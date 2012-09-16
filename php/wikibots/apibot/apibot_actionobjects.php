<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" dir="ltr">
<head>
<title>Development code/Apibot actionobjects.php - Apibot</title>
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
wgPageName="Development_code/Apibot_actionobjects.php",
wgTitle="Development code/Apibot actionobjects.php",
wgAction="view",
wgArticleId=48,
wgIsArticle=true,
wgUserName=null,
wgUserGroups=null,
wgUserLanguage="en",
wgContentLanguage="en",
wgBreakFrames=false,
wgCurRevisionId=280,
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
<body class="mediawiki ltr ns-0 ns-subject page-Development_code_Apibot_actionobjects_php skin-monobook">
<div id="globalWrapper">
<div id="column-content"><div id="content" >
	<a id="top"></a>
	
	<h1 id="firstHeading" class="firstHeading">Development code/Apibot actionobjects.php</h1>
	<div id="bodyContent">
		<h3 id="siteSub">From Apibot</h3>
		<div id="contentSub"></div>
		<div id="jump-to-nav">Jump to: <a href="#column-one">navigation</a>, <a href="#searchInput">search</a></div>
		<!-- start content -->
<p>This is the development code of the Apibot actionobjects module.
</p>
<pre>
&lt;?php
#
#  An Apibot extension - ActionObjects. Used together with the Iterators.
#
#  Example for usage:
#
#  $bot = new Apibot ( $bot_login_data, $logname );
#  $bot-&gt;enter_wiki();  // mandatory for some iterators to work
#  $Iterator = new Iterator_WhateverTypeYouNeed ( $bot );
#  $ActionObject = new ActionObject_WhateverActionYouNeed();
#  $processed_elements_count = $Iterator-&gt;iterate ( $ActionObject );
#
# &nbsp;!!! Beware! Not every iterator fills out all properties of an object!&nbsp;!!!
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

require_once ( dirname ( __FILE__ ) . &quot;/apibot_dataobjects.php&quot; );


# ---------------------------------------------------------------------------- #
# --                                                                        -- #
# --                    Official ActionObject classes                       -- #
# --                                                                        -- #
# -- The Apibot canonical support of the MediaWiki API.                     -- #
# --                                                                        -- #
# ---------------------------------------------------------------------------- #


# ---------------------------------------------------------------------------- #
# --                    Generic ActionObject classes                        -- #
# ---------------------------------------------------------------------------- #


abstract class ActionObject {

  public $iterator;

  public function preprocess () {  // override on need
    return true;
  }

  public function postprocess () {  // override on need
    return true;
  }

  abstract public function process ( $element );

}


abstract class ActionObject_WithBot extends ActionObject {

  protected $bot;

  function __construct ( $bot ) {
    $this-&gt;bot = $bot;
  }

  public function log ( $string, $loglevel = LL_INFO ) {
    return $this-&gt;bot-&gt;log ( $string, $loglevel );
  }

}


abstract class ActionObject_WithComment extends ActionObject_WithBot {

  public $comment;  // AKA reason, summary etc.

  protected function get_comment ( $element, $object ) {
    return $this-&gt;comment;
  }

}


abstract class ActionObject_WriteFile extends ActionObject {

  public $filename;

  abstract protected function element_string ( $element );  // should return NULL to have nothing written into the file

  protected function get_filename ( $element ) {
    return $this-&gt;filename;
  }

  public function process ( $element ) {
    $string = $this-&gt;element_string ( $element );
    if (&nbsp;! is_null ( $string ) ) {
      my_fwrite ( $this-&gt;get_filename ( $element ), $string );
      return true;
    } else {
      return false;
    }
  }
}


abstract class ActionObject_Iterate extends ActionObject_WithBot {

  protected $internal_iterator;
  protected $internal_actionobject;

  abstract protected function create_iterator     ( $element );
  abstract protected function create_actionobject ( $bot, $element );

  public function process ( $element ) {
    $this-&gt;internal_iterator     = $this-&gt;create_iterator     ( $element );
    $this-&gt;internal_actionobject = $this-&gt;create_actionobject ( $this-&gt;bot, $element );
    return $this-&gt;internal_iterator-&gt;iterate ( $this-&gt;internal_actionobject );
  }

}


# ---------------------------------------------------------------------------- #
# --                      Common ActionObject classes                       -- #
# ---------------------------------------------------------------------------- #


class ActionObject_Echo extends ActionObject {  // for testing iterators etc.

  public function process ( $element ) {
    print_r ( $element ); echo &quot;\n&quot;;
    return true;
  }

}


class ActionObject_Count extends ActionObject {  // just counts the objects
// This is the most resource-consuming way - use as a last resort only, or for counting very specific objects only!

  public $count = 0;

  protected function countable ( $element ) { return true; }  // override to count specific elements

  public function process ( $element ) {
    if ( $this-&gt;countable ( $element ) ) {
      $this-&gt;count++;
      return true;
    } else {
      return false;
    }
  }

}


class ActionObject_MakeArray extends ActionObject {  // useful to get an elements array

  public $unique = false;

  public $startno;
  public $count;
  protected $element_counter = 0;

  public $elements = array();

  protected function process_element ( $element ) {
  // override to make array only of element parts, or of processed elements; return NULL to skip adding this specific element
    return $element;
  }

  protected function element_array_key ( $element ) {
    return NULL;
  }

  public function process ( $element ) {
    $processed_element = $this-&gt;process_element ( $element );
    if (&nbsp;! is_null ( $processed_element ) ) {
      $this-&gt;elements_counter++;
      if ( is_numeric ( $this-&gt;startno ) &amp;&amp; ( $this-&gt;startno &gt;= $this-&gt;elements_counter ) ) return false;
      if ( is_numeric ( $this-&gt;count ) &amp;&amp; ( $this-&gt;startno + $this-&gt;count &lt; $this-&gt;elements_counter ) ) return false;
      if (&nbsp;! ( $this-&gt;unique &amp;&amp; in_array ( $processed_element, $this-&gt;elements ) ) ) {
        $key = $this-&gt;element_array_key ( $processed_element );
        if ( is_null ( $key ) ) {
          $this-&gt;elements[] = $processed_element;
        } else {
          $this-&gt;elements[$key] = $processed_element;
        }
        return true;
      }
      return false;
    }
  }

}


# ---------------------------------------------------------------------------- #
# --                 Standard Page ActionObject classes                     -- #
# ---------------------------------------------------------------------------- #


# -----  Abstract  ----- #


abstract class ActionObject_Page_Generic extends ActionObject_WithComment {

  # --- Page titles --- #

  public $move_new_title = true;  // on move page events return the new title; false - the old title

  protected function element_pagetitle ( &amp;$element ) {
    if ( is_string ( $element ) ) {
      return $element;
    } elseif ( is_array ( $element ) ) {
      return $element['title'];
    } elseif ( is_object ( $element ) ) {
      if ( $element instanceof Page ) {
        return $element-&gt;title;
      } elseif ( $element instanceof RecentChange ) {
        if ( $this-&gt;move_new_title &amp;&amp; ( $element-&gt;type == 'log' ) &amp;&amp; ( $element-&gt;logtype == 'move' ) &amp;&amp; ( $element-&gt;logaction == 'move' ) ) {
          return $element-&gt;logparams;
        } else {
          return $element-&gt;title;
        }
      } elseif ( $element instanceof UserContrib ) {
        return $element-&gt;title;
      } elseif ( $element instanceof LogEvent ) {
        if ( $this-&gt;move_new_title &amp;&amp; ( $element-&gt;logtype == 'move' ) &amp;&amp; ( $element-&gt;logaction == 'move' ) ) {
          return $element-&gt;logparams;
        } else {
          return $element-&gt;title;
        }
      } elseif ( $element instanceof ProtectedTitle ) {
        return $element-&gt;title;
      } elseif ( $element instanceof Page_WithExtlink ) {
        return $element-&gt;title;
      } elseif ( $element instanceof Page_FromWatchlist ) {
        return $element-&gt;title;
      } elseif ( $element instanceof List_Title ) {
        return $element-&gt;title;
      } elseif ( $element instanceof List_Link ) {
        return $element-&gt;title;
      } elseif ( $element instanceof List_SearchResult ) {
        return $element-&gt;title;
      }
    }
    $this-&gt;log ( &quot;Unsupported element type supplied by &quot; . get_class ( $this-&gt;iterator ) . &quot; to &quot; . get_class ( $this ) . &quot;!&quot;, LL_ERROR );
    return false;
  }

  # --- Full pages --- #

  protected $element_page_properties;

  protected function refetch_page_if_needed ( $page ) {
    if (&nbsp;! empty ( $this-&gt;element_page_properties ) ) {
      return $this-&gt;bot-&gt;fetch_page ( $page-&gt;title, $this-&gt;element_page_properties );
    }
  }

  protected function element_page ( &amp;$element ) {
    if ( is_object ( $element ) ) {
      if ( $element instanceof Page ) {
        return $this-&gt;refetch_page_if_needed ( $element );
      }
    }
    $title = $this-&gt;element_pagetitle ( $element );
    if ( $title === false ) {
      return false;
    }
    return $this-&gt;bot-&gt;fetch_page ( $title, $this-&gt;element_page_properties );
  }

