<?php
session_start();
if (!isset($_SESSION['member']))
    header("location:login.php");
include_once '../commoninclude.php';
include_once 'SendMailOnCommentWritten.php';

$receiverid="";
$membername="";

if(isset($_REQUEST['id']))
{
    $receiverid=$_REQUEST['id'];
    $membername=$_REQUEST['member'];
}
else
{
    $receiverid=$_SESSION['memberid'];
    $membername=$_SESSION['member'];
}

$objBoMemberComment = new BoMemberComment();
$objBoMemberComment->setMemberID($_SESSION['memberid']); // Replace it with $_Request['friendid']
$objBoMemberComment->setFriendID($receiverid); //Replace it with $_SESSION['memberid']
$objBoMemberComment->setComment($_REQUEST['txtPrivateComment']);


$objPlMemberComment = new PlMemberComment();
$msg = $objPlMemberComment->PlAddMemberComment($objBoMemberComment);

$objBoMemberDetails=new BoMemberRegistration();
$objBoMemberDetails->setId($receiverid);

$objPlMemberDetails=new PlMemberRegistration();
$record=$objPlMemberDetails->PlGetMemberDetails($objBoMemberDetails);

$to=$record[0]['EmailID'];
$message="
    <b>One of your friend, ".$_SESSION['member']." has commented on your profile</b>
    You can visit his profile by following link
    <a href='".SITE_URL."/Member/Profile.php?id=".$_SESSION['memberid']."&member=".$_SESSION['member']."'>
        ".SITE_URL."/Member/Profile.php?id=".$_SESSION['memberid']."&member=".$_SESSION['member']."</a>";
$subject=$_SESSION['member']." has commented on your profile.";

if(isset($msg))
{
    $mailflag=SendMailToMember($_SESSION['member'], $to, $message,$subject);
    header("location:Comments.php?id=".$receiverid."&member=".$membername);
}
?>
