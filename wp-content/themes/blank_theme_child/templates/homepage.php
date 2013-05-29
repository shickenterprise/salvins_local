<?php
/*
Template Name: HomePage
*/
?>

<?php get_header(); ?>
<div class="main_content homepage">
	<div class="home_slider">
    	<?php putRevSlider( "home_slider" ) ?>
    </div>

    <div class="page_menu">
		<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
    </div>
    
    <div class="new_releases">
    </div>
    

   				   
	
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
				<?php the_content(); ?>
 <div class="home_recent_blog">
		<ul>
<?php
global $post;
$args = array( 'numberposts' => 5 );
$myposts = get_posts( $args );
foreach( $myposts as $post ) :	setup_postdata($post); ?>
	<li class="recent_blogs">
    
    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h1>
	<p>
	<?php the_excerpt();?>
    </p>
    </li>
<?php endforeach; wp_reset_postdata(); ?>
</ul>
		<?php endwhile; endif; ?>
 </div>

<div class="brands">
    <?php logo_slider(); ?>
    </div>


</div>
<?php get_footer(); ?>
