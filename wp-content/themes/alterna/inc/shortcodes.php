<?php

/**
 * Add shortcode button
 */
function alterna_addbuttons() {
   // Don't bother doing this stuff if the current user lacks permissions
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
   // Add only in Rich Editor mode
   if ( get_user_option('rich_editing') == 'true') {
     add_filter("mce_external_plugins", "add_alterna_tinymce_plugin");
     add_filter('mce_buttons', 'register_alterna_button');
   }
}
 
function register_alterna_button($buttons) {
   array_push($buttons, "separator", "alterna");
   return $buttons;
}
 
// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function add_alterna_tinymce_plugin($plugin_array) {
   $plugin_array['alterna'] = get_template_directory_uri().'/js/shortcode.button.js';
   return $plugin_array;
}
 
// init process for button control
add_action('init', 'alterna_addbuttons');

//=============================
// Header Alert Message
//=============================
function alterna_headeralert_func($atts, $content = null){
	global $alterna_headeralert_items;
	$alterna_headeralert_item = array();
	do_shortcode($content);
	$count = count($alterna_headeralert_items);
	$output = '';
	if($count > 0){
		foreach($alterna_headeralert_items as $alterna_headeralert_item){
			$output .= $alterna_headeralert_item;
			if($count != 1) $output .= '<div class="header-information-element header-information-line">|</div>';
			$count--;
		}
	}
	
	return $output;
}
add_shortcode('headeralert', 'alterna_headeralert_func');

function alterna_headeralert_item_func($atts, $content = null){
	global $alterna_headeralert_items;
	
	$alterna_headeralert_items[] = '<div class="header-information-element">'.do_shortcode($content).'</div>';
	
	return $alterna_headeralert_items;
}
add_shortcode('headeralert_item', 'alterna_headeralert_item_func');

//=============================
// Title
//=============================
function alterna_title_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'text'	=> '',
		  'size' => 'h3',
		  'line' => 'true',
		  'icon' => '',
		  'align'	=> ''
		  ), $atts ) );
	$title_content = '<'.$size.' '.($align !='' ? 'style="text-align:'.$align.';"' : "").'>'.($icon != '' ? '<i class="'.$icon.'"></i>' : '' ).$text.'</'.$size.'>';
	if($line == 'true') 
		$line = '<div class="line"></div>';
	else
		$line = '';
	
	return '<div class="alterna-title row-fluid">'.$title_content.$line.'</div>';
}
add_shortcode('title', 'alterna_title_func');

//=============================
// Icons
//=============================
function alterna_icon_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'icon_name' => '',
		  'icon_size' => '',
		  'icon_style' => '',
		  'icon_color' => ''
		  ), $atts ) );
	if($icon_name == '') return '';
	return '<i class="'.$icon_name.' '.$icon_size.' '.$icon_style.'" '.($icon_color != '' ? ' style="color:'.$icon_color.'"' :'').'></i>';
}
add_shortcode('icon', 'alterna_icon_func');

//=============================
// Social
//=============================
function alterna_social_func($atts, $content = null){
	global $alterna_icon_items, $alterna_icon_default_color, $alterna_icon_default_params;
	$alterna_icon_items = array();
	extract( shortcode_atts( array(
			'bg_color' => '',
			'tooltip' => 'no',
			'tooltip_placement' => 'top'
		  ), $atts ) );
	
	$alterna_icon_default_color = $bg_color;
	$alterna_icon_default_params = array('tooltip' => $tooltip, 'placement' => $tooltip_placement);
	
	$output = '<ul class="inline alterna-social">';
	do_shortcode($content);
	
	if(count($alterna_icon_items) > 0) {
		foreach($alterna_icon_items as $alterna_icon_item) {
			$output .= '<li>'.$alterna_icon_item.'</li>';
		}
	}
	
	$output .= '</ul>';
	
	return $output;
}

add_shortcode('social', 'alterna_social_func');

function alterna_social_item_func($atts, $content = null){
	global $alterna_icon_items, $alterna_icon_default_color, $alterna_icon_default_params;
	
	extract( shortcode_atts( array(
			'type' => 'twitter',
			'link' => '#',
			'target' => '_blank',
			'title' => ''
		  ), $atts ) );
	
	if($alterna_icon_default_params['tooltip'] == "yes" && $title == ""){
		$title = $type;
	}
	
	$alterna_icon_items[] = '<a '.($alterna_icon_default_color != "" ? 'style="background-color:'.$alterna_icon_default_color.'"' : '').' href="'.$link.'" target="'.$target.'" '.($alterna_icon_default_params['tooltip'] == "yes" ? 'title="'.$title.'" data-placement="'.$alterna_icon_default_params['placement'].'"' : '').' class="alterna-icon-'.$type.' '.($alterna_icon_default_params['tooltip'] == "yes" ? "show-tooltip" : "").'"></a>';
	return $alterna_icon_items;
}
add_shortcode('social_item', 'alterna_social_item_func');

//=============================
// Map
//=============================
function alterna_map_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'id' => '',
		  'zoom'	=> '13',
		  'scrollwheel' => 'yes',
		  'draggable'	=> 'yes',
		  'latlng' => '',
		  'width' => '300',
		  'height' => '200',
		  'show_marker' => 'no',
		  'show_info' =>'no',
		  'info_width' => '260',
		  ), $atts ) );
		
		if($width != "100%") $width = $width.'px';
		if($height != "100%") $height = $height.'px';
		
	$output = '<div id="'.$id.'" class="map_canvas" style="float:left;width:'.$width.';height:'.$height.';"  data-zoom="'.$zoom.'" data-latlng="'.$latlng.'" data-scrollwheel="'.$scrollwheel.'" data-draggable="'.$draggable.'" ';
	
	if($show_marker == 'yes'){
		
		$output .= 'data-showmarker="'.$show_marker.'" ';
		
		if($show_info == "yes"){
			$output .= 'data-showinfo="'.$show_info.'" ';
			$output .= 'data-infowidth="'.$info_width.'" ';
			$output .= 'data-infobg="'.get_template_directory_uri().'/img/tipbox.png" >';
			$output .= '</div>';
			$output .= '<div id="'.$id.'-map-info" style="display:none;">'.$content.'</div>';
			
			return $output;
		}
		$output .= '></div>';
		return $output;
	}
	$output .= '></div>';
	return $output;
	
}
add_shortcode('map', 'alterna_map_func');

//=============================
// FlexSlider
//=============================
function alterna_flexslider_func($atts, $content = null){
	global $alterna_flexslider_items;
	$alterna_flexslider_items = array();
	
	extract( shortcode_atts( array(
		  'id' => '',
		  ), $atts ) );
	$output = '<div class="flexslider post-gallery"><ul class="slides">';
	
	do_shortcode($content);
	if(count($alterna_flexslider_items) > 0){
		foreach($alterna_flexslider_items as $alterna_flexslider_item){
			$output .= '<li>'.$alterna_flexslider_item.'</li>';
		}
	}
	
	$output .= '</ul></div>';
	
	return $output;
}
add_shortcode('flexslider', 'alterna_flexslider_func');

function alterna_flexslider_item_func($atts, $content = null){
	global $alterna_flexslider_items;
	extract( shortcode_atts( array(
		  'type' => 'image',
		  'src'	 => ''
		  ), $atts ) );
	switch($type){
		case 'image' :
			$alterna_flexslider_items[] = '<img src="'.$src.'" alt="" >';
			break;
		case 'video' :
			$alterna_flexslider_items[] = do_shortcode($content);
			break;
	}
	return $alterna_flexslider_items;
}
add_shortcode('flexslider_item', 'alterna_flexslider_item_func');

