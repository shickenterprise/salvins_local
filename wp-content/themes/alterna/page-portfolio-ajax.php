<?php
/**
 * Template Name: Portfolio Template Waterfall Flux with AJAX
 *
 * @since alterna 1.0
 */

get_header(); ?>
	
    
    <?php 
		global $paged;
		// get page layout 
		$layout = alterna_get_page_layout();                         
		$per_page_num 			=	get_post_meta(get_the_ID() , 'portfolio-ajax-page-num', true);
		$page_cols				=	get_post_meta(get_the_ID() , 'portfolio-ajax-cols-num', true);
		$portfolio_show_style	=	get_post_meta(get_the_ID() , 'portfolio-show-style', true);
		$portfolio_show_filter	=	get_post_meta(get_the_ID() , 'portfolio-show-filter', true);
		$portfolio_show_cat		=	get_post_meta(get_the_ID() , 'portfolio-show-cat', true);
		$thumbs_size	=	'portfolio-four-thumbs';
		switch(intval($page_cols)){
			case 0: $thumbs_size = 'portfolio-two-thumbs';break;
			case 1: $thumbs_size = 'portfolio-three-thumbs';break;
			default :
		}
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
                <?php if($portfolio_show_filter == "on") : ?>
                     <div class="portfolio-filters row-fluid">
                        <ul class="portfolio-filters-cate inline">
                            <li><a data-filters="*" class="active"><?php _e('All', 'alterna'); ?></a></li>
                            <?php $categories = alterna_get_custom_all_categories('portfolio_categories'); 
                            foreach($categories as $category){
                                echo '<li><a data-filters=".cat-'.$category->slug.'" >'.$category->name.'</a></li>';
                            }
                            ?>
                        </ul>
                     </div>
                 <?php endif; ?>
                <div id="portfolio-ajax" class="portfolio-container row-fluid">
                    <?php 
						if($paged == 0) $paged = 1;
						
                        // get portfolio
                        $args = array(	'post_type' => 'portfolio',
                                        'post_status' => 'publish',
                                        'paged' => $paged,
                                        'posts_per_page'=> intval($per_page_num)
                                     );
									 
						// show category portfolio
						if($portfolio_show_cat != "") {
							$slugs = explode("," , $portfolio_show_cat);
							if(count($slugs) > 0) {
								$args['tax_query'] = array(	array('taxonomy' => 'portfolio_categories',
															'field' => 'slug',
															'terms' => $slugs));
							}
						}
									 
                        // The Query
						$portfolios = new WP_Query($args);
                    ?>
                    <?php if ( $portfolios->have_posts() ) : ?>
                        <?php /* Start the Loop */ ?>
                            <?php while ($portfolios->have_posts() ) : $portfolios->the_post(); ?>
                                
                                <?php
                                   	$custom = alterna_get_custom_post_meta(get_the_ID(),'portfolio');

									$portfolio_cats = alterna_get_custom_post_categories(get_the_ID(),'portfolio_categories',true,' ','slug','cat-');
                                ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class('portfolio-element portfolio-style-'.(intval($portfolio_show_style)+1).' '.$portfolio_cats.' columns-'.(intval($page_cols)+2));?> >
									<?php if(intval($portfolio_show_style) == 0) { ?>
											<div class="portfolio-wrap">
                                        
										<?php 	// show gallery
											if(intval($custom['portfolio-type']) == 1) {  ?>
                                    			<div class="flexslider">
                                                    <ul class="slides">
														<?php
														if( has_post_thumbnail(get_the_ID())) :
                                                        	$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $thumbs_size);
                                                        	$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); 
                                                        ?>
                                                    	<li>
                                                        	<a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[<?php echo get_the_ID(); ?>]"><img src="<?php echo $attachment_image[0]; ?>" alt="" ></a>
                                                    	</li>
                                                        <?php endif; ?>
														<?php echo alter_get_attachments(get_the_ID() , array() , $thumbs_size , true , true); ?>
                                                	</ul>
                                                </div>
										<?php
												// show video with youtube or vimeo
											} else  if(intval($custom['portfolio-type']) == 2 && $custom['video-content'] != '') {
												
												echo do_shortcode('['.(intval($custom['video-type']) == 0 ? 'youtube' : 'vimeo').' id="'.$custom['video-content'].'" width="100%" height="300"]');
												
											} else {
									?>
												<div class="portfolio-img">
												<?php if( has_post_thumbnail(get_the_ID())) {
													echo get_the_post_thumbnail(get_the_ID(), $thumbs_size);
												}else{
													 echo '<img src="'.get_template_directory_uri().'/img/portfolio-no-thumbs.png" alt="">' ;
												}?>
												</div>
                                                
                                                <div class="post-tip">
                                                    <div class="bg"></div>
                                                    <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
                                                    <a href="<?php echo get_permalink(); ?>"><div class="link left-link"><i class="big-icon-link"></i></div></a>
                                                    <a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto"><div class="link right-link"><i class="big-icon-preview"></i></div></a>
                                                </div>
										<?php }	?>
											</div>
                                            <div class="portfolio-content">
                                                <div class="portfolio-title">
                                                	<?php if(intval($page_cols) == 0) : ?>
                                                    <h4><a href="<?php echo get_permalink(get_the_ID());?>" ><?php echo get_the_title(); ?></a></h4>											<?php else : ?>
                                                    <h5><a href="<?php echo get_permalink(get_the_ID());?>" ><?php echo get_the_title(); ?></a></h5>
                                                    <?php endif; ?>
                                                    <span class="portfolio-categories"><?php echo alterna_get_custom_portfolio_category_links( alterna_get_custom_post_categories(get_the_ID(),'portfolio_categories',false) , ' / '); ?></span>
                                                </div>
                                            </div>
                                            
									<?php	} else if(intval($portfolio_show_style) == 1) { ?>
                                    		<div class="portfolio-wrap">
                                    		<a href="<?php echo get_permalink(get_the_ID());?>" >
                                    			<div class="portfolio-img">
												<?php if( has_post_thumbnail(get_the_ID())) {
                                                    echo get_the_post_thumbnail(get_the_ID(), $thumbs_size);
                                                }else{
                                                     echo '<img src="'.get_template_directory_uri().'/img/portfolio-no-thumbs.png" alt="">' ;
                                                }?>
                                    			</div>
                                                <div class="post-tip">
                                                    <div class="bg"></div>
                                                    <div class="post-tip-info">
                                                    	<h4><?php echo get_the_title(); ?></h4>
                                                    	<p><?php echo string_limit_words(get_the_excerpt()); ?><?php
															if($custom['portfolio-client'] != "") {
																echo '<span class="portfolio-client"><strong>'.__('Client: ','alterna').'</strong>'.$custom['portfolio-client'].'</span>';
															}
														 ?></p>
                                                    </div>
                                                </div>
                                   			</a>
                                            </div>
                                	<?php }	 else if(intval($portfolio_show_style) == 2)  {?>
                                    		<div class="portfolio-wrap">
                                    		<a href="<?php echo get_permalink(get_the_ID());?>" >
                                    			<div class="portfolio-img">
												<?php if( has_post_thumbnail(get_the_ID())) {
                                                    echo get_the_post_thumbnail(get_the_ID(), $thumbs_size);
                                                }else{
                                                    echo '<img src="'.get_template_directory_uri().'/img/portfolio-no-thumbs.png" alt="">' ;
                                                }?>
                                    			</div>
                                                <div class="post-tip">
                                                    <div class="bg"></div>
                                                    <h4><?php echo get_the_date(); ?></h4>
                                                </div>
                                   			</a>
                                            </div>
                                            <div class="portfolio-content">
                                                <div class="portfolio-title">
                                                	<?php if(intval($page_cols) == 0) : ?>
                                                    <h4><a href="<?php echo get_permalink(get_the_ID());?>" ><?php echo get_the_title(); ?></a></h4>											<?php else : ?>
                                                    <h5><a href="<?php echo get_permalink(get_the_ID());?>" ><?php echo get_the_title(); ?></a></h5>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                    <?php } else { ?>
                                    		<div class="portfolio-wrap portfolio-popup">
											<?php 
												if(has_post_thumbnail(get_the_ID())) {
													$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $thumbs_size);
													$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); 
													$full_image = $full_image[0];
												}else {
													$full_image = "";
												}
											?>
                                    		<a href="<?php echo $full_image; ?>" rel="prettyPhoto" >
                                            	<div class="portfolio-img">
                                                	<?php if( has_post_thumbnail(get_the_ID())) {
													echo get_the_post_thumbnail(get_the_ID(), $thumbs_size);
													}else{
														 echo '<img src="'.get_template_directory_uri().'/img/portfolio-no-thumbs.png" alt="">' ;
													}?>
                                                    <div class="post-tip"><div class="bg"></div><div class="link no-bg"><i class="big-icon-preview"></i></div></div>
                                                </div>
                                   			</a>
                                            </div>
                                    <?php } ?>
   
                                </article>
                                
                            <?php endwhile; ?>
                        <?php else : ?>
                    <?php endif; ?>
                </div><!-- #row -->
                <div class="ajax-load-content"></div>
                <div class="row-fluid alterna-space alterna-line"></div>
                <div class="post-ajax-btn-container row-fluid">
                <?php 
                    if($portfolios->max_num_pages > $paged) :
                ?>
                    <a id="post-ajax-btn" class="btn btn-custom btn-large" data-page="<?php echo get_pagenum_link($paged+1) ;?>"><i class="icon-refresh pull-left"></i><?php _e('View More Of Our Work...', 'alterna'); ?></a>
                <?php else : ?>
                    <a id="post-ajax-btn" class="btn btn-custom btn-large" style="cursor:auto;"><i class="icon-coffee pull-left"></i><?php _e('No More Work!', 'alterna'); ?></a>
                <?php endif; ?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var paged 		= <?php echo $paged+1; ?>;
		var max_paged 	= <?php echo $portfolios->max_num_pages; ?>;
		var next_link	= '';
		var loading		= false;
		
		$("#post-ajax-btn").click( function() {
			if(loading || paged > max_paged){ return false;}
			loading = true;
			
			$("#post-ajax-btn").html('<i class="icon-spinner icon-spin"></i><?php _e('Loading...', 'alterna'); ?>');
			
			if(next_link === ""){ next_link = $("#post-ajax-btn").attr('data-page');}
			
			$('.ajax-load-content').load(next_link + ' .portfolio-element' , function(){
				var $newItems = $($('.ajax-load-content').html());
				$('.ajax-load-content').html('');
				
				$newItems.find('.flexslider').flexslider({slideshow: false , start: function(element){
					if($(element).height() <= 10) {
						$(element).css('height',($(element).width() * 0.68));
						$(window).resize(function() {$(element).css('height','auto');});
					}
					
					jQuery('.portfolio-container').isotope( 'reLayout' );
				} });
				
				$newItems.find('.portfolio-img img').load(function() {
					jQuery('.portfolio-container').isotope( 'reLayout' );
				});
				
				$('#portfolio-ajax').append( $newItems ).isotope( 'insert', $newItems );
				
				if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))) {
					
					$(".portfolio-element").each(function() {
						if( $(this).find('.post-tip').length > 0 ){
							if($(this).find('.post-tip .left-link').length >0 ){
								var portfolio_link = $($(this).find('.post-tip .left-link').parent()).attr('href');
								if(!portfolio_link) { portfolio_link = $(this).find('.post-tip .left-link a').attr('href'); }
								
								$(this).find('.portfolio-img').wrap('<a style="float:left;" href="'+ portfolio_link +'"></a>');
							}
							$(this).find('.post-tip').remove();
						}
					});

					$('.flexslider').addClass('touch');
				}
				
				if($.fn.prettyPhoto != null){
					$newItems.find("a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal'});
				}
				
				paged++;
				if(paged <= max_paged) {
					next_link = next_link.replace(/\/page\/[0-9]?/, '/page/'+ paged);
					next_link = next_link.replace(/paged=[0-9]/, 'paged='+ paged);
					
					$("#post-ajax-btn").html('<i class="icon-refresh pull-left"></i><?php _e('View More Of Our Work...', 'alterna'); ?>');
					
					loading = false;
				}else{
					$("#post-ajax-btn").html('<i class="icon-coffee pull-left"></i><?php _e('No More Work!', 'alterna'); ?>');
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