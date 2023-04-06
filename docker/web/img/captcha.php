<?php
session_start();
header("Content-type: image/png");

$mot = substr(strtoupper(sha1(time())), 0, 7);
$_SESSION['captcha'] = $mot;
$largeur = 11 * 7 - 10;
$hauteur = 25;
$img = imagecreate($largeur, $hauteur);
$blanc = imagecolorallocate($img, 240, 227, 192);
$noir = imagecolorallocate($img, 0, 0, 0);
$milieuHauteur = ($hauteur / 2) - 7;
imagestring($img, 6, strlen($mot) /2 , $milieuHauteur, $mot, $noir);
imagepng($img);
imagedestroy($img);
?>