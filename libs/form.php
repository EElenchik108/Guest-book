<?php
	$action = $_POST['action'] ?? null;
	if($action) {
		$action();
	}

function sendMail(){	
	$email = $_POST['email'] ?? null;
	$message  = $_POST['message'] ?? null;
	$errors = [];
	if(!$email){
		$errors['email'] = 'Email is requered!';	
	};
	if(!$message){
		$errors['message'] = 'Message is requered!';
	};
	if($errors){
		setMessage($errors, 'danger');
	}
	else {
		mail('AAAA', 'DDDD', 'CCCCCC');
		setMessage('Thank!', 'success');
	}		
	redirect('contacts');
	//header('Location: index.php?page=contacts'); - функция обновляет страницу 
	// exit; или die;
}

function redirect ($page) {
	header('Location: index.php?page=' . $page);
	exit;
}

function sendRegistration(){
	$useremail = $_POST['useremail'] ?? null;
	$passwordUser = $_POST['passwordUser'] ?? null;
	$passwordReplay = $_POST['passwordReplay'] ?? null;
	$errors = [];
	if(!$useremail){
		$errors['useremail'] = 'Email is not entered!';		
	}
	if ($useremail&&!preg_match("/[0-9a-z]+@[a-z]/",$useremail)) {
		$errors['emailUser1'] = 'Email entered incorrectly!';      
	}
	if(!$passwordUser){
		$errors['passwordUser'] = 'Password is not entered!';
	}
	if($passwordUser&&!preg_match("/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/",$passwordUser)){
		$errors['passwordUser'] = 'Password entered incorrectly!';
	}
	if(!$passwordReplay){
		$errors['passwordReplay'] = 'Replay password is not entered!';
	}
	if($passwordReplay&&!preg_match("/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/",$passwordReplay)){
		$errors['passwordReplay'] = 'Replay password entered incorrectly!';
	}
	if($passwordReplay!==$passwordUser){
		$errors['passwordReplay'] = 'Passwords are not the same!';
	}

	if($errors){
		setMessage($errors, 'danger');
	}
	
	else {
		setSession('user', $useremail);	
		setMessage('Thank!', 'success');		

		$line = $useremail . '|' . $passwordUser . "\r\n";
		$files = fopen('user.txt', 'a+');
		fwrite($files, $line); 
		fclose($files);

		header('Location: index.php?page=home');
		redirect('home');		

	}
	redirect('registration');
}

function sendEntrance(){
	$emailUser = $_POST['emailUser'] ?? null;
	$password  = $_POST['password'] ?? null;	
	$errors = [];
	if(!$emailUser){
		$errors['emailUser'] = 'Email is not entered!';
	}
	if ($emailUser&&!preg_match("/[0-9a-z]+@[a-z]/",$emailUser)) {
		$errors['emailUser'] = 'Email entered incorrectly!';       
	}
	if(!$password){
		$errors['password'] = 'Password is not entered!';
	}
	if($password&&!preg_match("/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/",$password)){
		$errors['password'] = 'Password entered incorrectly!';
	}
	if($errors){
		setMessage($errors, 'danger');
	}	
	else if (file_exists('user.txt')){			 
		$string = file('user.txt');
		for ($i = 0; $i < count($string); $i++) {
			list($name, $pass) = explode('|', $string[$i]);
			if(trim($name) == $emailUser && trim($pass) == $password) {
	        		setSession('user', $emailUser);
	        		redirect('home');
	        	}
	        	else { 
	        		$errors['emailUser'] = 'A user with such a password does not exist!';
	        		setMessage($errors, 'danger');
	        	}
	    }
	}	
	redirect('entrance');
}

function output(){
	removeSession('user');
	redirect('home');
}

function sendBook () {	
	$name = $_POST['name'] ?? null;
	$message = $_POST['message'] ?? null;
	if(!$name || !$message){
		setMessage('All fields requered', 'danger');
		redirect('guest-book');
	}
	$str = $name . '|' . $message . '|' . time() . "\r\n";
	$file = fopen('guest.txt', 'a+');
	fwrite($file, $str); 
	fclose($file);
	redirect('guest-book');
}

function showGuestBook(){	
	if (file_exists('guest.txt')){
		$lines = array_reverse(file('guest.txt'));
		$p = $_GET['p'] ?? 0;		
		$totalPages = ceil(count($lines) / 3);
		$p = $p > $totalPages ? 0 : $p;

		for ($i = $p * 3; $i < $p * 3 + 3 && $i < count($lines); $i++) {
			list($name, $message, $time) = explode('|', $lines[$i]);			
			echo "<div class='my-2 border'>{$message}<br> $name, ". date('d. m. Y H:i', trim($time)) ." </div>";
		}
				echo '<ul class="pagination">';
		for($i = 0; $i < $totalPages; $i++){
			echo "<li class='page-item  " . ($p==$i ? 'active' : '') ." '><a href='index.php?page=guest-book&p={$i}'  class='page-link'>".($i+1)."</a></li>";
		}
		echo '</ul>';
	}
}


