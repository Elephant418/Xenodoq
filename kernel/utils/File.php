<?php

/* This file is part of the KissFile project.
 * KissFile is a free and unencumbered software released into the public domain.
 * For more information, please refer to <http://unlicense.org/>
 */

namespace UFile;



/*************************************************************************
  PATH METHODS                   
 *************************************************************************/
function name( $file_path ) {
	return \UString\substr_before_last( basename( $file_path ), '.' );
}

function extension( $file_path ) {
	return \UString\substr_after_last( $file_path, '.' );
}

function list_all( $path ) {
	return glob( $path . '/*' );
}

function list_relative( $path ) {
	$files = list_all( $path );
	foreach ( $files as $key => $file ) {
		$files[ $key ] = substr( $file, strlen( $path ) );
	}
	return $files;
}

function content_type( $file_path ) {
	switch( strtolower( extension( $file_path ) ) ) {
		case 'pdf': return 'application/pdf';
		case 'exe': return 'application/octet-stream';
		case 'zip': return 'application/zip';
		case 'doc': return 'application/msword';
		case 'xls': return 'application/vnd.ms-excel';
		case 'ppt': return 'application/vnd.ms-powerpoint';
		case 'gif': return 'image/gif';
		case 'png': return 'image/png';
		case 'jpeg':
		case 'jpg': return 'image/jpg';
	}
	return 'application/force-download';
}

function force_download( $file_path ) {
	header( 'Content-Disposition: attachment; filename="' . basename( $file_path ) . '"' );
	header( 'Content-Transfer-Encoding: binary' );
	deliver( $file_path );
}

function deliver( $file_path ) {
	$content_type = content_type( $file_path );
	header( 'Pragma: public' );
	header( 'Expires: 0' );
	header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
	header( 'Cache-Control: private', false );
	header( 'Last-Modified:  ' . gmdate( 'D, d M Y H:i:s', filemtime( $file_path ) ) . ' GMT' );
	header( 'Content-Type: ' . $content_type );
	header( 'Content-Length: ' . filesize( $file_path ) );
	readfile( $file_path );
	exit( );
}
