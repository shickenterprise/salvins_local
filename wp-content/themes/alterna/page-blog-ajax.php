<?php
/**
 * Template Name: Blog Template Waterfall Flux with AJAX
 *
 * @since alterna 1.0
 */

get_header(); ?>
	
    <?php
		global $paged;
		$layout = alterna_get_page_layout(); // get page layout 
		$per_page_num 	=	get_post_meta(get_the_ID() , 'blog-ajax-page-num', true);
        $page_cols		=	get_post_meta(get_the_ID() , 'blog-ajax-cols-num', true);
		$page_cats		=	get_post_meta(get_the_ID() , 'blog-ajax-cat', true);
	?>
	
    <div id="main" class="container">
    	<div class="row-fluid">
        
        	<?php if($layout == 2) : ?> 
            	<div class="span4"><?php generated_dynamic_sidebar(); ?></div>
            <?php endif; ?>
            
        	<div class="<?php echo $layout == 1 ? 'span12' : 'span8'; ?>">
        
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <div class="row-fluid">
                          <?php the_content(); ?>
                    </div>
                <?php endwhile;endif; ?>
                
                <div id="post-ajax" class="row-fluid">
                    <?php 

                        if($paged == 0) $paged = 1;
                        
                        $args = array(	'post_type' => 'post',
                                        'post_status' => 'publish',
                                        'paged' => $paged,
                                        'posts_per_page'=> $per_page_num
                                     );
						if($page_cats != "") {
							
							$cats = explode("," , $page_cats);
							
							if(count($cats) > 0) {
								$args['category__in'] = $cats;
							}
						}
                        // The Query
						$blog_posts = new WP_Query($args);
                    ?>
                    <?php if ( $blog_posts->have_posts() ) : ?>
                            <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
                                
                                <?php
                                    $icon_type = '';
                                    switch(get_post_format()){
                                        case 'video': $icon_type = 'big-icon-video'; break;
                                        case 'audio': $icon_type = 'big-icon-music'; break;
                                        case 'image': $icon_type = 'big-icon-picture'; break;
                                        case 'gallery': $icon_type = 'big-icon-slideshow'; break;
                                        case 'quote': $icon_type = 'big-icon-quote'; break;
                                        default : $icon_type = 'big-icon-file';
                                    }
                                ?>
                                
                                <article id="post-<?php the_ID(); ?>" <?php post_class('post-ajax-element columns-'.(intval($page_cols)+2));?> >
                                    <div class="post-ajax-border">
                                        <div class="post-ajax-content">
                                            <?php if(get_post_format() == "image"){ ?>
                                            <div class="post-img">
                                                <?php echo get_the_post_thumbnail(get_the_ID(), "post-thumbnail" , array('alt' => get_the_title(),'title' => '')); ?>
                                                <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
                                                <div class="post-tip">
                                                    <div class="bg"></div>
                                                    <a href="<?php echo get_permalink(); ?>"><div class="link left-link"><i class="big-icon-link"></i></div></a>
                                                    <a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto"><div class="link right-link"><i class="big-icon-preview"></i></div></a>
                                                </div>
                                            </div>
                                            <?php }else if(get_post_format() == "gallery") { ?>
                                            <div class="flexslider post-gallery">
                                                <ul class="slides">
                                                    <?php
                                                    $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumbnail');
                                                    $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); 
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[<?php echo get_the_ID(); ?>]"><img src="<?php echo $attachment_image[0]; ?>" alt=""></a>
                                                    </li>
                                                    <?php echo alter_get_attachments(get_the_ID() , array() , 'post-thumbnail' , true , true); ?>
                                                </ul>
                                            </div>
                                            <?php }else if(get_post_format() == "video") {
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
                                            } else if(get_post_format() == "audio") { 
                                               $audio_type 		= get_post_meta(get_the_ID(), 'audio-type', true);
                                               $audio_content 	= get_post_meta(get_the_ID(), 'audio-content', true);
                                               if($audio_content && $audio_content != ''){
                                                   if(intval($audio_type) == 0){
                                                     echo do_shortcode('[soundcloud url="'.$audio_content.'"]');
                                                   }else{
                                                       echo $audio_content;
                                                   }
                                               }
                                            } else if(get_post_format() == "quote"){ ?>
                                                <div class="post-quote-entry"><div class="post-quote-icon"></div><?php echo get_the_content(); ?></div>
                                            <?php }else {
                                                
                                            }
                                            ?>
                                        </div>
                                        
                                        <div class="post-ajax-information">
                                            <div class="post-date"><i class="icon-calendar"></i>&nbsp;<?php echo get_the_date(); ?></div>
                                            <div class="post-link"><a href="<?php echo the_permalink();?>"><i class="icon-link"></i></a></div>
                                            <div class="post-mata-container">
                                                <div class="post-type"><i class="<?php echo $icon_type; ?>"></i></div>
                                                <div class="post-meta-content">
                                                    <div class="title"><h4><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h4></div>
                                                    <div class="post-meta">
                                                        <div class="post-category"><i class="icon-folder-open"></i><span><?php 	$categories = get_the_category();
                                        $seperator = ' , ';
                                        $output = '';
                                        if($categories){
                                            foreach($categories as $category) {
                                                $output .= '<a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'alterna'), $category->name ) ) . '">&nbsp;'.$category->cat_name.'</a>'.$seperator;
                                            }
                                        echo trim($output, $seperator);
                                        }
                             ?></span></div>
                                                        <div class="post-comments"><i class="icon-comments"></i><a href="<?php echo get_permalink(get_the_ID()).'#comments'; ?>">&nbsp;<?php comments_number(__('No Comment','alterna'),__('1 Comment','alterna'),__('% Comments','alterna')); ?></a></div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(get_post_format() != "quote") : ?>
                                        <div class="post-content">
                                           <?php echo string_limit_words(get_the_excerpt(), 20); ?>
                                           <?php echo '<p><a class="more-link" href="'.get_permalink().'">'.alterna_get_options_key('global-read-more' , '' , false , 'Read More &raquo;').'</a></p>'; ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </article>
                                
                            <?php endwhile; ?>
        
                            
                        <?php else : ?>
                        
                    <?php endif; ?>
                </div><!-- #row -->
                <div class="ajax-load-content"></div>
                <div class="row-fluid alterna-space alterna-line"></div>
                <div class="post-ajax-btn-container row-fluid">
                <?php 
                    if($blog_posts->max_num_pages > $paged) :
                ?>
                    <a id="post-ajax-btn" class="btn btn-custom btn-large" data-page="<?php echo get_pagenum_link($paged+1) ;?>"><i class="icon-refresh pull-left"></i><?php echo alterna_get_options_key('global-read-more' , '' , false , 'Read More &raquo;'); ?></a>
                <?php else : ?>
                    <a id="post-ajax-btn" class="btn btn-custom btn-large" style="cursor:auto;" ><i class="icon-coffee pull-left"></i><?php _e('Have no more post!', 'alterna'); ?></a>
                <?php endif; ?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var paged 		= <?php echo $paged+1; ?>;
		var max_paged 	= <?php echo $blog_posts->max_num_pages; ?>;
		var next_link	= "";
		var loading		= false;
		$("#post-ajax-btn").click( function() {
			if(loading || paged > max_paged) {return false;}
			
			loading = true;
			$("#post-ajax-btn").html('<i class="icon-spinner icon-spin"></i><?php _e('Loading...', 'alterna'); ?>');
			if(next_link === "") {next_link = $("#post-ajax-btn").attr('data-page');}
			
			$('.ajax-load-content').load(next_link + ' .post-ajax-element' , function(){
				var $newItems = $($('.ajax-load-content').html());
				$('.ajax-load-content').html('');

				$newItems.find('.flexslider').flexslider({slideshow: false , start: function(element){
					if($(element).height() <= 10) {
						$(element).css('height',($(element).width() * 0.455));
						$(window).resize(function() {$(element).css('height','auto');});
					}
					$('#post-ajax').isotope( 'reLayout' );
				} });
				
				$newItems.find('.post-img img').load(function() {
					 $('#post-ajax').isotope( 'reLayout' );
				});
				
				$newItems.find('.post-content').each(function(index, element) {
					if($(element).find('.more-link').length > 0) {
						var html = '<p><a class="more-link" href="' + $(element).find('.more-link').attr('href') + '">' + $(element).find('.more-link').html() + '</a></p>';
						$(element).find('.more-link').remove();
						$(element).append(html);
					}
				});
				
				$('#post-ajax').append( $newItems ).isotope( 'insert', $newItems );
				
				if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))) {

					$(".post-img").each(function() { 
						if( $(this).find('.post-tip').length > 0){
							if($(this).find('.post-tip .left-link').length > 0 ){
								$(this).wrap('<a style="float:left;" href="'+ $($(this).find('.post-tip .left-link').parent()).attr('href') +'"></a>');
							}
							$(this).find('.post-tip').remove();
						}
					});
					
					$('.flexslider').addClass('touch');
				}
				
				if($.fn.prettyPhoto != null) $newItems.find("a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal'});
				
				paged++;
				
				if(paged <= max_paged) {
					next_link = next_link.replace(/\/page\/[0-9]?/, '/page/'+ paged);
					next_link = next_link.replace(/paged=[0-9]/, 'paged='+ paged);
					$("#post-ajax-btn").html('<i class="icon-refresh pull-left"></i><?php echo alterna_get_options_key('global-read-more' , '' , false , 'Read More &raquo;'); ?>');
					loading = false;
				}else{
					$("#post-ajax-btn").html('<i class="icon-coffee pull-left"></i><?php _e('Have no more post!', 'alterna'); ?>');
					$("#post-ajax-btn").css('cursor' , 'auto');
				}
			});
		});
	});
</script>
                </div>
                <?php wp_reset_postdata(); ?>
            </div>
            <?php if($layout == 3) : ?> 
            	<div class="span4"><?php generated_dynamic_sidebar(); ?></div>
            <?php endif; ?>
            
        </div><!-- end row-fluid -->
    </div><!-- end container -->
    
<?php get_footer(); ?>