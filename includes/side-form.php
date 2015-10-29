<?php
//session_start();

if(isset($_POST['submit'])) {
	if(trim($_POST['contactName']) === '') {
		$nameError = 'Name';
		$error_message .= 'Your Name\n';
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}
	
	if(trim($_POST['email']) === '')  {
		$emailError = 'E-mail';
		$error_message .= 'Your Email\n';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$error_message .= 'Enter a valid Email\n';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}
	
	if(trim($_POST['comments']) === '') {
		$commentError = 'Please enter a message.';
		$error_message .= 'Comments\n';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}
	
	if( $_SESSION['security_code4'] == $_POST['security_code4'] && !empty($_SESSION['security_code4'] ) ) {
			unset($_SESSION['security_code4']);
			$errors['security_code4'] = '';
	   } else {
			$errors['security_code4'] = 'Incorrect Security Code';	
			$error_message .= 'Incorrect Security Code\n';			
			$hasError = true;	
	   }
	   
		if($hasError) echo 	'<script>alert("\nPlease re-enter mandatory fields below: " + "\n\n'.$error_message.'");</script>';	

	if(!isset($hasError)) {
		$emailTo = get_option('tz_email');
		if (!isset($emailTo) || ($emailTo == '') ){
			$emailTo = get_option('admin_email');
		}
		$subject = 'From '.$name;
		$body = "Name: $name \n\nPhone: $phone \n\nEmail: $email \n\nComments: $comments";
		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		wp_mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

} ?>
<?php if(isset($emailSent) && $emailSent == true) { ?>

<div class="thanks">
  <p>
    <?php _e('Thanks, your email was sent successfully.','language');?>
  </p>
</div>
<?php } else { ?>
<?php if(isset($hasError) || isset($captchaError)) { ?>
<p class="error">
  <?php _e('Sorry, an error occured.','language');?>
<p>
  <?php } ?>
<div class="right-block">
  <div class="contact-seller-block ">
    <h3><?php echo $title;?></h3>
    <form action="" id="contactFormPage" name="contactFormPage" method="post" class="seller-contact-form">
      <p>
      <?php $contactName = $_POST['contactName']; 
					if($contactName != '' && $contactName !='Name'){
						$contactName = $_POST['contactName']; 
					}else{
						$contactName = 'Name'; 
					}
				?>
        <input type="text" id="contactName" name="contactName" class="seller-input-bar" value="<?php echo $contactName; ?>" />
      </p>
      <?php if(isset($nameError) && ($nameError != '')) { ?>
      <span class="error">
      <?php $nameError;?>
      </span>
      <?php } ?>
      <p>
       <?php $email = $_POST['email']; 
					if($email != '' && $email !='E-mail'){
						$email = $_POST['email']; 
					}else{
						$email = 'E-mail'; 
					}
				?>
        <input type="text" name="email" id="email" class="seller-input-bar" value="<?php echo $email; ?>" class="seller-input-bar required requiredField email" />
      </p>
      <?php if(isset($emailError) && ($emailError != '')) { ?>
      <span class="error">
      <?php $emailError;?>
      </span>
      <?php } ?>
      <p>
        <label class="hide" for="comments">
          <?php _e('Message','language');?>
        </label>
        <?php $comments = $_POST['comments']; 
					if($comments != '' && $comments !='Please enter your message'){
						$comments = $_POST['comments']; 
					}else{
						$comments = 'Please enter your message'; 
					}
				?>
        <textarea name="comments" cols="8" rows="5" class="required requiredField message-box2"><?php echo $comments; ?>
</textarea>
      </p>
      <?php if(isset($commentError) && ($commentError != '')) { ?>
      <span class="error">
      <?php $commentError;?>
      </span>
      <?php } ?>
      <p>
      <div class="captcha_form"> <span class="error">
        <?php $errors['security_code4'];?>
        </span>
        <label for="commentsText">
          <?php _e('Security Text','language');?>
        </label>
        <img src="<?php echo get_bloginfo('template_directory'); ?>/includes/captcha/CaptchaSecurityImages4.php?width=100&height=40&characters=5" />
        <?php if($errors['security_code4'] != '') { ?>
        <?php } ?>
        <label for="security_code4">Security Code: </label>
        <input id="security_code4" name="security_code4" value="<?php echo $_POST['security_code4']; ?>" type="text" />
        <div class="clear"></div>
      </div>
      </p>
      <p>
        <input type="submit" id="submitsearch" name="submit" class="seller-send-btn" value="Send" />
      </p>
    </form>
  </div>
</div>
<?php } 
?>
