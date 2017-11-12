<?php
session_start();
include_once '../commoninclude.php';
$objBo = new BoStuff();
$id = $_REQUEST['id'];
include_once '../FCKEditor/fckeditor.php';
$objPlStuff = new PlStuff();
$Description = $objPlStuff->PlLoadSelectedDescription($id);

$_SESSION['descriptionid']=$Description[0]['ID'];
$oFCKeditor = new FCKeditor('AddDescription');
if (isset($Description[0]['Description']))
    $oFCKeditor->Value = $Description[0]['Description'];
else
    $oFCKeditor->Value = "";
$oFCKeditor->Width = 650;
$oFCKeditor->Height = 200;
echo $oFCKeditor->CreateHtml();

?>
