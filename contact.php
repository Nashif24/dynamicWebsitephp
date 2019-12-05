<?php  

	define("TITLE" , "Contact Us | Franklin's Fine Dining");

	include('includes/header.php');

?>

	<div id="contact">

		<hr>

		<h1>Get in touch with us!</h1>

		<?php 

			//check for header injections
			function has_header_injection($str) {
				return preg_match("/[\r\n]/", $str );
			}	

			if (isset ($_POST['contact_submit'])) {

				$name  = trim($_POST['name']);
				$email  = trim($_POST['email']);
				$msg  = $_POST['message'];

				//check to see if $name or $email have header injections

				if (has_header_injection($name) || has_header_injection($email)) {
					die(); //if true kill the script
				}


				if ( !$name || !$email || !$msg) {
					
					echo  '<h4 class="error">All fields required.</h4><a href="contact.php" class="button block"> Go back and try again</a>';
					exit;
				}


				//add the recipient email to a variable

				$to = "nashifjohnson@gmail.com";

				//create a subject
				$subject = "$name sent you a message via contact form";

				//construct the message
				$message = "Name: $name\r\n";
				$message .= "Email: $email\r\n";
				$message .= "Message:\r\n$msg";

				//if the subsribe checkbox was checked...
				if (isset($_POST['subsribe']) && $_POST['subscribe'] == 'Subscribe') {

					//add a new line to the message
					$message .= "\r\n\r\nPlease add $email to the mailing list.\r\n";
				}

				$message = wordwrap($message, 72);

				//set the mail headers into a variable
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "Contact-type: text/plain; charset=iso-8859-1\r\n";
				$headers .= "From: $name <$email>\r\n";
				$headers .= "X-Priority: 1\r\n";
				$headers .= "X-MSMail-Priority: High\r\n\r\n";

				//send the email 
				mail( $to, $subject, $message, $headers );



		 ?>

		 <!--show success message after email has been sent-->
		 <h5>Thanks for contacting Franklin's!</h5>
		 <p>Please allow 24 hours for a response</p>
		 <p><a href="/Student" class="button block">&laquo; Go back to the home page</a></p>



		<?php } else { ?>

		<form method="post" action="" id="contact-form">

			<label for="name">Your name</label>
			<input type="text" name="name" id="name">

			<label for="email">Your email</label>
			<input type="email" name="email" id="email">

			<label for="message">Your message</label>
			<textarea id="message" name="message"></textarea>

			<input type="checkbox" name="subscribe" id="subscribe" value="Subscribe">
			<label for="subscribe">Subscribe to newsletter</label>

			<input type="submit" class="button next" name="contact_submit" value="Send Message">
			

			
		</form>

	<?php } ?>
		
	</div><!---contact-->


<?php include ('includes/footer.php'); ?>