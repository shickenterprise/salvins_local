<?php 
	/**
	Penguin Framework Module - SEO
	
	Copyright (c) 2012 Activetofocus

	@url http://penguin.activetofocus.com
	@package Penguin
	@version 1.0
**/

require_once("custom-post-field.php");

class PenguinModuleFeatured extends PenguinModuleCustomPostField {
	
	
	
	/**
	 *  create PenguinModuleFeatured for "blog,post,page,custom post"
	 */
	function PenguinModuleFeatured($items){
		parent::__construct("penguin_featured",$items,array(
														'featured'=> array('name'=>'featured',
																			'title'=>'Featured:',
																			'type'=>'checkbox',
																			'desc'=>'Check as Featured!')));
		
	}

}

?>