  # --- Element texts --- #

  public $get_text = true;

  protected function element_text ( &amp;$element ) {
    if (&nbsp;! $this-&gt;get_text ) { return false; }
    if ( is_string ( $element ) ) {
      return $element;
    } elseif ( is_array ( $element ) ) {
      return $element['text'];
    } elseif ( is_object ( $element ) ) {
      if ( $element instanceof Page ) {
        return $element-&gt;text;
      } elseif ( $element instanceof PageRevision ) {
        return $element-&gt;content;
      }
    }
    $this-&gt;log ( &quot;Unsupported element type supplied by &quot; . get_class ( $this-&gt;iterator ) . &quot; to &quot; . get_class ( $this ) . &quot;!&quot;, LL_ERROR );
    return false;
  }

}


abstract class ActionObject_Page_Edit_Generic extends ActionObject_Page_Generic {

  public $edit_minor = true;

  protected $element_page_properties = array (
    'info' =&gt; array ( 'prop' =&gt; 'protection' ),
    'revisions' =&gt; array ( 'prop' =&gt; 'content|timestamp', 'limit' =&gt; 1 ),
  );

  # ----------  Protected  ---------- #

  protected function is_editable ( $element, $page ) { return ( $page&nbsp;!== false ); }

  protected function refetch_page_if_needed ( $page ) {
    if ( is_null ( $page-&gt;text ) || empty ( $page-&gt;timestamp ) ) {
      return $this-&gt;bot-&gt;fetch_page ( $page-&gt;title, $this-&gt;element_page_properties );
    }
    return $page;
  }

  protected function get_edit_minor ( $page ) { return $this-&gt;edit_minor; }

  protected function modify_page ( &amp;$page, $element ) { return $page-&gt;is_modified(); }  // override in children classes

  # ----------  Public  ---------- #

  public function process ( $element ) {
    $page = $this-&gt;element_page ( $element );
    if ( $page === false ) {
      $this-&gt;log ( &quot;Page does not exist - skipping...&quot; );
      return false;
    }
    if ( $this-&gt;is_editable ( $element, $page ) ) {
      $this-&gt;log ( &quot;Editing page '&quot; . $page-&gt;title . &quot;'...&quot;, LL_INFO );
      if ( $this-&gt;modify_page ( $page, $element ) ) {
        return $this-&gt;bot-&gt;submit_page ( $page,
           $this-&gt;get_comment ( $element, $page ),
           $this-&gt;get_edit_minor ( $element ) );
      }
    }
    return false;
  }

}


# -----  Classic page actions  ----- #


class ActionObject_Page_Edit extends ActionObject_Page_Edit_Generic {

  public $replaces = array();

  protected $replacements_count;

  # -----  Protected  ----- #

  protected function register_action ( $replace, $count ) { return true; }

  protected function replace ( &amp;$page, &amp;$replace ) {
    if ( is_null ( $replace['name'] ) ) $replace['name'] = &quot;Replacing &quot; . $replace['regex'] . &quot; with &quot; . $replace['with'];
    if ( is_null ( $replace['limit'] ) ) $replace['limit'] = -1;

    if ( empty ( $replace['regex'] ) ) {
      $page-&gt;text .= $replace['with'];
      $this-&gt;replacements_count++;
    } else {
      $regex = $replace['regex'];
      $this-&gt;replacements_count += $page-&gt;replace ( $regex, $replace['with'], $replace['limit'] );
    }
    $this-&gt;register_action ( $replace, $this-&gt;replacements_count );
    if ( $count &gt; 0 ) {
      $this-&gt;log ( $replace['name'] . &quot;: &quot; . $count, LL_DEBUG );
    }
  }

  protected function modify_page ( &amp;$page, $element ) {
    $this-&gt;replacements_count = 0;

    foreach ( $this-&gt;replaces as $replace ) {
      $this-&gt;replace ( $page, $replace, $templates[$replace['type']] );
    }

    return parent::modify_page ( $page, $element );
  }

}


class ActionObject_Page_Undo extends ActionObject_Page_Generic {

  public $revert_revid;
  public $to_revid;

  protected function is_undoable ( $element, $title ) { return ( $title&nbsp;!== false ); }  // override to get page-specific undo

  protected function revert_revid ( $element, $title ) { return $this-&gt;revert_revid; } // override on need
  protected function to_revid     ( $element, $title ) { return $this-&gt;to_revid; } // override on need

  public function process ( $element ) {
    if ( $this-&gt;bot-&gt;can_i_edit() ) {
      $title = $this-&gt;element_pagetitle ( $element );
      if ( $this-&gt;is_undoable ( $element, $title ) ) {
        return $this-&gt;bot-&gt;undo_page ( $title,
          $this-&gt;revert_revid ( $element, $title ),
          $this-&gt;to_revid ( $element, $title ),
          $this-&gt;get_comment ( $element, $title )
        );
      }
    }
    return false;
  }

}


class ActionObject_Page_Move extends ActionObject_Page_Generic {

  public $noredirect = false;  // whether to not leave a redirect
  public $movetalk   = true&nbsp;;  // whether to move the talk page, too

  public $move_over  = false;  // if a page with the new name already exist, whether to delete it

  protected function is_moveable ( $element, $title ) { return ( $title&nbsp;!== false ); }  // override to get page-specific deletion

  protected function element_newtitle ( $element, $title ) {
    if ( is_string ( $element ) ) {
      return $element;  // best override it - this will also be the old title!
    } elseif ( is_array ( $element ) ) {
      return $element['new_title'];
    } elseif ( is_object ( $element ) ) {
      return $element-&gt;new_title;
    }
    $this-&gt;log ( &quot;Unsupported element type supplied by &quot; . get_class ( $this-&gt;iterator ) . &quot; to &quot; . get_class ( $this ) . &quot;!&quot;, LL_ERROR );
    return false;
  }

  protected function noredirect ( $element, $title ) { return $this-&gt;noredirect; }
  protected function movetalk   ( $element, $title ) { return $this-&gt;movetalk &nbsp;; }

  protected function free_new_name ( $new_title, $title, $element ) {
    $this-&gt;bot-&gt;delete_page ( $new_title, &quot;Will move [[&quot; . $title . &quot;]] at its place&quot; );
  }

  public function process ( $element ) {
    $title = $this-&gt;element_pagetitle ( $element );
    if ( $this-&gt;is_moveable ( $element, $title ) ) {
      $new_title = $this-&gt;element_newtitle ( $element, $title );
      if ( empty ( $new_title ) ) {
        return false;
      } else {
        if ( $this-&gt;move_over ) $this-&gt;free_new_name ( $new_title, $title, $element );
        return $this-&gt;bot-&gt;move_page ( $title, $new_title,
          $this-&gt;get_comment ( $element, $title ),
          $this-&gt;noredirect ( $element, $title ),
          $this-&gt;movetalk ( $element, $title ) );
      }
    }
    return false;
  }

}


class ActionObject_Page_Delete extends ActionObject_Page_Generic {

  protected function is_deleteable ( $element, $title ) { return ( $title&nbsp;!== false ); }  // override to get page-specific deletion

  public function process ( $element ) {
    $title = $this-&gt;element_pagetitle ( $element );
    if ( $this-&gt;is_deleteable ( $element, $title ) ) {
      return $this-&gt;bot-&gt;delete_page ( $title, $this-&gt;get_comment ( $element, $title ) );
    }
    return false;
  }

}


class ActionObject_Page_Undelete extends ActionObject_Page_Generic {  // MW 1.12+

  public $timestamps = array();  // list of the timestamps of revisions to be restored (if empty - all)

  public $drstart;  // used only if $timestamps is empty
  public $drend;    // used only if $timestamps is empty
  public $druser;   // used only if $timestamps is empty

  protected function is_undeleteable ( $element, $title ) { return ( $title&nbsp;!== false ); }  // override to get per-page undeleting

  protected function get_timestamps ( $title ) {
    if ( empty ( $this-&gt;timestamps ) ) {
      $timestamps = array();
      $Iter = new Iterator_DeletedRevs ( $this-&gt;bot );
      $Iter-&gt;titles[] = $title;
      $Iter-&gt;start    = $this-&gt;drstart;
      $Iter-&gt;end      = $this-&gt;drend;
      $AO = new ActionObject_MakeArray ( $this-&gt;bot );
      $Iter-&gt;iterate ( $AO );
      foreach ( $AO-&gt;elements as $revision ) {
        if ( is_null ( $this-&gt;druser ) ||
             ( is_string ( $this-&gt;druser ) &amp;&amp; ( $revision-&gt;user === $this-&gt;druser ) ) ||
             ( is_array ( $this-&gt;druser ) &amp;&amp; in_array ( $revision-&gt;user, $this-&gt;druser ) )
           ) {
          $timestamps[] = $revision-&gt;timestamp;
        }
      }
      return $timestamps;
    } else {
      return $this-&gt;timestamps;
    }
  }

  public function process ( $element ) {
    $title = $this-&gt;element_pagetitle ( $element );
    if ( $this-&gt;is_undeleteable ( $element, $title ) ) {
      return $this-&gt;bot-&gt;undelete_page ( $title,
        $this-&gt;get_comment ( $element, $title ),
        $this-&gt;get_timestamps ( $title ) );
    }
    return false;
  }

}


