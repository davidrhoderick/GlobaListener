<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" dir="ltr">
<head>
<title>Development code/Apibot dataobjects.php - Apibot</title>
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
wgPageName="Development_code/Apibot_dataobjects.php",
wgTitle="Development code/Apibot dataobjects.php",
wgAction="view",
wgArticleId=43,
wgIsArticle=true,
wgUserName=null,
wgUserGroups=null,
wgUserLanguage="en",
wgContentLanguage="en",
wgBreakFrames=false,
wgCurRevisionId=282,
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
<body class="mediawiki ltr ns-0 ns-subject page-Development_code_Apibot_dataobjects_php skin-monobook">
<div id="globalWrapper">
<div id="column-content"><div id="content" >
	<a id="top"></a>
	
	<h1 id="firstHeading" class="firstHeading">Development code/Apibot dataobjects.php</h1>
	<div id="bodyContent">
		<h3 id="siteSub">From Apibot</h3>
		<div id="contentSub"></div>
		<div id="jump-to-nav">Jump to: <a href="#column-one">navigation</a>, <a href="#searchInput">search</a></div>
		<!-- start content -->
<p>This is the development code for the Apibot data objects.
</p>
<pre>
&lt;?php
#
#  Apibot - a MediaWiki bot.
#  Data objects module.
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
#  You should have received a copy of the GNU Affero General Public License
#  along with this program; if not, write to the Free Software Foundation, Inc.,
#  59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
#  http://www.gnu.org/copyleft/gpl.html
#
#  Author: Grigor Gatchev &lt;grigor at gatchev dot info&gt;
# ---------------------------------------------------------------------------- #


# ---------------------------------------------------------------------------- #
# --                           Utility functions                            -- #
# ---------------------------------------------------------------------------- #


function assign_if_nonnull ( &amp;$target, $source, $value = NULL ) {
  if ( $value === NULL ) {
    $value = $source;
  }
  if (&nbsp;! ( $source === NULL ) ) {
    $target = $value;
  }
}

function assign_ts_nonnull ( &amp;$target, $source, $value = NULL ) {
  if ( is_null ( $value ) &amp;&amp;&nbsp;! is_null ( $source ) ) {
    $value = substr ( $source, 0, 10 ) . &quot; &quot; . substr ( $source, 11, 8 );
  }
  if (&nbsp;! is_null ( $source ) ) {
    $target = $value;
  }
}

function assign_if_nonnull_and_noorigin ( &amp;$target, $source, $value = NULL ) {
  if ( empty ( $target ) ) {
    assign_if_nonnull ( $target, $source, $value );
  }
}

function assign_ts_nonnull_and_noorigin ( &amp;$target, $source, $value = NULL ) {
  if ( empty ( $target ) ) {
    assign_ts_nonnull ( $target, $source, $value );
  }
}

function add2array_if_nonnull ( &amp;$array, $key, $value ) {
  if (&nbsp;! is_null ( $value ) ) {
    $array[$key] = $value;
  }
}

function set_if_arraykey_exists ( &amp;$to_var, $from_array, $valuename, $targetvalue = NULL ) {
  if ( array_key_exists ( $valuename, $from_array ) ) {
    if ( $targetvalue == NULL ) { $targetvalue = $from_array[$valuename]; };
    $to_var = $targetvalue;
  }
}

function merge_array_if_exists ( &amp;$target, $source ) {
  if (&nbsp;! is_array ( $target ) ) {
    $target = array();
  }
  if ( is_array ( $source ) ) {
    $target = array_merge ( $target, $source );
  }
}

function merge_data_if_requested ( &amp;$dest, $query, $keyword, $continues_element ) {
  if ( is_array ( $continues_element ) &amp;&amp; array_key_exists ( $keyword, $continues_element ) ) {
    merge_array_if_exists ( $dest, $query[$keyword] );
  }
}




# ----- New utils: ----- #

function array_sub ( $element, $key, $default = NULL ) {
  return ( is_array ( $element ) &amp;&amp; array_key_exists ( $key, $element )&nbsp;?
    $element[$key]&nbsp;:
    $default );
}

function array_subsub ( $element, $key1, $key2, $default = NULL ) {
  return ( ( is_array ( $element ) &amp;&amp; array_key_exists ( $key1, $element ) ) &amp;&amp;
           ( is_array ( $element[$key1] ) &amp;&amp; array_key_exists ( $key2, $element[$key1] ) )&nbsp;?
    $element[$key1][$key2]&nbsp;:
    $default );
}

function array_ts ( $element, $key, $default = NULL ) {
  return ( is_array ( $element ) &amp;&amp; array_key_exists ( $key, $element )&nbsp;?
    substr ( $element[$key], 0, 10 ) . &quot; &quot; . substr ( $element[$key], 11, 8 )&nbsp;:
    $default );
}


