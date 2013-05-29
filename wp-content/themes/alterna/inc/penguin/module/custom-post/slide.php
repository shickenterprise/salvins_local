<?php 
	/**
	Penguin Framework Module - Slide Post
	
	Copyright (c) 2012 Activetofocus

	@url http://penguin.activetofocus.com
	@package Penguin
	@version 1.0
**/

class PenguinModuleSlidePost {
	
	public $id = "slide";
	
	/**
	 *  PenguinModuleSlidePost
	 */
	function PenguinModuleSlidePost() {
		add_action( 'init', array($this,'slide_register') );
	}
	
	// Register slide
	function slide_register(){
	  $labels = array(
		'name' => _x('slide', 'post type general name','alterna'),
		'singular_name' => _x('Slides', 'post type singular name','alterna'),
		'add_new' => _x('Add New', 'slide','alterna'),
		'add_new_item' => __('Add New Slide','alterna'),
		'edit_item' => __('Edit slide','alterna'),
		'new_item' => __('New slide','alterna'),
		'all_items' => __('All slide','alterna'),
		'view_item' => __('View slide','alterna'),
		'search_items' => __('Search slide','alterna'),
		'not_found' =>  __('No slide found','alterna'),
		'not_found_in_trash' => __('No slide found in Trash','alterna'), 
		'parent_item_colon' => '',
		'menu_name' => 'Slides'
	
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
		'supports' => array( 'title' , 'editor')
	  ); 
	  register_post_type($this->id,$args);
	  
	}
	
}

?>