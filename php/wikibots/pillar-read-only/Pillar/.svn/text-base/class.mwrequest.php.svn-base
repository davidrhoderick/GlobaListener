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
 * MediaWiki request class
 * 
 * Make requests to a MediaWiki site.
 * 
 * All requests to a MediaWiki site should be channelled through this.
 * 
 * Adds necessary format, maxlag, and assert properties to the generic {@link Request}
 * class, which it inherits.
 * 
 * Also unserializes the result received and makes it accessible through {@link get_result()}.
 * 
 * @package Pillar
 *
 */
class MWRequest extends Request {
    /**
     * Unserialized MediaWiki API result
     *
     * @var string
     */
    private $result;
    
    /**
     * Make a new request
     * 
     * Create a new request to a MediaWiki site.  Unserialize reuslt and make it available through
     * {@link get_result()}.
     * 
     * This function also handles maxlag failures. When it detects the server has returned a maxlag
     * response, it waits for the recommended time (or longer, if {@link Site throttling limits} are
     * reached), then tries again.  It will do this indefinitely unless set to do otherwise in 
     * {@link MWSite::set_maxlagloops()}.
     * 
     * See {@link Request::__construct()} for detailed parameter information.
     *
     * @param MWSite $site MWSite to build request on
     * @param array $query Array of values to place in query
     * @param boolean $post Set to true to enable a POST query (a GET request is the default)
     * @param array $opts Array of values to add to the cURL request
     * @param boolean $index Use the index.php interface instead of the api.php interface
     */
    public function __construct($site,$query,$post = false,$opts = array(),$index = false) {
        $query['format'] = 'php';
        $query['maxlag'] = '5';
        if ($post && $site->get_loggedin() && $site->get_bot()) {
            $query['assert'] = 'bot';
        }
        
        do {
            $path = ($index ? str_replace('api.php','index.php',$site->get_path()) : false);
            parent::__construct($site,$query,$post,$path,$opts);
            
            $this->result = unserialize($this->body);
            
            if (array_key_exists('X-Database-Lag',$this->headers)) {
                preg_match('/Waiting for [^ ]*: ([0-9.-]+) seconds lagged/',$this->result['error']['info'],$match);
                Pillar::report("Server lagged (" . $match[1] . ' seconds): retry in minimum ' . $this->headers['Retry-After'] . " seconds",PILLAR_ERROR);
                sleep ($this->headers['Retry-After']);
                
                if ($site->get_maxlagloops() != 0) {
                    $i++;
                } else {
                    $i = -1; //continue indefinitely
                }
            }
        } while ((array_key_exists('X-Database-Lag',$this->headers)) && ($i < $site->get_maxlagloops()));
        
        if (array_key_exists('X-Database-Lag',$this->headers)) { // i.e. the second part of the above condition evaluated to false
            print "Server heavily lagged ($i consecutive maxlag responses): shutting down\n";
            die();
        } else { //i.e. we have a result
            return;
        }
    }
    
    /**
     * Get unserialized result
     * 
     * Get the unserialized content returned from MediaWiki API
     *
     * @return string
     */
    public function get_result() {
        return $this->result;
    }
    
    /**
     * Get plain result
     * 
     * Get the plain content from a web request
     *
     * @return string
     */
    public function get_plain_result() {
        return $this->body;
    }
}