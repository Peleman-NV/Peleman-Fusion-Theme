<?php

//	Add location for navigation menus
	add_action( 'init', 'register_my_menus' );
	function register_my_menus() {
		register_nav_menus(
			array(
		  		'header-menu' => __( 'Header Menu', 'peleman-fusion' ),
			)
		);
	}