class ActionObject_Page_Rollback extends ActionObject_Page_Generic {

  public $user;

  protected function is_rollbackable ( $element, $title ) { return ( $title&nbsp;!== false ); }  // override to get page-specific rollback

  protected function get_user ( $element, $title ) { return $this-&gt;user; }

  public function process ( $element ) {
    $title = $this-&gt;element_pagetitle ( $element );
    if ( $this-&gt;is_rollbackable ( $element, $title ) ) {
      if ( $this-&gt;bot-&gt;can_i_rollback() ) {
        return $this-&gt;bot-&gt;rollback_page ( $title,
          $this-&gt;get_user ( $element, $title ),
          $this-&gt;get_comment ( $element, $title ) );
      } else {
        $this-&gt;log ( &quot;Cannot rollback here!&quot;, LL_ERROR );
        // possibly try RevertRevisions, if $this-&gt;bot-&gt;can_i_edit()?
      }
    }
    return false;
  }

}


class ActionObject_Page_Protect extends ActionObject_Page_Generic {

  public $edit     = 'sysop';
  public $move     = 'sysop';
  public $rollback = 'sysop';
  public $delete   = 'sysop';
  public $restore  = 'sysop';

  public $expiry   = NULL;
  public $cascade  = false;

  protected function is_protectable ( $element, $title ) { return ( $title&nbsp;!== false ); }  // override to get page-specific protection

  protected function get_protections ( $element, $title ) {
    return array (
      'edit'     =&gt; $this-&gt;edit,
      'move'     =&gt; $this-&gt;move,
      'rollback' =&gt; $this-&gt;rollback,
      'delete'   =&gt; $this-&gt;delete,
      'restore'  =&gt; $this-&gt;restore,
    );
  }

  protected function get_expiry  ( $element, $title ) { return $this-&gt;expiry&nbsp;; }
  protected function get_cascase ( $element, $title ) { return $this-&gt;cascade; }

  public function process ( $element ) {  // override to set per-element protections, expiry, comment and/or cascade
    $title = $this-&gt;element_pagetitle ( $element );
    if ( $this-&gt;is_protectable ( $element, $title ) ) {
      return $this-&gt;bot-&gt;protect_page ( $title,
        $this-&gt;get_protections ( $element, $title ),
        $this-&gt;get_expiry ( $element, $title ),
        $this-&gt;get_comment ( $element, $title ),
        $this-&gt;get_cascade ( $element, $title ) );
    }
    return false;
  }

  public function set_unprotect () {  // call after creating to turn the object in common unprotection mode
    $this-&gt;edit     = 'all';
    $this-&gt;move     = 'autoconfirmed';
    $this-&gt;rollback = 'autoconfirmed';
    $this-&gt;delete   = 'sysop';
    $this-&gt;restore  = 'autoconfirmed';
  }

}


class ActionObject_Page_Watch extends ActionObject_Page_Generic {

  public $watch_on = true;

  protected function is_watchable ( $element, $title ) { return ( $title&nbsp;!== false ); } // override to get page-specific watching

  protected function get_watch_on ( $element, $title ) { return $this-&gt;watch_on; }

  public function process ( $element ) {
    $title = $this-&gt;element_pagetitle ( $element );
    if ( $this-&gt;is_watchable ( $element, $title ) ) {
      return $this-&gt;bot-&gt;watch_page ( $title, $this-&gt;get_watch_on ( $element, $title ) );
    }
    return false;
  }

}


class ActionObject_Page_Import extends ActionObject_Page_Generic {  // MW 1.15+

  public $source;               // interwiki to import the page from
  public $fullhistory = false;  // import all page revisions, not just the current one
  public $namespace;            // import into this namespace instead of in the original page namespace
  public $templates   = false;  // import also all templates included in the page

  protected function is_importable ( $element, $title ) { return ( $title&nbsp;!== false ); } // override to get page-specific import

  protected function get_source      ( $element, $title ) { return $this-&gt;source    &nbsp;; }
  protected function get_fullhistory ( $element, $title ) { return $this-&gt;fullhistory; }
  protected function get_namespace   ( $element, $title ) { return $this-&gt;namespace &nbsp;; }
  protected function get_templates   ( $element, $title ) { return $this-&gt;templates &nbsp;; }

  public function process ( $element ) {
    $title = $this-&gt;element_pagetitle ( $element );
    if ( $this-&gt;is_importable ( $element ) ) {
      return $this-&gt;bot-&gt;import_page ( $title,
        $this-&gt;get_source ( $element, $title ),
        $this-&gt;get_fullhistory ( $element, $title ),
        $this-&gt;get_namespace ( $element, $title ),
        $this-&gt;get_templates ( $element, $title ) );
    }
    return false;
  }

}


class ActionObject_Page_PurgeCache extends ActionObject_Page_Generic {

  protected function is_purgeable ( $element, $title ) { return ( $title&nbsp;!== false ); }

  public function process ( $element ) {
    $title = $this-&gt;element_pagetitle ( $element );
    if ( $this-&gt;is_purgeable ( $element, $title ) ) {
      return $this-&gt;bot-&gt;purge_page_cache ( $title );
    }
    return false;
  }

}


# ----------  Text and page preprocessing ActionObject classes  ---------- #

class ActionObject_ExpandTemplates extends ActionObject_Page_Generic {

  protected function is_expandable ( $element ) { return true; }

  protected function postprocess_text ( $text, $element ) {
    echo $text . &quot;\n&quot; . str_repeat ( '-', 80 ) . &quot;\n&quot;;  // override to get something more useful
  }

  public function process ( $element ) {
    if ( $this-&gt;is_expandable ( $element ) ) {
      $text = $this-&gt;bot-&gt;expand_templates ( $this-&gt;element_text ( $element ),
        $this-&gt;element_pagetitle ( $element ) );
      if ( $text === false ) {
        return false;
      } else {
        return $this-&gt;postprocess_text ( $text, $element );
      }
    }
  }

}


class ActionObject_ParseText extends ActionObject_Page_Generic {

  public $properties;
  public $pst = true;
  public $uselang;

  protected function is_parseable ( $element ) { return true; }

  protected function get_properties ( $element ) { return $this-&gt;properties; }
  protected function get_pst ( $element ) { return $this-&gt;pst; }
  protected function get_uselang ( $element ) { return $this-&gt;uselang; }

  protected function postprocess_data ( $data, $element ) {
    print_r ( $data );  // override to get something more useful
  }

  public function process ( $element ) {
    if ( $this-&gt;is_parseable ( $element ) ) {
      $data = $this-&gt;bot-&gt;parse_text ( $this-&gt;element_text ( $element ),
        $this-&gt;element_pagetitle ( $element ), $this-&gt;get_properties ( $element ),
        $this-&gt;get_pst ( $element ), $this-&gt;get_uselang ( $element ) );
      if ( $data === false ) {
        return false;
      } else {
        return $this-&gt;postprocess_data ( $data, $element );
      }
    }
  }

}


class ActionObject_ParsePage extends ActionObject_Page_Generic {

  public $properties;
  public $uselang;

  protected function is_parseable ( $element ) { return true; }

  protected function get_properties ( $element ) { return $this-&gt;properties; }
  protected function get_uselang ( $element ) { return $this-&gt;uselang; }

  protected function postprocess_data ( $data ) {
    print_r ( $data );  // override to get something more useful
  }

  public function process ( $element ) {
    if ( $this-&gt;is_parseable ( $element ) ) {
      $data = $this-&gt;bot-&gt;parse_page ( $this-&gt;element_pagetitle ( $element ),
        $this-&gt;get_properties ( $element ), $this-&gt;get_uselang ( $element ) );
      if ( $data === false ) {
        return false;
      } else {
        return $this-&gt;postprocess_data ( $data );
      }
    }
  }

}


# ---------- Misc additional page-related ActionObject classes ---------- #


class ActionObject_MakeArray_PageTitles extends ActionObject_Page_Generic {

  public $unique = false;

  public $elements = array();

  public function process ( $element ) {
    $title = $this-&gt;element_pagetitle ( $element );
    if (&nbsp;! ( $this-&gt;unique &amp;&amp; in_array ( $title, $this-&gt;elements ) ) ) {
      $this-&gt;elements[] = $title;
      return true;
    } else {
      return false;
    }
  }

}



# ---------------------------------------------------------------------------- #
# --                 Standard User ActionObject classes                     -- #
# ---------------------------------------------------------------------------- #

# ----------  Abstract  ---------- #

abstract class ActionObject_User_Generic extends ActionObject_WithComment {

