<?php
//$str="<img src='Captcha/CaptchaSecurityImages.php?width=100&height=40&characters=5' id='imgcaptcha' name='imgcaptcha' alt='Image not found'/>";
include 'CaptchaSecurityImages.php';
$width = isset($_REQUEST['width']) ? $_REQUEST['width'] : '120';
$height = isset($_REQUEST['height']) ? $_REQUEST['height'] : '40';
$characters = isset($_REQUEST['characters']) && $_REQUEST['characters'] > 1 ? $_REQUEST['characters'] : '6';
$captcha = new CaptchaSecurityImages($width,$height,$characters);

?>
