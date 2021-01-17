<h1>Upload</h1>
<div class="container">
	<form class="col-6 m-auto" action="index.php" method="POST" enctype="multipart/form-data">
		<?php showMessage() ?>
		<input type="hidden" name="MAX_FILE_SIZE" value="524288">
		<input type="file" name="file">
		<button class="btn btn-primary" name="action" value="uploadImage">Send</button>
	</form>
	<?php 

		//1. Способ вывода изображений на этой странице
		
		//$f = opendir('images');
		//while ($file = readdir($f)) {
			//if($file != '.' && $file!='..' && !is_dir('images/' . $file)){
			/*echo $file . '<br>';*/
			//echo "<img src='images/{$file}'>";
			//}
		//}
		//closedir($f);
		
		//2. Способ
		
		/*$files = scandir('images');
		foreach ($files as $file) {
			if($file != '.' && $file!='..' && !is_dir('images/' . $file)){			
			echo "<img src='images/{$file}'>";
			}
		}*/

		//3. Способ
		
		/*$files = glob('images/* . {jpg, png, gif, jpeg, JPEG, PNG, GIF}', GLOB_BRACE); 
		//GLOB_ONLYDIR
		dump($files);*/
		/*
		if(!file_exists('test')){
			mkdir('test');
		}*/	


	?>

</div>
	
<?php 
	if(issetSession('image') ): ?>
		<img src="<?= issetSession ('image') ?>" alt="" id="big_img">
		<form action="index.php" method="POST">
			<input type="hidden" name="x" id="x">
			<input type="hidden" name="y" id="y">
			<input type="hidden" name="w" id="w">
			<input type="hidden" name="h" id="h">
			<input type="hidden" name="image" id="image" value="<?= issetSession('image') ?>">
			<button class="btn btn-primary" value="jCropImage" name="action">Crop</button>
		</form>
<?php 
	removeSession('image');
	endif 
?>