  protected function element_username ( $element ) {
    if ( is_string ( $element ) ) {
      return $element;
    } elseif ( is_array ( $element ) ) {
      return $element['user'];
    } elseif ( is_object ( $element ) ) {
      if ( $element instanceof User ) {
        return $element-&gt;name;
      } elseif ( $element instanceof UserContrib ) {  // and thus also of RecentChange
        return $element-&gt;user;
      } elseif ( $element instanceof Block ) {
        return $element-&gt;user;
      } elseif ( $element instanceof LogEvent ) {
        return $element-&gt;user;
      } elseif ( $element instanceof Image ) {
        return $element-&gt;user;
      } elseif ( $element instanceof ProtectedTitle ) {
        return $element-&gt;user;
      } elseif ( $element instanceof Page_FromWatchlist ) {
        return $element-&gt;user;
      } elseif ( $element instanceof Page_Revision ) {
        return $element-&gt;user;
      } elseif ( $element instanceof Page_ImageInfo ) {
        return $element-&gt;user;
      } elseif ( $element instanceof Page_DuplicateFile ) {
        return $element-&gt;user;
      }
    }
    $this-&gt;log ( &quot;Unsupported element type supplied by &quot; . get_class ( $this-&gt;iterator ) . &quot; to &quot; . get_class ( $this ) . &quot;!&quot;, LL_ERROR );
    return false;
  }

}


# ----------  Non-abstract  ---------- #

class ActionObject_User_Block extends ActionObject_User_Generic {

  public $expiry    = 'never';  // expiry timestamp, or stuff like '5 months', '2 weeks' etc.
  public $anononly  = false;
  public $nocreate  = false;
  public $autoblock = false;
  public $noemail   = false;

  protected function is_blockable ( $element, $username ) { return ( $username&nbsp;!== false ); }  // override to get per-user blocking

  protected function get_expiry    ( $element, $username ) { return $this-&gt;expiry  &nbsp;; }
  protected function get_anononly  ( $element, $username ) { return $this-&gt;anononly&nbsp;; }
  protected function get_nocreate  ( $element, $username ) { return $this-&gt;nocreate&nbsp;; }
  protected function get_autoblock ( $element, $username ) { return $this-&gt;autoblock; }
  protected function get_noemail   ( $element, $username ) { return $this-&gt;noemail &nbsp;; }

  public function process ( $element ) {
    $username = $this-&gt;element_username ( $element );
    if ( $this-&gt;is_blockable ( $element, $username ) &amp;&amp; $this-&gt;bot-&gt;can_i_block() ) {
      return $this-&gt;bot-&gt;block_user ( $username,
        $this-&gt;get_expiry    ( $element, $username ),
        $this-&gt;get_comment   ( $element, $username ),
        $this-&gt;get_anononly  ( $element, $username ),
        $this-&gt;get_nocreate  ( $element, $username ),
        $this-&gt;get_autoblock ( $element, $username ),
        $this-&gt;get_noemail   ( $element, $username ) );
    }
    return false;
  }

}


class ActionObject_User_Unblock extends ActionObject_User_Generic {

  public $block_id;

  protected function is_unblockable ( $element, $username ) { return ( $username&nbsp;!== false ); }  // override to get per-user unblocking

  protected function get_block_id ( $element, $username ) { return $this-&gt;block_id; }

  public function process ( $element ) {
    $username = $this-&gt;element_username ( $element );
    if ( $this-&gt;is_unblockable ( $element, $username ) ) {
      return $this-&gt;bot-&gt;unblock_user ( $username,
        $this-&gt;get_block_id ( $element, $username ),
        $this-&gt;get_comment ( $element, $username ) );
    }
    return false;
  }

}


class ActionObject_User_ModifyGroups extends ActionObject_User_Generic {  // MW 1.16+

  public $addto_groups      = array();
  public $removefrom_groups = array();

  protected function is_modifiable ( $element, $username ) { return ( $username&nbsp;!== false ); }  // override to get per-user groups modification

  protected function get_addto_groups      ( $element, $username ) { return $this-&gt;addto_groups    &nbsp;; }
  protected function get_removefrom_groups ( $element, $username ) { return $this-&gt;removefrom_groups; }

  public function process ( $element ) {
    $username = $this-&gt;element_username ( $element );
    if ( $this-&gt;is_modifiable ( $element, $username ) ) {
      return $this-&gt;bot-&gt;change_userrights ( $username,
        $this-&gt;get_addto_groups ( $element, $username ),
        $this-&gt;get_removefrom_groups ( $element, $username ),
        $this-&gt;get_comment ( $element, $username ) );
    }
    return false;
  }

}


class ActionObject_User_Email extends ActionObject_User_Generic {

  public $subject;
  public $text;
  public $cc_me = false;

  protected function is_emailable ( $element, $username ) { return ( $username&nbsp;!== false ); } // override to get per-user emailing

  protected function get_subject ( $element, $username ) { return $this-&gt;subject; }
  protected function get_text    ( $element, $username ) { return $this-&gt;text  &nbsp;; }
  protected function get_cc_me   ( $element, $username ) { return $this-&gt;cc_me &nbsp;; }

  public function process ( $element ) {
    $username = $this-&gt;element_username ( $element );
    if ( $this-&gt;is_emailable ( $element, $username ) ) {
      return $this-&gt;bot-&gt;email_user ( $username,
        $this-&gt;get_subject ( $element, $username ),
        $this-&gt;get_text    ( $element, $username ),
        $this-&gt;get_cc_me   ( $element, $username ) );
    }
    return false;
  }

}


# ---------------------------------------------------------------------------- #
# --             Standard RecentChange ActionObject classes                 -- #
# ---------------------------------------------------------------------------- #

# ----------  Abstract  ---------- #

abstract class ActionObject_RecentChange_Generic extends ActionObject {

  protected function element_rcid ( $element ) {
    if ( is_numeric ( $element ) ) {
      return $element;
    } elseif ( is_array ( $element ) ) {
      return $element['rcid'];
    } elseif ( is_object ( $element ) ) {
      if ( $element instanceof RecentChange ) {
        return $element-&gt;rcid;
      } elseif ( $element instanceof Page_FromWatchList ) {
        return $element-&gt;rcid;
      }  // could also fetch RCs by page revisions, different log events etc. (needs fetch_*() functions!)
    }
    $this-&gt;log ( &quot;Unsupported element type supplied by &quot; . get_class ( $this-&gt;iterator ) . &quot; to &quot; . get_class ( $this ) . &quot;!&quot;, LL_ERROR );
    return false;
  }

}

# ----------  Non-abstract  ---------- #

class ActionObject_RecentChange_Patrol extends ActionObject {

  protected function is_patrollable ( $element, $rcid ) { return ( $rcid&nbsp;!== false ); }  // override to get per-recentchange patrolling

  public function process ( $element ) {
    if ( $this-&gt;bot-&gt;can_i_autopatrol() ) {
      $rcid = $this-&gt;element_rcid ( $element );
      if ( $this-&gt;is_patrollable ( $element, $rcid ) ) {
        return $this-&gt;bot-&gt;patrol_recentchange ( $rcid );
      }
    }
    return false;
  }

}



# ---------------------------------------------------------------------------- #
# --            Standard FileProcessing ActionObject classes                -- #
# ---------------------------------------------------------------------------- #


class ActionObject_Upload_File extends ActionObject_WithComment {

  public $watch          = false;
  public $ignorewarnings = true;

  protected function element_filename ( $element ) {
    if ( is_array ( $element ) ) {
      if (&nbsp;! empty ( $element['filename'] ) ) {
        return $element['filename'];
      } elseif (&nbsp;! empty ( $element['file'] ) ) {
        return $element['file'];
      }
    } elseif ( is_string ( $element ) ) {
      return $element;
    } 
    $this-&gt;log ( &quot;Unsupported element type supplied by &quot; . get_class ( $this-&gt;iterator ) . &quot; to &quot; . get_class ( $this ) . &quot;!&quot;, LL_ERROR );
    return false;
  }

  protected function is_uploadable ( $element, $filename ) { return ( $filename&nbsp;!== false ); }

  protected function get_text ( $element, $filename ) { return NULL; }
  protected function get_target_filename ( $element, $filename ) { return NULL; }
  protected function get_watch ( $element, $filename ) { return $this-&gt;watch; }
  protected function get_ignorewarnings ( $element, $filename ) { return $this-&gt;ignorewarnings; }

  public function process ( $element ) {
    $filename = $this-&gt;element_filename ( $element );
    if ( $this-&gt;is_uploadable ( $element, $filename ) ) {
      if ( file_exists ( $filename ) ) {
        return $this-&gt;upload_file ( $filename,
          $this-&gt;get_text ( $element, $filename ),
          $this-&gt;get_comment ( $element, $filename ),
          $this-&gt;get_target_filename ( $element, $filename ),
          $this-&gt;get_watch ( $element, $filename ),
          $this-&gt;get_ignorewarnings ( $element, $filename ) );
      }
    }
    return false;
  }

}


class ActionObject_Upload_URL extends ActionObject_WithComment {

  public $watch          = false;
  public $ignorewarnings = true;

  protected function element_url ( $element ) {
    if ( is_array ( $element ) ) {
      if (&nbsp;! empty ( $element['URL'] ) ) {
        return $element['URL'];
      }
    } elseif ( is_string ( $element ) ) {
      return $element;
    } 
    $this-&gt;log ( &quot;Unsupported element type supplied by &quot; . get_class ( $this-&gt;iterator ) . &quot; to &quot; . get_class ( $this ) . &quot;!&quot;, LL_ERROR );
    return false;
  }

  protected function is_uploadable ( $element, $URL ) { return ( $URL&nbsp;!== false ); }

