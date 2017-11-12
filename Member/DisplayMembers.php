<?php
include_once '../Classes/MySQLConnection.php';

$objMember = new MySQLConnection();
$objMember->Open();

$result=$objMember->SelectQuery("Select * From tblMemberRegistration");
$rows=$objMember->RecordSet($result);

?>
