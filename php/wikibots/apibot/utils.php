<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" dir="ltr">
<head>
<title>Development code/Utils.php - Apibot</title>
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
wgPageName="Development_code/Utils.php",
wgTitle="Development code/Utils.php",
wgAction="view",
wgArticleId=45,
wgIsArticle=true,
wgUserName=null,
wgUserGroups=null,
wgUserLanguage="en",
wgContentLanguage="en",
wgBreakFrames=false,
wgCurRevisionId=289,
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
<body class="mediawiki ltr ns-0 ns-subject page-Development_code_Utils_php skin-monobook">
<div id="globalWrapper">
<div id="column-content"><div id="content" >
	<a id="top"></a>
	
	<h1 id="firstHeading" class="firstHeading">Development code/Utils.php</h1>
	<div id="bodyContent">
		<h3 id="siteSub">From Apibot</h3>
		<div id="contentSub"></div>
		<div id="jump-to-nav">Jump to: <a href="#column-one">navigation</a>, <a href="#searchInput">search</a></div>
		<!-- start content -->
<p>This is the development code for the Apibot utils module.
</p>
<pre>
&lt;?php
#
#  Miscellaneous utilities
#
#  Copyright (C) 2004 Borislav Manolov. This program is in the public domain.
#
#  Author: Borislav Manolov &lt;b.manolov at gmail dot com&gt;
#          http://purl.org/NET/borislav/
#
#  Modified and appended by Grigor Gatchev, 2008-2011.
#
#############################################################################


# ----- File handling ----- #

function my_fwrite($file, $text, $mode='a+') {
  $myFile = @fopen($file, $mode);
  if (! $myFile) return false;
  flock($myFile, LOCK_EX);
  $write_result = @fputs($myFile, $text);
  flock($myFile, LOCK_UN);
  if (! $write_result) return false;
  if (! @fclose($myFile)) return false;
  return true;
}


# ----- Memory handling ----- #


function get_memory_limit () {  // always returns bytes
  preg_match ( '/(\d+)([^\d])?/', ini_get ( 'memory_limit' ), $matches );
  switch ( strtolower ( $matches[2] ) ) {
    case 'k'&nbsp;: $matches[1] *= 1024;
    case 'm'&nbsp;: $matches[1] *= 1024 * 1024;
    case 'g'&nbsp;: $matches[1] *= 1024 * 1024 * 1024;
  }
  return $matches[1];
}


# ----- Wiki-typical strings ----- #

function wikilink ( $target, $text = NULL ) {
  if ( empty ( $text ) &amp;&amp; preg_match ( '/([^\(]+)\([^\)]+\)(\#.+)?$/u', $target, $matches ) ) {
    $text = trim ( $matches[1] );
  }
  if (&nbsp;! empty ( $text ) ) {
    $target .= &quot;|&quot; . $text;
  }
  return &quot;[[&quot; . $target . &quot;]]&quot;;
}


# ----- String diffs ----- #

function added_to_str ( $old_str, $new_str ) {
  $diff = array_diff ( explode ( ' ', $old_str ), explode ( ' ', $new_str ) );
  return implode ( ' ', $diff );
}

# Inspired by Paul Butler's SimpleDiff, and using his algorithm.
function diff_arrays ( $old, $new ) {
  foreach ( $old as $old_index =&gt; $old_value ) {
    $new_keys = array_keys ( $new, $old_value );
    foreach ( $new_keys as $new_index ) {
      $matrix[$old_index][$new_index] =
        isset ( $matrix[$old_index - 1][$new_index - 1] )&nbsp;?
        $matrix[$old_index - 1][$new_index - 1] + 1&nbsp;:
        1;
      if ( $matrix[$old_index][$new_index] &gt; $maxlen ) {
        $maxlen = $matrix[$old_index][$new_index];
        $old_max = $old_index + 1 - $maxlen;
        $new_max = $new_index + 1 - $maxlen;
      }
    }
  }
  if ( $maxlen == 0 ) {
    return array ( array ('d' =&gt; $old, 'i' =&gt; $new ) );
  } else {
    return array_merge (
      diff_arrays ( array_slice ( $old, 0, $old_max ), array_slice ( $new, 0, $new_max ) ),
      array_slice ( $new, $new_max, $maxlen ),
      diff_arrays ( array_slice ( $old, $old_max + $maxlen ), array_slice ( $new, $new_max + $maxlen ) )
    );
  }
}

function diff_strings ( $old, $new ) {
  return diff_arrays ( explode ( ' ', $old ), explode (' ', $new ) );
}

