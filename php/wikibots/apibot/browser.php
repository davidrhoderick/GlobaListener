<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" dir="ltr">
<head>
<title>Development code/Browser.php - Apibot</title>
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
wgPageName="Development_code/Browser.php",
wgTitle="Development code/Browser.php",
wgAction="view",
wgArticleId=44,
wgIsArticle=true,
wgUserName=null,
wgUserGroups=null,
wgUserLanguage="en",
wgContentLanguage="en",
wgBreakFrames=false,
wgCurRevisionId=288,
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
<body class="mediawiki ltr ns-0 ns-subject page-Development_code_Browser_php skin-monobook">
<div id="globalWrapper">
<div id="column-content"><div id="content" >
	<a id="top"></a>
	
	<h1 id="firstHeading" class="firstHeading">Development code/Browser.php</h1>
	<div id="bodyContent">
		<h3 id="siteSub">From Apibot</h3>
		<div id="contentSub"></div>
		<div id="jump-to-nav">Jump to: <a href="#column-one">navigation</a>, <a href="#searchInput">search</a></div>
		<!-- start content -->
<p>This is the development code for the Apibot browser module.
</p>
<pre>
&lt;?php
#  browser utils
#
#  Copyright (C) 2004 Borislav Manolov
#
#  This program is in the public domain.
#
#  Author: Borislav Manolov &lt;b.manolov at gmail dot com&gt;
#          http://purl.org/NET/borislav/
#
#  This program uses portions of
#    Snoopy - the PHP net client
#    Author: Monte Ohrt &lt;monte@ispi.net&gt;
#    Copyright (c): 1999-2000 ispi, all rights reserved
#    Version: 1.01
#    http://snoopy.sourceforge.net/
#
#  Modified by Grigor Gatchev &lt;grigor at gatchev dot info&gt;.
#  Added support for &quot;Content-Transfer: chunked&quot; и &quot;Accept-Encoding: gzip&quot;,
#  and the lastreq_time() function.
#
#############################################################################
require_once ( dirname ( __FILE__ ) . '/utils.php' );

class Browser {

	var $scheme  = '';        // connection scheme
	var $host    = '';        // host for connection
	var $port    = '';        // port for connection
	var $agent   = 'Mozilla/5.0 (PHPBrowser)'; // user agent
	var $cookies = array();   // cookies
	var $print_cookies = false; // whether to print cookies
	var $cookies_file = '';

	var $use_compression = true;

	# data for basic HTTP Authentication
	var $user = '';
	var $pass = '';

	var $conn_timeout = 120;  // timeout for socket connection

	var $fetch_method  = 'GET';     // fetch method
	var $submit_method = 'POST';    // submit method
	var $http_version  = 'HTTP/1.1';// http version
	var $content_type  = array(     // content types
		'text' =&gt; 'application/x-www-form-urlencoded',
		'binary' =&gt; 'multipart/form-data'
	);
	var $mime_boundary = ''; // MIME boundary for binary submission

	var $postdata_size;    // size in bytes of the last postdata sent
	var $lastreq_begtime;  // timestamp of the last request start
	var $lastreq_endtime;  // timestamp of the last request end

	var $content = '';        // content returned from server
	var $headers = array();   // headers returned from server

	var $error        = '';   // error messages
	var $is_redirect = false; // true if the fetched page is a redirect

	var $bytecounters;  // download / upload counters
	var $limits; // speed limits

	# constructor
	# $params - assoc array (name =&gt; value)
	# return nothing
	function Browser($params = array()) {
		settype($params, 'array');
		foreach ( $params as $field =&gt; $value ) {
			if ( isset($this-&gt;$field) ) {
				$this-&gt;$field = $value;
			}
		}
		$this-&gt;read_cookies();
		$this-&gt;mime_boundary = 'PHPBrowser' . md5( uniqid( microtime() ) );
		$this-&gt;reset_bytecounters();
	}


	# fetch a page
	# $uri - location of the page
	# $do_auth:boolean - add an authentication header
	# return true by success
	function fetch($uri, $do_auth = false) {
		return $this-&gt;make_request($uri, $this-&gt;fetch_method, '', '', $do_auth);
	}


