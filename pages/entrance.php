<div class="container">
	<h1  class="text-center"> Entrance </h1>
	<?php 
		/*showMessage()*/;
	?>

	<form action="index.php?page=entrance" method="POST" class="col-6  m-auto">
		<div class="form-group">
			<label for="emailUser">Email:</label>
			<input type="text" id="emailUser" name="emailUser" 	class="form-control <?= getError('emailUser') ? 'is-invalid' : '' ?>">
			<?php if(getError('emailUser')) {
				echo '<div class="invalid-feedback">' . getError('emailUser') . '</div>';
			}?>
		</div>

		<div class="form-group">
			<label for="password">Password:</label>
			<input type="password" class="	form-control <?= getError('password') ? 'is-invalid' : '' ?>" maxlength="25" size="40" name="password" id="password">	
			<?php if(getError('password')) {
				echo '<div class="invalid-feedback">' . getError('password') . '</div>';
			}?>		
		</div>		

		<button class="btn btn-primary" name="action" value="sendEntrance">Send</button>
	</form>
	<?php 
		/*showEntrance();*/
	?>
</div>