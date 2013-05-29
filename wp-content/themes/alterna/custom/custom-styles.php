<?php
/**
 * Custom Layout,Font,Css
 *
 * @since Alterna 1.0
 */
 
	global $alterna_options,$google_fonts,$google_load_fonts,$google_custom_fonts;
	
	if($google_custom_fonts == null) alterna_get_custom_font();
	
	// Custom Font For google font
 	$general_font 				=  $google_custom_fonts['general_font'];
	$general_font_size 			= '14px';
	$menu_font					= $google_custom_fonts['menu_font'];
	$menu_font_size				= '13px';
	$title_font					= $google_custom_fonts['title_font'];
	
	if(alterna_get_options_key('custom-enable-font') == "yes"){
		
		if( alterna_get_options_key('custom-general-font-size') !="")
			$general_font_size = intval($alterna_options['custom-general-font-size']).'px';

		if( alterna_get_options_key('custom-menu-font-size') !="")
			$menu_font_size = intval($alterna_options['custom-menu-font-size']).'px';
	}
	
	// Custom color
	$theme_color						=	'#7AB80E';
	$theme_over_color					=	'#5b8f00';
	$custom_general_color				=	'#666666';
	$custom_a_color						=	'#1c1c1c';
	$custom_h_color						=	'#3a3a3a';
	
	$custom_menu_background_color		=	'#0c0c0c';
	$custom_sub_menu_background_color		=	'#7AB80E';
	$custom_sub_menu_hover_background_color		=	'#0c0c0c';
	
	$custom_footer_text_color			=	'#999999';
	$custom_footer_a_color				=	'#e7e7e7';
	$custom_footer_h_color				=	'#ffffff';
	$custom_footer_bg_color				=	'#404040';
	$custom_footer_copyright_a_color	=	'#606060';
	$custom_footer_copyright_a_hover_color	=	'#7AB80E';
	$custom_footer_copyright_bg_color	=	'#0c0c0c';
	
	if(alterna_get_options_key('custom-enable-color') == "yes"){
		
		if( alterna_get_options_key('theme-color') !="")
			$theme_color=	"#".$alterna_options['theme-color'];
			
		if( alterna_get_options_key('theme-over-color') !="")
			$theme_over_color=	"#".$alterna_options['theme-over-color'];
			
		if( alterna_get_options_key('custom-general-color') !="")
			$custom_general_color=	"#".$alterna_options['custom-general-color'];
			
		if( alterna_get_options_key('custom-a-color') !="")
			$custom_a_color=	"#".$alterna_options['custom-a-color'];
			
		if( alterna_get_options_key('custom-h-color') !="")
			$custom_h_color=	"#".$alterna_options['custom-h-color'];
			
		if( alterna_get_options_key('custom-menu-background-color') !="")
			$custom_menu_background_color =	"#".$alterna_options['custom-menu-background-color'];
		
		if( alterna_get_options_key('custom-sub-menu-background-color') !="")
			$custom_sub_menu_background_color =	"#".$alterna_options['custom-sub-menu-background-color'];
		
		if( alterna_get_options_key('custom-sub-menu-hover-background-color') !="")
			$custom_sub_menu_hover_background_color =	"#".$alterna_options['custom-sub-menu-hover-background-color'];

		if( alterna_get_options_key('custom-footer-text-color') !="")
			$custom_footer_text_color=	"#".$alterna_options['custom-footer-text-color'];
			
		if( alterna_get_options_key('custom-footer-a-color') !="")
			$custom_footer_a_color=	"#".$alterna_options['custom-footer-a-color'];
		
		if( alterna_get_options_key('custom-footer-h-color') !="")
			$custom_footer_h_color=	"#".$alterna_options['custom-footer-h-color'];
			
		if( alterna_get_options_key('custom-footer-bg-color') !="")
			$custom_footer_bg_color=	"#".$alterna_options['custom-footer-bg-color'];
			
		if( alterna_get_options_key('custom-footer-copyright-a-color') !="")
			$custom_footer_copyright_a_color =	"#".$alterna_options['custom-footer-copyright-a-color'];
		
		if( alterna_get_options_key('custom-footer-copyright-a-hover-color') !="")
			$custom_footer_copyright_a_hover_color =	"#".$alterna_options['custom-footer-copyright-a-hover-color'];
		
		if( alterna_get_options_key('custom-footer-copyright-color') !="")
			$custom_footer_copyright_bg_color =	"#".$alterna_options['custom-footer-copyright-color'];
			
	}
	
