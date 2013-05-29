<?php
/**
 * alterna functions and definitions
 *
 * @since alterna 1.0
 */
 
 
/**
 * All alterna common functions.
 * Don't remove it.
 *
 * @since alterna 1.0
 */
require_once("inc/alterna-functions.php");

/**
 * Sets up theme custom options, post, update notifier.
 * Don't remove it.
 *
 * @since alterna 1.0
 */
include_once("inc/penguin-config.php");
include_once("inc/tools/sidebar_generator.php");
require_once('inc/plugins-config.php');

/**
 * Get all alterna options value
 */
global $alterna_options;
$alterna_options = get_option("alterna_options");

if (class_exists( 'woocommerce' )) {
	// Disable WooCommerce styles
	define('WOOCOMMERCE_USE_CSS', false);
	
	global $woocommerce_loop;
	$woocommerce_loop['columns'] = 4;
	
	// Display 24 products per page. Goes in functions.php
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 24;' ), 20 );
}

// Generate Options CSS
add_action('admin_init', 'alterna_generate_options_css');

// register an action (can be any suitable action)
add_action('admin_init', 'on_envato_init');

function on_envato_init(){
	global $alterna_options;

	if(alterna_get_options_key('theme-update-enable') != "yes" || alterna_get_options_key('theme-name') == "" || alterna_get_options_key('theme-api') == "") return false;
	
    // include the library
    include_once('envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php');
    
    $upgrader = new Envato_WordPress_Theme_Upgrader(alterna_get_options_key('theme-name') , alterna_get_options_key('theme-api') );
    /*
     *  Uncomment to check if the current theme has been updated
     */
     $upgrader->check_for_theme_update(); 

    /*
     *  Uncomment to update the current theme
     */
     $upgrader->upgrade_theme();
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 940;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links and post formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since alterna 1.0
 */
function alterna_setup() {

	// Load the Themes' Translations throught domain
	load_theme_textdomain( 'alterna', get_template_directory() . '/languages' );
	
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'alterna_menu', __( 'Alterna Menus', 'alterna' ) );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ,'image' , 'quote' ) );
	
	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );
	
	// Add woocommerce support
	add_theme_support( 'woocommerce' );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be the size of the header image that we just defined
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( 704, 340, true );
	
	//post
	alterna_add_image_size( 'post-thumbs' , 450 , 306 , true);
	
	//portfolio
	alterna_add_image_size( 'portfolio-two-thumbs' , 650 , 442 , true);
	alterna_add_image_size( 'portfolio-three-thumbs' , 450 , 306 , true);
	alterna_add_image_size( 'portfolio-four-thumbs' , 350 , 238 , true);
	
	alterna_add_image_size( 'portfolio-single-thumbs' , 770 , 500 , true);
	
	if (class_exists( 'woocommerce' )) {
		// Image sizes
		update_option( 'woocommerce_thumbnail_image_width', '372' ); // Image gallery thumbs
		update_option( 'woocommerce_thumbnail_image_height', '999' );
		update_option( 'woocommerce_single_image_width', '372' ); // Featured product image
		update_option( 'woocommerce_single_image_height', '999' );
		update_option( 'woocommerce_catalog_image_width', '372' ); // Product category thumbs
		update_option( 'woocommerce_catalog_image_height', '999' );
		 
		// Hard Crop [0 = false, 1 = true]
		update_option( 'woocommerce_thumbnail_image_crop', 0 );
		update_option( 'woocommerce_single_image_crop', 0 );
		update_option( 'woocommerce_catalog_image_crop', 0 );
	}
	
}
add_action( 'after_setup_theme', 'alterna_setup' );

/**
 * Sets up theme defaults styles and scripts.
 *
 * @since alterna 1.0
 */
