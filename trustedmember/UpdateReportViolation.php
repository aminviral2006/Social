<?php
if(!isset ($_SESSION)) //checking whether $_SESSION has been started or not?
    session_start();
ob_start(); //Buffering the data
include_once '../commoninclude.php';

if(isset($_REQUEST['checkstuff']))
{
    $objPlStuff=new PlStuff();
    $idArray=$_REQUEST['checkstuff'];
    for($i=0;$i<count($_REQUEST['checkstuff']);$i++)
    {
        if($_REQUEST['handled'])
            $msg=$objPlStuff->PlUpdateReportViolationStatus($_SESSION['memberid'], $idArray[$i],'N');
        else
            $msg=$objPlStuff->PlUpdateReportViolationStatus($_SESSION['memberid'], $idArray[$i],'Y');
    }
    header("location:DisplayReportViolation.php?page=1&ipp=".$_SESSION['TotalRecordsOnAdminStuffPage']."&msg=".$msg);
}
else
{
    $msg="Please select stuff.";
    header("location:DisplayReportViolation.php?page=1&ipp=".$_SESSION['TotalRecordsOnAdminStuffPage']."&msg=".$msg);
}
?>