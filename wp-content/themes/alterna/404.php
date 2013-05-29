<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @since alterna 1.0
 */

get_header();

// get page layout 
$layout = alterna_get_page_layout(); 

?>
	<div id="main" class="container">
    	<div class="row-fluid">
        	<?php if($layout == 2) : ?> 
            	<div class="span4"><?php generated_dynamic_sidebar(); ?></div>
            <?php endif; ?>
            
        	<div class="error-404 <?php echo $layout == 1 ? 'span12' : 'span8'; ?>">
				<div class="alert alert-error">
                	<h1 class="entry-title"><i class="icon-warning-sign"></i></h1>
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'alterna' ); ?></h1>
                    <p><?php _e( "Looks like the pege you are looking for isn't there. Please try again!", 'alterna' ); ?></p>
				</div>
    		</div>
            
            <?php if($layout == 3) : ?> 
            	<div class="span4"><?php generated_dynamic_sidebar(); ?></div>
            <?php endif; ?>
    	</div>
	</div>

<?php get_footer(); ?>