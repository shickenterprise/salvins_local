<?php 
	/**
	Penguin Framework Module - Portfolio Post
	
	Copyright (c) 2012 Activetofocus

	@url http://penguin.activetofocus.com
	@package Penguin
	@version 1.0
**/


class PenguinModulePortfolioPost {
	
	public $id = "portfolio";
	
	/**
	 *  PenguinModulePortfolioPost
	 */
	function PenguinModulePortfolioPost() {
		add_action( 'init', array($this,'portfolio_register') );
	}
	
	// Register portfolio
	function portfolio_register(){
	  $labels = array(
		'name' => _x('Portfolios', 'post type general name','alterna'),
		'singular_name' => _x('Portfolios', 'post type singular name','alterna'),
		'add_new' => _x('Add New', 'Portfolios','alterna'),
		'add_new_item' => __('Add New','alterna'),
		'edit_item' => __('Edit Portfolio','alterna'),
		'new_item' => __('New Portfolio','alterna'),
		'all_items' => __('All Portfolios','alterna'),
		'view_item' => __('View Portfolios','alterna'),
		'search_items' => __('Search Portfolio','alterna'),
		'not_found' =>  __('No portfolio found','alterna'),
		'not_found_in_trash' => __('No portfolio found in Trash','alterna'), 
		'parent_item_colon' => '',
		'menu_name' => 'Portfolios'
	  );
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array('slug'=>$this->id,'with_front'=>false),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position'	=> 6,
		'menu_icon' => get_template_directory_uri().'/'.Penguin::$FRAMEWORK_PATH.'/images/portfolio_type.png',
		'supports' => array( 'title', 'editor' , 'thumbnail' )
	  ); 
	  register_post_type($this->id,$args);
	  
		$this->register_categories();
	}
	
	//Register Portfolio categories
	function register_categories(){
		$labels = array(
			'name' => _x( 'Portfolio Categories', 'taxonomy general name' ,'alterna'),
			'singular_name' => _x( 'Portfolio Category', 'taxonomy singular name' ,'alterna'),
			'search_items' =>  __( 'Search Portfolio Categories' ,'alterna'),
			'all_items' => __( 'All Portfolio Categories' ,'alterna'),
			'parent_item' => __( 'Parent Category' ,'alterna'),
			'parent_item_colon' => __( 'Parent Category:' ,'alterna'),
			'edit_item' => __( 'Edit Portfolio Category' ,'alterna'), 
			'update_item' => __( 'Update Portfolio Category' ,'alterna'),
			'add_new_item' => __( 'Add Portfolio Category' ,'alterna'),
			'new_item_name' => __( 'New Portfolio Category' ,'alterna'),
			'menu_name' => __( 'Portfolio Categories' ,'alterna')
		  ); 
		
		register_taxonomy($this->id.'_categories',array($this->id), array(
			'hierarchical' => true,
			'labels' => $labels,
			'label_sing'		=> __( 'Portfolio Category','alterna'),
			'public'			=> true,
			'show_in_nav_menus'	=> true,
		 ));

	}
	
}
?>