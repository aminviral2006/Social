<?php
session_start();
if (!isset($_SESSION['member']))
    header("location:login.php");
include_once '../commoninclude.php';

$objBo=new BoPrivateMessage();
$objBo->setID($_REQUEST['pmid']);

$objPlPrivateMessage=new PlPrivateMessage();
$msg=$objPlPrivateMessage->PlDeletePrivateMessage($objBo);
if($msg==true)
    $msg="Record(s) has been deleted successfully.";
else
    $msg="Record has not been deleted successfully.";
if(isset($_REQUEST['Sent']))
{
        header("location:PrivateMessage.php?profileid=".$_REQUEST['profileid']."&Inbox=Sent&msg=".$msg);
}
else
{
        header("location:PrivateMessage.php?profileid=".$_REQUEST['profileid']."&Inbox=Inbox&msg=".$msg);
}
?>