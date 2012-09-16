<?php

/**
 * @package Pillar
 * @author Sam Korn <smoddy@gmail.com>
 * @author Soxred93 <soxred93@gmail.com>
 * @copyright Copyright (c) 2009, Sam Korn
 * @license http://opensource.org/licenses/mit-license.php MIT License
*/
if (!defined(PILLAR)) {
    die("Invalid entry point. Quitting.");
}

/**
 * Generic request class
 * 
 * Use to make any non-MediaWiki request.
 * 
 * @package Pillar
 *
 */
class Request {
    /**
     * URL used for request
     *
     * @var string
     */
    protected $host;
    /**
     * Path to script used for request
     *
     * @var string
     */
    protected $path;
    /**
     * Query value pairs used in request
     *
     * @var array
     */
    protected $query;
    /**
     * Additional cURL options
     *
     * @var array
     */
    protected $opts;
    /**
     * Method used for request (GET/POST)
     *
     * @var string
     */
    protected $method;
    /**
     * Raw result from server
     *
     * @var string
     */
    protected $raw;
    /**
     * Headers returned by server
     * 
     * Will not include HTTP status codes
     *
     * @var array
     */
    protected $headers;
    /**
     * Body of request
     *
     * @var string
     */
    protected $body;
    
    /**
     * Make new request
     * 
     * $site must be a {@link Site} or a {@link MWSite} instance.
     * 
     * $query must be an array of requests to put in the HTTP query. They should be in the format
     * 
     * <pre> array('field'=>'value','field2'=>'value2')</pre>
     * 
     * For more information, see {@link http://www.php.net/http_build_query http_build_query()}.
     * 
     * $post must be a boolean value.  true causes the request to be a POST request; false causes
     * it to be a GET request.  The default is false.
     * 
     * $path should be any additional path to be appended to the default Site path. The default is
     * an empty string.
     * 
     * $opts should be any additional cURL options desired, in the format
     * 
     * <pre> array('CURLOPT_POST',true)</pre>
     * 
     * Beware of unintended results with this: if you set CURLOPT_POST as in the example above, the 
     * query set by $query will be used as if it was a GET request (i.e. appended to the URL) and 
     * your POST request may be treated incorrectly.
     *
     * @param Site &$site Site instance upon which to make request
     * @param array $query Array of values to place in query
     * @param boolean $post Set to true to enable a POST query (a GET request is the default)
     * @param string $path Replace the regular {@link Site::get_path() path} for the site
     * @param array $opts Array of values to add to the cURL request
     */
    public function __construct(&$site,$query,$post = false,$path = '',$opts = array()) {       
       if (!is_array($opts)) {
          throw new PillarBadOpts();
       }
       if (!is_a($site,'Site')) {
          throw new PillarNotSite();
       }
       if ($query == false) {
          $query = array();
       }
       if (!is_array($query)) {
          throw new PillarBadQuery();
       }
       
       $url = Request::remove_slashes($site->get_host()) . '/' . ($path != '' ? Request::remove_slashes($path) : Request::remove_slashes($site->get_path())) . ((!$post) && ($query != array()) ? '?' . http_build_query($query) : '');
       
       $ms = microtime(1);
       $ch = curl_init($url);
       
       curl_setopt ($ch , CURLOPT_RETURNTRANSFER , 1                                       );
       curl_setopt ($ch , CURLOPT_COOKIEJAR     , '.pillar.' . $site->get_id() . '.cookies'       );
       curl_setopt ($ch , CURLOPT_COOKIEFILE    , '.pillar.' . $site->get_id() . '.cookies'       );
       curl_setopt ($ch , CURLOPT_CONNECTTIMEOUT , 5                                       );
       curl_setopt ($ch , CURLOPT_USERAGENT     , 'Pillar Mediawiki Framework ' . Pillar::$version );
       curl_setopt ($ch , CURLOPT_HTTPHEADER    , array('Expect:')                           ); //necessary for WMF's Squids
       curl_setopt ($ch , CURLOPT_HTTP_VERSION,   CURL_HTTP_VERSION_1_0                     ); //Avoid future problem with WMF servers
       curl_setopt ($ch , CURLOPT_FAILONERROR    , true                                    ); //HTTP responses >= 400 will cause a curl error
       curl_setopt ($ch , CURLOPT_HEADER        , true                                    );
       
       foreach ($opts as $opt) {
          curl_setopt($ch,$opt['name'],$opt['setting']);
       }
       
       if ($post != false) {
          curl_setopt ($ch , CURLOPT_POST      , true                );
          curl_setopt ($ch , CURLOPT_POSTFIELDS , http_build_query($query) );
       }
       
       $this->host = Request::remove_slashes($site->get_host());
       $this->path = Request::remove_slashes($site->get_path()) . ($path != '' ? ($site->get_path() ? '/' : '') . Request::remove_slashes($path) : '');
       $this->query = $query;
       $this->opts = $opts;
       $this->method = ($post ? 'POST' : 'GET');
       
       if ($this->method == 'POST') {
          $site->throttle_post();
          $site->set_lastpost();
       } else {
          $site->throttle_get();
          $site->set_lastget();
       }
       
       $result = curl_exec($ch);
       
       Pillar::report("{$this->method}: $url".' ('.(microtime(1) - $ms).' s) ('.strlen($result)." b)",PILLAR_URL);
       
       if (curl_errno($ch) != 0) {
          throw new PillarCurlError(curl_errno($ch),curl_error($ch));
       }   
       
       $this->raw = $result;
       $this->split_reply();
       
       $this->headers = explode("\n",$this->headers);
       foreach ($this->headers as $key => $header) {
          if (0 !== preg_match('/^(.*?):[\s]?(.*?)$/',$header,$match)) {
             $this->headers[$match[1]] = $match[2];
             unset($this->headers[$key]);
          } else {
             unset($this->headers[$key]);
          }
       }
       
       return;
    }
    
