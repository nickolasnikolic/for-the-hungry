<?php
//quick'n'dirty report of db contents
//ideally, this file won't exist, or rather, not be accessible except through ssl

if( $_GET[ 'catchya' ] == 'later' && $_GET[ 'sneaky' ] == 'pete' ) $dbhandle = sqlite_open( 'vote.db', 0666, $error );
else die( "<p>Sneaky you; if you have to spend your time trying to futz with a service for the poor, I would suggest <a href='http://www.gop.com'>the republican national committee site...</a></p>" );

if( !$dbhandle ) die( $error );
    
$query = "SELECT PrimaryTown, HomeTown FROM Towns";
$result = sqlite_query($dbhandle, $query);
if ( !$result ) die("Cannot execute query.");

$result = sqlite_fetch_all( $result, SQLITE_ASSOC );

foreach( $result as $entry ){
    echo '<p>Vote for CURRENT TOWN: ' .
			htmlspecialchars( urldecode( $entry['PrimaryTown'] ) ) . 
		 ' AND HOMETOWN: ' .
		 	htmlspecialchars( urldecode( $entry['HomeTown'] ) ) .
		 '</p>';
}

sqlite_close( $dbhandle );
?>