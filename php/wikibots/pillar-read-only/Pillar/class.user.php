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
 * User-specific functions
 * 
 * Note that anonymous (IP) users are <b>not</b> users in the MediaWiki sense.  It is not
 * possible to create a User object on them, although {@link User::blockip()} will work 
 * staticly.
 * 
 * Creating a new object gives basic information about a user:
 *  - username
 *  - editcount
 *  - block status
 *  - groups
 *  - registration time
 *  - whether user can receive wiki-email
 * 
 * It is also possible to retrieve (with additional API requests):
 *  - user contributions
 * 
 * The user can also be affected in the following ways:
 *  - block
 *  - email
 * 
 * @package Pillar
 * 
 * @todo unblock anonymous users
 */
class User {
    /**
     * Username
     * 
     * @var string
     */
    private $username;
    /**
     * Edit count
     * 
     * @var integer
     */
    private $editcount;
    /**
     * Block status
     * 
     * If blocked, array with keys 'blockedby', 'blockreason' and 'blockexpiry'. If not blocked, false.
     * 
     * Expect strange results for "blockexpiry" if your computer's clock is wrong!
     * 
     * @var mixed
     */
    private $blockstatus;
    /**
     * User groups
     * 
     * Array of user groups.  If the user is in no groups, the array will be empty.
     * 
     * @var array
     */
    private $groups;
    /**
     * Timestamp of user registration
     * 
     * A MediaWiki timestamp of the user's registration. If the user was created before this timestamp was introduced, 
     * the date of the first edit is present.
     * 
     * @var string
     */
    private $registration;
    /**
     * Whether user is emailable
     * 
     * If the user can receieve email through [[Special:Emailuser]], this is true, otherwise false.
     * 
     * @var boolean
     */
    private $emailable;
    /**
     * Whether user is an IP address
     * 
     * If the user is an ip address, return true, otherwise false.
     * 
     * @var boolean
     */
    private $is_ip;
    /**
     * Site
     * 
     * Reference to the MWSite that this user exists on.
     * 
     * @var MWSite
     */
    private $site;
    
    public function __construct($site,$username) {
        if ($username == '') {
            throw new PillarBadUsername($username);
        }
        
        $vars = array('action'=>'query','list'=>'users|logevents','letype'=>'block','letitle'=>"User:$username",'ususers'=>$username,'usprop'=>'blockinfo|groups|editcount|registration|emailable','lelimit'=>'1');
        // get user information and also the latest block event in the log
        
        $request = new MWRequest($site,$vars);
        
        $result = $request->get_result();
        
        if (!is_array($result)) {
            throw new PillarBadResult($request->get_result());
        }
        
        if (is_string($result['query']['users'][0]['missing'])) {
            throw new PillarUserMissing($username);
        }
        
        $this->username = $result['query']['users'][0]['name'];
        
        if (preg_match('/((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)/', $username)) { //Eww......
            $this->is_ip = true;
            if (is_string($result['query']['logevents'][0]['block']['expiry']) && strtotime($result['query']['logevents'][0]['block']['expiry']) > time()) {
            // above line: if there is a block event in the log AND the expiry of that event is in the future
                $this->blockstatus = array('blockedby'=>$result['query']['logevents'][0]['user'],'blockreason'=>$result['query']['logevents'][0]['comment'],'blockuntil'=>strtotime($result['query']['logevents'][0]['block']['expiry']));
            } else {
                $this->blockstatus = false;
            }
            $this->groups = array();
            $this->registration = false;
            $this->emailable = false;
            $this->editcount = false;
        }
        else {
            $this->is_ip = false;
            $this->editcount = $result['query']['users'][0]['editcount'];
            if (is_string($result['query']['users'][0]['blockedby'])) {
                $this->blockstatus = array('blockedby'=>$result['query']['users'][0]['blockedby'],'blockreason'=>$result['query']['users'][0]['blockreason'],'blockuntil'=>strtotime($result['query']['logevents'][0]['block']['expiry']));
                //above line: better to rely upon MW's reporting of block status where possible than to work from the log as we have to do for IPs
            } else {
                $this->blockstatus = false;
            }
            if ($result['query']['users'][0]['groups']) {
                $this->groups = $result['query']['users'][0]['groups'];
            } else {
                $this->groups = array();
            }
            $this->registration = $result['query']['users'][0]['registration'];
            $this->emailable = is_string($result['query']['users'][0]['emailable']); //boolean true/false
        }
        
        $this->site =& $site;
    }
    
