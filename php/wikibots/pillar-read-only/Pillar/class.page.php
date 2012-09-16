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
 * Page-specific MediaWiki functions
 * 
 * Creating a new object ({@link __construct()}) gets the basic information for a page.
 * 
 * The following functions giving information about the current page are available on 
 * object construction and require no additional API calls (no throttling necessary):
 * 
 * - {@link get_title()}
 * - {@link get_text()}
 * - {@link get_editprotection()}
 * - {@link get_edittime()}
 * - {@link get_moveprotection()}
 * 
 * The following functions are also available, but require additional API calls.  They 
 * also have a more complicated syntax as they retrieve (sometimes lengthy) lists of
 * information.
 * 
 * - {@link get_categories()}
 * - {@link get_extlinks()}
 * - {@link get_images()}
 * - {@link get_langlinks()}
 * - {@link get_links()}
 * - {@link get_templates()}
 * 
 * The following functions make changes to the page and are always available:
 * 
 * - {@link delete()}
 * - {@link move()}
 * - {@link protect()}
 * - {@link put()}
 * - {@link show_changes()}
 * 
 * @package Pillar
 * @todo Deal with users who don't have diff, colordiff or wikidiff2 installed (Firing-squad?) Currently fails gracefully, so non-urgent.
 *
 */
class Page {
    /**
     * Page title
     *
     * @var string
     */
    private $title;
    /**
     * Page text
     *
     * @var string
     */
    private $text;
    /**
      * Edit-protection status
      * 
      * Format:
      * 
      * <pre> array ('level'=>'sysop','expiry'='infinity')</pre>
      *
      * @var array
      */
    private $editprotection;
    /**
      * Move-protection status
      * 
      * Format:
      * 
      * <pre> array ('level'=>'sysop','expiry'='infinity')</pre>
      *
      * @var array
      */
    private $moveprotection;
    /**
      * Edit-token for current request
      *
      * @var string
      */
    private $edittoken;
    /**
      * Move-token for current request
      *
      * @var string
      */
    private $movetoken;
    /**
      * Delete-token for current request
      *
      * @var string
      */
    private $deletetoken;
    /**
      * Protect-token for current request
      *
      * @var string
      */
    private $protecttoken;
    /**
      * MediaWiki timestamp for last revision to page
      *
      * @var string
      */
    private $lastedit;
    /**
      * MediaWiki timestamp for when the request was made
      *
      * @var string
      */
    private $starttime;
    /**
      * Reference of site used to create
      *
      * @var MWSite
      */
    private $site;
    /**
      * Whether page exists
      *
      * @var boolean
      */
    private $exists;

    /**
     * Make a new Page instance
     * 
     * Create a new Page instance.
     *
     * @param MWSite $site MWSite instance on which to build page
     * @param string $title Title of the page
     * @param boolean $followredirect Set this to true to automatically follow redirects (default false)
     */
    public function __construct($site,$title,$followredirect = false) {
        if ($title == '') {
            throw new PillarBadTitle($title);
        }
        
        $vars = array('action'=>'query','prop'=>'info|revisions','rvprop'=>'content|timestamp','intoken'=>'edit|move|delete|protect','inprop'=>'protection','titles'=>$title);
        
        if ($followredirect) {
            $vars['redirects'] = '';
        }
        
        $request = new MWRequest($site,$vars);
        
        $result = $request->get_result();
        
        if (!is_array($result)) {
            throw new PillarBadResult($request->get_result());
        }
        
        $result = array_shift(array_values($result['query']['pages']));
        
        $this->exists = ('' === $result['missing']) ? false : true;
        
        $this->text = ('' === $result['missing']) ? false : $result['revisions']['0']['*'];
        $this->lastedit = ('' === $result['missing']) ? false : $result['revisions']['0']['timestamp'];
        $this->starttime = $result['starttimestamp'];
        $this->title = $result['title'];
        
        $this->edittoken = $result['edittoken'];
        $this->movetoken = $result['movetoken'];
        $this->protecttoken = $result['protecttoken'];
        $this->deletetoken = $result['deletetoken'];
        
        if ($result['protection']) {
            $this->editprotection = $this->moveprotection = array ('level'=>'','expiry'=>'');
            foreach ($result['protection'] as $pr) {
                if ($pr['type'] == 'move') {
                    if ($this->moveprotection['level'] != 'sysop') {
                        $this->moveprotection['level'] = $pr['level'];
                        $this->moveprotection['expiry'] = $pr['expiry'];
                    }
                } elseif ($pr['type'] == 'edit') {
                    if ($this->editprotection['level'] != 'sysop') {
                        $this->editprotection['level'] = $pr['level'];
                        $this->editprotection['expiry'] = $pr['expiry'];
                    }
                }
            }
        } else {
            $this->editprotection = $this->moveprotection = array ('level'=>'','expiry'=>'');
        }
        
        $this->site =& $site;
                
        return;
    }
    
