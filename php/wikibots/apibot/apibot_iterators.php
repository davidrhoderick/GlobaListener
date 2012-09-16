<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" dir="ltr">
<head>
<title>Development code/Apibot iterators.php - Apibot</title>
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
wgPageName="Development_code/Apibot_iterators.php",
wgTitle="Development code/Apibot iterators.php",
wgAction="view",
wgArticleId=47,
wgIsArticle=true,
wgUserName=null,
wgUserGroups=null,
wgUserLanguage="en",
wgContentLanguage="en",
wgBreakFrames=false,
wgCurRevisionId=283,
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
<body class="mediawiki ltr ns-0 ns-subject page-Development_code_Apibot_iterators_php skin-monobook">
<div id="globalWrapper">
<div id="column-content"><div id="content" >
	<a id="top"></a>
	
	<h1 id="firstHeading" class="firstHeading">Development code/Apibot iterators.php</h1>
	<div id="bodyContent">
		<h3 id="siteSub">From Apibot</h3>
		<div id="contentSub"></div>
		<div id="jump-to-nav">Jump to: <a href="#column-one">navigation</a>, <a href="#searchInput">search</a></div>
		<!-- start content -->
<p>This is the development code for the Apibot iterators module.
</p>
<pre>
&lt;?php
#
#  An Apibot extension - Iterators. Used together with ActionObjects.
#
#  Example for usage:
#
#  $bot = new Apibot ( $bot_login_data, $logname );
#  $bot-&gt;enter_wiki();  // mandatory for some iterators to work
#  $Iterator = new Iterator_WhateverTypeYouNeed ( $bot );
#  $ActionObject = new ActionObject_WhateverActionYouNeed();
#  $processed_elements_count = $Iterator-&gt;iterate ( $ActionObject );
#
#  -----
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
#  You should have received a copy of the GNU General Public License along
#  with this program; if not, write to the Free Software Foundation, Inc.,
#  59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
#  http://www.gnu.org/copyleft/gpl.html
#
#  Author: Grigor Gatchev &lt;grigor at gatchev dot info&gt;
#
#  --------------------------------------------------------------------------- #

require_once ( dirname ( __FILE__ ) . '/apibot.php' );
require_once ( dirname ( __FILE__ ) . '/apibot_actionobjects.php' );  // not really needed, but convenient


# ----- -----  Iterator classes  ----- ----- #

# ----------  Generic iterator class  ---------- #


abstract class Iterator_Generic {
// A base for all iterator classes, both these that use the bot as elements source and others.
// Since this is an Apibot module, a bot will always be needed eventually.

  public $elements_counter = 0;
  public $elements_limit = PHP_INT_MAX;

  public $abort_iteration = false;

  public $bot;

  # ----------  Constructor  ---------- #

  function __construct ( $bot ) {
    $this-&gt;bot = $bot;
  }

  # ----------  Protected  ---------- #

  protected function log ( $string, $loglevel = LL_INFO ) {
    $this-&gt;bot-&gt;log ( $string, $loglevel );
  }

  protected function appropriate_actionobject_type () {  // override with more specific on need.
    return 'ActionObject';
  }

  protected function iterate_element ( $element, $ActionObject ) {  // override to modify the behaviour
    if ( is_object ( $ActionObject ) ) {
      return $ActionObject-&gt;process ( $element );
    } elseif ( is_string ( $ActionObject ) || is_array ( $ActionObject ) ) {
      return call_user_func ( $ActionObject, $element, $this, $this-&gt;bot );
    }
  }

  protected function iterate_elements ( $ActionObject ) {  // override to modify the behaviour
    if (&nbsp;! $this-&gt;open_elements_source() ) { $this-&gt;log ( $this-&gt;error_info(), LL_ERROR ); }
    $result = $this-&gt;query();
    if (&nbsp;! $result ) { $this-&gt;log ( $this-&gt;error_info(), LL_ERROR ); }
    while ( $result ) {
      $elements_array = $this-&gt;obtain_elements_array();
      if ( $elements_array&nbsp;!== false ) {
        foreach ( $elements_array as $element ) {
          if ( $this-&gt;iterate_element ( $element, $ActionObject ) ) { $this-&gt;elements_counter += 1; }
          if ( $this-&gt;abort_iteration || ( $this-&gt;elements_counter == $this-&gt;elements_limit ) ) { break 2; }
        }
        $result = $this-&gt;continue_query();
      } else {
        break;
      }

    }
    if (&nbsp;! $this-&gt;close_elements_source() ) { $this-&gt;log ( $this-&gt;error_info(), LL_ERROR ); }
    return $this-&gt;elements_counter;
  }

  protected function pre_iterate_elements ( $ActionObject ) {  // override if necessary
    return $ActionObject-&gt;preprocess ();
  }

  protected function post_iterate_elements ( $ActionObject ) {  // override if necessary
    return $ActionObject-&gt;postprocess ();
  }

  protected function  open_elements_source () { return true; }
  protected function close_elements_source () { return true; }

  abstract protected function query();

  abstract protected function continue_query();

  abstract protected function obtain_elements_array();

  abstract protected function error_info();

  # ----------  Public  ---------- #

  public function iterate ( $ActionObject ) {
    if ( is_object ( $ActionObject ) ) {
      $appropriate_actionobject_type = $this-&gt;appropriate_actionobject_type();
      if ( $ActionObject instanceof $appropriate_actionobject_type ) {
        if ( $this-&gt;pre_iterate_elements ( $ActionObject ) ) {
          $this-&gt;elements_counter = 0;
          $ActionObject-&gt;iterator = $this;
          $result = $this-&gt;iterate_elements ( $ActionObject );
          $this-&gt;post_iterate_elements ( $ActionObject );
          return $result;
        }
      } else {
        $this-&gt;log ( &quot;Inapropriate action object type -- aborting!&quot;, LL_ERROR );
        return false;
      }
    } elseif ( is_string ( $ActionObject ) || is_array ( $ActionObject ) ) {
      return $this-&gt;iterate_elements ( $ActionObject );
    } else {
      $this-&gt;log ( &quot;I don't know how to use such an action object!&quot;, LL_ERROR );
      return false;
    }
  }

}


# ----------  Generic Apibot iterator class  ---------- #

abstract class Iterator_Apibot_Generic extends Iterator_Generic {

  # ----------  Protected  ---------- #

  protected function error_info () {
    return $this-&gt;bot-&gt;error_string();
  }

  protected function iterate_element ( $element, $ActionObject ) {
    $this-&gt;bot-&gt;push_bot_state();
    $result = parent::iterate_element ( $element, $ActionObject );
    $this-&gt;bot-&gt;pop_bot_state();
    return $result;
  }

}

# ----------  Generic API iterator class  ---------- #

abstract class Iterator_GenericAPI extends Iterator_Apibot_Generic {

  protected $query_datatree_element_name;  // to be overridden!
  protected $element_object_class_name;    // to be overridden!

  # ----------  Private  ---------- #

  # ----- Obtaining requested data from the request response ----- #

  private function check_data_elements_for_errors ( $elements ) {
    $counter = 0;
    while ( true ) {
      $counter--;
      if ( array_key_exists ( $counter, $elements ) ) {
        $error = $elements[$counter];
        if ( array_key_exists ( &quot;invalid&quot;, $error ) ) {
          $this-&gt;bot-&gt;error['type'] = 2;
          $this-&gt;bot-&gt;error['code'] = &quot;invalid_element&quot;;
          $this-&gt;bot-&gt;error['info'] = &quot;Invalid element data supplied!&quot;;
          return true;
        }
      } else {
        break;
      }
    }
    return false;
  }

  private function dispatch_data_element ( $data_element ) {
    $object = new $this-&gt;element_object_class_name;
    $object-&gt;read_from_element ( $data_element, $this-&gt;bot );
    return $object;
  }

  # ----------  Protected  ---------- #

  # ----- Tools ----- #

  protected function add_nonempty ( &amp;$params, $param, $key, $minimal_mw_version = 11000 ) {
    if ( $minimal_mw_version &lt;= $this-&gt;bot-&gt;mw_version_number() ) {
      if (&nbsp;! empty ( $param ) ) {
        $params[$key] = $param;
      }
    }
  }

  protected function add_namespace ( &amp;$params, $namespace, $key = 'namespace' ) {
    if (&nbsp;! is_null ( $namespace ) ) {
      $ns_code = $this-&gt;bot-&gt;wiki_namespace_id ( $namespace );
      if ( $ns_code === false ) {
        if ( is_numeric ( $namespace ) ) {
          $params[$key] = $namespace;
        } else {
          $this-&gt;log ( &quot;Bad namespace: &quot; . $namespace . &quot;!&quot;, LL_ERROR );
        }
      } else {
        $params[$key] = $ns_code;
      }
    }
  }

  protected function add_startenddir ( &amp;$params, $start, $end, $suffix = NULL ) {
    if (&nbsp;! is_null ( $start ) ) { $params['start'.$suffix] = $start; }
    if (&nbsp;! is_null ( $end   ) ) { $params['end'  .$suffix] = $end &nbsp;; }
    if (&nbsp;! ( is_null ( $start ) || is_null ( $end ) ) ) {
      if ( $start &gt;= $end ) {
        $params['dir'] = 'older';
      } else {
        $params['dir'] = 'newer';
      }
    }
  }

  protected function add_user ( &amp;$params, $user ) {
    if (&nbsp;! empty ( $user ) ) {
      if ( mb_substr ( $user, 0, 1 ) == '!' ) {
        $params['excludeuser'] = mb_substr ( $user, 1 );
      } else {
        $params['user'] = $user;
      }
    }
  }

  protected function add_boolbang ( &amp;$array, $bool, $string, $minimal_mw_version = 11000 ) {
    if ( $minimal_mw_version &lt;= $this-&gt;bot-&gt;mw_version_number() ) {
      if ( $bool === true ) {
        $array[] = $string;
      } elseif ( $bool === false ) {
        $array[] = '!' . $string;
      }
    }
  }

  protected function add_boolkey ( &amp;$array, $bool, $key, $value = '' ) {
    if ( $bool === true ) {
      $array[$key] = $value;
    }
  }

  protected function add_boolvalue ( &amp;$array, $bool, $value, $minimal_mw_version = 11000 ) {
    if ( $minimal_mw_version &lt;= $this-&gt;bot-&gt;mw_version_number() ) {
      if ( $bool === true ) {
        $array[] = $value;
      }
    }
  }

  # ----- API querying ----- #

  protected function query_elements_array ( $query_tree ) {  // override further for the general types classes!
    if (&nbsp;! is_array ( $query_tree ) ) { return false; }
    if (&nbsp;! empty ( $this-&gt;bot-&gt;error ) ) { return false; }
    if ( array_key_exists ( $this-&gt;query_datatree_element_name, $query_tree ) ) {
      return $query_tree[$this-&gt;query_datatree_element_name];
    } else {
      return false;
    }
  }

  protected function obtain_elements_array () {
    $data_elements = $this-&gt;query_elements_array ( $this-&gt;bot-&gt;query_tree() );
    if ( $data_elements === false ) {
      return array();
    } else {
      if ( $this-&gt;check_data_elements_for_errors ( $data_elements ) ) {
        return false;
      } else {
        $data_objects = array();
        foreach ( $data_elements as $data_element ) {
          $data_objects[] = $this-&gt;dispatch_data_element ( $data_element );
        }
        return $data_objects;
      }
    }
  }

  protected function continue_query () {
    return $this-&gt;bot-&gt;continue_query();
  }

}


# ----------  List members iterator classes  ---------- #


abstract class Iterator_ListMembers extends Iterator_GenericAPI {

  protected $list_code;  // to be 'overridden'

  public $limit = &quot;max&quot;;

  public $titles  = array();  // titles of the pages who can be processed (valid only in some iterators)
  public $pageids = array();
  public $revids  = array();

  # ----------  Protected  ---------- #

  protected function query () {  // overrides abstract
    $listparams = $this-&gt;gather_list_params();
    $params     = $this-&gt;gather_params();
    return $this-&gt;bot-&gt;query_list ( $this-&gt;query_datatree_element_name, $this-&gt;list_code, $listparams, $params );
  }

  protected function gather_params () {
    $params = array();
    $this-&gt;add_nonempty ( $params, $this-&gt;titles , 'titles' , 11200 );
    $this-&gt;add_nonempty ( $params, $this-&gt;pageids, 'pageids', 11200 );
    $this-&gt;add_nonempty ( $params, $this-&gt;revids , 'revids' , 11200 );
    return $params;
  }

