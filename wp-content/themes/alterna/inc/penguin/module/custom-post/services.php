<?php 
	/**
	Penguin Framework Module - Services Post
	
	Copyright (c) 2012 Activetofocus

	@url http://penguin.activetofocus.com
	@package Penguin
	@version 1.0
**/

class PenguinModuleServicesPost {
	
	public $id = "services";
	
	/**
	 *  PenguinModuleServicesPost
	 */
	function PenguinModuleServicesPost() {
		add_action( 'init', array($this,'services_register') );
	}
	
	// Register services
	function services_register(){
	  $labels = array(
		'name' => _x('services', 'post type general name','alterna'),
		'singular_name' => _x('Services', 'post type singular name','alterna'),
		'add_new' => _x('Add New', 'services','alterna'),
		'add_new_item' => __('Add Services','alterna'),
		'edit_item' => __('Edit services','alterna'),
		'new_item' => __('New services','alterna'),
		'all_items' => __('All services','alterna'),
		'view_item' => __('View services','alterna'),
		'search_items' => __('Search services','alterna'),
		'not_found' =>  __('No services found','alterna'),
		'not_found_in_trash' => __('No services found in Trash','alterna'), 
		'parent_item_colon' => '',
		'menu_name' => 'Services'
	
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
		'supports' => array( 'title', 'editor' )
	  ); 
	  register_post_type($this->id,$args);
	  
	}
	
}

?>