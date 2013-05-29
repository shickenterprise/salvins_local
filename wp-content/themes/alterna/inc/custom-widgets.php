<?php


/**
 * Register All Widget
 */
function alterna_register_widgets() {
	
	register_widget( 'AlternaPortfolioCategoryWidget' );
	register_widget( 'AlternaPortfolioRecentWidget' );
	
	register_widget( 'AlternaBlogRecentWidget' );
	
	register_widget( 'AlternaTwitterWidget' );
}

add_action( 'widgets_init', 'alterna_register_widgets' );

/**
 * Twitter Widget
 */
class AlternaTwitterWidget extends WP_Widget {

	function AlternaTwitterWidget() {
		// Instantiate the parent object
		parent::__construct( false, __('Alterna Twitter Widget','alterna'), array( 'description' => __( 'Alterna twitter v1.0 api widget. The twitter plugin it is not support v1.1 api, so if you find it is not display correct content, please use other twitter plugin which support twitter v1.1! ', 'alterna' )));
	}

	function widget( $args, $instance ) {
		// Widget output
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$name = apply_filters('widget_title', $instance['name'] );
		$count = apply_filters('widget_title', $instance['count'] );
		
		echo $before_widget;
		
		if ( $title ) {
		    echo $before_title . $title . $after_title;
		}
		
		if($name == "" || intval($count) == 0){
			echo __('Please Setting Account Name and Count','alterna');
		}else{
			echo do_shortcode('[twitter name="'.$name.'" count="'.$count.'"]');
		}
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['name'] = strip_tags($new_instance['name']);
		$instance['count'] = intval($new_instance['count']);
		return $instance;
	}

	function form( $instance ) {
		// Output admin widget options form
		if( isset($instance['title']) ){
			$title = $instance['title'];
		}else{
			$title = __('Recent Tweets','alterna');
		}
		if( isset($instance['name']) ){
			$name = $instance['name'];
		}else{
			$name = '';
		}
		if( isset($instance['count']) ){
			$count = $instance['count'];
		}else{
			$count = 3;
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        <p>
		<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'Account Name:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>" />
		</p>
        <p>
		<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Tweets Number:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>" />
		</p>
        <?php
	}
}


/**
 * Portfolio Category Widget
 */
class AlternaPortfolioCategoryWidget extends WP_Widget {

	function AlternaPortfolioCategoryWidget() {
		// Instantiate the parent object
		parent::__construct( false, __('Alterna Portfolio Category','alterna'), array( 'description' => __( 'Alterna portfolio categories! ', 'alterna' )));
	}

