<?php
session_start();
if (!isset($_SESSION['member']))
    header("location:login.php");
include_once '../commoninclude.php';

$objBo=new BoPrivateMessage();
$objBo->setFriendID($_SESSION['memberid']);
$objBo->setMemberID($_SESSION['memberid']);

$objPlPrivateMessage=new PlPrivateMessage();
if(isset($_REQUEST['Sent']))
{
        header("location:PrivateMessage.php?profileid=".$_REQUEST['profileid']."&Inbox=Sent");
}
else
{
        header("location:PrivateMessage.php?profileid=".$_REQUEST['profileid']."&Inbox=Inbox");
}
?>