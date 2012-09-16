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
 * Creates a new MediaWiki site
 * 
 * Create a new MediaWiki site, inheriting all properties and methods from {@link Site}.
 * 
 * Provides a method to {@link login() login} (automatically invoked when the page is 
 * {@link __construct() created}).
 * 
 * Provides general site information, e.g.
 *  - {@link get_admin() whether user is an admin}
 *  - {@link get_bot() whether user is a bot}
 *  - {@link get_loggedin() whether the user is logged in}
 *  - {@link get_username() what the user's username} 
 * 
 * Also provides non-page specific functions, e.g. 
 *  - {@link blockuser() block a user}
 *  - {@link blockip() block an IP}
 *  - {@link get_categorymembers() category members}
 *  - {@link get_embeddedin() pages where a particular template is embedded}
 *  - {@link get_imageuse() pages using an image}
 *  - {@link get_extlinksto() pages linking to a particular external site}
 * 
 * @package Pillar
 * @see Site
 *
 */
class MWSite extends Site {
    /**
     * Username of logged-in user
     *
     * @var string
     */
    private $username;
    /**
     * User bot?
     *
     * @var bool
     */
    private $bot;
    /**
     * User admin?
     *
     * @var bool
     */
    private $admin;
    /**
     * User logged in?
     *
     * @var bool
     */
    private $loggedin;
    /**
     * Confirm every action?
     * 
     * @var bool
     */
    private $confirmaction;
    /**
     * Limit looping when server responds with maxlag
     * 
     * @var int
     */
    private $maxlagloops;
    
    /**
     * New MediaWiki site
     * 
     * Create a new MediaWiki site.
     * 
     * Does the same as {@link Site::__construct()}, but also attempts {@link login() login} and handles login throttling (MediaWiki
     * limits the frequency of login attempts).
     *
     * @param string $host
     * @param string $path
     * @param string $username
     * @param string $password
     * @param boolean $confirmbot
     */
    public function __construct($id,$host,$path,$username='',$password='',$confirmbot=true) {
        parent::__construct($id,$host,$path);
        
        $this->maxlagloops = 0;
        
        
        
        while (true) {
            try {
                $this->login($username,$password,$confirmbot);
            } catch (PillarThrottled $e) {
                Pillar::report($e->getMessage() . "\nWaiting " . $e->get_wait() . " seconds\n",PILLAR_ERROR);
                sleep($e->get_wait());
                continue;
            } catch (PillarLoginError $e) {
                Pillar::report($e->getMessage(),PILLAR_ERROR);
                continue;
            }
            
            break;
        }
        
        $this->confirmaction = true;
    }
    
    /**
     * Do login
     * 
     * Attempt login.
     * 
     * If username and password are not provided in function call, get them from command-line input.
     * (Password input is done with hidden text.)
     * 
     * The method will continue looping until the user is successfully logged in or the script is 
     * manually terminated (Ctrl+C).
     * 
     * Set $confirmbot to false to avoid checking whether user is a bot.  This is necessary for 
     * cronjobs where the user does not have a bot flag (otherwise the script will hang indefinitely
     * waiting for user input).
     * 
     * @param string $username Username
     * @param string $password Password
     * @param boolean $confirmbot Set to false to prevent checking whether user is a bot
     */
    public function login($username='',$password='',$confirmbot=true) {
        Pillar::report("Attempting login to {$this->host} ('{$this->id}')",PILLAR_ACTION);
        
        do {
            while ($username == '') {
                print "Username: ";
                $username = trim(fgets(STDIN));
            }
            while ($password == '') {
                print "Password: ";
                shell_exec('stty -echo'); // turn off displaying text on the terminal for password input
                $password = trim(fgets(STDIN));
                shell_exec('stty echo');
                print "\n";
            }
            
            $request = new MWRequest($this,array('action'=>'login','lgname' => $username,'lgpassword' => $password),true);
            $result = $request->get_result();
            
            if (!is_array($result['login'])) {
                throw new PillarBadResult($result);
            }
            
            switch ($result['login']['result']) {
                case 'Success':
                    break;
                case 'Illegal':
                    throw new PillarIllegalUsername($username);
                case 'NotExists':
                    throw new PillarUserNotExists($username);
                case 'WrongPass':
                    throw new PillarWrongPassword();
                case 'Throttled':
                    throw new PillarThrottled($result['login']['wait']);
                default:
                    throw new PillarLoginError(print_r($result,1));
            }
            
            $request = new MWRequest($this,array('action'=>'query', 'meta'=>'userinfo', 'uiprop'=>'groups|blockinfo'));
            $result = $request->get_result();
            
            $this->username = $result['query']['userinfo']['name'];
            
            if (in_array('bot',$result['query']['userinfo']['groups'])) {
                $this->bot = true;
            } else {
                $this->bot = false;
            }
            
            if (in_array('sysop',$result['query']['userinfo']['groups'])) {
                $this->admin = true;
            } else {
                $this->admin = false;
            }
            
            $this->loggedin = true;
            
            Pillar::report("Logged in to {$this->host} ({$this->id}) as {$this->username}",PILLAR_ACTION);

            if (($this->get_bot() == false) && ($confirmbot == true)) {
                do {
                    print "User " . $this->username . " is not a bot. Continue? (y/n) ";
                    $continue = trim(fgets(STDIN));
                } while (($continue != 'y') && ($continue != 'n'));
                
                if ($continue == 'y') {
                    break;
                } else {
                    $this->logout();
                    die();
                }
            }
            
            break;
        } while (true);
    }
    
    /**
     * Logout
     *
     */
    private function logout() {
        new MWRequest($this,array('action'=>'logout'));
    }
    
    /**
     * Set action confirmations
     * 
     * Change setting of whether actions (edits, moves, blocks, protections, deletions) should
     * be confirmed.
     * 
     * @see get_confirmaction()
     * @see Pillar::confirmaction()
     * 
     * @param boolean $value True to enable confirmations, false to disable
     */
    public function set_confirmaction($value) {
        $this->confirmaction = $value ? true : false;
    }
    
    /**
     * Get action confirmations
     * 
     * Return whether or not actions (edits, moves, blocks, protections, deletions) should
     * be confirmed.
     * 
     * @see set_confirmaction()
     * @see Pillar::confirmaction()
     *
     * @return boolean
     */
    public function get_confirmaction() {
        return $this->confirmaction;
    }
    
    /**
     * Set maximum loops when server lagged
     * 
     * When a MediaWiki site has a large duplication lag, it responds with maxlag responses.
     * Pillar waits for the amount of time specified (normally 5 seconds) and tries again. 
     * By default, it will carry on doing this indefinitely -- to stop and shutdown the bot 
     * after a certain number of consecutive maxlag failures, use this function.
     * 
     * An integer is the maximum number of maxlag loops to hit.  Setting false (the default 
     * behaviour) means Pillar will keep trying indefinitely.
     * 
     * @see get_maxlagloops()
     * 
     * @param integer $maxloops Maximum number of consecutive maxlags before failure
     */
    public function set_maxlagloops($maxloops) {
        $this->maxlagloops = (int) $maxloops;
    }
    
    /**
     * Get the maximum number of maxlag loops
     * 
     * When a MediaWiki site has a large duplication lag, it responds with maxlag responses.
     * Pillar waits for the amount of time specified (normally 5 seconds) and tries again. 
     * 
     * Returns the maximum number of loops to try before shutting down.
     * 
     * @see set_maxlagloops()
     * 
     * @return integer
     */
    public function get_maxlagloops() {
        return $this->maxlagloops;
    }
    
    /**
     * Return bot status
     * 
     * Return true if the user is a bot, otherwise false.
     *
     * @return boolean
     */
    public function get_bot() {
        return $this->bot;
    }
    
    /**
     * Return username
     * 
     * Return username of user logged in on this {@link Site}.
     *
     * @return string
     */
    public function get_username() {
        return $this->username;
    }
    
    /**
     * Return admin status
     * 
     * Return true if the user is an admin, otherwise false.
     *
     * @return boolean
     */
    public function get_admin() {
        return $this->admin;
    }
    
    /**
     * Return login status
     * 
     * Return true if the user is logged in, otherwise false.
     *
     * @return boolean
     */
    public function get_loggedin() {
        return ($this->loggedin ? true : false);
    }
    
    /**
     * Return if a user has new messages or not
     * 
     * Return true if the user has new messages, otherwise false.
     *
     * @return boolean
     */
    public function get_newmessages() {
    	$request = new MWRequest($this,array('action'=>'query','meta' => 'userinfo','uiprop' => 'hasmsg'));
        $result = $request->get_result();
          
        if (isset($result['query']['userinfo']['messages'])) {
            return true;
        }
        return false;
    }
    
    /**
     * Embedded in
     * 
     * Get pages in which page $page is embedded.
     * 
     * $count may not be more than 500; values more than 500 will be reduced to 500.
     * 
     * Do not rely upon this function returning the number of pages in $count -- always use count()
     * 
     * The expected use of this function is
     * 
     * <pre> do {
     *     $pages = $site->get_embeddedin('Template:Stub',10,$continue,0);
     * } while ($continue != null)</pre>
     * 
     * @param string $page Target page
     * @param int $count Maximum number of page titles to retrieve
     * @param string &$continue Reference to continue parameter
     * @param int $namespace Namespace to retrieve results in
     * @return array
     */
    public function get_embeddedin($page,$count,&$continue,$namespace = null) {
        if ($page == '') {
            throw new PillarBadTitle($page);
        }
        
        $count = (int) $count;
        
        if ($count > 500) {
            $count = 500;
        }
        
        $vars = array ('action'=>'query','list'=>'embeddedin','eititle'=>$page,'eilimit'=>$count);
        
        if ($namespace) {
            $vars['einamespace'] = $namespace;
        }
        
        if ($continue) {
            $vars['eicontinue'] = $continue;
        }
        
        $request = new MWRequest($this,$vars);
        $result = $request->get_result();
        
        if (!is_array($result)) {
            throw new PillarBadResult($result);
        }
        
        if ((is_array($result['error']) && ($result['error']['code'] == 'eibadcontinue'))) {
            throw new PillarBadContinue($page);
        }
        
        if ($result['query-continue']) {
            $continue = $result['query-continue']['embeddedin']['eicontinue'];
        } else {
            $continue = null;
        }
        
        $return = array();
        
        foreach ($result['query']['embeddedin'] as $page) {
            $return[] = $page['title'];
        }
        return $return;
    }
    
    /**
     * Category members
     * 
     * Get pages that are in category $category.
     *
     * $count may not be more than 500; values more than 500 will be reduced to 500.
     * 
     * Do not rely upon this function returning the number of pages in $count -- always use count().
     * 
     * The expected use of this function is
     * 
     * <pre> do {
     *     $pages = $site->get_categorymembers('Category:Stubs',10,$continue,0);
     * } while ($continue != null)</pre>
     * 
     * @param string $category Target category
     * @param int $count Maximum number of page titles to retrieve
     * @param string &$continue Reference to continue parameter
     * @param int $namespace Namespace to retrieve results in
     * @return array
     */
    public function get_categorymembers($category,$count = 500,&$continue = null,$namespace = null) {
        if ($category == '') {
            throw new PillarBadTitle($category);
        }
        
        $count = (int) $count;
        
        if ($count > 500) {
            $count = 500;
        }
        
        $vars = array ('action'=>'query','list'=>'categorymembers','cmtitle'=>$category,'cmlimit'=>$count, 'cmprop'=>'title|sortkey');
        
        if ($namespace) {
            $vars['cmnamespace'] = $namespace;
        }
        
        if ($continue) {
            $vars['cmcontinue'] = $continue;
        }
        
        $request = new MWRequest($this,$vars);
        $result = $request->get_result();
        
        if (!is_array($result)) {
            throw new PillarBadResult($result);
        }
        
        if ((is_array($result['error']) && ($result['error']['code'] == 'cmbadcontinue'))) {
            throw new PillarBadContinue($category);
        }
        
        if ($result['query-continue']) {
            $continue = $result['query-continue']['categorymembers']['cmcontinue'];
        } else {
            $continue = null;
        }
        
        $return = array();
        
        if (is_array($result['query']['categorymembers'])) {
            foreach ($result['query']['categorymembers'] as $page) {
                $return[] = array('title'=>$page['title'],'sortkey'=>$page['sortkey']);
            }
        } else {
            $return = array();
        }
        return $return;
    }
    
    /**
     * Image use
     * 
     * Get pages that use image $image.
     *
     * $count may not be more than 500; values more than 500 will be reduced to 500.
     * 
     * Do not rely upon this function returning the number of pages in $count -- always use count().
     * 
     * The expected use of this function is
     * 
     * <pre> do {
     *     $pages = $site->get_imageuse('File:Wiki.png',10,$continue,0);
     * } while ($continue != null)</pre>
     *
     * @param string $image Target image
     * @param int $count Maximum number of page titles to retrieve
     * @param string &$continue Reference to continue parameter
     * @param int $namespace Namespace to retrieve results in
     * @return array
     */
    public function get_imageuse($image,$count = 500,&$continue = null,$namespace = null) {
        if ($image == '') {
            throw new PillarBadTitle($image);
        }
        
        $count = (int) $count;
        
        if ($count > 500) {
            $count = 500;
        }
        
        $vars = array ('action'=>'query','list'=>'imageusage','iutitle'=>$image,'iulimit'=>$count);
        
        if ($namespace) {
            $vars['iunamespace'] = $namespace;
        }
        
        if ($continue) {
            $vars['iucontinue'] = $continue;
        }
        
        $request = new MWRequest($this,$vars);
        $result = $request->get_result();
        
        if (!is_array($result)) {
            throw new PillarBadResult($result);
        }
        
        if ((is_array($result['error']) && ($result['error']['code'] == 'iubadcontinue'))) {
            throw new PillarBadContinue($image);
        }
        
        if ($result['query-continue']) {
            $continue = $result['query-continue']['imageusage']['iucontinue'];
        } else {
            $continue = null;
        }
        
        $return = array();
        
        if (is_array($result['query']['imageusage'])) {
            foreach ($result['query']['imageusage'] as $page) {
                $return[] = $page['title'];
            }
        } else {
            $return = array();
        }
        return $return;
    }
        
    /**
     * External links
     * 
     * Get all pages that link to the external site $url.
     * 
     * Do <b>not</b> include protocol (e.g. http) in $url.
     * 
     * $count may not be more than 500; values more than 500 will be reduced to 500.
     * 
     * Do not rely upon this function returning the number of pages in $count -- always use count().
     * 
     * The expected use of this function is
     * 
     * <pre> do {
     *     $pages = $site->get_extlinksto('slashdot.org',10,$offset,0);
     * } while ($offset != null)</pre>
     *
     * @param string $url Target url
     * @param int $count Maximum number of page titles to retrieve
     * @param string &$continue Reference to continue parameter
     * @param int $namespace Namespace to retrieve results in
     * @param string $protocol Protocol to filter by.
     * @return array
     */
    public function get_extlinksto($url,$count = 500,&$offset=0,$namespace = null,$protocol=null) {
        if ($url == '') {
            throw new PillarBadTitle($url);
        }
        
        $count = (int) $count;
        
        if ($count > 500) {
            $count = 500;
        }
        
        $vars = array ('action'=>'query','list'=>'exturlusage','euquery'=>$url,'eulimit'=>$count,'euoffset'=>$offset);
        
        if ($namespace) {
            $vars['eunamespace'] = $namespace;
        }
        
        if ($protocol) {
        	$vars['euprotocol']= $protocol;
        }
        
        $request = new MWRequest($this,$vars);
        $result = $request->get_result();
        
        if (!is_array($result)) {
            throw new PillarBadResult($result);
        }
        
        if ((is_array($result['error']) && ($result['error']['code'] == 'iubadcontinue'))) {
            throw new PillarBadContinue($url);
        }
        
        if ($result['query-continue']) {
            $offset = (int) $result['query-continue']['exturlusage']['euoffset'];
        } else {
            $offset = null;
        }
        
        $return = array();
        
        if (is_array($result['query']['exturlusage'])) {
            foreach ($result['query']['exturlusage'] as $page) {
                $return[] = array('title'=>$page['title'],'url'=>$page['url']);
            }
        } else {
            $return = array();
        }
        return $return;
    }
    
    /**
     * Diff function
     * 
     * Gets a diff
     * 
     * $title is the page to retrieve
     * 
     * $oldid is the old revision id
     * 
     * $id is the new revision id
     * 
     * @param string $title Page to retrieve
     * @param string $oldid Old revision id
     * @param string $id New revision id
     * @return array
     */
    public function diff ($title,$oldid,$id) {
    	#FIXME: USE THE API ONCE WIKIMEDIA IS SCAPPED!
		$deleted = '';
		$added = '';

		$html = new MWRequest($this,array('title'=>$title,'action' => 'render','diff' => $id,'oldid' => $oldid,'diffonly' => 1),false,array(),true);
        $html = $html->get_body(); //MWRequest inherits this function from Request

		if (preg_match_all('/\&amp\;(oldid\=|undo=)(\d*)\'\>(Revision as of|undo)/USs', $html, $m, PREG_SET_ORDER)) {
			//print_r($m);
			if ((($oldid != $m[0][2]) and (is_numeric($oldid)))) {
				throw new PillarBadDiff($title,$id);
			}
		}
		
		if (preg_match_all('/\<td class\=(\"|\')diff-addedline\1\>\<div\>(.*)\<\/div\>\<\/td\>/USs', $html, $m, PREG_SET_ORDER)) {
			//print_r($m);
			foreach ($m as $x) {
				$added .= htmlspecialchars_decode(strip_tags($x[2]))."\n";
			}
		}
			if (preg_match_all('/\<td class\=(\"|\')diff-deletedline\1\>\<div\>(.*)\<\/div\>\<\/td\>/USs', $html, $m, PREG_SET_ORDER)) {
			//print_r($m);
			foreach ($m as $x) {
				$deleted .= htmlspecialchars_decode(strip_tags($x[2]))."\n";
			}
		}

		return array($added,$deleted);
	}
	
	/**
     * Logs
     * 
     * Get info from Special:Log
     *
     * $limit may not be more than 500; values more than 500 will be reduced to 500.
     * 
     * @param string $user Target user, default to null
     * @param string $title Target title, default to null
     * @param integer $limit Number of logs to retrieve, default to 50
     * @param string $type Log type to retrieve, default to null
     * @param string $start Time to start at, default to null
     * @param string $end Time to end at, default to null
     * @param string $dir Direction to go, default older
     * @return array
     */
    public function logs ($user = null,$title = null,$limit = 50,$type = null,$start = null,$end = null,$dir = 'older') {
        
        $limit = (int) $limit;
        
        if ($limit > 500) {
            $limit = 500;
        }
        
        $vars = array ('action'=>'query','list'=>'logevents','leprop'=>'ids|title|type|user|timestamp|comment|details');
        
        if ($user != null) $vars['leuser='] = $user;
		if ($title != null) $vars['letitle='] = $title;
		if ($limit != null) $vars['lelimit='] = $limit;
		if ($type != null) $vars['letype='] = $type;
		if ($start != null) $vars['lestart='] = $start;
		if ($end != null) $vars['leend='] = $end;
		if ($dir != null) $vars['ledir='] = $dir;
        
        $request = new MWRequest($this,$vars);
        $result = $request->get_result();
        
        if (!is_array($result)) {
            throw new PillarBadResult($result);
        }
        
        return $result['query']['logevents'];
    }
    
    /**
     * Upload
     * 
     * Upload a file
     * 
     * @param string $username Destination name
     * @param string $password File location
     * @param string $desc Image description
     */
    public function upload($page='',$file='',$desc='') {
        $html = new MWRequest($this,array(
        	'title'=>'Special:Upload',
        	'action' => 'submit',
        	'wpUploadFile' => '@'.$file,
        	'wpSourceType' => 'file',
        	'wpDestFile'		=> $page,
			'wpUploadDescription'	=> $desc,
			'wpLicense'		=> '',
			'wpWatchthis'		=> '0',
			'wpIgnoreWarning'	=> '1',
			'wpUpload'		=> 'Upload file'
        ),false,array(),true);
        $result = $html->get_body(); //MWRequest inherits this function from Request
        
       if (!$result) {
            throw new PillarBadResult($result);
        }
    }
}