function dump($arr) {
	echo '<pre>' . print_r($arr, true) . '</pre>'; 
}

function uploadImage() {
	$file = $_FILES['file'] ?? null;
	$fName = saveImage($file, 'images');
	if($fName){
		setSession('image', 'images/'. $fName);
		cropImage($fName, 'images', 150, true); //true - квадратное изображение (жесткая обрезка)
		cropImage($fName, 'images', 300); // false - пропорциональное изменение размера*/
		setMessage('File uploaded!', 'success');
	}
	redirect('upload');
}

function cropImage($fName, $dir, $width, $crop = false){ // $crop = false - параметр по умолчанию (в дальнейшем можно не указывать)
	$create_f = getFunction('imagecreatefrom', $fName); 
	$save_f = getFunction('image', $fName);
	$src = $create_f( $dir . '/' . $fName );
	$w_src = imagesx($src);
	$h_src = imagesy($src);
	if ($crop) {
		$dest = imagecreatetruecolor($width, $width);
		if($w_src>$h_src) {
			imagecopyresized($dest, $src, 0, 0, ($w_src - $h_src)/2, 0, $width, $width, $h_src, $h_src);			
		}
		else {
			imagecopyresized($dest, $src, 0, 0, 0, ($h_src - $w_src)/2, $width, $width, $w_src, $w_src);
		}
		$save_f($dest, "{$dir}/{$width}x{$width}_{$fName}" );
	}
	else {
		$height = $width * $h_src / $w_src;
		$dest = imagecreatetruecolor($width, $height);
		imagecopyresized($dest, $src, 0, 0, 0, 0, $width, $height, $w_src, $h_src);
		$save_f($dest, "{$dir}/{$width}x{$height}_{$fName}" );
	}

}
function getFunction($begin, $fName) {
	$ext = strtolower( substr($fName, strrpos($fName, '.') +1) ); //strtolower()- прeобразует строку в нижний регистр, strrpos() - возвращает позицию искомого символа, поиск начинается с конца
	if($ext == 'jpg') {
		return $begin . 'jpeg';
	}
	return $begin . $ext;
}

function saveImage($file, $dir){
	if(!$file||$file['error'] == 4){
		setMessage('File is required', 'danger');
		return false;
	}
	if($file['error'] == 2 || $file['size'] > 1024 * 1024 * 1) {
		setMessage('Max file size < 1 MB!', 'danger');
		return false;
	}
	$arrType = [
		'image/jpeg',
		'image/gif',
		'image/png',
		'image/webp',
	];
	if(!in_array($file['type'], $arrType)){
		setMessage('Upload only image', 'danger');
		return false;
	}

	$fName = time() . '_' . $file['name'];

	move_uploaded_file($file['tmp_name'], $dir . '/'. $fName);
	return $fName;
}

function addFolder () {
	$folderName =  $_POST['folder'] ?? null;
	/*$errors = [];*/
	$folderName = trim($folderName);	
	if($folderName && !preg_match("/[a-zA-Z0-9]/", $folderName)) {
		setMessage('The name is entered incorrectly!', 'danger');		   
	}
	else {
		setMessage('A folder with this name exists!', 'danger');
	}
	if(!$folderName){
		setMessage('Folder name not entered!', 'danger');
	}		
	if(!file_exists("images/$folderName")) {
		mkdir("images/$folderName");
		setMessage('Folder created!', 'success');			
	}			
	redirect('slider');
}

function sliderImage() {
	$file = $_FILES['file'] ?? null;
	$fName = saveSliderImage($file);	
	if($fName){
		$folder = htmlentities($_POST['folder'] ?? null);
		setSession('imagesS', $folder. $fName);
		cropSlider($fName, 150);				
		setMessage('File uploaded!', 'success');
	}
	redirect('slider');
}