    /**
     * Edit page
     * 
     * Applies edit to current Page instance: the current page will be replaced by $text.
     * 
     * $summary must be less than 255 characters to fill MediaWiki requirements.
     * 
     * After the edit is made, the Page object is refreshed with the new settings.
     * 
     * If confirmation of actions (see {@link MWSite::set_confirmaction()}) is enabled, a preview of the edit
     * will be shown (in console or browser, as set by {@link Pillar::set_browser()}).
     *
     * @param string $text New text for page
     * @param string $summary Edit-summary
     * @param boolean $minor Mark true for minor edit
     * @param boolean $rebuild Rebuild Page object after edit (default true)
     */
    public function put($text,$summary,$minor,$rebuild=true) {
        if ($this->site->get_confirmaction()) {
            $pillar = Pillar::get_instance();
            $this->show_changes($text,$pillar->get_browser());
            if (!Pillar::confirmaction("edit to {$this->title}")) {
                throw new PillarActionCancelled("edit to {$this->title}");
            }
        }
        
        if ($this->edittoken == '') {
            throw new PillarEditForbidden($this->title);
        }
        
        if ($summary == '') {
            throw new PillarEditNoSummary($this->title);
        }
        
        if (strlen($summary) > 255) {
            throw new PillarEditLongSummary($this->title);
        }
        
        $vars = array ('action'=>'edit', 'title'=>$this->title, 'text'=>$text, 'token'=>$this->edittoken, 'summary'=>$summary, 'starttimestamp'=>$this->starttime, 'basetimestamp'=>$this->edittime, 'md5'=>md5($text));
        
        if ($minor) {
            $vars['minor'] = '1';
        } else {
            $vars['notminor'] = '1';
        }
        
        if ($this->site->get_bot() == true) {
            $vars['bot'] = '1';
        }
        
        $request = new MWRequest($this->site,$vars,true);
        $result = $request->get_result();
        
        if (is_array($result['edit'])) {
            if ($result['edit']['result'] == 'Success') {
                if ($rebuild) {
                    $this->__construct($this->site,$this->title);
                }
                return;
            }
            if (isset($result['edit']['spamblacklist'])) {
                throw new PillarEditSpamDetected($this->title,$result['edit']['spamblacklist']);
            }
            if (isset($result['edit']['assert'])) {
                throw new PillarEditAssertion($this->title,"assert=".$result['edit']['assert']);
            }
            if (isset($result['edit']['nassert'])) {
                throw new PillarEditAssertion($this->title,"nassert=".$result['edit']['nassert']);
            }
            throw new PillarEditError('Undetermined error: ' . print_r($result['edit'],1),$this->title);
        } else {
            switch ($result['error']['code']) {
                case 'notoken':
                    throw new PillarEditNoToken($this->title);
                case 'protectedtitle':
                    throw new PillarEditNotCreate($this->title);
                case 'spamdetected':
                    preg_match ('/Your edit was refused because it contained a spam fragment: (.*)/i',$result['error']['info'],$match);
                    throw new PillarEditSpamDetected($this->title,$match[1]);
                case 'contenttoobig':
                    preg_match ('/The content you supplied exceeds the article size limit of (\d*) bytes/',$result['error']['info'],$match);
                    throw new PillarEditContentTooBig($this->title,$match[1]);
                case 'pagedeleted':
                    throw new PillarEditPageDeleted($this->title);
                case 'emptypage':
                    throw new PillarEditEmptyPage($this->title);
                case 'editconflict':
                    throw new PillarEditConflict($this->title);
                default:
                    throw new PillarEditError('Undetermined error: ' . print_r($result,1),$this->title);
            }
        }
    }
    
