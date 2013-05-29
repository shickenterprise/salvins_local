<?php

/**
	Penguin Framework

	Copyright (c) 2012 Activetofocus

	@url http://penguin.activetofocus.com
	@package Penguin
	@version 1.0
**/


class PenguinPost {
	
	public $posts;
	
	function PenguinPost($posts = array()){
		
		$this->posts = $posts;
		
		$this->create_post_type();
	}
	
	function create_post_type() {
		
		foreach($this->posts as $key =>$value)
		{
			switch($key){
				case "posts":
					$this->ex_custom_posts($value);
					break;
				case "fields":
					$this->ex_custom_fields($value);
					break;
			}
		}
		
	}
	
	// custom post init
	function ex_custom_posts($posts){
		foreach($posts as $key =>$value)
		{
			switch($key)
			{
				case "portfolio":
					require_once("module/custom-post/portfolio.php");
					new PenguinModulePortfolioPost();
					break;
				case "team":
					require_once("module/custom-post/team.php");
					new PenguinModuleTeamPost();
					break;
				case "slide":
					require_once("module/custom-post/slide.php");
					new PenguinModuleSlidePost();
					break;
				case "news":
					require_once("module/custom-post/news.php");
					new PenguinModuleNewsPost();
					break;
				case "services":
					require_once("module/custom-post/services.php");
					new PenguinModuleServicesPost();
					break;
			}
		}
	}
	
	// custom post field init
	function ex_custom_fields($fields){
		foreach($fields as $key =>$value)
		{
			switch($key)
			{
				case "seo":
					require_once("module/custom-post-field/seo.php");
					new PenguinModuleSEO($value);
					break;
				case "featured":
					require_once("module/custom-post-field/featured.php");
					new PenguinModuleFeatured($value);
					break;
				case "thumbnails":
					require_once("module/custom-post-field/thumbnails.php");
					new PenguinModuleThumbnails($value);
					break;
				case "customfield": //array
					require_once("module/custom-post-field/custom-post-field.php");
					foreach($value as $element){
						new PenguinModuleCustomPostField($element['id'],$element['items'],$element['fields']);
					}
					break;
			}
		}
	}
}


?>