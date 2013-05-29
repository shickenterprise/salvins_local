<?php
/**
 * Pagination
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) {
		// get the current page
		$paged = 1;
		$max_show_number = 3;
		if (get_query_var('paged')) {
			$paged = get_query_var('paged');
		} else if (get_query_var('page')) {
			$paged = get_query_var('page');
		}
		
		?>
        <div class="pagination pagination-centered">
            <ul>
            <?php
                $max_number = $wp_query->max_num_pages;
                //prev button
                if($paged > 1) echo '<li><a href="'. get_pagenum_link($paged-1) .'">'.__('&laquo','alterna').'</a></li>';
				
                if($paged - $max_show_number > 1) echo  '<li><span>...</span></li>';
				
                for($k= $paged - $max_show_number; $k <= ($paged+$max_show_number) & $k <= $max_number; $k++){
                    if($k < 1) continue;
                    if($k == $paged) 
                        echo '<li><span class="disabled">'.$k.'</span></li>';
                    else
                        echo '<li><a href="'.get_pagenum_link( $k).'">'.$k.'</a></li>';
                }
                if($paged + $max_show_number < $max_number) {
                     echo  '<li><span>...</span></li>';
                     echo '<li><a href="'.get_pagenum_link( $k ).'">'.$max_number.'</a></li>';
                }
                //next button
                if($paged < $max_number) echo '<li><a href="'.get_pagenum_link($paged+1).'">'.__('&raquo;','alterna').'</a></li>';
				
            ?>
            </ul>
         </div>
        <?php
	}
?>