<?php

include( '../kernel/include.php' );

// INITIALIZATION
define( 'HTML_EOL' , '<br>' . PHP_EOL ) ;
define( 'URI'      , rawurldecode( \UString\substr_before( $_SERVER[ 'REQUEST_URI' ], '?' ) ) );
define( 'DATA_PATH', '../data/' . 'client1' );

$file_path = DATA_PATH . URI;
if ( is_file( $file_path ) ) {
	\UFile\force_download( $file_path );
} else {
	$files = \UFile\list_relative( DATA_PATH );
	echo $file_path . HTML_EOL;
	echo '<ul>';
	foreach ( $files as $file ) {
		echo '<li><a href="' . $file . '">' . \UFile\name( $file ) . '</a></li>';
	}
	echo '</ul>';
	
}

?>
