<div class="container">
	<h1  class="text-center"> Registration </h1>
	<?php 
		/*showMessage();	*/	
	?>

	<form action="index.php?page=registration" method="POST" class="col-6  m-auto">
		<div class="form-group">
			<label for="useremail">Email:</label>
			<input type="text" id="useremail" name="useremail" 	class="form-control <?= getError('useremail') ? 'is-invalid' : '' ?>">
			<?php if(getError('useremail')) {
				echo '<div class="invalid-feedback">' . getError('useremail') . '</div>';
			}?>
		</div>

		<div class="form-group">
			<label for="passwordUser">Password:</label>
			<input type="password" class="	form-control <?= getError('passwordUser') ? 'is-invalid' : '' ?>" maxlength="25" size="40" name="passwordUser" id="passwordUser ">	
			<?php if(getError('passwordUser')) {
				echo '<div class="invalid-feedback">' . getError('passwordUser') . '</div>';
			}?>		
		</div>

		<div class="form-group">
			<label for="passwordReplay">Replay password:</label>
			<input type="password" class="form-control <?= getError('passwordReplay') ? 'is-invalid' : '' ?>" maxlength="25" size="40" name="passwordReplay" id="passwordReplay">	
			<?php if(getError('passwordReplay')) {
				echo '<div class="invalid-feedback">' . getError('passwordReplay') . '</div>';
			}?>			
		</div>

		<button class="btn btn-primary" name="action" value="sendRegistration">Send</button>
	</form>
	
</div>