  protected function gather_list_params () {
    $params = array();
    $this-&gt;add_nonempty ( $params, $this-&gt;limit, 'limit', 11200 );
    return $params;
  }

}


class Iterator_RecentChanges extends Iterator_ListMembers {

  protected $query_datatree_element_name = 'recentchanges';  // overrides 'abstract'
  protected $element_object_class_name   = 'RecentChange';   // overrides 'abstract'
  protected $list_code = 'rc';

  public $start;         // datetime
  public $end;           // datetime (if before $start, iteration goes from $end to $start)
  public $namespace = NULL;  // NULL - all namespaces, &quot;&quot; or 0 - main namespace, etc.
  public $user;          // username/IP, or NULL for all users
  public $type;          // rc entry types to obtain - 'edit, 'new', 'log'
  public $show_minor;    // NULL, true (minor only), false (non-minor only)
  public $show_anon;     // like $show_minor, for anonymous edits
  public $show_bot;      // like $show_minor, for bot edits
  public $show_redirect; // like $show_minor, for redirect pages
  public $show_patrolled;// will work only if the bot has the patrol right
  public $get_user      = true;
  public $get_comment   = true;
  public $get_timestamp = true;
  public $get_title     = true;
  public $get_ids       = true;
  public $get_sizes     = true;
  public $get_redirect  = true;
  public $get_patrolled = true;
  public $get_loginfo   = true;
  public $get_flags     = true;

  protected function gather_list_params () {
    $mw_version_number = $this-&gt;bot-&gt;mw_version_number();

    $params = parent::gather_list_params();

    $this-&gt;add_startenddir ( $params, $this-&gt;start, $this-&gt;end );
    $this-&gt;add_namespace   ( $params, $this-&gt;namespace );
    $this-&gt;add_user        ( $params, $this-&gt;user );
    $this-&gt;add_nonempty    ( $params, $this-&gt;type, 'type' );

    $show = array();
    $this-&gt;add_boolbang ( $show, $this-&gt;show_minor    , 'minor'     );
    $this-&gt;add_boolbang ( $show, $this-&gt;show_anon     , 'anon'      );
    $this-&gt;add_boolbang ( $show, $this-&gt;show_bot      , 'bot'       );
    $this-&gt;add_boolbang ( $show, $this-&gt;show_redirect , 'redirect'  );
    if ( $this-&gt;bot-&gt;can_i_patrol() ) {
      $this-&gt;add_boolbang ( $show, $this-&gt;show_patrolled, 'patrolled', 11300 );
    }
    $this-&gt;add_nonempty ( $params, $this-&gt;bot-&gt;barsepstring ( $show ), 'show' );

    $prop = array();
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_user     , 'user'      );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_comment  , 'comment'   );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_timestamp, 'timestamp' );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_title    , 'title'     );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_ids      , 'ids'       );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_sizes    , 'sizes'     );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_redirect , 'redirect', 11300 );
    if ( $this-&gt;bot-&gt;can_i_patrol() ) {
      $this-&gt;add_boolvalue ( $prop, $this-&gt;get_patrolled, 'patrolled', 11300 );
    }
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_loginfo  , 'loginfo' , 11300 );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_flags    , 'flags'     );
    $this-&gt;add_nonempty ( $params, $this-&gt;bot-&gt;barsepstring ( $prop ), 'prop' );

    return $params;
  }

}


class Iterator_UserContribs extends Iterator_ListMembers {

  protected $query_datatree_element_name = 'usercontribs';  // overrides 'abstract'
  protected $element_object_class_name   = 'UserContrib';   // overrides 'abstract'
  protected $list_code = 'uc';

  public $user;            // mandatory, unless $userprefix is specified
  public $userprefix;      // overrides $user
  public $start;           // datetime
  public $end;             // datetime (if before $start, iteration goes from $end to $start)
  public $namespace = NULL;// NULL - all namespaces, &quot;&quot; or 0 - main namespace, etc.
  public $show_minor;      // NULL, true (minor only), false (non-minor only)
  public $show_patrolled;  // will work only if the user has patrol right
  public $get_ids       = true;
  public $get_title     = true;
  public $get_timestamp = true;
  public $get_comment   = true;
  public $get_patrolled = true;
  public $get_flags     = true;

  protected function gather_list_params () {
    if ( empty ( $this-&gt;user ) &amp;&amp; empty ( $this-&gt;userprefix ) ) {
      $this-&gt;log ( &quot;UserContribs request: neither user nor userprefix are specified - no data will be obtained!&quot;, LL_ERROR );
    }
    if (&nbsp;! empty ( $this-&gt;userprefix ) ) { $this-&gt;user = NULL; }

    $params = parent::gather_list_params();

    $this-&gt;add_startenddir ( $params, $this-&gt;start, $this-&gt;end );
    $this-&gt;add_namespace   ( $params, $this-&gt;namespace );
    $this-&gt;add_nonempty    ( $params, $this-&gt;user      , 'user' );
    $this-&gt;add_nonempty    ( $params, $this-&gt;userprefix, 'userprefix' );

    $show = array();
    $this-&gt;add_boolbang ( $show, $this-&gt;show_minor    , 'minor'     );
    if ( $this-&gt;bot-&gt;can_i_patrol() ) {
      $this-&gt;add_boolbang ( $show, $this-&gt;show_patrolled, 'patrolled', 11400 );
    }
    $this-&gt;add_nonempty ( $params, $this-&gt;bot-&gt;barsepstring ( $show ), 'show' );

    $prop = array();
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_ids      , 'ids'       );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_title    , 'title'     );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_timestamp, 'timestamp' );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_comment  , 'comment'   );
    if ( $this-&gt;bot-&gt;can_i_patrol() ) {
      $this-&gt;add_boolvalue ( $prop, $this-&gt;get_patrolled, 'patrolled', 11400 );
    }
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_flags    , 'flags'     );
    $this-&gt;add_nonempty ( $params, $this-&gt;bot-&gt;barsepstring ( $prop ), 'prop' );

    return $params;
  }

}


class Iterator_AllUsers extends Iterator_ListMembers {

  protected $query_datatree_element_name = 'allusers';  // overrides 'abstract'
  protected $element_object_class_name   = 'User';   // overrides 'abstract'
  protected $list_code = 'au';

  public $from;    // user to start with
  public $prefix;  // username prefix
  public $group;   // could be any defined group; 'bot', 'sysop' and 'bureaucrat' are common
  public $get_editcount    = true;
  public $get_groups       = true;
  public $get_registration = true;

  protected function gather_list_params () {
    $params = parent::gather_list_params();

    $this-&gt;add_nonempty ( $params, $this-&gt;from  , 'from'   );
    $this-&gt;add_nonempty ( $params, $this-&gt;prefix, 'prefix' );
    $this-&gt;add_nonempty ( $params, $this-&gt;group , 'group'  );

    $prop = array();
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_editcount   , 'editcount'    );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_groups      , 'groups'       );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_registration, 'registration' );
    $this-&gt;add_nonempty ( $params, $this-&gt;bot-&gt;barsepstring ( $prop ), 'prop' );

    return $params;
  }

}


class Iterator_Blocks extends Iterator_ListMembers {

  protected $query_datatree_element_name = 'blocks';  // overrides 'abstract'
  protected $element_object_class_name   = 'Block';   // overrides 'abstract'
  protected $list_code = 'bk';

  public $start;        // datetime
  public $end;          // datetime (if before $start, iteration goes from $end to $start)
  public $ids;          // will iterate these block IDs
  public $users;        // will iterate blocks of these users
  public $ip;           // will iterate blocks affecting this IP address / CIDR range (ranges cannot be larger than /16)
  public $get_id        = true;
  public $get_user      = true;
  public $get_by        = true;
  public $get_timestamp = true;
  public $get_expiry    = true;
  public $get_reason    = true;
  public $get_range     = true;
  public $get_flags     = true;

  protected function gather_list_params () {
    $params = parent::gather_list_params();

    $this-&gt;add_startenddir ( $params, $this-&gt;start, $this-&gt;end );
    $this-&gt;add_nonempty ( $params, $this-&gt;ids  , 'ids'   );
    $this-&gt;add_nonempty ( $params, $this-&gt;users, 'users' );
    $this-&gt;add_nonempty ( $params, $this-&gt;ip   , 'ip'    );

    $prop = array();
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_id       , 'id'        );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_user     , 'user'      );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_by       , 'by'        );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_timestamp, 'timestamp' );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_expiry   , 'expiry'    );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_reason   , 'reason'    );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_range    , 'range'     );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_flags    , 'flags'     );
    $this-&gt;add_nonempty ( $params, $this-&gt;bot-&gt;barsepstring ( $prop ), 'prop' );

    return $params;
  }

}


class Iterator_LogEvents extends Iterator_ListMembers {

  protected $query_datatree_element_name = 'logevents';  // overrides 'abstract'
  protected $element_object_class_name   = 'LogEvent';   // overrides 'abstract'
  protected $list_code = 'le';

  public $start;        // datetime
  public $end;          // datetime (if before $start, iteration goes from $end to $start)
  public $user;         // will iterate log events caused by this user
  public $title;        // will iterate log events concerning this page title
  public $type;         // 'block', 'protect', 'rights', 'delete', 'upload', 'move', 'import', 'patrol', 'merge', 'newusers'
  public $get_ids       = true;
  public $get_title     = true;
  public $get_type      = true;
  public $get_user      = true;
  public $get_timestamp = true;
  public $get_comment   = true;
  public $get_details   = true;

  protected function gather_list_params () {
    $params = parent::gather_list_params();

    $this-&gt;add_startenddir ( $params, $this-&gt;start, $this-&gt;end );
    $this-&gt;add_nonempty ( $params, $this-&gt;user , 'user'  );
    $this-&gt;add_nonempty ( $params, $this-&gt;title, 'title' );
    $this-&gt;add_nonempty ( $params, $this-&gt;type , 'type'  );

    $prop = array();
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_ids      , 'ids'       );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_title    , 'title'     );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_type     , 'type'      );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_user     , 'user'      );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_timestamp, 'timestamp' );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_comment  , 'comment'   );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_details  , 'details'   );
    $this-&gt;add_nonempty ( $params, $this-&gt;bot-&gt;barsepstring ( $prop ), 'prop' );

    return $params;
  }

}


class Iterator_DeletedRevs extends Iterator_ListMembers {
// You can iterate the deleted revs EITHER for certain titles, OR for certain user, OR for certain namespace!

  protected $query_datatree_element_name = 'deletedrevs';     // overrides 'abstract'
  protected $element_object_class_name   = 'DeletedRevision'; // overrides 'abstract'
  protected $list_code = 'dr';

  public $start;      // datetime
  public $end;        // datetime (if before $start, iteration goes from $end to $start)
  public $user;              // only iterate revisions deleted by this user ('!user' - not by this user)
  public $namespace = NULL;  // NULL - all namespaces, &quot;&quot; or 0 - main namespace, etc.
                             // set only one of $titles, $user and $namespace!
  public $from;              // will start from this title
  public $unique = false;    // list only one revision for each page?
  public $get_revid   = true;
  public $get_user    = true;
  public $get_comment = true;
  public $get_minor   = true;
  public $get_len     = true;
  public $get_content = true;
  public $get_token   = true;

  protected function gather_list_params () {
    if (&nbsp;! $this-&gt;bot-&gt;can_i_see_deletedhistory() ) {
      $this-&gt;log ( &quot;Deleted revisions requested without having the right 'deletedhistory' - no data will be obtained!&quot;, LL_ERROR );
    }

    if ( $this-&gt;bot-&gt;mw_version_number() &lt; 11300 ) $this-&gt;limit = NULL;  // MW 1.12 deletedrevs module doesn't understand limit=max
    $params = parent::gather_list_params();

    $this-&gt;add_startenddir ( $params, $this-&gt;start, $this-&gt;end );
    if ( empty ( $this-&gt;titles ) ) {
      if (&nbsp;! empty ( $this-&gt;user ) ) {
        $this-&gt;add_user      ( $params, $this-&gt;user, 'user'  );
      } else {
        $this-&gt;add_namespace ( $params, $this-&gt;namespace );
      }
    }
    $this-&gt;add_nonempty    ( $params, $this-&gt;from  , 'from'  );
    $this-&gt;add_boolkey     ( $params, $this-&gt;unique, 'unique' );

    $prop = array();
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_revid  , 'revid'   );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_user   , 'user'    );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_comment, 'comment' );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_minor  , 'minor'   );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_len    , 'len'     );
    if ( $this-&gt;bot-&gt;can_i_undelete() ) {
      $this-&gt;add_boolvalue ( $prop, $this-&gt;get_content, 'content' );
    }
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_token  , 'token'   );
    $this-&gt;add_nonempty ( $params, $this-&gt;bot-&gt;barsepstring ( $prop ), 'prop' );

    return $params;
  }

  protected function query_elements_array ( $data_tree ) {
    $page_elements = parent::query_elements_array ( $data_tree );
    $deleted_revisions_elements = array();
    foreach ( $page_elements as $page_element ) {
      foreach ( $page_element['revisions'] as $revision_element ) {
        $revision_element['title'] = $page_element['title'];
        $revision_element['token'] = $page_element['token'];
        $deleted_revisions_elements[] = $revision_element;
      }
    }
    return $deleted_revisions_elements;
  }

}


