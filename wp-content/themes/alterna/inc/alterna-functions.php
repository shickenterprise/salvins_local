<?php

//========================================================
//  	THEME METHODS
//========================================================

/**
 * Display navigation to pagination pages numbers when applicable
 *
 * @since alterna 1.0
 */
function alterna_content_pagination($pagination_id, $pagination_class  = '' , $max_show_number = 2 , $query = '') {
	global $wp_query;
	if($query == '') $query = $wp_query;

	if ( $query->max_num_pages > 1 ) {
		// get the current page
		$paged = 1;
		if (get_query_var('paged')) {
			$paged = get_query_var('paged');
		} else if (get_query_var('page')) {
			$paged = get_query_var('page');
		}
		
		?>
        <div id="<?php echo $pagination_id; ?>" class="pagination <?php echo $pagination_class; ?>">
            <ul>
            <?php
                $max_number = $query->max_num_pages;
                //prev button
                if($paged > 1){
					echo '<li><a href="'. get_pagenum_link($paged-1) .'">'.__('&laquo','alterna').'</a></li>';
					if($paged - $max_show_number > 1) echo '<li><a href="'. get_pagenum_link(1) .'">1</a></li>';
				}
				
                if($paged - $max_show_number > 2) echo  '<li><span>...</span></li>';
				
                for($k= $paged - $max_show_number; $k <= ($paged+$max_show_number) & $k <= $max_number; $k++){
                    if($k < 1) continue;
                    if($k == $paged) 
                        echo '<li><span class="disabled">'.$k.'</span></li>';
                    else
                        echo '<li><a href="'.get_pagenum_link( $k).'">'.$k.'</a></li>';
                }
                if($paged + $max_show_number < $max_number) {
                     if($paged + $max_show_number < ($max_number-1)) echo  '<li><span>...</span></li>';
                     echo '<li><a href="'.get_pagenum_link( $max_number ).'">'.$max_number.'</a></li>';
                }
                //next button
                if($paged < $max_number) echo '<li><a href="'.get_pagenum_link($paged+1).'">'.__('&raquo;','alterna').'</a></li>';
				
            ?>
            </ul>
         </div>
        <?php
	}
}

/**
 * get show have no menu information
 *
 * @since alterna 1.0
 */
function alterna_show_setting_primary_menu(){
	echo '<h5 style="float:left;color: #ffffff;margin-left: 10px;line-height: 20px;">'.__('Please open Admin -&gt; Appearance -&gt; Menus Setting','alterna').'</h5>';
}

/**
 * get Custom Font For google font	
 *
 * @since alterna 1.0
 */
function alterna_get_custom_font(){
	global $alterna_options,$google_fonts,$google_load_fonts,$google_custom_fonts;
	
	$google_load_fonts = "";
	$google_custom_fonts = array();
	
 	$general_font 				= 'SourceSansProRegular';
	$general_font_size 			= '14px';
	$menu_font					= 'Oswald';
	$menu_font_size				= '13px';
	$title_font					= 'Open Sans';
	
	$font_names = array();
	
	if(alterna_get_options_key('custom-enable-font') == "yes"){
		
		$array = explode("|",$google_fonts);
		
		if( alterna_get_options_key('custom-general-font') !="0"){
			$font_name = $array[intval($alterna_options['custom-general-font'])-1];
			$general_font = alterna_get_current_font_name($font_name);
			if(intval($alterna_options['custom-general-font'])-1 < 532){
				array_push($font_names,$font_name);
			}
		}
			
		if( alterna_get_options_key('custom-menu-font') !="0"){
			$font_name = $array[intval($alterna_options['custom-menu-font'])-1];
			$menu_font = alterna_get_current_font_name($font_name);
			if(intval($alterna_options['custom-general-font'])-1 < 532){
				array_push($font_names,$font_name);
			}
		}
		
		if( alterna_get_options_key('custom-title-font') !="0"){
			$font_name = $array[intval($alterna_options['custom-title-font'])-1];
			$title_font = alterna_get_current_font_name($font_name);
			if(intval($alterna_options['custom-general-font'])-1 < 532){
				array_push($font_names,$font_name);
			}
		}else{
			array_push($font_names,'Open+Sans:400,400italic,300,300italic');
		}
	}else{
		array_push($font_names,'Open+Sans:400,400italic,300,300italic');
	}

	$google_custom_fonts['general_font']				= $general_font;
	$google_custom_fonts['menu_font']					= $menu_font;
	$google_custom_fonts['title_font']					= $title_font;
	
	$google_load_fonts = implode("|",array_unique($font_names));
}

/**
 * Get current font name
 *
 * @since Alterna 1.0
 */
function alterna_get_current_font_name($font_name){
	$arr = explode(":", str_replace("+"," ",$font_name) );
	return $arr[0];
}

/**
 * Display navigation to next/previous pages when applicable
 *
 * @since alterna 1.0
 */
