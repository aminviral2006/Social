<?php
session_start();
if (!isset($_SESSION['member']))
    header("location:login.php");
include_once '../commoninclude.php';

$objBoPrivatemsg= new BoPrivateMessage();
$objBoPrivatemsg->setMemberID($_SESSION['memberid']);
$objBoPrivatemsg->setFriendName($_REQUEST['keyword']);
$objBoPrivatemsg->setMessage($_REQUEST['txtmessage']);

$objPlStuff= new PlPrivateMessage();
$msg=$objPlStuff->PlAddPrivateMessage($objBoPrivatemsg);
//echo $msg;
if(isset($_REQUEST['txtmessage']))
    header("location:Profile.php?profileid=".$_SESSION['memberid']."&member=".$_SESSION['member']."&msg=".$msg);
else
    header("location:PrivateMessage.php?postmessage=Your Message Posted Successfully");

?>
