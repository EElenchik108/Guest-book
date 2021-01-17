<?php

header('Content-Tape: image/jpeg');
$r = $_GET['r'] ?? 438;
$g = $_GET['g'] ?? 438;
$b = $_GET['b'] ?? 438;

$red = (100-$r)*4.27;
$green = (100-$g)*4.27;
$blue = (100-$b)*4.27;
$image = imagecreatetruecolor(380, 440);
imagefill($image, 0, 0, 0xEBE7E7);

for($i = 0; $i < 11; $i++){
	$letter = 10*$i.'%';
	imageline ($image, 70, 7 + $i*42, 331, 7 + $i*42, 0xB4ADAD);
	imagestring($image, 7, 15 , 420 - $i*42, $letter, 0x797575);
}

imagefilledrectangle($image, 90, $red, 130, 427, 0xEC1A1A);

imagefilledrectangle($image, 180, $green, 220, 427, 0x359A33);

imagefilledrectangle($image, 270, $blue, 310, 427, 0x3B22F6);

imagejpeg($image);