//=============================
// Carousel
//=============================
function alterna_carousel_func($atts, $content = null){
	global $alterna_carousel_items;
	$alterna_carousel_items = array();
	
	extract( shortcode_atts( array(
		  'id' => '',
		  ), $atts ) );
	$output =  '<div id="'.$id.'" class="carousel slide">';
	$output .= '<div class="carousel-inner">';
	
	do_shortcode($content);
	$c = 0;
	foreach($alterna_carousel_items as $alterna_carousel_item){
		$output .= '<div class="item '.($c == 0 ? 'active' : '').'">'.$alterna_carousel_item.'</div>';
		$c++;
	}
	
	$output .= '</div>';
	$output .= '<a class="carousel-control left" href="#'.$id.'" data-slide="prev">&lsaquo;</a>';
	$output .= '<a class="carousel-control right" href="#'.$id.'" data-slide="next">&rsaquo;</a>';
	$output .= '</div>';
	
	return $output;
}
add_shortcode('carousel', 'alterna_carousel_func');

function alterna_carousel_item_func($atts, $content = null){
	global $alterna_carousel_items;
	extract( shortcode_atts( array(
		  'src'	 => ''
		  ), $atts ) );
	$output = '<img src="'.$src.'" alt="" >';
	$output .= '<div class="carousel-caption">'.$content.'</div>';
	$alterna_carousel_items[] = $output;
		
	return $alterna_carousel_items;
}
add_shortcode('carousel_item', 'alterna_carousel_item_func');

//=============================
// Buttons
//=============================
function alterna_button_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'text' => 'Button Name',
		  'type' => '',
		  'size' => '',
		  'url'	 => '#',
		  'target' => '_blank',
		  'bg_color' => '',
		  'bg_hover_color' => '',
		  'txt_color' => '',
		  'txt_hover_color' => ''
		  ), $atts ) );
	if($type == 'btn-custom') $type = 'btn-custom ';
	$output = '<a class="btn '.$type.' '.$size.'" href="'.$url.'" target="'.$target.'"';
	
	if($bg_color != '') $output .=' data-bgcolor="'.$bg_color.'"';
	if($bg_hover_color != '') $output .=' data-bghovercolor="'.$bg_hover_color.'"';
	if($txt_color != '') $output .=' data-txtcolor="'.$txt_color.'"';
	if($txt_hover_color != '') $output .=' data-txthovercolor="'.$txt_hover_color.'"';
	
	$output .= ' >'.$text.'</a>';
	
	return $output;
}
add_shortcode('button', 'alterna_button_func');

//=============================
// Alert Message
//=============================
function alterna_alert_func($atts, $content = null){
	global $alterna_carousel_items;
	$alterna_carousel_items = array();
	
	extract( shortcode_atts( array(
		  'type' => '',
		  'close' => 'yes',
		  'title' => '',
		  ), $atts ) );
		  
	$output =  '<div class="alert '.($close == "yes" ? 'alert-block ' : '').($type == '' ? '' : 'alert-'.$type ).' fade in">';
	//if($close == 'yes') $output .= '<a class="close" data-dismiss="alert" href="#">&times;</a>';
	if($close == 'yes') $output .= '<div class="close" data-dismiss="alert">&times;</div>';
	if($title != '') $output .= '<h4 class="alert-heading">'.$title.'</h4>';
	$output .= do_shortcode($content);
    $output .= '</div>';
	
	return $output;
}
add_shortcode('alert', 'alterna_alert_func');

//=============================
// Dropcap
//=============================
function alterna_dropcap_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'text' 		=> '',
		  'type' 		=> '',
		  'txt_color'	=> '#000000',
		  'bg_color'	=> '#ff0000'
		  ), $atts ) );
	
	$output = '<span class="dropcap';
	switch($type){
		case "text":
			$output .= ' dropcap-text" style="color:'.$txt_color.'"';
			break;
		default :
			$output .= ' dropcap-default" style="background:'.$bg_color.';color:'.$txt_color.'"';
			
	}
	$output .= '>';
	$output .= $text.'</span>';
	$output .= do_shortcode($content);
	
	return $output;
}
add_shortcode('dropcap', 'alterna_dropcap_func');

//=============================
// Blockquote
//=============================
function alterna_blockquote_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'border_color'	=> '#eeeeee',
		  'bg_color'		=> '#ffffff'
		  ), $atts ) );
	
	$output = '<blockquote style="padding:10px 10px 10px 15px;border-left: 5px solid '.$border_color.';'.($bg_color != '' ? 'background:'.$bg_color.';' : '').'">'.do_shortcode($content).'</blockquote>';

	return $output;
}
add_shortcode('blockquote', 'alterna_blockquote_func');

//=============================
// Bullets
//=============================
function alterna_bullets_func($atts, $content = null){
	global $alterna_bullets_items,$alterna_bullets_type,$alterna_bullets_color;
	$alterna_bullets_items = array();
	
	extract( shortcode_atts( array(
			'type'	=> 'ok',
			'color' => '#000000',
			'txt_color' => ''
		  ), $atts ) );
		  
	$output = '<ul class="bullets" '.($txt_color != '' ? ' style="color:'.$txt_color.'"' : '').'>';
	
	$alterna_bullets_type = $type;
	$alterna_bullets_color = $color;
	
	do_shortcode($content);
	
	foreach($alterna_bullets_items as $alterna_bullets_item){
		$output .= $alterna_bullets_item;
	}
	
	$output .= '</ul>';
	return $output;
}
add_shortcode('bullets', 'alterna_bullets_func');

function alterna_bullet_func($atts, $content = null){
	global $alterna_bullets_items,$alterna_bullets_type,$alterna_bullets_color;
	
	extract( shortcode_atts( array(
			'custom'	=> 'no',
			'txt_color' => ''
		  ), $atts ) );
	
	$output = '<li '.($txt_color != '' ? ' style="color:'.$txt_color.'"' : '').'>';
	if($custom == 'yes' ){
		
	}else{
		if($alterna_bullets_type == "ok"){
			$output .= do_shortcode('[icon icon_name="icon-ok" icon_color="'.$alterna_bullets_color.'"]') ;
		}else if($alterna_bullets_type == "number"){
			$output .= '<span style="background-color:'.$alterna_bullets_color.';">'.(count($alterna_bullets_items) + 1).'</span>';
		}else if($alterna_bullets_type == "error"){
			$output .= do_shortcode('[icon icon_name="icon-remove" icon_color="'.$alterna_bullets_color.'"]') ;
		}
	}
	
	$output .= do_shortcode($content);
	
	$output .= '</li>';
	
	$alterna_bullets_items[] = $output;
	
	return $alterna_bullets_items;
}
add_shortcode('bullet', 'alterna_bullet_func');

