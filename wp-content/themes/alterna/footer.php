<?php
/**
 * The Footer for our theme.
 *
 * @since alterna 1.0
 */
?>
	</div><!-- end content-wrap -->

	<div class="footer-wrap <?php echo intval(alterna_get_options_key('global-layout')) == 0 ? 'container' : '';?>">
    	<footer id="footer-content" class="container">
        	<div class="footer-top-content row-fluid">
        		<?php $cols = alterna_get_footer_widget_active_items(); ?>
				<?php if (function_exists('dynamic_sidebar') && is_active_sidebar('sidebar-footer-1')): ?>
                <div class="<?php echo $cols; ?>">
                    <?php dynamic_sidebar('sidebar-footer-1') ?>
                </div>
                <?php endif; ?>
               <?php if (function_exists('dynamic_sidebar') && is_active_sidebar('sidebar-footer-2')): ?>
                <div class="<?php echo $cols; ?>">
                    <?php dynamic_sidebar('sidebar-footer-2') ?>
                </div>
                <?php endif; ?>
                <?php if (function_exists('dynamic_sidebar') && is_active_sidebar('sidebar-footer-3')): ?>
                <div class="<?php echo $cols; ?>">
                    <?php dynamic_sidebar('sidebar-footer-3') ?>
                </div>
                <?php endif; ?>
                <?php if (function_exists('dynamic_sidebar') && is_active_sidebar('sidebar-footer-4')): ?>
                <div class="<?php echo $cols; ?>">
                    <?php dynamic_sidebar('sidebar-footer-4') ?>
                </div>
                <?php endif; ?>
			</div>
            
        	<div class="footer-bottom-content row-fluid">
            	<div class="footer-copyright"><?php echo alterna_get_options_key('footer-copyright-message'); ?></div>
            	<div class="footer-link"><?php echo alterna_get_options_key('footer-link-text'); ?></div>
        	</div>
    	</footer>
	</div><!-- end footer-wrap -->
	<?php wp_footer() ?>
</body>
</html>