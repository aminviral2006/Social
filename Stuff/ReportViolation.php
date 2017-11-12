<?php
session_start();
include_once '../commoninclude.php';

$msg="";
$objPlStuff=new PlStuff();

$result=$objPlStuff->PlReportViolation($_REQUEST['stuffid'], $_REQUEST['memberid'], $_REQUEST['reportdescription']);
$msg="Report has been violated successfully.";
header("location:stuffdetail.php?stuffid=".$_REQUEST['stuffid']."&msg=".$msg);

?>
