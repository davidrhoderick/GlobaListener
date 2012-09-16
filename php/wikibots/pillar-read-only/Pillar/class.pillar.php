<?php
/**
 * @package Pillar
 * @version 0.1
 * @author Sam Korn <smoddy@gmail.com>
 * @author Soxred93 <soxred93@gmail.com>
 * @copyright Copyright (c) 2009, Sam Korn
 * @license http://opensource.org/licenses/mit-license.php MIT License
*/

if (!defined(PILLAR)) {
    die("Invalid entry point. Quitting.");
}

/**
 * Parent Pillar object
 * 
 * Creating this initialises the application and manages open sites.
 * 
 * Multiple {@link Site} (or {@link MWSite}) instances can be created for the same site, e.g. if both a bot and a sysop account 
 * need to be logged in.  Note that request-throttling happens based on Site instance, not on hostname.
 * Therefore you need to be conservative with your request speeds if you intend to do multiple logins
 * on one host.
 *
 * @package Pillar
 * 
 */
class Pillar {
    
    private static $instance;
    /**
     * Index of indexed sites
     * 
     * Array where key is a site identifier and value is a reference to a Site or MWSite object
     *
     * @var array
     */
    private $sitesindex;
    /**
     * Shortcut to get the site being used
     * 
     * This can be used $pillar->cursite->get_embeddedin()
     * 
     * Equivalent to $pillar->get_site(id of site)
     *
     * @var string
     */
    public $cursite;
    
    /**
     * Pillar version
     * 
     * Sent in user-agent
     *
     * @var string
     */
    public static $version = '0.1';
    
    /**
     * Browser to use in page previews
     * 
     * False sets Pillar to attempt to use colordiff and then diff. If neither is available, it
     * falls back on the command "firefox"
     * 
     * Any other value will be interpreted as a string and given as a shell argument.
     * 
     * @var mixed
     */
    private $browser = false;
    /**
     * Reporting levels
     * 
     * Array of levels of reporting
     * 
     * array ('urls'=>true) (leaving options open to add more levels at some stage...)
     * 
     * @var array
     */ 
    public $reporting;
    
    /**
     * Make new Pillar instance
     * 
     * Will create a new Pillar instance.  The initial site must be a MediaWiki site.
     * 
     * Arguments apply to the initial MWSite created by the function.
     *
     * @param string $id Identification string for site
     * @param string $host Hostname for site
     * @param string $path Path to script
     * @param string $username Username for MediaWiki site
     * @param string $password Password for MediaWiki site
     * @param boolean $confirmbot Set to false to disable the requirement to confirm if the user is not a bot
     */
    private function __construct() {
        $this->reporting = array (PILLAR_URL=>STDERR,PILLAR_ERROR=>STDERR,PILLAR_ACTION=>STDOUT);
        $this->siteindex = array();
        $this->cursite = false;
        
        register_shutdown_function(array(&$this,'deletecookies'));
        declare (ticks = 1);
        pcntl_signal(SIGINT, array(&$this,'shutdown'));
        pcntl_signal(SIGTERM, array(&$this,'shutdown'));
    }
    
    public static function get_instance() {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }
    
    /**
     * Remove cookie file on shutdown
     *
     */
    public function deletecookies() {
        if ($this->sitesindex) {
            foreach ($this->sitesindex as $site) {
                if (file_exists('.pillar.' . $site->get_id() . '.cookies')) {
                    unlink ('.pillar.' . $site->get_id() . '.cookies');
                }
            }
        }
        exit;
    }
    
    /**
     * Catch SIGINT and SIGTERM
     *
     */
    public function shutdown() {
        print "\nForce quit\n";
        die();
    }
    
    /**
     * Add a new MediaWiki site to the index
     * 
     * Add a new MediaWiki site to the index and login.
     * 
     * If username and password are set, attempt login with these
     *
     * @param string $id Identification string for site
     * @param string $host Hostname for site
     * @param string $path Path to script
     * @param string $username Username for MediaWiki site
     * @param string $password Password for MediaWiki site
     * @param boolean $confirmbot Set to false to disable the requirement to confirm if the user is not a bot
     */
    public function add_mwsite($id,$host,$path,$username='',$password='',$confirmbot=true) {
        if ($this->sitesindex && array_key_exists($id,$this->sitesindex)) {
            throw new PillarSiteInIndex($id);
        }
        
        $this->sitesindex[$id] = new MWSite($id,$host,$path,$username,$password,$confirmbot);
        
        if (count($this->sitesindex) == 1) {
            $this->cursite = $this->sitesindex[$id];
        }
        
        return;
    }
    