    /**
     * Remove slashes from each end of string
     * 
     * @internal Used in making correct URLs.
     *
     * @param string $text Text to escape
     *
     * @return string
     */
    private static function remove_slashes($text) {
       return (preg_replace('/^\/?(.*?)\/?$/',"\\1",$text));
    }
    
    /**
     * Split headers and body out of raw result
     * 
     * Break {@link get_raw() raw output from server} into {@link get_headers() headers} and
     * {@link get_body() body}.
     *
     * @return void
     */
    private function split_reply() {
       $this->raw = str_replace("\r\n","\n",$this->raw);
       $char = false;
       $i = 0;
       while (strlen($this->raw) > $i) {
          if (($char === $this->raw[$i]) && ($char === "\n")) {
             break;
          }
          $char = $this->raw[$i];
          $i++;
       }
       $this->headers = substr($this->raw,0,$i-1);
       $this->body = substr($this->raw,$i+1);
       return;
    }
    
    /**
     * Get host used in request
     * 
     * Return host used in {@link __construct() request}.
     *
     * @return string
     */
    public function get_host() {
       return $this->host;
    }
    
    /**
     * Return path to script in request
     * 
     * Return path used in {@link __construct() request}.
     *
     * @return string
     */
    public function get_path() {
       return $this->path;
    }
    
    /**
     * Return query sent in request
     * 
     * Return array of values sent in {@link __construct() request}.
     *
     * @return array
     */
    public function get_query() {
       return $this->query;
    }
    
    /**
     * Return additional cURL options sent in request
     * 
     * Return additional cURL options set in {@link __construct() request}.
     *
     * @return array
     */
    public function get_opts() {
       return $this->opts;
    }
    
    /**
     * Return method used in request
     * 
     * Return method (POST/GET) used in {@link __construct() request}.
     *
     * @return unknown
     */
    public function get_method() {
       return $this->method;
    }
    
    /**
     * Return raw text
     * 
     * Return the raw text sent by server (headers and body unsplit).
     *
     * @return string
     */
    public function get_raw() {
       return $this->raw;
    }
    
    /**
     * Return headers
     * 
     * Return array of headers sent by server.
     *
     * @return array
     */
    public function get_headers() {
       return $this->headers;
    }
    
    /**
     * Return body
     * 
     * Return the body of the server's response.
     *
     * @return string
     */
    public function get_body() {
       return $this->body;
    }
}