<?php
session_start();
include_once '../commoninclude.php';
$objLogin=new MySQLConnection();
$objLogin->Open();
$updateMemberOnlineStatus="Update tblMemberRegistration Set OnlineStatus='F' Where ID=".$_SESSION['adminid'];
$objLogin->UpdateQuery($updateMemberOnlineStatus);
$objLogin->Close();
session_unset();
session_destroy();
header("location:login.php");
?>