function alterna_content_nav( $nav_id ,$nav_class = '' ) {
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) : ?>
        <nav id="<?php echo $nav_id; ?>"  class="posts-nav <?php echo $nav_class; ?>">
			<div class="nav-prev"><?php next_posts_link( __( '&larr; Older posts', 'alterna' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'alterna' ) ); ?>
		</nav>
	<?php endif;
}

/**
 * Display single post navigation to next/previous post when applicable
 *
 * @since alterna 1.0
 */
function alterna_single_content_nav( $nav_id ,$nav_class = '' ) {
?>
	<nav class="single-pagination row-fluid">
		<?php previous_post_link('%link', __('&laquo; Previous', 'alterna').'<span class="post-title">'.'%title'.'</span>'); ?>
		<?php next_post_link('%link ', '<span class="post-title">'.'%title'.'</span>'.__('Next &raquo;', 'alterna')); ?>
	</nav>
<?php
}

/**
 * Get Page Layout
 * @since alterna 1.0
 */
function alterna_get_page_layout($id = "-1") {
	if($id != 'global'){
		$layout = intval(get_post_meta($id != "-1" ? $id : get_the_ID(), 'layout-type', true));
		if($layout != 0) return $layout;
	}
	return intval(alterna_get_options_key('global-sidebar-layout')) == 0 ? 2 : 3 ;
}

/**
 * Get Page Header Links
 *
 * @since alterna 1.0
 */
function alterna_page_links() {
	
	$output = '';
	// page is not front page show first link with "home" page;
    if( !is_front_page() ) {
       $output .= '<li><i class="icon-home"></i><a href="'.home_url().'" title="'.__('Home','alterna').'">'.__('HOME','alterna').'</a></li>';
    }
    
	// page is used home page as posts
	if((is_home() || is_category() || is_tag() || is_date() || is_single()) && !is_front_page()){
		
		$single_type = get_post_type(get_the_ID());
		
		if(is_single() && $single_type == "portfolio") {
			global $portfolio_default_page_id;
		
			// show default portfolio page
			$portfolio_default_page_id  = alterna_get_default_portfolio_page();
			$portfolio_page = get_page( $portfolio_default_page_id );
			
			$output .= '<li><i class="icon-chevron-right"></i><a href="'.get_permalink($portfolio_default_page_id).'" title="'.$portfolio_page->post_title.'">'.$portfolio_page->post_title.'</a></li>';
		} else {
			if(intval(get_option('page_for_posts')) > 0) {
				$page = get_page( get_option('page_for_posts') );
				$output .= '<li><i class="icon-chevron-right"></i><a href="'.get_permalink(get_option('page_for_posts')).'" title="'.$page->post_title.'">'.$page->post_title.'</a></li>';
			}
		}
	}
	
	// page is category
	if(is_category()){
		$cat = get_category( get_query_var( 'cat' ) );
		$output .= '<li><i class="icon-chevron-right"></i><span>'.__('Category Archive for "','alterna').$cat->name.'"</span></li>';
	}
	
	// show portfolio category link
	if(taxonomy_exists('portfolio_categories') && is_tax()) {
		global $alterna_options,$term,$portfolio_default_page_id;
		
		// show default portfolio page
		$portfolio_default_page_id  = alterna_get_default_portfolio_page();
		$portfolio_page = get_page( $portfolio_default_page_id );
		
		$output .= '<li><i class="icon-chevron-right"></i><a href="'.get_permalink($portfolio_default_page_id).'" title="'.$portfolio_page->post_title.'">'.$portfolio_page->post_title.'</a></li>';
		// show category name
		$output .= '<li><i class="icon-chevron-right"></i><span>'.$term->name.'</span></li>';
	}
	
	// show page title
	if(is_page() || is_single()){
		global $post;
		if ( is_page() && $post->post_parent ) {
      		$parent_id  = $post->post_parent;
      		$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<li><i class="icon-chevron-right"></i><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				$output .= $breadcrumbs[$i];
			}
    	} 
		
		$output .= '<li><i class="icon-chevron-right"></i><span>'.get_the_title().'</span></li>';
	}
	
	// tag page
	if(is_tag()) {

		$output .= '<li><i class="icon-chevron-right"></i><span>'.__('Posts Tagged "','alterna').single_tag_title('', false).'"</span></li>';
	}
	
	// search page
	if(is_search()) {
		//$output .= '<li><i class="icon-chevron-right"></i><span>'.__('Search' , 'alterna').'</span></li>';
	}
	
	// 404 page
	if(is_404()){
		$output .= '<li><i class="icon-chevron-right"></i><span>'.__('404 Error' , 'alterna').'</span></li>';
	}
	
	// date page
	if(is_date()){
		$output .= '<li><i class="icon-chevron-right"></i><span>'.__('Date Archives for "','alterna').get_the_time('Y-M').'"</span></li>';
	}
	return $output;
}

/**
 * Get Page Title
 *
 * @since alterna 1.0
 */
