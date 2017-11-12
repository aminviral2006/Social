<?php
session_start();
if (!isset($_SESSION['member']))
    header("location:login.php");
include_once '../commoninclude.php';
include_once 'SendMailOnCommentWritten.php';

$objBoFriend = new BoAddFriends();
$objBoFriend->setMemberId($_SESSION['memberid']);
//$objBoFriend->setFriendId($memberdetail[0]['id']);
$objBoFriend->setFriendId($_REQUEST['friendid']);
$objBoFriend->setCreatedDate(Date('Y-m-d'));

$objPlFriend = new PlAddFriends();
$msg = $objPlFriend->PlAddToFriendsList($objBoFriend);

//Sending Mail to Requested Friend
$objBoMemberDetails=new BoMemberRegistration();
$objBoMemberDetails->setId($_REQUEST['friendid']);

$objPlMemberDetails=new PlMemberRegistration();
$record=$objPlMemberDetails->PlGetMemberDetails($objBoMemberDetails);

$to=$record[0]['EmailID'];
$message="
    <b>One of your friend, ".$_SESSION['member']." has made a friend request.</b>
    You can visit his profile by following link
    <a href='".SITE_URL."/Member/Profile.php?id=".$_SESSION['memberid']."&member=".$_SESSION['member']."'>
        ".SITE_URL."/Member/Profile.php?id=".$_SESSION['memberid']."&member=".$_SESSION['member']."</a>";
//Ends here
$subject=$_SESSION['member']." has made Friend Request.";

$mailflag=SendMailToMember($_SESSION['member'], $to, $message,$subject);

if($msg=="success")
    echo "<img src='../images/PendingFriendRequest.jpg' />";
else
    echo "<input type='button' id='btnaddtofriends' name='btnaddtofriends' value='Add to Friend' onclick='AddToFriendsList()'/>";
?>