class Iterator_Users extends Iterator_ListMembers {

  protected $query_datatree_element_name = 'users';  // overrides 'abstract'
  protected $element_object_class_name   = 'User';   // overrides 'abstract'
  protected $list_code = 'us';

  public $users = array();  // list of users names to get info about - mandatory!
  public $get_token_rights = true;
  public $get_blockinfo    = true;
  public $get_groups       = true;
  public $get_editcount    = true;
  public $get_registration = true;
  public $get_emailable    = true;

  protected function gather_list_params () {
    $params = parent::gather_list_params();

    $this-&gt;add_nonempty    ( $params, $this-&gt;bot-&gt;barsepstring ( $this-&gt;users ), 'users' );
    if ( $this-&gt;get_token_rights ) { $params['token'] = 'userrights'; }

    $prop = array();
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_blockinfo   , 'blockinfo'    );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_groups      , 'groups'       );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_editcount   , 'editcount'    );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_registration, 'registration' );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_emailable   , 'emailable'    );
    $this-&gt;add_nonempty ( $params, $this-&gt;bot-&gt;barsepstring ( $prop ), 'prop' );

    return $params;
  }

}


class Iterator_ProtectedTitles extends Iterator_ListMembers {

  protected $query_datatree_element_name = 'protectedtitles';  // overrides 'abstract'
  protected $element_object_class_name   = 'ProtectedTitle';   // overrides 'abstract'
  protected $list_code = 'pt';

  public $start;          // timestamp to start listing page protections from
  public $end;            // timestamp to end listing to (if before $start, they will be listed backwards)
  public $namespace;      // NULL - all namespaces, &quot;&quot; or 0 - main namespace, etc.
  public $level;          // list only pages with this protection level, eg. 'sysop'
  public $get_timestamp;  // when the title was protected
  public $get_expiry;     // timestamp when the protection expires
  public $get_user;       // who protected it
  public $get_comment;    // with what comment
  public $get_level;      // level needed to create the page

  protected function gather_list_params () {
    $params = parent::gather_list_params();

    $this-&gt;add_startenddir ( $params, $this-&gt;start, $this-&gt;end );
    $this-&gt;add_namespace   ( $params, $this-&gt;namespace );
    $this-&gt;add_nonempty    ( $params, $this-&gt;level, 'level' );

    $prop = array();
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_timestamp, 'timestamp' );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_user     , 'user'      );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_comment  , 'comment'   );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_expiry   , 'expiry'    );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_level    , 'level'     );
    $this-&gt;add_nonempty ( $params, $this-&gt;bot-&gt;barsepstring ( $prop ), 'prop' );

    return $params;
  }

}


# ----------  Generator members iterator classes  ---------- #


abstract class Iterator_GeneratorMembers extends Iterator_ListMembers {

  protected $element_object_class_name   = 'Page';   // overrides 'abstract'
  protected $query_datatree_element_name = 'pages';  // overrides 'abstract'
  // When in list mode, the name is 'allpages', 'alllinks' etc. for the different iterators.
  // When in generator mode, the name is always 'pages'!

  protected $list_name;  // to be 'overriden'

  public $list_mode = false;   // if true, will work as an ordinary list iterator

  public $properties = array();  // set here subarrays with properties lists, eg. $this-&gt;properties['info'] = array ( 'props' =&gt; 'title|ids' )

  # ----------  Protected  ---------- #

  protected function query () {
    if ( $this-&gt;list_mode ) {
      return parent::query();
    } else {
      $this-&gt;element_object_class_name   = 'Page';  // generator mode always yields pages
      $this-&gt;query_datatree_element_name = 'pages';
      $listparams = $this-&gt;gather_list_params();
      $params     = $this-&gt;gather_params();
      return $this-&gt;bot-&gt;query_generator ( $this-&gt;list_name, $this-&gt;list_code, $listparams, $this-&gt;properties, $params );
    }
  }

}


class Iterator_AllPages extends Iterator_GeneratorMembers {

  protected $query_datatree_element_name = 'allpages';  // list mode
  protected $element_object_class_name   = 'Page';      // list mode
  protected $list_code = 'ap';
  protected $list_name = 'allpages';

  public $from;            // start (alphabetically) from this title
  public $prefix;          // pagetitle prefix (without any namespace preface)!
  public $namespace;       // NULL, &quot;&quot; or 0 - main namespace, etc. (only one namespace is enumerated at a time!)
  public $filterredir;     // 'all' (default), 'redirects', 'non-redirects'
  public $filterlanglinks; // 'all' (default), 'withlanglinks', 'withoutlanglinks'
  public $minsize;         // minimal page size to list, in bytes
  public $maxsize;         // maximal page size to list, in bytes
  public $prtype;          // 'edit', 'move' or other types of actions pages have been protected against
  public $prlevel;         // 'autoconfirmed', 'sysop' or other levels of protection (incompatible with prtype!)
  public $direction;       // 'ascending' (default), 'descending'

  protected function gather_list_params () {
    if ( empty ( $this-&gt;prtype ) &amp;&amp;&nbsp;! empty ( $this-&gt;prlevel ) ) {
      $this-&gt;log ( &quot;AllPages: \$prlevel may not be specified without \$prtype - ignoring it!&quot;, LL_WARNING );
      $this-&gt;prlevel = NULL;
    }
    $from_ns = $this-&gt;bot-&gt;title_namespace ( $this-&gt;from );
    if (&nbsp;! empty ( $from_ns ) ) {
      if ( $this-&gt;bot-&gt;title_is_in_namespace ( $this-&gt;from, $this-&gt;namespace ) ) {
        $this-&gt;from = $this-&gt;bot-&gt;title_pagename ( $this-&gt;from );
      } else {
        $this-&gt;log ( &quot;From-page [[&quot; . $this-&gt;from . &quot;]] is not in namespace &quot; . $this-&gt;namespace . &quot;; ignoring the difference - you know best what you want&quot;, LL_WARNING );
      }
    }

    $params = parent::gather_list_params();

    $this-&gt;add_nonempty  ( $params, $this-&gt;from           , 'from'            );
    $this-&gt;add_nonempty  ( $params, $this-&gt;prefix         , 'prefix'          );
    $this-&gt;add_namespace ( $params, $this-&gt;namespace );
    $this-&gt;add_nonempty  ( $params, $this-&gt;filterredir    , 'filterredir'     );
    $this-&gt;add_nonempty  ( $params, $this-&gt;filterlanglinks, 'filterlanglinks' );
    $this-&gt;add_nonempty  ( $params, $this-&gt;minsize        , 'minsize'         );
    $this-&gt;add_nonempty  ( $params, $this-&gt;maxsize        , 'maxsize'         );
    $this-&gt;add_nonempty  ( $params, $this-&gt;prtype         , 'prtype'          );
    $this-&gt;add_nonempty  ( $params, $this-&gt;prlevel        , 'prlevel'         );
    $this-&gt;add_nonempty  ( $params, $this-&gt;direction      , 'dir'             );

    return $params;
  }

}


class Iterator_AllLinks extends Iterator_GeneratorMembers {

  protected $query_datatree_element_name = 'alllinks';  // list mode
  protected $element_object_class_name   = 'List_Link'; // list mode
  protected $list_code = 'al';
  protected $list_name = 'alllinks';

  public $from;            // start (alphabetically) from this title
  public $prefix;          // pagetitle prefix (without any namespace preface)!
  public $namespace;       // NULL, &quot;&quot; or 0 - main namespace, etc (only one namespace is enumerated at a time!)
  public $unique = false;  // if true, multiple links to the same title will be listed only once, and listing IDs will not be obtained.
  public $get_ids   = true;
  public $get_title = true;

  protected function gather_list_params () {
    if ( $this-&gt;unique &amp;&amp; $this-&gt;get_ids ) {
      $this-&gt;log ( &quot;AllLinks: both unique and get_ids specified; is not allowed - will not get_ids!&quot;, LL_WARNING );
      $this-&gt;get_ids = false;
    }

    $params = parent::gather_list_params();

    $this-&gt;add_nonempty  ( $params, $this-&gt;from     , 'from'   );
    $this-&gt;add_nonempty  ( $params, $this-&gt;prefix   , 'prefix' );
    $this-&gt;add_namespace ( $params, $this-&gt;namespace );
    $this-&gt;add_boolkey   ( $params, $this-&gt;unique   , 'unique' );

    $prop = array();
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_ids  , 'ids'   );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_title, 'title' );
    $this-&gt;add_nonempty ( $params, $this-&gt;bot-&gt;barsepstring ( $prop ), 'prop' );

    return $params;
  }

}


class Iterator_AllCategories extends Iterator_GeneratorMembers {
# Not the same as allpages with namespace 14! It lists categories with text, even if empty.
# This lists categories with members, even if without text.

  protected $query_datatree_element_name = 'allcategories'; // list mode
  protected $element_object_class_name   = 'List_Title';    // list mode
  protected $list_code = 'ac';
  protected $list_name = 'allcategories';

  public $from;            // start (alphabetically) from this title
  public $prefix;          // title prefix (without any namespace preface)!
  public $direction;

  protected function gather_list_params () {
    $params = parent::gather_list_params();

    $this-&gt;add_nonempty  ( $params, $this-&gt;from     , 'from'   );
    $this-&gt;add_nonempty  ( $params, $this-&gt;prefix   , 'prefix' );
    $this-&gt;add_nonempty  ( $params, $this-&gt;direction, 'dir'    );

    return $params;
  }

}


class Iterator_AllImages extends Iterator_GeneratorMembers {

  protected $query_datatree_element_name = 'allimages';  // list mode
  protected $element_object_class_name   = 'Image';      // list mode
  protected $list_code = 'ai';
  protected $list_name = 'allimages';

  public $from;            // start (alphabetically) from this title
  public $prefix;          // pagetitle prefix (without any namespace preface)!
  public $minsize;         // minimal page size to list, in bytes
  public $maxsize;         // maximal page size to list, in bytes
  public $direction;       // 'ascending' (default), 'descending'
  public $sha1;
  public $sha1base36;
  public $get_timestamp  = true;
  public $get_user       = true;
  public $get_comment    = true;
  public $get_url        = true;
  public $get_size       = true;
  public $get_dimensions = true;
  public $get_mime       = true;
  public $get_sha1       = true;
  public $get_metadata   = true;

  protected function gather_list_params () {
    $params = parent::gather_list_params();

    $this-&gt;add_nonempty  ( $params, $this-&gt;from      , 'from'       );
    $this-&gt;add_nonempty  ( $params, $this-&gt;prefix    , 'prefix'     );
    $this-&gt;add_nonempty  ( $params, $this-&gt;minsize   , 'minsize'    );
    $this-&gt;add_nonempty  ( $params, $this-&gt;maxsize   , 'maxsize'    );
    $this-&gt;add_nonempty  ( $params, $this-&gt;direction , 'dir'        );
    $this-&gt;add_nonempty  ( $params, $this-&gt;sha1      , 'sha1'       );
    $this-&gt;add_nonempty  ( $params, $this-&gt;sha1base36, 'sha1base36' );

    $prop = array();
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_timestamp   , 'timestamp'   );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_user        , 'user'        );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_comment     , 'comment'     );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_url         , 'url'         );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_size        , 'size'        );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_dimensions  , 'dimenstions' );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_mime        , 'mime'        );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_sha1        , 'sha1'        );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_metadata    , 'metadata'    );
    $this-&gt;add_nonempty ( $params, $this-&gt;bot-&gt;barsepstring ( $prop ), 'prop' );

    return $params;
  }

}


class Iterator_BackLinks extends Iterator_GeneratorMembers {

  protected $query_datatree_element_name = 'backlinks';  // list mode
  protected $element_object_class_name   = 'Page';       // list mode
  protected $list_code = 'bl';
  protected $list_name = 'backlinks';

