<?php
	$filename = "iTunes Music Library.xml";
	$filepath = "../xml/" . $filename;
	$index = array();
	$vals = array();
	$start_tracks = "<key>Tracks</key>";
	
	$mysqli = new mysqli();
	
	$dataarray = array(
			"name"	=>	array(),
			"artist"		=>	array(),
			"composer"		=>	array(),
			"album"			=>	array(),
			"genre"			=>	array(),
			"year"			=>	array() );
	
	$nexttype = "";
	
	function store_array( &$data, $table, $mysqli )
	{
		$cols = implode( ',', array_keys( $data ) );
		
		foreach( array_values( $data ) as $value )
		{
			isset( $vals ) ? $vals .= ',' : $vals = '';
			$vals .= '\'' . $this->mysql->real_escape_string($value) . '\'';
		}
		
		$mysqli->real_query('INSERT INTO '.$table.' ('.$cols.') VALUES ('.$vals.')');
	}
	
	function contents( $parser, $data )
	{
		global $dataarray;
		global $tempartist;
		global $nexttype;
		
		if( $nexttype !== "" )
		{
			if( $nexttype != "year" )
			{
				array_push( $dataarray[$nexttype], $data );
			}
			else
			{
				array_push( $dataarray[$nexttype], (int) $data );
			}
		}
		
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
	
	$parser = xml_parser_create();

	xml_set_character_data_handler($parser, "contents");
	
	$fp = fopen($filepath, "r"); 
	
	$data = file_get_contents( $filepath );
	
	if( !( xml_parse( $parser, $data, feof( $fp ) ) ) )
	{ 
		die("Error on line " . xml_get_current_line_number( $parser ) ); 
	}
	
	store_array( $dataarray, "tracks", $mysqli );
	
//	echo "End of process line number: " . xml_get_current_line_number( $parser ) . "<br />";
	
	xml_parser_free( $parser );
	$data = "";
	fclose($fp);
	
	var_dump( $dataarray );
	
?>