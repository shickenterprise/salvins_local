<?php
/**
 * Gallery Post Content
 * 
 * @since alterna 1.0
 */
 ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('entry-post');?> >
		<!-- post date -->
		<div class="entry-left-side span3">
			<div class="post-date-type row-fluid">
        		<div class="post-type"><i class="big-icon-slideshow"></i></div>
				<div class="date">
					<div class="day"><?php echo get_the_date('d'); ?></div>
					<div class="month"><?php echo get_the_date('M'); ?></div>
					<div class="year"><?php echo get_the_date('Y'); ?></div>
				</div>
			</div>
			<div class="post-meta post-author row-fluid"><i class="icon-user"></i><?php _e('by','alterna'); ?> <?php the_author_link();?></div>
			<div class="post-meta post-comments row-fluid"><i class="icon-comments"></i><a href="<?php echo get_permalink(get_the_ID()).'#comments'; ?>"><?php comments_number(__('No Comment' , 'alterna') , __('1 Comment' , 'alterna') , __('% Comments' , 'alterna')); ?></a></div>
		</div>

		<!-- post content -->
		<div class="entry-right-side span9">
        	<div class="flexslider post-gallery row-fluid">
            	<ul class="slides">
                 	<?php $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumbnail'); ?>
					<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
                    <li>
                    	<a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[<?php echo get_the_ID(); ?>]"><img src="<?php echo $attachment_image[0]; ?>" alt=""></a>
					</li>
                    <?php echo alter_get_attachments(get_the_ID() , array() , 'post-thumbnail' , true , true); ?>
                </ul>
            </div>
			<div class="title"><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3></div>
			<div class="clear"></div>
			<?php edit_post_link(__('Edit', 'alterna'), '<div class="post-edit"><i class="icon-edit"></i>', '</div>'); ?>
			<div class="post-meta post-category"><i class="icon-folder-open"></i><span><?php 	$categories = get_the_category();
					$seperator = ' , ';
					$output = '';
					if($categories){
						foreach($categories as $category) {
							$output .= '<a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'alterna'), $category->name ) ) . '">'.$category->cat_name.'</a>'.$seperator;
						}
					echo trim($output, $seperator);
					}
		 ?></span>
        		<div class="post-link"><a href="<?php echo the_permalink();?>"><i class="icon-link"></i></a></div>
			</div>
            
			<div class="post-content">
				<?php echo string_limit_words(get_the_excerpt(), 30); ?>
                <?php echo '<p><a class="more-link" href="'.get_permalink().'">'.alterna_get_options_key('global-read-more' , '' , false , 'Read More &raquo;').'</a></p>'; ?>
            </div>
		</div>
	</article>
    