//=============================
// PriceTable
//=============================
function alterna_price_func($atts, $content = null){
	global $alterna_price_items,$alterna_price_type;
	$alterna_price_items = array();
	extract( shortcode_atts( array(
		  'type'	=> 'standard',
		  
		  'title'	=> '',
		  'price'	=> '',
		  'plan'	=> '',
		  
		  'background_color' 	=> '',
		  'border_color'		=> '',
		  
		  'content_bg_color'		=> '',
		  'content_align'			=> 'center',
		  
		  ), $atts ) );
	//recommend , free , standard
	if($border_color == ""){
		switch($type){
			case 'recommend':
				$border_color = '#C7A807';
				break;
			case 'free':
				$border_color = '#5E9401';
				break;
			default :
				$border_color = '#c7c7c7';
		}
	}
	
	if($background_color == ""){
		switch($type){
			case 'recommend':
				$background_color = '#F1D027';
				break;
			case 'free':
				$background_color = '#82C906';
				break;
			default :
				$background_color = '#e2e2e2';
		}
	}
	
	if($content_bg_color == ""){
		switch($type){
			case 'recommend':
				$content_bg_color = '#fff9d9';
				break;
			case 'free':
				$content_bg_color = '#EFFED6';
				break;
			default :
				$content_bg_color = '#F4F4F4';
		}
	}
	
	$alterna_price_type = $type;
	
	$output = '<div class="price '.($type).'"><div class="price-header" style="border: 1px '.$border_color.' solid;background: '.$background_color.';">';
	
	$output .= '<div class="price-title"><h5>'.$title.'</h5></div>';
	
	$output .= '<div class="price-price-plan">';
	$output .= '<div class="price-num">'.$price.'</div>';
	$output .= '<div class="price-plan">'.$plan.'</div>';
	$output .= '</div>';
	
	$output .= '</div><ul class="price-content" style="text-align:'.$content_align.';background: '.$content_bg_color.';">';
	
	do_shortcode($content);
	
	foreach($alterna_price_items as $alterna_price_item){
		$output .= $alterna_price_item;
	}
	
	$output .= '</ul></div>';
	
	return $output;
}
add_shortcode('price', 'alterna_price_func');

function alterna_price_item_func($atts, $content = null){
	global $alterna_price_items, $alterna_price_type;
	
	extract( shortcode_atts( array(
		  'type'	 	=> 'text',
		  'btn_text'	=> 'Sign Up',
		  'btn_url'		=>	'#',
		  'btn_target'	=> 	'_self',
		  'btn_size'	=>	'default',
		  'btn_bg_color' => '',
		  'btn_bg_hover_color' => '',
		  'btn_txt_color'	=> '',
		  'btn_txt_hover_color'	=> ''
		  ), $atts ) );
	
	switch($alterna_price_type){
		case 'recommend' :
			if($btn_bg_color == '') $btn_bg_color = '#F1D027';
			if($btn_bg_hover_color == '') $btn_bg_hover_color = '#C7A807';
			if($btn_txt_color == '') $btn_txt_color = '#ffffff';
			if($btn_txt_hover_color == '') $btn_txt_hover_color = '#ffffff';
			break;
		case 'free' :
			if($btn_bg_color == '') $btn_bg_color = '#82C906';
			if($btn_bg_hover_color == '') $btn_bg_hover_color = '#5E9401';
			if($btn_txt_color == '') $btn_txt_color = '#ffffff';
			if($btn_txt_hover_color == '') $btn_txt_hover_color = '#ffffff';
			break;
		default :
			if($btn_bg_color == '') $btn_bg_color = '#666666';
			if($btn_bg_hover_color == '') $btn_bg_hover_color = '#333333';
			if($btn_txt_color == '') $btn_txt_color = '#ffffff';
			if($btn_txt_hover_color == '') $btn_txt_hover_color = '#ffffff';
	}
	
	switch($type){
		case 'btn':
			$btn = '[button text="'.$btn_text.'" type="btn-custom" size="'.$btn_size.'" url="'.$btn_url.'"  target="'.$btn_target.'" bg_color="'.$btn_bg_color.'" bg_hover_color="'.$btn_bg_hover_color.'" txt_color="'.$btn_txt_color.'" txt_hover_color="'.$btn_txt_hover_color.'"]';
			$alterna_price_items[] = '<li class="price-item price-btn">'.do_shortcode($btn).'</li>';
			break;
		default :
			$alterna_price_items[] = '<li class="price-item">'.do_shortcode($content).'</li>';
	}

	return $alterna_price_items;
	
}
add_shortcode('price_item', 'alterna_price_item_func');

//=============================
// PriceSlide
//=============================

function alterna_priceslider_func($atts, $content = null){
	global $priceslider_contents;
	
	$priceslider_contents = array();
	
	extract( shortcode_atts( array(
				'height' => '' , 
				'nav_color' => ''
		  ), $atts ) );
	
	do_shortcode($content);
	
	$output = '<div class="price-slider" '.($height != '' ? 'style="height:'.$height.'px;"' : '').'>';
	$output .= '<div class="price-slider-images">';
		foreach($priceslider_contents as $priceslider_content){
			$output .= $priceslider_content['img'];
		}	
	$output	.= '</div>';
	$output .= '<div class="price-slider-content">';
		foreach($priceslider_contents as $priceslider_content){
			$output .= $priceslider_content['element'];
		}
	$output .= '</div>';
	$output .= '<div class="price-slider-btns">';
		$output .= '<a class="price-prev" '.($nav_color != '' ? 'style="background-color:'.$nav_color.'"' : '').'><i class="icon-chevron-left"></i></a>';
		$output .= '<a class="price-next" '.($nav_color != '' ? 'style="background-color:'.$nav_color.'"' : '').'><i class="icon-chevron-right"></i></a>';
	$output	.= '</div>';
	
	$output .= '</div>';
	
	return $output;	
}

add_shortcode('priceslider', 'alterna_priceslider_func');

function alterna_priceslider_item_func($atts, $content = null){
	global $priceslider_contents;
	extract( shortcode_atts( array(
				'img'	 	=> '',
				'plan'		=>	'<i class="icon-truck"></i> Regular License',
				'currency'	=> '$',
				'price'		=>	'0',
				'color'		=> '#7AB80E',
				'btn_text'	=> 'Sign Up',
			  	'btn_url'		=>	'#',
			  	'btn_target'	=> 	'_self',
			  	'btn_size'	=>	'default',
			  	'btn_bg_color' => '#7AB80E',
			  	'btn_bg_hover_color' => '#5b8f00',
			  	'btn_txt_color'	=> '#ffffff',
			  	'btn_txt_hover_color'	=> '#ffffff'
		  ), $atts ) );
	$output_data = array('img'=>'','element'=>'');
	$output_data['img'] = '<div class="price-img"><img src="'.$img.'" alt=""></div>';
	
	$element = '<div class="price-slider-element">';
		$element .= '<div class="price-plan" style="background-color:'.$color.';"><h4>'.$plan.'</h4></div>';
		$element .= '<div class="price-value" style="color:'.$color.';"><sup>'.$currency.'</sup>'.$price.'</div>';
		$element .= '<div class="price-slider-description">'.$content.'</div>';
		$element .= '<div class="price-slider-signup">';
			$element .='[button text="'.$btn_text.'" type="btn-custom" size="'.$btn_size.'" url="'.$btn_url.'"  target="'.$btn_target.'" bg_color="'.$btn_bg_color.'" bg_hover_color="'.$btn_bg_hover_color.'" txt_color="'.$btn_txt_color.'" txt_hover_color="'.$btn_txt_hover_color.'"]';
		$element	.= '</div>';
		$element	.= '</div>';
	
	$output_data['element'] = do_shortcode($element);
	
	$priceslider_contents[] = $output_data;
	return $priceslider_contents;
}
add_shortcode('priceslider_item', 'alterna_priceslider_item_func');


