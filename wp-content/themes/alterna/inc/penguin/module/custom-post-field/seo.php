<?php 
	/**
	Penguin Framework Module - SEO
	
	Copyright (c) 2012 Activetofocus

	@url http://penguin.activetofocus.com
	@package Penguin
	@version 1.0
**/

require_once("custom-post-field.php");

class PenguinModuleSEO extends PenguinModuleCustomPostField{
	
	
	public $id = "penguin_seo";

	public $items;
	
	/**
	 *  create PenguinModuleSEO for "blog,post,page,custom post"
	 */
	function PenguinModuleSEO($items = array()){
		parent::__construct("penguin_seo",$items,array( array('name'=>'seo-title','title'=>'Browser Title:'),
														array('name'=>'seo-description','title'=>'Description:'),
														array('name'=>'seo-keywords','title'=>'Keywords:')
												));
	}
}

?>