# ---------------------------------------------------------------------------- #
# --                             Abstract classes                           -- #
# ---------------------------------------------------------------------------- #


abstract class Generic_Data_Item {
  public $bot;

  public function read_from_element ( $data_element, $bot ) {
    $this-&gt;bot = $bot;
  }

}


abstract class Namespaced_Data_Item extends Generic_Data_Item {
  public $ns;
  public $namespace;

  private function get_namespace () {
    if (&nbsp;! is_null ( $this-&gt;bot ) ) {
      $this-&gt;namespace = $this-&gt;bot-&gt;wiki_namespace_name ( $this-&gt;ns );
    }
  }

  public function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;ns = array_sub ( $data_element, 'ns' );
    $this-&gt;get_namespace();
  }

}


abstract class Generic_Page_Item extends Namespaced_Data_Item {
  public $title;
  public $pageid;

  public function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;title  = array_sub ( $data_element, 'title'  );
    $this-&gt;pageid = array_sub ( $data_element, 'pageid' );
  }

}


abstract class Generic_Image extends Generic_Data_Item {
  public $name;
  public $mime;
  public $url;
  public $timestamp;
  public $user;
  public $comment;
  public $width;
  public $height;
  public $size;
  public $sha1;
  public $metadata;
  public $descriptionurl;

  public function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;name      = array_sub ( $data_element, 'name' );
    $this-&gt;mime      = array_sub ( $data_element, 'mime' );
    $this-&gt;url       = array_sub ( $data_element, 'url' );
    $this-&gt;timestamp = array_ts  ( $data_element, 'timestamp' );
    $this-&gt;user      = array_sub ( $data_element, 'user' );
    $this-&gt;comment   = array_sub ( $data_element, 'comment' );
    $this-&gt;width     = array_sub ( $data_element, 'width' );
    $this-&gt;height    = array_sub ( $data_element, 'height' );
    $this-&gt;size      = array_sub ( $data_element, 'size' );
    $this-&gt;sha1      = array_sub ( $data_element, 'sha1' );
    $this-&gt;metadata  = array_sub ( $data_element, 'metadata' );
    $this-&gt;descriptionurl = array_sub ( $data_element, 'descriptionurl' );
  }

}


# ---------------------------------------------------------------------------- #
#                      Page properties iterators data                       -- #
# ---------------------------------------------------------------------------- #


class Page_Revision extends Generic_Data_Item {
  public $pageid;  // supplied by querying revids, and useful in many cases
  public $revid;
  public $is_minor;
  public $timestamp;
  public $user;
  public $comment;
  public $size;
  public $content;
  public $section;
  public $parsetree;
  public $tags;

  function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;pageid    = array_sub ( $data_element, 'pageid' );
    $this-&gt;revid     = array_sub ( $data_element, 'revid' );
    $this-&gt;is_minor  = array_key_exists ( 'minor', $data_element );
    $this-&gt;timestamp = array_ts  ( $data_element, 'timestamp' );
    $this-&gt;user      = array_sub ( $data_element, 'user' );
    $this-&gt;comment   = array_sub ( $data_element, 'comment' );
    $this-&gt;size      = array_sub ( $data_element, 'size' );
    $this-&gt;content   = array_sub ( $data_element, '*' );
    $this-&gt;section   = array_sub ( $data_element, 'section' );
    $this-&gt;parsetree = array_sub ( $data_element, 'parsetree' );
    $this-&gt;tags      = array_sub ( $data_element, 'tags' );
  }

}


class Page_Category extends Generic_Page_Item {
  public $sortkey;
  public $timestamp;

  public function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;sortkey   = array_ts  ( $data_element, 'sortkey' );
    $this-&gt;timestamp = array_sub ( $data_element, 'timestamp' );
  }

}


class Page_ImageInfo extends Generic_Image {

  public $archivename;
  public $imagerepository;

  public function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;archivename     = array_sub ( $data_element, 'archivename' );
    $this-&gt;imagerepository = array_sub ( $data_element, 'imagerepository' );
  }

}


class Page_LangLink extends Generic_Data_Item {

  public $lang;
  public $title;

  public function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;lang  = array_sub ( $data_element, 'lang' );
    $this-&gt;title = array_sub ( $data_element, '*' );
  }

}


class Page_Link extends Generic_Page_Item {

}


class Page_Template extends Generic_Page_Item {

}


class Page_Image extends Generic_Page_Item {

}


class Page_Extlink extends Generic_Data_Item {

  public $url;

  public function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;url = array_sub ( $data_element, '*' );
  }

}


class Page_DuplicateFile extends Generic_Data_Item {
  public $name;
  public $user;
  public $timestamp;

  public function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;name      = array_sub ( $data_element, 'name' );
    $this-&gt;user      = array_sub ( $data_element, 'user' );
    $this-&gt;timestamp = array_ts  ( $data_element, 'timestamp' );
  }

}


class Page_GlobalUsage extends Generic_Data_Item {
  public $title;
  public $url;
  public $wiki;