  public $title;       // backlinks to this page title
  public $namespace;   // NULL - all namespaces, &quot;&quot; or 0 - main namespace, etc.
  public $filterredir; // 'all' (default), 'redirects', 'non-redirects'
  public $redirect = false;  // list also pages linking to this page through a redirect?

  protected function gather_list_params () {
    if ( empty ( $this-&gt;title ) ) {
      $this-&gt;log ( &quot;BackLinks: no page title specified - no data will be obtained!&quot;, LL_WARNING );
    }

    $params = parent::gather_list_params();

    $this-&gt;add_nonempty  ( $params, $this-&gt;title      , 'title'       );
    $this-&gt;add_namespace ( $params, $this-&gt;namespace );
    $this-&gt;add_nonempty  ( $params, $this-&gt;filterredir, 'filterredir' );
    $this-&gt;add_boolvalue ( $params, $this-&gt;redirect   , 'redirect'    );

    return $params;
  }

}


class Iterator_CategoryMembers extends Iterator_GeneratorMembers {

  protected $query_datatree_element_name = 'categorymembers';  // list mode
  protected $element_object_class_name   = 'Page';             // list mode
  protected $list_code = 'cm';
  protected $list_name = 'categorymembers';

  public $title;            // category to iterate ('Category:' prefix can be omitted)
  public $namespace;        // NULL - all namespaces, &quot;&quot; or 0 - main namespace, etc.
  public $sort;             // 'sortkey' (default) or 'timestamp'
  public $start;            // start timestamp (used with $sort =&gt; 'timestamp')
  public $end;              // end timestamp (used with $sort =&gt; 'timestamp')
  public $startsortkey;     // start sortkey (used with $sort =&gt; 'sortkey')
  public $endsortkey;       // end sortkey (used with $sort =&gt; 'sortkey')
  public $get_ids       = true;
  public $get_title     = true;
  public $get_sortkey   = true;
  public $get_timestamp = true;

  protected function gather_list_params () {
    if ( empty ( $this-&gt;title ) ) {
      $this-&gt;log ( &quot;CategoryMembers: category name not specified - no data will be obtained!&quot;, LL_WARNING );
    }
    if (&nbsp;! $this-&gt;bot-&gt;title_is_in_namespace ( $this-&gt;title, NAMESPACE_ID_CATEGORY ) ) {
      if ( mb_strpos ( $this-&gt;title, ':' ) === false ) {
        $this-&gt;title = $this-&gt;bot-&gt;wiki_namespace_name ( NAMESPACE_ID_CATEGORY ) . ':' . $this-&gt;title;
      } else {
        $this-&gt;log ( &quot;CategoryMembers: page '&quot; . $this-&gt;title . &quot;' appears to not be a category - no data will be obtained!&quot;, LL_WARNING );
      }
    }
    if ( ( ( $this-&gt;sort&nbsp;!= 'sortkey' ) || ( $this-&gt;sortkey&nbsp;!== '' ) ) &amp;&amp;
         (&nbsp;! empty ( $this-&gt;startsortkey ) ||&nbsp;! empty ( $this-&gt;endsortkey ) ) ) {
      $this-&gt;log ( &quot;CategoryMembers: not sorted by sortkey - startsortkey and endsortkey will be ignored!&quot;, LL_WARNING );
      $this-&gt;startsortkey = NULL;
      $this-&gt;endsortkey   = NULL;
    }

    $params = parent::gather_list_params();

    $this-&gt;add_nonempty    ( $params, $this-&gt;title       , 'title'       );
    $this-&gt;add_namespace   ( $params, $this-&gt;namespace );
    $this-&gt;add_startenddir ( $params, $this-&gt;start, $this-&gt;end );
    $this-&gt;add_nonempty    ( $params, $this-&gt;startsortkey, 'startsortkey' );
    $this-&gt;add_nonempty    ( $params, $this-&gt;endsortkey  , 'endsortkey'   );
    $this-&gt;add_nonempty    ( $params, $this-&gt;sort        , 'sort'         );

    $prop = array();
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_ids      , 'ids'       );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_title    , 'title'     );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_sortkey  , 'sortkey'   );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_timestamp, 'timestamp' );
    $this-&gt;add_nonempty ( $params, $this-&gt;bot-&gt;barsepstring ( $prop ), 'prop' );

    return $params;
  }

}


class Iterator_EmbeddedIn extends Iterator_GeneratorMembers {

  protected $query_datatree_element_name = 'embeddedin'; // list mode
  protected $element_object_class_name   = 'Page';       // list mode
  protected $list_code = 'ei';
  protected $list_name = 'embeddedin';

  public $title;        // iterate pages that include (eg. as a template) this title (include namespace preface!)
  public $namespace;    // NULL -&nbsp;;ist pages from all namespaces, &quot;&quot; or 0 - main namespace, etc.
  public $filterredir;  // 'all' (default), 'redirects', 'non-redirects'

  protected function gather_list_params () {
    $params = parent::gather_list_params();

    $this-&gt;add_nonempty  ( $params, $this-&gt;title      , 'title'       );
    $this-&gt;add_namespace ( $params, $this-&gt;namespace );
    $this-&gt;add_nonempty  ( $params, $this-&gt;filterredir, 'filterredir' );

    return $params;
  }

}


class Iterator_ExtUrlUsage extends Iterator_GeneratorMembers {

  protected $query_datatree_element_name = 'exturlusage';      // list mode
  protected $element_object_class_name   = 'Page_WithExtlink'; // list mode
  protected $list_code = 'eu';
  protected $list_name = 'exturlusage';

  public $query;     // '*' is wildcard (never use it alone!); if completely empty, protocol is ignored
  public $protocol;  // if $query is not empty: 'http' (default), 'https', 'ftp', 'irc', 'gopher', 'telnet', 'nntp', 'worldwind', 'mailto', 'news'
  public $namespace; // NULL - all namespaces, &quot;&quot; or 0 - main namespace, etc.
  public $get_ids   = true;
  public $get_title = true;
  public $get_url   = true;   // no sense in setting it - MW API doesn't return the URLs, at least up to 1.16w4!&nbsp;:-(

  protected function gather_list_params () {
    $params = parent::gather_list_params();

    $this-&gt;add_nonempty  ( $params, $this-&gt;query   , 'query'    );
    $this-&gt;add_nonempty  ( $params, $this-&gt;protocol, 'protocol' );
    $this-&gt;add_namespace ( $params, $this-&gt;namespace );

    $prop = array();
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_ids  , 'ids'   );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_title, 'title' );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_url  , 'url'   );
    $this-&gt;add_nonempty ( $params, $this-&gt;bot-&gt;barsepstring ( $prop ), 'prop' );

    return $params;
  }

}


class Iterator_ImageUsage extends Iterator_GeneratorMembers {

  protected $query_datatree_element_name = 'imageusage'; // list mode
  protected $element_object_class_name   = 'Page';       // list mode
  protected $list_code = 'iu';
  protected $list_name = 'imageusage';

  public $title;       // image title ('Image' or 'File' prefix can be omitted)
  public $namespace;   // NULL - all namespaces, &quot;&quot; or 0 - main namespace, etc.
  public $filterredir; // 'all' (default), 'redirects', 'non-redirects'
  public $redirect = false;

  protected function gather_list_params () {
    if ( empty ( $this-&gt;title ) ) {
      $this-&gt;log ( &quot;ImageUsage: no image title specified - no data will be obtained!&quot;, LL_WARNING );
    }

    if (&nbsp;! $this-&gt;bot-&gt;title_is_in_namespace ( $this-&gt;title, NAMESPACE_ID_FILE ) ) {
      if ( mb_strpos ( $this-&gt;title, ':' ) === false ) {
        $this-&gt;title = $this-&gt;bot-&gt;wiki_namespace_name ( NAMESPACE_ID_FILE ) . ':' . $this-&gt;title;
      } else {
        $this-&gt;log ( &quot;ImageUsage: page '&quot; . $this-&gt;title . &quot;' appears to not be an image (or file) - no data will be obtained!&quot;, LL_WARNING );
      }
    }

    $params = parent::gather_list_params();

    $this-&gt;add_nonempty  ( $params, $this-&gt;title      , 'title'       );
    $this-&gt;add_namespace ( $params, $this-&gt;namespace );
    $this-&gt;add_nonempty  ( $params, $this-&gt;filterredir, 'filterredir' );
    $this-&gt;add_boolvalue ( $params, $this-&gt;redirect   , 'redirect'    );

    return $params;
  }

}


class Iterator_Search extends Iterator_GeneratorMembers {

  protected $query_datatree_element_name = 'search';             // list mode
  protected $element_object_class_name   = 'List_SearchResult';  // list mode
  protected $list_code = 'sr';
  protected $list_name = 'search';

  public $search;    // what to search for
  public $what;      // what to search in: 'title' (default), 'text')
  public $namespace; // NULL, &quot;&quot; or 0 - main namespace, etc.
  public $redirects = false;

  protected function gather_list_params () {
    if ( empty ( $this-&gt;search ) ) {
      $this-&gt;log ( &quot;Search: no search string specified - all pages will be listed!&quot;, LL_WARNING );
    }

    $params = parent::gather_list_params();

    $this-&gt;add_nonempty  ( $params, $this-&gt;search   , 'search'    );
    $this-&gt;add_nonempty  ( $params, $this-&gt;what     , 'what'      );
    $this-&gt;add_namespace ( $params, $this-&gt;namespace );
    $this-&gt;add_boolvalue ( $params, $this-&gt;redirects, 'redirects' );

    return $params;
  }

}


class Iterator_Watchlist extends Iterator_GeneratorMembers {

  protected $query_datatree_element_name = 'watchlist';          // list mode
  protected $element_object_class_name   = 'Page_FromWatchlist'; // list mode
  protected $list_name = 'watchlist';
  protected $list_code = 'wl';

  public $start;       // timestamp to start listing watched pages from
  public $end;         // timestamp to end listing to (if before $start, they will be listed backwards)
  public $namespace;   // NULL - all namespaces, &quot;&quot; or 0 - main namespace, etc.
  public $user;        // only list changes made by this user ('!user' - not by this user)
  public $allrev;      // true - list all revisions, false - list only the last revision
  public $show_minor;  // NULL (all), true (minor only), false (non-minor only)
  public $show_anon;
  public $show_bot;
  public $get_user      = true;
  public $get_comment   = true;
  public $get_timestamp = true;
  public $get_title     = true;
  public $get_ids       = true;
  public $get_sizes     = true;
  public $get_patrol    = true;
  public $get_flags     = true;

  protected function gather_list_params () {
    if (&nbsp;! $this-&gt;list_mode &amp;&amp; $this-&gt;allrev ) {
      $this-&gt;log ( &quot;WatchList: \$allrev is not allowed in generator mode - ignoring it!&quot;, LL_WARNING );
      $this-&gt;allrev = NULL;
    }

    $params = parent::gather_list_params();

    $this-&gt;add_startenddir ( $params, $this-&gt;start, $this-&gt;end );
    $this-&gt;add_namespace   ( $params, $this-&gt;namespace );
    $this-&gt;add_user        ( $params, $this-&gt;user );
    $this-&gt;add_boolvalue   ( $params, $this-&gt;allrev, 'allrev' );

    $show = array();
    $this-&gt;add_boolbang ( $show, $this-&gt;show_minor    , 'minor'     );
    $this-&gt;add_boolbang ( $show, $this-&gt;show_anon     , 'anon'      );
    $this-&gt;add_boolbang ( $show, $this-&gt;show_bot      , 'bot'       );
    $this-&gt;add_nonempty ( $params, $this-&gt;bot-&gt;barsepstring ( $show ), 'show' );

    $prop = array();
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_user     , 'user'      );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_comment  , 'comment'   );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_timestamp, 'timestamp' );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_title    , 'title'     );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_ids      , 'ids'       );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_sizes    , 'sizes'     );
    if ( $this-&gt;bot-&gt;can_i_patrol() ) {
      $this-&gt;add_boolvalue ( $prop, $this-&gt;get_patrol , 'patrol'    );
    }
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_flags    , 'flags'     );
    $this-&gt;add_nonempty ( $params, $this-&gt;bot-&gt;barsepstring ( $prop ), 'prop' );

    return $params;
  }

}


class Iterator_Random extends Iterator_GeneratorMembers {

  protected $query_datatree_element_name = 'random';  // list mode
  protected $element_object_class_name   = 'Page';    // list mode
  protected $list_code = 'rn';
  protected $list_name = 'random';

  public $namespace;         // NULL - all namespaces, &quot;&quot; or 0 - main namespace, etc.
  public $redirect = false;  // non-redirects only; true will list only redirects

