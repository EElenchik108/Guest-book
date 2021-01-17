<div class="container">
<h1  class="text-center"> Poll </h1>
	
<h4 class="col-6  m-auto" style="text-align: center;">Which color do you like more?</h4>
	<form action="index.php?page=poll" method="POST" class="col-6  m-auto"  style="width: 155px; padding-left: 40px;  padding-top: 30px;">
		
		<?php showMessage() ?>
		<div class="form-group">
			<label>Сhoose color<br>
				<input type="radio" name="colors" value="red" style="margin-top: 18px; margin-right: 10px;"><b style="color: #EC1A1A;">red</b><br> 
				<input type="radio" name="colors" value="green" style="margin-top: 18px; margin-right: 10px;"><b style="color: #359A33;">green</b><br>
				<input type="radio" name="colors" value="blue" style="margin-top: 18px; margin-right: 10px;"><b style="color: #3B22F6;">blue</b><br>
				</label>
		</div>	

		<button class="btn btn-primary" name="action" value="colorValue">Send</button>
	</form>
	
</div>

<div class="container mt-5" style="width: 410px; margin-bottom: 20px; margin-top: 0.5rem!important;">
<?php 
	showColor();
?>
<div class="form-group">
	<?php 
		$r = issetSession('red');
		$g = issetSession('green');
		$b = issetSession('blue');
		echo "<img src='images-php/schedule.php?r=$r&g=$g&b=$b'>";
	?>
						
</div>
</div>

