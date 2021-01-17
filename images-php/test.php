<?php

header('Content-Tape: image/jpeg');
$w = $_GET['w'] ?? 100;
$h = $_GET['h'] ?? 100;

$image = imagecreatetruecolor($w, $h);
imagefill($image, 0, 0, 0xB69CDC);

imageellipse($image, 50, 50, 80, 80, 0xffffff);
imagefilledellipse($image, 40, 40, 20, 20, 0xffffff);
imagefilledellipse($image, 60, 40, 20, 20, 0xffffff);
imagearc($image, 50, 50, 60, 60, 65, 180, 0xFD2796);

imagejpeg($image);