  public function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;title = array_sub ( $data_element, 'title' );
    $this-&gt;url   = array_sub ( $data_element, 'url'   );
    $this-&gt;wiki  = array_sub ( $data_element, 'wiki'  );
  }

}


# ---------------------------------------------------------------------------- #
# --                 Basic functions / List iterators data                  -- #
# ---------------------------------------------------------------------------- #


class Image extends Generic_Image {

}


class UserContrib extends Generic_Page_Item {
  public $user;
  public $revid;
  public $timestamp;
  public $comment;

  public $is_anon;
  public $id_new;
  public $is_bot;
  public $is_minor;
  public $is_top;

  public function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;user      = array_sub ( $data_element, 'user'      );
    $this-&gt;revid     = array_sub ( $data_element, 'revid'     );
    $this-&gt;timestamp = array_ts  ( $data_element, 'timestamp' );
    $this-&gt;comment   = array_sub ( $data_element, 'comment'   );

    $this-&gt;is_anon  = array_key_exists ( 'anon' , $data_element );
    $this-&gt;is_new   = array_key_exists ( 'new'  , $data_element );
    $this-&gt;is_bot   = array_key_exists ( 'bot'  , $data_element );
    $this-&gt;is_minor = array_key_exists ( 'minor', $data_element );
    $this-&gt;is_top   = array_key_exists ( 'top'  , $data_element );
  }
}


class RecentChange extends UserContrib {
  public $type;

  public $rcid;
  public $old_revid;

  public $logid;
  public $logtype;
  public $logaction;
  public $logparams;

  public $is_patrolled;  // filled in only if the user has the patrol right

  public $oldlen;
  public $newlen;

  public function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;type      = array_sub ( $data_element, 'type' );
    $this-&gt;rcid      = array_sub ( $data_element, 'rcid' );
    $this-&gt;old_revid = array_sub ( $data_element, 'old_revid' );
    $this-&gt;logid     = array_sub ( $data_element, 'logid' );
    $this-&gt;logtype   = array_sub ( $data_element, 'logtype' );
    $this-&gt;logaction = array_sub ( $data_element, 'logaction' );
    switch ( $data_element['logtype'] ) {
      case 'move' &nbsp;: $this-&gt;logparams = array_subsub ( $data_element, 'move', 'new_title' );
      case 'block'&nbsp;: $this-&gt;logparams = array_subsub ( $data_element, 'block', 'duration' );
      default     &nbsp;: $this-&gt;logparams = array_sub ( $data_element, '0' );
    }
    $this-&gt;is_patrolled = array_key_exists ( 'patrolled', $data_element );
    $this-&gt;oldlen = array_sub ( $data_element, 'oldlen' );
    $this-&gt;newlen = array_sub ( $data_element, 'newlen' );
  }

}


class User extends Generic_Data_Item {
  public $name;
  public $editcount;
  public $registration;
  public $groups;
  public $blockedby;
  public $blockreason;
  public $emailable;
  public $userrightstoken;

  public $is_missing;
  public $is_invalid;

  public function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;name            = array_sub ( $data_element, 'name' );
    $this-&gt;editcount       = array_sub ( $data_element, 'editcount' );
    $this-&gt;registration    = array_ts  ( $data_element, 'registration' );
    $this-&gt;groups          = array_sub ( $data_element, 'groups' );
    $this-&gt;blockedby       = array_sub ( $data_element, 'blockedby' );
    $this-&gt;blockreason     = array_sub ( $data_element, 'blockreason' );
    $this-&gt;emailable       = array_sub ( $data_element, 'emailable' );
    $this-&gt;userrightstoken = array_sub ( $data_element, 'userrightstoken' );

    $this-&gt;is_missing = array_key_exists ( 'missing', $data_element );
    $this-&gt;is_invalid = array_key_exists ( 'invalid', $data_element );
  }

  public function is_in_group ( $group ) {
    if ( is_array ( $this-&gt;groups ) ) {
      return (&nbsp;! ( array_search ( $group, $this-&gt;groups ) === false ) );
    }
    return false;
  }

  public function is_bot () {
    return $this-&gt;is_in_group ( &quot;bot&quot; );
  }

  public function is_sysop () {
    return $this-&gt;is_in_group ( &quot;sysop&quot; );
  }

  public function is_bureaucrat () {
    return $this-&gt;is_in_group ( &quot;bureaucrat&quot; );
  }

}


class Block extends Generic_Data_Item {
  public $id;
  public $user;
  public $by;
  public $timestamp;
  public $expiry;
  public $reason;
  public $rangestart;
  public $rangeend;
  public $is_nocreate;
  public $is_autoblock;