	function widget( $args, $instance ) {
		// Widget output
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		
		echo $before_widget;
		
		if ( $title ) {
		    echo $before_title . $title . $after_title;
		}
		
		echo alterna_get_portfolio_categories();
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	function form( $instance ) {
		// Output admin widget options form
		if( isset($instance['title']) ){
			$title = $instance['title'];
		}else{
			$title = __('Categories','alterna');
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        <?php
	}
}

/**
 * Portfolio Recent Widget
 */
class AlternaPortfolioRecentWidget extends WP_Widget {

	function AlternaPortfolioRecentWidget() {
		// Instantiate the parent object
		parent::__construct( false, __('Alterna Portfolio Recent Items','alterna'), array( 'description' => __( 'Alterna portfolio recent , featured items widget! ', 'alterna' )));
	}

	function widget( $args, $instance ) {
		// Widget output
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		
		$show_type = apply_filters('widget_title', $instance['show_type'] );
		
		$show_featured = apply_filters('widget_title', $instance['show_featured'] );
		$featured_title = apply_filters('widget_title', $instance['featured_title'] );
		$featured_ids = apply_filters('widget_title', $instance['featured_ids'] );
		
		$show_recent = apply_filters('widget_title', $instance['show_recent'] );
		$recent_title = apply_filters('widget_title', $instance['recent_title'] );
		$recent_number = apply_filters('widget_title', $instance['recent_number'] );
		
		echo $before_widget;
		
		if ( $title ) {
		    echo $before_title . $title . $after_title;
		}
		
		$html = '[tabs]';
		if($show_featured) {
			if($featured_title == "") $featured_title = __('Featured','alterna');
			$html .='[tabs_item title="'.$featured_title.'"]'.alterna_get_portfolio_widget_post('featured','',$featured_ids,false,$show_type).'[/tabs_item] ';
		}
		if($show_recent) {
			if($recent_title == "") $recent_title = __('Recent','alterna');
			$html .='[tabs_item title="'.$recent_title.'"]'.alterna_get_portfolio_widget_post('recent',$recent_number,'',false,$show_type).'[/tabs_item] ';
		}
		$html .='[/tabs]';
		
		echo do_shortcode($html);
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['show_type'] = strip_tags($new_instance['show_type']);
		$instance['show_featured'] = strip_tags($new_instance['show_featured']);
		$instance['featured_title'] = strip_tags($new_instance['featured_title']);
		$instance['featured_ids'] = strip_tags($new_instance['featured_ids']);
		$instance['show_recent'] = strip_tags($new_instance['show_recent']);
		$instance['recent_title'] = strip_tags($new_instance['recent_title']);
		$instance['recent_number'] = strip_tags($new_instance['recent_number']);
		return $instance;
	}

	function form( $instance ) {
		// Output admin widget options form
		if( isset($instance['title']) ){
			$title = $instance['title'];
		}else{
			$title = "";
		}
		
		if( isset($instance['show_type']) ){
			$show_type = intval($instance['show_type']);
		}else{
			$show_type = 0;
		}
		
		if( isset($instance['show_featured']) ){
			$show_featured = $instance['show_featured'];
		}else{
			$show_featured = "yes";
		}
		
		if( isset($instance['featured_title']) && $instance['featured_title'] != ""){
			$featured_title = $instance['featured_title'];
		}else{
			$featured_title = __('Featured','alterna');
		}
		
		if( isset($instance['featured_ids']) ){
			$featured_ids = $instance['featured_ids'];
		}else{
			$featured_ids = "";
		}
		
		if( isset($instance['show_recent']) ){
			$show_recent = $instance['show_recent'];
		}else{
			$show_recent = "yes";
		}
		if( isset($instance['recent_title'])  && $instance['recent_title'] != ""){
			$recent_title = $instance['recent_title'];
		}else{
			$recent_title = __('Recent','alterna');
		}
		if( isset($instance['recent_number']) ){
			$recent_number = intval($instance['recent_number']);
		}else{
			$recent_number = 5;
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        <p>
        <label for="<?php echo $this->get_field_id( 'show_type' ); ?>"><?php _e( 'Show Type:' , 'alterna'); ?></label> 
        <select class="widefat" id="<?php echo $this->get_field_id( 'show_type' ); ?>" name="<?php echo $this->get_field_name( 'show_type' ); ?>" type="text">
        	<option value="0" <?php echo $show_type == 0 ? 'selected="selected"' : ''; ?>><?php _e( 'Thumbs with Title' , 'alterna'); ?></option>
            <option value="1" <?php echo $show_type == 1 ? 'selected="selected"' : ''; ?>><?php _e( 'Icon with Title' , 'alterna'); ?></option>
        </select>
        </p>
        <hr />
        <p>
        <label for="<?php echo $this->get_field_id( 'show_featured' ); ?>"><input id="<?php echo $this->get_field_id( 'show_featured' ); ?>" name="<?php echo $this->get_field_name( 'show_featured' ); ?>" type="checkbox" <?php checked('yes' , $show_featured); ?> value="yes" /><?php _e( 'Click show featured items' , 'alterna'); ?></label> 
		</p>
        <p>
		<label for="<?php echo $this->get_field_id( 'featured_title' ); ?>"><?php _e( 'Featured Title:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'featured_title' ); ?>" name="<?php echo $this->get_field_name( 'featured_title' ); ?>" type="text" value="<?php echo esc_attr( $featured_title ); ?>" />
		</p>
        <p>
		<label for="<?php echo $this->get_field_id( 'featured_ids' ); ?>"><?php _e( 'Features Item Id with ",' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'featured_ids' ); ?>" name="<?php echo $this->get_field_name( 'featured_ids' ); ?>" type="text" value="<?php echo esc_attr( $featured_ids ); ?>" />
		</p>
        
        <hr />
        <p>
        <label for="<?php echo $this->get_field_id( 'show_recent' ); ?>"><input id="<?php echo $this->get_field_id( 'show_recent' ); ?>" name="<?php echo $this->get_field_name( 'show_recent' ); ?>" type="checkbox" <?php checked('yes' , $show_recent); ?>  value="yes" /><?php _e( 'Click show recent items' , 'alterna'); ?></label> 
		</p>
        <p>
		<label for="<?php echo $this->get_field_id( 'recent_title' ); ?>"><?php _e( 'Recent Title:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'recent_title' ); ?>" name="<?php echo $this->get_field_name( 'recent_title' ); ?>" type="text" value="<?php echo esc_attr( $recent_title ); ?>" />
		</p>
        <p>
        <label for="<?php echo $this->get_field_id( 'recent_number' ); ?>"><?php _e( 'Recent Items number' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'recent_number' ); ?>" name="<?php echo $this->get_field_name( 'recent_number' ); ?>" value="<?php echo esc_attr( $recent_number ); ?>" ?>
		</p>
        <?php
	}
}

/**
 * Blog Recent Widget
 */
class AlternaBlogRecentWidget extends WP_Widget {

	function AlternaBlogRecentWidget() {
		// Instantiate the parent object
		parent::__construct( false, __('Alterna Blog Recent Items','alterna'), array( 'description' => __( 'Alterna blog recent , featured , popular items widget! ', 'alterna' )));
	}

	function widget( $args, $instance ) {
		// Widget output
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		
		$show_type = apply_filters('widget_title', $instance['show_type'] );
		
		$show_featured = apply_filters('widget_title', $instance['show_featured'] );
		$featured_title = apply_filters('widget_title', $instance['featured_title'] );
		$featured_ids = apply_filters('widget_title', $instance['featured_ids'] );
		
		$show_popular = apply_filters('widget_title', $instance['show_popular'] );
		$popular_title = apply_filters('widget_title', $instance['popular_title'] );
		$popular_number = apply_filters('widget_title', $instance['popular_number'] );
		
		$show_recent = apply_filters('widget_title', $instance['show_recent'] );
		$recent_title = apply_filters('widget_title', $instance['recent_title'] );
		$recent_number = apply_filters('widget_title', $instance['recent_number'] );
		
		echo $before_widget;
		
		if ( $title ) {
		    echo $before_title . $title . $after_title;
		}
		
		$html = '[tabs]';
		if($show_featured) {
			if($featured_title == "") $featured_title = __('Featured','alterna');
			$html .='[tabs_item title="'.$featured_title.'"]'.alterna_get_blog_widget_post('featured','',$featured_ids,false,$show_type).'[/tabs_item] ';
		}
		if($show_popular) {
			if($popular_title == "") $popular_title = __('Popular','alterna');
			$html .='[tabs_item title="'.$popular_title.'"]'.alterna_get_blog_widget_post('popular',$popular_number,'',false,$show_type).'[/tabs_item] ';
		}
		if($show_recent) {
			if($recent_title == "") $recent_title = __('Recent','alterna');
			$html .='[tabs_item title="'.$recent_title.'"]'.alterna_get_blog_widget_post('recent',$recent_number,'',false,$show_type).'[/tabs_item] ';
		}
		$html .='[/tabs]';
		
		echo do_shortcode($html);
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['show_type'] = strip_tags($new_instance['show_type']);
		$instance['show_featured'] = strip_tags($new_instance['show_featured']);
		$instance['featured_title'] = strip_tags($new_instance['featured_title']);
		$instance['featured_ids'] = strip_tags($new_instance['featured_ids']);
		
		$instance['show_popular'] = strip_tags($new_instance['show_popular']);
		$instance['popular_title'] = strip_tags($new_instance['popular_title']);
		$instance['popular_number'] = strip_tags($new_instance['popular_number']);
		
		$instance['show_recent'] = strip_tags($new_instance['show_recent']);
		$instance['recent_title'] = strip_tags($new_instance['recent_title']);
		$instance['recent_number'] = strip_tags($new_instance['recent_number']);
		return $instance;
	}

	function form( $instance ) {
		// Output admin widget options form
		if( isset($instance['title']) ){
			$title = $instance['title'];
		}else{
			$title = "";
		}
		
		if( isset($instance['show_type']) ){
			$show_type = intval($instance['show_type']);
		}else{
			$show_type = 0;
		}
		
		if( isset($instance['show_featured']) ){
			$show_featured = $instance['show_featured'];
		}else{
			$show_featured = "yes";
		}
		
		if( isset($instance['featured_title']) && $instance['featured_title'] != ""){
			$featured_title = $instance['featured_title'];
		}else{
			$featured_title = __('Featured','alterna');
		}
		
		if( isset($instance['featured_ids']) ){
			$featured_ids = $instance['featured_ids'];
		}else{
			$featured_ids = "";
		}
		
		if( isset($instance['show_popular']) ){
			$show_popular = $instance['show_popular'];
		}else{
			$show_popular = "yes";
		}
		if( isset($instance['popular_title'])  && $instance['popular_title'] != ""){
			$popular_title = $instance['popular_title'];
		}else{
			$popular_title = __('Popular','alterna');
		}
		if( isset($instance['popular_number']) ){
			$popular_number = intval($instance['popular_number']);
		}else{
			$popular_number = 5;
		}
		
		if( isset($instance['show_recent']) ){
			$show_recent = $instance['show_recent'];
		}else{
			$show_recent = "yes";
		}
		if( isset($instance['recent_title'])  && $instance['recent_title'] != ""){
			$recent_title = $instance['recent_title'];
		}else{
			$recent_title = __('Recent','alterna');
		}
		if( isset($instance['recent_number']) ){
			$recent_number = intval($instance['recent_number']);
		}else{
			$recent_number = 5;
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        <p>
        <label for="<?php echo $this->get_field_id( 'show_type' ); ?>"><?php _e( 'Show Type:' , 'alterna'); ?></label> 
        <select class="widefat" id="<?php echo $this->get_field_id( 'show_type' ); ?>" name="<?php echo $this->get_field_name( 'show_type' ); ?>" type="text">
        	<option value="0" <?php echo $show_type == 0 ? 'selected="selected"' : ''; ?>><?php _e( 'Thumbs with Title' , 'alterna'); ?></option>
            <option value="1" <?php echo $show_type == 1 ? 'selected="selected"' : ''; ?>><?php _e( 'Icon with Title' , 'alterna'); ?></option>
        </select>
        </p>
        <hr />
        <p>
        <label for="<?php echo $this->get_field_id( 'show_featured' ); ?>"><input id="<?php echo $this->get_field_id( 'show_featured' ); ?>" name="<?php echo $this->get_field_name( 'show_featured' ); ?>" type="checkbox" <?php checked('yes' , $show_featured); ?> value="yes" /><?php _e( 'Click show featured items' , 'alterna'); ?></label> 
		</p>
        <p>
		<label for="<?php echo $this->get_field_id( 'featured_title' ); ?>"><?php _e( 'Featured Title:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'featured_title' ); ?>" name="<?php echo $this->get_field_name( 'featured_title' ); ?>" type="text" value="<?php echo esc_attr( $featured_title ); ?>" />
		</p>
        <p>
		<label for="<?php echo $this->get_field_id( 'featured_ids' ); ?>"><?php _e( 'Features Item Id with ",' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'featured_ids' ); ?>" name="<?php echo $this->get_field_name( 'featured_ids' ); ?>" type="text" value="<?php echo esc_attr( $featured_ids ); ?>" />
		</p>
        
        <hr />
        <p>
        <label for="<?php echo $this->get_field_id( 'show_popular' ); ?>"><input id="<?php echo $this->get_field_id( 'show_popular' ); ?>" name="<?php echo $this->get_field_name( 'show_popular' ); ?>" type="checkbox" <?php checked('yes' , $show_popular); ?>  value="yes" /><?php _e( 'Click show popular items' , 'alterna'); ?></label> 
		</p>
        <p>
		<label for="<?php echo $this->get_field_id( 'popular_title' ); ?>"><?php _e( 'Popular Title:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'popular_title' ); ?>" name="<?php echo $this->get_field_name( 'popular_title' ); ?>" type="text" value="<?php echo esc_attr( $popular_title ); ?>" />
		</p>
        <p>
        <label for="<?php echo $this->get_field_id( 'popular_number' ); ?>"><?php _e( 'Popular Items number' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'popular_number' ); ?>" name="<?php echo $this->get_field_name( 'popular_number' ); ?>" value="<?php echo esc_attr( $popular_number ); ?>" ?>
		</p>
        
        <hr />
        <p>
        <label for="<?php echo $this->get_field_id( 'show_recent' ); ?>"><input id="<?php echo $this->get_field_id( 'show_recent' ); ?>" name="<?php echo $this->get_field_name( 'show_recent' ); ?>" type="checkbox" <?php checked('yes' , $show_recent); ?>  value="yes" /><?php _e( 'Click show recent items' , 'alterna'); ?></label> 
		</p>
        <p>
		<label for="<?php echo $this->get_field_id( 'recent_title' ); ?>"><?php _e( 'Recent Title:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'recent_title' ); ?>" name="<?php echo $this->get_field_name( 'recent_title' ); ?>" type="text" value="<?php echo esc_attr( $recent_title ); ?>" />
		</p>
        <p>
        <label for="<?php echo $this->get_field_id( 'recent_number' ); ?>"><?php _e( 'Recent Items number' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'recent_number' ); ?>" name="<?php echo $this->get_field_name( 'recent_number' ); ?>" value="<?php echo esc_attr( $recent_number ); ?>" ?>
		</p>
        <?php
	}
}