<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @since alterna 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<?php 
global $page, $paged, $post;

// get the current page
$paged = 1;
if (get_query_var('paged')) {
	$paged = get_query_var('paged');
} else if (get_query_var('page')) {
	$paged = get_query_var('page');
}
		
/* Custom SEO */
if( alterna_get_options_key('seo-enable') == "yes" && (is_home() || is_page() || is_single() || (taxonomy_exists('portfolio_categories') && is_tax())) ) {
	
	$meta_title ="";
	$meta_description="";
	$meta_keywords="";

	$page_id = get_the_ID();
 
	if(is_home() && is_front_page()){
		$meta_title 		= alterna_get_options_key('seo-title');
		$meta_description 	= alterna_get_options_key('seo-description');
		$meta_keywords 		= alterna_get_options_key('seo-keywords');
	}else{
		if((is_home() && !is_front_page()))	$page_id = get_option('page_for_posts');
		if((!is_home() && is_front_page()))	$page_id = get_option('page_on_front');
		$meta_title 		= get_post_meta($page_id , 'seo-title', true);
		$meta_description 	= get_post_meta($page_id , 'seo-description', true);
		$meta_keywords 		= get_post_meta($page_id , 'seo-keywords', true);
	}
	
	?><title><?php

	if($meta_title == "") {
		wp_title( '|', true, 'right' );
	} else {
		echo $meta_title.' | ';
	}
	
	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'alterna' ), max( $paged, $page ) );
	
	?></title><?php
	
	//Description
	echo '<meta name="description" content="'.$meta_description.'" />';
	
	//Keywords
   	echo '<meta name="keywords" content="'.$meta_keywords.'" />';
	
} else {
?><title><?php

	wp_title( '|', true, 'right' );
	
	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'alterna' ), max( $paged, $page ) );
	
?></title><?php } ?>

<?php if(intval(alterna_get_options_key('global-responsive')) == 0 ) : ?>
<!-- Mobile viewport optimized: j.mp/bplateviewport -->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php endif; ?>

<link rel="shortcut icon" href="<?php echo (alterna_get_options_key('favicon') != "") ? alterna_get_options_key('favicon') : get_template_directory_uri()."/img/favicon.png";?>" />

<link rel="profile" href="http://gmpg.org/xfn/11" />

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!--[if IE 7]>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/fontawesome/css/font-awesome-ie7.min.css">
<![endif]-->

<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/main.css" type="text/css" /></head>