    /**
     * Get current page text
     * 
     * Return page's wikitext.
     *
     * @return string
     */
    public function get_text() {
        return $this->text;
    }
    
    /**
     * Get current page title
     * 
     * Return page's title.
     *
     * @return string
     */
    public function get_title() {
        return $this->title;
    }
    
    /**
     * Get move protection
     * 
     * Return an array specifying current page move-protection status.
     * 
     * Result in format:
     * 
     * <pre> array('level'=>'sysop', 'expiry'=>'infinite')</pre>
     * 
     * If the page is not edit-protected, the format will be:
     * 
     * <pre> array('level'=>'', 'expiry'=>'')</pre>
     *
     * @return array
     */
    public function get_moveprotection() {
        return $this->moveprotection;
    }
    
    /**
     * Get edit protection
     * 
     * Return an array specifying current page edit-protection status.
     * 
     * Result in format:
     * 
     * <pre> array('level'=>'sysop', 'expiry'=>'infinite')</pre>
     * 
     * If the page is not edit-protected, the format will be:
     * 
     * <pre> array('level'=>'', 'expiry'=>'')</pre>
     *
     * @return array
     */
    public function get_editprotection() {
        return $this->editprotection;
    }
    
    /**
     * Get MediaWiki timestamp of last revision
     * 
     * Return the timestamp of the most recent revision.
     *
     * @return string
     */
    public function get_edittime() {
        return $this->edittime;
    }
    
    /**
     * Get whether page exists
     * 
     * Return boolean true or false depending on whether the page currently exists
     *
     * @return boolean
     */
    public function get_exists() {
        return $this->exists;
    }
    
    /**
     * Get categories in this page
     * 
     * $count may not be more than 500; values more than 500 will be reduced to 500.
     * 
     * Do not rely upon this function returning the number of pages in $count -- always use count()
     * 
     * The expected use of this function is
     * 
     * <pre> do {
     *     $categories = $page->get_categories(10,$continue,0);
     * } while ($continue != null)</pre>
     *
     * @param int $count Maximum number of category titles to retrieve
     * @param int &$continue Reference to continue parameter
     * @param int $namespace Namespace to restrict edit to (0 is article space, 1 is artice discussion etc.)
     * @return array
     */
    public function get_categories($count = 100,&$continue = null,$namespace = false) {
        if ($count > 500) {
            $count = 500;
        }
        
        $count = (int) $count;
        
        if ($this->exists) {
            $vars = array('action'=>'query', 'prop'=>'categories', 'cllimit'=>"$count", 'titles'=>$this->title);
            if ($namespace) {
                $vars['namespace'] = (int) $namespace;
            }
            if ($continue) {
                $vars['clcontinue'] = $continue;
            }
            
            $request = new MWRequest($this->site,$vars);
            $result = $request->get_result();
            
            if (!is_array($result) || !is_array($result['query']['pages'])) {
                throw new PillarBadResult($request->get_result());
            }
            $page = array_pop($result['query']['pages']);
            
            $return = array();
            
            if (is_array($page['categories'])) {
                foreach($page['categories'] as $cat) {
                    $return[] = $cat['title'];
                }
            } else {
                $return = array();
            }
            return $return;
        } else {
            return array();
        }
    }
    
    /**
     * Get pages included in this page
     * 
     * $count may not be more than 500; values more than 500 will be reduced to 500.
     * 
     * Do not rely upon this function returning the number of pages in $count -- always use count()
     * 
     * The expected use of this function is
     * 
     * <pre> do {
     *     $templates = $page->get_templates(10,$continue,0);
     * } while ($continue != null)</pre>
     *
     * @param int $count Maximum number of templates to retrieve
     * @param int &$continue Reference to continue parameter
     * @return array
     */
    public function get_templates($count = 100,&$continue = null) {
        if ($count > 500) {
            $count = 500;
        }
        
        $count = (int) $count;
        
        if ($this->exists) {
            $vars = array('action'=>'query', 'prop'=>'templates', 'tllimit'=>"$count", 'titles'=>$this->title);
            if ($namespace) {
                $vars['namespace'] = (int) $namespace;
            }
            if ($continue) {
                $vars['tlcontinue'] = $continue;
            }
            
            $request = new MWRequest($this->site,$vars);
            $result = $request->get_result();
            
            if (!is_array($result) || !is_array($result['query']['pages'])) {
                throw new PillarBadResult($request->get_result());
            }
            $page = array_pop($result['query']['pages']);
            
            $return = array();
            
            if (is_array($page['templates'])) {
                foreach($page['templates'] as $template) {
                    $return[] = $template['title'];
                }
            } else {
                $return = array();
            }
            
            return $return;
        } else {
            return array();
        }
    }
    