  protected function get_text ( $element, $URL ) { return NULL; }
  protected function get_target_filename ( $element, $URL ) { return NULL; }
  protected function get_watch ( $element, $URL ) { return $this-&gt;watch; }
  protected function get_ignorewarnings ( $element, $URL ) { return $this-&gt;ignorewarnings; }

  public function process ( $element ) {
    $URL = $this-&gt;element_filename ( $element );
    if ( $this-&gt;is_uploadable ( $element, $URL ) ) {
      return $this-&gt;upload_url ( $URL, $this-&gt;get_text ( $element, $URL ),
        $this-&gt;get_comment ( $element, $URL ),
        $this-&gt;get_target_filename ( $element, $URL ),
        $this-&gt;get_watch ( $element, $URL ),
        $this-&gt;get_ignorewarnings ( $element, $URL ) );
    }
    return false;
  }

}



# ---------------------------------------------------------------------------- #
# --                                                                        -- #
# --                   Unofficial ActionObject classes                      -- #
# --                                                                        -- #
# -- Classes that make easier specific tasks. Immature and/or too specific. -- #
# -- May be undocumented in the Apibot wiki.                                -- #
# -- May be made official, heavily modified or dropped in the future.       -- #
# -- Use and rely on them at your own risk.                                 -- #
# --                                                                        -- #
# ---------------------------------------------------------------------------- #


# ---------------------------------------------------------------------------- #
# --                 Extended Page ActionObject classes                     -- #
# ---------------------------------------------------------------------------- #


# ----- Selective revisions revert system ----- #

abstract class ActionObject_Page_Revert_Generic extends ActionObject_Page_Generic {

  public $undo_revert = true;  // use the 'undo' method to revert revisions where possible

  public $page_deletion_marker;  // will insert this into page text if can't delete pages

  protected $reverted_revs_count;  // must be set by evaluate_revert_revisions()
  protected $revert_revision;      // revert this revision
  protected $to_revision;          // ... and back to (but not including) this revision (if NULL - delete the page)

  # ----- Protected ----- #

  protected function is_revertable ( $element, $page ) { return ( $page&nbsp;!== false ); }

  protected function revert_page ( $page ) {
    $summary = $this-&gt;summary_reverted ( $page );

    if (&nbsp;! $this-&gt;bot-&gt;can_i_edit() ) {
      $this-&gt;log ( &quot;Would revert page '&quot; . $page-&gt;title . &quot;' (&quot; . $summary .
        &quot;) to revid &quot; . $to_revision-&gt;revid . &quot;, but cannot edit the wiki!&quot; );
      return false;
    }

    $this-&gt;log ( &quot;Reverting page '&quot; . $page-&gt;title . &quot;' to revision &quot; . $this-&gt;to_revision-&gt;revid .
      &quot;, obsoleting up to revision &quot; . $this-&gt;revert_revision-&gt;revid );
    if ( $this-&gt;undo_revert &amp;&amp; ( $this-&gt;bot-&gt;mw_version_number() &gt;= 11303 ) ) {
      return $this-&gt;bot-&gt;undo_page ( $page, $this-&gt;revert_revision-&gt;revid, $this-&gt;to_revision-&gt;revid, $summary );
    } else {
      $page-&gt;text        = $this-&gt;to_revision-&gt;content;
      $page-&gt;rvtimestamp = $this-&gt;to_revision-&gt;timestamp;
      $page-&gt;timestamp   = $this-&gt;revert_revision-&gt;timestamp;

      return $this-&gt;bot-&gt;submit_page ( $page, $summary, false );
    }
  }

  protected function delete_page ( $page ) {
    $summary = $this-&gt;summary_deleted ( $page );
    if ( $this-&gt;bot-&gt;can_i_delete() ) {
      $this-&gt;log ( &quot;Deleting page '&quot; . $page-&gt;title . &quot;' (&quot; . $summary . &quot;)&quot; );
      return $this-&gt;bot-&gt;delete_page ( $page-&gt;title, $summary );
    } elseif ( $this-&gt;bot-&gt;can_i_edit() &amp;&amp;&nbsp;! empty ( $this-&gt;page_deletion_marker ) ) {
      $this-&gt;log ( &quot;Marking page '&quot; . $page-&gt;title . &quot;' for deletion (&quot; . $summary . &quot;)&quot; );
      $page-&gt;text        = $this-&gt;page_deletion_marker . $this-&gt;revert_revision-&gt;content;
      $page-&gt;rvtimestamp = $this-&gt;revert_revision-&gt;timestamp;
      return $this-&gt;bot-&gt;submit_page ( $page, &quot;Marking page for deletion (&quot; . $summary . &quot;)&quot; );
    } else {
      $this-&gt;log ( &quot;Would delete page '&quot; . $page-&gt;title . &quot;' (&quot; . $summary .
        &quot;), but can neither delete nor mark it for deletion!&quot; );
      return false;
    }

  }

  protected function skip_page ( $page, $reason_template = NULL ) {
    if (&nbsp;! is_null ( $reason_template ) ) {
      $this-&gt;log ( str_replace ( '$1', $page-&gt;title, $reason_template ) );
    }
    return false;
  }

  abstract protected function evaluate_revert_revisions ( $element, $page );

  abstract protected function summary_reverted ( $page );
  abstract protected function summary_deleted  ( $page );

  public function process ( $element ) {
    $page = $this-&gt;element_page ( $element );
    if ( $this-&gt;is_revertable ( $element, $page ) ) {

      $this-&gt;evaluate_revert_revisions ( $element, $page );
      if ( is_null ( $this-&gt;to_revision ) ) {
        if ( $this-&gt;reverted_revs_count == 0 ) {
          return $this-&gt;skip_page ( $page, &quot;Processed 0 revisions for page '$1' - was it deleted meanwhile?&quot; );
        } else {
          return $this-&gt;delete_page ( $page );
        }
      } else {
        if ( $this-&gt;reverted_revs_count == 0 ) {
          return $this-&gt;skip_page ( $page, &quot;Page '$1' does not need to be reverted.&quot; );
        } else {
          return $this-&gt;revert_page ( $page );
        }
      }
    } else {
      return $this-&gt;skip_page ( $page, &quot;Page '$1' was skipped - marked as non-revertable&quot; );
    }
  }

}


abstract class ActionObject_Page_Revert extends ActionObject_Page_Revert_Generic {

  public $report_only = false;

  # -----  Protected  ----- #

  protected function evaluate_revert_revisions ( $element, $page ) {
    $internal_iterator     = $this-&gt;create_iterator     ( $element, $page );
    $internal_actionobject = $this-&gt;create_actionobject ( $this-&gt;bot, $element, $page );
    $internal_iterator-&gt;iterate ( $internal_actionobject );
    $this-&gt;revert_revision = $internal_actionobject-&gt;last_revision;
    if ( $internal_iterator-&gt;abort_iteration ) {
      $this-&gt;reverted_revs_count = $internal_iterator-&gt;elements_counter - 1;
      $this-&gt;to_revision         = $internal_actionobject-&gt;to_revision;
    } else {
      $this-&gt;reverted_revs_count = $internal_iterator-&gt;elements_counter;
      $this-&gt;to_revision         = NULL;
    }
  }

  protected function register_action ( $page, $action_taken ) { return true; } // override to eg. make lists of what is done.

  protected function create_iterator ( $element, $page ) {
    $internal_iterator = new Iterator_PageRevisions_WithDiffs ( $this-&gt;bot );
    $internal_iterator-&gt;content = true;
    $internal_iterator-&gt;title   = $page-&gt;title;
    return $internal_iterator;
  }

  abstract protected function create_actionobject ( $bot, $element, $page );
/*   the internal ActionObject must have:
   public $to_revision;   // set here the revision the page must be reverted to, or NULL if it is to be deleted
   public $last_revision; // set here the last page revision
 */

  protected function revert_page ( $page ) {
    $this-&gt;register_action ( $page, &quot;revert&quot; );
    if ( $this-&gt;report_only ) {
      $this-&gt;log ( &quot;Would revert page '&quot; . $page-&gt;title . &quot;' to revid &quot; .
        $this-&gt;to_revision-&gt;revid . &quot; (&quot; . $this-&gt;summary_reverted ( $page ) . &quot;)&quot; );
      return true;
    } else {
      return parent::revert_page ( $page );
    }
  }

  protected function delete_page ( $page ) {
    $summary = $this-&gt;summary_deleted ( $page );
    $this-&gt;register_action ( $page, &quot;delete&quot; );
    if ( $this-&gt;report_only ) {
      if ( $this-&gt;bot-&gt;can_i_delete() ) {
        $this-&gt;log ( &quot;Would delete page '&quot; . $page-&gt;title . &quot;' (&quot; . $summary . &quot;)&quot; );
        return true;
      } elseif ( $this-&gt;bot-&gt;can_i_edit() &amp;&amp;&nbsp;! empty ( $this-&gt;page_deletion_marker ) ) {
        $this-&gt;log ( &quot;Would mark page '&quot; . $page-&gt;title . &quot;' for deletion (&quot; . $summary . &quot;)&quot; );
        return true;
      } else {
        $this-&gt;log ( &quot;Page '&quot; . $page-&gt;title . &quot;' should be deleted (&quot; . $summary .
          &quot;), but can neither delete nor mark it for deletion!&quot; );
        return false;
      }
    } else {
      return parent::delete_page ( $page );
    }
  }

