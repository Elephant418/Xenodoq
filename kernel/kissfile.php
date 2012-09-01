<?php

/* This file is part of the KissFile project.
 * KissFile is a free and unencumbered software released into the public domain.
 * For more information, please refer to <http://unlicense.org/>
 */

session_start( );


// REQUIRE
$root_path = dirname( __FILE__ );
require( $root_path . '/Page.php' );
require( $root_path . '/utils/String.php' );
require( $root_path . '/utils/Array.php' );
require( $root_path . '/utils/File.php' );


// INITIALIZATION
define( 'HTML_EOL'   , '<br>' . PHP_EOL ) ;
define( 'URI'        , rawurldecode( \UString\substr_before( $_SERVER[ 'REQUEST_URI' ], '?' ) ) );
define( 'ROOT_PATH'  , '..' );
define( 'PAGES_PATH' , ROOT_PATH . '/kernel/pages' );


// ACTIONS
if ( isset( $_GET[ 'user' ] ) ) {
	$_SESSION[ 'user' ] = $_GET[ 'user' ];
} else if ( isset( $_GET[ 'logout' ] ) ) {
	unset( $_SESSION[ 'user' ] );
}
if ( ! isset( $_SESSION[ 'user' ] ) ) {
	$page = new Page( 'login' );
} else {

	
	// USER CONTROL
	define( 'USER_PATH'  , ROOT_PATH . '/data/' . $_SESSION[ 'user' ] );
	if ( ! is_dir( USER_PATH ) ) {
		$page = new Page( 'error_500' );
	}
	define( 'DATA_PATH'  , USER_PATH . URI );


	// LOGIC :)
	if ( is_file( DATA_PATH ) ) {
		\UFile\force_download( DATA_PATH );
	} else if ( ! is_dir( DATA_PATH ) ) {
		$page = new Page( 'error_500' );
	} else {
		$page = new Page( 'list' );
	}
}

echo $page->render( );