    /**
     * Block function
     *
     * Calls a different function depending on if it is a user or ip
     *
     */
    public function block($expiry,$reason) {
    	if( $this->is_ip ) {
    		$this->blockip($expiry,$reason);
    	}
    	else {
    		$this->blockuser($expiry,$reason);
    	}
    }
    
    /**
     * Block user
     * 
     * Block a username from editing.  Use {@link blockip()} for anonymous users.
     * 
     * $expiry can be any expiry that would work through [[Special:Blockip]], e.g. "24 hours", "1 week",
     * "infinite".
     * 
     * $reason must be less than 255 characters, per MediaWiki requirement.
     * 
     * $nocreate sets whether the user can create more accounts.  Setting this to false allows account 
     * creation.  Default true.
     * 
     * $autoblock sets whether the autoblock is enabled.  Setting this to false disables autoblocks. 
     * Default true.
     * 
     * $noemail sets whether the user is permitted to send emails.  Setting this to true disables emails.
     * Default false.
     * 
     * $edittalk sets whether the user is permitted to edit their talk page.  Setting this to false disables
     * talkpage editing.
     * 
     * $reblock sets whether existing block settings should be overridden. Setting this to true overrides 
     * existing blocks.  Default false.
     * 
     * @param string $user Username
     * @param string $expiry Expiry time
     * @param string $reason Reason for block
     * @param boolean $nocreate Account creation blocked (default true)
     * @param boolean $autoblock Autoblock enabled (default true)
     * @param boolean $noemail Special:Emailuser disabled (default false)
     * @param boolean $edittalk Allow editing talk page (default true)
     * @param boolean $reblock Override existing blocks (default false)
     */
    private function blockuser($expiry,$reason,$nocreate=true,$autoblock=true,$noemail=false,$edittalk=true,$reblock=false) {
        if ($this->site->get_confirmaction()) {
            if (!Pillar::confirmaction("block of " . $this->username)) {
                throw new PillarActionCancelled("block of " . $this->username);
            }
        }
        
        if (strlen($reason) > 255) {
            throw new PillarBlockLongReason($this->username);
        }
        
        $vars = array('action'=>'query','prop'=>'info','intoken'=>'block','titles'=>$this->username);
        
        $request = new MWRequest($this->site,$vars);
        $result = $request->get_result();
        
        if (!is_array($result)) {
            throw new PillarBadResult($result);
        }
        
        $page = array_shift($result['query']['pages']);
        $token = $page['blocktoken'];
        
        $vars = array('action'=>'block','user'=>$this->username,'expiry'=>$expiry,'reason'=>$reason,'token'=>$token);
        
        if ($nocreate) {
            $vars['nocreate'] = '';
        }
        
        if ($autoblock) {
            $vars['autoblock'] = '';
        }
        
        if ($noemail) {
            $vars['noemail'] = '';
        }
        
        if ($edittalk) {
            $vars['allowusertalk'] = '';
        }
        
        if ($reblock) {
            $vars['reblock'] = '';
        }
        
        $request = new MWRequest($this->site,$vars,true);
        $result = $request->get_result();
        
        if (!is_array($result)) {
            throw new PillarBadResult($result);
        }
        
        if (!is_array($result['block'])) {
            throw new PillarBlockError($result['info'],$this->username);
        }
        
        $this->__construct($this->site,$this->username); //rebuild user instance with new block settings
        
        return;
    }
    
