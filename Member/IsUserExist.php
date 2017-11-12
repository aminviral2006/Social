<?php
//include_once '../Classes/MySQLConnection.php';
include_once '../commoninclude.php';

if(isset($_REQUEST['nickname']) && $_REQUEST['nickname']!="")
{
    $objBoMember=new BoMemberRegistration();
    $objBoMember->setNickname($_REQUEST['nickname']);

    $objPlMember=new PlMemberRegistration();
    $msg=$objPlMember->PlIsNicknameExist($objBoMember);
    echo $msg;
}
else if (isset($_REQUEST['email']) && $_REQUEST['email']!="")
{
    $objBoMember=new BoMemberRegistration();
    $objBoMember->setEmailId($_REQUEST['email']);

    $objPlMember=new PlMemberRegistration();
    $msg=$objPlMember->PlIsEmailExist($objBoMember);
    echo $msg;
}
?>