	# submit an http form
	# $uri  - the location of the page to submit
	# $vars - assoc array with form fields and their values
	# $file - assoc array (field name =&gt; file name)
	#         set only by upload
	# $do_auth:boolean - add an authentication header
	# return true by success
	function submit( $uri, $vars = array(), $file = array(), $do_auth = false ) {
		$postdata = '';
		if ( empty($file) ) {
			if (&nbsp;! empty ( $vars ) ) {
				foreach ( $vars as $key =&gt; $val ) {
					if ( is_array ( $val ) ) {
						foreach ( $val as $sub ) {
							$postdata .= urlencode($key.&quot;[]&quot;) .'='. urlencode($sub) . '&amp;';
						}
					} else {
						$postdata .= urlencode($key) .'='. urlencode($val) .'&amp;';
					}
				}
			}
		} else {
			foreach ( $vars as $key =&gt; $val ) {
				$postdata .= '--'. $this-&gt;mime_boundary .&quot;\r\n&quot;;
				$postdata .= 'Content-Disposition: form-data; name=&quot;'. $key .&quot;\&quot;\r\n\r\n&quot;;
				$postdata .= $val . &quot;\r\n&quot;;
			}

			list($field_name, $file_name) = each($file);
			if (&nbsp;!is_readable($file_name) ) {
				$this-&gt;error = 'File &quot;' . $file_name . '&quot; is not readable.';
				return false;
			}

			$fp = fopen($file_name, 'r');
			$file_content = fread( $fp, filesize($file_name) );
			fclose($fp);
			$base_name = basename($file_name);

			$postdata .= '--'. $this-&gt;mime_boundary .&quot;\r\n&quot;;
			$postdata .= 'Content-Disposition: form-data; name=&quot;'. $field_name .
						'&quot;; filename=&quot;' . $base_name . &quot;\&quot;\r\n\r\n&quot;;
			$postdata .= $file_content . &quot;\r\n&quot;;
			$postdata .= '--'. $this-&gt;mime_boundary .&quot;--\r\n&quot;;
		}

		$content_type = empty($file)
			? $this-&gt;content_type['text']
			: $this-&gt;content_type['binary'];

		return $this-&gt;make_request($uri, $this-&gt;submit_method, $content_type,
			$postdata, $do_auth);
	}

