<?php
session_start();
include_once '../commoninclude.php';

$objPlStuff=new PlStuff();
if($_REQUEST['sensor']=="description")
{
    $result=$objPlStuff->PlHideDescription($_REQUEST['descriptionid'], "H");
    header("location:stuffdetail.php?stuffid=".$_REQUEST['stuffid']);
}
else if($_REQUEST['sensor']=="comment")
{
    $result=$objPlStuff->PlHideComment($_REQUEST['commentid'], "H");
    header("location:stuffdetail.php?stuffid=".$_REQUEST['stuffid']);
}
?>