    /**
     * Get interwiki language links for page
     * 
     * $count may not be more than 500; values more than 500 will be reduced to 500.
     * 
     * Do not rely upon this function returning the number of pages in $count -- always use count()
     * 
     * The expected use of this function is
     * 
     * <pre> do {
     *     $langlinks = $page->get_langlinks(10,$continue,0);
     * } while ($continue != null)</pre>
     *
     * @param int $count Maximum number of language links to retrieve
     * @param int &$continue Reference to continue parameter
     * @return array
     */
    public function get_langlinks($count = 100,&$continue = null) {
        if ($count > 500) {
            $count = 500;
        }
        $count = (int) $count;
        
        if ($this->exists) {
            $vars = array('action'=>'query', 'prop'=>'langlinks', 'lllimit'=>"$count", 'titles'=>$this->title);
            if ($namespace) {
                $vars['namespace'] = (int) $namespace;
            }
            if ($continue) {
                $vars['llcontinue'] = $continue;
            }
            
            $request = new MWRequest($this->site,$vars);
            $result = $request->get_result();
            
            if (!is_array($result) || !is_array($result['query']['pages'])) {
                throw new PillarBadResult($request->get_result());
            }
            $page = array_pop($result['query']['pages']);
            
            $return = array();
            
            if (is_array($page['langlinks'])) {
                foreach ($page['langlinks'] as $link) {
                    $return[] = array('lang'=>$link['lang'],'title'=>$link['*']);
                }
            } else {
                $return = array();
            }
            
            return $return;
        } else {
            return array();
        }
    }
    
    /**
     * Get links in this page
     * 
     * $count may not be more than 500; values more than 500 will be reduced to 500.
     * 
     * Do not rely upon this function returning the number of pages in $count -- always use count()
     * 
     * The expected use of this function is
     * 
     * <pre> do {
     *     $links = $page->get_links(10,$continue,0);
     * } while ($continue != null)</pre>
     *
     * @param int $count Maximum number of links to retrieve
     * @param int &$continue Reference to continue parameter
     * @return array
     */
    public function get_links($count = 100,&$continue = null) {
        if ($count > 500) {
            $count = 500;
        }
        $count = (int) $count;
        
        if ($this->exists) {
            $vars = array('action'=>'query', 'prop'=>'links', 'pllimit'=>"$count", 'titles'=>$this->title);
            if ($namespace) {
                $vars['namespace'] = (int) $namespace;
            }
            if ($continue) {
                $vars['plcontinue'] = $continue;
            }
            
            $request = new MWRequest($this->site,$vars);
            $result = $request->get_result();
            
            if (!is_array($result) || !is_array($result['query']['pages'])) {
                throw new PillarBadResult($request->get_result());
            }
            $page = array_pop($result['query']['pages']);
            
            $return = array();
            
            if (is_array($page['links'])) {
                foreach ($page['links'] as $link) {
                    $return[] = $link['title'];
                }
            } else {
                $return = array();
            }
            
            return $return;
        } else {
            return array();
        }
    }
    