function alterna_page_title(){
	$output = '';
	
	// category page
	if(is_category()) $output = single_cat_title('', false);
	
	// tag page
	if(is_tag()) $output = single_tag_title('', false);
	
	// search page
	if(is_search()) $output = __('Search' , 'alterna');
	
	// 404 page
	if(is_404()) $output = __('Page Not Found' , 'alterna');
	
	// date page
	if(is_date())  $output = get_the_time('Y-M');
	
	if(taxonomy_exists('portfolio_categories') && is_tax()) {
		global $term;
		$output = $term->name;
	}
	
	return $output;
}


/**
 * Get All Portfolio Type Pages
 *
 * @since alterna 1.0
 */
function alterna_get_all_portfolio_type_pages($re_id = false) {
	$portfolio_pages = array();
	
	$p_types = array('page-portfolio.php', 'page-portfolio-ajax.php');
	
	foreach($p_types as $p_type){
		$args = array(
			'meta_key' => '_wp_page_template',
			'meta_value' => $p_type,
			'post_type' => 'page',
			'post_status' => 'publish'
		); 
		$pages = get_pages($args); 
		if(!empty($pages)) {
			foreach($pages as $page){
				if($re_id){
					$portfolio_pages[] = $page->ID;
				}else {
					$portfolio_pages[$page->ID] = $page->post_title;
				}
			}
		}
	}
	
	return $portfolio_pages;
}

/**
 * Get Default Portfolio Page
 *
 * @since alterna 1.0
 */
function alterna_get_default_portfolio_page() {
	global $portfolio_default_page_id;
	
	$default_page_id = intval( alterna_get_options_key('portfolio-default-page') );
	
	$pages = alterna_get_all_portfolio_type_pages(true);
	
	if(isset($pages[$default_page_id])) {
		$default_page_id = $pages[$default_page_id];
		$template = get_post_meta( $default_page_id , '_wp_page_template', true );
		if($template == 'page-portfolio.php' || $template == 'page-portfolio-ajax.php' ) {
			$portfolio_default_page_id = $default_page_id;
			return $portfolio_default_page_id;
		}
		
	}

	foreach($pages as $key=>$value){
		$portfolio_default_page_id = $key;
		break;
	}
	return $portfolio_default_page_id;
}

/**
 * Get all categories
 * @bool = true return <li> list with name
 */
function alterna_get_custom_all_categories($taxonomies,$bool = false){
	$categories = get_terms($taxonomies);
	$output = "";
	// return <li> html code
	if($bool){ 
		foreach($categories as $category){
			$output .= '<li>'.strtoupper($category->name).'</li>';
		}
	} else {
		return $categories;
	}
	return $output;
}

/**
 * Get Portfolio categories
 */
function alterna_get_portfolio_categories(){
	$output = '<ul>';
	$categories = alterna_get_custom_all_categories('portfolio_categories');
	if(count($categories) > 0){
		foreach($categories as $category){
			if(intval($category->parent) != 0) continue;
			$subcategories = get_terms('portfolio_categories',array('child_of' => $category->term_id));

			$output .='<li><a href="'.esc_attr(get_term_link($category, 'portfolio_categories')).'">'.$category->name.' ( '.alterna_get_portfolio_list_by_categories(array($category->term_id),true).' ) '.'</a>';
			if(count($subcategories)>0){
				$output .='<ul>';
				foreach($subcategories as $subcategory){
					$output .='<li><a href="'.esc_attr(get_term_link($subcategory, 'portfolio_categories')).'">'.$subcategory->name.' ( '.alterna_get_portfolio_list_by_categories(array($subcategory->term_id),true).' ) '.'</a></li>';
				}
				$output .='</ul>';
			}
			$output .= '</li>';
		}
	}
    $output .='</ul>';
	return $output;
}


/**
 * Get Portfolio categories
 */
function alterna_get_portfolio_list_by_categories($slugs = array(),$re_count = false){
	$args = array(
			'post_type' => 'portfolio',
			'posts_per_page' => -1, 
			'tax_query' => array(
				array(
					'taxonomy' => 'portfolio_categories',
					'field' => 'term',
					'terms' => $slugs)
				)
			);
	$the_query = new WP_Query($args);
	
	if($re_count){
		if($the_query->have_posts()) return $the_query->post_count;
		return 0;
	}
	return $the_query;
}

/**
 * Get current post categories
 * @bool = true return "," string name
 */
function alterna_get_custom_post_categories($id,$taxonomies,$bool = false,$sep=' , ' , $type = 'name' , $exter = ''){
	$categories = get_the_terms($id,$taxonomies);
	$output = "";
	// return <li> html code
	if($bool && !empty($categories)){
		$first = true;
		foreach($categories as $category){
			if(!$first)
				$output .=$sep;
			else
				$first = false;
				
			$output .= $exter.$category->$type;
		}
	} else {
		return $categories;
	}
	return $output;
}

/**
 * Get custom portfolio category links
 *
 * @since alterna 1.0
 */