  protected function gather_list_params () {
    $params = parent::gather_list_params();

    $this-&gt;add_namespace ( $params, $this-&gt;namespace );
    $this-&gt;add_boolvalue ( $params, $this-&gt;redirect, 'redirect' );

    return $params;
  }

}


# ----------  Page elements iterator classes  ---------- #


abstract class Iterator_PageElements extends Iterator_GenericAPI {

  protected $query_datatree_element_name = 'pages';  // overrides 'abstract' variable

  protected $page_datatree_element_name;  // to be overridden

  public $pageid; // pageid of the page whose elements are to be iterated
  public $title;  // title of the page whose elements are to be iterated
                  // (mutually exclusive with pageid - specify one of the two; if both are specified, pageid takes precedence)

  public $properties;  // page properties to request (specific iterators offer more convenience for their specific props)

  public $limit = 'max';

  public $page;   // the page whose properties are iterated (as a favor for the actionobject&nbsp;:-)

  # ----------  Constructor / Destructor  ---------- #

  function __construct ( $bot ) {
    parent::__construct ( $bot );
    $this-&gt;properties = $this-&gt;page_default_props();
  }

  # ----------  Protected  ---------- #

  # ----- Basic ----- #

  protected function query_elements_array ( $query_tree ) {
    $pages_tree = parent::query_elements_array ( $query_tree );
    if ( $pages_tree&nbsp;!== false ) {
      $page_tree = reset ( $pages_tree );
      $this-&gt;page = new Page;
      $this-&gt;page-&gt;read_from_element ( $page_tree, $this-&gt;bot );
      if ( array_key_exists ( $this-&gt;page_datatree_element_name, $page_tree ) ) {
        return $page_tree[$this-&gt;page_datatree_element_name];
      }
    }
    return false;
  }

  protected function page_default_props () {
    $props = array();
    $props['info'] = array();
    $props['info']['prop'] = &quot;protection&quot;;
    return $props;
  }

  protected function query () {
    $properties = $this-&gt;element_props();
    if ( $properties === false ) { return false; }
    $this-&gt;properties[$this-&gt;page_datatree_element_name] = $properties;
    if (&nbsp;! ( $this-&gt;pageid === NULL ) ) {
      return $this-&gt;bot-&gt;query_pageids ( $this-&gt;pageid, $this-&gt;properties );
    } elseif (&nbsp;! ( $this-&gt;title === NULL ) ) {
      return $this-&gt;bot-&gt;query_titles ( $this-&gt;title, $this-&gt;properties );
    } else {
      $this-&gt;log ( &quot;Error: Trying to guery page properties without specifying the page!&quot;, LL_ERROR );
      return false;
    }
  }

  protected function element_props () {
    if ( array_key_exists ( $this-&gt;page_datatree_element_name, $this-&gt;properties ) ) {
      $props = $this-&gt;properties[$this-&gt;page_datatree_element_name];
    } else {
      $props = array();
    }
    $this-&gt;add_nonempty ( $props, $this-&gt;limit, 'limit', 11200 );
    return $props;
  }

}


class Iterator_PageRevisions extends Iterator_PageElements {

  protected $element_object_class_name  = 'Page_Revision';  // overrides 'abstract' variable
  protected $page_datatree_element_name = 'revisions';      // overrides 'abstract' variable

  public $start;                   // timestamp to start listing page revisions from
  public $end;                     // timestamp to end listing to (if before $start, they will be listed backwards)
  public $startid;                 // revision ID to start listing page revisions from
  public $endid;                   // revision ID to end listing to (if before $start, they will be listed backwards)
  public $user;                    // list only revisions made by this user ('!user' - NOT by this user)
  public $expandtemplates = false; // expand included templates in the revision content (if content is requested)
  public $generatexml = false;     // generate XML parse tree for revision content (since version&nbsp;????)
  public $section;                 // return only this section (if content is requested; MW 1.13 and up)
  public $diffto;                  // return a diff to the revision with this ID; 'prev', 'next' and 'cur' are allowed
  public $difftotext;              // return a diff to this text (overrides $diffto)

  public $get_rollbacktoken = false;   // get rollback tokens for each revision
  public $get_size          = true;
  public $get_content       = true;
  public $get_tags          = true;

  # ----------  Protected  ---------- #

  protected function element_props () {
    if ( $this-&gt;bot-&gt;mw_version_number() &lt; 11700 ) { $this-&gt;get_tags = NULL; }

    $props = parent::element_props();
    $this-&gt;add_startenddir ( $props, $this-&gt;start, $this-&gt;end );
    $this-&gt;add_startenddir ( $props, $this-&gt;startid, $this-&gt;endid, &quot;id&quot; );
    $this-&gt;add_user ( $props, $this-&gt;user );
    $this-&gt;add_nonempty ( $props, $this-&gt;section, 'section', 11300 );
    $this-&gt;add_boolkey  ( $props, $this-&gt;expandtemplates, 'expandtemplates' );
    $this-&gt;add_boolkey  ( $props, $this-&gt;generatexml, 'generatexml' );
    $this-&gt;add_nonempty ( $props, $this-&gt;diffto, 'diffto' );
    $this-&gt;add_nonempty ( $props, $this-&gt;difftotext, 'difftotext' );

    if ( ( $this-&gt;bot-&gt;mw_version_number() &lt; 11200 ) &amp;&amp;
         ( empty ( $this-&gt;start ) &amp;&amp; empty ( $this-&gt;end ) &amp;&amp;
           empty ( $this-&gt;startid ) &amp;&amp; empty ( $this-&gt;endid ) ) ) {
      $this-&gt;add_startenddir ( $props, PHP_INT_MAX, 0, &quot;id&quot; );
    }

    if ( $this-&gt;get_rollbacktoken ) { $props['token'] = 'rollback'; }

    $props['prop'] = &quot;ids|flags|timestamp|user|comment&quot;;
    if ( $this-&gt;get_size    ) { $props['prop'] .= &quot;|size&quot;;    }
    if ( $this-&gt;get_content ) { $props['prop'] .= &quot;|content&quot;; }
    if ( $this-&gt;get_tags    ) { $props['prop'] .= &quot;|tags&quot;;    }
    return $props;
  }

}


class Iterator_PageRevisions_WithDiffs extends Iterator_PageRevisions {

  protected $previous_revision;

  protected function iterate_element ( $element, $ActionObject ) {
    if ( is_null ( $this-&gt;previous_revision ) ) {
      $result = true;
    } else {
      $this-&gt;previous_revision-&gt;inserted = added_to_str ( $this-&gt;previous_revision-&gt;content, $element-&gt;content );
      $this-&gt;previous_revision-&gt;removed  = added_to_str ( $element-&gt;content, $this-&gt;previous_revision-&gt;content );
      $result = parent::iterate_element ( $this-&gt;previous_revision, $ActionObject );
    }
    $this-&gt;previous_revision = $element;
    return $result;
  }

  protected function iterate_elements ( $ActionObject ) {
    $this-&gt;previous_revision = NULL;
    $this-&gt;elements_counter--;
    parent::iterate_elements ( $ActionObject );
    if (&nbsp;! $this-&gt;abort_iteration ) {
      if ( $this-&gt;iterate_element ( NULL, $ActionObject ) ) {
        $this-&gt;elements_counter++;
      }
    }
    return $this-&gt;elements_counter;
  }

}


class Iterator_PageCategories extends Iterator_PageElements {

  protected $element_object_class_name  = 'Page_Category'; // overrides 'abstract' variable
  protected $page_datatree_element_name = 'categories';    // overrides 'abstract' variable

  public $show_hidden   = NULL;     // false - do not show hidden categories; true - show only them; NULL - show both kinds
  public $only_these    = array();  // show only the categories listed here - useful to check if the page is in a given category
  public $get_sortkey   = true;
  public $get_timestamp = true;

  # ----------  Protected  ---------- #

  protected function element_props () {
    if ( $generator ) {  // not implemented - could not find info how to use this as a generator
      $this-&gt;log ( &quot;PageCategories: \$sortkey and $timestamp are not allowed in generator mode - ignoring them!&quot;, LL_WARNING );
      $this-&gt;sortkey   = NULL;
      $this-&gt;timestamp = NULL;
    }

    $prop = array();
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_sortkey  , 'sortkey'   );
    $this-&gt;add_boolvalue ( $prop, $this-&gt;get_timestamp, 'timestamp' );

    $show = array();
    $this-&gt;add_boolbang ( $show, $this-&gt;show_hidden, 'hidden' );

    $props = parent::element_props();
    $this-&gt;add_nonempty ( $props, $prop, 'prop' );
    $this-&gt;add_nonempty ( $props, $show, 'show' );
    $this-&gt;add_nonempty ( $props, $this-&gt;bot-&gt;barsepstring ( $this-&gt;only_these ), 'categories' );
    return $props;
  }

}


class Iterator_PageImageInfo extends Iterator_PageElements {

  protected $element_object_class_name  = 'Page_ImageInfo'; // overrides 'abstract' variable
  protected $page_datatree_element_name = 'imageinfo';    // overrides 'abstract' variable

  public $start;      // timestamp to start listing page image info from
  public $end;        // timestamp to end listing to (if before $start, they will be listed backwards)
  public $urlwidth;   // the URL returned (if get_url is set) will point to image resized to this width
  public $urlheight;  // as with $urlwidth, but for the image height
  public $get_timestamp   = true;
  public $get_user        = true;
  public $get_comment     = false;
  public $get_url         = false;
  public $get_size        = false;
  public $get_sha1        = false;
  public $get_mime        = false;
  public $get_metadata    = false;
  public $get_archivename = false;

  # ----------  Protected  ---------- #

  protected function element_props () {
    if (&nbsp;! empty ( $this-&gt;title ) &amp;&amp;
         ( $this-&gt;bot-&gt;title_namespace_id ( $this-&gt;title ) === &quot;&quot; ) ) {
      $this-&gt;title = $this-&gt;bot-&gt;wiki_namespace_name ( NAMESPACE_ID_FILE ) . &quot;:&quot; . $this-&gt;title;
    }

    $show = array();
    $this-&gt;add_boolvalue ( $show, $this-&gt;get_timestamp  , 'timestamp'   );
    $this-&gt;add_boolvalue ( $show, $this-&gt;get_user       , 'user'        );
    $this-&gt;add_boolvalue ( $show, $this-&gt;get_comment    , 'comment'     );
    $this-&gt;add_boolvalue ( $show, $this-&gt;get_url        , 'url'         );
    $this-&gt;add_boolvalue ( $show, $this-&gt;get_size       , 'size'        );
    $this-&gt;add_boolvalue ( $show, $this-&gt;get_sha1       , 'sha1'        );
    $this-&gt;add_boolvalue ( $show, $this-&gt;get_mime       , 'mime'        );
    $this-&gt;add_boolvalue ( $show, $this-&gt;get_metadata   , 'metadata'    );
    $this-&gt;add_boolvalue ( $show, $this-&gt;get_archivename, 'archivename' );

    $props = parent::element_props();
    $this-&gt;add_nonempty ( $props, $this-&gt;start    , 'start'     );
    $this-&gt;add_nonempty ( $props, $this-&gt;end      , 'end'       );
    $this-&gt;add_nonempty ( $props, $this-&gt;urlwidth , 'urlwidth'  );
    $this-&gt;add_nonempty ( $props, $this-&gt;urlheight, 'urlheight' );
    $this-&gt;add_nonempty ( $props, $show, 'prop' );
    return $props;
  }

}


class Iterator_PageStashImageInfo extends Iterator_PageElements {

  protected $element_object_class_name  = 'Page_ImageInfo'; // overrides 'abstract' variable
  protected $page_datatree_element_name = 'stashimageinfo';    // overrides 'abstract' variable

  public $sessionkey; // Session key for a temporarily stashed previous upload (mandatory!)
  public $urlwidth;   // the URL returned (if get_url is set) will point to image resized to this width
  public $urlheight;  // as with $urlwidth, but for the image height
  public $get_timestamp   = true;
  public $get_url         = false;
  public $get_size        = false;
  public $get_sha1        = false;
  public $get_mime        = false;
  public $get_metadata    = false;

  # ----------  Protected  ---------- #

