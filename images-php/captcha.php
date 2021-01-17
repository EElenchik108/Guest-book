<?php

header('Content-Tape: image/jpeg');
$w = $_GET['w'] ?? 200;
$h = $_GET['h'] ?? 50;

$image = imagecreatetruecolor($w, $h);
imagefill($image, 0, 0, 0xB69CDC);

for($i = 0; $i < 1000; $i++){
	imagesetpixel($image, rand(0, $w), rand(0, $h), 0x7777777);
}

$letters = 'qwertyuioplkjhgfdsazxcvbnm1234567890';
$font = __DIR__ . '/HARNGTON.TTF';

for($i = 0; $i < 4; $i++){
	$letter = $letters[ rand(0, strlen($letters)-1) ];
	imagettftext($image, 20, rand(-5, 5), 48 + $i * 30, 32, 0x000000, $font, $letter);
}

imagejpeg($image);