//=============================
// Call To Action
//=============================
function alterna_call_to_action_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'title' => '',
		  'desc' => '',
		  'size' => 'big',
		  'btn_title' => '',
		  'btn_type' => 'btn-primary',
		  'btn_size' => 'btn-large',
		  'url'	 => '#',
		  'target' => '_self',
		  'bg_color' => '',
		  'bg_hover_color' => '',
		  'txt_color' => '',
		  'txt_hover_color' => ''
		  ), $atts ) );
	
	
	$output = '<div class="call-to-action">';
	if($size == 'big')
		$output .= '<h1>'.$title.'</h1>';
	else if($size == '' || $size == 'small')
		$output .= '<h3>'.$title.'</h3>';
	else 
		$output .= '<'.$size.'>'.$title.'</'.$size.'>';
	
	if($desc != '') $output .= '<p class="desc '.$size.'">'.$desc.'</p>';
	
	if($btn_title != '') {
		if($btn_type == 'btn-custom') $btn_type = 'btn-custom ';
		$output .= '<p><a class="btn '.$btn_type.' '.$btn_size.'" href="'.$url.'" target="'.$target.'"';
		
		if($bg_color != '') $output .=' data-bgcolor="'.$bg_color.'"';
		if($bg_hover_color != '') $output .=' data-bghovercolor="'.$bg_hover_color.'"';
		if($txt_color != '') $output .=' data-txtcolor="'.$txt_color.'"';
		if($txt_hover_color != '') $output .=' data-txthovercolor="'.$txt_hover_color.'"';
		
		$output .= ' >'.$btn_title.'</a></p>';
	}
	
	$output .= '</div>';
	
	return $output;
}
add_shortcode('call_to_action', 'alterna_call_to_action_func');

function alterna_call_to_action_bar_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'title' => '',
		  'desc' => '',
		  'size' => 'big',
		  'btn_title' => '',
		  'btn_type' => 'btn-primary',
		  'btn_size' => 'btn-large',
		  'url'	 => '#',
		  'target' => '_self',
		  'bg_color' => '',
		  'bg_hover_color' => '',
		  'txt_color' => '',
		  'txt_hover_color' => ''
		  ), $atts ) );

	$output = '<div class="call-to-action-bar"><div class="call-to-action-bar-content">';
	
	if($size == 'big')
		$output .= '<h1>'.$title.'</h1>';
	else if($size == '' || $size == 'small')
		$output .= '<h3>'.$title.'</h3>';
	else 
		$output .= '<'.$size.'>'.$title.'</'.$size.'>';
	
	if($desc != '') $output .= '<p class="desc '.$size.'">'.$desc.'</p>';
	$output .= '</div>';
	if($btn_title != '') {
		if($btn_type == 'btn-custom') $btn_type = 'btn-custom ';
		$output .= '<p><a class="btn '.$btn_type.' '.$btn_size.'" href="'.$url.'" target="'.$target.'"';
		
		if($bg_color != '') $output .=' data-bgcolor="'.$bg_color.'"';
		if($bg_hover_color != '') $output .=' data-bghovercolor="'.$bg_hover_color.'"';
		if($txt_color != '') $output .=' data-txtcolor="'.$txt_color.'"';
		if($txt_hover_color != '') $output .=' data-txthovercolor="'.$txt_hover_color.'"';
		
		$output .= ' >'.$btn_title.'</a></p>';
	}
	
	$output .= '</div>';
	
	return $output;
}
add_shortcode('call_to_action_bar', 'alterna_call_to_action_bar_func');

//=============================
// Accordion
//=============================
function alterna_accordion_func($atts, $content = null){
	global $alterna_accordion_items,$alterna_accordion_id;
	
	extract( shortcode_atts( array(
		  'id' => '',
		  ), $atts ) );
		  
	$alterna_accordion_items = array();
	$alterna_accordion_id = $id;
	$output = '<div class="accordion alterna-accordion" id="'.$id.'">';
	do_shortcode($content);
	foreach($alterna_accordion_items as $alterna_accordion_item){
		$output .= $alterna_accordion_item;
	}
	$output .= '</div>';
	
	return $output;
}
add_shortcode('accordion', 'alterna_accordion_func');

function alterna_accordion_item_func($atts, $content = null){
	global $alterna_accordion_items,$alterna_accordion_id;
	extract( shortcode_atts( array(
		  'id' => '',
		  'title' => '',
		  'open' => 'false'
		  ), $atts ) );
		  
	$alterna_accordion_items[] = '<div class="accordion-group"><div class="accordion-heading"><a class="accordion-toggle '.($open == "true" || $open == "yes" ? '' : 'collapsed').'" data-toggle="collapse" data-parent="#'.$alterna_accordion_id.'" href="#'.$id.'"><i class="icon-minus"></i><i class="icon-plus"></i>'.$title.'</a></div><div id="'.$id.'" class="accordion-body collapse '.($open == "true" || $open == "yes" ? "in" : "").'"><div class="accordion-inner">'.do_shortcode($content).'</div></div></div>';
	return $alterna_accordion_items;
}
add_shortcode('accordion_item', 'alterna_accordion_item_func');

//=============================
// Toggle
//=============================
function alterna_toggle_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'id' => '',
		  'title' => '',
		  'open'  => ''
		  ), $atts ) );
		  
	$output = '<div class="accordion">';
	$output .= '<div class="accordion-group"><div class="accordion-heading"><a class="accordion-toggle '.($open == "true" || $open == "yes" ? '' : 'collapsed').'" data-toggle="collapse" href="#'.$id.'"><i class="icon-minus"></i><i class="icon-plus"></i>'.$title.'</a></div>';
	$output .= '<div id="'.$id.'" class="accordion-body collapse '.($open == "true" || $open == "yes" ? 'in' : '').'"><div class="accordion-inner">'.do_shortcode($content).'</div></div></div>';
	$output .= '</div>';
	
	return $output;
}
add_shortcode('toggle', 'alterna_toggle_func');

//=============================
// Tabs
//=============================
function alterna_tabs_func($atts, $content = null){
	global $tabs_title_array,$tabs_content_array;
	$tabs_title_array 	= array();
	$tabs_content_array = array();
	
	$output = '<div class="tabs">';
	do_shortcode($content);
	$output .= '<ul class="tabs-nav">';
	foreach($tabs_title_array as $tabs_title){
		$output .= $tabs_title;
	}
	$output .= '</ul>';
	$output .= '<div class="tabs-container">';
	foreach($tabs_content_array as $tabs_content){
		$output .= $tabs_content;
	}
	$output .='</div></div>';
	return $output;
}
add_shortcode('tabs', 'alterna_tabs_func');

function alterna_tabs_item_func($atts, $content = null){
	global $tabs_title_array,$tabs_content_array;
	
	extract( shortcode_atts( array(
		  'title' => 'No title!'
		  ), $atts ) );
		  
	$tabs_title_array[] = '<li>'.$title.'</li>';
	$tabs_content_array[]	= '<div class="tabs-content">'.do_shortcode($content).'</div>';
	return "";
}
add_shortcode('tabs_item', 'alterna_tabs_item_func');

