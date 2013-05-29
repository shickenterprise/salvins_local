<?php 
	/**
	Penguin Framework Module - Thumbnails Position
	
	Copyright (c) 2012 Activetofocus

	@url http://penguin.activetofocus.com
	@package Penguin
	@version 1.0
**/

require_once("custom-post-field.php");

class PenguinModuleThumbnails extends PenguinModuleCustomPostField{
	
	/**
	 *  PenguinModuleThumbnails
	 */
	function PenguinModuleThumbnails($items = array()) {
		parent::__construct("postimagediv",$items);
	}
	
	// rechange thumbnails position of admin
	function custom_fields(){
		foreach($this->items as $item){
			remove_meta_box('postimagediv', $item['type'], 'side');
			add_meta_box('postimagediv', $item['title'], 'post_thumbnail_meta_box', $item['type'] , 'side', 'high');
		}
	}
}

?>