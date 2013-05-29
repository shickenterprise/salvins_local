<?php 
	/**
	Penguin Framework Module - News Post
	
	Copyright (c) 2012 Activetofocus

	@url http://penguin.activetofocus.com
	@package Penguin
	@version 1.0
**/

class PenguinModuleNewsPost {
	
	public $id = "news";
	
	/**
	 *  PenguinModuleNewsPost
	 */
	function PenguinModuleNewsPost() {
		add_action( 'init', array($this,'news_register') );
	}
	
	// Register news
	function news_register(){
	  $labels = array(
		'name' => _x('news', 'post type general name','alterna'),
		'singular_name' => _x('News', 'post type singular name','alterna'),
		'add_new' => _x('Add New', 'news','alterna'),
		'add_new_item' => __('Add News','alterna'),
		'edit_item' => __('Edit news','alterna'),
		'new_item' => __('New news','alterna'),
		'all_items' => __('All news','alterna'),
		'view_item' => __('View news','alterna'),
		'search_items' => __('Search news','alterna'),
		'not_found' =>  __('No news found','alterna'),
		'not_found_in_trash' => __('No news found in Trash','alterna'), 
		'parent_item_colon' => '',
		'menu_name' => 'News'
	
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