//=============================
// SideTabs
//=============================
function alterna_sidetabs_func($atts, $content = null){
	global $sidetabs_title_array,$sidetabs_content_array;
	$sidetabs_title_array 	= array();
	$sidetabs_content_array = array();
	
	$output = '<div class="sidetabs">';
	do_shortcode($content);
	$output .= '<ul class="sidetabs-nav the-icons">';
	foreach($sidetabs_title_array as $sidetabs_title){
		$output .= $sidetabs_title;
	}
	$output .= '</ul>';
	$output .= '<div class="sidetabs-container">';
	foreach($sidetabs_content_array as $sidetabs_content){
		$output .= $sidetabs_content;
	}
	$output .='</div></div>';
	return $output;
}
add_shortcode('sidetabs', 'alterna_sidetabs_func');

function alterna_sidetabs_item_func($atts, $content = null){
	global $sidetabs_title_array,$sidetabs_content_array;
	
	extract( shortcode_atts( array(
		  'title' => 'No title!',
		  'icon' => ''
		  ), $atts ) );
		  
	$sidetabs_title_array[] = '<li>'.($icon != '' ? '<i class="'.$icon.'"></i>' : '' ).$title.'</li>';
	$sidetabs_content_array[]	= '<div class="sidetabs-content">'.do_shortcode($content).'</div>';
	return "";
}
add_shortcode('sidetabs_item', 'alterna_sidetabs_item_func');

//=============================
// Testimonials
//=============================
function alterna_testimonials_func($atts, $content = null) {
	global $alterna_testimonials_items,$alterna_testimonials_type;
	
	$alterna_testimonials_items = array();
	
	extract( shortcode_atts( array(
		  	'type'		=> '',
			'autoplay'	=> 'no',
			'delay'		=>	'6000',
			'show_nav'	=>	'yes'	
		  ), $atts ) );
	
	$alterna_testimonials_type = $type;
	
	$output ='<div class="testimonials '.($type == 'avatar' ? "testimonials-avatar" : "").($autoplay == 'yes' ? " testimonials-auto" : "").'" data-delay="'.$delay.'">';
	
	do_shortcode($content);
	
	foreach($alterna_testimonials_items as $alterna_testimonials_item){
		$output .= $alterna_testimonials_item;
	}
	
	if($show_nav == 'yes'){
		$output .='<a class="testimonials-prev"><i class="icon-angle-left"></i></a><a class="testimonials-next"><i class="icon-angle-right"></i></a>';
	}
	
	$output .= '</div>';
	return $output;
}
add_shortcode('testimonials', 'alterna_testimonials_func');

function alterna_testimonials_item_func($atts, $content = null){
	global $alterna_testimonials_items , $alterna_testimonials_type;
	
	extract( shortcode_atts( array(
		  	'name'	=>  '',
			'job'	=> '',
			'img'	=>	''
		  ), $atts ) );
	
	
	$output = '<div class="testimonials-item">';
	if($alterna_testimonials_type == 'avatar'){
		if($img == "") $img = get_template_directory_uri() . '/img/testimonials-client.png';
		$output .= '<div class="testimonials-avatar"><img src="'.$img.'" alt="" ></div>';
	}
	$output .= '<div class="testimonials-content">';
	$output .= '<i class="icon-quote-left"></i>'.$content.'<i class="icon-quote-right"></i><span class="testimonials-arraw"></span></div><div class="testimonials-name"><div class="testimonials-icon" ><span>'.$name.'</span>'.( $job != '' ? '<span class="testimonials-job">- '.$job : "" ).'</span></div></div></div>';
	
	$alterna_testimonials_items[] = $output;
	
	return $alterna_testimonials_items;
}
add_shortcode('testimonials_item', 'alterna_testimonials_item_func');

//=============================
// Services
//=============================
function alterna_services_func($atts, $content = null){
	extract( shortcode_atts( array(
			'type' => 'icon',
			'src'	=> '',
			'show_bg' => 'yes',
			'border' => 'no'
		  ), $atts ) );
		  
	$output = '<div class="services '.($show_bg == "yes" ? 'show-bg' : '').($border == "yes" ? ' border' : '').'"><div class="services-image">';
	if($type == "icon"){
		$output .= '<div class="services-icon"><i class="'.$src.'"></i></div>';
	}else{
		$output .= '<div class="services-icon"><img src="'.$src.'" alt=""></div>';
	}
	$output .= '</div>';
	$output .= do_shortcode($content);
	$output .= '</div>';
	
	return $output;
}
add_shortcode('services', 'alterna_services_func');

//=============================
// Features
//=============================
function alterna_features_func($atts, $content = null){
	extract( shortcode_atts( array(
			'type' => 'icon',
			'src'	=> '',
			'title' => '',
			'show_bg' => 'yes',
			'border' => 'no'
		  ), $atts ) );
		  
	$output = '<div class="features '.($show_bg == "yes" ? 'show-bg' : '').($border == "yes" ? ' border' : '').'">';
	if($type == "icon"){
		$output .= '<div class="features-icon"><i class="'.$src.'"></i></div>';
	}else{
		$output .= '<div class="features-icon"><img src="'.$src.'" alt=""></div>';
	}
	$output .= '<div class="features-title"><h3>'.$title.'</h3><div class="features-content">';
	$output .= do_shortcode($content);
	$output .= '</div></div></div>';
	
	return $output;
}
add_shortcode('features', 'alterna_features_func');

//=============================
// Team
//=============================
function alterna_team_func($atts, $content = null){
	global $alterna_team_content , $alterna_team_socials;
	$alterna_team_content = '';
	$alterna_team_socials = array();
	
	extract( shortcode_atts( array(
			'name' 	=> '',
			'job'	=> '',
			'src'	=> '',
		  ), $atts ) );
		  
	$output = '<div class="team"><div><div class="team-user">';
	$output .='<h4>'.$name.'</h4>';
	$output	.='<div class="team-job">'.$job.'</div>';
	$output	.='</div>';
	$output	.='<div class="team-avatar"><img src="'.$src.'" alt="" /></div>';
	
	do_shortcode($content);
	
	$output	.='<div class="team-information">'.$alterna_team_content.'</div>';
	$output	.='<div class="team-social">';
	$count = 0;
	foreach($alterna_team_socials as $alterna_team_social){
		if($count != 0) $output .=' / ';
		$output	.=$alterna_team_social;
		$count++;
	}
	$output	.='</div></div></div>';
	
	return $output;
}
add_shortcode('team', 'alterna_team_func');

function alterna_team_content_func($atts, $content = null){
	global $alterna_team_content ;
	$alterna_team_content = do_shortcode($content);
	return $alterna_team_content;
}
add_shortcode('team_content', 'alterna_team_content_func');

function alterna_team_social_func($atts, $content = null){
	global $alterna_team_socials;
	
	extract( shortcode_atts( array(
			'link'  => '#',
			'target' => '_blank',
		  ), $atts ) );
	$alterna_team_socials[] = '<a href="'.$link.'" target="'.$target.'">'.$content.'</a>';
	
	return $alterna_team_socials;
}
add_shortcode('team_social', 'alterna_team_social_func');
		  
//=============================
// History
//=============================
function alterna_history_func($atts, $content = null){
	extract( shortcode_atts( array(
			'day'	=>	'',
			'src'	=>	'',
			'width' =>	'',
			'start' => 'no',
			'title' => ''
		  ), $atts ) );
		  
	$output = '<div class="history"><div class="history-date"><div class="day">'.$day.'</div></div><div class="history-line"></div><div class="history-hor-line"></div>';
	if($start == "yes") $output .='<div class="history-start-point"></div>';
	$output .='<div class="history-container">';
	if($src != '') $output .='<div class="history-img"><img src="'.$src.'" alt="" '.($width != '' ? 'style="width:'.$width.';"' : '').' ></div>';
	$output .='<div class="history-content '.($src == "" ? "" : "history-hasimg" ).'">';
	if($title != '') $output .='<h4>'.$title.'</h4>';
	$output .=do_shortcode($content).'</div></div></div>';

	return $output;
}
add_shortcode('history', 'alterna_history_func');

