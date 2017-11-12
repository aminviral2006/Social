<?php
session_start();
include_once '../commoninclude.php';
$objBo = new BoStuff();
$id = $_REQUEST['id'];
include_once '../FCKEditor/fckeditor.php';
$objPlStuff = new PlStuff();
$Description = $objPlStuff->PlLoadSelectedDescription($id);
//echo $Description[0]['Description'];

$oFCKeditor = new FCKeditor('txtAddDescription');
if (isset($Description[0]['Description']))
    $oFCKeditor->Value = $Description[0]['Description'];
else
    $oFCKeditor->Value = "";
$oFCKeditor->Width = 295;
$oFCKeditor->Height = 130;
echo $oFCKeditor->CreateHtml();
?>
