<?php
$src = imagecreatefrompng('public/images/LOGO RESMI IPNUIPPNU by diqies 2.png');
$w = imagesx($src);
$h = imagesy($src);
$half_w = (int)($w / 2);

// IPNU logo (left half)
$ipnu = imagecreatetruecolor($half_w, $h);
imagealphablending($ipnu, false);
imagesavealpha($ipnu, true);
$trans = imagecolorallocatealpha($ipnu, 0, 0, 0, 127);
imagefill($ipnu, 0, 0, $trans);
imagecopy($ipnu, $src, 0, 0, 0, 0, $half_w, $h);
imagepng($ipnu, 'public/images/ipnu-logo.png');

// IPPNU logo (right half)
$ippnu = imagecreatetruecolor($half_w, $h);
imagealphablending($ippnu, false);
imagesavealpha($ippnu, true);
imagefill($ippnu, 0, 0, $trans);
imagecopy($ippnu, $src, 0, 0, $half_w, 0, $half_w, $h);
imagepng($ippnu, 'public/images/ippnu-logo.png');

// Create square favicon with padding
$dim = max($w, $h);
$fav = imagecreatetruecolor($dim, $dim);
imagealphablending($fav, false);
imagesavealpha($fav, true);
imagefill($fav, 0, 0, $trans);
$dx = (int)(($dim - $w) / 2);
$dy = (int)(($dim - $h) / 2);
imagecopy($fav, $src, $dx, $dy, 0, 0, $w, $h);
imagepng($fav, 'public/favicon.png');

echo 'Done';