//=============================
// Skrills
//=============================
function alterna_skills_func($atts, $content = null){
	global $skill_items;
	$skill_items = array();
	
	$output = '<ul class="skills">';
	
	do_shortcode($content);
	
	if(count($skill_items) > 0){
		foreach($skill_items as $skill_item){
			$output .= '<li>'.$skill_item.'</li>';
		}
	}
	
	$output .= '</ul>';
	return $output;
}
add_shortcode('skills', 'alterna_skills_func');

function alterna_skill_func($atts, $content = null){
	global $skill_items;
	
	extract( shortcode_atts( array(
			'name'	=> 'No Name',
			'percent' => '50%',
			'text' => '',
			'bg_color' => '',
			'color'	=> ''
		  ), $atts ) );
	
	$skill_items[] = '<span class="skill-bg" data-percent="'.$percent.'" '.($bg_color != '' ? 'style="background:'.$bg_color.'";' : '').'></span><span class="skill-name" '.($color != '' ? 'style="color:'.$color.'";' : '').'>'.$name.'</span><span class="skill-progress" '.($color != '' ? 'style="color:'.$color.'";' : '').'>'.($text == "" ? $percent : $text).'</span>';
	
	return $skill_items;
}
add_shortcode('skill', 'alterna_skill_func');

//=============================
// Twitter
//=============================
function alterna_twitter_func($atts, $content = null){
	extract( shortcode_atts( array(
			'name'	=> '',
			'count'	=> '5'
		  ), $atts ) );
	$params = array('count' => $count ,'screen_name' => $name);
		  
	return alterna_generate_tweet_list($params);
}
add_shortcode('twitter', 'alterna_twitter_func');



//=============================
// Columns
//=============================
function alterna_space_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'line'	=> 'no'
		  ), $atts ) );
	return '<div class="row-fluid alterna-space '.($line =="yes" ? 'alterna-line' : '').'">'.do_shortcode($content).'</div>';
}
add_shortcode('space', 'alterna_space_func');

function alterna_one_func($atts, $content = null){
	return '<div class="row-fluid">'.do_shortcode($content).'</div>';
}
add_shortcode('one', 'alterna_one_func');

function alterna_inner_one_func($atts, $content = null){
	return '<div class="row-fluid">'.do_shortcode($content).'</div>';
}
add_shortcode('inner_one', 'alterna_inner_one_func');

function alterna_one_half_func($atts, $content = null){
	return '<div class="span6">'.do_shortcode($content).'</div>';
}
add_shortcode('one_half', 'alterna_one_half_func');

function alterna_one_third_func($atts, $content = null){
	return '<div class="span4">'.do_shortcode($content).'</div>';
}
add_shortcode('one_third', 'alterna_one_third_func');

function alterna_two_third_func($atts, $content = null){
	return '<div class="span8">'.do_shortcode($content).'</div>';
}
add_shortcode('two_third', 'alterna_two_third_func');

function alterna_one_fourth_func($atts, $content = null){
	return '<div class="span3">'.do_shortcode($content).'</div>';
}
add_shortcode('one_fourth', 'alterna_one_fourth_func');

function alterna_two_fourth_func($atts, $content = null){
	return '<div class="span6">'.do_shortcode($content).'</div>';
}
add_shortcode('two_fourth', 'alterna_two_fourth_func');

function alterna_three_fourth_func($atts, $content = null){
	return '<div class="span9">'.do_shortcode($content).'</div>';
}
add_shortcode('three_fourth', 'alterna_three_fourth_func');


//=============================
// Youtube Video Player
//=============================
function alterna_youtube_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'id' => '',
		  'width' => '600',
		  'height' => '360',
		  ), $atts ) );
	if($width == "100%") {
		$out_width = 'class="full-width-show" width="600"';
	}else{
		$out_width = 'width="'.$width.'"';
	}
	
	$output = '<div class="video-youtube"><iframe title="YouTube Video Player" src="http://www.youtube.com/embed/' . $id . '" '.$out_width.' height="' . $height . '" allowfullscreen></iframe></div>';
		
	return $output;
}
add_shortcode('youtube', 'alterna_youtube_func');

//=============================
// Vimeo Video Player
//=============================
function alterna_vimeo_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'id' => '',
		  'width' => '600',
		  'height' => '360',
		  ), $atts ) );
		  
	if($width == "100%") {
		$out_width = 'class="full-width-show" width="600"';
	}else{
		$out_width = 'width="'.$width.'"';
	}
		
	$output = '<div class="video-vimeo"><iframe title="Vimeo Video Player" src="http://player.vimeo.com/video/' . $id . '" '.$out_width.' height="' . $height . '" ></iframe></div>';
		
	return $output;
}
add_shortcode('vimeo', 'alterna_vimeo_func');

//=============================
// Soundcloud Audio Player
//=============================
function alterna_soundcloud_func($atts, $content = null){
	extract( shortcode_atts( array(
		  	'url' => '',
			'iframe' => 'true',
			'width' => '100%',
			'height' => 166,
			'auto_play' => 'true',
			'show_comments' => 'true',
			'color' => 'ff7700',
			'theme_color' => 'ff6699',
		  ), $atts ) );
	
	// use iframe
	if($iframe == 'true'){
		$url = 'http://w.soundcloud.com/player?' . http_build_query($atts);
		if($width == "100%") {
			$out_width = 'class="full-width-show" width="600"';
		}else{
			$out_width = 'width="'.$width.'"';
		}
		return '<div class="sound-sl"><iframe '.$out_width.' height="'.$height.'" scrolling="no" src="'.$url.'"></iframe></div>';
	}else{
	// use flash
		$url = 'http://player.soundcloud.com/player.swf?' . http_build_query($atts);
		return '<div class="sound-sl"><object width="'.$width.'" height="'.$height.'">
                                <param name="movie" value="'.$url.'"></param>
                                <param name="allowscriptaccess" value="always"></param>
                                <embed width="'.$width.'" height="'.$height.'" src="'.$url.'" allowscriptaccess="always" type="application/x-shockwave-flash"></embed>
                              </object></div>';
	}
	return '';
}

add_shortcode('soundcloud', 'alterna_soundcloud_func');





/*-------------------------------------------------------------
 			THEME CONTENT WITH SHORTCODE
-------------------------------------------------------------*/