function alterna_get_custom_portfolio_category_links($categories , $sep ='' , $taxonomies = "portfolio_categories"){
	
	$output = '';
	if( !empty($categories) ){
		$bool = false;
		foreach($categories as $category){
			if($bool) $output .= $sep;
			$output .= '<a href="'.get_term_link($category->slug, $taxonomies ).'">'.$category->name.'</a>';
			$bool = true;
		}
	}
	if($output == '') $output = __('No Category','alterna');
	return $output;
}

/**
 * get custom post meta list
 *
 * @since alterna 1.0
 */
function alterna_get_custom_post_meta($id,$type = 'post') {

	$custom = get_post_custom($id);
	$output = array();
	$check_array = array();
	switch($type){
		case "post": // Post
			$check_array = array('show-related-post','show-related-post-number');
			break;
		case "portfolio": // Portfolio
			$check_array = array('portfolio-type','video-type','video-content','portfolio-colors','portfolio-skills','portfolio-client','portfolio-link','show-related-portfolio','show-related-portfolio-number');
			break;
	}
	foreach($check_array as $value){
		$output[$value] = isset($custom[$value])  ? $custom[$value][0] : "";
	}
	
	return $output;
}

/**
 * Get social account from alterna setting
 *
 * @since alterna 1.0
 */
function alterna_get_social_list($extra_name=''){
	global $alterna_options;
	
	$str = "";
	$social_list = array(	array('twitter','Twitter') ,
							array('facebook', 'Facebook') ,
							array('google-plus', 'Google Plus') ,
							array('dribbble', 'Dribbble') ,
							array('pinterest', 'Pinterest') ,
							array('flickr', 'Flickr') ,
							array('skype', 'Skype') ,
							array('youtube', 'Youtube') ,
							array('vimeo', 'Vimeo') ,
							array('linkedin', 'Linkedin'),
							array('digg', 'Digg') ,
							array('deviantart', 'Deviantart') ,
							array('behance', 'Behance') ,
							array('forrst', 'Forrst') ,
							array('lastfm', 'Lastfm') ,
							array('xing', 'XING'),
							array('instagram', 'instagram'),
							array('stumbleupon', 'StumbleUpon'),
							array('picasa', 'Picasa')
						);
	foreach($social_list as $social_item){
		
		if(alterna_get_options_key('social-'.$social_item[0]) != '') {
			$str .=  '<li><a title="'.$social_item[0].'" href="'.alterna_get_options_key('social-'.$social_item[0]).'" target="_blank" class="alterna-icon-'.$social_item[0].'"></a></li>';
		}
	}
	
	return $str;
}

/**
 * Get color list
 *
 * @since alterna 1.0
 */
function alterna_get_color_list($string){
	$output = '';
	$colors = explode(",",$string);
	if(count($colors) > 0){
		foreach($colors as $color){
			if($color != '') $output .= '<div class="circle-color show-tooltip" title="'.$color.'" style="background-color:'.$color.'"></div>';
		}
	}
	return $output;
}

/**
 * Get attachments
 * if li true return <li></li>
 * if link true return <a>
 * @since alterna 1.0
 */
function alter_get_attachments($id , $args , $show_size , $re_li = false , $link = false , $link_size = 'full' , $params = '') {
	
	$args = wp_parse_args( $args , array(
		'post_type' => 'attachment',
		'numberposts' => '10',
		'post_status' => null,
		'post_parent' => $id,
		'post_mime_type' => 'image',
		'exclude' => get_post_thumbnail_id($id)
	));
	
	$attachments = get_posts($args);
	
	if($re_li){
		$output = '';
		foreach($attachments as $attachment) { 								
			$attachment_image = wp_get_attachment_image_src($attachment->ID, $show_size );
			$full_image = wp_get_attachment_image_src($attachment->ID, $link_size );
			$attachment_data = wp_get_attachment_metadata($attachment->ID);
			if(is_array($attachment_image) && $attachment_image[0] != '') {
				$output .= '<li>';
				
				if($link == true) {
					$params = $params == '' ? 'rel="prettyPhoto['.$id.']"' : $params;
					$output .= '<a href="'.$full_image[0].'" '.$params.'>';
				}
				$output .= '<img src="'.$attachment_image[0].'" alt="'.$attachment->post_title.'" />';
				if($link == true){
					$output .= '</a>';
				}
				$output .='</li>';
			}
		}
		return $output;
	}

	return $attachments;
}

/**
 * Get comment form
 *
 * @since alterna 1.0
 */