  protected function element_props () {
    if (&nbsp;! empty ( $this-&gt;title ) &amp;&amp;
         ( $this-&gt;bot-&gt;title_namespace_id ( $this-&gt;title ) === &quot;&quot; ) ) {
      $this-&gt;title = $this-&gt;bot-&gt;wiki_namespace_name ( NAMESPACE_ID_FILE ) . &quot;:&quot; . $this-&gt;title;
    }

    if ( empty ( $this-&gt;sessionkey ) ) {
      $this-&gt;log ( &quot;No session key supplied -- cannot query stashed image info!&quot;, LL_ERROR );
      return false;
    }

    $show = array();
    $this-&gt;add_boolvalue ( $show, $this-&gt;get_timestamp, 'timestamp' );
    $this-&gt;add_boolvalue ( $show, $this-&gt;get_url      , 'url'       );
    $this-&gt;add_boolvalue ( $show, $this-&gt;get_size     , 'size'      );
    $this-&gt;add_boolvalue ( $show, $this-&gt;get_sha1     , 'sha1'      );
    $this-&gt;add_boolvalue ( $show, $this-&gt;get_mime     , 'mime'      );
    $this-&gt;add_boolvalue ( $show, $this-&gt;get_metadata , 'metadata'  );

    $props = parent::element_props();
    $this-&gt;add_nonempty ( $props, $this-&gt;sessionkey, 'sessionkey' );
    $this-&gt;add_nonempty ( $props, $this-&gt;urlwidth  , 'urlwidth'   );
    $this-&gt;add_nonempty ( $props, $this-&gt;urlheight , 'urlheight'  );
    $this-&gt;add_nonempty ( $props, $show, 'prop' );
    return $props;
  }

}


class Iterator_PageLangLinks extends Iterator_PageElements {

  protected $element_object_class_name  = 'Page_LangLink'; // overrides 'abstract' variable
  protected $page_datatree_element_name = 'langlinks';     // overrides 'abstract' variable

}


class Iterator_PageLinks extends Iterator_PageElements {

  protected $element_object_class_name  = 'List_Title'; // overrides 'abstract' variable
  protected $page_datatree_element_name = 'links';      // overrides 'abstract' variable

  public $namespace;  // NULL - list link to pages in all namespaces; &quot;&quot; or 0 - in main namespace, etc.

  # ----------  Protected  ---------- #

  protected function element_props () {
    $props = parent::element_props();
    $this-&gt;add_namespace ( $props, $this-&gt;namespace );
    return $props;
  }

}


class Iterator_PageTemplates extends Iterator_PageElements {

  protected $element_object_class_name  = 'Page_Template'; // overrides 'abstract' variable
  protected $page_datatree_element_name = 'templates';     // overrides 'abstract' variable

  public $namespace;  // NULL - list link to included pages in all namespaces; &quot;&quot; or 0 - in main namespace, 8 - classic templates only, etc.

  # ----------  Protected  ---------- #

  protected function element_props () {
    $ns_code = $this-&gt;bot-&gt;wiki_namespace_id ( $this-&gt;namespace );
    if ( $ns_code&nbsp;!== false ) { $this-&gt;namespace = $ns_code; }

    $props = parent::element_props();
    $this-&gt;add_namespace ( $props, $this-&gt;namespace );
    return $props;
  }

}


class Iterator_PageImages extends Iterator_PageElements {

  protected $element_object_class_name  = 'Page_Image'; // overrides 'abstract' variable
  protected $page_datatree_element_name = 'images';     // overrides 'abstract' variable

}


class Iterator_PageExtlinks extends Iterator_PageElements {

  protected $element_object_class_name  = 'Page_Extlink'; // overrides 'abstract' variable
  protected $page_datatree_element_name = 'extlinks';     // overrides 'abstract' variable

}


// page_categoryinfo has no elements that can be iterated


class Iterator_PageDuplicateFiles extends Iterator_PageElements {

  protected $element_object_class_name  = 'Page_DuplicateFile'; // overrides 'abstract' variable
  protected $page_datatree_element_name = 'duplicatefiles'   &nbsp;; // overrides 'abstract' variable

}


class Iterator_PageGlobalUsage extends Iterator_PageElements {

  protected $element_object_class_name  = 'Page_GlobalUsage'; // overrides 'abstract' variable
  protected $page_datatree_element_name = 'globalusage';      // overrides 'abstract' variable

  public $filterlocal = false;

  # ----------  Protected  ---------- #

  protected function element_props () {
    $props = parent::element_props();
    $this-&gt;add_boolkey ( $props, $this-&gt;filterlocal, 'filterlocal' );
    return $props;
  }

}


# ----------  Apibot siteinfo and userinfo iterator classes  ---------- #


abstract class Iterator_Apibot_MetaInfo extends Iterator_Apibot_Generic {

  # ---------- Protected ---------- #

  protected function query         () { return true&nbsp;; }
  protected function continue_query() { return false; }

  protected function obtain_elements_array () { return $this-&gt;info_elements(); }

  abstract protected function info_elements();

}


class Iterator_Wiki_Namespaces extends Iterator_Apibot_MetaInfo {
  protected function info_elements () { return $this-&gt;bot-&gt;wiki_namespaces(); }
}

class Iterator_Wiki_NamespaceAliases extends Iterator_Apibot_MetaInfo {
  protected function info_elements () { return $this-&gt;bot-&gt;wiki_namespaces_aliases(); }
}

class Iterator_Wiki_Interwikis extends Iterator_Apibot_MetaInfo {
  protected function info_elements () { return $this-&gt;bot-&gt;wiki_interwikis(); }
}

class Iterator_Wiki_SpecialPageAliases extends Iterator_Apibot_MetaInfo {
  protected function info_elements () { return $this-&gt;bot-&gt;wiki_specialpagealiases(); }
}

class Iterator_Wiki_MagicWords extends Iterator_Apibot_MetaInfo {
  protected function info_elements () { return $this-&gt;bot-&gt;wiki_magicwords(); }
}

class Iterator_Wiki_Extensions extends Iterator_Apibot_MetaInfo {
  protected function info_elements () { return $this-&gt;bot-&gt;wiki_extensions(); }
}

class Iterator_Wiki_FileExtensions extends Iterator_Apibot_MetaInfo {
  protected function info_elements () { return $this-&gt;bot-&gt;wiki_fileextensions(); }
}

class Iterator_Wiki_UserGroups extends Iterator_Apibot_MetaInfo {
  protected function info_elements () { return $this-&gt;bot-&gt;wiki_usergroups(); }
}

class Iterator_User_Groups extends Iterator_Apibot_MetaInfo {
  protected function info_elements () { return $this-&gt;bot-&gt;my_groups(); }
}

class Iterator_User_ChangeableGroups extends Iterator_Apibot_MetaInfo {

  public $action = 'add';

  protected function info_elements () {
    $groups = $this-&gt;bot-&gt;my_changeablegroups();
    return $groups[$this-&gt;action];
  }
}

class Iterator_User_Rights extends Iterator_Apibot_MetaInfo {
  protected function info_elements () { return $this-&gt;bot-&gt;my_rights(); }
}

class Iterator_User_Options extends Iterator_Apibot_MetaInfo {
  protected function info_elements () {
    $options = $this-&gt;bot-&gt;my_options();
    $elements = array();
    foreach ( $options as $name =&gt; $value ) {
      $elements[] = array ( 'name' =&gt; $name, 'value' =&gt; $value );
    }
    return $elements;
  }
}

class Iterator_User_RateLimits extends Iterator_Apibot_MetaInfo {
  protected function info_elements () { return $this-&gt;bot-&gt;my_ratelimits(); }
}

class Iterator_Wiki_Messages extends Iterator_Apibot_MetaInfo {

  protected function info_elements () {
    if (&nbsp;! $this-&gt;bot-&gt;are_wiki_messages_fetched() ) {
      $this-&gt;bot-&gt;fetch_wiki_messages();
    }
    return $this-&gt;bot-&gt;wiki_messages();
  }
}


# ----------  Custom API iterator classes  ---------- #


class Iterator_CategoryMembers_Recursive extends Iterator_CategoryMembers {

  public $max_nesting_depth  = PHP_INT_MAX;    // max depth to recurse through subcategories (0 - do not recurse)

  public $process_categories = false;  // whether to process the category pages
  public $process_pages      = true;   // whether to process the non-category pages

  public $ignore_processed_categories = true;  // whether to ignore already processed categories, or to re-process them

  public $processed_categories = array();  // categories that are already processed (to avoid re-processing categories)
  public $category_stack = array();

  # ---------- Protected ---------- #

  protected function on_max_nesting_depth ( $title ) {
    $this-&gt;bot-&gt;log ( &quot;Max nesting depth (&quot; . $this-&gt;max_nesting_depth . &quot;) reached - refusing to process category '&quot; . $title . &quot;'!&quot;, LL_INFO );
    return true;
  }

  protected function on_circular_categorization ( $title ) {
    $this-&gt;bot-&gt;log ( &quot;Category '&quot; . $title . &quot;' is nested inside its own tree (circular categorization?) - will not process it.&quot;, LL_WARNING );
    return true;
  }

  protected function on_already_processed () {
    $this-&gt;bot-&gt;log ( &quot;Category '&quot; . $this-&gt;title . &quot;' is already processed (met &quot; .
      $this-&gt;processed_categories[$this-&gt;title] . &quot; times) - skipping it.&quot;, LL_INFO );
  }

  protected function create_iterator ( $element ) {
    $classname = get_class ( $this );
    $Iterator = new $classname ( $this-&gt;bot );  // allows using child classes

    $Iterator-&gt;title = $element-&gt;title;

    $Iterator-&gt;processed_categories = &amp;$this-&gt;processed_categories;
    $Iterator-&gt;category_stack       = &amp;$this-&gt;category_stack;
    $Iterator-&gt;max_nesting_depth    =  $this-&gt;max_nesting_depth;
    $Iterator-&gt;process_categories   =  $this-&gt;process_categories;
    $Iterator-&gt;process_pages        =  $this-&gt;process_pages;

    $Iterator-&gt;namespace     = $this-&gt;namespace;
    $Iterator-&gt;start         = $this-&gt;start;
    $Iterator-&gt;end           = $this-&gt;end;
    $Iterator-&gt;startsortkey  = $this-&gt;startsortkey;
    $Iterator-&gt;endsortkey    = $this-&gt;endsortkey;
    $Iterator-&gt;sort          = $this-&gt;sort;
    $Iterator-&gt;get_ids       = $this-&gt;get_ids;
    $Iterator-&gt;get_title     = $this-&gt;get_title;
    $Iterator-&gt;get_sortkey   = $this-&gt;get_sortkey;
    $Iterator-&gt;get_timestamp = $this-&gt;get_timestamp;

    return $Iterator;
  }

  protected function iterate_subcategories ( $element, $ActionObject ) {
    $Iterator = $this-&gt;create_iterator ( $element );

    $this-&gt;bot-&gt;push_bot_state();
    $this-&gt;elements_counter += $Iterator-&gt;iterate ( $ActionObject );
    $this-&gt;bot-&gt;pop_bot_state();
  }

  protected function iterate_element ( $element, $ActionObject ) {
    if ( $element-&gt;ns == NAMESPACE_ID_CATEGORY ) {
      $this-&gt;iterate_subcategories ( $element, $ActionObject );

      if ( $this-&gt;process_categories ) {
        if ( parent::iterate_element ( $element ) ) {
          $this-&gt;elements_counter++;
        }
      }

    } else {

      if ( $this-&gt;process_pages ) {
        if ( parent::iterate_element ( $element ) ) {
          $this-&gt;elements_counter++;
        }
      }

    }
  }

  public function iterate ( $ActionObject ) {
    $result = false;
    if ( $this-&gt;processed_categories[$this-&gt;title] &amp;&amp; $this-&gt;ignore_processed_categories ) {
      $this-&gt;on_already_processed();
    } else {
      if ( count ( $this-&gt;category_stack ) &gt;= $this-&gt;max_nesting_depth ) {
        $this-&gt;on_max_nesting_depth ( $this-&gt;title );
      } elseif ( in_array ( $this-&gt;title, $this-&gt;category_stack ) ) {
        $this-&gt;on_circular_categorization ( $this-&gt;title );
      } else {
        array_push ( $this-&gt;category_stack, $this-&gt;title );

        $this-&gt;bot-&gt;log ( &quot;Entering category '&quot; . $this-&gt;title . &quot;' (nesting depth &quot; . count ( $this-&gt;category_stack ) . &quot;)&quot;, LL_INFO );
        $result = parent::iterate ( $ActionObject );
        $this-&gt;bot-&gt;log ( &quot;Leaving category '&quot; . $this-&gt;title . &quot;'&quot;, LL_INFO );

        array_pop ( $this-&gt;category_stack );

      }
    }
    $this-&gt;processed_categories[$this-&gt;title] = $this-&gt;processed_categories[$this-&gt;title] + 1;

    return $result;
  }

}