function cropSlider($fName, $width, $crop = false){ // $crop = false - параметр по умолчанию (в дальнейшем можно не указывать)
	$create_f = getFunction('imagecreatefrom', $fName); 
	$save_f = getFunction('image', $fName);	
	
	$folder = htmlentities($_POST['foldersI'] ?? null);	
	$src = $create_f( $folder . '/' . $fName );	
	$w_src = imagesx($src);	
	$h_src = imagesy($src);		
	
		$dest = imagecreatetruecolor($width, $width);
		if($w_src>$h_src) {
			imagecopyresized($dest, $src, 0, 0, ($w_src - $h_src)/2, 0, $width, $width, $h_src, $h_src);			
		}
		else {
			imagecopyresized($dest, $src, 0, 0, 0, ($h_src - $w_src)/2, $width, $width, $w_src, $w_src);
		}
		$save_f($dest, "$folder/{$width}x{$width}_$fName" );		
}

function saveSliderImage($file){
	$foldersI = htmlentities($_POST['foldersI'] ?? null);	
	$foldersI= trim($foldersI);	
	if(!$file||$file['error'] == 4){
		setMessage('File is required', 'danger');
		return false;
	}
	if($file['error'] == 2 || $file['size'] > 1024 * 1024 * 1) {
		setMessage('Max file size < 1 MB!', 'danger');
		return false;
	}
	$arrType = [
		'image/jpeg',
		'image/gif',
		'image/png',
		'image/webp',
		'image/JPEG',
		'image/GIF',
		'image/PNG',
		'image/WEBP',
	];
	if(!in_array($file['type'], $arrType)){
		setMessage('Upload only image', 'danger');
		return false;
	}

	$fName = time() . '_' . $file['name'];	

	move_uploaded_file($file['tmp_name'], $foldersI . '/' . $fName);
	/*move_uploaded_file($file['tmp_name'], 'images/' . $foldersI . '/' . $fName); - для сохранения и добавления папки через файл*/
	return $fName;
	redirect('slider');
}


function sliderDelete() {
	$string = glob('images/*', GLOB_ONLYDIR);
	if ($string){
	$foldersD = htmlentities($_POST['foldersD'] ?? null);
	deleteFolder($foldersD);
	setMessage('Slider successfully deleted!', 'success');
	}
	else {
		setMessage('Missing slider to delete!', 'danger');
	}
}

function deleteFolder($dir) {
	$includes = glob($dir.'/*');
	foreach ($includes as $include) {
		if(is_dir($include)) {
			recursiveRemoveDir($include);
		}
		else {
			unlink($include);
		}
	}
	rmdir($dir);
}

function jCropImage(){
	$x = $_POST['x'] ?? null;
	$y = $_POST['y'] ?? null;
	$w = $_POST['w'] ?? null;
	$h = $_POST['h'] ?? null;
	$image = $_POST['image'] ?? null;

	$create_f = getFunction('imagecreatefrom', $image); 
	$save_f = getFunction('image', $image);
	$src = $create_f( $image ); //- создаем изображение на основе указанного пути
	$dest = imagecreatetruecolor(50, 50);
	imagecopyresized($dest, $src, 0, 0 , $x, $y, 50, 50, $w, $h);
	$parts = explode('/', $image); 
	$parts[count($parts)-1] = '50x50_'. $parts[count($parts)-1];
	$save_f($dest, implode('/', $parts));;
}

function colorValue() {
	$colors = $_POST['colors'] ?? null;	
	if(!$colors){		 
		setMessage('Make your choice!', 'danger');
		redirect('poll');
	}	
	$string = $colors . "\r\n";
	$file = fopen('colors.txt', 'a+');
	fwrite($file, $string); 
	fclose($file);
	redirect('poll');
}

function showColor(){	
	if (file_exists('colors.txt')){
		$arreyColor = file('colors.txt');				
		$red = [];
		$green = [];
		$blue = [];
		$total = count($arreyColor);
		foreach ($arreyColor as $arreyColors) {
			if(strripos($arreyColors, 'red') !== false) {
				array_push($red, $arreyColors);
			}
			if(strripos($arreyColors, 'green') !== false) {
				array_push($green, $arreyColors);
			}
			else if(strripos($arreyColors, 'blue') !== false){
				array_push($blue, $arreyColors);
			}
		}
		$quantityRed = count($red);
		$quantityGreen = count($green);
		$quantityBlue = count($blue);		
		$percentRed = round (100*$quantityRed/$total, 1);
		$percentGreen =  round (100*$quantityGreen/$total, 1);
		$percentBlue =  round (100*$quantityBlue/$total, 1);
		echo "<div class='my-2 border'>
		<p>Red - <b style='color:#EC1A1A'>$percentRed"."%"."</b></p>
		<p>Green - <b style='color:#359A33'>$percentGreen"."%"."</b></p>
		<p>Blue - <b style='color:#3B22F6'>$percentBlue"."%"."</b></p>
		</div>";
		setSession('red', $percentRed); 
		setSession('green', $percentGreen);
		setSession('blue', $percentBlue);
	}
}