/**
 * Fetch an array element by key.
 * Nested arrays can be accessed through dot notation, e.g. my.nested.element
 * Return $default_value if no such key exists.
 * @param array $data             Data array
 * @param string $keys            Key to fetch (use dot notation for nested elements)
 * @param mixed $default_value    Return this value if no element can be found
 * @return mixed
 */
function array_value ( array $data, $keys, $default_value = null ) {
  foreach ( explode ( '.', $keys ) as $key ) {
    if ( isset ( $data[$key] ) ) {
      $data = $data[$key];
    } else {
      return $default_value;
    }
  }
  return $data;
}

function fill_on_empty ( &amp;$var, $value ) {
  if ( empty ( $var ) ) {
    $var = $value;
  }
}

function fill_on_null ( &amp;$var, $value ) {
  if ( is_null ( $var ) ) {
    $var = $value;
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

<!-- Saved in parser cache with key wikidb_apibot:pcache:idhash:45-0!1!0!!en!2!edit=0 and timestamp 20120916025132 -->
<div class="printfooter">
Retrieved from "<a href="http://apibot.zavinagi.org/index.php/Development_code/Utils.php">http://apibot.zavinagi.org/index.php/Development_code/Utils.php</a>"</div>
		<div id='catlinks' class='catlinks catlinks-allhidden'></div>		<!-- end content -->
				<div class="visualClear"></div>
	</div>
</div></div>
<div id="column-one">
	<div id="p-cactions" class="portlet">
		<h5>Views</h5>
		<div class="pBody">
			<ul>
				 <li id="ca-nstab-main" class="selected"><a href="/index.php/Development_code/Utils.php" title="View the content page [c]" accesskey="c">Page</a></li>
				 <li id="ca-talk" class="new"><a href="/index.php?title=Talk:Development_code/Utils.php&amp;action=edit&amp;redlink=1" title="Discussion about the content page [t]" accesskey="t">Discussion</a></li>
				 <li id="ca-viewsource"><a href="/index.php?title=Development_code/Utils.php&amp;action=edit" title="This page is protected.&#10;You can view its source [e]" accesskey="e">View source</a></li>
				 <li id="ca-history"><a href="/index.php?title=Development_code/Utils.php&amp;action=history" title="Past revisions of this page [h]" accesskey="h">History</a></li>
			</ul>
		</div>
	</div>
	<div class="portlet" id="p-personal">
		<h5>Personal tools</h5>
		<div class="pBody">
			<ul>
				<li id="pt-login"><a href="/index.php?title=Special:UserLogin&amp;returnto=Development_code/Utils.php" title="You are encouraged to log in; however, it is not mandatory [o]" accesskey="o">Log in</a></li>
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
				<li id="t-whatlinkshere"><a href="/index.php/Special:WhatLinksHere/Development_code/Utils.php" title="List of all wiki pages that link here [j]" accesskey="j">What links here</a></li>
				<li id="t-recentchangeslinked"><a href="/index.php/Special:RecentChangesLinked/Development_code/Utils.php" title="Recent changes in pages linked from this page [k]" accesskey="k">Related changes</a></li>
<li id="t-specialpages"><a href="/index.php/Special:SpecialPages" title="List of all special pages [q]" accesskey="q">Special pages</a></li>
				<li id="t-print"><a href="/index.php?title=Development_code/Utils.php&amp;printable=yes" rel="alternate" title="Printable version of this page [p]" accesskey="p">Printable version</a></li>				<li id="t-permalink"><a href="/index.php?title=Development_code/Utils.php&amp;oldid=289" title="Permanent link to this revision of the page">Permanent link</a></li>			</ul>
		</div>
	</div>
</div><!-- end of the left (by default at least) column -->
<div class="visualClear"></div>
<div id="footer">
	<div id="f-poweredbyico"><a href="http://www.mediawiki.org/"><img src="/skins/common/images/poweredby_mediawiki_88x31.png" height="31" width="88" alt="Powered by MediaWiki" /></a></div>
	<ul id="f-list">
		<li id="lastmod"> This page was last modified on 4 March 2012, at 16:00.</li>
		<li id="viewcount">This page has been accessed 411 times.</li>
		<li id="privacy"><a href="/index.php/Apibot:Privacy_policy" title="Apibot:Privacy policy">Privacy policy</a></li>
		<li id="about"><a href="/index.php/Apibot:About" title="Apibot:About">About Apibot</a></li>
		<li id="disclaimer"><a href="/index.php/Apibot:General_disclaimer" title="Apibot:General disclaimer">Disclaimers</a></li>
	</ul>
</div>
</div>

<script>if (window.runOnloadHook) runOnloadHook();</script>
<!-- Served in 0.133 secs. --></body></html>
