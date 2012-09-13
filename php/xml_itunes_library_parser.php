<?php
	$filename = "iTunes Music Library.xml";		// name of the xml itunes library file
	$filepath = "../xml/" . $filename;			// filepath to the xml file
	
	$dataarray = array();						// array for uploading to database
	$entryarray = array(
			"name"			=>	"",
			"artist"		=>	"",
			"composer"		=>	"",
			"album"			=>	"",
			"genre"			=>	"",
			"year"			=>	"" );			// array for each song's entry
	
	$nexttype = "";								// aligns each key with the value (compensating for iTunes XML)
	
	// create a mysqli object and connect to the database, also catch errors
	$mysqli = new mysqli('localhost', 'root', 'root', 'globalistener');
	mysqli_connect( $mysqli );
	
	if ($mysqli->connect_error)
	{
		die('Connect Error (' . $mysqli->connect_errno . ') '
				. $mysqli->connect_error);
	}
	
	// this function takes in an array, the table name, and the database link
	// and turns an entry, which is an array, into a row in the table
	function store_array( &$data, $table, $mysqli )
	{
		$cols = implode( ',', array_keys( $data ) );
		
		foreach( array_values( $data ) as $value )
		{
			isset( $vals ) ? $vals .= ',' : $vals = '';
			$vals .= '\'' . mysqli_real_escape_string( $mysqli, $value ) . '\'';
		}
		
		if( !mysqli_query( $mysqli,
			'INSERT INTO ' . $table . ' (' . $cols . ') VALUES (' . $vals . ')' ) )
		{
			die( "Couldn't add entries to the database" );
		}
	}
	
	// this is a handler for the contents of the xml parser
	function contents( $parser, $data )
	{
		global $dataarray;
		global $entryarray;
		global $tempartist;
		global $nexttype;
		
		if( $nexttype !== "" )
		{
			// if the type is not "year," add the data to the entry array
			// otherwise, add year as an integer to the entry array
			// then add the entry to the data array
			if( $nexttype != "year" )
			{
				$entryarray[$nexttype] = $data;
			}
			else
			{
				$entryarray[$nexttype] = (int) $data;
				array_push( $dataarray, $entryarray );
			}
		}
		
		// this switches the contents because iTunes puts what type of information follows
		// in the contents of the tag before it.  This is why $nexttype is needed
		switch( $data )
		{
			case "Name":
				$nexttype = "name";
				break;
			case "Artist":
				$nexttype = "artist";
				break;
			case "Composer":
				$nexttype = "composer";
				break;
			case "Album":
				$nexttype = "album";
				break;
			case "Genre":
				$nexttype = "genre";
				break;
			case "Year":
				$nexttype = "year";
				break;
			default:
				$nexttype = "";
		}
		
	}
	
	// creates the parser and links the handler to the contents function
	$parser = xml_parser_create();
	xml_set_character_data_handler($parser, "contents");
	
	// finds the XML file and gets the contents to a string
	$fp = fopen($filepath, "r"); 
	$data = file_get_contents( $filepath );
	
	// parses the XML and error checks
	if( !( xml_parse( $parser, $data, feof( $fp ) ) ) )
	{ 
		die("Error on line " . xml_get_current_line_number( $parser ) ); 
	}
	
	// cycles through each entry and calls store_array to make it a row in the database
	foreach( $dataarray as $trackentry )
	{
		store_array( $trackentry, "tracks", $mysqli );
	}
	
	// free the parser, clear $data, and close the file
	xml_parser_free( $parser );
	$data = "";
	fclose($fp);
?>