  public function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;id         = array_sub ( $data_element, 'id' );
    $this-&gt;user       = array_sub ( $data_element, 'user' );
    $this-&gt;by         = array_sub ( $data_element, 'by' );
    $this-&gt;timestamp  = array_ts  ( $data_element, 'timestamp' );
    $this-&gt;expiry     = array_sub ( $data_element, 'expiry' );
    $this-&gt;reason     = array_sub ( $data_element, 'reason' );
    $this-&gt;rangestart = array_sub ( $data_element, 'rangestart' );
    $this-&gt;rangeend   = array_sub ( $data_element, 'rangeend' );

    $this-&gt;is_nocreate  = array_key_exists ( 'nocreate' , $data_element );
    $this-&gt;is_autoblock = array_key_exists ( 'autoblock', $data_element );
  }

}


class LogEvent extends Generic_Page_Item {
  public $logid;
  public $type;
  public $action;
  public $user;
  public $timestamp;
  public $comment;
  public $details;

  public function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;logid     = array_sub ( $data_element, 'logid' );
    $this-&gt;type      = array_sub ( $data_element, 'type' );
    $this-&gt;action    = array_sub ( $data_element, 'action' );
    $this-&gt;user      = array_sub ( $data_element, 'user' );
    $this-&gt;timestamp = array_ts  ( $data_element, 'timestamp' );
    $this-&gt;comment   = array_sub ( $data_element, 'comment' );
    switch ( $data_element['type'] ) {
      case 'delete'    &nbsp;: $this-&gt;details = array_sub ( $data_element, 'delete' );    // the field will not exist
        break;
      case 'move'      &nbsp;: $this-&gt;details = array_sub ( $data_element, 'move' );      // array ( new_ns, new_title ); new_title has namespace prefix
        break;
      case 'protect'   &nbsp;:
        switch ( $data_element['action'] ) {
          case 'protect'&nbsp;: $this-&gt;details[0] = array_sub ( $data_element, '0' ); // the protections and a language-specific expiry
                           $this-&gt;details[0] = array_sub ( $data_element, '1' ); // mostly empty
            break;
          case 'unprotect'&nbsp;:  // no details to obtain
            break;
          case 'move_prot'&nbsp;: $this-&gt;details = array_sub ( $data_element, '0' ); // the old name of the moved protected page ('title' is the new name)
            break;
        }
        break;
      case 'block'     &nbsp;: $this-&gt;details = array_sub ( $data_element, 'block' );     // if range - no data; if account/ip - array ( flags, duration, expiry )
        break;
      case 'rights'    &nbsp;: $this-&gt;details = array_sub ( $data_element, 'rights' );    // array ( new, old ); lists of MW rights (privileges)
        break;
      case 'renameuser'&nbsp;: $this-&gt;details = array_sub ( $data_element, '0' );  // the new name ('title' is the old name)
        break;
      case 'newusers'  &nbsp;:
        switch ( $data_element['action'] ) {
          case 'newusers'&nbsp;:
            break;
          case 'create2'&nbsp;: $this-&gt;details = array_sub ( $data_element, '0' );  // userid? (can be missing)
            break;
          case 'create'&nbsp;: $this-&gt;details = array_sub ( $data_element, '0' );  // userid? (can be missing)
            break;
          case 'autocreate'&nbsp;: $this-&gt;details = array_sub ( $data_element, '0' );  // userid? (can be missing)
            break;
        }
        break;
      case 'patrol'    &nbsp;: $this-&gt;details = array_sub ( $data_element, 'patrol' );    // array ( auto, prev, cur ); auto - 0 or 1, prev/cur - revids
        break;
      case 'upload'    &nbsp;:  // no details to obtain
        break;
      default          &nbsp;: $this-&gt;details = array_sub ( $data_element, 'details' );
    }
  }

}


class ProtectedTitle extends Generic_Page_Item {

  public $timestamp;
  public $user;
  public $comment;
  public $expiry;
  public $level;

  public function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;timestamp = array_ts  ( $data_element, 'timestamp' );
    $this-&gt;user      = array_sub ( $data_element, 'user' );
    $this-&gt;comment   = array_sub ( $data_element, 'comment' );
    $this-&gt;expiry    = array_sub ( $data_element, 'expiry' );
    $this-&gt;level     = array_sub ( $data_element, 'level' );
  }

}


class Page_WithExtlink extends Generic_Page_Item {
  public $url;

  public function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;url = array_sub ( $data_element, 'url' );
  }

}


class Page_FromWatchlist extends Generic_Page_Item {
  public $revid;
  public $old_revid;
  public $rcid;
  public $user;
  public $comment;
  public $timestamp;
  public $oldlen;
  public $newlen;
  public $is_patrolled;
  public $is_new;
  public $is_botedit;
  public $is_minor;
  public $is_anon;

