<?php
//var_export($_SERVER['argv']);
//exit;
if (empty($_SERVER['argv'][0])) {
    if (empty($_GET['count'])) {
	$string = "NoN";
    } else {
	$string = $_GET['count'];
    }
} else {
    $string = $_SERVER['argv'][0];
}

Header("Content-type: image/png"); 
if ( file_exists('button.png') ) {
    $im = ImageCreateFromPng("button.png");
} else {
    $im = ImageCreate(64, 18);
    $black = ImageColorAllocate($im, 0, 0, 0);
}
$orange = ImageColorAllocate($im, 220, 210, 60);
$px = (ImageSX($im)-7.5*strlen($string))/2;
ImageString($im,3,$px,2,$string,$orange);
ImagePng($im);
ImageDestroy($im);
?>