//=============================
// Big content blog 
//=============================
function alterna_blog_bigcontent_func($atts, $content = null){
	extract( shortcode_atts( array(
		  	'type' => '',
			'number' => '3',
		  ), $atts ) );
	
	$args = array(	'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => $number,
                  );
	if($type != ''){
		$args['tax_query'] = array(	array(
								'taxonomy' => 'post_format',
								'field' => 'slug',
								'terms' => array($type),
							));
	}
	
	$output = '';
				  
	$blog = new WP_Query($args);
	if($blog->have_posts()) :
		while($blog->have_posts()) : $blog->the_post();
		
			$contents = '';
			$informations = '';
			$btns = '';
			$icon_type = '';
			$content_is_null = false;
			
			$output .= '<div class="blog-big-widget">';
			
			switch(get_post_format()){
				case 'video': $icon_type = 'big-icon-video'; break;
				case 'audio': $icon_type = 'big-icon-music'; break;
				case 'image': $icon_type = 'big-icon-picture'; break;
				case 'gallery': $icon_type = 'big-icon-slideshow'; break;
				case 'quote': $icon_type = 'big-icon-quote'; break;
				default : $icon_type = 'big-icon-file';
			}
		
			$contents .= '<div class="blog-big-widget-element">';
			if(get_post_format() == "image"){
				if(has_post_thumbnail(get_the_ID())){
				
					$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumbnail');
                    $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
					
					$contents .= '<a href="'.$full_image[0].'" rel="prettyPhoto"><div class="post-img">';
					$contents .= '<img src="'.$attachment_image[0].'" alt="'.get_the_title().'" /><div class="post-tip"><div class="bg"></div><div class="link no-bg"><i class="big-icon-preview"></i></div></div></div></a>';

				}
			}else if(get_post_format() == "gallery"){
				$contents .= '<div class="flexslider post-gallery"><ul class="slides">';
				
				$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumbnail');
				$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
				
				$contents .= '<li><a href="'.$full_image[0].'" rel="prettyPhoto"><img src="'.$attachment_image[0].'" alt="" ></a></li>';
				$contents .= alter_get_attachments(get_the_ID() , array() , 'post-thumbnail' , true , true);
                 
				$contents .= '</ul></div>';
					
			}else if(get_post_format() == "video"){
				$video_type = get_post_meta(get_the_ID(), 'video-type', true);
				$video_content 	= get_post_meta(get_the_ID(), 'video-content', true);
				if($video_content && $video_content != ''){
					if(intval($video_type) == 0){
						$contents .= do_shortcode('[youtube id="'.$video_content.'" width="100%" height="400"]');
					}else if(intval($video_type) == 1){
						$contents .= do_shortcode('[vimeo id="'.$video_content.'" width="100%" height="400"]');
					}else{
					   $contents .= $video_content;
					}
				}
			}else if(get_post_format() == "audio"){
				$audio_type 	= get_post_meta(get_the_ID(), 'audio-type', true);
				$audio_content 	= get_post_meta(get_the_ID(), 'audio-content', true);
				if($audio_content && $audio_content != ''){
				   if(intval($audio_type) == 0){
					 $contents .= do_shortcode('[soundcloud url="'.$audio_content.'"]');
				   }else{
					   $contents .= $audio_content;
				   }
				}
			}else if(get_post_format() == "quote"){
				$contents .= '<div class="post-quote-entry"><div class="post-quote-icon"></div>'.get_the_content().'</div>';
			}else {
				$content_is_null = true;
			}
			$contents .= '</div>';
			
			$informations .= '<div class="blog-big-widget-information"><div class="post-type"><i class="'.$icon_type.' "></i></div><div class="post-content"><h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
			
            $informations .= '<div class="post-meta row-fluid"><div class="post-date"><i class="icon-calendar"></i><a href="'.get_month_link(get_the_date('Y'), get_the_date('M')).'" title="'.get_the_date('M').' , '.get_the_date('Y').'">'.get_the_date().'</a></div><div class="post-category"><i class="icon-folder-open"></i><span>';
			$categories = get_the_category();
			$seperator = ' , ';
			$str = '';
			if($categories){
				foreach($categories as $category) {
					$str .= '<a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'alterna'), $category->name ) ) . '">'.$category->cat_name.'</a>'.$seperator;
				}
				$informations .= trim($str, $seperator);
			}
			
			$num_comments = get_comments_number();
			
			if ( $num_comments == 0 ) {
				$comments = __('No Comments' , 'alterna');
			} elseif ( $num_comments > 1 ) {
				$comments = $num_comments . __(' Comments' , 'alterna');
			} else {
				$comments = __('1 Comment' , 'alterna');
			}
		
			$informations .= '</span></div><div class="post-comments"><i class="icon-comments"></i><a href="'.get_permalink(get_the_ID()).'#comments'.'">'.$comments.'</a></div></div>';
			
			$informations .= '</div><div class="post-excerpt">'.string_limit_words(get_the_excerpt(), 20).'</div><a class="more-link" href="'.get_permalink().'">'.alterna_get_options_key('global-read-more' , '' , false , 'Read More &raquo;').'</a></div>';

			//image,video etc conent
			if(!$content_is_null) $output .= $contents;
	
			//desc
			$output .= $informations;
			
			$output .= '</div>';
		endwhile;
	endif;
	wp_reset_postdata();
	return $output;  
}

add_shortcode('blog_bigcontent', 'alterna_blog_bigcontent_func');


//=============================
// Blog List
//=============================
function alterna_blog_list_func($atts, $content = null){
	/**
	 *	show_type 0:recent , 1:related 
	 */
	extract( shortcode_atts( array(
		  	'number' 	=> '4',
			'columns'	=>	'4',
			'show_type' => '0',
			'show_style'	=> '0',
			'related_slug'	=> '',
			'post__not_in'	=> ''
		  ), $atts ) );
		  
	switch($show_type){
		case '0': 
				$blog_posts = alterna_get_blog_widget_post('recent',$number,'',true,0,$post__not_in);
				break;
		case '1': 
				$blog_posts = alterna_get_blog_widget_post('related',$number,$related_slug,true,0,$post__not_in);
				break;
	}

	$output = '';
	if($blog_posts->have_posts()){
		
		$blog_posts_count = $blog_posts->post_count;
		$bool = true;
		$num	= $columns;
		$thumbs_size = 'post-thumbs';
		
		while($blog_posts->have_posts()) : $blog_posts->the_post();
			$custom = alterna_get_custom_post_meta(get_the_ID(),'portfolio');
			
			if($bool) $output .= '<div class="row-fluid">';
			
			$output .= '<article class="shortcode-post-element span'.(12/$columns).'">';
				if($show_style == "0") {
					$output .= '<div class="post-img"><a href="'.get_permalink(get_the_ID()).'" >';
					if( has_post_thumbnail(get_the_ID())) {
						$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $thumbs_size);	
						$output .= '<img src="'.$attachment_image[0].'" alt="" >';
					}else{
						 $output .= '<img src="'.get_template_directory_uri().'/img/portfolio-no-thumbs.png" alt="">' ;
					}
					$output .= '<div class="post-cover"></div><h5>'.get_the_title().'</h5></a>';
					$output	.= '<div class="date"><div class="day">'.get_the_date('d').'</div><div class="month">'.get_the_date('M').'</div><div class="year">'.get_the_date('Y').'</div></div>';
					
					$num_comments = get_comments_number(get_the_ID());

					$output .= '<div class="post-comments"><a href="'.get_permalink(get_the_ID()).'#comments'.'"><i class="icon-comments"></i>'.$num_comments.'</a></div>';
					
					$output .= '</div>';
					$output .= '<div class="post-title"><h4><a href="'.get_permalink(get_the_ID()).'" >'.get_the_title().'</a></h4></div>';
					$output .= '<div class="post-content">'.string_limit_words(get_the_excerpt()).'</div><a class="more-link" href="'.get_permalink().'">'.alterna_get_options_key('global-read-more' , '' , false , 'Read More &raquo;').'</a>';
				}else {
					$output .= '<div class="post-img"><a href="'.get_permalink(get_the_ID()).'" >';
					if( has_post_thumbnail(get_the_ID())) {
						$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $thumbs_size);
						$output .= '<img src="'.$attachment_image[0].'" alt="" >';
					}else{
						 $output .= '<img src="'.get_template_directory_uri().'/img/portfolio-no-thumbs.png" alt="">' ;
					}
					$output .= '<div class="post-cover"></div><h5>'.get_the_title().'</h5></a>';
					$output	.= '<div class="date"><div class="day">'.get_the_date('d').'</div><div class="month">'.get_the_date('M').'</div><div class="year">'.get_the_date('Y').'</div></div>';
					
					$num_comments = get_comments_number(get_the_ID());

					$output .= '<div class="post-comments"><a href="'.get_permalink(get_the_ID()).'#comments'.'"><i class="icon-comments"></i>'.$num_comments.'</a></div>';
					
					$output .= '</div>';
					$output .= '<div class="post-title"><h4><a href="'.get_permalink(get_the_ID()).'" >'.get_the_title().'</a></h4></div>';
				}
			$output .= '</article>';
			
			$blog_posts_count--;
			
			if($blog_posts_count == 0) {
				$output .= '</div>';
			}else{
				$bool = false;
				$num--;
				if($num == 0){
					$output .= '</div>';
					$bool = true;
					$num = $columns;
				}
			}

		endwhile;
		
	}
	
	wp_reset_postdata();
	
	return $output;
	
		  
		  
}
add_shortcode('blog_list', 'alterna_blog_list_func');