  public function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;revid     = array_sub ( $data_element, 'revid' );
    $this-&gt;old_revid = array_sub ( $data_element, 'old_revid' );
    $this-&gt;rcid      = array_sub ( $data_element, 'rcid' );
    $this-&gt;user      = array_sub ( $data_element, 'user' );
    $this-&gt;comment   = array_sub ( $data_element, 'comment' );
    $this-&gt;timestamp = array_ts  ( $data_element, 'timestamp' );
    $this-&gt;oldlen    = array_sub ( $data_element, 'oldlen' );
    $this-&gt;newlen    = array_sub ( $data_element, 'newlen' );

    $this-&gt;is_patrolled = array_key_exists ( 'patrolled', $data_element );
    $this-&gt;is_new       = array_key_exists ( 'new'      , $data_element );
    $this-&gt;is_botedit   = array_key_exists ( 'bot'      , $data_element );
    $this-&gt;is_minor     = array_key_exists ( 'minor'    , $data_element );
    $this-&gt;is_anon      = array_key_exists ( 'anon'     , $data_element );
  }

}


class List_Title extends Generic_Data_Item {

  public $title;

  public function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;title = array_sub ( $data_element, '*' );
  }

}


class List_Link extends Generic_Page_Item {

  public $fromid;

  public function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;fromid = array_sub ( $data_element, 'fromid' );
  }

}


class List_SearchResult extends Generic_Page_Item {

  public $snippet;
  public $size;
  public $wordcount;
  public $timestamp;

  public function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;snippet   = array_sub ( $data_element, 'snippet'   );
    $this-&gt;size      = array_sub ( $data_element, 'size'      );
    $this-&gt;wordcount = array_sub ( $data_element, 'wordcount' );
    $this-&gt;timestamp = array_ts  ( $data_element, 'timestamp' );
  }

}


class DeletedRevision extends Page_Revision {
  public $token;  // undelete token - use it while undeleting revisions!

  public function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;token = array_sub ( $data_element, 'token' );
    $this-&gt;size  = array_sub ( $data_element, 'len'   );  // 'size' in deletedrevs list is replaced by 'len'
  }

}


# ---------------------------------------------------------------------------- #
# --                              Page support                              -- #
# ---------------------------------------------------------------------------- #


class Page extends Generic_Page_Item {

  public $counter;     // times the page was accessed; some wikis don't supply this info
  public $length;      // in bytes
  public $timestamp;   // of the last revision fetched
  public $lasttouched; // timestamp the page was last touched by a change in its rendering (eg. in a template it includes...)
  public $lastrevid;   // the last page revid (might be different from the last revid requested)
  public $protection;  // array of protection description arrays
  public $url;
  public $editurl;

  public $is_missing;
  public $is_invalid; // if the name requested is invalid
  public $is_new;     // has only 1 revision
  public $is_redirect;

  # These might be empty or partially filled, depending on the page request properties.
  public $revisions;  // history of the page
  public $categories; // categories it is in
  public $imageinfo;  // image versions ('revisions'), if the page is an image
  public $stashimageinfo;
  public $langlinks;  // a.k.a. interwikis
  public $links;      // a.k.a. wikilinks
  public $templates;  // and other included pages
  public $images;     // and other media
  public $extlinks;
  public $duplicatefiles;
  public $globalusage;

  public $imagerepository;  // 'local' etc.
  public $categorysize;     // if this is a category page, the number of members
  public $categorypages;
  public $categoryfiles;
  public $categorysubcats;

  public $text;             // text of the page latest (requested) revision
  public $section;          // section No. that wat fetched (NULL - all text, 'new' - new section)
  public $rvtimestamp;      // timestamp of the latest (requested) revision

/*  not implemented yet:
  public $prependtext;
  public $appendtext;
*/

  public $requested_title;  // the non-normalized title from the request;
  public $fetchtimestamp;   // the wiki timestamp the page was fetched on

  public $deny_bots;        // if true, access for this bot is denied by a {{Bots}} template.


  protected $lastrev;


  private function objects_array ( &amp;$data_element, $array_key, $object_type ) {
    if ( array_key_exists ( $array_key, $data_element ) ) {
      if ( is_array ( $data_element[$array_key] ) ) {
        $objects = array();
        foreach ( $data_element[$array_key] as $key =&gt; &amp;$subelement ) {
          $object = new $object_type;
          $object-&gt;read_from_element ( $subelement, $this-&gt;bot );
          unset ( $data_element[$array_key][$key] );  // decreases memory usage, but will cause data element modification!!!
          $objects[] = $object;
        }
        return $objects;
      }
    }
    return NULL;
  }

  private function latest_revision () {
    if (&nbsp;! isset ( $this-&gt;lastrev ) ) {
      if ( empty ( $this-&gt;revisions ) ) return false;
      $begrev = reset ( $this-&gt;revisions );
      $endrev = end   ( $this-&gt;revisions );
      if ( $endrev-&gt;timestamp &gt; $begrev-&gt;timestamp ) { $this-&gt;lastrev = &amp;$endrev; } else { $this-&gt;lastrev = &amp;$begrev; }
    }
    return $this-&gt;lastrev;
  }