function alterna_comment_form(){
	global $user_identity;
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	if ( comments_open() ) { ?>
		<div id="respond" class="row-fluid">
        	<div id="reply-title" class="alterna-title row-fluid">
            	<h3><?php comment_form_title(__('Leave A Comment', 'alterna'), __('Leave A Comment', 'alterna')); ?></h3>
            	<div class="line row-fluid"><span class="left-line"></span><span class="right-line"></span></div>
        	</div>
            <div class="row-fluid"><?php cancel_comment_reply_link(); ?></div>
			<form id="comment-form" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
        	
            <?php if ( is_user_logged_in() ) : ?>

            <p><?php _e('Logged in as', 'alterna'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e('Log out &raquo;', 'alterna'); ?></a></p>
    		<div class="row-fluid">
            	<div id="comment-textarea" class="span6">
                	<textarea placeholder="<?php _e('Comment...', 'alterna'); ?>" name="comment" id="comment" cols="60" rows="5" tabindex="4" class="textarea-comment logged-in"></textarea>
            	</div>
            </div>
            <div class="form-submit">
                <p><div class=""><input name="submit" class="btn btn-custom" type="submit" id="submit" tabindex="5" value="<?php _e('Post Comment', 'alterna'); ?>" /></div></p>
                <?php comment_id_fields(); ?>
                <?php do_action('comment_form', get_the_ID()); ?>
            </div>
		
		<?php else : ?>
        	<div class="row-fluid">
            	<div id="comment-input" class="span6">
                	<div class="placeholding-input">
                		<input type="text" name="author" id="author" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> class="input-name" />
                        <label for="author" class="placeholder"><?php _e('Name (required)', 'alterna'); ?></label>
                    </div>
                    <div class="placeholding-input">
                		<input type="text" name="email" id="email" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> class="input-email"  />
                        <label for="email" class="placeholder"><?php _e('Email (required)', 'alterna'); ?></label>
                    </div>
                    <div class="placeholding-input">
                		<input type="text" name="url" id="url" tabindex="3" class="input-website" />
                        <label for="url" class="placeholder"><?php _e('Website', 'alterna'); ?></label>
                    </div>
            	</div>
            
            	<div id="comment-textarea" class="span6">
                	<div class="placeholding-input">
                		<textarea name="comment" id="comment" cols="60" rows="5" tabindex="4" class="textarea-comment"></textarea>
                    	<label for="comment" class="comment-placeholder placeholder"><?php _e('Comment...', 'alterna'); ?></label>
                    </div>
            	</div>
            </div>
            <div id="comment-submit">
                <div><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Post Comment', 'alterna'); ?>" class="btn btn-custom" /></div>
                <?php comment_id_fields(); ?>
                <?php do_action('comment_form', get_the_ID()); ?>
            </div>
    
            <?php endif; ?>
        </form>
    </div>
	<?php
	}
}

/**
 * Get comments list
 *
 * @since alterna 1.0
 */
function alterna_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
		
	if ( 'div' == $args['style'] ) {
		//$tag = 'div';
		$add_below = 'comment';
	} else {
		//$tag = 'li';
		$add_below = 'div-comment';
	}
	?>
    
    <li id="comment-<?php comment_ID() ?>">
    	<article id="div-comment-<?php comment_ID() ?>" class="comment-item">
        	<div class="gravatar"><?php if ($args['avatar_size'] != 0) echo  get_avatar( $comment, $args['avatar_size']); ?></div>
        	
        	<div class="comment-content">
            	<div class="comment-meta"><span class="author-name"><?php echo comment_author_link($comment->comment_ID);?></span><span>&nbsp;&nbsp;</span><span class="comment-date"><?php echo get_comment_date(); ?> <?php _e('at', 'alterna'); ?> <?php echo get_comment_time(); ?></span></div>
            	<?php comment_text(); ?>
                <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				<?php if ($comment->comment_approved == '0') : ?>
                      <em class="comment-wait-approved"><?php _e('Your comment is awaiting approved.' , 'alterna') ?></em>
            	<?php endif; ?>
            
        	</div>
    	</article>
    <?php 
}


/**
 * Get portfolio post for sidebar widget
 */