<body <?php body_class( array((intval(alterna_get_options_key('global-layout')) == 0 ? 'boxed-layout' : 'full-width-layout') , (intval(alterna_get_options_key('global-responsive')) == 0 ? '' : 'fixed-width'))); ?>>
	<div class="header-wrap <?php echo intval(alterna_get_options_key('global-layout')) == 0 ? 'container' : '';?>">
    	<!-- header alert message -->
        <div class="header-top-content" >
        	<div class="container">
                <div class="header-information">
                    <?php echo do_shortcode(alterna_get_options_key('header-alert-message'));  ?>
                    <?php
						if (class_exists( 'woocommerce' )) {
							get_template_part('woocommerce/content-header');
						}else if( alterna_get_options_key('custom-enable-login') == "yes" && alterna_get_options_key('custom-login-page') != ""){ ?>
						<div class="custom-login-header">
                        	<div class="custom-login">
                             <?php if ( is_user_logged_in() ) { ?>
                                <a href="<?php echo alterna_get_options_key('custom-login-page'); ?>" title="<?php _e( 'View your account', 'alterna' ); ?>"><?php 
                                    global $current_user;
                                    get_currentuserinfo();
                                    if($current_user->user_firstname)
                                        echo __('Welcome, ','alterna') . $current_user->user_firstname;
                                    elseif($current_user->display_name)
                                        echo __('Welcome, ','alterna') . $current_user->display_name;
                                ?></a>&nbsp;&nbsp;<?php _e('|','alterna'); ?>&nbsp;&nbsp;<a href="<?php echo wp_logout_url(get_permalink()); ?>"><?php _e('Log out','alterna'); ?></a>                                
                                <?php }	else { ?>
                                <a class="wc-login-in" href="<?php echo alterna_get_options_key('custom-login-page'); ?>" title="<?php _e( 'Login / Register', 'alterna' ); ?>"><?php _e( 'Login / Register', 'alterna' ); ?></a>
                                <?php } ?>
                            </div>
                        </div>	
					<?php	}
					?>
                 </div>
            </div>
        </div>
        
        <header class="container">
        	<!-- logo & social -->
            <div id="alterna-header" class="row-fluid">
                <div class="logo">
                    <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php if(alterna_get_options_key('logo-txt-enable')  == "yes") echo '<h2>'.get_bloginfo( 'name' ).'</h2>'; ?></a>
                </div>
                <?php if(intval(alterna_get_options_key('header-right-area-type')) == 0) : ?>
                <div class="header-social-container">
                    <ul class="inline alterna-social header-social">
                        <?php 
                        echo alterna_get_social_list(); 
                        if(alterna_get_options_key('rss-feed') != "") echo '<li><a title="'.__('rss','alterna').'" href="'.alterna_get_options_key('rss-feed').'" class="alterna-icon-rss"></a></li>';
                        ?>
                    </ul>
                 </div>
                 <?php else : ?>
                 <div class="header-custom-container">
                 	<?php echo do_shortcode(alterna_get_options_key('header-right-area-content')); ?>
                 </div>
                 <?php endif; ?>
            </div>
            
            <!-- mobile show drop select menu -->
            <div id="alterna-drop-nav" class="row-fluid navbar">
            	<div id="alterna-nav-menu-select" class="navbar-inverse">
                	<button type="button" class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                     </button>
                     <div class="nav-collapse collapse"><ul class="nav"></ul></div>
                </div>
            </div>
            
            <!-- menu & search form -->
            <nav id="alterna-nav" class="row-fluid">
            	<div class="container">
                <?php if(alterna_get_options_key('fixed-enable') == "yes") : ?>
                <div class="fixed-logo">
                    <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"></a>
                </div>
                <?php endif; ?>
				<?php 
                    $alterna_main_menu = array(
                        'theme_location'  	=> 'alterna_menu',
                        'container_class'	=> 'alterna-nav-menu-container',
                        'menu_class'    	=> 'alterna-nav-menu',
                        'fallback_cb'	  	=> 'alterna_show_setting_primary_menu'
                    ); 
                    wp_nav_menu($alterna_main_menu);
                ?>
                <div class="alterna-nav-form-container">
                    <div class="alterna-nav-form">
                        <form role="search" class="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                           <div>
                               <input id="sf-s" name="s" type="text" placeholder="<?php _e('Search','alterna'); ?>" />
                               <input id="sf-searchsubmit" type="submit" value="" />
                           </div>
                        </form>
                    </div>
                </div>
                </div>
            </nav>
        </header>
    
    </div><!-- end header-wrap -->
    
    <div class="content-wrap <?php echo intval(alterna_get_options_key('global-layout')) == 0 ? 'container' : '';?>">
    
    <?php 
		// current post, page id
		$post_id = ($post) ? $post->ID : '-1';
		if(is_home() && !is_front_page()) $post_id = get_option('page_for_posts');
		// show header layerslider
		if(!(is_category()|| is_tag() || is_404() || is_search() || is_date()) && intval(get_post_meta($post_id , 'slide-type', true)) != 0) :
	?>
    	<?php if(intval(get_post_meta($post_id , 'slide-type', true)) == 1 && intval(get_post_meta($post_id , 'layer-slide-id', true)) != 0) : ?>
        	<div id="layerslide-container" class="container">
            <?php echo do_shortcode('[layerslider id="'.(intval(get_post_meta($post_id , 'layer-slide-id', true))).'"]'); ?>
        	</div>
        <?php elseif(intval(get_post_meta($post_id , 'slide-type', true)) == 2 && intval(get_post_meta($post_id , 'rev-slide-id', true)) != 0) : ?>
        	<div id="revslide-container" class="container">
            	<?php echo do_shortcode('[rev_slider '.(intval(get_post_meta($post_id , 'rev-slide-id', true))).']'); ?>
        	</div>
        <?php endif; ?>
    <?php endif;  ?>
    
    
    <?php // show header title
		
		$current_tax = get_query_var('taxonomy');

		if((is_tax() && taxonomy_exists('product_cat') && $current_tax == "product_cat") || is_singular('product')) {
			echo '';
		} elseif (((is_home()|| is_page() || is_single()) && intval(get_post_meta($post_id , 'title-show', true)) == 0) && !is_front_page()) { ?>
		<div id="page-header" class="container">
        	<div class="page-header-content row-fluid">
            	<div class="title span12">
        			<?php 
						$title = get_post_meta($post_id, 'title-content', true);
						if($title == '') $title = '<h2>'.get_the_title($post_id).'</h2>';
						echo $title; 
					?>
                </div>
            </div>
            <div class="line"></div>
            <div class="desc row-fluid">
            	<ul><?php echo alterna_page_links(); ?></ul>
            </div>
        </div>
    <?php } elseif ( ((is_tax() && taxonomy_exists('portfolio_categories') && $current_tax == "portfolio_categories") || is_category()|| is_tag() || is_404() || is_search() || is_date()) && !is_front_page()) {?>
		<div id="page-header" class="container">
        	<div class="page-header-content row-fluid">
            	<div class="title span12">
        			<h2><?php echo alterna_page_title();?></h2>
                </div>
            </div>
            <div class="line"></div>
            <div class="desc row-fluid">
            	<ul>
                <?php echo alterna_page_links(); ?>
                <?php if(is_search()) : ?>
                	<li><i class="icon-chevron-right"></i><span><?php printf( __( 'Search Results for "%s"', 'alterna' ), get_search_query() ); ?></span></li>
                <?php endif; ?>
                </ul>
            </div>
        </div>
    <?php } ?>