  private function deny_bots () {
    return (bool) preg_match (
      '/\{\{(' .
          'nobots|' .
          'bots\|allow=none|' .
          'bots\|deny=all|' .
          'bots\|optout=all|' .
          'bots\|deny=.*?' . preg_quote ( $this-&gt;bot-&gt;my_username(), '/' ) . '.*?' .
        ')\}\}/iS',
      $this-&gt;text, $matches );
  }

  public function read_from_element ( $data_element, $bot ) {
    parent::read_from_element ( $data_element, $bot );

    $this-&gt;counter     = array_sub ( $data_element, 'counter'    );
    $this-&gt;length      = array_sub ( $data_element, 'length'     );
    $this-&gt;lasttouched = array_ts  ( $data_element, 'touched'    );
    $this-&gt;lastrevid   = array_sub ( $data_element, 'lastrevid'  );
    $this-&gt;protection  = array_sub ( $data_element, 'protection' );  // an array of arrays...
    $this-&gt;url         = array_sub ( $data_element, 'fullurl'    );
    $this-&gt;editurl     = array_sub ( $data_element, 'editurl'    );

    $this-&gt;is_missing  = array_key_exists ( 'missing' , $data_element );
    $this-&gt;is_invalid  = array_key_exists ( 'invalid' , $data_element );
    $this-&gt;is_new      = array_key_exists ( 'new'     , $data_element );
    $this-&gt;is_redirect = array_key_exists ( 'redirect', $data_element );

    $this-&gt;revisions      = $this-&gt;objects_array ( $data_element, 'revisions'     , 'Page_Revision'      );
    $this-&gt;categories     = $this-&gt;objects_array ( $data_element, 'categories'    , 'Page_Category'      );
    $this-&gt;imageinfo      = $this-&gt;objects_array ( $data_element, 'imageinfo'     , 'Page_ImageInfo'     );
    $this-&gt;stashimageinfo = $this-&gt;objects_array ( $data_element, 'stashimageinfo', 'Page_ImageInfo'     );
    $this-&gt;langlinks      = $this-&gt;objects_array ( $data_element, 'langlinks'     , 'Page_LangLink'      );
    $this-&gt;links          = $this-&gt;objects_array ( $data_element, 'links'         , 'Page_Link'          );
    $this-&gt;templates      = $this-&gt;objects_array ( $data_element, 'templates'     , 'Page_Template'      );
    $this-&gt;images         = $this-&gt;objects_array ( $data_element, 'images'        , 'Page_Image'         );
    $this-&gt;extlinks       = $this-&gt;objects_array ( $data_element, 'extlinks'      , 'Page_Extlink '      );
    $this-&gt;duplicatefiles = $this-&gt;objects_array ( $data_element, 'duplicatefiles', 'Page_DuplicateFile' );
    $this-&gt;globalusage    = $this-&gt;objects_array ( $data_element, 'globalusage'   , 'Page_GlobalUsage'   );

    $this-&gt;imagerepository = array_sub ( $data_element, 'imagerepository' );

    if ( array_key_exists ( 'categoryinfo', $data_element ) ) {
      $this-&gt;categorysize    = array_subsub ( $data_element, 'categoryinfo', 'size'    );
      $this-&gt;categorypages   = array_subsub ( $data_element, 'categoryinfo', 'pages'   );
      $this-&gt;categoryfiles   = array_subsub ( $data_element, 'categoryinfo', 'files'   );
      $this-&gt;categorysubcats = array_subsub ( $data_element, 'categoryinfo', 'subcats' );
    }

    $this-&gt;fetchtimestamp = array_sub ( $data_element, 'fetchtimestamp' );
    if ( empty ( $this-&gt;fetchtimestamp ) ) {
      $this-&gt;fetchtimestamp = date ( 'Y-m-d H:i:s', $this-&gt;bot-&gt;wiki_lastreq_time() );
    }

    $this-&gt;reset_text_changes();
    $this-&gt;deny_bots = $this-&gt;deny_bots();

  }

  public function redirects_to () {
    preg_match ( '/#' . $this-&gt;bot-&gt;wiki_magicword_namesregex ( 'redirect' ) . '\s*\[\[([^\]]+)\]\]/Ui', $this-&gt;text, $matches );
    if ( empty ( $matches[2] ) ) { return false; } else { return $matches[2]; }
  }

  public function is_edited () {
    $lastrev = $this-&gt;latest_revision();
    $origtext = ( ( $lastrev === false )&nbsp;? NULL&nbsp;: $lastrev-&gt;content );
    return ( $this-&gt;text&nbsp;!== $origtext );
  }

  public function is_modified () {
    return ( $this-&gt;is_edited() || ( $this-&gt;timestamp&nbsp;!== $this-&gt;rvtimestamp ) );
  }