//=============================
// Portfolio List
//=============================
function alterna_portfolio_list_func($atts, $content = null){
	
	/**
	 *	show_type 0:recent , 1:related 
	 */
	extract( shortcode_atts( array(
		  	'number' 	=> '4',
			'columns'	=>	'4',
			'show_type' => '0',
			'show_style'	=> '0',
			'related_slug'	=> '',
			'post__not_in' => ''
		  ), $atts ) );
	
	switch($show_type){
		case '0': 
				$portfolios = alterna_get_portfolio_widget_post('recent',$number,'',true,0,$post__not_in);
				break;
		case '1': 
				$portfolios = alterna_get_portfolio_widget_post('related',$number,$related_slug,true,0,$post__not_in);
				break;
	}
	
	$output = '';
	
	if($portfolios->have_posts()){
		
		$thumbs_size	=	'portfolio-four-thumbs';
		switch(intval($columns)){
			case 2: $thumbs_size = 'portfolio-two-thumbs';break;
			case 3: $thumbs_size = 'portfolio-three-thumbs';break;
			default :
		}
		
		$portfolio_count = $portfolios->post_count;
		$bool = true;
		$num	= $columns;
		
		while($portfolios->have_posts()) : $portfolios->the_post();
			$custom = alterna_get_custom_post_meta(get_the_ID(),'portfolio');
			
			if($bool) $output .= '<div class="row-fluid">';
			
			$output .= '<article class="portfolio-element portfolio-style-'.(intval($show_style)+1).' span'.(12/$columns).'">';
				if(intval($show_style) == 0) {
					$output .= '<div class="portfolio-wrap">';
						 			// show gallery
								if(intval($custom['portfolio-type']) == 1) {
									$output .= '<div class="flexslider">';
										$output	.=	'<ul class="slides">';
														if( has_post_thumbnail(get_the_ID())) :
                                                        	$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $thumbs_size);
                                                        	$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); 
															$output .= '<li><a href="'.$full_image[0].'" rel="prettyPhoto['.get_the_ID().']"><img src="'.$attachment_image[0].'" alt="" ></a></li>';
														endif;
															$output .= alter_get_attachments(get_the_ID() , array() , $thumbs_size , true , true);
										$output	.=	'</ul>';
									$output .= '</div>';
									// show video with youtube or vimeo
								} else  if(intval($custom['portfolio-type']) == 2 && $custom['video-content'] != '') {
										$output .= do_shortcode('['.(intval($custom['video-type']) == 0 ? 'youtube' : 'vimeo').' id="'.$custom['video-content'].'" width="100%" height="300"]');
												
								} else {
									$output .= '<div class="portfolio-img">';
											if( has_post_thumbnail(get_the_ID())) {
												$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $thumbs_size);
												$output .= '<img src="'.$attachment_image[0].'" alt="" >';
											}else{
												 $output .= '<img src="'.get_template_directory_uri().'/img/portfolio-no-thumbs.png" alt="">' ;
											}
									$output .= '</div>';
                                    $output .= '<div class="post-tip">';
										$output .= '<div class="bg"></div>';
										$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');		
                                       	$output .= '<div class="link left-link"><a href="'.get_permalink().'"><i class="big-icon-link"></i></a></div>';
										$output	.= '<div class="link right-link"><a href="'.$full_image[0].'" rel="prettyPhoto"><i class="big-icon-preview"></i></a></div>';
									$output .= '</div>';
								}
								$output .= '</div>';
                                     $output .= '<div class="portfolio-content">';
                                     $output .= '<div class="portfolio-title">';
                                                	if(intval($columns) == 0) : 
                                                    $output .= '<h4><a href="'.get_permalink(get_the_ID()).'" >'.get_the_title().'</a></h4>	';										
													else :
                                                    $output .= '<h5><a href="'.get_permalink(get_the_ID()).'" >'.get_the_title().'</a></h5>';
                                                    endif;
                                                    $output .= '<span class="portfolio-categories">'.alterna_get_custom_portfolio_category_links( alterna_get_custom_post_categories(get_the_ID(),'portfolio_categories',false) , ' / ').'</span>';
									$output .= '</div>';
									$output .= '</div>';
                                            
				} else {
                    $output .= '<div class="portfolio-wrap">';
						$output .= '<a href="'.get_permalink(get_the_ID()).'" >';
								$output .= '<div class="portfolio-img">';
											if( has_post_thumbnail(get_the_ID())) {
												$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $thumbs_size);
											$output .= '<img src="'.$attachment_image[0].'" alt="" >';
											}else{
												$output .= '<img src="'.get_template_directory_uri().'/img/portfolio-no-thumbs.png" alt="">';
											}
                                 $output .= '</div>';
                                 $output .= '<div class="post-tip">';
                                        $output .= '<div class="bg"></div>';
                                        $output .= '<div class="post-tip-info">';
                                        	$output .= '<h4>'.get_the_title().'</h4>';
                                            $output .= '<p>'.string_limit_words(get_the_excerpt());
											if($custom['portfolio-client'] != "") {
												$output .= '<span class="portfolio-client"><strong>'.__('Client: ','alterna').'</strong>'.$custom['portfolio-client'].'</span>';
											}
											$output .= '</p>';
                                         $output .= '</div>';
                                   $output .= '</div>';
                           $output .= '</a>';
                       $output .= '</div>';
                }
				
			$output .= '</article>';
			
			$portfolio_count--;
			
			if($portfolio_count == 0) {
				$output .= '</div>';
			}else{
				$bool = false;
				$num--;
				if($num == 0){
					$output .= '</div>';
					$bool = true;
					$num = $columns;
				}
			}

		endwhile;
		
	}
	wp_reset_postdata();
	return $output;
}

add_shortcode('portfolio_list', 'alterna_portfolio_list_func');

function alterna_clean_shortcodes($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'alterna_clean_shortcodes');
add_filter('widget_text', 'alterna_clean_shortcodes');

