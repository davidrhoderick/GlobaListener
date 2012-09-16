<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" dir="ltr">
<head>
<title>Development code/Apibot.php - Apibot</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="generator" content="MediaWiki 1.16.0" />
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="search" type="application/opensearchdescription+xml" href="/opensearch_desc.php" title="Apibot (en)" />
<link rel="alternate" type="application/atom+xml" title="Apibot Atom feed" href="/index.php?title=Special:RecentChanges&amp;feed=atom" />
<link rel="stylesheet" href="/skins/common/shared.css?270" media="screen" />
<link rel="stylesheet" href="/skins/common/commonPrint.css?270" media="print" />
<link rel="stylesheet" href="/skins/monobook/main.css?270" media="screen" />
<!--[if lt IE 5.5000]><link rel="stylesheet" href="/skins/monobook/IE50Fixes.css?270" media="screen" /><![endif]-->
<!--[if IE 5.5000]><link rel="stylesheet" href="/skins/monobook/IE55Fixes.css?270" media="screen" /><![endif]-->
<!--[if IE 6]><link rel="stylesheet" href="/skins/monobook/IE60Fixes.css?270" media="screen" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" href="/skins/monobook/IE70Fixes.css?270" media="screen" /><![endif]-->
<link rel="stylesheet" href="/index.php?title=MediaWiki:Common.css&amp;usemsgcache=yes&amp;ctype=text%2Fcss&amp;smaxage=18000&amp;action=raw&amp;maxage=18000" />
<link rel="stylesheet" href="/index.php?title=MediaWiki:Print.css&amp;usemsgcache=yes&amp;ctype=text%2Fcss&amp;smaxage=18000&amp;action=raw&amp;maxage=18000" media="print" />
<link rel="stylesheet" href="/index.php?title=MediaWiki:Monobook.css&amp;usemsgcache=yes&amp;ctype=text%2Fcss&amp;smaxage=18000&amp;action=raw&amp;maxage=18000" />
<link rel="stylesheet" href="/index.php?title=-&amp;action=raw&amp;maxage=18000&amp;gen=css" />
<script>
var skin="monobook",
stylepath="/skins",
wgUrlProtocols="http\\:\\/\\/|https\\:\\/\\/|ftp\\:\\/\\/|irc\\:\\/\\/|gopher\\:\\/\\/|telnet\\:\\/\\/|nntp\\:\\/\\/|worldwind\\:\\/\\/|mailto\\:|news\\:|svn\\:\\/\\/",
wgArticlePath="/index.php/$1",
wgScriptPath="",
wgScriptExtension=".php",
wgScript="/index.php",
wgVariantArticlePath=false,
wgActionPaths={},
wgServer="http://apibot.zavinagi.org",
wgCanonicalNamespace="",
wgCanonicalSpecialPageName=false,
wgNamespaceNumber=0,
wgPageName="Development_code/Apibot.php",
wgTitle="Development code/Apibot.php",
wgAction="view",
wgArticleId=42,
wgIsArticle=true,
wgUserName=null,
wgUserGroups=null,
wgUserLanguage="en",
wgContentLanguage="en",
wgBreakFrames=false,
wgCurRevisionId=290,
wgVersion="1.16.0",
wgEnableAPI=true,
wgEnableWriteAPI=true,
wgSeparatorTransformTable=["", ""],
wgDigitTransformTable=["", ""],
wgMainPageTitle="Main Page",
wgFormattedNamespaces={"-2": "Media", "-1": "Special", "0": "", "1": "Talk", "2": "User", "3": "User talk", "4": "Apibot", "5": "Apibot talk", "6": "File", "7": "File talk", "8": "MediaWiki", "9": "MediaWiki talk", "10": "Template", "11": "Template talk", "12": "Help", "13": "Help talk", "14": "Category", "15": "Category talk"},
wgNamespaceIds={"media": -2, "special": -1, "": 0, "talk": 1, "user": 2, "user_talk": 3, "apibot": 4, "apibot_talk": 5, "file": 6, "file_talk": 7, "mediawiki": 8, "mediawiki_talk": 9, "template": 10, "template_talk": 11, "help": 12, "help_talk": 13, "category": 14, "category_talk": 15, "image": 6, "image_talk": 7},
wgSiteName="Apibot",
wgCategories=[],
wgRestrictionEdit=[],
wgRestrictionMove=[];
</script><script src="/skins/common/wikibits.js?270"></script>
<script src="/skins/common/ajax.js?270"></script>
<script src="/index.php?title=-&amp;action=raw&amp;gen=js&amp;useskin=monobook&amp;270"></script>

</head>
<body class="mediawiki ltr ns-0 ns-subject page-Development_code_Apibot_php skin-monobook">
<div id="globalWrapper">
<div id="column-content"><div id="content" >
	<a id="top"></a>
	
	<h1 id="firstHeading" class="firstHeading">Development code/Apibot.php</h1>
	<div id="bodyContent">
		<h3 id="siteSub">From Apibot</h3>
		<div id="contentSub"></div>
		<div id="jump-to-nav">Jump to: <a href="#column-one">navigation</a>, <a href="#searchInput">search</a></div>
		<!-- start content -->
<pre>
&lt;?php
#
#  A MediaWiki bot - used for automated editing of pages on sites
#  powered by MediaWiki.
#
#  Based on the idea of Bgbot, by Borislav Manolov.
#
#  This program is free software; you can redistribute it and/or
#  modify it under the terms of the GNU Affero General Public License
#  as published by the Free Software Foundation; either version 3
#  of the License, or (at your option) any later version.
#
#  This program is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU General Public License for more details.
#
#  You should have received a copy of the GNU Afero General Public License
#  along with this program; if not, write to the Free Software Foundation, Inc.,
#  59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
#  http://www.gnu.org/copyleft/agpl.html
#
#  Author: Grigor Gatchev &lt;grigor at gatchev dot info&gt;
# ---------------------------------------------------------------------------- #

require_once ( dirname ( __FILE__ ) . '/browser.php' );
require_once ( dirname ( __FILE__ ) . '/logins.php' );
require_once ( dirname ( __FILE__ ) . '/apibot_dataobjects.php' );


# ---------------------------------------------------------------------------- #
#                               Bot constants                                  #
# ---------------------------------------------------------------------------- #

define ( 'APIBOT_VERSION', '0.33dev' );
define ( 'APIBOT_BROWSER_AGENT', 'Mozilla 5.0 (Apibot ' . APIBOT_VERSION . ')' );

# ----- Bot loglevels ----- #

define ( 'LL_PANIC'  , 0 );  // the bot is expected to die after logging this level.
define ( 'LL_ERROR'  , 1 );
define ( 'LL_WARNING', 2 );
define ( 'LL_INFO'   , 3 );
define ( 'LL_DEBUG'  , 4 );

# ----- Namespace IDs ----- #

define ( 'NAMESPACE_ID_MEDIA', -2 );
define ( 'NAMESPACE_ID_SPECIAL', -1 );

define ( 'NAMESPACE_ID_MAIN', 0 );
define ( 'NAMESPACE_ID_MAINTALK', 1 );
define ( 'NAMESPACE_ID_USER', 2 );
define ( 'NAMESPACE_ID_USERTALK', 3 );
define ( 'NAMESPACE_ID_WIKI', 4 );  // the wiki name - Wikipedia, or whatever
define ( 'NAMESPACE_ID_WIKITALK', 5 );
define ( 'NAMESPACE_ID_FILE', 6 );
define ( 'NAMESPACE_ID_FILETALK', 7 );
define ( 'NAMESPACE_ID_MEDIAWIKI', 8 );
define ( 'NAMESPACE_ID_MEDIAWIKITALK', 9 );
define ( 'NAMESPACE_ID_TEMPLATE', 10 );
define ( 'NAMESPACE_ID_TEMPLATETALK', 11 );
define ( 'NAMESPACE_ID_HELP', 12 );
define ( 'NAMESPACE_ID_HELPTALK', 13 );
define ( 'NAMESPACE_ID_CATEGORY', 14 );
define ( 'NAMESPACE_ID_CATEGORYTALK', 15 );


# Some of the errors are standard MW API ones, duplicated here for usage by the web backends etc.
$GLOBALS['APIBOT_ERRORS'] = array (

  'genericerror' =&gt; array ( 'level' =&gt; NULL, 'type' =&gt; NULL, 'code' =&gt; NULL, 'info' =&gt; NULL ),  // set code and info!

  'xfererror'    =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 1, 'code' =&gt; &quot;xfererror&quot;,
    'info' =&gt; &quot;Data transfer error&quot; ),
  'browsererror' =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 1, 'code' =&gt; &quot;browsererror&quot;,
    'info' =&gt; &quot;Browser error&quot; ),  // add the browser error No. in the code!
  'xfernoreply'  =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 1, 'code' =&gt; &quot;xfernoreply&quot;,
    'info' =&gt; &quot;No reply received&quot; ),

  'notloggedin'  =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 2, 'code' =&gt; &quot;notloggedin&quot;,
    'info' =&gt; &quot;You must be logged in&quot; ),
  'editconflict' =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 2, 'code' =&gt; &quot;editconflict&quot;,
    'info' =&gt; &quot;Edit conflict detected&quot; ),
  'pagedeleted'  =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 2, 'code' =&gt; &quot;pagedeleted&quot;,
    'info' =&gt; &quot;The page has been deleted since you fetched its timestamp&quot; ),
  'permissiondenied' =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 2, 'code' =&gt; &quot;permissiondenied&quot;,
    'info' =&gt; &quot;Permission denied&quot; ),
  'unknownreason' =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 2, 'code' =&gt; &quot;reasonunknown&quot;,
    'info' =&gt; &quot;Unknown reason&quot; ),
  'revertcaptcha' =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 2, 'code' =&gt; &quot;revertcaptcha&quot;,
    'info' =&gt; &quot;You must solve a captcha to revert this page&quot; ),
  'revertknown'   =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 2, 'code' =&gt; &quot;revertknown&quot;,
    'info' =&gt; NULL ),  // add the error from the ['result'] tree element!
  'revertunknown' =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 2, 'code' =&gt; &quot;revertunknown&quot;,
    'info' =&gt; &quot;Unknown reason&quot; ),
  'editknown'     =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 2, 'code' =&gt; &quot;editknown&quot;,
    'info' =&gt; NULL ),  // add the error from the ['result'] tree element!
  'notmodified'   =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 2, 'code' =&gt; &quot;notmodified&quot;,
    'info' =&gt; &quot;Not modified&quot; ),
  'pageprotected' =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 2, 'code' =&gt; &quot;pageprotected&quot;,
    'info' =&gt; &quot;Protected against bots&quot; ),
  'pagemissing'   =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 2, 'code' =&gt; &quot;pagemissing&quot;,
    'info' =&gt; &quot;Missing page title&quot; ),
  'pageinvalid'   =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 2, 'code' =&gt; &quot;pageinvalid&quot;,
    'info' =&gt; &quot;Invalid page title&quot; ),
  'noparaminfo'   =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 2, 'code' =&gt; &quot;noparaminfo&quot;,
    'info' =&gt; &quot;Could not obtain paraminfo&quot; ),
  'nopimodules'   =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 2, 'code' =&gt; &quot;nopimodules&quot;,
    'info' =&gt; &quot;Could not obtain modules paraminfo&quot; ),
  'nopiqmodules'  =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 2, 'code' =&gt; &quot;nopiqmodules&quot;,
    'info' =&gt; &quot;Could not obtain querymodules paraminfo&quot; ),
  'cantdelete'    =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 2, 'code' =&gt; &quot;cantdelete&quot;,
    'info' =&gt; &quot;Cannot delete pages on this wiki&quot; ),
  'notblocked'   =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 2, 'code' =&gt; &quot;notblocked&quot;,
    'info' =&gt; &quot;User not blocked&quot; ),
  'insharedrepo' =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 2, 'code' =&gt; &quot;insharedrepo&quot;,
    'info' =&gt; &quot;This file is in shared repository&quot; ),


  'olderversion' =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 3, 'code' =&gt; &quot;olderversion&quot;,
    'info' =&gt; &quot;The MediaWiki version is too old to support this request&quot; ),
  'notoken'      =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 3, 'code' =&gt; &quot;notoken&quot;,
    'info' =&gt; &quot;Could not obtain the token requested&quot; ),
  'api_error'    =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 3, 'code' =&gt; &quot;api_error&quot;,
    'info' =&gt; &quot;An internal MediaWiki API error occurred&quot; ),
  'web_error'    =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 3, 'code' =&gt; &quot;web_error&quot;,
    'info' =&gt; &quot;An incorrect or incomplete HTML page was received&quot; ),
  'noblockidoruser' =&gt; array ( 'level' =&gt; LL_ERROR, 'type' =&gt; 3, 'code' =&gt; &quot;noblockidoruser&quot;,
    'info' =&gt; &quot;Specified neither user nor block ID&quot; ),
);


# ---------------------------------------------------------------------------- #
#                               The main bot class                             #
# ---------------------------------------------------------------------------- #

class Apibot {

  public    $test_mode = false;   // if true, info will be printed to screen instead of exchange
  public    $dump_mode = false;   // if true, the exchange will be dumped also to screen

  protected $login;               // login data, passed to Apibot

  protected $bot_params;          // bot global parameters

  protected $wiki = array();      // wiki info
  protected $user = array();      // user info

  protected $browser;             // the browser object
  public    $browser_agent = APIBOT_BROWSER_AGENT;
  public    $browser_compression = true;

  public    $error = array();     // 'level', 'type', 'code' and 'info' are supported
  // level: panic - 0, error - 1, warning - 2 (info and debug do not go here)
  // type: 0 or NULL - no error, 1 - link (browser), 2 - MediaWiki / HTML, 3 - program logic... 255 - unknown

  protected $params = array();    // parameters to be passed on request
  protected $fileparams = array();// file upload parameters to be passed on request
  protected $states = array();    // states of modules etc. to be preserved between calls and recursions

  protected $data_tree = array(); // data returned by the request

  protected $bot_stack = array(); // preserves the full bot states during inserted tasks

  protected $logname;             // filename to write the log in
  protected $logpreface;          // a string to preface every log string
  protected $logpreface_stack = array(); // the log prefaces stack
  public    $loglevel = LL_INFO;  // levels: 0 (panic), 1 (error), 2 (warning), 3 (info), 4 (debug)
  public    $echo_log;            // echo the log on the screen, too
  public    $html_log;            // format the log in HTML

  public    $max_postdata_size = PHP_INT_MAX;  // if postdata turns out longer, this will be logged.
  public    $log_levelprefs = array ( LL_PANIC =&gt; '!', LL_ERROR =&gt; '#', LL_WARNING =&gt; '=', LL_INFO =&gt; '+', LL_DEBUG =&gt; '-' );

  protected $APIBOT_PAGE_PROPERTIES = array (
    'info'           =&gt; 'in',
    'revisions'      =&gt; 'rv',
    'categories'     =&gt; 'cl',
    'imageinfo'      =&gt; 'ii',
    'stashimageinfo' =&gt; 'sii',
    'langlinks'      =&gt; 'll',
    'links'          =&gt; 'pl',
    'templates'      =&gt; 'tl',
    'images'         =&gt; 'im',
    'extlinks'       =&gt; 'el',
    'categoryinfo'   =&gt; 'ci',
    'duplicatefiles' =&gt; 'df',
    'globalusage'    =&gt; 'gu',
  );

  # ---------- Constructor and destructor ---------- #

  function __construct ( $login, $params = NULL ) {

    $this-&gt;set_bot_params ( $params, $login );
    $this-&gt;set_bot_variables();

    $this-&gt;log ( &quot;Started, Apibot v&quot; . APIBOT_VERSION, LL_INFO );

    $this-&gt;login ( $login );
  }

  function __destruct () {
    $this-&gt;log ( &quot;Ended, Apibot v&quot; . APIBOT_VERSION . &quot;\n&quot;, LL_INFO );
  }

  private function set_bot_params ( $params, $login ) {
    fill_on_null ( $params, array() );

    fill_on_empty ( $params['logname'], basename ( $_SERVER['SCRIPT_FILENAME'], '.php' ) . '.log' );
    fill_on_empty ( $params['logpreface'], '' );
    fill_on_empty ( $params['loglevel'], LL_INFO);
    fill_on_empty ( $params['echo_log'], true );
    fill_on_empty ( $params['html_log'], false );

    fill_on_empty ( $params['workfiles_path'], &quot;.&quot; );

    fill_on_empty ( $params['fetch_info'], &quot;on_newrevision&quot; );
    fill_on_empty ( $params['fetch_wikiinfo'], $params['fetch_info'] );
    fill_on_empty ( $params['fetch_userinfo'], $params['fetch_info'] );
    if ( $params['fetch_userinfo'] == &quot;on_newversion&quot; || $params['fetch_userinfo'] == &quot;on_newrevision&quot; ) {
      $params['fetch_userinfo'] = &quot;on_expiry&quot;;
    }

    fill_on_empty ( $params['fetched_info_expiry'], 60 * 60 * 24 * 7 );
    fill_on_empty ( $params['fetched_wikiinfo_expiry'], $params['fetched_info_expiry'] );
    fill_on_empty ( $params['fetched_userinfo_expiry'], $params['fetched_info_expiry'] );

    fill_on_empty ( $params['limits'], array() );
    fill_on_empty ( $login['limits'], array() );
    fill_on_empty ( $login['wiki']['limits'], array() );
    $params['limits'] = array_merge ( $login['limits'], $login['wiki']['limits'], $params['limits'] );

    $this-&gt;test_mode = array_value ( $params, 'test_mode', $this-&gt;test_mode );
    $this-&gt;dump_mode = array_value ( $params, 'dump_mode', $this-&gt;dump_mode );

    if (&nbsp;! empty ( $params['memory_limit'] ) ) {
      ini_set ( 'memory_limit', $params['memory_limit'] );
    }
    if (&nbsp;! empty ( $params['max_text_length'] ) ) {
      preg_match ( '/^(\d+)(K|M|G)?$/ui', $params['max_text_length'], $matches );
      $bytes = $matches[1] * 4;  // * 2 for the MediaWiki utf8, and * 2 for the regex search/replace process
      ini_set ( 'pcre.backtrack_limit', $bytes . $matches[2] );
    }

    $this-&gt;bot_params = $params;
  }

  private function set_bot_variables ( $bot_params = NULL ) {
    fill_on_null ( $bot_params, $this-&gt;bot_params );

    $this-&gt;logname    = $bot_params['logname'];
    $this-&gt;logpreface = $bot_params['logpreface'];
    $this-&gt;loglevel   = $bot_params['loglevel'];
    $this-&gt;echo_log   = $bot_params['echo_log'];
    $this-&gt;html_log   = $bot_params['html_log'];

    $browser_params = array();
    if (&nbsp;! empty ( $bot_params['cookies_file'] ) ) {
      $browser_params['cookies_file'] = $bot_params['workfiles_path'] . &quot;/&quot; . $bot_params['cookies_file'];
    }
    $this-&gt;browser = new Browser ( $browser_params );

  }

  # ---------- Tools ---------- #

  # ----- Logfile ----- #