class Iterator_PageAndSubpages extends Iterator_AllPages {

  public $title;

  public $iterate_main_space = true;  // whether to process the pages in the given namespace
  public $iterate_talk_space = true;  // whether to process the matching talk pages

  # ----------  Protected  ---------- #

  protected function iterate_elements ( $ActionObject ) {
    $page = $this-&gt;bot-&gt;fetch_page ( $this-&gt;title, $this-&gt;properties );
    $counter = $this-&gt;iterate_element ( $page, $ActionObject );
    $title_parts = $this-&gt;bot-&gt;title_parts ( $this-&gt;title );
    $this-&gt;prefix = $title_parts['title'] . '/';
    $this-&gt;namespace = $title_parts['namespace'];
    return parent::iterate_elements ( $ActionObject ) + $counter;
  }

  public function iterate ( $ActionObject ) {
    $temp_title = $this-&gt;title;
    $pages_titles = $this-&gt;bot-&gt;maintalk_pages_titles ( $this-&gt;title );
    $counter = 0;
    if ( $this-&gt;iterate_main_space ) {
      $this-&gt;title = $pages_titles['main'];
      $counter += $this-&gt;iterate_elements ( $ActionObject );
    }
    if ( $this-&gt;iterate_talk_space ) {
      $this-&gt;title = $pages_titles['talk'];
      $counter += $this-&gt;iterate_elements ( $ActionObject );
    }
    $this-&gt;title = $temp_title;
    return $counter;
  }

}


class Iterator_AllPagesAllNamespaces extends Iterator_Wiki_Namespaces {
// Like Iterator_AllPages, but is not limited to iterating only one namespace.

  public $from;            // start (alphabetically) from this title
  public $prefix;          // pagetitle prefix (without any namespace preface)!
  public $filterredir;     // 'all' (default), 'redirects', 'non-redirects'
  public $filterlanglinks; // 'all' (default), 'withlanglinks', 'withoutlanglinks'
  public $minsize;         // minimal page size to list, in bytes
  public $maxsize;         // maximal page size to list, in bytes
  public $prtype;          // 'edit', 'move' or other types of actions pages have been protected against
  public $prlevel;         // 'autoconfirmed', 'sysop' or other levels of protection (incompatible with prtype!)
  public $direction;       // 'ascending' (default), 'descending'

  public $namespaces = array();  // traverse only these namespaces (if not set - all namespaces)

  protected $namespaces_ids = array();

  protected function iterate_element ( $element, $ActionObject ) {
    if ( empty ( $this-&gt;namespaces_ids ) &amp;&amp;&nbsp;! empty ( $this-&gt;namespaces ) ) {
      foreach ( $this-&gt;namespaces as $namespace ) {
        $this-&gt;namespaces_ids[] = $bot-&gt;wiki_namespace_id ( $namespace );
      }
    }

    if ( empty ( $this-&gt;namespaces_ids ) || in_array ( $element['id'], $this-&gt;namespaces_ids ) ) {
      $classname = get_class ( $this );
      $IterAP = new $classname ( $this-&gt;bot );  // usable by child classes, too
      $IterAP-&gt;from            = $this-&gt;from;
      $IterAP-&gt;prefix          = $this-&gt;prefix;
      $IterAP-&gt;filterredir     = $this-&gt;filterredir;
      $IterAP-&gt;filterlanglinks = $this-&gt;filterlanglinks;
      $IterAP-&gt;minsize         = $this-&gt;minsize;
      $IterAP-&gt;maxsize         = $this-&gt;maxsize;
      $IterAP-&gt;prtype          = $this-&gt;prtype;
      $IterAP-&gt;prlevel         = $this-&gt;prlevel;
      $IterAP-&gt;direction       = $this-&gt;direction;

      $IterAP-&gt;namespace       = $element['id'];

      $IterAP-&gt;iterate ( $ActionObject );
    }
  }

}


# ----------  Directory and file iterator classes  ---------- #


class Iterator_Directory extends Iterator_Generic {

  public $path;

  public $filename_regex = '/.*/';

  public $minsize = 0;
  public $maxsize = PHP_INT_MAX;

  public $ctimebeg = 0;
  public $ctimeend = PHP_INT_MAX;
  public $mtimebeg = 0;
  public $mtimeend = PHP_INT_MAX;
  public $atimebeg = 0;
  public $atimeend = PHP_INT_MAX;

  public $dirname_regex = '/^$/';   // regex for the subdirectory names to be iterated

  public $subdirs_regex = '/.*/';   // regex for the subcategory names to be recursed into
  public $max_nesting_depth = 0;    // max recursion depth (0 - no recursion)

  public $depth = 0;                // subdirectory level

  protected $dp;
  protected $files = array();
  protected $subdirs = array();

  # -----  Protected  ----- #

  private function between_values ( $min, $max, $test ) {
    if ( $min &lt;= $max ) {
      return ( ( $text &gt;= $min ) &amp;&amp; ( $test &lt;= $max ) );
    } else {
      return ( ( $text &lt; $min ) || ( $text &gt; $max ) );
    }
  }

  private function regex_matches ( $regex, $string ) {
    if (&nbsp;! is_array ( $regex ) ) { $regex = array ( $regex ); }
    foreach ( $regex as $regex_element ) {
      if ( preg_match ( $regex_element, $string, $matches ) ) { return true; }
    }
    return false;
  }

  protected function file_is_ok ( $file ) {
    return ( $this-&gt;between_values ( $this-&gt;minsize , $this-&gt;maxsize , $file['size' ] ) &amp;&amp;
             $this-&gt;between_values ( $this-&gt;atimebeg, $this-&gt;atimeend, $file['atime'] ) &amp;&amp;
             $this-&gt;between_values ( $this-&gt;mtimebeg, $this-&gt;mtimeend, $file['mtime'] ) &amp;&amp;
             $this-&gt;between_values ( $this-&gt;ctimebeg, $this-&gt;ctimeend, $file['ctime'] ) &amp;&amp;
             $this-&gt;regex_matches  ( $this-&gt;filename_regex, $file['name'] )
           );
  }

  protected function open_elements_source () {
    if (&nbsp;! is_dir ( $this-&gt;path ) ) {
      $this-&gt;error_text = &quot;Path not found: &quot; . $this-&gt;path;
      return false;
    }
    if ( substr ( $this-&gt;path, -1 )&nbsp;!= '/' ) { $this-&gt;path .= '/'; }
  }

  protected function query () {
    $dir = scandir ( $this-&gt;path );
    foreach ( $dir as $filename ) {
      $file = stat ( $this-&gt;path . $filename );
      $file['path'] = $this-&gt;path;
      $file['name'] = $filename;
      if ( is_dir ( $this-&gt;path . $filename ) ) {
        if ( $this-&gt;regex_matches ( $this-&gt;dirname_regex, $filename ) ) {
          $this-&gt;files[] = $file;
        }
        if ( $this-&gt;depth &lt; $this-&gt;max_nesting_depth ) {
          if ( $this-&gt;regex_matches ( $this-&gt;subdirs_regex, $filename ) &amp;&amp;
               ( $filename&nbsp;!= '.' ) &amp;&amp; ( $filename&nbsp;!= '..' ) ) {
            $this-&gt;subdirs[] = $filename;
          }
        }
      } else {
        if ( $this-&gt;file_is_ok ( $file ) ) { $this-&gt;files[] = $file; }
      }
    }
    return ( count ( $this-&gt;files ) &gt; 0 );
  }

  protected function continue_query () {
    return false;
  }

  protected function obtain_elements_array () {
    return $this-&gt;files;
  }

  protected function error_info () {
    return $this-&gt;error_text;
  }

  protected function iterate_elements ( $ActionObject ) {
    if (&nbsp;! is_int ( $this-&gt;ctimebeg ) ) { $this-&gt;ctimebeg = strtotime ( $this-&gt;ctimebeg ); }
    if (&nbsp;! is_int ( $this-&gt;ctimeend ) ) { $this-&gt;ctimeend = strtotime ( $this-&gt;ctimeend ); }
    if (&nbsp;! is_int ( $this-&gt;mtimebeg ) ) { $this-&gt;mtimebeg = strtotime ( $this-&gt;mtimebeg ); }
    if (&nbsp;! is_int ( $this-&gt;mtimeend ) ) { $this-&gt;mtimeend = strtotime ( $this-&gt;mtimeend ); }
    if (&nbsp;! is_int ( $this-&gt;atimebeg ) ) { $this-&gt;atimebeg = strtotime ( $this-&gt;atimebeg ); }
    if (&nbsp;! is_int ( $this-&gt;atimeend ) ) { $this-&gt;atimeend = strtotime ( $this-&gt;atimeend ); }
    parent::iterate_elements ( $ActionObject );
    foreach ( $this-&gt;subdirs as $subdir ) {
      $classname = get_class ( $this );
      $Iter = new $classname ( $this-&gt;bot );
      $Iter-&gt;path              = $this-&gt;path . $subdir;
      $Iter-&gt;filename_regex    = $this-&gt;filename_regex;
      $Iter-&gt;minsize           = $this-&gt;minsize;
      $Iter-&gt;maxsize           = $this-&gt;maxsize;
      $Iter-&gt;ctimebeg          = $this-&gt;ctimebeg;
      $Iter-&gt;ctimeend          = $this-&gt;ctimeend;
      $Iter-&gt;mtimebeg          = $this-&gt;mtimebeg;
      $Iter-&gt;mtimeend          = $this-&gt;mtimeend;
      $Iter-&gt;atimebeg          = $this-&gt;atimebeg;
      $Iter-&gt;atimeend          = $this-&gt;atimeend;
      $Iter-&gt;dirname_regex     = $this-&gt;dirname_regex;
      $Iter-&gt;subdirs_regex     = $this-&gt;subdirs_regex;
      $Iter-&gt;max_nesting_depth = $this-&gt;max_nesting_depth;
      $Iter-&gt;depth             = $this-&gt;depth++;
      $Iter-&gt;iterate ( $ActionObject );
    }
  }

}


abstract class Iterator_GenericFile extends Iterator_Generic {

  public $filename;           // this file will be read for elements to be iterated
  public $batch_size = 1000;  // read up to this number of elements per batch

  protected $fp;                  // the file handle
  protected $elements = array();  // the file elements being read and processed

  protected $error_text;

  # ----------  Protected  ---------- #

  protected function read_elements () {
    while ( count ( $this-&gt;elements ) &lt; $this-&gt;batch_size ) {
      $element = $this-&gt;read_element ();
      if ( $element === false ) { break; }
      $this-&gt;elements[] = $element;
    }
    return ( count ( $this-&gt;elements ) &gt; 0 );
  }

  protected function query () {
    return $this-&gt;read_elements();
  }

  protected function continue_query () {
    return $this-&gt;read_elements();
  }

  protected function obtain_elements_array () {
    return $this-&gt;elements;
  }

  protected function error_info () {
    return $this-&gt;error_text;
  }

  protected function open_elements_source () {
    $this-&gt;fp = @fopen ( $filename, 'r' );
    return ( $this-&gt;fp&nbsp;!== false );
  }

  protected function close_elements_source () {
    if ( @fclose ( $this-&gt;fp ) ) {
      return true;
    } else {
      return false;
    }
  }

  abstract protected function read_element ();

}


class Iterator_TextFile extends Iterator_GenericFile {

  # ----------  Protected  ---------- #

  protected function read_element () {
    while ( true ) {
      if ( feof ( $this-&gt;fp ) ) { return false; }
      return @fgets ( $this-&gt;fp );
    }
  }

}


class Iterator_ConfigFile extends Iterator_TextFile {

  public $line_comment_marks = array ( '#', '//' );

  protected $line_comment_marks_regex;

  protected function query() {
    $this-&gt;line_comment_marks_regex = '/^\s*(' . $this-&gt;bot-&gt;barsepstring ( $this-&gt;line_comment_marks, true ) . ')/Uus';
    return parent::query();
  }

  protected function read_element () {
    $line = parent::read_element();
    if ( $line === false ) { return false; }
    if ( preg_match ( $this-&gt;line_comment_marks_regex, $line, $matches ) ) $line = '';
    return $line;
  }

}


# ----------  Chronology iterator classes  ---------- #


abstract class Iterator_Monthdays_Generic extends Iterator_Apibot_Generic {