function alterna_init_styles_scripts() {
	global $google_load_fonts,$alterna_options;
	
	//get template directory url
	$dir = get_template_directory_uri();
	
	//get theme version
	$theme_data = wp_get_theme();
	$ver = $theme_data['Version'];
	
	//Stylesheets
	
	/* bootstrap & fontawesome css files */
	wp_enqueue_style( 'bootstrap', $dir . '/bootstrap/css/bootstrap.min.css' , array() , $ver );
	wp_enqueue_style( 'fontawesome', $dir . '/fontawesome/css/font-awesome.min.css' , array() , $ver );
	
	wp_enqueue_style( 'flexslider_style', $dir . '/js/flexslider/flexslider.css' , array() , $ver );
	wp_enqueue_style( 'prettyPhoto_style', $dir . '/js/prettyPhoto/prettyPhoto.css' , array() , $ver );
	
	if (class_exists( 'woocommerce' )) { wp_enqueue_style( 'woocommerce_style', $dir . '/woocommerce/assets/css/woocommerce.css' , array() , $ver ); }

	wp_enqueue_style( 'alterna_style', $dir . '/style.css' , array() , $ver );
	
	//Responsive
	if(intval(alterna_get_options_key('global-responsive')) == 0 ) {
		wp_enqueue_style( 'bootstrap_responsive', $dir . '/bootstrap/css/bootstrap-responsive.min.css' , array() , $ver );
		wp_enqueue_style( 'alterna_responsive', $dir . '/css/responsive.css' , array() , $ver );
	}
	
	//Custom
	alterna_get_custom_font();
	$alterna_options_update = get_option('alterna_options_update');
	if(isset($alterna_options_update['version'])){
		wp_enqueue_style('custom-styles', $dir . '/custom/custom-styles.css' , array() , $alterna_options_update['version'] );
	}
	
	//Font
	if(alterna_get_options_key('custom-enable-font') != "yes" || (alterna_get_options_key('custom-enable-font') == "yes" && alterna_get_options_key('custom-general-font') =="0") ){
		wp_enqueue_style( 'source_sans_pro', $dir . '/inc/font/source-sans-pro/stylesheet.css' , array() , $ver );
	}
	
	if(alterna_get_options_key('custom-enable-font') != "yes" || (alterna_get_options_key('custom-enable-font') == "yes" && alterna_get_options_key('custom-menu-font') =="0") ){
		wp_enqueue_style( 'oswald', $dir . '/inc/font/oswald/stylesheet.css' , array() , $ver );
	}

	if($google_load_fonts != null && $google_load_fonts != ""){
		wp_enqueue_style( 'custom-font', 'http://fonts.googleapis.com/css?family='.$google_load_fonts);
	}
	
	//Javascripts
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'bootstrap' , $dir . '/bootstrap/js/bootstrap.min.js' , array('jquery') , $ver , true);
	wp_enqueue_script( 'isotope' , $dir . '/js/jquery.isotope.min.js' , array('jquery') , $ver , true);
	wp_enqueue_script( 'prettyPhoto' , $dir . '/js/prettyPhoto/jquery.prettyPhoto.js' , array('jquery') , $ver , true);
	wp_enqueue_script( 'flexslider_js' , $dir . '/js/flexslider/jquery.flexslider-min.js' , array('jquery') , $ver , true);
	wp_enqueue_script( 'alterna' , $dir . '/js/jquery.theme.js' , array('jquery') , $ver , true);
	
}
add_action('wp_enqueue_scripts', 'alterna_init_styles_scripts');

/**
 * Sets up custom theme styles
 *
 * @since alterna 1.0
 */
function alterna_custom_styles(){
	global $alterna_options;
	
	if(alterna_get_options_key('custom-enable-css') == "yes" && alterna_get_options_key('custom-css-content') != ""){
		?>
        <style id="alterna-custom-css" type="text/css">
			<?php echo $alterna_options['custom-css-content']; ?>
		</style>
        <?php 
	}
	
	echo (intval(alterna_get_options_key('google_analytics-position')) == 0) ? alterna_get_options_key('google_analytics-text') : "";
	
}
add_action( 'wp_head', 'alterna_custom_styles' );