    /**
     * Add a new site to the index
     * 
     * Add a new non-MediaWiki site to the index
     *
     * @param string $id Identification string for site
     * @param string $host Hostname for site
     * @param string $path Path to script
     */
    public function add_site($id,$host,$path) {
        if (array_key_exists($id,$this->sitesindex)) {
            throw new PillarSiteInIndex($id);
        }
        
        $this->sitesindex[$id] = new Site($id,$host,$path);
        
        if (count($this->sitesindex) == 1) {
            $this->cursite = $this->sitesindex[$id];
        }
        
        return;
    }
    
    /**
     * Return the index of sites
     * 
     * Return a list of the sites in Pillar's index
     *
     * @return array
     */
    public function list_sites() {
        return $this->sitesindex;
    }
    
    /**
     * Return site
     * 
     * Return the site given the id $id in registration (see {@link add_site()} and {@link add_mwsite()}).
     *
     * @param string $id Identification string for site
     *
     * @return Site
     */
    public function get_site($id) {
        if (!array_key_exists($id,$this->sitesindex)) {
            throw new PillarSiteNotInIndex($id);
        }
        return $this->sitesindex[$id];
    }
    
    /**
     * Set current site
     * 
     * Set {@link $cursite} to allow easy access to site.
     *
     * @param string $id Identification string for site
     */
    public function set_cursite($id) {
        if (!array_key_exists($id,$this->sitesindex)) {
            throw new PillarSiteNotInIndex($id);
        }
        $this->cursite =& $this->sitesindex[$id];
        return;
    }
    
    /**
     * Destroy site
     * 
     * Remove site identified by $id (see (see {@link add_site()} and {@link add_mwsite()})
     * from the index.
     *
     * @param string $id Identification string for site
     */
    public function remove_site($id) {
        if (!array_key_exists($id,$this->sitesindex)) {
            throw new PillarSiteNotInIndex($id);
        }
        unset ($this->sitesindex[$id]);
        return;
    }
    
    /**
     * Launch Pillar from configuration file
     * 
     * Will launch Pillar, create a new MWSite for each section in the configuration file, apply global settings 
     * and return the Pillar instance.  This is vital for cronjobs; it is introduced to allow the scripts 
     * to be world-readable on a shared-server while ensuring that passwords can remain private.
     * 
     * The configuration file should be formatted as follows:
     *  <pre>  [pillar]
     *  browser=firefox 
     *  
     *  [enwiki]
     *  host=en.wikipedia.org
     *  path=w/api.php
     *  username=Username
     *  password=Password
     *  confirmaction=disabled
     *  confirmbot=disabled
     *  verbose=0</pre>
     * 
     * If you want to use in-console edit previews (using colordiff or diff), you can set browser=disabled or leave
     * it unset.
     * 
     * If you do not want to confirm actions (edits, moves, deletes, protects, blocks), set confirmaction=disabled.
     * Any other value will be evaluated as indicating that actions should be confirmed.
     * 
     * @param string $inifile Path to Pillar initialisation file
     * 
     * @global Pillar $pillar
     */
    static function ini_launch($inifile) {
        $initext = parse_ini_file($inifile,true);
        
        $pillar = Pillar::get_instance();
        
        foreach ($initext as $sitename => $section) {
            if ($sitename == 'pillar') {
                continue;
            }
            
            $checkbot = ($section['confirmbot'] == 'disabled') ? false : true;
            $pillar->add_mwsite($sitename,$section['host'],$section['path'],$section['username'],$section['password'],$checkbot);
            
            $site =& $pillar->get_site($sitename);
            
            if ($section['confirmaction'] != false) {
                $site->set_confirmaction(($section['confirmaction'] == 'disabled') ? false : true);
            }
            
            if ($section['getrate']) {
                $site->set_getrate($section['getrate']);
            }
            
            if ($section['postrate']) {
                $site->set_postrate($section['postrate']);
            }
            
            if ($section['allrate']) {
                $site->set_allrate($section['allrate']);
            }
        }
        
        if ($initext['pillar']['browser']) {
            $pillar->set_browser($initext['pillar']['browser']);
        }
        
        if ($initext['pillar']['reporting-urls']) {
            if ($initext['pillar']['reporting-urls'] == 'disabled') {
                $pillar->set_reporting(PILLAR_URL,false);
            }
        }
        if ($initext['pillar']['reporting-errors']) {
            if ($initext['pillar']['reporting-errors'] == 'disabled') {
                $pillar->set_reporting(PILLAR_ERROR,false);
            }
        }
        if ($initext['pillar']['reporting-actions']) {
            if ($initext['pillar']['reporting-actions'] == 'disabled') {
                $pillar->set_reporting(PILLAR_ACTION,false);
            }
        }
        
        return $pillar;
    }
    
