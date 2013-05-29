<?php
/**
 * Template Name: Contact Template
 *
 * @since alterna 1.0
 */


$recaptcha = intval(get_post_meta(get_the_ID() , 'form-recaptcha', true));

// Get a key from https://www.google.com/recaptcha/admin/create
$publickey 	= get_post_meta(get_the_ID() , 'recaptcha-pub-api', true);
$privatekey = get_post_meta(get_the_ID() , 'recaptcha-pri-api', true);

$recaptcha_valid = false;

if($recaptcha == 1 && $publickey != "" && $privatekey != ""){
	$recaptcha_valid = true;
	
	require_once('inc/tools/recaptchalib.php');
	
	# the response from reCAPTCHA
	$resp = null;
	
	# the error code from reCAPTCHA, if any
	$recaptcha_error = null;
	
	# was there a reCAPTCHA response?
	if ($_POST["recaptcha_response_field"]) {
			$resp = recaptcha_check_answer ($privatekey,
											$_SERVER["REMOTE_ADDR"],
											$_POST["recaptcha_challenge_field"],
											$_POST["recaptcha_response_field"]);
	
			if ($resp->is_valid) {
					echo "You got it!";
			} else {
					# set the error code so that we can display it
					$recaptcha_error = $resp->error;
					$hasError = true;
			}
	}
}

?>
<?php
if(isset($_POST['submitted'])) {
	$nameError 		= '';
    $emailError 	= '';
    $subjectError	= '';
    $messageError 	= '';
	$recipientError	= '';
	$emailSent		= false;
	if(trim($_POST['contactName']) === '') {
		$nameError = __('Please enter your name.','alterna');
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}

	if(trim($_POST['email']) === '')  {
		$emailError = __('Please enter your email address.','alterna');
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = __('You entered an invalid email address.','alterna');
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}
	
	if(trim($_POST['subject']) === '') {
		$subjectError = __('Please enter subject.','alterna');
		$hasError = true;
	} else {
		$subject = trim($_POST['subject']);
	}

	if(trim($_POST['message']) === '') {
		$messageError = __('Please enter a message.','alterna');
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$message = stripslashes(trim($_POST['message']));
		} else {
			$message = trim($_POST['message']);
		}
	}

	//If there is no error, send the email
	if(!isset($hasError)) {
		$emailTo = get_post_meta(get_the_ID() , 'contact-recipient', true);
		if($emailTo != ""){
			$subject = $subject;
			$body = __('Name: ','alterna'). $name.'\r\n'.__('Email: ','alterna'). $email .'\r\n'.__('Message: ','alterna'). $message;
			$headers = __('From: ','alterna').$name.'<'.$email.'>';
	
			$emailSent = wp_mail( $emailTo, $subject, $body, $headers );
		}else{
			$hasError = false;
			$recipientError = __('Please add your recipient email throught edit admin -> page options setting.','alterna');
		}
	}

} ?>

<?php get_header(); ?>
	
    <?php $layout = alterna_get_page_layout(); // get page layout ?>
	
	<div id="main" class="container">
    
    	<?php 				
			// show google map
			if(intval(get_post_meta(get_the_ID() , 'map-show', true)) == 1) {
				$map_height = intval(get_post_meta(get_the_ID() , 'map-height', true));
				if($map_height == 0) $map_height = '320';
				echo do_shortcode('[map id="map_contact" width="100%" height="'.$map_height.'" latlng="'.get_post_meta(get_the_ID() , 'map-latlng', true).'" scrollwheel="no" show_marker="yes" show_info="yes" info_width="300"]'.get_post_meta(get_the_ID() , 'map-address', true).'[/map]'); 
			}
		?>
        
    	<div class="row-fluid">
        	<?php if($layout == 2) : ?> 
            	<div class="span4"><?php generated_dynamic_sidebar(); ?></div>
            <?php endif; ?>
        	<div class="<?php echo $layout == 1 ? 'span12' : 'span8'; ?>">
            
            	<!-- show contact page custom content -->
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                	<div class="row-fluid">
                    <?php the_content(); ?>
                    </div>
                <?php endwhile; endif; ?>
                
                <!-- show contact form -->
                <div class="row-fluid">
                	<h4><?php _e('Contact Form','alterna'); ?></h4>
                	<form id="contact-form" class="contact-form" action="<?php the_permalink(); ?>" method="post">
						<?php 
							if(isset($emailSent) && $emailSent == true) { 
                                echo do_shortcode('[alert type="success" title="Congratulations!"]Thanks, your email was sent successfully.[/alert]');
                             } else if(isset($hasError)) {
                                 $err_alert = '[alert type="danger" title="Oh snap! You got an error!"]<p><ol>';
								 if($recipientError != '') $err_alert .= '<li><h6>'.$recipientError.'</h6></li>';
                                 if($nameError != '') $err_alert .= '<li><h6>'.$nameError.'</h6></li>';
                                 if($emailError != '') $err_alert .= '<li><h6>'.$emailError.'</h6></li>';
                                 if($subjectError != '') $err_alert .= '<li><h6>'.$subjectError.'</h6></li>';
                                 if($messageError != '') $err_alert .= '<li><h6>'.$messageError.'</h6></li>';
								 if($recaptcha_valid && $recaptcha_error != '') $err_alert .= '<li><h6>'.$recaptcha_error.'</h6></li>';
                                 $err_alert .= '</ol></p>[/alert]';
                                 echo do_shortcode($err_alert);
                            }
						?>
                        <div>
                            <?php _e('Name','alterna'); ?><br>
                            <input type="text" class="input-xlarge" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName']) && !$emailSent) echo $_POST['contactName'];?>" />
                        </div>
                        
                        <div>
                            <?php _e('Email','alterna'); ?><br>
                            <input type="text" class="input-xlarge" name="email" id="email" value="<?php if(isset($_POST['email']) && !$emailSent)  echo $_POST['email'];?>" />
                        </div>
                        
                        <div>
                            <?php _e('Subject','alterna'); ?><br>
                            <input type="text" class="input-xlarge" name="subject" id="subject" value="<?php if(isset($_POST['subject']) && !$emailSent)  echo $_POST['subject'];?>" />
                        </div>
                        
                         <div>
                            <?php _e('Message','alterna'); ?><br>
                            <textarea name="message" id="commentsText" rows="5" cols="60" class="input-xlarge required requiredField"><?php if(isset($_POST['message']) && !$emailSent) { if(function_exists('stripslashes')) { echo stripslashes($_POST['message']); } else { echo $_POST['message']; } } ?></textarea>
                        </div>
                        <?php if($recaptcha_valid) echo recaptcha_get_html($publickey, $recaptcha_error); ?>
                        <input type="submit" id="submit" class="btn btn-custom" value="<?php _e('Send Message','alterna'); ?>" />
                        <input type="hidden" name="submitted" id="submitted" value="true" />
                	</form>
                </div>
                
    		</div>
            <?php if($layout == 3) : ?> 
            	<div class="span4"><?php generated_dynamic_sidebar(); ?></div>
            <?php endif; ?>
    	</div>
        
	</div>

<?php get_footer(); ?>