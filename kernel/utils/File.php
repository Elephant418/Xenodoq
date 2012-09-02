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
	$file_name = basename( $file_path );
	return \UString\substr_before( $file_name, '.' );
}

function extension( $file_path ) {
	$name = basename( $file_path );
	if ( ! \UString\contains( $name, '.' ) ) {
		return '';
	}
	return \UString\substr_after_last( $name, '.' );
}

function list_folder( $path ) {
	\UString\must_not_ends_with( $path, '/' );
	return glob( $path . '/*' );
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

function type( $file_path ) {
	switch( strtolower( extension( $file_path ) ) ) {
		case ''    : return 'folder';
		case 'rar' : 
		case 'tar' : 
		case 'tgz' : 
		case 'zip' : 
		case 'gz'  : 
		case 'bz2' : 
		case 'cab' :
		case '7z'  : return 'archive';
		case 'wav' : 
		case 'wma' : 
		case 'mp3' : 
		case 'mp4' : return 'video'; // 'audio';
		case 'xml' : 
		case 'css' : return 'file'; // 'code';
		case 'sql' : return 'file'; // 'database';
		case 'bmp' : 
		case 'xcf' : 
		case 'psd' : 
		case 'png' : 
		case 'jpg' : 
		case 'jpeg': 
		case 'gif' : return 'image';
		case 'pdf' : return 'pdf';
		case 'xls' : 
		case 'pps' : 
		case 'ppsx': 
		case 'ppt' : 
		case 'odp' : 
		case 'pptx': return 'file'; // 'presentation';
		case 'xls' : 
		case 'xlsx': 
		case 'ods' : return 'file'; // 'spreadsheet';
		case 'txt' : 
		case 'odt' : 
		case 'doc' : 
		case 'docx': return 'textdocument';
		case 'odg' : return 'file'; // 'vectorgraphics';
		case 'wmv' : 
		case 'mpeg': 
		case 'mpg' : 
		case 'mov' : 
		case 'avi' : return 'video';
		case 'htm' : 
		case 'html': return 'file'; // 'webpage';
	}
	return 'file';
}

function format_size( $file_path ) {
	$sizes = array( 'o', 'Ko', 'Mo', 'Go', 'To', 'Po', 'Eo' );
	$i = 1;
	$size = filesize( $file_path );
	while ( $i < count( $sizes ) && ( $size >= 1024 ) ) {
		$size = $size / 1024;
		$i++;
	}
	return round( $size, 2 ) . ' ' . $sizes[ $i - 1 ];
}
