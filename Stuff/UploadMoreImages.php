<?php
session_start();
/*Upload more images*/
include_once '../commoninclude.php';
if(isset($_REQUEST['submituploadimage']))
{
    $objUploadMoreImage=new PlStuff();
    $objUploadMoreImage->PlUploadMoreImages();
    header("location:StuffDetail.php?stuffid=".$_REQUEST['uploadstuffid']);
}
/*ends here*/
?>
