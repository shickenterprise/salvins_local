<?php

/**
	Penguin Framework

	Copyright (c) 2012 Activetofocus

	@url http://penguin.activetofocus.com
	@package Penguin
	@version 1.1
**/

require_once("penguin-option.php");
require_once("penguin-post.php");

class Penguin {
	
	static $FRAMEWORK_PATH = "";
	static $FRAMEWORK_VERSION = "1.1";
	static $THEME_NAME = "";


	/**
	 * @$FRAMEWORK_PATH		penguin framework files path 
	 * @$options			add your option for admin panel
	 * @$posts				add your post page for admin panel
	 * @$update 			check theme version for update
	 */
	static function start($options = array(), $posts = array()){
		if(count($options) > 0) new PenguinOption($options);
		if(count($posts) > 0) new PenguinPost($posts);
	}
	
	/* 
	 * Check key value in array
	 */
	static function check_key_value($key,$array,$default=''){
		if(isset($array[$key])) return $array[$key];
		return $default;
	}
}

?>