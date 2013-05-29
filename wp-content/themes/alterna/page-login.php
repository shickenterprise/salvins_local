<?php
/**
 * Template Name: Login / Register Template
 *
 * @since alterna 1.0
 */

global $user_ID, $user_identity; get_currentuserinfo();

get_header(); ?>
	
    <?php $layout = alterna_get_page_layout(); // get page layout ?>

	<div id="main" class="container">
    	<div class="row-fluid">
        	<?php if($layout == 2) : ?> 
            	<div class="span4"><?php generated_dynamic_sidebar(); ?></div>
            <?php endif; ?>
            
        	<div class="<?php echo $layout == 1 ? 'span12' : 'span8'; ?>">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                	
                    <?php 
						$action = isset($_GET['action']) ? $_GET['action'] : "";
						$register = isset($_GET['register']) ? $_GET['register'] : ""; 
						$reset = isset($_GET['reset']) ? $_GET['reset'] : ""; 

						if ($register == true) { ?>
                            <h3><?php _e('Success!','alterna'); ?></h3>
                            <p><?php _e('Check your email for the password and log in.','alterna'); ?></p>
                        <?php } elseif ($reset == true) { ?>
                            <h3><?php _e('Success!','alterna'); ?></h3>
                            <p><?php _e('Check your email to reset your password.','alterna'); ?></p>
                        <?php } elseif ($action == 'lostpassword') { ?>
                            <h3><?php _e('Reset Password!','alterna'); ?></h3>
                         <?php } elseif ($action == 'register') { ?>
                            <h3><?php _e('Create an account?','alterna'); ?></h3>
                         <?php } elseif(!$user_ID) { ?>
                            <h3><?php _e('Sign In','alterna'); ?></h3>
                         <?php } ?>
                         
                    <?php if(!$user_ID) : ?>
                    	
                        <?php if($action == 'lostpassword' ) : ?>
                        	<form class="form-horizontal" name="loginform" id="loginform" action="<?php echo home_url(); ?>/wp-login.php?action=lostpassword" method="post">
                                <div class="control-group">
                                    <label class="control-label" for="user_login"><?php _e('Username or Email','alterna'); ?></label>
                                    <div class="controls">
                                        <input type="text" name="user_login" id="user_login" class="input" value="" size="20" tabindex="10" />
                                    </div>
                                </div>
                                <div class="control-group login-last">
                                	<div class="controls">
                                        <p class="submit">
                                            <input type="submit" name="wp-submit" id="wp-submit" class="btn" value="<?php _e('Reset my password','alterna'); ?> " tabindex="100" />
                                            <input type="hidden" name="redirect_to" value="<?php echo get_permalink(); ?>?reset=true" />
                                            <input type="hidden" name="user-cookie" value="1" />
                                        </p>
                                    </div>
                                </div>
                            </form>
                        <?php elseif($action == 'register') : ?>
                            <form class="form-horizontal" name="loginform" id="loginform" action="<?php echo home_url(); ?>/wp-login.php?action=register" method="post">
                                <div class="control-group">
                                    <label class="control-label" for="user_login"><?php _e('Username','alterna'); ?></label>
                                    <div class="controls">
                                        <input type="text" name="user_login" id="user_login" class="input" value="" size="20" tabindex="10" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="user_email"><?php _e('Your Email','alterna'); ?></label>
                                    <div class="controls">
                                        <input type="text" name="user_email" id="user_email" class="input" value="" size="20" tabindex="20" />
                                    </div>
                                </div>
                                <div class="control-group login-last">
                                	<div class="controls">
                                        <p class="submit">
                                            <input type="submit" name="wp-submit" id="wp-submit" class="btn" value="<?php _e('Register','alterna'); ?>" tabindex="100" />
                                            <input type="hidden" name="redirect_to" value="<?php echo get_permalink(); ?>?register=true" />
                                            <input type="hidden" name="user-cookie" value="1" />
                                        </p>
                                    </div>
                                </div>
                            </form>
                        <?php else : ?>
                            <form class="form-horizontal" name="loginform" id="loginform" action="<?php echo home_url(); ?>/wp-login.php" method="post">
                                <div class="control-group">
                                    <label class="control-label" for="user_login"><?php _e('Username','alterna'); ?></label>
                                    <div class="controls">
                                        <input type="text" name="log" id="user_login" class="input" value="" size="20" tabindex="10" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="user_pass"><?php _e('Password','alterna'); ?></label>
                                    <div class="controls">
                                        <input type="password" name="pwd" id="user_pass" class="input" value="" size="20" tabindex="20" />
                                    </div>
                                </div>
                                <div class="control-group login-last">
                                <div class="controls">
                                <label class="checkbox">
                                <input  name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90"> <?php _e('Remember me','alterna'); ?>
                                </label>
                                <p class="submit">
                                    <input type="submit" name="wp-submit" id="wp-submit" class="btn" value="Log In" tabindex="100" />
                                    <input type="hidden" name="redirect_to" value="<?php echo get_permalink(); ?>" />
                                    <input type="hidden" name="user-cookie" value="1" />
                                    <a href="<?php echo get_permalink(); ?>?action=lostpassword" title="<?php _e('Lost your password!','alterna'); ?>"><?php _e('Lost your password?','alterna'); ?></a>
                                    <?php if(get_option('users_can_register')) { ?>
                                    / <a href="<?php echo get_permalink(); ?>?action=register" title="<?php _e('Register','alterna'); ?>"><?php _e('Register','alterna'); ?></a>
                                    <?php } ?>
                                </p>
                                </div>
                                </div>
                            </form>
                        <?php endif; ?>
                   	<?php else : ?>
                    	<h3><?php echo __('Welcome, ','alterna').$user_identity; ?></h3>
                        <div class="usericon">
						<?php echo get_avatar($userdata->ID, 60); ?>
                        </div>
                        <div class="userinfo">
                            <p><?php _e('You&rsquo;re logged in as','alterna'); ?> <strong><?php echo $user_identity; ?></strong></p>
                            <p>
                                <a href="<?php echo wp_logout_url(get_permalink()); ?>"><?php _e('Log out','alterna'); ?></a> | 
                                <?php if (current_user_can('manage_options')) { 
                                    echo '<a href="' . admin_url() . '">' . __('Admin','alterna') . '</a>'; } else { 
                                    echo '<a href="' . admin_url() . 'profile.php">' . __('Profile','alterna') . '</a>'; } ?>
                
                            </p>
                        </div>
                    <?php endif; ?>
                    
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