function alterna_get_portfolio_widget_post($type = 'recent' , $per_page = '' , $post_value = '' , $re_list = false , $show_type = 0 , $post__not_in = '') {
	if($per_page == "") $per_page = 5;
	
	$args=array( 'post_type' => 'portfolio', 'post_status' => 'publish', 'posts_per_page' => $per_page );
				 
	switch($type){
		case 'featured':
				$post_ids = explode("," , $post_value);
				if(count($post_ids) == 0) return "";
				$args['post__in']= $post_ids;
				$args['posts_per_page']= count($post_ids);
			break;
		case 'recent':
				
			break;
		case 'related':
				$slugs = explode("," , $post_value);
				if(count($slugs) == 0) return "";
				$args['tax_query'] = array(	array('taxonomy' => 'portfolio_categories',
												'field' => 'slug',
												'terms' => $slugs));
				if($post__not_in != ""){
					$post__not_in = explode("," , $post__not_in);
					$args['post__not_in'] = $post__not_in;
				}
			break;
	}

	$portfolios = new WP_Query($args);
	
	if($re_list) return $portfolios;
	
	$output = "";
	
	if ($portfolios -> have_posts() ){
		while ($portfolios -> have_posts() ) : $portfolios-> the_post();
		
			$custom = alterna_get_custom_post_meta(get_the_ID(),'portfolio');
			
			$output .='<div class="sidebar-portfolio-recent">';
			
			if(intval($show_type) == 0){
			
				$output .= '<div class="sidebar-portfolio-img post-img">';
				if (has_post_thumbnail(get_the_ID()) ) { 
					$output .= get_the_post_thumbnail(get_the_ID(), "portfolio-four-thumbs",array('alt' => get_the_title(get_the_ID()),'title' => get_the_title(get_the_ID())));
				}else{
					$output .= '<img  src="'.get_template_directory_uri().'/img/portfolio-no-thumbs.png" alt="">';
				}
				 $output .= '<div class="post-tip"><div class="bg"></div><a href="'.get_permalink(get_the_ID()).'" ><div class="link center-link"><i class="big-icon-link"></i></div></a></div>';
				$output .='</div>';
				$output .='<div class="sidebar-portfolio-title"><a title="'.get_the_title().'" href="'.get_permalink(get_the_ID()).'">'.get_the_title().'</a>';
			}else{
				$icon_class = 'big-icon-picture';
				switch(intval($custom['portfolio-type'])){
					case 1: $icon_class = 'big-icon-slideshow'; break;
					case 2: $icon_class = 'big-icon-video'; break;
				}
				$output .= '<div class="portfolio-type"><i class="'.$icon_class.'"></i></div>';
				$output .= '<div class="sidebar-portfolio-title-cat "><a title="'.get_the_title().'" href="'.get_permalink(get_the_ID()).'">'.get_the_title().'</a>';
				$output .= '<span class="portfolio-categories">'.alterna_get_custom_portfolio_category_links( alterna_get_custom_post_categories(get_the_ID(),'portfolio_categories',false) , ' / ').'</span>';
			}
			
			
			$output .='</div></div>';
			
		endwhile;
	}
	wp_reset_postdata();
	return $output;
}

/**
 * Get blog posts for sidebar widget
 */
function alterna_get_blog_widget_post($type = 'recent' , $per_page = '' , $post_value = '' , $re_list = false , $show_type = 0 , $post__not_in = '') {
	
	if($per_page == "") $per_page = 5;
	
	$args=array('post_type' => 'post', 'post_status' => 'publish' , 'posts_per_page' => $per_page);
				 
	switch($type){
		case 'featured':
				$post_ids = explode("," , $post_value);
				if(count($post_ids) == 0) return "";
				$args['post__in']= $post_ids;
				$args['posts_per_page']= count($post_ids);
			break;
		case 'popular':
				$args['orderby']= 'comment_count';
		case 'recent':
				
			break;
		case 'related':
				$post_cats = explode("," , $post_value);
				if(count($post_cats) == 0) return "";
				$args['category__in'] = $post_cats;
				
				if($post__not_in != ""){
					$post__not_in = explode("," , $post__not_in);
					$args['post__not_in'] = $post__not_in;
				}
			break;
	}

	$blog_posts = new WP_Query($args);
	
	if($re_list) return $blog_posts;
	
	$output = "";
	
	if ($blog_posts -> have_posts() ){
		while ($blog_posts -> have_posts() ) : $blog_posts-> the_post();
		
			$output .='<div class="sidebar-portfolio-recent">';
			
			if(intval($show_type) == 0){
				$output .= '<div class="sidebar-portfolio-img post-img">';
				if (has_post_thumbnail(get_the_ID()) ) { 
					$output .= get_the_post_thumbnail(get_the_ID(), "portfolio-four-thumbs",array('alt' => get_the_title(get_the_ID()),'title' => get_the_title(get_the_ID())));
				}else{
					$output .= '<img  src="'.get_template_directory_uri().'/img/portfolio-no-thumbs.png" alt="">';
				}
				 $output .= '<div class="post-tip"><div class="bg"></div><a href="'.get_permalink(get_the_ID()).'" ><div class="link center-link"><i class="big-icon-link"></i></div></a></div>';
				$output .='</div>';
				$output .='<div class="sidebar-portfolio-title"><a title="'.get_the_title().'" href="'.get_permalink(get_the_ID()).'">'.get_the_title().'</a>';
			}else{
				$icon_class = 'big-icon-file';
			 	switch(get_post_format()){
					case 'video': $icon_class =  'big-icon-video'; break;
					case 'audio': $icon_class =  'big-icon-music'; break;
					case 'image': $icon_class =  'big-icon-picture'; break;
					case 'gallery': $icon_class =  'big-icon-slideshow'; break;
					case 'quote': $icon_class =  'big-icon-quote'; break;
				}
				$output .= '<div class="portfolio-type"><i class="'.$icon_class.'"></i></div>';
				$output .= '<div class="sidebar-blog-title"><a title="'.get_the_title().'" href="'.get_permalink(get_the_ID()).'">'.get_the_title().'</a>';
				$output .= '<div class="sidebar-blog-meta"><span class="blog-date">'.get_the_date('d-M-Y').'</span>';
				$num_comments = get_comments_number(get_the_ID()); 
				if ( $num_comments == 0 ) {
					$comments = __('No Comments','alterna');
				} elseif ( $num_comments > 1 ) {
					$comments = $num_comments . __(' Comments','alterna');
				} else {
					$comments = __('1 Comment','alterna');
				}
				$output .= '<a class="blog-comments" href="' . get_comments_link(get_the_ID()) .'"><i class="icon-comments"></i>'.$comments.'</a></div>';
			}
			$output .='</div></div>';
		endwhile;
	}
	
	wp_reset_postdata();
	
	return $output;
}


