<?php
/**
 * The template for displaying Search Results pages.
 *
 * @since alterna 1.0
 */

get_header(); ?>
	
   <?php $layout = alterna_get_page_layout('global'); //get global layout ?>
    
	<div id="main" class="container">
    
    	<div class="row-fluid">

            <?php if($layout == 2) : ?> 
            	<div class="span4"><?php generated_dynamic_sidebar(); ?></div>
            <?php endif; ?>
            
        	<div class="left-side <?php echo $layout == 1 ? 'span12' : 'span8'; ?>">
				<?php if ( have_posts() ) : ?>
					
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php 
							$post_type = get_post_type(get_the_ID());
							if($post_type == "post"){
								get_template_part( 'content', get_post_format() );
							}else if($post_type == "page" || $post_type == "portfolio") {
							?>
                            	<article id="post-<?php the_ID(); ?>" <?php post_class('entry-post');?> >
                                    <!-- post date -->
                                    <div class="entry-left-side span3">
                                        <div class="post-date-type row-fluid">
                                            <div class="post-type"><i class="big-icon-file"></i></div>
                                            <div class="date">
                                                <div class="day"><?php echo get_the_date('d'); ?></div>
                                                <div class="month"><?php echo get_the_date('M'); ?></div>
                                                <div class="year"><?php echo get_the_date('Y'); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <!-- post content -->
                                    <div class="entry-right-side span9">
                                        <div class="title"><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3></div>
                                        <div class="clear"></div>
                                        <div class="search-post-mate  row-fluid">
                                        <div class="post-type"><i class="icon-leaf"></i><?php 
										if( $post_type == "page") {
											_e('Page','alterna');
										}else{
											_e('Portfolio','alterna');
										}
										?></div>
                                         <div class="post-author"><i class="icon-user"></i><?php _e('by','alterna'); ?> <?php the_author_link();?></div>
                                        <div class="post-comments"><i class="icon-comments"></i><a href="<?php echo get_permalink(get_the_ID()).'#comments'; ?>"><?php comments_number(__('No Comment' , 'alterna') , __('1 Comment' , 'alterna') , __('% Comments' , 'alterna')); ?></a></div>
                                        <?php edit_post_link(__('Edit', 'alterna'), '<div class="post-edit"><i class="icon-edit"></i>', '</div>'); ?>	
                                        </div>
                                        <div class="search-post-content  row-fluid">
                                        	<p><?php echo string_limit_words(get_the_excerpt()); ?></p>
                                        	<a class="search-read-more" href="<?php the_permalink(); ?>"><?php echo alterna_get_options_key('global-read-more' , '' , false , 'Read More &raquo;'); ?></a>
                                        </div>
                                    </div>
                                </article>
                            <?php
							}
						?>
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
            	<div class="span4"><?php generated_dynamic_sidebar(); ?></div>
            <?php endif; ?>
		</div><!-- #row-fluid -->
    </div><!-- #container -->
        
<?php get_footer(); ?>