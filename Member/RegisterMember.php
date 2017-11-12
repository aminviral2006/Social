<?php

include_once 'Classes/MySQLConnection.php';

$objMember = new MySQLConnection();
$objMember->Open();

$nickname = $_REQUEST['txtnickname'];
$email = $_REQUEST['txtemail'];
$password = $_REQUEST['txtpassword'];
$captchacode = $_REQUEST['txtCaptcha'];

$searchNickname = "Select Nickname From tblMemberRegistration Where Nickname='" . $nickname . "'";
$searchResult=$objMember->SelectQuery($searchNickname);
$recordFound = $objMember->RowsCount($searchResult);

if ($recordFound == 0)
{
    $insertQuery = "Insert Into tblMemberRegistration ";
    $insertQuery.="(ID,NickName,EmailID,UserPassword,CaptchaCode,CreatedDate,MemberStatus,OnlineStatus,MemberType) ";
    $insertQuery.="Values ";
    $insertQuery.="(NULL,'" . $nickname . "','" . $email . "','" . md5($password) . "','" . $captchacode . "','" . Date("Y-m-d") . "',";
    $insertQuery.="'A','O','U')";
    
    if($objMember->InsertQuery($insertQuery)==true)
    {
        header("location:EditMemberProfile.php?login=success");
    }    
}
?>