//========================================================
//  	COMMON METHODS
//========================================================

/**
 * Get custom option key value
 *
 */
function alterna_get_options_key($key,$options = '',$rebool = false,$default = ''){
	global $alterna_options;
	if($options == '') $options = $alterna_options;
	if(isset($options[$key])){
		if($rebool) return true;
		return $options[$key];
	}else{
		if($rebool) return false;
	}
	return $default;
}

/**
 * Generate Options CSS
 *
 */
function alterna_generate_options_css() {
	
	/** Define some vars **/
	$options_update_name = 'alterna_options_update';
	$options_update = get_option($options_update_name);
	$update_data;

	if(isset($options_update['update'])){
		if($options_update['update'] == 'yes') return;
		$update_data = array('update'=>'yes','version'=> (intval($options_update['version']) + 1) );
	}else{
		$update_data = array('update'=>'yes','version'=> 0 );
	}
	
	/** Define some vars **/
	$uploads = wp_upload_dir();
	$css_dir = get_template_directory() . '/custom/'; // Shorten code, save 1 call
	
	/** Capture CSS output **/
	ob_start();
	require($css_dir . 'custom-styles.php');
	$css = ob_get_clean();
	
	/** Write to options.css file **/
	WP_Filesystem();
	global $wp_filesystem;
	if ( ! $wp_filesystem->put_contents( $css_dir . 'custom-styles.css', $css, 0644) ) {
		return true;
	}
	update_option($options_update_name ,$update_data);
}

/**
 * Add custom image size for feature image crop
 */
function alterna_add_image_size($name,$w,$h,$crop = true){
	add_image_size( $name, $w, $h, $crop );
	update_option($name.'_size_w', $w);
	update_option($name.'_size_h', $h);
	update_option($name.'_crop', $crop ? 1 : 0);
}

/**
 * Get limit words
 */
function string_limit_words($str, $limit = 18 , $need_end = false) {
	$words = explode(' ', $str, ($limit + 1));
	if(count($words) > $limit) {
		array_pop($words);
		array_push($words,'...');
	}
	return implode(' ', $words);
}

/**
 * Relace All key string use value
 */
function alterna_replace_str($str,$key,$value) {
	$str = str_replace($key,$value,$str);
	return $str;
}

/** 
 * Get Preg replace string value
 */
function alterna_get_retina_preg_replace_str($string , $preg = '/\.\w+$/'){
	$return_str = '';
	
	preg_match($preg, $string , $match_result);
	
	if(count($match_result) > 0) {
		$return_str = preg_replace($preg, '@2x'.$match_result[0] , $string);
	}
	
	return $return_str;
}

/**
 * Get common hex to rgb
 */
function alterna_hex2RGB($color) {
	if ($color[0] == '#')
        $color = substr($color, 1);

    if (strlen($color) == 6)
        list($r, $g, $b) = array($color[0].$color[1],
                                 $color[2].$color[3],
                                 $color[4].$color[5]);
    elseif (strlen($color) == 3)
        list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
    else
        return false;

    $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);

    return array('r' => $r, 'g' => $g, 'b' => $b);
}

//========================================================
//  	PLUGIN FUNCTION METHODS
//========================================================

/**
 * Get option  for layerslider
 */
