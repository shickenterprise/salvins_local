<?php 
	/**
	Penguin Framework Module - Team Post
	
	Copyright (c) 2012 Activetofocus

	@url http://penguin.activetofocus.com
	@package Penguin
	@version 1.0
**/

class PenguinModuleTeamPost {
	
	public $id = "team";
	
	/**
	 *  PenguinModuleTeamPost
	 */
	function PenguinModuleTeamPost() {
		add_action( 'init', array($this,'team_register') );
	}
	
	// Register team
	function team_register(){
	  $labels = array(
		'name' => _x('team', 'post type general name','alterna'),
		'singular_name' => _x('Team', 'post type singular name','alterna'),
		'add_new' => _x('Add Member', 'team','alterna'),
		'add_new_item' => __('Add New Member','alterna'),
		'edit_item' => __('Edit team','alterna'),
		'new_item' => __('New team','alterna'),
		'all_items' => __('All team','alterna'),
		'view_item' => __('View team','alterna'),
		'search_items' => __('Search team','alterna'),
		'not_found' =>  __('No member found','alterna'),
		'not_found_in_trash' => __('No member found in Trash','alterna'), 
		'parent_item_colon' => '',
		'menu_name' => 'Team'
	
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