    /**
     * Get images in page
     * 
     * $count may not be more than 500; values more than 500 will be reduced to 500.
     * 
     * Do not rely upon this function returning the number of pages in $count -- always use count()
     * 
     * The expected use of this function is
     * 
     * <pre> do {
     *     $images = $page->get_images(10,$continue,0);
     * } while ($continue != null)</pre>
     *
     * @param int $count Maximum number of image titles to retrieve
     * @param int &$continue Reference to continue parameter
     * @return array
     */
    public function get_images($count = 100,&$continue = null) {
        if ($count > 500) {
            $count = 500;
        }
        $count = (int) $count;
        
        if ($this->exists) {
            $vars = array('action'=>'query', 'prop'=>'images', 'illimit'=>"$count", 'titles'=>$this->title);
            if ($namespace) {
                $vars['namespace'] = (int) $namespace;
            }
            if ($continue) {
                $vars['ilcontinue'] = $continue;
            }
            
            $request = new MWRequest($this->site,$vars);
            $result = $request->get_result();
            
            if (!is_array($result) || !is_array($result['query']['pages'])) {
                throw new PillarBadResult($request->get_result());
            }
            $page = array_pop($result['query']['pages']);
            
            $return = array();
            
            if (is_array($page['images'])) {
                foreach ($page['images'] as $image) {
                    $return['images'][] = $image['title'];
                }
            } else {
                $return = array();
            }
            
            return $return;
        } else {
            return array();
        }
    }
    
    /**
     * Get external links in page
     * 
     * $count may not be more than 500; values more than 500 will be reduced to 500.
     * 
     * Do not rely upon this function returning the number of pages in $count -- always use count()
     * 
     * The expected use of this function is
     * 
     * <pre> do {
     *     $extlinks = $page->get_extlinks(10,$continue,0);
     * } while ($continue != null)</pre>
     *
     * @param int $count Maximum number of external links to retrieve
     * @param int &$continue Reference to continue parameter
     * @return array
     */
    public function get_extlinks($count = 100,&$continue = null) {
        if ($count > 500) {
            $count = 500;
        }
        $count = (int) $count;
        
        if ($this->exists) {
            $vars = array('action'=>'query', 'prop'=>'extlinks', 'ellimit'=>"$count", 'titles'=>$this->title);
            if ($namespace) {
                $vars['namespace'] = (int) $namespace;
            }
            if ($continue) {
                $vars['elcontinue'] = $continue;
            }
            
            $request = new MWRequest($this->site,$vars);
            $result = $request->get_result();
            
            if (!is_array($result) || !is_array($result['query']['pages'])) {
                throw new PillarBadResult($request->get_result());
            }
            $page = array_pop($result['query']['pages']);
            
            $return = array();
            
            if (is_array($page['extlinks'])) {
                foreach ($page['extlinks'] as $link) {
                    $return['extlinks'][] = $link['*'];
                }
            } else {
                $return = array();
            }
            return $return;
        } else {
            return array();
        }
    }
    
    /**
     * Show changes
     * 
     * Show changes between current page text and $new
     * 
     * For preview functions, the following logic is used:
     *  - If a browser command is specified, use that
     *  - Otherwise, if colordiff is installed, use that
     *  - Otherwise, if diff is installed, use that
     *  - Otherwise, use the command "firefox"
     *
     * @param string $new New text
     * @param string $browser Command to browser to show page preview
     */
    public function show_changes($new,$browser=false) {
        if ($browser) {
            if (!function_exists('wikidiff2_do_diff')) { 
                dl('php_wikidiff2.so');
            }
            if (!function_exists('wikidiff2_do_diff')) {
                $route = 'diff';
            } else {
                $route = 'browser';
            }
        } else {
            $route = 'browser';
        }
        
        if (!$browser) {
            $type = shell_exec('type colordiff');
            if (false !== strpos($type,'colordiff is')) {
                $command = 'colordiff';
            } else {
                shell_exec('type diff');
                if (false !== strpos($type,'diff is')) {
                    $command = 'diff';
                }
            }
            
            if ($command) {
                file_put_contents('.pillardiffold',$this->text . "\n");
                file_put_contents('.pillardiffnew',$new . "\n");

                Pillar::report (str_pad(" {$this->title} ",60,'#',STR_PAD_BOTH) . "\n\n" . exec("$command -u .pillardiffold .pillardiffnew --label Old --label New") . "\n" . str_pad("",60,'#',STR_PAD_BOTH),PILLAR_ACTION);
                
                unlink('.pillardiffold');
                unlink('.pillardiffnew');
                return;
            } else {
                $route = 'browser';
            }
        }
        
        if ($route == 'browser') { //it must, but checking anyway for sanity's sake...
            if (!function_exists('wikidiff2_do_diff')) {
                Pillar::report("No preview software (wikidiff2/colordiff/diff) available",PILLAR_ERROR); //we only get here if the colordiff/diff checking has failed above as well
                return;
            }
            file_put_contents('.pillarpreview.htm',str_replace('COMPLETETEXT',$new,str_replace('REPLACETITLE',$this->title,str_replace('REPLACETHISPLEASE',wikidiff2_do_diff($this->text,$new,2),file_get_contents('template.htm'))))); //sorry, Anomie
            
            system (($browser ? 'firefox' : $browser) . " .pillarpreview.htm &");
            return;
        } else {
            throw new PillarException();
        }
    }
    
