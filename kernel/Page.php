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
		require( PAGES_PATH . '/' . $this->page_name . '.php' );
		$content = ob_get_contents();
		ob_end_clean();
		ob_start();		
		require( KERNEL_PATH . '/layout.php' );
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
}
