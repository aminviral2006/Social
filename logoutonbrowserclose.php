<?php
session_start();
include_once 'commoninclude.php';
$objLogin=new MySQLConnection();
$objLogin->Open();
$updateMemberOnlineStatus="Update tblMemberRegistration Set OnlineStatus='F' Where ID=".$_REQUEST['memberid'];
$objLogin->UpdateQuery($updateMemberOnlineStatus);
$objLogin->Close();
echo $updateMemberOnlineStatus;
session_unset();
session_destroy();
?>