  protected function skip_page ( $page, $reason_template = NULL ) {
    $this-&gt;register_action ( $page, &quot;skip&quot; );
    return parent::skip_page ( $page, $reason_template );
  }

}


abstract class ActionObject_Page_RevertWithStats_Generic extends ActionObject_Page_Revert {

  public $stats = array (
    'processed_pages'    =&gt; 0,
    'reverted_pages'     =&gt; 0,
    'deleted_pages'      =&gt; 0,
    'skipped_pages'      =&gt; 0,
    'rejected_revisions' =&gt; 0,
    'accepted_revisions' =&gt; 0,
  );

  protected function revert_page ( $page ) {
    $this-&gt;stats['processed_pages'   ] = $this-&gt;stats['processed_pages'   ] + 1;
    $this-&gt;stats['reverted_pages'    ] = $this-&gt;stats['reverted_pages'    ] + 1;
    $this-&gt;stats['accepted_revisions'] = $this-&gt;stats['accepted_revisions'] + 1;
    $this-&gt;stats['rejected_revisions'] = $this-&gt;stats['rejected_revisions'] + $this-&gt;reverted_revs_count;
    return parent::revert_page ( $page );
  }

  protected function delete_page ( $page ) {
    $this-&gt;stats['processed_pages'   ] = $this-&gt;stats['processed_pages'   ] + 1;
    $this-&gt;stats['deleted_pages'     ] = $this-&gt;stats['deleted_pages'     ] + 1;
    $this-&gt;stats['rejected_revisions'] = $this-&gt;stats['rejected_revisions'] + $this-&gt;reverted_revs_count;
    return parent::delete_page ( $page );
  }

  protected function skip_page ( $page, $reason_template = NULL ) {
    $this-&gt;stats['processed_pages'] = $this-&gt;stats['processed_pages'] + 1;
    $this-&gt;stats['skipped_pages'  ] = $this-&gt;stats['skipped_pages'  ] + 1;
    return parent::skip_page ( $page, $reason_template );
  }

}


# This is an actionobject used internally by ActionObject_Page_RevertRevisions.
# Do not use it with your iterators, unless you really know what you are doing.
class InternalActionObject_Page_IsRevisionToBeReverted extends ActionObject {

  public $user_regex;
  public $not_user_regex;

  public $comment_regex;
  public $not_comment_regex;

  public $content_regex;
  public $not_content_regex;

  public $revid_min;
  public $revid_max;

  public $timestamp_min;
  public $timestamp_max;

  public $bytes_min;
  public $bytes_max;

  public $chars_min;
  public $chars_max;

  public $is_minor;  // true, false, NULL

  public $last_revision;
  public $to_revision;

  # ----- Protected ----- #

  protected function match_regex ( $regex, $element ) {
    if ( is_null ( $regex ) ) { return false; }
    if ( is_array ( $regex ) ) {
      foreach ( $regex as $regex_element ) {
        if ( $this-&gt;match_regex ( $regex_element, $element ) ) { return true; }
      }
    }
    return preg_match ( $regex, $element );
  }

  protected function match_posneg_regex ( $pos_regex, $neg_regex, $element ) {
    return ( $this-&gt;match_regex ( $pos_regex, $element ) &amp;&amp;
     &nbsp;! $this-&gt;match_regex ( $neg_regex, $element ) );
  }

  protected function match_diap ( $min, $max, $element ) {
    if ( ( $min === NULL ) &amp;&amp; ( $max === NULL ) ) { return false; }
    if ( ( $min === NULL ) &amp;&amp; ( $max&nbsp;!== NULL ) ) { $min = 0; }
    if ( ( $min&nbsp;!== NULL ) &amp;&amp; ( $max === NULL ) ) { $max = PHP_INT_MAX; }
    if ( $min &lt; $max ) {
      return ( ( $min &lt;= $element ) &amp;&amp; ( $element &lt;= $max ) );
    } else {
      return ( ( $max &lt;= $element ) &amp;&amp; ( $element &lt;= $min ) );
    }
  }

  protected function match_bool ( $test, $element ) {
    return ( ( $test&nbsp;!== NULL ) &amp;&amp; ( $test === $element ) );
  }

  protected function is_to_be_reverted ( $revision ) {
    return (
      $this-&gt;match_posneg_regex ( $this-&gt;user_regex   , $this-&gt;not_user_regex   , $revision-&gt;user ) ||
      $this-&gt;match_posneg_regex ( $this-&gt;comment_regex, $this-&gt;not_comment_regex, $revision-&gt;comment ) ||
      $this-&gt;match_posneg_regex ( $this-&gt;content_regex, $this-&gt;not_content_regex, $revision-&gt;content ) ||
      $this-&gt;match_diap ( $this-&gt;revid_min    , $this-&gt;revid_max    , $revision-&gt;revid     ) ||
      $this-&gt;match_diap ( $this-&gt;timestamp_min, $this-&gt;timestamp_max, $revision-&gt;timestamp ) ||
      $this-&gt;match_diap ( $this-&gt;bytes_min    , $this-&gt;bytes_max    , $revision-&gt;size      ) ||
      $this-&gt;match_diap ( $this-&gt;chars_min    , $this-&gt;chars_max    , mb_strlen ( $revision-&gt;content ) ) ||
      $this-&gt;match_bool ( $this-&gt;is_minor, $revision-&gt;is_minor )
    );
  }

  public function process ( $revision ) {
    if ( is_null ( $this-&gt;last_revision ) ) { $this-&gt;last_revision = $revision; }

    if (&nbsp;! $this-&gt;is_to_be_reverted ( $revision ) ) {
      $this-&gt;to_revision = $revision;
      $this-&gt;iterator-&gt;abort_iteration = true;
    }

    return true;
  }

}


class ActionObject_Page_RevertRevisions extends ActionObject_Page_Revert {

  public $user_regex;     // should match the user(s) whose revisions must be reverted
  public $not_user_regex; // should match the user(s) whose revisions must NOT be reverted

  public $comment_regex;
  public $not_comment_regex;

  public $content_regex;
  public $not_content_regex;

  public $revid_min;
  public $revid_max;

  public $timestamp_min;
  public $timestamp_max;

  public $bytes_min;
  public $bytes_max;

  public $chars_min;
  public $chars_max;

  public $is_minor;  // true, false, NULL (no check)

  protected function summary_reverted ( $page ) {
    return &quot;Reverted revisions after &quot; . $this-&gt;to_revision-&gt;revid .
      &quot;, up to &quot; . $this-&gt;revert_revision-&gt;revid;
  }

  protected function summary_deleted  ( $page ) {
    &quot;Reverted all revisions - nothing left; deleting page&quot;;
  }

  protected function create_actionobject ( $bot, $element, $page ) {
    $AO = new InternalActionObject_Page_IsRevisionToBeReverted ( $bot );

    $AO-&gt;user_regex        = $this-&gt;user_regex;
    $AO-&gt;not_user_regex    = $this-&gt;not_user_regex;
    $AO-&gt;comment_regex     = $this-&gt;comment_regex;
    $AO-&gt;not_comment_regex = $this-&gt;not_comment_regex;
    $AO-&gt;content_regex     = $this-&gt;content_regex;
    $AO-&gt;not_content_regex = $this-&gt;not_content_regex;
    $AO-&gt;revid_min         = $this-&gt;revid_min;
    $AO-&gt;revid_max         = $this-&gt;revid_max;
    $AO-&gt;timestamp_min     = $this-&gt;timestamp_min;
    $AO-&gt;timestamp_max     = $this-&gt;timestamp_max;
    $AO-&gt;bytes_min         = $this-&gt;bytes_min;
    $AO-&gt;bytes_max         = $this-&gt;bytes_max;
    $AO-&gt;chars_min         = $this-&gt;chars_min;
    $AO-&gt;chars_max         = $this-&gt;chars_max;
    $AO-&gt;is_minor          = $this-&gt;is_minor;

    return $AO;
  }

}


# ----- Category-related page editing ----- #


class ActionObject_Page_ReplaceCategory extends ActionObject_Page_Edit_Generic {

  public $old_category;
  public $new_category;
  public $new_sortkey;

  protected function old_category_name ( $element ) { return $this-&gt;old_category; }
  protected function new_category_name ( $element ) { return $this-&gt;new_category; }
  protected function new_sortkey ( $element ) { return $this-&gt;new_sortkey; }

  protected function modify_page ( &amp;$page, $element ) {
    return $page-&gt;replace_category ( $this-&gt;old_category_name ( $element ),
      $this-&gt;new_category_name ( $element ), $this-&gt;new_sortkey ( $element ) );
  }

}


class ActionObject_RecategorizeCategoryMembers extends ActionObject_Page_Generic {

  public $new_category_name;

  public $namespace;  // only recategorize members in this namespace
  public $startsortkey;  // only recategorize members between these sortkeys (only sortkey or timestamp-based selection is allowed, but not both!)
  public $endsortkey;
  public $starttimestamp;  // only recategorize members between these timestamps;
  public $endtimestamp;

  protected function new_category_name ( $element, $old_category ) { return $this-&gt;new_category_name; }  // override on need
  protected function new_sortkey ( $element, $old_category ) { return $this-&gt;new_sortkey; }

