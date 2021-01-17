<h1  class="text-center">Slider creation</h1>
<div class="text-center m-auto" style="width: 650px; margin-top: 20px; margin-left: 9%;"><?php showMessage() ?></div>

<div class="container" style="display: flex; align-items: flex-start; flex-wrap: wrap; margin-top: 30px;">	
	<form class="col-6"  action="index.php?page=slider" method="POST" enctype="multipart/form-data">	
	
		<label for="folder"  style="width: 180px">Сreate slider:</label>
		<input type="text" id="folder" name="folder" 	class="form-control <?= getError('folder') ? 'is-invalid' : '' ?>" style="width: 180px">
		<?php if(getError('folder')) {
				echo '<div class="invalid-feedback">' . getError('folder') . '</div>';
		}?>
		<button class="btn btn-primary" name="action" value="addFolder" style="margin-top: 33px;">Сreate</button>
	</form>

	<form class="col-6" action="index.php?page=slider" method="POST" enctype="multipart/form-data">
	<label for="folders"  style="width: 180px">Сreate image in slider:</label><br>		
		<select name="foldersI" style="width: 180px">
			<option disabled>Specify a slider for images</option><br>    
			<?php
				$string = glob('images/*', GLOB_ONLYDIR);
				foreach ($string as $value ): ?>
					<option value="<?= $value ?>"> <?= $value ?> </option>
			<?php endforeach ?>
		</select><br>
		<input type="hidden" name="MAX_FILE_SIZE" value="524288">
		<input type="file" name="file" style="margin-bottom: 10px; margin-top: 10px"><br>
		<button class="btn btn-primary" name="action" value="sliderImage" >Send</button>
	</form>

	<div style="margin-top: 70px;">
	<form class="col-6" action="index.php?page=slider" method="POST" enctype="multipart/form-data">
	<label for="folders" style="width: 180px">Delete slider:</label><br>		<select name="foldersD" style="width: 180px">
			<option disabled>Specify a slider</option>    
			<?php 
				$string = glob('images/*', GLOB_ONLYDIR);
				foreach ($string as $value ): ?>
					<option value="<?= $value ?>"> <?= $value ?> </option>
			<?php endforeach ?>
		</select><br>		
		<button class="btn btn-primary" name="action" value="sliderDelete" style="margin-top: 10px;">Delete</button>
	</form>
</div>
</div>

<?php 
	$string = glob('images/*', GLOB_ONLYDIR);
	foreach ($string as $value){
		$pice = explode('/', $value );
		$pic = 	$pice[1];		
		echo "<h1  class='text-center'>$pic</h1><div class='main'><div class='multiple-items'>";
    	$files = scandir($value);
		foreach ($files as $file) {
			if($file != '.' && $file!='..' && !is_dir('$value' . $file)){		
				if(strripos($file, '150x150') !== false) {// выводим маленькие картинки
					$bigFile = str_replace('150x150_', '', $file); // чтобы из маленькой получить большую - заменяем 150x150_ на пустоту
					echo "<a href='$value/$bigFile' data-fancybox='gallery'><img src='$value/$file'></a>";
				}				
			}		
		}				
		echo "</div>";
		echo "</div>";	
	}		
?>


