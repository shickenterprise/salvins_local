<?php
/**
 * Single Portfolio 
 * @since alterna 1.0
 */

get_header(); ?>

	<div id="main" class="container">
    
    	<div id="single-portfolio" class="row-fluid">
        
        		<?php
                if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                    $custom = alterna_get_custom_post_meta(get_the_ID(),'portfolio');
					$slugs = alterna_get_custom_post_categories(get_the_ID(),'portfolio_categories',true,",",'slug');
                ?>
            	<div class="span8">
                	<div class="single-portfolio-element row-fluid" >
                    	<?php if(intval($custom['portfolio-type']) == 1) : ?>
                            <div class="flexslider post-gallery">
                                <ul class="slides">
                                    <?php	
                                    if( has_post_thumbnail(get_the_ID())) :
                                        $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'portfolio-single-thumbs');
                                        $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); 
                                    ?>
                                    <li>
                                        <a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[<?php echo get_the_ID(); ?>]"><img src="<?php echo $attachment_image[0]; ?>" alt="" ></a>
                                    </li>
                                    <?php endif; ?>
                                    <?php echo alter_get_attachments(get_the_ID() , array() , 'portfolio-single-thumbs' , true , true); ?>
                                </ul>
                            </div>
                		<?php elseif(intval($custom['portfolio-type']) == 2 && $custom['video-content'] != '') : ?>
                        	<?php 
								echo do_shortcode('['.(intval($custom['video-type']) == 0 ? 'youtube' : 'vimeo').' id="'.$custom['video-content'].'" width="100%" height="300"]');
							?>
						<?php else : ?>
                        	<?php if(has_post_thumbnail(get_the_ID())) : ?>
								<?php $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'portfolio-single-thumbs'); ?>
                                <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
                                
                                <a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto">
                                <div class="post-img">
                                    <img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_the_title(); ?>" />
                                    <div class="post-tip"><div class="bg"></div><div class="link no-bg"><i class="big-icon-preview"></i></div></div>
                                </div>
                                </a>
                            <?php endif; ?>
						<?php endif; ?>
                	</div>

        		</div>

                <div class="single-portfolio-information span4">
                    <?php echo do_shortcode('[title text="'.get_the_title().'"]'); ?>
                   
                    <ul class="single-portfolio-meta row-fluid">
                        <li>
                            <div class="type"><i class="icon-calendar"></i>&nbsp;<?php _e('Date','alterna'); ?></div>
                            <div class="value"><?php echo get_the_date(); ?></td>
                        </li>
                         <li>
                            <div class="type"><i class="icon-folder-open"></i>&nbsp;<?php _e('Categories','alterna'); ?></div>
                            <div class="value"><?php echo alterna_get_custom_portfolio_category_links( alterna_get_custom_post_categories(get_the_ID(),'portfolio_categories',false)  , ' / '); ?></td>
                        </li>
                        <?php if($custom['portfolio-client'] != "") : ?>
                        <li>
                            <div class="type"><i class="icon-user"></i>&nbsp;<?php _e('Client','alterna'); ?></div>
                            <div class="value"><?php echo $custom['portfolio-client']; ?></td>
                        </li>
                        <?php endif; ?>
                        <?php if($custom['portfolio-skills'] != "") : ?>
                        <li>
                            <div class="type"><i class="icon-bolt"></i>&nbsp;<?php _e('Skills','alterna'); ?></div>
                            <div class="value"><?php echo $custom['portfolio-skills']; ?></div>
                        </li>
                        <?php endif; ?>
                        <?php if($custom['portfolio-colors'] != "") : ?>
                        <li>
                            <div class="type"><i class="icon-adjust"></i>&nbsp;<?php _e('Colors','alterna'); ?></div>
                            <div class="value"><?php echo alterna_get_color_list($custom['portfolio-colors']); ?></div>
                        </li>
                        <?php endif; ?>
                        <?php if($custom['portfolio-link'] != "") : ?>
                         <li>
                            <div class="type"><i class="icon-link"></i>&nbsp;<?php _e('Link','alterna'); ?></div>
                            <div class="value"><a href="<?php echo $custom['portfolio-link']; ?>"><?php echo $custom['portfolio-link']; ?></a></div>
                        </li>
                        <?php endif; ?>
                        <!-- show share -->
                   		<?php if(intval(alterna_get_options_key('portfolio-share-type')) != 0) : ?>
                        <li>
                        	<div class="single-portfolio-share">
                            	<?php if(alterna_get_options_key('portfolio-share-type') == "1") : ?>
                                <!-- AddThis Button BEGIN -->
                                <div class="addthis_toolbox addthis_default_style ">
                                <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                                <a class="addthis_button_tweet"></a>
                                <a class="addthis_button_pinterest_pinit"></a>
                                <a class="addthis_counter addthis_pill_style"></a>
                                </div>
                                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-5102b19361611ae7"></script>
                                <!-- AddThis Button END -->
                                <?php else : ?>
                                <!-- Custom share plugin code -->
                           		<?php echo  alterna_get_options_key('portfolio-share-code'); ?>
                                <?php endif; ?>
                            </div>  
                        </li>
                        <?php endif; ?>
                        
					</ul>
					<?php echo do_shortcode('[space line="yes"]'); ?>
                    
                     <div class="single-portfolio-content row-fluid">
                     	 <?php edit_post_link(__('Edit', 'alterna'), '<div class="post-edit"><i class="icon-edit"></i>', '</div>'); ?>
                    	<?php the_content(); ?>
                    </div>
                    
                </div>
                
                <?php endwhile; else: ?>
                    <p><?php _e('Sorry, this page does not exist.' , 'alterna' ); ?></p>
                <?php endif; ?>
        </div>
        <?php alterna_single_content_nav('single-nav-bottom' , 'single-pagination row-fluid'); ?>
        <?php
		if(intval($custom['show-related-portfolio']) == 0) : ?>
        <div class="row-fluid">
        	<?php 
			echo do_shortcode('[title text="'.__('Related Works' , 'alterna').'" line="no"]');
			$show_num = intval($custom['show-related-portfolio-number']);
			if($show_num == 0) $show_num = 3;
			echo do_shortcode('[portfolio_list columns="3" number="'.$show_num.'" show_type="1" show_style="1" related_slug="'.$slugs.'" post__not_in="'.get_the_ID().'"]'); ?>
        </div>
        <?php endif; ?>
	</div>

<?php get_footer(); ?>