  public function process ( $element ) {
    $old_category = $this-&gt;element_pagetitle ( $element );
    if ( $this-&gt;bot-&gt;title_namespace_id ( $old_category )&nbsp;!== NAMESPACE_ID_CATEGORY ) {
      $this-&gt;bot-&gt;log ( &quot;[[&quot; . $old_category . &quot;]] appears to not be a category!&quot;, LL_ERROR );
      return false;
    }

    $Iter = new Iterator_CategoryMembers ( $this-&gt;bot );
    $Iter-&gt;title       = $old_category;
    $Iter-&gt;namespace   = $this-&gt;namespace;
    if (&nbsp;! ( empty ( $this-&gt;startsortkey ) &amp;&amp; empty ( $this-&gt;endsortkey ) ) ) {
      $Iter-&gt;sort = &quot;sortkey&quot;;
      $Iter-&gt;startsortkey = $this-&gt;startsortkey;
      $Iter-&gt;endsortkey   = $this-&gt;endsortkey;
    } elseif (&nbsp;! ( empty ( $this-&gt;starttimestamp ) &amp;&amp; empty ( $this-&gt;endtimestamp ) ) ) {
      $Iter-&gt;sort = &quot;timestamp&quot;;
      $Iter-&gt;starttimestamp = $this-&gt;starttimestamp;
      $Iter-&gt;endtimestamp   = $this-&gt;endtimestamp;
    }

    $AO = new ActionObject_Page_ReplaceCategory ( $this-&gt;bot );
    $AO-&gt;comment = $this-&gt;comment;
    $AO-&gt;old_category_name = $this-&gt;bot-&gt;title_pagename ( $old_category );
    $AO-&gt;new_category_name = $this-&gt;new_category_name ( $element, $old_category );

    $Iter-&gt;iterate ( $AO );

    return true;
  }

}


class ActionObject_Category_Rename extends ActionObject_Page_Move {

  public $recategorize_comment;  // will be passed to the recategorizing AO

  public function process ( $element ) {
    $title = $this-&gt;element_pagetitle ( $element );
    if ( $this-&gt;bot-&gt;title_namespace_id ( $title )&nbsp;!== NAMESPACE_ID_CATEGORY ) {
      $this-&gt;bot-&gt;log ( &quot;[[&quot; . $title . &quot;]] appears to not be a category!&quot;, LL_ERROR );
      return false;
    }

    if ( parent::process ( $element ) ) {
      $AO = new ActionObject_RecategorizeCategoryMembers ( $this-&gt;bot );
      $AO-&gt;comment           = $this-&gt;recategorize_comment;
      $AO-&gt;new_category_name = $this-&gt;bot-&gt;title_pagename ( $this-&gt;element_newtitle ( $element, $title ) );

      $AO-&gt;process ( $element );

      return true;
    } else {
      return false;
    }
  }

}


class ActionObject_Category_JoinTo extends ActionObject_Page_Delete {  // deletes the source category and transfers all members to the target category 

  public $recategorize_comment;  // will be passed to the recategorizing AO

  public function process ( $element ) {
    $title = $this-&gt;element_pagetitle ( $element );
    if ( $this-&gt;bot-&gt;title_namespace_id ( $title )&nbsp;!== NAMESPACE_ID_CATEGORY ) {
      $this-&gt;bot-&gt;log ( &quot;[[&quot; . $title . &quot;]] appears to not be a category!&quot;, LL_ERROR );
      return false;
    }

    if ( parent::process ( $element ) ) {
      $AO = new ActionObject_RecategorizeCategoryMembers ( $this-&gt;bot );
      $AO-&gt;comment           = $this-&gt;recategorize_comment;
      $AO-&gt;new_category_name = $this-&gt;bot-&gt;title_pagename ( $this-&gt;element_newtitle ( $element, $title ) );

      $AO-&gt;process ( $element );

      return true;
    } else {
      return false;
    }
  }

}


# ----- Wikilink-related page editing ----- #


class ActionObject_Page_RelinkWikilinks extends ActionObject_Page_Edit {

  public $relink_from_title;
  public $relink_to_title;
  public $preserve_anchors = true;

  protected function relink_from_title ( $element ) { return $this-&gt;relink_from_title; }
  protected function relink_to_title   ( $element ) { return $this-&gt;relink_to_title; }

  public function process ( $element ) {
    $relink_from_title = $this-&gt;relink_from_title();
    $relink_to_title   = $this-&gt;relink_to_title();
    $this-&gt;replaces = array (
      array (
        'type'  =&gt; &quot;text&quot;,
        'name'  =&gt; &quot;Relinking title [[&quot; . $relink_from_title . &quot;]] to [[&quot; . $relink_to_title . &quot;]]...&quot;,
        'regex' =&gt; $this-&gt;bot-&gt;regexmatch_wikilink ( false, &quot;&quot;, &quot;&quot;, $relink_from_title, NULL, NULL ),
        'with'  =&gt; '[[$1$3$5' . $relink_to_title . ( $this-&gt;preserve_anchors&nbsp;? '$7'&nbsp;: &quot;&quot; ) . '$9]]',
      ),
    );
    return parent::process ( $element );
  }
}


class ActionObject_RelinkAllWikilinksToPage extends ActionObject_Page_Generic {

  public $new_title;
  public $preserve_anchors = true;

  public $namespace;    // work in this namespace only (NULL - all, &quot;&quot; - main, etc)
  public $filterredir;  // &quot;all&quot; (default), &quot;redirects&quot; (only in redirects), &quot;non-redirects&quot; (only in non-redirects)

  protected function new_title ( $element, $title ) { return $this-&gt;new_title; }  // override on need

  public function process ( $element ) {
    $title = $this-&gt;element_pagetitle ( $element );
    $new_title = $this-&gt;new_title ( $element, $title );

    $Iter = new Iterator_BackLinks ( $this-&gt;bot );
    $Iter-&gt;title       = $title;
    $Iter-&gt;namespace   = $this-&gt;namespace;
    $Iter-&gt;filterredir = $this-&gt;filterredir;

    $AO = new ActionObject_Page_RelinkWikilinks ( $this-&gt;bot );
    $AO-&gt;relink_title     = $title;
    $AO-&gt;relink_to_title  = $new_title;
    $AO-&gt;preserve_anchors = $this-&gt;preserve_anchors;

    $Iter-&gt;iterate ( $AO );

    return parent::process ( $element );
  }

}


class ActionObject_Page_WikilinkText extends ActionObject_Page_Edit {

  public $link_target;
  public $link_section;
  public $link_text;
  public $links_count;

  protected function link_target  ( $element, $title ) { return $this-&gt;link_target; }
  protected function link_section ( $element, $title ) { return $this-&gt;link_section; }
  protected function link_text    ( $element, $title ) { return $this-&gt;link_text; }
  protected function links_count  ( $element, $title ) { return $this-&gt;links_count; }

  public function process ( $element ) {
    if ( $this-&gt;wikilinkable ( $element ) ) {
      $title = $this-&gt;element_pagetitle ( $element );
      $link_text    = $this-&gt;link_text    ( $element, $title );
      $link_section = $this-&gt;link_section ( $element, $title );
      $link_target  = $this-&gt;link_target  ( $element, $title );
      $links_count  = $this-&gt;links_count  ( $element, $title );

      if ( empty ( $link_text ) ) {
        $replace_name = &quot;Wikilinking \&quot;&quot; . $link_text . &quot;\&quot;...&quot;;
        $link_text = $link_target;
      } else {
        $replace_name = &quot;Wikilinking \&quot;&quot; . $link_text . &quot;\&quot; to [[&quot; . $link_target . &quot;]]...&quot;;
      }

      if (&nbsp;! empty ( $link_section ) ) $link_target .= &quot;#&quot; . $link_section;

      $this-&gt;replaces = array (
        array (
          'type'  =&gt; &quot;text&quot;,
          'name'  =&gt; $replace_name,
          'regex' =&gt; '/' . preg_quote ( $link_text ) . '/u',
          'with'  =&gt; wikilink ( $link_target, $link_text ),
          'count' =&gt; $links_count,
        ),
      );
      return parent::process ( $element );
    }
  }

}


# ----- Moving / deleting pages and fixing wikilinks that point to them ----- #


class ActionObject_Page_MoveAndRelink extends ActionObject_Page_Move {
# Moves the page and modifies wikilinks to it to point the new title.

  public $relink_comment;  // will be passed to the relink wikilinks AO

  public $noredirect = true;  // &quot;overriding&quot; the default false

  public $namespace;    // work in this namespace only (NULL - all, &quot;&quot; - main, etc)
  public $filterredir;  // &quot;all&quot; (default), &quot;redirects&quot; (only in redirects), &quot;non-redirects&quot; (only in non-redirects)

  public function process ( $element ) {
    if ( parent::process ( $element ) ) {
      $AO = new ActionObject_RelinkAllWikilinksToPage ( $this-&gt;bot );
      $AO-&gt;comment     = $this-&gt;relink_comment;
      $AO-&gt;new_title   = $this-&gt;element_newtitle ( $element, $title );
      $AO-&gt;namespace   = $this-&gt;namespace;
      $AO-&gt;filterredir = $this-&gt;filterredir;

      $AO-&gt;process ( $element );

      return true;
    } else {
      return false;
    }
  }

}


