<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @since alterna 1.0
 */
 
get_header(); ?>
	
    <?php $layout = alterna_get_page_layout(); // get page layout ?>

	<div id="main" class="container">
    	<div class="row-fluid">
        	<?php if($layout == 2) : ?> 
            	<div class="span4"><?php generated_dynamic_sidebar(); ?></div>
            <?php endif; ?>
            
        	<div class="<?php echo $layout == 1 ? 'span12' : 'span8'; ?>">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
            
                <?php endwhile; else: ?>
                    <p><?php _e('Sorry, this page does not exist.' , 'alterna' ); ?></p>
                <?php endif; ?>
    		</div>
            
            <?php if($layout == 3) : ?> 
            	<div class="span4"><?php generated_dynamic_sidebar(); ?></div>
            <?php endif; ?>
    	</div>
        
	</div>

<?php get_footer(); ?>