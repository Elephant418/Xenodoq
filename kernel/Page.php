<?php

/* This file is part of the KissFile project.
 * KissFile is a free and unencumbered software released into the public domain.
 * For more information, please refer to <http://unlicense.org/>
 */

class Page {



	/*************************************************************************
	 ATTRIBUTES
	 *************************************************************************/
	public $page_name;



	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
	public function __construct( $page_name ) {
		$this->page_name = $page_name;
	}



	/*************************************************************************
	  RENDER METHODS                   
	 *************************************************************************/
	public function render( ) {
		$title = 'Title';
		ob_start();		
		require( $this->find_file( $this->page_name ) );
		$content = ob_get_contents();
		ob_end_clean();
		ob_start();		
		require( $this->find_file( 'layout' ) );
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
	public function find_file( $page_name ) {
		$custom_file = CUSTOM_PAGES_PATH . '/' . $page_name . '.php';
		if ( is_file( $custom_file ) ) {
			return $custom_file;
		}
		return PAGES_PATH . '/' . $page_name . '.php';
	}
}