class ActionObject_Page_DeleteAndUnlink extends ActionObject_Page_Delete {
# Both deletes the page and unlinks all wikilinks that point to it.

  public $unlink_comment;  // will be passed to the relink wikilinks AO

  public $namespace;    // work in this namespace only (NULL - all, &quot;&quot; - main, etc)
  public $filterredir;  // &quot;all&quot; (default), &quot;redirects&quot; (only unlink in redirects), &quot;non-redirects&quot; (only in non-redirects)

  public function process ( $element ) {
    if ( parent::process ( $element ) ) {
      $title = $this-&gt;element_pagetitle ( $element );

      $Iter = new Iterator_BackLinks ( $this-&gt;bot );
      $Iter-&gt;title       = $title;
      $Iter-&gt;namespace   = $this-&gt;namespace;
      $Iter-&gt;filterredir = $this-&gt;filterredir;
      $Iter-&gt;redirect    = false;

      $AO = new ActionObject_Page_Edit ( $this-&gt;bot );
      $AO-&gt;comment = $this-&gt;unlink_comment;
      $AO-&gt;replaces = array (
        array (
          'type'  =&gt; &quot;text&quot;,
          'name'  =&gt; &quot;Unlinking title [[&quot; . $title . &quot;]]...&quot;,
          'regex' =&gt; regex_match_wikilink ( $title, NULL, NULL ),
          'with'  =&gt; '$6',
        ),
      );

      $Iter-&gt;iterate ( $AO );
      return true;
    } else {
      return false;
    }
  }

}


class ActionObject_Redirect_DeleteAndRelink extends ActionObject_Page_Delete {

  public $relink_comment;  // will be passed to the relink wikilinks AO

  public function process ( $element ) {
    $page = $this-&gt;element_page ( $element );
    if ( parent::process ( $element ) ) {
      $redirects_to_title = $page-&gt;redirects_to();

      $AO = new ActionObject_RelinkAllWikilinksToPage ( $this-&gt;bot );
      $AO-&gt;comment = $this-&gt;relink_comment;
      $AO-&gt;new_title = $redirects_to_title;
      $AO-&gt;preserve_anchors = false;
      $AO-&gt;process ( $element );

      return true;
    } else {
      return false;
    }
  }

}


# ----- Other ----- #


class ActionObject_User_RollbackEdits extends ActionObject_User_Generic {

  public $namespace;
  public $start;
  public $end;
  public $minor;
  public $protected;

  public function process ( $element ) {
    $user = $this-&gt;element_username ( $element );

    $Iter = new Iterator_UserContribs ( $this-&gt;bot );
    $Iter-&gt;user      = $user;
    $Iter-&gt;namespace = $this-&gt;namespace;
    $Iter-&gt;start     = $this-&gt;start;
    $Iter-&gt;end       = $this-&gt;end;
    $Iter-&gt;minor     = $this-&gt;minor;
    $Iter-&gt;protected = $this-&gt;protected;

    $AO = new ActionObject_Page_Rollback ( $this-&gt;bot );
    $AO-&gt;comment = $this-&gt;comment;
    $AO-&gt;user    = $user;

    $Iter-&gt;iterate ( $AO );

    return true;
  }

}


# ---------------------------------------------------------------------------- #
# --               Abstract Database ActionObject classes                   -- #
# ---------------------------------------------------------------------------- #


abstract class ActionObject_WithDatabase extends ActionObject {

  public $db_details;  // array: host, port, user, pass, name, charset - must be set before using with an iterator!
  public $db;          // may be set externally, eg. by an Iterator_Database_*

  abstract protected function db_connect ( $db_details );
  abstract protected function db_disconnect ( $db );
  abstract protected function db_query ( $SQL );

  public function preprocess () {
    if ( empty ( $this-&gt;db ) &amp;&amp;&nbsp;! empty ( $this-&gt;db_details ) ) {
      $this-&gt;db = $this-&gt;db_connect ( $this-&gt;db_details );
    }
    return parent::preprocess();
  }

  public function postprocess () {
    if (&nbsp;! empty ( $this-&gt;db ) &amp;&amp;&nbsp;! empty ( $this-&gt;db_details ) ) {
      $this-&gt;db = $this-&gt;db_disconnect ( $this-&gt;db );
    }
    return parent::postprocess();
  }

}


abstract class ActionObject_WithDatabase_Mysql extends ActionObject_WithDatabase {

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
    // do nothing - using mysql_pconnect(), disconnect is not needed
  }

  protected function db_query ( $SQL ) {
    mysql_select_db ( $this-&gt;db_details['name'], $this-&gt;db );
    $result = mysql_query ( $SQL, $this-&gt;db );
    if (&nbsp;! $result ) {
      throw new Exception ( &quot;SQL query failed (&quot; . mysql_error() . &quot;): &quot; . $SQL );
    }
    return $result;
  }

  // public function process ( $element ) is still abstract

}

</pre>

<!-- 
NewPP limit report
Preprocessor node count: 4/1000000
Post-expand include size: 0/2097152 bytes
Template argument size: 0/2097152 bytes
Expensive parser function count: 0/100
-->

<!-- Saved in parser cache with key wikidb_apibot:pcache:idhash:48-0!1!0!!en!2!edit=0 and timestamp 20120916045557 -->
<div class="printfooter">
Retrieved from "<a href="http://apibot.zavinagi.org/index.php/Development_code/Apibot_actionobjects.php">http://apibot.zavinagi.org/index.php/Development_code/Apibot_actionobjects.php</a>"</div>
		<div id='catlinks' class='catlinks catlinks-allhidden'></div>		<!-- end content -->
				<div class="visualClear"></div>
	</div>
</div></div>
<div id="column-one">
	<div id="p-cactions" class="portlet">
		<h5>Views</h5>
		<div class="pBody">
			<ul>
				 <li id="ca-nstab-main" class="selected"><a href="/index.php/Development_code/Apibot_actionobjects.php" title="View the content page [c]" accesskey="c">Page</a></li>
				 <li id="ca-talk" class="new"><a href="/index.php?title=Talk:Development_code/Apibot_actionobjects.php&amp;action=edit&amp;redlink=1" title="Discussion about the content page [t]" accesskey="t">Discussion</a></li>
				 <li id="ca-viewsource"><a href="/index.php?title=Development_code/Apibot_actionobjects.php&amp;action=edit" title="This page is protected.&#10;You can view its source [e]" accesskey="e">View source</a></li>
				 <li id="ca-history"><a href="/index.php?title=Development_code/Apibot_actionobjects.php&amp;action=history" title="Past revisions of this page [h]" accesskey="h">History</a></li>
			</ul>
		</div>
	</div>
	<div class="portlet" id="p-personal">
		<h5>Personal tools</h5>
		<div class="pBody">
			<ul>
				<li id="pt-login"><a href="/index.php?title=Special:UserLogin&amp;returnto=Development_code/Apibot_actionobjects.php" title="You are encouraged to log in; however, it is not mandatory [o]" accesskey="o">Log in</a></li>
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
				<li id="t-whatlinkshere"><a href="/index.php/Special:WhatLinksHere/Development_code/Apibot_actionobjects.php" title="List of all wiki pages that link here [j]" accesskey="j">What links here</a></li>
				<li id="t-recentchangeslinked"><a href="/index.php/Special:RecentChangesLinked/Development_code/Apibot_actionobjects.php" title="Recent changes in pages linked from this page [k]" accesskey="k">Related changes</a></li>
<li id="t-specialpages"><a href="/index.php/Special:SpecialPages" title="List of all special pages [q]" accesskey="q">Special pages</a></li>
				<li id="t-print"><a href="/index.php?title=Development_code/Apibot_actionobjects.php&amp;printable=yes" rel="alternate" title="Printable version of this page [p]" accesskey="p">Printable version</a></li>				<li id="t-permalink"><a href="/index.php?title=Development_code/Apibot_actionobjects.php&amp;oldid=280" title="Permanent link to this revision of the page">Permanent link</a></li>			</ul>
		</div>
	</div>
</div><!-- end of the left (by default at least) column -->
<div class="visualClear"></div>
<div id="footer">
	<div id="f-poweredbyico"><a href="http://www.mediawiki.org/"><img src="/skins/common/images/poweredby_mediawiki_88x31.png" height="31" width="88" alt="Powered by MediaWiki" /></a></div>
	<ul id="f-list">
		<li id="lastmod"> This page was last modified on 28 August 2011, at 18:46.</li>
		<li id="viewcount">This page has been accessed 1,046 times.</li>
		<li id="privacy"><a href="/index.php/Apibot:Privacy_policy" title="Apibot:Privacy policy">Privacy policy</a></li>
		<li id="about"><a href="/index.php/Apibot:About" title="Apibot:About">About Apibot</a></li>
		<li id="disclaimer"><a href="/index.php/Apibot:General_disclaimer" title="Apibot:General disclaimer">Disclaimers</a></li>
	</ul>
</div>
</div>

<script>if (window.runOnloadHook) runOnloadHook();</script>
<!-- Served in 0.129 secs. --></body></html>
