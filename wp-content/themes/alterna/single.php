<?php
/**
 * Single Post Content
 *
 * @since alterna 1.0
 */

get_header(); ?>

	<?php 
	$layout = alterna_get_page_layout(); // get page layout 
	$custom = alterna_get_custom_post_meta(get_the_ID(),'post');
	$sidebar_name = get_post_meta(get_the_ID(), 'sidebar-type', true);
	
	// get blog default sidebar
	if($sidebar_name == "Global Sidebar"){
		$blog_page_id = get_option('page_for_posts');
		if(intval($blog_page_id) != 0){
			$sidebar_name = get_post_meta($blog_page_id, 'sidebar-type', true);
		}
	}
	?>
    
	<div id="main" class="container">
    	<div class="row-fluid">
        	<?php if($layout == 2) : ?> 
            	<div class="span4"><?php generated_dynamic_sidebar($sidebar_name); ?></div>
            <?php endif; ?>
            
        	<div class="left <?php echo $layout == 1 ? 'span12' : 'span8'; ?>">
            
            <div class="row-fluid">
			<?php
             if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('span12');?> >
                    
                    <div class="post-type-container span1">
                        <div class="post-type">
                                <i class="<?php
                                switch(get_post_format()){
                                    case 'video': echo 'big-icon-video'; break;
                                    case 'audio': echo 'big-icon-music'; break;
                                    case 'image': echo 'big-icon-picture'; break;
                                    case 'gallery': echo 'big-icon-slideshow'; break;
									case 'quote': echo 'big-icon-quote'; break;
                                    default : echo 'big-icon-file';
                                }
                                ?> "></i>
                        </div>
                    </div>
                    
                    <div class="span11">
                    <?php
                    if(get_post_format() == "image"){
                    	if(has_post_thumbnail(get_the_ID())){  
							$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumbnail');
							$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); 
					?>
                        <a href="<?php echo $full_image[0] ?>" rel="prettyPhoto">
                            <div class="post-img">
                                <img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_the_title(); ?>" />
                                <div class="post-tip">
                                	<div class="bg"></div>
                                    <div class="link no-bg"><i class="big-icon-preview"></i></div>
                                </div>
                            </div>
                         </a>
                    <?php
                        }
                    }else if(get_post_format() == "gallery"){ ?>
                        <div class="flexslider post-gallery">
                            <ul class="slides">
                                <?php $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumbnail'); ?>
                                <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
                                <li>
                                    <a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[<?php echo get_the_ID(); ?>]"><img src="<?php echo $attachment_image[0]; ?>" alt="" ></a>
                                </li>
                                <?php echo alter_get_attachments(get_the_ID() , array() , 'post-thumbnail' , true , true); ?>
                            </ul>
                        </div>
                    <?php
                    }else if(get_post_format() == "video") {
						$video_type 	= get_post_meta(get_the_ID(), 'video-type', true);
						$video_content 	= get_post_meta(get_the_ID(), 'video-content', true);
							if($video_content && $video_content != ''){
							if(intval($video_type) == 0){
								echo do_shortcode('[youtube id="'.$video_content.'" width="100%" height="300"]');
							}else if(intval($video_type) == 1){
								echo do_shortcode('[vimeo id="'.$video_content.'" width="100%" height="300"]');
							}else{
							   echo $video_content;
							}
						}
					}else if(get_post_format() == "audio"){
						$audio_type 	= get_post_meta(get_the_ID(), 'audio-type', true);
						$audio_content 	= get_post_meta(get_the_ID(), 'audio-content', true);
						if($audio_content && $audio_content != ''){
						   if(intval($audio_type) == 0){
							 echo do_shortcode('[soundcloud url="'.$audio_content.'"]');
						   }else{
							   echo $audio_content;
						   }
						}
					}else if(get_post_format() == "quote") {
						echo '<div class="post-quote-entry"><div class="post-quote-icon"></div>'.get_the_content().'</div>';
					}
                    ?>
                    
                    <div class="post-title row-fluid"><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3></div>
                    <div class="post-header row-fluid">
                            <div class="post-meta row-fluid">
                                <div class="post-date"><i class="icon-calendar"></i><?php echo get_the_date(); ?></div>
                                <div class="post-author"><i class="icon-user"></i><?php _e('by','alterna'); ?> <?php the_author_link();?></div>
                                <div class="post-category"><i class="icon-folder-open"></i><span><?php 	$categories = get_the_category();
                                $seperator = ' , ';
                                $output = '';
								$slugs = '';
                                if($categories){
                                    foreach($categories as $category) {
										if($slugs != '') $slugs .= ',';
										$slugs .= $category->term_id;
                                        $output .= '<a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'alterna'), $category->name ) ) . '">'.$category->cat_name.'</a>'.$seperator;
                                    }
                                echo trim($output, $seperator);
                                }
                     ?></span></div>
                                <div class="post-comments"><i class="icon-comments"></i><a href="<?php echo get_permalink(get_the_ID()).'#comments'; ?>"><?php comments_number(__('No Comment','alterna'),__('1 Comment','alterna'),__('% Comments','alterna')); ?></a></div>
                                <?php edit_post_link(__('Edit', 'alterna'), '<div class="post-edit"><i class="icon-edit"></i>', '</div>'); ?>
                                
                            </div>
                    </div>
                    
                    <?php if(get_post_format() != "quote") : ?>
                    <div class="post-content row-fluid">
                        <?php the_content(); ?>
                        <?php wp_link_pages(); ?>
                    </div>
                    <?php endif; ?>
                    <div class="post-meta post-tags row-fluid">
                    	<div class="post-tags-icon"><i class="icon-tags icon-white"></i></div>
                        <span><?php _e('Tagged: ', 'alterna' ); ?><?php the_tags('',' , ','');?></span>
                    </div>
                    <!-- show share -->
                    <?php if(intval(alterna_get_options_key('blog-share-type')) != 0) : ?>
                    <div class="post-share row-fluid">
                        <div class="alterna-title row-fluid">
                            <h3><?php _e('Share This Story!', 'alterna'); ?></h3>
                            <div class="line"></div>
                        </div>
                        <div>
                        <?php if(alterna_get_options_key('blog-share-type') == "1") : ?>
                            <!-- AddThis Button BEGIN -->
                            <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                            <a class="addthis_button_preferred_1"></a>
                            <a class="addthis_button_preferred_2"></a>
                            <a class="addthis_button_preferred_3"></a>
                            <a class="addthis_button_preferred_4"></a>
                            <a class="addthis_button_compact"></a>
                            <a class="addthis_counter addthis_bubble_style"></a>
                            </div>
                            <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-505181b575581334"></script>
                            <!-- AddThis Button END -->
                        <?php else : ?>
                            <!-- Custom share plugin code -->
                            <?php echo  alterna_get_options_key('blog-share-code'); ?>
                        <?php endif; ?>
                         </div>
                    </div>
                    <?php endif; ?>
                    <!-- show author -->
                    <?php if(intval(alterna_get_options_key('blog-show-author')) != 0) : ?>
                    <div class="post-about-author row-fluid">
                         <div class="alterna-title row-fluid">
                            <h3><?php _e('About Author', 'alterna'); ?></h3>
                            <div class="line row-fluid"><span class="left-line"></span><span class="right-line"></span></div>
                        </div>
                    
                        <?php $author_info = get_userdata($post->post_author);?>
                        <div class="post-author-details row-fluid">
                            <div class="gravatar">
                                <?php echo get_avatar($author_info->ID, 80 ); ?>
                            </div>
                            <div class="author-meta">
                            <span class="author-name"><a href="<?php echo $author_info->user_url;?>"><?php the_author();?></a></span>
                            <div class="author-desc">
                            <?php echo $author_info->user_description; ?>
                            </div>
                            </div>
                        </div>
                    </div>
                   	<?php endif; ?>
                   	<?php if(intval($custom['show-related-post']) == 0) : ?>
                    <div class="row-fluid">
						<?php 
                        echo do_shortcode('[title text="'.__('Related Posts' , 'alterna').'"]');
						$show_number = intval($custom['show-related-post-number']);
						if($show_number == 0) $show_number = 3;
                        echo do_shortcode('[blog_list columns="3" number="'.$show_number.'" show_type="1" show_style="1" related_slug="'.$slugs.'" post__not_in="'.get_the_ID().'"]'); ?>
                    </div>
                    <?php endif; ?>
                    <?php comments_template(); ?>
                    </div>
                </article>
                
            <?php endwhile; else: ?>
                <p><?php _e('Sorry, this page does not exist.' , 'alterna' ); ?></p>
            <?php endif; ?>
        </div>
        <?php alterna_single_content_nav('single-nav-bottom' , 'single-pagination row-fluid'); ?>
        </div>
        <?php if($layout == 3) : ?> 
            <div class="span4"><?php generated_dynamic_sidebar($sidebar_name); ?></div>
        <?php endif; ?>
        </div>
	</div>

<?php get_footer(); ?>