<?php
//pull vars from the url
$temp1	 	= $_GET[	'votePrimary'	];
$temp2 		= $_GET[	'voteHomeTown'	];
$temp3		= $_GET[	'uid'			];
$debug		= $_GET[	'debug'			];

//strip unweildy chars
$primaryLivingQuarters 	= sqlite_escape_string( $temp1 );
$originalHomeTown  		= sqlite_escape_string( $temp2 );
$uid  					= sqlite_escape_string( $temp3 );

//if we have a uid we know this is a facebook user...
if( !empty( $uid ) ){
	
	if( !empty( $debug ) && $debug == "tulip" ){
		echo "The current vars are:<br />";
		echo $primaryLivingQuarters . "<br />";
		echo $originalHomeTown . "<br />";
		echo $uid . "<br />";
		die();
	}
	
	$dbhandle = sqlite_open('db/vote.db', 0666, $error);
	
	if( !$dbhandle ) die( $error );
	
	$setValues = "INSERT INTO Towns(PrimaryTown, HomeTown, uid) VALUES('" . $primaryLivingQuarters . "', '" . $originalHomeTown . "', '" . $uid . "')";
	$ok = sqlite_exec($dbhandle, $setValues, $error);
	
	if (!$ok) die("Error: $error");
	
	//send back some fun JSON that looks more impressive then it is ;-)
	if( empty( $debug ) ){ 
		echo json_encode( array( 'status' => 'OK' ) );
	}		
}
?>