    /**
     * Block IP
     * 
     * Block an IP from editing.
     * 
     * $expiry can be any expiry that would work through [[Special:Blockip]], e.g. "24 hours", "1 week",
     * "infinite".
     * 
     * $reason must be less than 255 characters, per MediaWiki requirement.
     * 
     * $anononly sets the "anonymous users only" function in the block.  Setting this to false allows 
     * non-blocked usernames to edit through the IP block.
     * 
     * $nocreate sets whether the user can create accounts.  Setting this to false allows account 
     * creation.  Default true.
     * 
     * $edittalk sets whether the user is permitted to edit their talk page.  Setting this to false disables
     * talkpage editing.
     * 
     * $reblock sets whether existing block settings should be overridden. Setting this to true overrides 
     * existing blocks.  Default false.
     * 
     * @param string $ip IP address/range to block
     * @param string $expiry Block expiry
     * @param string $reason Reason for block
     * @param boolean $anononly Anonymous users only (default true)
     * @param boolean $nocreate Account creation disabled (default true)
     * @param boolean $edittalk Allow talk page editing (default true)
     * @param boolean $reblock Over-ride existing block settings (default false)
     */
    private function blockip($expiry,$reason,$anononly=true,$nocreate=true,$edittalk=true,$reblock=false) {
        if ($this->site->get_confirmaction()) {
            if (!Pillar::confirmaction("block of {$this->username}")) {
                throw new PillarActionCancelled("block of {$this->username}");
            }
        }
        
        if ($this->username == '') {
            throw new PillarBadTitle($ip);
        }
        
        if (strlen($reason) > 255) {
            throw new PillarBlockLongReason($this->username);
        }
        
        $vars = array('action'=>'query','prop'=>'info','intoken'=>'block','titles'=>$this->username);
        
        $request = new MWRequest($this->site,$vars);
        $result = $request->get_result();
        
        if (!is_array($result)) {
            throw new PillarBadResult($result);
        }
        
        $page = array_shift($result['query']['pages']);
        $token = $page['blocktoken'];
        
        $vars = array('action'=>'block','user'=>$this->username,'expiry'=>$expiry,'reason'=>$reason,'token'=>$token);
        
        if ($anononly) {
            $vars['anononly'] = '';
        }
        
        if ($nocreate) {
            $vars['nocreate'] = '';
        }
        
        if ($edittalk) {
            $vars['allowusertalk'] = '';
        }
        
        if ($reblock) {
            $vars['reblock'] = '';
        }
        
        $request = new MWRequest($this->site,$vars,true);
        $result = $request->get_result();
        
        if (!is_array($result)) {
            throw new PillarBadResult($result);
        }
        
        if (!is_array($result['block'])) {
            throw new PillarBlockError("Block of {$this->username} failed (error code: '{$result['info']}')",$this->username);
        }
        
        return;
    }
    
    /**
     * Unblock user
     * 
     * Unblock the user for reason $reason.
     * 
     * Will not unblock anonymous users, as a User class cannot be created for them.
     * 
     * $reason must be less than 255 characters, per MediaWiki requirement.
     * 
     * @param string $reason Reason for unblock
     */
    public function unblock($reason) {
        if ($this->blockstatus == false) {
            throw new PillarNotBlocked($this->username);
        }
        
        if ($this->site->get_confirmaction()) {
            if (!Pillar::confirmaction("unblock of {$this->username}")) {
                throw new PillarActionCancelled("unblock of {$this->username}");
            }
        }
        
        if (strlen($reason) > 255) {
            throw new PillarUnblockLongReason($this->username);
        }
        
        $vars = array('action'=>'unblock','user'=>$this->username,'gettoken'=>'');
        
        $request = new MWRequest($this->site,$vars,true);
        $result = $request->get_result();
        
        if (!is_array($result)) {
            throw new PillarBadResult($result);
        }
        
        $token = $result['unblock']['unblocktoken'];
        
        $vars = array('action'=>'unblock','user'=>$this->username,'reason'=>$reason,'token'=>$token);
        
        $request = new MWRequest($this->site,$vars,true);
        
        $result = $request->get_result();
        
        if (!is_array($result)) {
            throw new PillarBadResult($result);
        }
        
        if (!is_array($result['unblock'])) {
            throw new PillarBlockError("Unblock of {$this->username} failed (error code: '{$result['info']}')",$ip);
        }
        
        return;
    }
    