    /**
     * Move page to new name
     * 
     * Moves current page, then rebuilds Page object at new title.  This will, of course, change {@link Page::get_edittime()}
     * among other settings.
     * 
     * @param string $to New title of page
     * @param string $summary Move summary
     * @param boolean $movetalk Move associated talk page?
     * @param boolean $noredirect Suppress redirect (admins and bots only)
     */
    public function move($to,$summary,$movetalk = true,$noredirect = false) {
        if ($this->site->get_confirmaction()) {
            if (!Pillar::confirmaction("move of {$this->title} to $to")) {
                throw new PillarActionCancelled("move of {$this->title} to $to");
            }
        }
        
        if ($this->movetoken == null) {
            throw new PillarMoveForbidden($this->title);
        }
        
        if (strlen($summary > 255)) {
            throw new PillarMoveLongSummary($this->title);
        }
        
        if ($summary == '') {
            throw new PillarMoveNoSummary($this->title);
        }
        
        $vars = array('action'=>'move','from'=>$this->title, 'to'=>$to, 'token'=>$this->movetoken, 'reason'=>$summary);
        
        if ($movetalk) {
            $vars['movetalk'] = '';
        }
        
        if ($noredirect) {
            $vars['noredirect'] = '';
        }
        
        $request = new MWRequest($this->site,$vars,true);
        $result = $request->get_result();
        
        if (!is_array($result['move'])) {
            throw new PillarMoveError($result['info'],$this->title);
        }
        
        $this->__construct($this->site,$to);
    }
    
    /**
     * Delete page
     * 
     * Delete current page.
     * 
     * Then rebuild page object with the same title, presumably now with no content and {@link Page::get_exists()} == false
     *
     * @param string $summary
     */
    public function delete($summary) {
        if ($this->site->get_confirmaction()) {
            if (!Pillar::confirmaction("deletion of {$this->title}")) {
                throw new PillarActionCancelled("deletion of {$this->title}");
            }
        }
        
        if ($this->deletetoken == null) {
            throw new PillarDeleteForbidden($this->title);
        }
        
        if (strlen($summary > 255)) {
            throw new PillarDeleteLongSummary($this->title);
        }
        
        if ($summary == '') {
            throw new PillarDeleteNoSummary($this->title);
        }
        
        $vars = array('action'=>'delete', 'title'=>$this->title, 'token'=>$this->deletetoken,'reason'=>$summary);
        
        $request = new MWRequest($this->site,$vars,true);
        $result = $request->get_result();
        
        if (!is_array($result['delete'])) {
            throw new PillarDeleteError($result['info'],$this->title);
        }
        
        $this->__construct($this->site,$this->title);
    }
    