header("Content-type: text/css; charset: UTF-8");
?>

::-moz-selection { background:<?php echo $theme_color;?>; color: #ffffff; text-shadow: none; }
::selection { background:<?php echo $theme_color;?>; color: #ffffff; text-shadow: none; }

<?php 
if(intval(alterna_get_options_key('global-layout')) != 0) : 
?>    
body {padding:0 !important;}
<?php 
endif;
if(alterna_get_options_key('logo-txt-enable') != "yes") : 
?>
.logo a {
    width:<?php echo intval(alterna_get_options_key('logo-image-width')) == 0 ? '280px' : $alterna_options['logo-image-width'].'px'?>;
    height:<?php echo intval(alterna_get_options_key('logo-image-height')) == 0 ? '60px' : $alterna_options['logo-image-height'].'px'?>;
    background-image:url(<?php echo alterna_get_options_key('logo-image') == "" ? "../img/logo.png" : $alterna_options['logo-image'];?>);
    background-size: <?php echo intval(alterna_get_options_key('logo-image-width')) == 0 ? '280px' : $alterna_options['logo-image-width'].'px'?> <?php echo intval(alterna_get_options_key('logo-image-height')) == 0 ? '60px' : $alterna_options['logo-image-height'].'px'?>;
}
<?php 
endif; 
if(alterna_get_options_key('fixed-enable') == "yes") : 
?>
.fixed-logo a {
    width:<?php echo intval(alterna_get_options_key('fixed-logo-image-width')) == 0 ? '44px' : $alterna_options['fixed-logo-image-width'].'px'?>;
    height:44px;
    background-image:url(<?php echo alterna_get_options_key('fixed-logo-image') == "" ? "../img/fixed-logo.png" : $alterna_options['fixed-logo-image'];?>);
    background-size: <?php echo intval(alterna_get_options_key('fixed-logo-image-width')) == 0 ? '44px' : $alterna_options['fixed-logo-image-width'].'px'?> 44px;
}
<?php 
endif; 
if(intval(alterna_get_options_key('global-layout')) == 0) : 
	if(intval(alterna_get_options_key('global-bg-type')) == 0) : 
?>
    body {
        background-size:<?php echo alterna_get_options_key('global-bg-pattern-width') == "" ? "200" : $alterna_options['global-bg-pattern-width'];?>px <?php echo alterna_get_options_key('global-bg-pattern-height') == "" ? "200" : $alterna_options['global-bg-pattern-height'];?>px;
        background-repeat: repeat;
        background-image:url(<?php echo alterna_get_options_key('global-bg-image') == "" ? "../img/wild_oliva.png" : $alterna_options['global-bg-image'];?>);
     }
<?php 
	elseif(intval(alterna_get_options_key('global-bg-type')) == 1 && alterna_get_options_key('global-bg-image') != "") : 
?>
    body { 
        background: url(<?php echo alterna_get_options_key('global-bg-image'); ?>) no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
<?php 
	elseif(intval(alterna_get_options_key('global-bg-type')) == 2 && alterna_get_options_key('global-bg-color') != "") : 
?>
    body {
        background-color:#<?php echo alterna_get_options_key('global-bg-color'); ?>;
    }
<?php 
	endif;
endif;
?> 
.header-social-container {
    margin-top:<?php echo intval(alterna_get_options_key('header-social-padding-top')).'px'; ?>;
    margin-right:<?php echo intval(alterna_get_options_key('header-social-padding-left')).'px'; ?>;
}
<?php 
if(alterna_get_options_key('custom-enable-font') == "yes") : 
?>
/* 	----------------------------------------------------------------------------------------------	
										A - CUSTOM THEME FONT																												
	----------------------------------------------------------------------------------------------	*/
    
    body {
    	font-family:<?php echo $general_font;?>,"Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size:<?php echo $general_font_size; ?>;
    }

	h1,h2,h3,h4,h5,h6 {font-family:<?php echo $title_font; ?>,Arial,Helvetica,sans-serif;}
	
    .alterna-nav-menu li a , #alterna-nav-menu-select .nav a {
    	font-size: <?php echo $menu_font_size;?>;
       	font-family: <?php echo $menu_font;?>,sans-serif;
    }
    
    .post-meta, 
    .post-meta a , 
    .comment-meta , 
    .comment-meta a ,
    .search-post-mate, 
    .search-post-mate a {font-family:<?php echo $title_font; ?>,Arial,Helvetica,sans-serif;}
    
<?php endif; ?>

<?php if( alterna_get_options_key('custom-enable-color') == "yes") : ?>	

/* 	----------------------------------------------------------------------------------------------	
										CUSTOM THEME COLOR																												
	----------------------------------------------------------------------------------------------	*/


/* 	----------------------------------------------------------------------------------------------	
										A - GENERAL STYLE																												
	----------------------------------------------------------------------------------------------	*/

h1,h2,h3,h4,h5,h6 {color:<?php echo $custom_h_color;?>;}
body {color: <?php echo $custom_general_color;?>;}
a {color: <?php echo $custom_a_color;?>;}
a:hover {color: <?php echo $theme_color;?>;}

/* global wrap style */
.footer-wrap {border-top: 6px <?php echo $theme_color;?> solid;background:<?php echo $custom_footer_bg_color;?>;}

<?php $rgb = alterna_hex2RGB($theme_color); ?>
 textarea:focus,
    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="datetime"]:focus,
    input[type="datetime-local"]:focus,
    input[type="date"]:focus,
    input[type="month"]:focus,
    input[type="time"]:focus,
    input[type="week"]:focus,
    input[type="number"]:focus,
    input[type="email"]:focus,
    input[type="url"]:focus,
    input[type="search"]:focus,
    input[type="tel"]:focus,
    input[type="color"]:focus,
    .uneditable-input:focus {
      border-color: rgba(<?php echo $rgb['r'].' , '.$rgb['g'].' , '.$rgb['b']; ?>, 0.8);
      outline: 0;
      outline: thin dotted \9;
      /* IE6-9 */
    
      -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(<?php echo $rgb['r'].' , '.$rgb['g'].' , '.$rgb['b']; ?>, 0.6);
         -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(<?php echo $rgb['r'].' , '.$rgb['g'].' , '.$rgb['b']; ?>, 0.6);
              box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(<?php echo $rgb['r'].' , '.$rgb['g'].' , '.$rgb['b']; ?>, 0.6);
    }
    
/* 	----------------------------------------------------------------------------------------------	
										B - LAYOUT																													
	----------------------------------------------------------------------------------------------	*/
/* = Header Style
-------------------------------------------------------------- */

/* header alert message */
.header-top-content {background: <?php echo $theme_color; ?>;}
.header-information a:hover {color:<?php echo $theme_over_color; ?>;}

/* header menu , search form */
.alterna-nav-menu li:hover {background:<?php echo $theme_color; ?>;}

.alterna-nav-menu > li.current-menu-item , .alterna-nav-menu > li.current-menu-ancestor {background:<?php echo $theme_color; ?>;}
.alterna-nav-menu .sub-menu {background:<?php echo $custom_sub_menu_background_color; ?>;}

.alterna-nav-menu .sub-menu li {border-bottom:1px <?php echo $custom_menu_background_color; ?> dotted;}
.alterna-nav-menu .sub-menu li a {color:<?php echo $custom_menu_background_color; ?>;}
.alterna-nav-menu > li.current-menu-item:hover  , 
.alterna-nav-menu > li.current-menu-ancestor:hover ,
.alterna-nav-menu > li.current-menu-item:hover .sub-menu, 
.alterna-nav-menu > li.current-menu-ancestor:hover .sub-menu {background:<?php echo $theme_color; ?>;}
.alterna-nav-menu .sub-menu li:hover {background:<?php echo $custom_sub_menu_hover_background_color; ?>;}
#alterna-nav {background:<?php echo $custom_menu_background_color; ?>;border-bottom:4px <?php echo $theme_color; ?> solid;}


#alterna-nav-menu-select {background:<?php echo $custom_menu_background_color; ?>;}
#alterna-nav-menu-select .nav .active a, #alterna-nav-menu-select .nav a:hover {background:<?php echo $theme_color; ?>;}

/* header form */
.searchform #sf-searchsubmit {border: 1px solid <?php echo $theme_color; ?>;background-color: <?php echo $theme_color; ?>;}

/* = Footer Style
-------------------------------------------------------------- */
#footer-content {color: <?php echo $custom_footer_text_color;?>;}
#footer-content a {color: <?php echo $custom_footer_a_color;?>;}
#footer-content a:hover {color: <?php echo $theme_color;?>;}
.footer-top-content h1 , 
.footer-top-content h2 ,
.footer-top-content h3 ,
.footer-top-content h4 ,
.footer-top-content h5, 
.footer-top-content h6 {color:<?php echo $custom_footer_h_color; ?>;}

.footer-bottom-content {border-top: none;background-color: <?php echo $custom_footer_copyright_bg_color; ?>;}

#footer-content .footer-copyright a {color: <?php echo $custom_footer_copyright_a_color;?>;}
#footer-content .footer-copyright  a:hover {color: <?php echo $custom_footer_copyright_a_hover_color;?>;}

/* = Other Element Style
-------------------------------------------------------------- */

/* line style */
.left-line {background:<?php echo $theme_color; ?>;}

/* back top */
#back-top:hover {background-color:<?php echo $theme_color; ?>;}

/* 	----------------------------------------------------------------------------------------------	
										C - PAGE STYLES																											
	----------------------------------------------------------------------------------------------	*/

/* = Post , Blog
-------------------------------------------------------------- */

.entry-left-side .post-type , .single-post .post-type {background: <?php echo $theme_color; ?>;}
.entry-right-side .title h3:hover {color:<?php echo $theme_color; ?>;}
.single-post .post-tags .post-tags-icon {background: <?php echo $theme_color; ?>;}

/* post image */
div.left-link:hover ,div.right-link:hover ,div.center-link:hover {background: <?php echo $theme_color; ?>;}
.post-quote-entry {background:<?php echo $theme_color; ?>;}

/* post with ajax */
.post-ajax-element .post-type {background: <?php echo $theme_color; ?>;}

.post-meta a:hover , 
.comment-meta a:hover , 
.search-post-mate a:hover {color:<?php echo $theme_color; ?> !important;}

/* = Portfolio Style
-------------------------------------------------------------- */
.portfolio-filters-cate li a:hover {color: #7AB80E;border: 1px solid <?php echo $theme_color; ?>;}
.portfolio-wrap .post-tip h4 , .portfolio-wrap .post-tip h5 {color: <?php echo $theme_color; ?>;}
.portfolio-element.portfolio-style-1:hover .portfolio-content { border-bottom: 1px <?php echo $theme_color; ?> solid;}
.portfolio-element:hover .portfolio-content h5 {color: <?php echo $theme_color; ?>;}
.post-tip-info .portfolio-client {color: <?php echo $theme_color; ?>;}

/* 	----------------------------------------------------------------------------------------------	
										D. WIDGETS																										
	----------------------------------------------------------------------------------------------	*/

/* ------- 2. Button  ------- */
.btn-custom , input.btn-custom {border-color:<?php echo $theme_color; ?>;background: <?php echo $theme_color; ?>;}
.btn-custom:hover , input.btn-custom:hover {background:<?php echo $theme_over_color; ?>;}

/* ------- 3. Home Post Widget  ------- */
.blog-big-widget .post-type {background: <?php echo $theme_color; ?>;}

/* ------- 5. Search Form  ------- */
.sidebar-searchform input[type=submit] ,
.widget_product_search #searchform input[type=submit] {border: none;background-color:<?php echo $theme_color; ?>;}

/* ------- 6. Archive  ------- */
.footer-top-content .widget_archive ul li a:hover , 
.footer-top-content .widget_login ul li a:hover ,
.footer-top-content .widget_categories ul li a:hover ,
.footer-top-content .widget_product_categories ul li a:hover ,
.footer-top-content .widget_nav_menu ul li a:hover ,
.footer-top-content .widget_alternaportfoliocategorywidget ul li a:hover ,
.footer-top-content .widget_recent_entries ul li a:hover ,
.footer-top-content .widget_pages  ul li a:hover ,
.footer-top-content .widget_recent_comments ul li:hover ,
.footer-top-content .widget_meta ul li a:hover ,
.footer-top-content .widget_links ul li a:hover ,
.footer-top-content .widget_tag_cloud .tagcloud a:hover{
	background: <?php echo $theme_color; ?>;
}
.footer-top-content .widget_recent_comments ul li a:hover {
	color:<?php echo $theme_over_color; ?> !important;
}

/* ------- 7. Sidebar Portfolio Recent  ------- */
.sidebar-portfolio-recent .portfolio-type {background: <?php echo $theme_color; ?>;}

/* ------- 9. Blog List  ------- */
.shortcode-post-element .date {background: <?php echo $theme_color; ?>;}
.shortcode-post-element .post-comments a:hover {color:<?php echo $theme_color; ?>;}

.skills .skill-bg {	background: <?php echo $theme_color; ?>;}
/* 	----------------------------------------------------------------------------------------------	
										E - EXTRAS																					
	----------------------------------------------------------------------------------------------	*/

/* = Shortcode Element Style
-------------------------------------------------------------- */

/* ------- 1. Call To Action  ------- */
.call-to-action-bar {border-left:10px <?php echo $theme_color; ?> solid;background:#f4f4f4;}

/* ------- 2. Tabs  ------- */
.tabs .tabs-nav li.current {border-top:2px <?php echo $theme_color; ?> solid;}

/* ------- 9. Services  ------- */
.services.show-bg:hover {background:<?php echo $theme_color; ?>;}
.services .services-icon {background: <?php echo $theme_color; ?>;}
.services.show-bg:hover .services-icon {color: <?php echo $theme_color; ?>;}

/* ------- 11. History  ------- */
.history .history-date{background: <?php echo $theme_color; ?>;}
.history .history-line {background: <?php echo $theme_color; ?>;}
.history .history-hor-line {background: <?php echo $theme_color; ?>;}
.history .history-start-point {border: 4px <?php echo $theme_color; ?> solid;}

/* ------- 12. Features  ------- */
.features.show-bg:hover {background:<?php echo $theme_color; ?>;}
.features .features-icon {background: <?php echo $theme_color; ?>;}
.features.show-bg:hover .features-icon {color: <?php echo $theme_color; ?>;}
.features.show-bg:hover h3 , .features.show-bg:hover .features-content{color:#ffffff;}


/* ------- 13. WooCommerce  ------- */

.woocommerce a.button:hover, .woocommerce-page a.button:hover, .woocommerce button.button:hover, 
.woocommerce-page button.button:hover, .woocommerce input.button:hover, .woocommerce-page input.button:hover, 
.woocommerce #respond input#submit:hover, .woocommerce-page #respond input#submit:hover, 
.woocommerce #content input.button:hover, .woocommerce-page #content input.button:hover ,
.woocommerce ul.products li.product h3:hover, .woocommerce-page ul.products li.product h3:hover {
	color:<?php echo $theme_color; ?>;
}

.woocommerce div.product span.price, .woocommerce-page div.product span.price, 
.woocommerce #content div.product span.price, .woocommerce-page #content div.product span.price,
.woocommerce div.product p.price, .woocommerce-page div.product p.price, .woocommerce #content div.product p.price, 
.woocommerce-page #content div.product p.price {
	color:<?php echo $theme_color; ?>;
}

.woocommerce div.product .stock,.woocommerce-page div.product .stock,
.woocommerce #content div.product .stock,
.woocommerce-page #content div.product .stock{
	color:<?php echo $theme_color; ?>;
}

.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price{color:<?php echo $theme_color; ?>;}

.woocommerce span.onsale, .woocommerce-page span.onsale {background: <?php echo $theme_color; ?>;}

.woocommerce ul.product_list_widget li .amount {	color:<?php echo $theme_color; ?>;}

.woocommerce a.button.alt,.woocommerce-page a.button.alt,.woocommerce button.button.alt,
.woocommerce-page button.button.alt,.woocommerce input.button.alt,.woocommerce-page input.button.alt,
.woocommerce #respond input#submit.alt,.woocommerce-page #respond input#submit.alt,
.woocommerce #content input.button.alt,.woocommerce-page #content input.button.alt{
	background:<?php echo $theme_color; ?>;
	border-color:<?php echo $theme_over_color; ?>;
}

.woocommerce a.button.alt:hover,.woocommerce-page a.button.alt:hover,.woocommerce button.button.alt:hover,
.woocommerce-page button.button.alt:hover,.woocommerce input.button.alt:hover,.woocommerce-page input.button.alt:hover,
.woocommerce #respond input#submit.alt:hover,.woocommerce-page #respond input#submit.alt:hover,
.woocommerce #content input.button.alt:hover,.woocommerce-page #content input.button.alt:hover{
	background:<?php echo $theme_over_color; ?>;
}