    /**
     * Email
     * 
     * Sends an email to a user.
     * 
     * $target is a user to send to, without the User: prefix.
     * 
     * $subject is the subject of the email, limited to 200 characters.
     * 
     * $text is the body of the email.
     * 
     * $ccme sets whether or not to cc the sender. Default false.
     * 
     * @param string $subject Subject of the email
     * @param string $text Text of the email
     * @param boolean $ccme CC a copy of the email (default false)
     */
    public function email($subject,$text,$ccme=false) {
        if (!$this->emailable) {
            throw new PillarNotEmailable($this->username);
        }
        
        if ($this->confirmaction) {
            if (!Pillar::confirmaction("email to " . $this->username)) {
                throw new PillarActionCancelled("email to " . $this->username);
            }
        }
        
        if (strlen($reason) > 200) {
            throw new PillarEmailLongSubject($this->username);
        }
        
        $vars = array('action'=>'query','prop'=>'info','intoken'=>'email','titles'=>'User:' . $this->username);
        
        $request = new MWRequest($this->site,$vars);
        $result = $request->get_result();
        
        if (!is_array($result)) {
            throw new PillarBadResult($result);
        }
        
        $page = array_shift($result['query']['pages']);
        $token = $page['emailtoken'];
        
        $vars = array('action'=>'emailuser','target'=>$this->username,'subject'=>$subject,'text'=>$text,'token'=>$token);
        
        if ($ccme) {
                $vars['ccme'] = "";
        }
        
        $request = new MWRequest($this->site,$vars,true);
        $result = $request->get_result();
        
        if (!is_array($result)) {
            throw new PillarBadResult($result);
        }
        
        if (!is_array($result['emailuser'])) {
            if ($result['error']['code'] == 'cantsend') {
                throw new PillarNoEmail($this->username);
            } else {
                throw new PillarEmailError($result['info'],$this->username);
            }
        }
        
        return;
    }
    
    /**
     * Get username
     * 
     * Return the user's username
     * 
     * @return string
     */
    public function get_username() {
        return $this->username;
    }
    
    /**
     * Get editcount
     * 
     * Return the user's editcount
     * 
     * @return integer
     */
    public function get_editcount() {
        return $this->editcount;
    }
    
    /**
     * Get block status
     * 
     * If the user is blocked, return an array with keys 'blockedby', 'blockreason' and 'blockexpiry'. If not blocked, return
     * false.
     * 
     * Expect strange results if your computer's clock is wrong!
     * 
     * @return integer
     */
    public function get_blockstatus() {
        return $this->blockstatus;
    }
    
    /**
     * Get user groups
     * 
     * Return an array of user groups.  If the user is in no groups, the array will be empty.
     * 
     * @var array
     */
    public function get_groups() {
        return $this->groups;
    }
    
    /**
     * Get user registration
     * 
     * Return a MediaWiki timestamp of the user's registration. If the user was created before this timestamp was introduced, 
     * the date of the first edit is returned instead.
     * 
     * If the user is an IP, this will return false.
     * 
     * @var string
     */
    public function get_registration() {
        return $this->registration;
    }
    
    /**
     * Get emailable
     * 
     * If the user can receieve email through [[Special:Emailuser]] or {@link email()}, return true, otherwise return false.
     * 
     * @var boolean
     */
    public function get_emailable() {
        return $this->emailable;
    }
    
    /**
     * Check if a user is an email address
     *
     * @var boolean
     */
    public function is_ip() {
    	return $this->is_ip;
    }
    
    /**
     * User contributions
     * 
     * Get a list of user contributions.
     *
     * $count may not be more than 500; values more than 500 will be reduced to 500.
     * 
     * Do not rely upon this function returning the number of pages in $count -- always use count().
     * 
     * The expected use of this function is
     * 
     * <pre> do {
     *     $pages = $user->get_usercontribs(10,$continue);
     * } while ($continue != null)</pre>
     * 
     * @param int $count Maximum number of page titles to retrieve
     * @param string &$continue Reference to continue parameter
     * @param string $dir Direction to go, default older
     * @return array
     */
    public function get_usercontribs($count = 500,&$continue = null,$dir = 'older') {
        
        $count = (int) $count;
        
        if ($count > 500) {
            $count = 500;
        }
        
        $vars = array ('action'=>'query','list'=>'usercontribs','ucuser'=>$this->username,'uclimit'=>$count, 'ucdir'=>$dir);
        
        if ($continue) {
            $vars['uccontinue'] = $continue;
        }
        
        $request = new MWRequest($this,$vars);
        $result = $request->get_result();
        
        if (!is_array($result)) {
            throw new PillarBadResult($result);
        }
        
        if ((is_array($result['error']) && ($result['error']['code'] == 'uc_badcontinue'))) {
            throw new PillarBadContinue($this->username);
        }
        
        if ($result['query-continue']) {
            $continue = $result['query-continue']['usercontribs']['uccontinue'];
        } else {
            $continue = null;
        }
        
        if (is_array($result['query']['usercontribs'])) {
            $return = $result['query']['usercontribs'];
        } else {
            $return = array();
        }
        return $return;
    }
}