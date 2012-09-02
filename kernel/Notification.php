<?php

/* This file is part of the KissFile project.
 * KissFile is a free and unencumbered software released into the public domain.
 * For more information, please refer to <http://unlicense.org/>
 */

class Notification implements \Serializable {


	/*************************************************************************
	 CONSTANTS
	 *************************************************************************/
	const NOTICE	= 'notice';
	const SUCCESS   = 'success';
	const ERROR	= 'error';
	const EXCEPTION = 'exception';


	/*************************************************************************
	 ATTRIBUTES
	 *************************************************************************/
	public $message;
	public $level;


	/*************************************************************************
	  CONSTRUCTOR				   
	 *************************************************************************/
	public function __construct( $message, $level = self::NOTICE ) {
		$this->message = $message;
		$this->level = $level;
	}


	/*************************************************************************
	  PUBLIC METHODS
	 *************************************************************************/
	public function __toString( ) {
		return $this->message;
	}


	/*************************************************************************
	  PUBLIC METHODS
	 *************************************************************************/
	public function serialize( ) {
		return serialize(  );
	}
	public function unserialize( $data ) {
		list( $this->message,  $this->level ) = unserialize( $data );
	}


	/*************************************************************************
	  STATIC METHODS				   
	 *************************************************************************/
	public static function push( $message, $level = self::NOTICE ) {
		if ( is_object( $message ) ) {
			$level = $message->level;
			$message = $message->message;
		}
		if ( ! isset( $_SESSION[ 'notification' ] ) ) {
			$_SESSION[ 'notification' ] = [ ];
		}
		$_SESSION[ 'notification' ][ ] = [ $message,  $level ];
	}
	public static function pull( $levels = NULL ) {
		if ( isset( $_SESSION[ 'notification' ] ) ) {
			$notifications = $_SESSION[ 'notification' ];
			unset( $_SESSION[ 'notification' ] );
		} else {
			$notifications = [ ];
		}

		if ( ! is_null( $levels ) ) {	
			\Supersoniq\must_be_array( $levels );	
		}

		foreach ( $notifications as $key => $notification ) {
			$notification = new \Notification( $notification[ 0 ], $notification[ 1 ] );
			$notifications[ $key ] = $notification;
			if ( ! is_null( $levels ) && ! in_array( $notification->level, $levels ) ) {
				unset( $notifications[ $key ] );
			}
		}

		return $notifications;
	}
}