/**
 * Sets up footer custom theme styles
 *
 * @since alterna 1.0
 */
function alterna_wp_footer_scripts(){
	global $alterna_options;
	//get template directory url
	$dir = get_template_directory_uri();

	/* google map */
	wp_enqueue_script( 'googleapis', 'http://maps.googleapis.com/maps/api/js?v=3&amp;sensor=true');
	wp_enqueue_script( 'map-infobox', $dir . '/js/infobox.js');
	
	if(alterna_get_options_key('custom-enable-scripts') == "yes" && alterna_get_options_key('custom-scripts-content') != ""){
		?>
        <script type="text/javascript">
			<?php echo $alterna_options['custom-scripts-content']; ?>
		</script>
        <?php 
	}
	
	echo (intval(alterna_get_options_key('google_analytics-position')) == 1) ? alterna_get_options_key('google_analytics-text') : "";
}
add_action( 'wp_footer', 'alterna_wp_footer_scripts' );

/**
 * Add shortcode
 *
 * @since alterna 1.0
 */
 
// Use shortcodes in text widgets.
add_filter('widget_text', 'do_shortcode');
include("inc/shortcodes.php");

/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 *
 * @since alterna 1.0
 */
function alterna_widgets_init() {
	
	register_sidebar( array(
		'name' => __( 'Global Sidebar', 'alterna' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="line"></div><div class="clear"></div>'
	));
	
	register_sidebar( array(
		'id'	=>'sidebar-footer-1',
		'name' => __( 'Footer 1', 'alterna' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4><div class="line"></div><div class="clear"></div>'
	));
	
	register_sidebar( array(
		'id'	=>'sidebar-footer-2',
		'name' => __( 'Footer 2', 'alterna' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4><div class="line"></div><div class="clear"></div>'
	));
	
	register_sidebar( array(
		'id'	=>'sidebar-footer-3',
		'name' => __( 'Footer 3', 'alterna' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4><div class="line"></div><div class="clear"></div>'
	));
	
	register_sidebar( array(
		'id'	=>'sidebar-footer-4',
		'name' => __( 'Footer 4', 'alterna' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4><div class="line"></div><div class="clear"></div>'
	));
	
	register_sidebar( array(
		'id'	=>'shop',
		'name' => __( 'Woocommerce Shop', 'alterna' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4><div class="line"></div><div class="clear"></div>'
	));
	
		register_sidebar( array(
		'id'	=>'shop-2',
		'name' => __( 'Woocommerce Shop', 'alterna' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4><div class="line"></div><div class="clear"></div>'
	));

}
add_action( 'widgets_init', 'alterna_widgets_init' );
include_once("inc/custom-widgets.php");

/**
 * Get footer widget items columns
 */
function alterna_get_footer_widget_active_items(){
	$count = 0;
	$cols = 12;
	if (function_exists('dynamic_sidebar')){
		if(is_active_sidebar('sidebar-footer-1')) $count++;
		if(is_active_sidebar('sidebar-footer-2')) $count++;
		if(is_active_sidebar('sidebar-footer-3')) $count++;
		if(is_active_sidebar('sidebar-footer-4')) $count++;
		if($count == 0) return 'span12';
		$cols = 12/$count;
	}
	return 'span'.$cols;
}

/**
 * Redesign login page
 */
function alterna_login_logo() { 
	global $alterna_options;
?>
    <style type="text/css">
        body.login div#login h1 a {
			background: url(<?php echo alterna_get_options_key('logo-image') == "" ?  get_template_directory_uri()."/img/logo.png" : $alterna_options['logo-image']; ?>) no-repeat top center;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'alterna_login_logo' );

function alterna_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'alterna_login_logo_url' );

function alterna_login_logo_url_title() {
    return get_bloginfo('title');
}
add_filter( 'login_headertitle', 'alterna_login_logo_url_title' );

?>