<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme
 *
 * @since alterna 1.0
 */

get_header(); ?>
	
   <?php 
   		if(((is_home() && !is_front_page()) || is_category()|| is_tag() || is_date()) && (intval(get_option('page_for_posts')) > 0) ) {
			//when you use custom page for blog will use the page layout
			$layout = alterna_get_page_layout(get_option('page_for_posts'));
			$sidebar_name = get_post_meta(get_option('page_for_posts'), 'sidebar-type', true);
		}else{
			// index default will use global layout 
			$layout = alterna_get_page_layout('global'); 
			$sidebar_name = '0';
		}
	?>
    
	<div id="main" class="container">
    	<div class="row-fluid">
            <?php if($layout == 2) : ?> 
            	<div class="span4"><?php generated_dynamic_sidebar($sidebar_name); ?></div>
            <?php endif; ?>
            
        	<div class="left-side <?php echo $layout == 1 ? 'span12' : 'span8'; ?>">
				<?php if ( have_posts() ) : ?>
					
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', get_post_format() );?>
    
					<?php endwhile; ?>

					<?php alterna_content_pagination('nav-bottom' , 'pagination-centered'); ?>
                   
				<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'alterna' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'alterna' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #left-side -->
             <?php if($layout == 3) : ?> 
            	<div class="span4"><?php generated_dynamic_sidebar($sidebar_name); ?></div>
            <?php endif; ?>
		</div><!-- #row-fluid -->
    </div><!-- #container -->
        
<?php get_footer(); ?>