  public function log ( $msg, $msglevel = LL_INFO ) {
    $msg = $this-&gt;logpreface . $msg;
    if ( $msglevel &lt;= $this-&gt;loglevel ) {
      if (&nbsp;! empty ( $msg ) ) {
        $msg = $this-&gt;log_levelprefs[$msglevel] . ' ['. date('Y-m-d H:i:s') .'] '. $msg;
        if ( $this-&gt;echo_log ) {
          # print errors in red
          echo ( ( $msglevel &lt; LL_WARNING )&nbsp;? &quot;\033[31m$msg\033[0m&quot;&nbsp;: $msg ) . &quot;\n&quot;;
          flush();
        }
      }
      if ( $this-&gt;html_log ) $msg = &quot;&lt;p&gt;&quot; . $msg . &quot;&lt;/p&gt;&quot;;
      if ( $this-&gt;logname&nbsp;!== &quot;&quot; ) my_fwrite ( $this-&gt;logname, $msg . &quot;\n&quot; );
    }
  }

  public function push_logpreface ( $new_preface ) {
    array_push ( $this-&gt;logpreface_stack, $this-&gt;log_preface );
    $this-&gt;logpreface = $new_preface;
  }

  public function pop_logpreface () {
    $this-&gt;logpreface = array_pop ( $this-&gt;logpreface_stack );
  }

  protected function log_status ( $ok_string, $error_template,
    $ok_loglevel = LL_INFO, $error_loglevel = NULL ) {

    if ( array_key_exists ( 'level',  $this-&gt;error ) ) {
      if ( is_null ( $error_loglevel ) ) {
        $error_loglevel = $this-&gt;error['level'];
      }
      switch ( $this-&gt;error['level'] ) {
        case 0&nbsp;: $level = &quot;Panic&quot;; break;
        case 1&nbsp;: $level = &quot;Error&quot;; break;
        case 2&nbsp;: $level = &quot;Warning&quot;; break;
      }
      switch ( $this-&gt;error['type'] ) {
        case 1&nbsp;: $type = &quot;data link&quot;; break;
        case 2&nbsp;: $type = &quot;MediaWiki&quot;; break;
        case 3&nbsp;: $type = &quot;logic&quot;; break;
        default&nbsp;: $type = &quot;unknown&quot;;
      }
      $error_string = str_replace ( '$level', $level, $error_template );
      $error_string = str_replace ( '$type', $type, $error_string );
      $error_string = str_replace ( '$code', $this-&gt;error['code'], $error_string );
      $error_string = str_replace ( '$info', $this-&gt;error['info'], $error_string );
      $this-&gt;log ( $error_string, $error_loglevel );
      return false;
    } else {
      $this-&gt;log ( $ok_string, $ok_loglevel );
      return true;
    }
  }

  protected function log_warnings_if_present ( &amp;$action_tree ) {
    if (&nbsp;! empty ( $action_tree['warnings'] ) ) {
      foreach ( $action_tree['warnings'] as $warning =&gt; $text ) {
        $this-&gt;log ( &quot;Warning: &quot; . $warning . &quot;: &quot; . $text, LL_WARNING );
      }
      return true;
    }
    return false;
  }

  # ----- Saving and restoring bot state ----- #

  public function push_bot_state () {
    $state = array();
    $state['params'    ] = $this-&gt;params;
    $state['fileparams'] = $this-&gt;fileparams;
    $state['states'    ] = $this-&gt;states;
    $state['error'     ] = $this-&gt;error;
    $state['data_tree' ] = $this-&gt;data_tree;
    $this-&gt;bot_stack[] = $state;
  }

  public function pop_bot_state () {
    $state = array_pop ( $this-&gt;bot_stack );
    $this-&gt;params     = $state['params'    ];
    $this-&gt;fileparams = $state['fileparams'];
    $this-&gt;states     = $state['states'    ];
    $this-&gt;error      = $state['error'     ];
    $this-&gt;data_tree  = $state['data_tree' ];
  }

  # ----- Errors ----- #

  protected function set_std_error ( $id, $info = NULL, $code = NULL, $type = NULL, $level = NULL ) {
    $this-&gt;error = $GLOBALS['APIBOT_ERRORS'][$id];
    if (&nbsp;! is_null ( $level ) ) { $this-&gt;error['level'] = $level; }
    if (&nbsp;! is_null ( $type ) ) { $this-&gt;error['type'] = $type; }
    if (&nbsp;! is_null ( $code ) ) { $this-&gt;error['code'] = $code; }
    if (&nbsp;! is_null ( $info ) ) {
      if ( preg_match ( '/[\ \:]/', mb_substr ( $info, 0, 1 ) ) ) {
        $this-&gt;error['info'] .= $info;
      } else {
        $this-&gt;error['info'] = $info;
      }
    }
    return false;
  }

  public function error_string () {
    return $this-&gt;error['code'] . &quot;: &quot; . $this-&gt;error['info'];
  }

  # -----  MediaWiki version handling  ----- #

  public function mw_version_number () {
    $array = explode ( &quot; &quot;, $this-&gt;wiki['general']['generator'] );
    $array = explode ( &quot;.&quot;, $array[1] );
    return ( $array[0] * 10000 ) + ( $array[1] * 100 ) + ( empty ( $array[2] )&nbsp;? 0&nbsp;: $array[2] );
  }

  public function mw_version_ok ( $version_code ) {
    if ( $this-&gt;mw_version_number() &gt;= $version_code ) {
      return true;
    } else {
      return $this-&gt;set_std_error ( 'olderversion' );
    }
  }

  protected function mw_version_and_token_ok ( $version_code ) {
    if ( $this-&gt;mw_version_ok ( $version_code ) &amp;&amp; $this-&gt;api_get_token_if_needed() ) {
      if ( empty ( $this-&gt;params['token'] ) ) {
        $this-&gt;append_param ( 'token', $this-&gt;wiki['token'] );
      }
      return true;
    }
    return false;
  }

  # -----  Convenience functions  ----- #

  public function barsepstring ( $arg, $preg_quote = false, $regex_wikicase = false ) {
    if ( is_array ( $arg ) ) {
      foreach ( $arg as &amp;$value ) {
        $value = ( $preg_quote&nbsp;? preg_quote ( $value )&nbsp;: $value );
        $value = ( $regex_wikicase&nbsp;? $this-&gt;regex_wikicase ( $value )&nbsp;: $value );
      }
      return implode ( &quot;|&quot;, $arg );
    } else {
      return $arg;
    }
  }

  public function keyequals_barsepstring ( $arg, $match_sign = '=' ) {
    if ( is_array ( $arg ) ) {
      foreach ( $arg as $key =&gt; &amp;$value ) {
        $value = $key . $match_sign . $value;
      }
    }
    return $this-&gt;barsepstring ( $arg );
  }

  # ---------- Adding request parameters ---------- #

  # ----- Append to the params array ----- #

  protected function append_param ( $paramname, $params = NULL ) {
    $string = $this-&gt;barsepstring ( $params );
    if ( empty ( $this-&gt;params[$paramname] ) ) {
      $this-&gt;params[$paramname] = $string;
    } else {
      $this-&gt;params[$paramname] .= &quot;|&quot; . $string;
    }
  }

  protected function append_param_if_nonnull ( $paramname, $params ) {
    if (&nbsp;! is_null ( $params ) ) {
      $this-&gt;append_param ( $paramname, $params );
    }
  }

  protected function append_param_if_true ( $paramname, $param ) {
    if ( $param ) { $this-&gt;append_param ( $paramname, '' ); }
  }

  protected function append_params_array ( $parameters, $code = NULL ) {
    foreach ( $parameters as $parameter =&gt; $value ) {
      $value = $this-&gt;barsepstring ( $value );
      $this-&gt;append_param ( $code . $parameter, $value );
    }
  }

  # ----- Append to the fileparams array ----- #

  protected function append_fileparam ( $paramname, $param = NULL ) {
    $this-&gt;fileparams[$paramname] = $param;
  }

  protected function append_fileparam_if_nonnull ( $paramname, $param ) {
    if (&nbsp;! is_null ( $param ) ) {
      $this-&gt;append_fileparam ( $paramname, $param );
    }
  }

  # ---------- Generic browser requests ---------- #

  protected function test_dump ( $text ) {
    echo $text;
    echo str_repeat ( '-', 80 ) . &quot;\n&quot;;
  }

  public function bytecounters () {
    return $this-&gt;browser-&gt;bytecounters;
  }

  public function reset_bytecounters () {
    return $this-&gt;browser-&gt;reset_bytecounters();
  }

  public function xfer ( $url, $vars = NULL, $files = NULL, $http_auth = NULL,
    $use_compression = true, $browser_agent = NULL, $limits = NULL,
    $retries = 5, $interval = 1, $checkreply_func = NULL ) {

    if ( is_null ( $browser_agent ) ) { $browser_agent = $this-&gt;browser_agent; }

    $this-&gt;browser-&gt;use_compression = $use_compression;
    $this-&gt;browser-&gt;agent           = $browser_agent;
    $this-&gt;browser-&gt;limits          = $limits;

    if ( empty ( $http_auth ) ) {
      $do_auth = false;
    } else {
      $do_auth = true;
      $this-&gt;browser-&gt;user = $http_auth['user'];
      $this-&gt;browser-&gt;pass = $http_auth['pass'];
    }

    $counter = 0;
    while ( $counter &lt; $retries ) {
      $this-&gt;error = array();

      $result = $this-&gt;browser-&gt;submit ( $url, $vars, $files, $do_auth );

      if (&nbsp;! $result ) {
        $this-&gt;set_std_error ( 'browsererror', &quot;: &quot; . $this-&gt;browser-&gt;error );
      } elseif ( strlen ( $this-&gt;browser-&gt;content ) == 0 ) {
        $this-&gt;set_std_error ( 'xfernoreply' );
      } elseif (&nbsp;! empty ( $checkreply_func ) &amp;&amp;&nbsp;! call_user_func ( $checkreply_func, $this-&gt;browser ) ) {
        // the error should be set in checkreply_func();
        // it should return false on data transfer error, true otherwise (but may still set an error)
      } else {
        return $this-&gt;browser-&gt;content;
      }

      $this-&gt;log_status ( &quot;&quot;, &quot;Data transfer failed (\$info) - retry &quot; . ( $counter + 1 ) . &quot;...&quot;,
        LL_INFO, LL_WARNING );

      $counter++;
      sleep ( $interval * $counter * $counter );
    }
    if ( empty ( $this-&gt;error['level'] ) ) {
      return $this-&gt;set_std_error ('xfererror' );
    }
    return false;
  }

  private function wiki_xfer ( $url, $vars = NULL, $files = NULL, $checkreply_func = NULL ) {
    return ( $this-&gt;xfer ( $url, $vars, $files, array_value ( $this-&gt;login, 'wiki.http-auth' ),
      $this-&gt;browser_compression, $this-&gt;browser_agent, $this-&gt;bot_params['limits'],
      array_value ( $this-&gt;login, 'wiki.retries.link_error' ),
      array_value ( $this-&gt;login, 'wiki.interval.link_error' ),
      $checkreply_func )&nbsp;!== false );
  }

  # ----- Generic API request ----- #

  private function checkreply_api () {
    $this-&gt;data_tree = unserialize ( $this-&gt;browser-&gt;content );
    if ( $this-&gt;data_tree === false ) {
      if ( preg_match ( '/Unexpected non-MediaWiki exception encountered\, of type \&amp;quot\;(.*)\&amp;quot\;\&lt;br \/\&gt;(.*)\&lt;br \/\&gt;/Uus', $this-&gt;browser-&gt;content, $matches ) ) {
        $err_info = &quot;: &quot; . trim ( $matches[1] ) . &quot; (&quot; . trim ( $matches[2] ) . &quot;)&quot;;
        if ( preg_match ( '/^unknown_action:/U', trim ( $matches[2] ), $matches ) ) {
          $err_info.= ' (is $wgEnableWriteAPI enabled on this wiki?)';
        }
      } elseif ( preg_match ( &quot;/\&lt;b\&gt;\s*Fatal error\s*\&lt;\/b\&gt;\s*\:(.*)$/Usi&quot;, $this-&gt;browser-&gt;content, $matches ) ) {
        $err_info = &quot;Fatal error: &quot; . trim ( $matches[1] );  // could be processed further
      } elseif ( preg_match ( '/\&lt;title\&gt;([^\&lt;]+)\&lt;\/title\&gt;/ui', $this-&gt;browser-&gt;content, $matches ) ) {
        $err_info = &quot;Technical problem: &quot; . $matches[1];
      }
      return $this-&gt;set_std_error ( 'api_error', $err_info );
    } elseif (&nbsp;! is_array ( $this-&gt;data_tree ) ) {  // should not occur, but just in case...
      return $this-&gt;set_std_error ( 'api_error' );
    } elseif ( array_key_exists ( 'error', $this-&gt;data_tree ) ) {
      $this-&gt;set_std_error ( 'genericerror', $this-&gt;data_tree['error']['info'],
        $this-&gt;data_tree['error']['code'], 3, LL_ERROR );
    }
    return true;
  }

  protected function api ( $action ) {
    $this-&gt;params['format'] = &quot;php&quot;;
    $this-&gt;params['action'] = $action;

    if ( $this-&gt;dump_mode ) {
      echo &quot;Params: &quot;; print_r ( $this-&gt;params );
      echo &quot;Files: &quot;; print_r ( $this-&gt;fileparams );
    }

    $result = $this-&gt;wiki_xfer ( $this-&gt;login['wiki']['api_url'], $this-&gt;params,
      $this-&gt;fileparams, array ( $this, &quot;checkreply_api&quot; ) );
    // checkreply_api() also unserializes the request result

    if ( $this-&gt;dump_mode ) print_r ( $this-&gt;data_tree );

    $this-&gt;params = array();
    $this-&gt;fileparams = array();

    return $result;
  }

  # ----- Generic web request ----- #

  private function checkreply_web () {
    if ( strripos ( $this-&gt;browser-&gt;content, '&lt;/html&gt;' ) === false ) {
      return $this-&gt;set_std_error ( 'web_error' );
    } else {
      return true;
    }
  }

  protected function web ( $title, $action, $vars = NULL, $files = NULL, $extra_params = NULL ) {
    if (&nbsp;! is_array ( $extra_params ) ) { $extra_params = array(); }
    if (&nbsp;! empty ( $title ) ) { $extra_params['title'] = $title; }
    if (&nbsp;! empty ( $action ) ) { $extra_params['action'] = $action; }

    foreach ( $extra_params as $name =&gt; $value ) {
      if ( empty ( $params ) ) { $params = '?'; } else { $params .= '&amp;'; }
      $params .= urlencode ( $name ) . &quot;=&quot; . urlencode ( $value );
    }

    $url = str_replace ( &quot;api.php&quot;, &quot;index.php&quot;, $this-&gt;login['wiki']['api_url'] ) .
      $params;

    if ( $this-&gt;dump_mode ) {
      echo &quot;URL: &quot; . $url;
      echo &quot;Params: &quot;; print_r ( $this-&gt;vars );
      echo &quot;Files: &quot;; print_r ( $this-&gt;files );
    }

    $result = $this-&gt;wiki_xfer ( $url, $vars, $files, array ( $this, &quot;checkreply_web&quot; ) );

    if ( $this-&gt;dump_mode ) echo $this-&gt;browser-&gt;contents;
  }

  # ---------- API requests - first level ---------- #

  protected function api_action_login           () { return $this-&gt;api ( &quot;login&quot;      ); }
  protected function api_action_logout          () { return $this-&gt;api ( &quot;logout&quot;     ); }
  protected function api_action_query           () { return $this-&gt;api ( &quot;query&quot;      ); }
  protected function api_action_edit            () { return $this-&gt;api ( &quot;edit&quot;       ); }
  protected function api_action_move            () { return $this-&gt;api ( &quot;move&quot;       ); }
  protected function api_action_rollback        () { return $this-&gt;api ( &quot;rollback&quot;   ); }
  protected function api_action_delete          () { return $this-&gt;api ( &quot;delete&quot;     ); }
  protected function api_action_undelete        () { return $this-&gt;api ( &quot;undelete&quot;   ); }
  protected function api_action_protect         () { return $this-&gt;api ( &quot;protect&quot;    ); }
  protected function api_action_block           () { return $this-&gt;api ( &quot;block&quot;      ); }
  protected function api_action_unblock         () { return $this-&gt;api ( &quot;unblock&quot;    ); }
  protected function api_action_watch           () { return $this-&gt;api ( &quot;watch&quot;      ); }
  protected function api_action_emailuser       () { return $this-&gt;api ( &quot;emailuser&quot;  ); }
  protected function api_action_patrol          () { return $this-&gt;api ( &quot;patrol&quot;     ); }
  protected function api_action_import          () { return $this-&gt;api ( &quot;import&quot;     ); }
  protected function api_action_userrights      () { return $this-&gt;api ( &quot;userrights&quot; ); }
  protected function api_action_expandtemplates () { return $this-&gt;api ( &quot;expandtemplates&quot; ); }
  protected function api_action_parse           () { return $this-&gt;api ( &quot;parse&quot;      ); }
  protected function api_action_upload          () { return $this-&gt;api ( &quot;upload&quot;     ); }
  protected function api_action_purge           () { return $this-&gt;api ( &quot;purge&quot;      ); }
  protected function api_action_paraminfo       () { return $this-&gt;api ( &quot;paraminfo&quot;  ); }

  # ---------- API requests - second level (where needed) ---------- #

  # ----- Queries ----- #

  # --- Appending page properties --- #

  protected function append_prop ( $properties, $prop, $code ) {
    if ( isset ( $properties[$prop] ) ) {
      $this-&gt;append_param ( 'prop', $prop );
      $this-&gt;append_params_array ( $properties[$prop], $code );
    }
  }

  protected function append_properties ( $properties ) {
    foreach ( $this-&gt;APIBOT_PAGE_PROPERTIES as $name =&gt; $prefix ) {
      $this-&gt;append_prop ( $properties, $name, $prefix );
    }
  }

  # --- General --- #

  public function query_tree () {
    return $this-&gt;data_tree['query'];
  }

  public function query_limits ( $what_for = NULL ) {
    if ( empty ( $this-&gt;data_tree['limits'] ) ) return false;
    if ( is_null ( $what_for ) ) {
      return $this-&gt;data_tree['limits'];
    } else {
      return ( empty ( $this-&gt;data_tree['limits'][$what_for] )&nbsp;? false&nbsp;: $this-&gt;data_tree['limits'][$what_for] );
    }
  }

  public function query_normalized ( $what = NULL ) {
    if ( empty ( $this-&gt;data_tree['query']['normalized'] ) ) return false;
    if ( is_null ( $what ) ) {
      return $this-&gt;data_tree['query']['normalized'];
    } else {
      foreach ( $this-&gt;data_tree['query']['normalized'] as $normalize ) {
        if ( $normalize['from'] == $what ) return $normalize['to'];
      }
      return false;
    }
  }

  public function query_is_exhausted () {
    return empty ( $this-&gt;states['query']['continues'] );
  }

  protected function api_query () {

    if ( is_array ( $this-&gt;states['query']['params'] ) ) {
      $this-&gt;append_params_array ( $this-&gt;states['query']['params'] );
    }
    if (&nbsp;! empty ( $this-&gt;states['query']['listparams'] ) ) {
      $this-&gt;append_params_array ( $this-&gt;states['query']['listparams'], $this-&gt;states['query']['listparams_code'] );
    }
    if ( is_array ( array_value ( $this-&gt;states, 'query.properties' ) ) ) {
      $this-&gt;append_properties ( $this-&gt;states['query']['properties'] );
    }

    if ( is_array ( $this-&gt;states['query']['continues'] ) ) {
      foreach ( $this-&gt;states['query']['continues'] as $property =&gt; $continue ) {
        if ( is_array ( $continue ) ) {
          foreach ( $continue as $propname =&gt; $token ) {
            if ( empty ( $token ) ) {
              switch ( $propname ) {
                case 'rvstartid'&nbsp;:
                  unset ( $this-&gt;params['rvstart'] ); break;
                case 'alcontinue'&nbsp;:
                  unset ( $this-&gt;params['alfrom'] ); break;
                case 'aicontinue'&nbsp;:
                  unset ( $this-&gt;params['aifrom'] ); break;
                default&nbsp;:
                  unset ( $this-&gt;params[$propname] );
              }
            } else {
              $this-&gt;params[$propname] = $token;
            }
          }
        }
      }
    }

    $result = $this-&gt;api_action_query();

    $this-&gt;states['query']['continues'] =
      ( isset ( $this-&gt;data_tree['query-continue'] )&nbsp;? $this-&gt;data_tree['query-continue']&nbsp;: NULL );

    // properties are continued to exhaustion on single-page, but not on multiple-page or list or generator requests!
    $is_single_page = empty ( $this-&gt;states['query']['listparams'] ) &amp;&amp;
         ( strpos ( '|', array_value ( $this-&gt;states, 'query.params.titles' ) ) === false ) &amp;&amp;
         ( strpos ( '|', array_value ( $this-&gt;states, 'query.params.pageids' ) ) === false ) &amp;&amp;
         ( strpos ( '|', array_value ( $this-&gt;states, 'query.params.revids' ) ) === false );

    if (&nbsp;! $is_single_page &amp;&amp; is_array ( $this-&gt;states['query']['continues'] ) ) {
      foreach ( $this-&gt;APIBOT_PAGE_PROPERTIES as $name =&gt; $prefix ) {
        unset ( $this-&gt;states['query']['continues'][$name] );
      }
    }

    if ( $is_single_page &amp;&amp; is_array ( array_value ( $this-&gt;states, 'query.properties' ) ) ) {
      foreach ( $this-&gt;states['query']['properties'] as $property =&gt; &amp;$value ) {
        if (&nbsp;! is_array ( $this-&gt;states['query']['continues'] ) ||
            &nbsp;! array_key_exists ( $property, $this-&gt;states['query']['continues'] ) ) {
          unset ( $this-&gt;states['query']['properties'][$property] );
        }
      }
    }

    return $result;
  }

  protected function api_start_query ( $params ) {
    $this-&gt;states['query']['params'] = $params;
    $this-&gt;states['query']['continues'] = NULL;
    return $this-&gt;api_query();
  }

  # --- Page queries --- #

  protected function api_query_pages ( $queryparam, $queryvalue, $properties ) {
    $this-&gt;states['query']['properties'] = $properties;
    unset ( $this-&gt;states['query']['listparams'] );
    unset ( $this-&gt;states['query']['listparams_code'] );
    return $this-&gt;api_start_query ( array ( $queryparam =&gt; $queryvalue ) );
  }

  protected function api_query_titles ( $titles, $properties = NULL ) {
    return $this-&gt;api_query_pages ( 'titles', $titles, $properties );
  }

  protected function api_query_pageids ( $pageids, $properties = NULL ) {
    return $this-&gt;api_query_pages ( 'pageids', $pageids, $properties );
  }

  protected function api_query_revids ( $revids, $properties = NULL ) {
    return $this-&gt;api_query_pages ( 'revids', $revids, $properties );
  }

  # --- List and generator queries --- #

  protected function api_query_list ( $list, $code, $listparams = NULL, $params = NULL ) {
    $this-&gt;states['query']['listparams'] = $listparams;
    $this-&gt;states['query']['listparams_code'] = $code;
    $params['list'] = $list;
    return $this-&gt;api_start_query ( $params );
  }

  protected function api_query_generator ( $generator, $code, $listparams = NULL, $properties = NULL, $params = NULL ) {
    $this-&gt;states['query']['properties'] = $properties;
    $this-&gt;states['query']['listparams'] = $listparams;
    $this-&gt;states['query']['listparams_code'] = 'g' . $code;
    $params['generator'] = $generator;
    return $this-&gt;api_start_query ( $params );
  }

  # --- Meta queries --- #

  protected function api_query_meta ( $meta ) {
    return $this-&gt;api_start_query ( array ( 'meta' =&gt; $meta ) );
  }

  protected function api_query_siteinfo ( $siprop = NULL ) {
    $this-&gt;append_param ( 'siprop', $siprop );
    return $this-&gt;api_query_meta ( &quot;siteinfo&quot; );
  }

  protected function api_query_userinfo ( $uiprop = NULL ) {
    $this-&gt;append_param ( 'uiprop', $uiprop );
    return $this-&gt;api_query_meta ( &quot;userinfo&quot; );
  }

  protected function api_query_messages ( $ammessages = NULL, $amfilter = NULL, $amlang = NULL ) {
    $this-&gt;append_param_if_nonnull ( 'ammessages', $ammessages );
    $this-&gt;append_param_if_nonnull ( 'amfilter', $amfilter );
    $this-&gt;append_param_if_nonnull ( 'amlang', $amlang );
    return $this-&gt;api_query_meta ( &quot;allmessages&quot; );
  }

  # ---------- API requests - third level ---------- #

  # ----- Obtaining tokens ----- #

  protected function api_get_token () {
    $properties = array ( 'info' =&gt; array ( 'token' =&gt; 'edit' ) );
    if ( $this-&gt;api_query_titles ( $this-&gt;wiki['general']['mainpage'], $properties ) ) {
      $pagedesc = current ( $this-&gt;data_tree['query']['pages'] );
      $this-&gt;wiki['token'] = $pagedesc['edittoken'];
      return true;
    }
    return $this-&gt;set_std_error ( 'notoken', &quot; (edit)&quot; );
  }

  protected function api_get_token_if_needed () {
    if ( empty ( $this-&gt;wiki['token'] ) ) {
      return $this-&gt;api_get_token();
    } else {
      return true;
    }
  }

  protected function api_get_rollbacktoken ( $title ) {
    $this-&gt;append_param ( 'rvtoken', &quot;rollback&quot; );
    $this-&gt;append_param ( 'prop', &quot;revisions&quot; );
    if ( $this-&gt;api_query_titles ( $title ) ) {
      $pagedesc = reset ( $this-&gt;data_tree['query']['pages'] );
      $lastrev = reset ( $pagedesc['revisions'] );
      if (&nbsp;! empty ( $lastrev['rollbacktoken'] ) ) {
        return $lastrev['rollbacktoken'];
      }
    }
    return $this-&gt;set_std_error ( 'notoken', &quot; (rollback)&quot; );
  }

  protected function api_get_userrights_token ( $user ) {
    $parameters = array ( 'ususers' =&gt; $user, 'ustoken' =&gt; &quot;userrights&quot; );
    if ( $this-&gt;api_query_list ( &quot;users&quot;, 'us', $parameters ) ) {
      $userdesc = reset ( $this-&gt;data_tree['query']['users'] );
      if (&nbsp;! empty ( $userdesc['userrightstoken'] ) ) {
        return $userdesc['userrightstoken'];
      }
    }
    return $this-&gt;set_std_error ( 'notoken', &quot; (userrights)&quot; );
  }

  # ----- Meta info ----- #

  protected function api_siteinfo_general () {
    if ( $this-&gt;api_query_siteinfo ( array ( 'general' ) ) ) {
      $this-&gt;wiki['general'] = $this-&gt;data_tree['query']['general'];
      return true;
    } else {
      return false;
    }
  }

  protected function api_siteinfo () {  // fetch paraminfo first, or you'll end with barebones siteinfo!
    $wiki_version = $this-&gt;mw_version_number();
    if ( array_key_exists ( 'paraminfo', $this-&gt;wiki ) &amp;&amp;
         array_key_exists ( 'querymodules', $this-&gt;wiki['paraminfo'] ) &amp;&amp;
         array_key_exists ( 'siteinfo', $this-&gt;wiki['paraminfo']['querymodules'] ) ) {
      $properties = $this-&gt;wiki['paraminfo']['querymodules']['siteinfo']['parameters']['prop']['type'];
    } else {
      $properties = array ( &quot;namespaces&quot;, &quot;statistics&quot;, &quot;interwikimap&quot;, &quot;dbrepllag&quot; );
    }
    if ( $this-&gt;api_query_siteinfo ( $properties ) ) {
      $this-&gt;wiki = array_merge ( $this-&gt;wiki, $this-&gt;query_tree() );
      return true;
    } else {
      return false;
    }
  }

  // Relying on obtained wiki siteinfo!
  protected function api_userinfo () {
    $wiki_version = $this-&gt;mw_version_number();
    if ( array_key_exists ( 'paraminfo', $this-&gt;wiki ) &amp;&amp;
         array_key_exists ( 'querymodules', $this-&gt;wiki['paraminfo'] ) &amp;&amp;
         array_key_exists ( 'userinfo', $this-&gt;wiki['paraminfo']['querymodules'] ) ) {
      $properties = $this-&gt;wiki['paraminfo']['querymodules']['userinfo']['parameters']['prop']['type'];
    } else {
      $properties = array ( &quot;blockinfo&quot;, &quot;hasmsg&quot;, &quot;groups&quot;, &quot;rights&quot; );
    }
    if ( $this-&gt;api_query_userinfo ( $properties ) ) {
      if ( $wiki_version &lt; 11200 ) {
        $this-&gt;user = $this-&gt;data_tree['userinfo'];
      } else {
        $this-&gt;user = $this-&gt;data_tree['query']['userinfo'];
      }
      return true;
    } else {
      return false;
    }
  }

  protected function api_messages ( $ammessages = NULL, $amfilter = NULL, $amlang = NULL ) {
    if ( $this-&gt;api_query_messages ( $ammessages, $amfilter, $amlang ) ) {
      $this-&gt;wiki['messages'] = $this-&gt;data_tree['query']['allmessages'];
      return true;
    }
    return false;
  }

  protected function web_obtain_wikitime () {
    $title = md5 ( rand() ); // make up a long random title
    if ( $this-&gt;web ( $title, &quot;edit&quot; ) ) {
      if ( preg_match ( '/\&lt;input\s[^\&gt;]*name=&quot;wpStarttime&quot;[^\&gt;]*\&gt;/U', $this-&gt;browser-&gt;content, $matches ) ) {
        if ( preg_match ( '/value=&quot;(\d+)&quot;/U', $matches[0], $matches ) ) {
          $timestr = preg_replace ( '/(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/', &quot;$1-$2-$3 $4:$5:$6&quot;, $matches[1] );
          return strtotime ( $timestr );
        }
      }
    }
    return NULL;
  }

  # ----- Paraminfo ----- #

  private function rekey_paraminfo_module_array ( &amp;$module, $arrayname ) {
    $array = array();
    if ( is_array ( $module ) &amp;&amp; array_key_exists ( $arrayname, $module ) &amp;&amp; is_array ( $module[$arrayname] ) ) {
      foreach ( $module[$arrayname] as $element ) {
        $array[$element['name']] = $element;
      }
      $module[$arrayname] = $array;
    }
  }

  private function rekey_paraminfo_module_arrays ( &amp;$module ) {
    $this-&gt;rekey_paraminfo_module_array ( $module, 'parameters' );
  }

  private function adopt_paraminfo_module ( &amp;$to_array, $from_array, $data_tree_key ) {
    $module = $from_array[$data_tree_key];
    $this-&gt;rekey_paraminfo_module_arrays ( $module );
    $to_array[$module['name']] = $module;
  }

  protected function api_paraminfo_paraminfo () {
    if ( $this-&gt;mw_version_number() &gt;= 11200 ) {
      $this-&gt;append_param ( 'modules', &quot;paraminfo&quot; );
      if ( $this-&gt;api_action_paraminfo() ) {
        $this-&gt;adopt_paraminfo_module ( $this-&gt;wiki['paraminfo']['modules'],
          $this-&gt;data_tree['paraminfo']['modules'], 0 );
        return true;
      }
    }
    return $this-&gt;set_std_error ( 'noparaminfo' );
  }

  protected function api_paraminfo_mainmodule () {
    if (&nbsp;! empty ( $this-&gt;wiki['paraminfo']['modules']['paraminfo']['parameters']['mainmodule'] ) ) {
      $this-&gt;append_param ( 'mainmodule', &quot;&quot; );
      if ( $this-&gt;api_action_paraminfo() ) {
        $this-&gt;wiki['paraminfo']['mainmodule'] =
          $this-&gt;data_tree['paraminfo']['mainmodule'];
        $this-&gt;rekey_paraminfo_module_arrays ( $this-&gt;wiki['paraminfo']['mainmodule'] );
        return true;
      }
    }
    return false;
  }

  protected function api_paraminfo_modules () {
    if ( empty ( $this-&gt;wiki['paraminfo']['mainmodule'] ) ) {
      $modules = &quot;query|login|logout|edit|move|delete|undelete|rollback|&quot; .
        &quot;protect|block|unblock|watch|emailuser|patrol|import|&quot; .
        &quot;expandtemplates|parse|upload|purge|userrights&quot;;
    } else {
      $modules = $this-&gt;barsepstring (
        $this-&gt;wiki['paraminfo']['mainmodule']['parameters']['action']['type'] );
      $modules = str_replace ( '|paraminfo', '', $modules );  // obtained in advance
    }

    if ( strpos ( $this-&gt;wiki['general']['generator'], '1.16' )&nbsp;!== false ) {
      $modules = str_replace ( '|userrights', '', $modules );  // workaround a MW 1.16 bug
    } elseif ( strpos ( $this-&gt;wiki['general']['generator'], '1.17' )&nbsp;!== false ) {
      $modules = str_replace ( '|upload', '', $modules );  // workaround a MW 1.17 bug
    }

    while ( true ) {
      $this-&gt;append_param ( 'modules', $modules );
      if (&nbsp;! empty ( $this-&gt;wiki['paraminfo']['modules']['paraminfo']['parameters']['pagesetmodule'] ) ) {
        $this-&gt;append_param ( 'pagesetmodule', &quot;&quot; );
      }

      // mainmodule is planned to be obtained in advance
      $result = $this-&gt;api_action_paraminfo();
      if (&nbsp;! empty ( $this-&gt;error['code'] ) ) {
        return false;
      } else {
        break;  // all is OK
      }

    }

    if ( $result ) {
      foreach ( $this-&gt;data_tree['paraminfo']['modules'] as $key =&gt; $module ) {
        $this-&gt;adopt_paraminfo_module ( $this-&gt;wiki['paraminfo']['modules'],
          $this-&gt;data_tree['paraminfo']['modules'], $key );
      }
      $this-&gt;wiki['paraminfo']['pagesetmodule'] = $this-&gt;data_tree['paraminfo']['pagesetmodule'];
      $this-&gt;rekey_paraminfo_module_arrays ( $this-&gt;wiki['paraminfo']['pagesetmodule'] );
    } else {
      return $this-&gt;set_std_error ( 'nopimodules' );
    }
  }

  protected function api_paraminfo_querymodules () {
    if ( empty ( $this-&gt;wiki['paraminfo']['modules']['query'] ) ) {
      $querymodules = &quot;info|revisions|links|langlinks|images|imageinfo|stashimageinfo&quot; .
        &quot;|templates|categories|extlinks|categoryinfo|duplicatefiles|globalusage&quot; .
        &quot;|allimages|allpages|alllinks|allcategories|allusers|backlinks|blocks&quot; .
        &quot;|categorymembers|deletedrevs|embeddedin|imageusage|logevents&quot; .
        &quot;|recentchanges|search|tags|usercontribs|watchlist|watchlistraw&quot; .
        &quot;|exturlusage|users|random|protectedtitles|globalblocks&quot; .
        &quot;|siteinfo|userinfo|allmessages|globaluserinfo&quot;;
    } else {
      $querymodules = $this-&gt;barsepstring (
        array_merge (
          $this-&gt;wiki['paraminfo']['modules']['query']['parameters']['prop']['type'],
          $this-&gt;wiki['paraminfo']['modules']['query']['parameters']['list']['type'],
          $this-&gt;wiki['paraminfo']['modules']['query']['parameters']['meta']['type']
        )
      );
    }
    $this-&gt;append_param ( 'querymodules', $querymodules );
    if ( $this-&gt;api_action_paraminfo() ) {
      foreach ( $this-&gt;data_tree['paraminfo']['querymodules'] as $key =&gt; $module ) {
        $this-&gt;adopt_paraminfo_module ( $this-&gt;wiki['paraminfo']['querymodules'],
          $this-&gt;data_tree['paraminfo']['querymodules'], $key );
      }
    } else {
      return $this-&gt;set_std_error ( 'nopiqmodules' );
    }
  }

  protected function api_paraminfo () {
    if ( $this-&gt;api_paraminfo_paraminfo() ) {
      $this-&gt;api_paraminfo_mainmodule();
      $this-&gt;api_paraminfo_modules();
      $this-&gt;api_paraminfo_querymodules();
    }
  }

  # ----- Login ----- #

  protected function api_login ( $user = NULL, $pass = NULL, $domain = NULL, $token = NULL ) {

    $attempts_count = 0;
    while ( $attempts_count &lt; 5 ) {
      $attempts_count += 1;

      $this-&gt;params = array ( 'lgname' =&gt; $user, 'lgpassword' =&gt; $pass );
      $this-&gt;append_param_if_nonnull ( 'lgdomain', $domain );
      $this-&gt;append_param_if_nonnull ( 'lgtoken' , $token  );
      $result = $this-&gt;api_action_login ();

      if ( $result ) {
        switch ( $this-&gt;data_tree['login']['result'] ) {
          case &quot;Success&quot;  &nbsp;: return $result;
          case &quot;NeedToken&quot;&nbsp;:
            $token = $this-&gt;data_tree['login']['token'];
            $attempts_count -= 1;
            break;
          case &quot;Throttled&quot;&nbsp;:
            $throttled_wait = ( $this-&gt;data_tree['login']['wait'] / 10 ) + 10;  // to be on the safe side
            $this-&gt;log ( &quot;Throttled - waiting for &quot; . $throttled_wait . &quot; secs...&quot;, LL_INFO );
            sleep ( $throttled_wait );
            break;
          default&nbsp;:
            return $this-&gt;set_std_error ( 'genericerror', $this-&gt;data_tree['login']['details'],
              $this-&gt;data_tree['login']['result'] );
        }
      }
    }
    return $result;
  }

  # ----- Logout ----- #

  protected function api_logout () {
    return $this-&gt;api_action_logout();
  }

  # ----- Edit ----- #

  protected function web_edit ( $timestamp, $fetchtimestamp,
    $title, $text, $section, $summary, $isminor = NULL, $bot = true,
    $watch = 'preferences', $recreate = false ) {

    $this-&gt;api_get_token_if_needed();

    $edittime  = preg_replace ( '/[\-\s\:TZ]/', '', $timestamp );
    $starttime = preg_replace ( '/[\-\s\:TZ]/', '', $fetchtimestamp );

    if ( $watch === true ) { $watch = 'watch'; }
    elseif ( $watch === false ) { $watch = 'unwatch'; }

    $vars = array(
      'wpEditToken'   =&gt; $this-&gt;wiki['token'],
      'wpTextbox1'    =&gt; $text,
      'wpSummary'     =&gt; $summary,
      'wpStarttime'   =&gt; $starttime,
      'wpEdittime'    =&gt; $edittime,
      'wpSection'     =&gt; $section,
      'wpWatchthis'   =&gt; $watch,
      'wpIgnoreBlankSummary' =&gt; 1,  // accept edit even if summary is blank or not changed
#      'wpAutoSummary' =&gt; md5 ( $summary ),  // does not make any difference
#      'wpScrolltop'   =&gt; 0,  // does not make any difference
    );
    $vars['wpMinoredit'] = ( $isminor &nbsp;? 1&nbsp;: 0 );
    $vars['wpRecreate' ] = ( $recreate&nbsp;? 1&nbsp;: 0 );

    if ( $this-&gt;web ( $title, &quot;submit&quot;, $vars ) ) {
      if (&nbsp;! preg_match ('/content *= *&quot;noindex,nofollow&quot;/Uus', $this-&gt;browser-&gt;content ) ) {
        return true;
      } else {
        if ( strpos ( $this-&gt;browser-&gt;content, 'pt-login' )&nbsp;!== false ) {
          $this-&gt;set_std_error ( 'notloggedin' );
        } elseif ( preg_match ( '/\&lt;textarea [^\&gt;]*id=[\'\&quot;]wpTextbox2[\'\&quot;]/Uus', $this-&gt;browser-&gt;content, $matches ) ) {
          $this-&gt;set_std_error ( 'editconflict' );
        } elseif ( preg_match ( '/\&lt;input [^\&gt;]*id=[\'\&quot;]wpRecreate[\'\&quot;]/Uus', $this-&gt;browser-&gt;content, $matches ) ) {
          $this-&gt;set_std_error ( 'pagedeleted' );
        } else {
          $this-&gt;set_std_error ( 'unknownreason' );
        }
        return false;
      }
    } else {
      return false;
    }
  }

  protected function api_edit ( $basetimestamp, $starttimestamp,
    $title, $text, $section, $summary, $isminor = NULL, $bot = true,
    $watch = 'preferences', $createonly = false, $nocreate = false ) {

    if ( $this-&gt;mw_version_and_token_ok ( 11303 ) ) {
      $this-&gt;append_param_if_nonnull ( &quot;basetimestamp&quot;, $basetimestamp );
      $this-&gt;append_param_if_nonnull ( &quot;starttimestamp&quot;, $starttimestamp );
      $this-&gt;append_param ( &quot;title&quot;, $title );
      $this-&gt;append_param ( &quot;text&quot;, $text );
      $this-&gt;append_param ( &quot;summary&quot;, $summary );
      $this-&gt;append_param_if_nonnull ( &quot;section&quot;, $section );
      if ( $isminor === true ) {
        $this-&gt;append_param ( &quot;minor&quot; );
      } elseif ( $isminor === false ) {
        $this-&gt;append_param ( &quot;notminor&quot; );
      }
      if ( $bot ) {
        $this-&gt;append_param ( &quot;bot&quot; );
      }
//      $this-&gt;append_param ( &quot;md5&quot;, md5 ( $page-&gt;text ) );  // couldn't get it working - 2009-10-05
      if (&nbsp;! empty ( $watch ) ) { $this-&gt;append_param ( $watch ); }
      $this-&gt;append_param ( &quot;recreate&quot; );  // useful - a bot should know well.
      if ( $createonly ) { $this-&gt;append_param ( &quot;createonly&quot; ); }
      if ( $nocreate   ) { $this-&gt;append_param ( &quot;nocreate&quot;   ); }

      return $this-&gt;api_action_edit();
    } else {
      return false;
    }
  }

  protected function api_undo ( $basetimestamp, $title, $revert_revid, $to_revid = NULL, $summary = NULL, $bot = true ) {
    if ( $this-&gt;mw_version_and_token_ok ( 11303 ) ) {
      $this-&gt;append_param_if_nonnull ( &quot;basetimestamp&quot;, $basetimestamp );
      $this-&gt;append_param ( &quot;title&quot;, $title );
      $this-&gt;append_param ( &quot;summary&quot;, $summary );
      $this-&gt;append_param ( &quot;undo&quot;, $revert_revid );
      $this-&gt;append_param_if_nonnull ( &quot;undoafter&quot;, $to_revid );
      $this-&gt;append_param_if_true ( &quot;bot&quot;, $bot );
      $this-&gt;append_param ( &quot;recreate&quot; );  // useful - a bot should know well.

      return $this-&gt;api_action_edit();
    } else {
      return false;
    }
  }

  # ----- Move ----- #

  protected function api_move ( $from, $to, $reason = NULL, $noredirect = false, $movetalk = true ) {
    if ( $this-&gt;mw_version_and_token_ok ( 11200 ) ) {
      $this-&gt;append_param ( &quot;from&quot;, $from );
      $this-&gt;append_param ( &quot;to&quot;, $to );
      $this-&gt;append_param ( &quot;reason&quot;, $reason );
      $this-&gt;append_param_if_true ( &quot;noredirect&quot;, $noredirect );
      $this-&gt;append_param_if_true ( &quot;movetalk&quot;, $movetalk );

      return $this-&gt;api_action_move();
    } else {
      return false;
    }
  }

  # ----- Delete ----- #

  protected function web_delete ( $title, $reason = NULL ) {
    $vars = array (
      'wpReason'    =&gt; $reason,
      'wpConfirmB'  =&gt; 1,
      'wpEditToken' =&gt; $this-&gt;wiki['token'],
    );
    if ( $this-&gt;web ( $title, &quot;delete&quot;, $vars ) ) {
      if ( preg_match ( '/\&lt;div\s+[^\&gt;]*class=&quot;permissions-errors&quot;/Usi', $this-&gt;browser-&gt;content ) ) {
        $this-&gt;set_std_error ( 'permissiondenied' );
      } else {
        return true;
      }
    }
    return false;
  }

  protected function api_delete ( $title, $reason = NULL ) {
    if ( $this-&gt;mw_version_and_token_ok ( 11200 ) ) {
      $this-&gt;append_param ( &quot;title&quot; , $title );
      $this-&gt;append_param ( &quot;reason&quot;, $reason );

      return $this-&gt;api_action_delete();
    } else {
      return false;
    }
  }

  # ----- Undelete ----- #

  protected function api_undelete ( $title, $reason = NULL, $timestamps = NULL ) {
    if ( $this-&gt;mw_version_and_token_ok ( 11200 ) ) {
      $this-&gt;append_param ( &quot;title&quot;, $title );
      $this-&gt;append_param ( &quot;reason&quot;, $reason );
      $this-&gt;append_param ( &quot;timestamps&quot;, $this-&gt;barsepstring ( $timestamps ) );

      return $this-&gt;api_action_undelete();
    } else {
      return false;
    }
  }

  # ----- Rollback ----- #

  protected function api_rollback ( $title, $user, $summary = NULL, $bot = true, $token = NULL ) {
    if ( $this-&gt;mw_version_number() &gt;= 11200 ) {
      if ( is_null ( $token ) ) {
        $token = $this-&gt;api_get_rollbacktoken ( $title );
      }
      if ( $token === false ) {
        return $this-&gt;set_std_error ( 'notoken', &quot; (rollback)&quot; );
      } else {
        $this-&gt;append_param ( &quot;token&quot;, $token );
        $this-&gt;append_param ( &quot;title&quot;, $title );
        $this-&gt;append_param ( &quot;user&quot;, $user );
        $this-&gt;append_param ( &quot;summary&quot;, $summary );
        $this-&gt;append_param_if_true ( &quot;markbot&quot;, $bot );

        return $this-&gt;api_action_rollback();
      }
    } else {
      return false;
    }
  }

  # ----- Protect ----- #

  protected function api_protect ( $title, $protections, $expiry = NULL, $reason = NULL, $cascade = false ) {
    if ( $this-&gt;mw_version_and_token_ok ( 11200 ) ) {
      $this-&gt;append_param ( &quot;title&quot;, $title );
      $this-&gt;append_param ( &quot;protections&quot;, $this-&gt;keyequals_barsepstring ( $protections ) );
      $this-&gt;append_param ( &quot;expiry&quot;, $expiry );
      $this-&gt;append_param ( &quot;reason&quot;, $reason );
      $this-&gt;append_param_if_true ( &quot;cascade&quot;, $cascade );

      return $this-&gt;api_action_protect();
    } else {
      return false;
    }
  }

  # ----- Block ----- #

  protected function web_block ( $user, $expiry = &quot;never&quot;, $reason = NULL, $anononly = false, $nocreate = false, $autoblock = false, $noemail = false ) {
    $this-&gt;api_get_token_if_needed();

    $vars = array(
      'wpEditToken'       =&gt; $this-&gt;wiki['token'],
      'wpBlockAddress'    =&gt; $user,
      'wpBlockExpiry'     =&gt; &quot;other&quot;,
      'wpBlockOther'      =&gt; $expiry,
      'wpBlockReasonList' =&gt; &quot;other&quot;,
      'wpBlockReason'     =&gt; $reason,
      'wpAnonOnly'        =&gt; ( $anononly &nbsp;? &quot;1&quot;&nbsp;: &quot;&quot; ),
      'wpCreateAccount'   =&gt; ( $nocreate &nbsp;? &quot;1&quot;&nbsp;: &quot;&quot; ),
      'wpEnableAutoblock' =&gt; ( $autoblock&nbsp;? &quot;1&quot;&nbsp;: &quot;&quot; ),
      'wpEmailBan'        =&gt; ( $noemail  &nbsp;? &quot;1&quot;&nbsp;: &quot;&quot; ),
    );

    if ( $this-&gt;web ( &quot;Special:Blockip&quot;, &quot;submit&quot;, $vars ) ) {
      if ( preg_match ( '/\&lt;a +href=[^\&gt;]+\:Contributions\/[^\&gt;]+\:Contributions/U', $this-&gt;browser-&gt;content ) ) {  // todo! check with failing blocks!
        return true;
      } else {
        if ( strpos ( $this-&gt;browser-&gt;content, 'pt-login' )&nbsp;!== false ) {  // todo! check with failing blocks!
          $this-&gt;set_std_error ( 'notloggedin' );
        } else {
          $this-&gt;set_std_error ( 'unknownreason' );
        }
        return false;
      }
    } else {
      return false;
    }
  }

  protected function api_block ( $user, $expiry = &quot;never&quot;, $reason = NULL, $anononly = false, $nocreate = false, $autoblock = false, $noemail = false ) {
    if ( $this-&gt;mw_version_and_token_ok ( 11200 ) ) {
      $this-&gt;append_param ( &quot;user&quot;, $user );
      $this-&gt;append_param ( &quot;expiry&quot;, $expiry );
      $this-&gt;append_param ( &quot;reason&quot;, $reason );
      $this-&gt;append_param_if_true ( &quot;anononly&quot; , $anononly  );
      $this-&gt;append_param_if_true ( &quot;nocreate&quot; , $nocreate  );
      $this-&gt;append_param_if_true ( &quot;autoblock&quot;, $autoblock );
      $this-&gt;append_param_if_true ( &quot;noemail&quot;  , $noemail   );

      return $this-&gt;api_action_block();
    } else {
      return false;
    }
  }

  # ----- Unblock ----- #

  protected function web_unblock ( $user, $block_id, $reason = NULL ) {
    $this-&gt;api_get_token_if_needed();

    $vars = array(
      'wpEditToken'      =&gt; $this-&gt;wiki['token'],
      'wpUnblockAddress' =&gt; $user,
//      'id'               =&gt; $block_id,  // not used in the web unblock
      'wpUnblockReason'  =&gt; $reason,
    );

    if ( $this-&gt;web ( &quot;Special:Ipblocklist&quot;, &quot;submit&quot;, $vars ) ) {
      if ( preg_match ( '/\&lt;div +id *= *&quot;contentSub&quot;\&gt;.*\&lt;a href=[^\&gt;]+\:' . $user .
        '[^\&gt;]*title=&quot;[^\&gt;]*\:' . $user . '&quot;[^\&gt;]*\&gt;' . $user . '\&lt;\/a\&gt;/U',
        $this-&gt;browser-&gt;content ) ) {

        return true;
      } else {
        if ( strpos ( $this-&gt;browser-&gt;content, 'pt-login' )&nbsp;!== false ) {
          $this-&gt;set_std_error ( 'notloggedin' );
        } else {
          $this-&gt;set_std_error ( 'unknownreason' );
        }
        return false;
      }
    } else {
      return false;
    }
  }

  protected function api_unblock ( $user, $block_id, $reason = NULL ) {
    if ( $this-&gt;mw_version_and_token_ok ( 11200 ) ) {
      if ( empty ( $user ) ) {
        if ( empty ( $block_id ) ) {
          return $this-&gt;set_std_error ( 'noblockidoruser' );
        } else {
          $this-&gt;append_param ( &quot;id&quot;, $block_id );
        }
      } else {
        $this-&gt;append_param ( &quot;user&quot;, $user );
      }
      $this-&gt;append_param ( &quot;reason&quot;, $reason );

      return $this-&gt;api_action_unblock();
    } else {
      return false;
    }
  }

  # ----- Watch ----- #

  protected function api_watch ( $title, $watch = true ) {
    if ( $this-&gt;mw_version_number() &gt;= 11400 ) {
      $this-&gt;append_param ( &quot;title&quot;, $title );
      $this-&gt;append_param_if_true ( &quot;unwatch&quot;, (&nbsp;! $watch ) );
      return $this-&gt;api_action_watch();
    } else {
      return false;
    }
  }

  # ----- Emailuser ----- #

  protected function api_emailuser ( $target, $subject, $text, $ccme = false ) {
    if ( $this-&gt;mw_version_and_token_ok ( 11400 ) ) {
      $this-&gt;append_param ( &quot;target&quot; , $target );  // the user you are sending email to
      $this-&gt;append_param ( &quot;subject&quot;, $subject );
      $this-&gt;append_param ( &quot;text&quot;   , $text );
      $this-&gt;append_param_if_true ( &quot;ccme&quot;, $ccme );
      return $this-&gt;api_action_emailuser();
    } else {
      return false;
    }
  }

  # ----- Patrol ----- #

  protected function web_patrol ( $rcid ) {
    if ( $this-&gt;web ( NULL, &quot;markpatrolled&quot;, array ( 'rcid' =&gt; $rcid ) ) ) {
      if ( preg_match ( '/\&lt;div\s+[^\&gt;]*class=&quot;permissions-errors&quot;/Usi', $this-&gt;browser-&gt;content ) ) {
        $this-&gt;set_std_error ( 'permissiondenied' );
      } else {
        return true;
      }
    }
    return false;
  }

  protected function api_patrol ( $rcid ) {
    $this-&gt;append_param ( &quot;rcid&quot; , $rcid );
    return $this-&gt;api_action_patrol();
  }

  # ----- Import ----- #

  protected function api_import_interwiki ( $title, $iwcode, $summary, $fullhistory = true, $into_namespace = NULL, $templates = false ) {
    if ( $this-&gt;mw_version_and_token_ok ( 11500 ) ) {
      $this-&gt;append_param ( 'interwikititle' , $title );
      $this-&gt;append_param ( 'interwikisource' , $iwcode );
      $this-&gt;append_param ( 'summary' , $summary );
      $this-&gt;append_param_if_nonnull ( $into_namespace );
      $this-&gt;append_param_if_true ( 'fullhistory' , $fullhistory );
      $this-&gt;append_param_if_true ( 'templates'   , $templates   );
      return $this-&gt;api_action_import();
    } else {
      return false;
    }
  }

  protected function api_import_xml ( $xml_upload, $summary ) {
    if ( $this-&gt;mw_version_and_token_ok ( 11500 ) ) {
      $this-&gt;append_param ( 'xml' , $xml_upload );
      $this-&gt;append_param ( 'summary' , $summary );
      return $this-&gt;api_action_import();
    } else {
      return false;
    }
  }

  # ----- Userrights ----- #

  protected function web_userrights ( $user, $add_groups, $remove_groups, $reason ) {  // todo! test it!
    $this-&gt;api_get_token_if_needed();

    $vars = array(
      'wpEditToken'   =&gt; $this-&gt;wiki['token'],
      'user'          =&gt; $user,
      'available'     =&gt; $add_groups,
      'removable'     =&gt; $remove_groups,
      'user-reason'   =&gt; $reason,
    );

    if ( $this-&gt;web ( &quot;Special:Userrights&quot;, &quot;submit&quot;, $vars ) ) {
      if (&nbsp;! preg_match ('/content *= *&quot;noindex,nofollow&quot;/', $this-&gt;browser-&gt;content ) ) {
        return true;
      } else {
        if ( strpos ( $this-&gt;browser-&gt;content, 'pt-login' )&nbsp;!== false ) {
          $this-&gt;set_std_error ( 'notloggedin' );
        } else {
          $this-&gt;set_std_error ( 'unknownreason' );
        }
        return false;
      }
    } else {
      return false;
    }
  }

  protected function api_userrights ( $user, $add_groups, $remove_groups, $reason ) {
    if ( $this-&gt;mw_version_and_token_ok ( 11600 ) ) {
      $token = $this-&gt;api_get_userrightstoken ( $user );
      if (&nbsp;! ( $token === false ) ) {
        $this-&gt;append_param ( 'token' , $token );
        $this-&gt;append_param ( 'user'  , $user );
        $this-&gt;append_param ( 'add'   , $this-&gt;barsepstring ( $add_groups    ) );
        $this-&gt;append_param ( 'remove', $this-&gt;barsepstring ( $remove_groups ) );
        $this-&gt;append_param ( 'reason', $reason );
        return $this-&gt;api_action_userrights();
      } else {
        return $this-&gt;set_std_error ( 'notoken', &quot; (userrights)&quot; );
      }
    } else {
      return false;
    }
  }

  # ----- Expandtemplates ----- #

  protected function api_expandtemplates ( $text, $title = NULL ) {
    if ( $this-&gt;mw_version_and_token_ok ( 11200 ) ) {
      $this-&gt;append_param ( 'text', $text );
      $this-&gt;append_param_if_nonnull ( 'title', $title );
      return $this-&gt;api_action_expandtemplates();
    } else {
      return false;
    }
  }

  # ----- Parse ----- #

  protected function api_parse_text ( $text, $title = NULL, $properties = NULL, $pst = true, $uselang = NULL ) {
    if ( $this-&gt;mw_version_and_token_ok ( 11200 ) ) {
      $this-&gt;append_param ( 'text', $text );
      $this-&gt;append_param_if_nonnull ( 'title', $title );
      $this-&gt;append_param_if_nonnull ( 'prop' , $properties );
      $this-&gt;append_param_if_true ( 'pst', $pst );
      $this-&gt;append_param_if_nonnull ( 'uselang', $uselang );
      return $this-&gt;api_action_parse();
    } else {
      return false;
    }
  }

  protected function api_parse_page ( $title, $properties = NULL, $uselang = NULL ) {
    if ( $this-&gt;mw_version_and_token_ok ( 11200 ) ) {
      $this-&gt;append_param ( 'page', $title );
      $this-&gt;append_param_if_nonnull ( 'prop' , $properties );
      $this-&gt;append_param_if_nonnull ( 'uselang', $uselang );
      return $this-&gt;api_action_parse();
    } else {
      return false;
    }
  }

  # ----- Upload ----- #

  protected function web_upload_file ( $file, $text, $comment, $target_filename, $watch = false, $ignorewarnings = false ) {
    $this-&gt;api_get_token_if_needed();
    $vars = array(
      'wpUploadFile'        =&gt; &quot;@&quot; . $file,
      'wpSourceType'        =&gt; &quot;file&quot;,
      'wpDestFile'          =&gt; $target_filename,
      'wpUploadDescription' =&gt; $text,
      'wpLicense'           =&gt; &quot;&quot;,  // the API does not (yet) provide a documented param for this
      'wpComment'           =&gt; $comment,  // is this processed at all?
      'wpWatchthis'         =&gt; ( $watch&nbsp;? '1'&nbsp;: '0' ),
      'wpIgnoreWarning'     =&gt; ( $ignorewarnings&nbsp;? '1'&nbsp;: '0' ),
      'wpEditToken'         =&gt; $this-&gt;wiki['token'],
      'wpUpload'            =&gt; &quot;Upload&quot;,
    );

    if ( $this-&gt;web ( &quot;Special:Upload&quot;, &quot;submit&quot;, $vars ) ) {
      if ( preg_match ( '/\&lt;ul/s+class=&quot;warning&quot;[^\&gt;]*\&gt;/Us', $this-&gt;browser_content, $matches ) ) {
        $this-&gt;log ( &quot;Some warnings resulted during the web-mode upload of '&quot; . $file . &quot;'!&quot;, LL_WARNING );
      }
      return true;
    } else {
      return false;
    }
  }

  protected function api_upload_file ( $file, $text, $comment, $target_filename, $watch = false, $ignorewarnings = true ) {
    if ( $this-&gt;mw_version_and_token_ok ( 11600 ) ) {
      $this-&gt;append_param ( 'filename', $target_filename );
      $this-&gt;append_param ( 'comment', $comment );
      $this-&gt;append_param ( 'text', $text );
      $this-&gt;append_param_if_true ( 'watch', &quot;&quot; );
      $this-&gt;append_param_if_true ( 'ignorewarnings', &quot;&quot; );
      $this-&gt;append_fileparam ( 'file', $file );
      return $this-&gt;api_action_upload();
    } else {
      return false;
    }
  }

  protected function api_upload_url ( $URL, $text, $comment, $target_filename, $watch = false, $ignorewarnings = true ) {
    if ( $this-&gt;mw_version_and_token_ok ( 11600 ) ) {
      $this-&gt;append_param ( 'filename', $target_filename );
      $this-&gt;append_param ( 'comment', $comment );
      $this-&gt;append_param ( 'text', $text );
      $this-&gt;append_param_if_true ( 'watch', &quot;&quot; );
      $this-&gt;append_param_if_true ( 'ignorewarnings', &quot;&quot; );
      $this-&gt;append_param ( 'url', $URL );
      return $this-&gt;api_action_upload();
    } else {
      return false;
    }
  }

  protected function api_upload_sessionkey ( $filename, $sessionkey, $httpstatus = NULL, $ignorewarnings = true ) {
    if ( $this-&gt;mw_version_and_token_ok ( 11600 ) ) {
      $this-&gt;append_param ( 'filename', $filename );
      $this-&gt;append_param ( 'sessionkey', $sessionkey );
      $this-&gt;append_param_if_true ( 'ignorewarnings', $ignorewarnings );
      $this-&gt;append_param_if_nonnull ( 'httpstatus', $httpstatus );
      return $this-&gt;api_action_upload();
    } else {
      return false;
    }
  }

  # ----- Purge ----- #

  protected function api_purge ( $titles ) {
    if ( $this-&gt;mw_version_and_token_ok ( 11400 ) ) {
      $this-&gt;append_param ( 'titles', $this-&gt;barsepstring ( $titles ) );
      return $this-&gt;api_action_purge();
    } else {
      return false;
    }
  }

  # ---------- Obtaining initial info ---------- #

  # ----- Overlaying the API calls ----- #

  protected function fetch_wikiinfo_general () {
    if ( $this-&gt;api_siteinfo_general () ) {
      $this-&gt;wiki['general']['time'] =
        substr ( $this-&gt;wiki['general']['time'], 0, 10 ) . &quot; &quot; .
        substr ( $this-&gt;wiki['general']['time'], 11, 8 );
      $this-&gt;wiki['general']['timediff'] = strtotime ( $this-&gt;wiki['general']['time'] ) - $this-&gt;browser-&gt;lastreq_time();
      $this-&gt;log ( &quot;Connected to: &quot; . $this-&gt;wiki_name() . &quot; (&quot; . $this-&gt;wiki_generator() . &quot;)&quot;, LL_DEBUG );
      return true;
    } else {
      $this-&gt;log ( &quot;Could not obtain general wiki info for &quot; . $this-&gt;login['wiki']['name'] . &quot;!&quot;, LL_WARNING );
      return false;
    }
  }

  protected function fetch_paraminfo () {
    $this-&gt;api_paraminfo();
    return $this-&gt;log_status ( &quot;Obtained wiki paraminfo&quot;,
      &quot;Could not obtain wiki paraminfo: \$info&quot;, LL_DEBUG, LL_ERROR );
  }

  protected function fetch_wikiinfo () {
    $wiki_general = $this-&gt;wiki['general'];
    if ( $this-&gt;api_siteinfo () ) {
      if (&nbsp;! empty ( $wiki_general ) ) $this-&gt;wiki['general'] = $wiki_general;
      $wikiprops = implode ( &quot;, &quot;, array_keys ( $this-&gt;wiki ) );
      $this-&gt;log ( &quot;Wiki info obtained: &quot; . $wikiprops, LL_DEBUG );
      return true;
    } else {
      $this-&gt;log ( &quot;Could not obtain wiki info for &quot; . $this-&gt;login['wiki']['name'] . &quot;!&quot;, LL_WARNING );
      return false;
    }

  }

  private function obtain_wikiinfo_error () {
    $this-&gt;log ( &quot;Could not obtain the wiki info; working may create a mess! Should not continue...&quot;, LL_PANIC );
    die();
  }

  protected function fetch_wikiinfo_or_die () {
    if ( $this-&gt;fetch_wikiinfo_general() &amp;&amp; $this-&gt;fetch_paraminfo() &amp;&amp; $this-&gt;fetch_wikiinfo() ) {
      return true;
    } else {
      return $this-&gt;obtain_wikiinfo_error();
    }
  }

  protected function fetch_userinfo () {
    if ( $this-&gt;api_userinfo () ) {
      $this-&gt;log ( &quot;Entered as: &quot; . $this-&gt;user['name'], LL_DEBUG );
      $userprops = &quot;&quot;;
      foreach ( $this-&gt;user as $infoname =&gt; $contents ) {
        if (&nbsp;! empty ( $userprops ) ) { $userprops .= ', '; }
        $userprops .= $infoname;
      }
      $this-&gt;log ( &quot;User info obtained: &quot; . $userprops, LL_DEBUG );
      return true;

    } else {
      $this-&gt;log ( &quot;Could not obtain user info for me on &quot; . $this-&gt;login['wiki']['name'] . &quot;!&quot;, LL_WARNING );
    }
    return false;
  }

  private function obtain_userinfo_error () {
    $this-&gt;log ( &quot;Could not obtain the user info; working may create a mess! Should not continue...&quot;, LL_PANIC );
    die();
  }

  protected function fetch_userinfo_or_die () {
    if ( $this-&gt;fetch_userinfo() ) {
      return true;
    } else {
      return $this-&gt;obtain_userinfo_error();
    }
  }

  protected function fetch_messages ( $lang = NULL ) {
    $this-&gt;api_messages ( NULL, NULL, $lang );
    if (&nbsp;! is_null ( $lang ) ) {
      $translated_to_addon = &quot; (translated to &quot; . $lang . &quot;)&quot;;
    }
    return $this-&gt;log_status ( &quot;Obtained wiki message strings&quot; . $translated_to_addon,
      &quot;Could not obtain wiki message strings&quot; . $translated_to_addon . &quot;: \$info&quot; );
  }

  # ----- Handling infofiles ----- #

  protected function infofile_name ( $filename, $extension ) {
    return $this-&gt;bot_params['workfiles_path'] . &quot;/&quot; . $filename . &quot;.&quot; . $extension;
  }

  protected function infofile_expired ( $filename, $extension, $expiry_period ) {
    $filetime = filemtime ( $this-&gt;infofile_name ( $filename, $extension ) );
    return ( time() - $filetime &gt; $expiry_period );
  }

  protected function read_infofile ( $filename, $extension ) {
    $file = $this-&gt;infofile_name ( $filename, $extension );
    if ( file_exists ( $file ) ) {
      $result = unserialize ( file_get_contents ( $file ) );
      if ( $result ) {
        $this-&gt;log ( &quot;Read infofile &quot; . $file, LL_DEBUG );
      }
      return $result;
    } else {
      $this-&gt;log ( &quot;Infofile &quot; . $file . &quot; does not exist!&quot;, LL_DEBUG );
      return false;
    }
  }

  protected function write_infofile ( $filename, $extension, $value ) {
    if (&nbsp;! file_exists ( $this-&gt;bot_params['workfiles_path'] ) ) {
      if (&nbsp;! mkdir ( $this-&gt;bot_params['workfiles_path'], '0755', true ) ) {
        $this-&gt;log ( &quot;Cannot create workfiles path &quot; . $this-&gt;bot_params['workfiles_path'] . &quot; - will not store infofiles!&quot;, LL_WARNING );
        return false;
      }
    }
    $file = $this-&gt;infofile_name ( $filename, $extension );
    if ( file_put_contents ( $file, serialize ( $value ) ) ) {
      $this-&gt;log ( &quot;Wrote infofile &quot; . $file, LL_DEBUG );
      return true;
    } else {
      $this-&gt;log ( &quot;Cannot create infofile &quot; . $file . &quot; - will not store this info!&quot;, LL_WARNING );
      return false;
    }
  }

  protected function fetch_wikiinfo_and_write ( $filename, $extension = &quot;wikiinfo&quot; ) {
    if ( $this-&gt;fetch_wikiinfo_or_die() ) {
      return $this-&gt;write_infofile ( $filename, $extension, $this-&gt;wiki );
    } else {
      return true;
    }
  }

  protected function fetch_userinfo_and_write ( $filename, $extension = &quot;userinfo&quot; ) {
    if ( $this-&gt;fetch_userinfo_or_die() ) {
      return $this-&gt;write_infofile ( $filename, $extension, $this-&gt;user );
    } else {
      return true;
    }
  }

  # ----- Obtaining all initial info ----- #

  protected function obtain_wikiinfo () {
    $filename  = $this-&gt;login['wiki']['name'];
    $extension = &quot;wikiinfo&quot;;

    if ( ( $this-&gt;bot_params['fetch_wikiinfo'] === true ) || ( $this-&gt;bot_params['fetch_wikiinfo'] == &quot;always&quot; ) ) {
      return $this-&gt;fetch_wikiinfo_or_die();

    } elseif ( $this-&gt;bot_params['fetch_wikiinfo'] == &quot;this_time&quot; ) {
      return $this-&gt;fetch_wikiinfo_and_write ( $filename, $extension );

    } elseif ( $this-&gt;bot_params['fetch_wikiinfo'] == &quot;on_newversion&quot; ) {
      if ( $this-&gt;fetch_wikiinfo_general() ) {
        $wikiinfo = $this-&gt;read_infofile ( $filename, $extension );
        if ( ( $this-&gt;wiki_generator()&nbsp;!== $wikiinfo['general']['generator'] ) ||
             $this-&gt;infofile_expired ( $filename, $extension, $this-&gt;bot_params['fetched_wikiinfo_expiry'] ) ) {
          $this-&gt;log ( &quot;Wiki software version is different, or stored wiki data expired or not found - re-fetching wiki info...&quot;, LL_INFO );
          if ( $this-&gt;fetch_paraminfo() &amp;&amp; $this-&gt;fetch_wikiinfo() ) {
            $this-&gt;bot_params['fetch_userinfo'] = &quot;this_time&quot;;
            return $this-&gt;write_infofile ( $filename, $extension, $this-&gt;wiki );
          } else {
            return $this-&gt;obtain_wikiinfo_error();
          }
        } else {
          $wiki_general = $this-&gt;wiki['general'];
          $this-&gt;wiki = $wikiinfo;
          $this-&gt;wiki['general'] = $wiki_general;
          return true;
        }
      } else {
        return $this-&gt;obtain_wikiinfo_error();
      }

    } elseif ( $this-&gt;bot_params['fetch_wikiinfo'] == &quot;on_newrevision&quot; ) {
      if ( $this-&gt;fetch_wikiinfo_general() ) {
        $wikiinfo = $this-&gt;read_infofile ( $filename, $extension );
        if ( ( $this-&gt;wiki_revision()&nbsp;!== $wikiinfo['general']['rev'] ) ||
             $this-&gt;infofile_expired ( $filename, $extension, $this-&gt;bot_params['fetched_wikiinfo_expiry'] ) ) {
          $this-&gt;log ( &quot;Wiki software revision is different, or stored wiki data expired or not found - re-fetching wiki info...&quot;, LL_INFO );
          if ( $this-&gt;fetch_paraminfo() &amp;&amp; $this-&gt;fetch_wikiinfo() ) {
            $this-&gt;bot_params['fetch_userinfo'] = &quot;this_time&quot;;
            return $this-&gt;write_infofile ( $filename, $extension, $this-&gt;wiki );
          } else {
            return $this-&gt;obtain_wikiinfo_error();
          }
        } else {
          $wiki_general = $this-&gt;wiki['general'];
          $this-&gt;wiki = $wikiinfo;
          $this-&gt;wiki['general'] = $wiki_general;
          return true;
        }
      } else {
        return $this-&gt;obtain_wikiinfo_error();
      }

    } elseif ( $this-&gt;bot_params['fetch_wikiinfo'] == &quot;on_expiry&quot; ) {
      if ( $this-&gt;infofile_expired ( $filename, $extension, $this-&gt;bot_params['fetched_wikiinfo_expiry'] ) ) {
        return $this-&gt;fetch_wikiinfo_and_write ( $filename, $extension );
      }

    } elseif ( $this-&gt;bot_params['fetch_wikiinfo'] == &quot;if_missing&quot; ) {
      $this-&gt;wiki = $this-&gt;read_infofile ( $filename, $extension );
      if ( $this-&gt;wiki === false ) {
        return $this-&gt;fetch_wikiinfo_and_write ( $filename, $extension );
      } else {
        return $this-&gt;fetch_wikiinfo_general();
      }

    } elseif ( $this-&gt;bot_params['fetch_wikiinfo'] == &quot;never&quot; ) {
      $this-&gt;wiki = $this-&gt;read_infofile ( $filename, $extension );
      if ( $this-&gt;wiki === false ) {
        if (&nbsp;! $this-&gt;fetch_wikiinfo_general() ) {
          return $this-&gt;obtain_wikiinfo_error();
        }
      }
      return true;

    } elseif ( $this-&gt;bot_params['fetch_wikiinfo'] == &quot;not_needed&quot; ) {  // DANGEROUS!
      return true;

    } else {
      $this-&gt;log ( &quot;Illegal setting for fetching wiki info - exitting!&quot;, LL_PANIC );
      die();
    }

    return true;
  }

  protected function obtain_userinfo () {
    $filename  = $this-&gt;login['user'] . &quot;@&quot; . $this-&gt;login['wiki']['name'];
    $extension = &quot;userinfo&quot;;

    if ( ( $this-&gt;bot_params['fetch_userinfo'] === true ) || ( $this-&gt;bot_params['fetch_userinfo'] == &quot;always&quot; ) ) {
      return $this-&gt;fetch_userinfo_or_die();

    } elseif ( ( $this-&gt;bot_params['fetch_userinfo'] === true ) || ( $this-&gt;bot_params['fetch_userinfo'] == &quot;this_time&quot; ) ) {
      return $this-&gt;fetch_userinfo_and_write ( $filename, $extension );

    } elseif ( $this-&gt;bot_params['fetch_userinfo'] == &quot;on_expiry&quot; ) {
      if ( $this-&gt;infofile_expired ( $filename, $extension, $this-&gt;bot_params['fetched_userinfo_expiry'] ) ) {
        return $this-&gt;fetch_userinfo_and_write ( $filename, $extension );
      } else {
        $this-&gt;user = $this-&gt;read_infofile ( $filename, $extension );
      }

    } elseif ( $this-&gt;bot_params['fetch_userinfo'] == &quot;if_missing&quot; ) {
      $this-&gt;user = $this-&gt;read_infofile ( $filename, $extension );
      if ( $this-&gt;user === false ) {
        return $this-&gt;fetch_userinfo_and_write ( $filename, $extension );
      }

    } elseif ( $this-&gt;bot_params['fetch_userinfo'] == &quot;never&quot; ) {
      $this-&gt;user = $this-&gt;read_infofile ( $filename, $extension );
      if ( $this-&gt;user === false ) {
        return $this-&gt;obtain_userinfo_error();
      } else {
        return true;
      }

    } elseif ( $this-&gt;bot_params['fetch_userinfo'] == &quot;not_needed&quot; ) {
      return true;  // DANGEROUS!

    } else {
      $this-&gt;log ( &quot;Illegal setting for fetching user info - exitting!&quot;, LL_PANIC );
      die();
    }

    return true;
  }

  protected function obtain_initial_info () {
    $this-&gt;obtain_wikiinfo();
    $this-&gt;obtain_userinfo();
  }

  # ----------  User level - Basic  ---------- #

  # ----- Login / Logout ----- #

  public function am_i_logged () {
    return (&nbsp;! $this-&gt;am_i_anonymous() );
  }

  private function check_login ( &amp;$login ) {
    $result = true;

    if ( empty ( $login['wiki']['api_url'] ) ) {
      $this-&gt;log ( &quot;Did not get an API script URL to connect to! Cannot do anything - exitting.&quot;, LL_PANIC );
      die();
    }
    if ( empty ( $login['user'] ) ) {
      $this-&gt;log ( &quot;No login username! Will try to work anonymously...&quot;, LL_WARNING );
      $result = false;
    }
    if ( empty ( $login['password'] ) ) {
      $this-&gt;log ( &quot;No user password! Will try to work anonymously...&quot;, LL_WARNING );
      $result = false;
    }
    if ( empty ( $login['wiki']['retries']['link_error'] ) ) {
      $login['wiki']['retries']['link_error'] = 5;
      $this-&gt;log ( &quot;Max link errors count not specified - assuming 5...&quot;, LL_WARNING );
    }
    if ( empty ( $login['wiki']['interval']['link_error'] ) ) {
      $login['wiki']['interval']['link_error'] = 5;
      $this-&gt;log ( &quot;Link error interval not specified - assuming 5...&quot;, LL_WARNING );
    }

    return $result;
  }

  public function login ( $login ) {
    $this-&gt;login = $login;

    $has_cookies = array_value ( $this-&gt;login, 'attempt_cookies' ) &amp;&amp; $this-&gt;browser-&gt;has_cookies_for ( parse_url ( $login['wiki']['api_url'], PHP_URL_HOST ) );
    if ( $has_cookies ) {
      $this-&gt;obtain_initial_info();
      if ( $this-&gt;am_i_logged() ) return true;
    }

    if ( $this-&gt;check_login ( $this-&gt;login ) ) {
      $counter = (int) $this-&gt;login['wiki']['retries']['bad_login'];
      while (&nbsp;! $this-&gt;api_login ( $login['user'], $login['password'], $login['domain'] ) &amp;&amp; ( $counter &gt; 0 ) ) {
        $counter--;
        $this-&gt;log ( &quot;Could not login - retrying (&quot; . $this-&gt;error_string() . &quot;)...&quot;, LL_WARNING );
      }

      if ( $this-&gt;am_i_logged() ) {
        $this-&gt;log ( &quot;Logged in &quot; . $this-&gt;login['wiki']['name'] . &quot; as &quot; . $this-&gt;login['user'] );
      } else {
        $this-&gt;log ( &quot;Attention! The site says I am anonymous (unsuccessful login?)&quot;, LL_ERROR );
        if (&nbsp;! array_value ( $this-&gt;login, 'anonymous_ok' ) ) {
          die();
        }
      }

    }

    $this-&gt;obtain_initial_info();

    return true;
  }

  public function logout () {
    if ( $this-&gt;api_logout() ) {
      $this-&gt;wiki = array();
      $this-&gt;user = array();
      $this-&gt;log ( $this-&gt;login['user'] . &quot; logged out of &quot; . $this-&gt;login['wiki']['name'] );
    }
  }

  # ----- Queries ----- #

  public function continue_query () {
    if ( $this-&gt;query_is_exhausted() ) {
      return false;
    } else {
      return $this-&gt;api_query();
    }
  }

  public function query_titles ( $titles, $properties = NULL ) {
    return $this-&gt;api_query_titles ( $titles, $properties );
  }

  public function query_pageids ( $pageids, $properties = NULL ) {
    return $this-&gt;api_query_pageids ( $pageids, $properties );
  }

  public function query_revids ( $revids, $properties = NULL ) {
    return $this-&gt;api_query_revids ( $revids, $properties );
  }

  public function query_list ( $list, $code, $listparams = NULL, $params = NULL ) {
    return $this-&gt;api_query_list ( $list, $code, $listparams, $params );
  }

  public function query_generator ( $generator, $code, $listparams = NULL, $properties = NULL, $params = NULL ) {
    return $this-&gt;api_query_generator ( $generator, $code, $listparams, $properties, $params );
  }

  # ----- Editing pages ----- #

  private function fetch_page_objects ( $query_result, $limits = NULL ) {
    if ( $query_result === false ) { return false; }  // std_error is already set

    if ( is_array ( $this-&gt;data_tree['query'] ) &amp;&amp;
         array_key_exists ( 'pages', $this-&gt;data_tree['query'] ) ) {

      $page_key     = key     ( $this-&gt;data_tree['query']['pages'] );
      $page_element = current ( $this-&gt;data_tree['query']['pages'] );

      if ( array_key_exists ( 'missing', $page_element ) ) {
        if ( $page_element['imagerepository'] == &quot;shared&quot; ) {
          $this-&gt;set_std_error ( 'insharedrepo' );
        } else {
          $this-&gt;set_std_error ( 'pagemissing' );
        }
        return false;
      } elseif ( array_key_exists ( 'invalid', $page_element ) ) {
        $this-&gt;set_std_error ( 'pageinvalid' );
        return false;
      } elseif ( ( $page_key == -1 ) ) {
        $this-&gt;set_std_error ( 'unknownreason' );
        return false;
      } else {
        foreach ( $this-&gt;states['query']['properties'] as $property =&gt; $values ) {
          if ( isset ( $values['limit'] ) &amp;&amp;&nbsp;! isset ( $limits[$property] ) ) {
            $limits[$property] = $values['limit'];
          }
        }

        while ( $query_result ) {

          if ( is_array ( $limits ) ) {
            foreach ( $limits as $property =&gt; &amp;$limit ) {
              if ( $limit&nbsp;!= &quot;max&quot; ) {
                $limit -= count ( $page_element[$property] );
                if ( $limit == 0 ) {
                  unset ( $limits[$property] );
                } else {
                  if ( $limit &lt; $this-&gt;states['query']['properties'][$property]['limit'] ) {
                    $this-&gt;states['query']['properties'][$property]['limit'] = $limit;
                  }
                }
              }
            }
            if ( empty ( $limits ) ) break;
          }

          $query_result = $this-&gt;continue_query();
          if ( $query_result ) {
            $continue_element = current ( $this-&gt;data_tree['query']['pages'] );
            foreach ( $continue_element as $key =&gt; $sub ) {
              if ( is_array ( $sub ) ) {
                $page_element[$key] = array_merge ( $page_element[$key], $sub );
              }
            }
          }
        }
        unset ( $continue_element );

        $page = new Page;
        // FIXME where does $title come from?
        $page-&gt;requested_title = isset($title)&nbsp;? $title&nbsp;: '';
        $page-&gt;read_from_element ( $page_element, $this );
        return $page;
      }
    } else {
      return false;
    }
  }

  public function fetch_title ( $title, $properties = NULL, $limits = NULL ) {
    return $this-&gt;fetch_page_objects ( $this-&gt;api_query_titles ( $title, $properties ), $limits );
  }

  public function fetch_pageid ( $pageid, $properties = NULL, $limits = NULL ) {
    return $this-&gt;fetch_page_objects ( $this-&gt;api_query_pageids ( $pageid, $properties ), $limits );
  }

  public function title_exists ( $title ) {
    return (bool) $this-&gt;fetch_title ( $title );
  }

  public function pageid_exists ( $pageid ) {
    return (bool) $this-&gt;fetch_pageid ( $pageid );
  }

  public function fetch_page ( $title, $properties = NULL, $revision_id = NULL, $section = NULL ) {

    if ( $properties === NULL ) {
      $properties = array();

      if ( empty ( $properties['info'] ) ) {
        $properties['info'] = array ('prop' =&gt; 'protection' );
      }

      if ( $revision_id&nbsp;!== 0 ) {
        if ( empty ( $properties['revisions'] ) ) {
          $properties['revisions'] = array (
            'prop'  =&gt; 'content|timestamp',
            'limit' =&gt; '1',
          );
        }
        if (&nbsp;! ( $revision_id === NULL ) ) {
          $properties['revisions']['startid'] = $revision_id;
        }
        if (&nbsp;! ( $section === NULL ) ) {
          $properties['revisions']['section'] = $section;
        }
      }
    }

    $page = $this-&gt;fetch_title ( $title, $properties, array ( 'revisions' =&gt; 1 ) );

    $this-&gt;log_status ( &quot;Fetched page [[&quot; . $title . &quot;]].&quot;,
      &quot;Could not fetch page [[&quot; . $title . &quot;]]: \$info.&quot; );
    return $page;
  }

  public function submit_page ( $page, $summary, $isminor = true, $watch = NULL, $createonly = NULL ) {
    if (&nbsp;! $page-&gt;is_modified() ) {
      $this-&gt;set_std_error ( 'notmodified' );
    } elseif ( $page-&gt;deny_bots ) {
      $this-&gt;set_std_error ( 'pageprotected' );
    } else {

      $this-&gt;api_get_token_if_needed();

      if ( $page-&gt;wikiid&nbsp;!= $this-&gt;wiki['id'] ) {
        $page-&gt;timestamp = NULL;
        $page-&gt;fetchtimestamp = NULL;
      }

      $markbot = $this-&gt;login['mark_bot'];

      if ( $this-&gt;test_mode ) {
        $this-&gt;test_dump ( &quot;Would submit page [[&quot; . $page-&gt;title . &quot;]]\n&quot; .
          &quot;Text: &quot; . $page-&gt;text . &quot;\n&quot; .
          &quot;Summary: &quot; . $summary . &quot;\n&quot; );
        return true;
      }

      if ( (&nbsp;! $this-&gt;login['wiki']['submit_by_web'] ) &amp;&amp;
           ( $this-&gt;mw_version_number() &gt;= 11303 ) &amp;&amp;
           $this-&gt;is_api_write_enabled() ) {
        if ( $this-&gt;api_edit ( $page-&gt;timestamp, $page-&gt;fetchtimestamp,
          $page-&gt;title, $page-&gt;text, $page-&gt;section, $summary, $isminor,
          $markbot, $watch, ( $createonly === true ), ( $createonly === false ) ) ) {
          $edit_tree = $this-&gt;data_tree['edit'];
          if ( is_array ( $edit_tree ) ) {
            if ( array_key_exists ( 'result', $edit_tree ) ) {
              switch ( $edit_tree['result'] ) {
                case &quot;Success&quot;&nbsp;:
                  break;
                default&nbsp;:
                  $this-&gt;set_std_error ( 'editknown', $edit_tree['result'] );
              }
            } elseif ( array_key_exists ( 'captcha', $edit_tree ) ) {
              $this-&gt;set_std_error ( 'revertcaptcha' );
            } else {
              if (&nbsp;! $this-&gt;error['type'] ) {
                $this-&gt;set_std_error ( 'revertunknown' );
              }
            }
          }
        }
      } else {
        $this-&gt;web_edit ( $page-&gt;timestamp, $page-&gt;fetchtimestamp,
          $page-&gt;title, $page-&gt;text, $page-&gt;section, $summary, $isminor,
          $markbot, $watch );
      }

      sleep ( $this-&gt;login['wiki']['interval']['submit'] );

    }
    return $this-&gt;log_status ( &quot;Page [[&quot; . $page-&gt;title . &quot;]] was submitted.&quot;,
      &quot;Page [[&quot; . $page-&gt;title . &quot;]] was NOT submitted: \$info.&quot; );
  }

  public function undo_page ( $page, $revert_revid, $to_revid = NULL, $summary = NULL ) {
    $markbot = $this-&gt;login['mark_bot'];

    if ( $this-&gt;test_mode ) {
      $this-&gt;test_dump ( &quot;Would undo page [[&quot; . $page-&gt;title . &quot;]] from revid &quot; . $revert_revid .
        ( is_null ( $to_revid )&nbsp;? &quot;&quot;&nbsp;: &quot; to revid &quot; ) . $to_revid .
        &quot;\nSummary: &quot; . $summary . &quot;\n&quot; );
      return true;
    }

    if ( $this-&gt;api_undo ( $page-&gt;timestamp, $page-&gt;title, $revert_revid, $to_revid, $summary, $markbot ) ) {
      $edit_tree = $this-&gt;data_tree['edit'];
      if ( is_array ( $edit_tree ) ) {
        if ( array_key_exists ( 'result', $edit_tree ) ) {
          switch ( $edit_tree['result'] ) {
            case &quot;Success&quot;&nbsp;:
              $logstring = &quot;Reverted page [[&quot; . $page-&gt;title . &quot;]]&quot; .
                ( is_null ( $to_revid )&nbsp;? &quot; one revision back&quot;&nbsp;: &quot; to revid &quot; . $to_revid );
              break;
            default&nbsp;:
              $this-&gt;set_std_error ( 'revertknown', $edit_tree['result'] );
          }
        } elseif ( array_key_exists ( 'captcha', $edit_tree ) ) {
          $this-&gt;set_std_error ( 'revertcaptcha' );
        } else {
          if (&nbsp;! $this-&gt;error['type'] ) {
            $this-&gt;set_std_error ( 'revertunknown' );
          }
        }
      }
    }

    sleep ( $this-&gt;login['wiki']['interval']['submit'] );

    return $this-&gt;log_status ( $logstring . &quot;.&quot;,
      &quot;Page [[&quot; . $page-&gt;title . &quot;]] not undone: \$info.&quot; );
  }

  # ----- Moving, deleting and restoring pages ----- #

  public function move_page ( $from, $to, $reason = NULL, $noredirect = NULL, $movetalk = NULL ) {

    if ( $this-&gt;test_mode ) {
      $this-&gt;test_dump ( &quot;Would move page [[&quot; . $from . &quot;]] as [[&quot; . $to . &quot;]]\n&quot; .
        &quot;Summary: &quot; . $reason . &quot;\n&quot; );
      return true;
    }

    if ( $noredirect === NULL ) { $noredirect = $this-&gt;login['move_noredirect']; }
    if ( $noredirect === NULL ) { $noredirect = false; }
    if ( $movetalk   === NULL ) { $movetalk   = $this-&gt;login['move_withtalk']; }
    if ( $movetalk   === NULL ) { $movetalk   = true; }

    sleep ( $this-&gt;login['wiki']['interval']['submit'] );

    $this-&gt;api_move ( $from, $to, $reason, $noredirect, $movetalk );
    return $this-&gt;log_status ( &quot;Page [[&quot; . $from . &quot;]] moved as [[&quot; . $to . &quot;]].&quot;,
      &quot;Page [[&quot; . $from . &quot;]] NOT moved as [[&quot; . $to . &quot;]]: \$info.&quot; );
  }

  public function delete_page ( $title, $reason = NULL ) {

    if ( $this-&gt;test_mode ) {
      $this-&gt;test_dump ( &quot;Would delete page [[&quot; . $title . &quot;]]\n&quot; .
        &quot;Summary: &quot; . $reason . &quot;\n&quot; );
      return true;
    }

    if ( $this-&gt;can_i_delete() ) {
      if ( $this-&gt;mw_version_and_token_ok ( 11200 ) ) {
        $this-&gt;api_delete ( $title, $reason );
      } else {
        $this-&gt;web_delete ( $title, $reason );
      }
    } else {
      $this-&gt;set_std_error ( 'cantdelete' );
    }

    sleep ( $this-&gt;login['wiki']['interval']['submit'] );

    return $this-&gt;log_status ( &quot;Page [[&quot; . $title . &quot;]] was deleted.&quot;,
      &quot;Page [[&quot; . $title . &quot;]] was NOT deleted: \$info.&quot; );
  }

  public function undelete_page ( $title, $reason = NULL, $timestamps = NULL ) {

    if ( $this-&gt;test_mode ) {
      $this-&gt;test_dump ( &quot;Would undelete page [[&quot; . $title . &quot;]]\n&quot; .
        &quot;Summary: &quot; . $reason . &quot;\n&quot; .
        &quot;Revision timestamps: &quot; . print_r ( $timestamps, true ) );
      return true;
    }

    if ( empty ( $timestamps ) ) {
      $this-&gt;log ( &quot;Page &quot; . $title . &quot; has no revisions to be undeleted - skipping&quot; );
      return false;
    }

    $this-&gt;api_undelete ( $title, $reason, $timestamps );

    sleep ( $this-&gt;login['wiki']['interval']['submit'] );

    return $this-&gt;log_status ( &quot;Page [[&quot; . $title . &quot;]]: &quot; . count ( $timestamps ) . &quot; revision(s) were undeleted.&quot;,
      &quot;Page [[&quot; . $title . &quot;]]: &quot; . count ( $timestamps ) . &quot; revision(s) were NOT undeleted: \$info.&quot; );
  }

  # ----- Rolling back changes ----- #

  public function rollback_page ( $title, $user, $summary = NULL, $rollback_token = NULL ) {

    if ( $this-&gt;test_mode ) {
      $this-&gt;test_dump ( &quot;Would rollback page [[&quot; . $title . &quot;]] revisions by user &quot; . $user . &quot;\n&quot; .
        &quot;Summary: &quot; . $summary . &quot;\n&quot; .
        &quot;Revision timestamps: &quot; . print_r ( $timestamps, true ) );
      return true;
    }

    $markbot = $this-&gt;user['settings']['mark_bot'];
    $this-&gt;api_rollback ( $title, $user, $summary, $markbot, $rollback_token );

    sleep ( $this-&gt;login['wiki']['interval']['submit'] );

    return $this-&gt;log_status ( &quot;Page [[&quot; . $title . &quot;]] edits by user '&quot; . $user . &quot;' were rolled back.&quot;,
      &quot;Page [[&quot; . $title . &quot;]] edits by user '&quot; . $user . &quot;' were NOT rolled back: \$info.&quot; );
  }

  # ----- Protecting and unprotecting pages ----- #

  public function protect_page ( $title, $protections = NULL, $expiry = NULL, $reason = NULL, $cascade = false ) {
    if ( is_null ( $protections ) ) {
      $protections = &quot;edit=sysop|move=sysop|rollback=sysop|delete=sysop|restore=sysop&quot;;
    }

    if ( $this-&gt;test_mode ) {
      $this-&gt;test_dump ( &quot;Would protect page [[&quot; . $title . &quot;]]&quot; . ( $cascade&nbsp;? &quot; (cascade)&quot;&nbsp;: &quot;&quot; ) . &quot;\n&quot; .
        &quot;Protections: &quot; . print_r ( $protections, true ) .
        &quot;Expiry: &quot; . $expiry . &quot;\n&quot; .
        &quot;Summary: &quot; . $reason . &quot;\n&quot; .
        &quot;Revision timestamps: &quot; . print_r ( $timestamps, true ) );
      return true;
    }

    $this-&gt;api_protect ( $title, $protections, $expiry, $reason, $cascade );

    sleep ( $this-&gt;login['wiki']['interval']['submit'] );

    return $this-&gt;log_status ( &quot;Page [[&quot; . $title . &quot;]] was protected.&quot;,
      &quot;Page [[&quot; . $title . &quot;]] was NOT protected: \$info.&quot; );
  }

  public function unprotect_page ( $title, $protections = NULL, $reason = NULL, $cascade = false ) {
    if ( is_null ( $protections ) ) {
      $protections = &quot;edit=all|move=autoconfirmed|rollback=autoconfirmed|delete=sysop|restore=autoconfirmed&quot;;
    }

    if ( $this-&gt;test_mode ) {
      $this-&gt;test_dump ( &quot;Would unprotect page [[&quot; . $title . &quot;]]&quot; . ( $cascade&nbsp;? &quot; (cascade)&quot;&nbsp;: &quot;&quot; ) . &quot;\n&quot; .
        &quot;Protections: &quot; . print_r ( $protections, true ) .
        &quot;Expiry: &quot; . $expiry . &quot;\n&quot; .
        &quot;Summary: &quot; . $reason . &quot;\n&quot; .
        &quot;Revision timestamps: &quot; . print_r ( $timestamps, true ) );
      return true;
    }

    $this-&gt;api_protect ( $title, $protections, $expiry, $reason, $cascade );

    sleep ( $this-&gt;login['wiki']['interval']['submit'] );

    return $this-&gt;log_status ( &quot;Page [[&quot; . $title . &quot;]] was de-protected.&quot;,
      &quot;Page [[&quot; . $title . &quot;]] was NOT de-protected: \$info.&quot; );
  }

  # ----- Blocking and unblocking users ----- #

  public function block_user ( $username, $expiry = 'never', $reason = NULL, $anononly = false, $nocreate = false, $autoblock = false, $noemail = false ) {

    if ( $this-&gt;test_mode ) {
      $this-&gt;test_dump ( &quot;Would block user&quot; . $username . &quot;\n&quot; .
        &quot;Expiry: &quot; . $expiry . &quot;\n&quot; .
        &quot;Summary: &quot; . $reason . &quot;\n&quot; );
      return true;
    }

    if ( $this-&gt;can_i_block() ) {
      if ( $this-&gt;mw_version_and_token_ok ( 11200 ) ) {
        $this-&gt;api_block ( $username, $expiry, $reason, $anononly, $nocreate, $autoblock, $noemail );
      } else {
        $this-&gt;web_block ( $username, $expiry, $reason, $anononly, $nocreate, $autoblock, $noemail );
      }
      sleep ( $this-&gt;login['wiki']['interval']['submit'] );
    } else {
      $this-&gt;set_std_error ( 'permissiondenied' );
    }

    return $this-&gt;log_status ( &quot;User '&quot; . $username . &quot;' was blocked.&quot;,
      &quot;User '&quot; . $username . &quot;' was NOT blocked: \$info.&quot; );
  }

  private function get_user_last_block_id ( $username ) {
    $params = array();
    if ( mb_strpos ( $username, '/' ) === false ) {
      $params['users'] = $username;
    } else {
      $params['ip'] = $username;
    }
    $params['start'] = date ( 'Y-m-d H:i:s', $this-&gt;wiki_time() );
    $params['end'  ] = date ( 'Y-m-d H:i:s', $this-&gt;wiki_time ( 0 ) );
    $params['dir'  ] = &quot;older&quot;;
    $params['limit'] = 1;
    $params['prop' ] = &quot;id&quot;;

    $this-&gt;api_query_list ( 'blocks', 'bk', $params );
    $blockdesc = reset ( $this-&gt;data_tree['query']['blocks'] );
    if ( empty ( $blockdesc ) ) {
      $this-&gt;set_std_error ( 'notblocked' );
      return false;
    } else {
      return $blockdesc['id'];
    }
  }

  public function unblock_user ( $username, $block_id = NULL, $reason = NULL ) {

    if ( $this-&gt;test_mode ) {
      $this-&gt;test_dump ( &quot;Would unblock user&quot; . $username . &quot;\n&quot; .
        &quot;Summary: &quot; . $reason . &quot;\n&quot; );
      return true;
    }

    if ( $this-&gt;can_i_block() ) {
      if ( $this-&gt;mw_version_and_token_ok ( 11200 ) ) {
        if ( is_null ( $block_id ) ) {
          $block_id = $this-&gt;get_user_last_block_id ( $username );
        }
        if ( $block_id ) {
          $this-&gt;api_unblock ( $username, $block_id, $reason );
        }
      } else {
        $this-&gt;web_unblock ( $username, $block_id, $reason );
      }
      sleep ( $this-&gt;login['wiki']['interval']['submit'] );
    } else {
      $this-&gt;set_std_error ( 'permissiondenied' );
    }

    return $this-&gt;log_status ( &quot;User '&quot; . $username . &quot;' was unblocked.&quot;,
      &quot;User '&quot; . $username . &quot;' was NOT unblocked: \$info.&quot; );
  }

  # ----- Watching and unwatching pages ----- #

  public function watch_page ( $title ) {

    if ( $this-&gt;test_mode ) {
      $this-&gt;test_dump ( &quot;Would watch page [[&quot; . $title . &quot;]]\n&quot; );
      return true;
    }

    $this-&gt;api_watch ( $title, true );

    sleep ( $this-&gt;login['wiki']['interval']['submit'] );

    return $this-&gt;log_status ( &quot;Page [[&quot; . $title . &quot;]] was marked as watched.&quot;,
      &quot;Page [[&quot; . $title . &quot;]] was NOT marked as watched: \$info.&quot; );
  }

  public function unwatch_page ( $title ) {

    if ( $this-&gt;test_mode ) {
      $this-&gt;test_dump ( &quot;Would unwatch page [[&quot; . $title . &quot;]]\n&quot; );
      return true;
    }

    $this-&gt;api_watch ( $title, false );

    sleep ( $this-&gt;login['wiki']['interval']['submit'] );

    return $this-&gt;log_status ( &quot;Page [[&quot; . $title . &quot;]] was marked as not watched.&quot;,
      &quot;Page [[&quot; . $title . &quot;]] was NOT marked as not watched: \$info.&quot; );
  }

  # ----- E-mailing an user ----- #

  public function email_user ( $user, $subject, $text, $ccme = false ) {

    if ( $this-&gt;test_mode ) {
      $this-&gt;test_dump ( &quot;Would email user &quot; . $user . &quot;\n&quot; .
        &quot;Subject: &quot; . $subject . &quot;\n&quot; .
        &quot;Text: &quot; . $text . &quot;\n&quot; );
      return true;
    }

    if ( $this-&gt;can_i_sendemail() ) {
      $this-&gt;api_emailuser ( $user, $subject, $text, $ccme );
      sleep ( $this-&gt;login['wiki']['interval']['submit'] );
    } else {
      $this-&gt;set_std_error ( 'permissiondenied' );
    }

    return $this-&gt;log_status ( &quot;Email was sent to user '&quot; . $user . &quot;'.&quot;,
      &quot;Email was NOT sent to user '&quot; . $user . &quot;': \$info.&quot; );
  }

  # ----- Patrolling a recent change ----- #

  public function patrol_recentchange ( $rcid ) {

    if ( $this-&gt;test_mode ) {
      $this-&gt;test_dump ( &quot;Would mark recentchange &quot; . $rcid . &quot;as patrolled\n&quot; );
      return true;
    }

    if ( $this-&gt;can_i_patrol() ) {
      if ( $this-&gt;mw_version_and_token_ok ( 11400 ) ) {
        return $this-&gt;api_patrol ( $rcid );
      } else {
        return $this-&gt;web_patrol ( $rcid );
      }
      sleep ( $this-&gt;login['wiki']['interval']['submit'] );
    } else {
      $this-&gt;set_std_error ( 'permissiondenied' );
    }

    return $this-&gt;log_status ( &quot;Recentchange ID &quot; . $rcid . &quot; was marked as patrolled.&quot;,
      &quot;Recentchange ID &quot; . $rcid . &quot; was NOT marked as patrolled: \$info.&quot; );
  }

  # ----- Importing pages ----- #

  public function import_pages_interwiki ( $title, $iwcode, $summary = NULL, $fullhistory = true, $into_namespace = NULL, $templates = false ) {

    if ( $this-&gt;test_mode ) {
      $this-&gt;test_dump ( &quot;Would import from interwiki &quot; . $iwcode . &quot; page [[&quot; . $title . &quot;]]\n&quot; .
        &quot;Summary: &quot; . $summary . &quot;\n&quot; );
      return true;
    }

    $this-&gt;api_import_interwiki ( $title, $iwcode, $summary, $fullhistory, $into_namespace, $templates );
    sleep ( $this-&gt;login['wiki']['interval']['submit'] );

    return $this-&gt;log_status ( &quot;Page import was successful.&quot;,
      &quot;Page import was NOT successful: \$info.&quot; );
  }

  public function import_pages_xml ( $xml_upload, $summary = NULL ) {

    if ( $this-&gt;test_mode ) {
      $this-&gt;test_dump ( &quot;Would import from XML page [[&quot; . $title . &quot;]]\n&quot; .
        &quot;Summary: &quot; . $summary . &quot;\n&quot; );
      return true;
    }

    return $this-&gt;api_import_xml ( $xml_upload, $summary );
    sleep ( $this-&gt;login['wiki']['interval']['submit'] );

    return $this-&gt;log_status ( &quot;Page XML import was successful.&quot;,
      &quot;Page XML import was NOT successful: \$info.&quot; );
  }

  # ----- Changing user rights ----- #

  public function change_userrights ( $user, $add_groups = NULL, $remove_groups = NULL, $reason = NULL ) {

    if ( $this-&gt;test_mode ) {
      $this-&gt;test_dump ( &quot;Would change the rights of &quot; . $user . &quot;\n&quot; .
        &quot;Add groups: &quot; . $this-&gt;barsepstring ( $add_groups ) . &quot;\n&quot; .
        &quot;Remove groups: &quot; . $this-&gt;barsepstring ( $remove_groups ) . &quot;\n&quot; .
        &quot;Reason: &quot; . $reason . &quot;\n&quot; );
      return true;
    }

    if ( $this-&gt;can_i_userrights() ) {
      if ( $this-&gt;mw_version_and_token_ok ( 11600 ) ) {
        $this-&gt;api_userrights ( $user, $add_groups, $remove_groups, $reason );
      } else {
        $this-&gt;web_userrights ( $user, $add_groups, $remove_groups, $reason );
      }
      sleep ( $this-&gt;login['wiki']['interval']['submit'] );
    } else {
      $this-&gt;set_std_error ( 'permissiondenied' );
    }

    return $this-&gt;log_status ( &quot;User '&quot; . $user . &quot;' rights were changed.&quot;,
      &quot;User '&quot; . $user . &quot;' rights were NOT changed: \$info.&quot; );
  }

  # ----- Preprocessing wiki texts ----- #

  public function expand_templates ( $text, $title = NULL ) {
    if ( $this-&gt;api_expandtemplates ( $text, $title ) ) {
      $result = reset ( $this-&gt;data_tree['expandtemplates'] );
    } else {
      $result = false;
    }
    $this-&gt;log_status ( &quot;Text templates were expanded.&quot;,
      &quot;Text templates were NOT expanded: \$info.&quot; );
    return $result;
  }

  public function parse_text ( $text, $title = NULL, $properties = NULL, $pst = true, $uselang = NULL ) {
    if ( $this-&gt;api_parse_text ( $text, $title, $properties, $pst, $uselang ) ) {
      $result = $this-&gt;data_tree['parse'];
    } else {
      $result = false;
    }
    $this-&gt;log_status ( &quot;Text was parsed.&quot;,
      &quot;Text was NOT parsed: \$info.&quot; );
    return $result;
  }

  public function parse_page ( $title, $properties = NULL, $uselang = NULL ) {
    if ( $this-&gt;api_parse_page ( $title, $properties, $uselang ) ) {
      $result = $this-&gt;data_tree['parse'];
    } else {
      $result = false;
    }
    $this-&gt;log_status ( &quot;Page [[&quot; . $title . &quot;]] text was parsed.&quot;,
      &quot;Page [[&quot; . $title . &quot;]] text was NOT parsed: \$info.&quot; );
    return $result;
  }

  # ----- Uploading files ----- #

  public function upload_file ( $file, $text, $comment, $target_filename = NULL, $watch = false, $ignorewarnings = true ) {
    if ( empty ( $target_filename ) ) { $target_filename = basename ( $file ); }

    if ( $this-&gt;test_mode ) {
      $this-&gt;test_dump ( &quot;Would upload file &quot; . $file . &quot; as page [[&quot; . $target_filename . &quot;]]\n&quot; .
        &quot;Text: &quot; . $text . &quot;\n&quot; .
        &quot;Comment: &quot; . $comment . &quot;\n&quot; );
      return true;
    }

    if ( $this-&gt;mw_version_ok ( 11600 ) ) {
      $result = $this-&gt;api_upload_file ( $file, $text, $comment, $target_filename, $watch, $ignorewarnings );
    } else {
      $result = $this-&gt;web_upload_file ( $file, $text, $comment, $target_filename, $watch, $ignorewarnings );
    }

    sleep ( $this-&gt;login['wiki']['interval']['submit'] );

    $this-&gt;log_warnings_if_present ( $this-&gt;data_tree['upload'] );
    return $this-&gt;log_status ( &quot;Uploaded file '&quot; . $filename . &quot;' as '&quot; . $target_filename . &quot;'.&quot;,
      &quot;Upload of file '&quot; . $filename . &quot;' as '&quot; . $target_filename . &quot;' failed: \$info.&quot; );
  }

  public function upload_url ( $URL, $text, $comment, $target_filename = NULL, $watch = false, $ignorewarnings = true ) {
    if ( empty ( $target_filename ) ) { $target_filename = basename ( $filename ); }

    if ( $this-&gt;test_mode ) {
      $this-&gt;test_dump ( &quot;Would upload URL &quot; . $URL . &quot; as page [[&quot; . $target_filename . &quot;]]\n&quot; .
        &quot;Text: &quot; . $text . &quot;\n&quot; .
        &quot;Comment: &quot; . $comment . &quot;\n&quot; );
      return true;
    }

    $this-&gt;api_upload_url ( $URL, $text, $comment, $target_filename, $watch, $ignorewarnings );

    sleep ( $this-&gt;login['wiki']['interval']['submit'] );

    $this-&gt;log_warnings_if_present ( $this-&gt;data_tree['upload'] );
    return $this-&gt;log_status ( &quot;Uploaded by URL file '&quot; . $filename . &quot;' as '&quot; . $target_filename . &quot;'.&quot;,
      &quot;Upload by URL of file '&quot; . $filename . &quot;' as '&quot; . $target_filename . &quot;' failed: \$info.&quot; );
  }

  public function is_url_uploaded ( $target_filename, $sessionkey, $ignorewarnings = true ) {
    if ( $this-&gt;api_upload_sessionkey ( $target_filename, $sessionkey, true, $ignorewarnings ) ) {
      $this-&gt;log ( &quot;Upload (by URL) of '&quot; . $target_filename . &quot;' checked: OK.&quot; );
      return true;
    } else {
      $this-&gt;log ( &quot;Upload (by URL) of '&quot; . $target_filename . &quot;' checked: Failed.&quot; );
      return false;
    }
  }

  public function get_upload_session_key () {
    return $this-&gt;data_tree['upload']['sessionkey'];
  }

  # ----- Purging pages caches ----- #

  public function purge_page_cache ( $title ) {

    if ( $this-&gt;test_mode ) {
      $this-&gt;test_dump ( &quot;Would purge the web cache of page [[&quot; . $title . &quot;]]\n&quot; );
      return true;
    }

    $this-&gt;api_purge ( $title );

    sleep ( $this-&gt;login['wiki']['interval']['submit'] );

    return $this-&gt;log_status ( &quot;Page [[&quot; . $title . &quot;]] cache was purged.&quot;,
      &quot;Page [[&quot; . $title . &quot;]] cache was NOT purged: \$info.&quot; );
  }

  # ----------  Wiki apimodule info paraminfo  ---------- #

  public function is_apimodule_info_obtained () {
    return (&nbsp;! empty ( $this-&gt;wiki['paraminfo'] ) );
  }

  # ----- Modules ----- #

  public function apimodules_names ( $parentmodulename = NULL ) {
    switch ( $parentmodulename ) {
      case &quot;query&quot;&nbsp;:
        return array_keys ( $this-&gt;wiki['paraminfo']['querymodules'] );
      case NULL&nbsp;:
        return array_keys ( $this-&gt;wiki['paraminfo']['modules'] );
      case &quot;/&quot;&nbsp;:
        $modules = array_keys ( $this-&gt;wiki['paraminfo'] );
        unset ( $modules[array_search ( 'modules', $modules )] );
        unset ( $modules[array_search ( 'querymodules', $modules )] );
        return $modules;
      default&nbsp;:
        return false;
    }
  }

  public function apimodule_exists ( $modulename, $parentmodulename = NULL ) {
    return in_array ( $modulename, $this-&gt;apimodules_names ( $parentmodulename ) );
  }

  public function apimodule ( $modulename, $parentmodulename = NULL ) {
    switch ( $parentmodulename ) {
      case &quot;query&quot;&nbsp;:
        return $this-&gt;wiki['paraminfo']['querymodules'][$modulename];
      case NULL&nbsp;:
        return $this-&gt;wiki['paraminfo']['modules'][$modulename];
      case &quot;/&quot;&nbsp;:
        return $this-&gt;wiki['paraminfo'][$modulename];
      default&nbsp;:
        return false;
    }
  }

  # ----- Module elements ----- #

  private function apimodule_element ( $element_name, $modulename, $parentmodulename = NULL ) {
    $module = $this-&gt;apimodule ( $modulename, $parentmodulename );
    return ( is_array ( $module )&nbsp;? $module[$element_name]&nbsp;: false );
  }

  private function apimodule_subarraykeys ( $subarray_name, $modulename, $parentmodulename = NULL ) {
    $element = $this-&gt;apimodule_element ( $subarray_name, $modulename, $parentmodulename );
    return ( is_array ( $element )&nbsp;? array_keys ( $element )&nbsp;: false );
  }

  private function apimodule_subarrayelement ( $subarray_name, $element_name, $modulename, $parentmodulename = NULL ) {
    $subarray = $this-&gt;apimodule_element ( $subarray_name, $modulename, $parentmodulename );
    return ( is_array ( $subarray )&nbsp;? $subarray[$element_name]&nbsp;: false );
  }

  # --- Parameters --- #

  public function apimodule_params_names ( $modulename, $parentmodulename = NULL ) {
    return $this-&gt;apimodule_subarraykeys ( 'parameters', $modulename, $parentmodulename );
  }

  public function apimodule_param_exists ( $paramname, $modulename, $parentmodulename = NULL ) {
    $paramnames = $this-&gt;apimodule_params_names ( $modulename, $parentmodulename );
    return ( is_array ( $paramnames )&nbsp;? in_array ( $paramname, $paramnames )&nbsp;: false );
  }

  public function apimodule_param ( $paramname, $modulename, $parentmodulename = NULL ) {
    return $this-&gt;apimodule_subarrayelement ( 'parameters', $paramname,
      $modulename, $parentmodulename );
  }

  private function apimodule_paramelement ( $elementname, $paramname, $modulename, $parentmodulename = NULL ) {
    $param = $this-&gt;apimodule_param ( $paramname, $modulename, $parentmodulename );
    if ( is_array ( $param ) ) {
      return ( array_key_exists ( $elementname, $param )&nbsp;? $param[$elementname]&nbsp;: false );
    } else {
      return false;
    }
  }

  private function apimodule_paramelement_is_present ( $elementname, $paramname, $modulename, $parentmodulename = NULL ) {
    $element = $this-&gt;apimodule_paramelement ( $elementname, $paramname, $modulename, $parentmodulename );
    return ( $element&nbsp;!== false );
  }

  public function apimodule_param_desc ( $paramname, $modulename, $parentmodulename = NULL ) {
    return $this-&gt;apimodule_paramelement ( 'description', $paramname, $modulename, $parentmodulename );
  }

  public function apimodule_param_type ( $paramname, $modulename, $parentmodulename = NULL ) {
    return $this-&gt;apimodule_paramelement ( 'type', $paramname, $modulename, $parentmodulename );
  }

  public function apimodule_param_default ( $paramname, $modulename, $parentmodulename = NULL ) {
    return $this-&gt;apimodule_paramelement ( 'default', $paramname, $modulename, $parentmodulename );
  }

  public function apimodule_param_min ( $paramname, $modulename, $parentmodulename = NULL ) {
    return $this-&gt;apimodule_paramelement ( 'min', $paramname, $modulename, $parentmodulename );
  }

  public function apimodule_param_max ( $paramname, $modulename, $parentmodulename = NULL ) {
    return $this-&gt;apimodule_paramelement ( 'max', $paramname, $modulename, $parentmodulename );
  }

  public function apimodule_param_highmax ( $paramname, $modulename, $parentmodulename = NULL ) {
    return $this-&gt;apimodule_paramelement ( 'highmax', $paramname, $modulename, $parentmodulename );
  }

  public function apimodule_param_limit ( $paramname, $modulename, $parentmodulename = NULL ) {
    return $this-&gt;apimodule_paramelement ( 'limit', $paramname, $modulename, $parentmodulename );
  }

  public function apimodule_param_multi ( $paramname, $modulename, $parentmodulename = NULL ) {
    $this-&gt;apimodule_paramelement_is_present ( 'multi', $paramname, $modulename, $parentmodulename );
  }

  public function apimodule_param_allowsduplicates ( $paramname, $modulename, $parentmodulename = NULL ) {
    $this-&gt;apimodule_paramelement_is_present ( 'allowsduplicates', $paramname, $modulename, $parentmodulename );
  }

  # --- Other --- #

  public function apimodule_errors ( $modulename, $parentmodulename = NULL ) {
    $module = $this-&gt;apimodule ( $modulename, $parentmodulename );
    return $module['errors'];
  }

  private function apimodule_element_is_present ( $elementname, $modulename, $parentmodulename = NULL ) {
    $module = $this-&gt;apimodule ( $modulename, $parentmodulename );
    return array_key_exists ( $elementname, $module );
  }

  public function apimodule_classname ( $modulename, $parentmodulename = NULL ) {
    return $this-&gt;apimodule_element ( 'classname', $modulename, $parentmodulename );
  }

  public function apimodule_desc ( $modulename, $parentmodulename = NULL ) {
    return $this-&gt;apimodule_element ( 'description', $modulename, $parentmodulename );
  }

  public function apimodule_version ( $modulename, $parentmodulename = NULL ) {
    return $this-&gt;apimodule_element ( 'version', $modulename, $parentmodulename );
  }

  public function apimodule_prefix ( $modulename, $parentmodulename = NULL ) {
    return $this-&gt;apimodule_element ( 'prefix', $modulename, $parentmodulename );
  }

  public function apimodule_requires_readrights ( $modulename, $parentmodulename = NULL ) {
    return $this-&gt;apimodule_element_is_present ( 'readrights', $modulename, $parentmodulename );
  }

  public function apimodule_requires_writerights ( $modulename, $parentmodulename = NULL ) {
    return $this-&gt;apimodule_element_is_present ( 'writerights', $modulename, $parentmodulename );
  }

  public function apimodule_requires_mustbeposted ( $modulename, $parentmodulename = NULL ) {
    return $this-&gt;apimodule_element_is_present ( 'mustbeposted', $modulename, $parentmodulename );
  }

  public function apimodule_is_generator ( $modulename, $parentmodulename = NULL ) {
    return $this-&gt;apimodule_element_is_present ( 'generator', $modulename, $parentmodulename );
  }

  # ----------  Wiki and user characteristics  ---------- #

  # ----- Internal use functions ----- #

  protected function subarray ( $array, $key ) {
    return ( is_array ( $array[$key] )&nbsp;? $array[$key]&nbsp;: false );
  }
  protected function wiki_subarray ( $key ) { return $this-&gt;subarray ( $this-&gt;wiki, $key ); }
  protected function user_subarray ( $key ) { return $this-&gt;subarray ( $this-&gt;user, $key ); }

  protected function wiki_element_is_subarray ( $key ) { return is_array ( $this-&gt;wiki[$key] ); }
  protected function user_element_is_subarray ( $key ) { return is_array ( $this-&gt;user[$key] ); }

  protected function wiki_subarray_count ( $key ) {
    return ( is_array ( $this-&gt;wiki[$key] )&nbsp;? count ( $this-&gt;wiki[$key] )&nbsp;: false );
  }

  protected function wiki_subarray_elements_elements ( $key, $subkey ) {
    $element_subarray = $this-&gt;wiki_subarray ( $key );
    if (&nbsp;! $element_subarray ) {
      return $element_subarray;
    } else {
      $elements = array();
      foreach ( $element_subarray as $piecekey =&gt; $piece ) {
        $elements[$piecekey] = $piece[$subkey];
      }
      return $elements;
    }
  }

  protected function wiki_subarray_element_by_value ( $key, $subkey, $value ) {
    $element_subarray = $this-&gt;wiki_subarray ( $key );
    if (&nbsp;! $element_subarray ) {
      return $element_subarray;
    } else {
      foreach ( $element_subarray as $piecekey =&gt; $piece ) {
        if ( $piece[$subkey] == $value ) {
          return $piece;
        }
      }
      return false;
    }
  }

  protected function wiki_subarray_elements_by_values ( $key, $subkey, $value ) {
    $element_subarray = $this-&gt;wiki_subarray ( $key );
    if (&nbsp;! $element_subarray ) {
      return $element_subarray;
    } else {
      $pieces = array();
      foreach ( $element_subarray as $piecekey =&gt; $piece ) {
        if ( $piece[$subkey] == $value ) {
          $pieces[$piecekey] = $piece;
        }
      }
      return $pieces;
    }
  }

  # ----- Wiki misc ----- #

  public function is_wiki_info_obtained () { return (&nbsp;! empty ( $this-&gt;wiki ) ); }

  public function wiki_name              () { return $this-&gt;wiki['general']['sitename'            ]; }
  public function wiki_mainpage_title    () { return $this-&gt;wiki['general']['mainpage'            ]; }
  public function wiki_mainpage_url      () { return $this-&gt;wiki['general']['base'                ]; }
  public function wiki_id                () { return $this-&gt;wiki['general']['wikiid'              ]; }

  public function wiki_generator         () { return $this-&gt;wiki['general']['generator'           ]; }  // the wiki software and version
  public function wiki_revision          () { return $this-&gt;wiki['general']['rev'                 ]; }  // the software revision, I guess
  public function wiki_phpversion        () { return $this-&gt;wiki['general']['phpversion'          ]; }
  public function wiki_phpsapi           () { return $this-&gt;wiki['general']['phpsapi'             ]; }
  public function wiki_dbtype            () { return $this-&gt;wiki['general']['dbtype'              ]; }
  public function wiki_dbversion         () { return $this-&gt;wiki['general']['dbversion'           ]; }

  public function wiki_rights            () { return $this-&gt;wiki['general']['rights'              ]; }  // the wiki license (see also wiki_rightsinfo() )
  public function wiki_case              () { return $this-&gt;wiki['general']['case'                ]; }  // the page names case treatment (eg. first-letter)
  public function wiki_language          () { return $this-&gt;wiki['general']['lang'                ]; }  // the natural language used on this wiki
  public function wiki_fallback_encoding () { return $this-&gt;wiki['general']['fallback8bitEncoding']; }
  public function wiki_timezone          () { return $this-&gt;wiki['general']['timezone'            ]; }
  public function wiki_timeoffset        () { return $this-&gt;wiki['general']['timeoffset'          ]; }
  public function wiki_time_at_login     () { return $this-&gt;wiki['general']['time'                ]; }  // server time

  public function wiki_server            () { return $this-&gt;wiki['general']['server'              ]; }
  public function wiki_article_path      () { return $this-&gt;wiki['general']['articlepath'         ]; }
  public function wiki_other_article_path() { return $this-&gt;wiki['general']['variantarticlepath'  ]; }  // typically the 'short' article path
  public function wiki_script_path       () { return $this-&gt;wiki['general']['scriptpath'          ]; }
  public function wiki_script            () { return $this-&gt;wiki['general']['script'              ]; }

  public function is_api_write_enabled () {
    if (&nbsp;! is_array ( $this-&gt;wiki['general'] ) || ( $this-&gt;mw_version_number() &lt;= 11200 ) ) { return NULL; }
    return array_key_exists ( 'writeapi', $this-&gt;wiki['general'] );
  }  // can_i_writeapi() is much more user-specific - prefer it where available

  public function wiki_time ( $time = NULL ) {
    if ( is_null ( $time ) ) { $time = time(); }
    elseif (&nbsp;! is_numeric ( $time ) ) { $time = strtotime ( $time ); }
    return $time + $this-&gt;wiki['general']['timediff'];
  }

  public function wiki_lastreq_time () {
    return $this-&gt;wiki_time ( $this-&gt;browser-&gt;lastreq_time() );
  }

  # ----- Wiki namespaces ----- #

  # --- Lists of namespaces --- #

  protected function index_wiki_namespaces_allnames () {
    if (&nbsp;! empty ( $this-&gt;wiki['namespaces_indexed'] ) ) { return true; }
    if ( empty ( $this-&gt;wiki['namespaces'] ) ) { return NULL; }
    $this-&gt;wiki['namespaces_indexed'] = array ();
    foreach ( $this-&gt;wiki['namespaces'] as $id =&gt; &amp;$namespace ) {
      if ( array_key_exists ( '*', $namespace ) ) {
        $this-&gt;wiki['namespaces_indexed'][$namespace['*']] = &amp;$namespace;
      }
      if ( array_key_exists ( 'canonical', $namespace ) ) {
        $this-&gt;wiki['namespaces_indexed'][$namespace['canonical']] = &amp;$namespace;
      }
      $aliases = $this-&gt;wiki_namespace_aliases ( $id );
      if ( is_array ( $aliases ) ) {
        foreach ( $aliases as $alias ) {
          $this-&gt;wiki['namespaces_indexed'][$alias] = &amp;$namespace;
        }
      }
    }
    return true;
  }

  public function are_wiki_namespaces_obtained () {
    return $this-&gt;wiki_element_is_subarray ( 'namespaces' );
  }

  public function wiki_namespaces () {
    return $this-&gt;wiki_subarray ( 'namespaces' );
  }

  public function wiki_namespaces_count () {
    return $this-&gt;wiki_subarray_count ( 'namespaces' );
  }

  public function wiki_namespaces_ids () {
    return $this-&gt;wiki_subarray_elements_elements ( 'namespaces', 'id' );
  }

  public function wiki_namespaces_names () {
    return $this-&gt;wiki_subarray_elements_elements ( 'namespaces', '*' );
  }

  public function wiki_namespaces_canonical_names () {
    return $this-&gt;wiki_subarray_elements_elements ( 'namespace', 'canonical' );
  }

  public function wiki_namespaces_aliases () {
    return $this-&gt;wiki_subarray ( 'namespacealiases' );  // each alias is an array ( 'id' =&gt; id, '*' =&gt; alias )
  }

  public function wiki_namespaces_aliases_count () {
    return $this-&gt;wiki_subarray_count ( 'namespacealiases' );
  }

  public function wiki_namespaces_allnames () {
    if ( $this-&gt;index_wiki_namespaces_allnames() ) {
      return array_keys ( $this-&gt;wiki['namespaces_indexed'] );
    }
  }

  # --- Namespace data by id or name --- #

  public function wiki_namespace ( $id_or_name ) {
    if ( empty ( $this-&gt;wiki['namespaces'] ) ) { return NULL; }
    if ( array_key_exists ( $id_or_name, $this-&gt;wiki['namespaces'] ) ) {
      return $this-&gt;wiki['namespaces'][$id_or_name];
    } elseif ( $this-&gt;index_wiki_namespaces_allnames() &amp;&amp;
               array_key_exists ( $id_or_name, $this-&gt;wiki['namespaces_indexed'] ) ) {
      return $this-&gt;wiki['namespaces_indexed'][$id_or_name];
    } else {
      return false;
    }
  }

  public function wiki_namespace_is_present ( $id_or_name ) {
    $namespace = $this-&gt;wiki_namespace ( $id_or_name );
    if ( $namespace ) { return true; } else { return $namespace; }
  }

  protected function wiki_namespace_element ( $id_or_name, $element ) {
    $namespace = $this-&gt;wiki_namespace ( $id_or_name );
    if ( $namespace ) { return $namespace[$element]; } else { return $namespace; }
  }
  public function wiki_namespace_name           ( $id_or_name ) { return $this-&gt;wiki_namespace_element ( $id_or_name, '*'         ); }
  public function wiki_namespace_canonical_name ( $id_or_name ) { return $this-&gt;wiki_namespace_element ( $id_or_name, 'canonical' ); }
  public function wiki_namespace_case           ( $id_or_name ) { return $this-&gt;wiki_namespace_element ( $id_or_name, 'case'      ); }

  public function wiki_namespace_allows_subpages ( $id_or_name ) {
    $namespace = $this-&gt;wiki_namespace ( $id_or_name );
    return array_key_exists ( 'subpages', $namespace );
  }

  public function wiki_namespace_aliases ( $id_or_name ) {
    $namespace = $this-&gt;wiki_namespace ( $id_or_name );
    $aliases = array();
    if ( is_array ( $this-&gt;wiki['namespacealiases'] ) ) {
      foreach ( $this-&gt;wiki['namespacealiases'] as $alias ) {
        if ( $alias['id'] == $namespace['id'] ) {
          $aliases[] = $alias['*'];
        }
      }
    }
    return $aliases;
  }

  public function wiki_namespace_allnames ( $id_or_name ) {
    $names = array ( $this-&gt;wiki_namespace_name ( $id_or_name ) );
    if (&nbsp;! ( $names ) ) { return $names; }
    $canonical = $this-&gt;wiki_namespace_canonical_name ( $id_or_name );
    if (&nbsp;! empty ( $canonical ) ) { $names[] = $canonical; }
    $aliases = $this-&gt;wiki_namespace_aliases ( $id_or_name );
    if (&nbsp;! empty ( $aliases ) ) { $names = array_merge ( $names, $aliases ); }
    return $names;
  }

  public function wiki_namespace_id ( $name ) {
    $index_result = $this-&gt;index_wiki_namespaces_allnames();
    if ( $index_result &amp;&amp; array_key_exists ( $name, $this-&gt;wiki['namespaces_indexed'] ) ) {
      return $this-&gt;wiki['namespaces_indexed'][$name]['id'];
    } else {
      return false;
    }
  }

  # --- Misc namespace support --- #

  public function wiki_namespace_barsepnames ( $id_or_name, $preg_quote = false, $regex_wikicase = false ) {
    if ( is_null ( $id_or_name ) ) {
      return $this-&gt;barsepstring ( $this-&gt;wiki_namespaces_allnames ( $id_or_name ), $preg_quote, $regex_wikicase );
    } else {
      return $this-&gt;barsepstring ( $this-&gt;wiki_namespace_allnames ( $id_or_name ), $preg_quote, $regex_wikicase );
    }
  }

  public function wiki_namespace_namesregex ( $id_or_name ) {
    $barsepstring = $this-&gt;wiki_namespace_barsepnames ( $id_or_name, true, true );
    if (&nbsp;! $barsepstring ) { return $barsepstring; }
    return '(' . $barsepstring . ')';
  }

  public function title_is_in_namespace ( $title, $namespace ) {
    $title_ns_id = $this-&gt;wiki_namespace_id ( $this-&gt;title_namespace ( $title ) );
    if ( is_int ( $namespace ) ) {
      $namespace_id = $namespace;
    } else {
      $namespace_id = $this-&gt;wiki_namespace_id ( $namespace );
      if ( is_null ( $namespace_id ) ) return NULL;
    }
    return ( $title_ns_id === $namespace_id );
  }

  # ----- Wiki interwikis ----- #

  protected function index_interwikis_urls () {
    if (&nbsp;! empty ( $this-&gt;wiki['interwikimap_indexed'] ) ) { return true; }
    if ( empty ( $this-&gt;wiki['interwikimap'] ) ) { return NULL; }
    $this-&gt;wiki['interwikimap_indexed'] = array();
    foreach ( $this-&gt;wiki['interwikimap'] as &amp;$interwiki ) {
      $this-&gt;wiki['interwikimap_indexed'][$interwiki['url']] = $interwiki;
    }
    return true;
  }

  public function are_wiki_interwikis_obtained () {
    return $this-&gt;wiki_element_is_subarray ( 'interwikimap' );
  }

  public function wiki_interwikis () {
    return $this-&gt;wiki_subarray ( 'interwikimap' );
  }

  public function wiki_interwikis_count () {
    return $this-&gt;wiki_subarray_count ( 'interwikimap' );
  }

  public function wiki_interwikis_prefixes () {
    return $this-&gt;wiki_subarray_elements_elements ( 'interwikimap', 'prefix' );
  }

  public function wiki_interwiki ( $prefix ) {
    return $this-&gt;wiki_subarray_element_by_value ( 'interwikimap', 'prefix', $prefix );
  }

  public function wiki_interwiki_is_present ( $prefix ) {
    $interwiki = $this-&gt;wiki_interwiki ( $prefix );
    if ( $interwiki ) { return true; } else { return $interwiki; }
  }

  public function wiki_interwiki_url ( $prefix ) {
    $interwiki = $this-&gt;wiki_interwiki ( $prefix );
    if ( $interwiki ) { return $interwiki['url']; } else { return $interwiki; }
  }

  public function wiki_interwiki_language ( $prefix ) {
    $interwiki = $this-&gt;wiki_interwiki ( $prefix );
    if ( $interwiki ) { return $interwiki['language']; } else { return $interwiki; }
  }

  public function wiki_interwiki_is_local ( $prefix ) {
    $interwiki = $this-&gt;wiki_interwiki ( $prefix );
    if ( $interwiki ) { return array_key_exists ( 'local', $interwiki ); } else { return $interwiki; }
  }

  public function wiki_interwiki_by_url ( $url ) {
    $index_result = $this-&gt;index_wiki_interwikis_urls();
    if ( $index_result ) {
      $interwiki = $this-&gt;wiki['interwikimap_indexed'][$url];
      if ( empty ( $interwiki ) ) { return false; } else { return $interwiki; }
    } else {
      return $index_result;
    }
  }

  public function wiki_interwikis_by_language ( $language ) {  // language may NOT be unique!
    return $this-&gt;wiki_subarray_elements_by_values ( 'interwikimap', 'language', $language );
  }

  public function wiki_interwikis_barsepnames () {
    return $this-&gt;barsepstring ( $this-&gt;wiki_interwikis_prefixes() );
  }

  public function wiki_interwikis_prefixesregex () {
    return '(' . $this-&gt;wiki_interwikis_barsepnames() . ')';
  }

  # ----- Wiki special page aliases ----- #

  protected function index_specialpagealiases_allnames () {
    if (&nbsp;! empty ( $this-&gt;wiki['specialpagealiases_indexed'] ) ) { return true; }
    if ( empty ( $this-&gt;wiki['specialpagealiases'] ) ) { return NULL; }
    $this-&gt;wiki['specialpagealiases_indexed'] = array();
    foreach ( $this-&gt;wiki['specialpagealiases'] as &amp;$specialpagealias ) {
      $this-&gt;wiki['specialpagealiases_indexed'][$specialpagealias['realname']] = $specialpagealias;
      foreach ( $specialpagealias['aliases'] as $alias ) {
        $this-&gt;wiki['specialpagealiases_indexed'][$alias] = $specialpagealias;
      }
    }
    return true;
  }

  public function are_wiki_specialpagealiases_obtained () {
    return $this-&gt;wiki_element_is_subarray ( 'specialpagealiases' );
  }

  public function wiki_specialpagealiases () {
    return $this-&gt;wiki_subarray ( 'specialpagealiases' );
  }

  public function wiki_specialpagealiases_count () {
    return $this-&gt;wiki_subarray_count ( 'specialpagealiases' );
  }

  public function wiki_specialpagealias ( $name_or_alias ) {
    $index_result = $this-&gt;index_specialpagealiases_allnames();
    if ( $index_result ) {
      $specialpagealias = $this-&gt;wiki['specialpagealiases_indexed'][$name_or_alias];
      if ( empty ( $specialpagealias ) ) { return false; } else { return $specialpagealias; }
    } else {
      return $index_result;
    }
  }

  public function wiki_specialpagealias_by_name ( $realname ) {
    return $this-&gt;wiki_subarray_element_by_value ( 'specialpagealiases', 'realname', $realname );
  }

  public function wiki_specialpagealias_by_alias ( $alias ) {
    if ( is_array ( $this-&gt;wiki['specialpagealiases'] ) ) {
      foreach ( $this-&gt;wiki['specialpagealiases'] as $specialpagealias ) {
        if ( in_array ( $alias, $specialpagealias['aliases'] ) ) {
          return $specialpagealias;
        }
      }
      return false;
    }
    return NULL;
  }

  public function wiki_specialpagealias_name_by_alias ( $alias ) {
    $specialpagealias = $this-&gt;wiki_specialpagealiases_by_alias ( $alias );
    return $specialpagealias['realname'];
  }

  public function wiki_specialpagealias_aliases ( $name_or_alias ) {
    $specialpagealias = $this-&gt;wiki_specialpagealias ( $name_or_alias );
    return $specialpagealias['aliases'];
  }

  public function wiki_specialpagealias_allnames ( $name_or_alias ) {
    $specialpagealias = $this-&gt;wiki_specialpagealias ( $name_or_aliases );
    $aliases = $specialpagealias['aliases'];
    $aliases[] = $specialpagealias['realname'];
    return $aliases;
  }

  public function wiki_specialpagealias_barsepnames ( $name_or_alias, $preg_quote = false, $regex_wikicase = false ) {
    return $this-&gt;barsepstring ( $this-&gt;wiki_specialpagealias_allnames ( $name_or_alias ), $preg_quote, $regex_wikicase );
  }

  public function wiki_specialpagealias_namesregex ( $name_or_alias ) {
    $barsepnames = $this-&gt;wiki_specialpagealias_barsepnames ( $name_or_alias, true, true );
    if (&nbsp;! $barsepnames ) { return $barsepnames; }
    return '(' . $barsepnames . ')';
  }

  public function wiki_specialpagealias_is_present ( $name_or_alias ) {
    $specialpagealias = $this-&gt;wiki_specialpagealias ( $name_or_alias );
    if ( $specialpagealias ) { return true; } else { return $specialpagealias; }
  }

  # ----- Wiki magic words ----- #

  protected function index_megicwords_allnames () {
    if (&nbsp;! empty ( $this-&gt;wiki['magicwords_indexed'] ) ) { return true; }
    if ( empty ( $this-&gt;wiki['magicwords'] ) ) { return NULL; }
    $this-&gt;wiki['magicwords_indexed'] = array();
    foreach ( $this-&gt;wiki['magicwords'] as &amp;$magicword ) {
      $this-&gt;wiki['magicwords_indexed'][$magicword['name']] = $magicword;
      foreach ( $magicword['aliases'] as $alias ) {
        $this-&gt;wiki['magicwords_indexed'][$alias] = $magicword;
      }
    }
    return true;
  }

  public function are_wiki_magicwords_obtained () {
    return $this-&gt;wiki_element_is_subarray ( 'magicwords' );
  }

  public function wiki_magicwords () {
    return $this-&gt;wiki_subarray ( 'magicwords' );
  }

  public function wiki_magicwords_count () {
    return $this-&gt;wiki_subarray_count ( 'magicwords' );
  }

  public function wiki_magicword ( $name_or_alias ) {
    if ( empty ( $this-&gt;wiki['magicwords_indexed'] ) ) { return NULL; }
    $magicword = $this-&gt;wiki['magicwords_indexed'][$name_or_alias];
    if ( empty ( $magicword ) ) { return false; } else { return $magicword; }
  }

  public function wiki_magicword_by_name ( $name ) {
    return $this-&gt;wiki_subarray_element_by_value ( 'magicwords', 'name', $name );
  }

  public function wiki_magicword_by_alias ( $alias ) {
    $magicwords = $this-&gt;wiki_magicwords();
    if ( is_array ( $magicwords ) ) {
      foreach ( $magicwords as $magicword ) {
        if ( in_array ( $alias, $magicword['aliases'] ) ) {
          return $magicword;
        }
      }
    }
    return false;
  }

  public function wiki_magicword_name_by_alias ( $alias ) {
    $magicword = $this-&gt;wiki_magicword_by_alias ( $alias );
    return $magicword['name'];
  }

  public function wiki_magicword_aliases ( $name_or_alias ) {
    $magicword = $this-&gt;wiki_magicword ( $name_or_alias );
    if ( $magicword ) {
      return $magicword['aliases'];
    } else {
      return $magicword;
    }
  }

  public function wiki_magicword_allnames ( $name_or_alias ) {
    $magicword = $this-&gt;wiki_magicword ( $name_or_alias );
    $aliases = $magicword['aliases'];
    $aliases[] = $name_or_alias;
    return $aliases;
  }

  public function wiki_magicword_barsepnames ( $name_or_alias, $preg_quote = false, $regex_wikicase = false ) {
    return $this-&gt;barsepstring ( $this-&gt;wiki_magicword_allnames ( $name_or_alias ), $preg_quote, $regex_wikicase );
  }

  public function wiki_magicword_namesregex ( $name_or_alias ) {
    $barsepstring = $this-&gt;wiki_magicword_barsepnames ( $name_or_alias, true, true );
    if (&nbsp;! $barsepstring ) { return $barsepstring; }
    return '(' . $barsepstring . ')';
  }

  public function wiki_magicword_is_present ( $name_or_alias ) {
    $magicword = $this-&gt;wiki_magicword ( $name_or_alias );
    if ( $magicword ) { return true; } else { return $magicword; }
  }

  public function wiki_magicword_is_case_sensitive ( $name_or_alias ) {
    $magicword = $this-&gt;wiki_magicword ( $name_or_alias );
    if ( is_array ( $magicword ) ) {
      return in_array ( 'case-sensitive', $magicword );
    } else {
      return $magicword;
    }
  }

  # ----- Wiki extensions ----- #

  public function are_wiki_extensions_obtained () {
    return $this-&gt;wiki_element_is_subarray ( 'extensions' );
  }

  public function wiki_extensions () {
    return $this-&gt;wiki_subarray ( 'extensions' );
  }

  public function wiki_extensions_count () {
    return $this-&gt;wiki_subarray_count ( 'extensions' );
  }

  public function wiki_extensions_names () {
    return $this-&gt;wiki_subarray_elements_elements ( 'extensions', 'name' );
  }

  public function wiki_extension ( $name ) {
    return $this-&gt;wiki_subarray_element_by_value ( 'extensions', 'name', $name );
  }

  protected function wiki_extension_element ( $name, $element ) {
    $extension = $this-&gt;wiki_extension ( $name );
    if ( $extension ) { return $extension[$element]; } else { return $extension; }
  }
  public function wiki_extension_type            ( $name ) { return $this-&gt;wiki_extension_element ( $name, 'type'           ); }
  public function wiki_extension_author          ( $name ) { return $this-&gt;wiki_extension_element ( $name, 'author'         ); }
  public function wiki_extension_description     ( $name ) { return $this-&gt;wiki_extension_element ( $name, 'description'    ); }
  public function wiki_extension_description_msg ( $name ) { return $this-&gt;wiki_extension_element ( $name, 'descriptionmsg' ); }
  public function wiki_extension_url             ( $name ) { return $this-&gt;wiki_extension_element ( $name, 'url'            ); }
  public function wiki_extension_version         ( $name ) { return $this-&gt;wiki_extension_element ( $name, 'version'        ); }

  public function wiki_extension_is_present ( $name ) {
    $extension = $this-&gt;wiki_extension ( $name );
    if ( $extension ) { return true; } else { return $extension; }
  }

  public function wiki_extensions_by_type ( $type ) {
    return $this-&gt;wiki_subarray_elements_by_values ( 'extensions', 'type', $type );
  }

  public function wiki_extensions_by_author ( $author ) {
    return $this-&gt;wiki_subarray_elements_by_values ( 'extensions', 'author', $author );
  }

  # ----- Wiki file extensions ----- #

  public function are_wiki_fileextensions_obtained () {
    return $this-&gt;wiki_element_is_subarray ( 'fileextensions' );
  }

  public function wiki_fileextensions () {
    return $this-&gt;wiki_subarray ( 'fileextensions' );
  }

  public function wiki_fileextensions_count () {
    return count ( $this-&gt;wiki_fileextensions() );
  }

  public function wiki_fileextension_is_ok ( $ext ) {
    return $this-&gt;wiki_subarray_element_by_value ( 'fileextensions', 'ext', $ext );
  }

  # ----- Wiki rights info ----- #
  # See also wiki_rights()

  public function wiki_rightsinfo_is_obtained () {
    return $this-&gt;wiki_element_is_subarray ( 'rightsinfo' );
  }

  public function wiki_rightsinfo () {
    return $this-&gt;wiki_subarray ( 'rightsinfo' );
  }

  public function wiki_rightsinfo_url () {
    $rightsinfo = $this-&gt;wiki_rightsinfo();
    return $rightsinfo['url'];
  }

  public function wiki_rightsinfo_text () {
    $rightsinfo = $this-&gt;wiki_rightsinfo();
    return $rightsinfo['text'];
  }

  # ----- Wiki user groups ----- #

  public function are_wiki_usergroups_obtained () {
    return $this-&gt;wiki_element_is_subarray ( 'usergroups' );
  }

  public function wiki_usergroups () {
    return $this-&gt;wiki_subarray ( 'usergroups' );
  }

  public function wiki_usergroups_count () {
    return $this-&gt;wiki_subarray_count ( 'usergroups' );
  }

  public function wiki_usergroups_names () {
    return $this-&gt;wiki_subarray_elements_elements ( 'usergroups', 'name' );
  }

  public function wiki_usergroup ( $name ) {
    return $this-&gt;wiki_subarray_element_by_value ( 'usergroups', 'name', $name );
  }

  public function wiki_usergroup_is_present ( $name ) {
    return (&nbsp;! ( $this-&gt;wiki_usergroup ( $name ) === false ) );
  }

  public function wiki_usergroup_rights ( $name ) {
    $usergroup = $this-&gt;wiki_usergroup ( $name );
    if ( $usergroup ) {
      return $usergroup['rights'];
    } else {
      return $usergroup;
    }
  }

  public function wiki_usergroup_has_right ( $name, $right ) {
    $usergroup = $this-&gt;wiki_usergroup ( $name );
    if ( $usergroup ) {
      return array_key_exists ( $right, $usergroup['rights'] );
    } else {
      return $usergroup;
    }
  }

  public function wiki_usergroups_with_right ( $right ) {  // returns an array, possibly empty
    $usergroups = $this-&gt;wiki_usergroups();
    $right_groups = array();
    foreach ( $usergroups as $usergroup ) {
      if ( $this-&gt;wiki_usergroup_has_right ( $usergroup['name'], $right ) ) {
        $right_groups[] = $usergroup;
      }
    }
    return $right_groups;
  }

  # ----- Wiki statistics ----- #

  public function are_wiki_statistics_obtained () {
    return $this-&gt;wiki_element_is_subarray ( 'statistics' );
  }

  public function wiki_stats_pages       () { return $this-&gt;wiki['statistics']['pages'      ]; }
  public function wiki_stats_articles    () { return $this-&gt;wiki['statistics']['articles'   ]; }
  public function wiki_stats_edits       () { return $this-&gt;wiki['statistics']['edits'      ]; }
  public function wiki_stats_images      () { return $this-&gt;wiki['statistics']['images'     ]; }
  public function wiki_stats_users       () { return $this-&gt;wiki['statistics']['users'      ]; }
  public function wiki_stats_activeusers () { return $this-&gt;wiki['statistics']['activeusers']; }
  public function wiki_stats_admins      () { return $this-&gt;wiki['statistics']['admins'     ]; }
  public function wiki_stats_jobs        () { return $this-&gt;wiki['statistics']['jobs'       ]; }

  # ----- Wiki messages ----- #

  public function are_wiki_messages_fetched () {
    return (&nbsp;! empty ( $this-&gt;wiki['messages'] ) );
  }

  public function fetch_wiki_messages ( $messages = NULL, $filter = NULL, $language = NULL ) {
    if ( is_array ( $messages ) ) {
      $messages = $this-&gt;barsepstring ( $messages );
    }
    return $this-&gt;fetch_messages ( $messages, $filter, $language );
  }

  public function fetch_wiki_messages_if_needed ( $messages = NULL, $filter = NULL, $language = NULL ) {
    if (&nbsp;! $this-&gt;are_wiki_messages_fetched() ) {
      return $this-&gt;fetch_wiki_messages ( $messages, $filter, $language );
    } else {
      return true;
    }
  }

  public function wiki_messages () { return ( empty ( $this-&gt;wiki['messages'] )&nbsp;? false&nbsp;: $this-&gt;wiki['messages'] ); }

  public function wiki_message_by_name ( $name ) {
    if ( empty ( $this-&gt;wiki['messages'] ) ) { return NULL; }
    foreach ( $this-&gt;wiki['messages'] as $message ) {
      if ( $message['name'] == $name ) {
        return $message;
      }
    }
    return false;
  }

  public function wiki_message_text_by_name ( $name ) {
    $message = $this-&gt;wiki_message_by_name ( $name );
    if ( $message ) {
      return $message['text'];
    } else {
      return $message;
    }
  }

  public function wiki_message_by_text ( $text ) {
    if ( empty ( $this-&gt;wiki['messages'] ) ) { return NULL; }
    foreach ( $this-&gt;wiki['messages'] as $message ) {
      if ( $message['*'] == $text ) {
        return $message;
      }
    }
    return false;
  }

  public function wiki_message_name_by_text ( $text ) {
    $message = $this-&gt;wiki_message_by_text ( $text );
    if ( $message ) {
      return $message['name'];
    } else {
      return $message;
    }
  }

  public function wiki_message ( $name_or_text ) {
    $message = $this-&gt;wiki_message_by_name ( $name_or_text );
    if (&nbsp;! $message ) {
      $message = $this-&gt;Wiki_message_by_text ( $name_or_text );
    }
    return $message;
  }

  # ----- User general info ----- #

  public function is_user_info_obtained () { return (&nbsp;! empty ( $this-&gt;user ) ); }

  public function my_userid            () { return $this-&gt;user['id'              ]; }
  public function my_username          () { return $this-&gt;user['name'            ]; }
  public function my_editcount         () { return $this-&gt;user['editcount'       ]; }
  public function my_email             () { return $this-&gt;user['email'           ]; }

  public function my_groups            () { return $this-&gt;user['groups'          ]; }
  public function my_changeable_groups () { return $this-&gt;user['changeablegroups']; }
  public function my_permissions       () { return $this-&gt;user['rights'          ]; }
  public function my_options           () { return $this-&gt;user['options'         ]; }
  public function my_ratelimits        () { return $this-&gt;user['ratelimits'      ]; }

  public function am_i_anonymous () { return array_key_exists ( 'anon', $this-&gt;user ); }

  # ----- User groups ----- #

  public function are_my_groups_obtained () {
    return $this-&gt;user_element_is_subarray ( 'groups' );
  }

  protected function am_i_member_of ( $group ) {
    if ( $this-&gt;are_user_groups_obtained() ) {
      return in_array ( $group, $this-&gt;user['groups'] );
    } else {
      return NULL;
    }
  }
  public function am_i_bot_member   () { return $this-&gt;am_i_member_of ( 'bot'   ); }
  public function am_i_sysop_member () { return $this-&gt;am_i_member_of ( 'sysop' ); }

  # ----- User changeable groups ----- #

  public function are_my_changeable_groups_obtained () {
    return $this-&gt;user_element_is_subarray ( 'changeablegroups' );
  }

  public function my_add_groups () {
    return $this-&gt;user['changeablegroups']['add'];
  }

  public function my_remove_groups () {
    return $this-&gt;user['changeablegroups']['remove'];
  }

  public function my_addself_groups () {
    return $this-&gt;user['changeablegroups']['add-self'];
  }

  public function my_removeself_groups () {
    return $this-&gt;user['changeablegroups']['remove-self'];
  }

  public function can_i_add_group ( $group ) {
    return in_array ( $group, $this-&gt;user['changeablegroups']['add'] );
  }

  public function can_i_remove_group ( $group ) {
    return in_array ( $group, $this-&gt;user['changeablegroups']['remove'] );
  }

  public function can_i_addself_group ( $group ) {
    return in_array ( $group, $this-&gt;user['changeablegroups']['add-self'] );
  }

  public function can_i_removeself_group ( $group ) {
    return in_array ( $group, $this-&gt;user['changeablegroups']['remove-self'] );
  }

  # ----- User rights ----- #

  public function are_user_permissions_obtained () {
    return $this-&gt;user_element_is_subarray ( 'rights' );
  }

  protected function have_i_permission ( $right, $min_wiki_version, $max_wiki_version = NULL ) {
    if ( $this-&gt;are_user_permissions_obtained() &amp;&amp;
         ( $min_wiki_version &lt;= $this-&gt;mw_version_number() ) &amp;&amp;
         ( is_null ( $max_wiki_version ) || ( $this-&gt;mw_version_number() &lt;= $max_wiki_version ) )
       ) {
      return in_array ( $right, $this-&gt;user['rights'] );
    } else {
      return NULL;
    }
  }

  public function am_i_bot                  () { return $this-&gt;have_i_permission ( 'bot'                 , 10500 ); }
  public function am_i_autoconfirmed        () { return $this-&gt;have_i_permission ( 'autoconfirmed'       , 10600 ); }
  public function am_i_emailconfirmed       () { return $this-&gt;have_i_permission ( 'emailconfirmed'      , 10700, 11300 ); }

  public function am_i_ipblock_exempt       () { return $this-&gt;have_i_permission ( 'ipblock-exempt'      , 10900 ); }
  public function am_i_proxyunbannable      () { return $this-&gt;have_i_permission ( 'proxyunbannable'     , 10700 ); }

  public function have_i_highlimits         () { return $this-&gt;have_i_permission ( 'apihighlimits'       , 11200 ); }
  public function have_i_noratelimit        () { return $this-&gt;have_i_permission ( 'noratelimit'         , 11300 ); }

  public function can_i_read                () { return $this-&gt;have_i_permission ( 'read'                , 10500 ); }
  public function can_i_edit                () { return $this-&gt;have_i_permission ( 'edit'                , 10500 ); }
  public function can_i_editprotected       () { return $this-&gt;have_i_permission ( 'editprotected'       , 11300 ); }
  public function can_i_minoredit           () { return $this-&gt;have_i_permission ( 'minoredit'           , 10600 ); }
  public function can_i_skipcaptcha         () { return $this-&gt;have_i_permission ( 'skipcaptcha'         , 11700 ); }  // could not find it described??
  public function can_i_createpage          () { return $this-&gt;have_i_permission ( 'createpage'          , 10600 ); }
  public function can_i_createtalk          () { return $this-&gt;have_i_permission ( 'createtalk'          , 10600 ); }
  public function can_i_nominornewtalk      () { return $this-&gt;have_i_permission ( 'nominornewtalk'      , 10900 ); }
  public function can_i_writeapi            () { return $this-&gt;have_i_permission ( 'writeapi'            , 11300 ); }  // user-specific, unlike api_write_enabled()

  public function can_i_rollback            () { return $this-&gt;have_i_permission ( 'rollback'            , 10500 ); }
  public function can_i_markbotedits        () { return $this-&gt;have_i_permission ( 'markbotedits'        , 11200 ); }

  public function can_i_import              () { return $this-&gt;have_i_permission ( 'import'              , 10500 ); }
  public function can_i_importupload        () { return $this-&gt;have_i_permission ( 'importupload'        , 10500 ); }

  public function can_i_move                () { return $this-&gt;have_i_permission ( 'move'                , 10500 ); }
  public function can_i_movefile            () { return $this-&gt;have_i_permission ( 'movefile'            , 11400 ); }
  public function can_i_move_subpages       () { return $this-&gt;have_i_permission ( 'move-subpages'       , 11300 ); }
  public function can_i_move_rootuserpages  () { return $this-&gt;have_i_permission ( 'move-rootuserpages'  , 11400 ); }
  public function can_i_suppressredirect    () { return $this-&gt;have_i_permission ( 'suppressredirect'    , 11200 ); }

  public function can_i_upload              () { return $this-&gt;have_i_permission ( 'upload'              , 10500 ); }
  public function can_i_reupload            () { return $this-&gt;have_i_permission ( 'reupload'            , 10600 ); }
  public function can_i_reupload_own        () { return $this-&gt;have_i_permission ( 'reupload-own'        , 11100 ); }
  public function can_i_reupload_shared     () { return $this-&gt;have_i_permission ( 'reupload-shared'     , 10600 ); }
  public function can_i_uploadbyurl         () { return $this-&gt;have_i_permission ( 'upload_by_url'       , 10800 ); }

  public function can_i_see_deletedhistory  () { return $this-&gt;have_i_permission ( 'deletedhistory'      , 10600 ); }
  public function can_i_delete              () { return $this-&gt;have_i_permission ( 'delete'              , 10500 ); }
  public function can_i_bigdelete           () { return $this-&gt;have_i_permission ( 'bigdelete'           , 11200 ); }
  public function can_i_purge               () { return $this-&gt;have_i_permission ( 'purge'               , 11000 ); }
  public function can_i_undelete            () {
    $result = $this-&gt;have_i_permission ( 'undelete', 11200 );
    if ( is_null ( $result ) &amp;&amp; ( $this-&gt;mw_version_number() &lt; 11200 ) ) {
      $result = $this-&gt;have_i_permission ( 'delete', 10500 );
    }
    return $result;
  }
  public function can_i_browsearchive       () { return $this-&gt;have_i_permission ( 'browsearchive'       , 11300 ); }
  public function can_i_mergehistory        () { return $this-&gt;have_i_permission ( 'mergehistory'        , 11200 ); }
  public function can_i_suppressrevision    () { return $this-&gt;have_i_permission ( 'suppressrevision'    , 10600 ); }
  public function can_i_deleterevision      () { return $this-&gt;have_i_permission ( 'deleterevision'      , 10600 ); }

  public function can_i_protect             () { return $this-&gt;have_i_permission ( 'protect'             , 10500 ); }

  public function can_i_patrol              () { return $this-&gt;have_i_permission ( 'patrol'              , 10500 ); }
  public function can_i_autopatrol          () { return $this-&gt;have_i_permission ( 'autopatrol'          , 10900 ); }
  public function can_i_hideuser            () { return $this-&gt;have_i_permission ( 'hideuser'            , 11000 ); }

  public function can_i_block               () { return $this-&gt;have_i_permission ( 'block'               , 10500 ); }
  public function can_i_blockemail          () { return $this-&gt;have_i_permission ( 'blockemail'          , 11100 ); }

  public function can_i_createaccount       () { return $this-&gt;have_i_permission ( 'createaccount'       , 10500 ); }
  public function can_i_userrights          () { return $this-&gt;have_i_permission ( 'userrights'          , 10500 ); }
  public function can_i_userrights_interwiki() { return $this-&gt;have_i_permission ( 'userrights-interwiki', 11200 ); }
  public function can_i_editinterface       () { return $this-&gt;have_i_permission ( 'editinterface'       , 10500 ); }
  public function can_i_editusercssjs       () { return $this-&gt;have_i_permission ( 'editusercssjs'       , 11200 ); }
  public function can_i_sendemail           () { return $this-&gt;have_i_permission ( 'sendemail'           , 11700 ); } // could not find it described??

  public function can_i_remove_trackbacks   () { return $this-&gt;have_i_permission ( 'trackback'           , 10700 ); }
  public function can_i_see_unwatchedpages  () { return $this-&gt;have_i_permission ( 'unwatchedpages'      , 10600 ); }

  # ----- User options ----- #

  public function are_my_options_obtained () {
    return $this-&gt;user_element_is_subarray ( 'options' );
  }

  public function my_option ( $name ) {
    return $this-&gt;user['options'][$name];
  }

  # ----- User rate limits ----- #

  public function are_my_ratelimits_obtained () {
    return $this-&gt;user_element_is_subarray ( 'ratelimits' );
  }

  public function my_ratelimit ( $action ) {
    return $this-&gt;user['ratelimits'][$action];
  }

  # ----------  General support  ---------- #

  # ----- Namespaces support ----- #

  public function is_main_namespace_type ( $id_or_name ) {
    $namespace = $this-&gt;wiki_namespace ( $id_or_name );
    return ( ( $namespace['id'] &gt;= 0 ) &amp;&amp; ( ( $namespace['id']&nbsp;% 2 ) == 0 ) );
  }

  public function is_talk_namespace_type ( $id_or_name ) {
    $namespace = $this-&gt;wiki_namespace ( $id_or_name );
    return ( ( $namespace['id'] &gt;= 0 ) &amp;&amp; ( ( $namespace['id']&nbsp;% 2 ) == 1 ) );
  }

  public function is_special_namespace_type ( $id_or_name ) {
    $namespace = $this-&gt;wiki_namespace ( $id_or_name );
    return ( $namespace['id'] &lt; 0 );
  }

  # ----- Page titles support ----- #

  public function title_parts ( $title, $partname = NULL ) {
    $parts = array();
    $pieces = explode ( ':', $title );

    $parts['wiki'] = &quot;&quot;;
    $parts['namespace'] = &quot;&quot;;
    $parts['title'] = end ( $pieces );
    if ( count ( $pieces ) &gt; 1 ) {
      $parts['namespace'] = prev ( $pieces );
      if (&nbsp;! is_int ( $this-&gt;wiki_namespace_id ( $val ) ) ) {
        $parts['wiki'] = $parts['namespace'];
        $parts['namespace'] = &quot;&quot;;
      }
    }
    if ( count ( $pieces ) &gt; 2 ) {
      $parts['wiki'] = prev ( $pieces );
    }

    if ( empty ( $partname ) ) {
      return $parts;
    } else {
      return $parts[$partname];
    }
  }

  public function parts_title ( $parts ) {
    if (&nbsp;! empty ( $parts['wiki'     ] ) ) { $title .= $parts['wiki'     ] . ':'; }
    if (&nbsp;! empty ( $parts['namespace'] ) ) { $title .= $parts['namespace'] . ':'; }
    $title .= $parts['title'];
    return $title;
  }

  public function title_interwiki ( $title ) { return $this-&gt;title_parts ( $title, 'wiki'      ); }
  public function title_namespace ( $title ) { return $this-&gt;title_parts ( $title, 'namespace' ); }
  public function title_pagename  ( $title ) { return $this-&gt;title_parts ( $title, 'title'     ); }

  public function title_namespace_id ( $title ) {
    return $this-&gt;wiki_namespace_id ( $this-&gt;title_namespace ( $title ) );
  }

  public function is_main_page ( $title ) {
    $parts = $this-&gt;title_parts ( $title );
    return $this-&gt;is_main_namespace_type ( $parts['namespace'] );
  }

  public function is_talk_page ( $title ) {
    $parts = $this-&gt;title_parts ( $title );
    return $this-&gt;is_talk_namespace_type ( $parts['namespace'] );
  }

  public function is_special_page ( $title ) {
    $parts = $this-&gt;title_parts ( $title );
    return $this-&gt;is_special_namespace_type ( $parts['namespace'] );
  }

  public function talk_page_title ( $main_page_title ) {
    $parts = $this-&gt;title_parts ( $main_page_title );
    $ns_id = $this-&gt;wiki_namespace_id ( $parts['namespace'] );
    if ( ( $ns_id&nbsp;% 2 ) || ( $ns_id &lt; 0 ) ) {
      return false;
    } else {
      $parts['namespace'] = $this-&gt;wiki_namespace_name ( $ns_id + 1 );
      return $this-&gt;parts_title ( $parts );
    }
  }

  public function main_page_title ( $talk_page_title ) {
    $parts = $this-&gt;title_parts ( $talk_page_title );
    $ns_id = $this-&gt;wiki_namespace_id ( $parts['namespace'] );
    if (&nbsp;! ( $ns_id&nbsp;% 2 ) || ( $ns_id &lt; 0 ) ) {
      return false;
    } else {
      $parts['namespace'] = $this-&gt;wiki_namespace_name ( $ns_id - 1 );
      return $this-&gt;parts_title ( $parts );
    }
  }

  public function maintalk_pages_titles ( $title ) {
    if ( $this-&gt;is_main_page ( $title ) ) {
      return array ( 'main' =&gt; $title, 'talk' =&gt; $this-&gt;talk_page_title ( $title ) );
    } elseif ( $this-&gt;is_talk_page ( $title ) ) {
      return array ( 'main' =&gt; $this-&gt;main_page_title ( $title ), 'talk' =&gt; $title );
    } elseif ( $this-&gt;is_special_page ( $title ) ) {
      return array ( 'special' =&gt; $title );
    } else {
      return false;
    }
  }

  public function wikititle_to_url ( $title ) {
    return urlencode ( $this-&gt;wiki_server() . str_replace ( '$1', $title, $this-&gt;wiki_article_path() ) );
  }

  public function url_to_wikititle ( $url ) {
    $url = urldecode ( $url );
    $wiki_base = $this-&gt;wiki_server() . str_replace ( '$1', '', $this-&gt;wiki_article_path() );
    if ( stripos ( $url, $wiki_base ) === 0 ) {
      return stristr ( $url, $wiki_base );
    } else {
      return false;
    }
  }

  # ----- Common regexes ----- #

  public function regex_wikicase ( $string ) {
    switch ( $this-&gt;wiki_case() ) {
      case 'first-letter'&nbsp;:
        return '(?i)' . mb_substr ( $string, 0, 1, 'utf-8' ) . '(?-i)' . mb_substr ( $string, 1, 10000, 'utf-8' );
      default&nbsp;:
        return $string;
    }
  }

  // matches: 1 - leaging colon, 2 - wiki + colon, 3 - wiki, 4 - namespace + colon, 5 - namespace, 6 - title, 7 - sharp + anchor, 8 - anchor, 9 - bar + text, 10 - text
  public function regexmatch_wikilink ( $leading_colon = NULL, $wiki = NULL, $namespace = NULL, $title = NULL, $anchor = NULL, $text = NULL ) {
    $regex = '\[\[\h*';

    if ( is_null ( $leading_colon ) ) {
      $regex .= '(\:)?\h*';
    } elseif ( $leading_colon === true ) {
      $regex .= '(\:)\h*';
    } else {
      $regex .= '()';
    }

    if ( is_null ( $wiki ) ) {
      $regex .= '(([^\:\#\|\]]+)\:)?\h*';
    } elseif ( $wiki === &quot;&quot; ) {
      $regex .= &quot;(())&quot;;
    } elseif ( $wiki === &quot;*&quot; ) {
      $regex .= '(' . $this-&gt;wiki_interwikis_prefixesregex() . '\h*\:)\h*';
    } else {
      $regex .= '((' . str_replace ( '\|', '|', preg_quote ( $wiki ) ) . ')\h*\:)\h*';
    }

    if ( is_null ( $namespace ) ) {
      $regex .= '(([^\:\#\|\]]+)\:)?\h*';
    } elseif ( $namespace === &quot;&quot; ) {
      $regex .= &quot;(())&quot;;
    } elseif ( $namespace === &quot;*&quot; ) {
      $regex .= '(' . $this-&gt;wiki_namespace_namesregex ( NULL ) . '\h*\:\h*';
    } else {
      $regex .= '((' . str_replace ( '\|', '|', preg_quote ( $namespace ) ) . ')\h*\:)\h*';
    }

    if ( is_null ( $title ) ) {
      $regex .= '([^\#\|\]]+)';
    } elseif ( $title === &quot;&quot; ) {
      $regex .= &quot;()&quot;;
    } else {
      $regex .= '(' . str_replace ( '\|', '|', preg_quote ( $title ) ) . ')';
    }

    if ( is_null ( $anchor ) ) {
      $regex .= '(\#([^\|\]]*))?';
    } elseif ( $anchor === &quot;&quot; ) {
      $regex .= '(())';
    } else {
      $regex .= '(\#(' . preg_quote ( $anchor ) . '))';
    }

    if ( is_null ( $text ) ) {
      $regex .= '(\|(\[\[[^\]]*\]\]|[^\]]*))?';
    } elseif ( $text === &quot;&quot; ) {
      $regex .= '(())';
    } else {
      $regex .= '(\|(' . preg_quote ( $text ) . '))';
    }

    $regex .= '\]\]';

    return $regex;
  }

  public function regex_wikilink ( $leading_colon = NULL, $wiki = NULL, $namespace = NULL, $title = NULL, $anchor = NULL, $text = NULL ) {
    return '/' . $this-&gt;regexmatch_wikilink ( $leading_colon, $wiki, $namespace, $title, $anchor, $text ) . '/u';
  }

}
</pre>

<!-- 
NewPP limit report
Preprocessor node count: 4/1000000
Post-expand include size: 0/2097152 bytes
Template argument size: 0/2097152 bytes
Expensive parser function count: 0/100
-->

<!-- Saved in parser cache with key wikidb_apibot:pcache:idhash:42-0!1!0!!en!2!edit=0 and timestamp 20120915130227 -->
<div class="printfooter">
Retrieved from "<a href="http://apibot.zavinagi.org/index.php/Development_code/Apibot.php">http://apibot.zavinagi.org/index.php/Development_code/Apibot.php</a>"</div>
		<div id='catlinks' class='catlinks catlinks-allhidden'></div>		<!-- end content -->
				<div class="visualClear"></div>
	</div>
</div></div>
<div id="column-one">
	<div id="p-cactions" class="portlet">
		<h5>Views</h5>
		<div class="pBody">
			<ul>
				 <li id="ca-nstab-main" class="selected"><a href="/index.php/Development_code/Apibot.php" title="View the content page [c]" accesskey="c">Page</a></li>
				 <li id="ca-talk" class="new"><a href="/index.php?title=Talk:Development_code/Apibot.php&amp;action=edit&amp;redlink=1" title="Discussion about the content page [t]" accesskey="t">Discussion</a></li>
				 <li id="ca-viewsource"><a href="/index.php?title=Development_code/Apibot.php&amp;action=edit" title="This page is protected.&#10;You can view its source [e]" accesskey="e">View source</a></li>
				 <li id="ca-history"><a href="/index.php?title=Development_code/Apibot.php&amp;action=history" title="Past revisions of this page [h]" accesskey="h">History</a></li>
			</ul>
		</div>
	</div>
	<div class="portlet" id="p-personal">
		<h5>Personal tools</h5>
		<div class="pBody">
			<ul>
				<li id="pt-login"><a href="/index.php?title=Special:UserLogin&amp;returnto=Development_code/Apibot.php" title="You are encouraged to log in; however, it is not mandatory [o]" accesskey="o">Log in</a></li>
			</ul>
		</div>
	</div>
	<div class="portlet" id="p-logo">
		<a style="background-image: url(/skins/common/images/wiki.png);" href="/index.php/Main_Page" title="Visit the main page"></a>
	</div>
	<script type="text/javascript"> if (window.isMSIE55) fixalpha(); </script>
	<div class='generated-sidebar portlet' id='p-navigation'>
		<h5>Navigation</h5>
		<div class='pBody'>
			<ul>
				<li id="n-mainpage-description"><a href="/index.php/Main_Page" title="Visit the main page [z]" accesskey="z">Main page</a></li>
				<li id="n-portal"><a href="/index.php/Apibot:Community_portal" title="About the project, what you can do, where to find things">Community portal</a></li>
				<li id="n-currentevents"><a href="/index.php/Apibot:Current_events" title="Find background information on current events">Current events</a></li>
				<li id="n-recentchanges"><a href="/index.php/Special:RecentChanges" title="The list of recent changes in the wiki [r]" accesskey="r">Recent changes</a></li>
				<li id="n-randompage"><a href="/index.php/Special:Random" title="Load a random page [x]" accesskey="x">Random page</a></li>
				<li id="n-help"><a href="/index.php/Help:Contents" title="The place to find out">Help</a></li>
			</ul>
		</div>
	</div>
	<div id="p-search" class="portlet">
		<h5><label for="searchInput">Search</label></h5>
		<div id="searchBody" class="pBody">
			<form action="/index.php" id="searchform">
				<input type='hidden' name="title" value="Special:Search"/>
				<input id="searchInput" title="Search Apibot" accesskey="f" type="search" name="search" />
				<input type='submit' name="go" class="searchButton" id="searchGoButton"	value="Go" title="Go to a page with this exact name if exists" />&nbsp;
				<input type='submit' name="fulltext" class="searchButton" id="mw-searchButton" value="Search" title="Search the pages for this text" />
			</form>
		</div>
	</div>
	<div class="portlet" id="p-tb">
		<h5>Toolbox</h5>
		<div class="pBody">
			<ul>
				<li id="t-whatlinkshere"><a href="/index.php/Special:WhatLinksHere/Development_code/Apibot.php" title="List of all wiki pages that link here [j]" accesskey="j">What links here</a></li>
				<li id="t-recentchangeslinked"><a href="/index.php/Special:RecentChangesLinked/Development_code/Apibot.php" title="Recent changes in pages linked from this page [k]" accesskey="k">Related changes</a></li>
<li id="t-specialpages"><a href="/index.php/Special:SpecialPages" title="List of all special pages [q]" accesskey="q">Special pages</a></li>
				<li id="t-print"><a href="/index.php?title=Development_code/Apibot.php&amp;printable=yes" rel="alternate" title="Printable version of this page [p]" accesskey="p">Printable version</a></li>				<li id="t-permalink"><a href="/index.php?title=Development_code/Apibot.php&amp;oldid=290" title="Permanent link to this revision of the page">Permanent link</a></li>			</ul>
		</div>
	</div>
</div><!-- end of the left (by default at least) column -->
<div class="visualClear"></div>
<div id="footer">
	<div id="f-poweredbyico"><a href="http://www.mediawiki.org/"><img src="/skins/common/images/poweredby_mediawiki_88x31.png" height="31" width="88" alt="Powered by MediaWiki" /></a></div>
	<ul id="f-list">
		<li id="lastmod"> This page was last modified on 4 March 2012, at 16:06.</li>
		<li id="viewcount">This page has been accessed 1,850 times.</li>
		<li id="privacy"><a href="/index.php/Apibot:Privacy_policy" title="Apibot:Privacy policy">Privacy policy</a></li>
		<li id="about"><a href="/index.php/Apibot:About" title="Apibot:About">About Apibot</a></li>
		<li id="disclaimer"><a href="/index.php/Apibot:General_disclaimer" title="Apibot:General disclaimer">Disclaimers</a></li>
	</ul>
</div>
</div>

<script>if (window.runOnloadHook) runOnloadHook();</script>
<!-- Served in 0.133 secs. --></body></html>
