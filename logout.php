<?php
session_start();
include_once 'commoninclude.php';
$objLogin=new MySQLConnection();
$objLogin->Open();
$updateMemberOnlineStatus="Update tblLoginInfo Set LoginStatus='F' Where MemberID=".$_SESSION['memberid'];
$objLogin->UpdateQuery($updateMemberOnlineStatus);

//Query to logged out Members who are not active since 10 minutes
$updateTimeStamp="Update tblLoginInfo Set LoginStatus='F' Where (".time()."-LoginTimeStamp) > 600";
$objLogin->UpdateQuery($updateTimeStamp);

$objLogin->Close();
session_unset();
session_destroy();
header("location:index.php");
?>