    /**
     * Protect page
     * 
     * Apply new page protection settings.
     * 
     * $settings should be an array of edit and move protection settings.  If either is absent, it is implied that
     * the current settings for that setting should stand.  Omitting both will cause an exception to be thrown.
     * 
     * $settings can be visualised as an array of {@link Page::get_moveprotection()} and {@link Page::get_editprotection()}:
     * 
     * <pre> array ('edit'=>array('level'=>'sysop','expiry'=>'indefinite'),'move'=>array('level'=>'autoconfirmed','expiry'=>'indefinite')</pre>
     * 
     * $summary must be less than 255 characters, per MediaWiki requirements.
     * 
     * @param array $settings New page protection settings
     * @param string $summary Protection summary
     * @param boolean $cascade Enable cascading protection
     */
    public function protect($settings,$summary,$cascade=false) {
        if ($this->site->get_confirmaction()) {
            if (!Pillar::confirmaction("protection of {$this->title}")) {
                throw new PillarActionCancelled("protection of {$this->title}");
            }
        }
        
        if (strlen($summary > 255)) {
            throw new PillarProtectLongSummary($this->title);
        }
        if ($summary == '') {
            throw new PillarProtectNoSummary($this->title);
        }
        
        if (!array_key_exists('edit',$settings) && !array_key_exists('move',$settings)) {
            throw new PillarProtectNoSettings($this->title);
        }
        
        if (array_key_exists('edit',$settings)) {
            if (!array_key_exists('level',$settings['edit']) || !array_key_exists('expiry',$settings['edit'])) {
                throw new PillarProtectInvalidSettings($this->title);
            }
            $protections = "edit={$settings['edit']['level']}";
            $expiry = $settings['edit']['expiry'];
        }
        
        if (array_key_exists('move',$settings)) {
            if (!array_key_exists('level',$settings['move']) || !array_key_exists('expiry',$settings['move'])) {
                throw new PillarProtectInvalidSettings($this->title);
            }
            $protections = ($protections ? "$protections|" : '' ) . "move={$settings['edit']['level']}";
            $expiry = ($expiry ? "$expiry|" : '' ) . $settings['move']['expiry'];
        }
        
        $vars = array ('action'=>'protect','title'=>$this->title,'protections'=>$protections,'expiry'=>$expiry,'reason'=>$summary);
        
        if ($cascade) {
            $vars['cascade'] = '';
        }
        
        $request = new MWRequest($this->site,$vars,true);
        $result = $request->get_result();
        
        if (!is_array($result['protect'])) {
            throw new PillarProtectError($result['info'],$this->title);
        }
        
        $this->__construct($this->site,$this->title);
    }
    
    /**
     * Check exclusion
     * 
     * Check if bots -- and this bot in particular -- are excluded from this page.  The following logic 
     * is used:
     * 
     *  - If {@link http://en.wikipedia.org/wiki/Template:Nobots {{nobots}}} is present, return true.
     *  - If {@link http://en.wikipedia.org/wiki/Template:Nobots {{bots}}} is present and allow=(username)
     *    is present, return false.
     *  - If {{bots}} is present and deny= contains either "all" or the bot's username, return true.
     *  - If {{bots}} is present and optout= contains any of the tasks listed in the $tasks, return true.
     *  - Otherwise, return false
     * 
     * @param mixed $tasks Array or string containing task names to search for against optout=
     * @return boolean
     * 
     */
    public function checkexcluded($tasks=false) {
        do {
            $templates = $this->get_templates(100,$continue);
            if (in_array('Template:Bots',$templates)) {
                $botspresent = true;
            }
            if (in_array('Template:Nobots',$templates)) {
                $nobotspresent = true;
            }
        } while ($continue != null);
        
        if ($nobotspresent) {
            return true; //all bots are excluded
        }
        
        if (!$botspresent) {
            return false;
        }
        
        preg_match('/\{\{bots[^}]*\}\}/i','{{bots|deny=all}}',$bots);
        
        if (preg_match('/allow=([^\|\}]*)/i',$bots[0],$allow)) {
            $allow = explode(',',$allow[1]);
            foreach ($allow as $a) {
                if (stristr($a,$this->site->get_username())) {
                    return false;
                }
            }
        }
        
        if (preg_match('/deny=([^\|\}]*)/i',$bots[0],$deny)) {
            $deny = explode(',',$deny[1]);
            foreach ($deny as $d) {
                if (stristr($d,'all') || stristr($d,$this->site->get_username())) {
                    return true;
                }
            }
        }
        
        if ($tasks) {
            if (is_string($tasks)) {
                $tasks = array($tasks);
            }
            if (preg_match('/optout=([^\|\}]*)/i',$bots[0],$optout)) {
                $optout = explode(',',$optout[1]);
                foreach ($optout as $o) {
                    if (stristr($o,'all')) {
                        return true;
                    }
                    foreach ($tasks as $t) {
                        if (stristr($o,$t)) {
                            return true;
                        }
                    }
                }
            }
        }
    }
}