function alterna_get_layerslider(){
	$layerslider_slides = array();
	$layerslider_slides[0] = 'Select a slider';
	
	 // Get WPDB Object
    global $wpdb;
 
    // Table name
    $table_name = $wpdb->prefix . "layerslider";

	
	$sql = "show tables like '$table_name'";
	
	$table = $wpdb->get_var($sql);

	// have no rev slider 
	if($table != $table_name) return $layerslider_slides;
 
    // Get sliders
    $sliders = $wpdb->get_results( "SELECT * FROM $table_name
                                        WHERE flag_hidden = '0' AND flag_deleted = '0'
                                        ORDER BY date_c ASC LIMIT 100" );
 
    // Iterate over the sliders
    foreach($sliders as $key => $item) {
 		$layerslider_slides[$item->id] = '#'.$item->id . ' - ' .$item->name;
    }
	
	return $layerslider_slides;
}

/**
 * Get option  for revslider
 */
function alterna_get_revslider(){
	$revslider_slides = array();
	$revslider_slides[0] = 'Select a slider';
	
	 // Get WPDB Object
    global $wpdb;

    // Table name
    $table_name = $wpdb->prefix . "revslider_sliders";
	
	$sql = "show tables like '$table_name'";
	
	$table = $wpdb->get_var($sql);

	// have no rev slider 
	if($table != $table_name) return $revslider_slides;
	
    // Get sliders
    $sliders = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY id LIMIT 100" );
 
    // Iterate over the sliders
    foreach($sliders as $key => $item) {
 		$revslider_slides[$item->id] = '#'.$item->id . ' - ' .$item->title;
    }
	
	return $revslider_slides;
}

/**
 * Get generate tweet list
 */
function alterna_generate_tweet_list( $params = array() ) { 
	$args = array( 'count'=>5,  'published_when'=>1,'include_entities' => 'true' );
	$args['screen_name'] = '@'.$params['screen_name'];  
	$args['count'] = $params['count'];
    $request_url = 'https://api.twitter.com/1/statuses/user_timeline.json';  
    $request_url = add_query_arg($args,$request_url);  

	// Retrieve tweets  
	$tweets = alterna_get_tweets($request_url);  
	$content = '<ul class="alterna-twitter">';  
	if ( is_wp_error($tweets) || !is_array($tweets) ) {  
		$content .= '<li>'.__( ' Loading Tweets...', 'alterna' ) . '</li>';  
	} else if(count($tweets) == 0){
		$content .= '<li>'.__( ' No Tweets Available', 'alterna' ) . '</li>';  
	} else {  
		$count = 0;  
		foreach ( $tweets as $tweet ) {  
			//print_r($tweet);
			$content .= '<li>'; 
			
			$content .= '<span class="twitter-content">'.alterna_twitter_make_clickable($tweet).'</span>';  
			if ( $args['published_when'] ) {  
				$content .= '<span class="time-meta">';  
				$href = esc_url("http://twitter.com/{$tweet->user->screen_name}/statuses/{$tweet->id_str}");  
				$time_diff = __( 'about ','alterna').human_time_diff( strtotime($tweet->created_at)).__( ' ago','alterna');  
				$content .= "<a href={$href}>".$time_diff."</a>";  
				$content .= '</span>';  
			}  
			$content .= '</li>';  
			if ( ++$count >= $args['count'] )  
				break;  
		}  
	} 
	
	$content .='</ul>';
	$content .= '<p class="alterna-twitter-btn"><i class="icon-twitter"></i><a href="http://twitter.com/'.$params['screen_name'].'">Follow us on twitter</a></p>';
	return $content;  
}  

/**
 * Get twitter list
 */
function alterna_get_tweets($request_url) {  
	// Build request URL  
	$response = wp_remote_get( $request_url, array( 'timeout' => 5 ) );  
	if ( is_wp_error( $response ) )  
		return $response;  
	
	//print_r($response);
	
	if(isset($response['errors'])){
		return 'Account Error';
	}else{
		$response = json_decode( wp_remote_retrieve_body($response) );  
		return $response;
	}
	
	$code = (int) wp_remote_retrieve_response_code($response);  
	$response = json_decode( wp_remote_retrieve_body($response) );  
	switch( $code ):  
		case 200:  
			return $response;  
		case 304:  
		case 400:  
		case 401:  
		case 403:  
		case 404:  
		case 406:  
		case 420:  
		case 500:  
		case 502:  
		case 503:  
		case 504:  
			return new WP_Error($code, $response->error);  
		default:  
			return new WP_Error($code, __('Invalid response','alterna'));  
	endswitch;  
} 

function alterna_twitter_make_clickable( $tweet ) {  
    $entities = $tweet->entities;  
    $content = $tweet->text;  
    // Make any links clickable  
    if ( !empty($entities->urls) ) {  
        foreach ( $entities->urls as $url ) {  
            $content =str_ireplace($url->url,  '<a href="'.esc_url($url->expanded_url).'">'.$url->display_url.'</a>', $content);  
        }  
    }  
    // Make any hashtags clickable  
    if ( !empty($entities->hashtags) ) {  
        foreach ( $entities->hashtags as $hashtag ) {  
            $url = 'http://search.twitter.com/search?q=' . urlencode($hashtag->text);  
            $content =str_ireplace('#'.$hashtag->text,  '<a href="'.esc_url($url).'">#'.$hashtag->text.'</a>', $content);  
        }  
    }  
    // Make any users clickable  
    if ( !empty($entities->user_mentions) ) {  
        foreach ( $entities->user_mentions as $user ) {  
            $url = 'http://twitter.com/'.urlencode($user->screen_name);  
            $content =str_ireplace('@'.$user->screen_name,  '<a href="'.esc_url($url).'">@'.$user->screen_name.'</a>', $content);  
        }  
    }  
    // Make any media urls clickable  
    if ( !empty($entities->media) ) {  
        foreach ( $entities->media as $media ) {  
            $content =str_ireplace($media->url,  '<a href="'.esc_url($media->expanded_url).'">'.$media->display_url.'</a>', $content);  
        }  
    }  
    return $content;  
} 