    /**
     * Ask for confirmation of action
     * 
     * Ask for confirmation of an action, and wait for correct input.  Return true if the action is
     * confirmed (i.e. the user typed 'y') and false if the action is cancelled (i.e. if the user typed
     * 'n').
     * 
     * @param string $action String describing action
     * 
     * @return boolean
     */
    static function confirmaction($action) {
        while (($response != 'y') && ($response != 'n')) {
            print "Confirm action ($action)? (y/n) ";
            $response = strtolower(trim(fgets(STDIN)));
        }
        
        if ($response == 'y') {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Set the default action to take when doing show changes
     * 
     * Set the default action to take when doing {@link Page::show_changes()}.  Set to <b>false</b> to
     * use the default colordiff/diff options.
     * 
     * @param string $browser Command to run browser
     */
    public function set_browser($browser) {
        $this->browser = $browser;
    }
    
    /**
     * Get the default action to take when doing page previews
     * 
     * Return the default browser (set in {@link set_browser()}) for use in {@link Page::show_changes()}.
     */
    public function get_browser() {
        return $this->browser;
    }
    
    /**
     * Set reporting level
     * 
     * Set whether incidents of type $type should be reported.
     * 
     * @param string $type Incident type ('urls')
     * @param boolean $setting On or off
     * @return boolean
     */
    public function set_reporting($type,$setting) {
        switch ($type) {
            case (PILLAR_URL):
                $this->reporting[PILLAR_URL] = $setting;
                break;
            case (PILLAR_ERROR):
                $this->reporting[PILLAR_ERROR] = $setting;
                break;
            case (PILLAR_ACTION):
                $this->reporting[PILLAR_ACTION] = $setting;
                break;
        }
    }
    
    /**
     * Get reporting level
     * 
     * Get whether incidents of type $type should be reported.
     * 
     * @param string $type Incident type ('urls')
     * @param boolean $setting On or off
     * @return boolean
     */
    private function get_reporting($type) {        
        if (!is_a(self::$instance,'Pillar')) {
            return false;
        }
        
        switch ($type) {
            case (PILLAR_URL):
                return self::$instance->reporting[PILLAR_URL];
                break;
            case (PILLAR_ERROR):
                return self::$instance->reporting[PILLAR_ERROR];
                break;
            case (PILLAR_ACTION):
                return self::$instance->reporting[PILLAR_ACTION];
                break;
            default:
                return STDOUT; // better to be verbose, print to stdout
        }
    }
    
    static function report($notice,$type) {
        if ($fh = self::$instance->get_reporting($type)) {
            fwrite($fh,$notice . "\n\n");
        }
    }
}

define('PILLAR_URL',1);
define('PILLAR_ERROR',2);
define('PILLAR_ACTION',3);

/**
 * Generic Pillar exception
 * 
 * All exceptions inherit this
 * 
 * @package Pillar
 * 
 */
class PillarException extends Exception {
    public function __construct($message) {
        parent::__construct($message);
        Pillar::report("Error: " . $this->getMessage(),PILLAR_ERROR);
    }
}

/**
 * A site already exists identified by this id
 * 
 * @package Pillar
 * 
 */
class PillarSiteInIndex extends PillarException {
    public function __construct($id) {
        parent::__construct('A site identified by ' . $id . ' already exists in site index');
    }
}

/**
 * No sites in the index match this id
 * 
 * @package Pillar
 * 
 */
class PillarSiteNotInIndex extends PillarException {
    public function __construct($host) {
        parent::__construct($host . ' is not in the site index');
    }
}

/**
 * Extra cURL options must be provided in an array
 * 
 * @see class.request.php
 * 
 * @package Pillar
 * 
 */
class PillarBadOpts extends PillarException {
    public function __construct() {
        parent::__construct('Extra options must be an array');
    }
}

/**
 * Query values must be provided in an array
 * 
 * @see Request::__construct()
 * 
 * @package Pillar
 * 
 */
class PillarBadQuery extends PillarException {
    public function __construct() {
        parent::__construct('Query values must be an array');
    }
}

/**
 * Unexpected response
 * 
 * @package Pillar
 * 
 */
class PillarBadResult extends PillarException {
    public function __construct($result) {
        parent::__construct('Bad result: ' . print_r($result,1));
    }
}

/**
 * Error from cURL
 * 
 * Probably (though not necessarily) a >=400 response from server
 * 
 * @package Pillar
 * 
 */
class PillarCurlError extends PillarException {
    private $errno,$error;
    
    public function __construct($errno,$error) {
        $this->errno = $errno;
        $this->error = $error;
        
        parent::__construct('Curl error (' . $errno . '): ' . $error);
    }
    
    public function get_errno() {
        return $this->errno;
    }
    
    public function get_error() {
        return $this->error;
    }
}

/**
 * An instance of Site or MWSite must be provided in making a new Request
 * 
 * @package Pillar
 * 
 */
class PillarNotSite extends PillarException {
    public function __construct() {
        parent::__construct('Site object needed in Request::__construct()');
    }
}

/**
 * Title provided is invalid
 * 
 * (Almost certainly empty string)
 * 
 * @package Pillar
 * 
 */
class PillarBadTitle extends PillarException {
    public function __construct($title) {
        parent::__construct("Invalid title (\"$title\")");
    }
}

/**
 * Generic login error
 * 
 * @package Pillar
 * 
 */
class PillarLoginError extends PillarException {}

/**
 * MediaWiki replies that the username is illegal
 * 
 * @package Pillar
 * 
 */
class PillarIllegalUsername extends PillarLoginError {
    public function __construct($username) {
        parent::__construct("Illegal username (\"$username\")");
    }
}

/**
 * MediaWiki replies that the username does not exist
 * 
 * @package Pillar
 * 
 */
class PillarUserNotExists extends PillarLoginError {
    public function __construct($username) {
        parent::__construct("Username \"$username\" does not exist");
    }
}

/**
 * MediaWiki replies that the password is wrong
 * 
 * @package Pillar
 * 
 */
class PillarWrongPassword extends PillarLoginError {
    public function __construct() {
        parent::__construct("Incorrect password");
    }
}

/**
 * MediaWiki replies that the login throttle has been reached
 * 
 * @package Pillar
 * 
 */
class PillarThrottled extends PillarLoginError {
    private $wait;
    public function __construct($wait) {
        parent::__construct("Login throttled, wait $wait seconds");
        $this->wait = $wait;
    }
    public function get_wait() {
        return $this->wait;
    }
}

/**
 * Generic edit error
 * 
 * @package Pillar
 * 
 */
class PillarEditError extends PillarException {
    protected $title;
    
    public function __construct($message,$title = false) {
        parent::__construct($message);
        $this->title = $title;
    }
    
    public function get_title() {
        return $this->title;
    }
}

/**
 * MediaWiki replies that no edit-token was provided
 * 
 * @package Pillar
 * 
 */
class PillarEditNoToken extends PillarEditError {
    public function __construct($title) {
        parent::__construct("No edit-token provided when attempting to edit $title",$title);
    }
}

/**
 * The user appears to be logged out
 * 
 * @package Pillar
 * 
 */
class PillarEditLoggedOut extends PillarEditError {
    public function __construct($title) {
        parent::__construct("User appears to be logged out (editing $title)",$title);
    }
}

/**
 * No edit-summary was provided
 * 
 * @package Pillar
 * 
 */
class PillarEditNoSummary extends PillarEditError {
    public function __construct($title) {
        parent::__construct("Edit summary required (editing $title)",$title);
    }
}

/**
 * Edit summary too long
 * 
 * @package Pillar
 * 
 */
class PillarEditLongSummary extends PillarEditError {
    public function __construct($title) {
        parent::__construct("Edit summary must be less than 255 characters",$title);
    }
}

/**
 * User does not have the right to edit this page
 * 
 * @package Pillar
 * 
 */
class PillarEditForbidden extends PillarEditError {
    public function __construct($title) {
        parent::__construct("Permission denied (editing $title)",$title);
    }
}

/**
 * Page is protected against creation
 * 
 * @package Pillar
 * 
 */
class PillarEditNotCreate extends PillarEditError {
    public function __construct($title) {
        parent::__construct("$title is protected against creation",$title);
    }
}

/**
 * MediaWiki's spam filter was triggered
 * 
 * @package Pillar
 * 
 */
class PillarEditSpamDetected extends PillarEditError {
    public function __construct($title,$spam) {
        parent::__construct("Edit to $title refused: spam detected ($spam)",$title);
    }
}

/**
 * MediaWiki replies that the page content provided was too big
 * 
 * @package Pillar
 * 
 */
class PillarEditContentTooBig extends PillarEditError {
    public function __construct($title,$size) {
        parent::__construct("Edit to $title refused: exceeds article size limit ($size bytes)",$title);
    }
}

/**
 * MediaWiki replies that the page was deleted since the edit began
 * 
 * @package Pillar
 * 
 */
class PillarEditPageDeleted extends PillarEditError {
    public function __construct($title) {
        parent::__construct("$title has been deleted since edit began",$title);
    }
}

/**
 * No page content was provided on making the new edit
 * 
 * @package Pillar
 * 
 */
class PillarEditEmptyPage extends PillarEditError {
    public function __construct($title) {
        parent::__construct("No text provided (creating $title)",$title);
    }
}

/**
 * MediaWiki reports an edit conflict
 * 
 * @package Pillar
 * 
 */
class PillarEditConflict extends PillarEditError {
    public function __construct($title) {
        parent::__construct("Edit conflict (editing $title)",$title);
    }
}

/**
 * MediaWiki reports an assertion failed
 * 
 * @package Pillar
 * 
 */
class PillarEditAssertion extends PillarEditError {
    public function __construct($title, $assertion) {
        parent::__construct("Edit assertion failed: $assertion",$title);
    }
}

/**
 * Generic page move error
 * 
 * @package Pillar
 * 
 */
class PillarMoveError extends PillarException {
    private $title;
    
    public function __construct($message,$title = false) {
        parent::__construct($message);
        $this->title = $title;
    }
    
    public function get_title() {
        return $this->title;
    }
}

/**
 * MediaWiki reports no move token provided
 * 
 * @package Pillar
 * 
 */
class PillarMoveNoToken extends PillarMoveError {
    public function __construct($title) {
        parent::__construct("No move-token provided when attempting to move $title",$title);
    }
}

/**
 * User appears to be logged out
 * 
 * @package Pillar
 * 
 */
class PillarMoveLoggedOut extends PillarMoveError {
    public function __construct($title) {
        parent::__construct("User appears to be logged out (moving $title)",$title);
    }
}

/**
 * No move summary provided
 * 
 * @package Pillar
 * 
 */
class PillarMoveNoSummary extends PillarMoveError {
    public function __construct($title) {
        parent::__construct("Move summary required (moving $title)",$title);
    }
}

/**
 * Move summary too long
 * 
 * @package Pillar
 * 
 */
class PillarMoveLongSummary extends PillarMoveError {
    public function __construct($title) {
        parent::__construct("Move summary must be less than 255 characters",$title);
    }
}

/**
 * Generic delete error
 * 
 * @package Pillar
 * 
 */
class PillarDeleteError extends PillarException {
    private $title;
    
    public function __construct($message,$title = false) {
        parent::__construct($message);
        $this->title = $title;
    }
    
    public function get_title() {
        return $this->title;
    }
}

/**
 * MediaWiki reports no delete token provided
 * 
 * @package Pillar
 * 
 */
class PillarDeleteNoToken extends PillarDeleteError {
    public function __construct($title) {
        parent::__construct("No delete-token provided when attempting to delete $title",$title);
    }
}

/**
 * User appears to be logged out
 * 
 * @package Pillar
 * 
 */
class PillarDeleteLoggedOut extends PillarDeleteError {
    public function __construct($title) {
        parent::__construct("User appears to be logged out (deleting $title)",$title);
    }
}

/**
 * No deletion summary provided
 * 
 * @package Pillar
 * 
 */
class PillarDeleteNoSummary extends PillarDeleteError {
    public function __construct($title) {
        parent::__construct("Delete summary required (deleting $title)",$title);
    }
}

/**
 * Deletion summary too long
 * 
 * @package Pillar
 * 
 */
class PillarDeleteLongSummary extends PillarDeleteError {
    public function __construct($title) {
        parent::__construct("Delete summary must be less than 255 characters",$title);
    }
}

/**
 * User does not have the right to delete this page
 * 
 * @package Pillar
 * 
 */
class PillarDeleteForbidden extends PillarDeleteError {
    public function __construct($title) {
        parent::__construct("Permission denied (deleting $title)");
    }
}

/**
 * Bad continue parameter passed
 * 
 * @package Pillar
 * 
 */
class PillarBadContinue extends PillarException {
    public function __construct($title) {
        parent::__construct("Bad continue parameter passed when editing $title");
    }
}

/**
 * Generic block error
 * 
 * @package Pillar
 *
 */
class PillarBlockError extends PillarException {
    private $title;
    
    public function __construct($message,$title = false) {
        parent::__construct($message);
        $this->title = $title;
    }
    
    public function get_title() {
        return $this->title;
    }
}

/**
 * Block reason too long
 * 
 * @package Pillar
 * 
 */
class PillarBlockLongReason extends PillarException {
    public function __construct($user) {
        parent::__construct("Block reason too long when blocking $user");
    }
}

/**
 * Action cancelled
 * 
 * @package Pillar
 */
class PillarActionCancelled extends PillarException {
    public function __construct($action) {
        parent::__construct("Action ($action) cancelled");
    }
}

/**
 * Generic protection error
 * 
 * @package Pillar
 */
class PillarProtectError extends PillarException {
private $title;
    
    public function __construct($message,$title = false) {
        parent::__construct($message);
        $this->title = $title;
    }
    
    public function get_title() {
        return $this->title;
    }
}

/**
 * Protection reason too long
 * 
 * @package Pillar
 * 
 */
class PillarProtectLongSummary extends PillarProtectError {
    public function __construct($title) {
        parent::__construct("Protection summary too long (protecting $title)");
    }
}

/**
 * Protection reason not given
 * 
 * @package Pillar
 * 
 */
class PillarProtectNoSummary extends PillarProtectError {
    public function __construct($title) {
        parent::__construct("No protection summary given (protecting $title)");
    }
}

/**
 * No protection settings given
 * 
 * This is applied if $settings['admin'] and $settings['edit'] are both absent.
 * 
 * @package Pillar
 * 
 */
class PillarProtectNoSettings extends PillarProtectError {
    public function __construct($title) {
        parent::__construct("No protection settings provided (protecting $title)");
    }
}

/**
 * Invalid protection settings given
 *
 * @package Pillar
 */
class PillarProtectInvalidSettings extends PillarProtectError {
    public function __construct($title) {
        parent::__construct("Invalid protection settings provided (protecting $title)");
    }
}

/**
 * Generic email error
 * 
 * @package Pillar
 */
class PillarEmailError extends PillarException {
    private $target;
    
    public function __construct($message,$target = false) {
        parent::__construct($message);
        $this->target = $target;
    }
    
    public function get_title() {
        return $this->target;
    }
}

/**
 * Email summary too long
 * 
 * @package Pillar
 * 
 */
class PillarEmailLongSubject extends PillarEmailError {
    public function __construct($user,$target) {
        parent::__construct("Email summary too long when emailing $user",$user);
    }
}

/**
 * No user email set -- can't email
 * 
 * @package Pillar
 * 
 */
class PillarNoEmail extends PillarEmailError {
    public function __construct($user) {
        parent::__construct("You do not have an email address set (attempting to email $user)",$user);
    }
}

/**
 * Diff error
 *
 * @package Pillar
 *
 */
class PillarBadDiff extends PillarException {
    public function __construct($title,$id) {
        parent::__construct("Diff error when retrieving revision $id on $title");
    }
}
 
/**
 * Invalid username
 * 
 * @package Pillar
 * 
 */
class PillarBadUsername extends PillarException {
    public function __construct($username) {
        parent::__construct("Bad username ('$username')");
    }
}

/**
 * User does not exist
 * 
 * @package Pillar
 * 
 */
class PillarUserMissing extends PillarException {
    public function __construct($username) {
        parent::__construct("User $username does not exist");
    }
}

require('class.site.php');
require('class.mwsite.php');
require('class.request.php');
require('class.page.php');
require('class.mwrequest.php');
include('class.user.php');
