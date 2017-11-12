<?php

	// *** Include the class
	include("resize-class.php");

	// *** 1) Initialise / load image
	$resizeObj = new resize('17.jpg');

	// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
	$resizeObj -> resizeImage(30, 60, 'crop');

	// *** 3) Save image
	$resizeObj -> saveImage('17_3060-resized.jpg', 100);

?>