  public function is_actual () {
    $lastrev = $this-&gt;latest_revision();
    if (&nbsp;! $lastrev ) return false;
    return ( $lastrev-&gt;revid == $this-&gt;lastrevid );
  }

  public function reset_text_changes () {
    $lastrev = $this-&gt;latest_revision();
    if ( is_object ( $lastrev ) ) {
      $this-&gt;text        = $lastrev-&gt;content;
      $this-&gt;section     = $lastrev-&gt;section;
      $this-&gt;rvtimestamp = $lastrev-&gt;timestamp;
      if ( empty ( $this-&gt;timestamp ) ) { $this-&gt;timestamp = $lastrev-&gt;timestamp; }
    }
  }

  public function replace ( $regex, $with, $limit = -1 ) {
    $this-&gt;text = preg_replace ( $regex, $with, $this-&gt;text, $limit, $count );
    return $count;
  }

  # $old - the old category (empty - add the new); $new - the new category (empty - del the old), $new_sortkey - the new sortkey ( NULL - reuse the old, &quot;&quot; - none )
  public function replace_category ( $old, $new, $new_sortkey = NULL ) {
    if (&nbsp;! empty ( $new_sortkey ) ) $new_sortkey = '|' . $new_sortkey;
    if ( empty ( $old ) ) {
      if ( empty ( $new ) ) {
        return false;
      } else {
        $has_categories = preg_match ( $this-&gt;bot-&gt;regex_wikilink ( false, &quot;&quot;, $this-&gt;bot-&gt;wiki_namespace_barsepnames ( NAMESPACE_ID_CATEGORY ), NULL, &quot;&quot;, NULL ), $this-&gt;text );
        $has_interwikis = preg_match ( $this-&gt;bot-&gt;regex_wikilink ( false, $this-&gt;bot-&gt;wiki_interwikis_barsepnames(), &quot;&quot;, NULL, &quot;&quot;, NULL ), $this-&gt;text );
        if (&nbsp;! $has_interwikis ) {
          $this-&gt;text .= &quot;\n[[&quot; . $new . $new_sortkey . &quot;]]&quot;;
          return true;
        } elseif ( $has_categories ) {
          $regex = '/' .
            '(' . $this-&gt;bot-&gt;regexmatch_wikilink ( false, &quot;&quot;, $this-&gt;bot-&gt;wiki_namespace_barsepnames ( NAMESPACE_ID_CATEGORY ), NULL, &quot;&quot;, NULL ) . ')' .
            '((\v\h*)*)' .
            '(' . $this-&gt;bot-&gt;regexmatch_wikilink ( false, $this-&gt;bot-&gt;wiki_interwikis_barsepnames(), &quot;&quot;, NULL, &quot;&quot;, NULL ) . ')' .
            '/Uus';
          $with = '$1' . &quot;\n[[&quot; . $new . $new_sortkey . &quot;]]&quot; . '$12$14';
          return $this-&gt;replace ( $regex, $with, 1 );
        } else {
          $regex = '/(' . $this-&gt;bot-&gt;regexmatch_wikilink ( false, $this-&gt;bot-&gt;wiki_interwikis_barsepnames(), &quot;&quot;, NULL, &quot;&quot;, NULL ) . ')(.*)$/Uus';
          $with  = '[[' . $new . $new_sortkey . &quot;]]\n\n&quot; . '$1$12';
          return $this-&gt;replace ( $regex, $with, 1 );
        }
      }

    } else {
      $regex = '/' . $this-&gt;bot-&gt;regexmatch_wikilink ( false, &quot;&quot;, $this-&gt;bot-&gt;wiki_namespace_barsepnames ( NAMESPACE_ID_CATEGORY ), $old, &quot;&quot;, NULL ) . '\v?/u';
      if ( empty ( $new ) ) {
        $with = &quot;&quot;;
      } else {
        if ( is_null ( $new_sortkey ) ) {
          $new_sortkey = '$9';
        }
        $with = &quot;[[&quot; . $new . $new_sortkey . &quot;]]\n&quot;;
      }
      return $this-&gt;replace ( $regex, $with, 1 );
    }
  }

  public function replace_langlink ( $interwiki, $old_article_name, $new_article_name ) {
    if ( empty ( $old_article_name ) ) {
      if ( empty ( $new_article_name ) ) {
        return false;
      } else {
        $this-&gt;text .= &quot;\n[[&quot; . $interwiki . ':' . $new_article_name . &quot;]]&quot;;
        return true;
      }
    } else {
      $regex = '/\v?' . $this-&gt;bot-&gt;regexmatch_wikilink ( false, $interwiki, &quot;&quot;, $old_article_name, &quot;&quot;, &quot;&quot; ) . '/u';
      if ( empty ( $new_article_name ) ) {
        $with = &quot;&quot;;
      } else {
        $with = &quot;\n[[&quot; . $interwiki . ':' . $new_article_name . &quot;]]&quot;;
      }
      return $this-&gt;replace ( $regex, $with, 1 );
    }
  }

  public function replace_file ( $old_name, $new_name, $new_attrs = NULL, $count = 1 ) {
    if ( is_array ( $new_attrs ) ) $new_attrs = '|' . implode ( '|', $new_attrs );
    $regex = $this-&gt;bot-&gt;regex_wikilink ( NULL, NULL, $this-&gt;bot-&gt;wiki_namespace_barsepnames ( NAMESPACE_ID_FILE ), $old_name, &quot;&quot;, NULL );
    $with = ( empty ( $new_name )&nbsp;? ''&nbsp;: '[[$1$3$4' . $new_name . ( empty ( $new_attrs )&nbsp;? '$9'&nbsp;: $new_attrs ) . ']]' );
    return $this-&gt;replace ( $regex, $with, $count );
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

<!-- Saved in parser cache with key wikidb_apibot:pcache:idhash:43-0!1!0!!en!2!edit=0 and timestamp 20120916045519 -->
<div class="printfooter">
Retrieved from "<a href="http://apibot.zavinagi.org/index.php/Development_code/Apibot_dataobjects.php">http://apibot.zavinagi.org/index.php/Development_code/Apibot_dataobjects.php</a>"</div>
		<div id='catlinks' class='catlinks catlinks-allhidden'></div>		<!-- end content -->
				<div class="visualClear"></div>
	</div>
</div></div>
<div id="column-one">
	<div id="p-cactions" class="portlet">
		<h5>Views</h5>
		<div class="pBody">
			<ul>
				 <li id="ca-nstab-main" class="selected"><a href="/index.php/Development_code/Apibot_dataobjects.php" title="View the content page [c]" accesskey="c">Page</a></li>
				 <li id="ca-talk" class="new"><a href="/index.php?title=Talk:Development_code/Apibot_dataobjects.php&amp;action=edit&amp;redlink=1" title="Discussion about the content page [t]" accesskey="t">Discussion</a></li>
				 <li id="ca-viewsource"><a href="/index.php?title=Development_code/Apibot_dataobjects.php&amp;action=edit" title="This page is protected.&#10;You can view its source [e]" accesskey="e">View source</a></li>
				 <li id="ca-history"><a href="/index.php?title=Development_code/Apibot_dataobjects.php&amp;action=history" title="Past revisions of this page [h]" accesskey="h">History</a></li>
			</ul>
		</div>
	</div>
	<div class="portlet" id="p-personal">
		<h5>Personal tools</h5>
		<div class="pBody">
			<ul>
				<li id="pt-login"><a href="/index.php?title=Special:UserLogin&amp;returnto=Development_code/Apibot_dataobjects.php" title="You are encouraged to log in; however, it is not mandatory [o]" accesskey="o">Log in</a></li>
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
				<li id="t-whatlinkshere"><a href="/index.php/Special:WhatLinksHere/Development_code/Apibot_dataobjects.php" title="List of all wiki pages that link here [j]" accesskey="j">What links here</a></li>
				<li id="t-recentchangeslinked"><a href="/index.php/Special:RecentChangesLinked/Development_code/Apibot_dataobjects.php" title="Recent changes in pages linked from this page [k]" accesskey="k">Related changes</a></li>
<li id="t-specialpages"><a href="/index.php/Special:SpecialPages" title="List of all special pages [q]" accesskey="q">Special pages</a></li>
				<li id="t-print"><a href="/index.php?title=Development_code/Apibot_dataobjects.php&amp;printable=yes" rel="alternate" title="Printable version of this page [p]" accesskey="p">Printable version</a></li>				<li id="t-permalink"><a href="/index.php?title=Development_code/Apibot_dataobjects.php&amp;oldid=282" title="Permanent link to this revision of the page">Permanent link</a></li>			</ul>
		</div>
	</div>
</div><!-- end of the left (by default at least) column -->
<div class="visualClear"></div>
<div id="footer">
	<div id="f-poweredbyico"><a href="http://www.mediawiki.org/"><img src="/skins/common/images/poweredby_mediawiki_88x31.png" height="31" width="88" alt="Powered by MediaWiki" /></a></div>
	<ul id="f-list">
		<li id="lastmod"> This page was last modified on 28 August 2011, at 19:16.</li>
		<li id="viewcount">This page has been accessed 1,377 times.</li>
		<li id="privacy"><a href="/index.php/Apibot:Privacy_policy" title="Apibot:Privacy policy">Privacy policy</a></li>
		<li id="about"><a href="/index.php/Apibot:About" title="Apibot:About">About Apibot</a></li>
		<li id="disclaimer"><a href="/index.php/Apibot:General_disclaimer" title="Apibot:General disclaimer">Disclaimers</a></li>
	</ul>
</div>
</div>

<script>if (window.runOnloadHook) runOnloadHook();</script>
<!-- Served in 0.138 secs. --></body></html>
