<?php
if(!session_start()) //checking whether session_start() has been started or not?
    session_start();
include_once '../commoninclude.php';

//MYSQLCONNECTION object which establishes connection to MYSQL Database
$objLogin=new MySQLConnection();
if(isset($_POST))
{
    $objLogin->Open();
    $query="Select id,Nickname,OnlineStatus,MemberType From tblMemberRegistration Where ";
    $query.="((NickName='".$_REQUEST['txtusername']."' And UserPassword='".md5($_REQUEST['txtpassword'])."') Or";
    $query.="(EmailID='".$_REQUEST['txtusername']."' And UserPassword='".md5($_REQUEST['txtpassword'])."')) ";
    $query.=" And MemberStatus='A' And MemberType='A'";
    $result=$objLogin->SelectQuery($query);

    if($objLogin->RowsCount($result)>0)
    {
        $row=$objLogin->RecordSet($result);

        /*$updateQuery="Update tblMemberRegistration Set OnlineStatus='O' Where id=".$row[0]['id'];
        $objLogin->UpdateQuery($updateQuery);*/
        
        $_SESSION['memberid']=$row[0]['id'];
        $_SESSION['member']=$row[0]['Nickname'];
        $_SESSION['membertype']=$row[0]['MemberType'];
        $_SESSION['onlinestatus']=$row[0]['OnlineStatus'];
        header("location:index.php?login=success");
    }
    else
        header("location:Login.php?login=You are not authorized to view this page.");
}
?>