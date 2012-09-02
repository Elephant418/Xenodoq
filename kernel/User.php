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
		if ( ! isset( $_SESSION[ 'user' ] ) && isset( $_POST[ 'user' ] ) ) {
			$users = parse_ini_file( SETTING_PATH . '/users.ini' );
			if ( 
				isset( $users[ $_POST[ 'user' ] ] ) && 
				$users[ $_POST[ 'user' ] ] == sha1( $_POST[ 'password' ] )
			) {
				$_SESSION[ 'user' ] = $_POST[ 'user' ];
				Notification::push( 'Connexion' );
			} else {
				Notification::push( 'Mauvais identifiants', Notification::ERROR );
			}
		}
		if ( isset( $_SESSION[ 'user' ] ) ) {
			if ( isset( $_GET[ 'logout' ] ) ) {
				Notification::push( 'Déconnexion' );
				unset( $_SESSION[ 'user' ] );
				header( 'Location: /' );
				exit( );
			}
			self::$name = $_SESSION[ 'user' ];
			self::$root_path = DATA_PATH . '/' . self::$name;
			if ( ! is_dir( self::$root_path ) ) {
				Notification::push( 'Erreur interne : no data this user', Notification::ERROR );
				self::$name = NULL;
			}
			self::$data_path = self::$root_path . URI;
		}
	}



	/*************************************************************************
	  PUBLIC METHODS                   
	 *************************************************************************/
	static public function is_logged( ) {
		return ( ! is_null( self::$name ) );
	}
}