  protected $monthsdata = array (
     1 =&gt; array ( 'name' =&gt; &quot;януари&quot;   , 'days' =&gt; 31 ),
     2 =&gt; array ( 'name' =&gt; &quot;февруари&quot; , 'days' =&gt; 29 ),
     3 =&gt; array ( 'name' =&gt; &quot;март&quot;     , 'days' =&gt; 31 ),
     4 =&gt; array ( 'name' =&gt; &quot;април&quot;    , 'days' =&gt; 30 ),
     5 =&gt; array ( 'name' =&gt; &quot;май&quot;      , 'days' =&gt; 31 ),
     6 =&gt; array ( 'name' =&gt; &quot;юни&quot;      , 'days' =&gt; 30 ),
     7 =&gt; array ( 'name' =&gt; &quot;юли&quot;      , 'days' =&gt; 31 ),
     8 =&gt; array ( 'name' =&gt; &quot;август&quot;   , 'days' =&gt; 31 ),
     9 =&gt; array ( 'name' =&gt; &quot;септември&quot;, 'days' =&gt; 30 ),
    10 =&gt; array ( 'name' =&gt; &quot;октомври&quot; , 'days' =&gt; 31 ),
    11 =&gt; array ( 'name' =&gt; &quot;ноември&quot;  , 'days' =&gt; 30 ),
    12 =&gt; array ( 'name' =&gt; &quot;декември&quot; , 'days' =&gt; 31 ),
  );

  public $year;  // if not specified explicitly, the current year will be used.

  protected $leap_year;

  protected function query          () { return true&nbsp;; }
  protected function continue_query () { return false; }

  protected function obtain_elements_array () {  // just calculates whether the year is leap - extend with returning some data as array.
    if ( is_null ( $this-&gt;year ) ) { $this-&gt;year = date ( 'Y' ); }
    if ( ( $this-&gt;year&nbsp;% 4 ) == 0 ) { $this-&gt;leap_year = true;  }
    if ( ( ( $this-&gt;year&nbsp;% 100 ) == 0 ) &amp;&amp;&nbsp;! ( $this-&gt;year&nbsp;% 400 ) == 0 ) { $this-&gt;leap_year = false; }
    return false;
  }

}

class Iterator_Monthdays_Year extends Iterator_Monthdays_Generic {

  protected function obtain_elements_array () {
    parent::obtain_elements_array();

    $monthdays = array();
    $yeardayno = 1;
    foreach ( $this-&gt;monthsdata as $monthno =&gt; $monthdata ) {
      for ( $day = 1; $day &lt;= $monthdata['days']; $day++ ) {
        $monthday = array ( 'monthno' =&gt; $monthno, 'monthname' =&gt; $monthdata['name'], 'monthday' =&gt; $day, 'yearday' =&gt; $yeardayno );
        if ( $this-&gt;leap_year ||&nbsp;! ( ( $monthno == 2 ) &amp;&amp; ( $day == 29 ) ) ) {
          $monthdays[] = $monthday;
          $yeardayno++;
        }
      }
    }
    return $monthdays;
  }

}


class Iterator_Monthdays_Month extends Iterator_Monthdays_Generic {

  public $month;  // the month you would like to iterate its days, as name or number (1-12).

  protected function obtain_elements_array () {
    if ( empty ( $this-&gt;month ) ) {
      $this-&gt;log ( &quot;ERROR: Please specify a month to the monthdays iterator!&quot;, LL_PANIC );
      die();
    }
    if (&nbsp;! is_int ( $this-&gt;month ) ) {
      foreach ( $this-&gt;monthsdata as $monthno =&gt; $monthdata ) {
        if ( $this-&gt;month == $monthdata['name'] ) { $this-&gt;month = $monthno; break; }
      }
      $this-&gt;log ( &quot;ERROR: Bad month name: '&quot; . $this-&gt;month . &quot;'!&quot;, LL_PANIC );
      die();
    }
    if ( ( $this-&gt;month &lt; 1 ) || ( $this-&gt;month &gt; 12 ) ) {
      $this-&gt;log ( &quot;ERROR: Bad month No.: &quot; . $this-&gt;month . &quot;!&quot;, LL_PANIC );
      die();
    }

    $monthdays = array();
    for ( $day = 1; $day &lt;= $this-&gt;monthsdata[$this-&gt;month]; $day++ ) {
      if ( $this-&gt;leap_year ||&nbsp;! ( ( $this-&gt;month == 2 ) &amp;&amp; ( $day == 29 ) ) ) {
        $monthdays[$day] = $day;
      }
    }
    return $monthdays;
  }

}


# ----------  Database iterator classes  ---------- #

abstract class Iterator_Database_Generic extends Iterator_Generic {

  public $db_details;  // array: host, port, user, pass, name, charset - must be set before using with an iterator!
  public $db;          // may be set externally

  public $batch_size = 1000;  // read up to so much elements per batch

  public $offset = 0;

  public $db_query_sql;  // put here the SQL request, sans 'limit' and 'offset';

  protected $elements_array = array();

  protected $error_text;

  # ----- Protected ----- #

  protected function query_elements_array ( $count = NULL, $offset = NULL ) {
    $this-&gt;elements_array = $this-&gt;db_query ( $count, $offset );
    if ( is_array ( $this-&gt;elements_array ) ) $this-&gt;offset += count ( $this-&gt;elements_array );
    return (&nbsp;! empty ( $this-&gt;elements_array ) );
  }

  protected function query () {
    return $this-&gt;query_elements_array ( $this-&gt;batch_size, $this-&gt;offset );
  }

  protected function continue_query () {
    return $this-&gt;query_elements_array ( $this-&gt;batch_size, $this-&gt;offset );
  }

  protected function obtain_elements_array () {
    return $this-&gt;elements_array();
  }

  protected function error_info () {
    return $this-&gt;error_text;
  }

  # ----- Overriding ----- #

  protected function open_elements_source () {
    $this-&gt;db = $this-&gt;db_connect ( $this-&gt;db_details );
    return (&nbsp;! empty ( $this-&gt;db ) );
  }

  protected function close_elements_source () {
    return $this-&gt;db_disconnect ( $this-&gt;db );
  }

  # ----- Absract ----- #

  abstract protected function db_connect ( $db_details );
  abstract protected function db_disconnect ( $db );

  abstract protected function db_query ( $count, $offset );

  # ----- Public ----- #

  public function iterate ( $ActionObject ) {
    if ( $ActionObject instanceof ActionObject_WithDatabase ) {
      if ( empty ( $ActionObject-&gt;db_details ) ) {
        $ActionObject-&gt;db = $this-&gt;db;
      }
    }
    parent::iterate ( $ActionObject );
  }

}


class Iterator_Database_MySQL extends Iterator_Database_Generic {

  protected function db_connect ( $db_details ) {
    $hostname = $db_details['host'];
    if (&nbsp;! is_null ( $this-&gt;port ) ) {
      $hostname .= &quot;:&quot; . $db_details['port'];
    }
    $db = mysql_pconnect ( $hostname, $db_details['user'], $db_details['pass'] );
    if ( is_null ( $db ) ) {
      throw new Exception ( &quot;Could not connect to host/socket `&quot; . $hostname . &quot;` as `&quot; . $db_details['user'] . &quot;`!&quot; );
    }
    if (&nbsp;! mysql_select_db ( $db_details['name'], $db ) ) {
      throw new Exception ( &quot;Could not select database `&quot; . $db_details['name'] . &quot;`!&quot; );
    }
    if (&nbsp;! empty ( $db_details['charset'] ) ) {
      mysql_query ( &quot;SET CHARACTER SET &quot; . $db_details['charset'], $db );
      mysql_query ( &quot;SET NAMES &quot;         . $db_details['charset'], $db );
    }
    return $db;
  }

  protected function db_disconnect ( $db ) {
    // do nothing - disconnect is not needed
  }

  protected function db_query ( $count = NULL, $offset = NULL ) {
    $SQL = $this-&gt;db_query_sql ( $count, $offset );
    mysql_select_db ( $this-&gt;db_details['name'], $this-&gt;db );
    $result = mysql_query ( $SQL, $this-&gt;db );
    if (&nbsp;! $result ) {
      return false;
    } else {
      while ( $row = mysql_fetch_assoc ( $result ) ) {
        $this-&gt;elements_array[] = $row;
      }
      mysql_free_result ( $result );
    }
  }

  protected function db_query_sql ( $count = NULL, $offset = NULL ) {  // should return the SQL statement that extracts the elements
    if ( substr ( $this-&gt;db_query_sql, -1 ) == ';' ) {
      $this-&gt;db_query_sql = rtrim ( $this-&gt;db_query_sql, ';' );
    }
    if (&nbsp;! is_null ( $count  ) ) { $count  = ' LIMIT '  . $count&nbsp;; }
    if (&nbsp;! is_null ( $offset ) ) { $offset = ' OFFSET ' . $offset; }
    return $this-&gt;db_query_sql . $count . $offset . ';';
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

<!-- Saved in parser cache with key wikidb_apibot:pcache:idhash:47-0!1!0!!en!2!edit=0 and timestamp 20120916045557 -->
<div class="printfooter">
Retrieved from "<a href="http://apibot.zavinagi.org/index.php/Development_code/Apibot_iterators.php">http://apibot.zavinagi.org/index.php/Development_code/Apibot_iterators.php</a>"</div>
		<div id='catlinks' class='catlinks catlinks-allhidden'></div>		<!-- end content -->
				<div class="visualClear"></div>
	</div>
</div></div>
<div id="column-one">
	<div id="p-cactions" class="portlet">
		<h5>Views</h5>
		<div class="pBody">
			<ul>
				 <li id="ca-nstab-main" class="selected"><a href="/index.php/Development_code/Apibot_iterators.php" title="View the content page [c]" accesskey="c">Page</a></li>
				 <li id="ca-talk" class="new"><a href="/index.php?title=Talk:Development_code/Apibot_iterators.php&amp;action=edit&amp;redlink=1" title="Discussion about the content page [t]" accesskey="t">Discussion</a></li>
				 <li id="ca-viewsource"><a href="/index.php?title=Development_code/Apibot_iterators.php&amp;action=edit" title="This page is protected.&#10;You can view its source [e]" accesskey="e">View source</a></li>
				 <li id="ca-history"><a href="/index.php?title=Development_code/Apibot_iterators.php&amp;action=history" title="Past revisions of this page [h]" accesskey="h">History</a></li>
			</ul>
		</div>
	</div>
	<div class="portlet" id="p-personal">
		<h5>Personal tools</h5>
		<div class="pBody">
			<ul>
				<li id="pt-login"><a href="/index.php?title=Special:UserLogin&amp;returnto=Development_code/Apibot_iterators.php" title="You are encouraged to log in; however, it is not mandatory [o]" accesskey="o">Log in</a></li>
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
				<li id="t-whatlinkshere"><a href="/index.php/Special:WhatLinksHere/Development_code/Apibot_iterators.php" title="List of all wiki pages that link here [j]" accesskey="j">What links here</a></li>
				<li id="t-recentchangeslinked"><a href="/index.php/Special:RecentChangesLinked/Development_code/Apibot_iterators.php" title="Recent changes in pages linked from this page [k]" accesskey="k">Related changes</a></li>
<li id="t-specialpages"><a href="/index.php/Special:SpecialPages" title="List of all special pages [q]" accesskey="q">Special pages</a></li>
				<li id="t-print"><a href="/index.php?title=Development_code/Apibot_iterators.php&amp;printable=yes" rel="alternate" title="Printable version of this page [p]" accesskey="p">Printable version</a></li>				<li id="t-permalink"><a href="/index.php?title=Development_code/Apibot_iterators.php&amp;oldid=283" title="Permanent link to this revision of the page">Permanent link</a></li>			</ul>
		</div>
	</div>
</div><!-- end of the left (by default at least) column -->
<div class="visualClear"></div>
<div id="footer">
	<div id="f-poweredbyico"><a href="http://www.mediawiki.org/"><img src="/skins/common/images/poweredby_mediawiki_88x31.png" height="31" width="88" alt="Powered by MediaWiki" /></a></div>
	<ul id="f-list">
		<li id="lastmod"> This page was last modified on 28 August 2011, at 19:17.</li>
		<li id="viewcount">This page has been accessed 856 times.</li>
		<li id="privacy"><a href="/index.php/Apibot:Privacy_policy" title="Apibot:Privacy policy">Privacy policy</a></li>
		<li id="about"><a href="/index.php/Apibot:About" title="Apibot:About">About Apibot</a></li>
		<li id="disclaimer"><a href="/index.php/Apibot:General_disclaimer" title="Apibot:General disclaimer">Disclaimers</a></li>
	</ul>
</div>
</div>

<script>if (window.runOnloadHook) runOnloadHook();</script>
<!-- Served in 0.130 secs. --></body></html>
