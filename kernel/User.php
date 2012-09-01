<?php

/* This file is part of the KissFile project.
 * KissFile is a free and unencumbered software released into the public domain.
 * For more information, please refer to <http://unlicense.org/>
 */

class User {



	/*************************************************************************
	 ATTRIBUTES
	 *************************************************************************/
	static public $name;
	static public $root_path;
	static public $data_path;



	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
	public function initialize( ) {
		if ( isset( $_GET[ 'user' ] ) ) {
			$users = parse_ini_file( DATA_PATH . '/users.ini' );
			if ( 
				isset( $users[ $_GET[ 'user' ] ] ) && 
				$users[ $_GET[ 'user' ] ] == $_GET[ 'password' ]
			) {
				$_SESSION[ 'user' ] = $_GET[ 'user' ];
			} else {
				echo 'Mauvais identifiants' . HTML_EOL;
			}
		} else if ( isset( $_GET[ 'logout' ] ) ) {
			echo 'Déconnexion' . HTML_EOL;
			unset( $_SESSION[ 'user' ] );
		}
		if ( isset( $_SESSION[ 'user' ] ) ) {
			self::$name = $_GET[ 'user' ];
			self::$root_path = DATA_PATH . '/' . self::$name;
			if ( ! is_dir( self::$root_path ) ) {
				echo 'Erreur interne : no data' . HTML_EOL;
				self::$name = NULL;
			}
			self::$data_path = self::$root_path . URI;
		}
	}



	/*************************************************************************
	  PUBLIC METHODS                   
	 *************************************************************************/
	public function is_logged( ) {
		return ( ! is_null( self::$name ) );
	}
}
