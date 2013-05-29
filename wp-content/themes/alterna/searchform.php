<?php
/**
 * The template for displaying search forms in alterna
 *
 * @since alterna 1.0
 */
?>

<form role="search" class="sidebar-searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
   <div>
       <input id="sidebar-s" name="s" type="text" placeholder="<?php _e('Search','alterna'); ?>" />
       	<?php 
		if(have_posts()){
			$post_type = get_post_type(get_the_ID());
			if($post_type == "post" || $post_type == "portfolio") :
			?>
				<input id="sidebar-type" name="post_type" type="hidden" value="<?php echo $post_type;?>" />
			<?php endif;?>
        <?php } ?>
       <input id="sidebar-searchsubmit" type="submit" value="" />
   </div>
</form>