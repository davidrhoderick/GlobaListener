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
 * Keep information about a site
 * 
 * Site objects are created by {@link Pillar} to keep information about a site and to form
 * the basis for {@link Request Requests} and {@link MWRequest MWRequests}.
 * 
 * Methods provided by the object allow for control of request rate ("throttling").  This 
 * is the main advantage (along with brevity!) of using this class over raw cURL requests.
 * 
 * Use {@link MWSite} for MediaWiki sites.
 *
 * @package Pillar
 */
class Site {
    /**
     * Pillar's identification string for this site
     * 
     * @var string
     */
    protected $id;
    /**
     * Hostname of site
     *
     * @var string
     */
    protected $host;
    /**
     * Path to script
     *
     * @var string
     */
    protected $path;
    /**
     * Time between GET requests
     * 
     * 60 / edits per minute
     * 
     * NOT edits per minute
     * 
     * @see lastget
     * @see postrate
     * @see allrate
     *
     * @var int
     */
    protected $getrate;
    /**
     * UNIX timestamp for last GET request
     *
     * @see getrate
     * @see lastpost
     * @see lastall
     *
     * @var int
     */
    protected $lastget;
    /**
     * Time between POST requests
     *
     * @see lastpost
     * @see getrate
     * @see allrate
     *
     * @var int
     */
    protected $postrate;
    /**
     * UNIX timestamp for last POST request
     * 
     * @see postrate
     * @see lastget
     * @see lastall
     *
     * @var int
     */
    protected $lastpost;
    /**
     * Time between requests of any type
     * 
     * @see lastall
     * @see postrate
     * @see getrate
     *
     * @var int
     */
    protected $allrate;
    /**
     * UNIX timestamp for last request of any type
     *
     * @see allrate
     * @see lastpost
     * @see lastget
     *
     * @var int
     */
    protected $lastall;
    
    /**
     * Create new Site object
     * 
     * Create a new Site object.
     *
     * The method applies default edit-rates of
     * - GET 15 requests per minute
     * - POST 6 requests per minute
     * - all 15 requests per minute
     * 
     * The method sets last requests of each type to be the appropriate time in the past,
     * so that requests are not pointlessly throttled on startup.
     *
     * @param string $host Hostname of server
     * @param string $path Path to script
     */
    public function __construct($id,$host,$path) {
        $this->id = $id;
        $this->host = $host;
        $this->path = $path;
        
        $nice = (in_array('--no-throttle',$GLOBALS['argv']) ? false : true);
        
        $this->getrate = $nice ? 60 / 15 : 0;
        $this->postrate = $nice ? 60 / 6 : 0;
        $this->allrate = $nice ? 60 / 15 : 0;
        
        $this->lastget = time() - $this->getrate;
        $this->lastpost = time() - $this->postrate;
        $this->lastall = time() - $this->allrate;
    }
    
    /**
     * Return id
     * 
     * Return Pillar's identification for the site.
     *
     * @return string
     */
    public function get_id() {
        return $this->id;
    }
    
    /**
     * Return host
     * 
     * Return the hostname for the site
     *
     * @return string
     */
    public function get_host() {
        return $this->host;
    }
    
    /**
     * Return path to script
     * 
     * Return the path to the script.
     *
     * @return string
     */
    public function get_path() {
        return $this->path;
    }
    
    /**
     * Log a new GET request
     * 
     * Log a new GET request for the Site to allow throttling.  Used by {@link throttle_get()}.
     * 
     * @see set_lastpost()
     *
     */
    public function set_lastget() {
        $this->lastget = time();
        $this->lastall = time();
    }
    
    /**
     * Log a new POST request
     * 
     * Log a new POST request for the Site to allow throttling.  Used by {@link throttle_post()}.
     *
     */
    public function set_lastpost() {
        $this->lastpost = time();
        $this->lastall = time();
    }
    
    /**
     * Set a new GET rate
     * 
     * Set a new maximum rate for GET requests.
     * 
     * $rpm must be requests per minute, not time between requests.
     *
     * @param int $rpm Maximum GET requests per minute
     */
    public function set_getrate($rpm) {
        $this->getrate = (int) 60 / $rpm;
    }
    
    /**
     * Set a new POST rate
     * 
     * Set a new maximum rate for POST requests.
     * 
     * $rpm must be requests per minute, not time between requests.
     *
     * @param int $rpm Maximum POST requests per minute
     */
    public function set_postrate($rpm) {
        $this->postrate = (int) 60 / $rpm;
    }
    
    /**
     * Set a new rate for all requests
     * 
     * Set a new maximum rate for GET and POST requests combined.
     * 
     * Provide requests per minute, not time between requests
     *
     * @param int $rpm Maximum total requests per minute
     */
    public function set_allrate($rpm) {
        $this->allrate = (int) 60 / $rpm;
    }
    
    /**
     * Do GET throttling
     * 
     * Do any necessary throttling before a GET request.
     * 
     * Throttling for any GET requests is done first, followed by that for all requests, including POST.
     *
     */
    public function throttle_get() {
        if ((time() - $this->lastget) < ($this->getrate)) {
            sleep ((int) $this->getrate - (time() - $this->lastget));
        }
        
        if ((time() - $this->lastall) < $this->allrate) {
            sleep ((int) $this->allrate - (time() - $this->lastall));
        }
        
        return;
    }
    
    /**
     * Do POST throttling
     * 
     * Do any necessary throttling before a POST request.
     * 
     * Throttling for any POST requests is done first, followed by that for all requests, including GET.
     *
     */
    public function throttle_post() {
        if ((time() - $this->lastpost) < $this->postrate) {
            sleep ((int) $this->postrate - (time() - $this->lastpost));
        }
        
        if ((time() - $this->lastall) < $this->allrate) {
            sleep ((int) $this->allrate - (time() - $this->lastall));
        }
        
        return;
    }
}