	# get data from server
	# $uri - the location the page
	# $request_method - GET / POST
	# $content_type - content type (for POST submission)
	# $postdata - data (for POST submission)
	# $do_auth:boolean - add an authentication header based on $this-&gt;user and $this-&gt;pass
	# return true if the request succeeded, false otherwise
	function make_request( $uri, $request_method, $content_type = '',
		$postdata = '', $do_auth = false ) {

		$this-&gt;delay_if_needed();

		$this-&gt;postdata_size = strlen ( $postdata );

		$uri_parts = parse_url ( $uri );
		if (&nbsp;! in_array ( $uri_parts['scheme'], array ( 'http', 'https' ) ) ) { // not a valid protocol
			$this-&gt;error = &quot;Invalid protocol: $uri_parts[scheme]&quot;;
			return false;
		}

		$this-&gt;lastreq_begtime = time();

		$this-&gt;host = $uri_parts['host'];
		switch ( $uri_parts['scheme'] ) {
			case 'http' &nbsp;: $this-&gt;scheme = '';
			               if ( empty ( $uri_parts['port'] ) ) $uri_parts['port'] = 80;
			               break;
			case 'https'&nbsp;: if (&nbsp;! in_array ( 'openssl', get_loaded_extensions() ) ) {
			                 $this-&gt;error = &quot;No SSL support - cannot make HTTPS requests!&quot;;
			                 return false;
			               } else {
			                 $this-&gt;scheme = 'ssl://';
			                 if ( empty ( $uri_parts['port'] ) ) $uri_parts['port'] = 443;
			                 break;
			               }
			default&nbsp;: $this-&gt;error = &quot;Inappropriate protocol: &quot; . $uri_parts['scheme']; return false;
		}
		if ( empty ( $this-&gt;port ) ) $this-&gt;port = $uri_parts['port'];
		$fp = @fsockopen ( $this-&gt;scheme . $this-&gt;host, $this-&gt;port, $errno, $errstr, $this-&gt;conn_timeout );
		if (&nbsp;!$fp ) {
			$this-&gt;error = $errno .' / Reason: '. $errstr;
			return false;
		}

		$path = $uri_parts['path'] .
			(isset($uri_parts['query'])&nbsp;? '?'. $uri_parts['query']&nbsp;: '');

		$cookie_headers = '';
		if ($this-&gt;is_redirect) {
			$this-&gt;set_cookies();
		}

		if ( empty($path) ) { $path = '/'; }
		$headers = &quot;$request_method $path $this-&gt;http_version\r\n&quot; .
			&quot;User-Agent: $this-&gt;agent\r\n&quot; .
			&quot;Host: $this-&gt;host\r\n&quot; .
			&quot;Accept: */*\r\n&quot;;
		if ( $this-&gt;use_compression &amp;&amp; function_exists ( &quot;gzinflate&quot; ) ) {
			$headers .= &quot;Accept-Encoding: gzip\r\n&quot;;
		}

		if ($do_auth) {
			$headers .= 'Authorization: Basic '.
				base64_encode($this-&gt;user.':'.$this-&gt;pass) . &quot;\r\n&quot;;
		}

		if ( isset($this-&gt;cookies[$this-&gt;host]) ) {
			$cookie_headers .= 'Cookie: ';
			foreach ($this-&gt;cookies[$this-&gt;host] as $cookie_name =&gt; $cookie_data) {
				$cookie_headers .= $cookie_name .'='. $cookie_data[0] .'; ';
			}
			# add $cookie_headers w/o last 2 chars
			$headers .= substr($cookie_headers, 0, -2) . &quot;\r\n&quot;;
		}

		if (&nbsp;!empty($content_type) ) {
			$headers .= &quot;Content-type: $content_type&quot;;
			if ($content_type == $this-&gt;content_type['binary']) {
				$headers .= '; boundary=' . $this-&gt;mime_boundary;
			}
			$headers .= &quot;\r\n&quot;;
		}
		if (&nbsp;!empty($postdata) ) {
			$headers .= &quot;Content-length: &quot;. strlen($postdata) .&quot;\r\n&quot;;
		}
		$headers .= &quot;\r\n&quot;;

		$data = $headers . $postdata;
		$datalen = strlen ( $data );
		fwrite( $fp, $data, $datalen );
		$this-&gt;bytecounters['total']['UL']['compressed'  ] += $datalen;
		$this-&gt;bytecounters['total']['UL']['uncompressed'] += $datalen;
		$this-&gt;bytecounters['last' ]['UL']['compressed'  ]  = $datalen;
		$this-&gt;bytecounters['last' ]['UL']['uncompressed']  = $datalen;

		$this-&gt;is_redirect = false;
		$this-&gt;headers = array();

		$headers_len = 0;
		while ( $curr_header = fgets($fp, 4096) )  {
			if ($curr_header == &quot;\r\n&quot;) break;
			# if a header begins with Location: or URI:, set the redirect
			if ( preg_match('/^(Location:|URI:)[ ]+(.*)/', $curr_header, $matches) ) {
				$this-&gt;is_redirect = rtrim($matches[2]);
			}
			$this-&gt;headers[] = $curr_header;
			$headers_len += strlen ( $curr_header );
		}

		$content = '';
		if ( in_array ( &quot;Transfer-Encoding: chunked\r\n&quot;, $this-&gt;headers ) ) {
			while ( true ) {
				$chunk_size = fgets ( $fp );
				$chunk_size_dec = hexdec ( $chunk_size );
				if ( $chunk_size_dec == 0 ) {
					fgets ( $fp );  // remove trailing CRLF
					break;
				} else {
					$chunk = '';
					while ( $chunk_size_dec - strlen ( $chunk ) &gt; 0 ) {
						if (&nbsp;! ( $chunk_piece = fread ( $fp, $chunk_size_dec - strlen ( $chunk ) ) ) ) { break; }
						$chunk .= $chunk_piece;
					}
					fgets ( $fp ); // remove trailing CRLF
				}
				$content .= $chunk;
			}
			fgets ( $fp );
		} else {
			while ( $data = fread($fp, 500000) ) {
				$content .= $data;
			}
		}
		$this-&gt;content = $content;
		$this-&gt;bytecounters['total']['DL']['compressed'] += strlen ( $this-&gt;content ) + $headers_len;
		$this-&gt;bytecounters['last' ]['DL']['compressed']  = strlen ( $this-&gt;content ) + $headers_len;
		fclose($fp);

		$this-&gt;lastreq_endtime = time();

		if ( in_array ( &quot;Content-Encoding: gzip\r\n&quot;, $this-&gt;headers ) ) {
			$this-&gt;content = gzinflate ( substr ( $this-&gt;content, 10 ) );  // the 10 bytes stripped are the &quot;member header&quot; of the gzip compression;
				// gzdecode() should be a cleaner implementation, parsing the header intelligiently, but is still unavailable in PHP 5.2.6.
		}
		$this-&gt;bytecounters['total']['DL']['uncompressed'] += strlen ( $this-&gt;content ) + $headers_len;
		$this-&gt;bytecounters['last' ]['DL']['uncompressed']  = strlen ( $this-&gt;content ) + $headers_len;

		if ( $this-&gt;content === false ) {
			$this-&gt;error = 'Data decompression failed';
			return false;
		}

		if ($this-&gt;is_redirect) {
			$this-&gt;make_request($this-&gt;is_redirect, $request_method,
				$content_type, $postdata);
		}
		$this-&gt;set_cookies();
		return true;
	}

	public function lastreq_time () {
		return round ( ( $this-&gt;lastreq_begtime + $this-&gt;lastreq_endtime ) / 2 );
	}

	public function reset_bytecounters () {
		$bytecounters = $this-&gt;bytecounters;
		$this-&gt;bytecounters = array (
			'total' =&gt; array (
				'DL' =&gt; array (
					'compressed'   =&gt; 0,
					'uncompressed' =&gt; 0,
				),
				'UL' =&gt; array (
					'compressed'   =&gt; 0,
					'uncompressed' =&gt; 0,
				),
			),
			'last' =&gt; array (
				'DL' =&gt; array (
					'compressed'   =&gt; 0,
					'uncompressed' =&gt; 0,
				),
				'UL' =&gt; array (
					'compressed'   =&gt; 0,
					'uncompressed' =&gt; 0,
				),
			),
		);
		return $bytecounters;
	}

	public function has_cookies_for ( $host ) {
		return (&nbsp;! empty ( $this-&gt;cookies[$host] ) );
	}

	private function delay_if_needed() {
		if ( empty ( $this-&gt;limits ) ) return;
		if (&nbsp;! is_array ( $this-&gt;limits ) ) {
			$this-&gt;limits = array ( 'total' =&gt; $this-&gt;limits, 'DL' =&gt; PHP_INT_MAX, 'UL' =&gt; PHP_INT_MAX );
		}
		$secs_total = $secs_DL = $secs_UL = 0;
		if (&nbsp;! empty ( $this-&gt;limits['total'] ) ) {
			$secs_total = ( $this-&gt;bytecounters['last']['DL']['compressed'] +
			                $this-&gt;bytecounters['last']['UL']['compressed'] ) / $this-&gt;limits['total'];
		}
		if (&nbsp;! empty ( $this-&gt;limits['DL'] ) ) {
			$secs_DL = $this-&gt;bytecounters['last']['DL']['compressed'] / $this-&gt;limits['DL'];
		}
		if (&nbsp;! empty ( $this-&gt;limits['UL'] ) ) {
			$secs_UL = $this-&gt;bytecounters['last']['UL']['compressed'] / $this-&gt;limits['UL'];
		}
		$wait_secs = max ( $secs_total, $secs_DL, $secs_UL ) + $this-&gt;lastreq_begtime - time();
		@sleep ( $wait_secs );
	}

	# read cookies from file
	private function read_cookies() {
		if (file_exists($this-&gt;cookies_file)) {
			$curr_time = time();
			$lines = file($this-&gt;cookies_file);
			foreach ($lines as $line) {
				$line = trim($line);
				if ( empty($line) ) { continue; }
				list($host, $cookie_expire, $cookie_name, $cookie_val) = explode(&quot;\t&quot;, $line);
				# add cookie if not expired
				if ($curr_time &lt; $cookie_expire) {
					$this-&gt;cookies[$host][$cookie_name] = array($cookie_val, $cookie_expire);
				}
			}
			# write not expired cookies back to file
			$cookies_str = '';
			foreach ($this-&gt;cookies as $host =&gt; $cookie_data) {
				foreach ($cookie_data as $cookie_name =&gt; $cookie_subdata) {
					$cookies_str .= &quot;$host\t$cookie_subdata[1]\t$cookie_name\t$cookie_subdata[0]\n&quot;;
				}
			}
			if (&nbsp;! empty ( $this-&gt;cookies_file ) ) {
				my_fwrite($this-&gt;cookies_file, $cookies_str, 'w');
			}
		}
	}

	# set cookies
	private function set_cookies() {
		$cookies_str = '';
		$len = count($this-&gt;headers);
		for ($i = 0; $i &lt; $len; $i++) {
			if (preg_match('/^Set-Cookie:\s+([^=]+)=([^;]+);\s+(expires=([^;]+))?/i',
					$this-&gt;headers[$i], $matches)) {
				$exp_time = isset($matches[4])&nbsp;? strtotime($matches[4])&nbsp;: time() + 60*60*24*30;
				$cookies_str .= &quot;$this-&gt;host\t$exp_time\t$matches[1]\t$matches[2]\n&quot;;
				$this-&gt;cookies[$this-&gt;host][$matches[1]] = array($matches[2], $exp_time);
				if ( $this-&gt;print_cookies ) {
					echo &quot;$matches[1] = $matches[2]; expires at &quot; . @$matches[4] .&quot;\n&quot;;
				}
			}
		}
		$cookies_str = '';
		foreach ( $this-&gt;cookies as $hostname =&gt; $cookies_host ) {
			if ( is_array ( $cookies_host ) ) {
				foreach ( $cookies_host as $name =&gt; $valuesarray ) {
					$cookies_str .= &quot;$hostname\t$valuesarray[1]\t$name\t$valuesarray[0]\n&quot;;
				}
			}
			if (&nbsp;! empty ( $this-&gt;cookies_file ) ) {
				my_fwrite($this-&gt;cookies_file, $cookies_str, 'w');
			}
		}
	}

} // end of class Browser
</pre>

<!-- 
NewPP limit report
Preprocessor node count: 4/1000000
Post-expand include size: 0/2097152 bytes
Template argument size: 0/2097152 bytes
Expensive parser function count: 0/100
-->

<!-- Saved in parser cache with key wikidb_apibot:pcache:idhash:44-0!1!0!!en!2!edit=0 and timestamp 20120916045520 -->
<div class="printfooter">
Retrieved from "<a href="http://apibot.zavinagi.org/index.php/Development_code/Browser.php">http://apibot.zavinagi.org/index.php/Development_code/Browser.php</a>"</div>
		<div id='catlinks' class='catlinks catlinks-allhidden'></div>		<!-- end content -->
				<div class="visualClear"></div>
	</div>
</div></div>
<div id="column-one">
	<div id="p-cactions" class="portlet">
		<h5>Views</h5>
		<div class="pBody">
			<ul>
				 <li id="ca-nstab-main" class="selected"><a href="/index.php/Development_code/Browser.php" title="View the content page [c]" accesskey="c">Page</a></li>
				 <li id="ca-talk" class="new"><a href="/index.php?title=Talk:Development_code/Browser.php&amp;action=edit&amp;redlink=1" title="Discussion about the content page [t]" accesskey="t">Discussion</a></li>
				 <li id="ca-viewsource"><a href="/index.php?title=Development_code/Browser.php&amp;action=edit" title="This page is protected.&#10;You can view its source [e]" accesskey="e">View source</a></li>
				 <li id="ca-history"><a href="/index.php?title=Development_code/Browser.php&amp;action=history" title="Past revisions of this page [h]" accesskey="h">History</a></li>
			</ul>
		</div>
	</div>
	<div class="portlet" id="p-personal">
		<h5>Personal tools</h5>
		<div class="pBody">
			<ul>
				<li id="pt-login"><a href="/index.php?title=Special:UserLogin&amp;returnto=Development_code/Browser.php" title="You are encouraged to log in; however, it is not mandatory [o]" accesskey="o">Log in</a></li>
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
				<li id="t-whatlinkshere"><a href="/index.php/Special:WhatLinksHere/Development_code/Browser.php" title="List of all wiki pages that link here [j]" accesskey="j">What links here</a></li>
				<li id="t-recentchangeslinked"><a href="/index.php/Special:RecentChangesLinked/Development_code/Browser.php" title="Recent changes in pages linked from this page [k]" accesskey="k">Related changes</a></li>
<li id="t-specialpages"><a href="/index.php/Special:SpecialPages" title="List of all special pages [q]" accesskey="q">Special pages</a></li>
				<li id="t-print"><a href="/index.php?title=Development_code/Browser.php&amp;printable=yes" rel="alternate" title="Printable version of this page [p]" accesskey="p">Printable version</a></li>				<li id="t-permalink"><a href="/index.php?title=Development_code/Browser.php&amp;oldid=288" title="Permanent link to this revision of the page">Permanent link</a></li>			</ul>
		</div>
	</div>
</div><!-- end of the left (by default at least) column -->
<div class="visualClear"></div>
<div id="footer">
	<div id="f-poweredbyico"><a href="http://www.mediawiki.org/"><img src="/skins/common/images/poweredby_mediawiki_88x31.png" height="31" width="88" alt="Powered by MediaWiki" /></a></div>
	<ul id="f-list">
		<li id="lastmod"> This page was last modified on 4 March 2012, at 15:59.</li>
		<li id="viewcount">This page has been accessed 1,054 times.</li>
		<li id="privacy"><a href="/index.php/Apibot:Privacy_policy" title="Apibot:Privacy policy">Privacy policy</a></li>
		<li id="about"><a href="/index.php/Apibot:About" title="Apibot:About">About Apibot</a></li>
		<li id="disclaimer"><a href="/index.php/Apibot:General_disclaimer" title="Apibot:General disclaimer">Disclaimers</a></li>
	</ul>
</div>
</div>

<script>if (window.runOnloadHook) runOnloadHook();</script>
<!-- Served in 0.243 secs. --></body></html>