.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle{
	background:<?php echo $theme_color; ?>;
}

.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range{
	background:<?php echo $theme_color; ?> url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAADCAYAAABS3WWCAAAAFUlEQVQIHWP4//9/PRMDA8NzEPEMADLLBU76a5idAAAAAElFTkSuQmCC) top repeat-x;box-shadow:inset 0 0 0 1px rgba(0,0,0,0.5);
}

.cart-collaterals .cart_totals .discount td{color:<?php echo $theme_color; ?>;}

<?php endif; ?>

@media only screen and (-Webkit-min-device-pixel-ratio: 1.5),
only screen and (-moz-min-device-pixel-ratio: 1.5),
only screen and (-o-min-device-pixel-ratio: 3/2),
only screen and (min-device-pixel-ratio: 1.5) {
<?php 
if(alterna_get_options_key('logo-txt-enable') != "yes") :  
?>
.logo a { background-image:url(<?php echo alterna_get_options_key('logo-retina-image') == "" ? "../img/logo@2x.png" : $alterna_options['logo-retina-image'];?>); }
<?php 
endif; 
if(alterna_get_options_key('fixed-enable') == "yes") : 
?>
.fixed-logo a { background-image:url(<?php echo alterna_get_options_key('fixed-logo-retina-image') == "" ? "../img/fixed-logo@2x.png" : $alterna_options['fixed-logo-retina-image'];?>); }
<?php 
endif; 
if(intval(alterna_get_options_key('global-layout')) == 0 && intval(alterna_get_options_key('global-bg-type')) == 0) : 
?>
body { background-image:url(<?php echo alterna_get_options_key('global-bg-retina-image') == "" ? "../img/wild_oliva@2x.png" : $alterna_options['global-bg-retina-image'];?>); }
<?php 
endif;
?>
}