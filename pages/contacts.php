<div class="container">
	<h1  class="text-center"> Contacts </h1>
	
	<?php 
	/*showMessage();*/ 
	?>

	<form action="index.php?page=contacts" method="POST" class="col-6  m-auto">
		<div class="form-group">
			<label for="email">Email:</label>
			<input type="text" id="email" name="email" 	class="form-control <?= getError('email') ? 'is-invalid' : '' ?>">
			<?php if(getError('email')) {
				echo '<div class="invalid-feedback">' . getError('email') . '</div>';
			}?>
		</div>

		<div class="form-group">
			<label for="message">Message:</label>
			<textarea id="message" name="message"  class="form-control <?= getError('message') ? 'is-invalid' : '' ?>"></textarea>
			<?php if(getError('message')) {
				echo '<div class="invalid-feedback">' . getError('message') . '</div>';
			}?>
		</div>

		<div class="form-group">
			<img src="images-php/captcha.php">
			<input type="text" name="captcha" class="form-control">
		</div>

		<button class="btn btn-primary" name="action" value="sendMail">Send</button>
	</form>
	
</div>