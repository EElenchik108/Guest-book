<h1 class="text-center">Guest Book</h1>

<form action="index.php?page=guest-book" method="POST" class="col-6 m-auto">
	<?php showMessage() ?>
	<div class="form-group" >
			<label for="name">Name:</label>
			<input type="text" id="name" name="name" class="form-control">			
		</div>

		<div class="form-group">
			<label for="email">Massage:</label>
			<textarea id="message" name="message"  class="form-control"></textarea>
		</div>

		<button class="btn btn-primary" name="action" value="sendBook">Send</button>
</form>
<div class="container mt-5">
<?php 
	showGuestBook();
?>
</div>

