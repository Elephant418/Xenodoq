<?php

/* This file is part of the KissFile project.
 * KissFile is a free and unencumbered software released into the public domain.
 * For more information, please refer to <http://unlicense.org/>
 */

session_start( );


// REQUIRE
$root_path = dirname( __FILE__ );
require( $root_path . '/User.php' );
require( $root_path . '/Page.php' );
require( $root_path . '/Notification.php' );
require( $root_path . '/utils/String.php' );
require( $root_path . '/utils/Array.php' );
require( $root_path . '/utils/File.php' );


// INITIALIZATION
define( 'HTML_EOL'   , '<br>' . PHP_EOL ) ;
define( 'URI'        , rawurldecode( \UString\substr_before( $_SERVER[ 'REQUEST_URI' ], '?' ) ) );
define( 'ROOT_PATH'  , '..' );
define( 'DATA_PATH'  , ROOT_PATH . '/data' );
define( 'KERNEL_PATH', ROOT_PATH . '/kernel' );
define( 'PAGES_PATH' , KERNEL_PATH . '/pages' );


// LOGIC :)
$user = new User;
$user->initialize( );
if ( ! $user->is_logged( ) ) {
	$page = new Page( 'login' );
} else {
	if ( is_file( User::$data_path ) ) {
		\UFile\force_download( User::$data_path );
	} else if ( ! is_dir( User::$data_path ) ) {
		$page = new Page( 'error' );
	} else {
		$page = new Page( 'list' );
	}
}
echo $page->render( );
