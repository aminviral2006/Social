<?php
session_start();
/*if(isset($_SESSION['member']))
    header("location:../index.php");
else if(!isset($_SESSION['member']))
    header("location:login.php");
*/
include_once '../commoninclude.php';

//For Getting Client's IP Address
function getIP()
{
    $ip="";
    if (getenv("HTTP_CLIENT_IP"))
        $ip = getenv("HTTP_CLIENT_IP");
    else if(getenv("HTTP_X_FORWARDED_FOR"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if(getenv("REMOTE_ADDR"))
        $ip = getenv("REMOTE_ADDR");
    else
        $ip = "UNKNOWN";
    return $ip;
}

$objLogin=new MySQLConnection();
if(isset($_POST))
{
    $objLogin->Open();
    $query="Select id,nickname,onlinestatus,membertype From tblMemberRegistration Where ";
    $query.="((NickName='".$_REQUEST['txtusername']."' And UserPassword='".md5($_REQUEST['txtpassword'])."') Or";
    $query.="(EmailID='".$_REQUEST['txtusername']."' And UserPassword='".md5($_REQUEST['txtpassword'])."')) ";
    $query.=" And MemberStatus='A'";
    $result=$objLogin->SelectQuery($query);

    if(mysql_num_rows($result)>0)
    {
        $row=mysql_fetch_assoc($result);
        
        $_SESSION['memberid']=$row['id'];
        $_SESSION['member']=$row['nickname'];
        $_SESSION['membertype']=$row['membertype'];
        $_SESSION['onlinestatus']=$row['onlinestatus'];        

        //$updateMemberOnlineStatus="Update tblMemberRegistration Set OnlineStatus='O' Where ID=".$row['id'];
        //$objLogin->UpdateQuery($updateMemberOnlineStatus);
        $insertToLoginInfo="Insert Into tblLoginInfo (MemberID,LoginTime,LoginStatus,IPAddress,LoginTimeStamp)
                            Values (".$_SESSION['memberid'].",NOW(),'O','".$_SERVER['REMOTE_ADDR']."',".time().")";
        $objLogin->InsertQuery($insertToLoginInfo);

        $updateTimeStamp="Update tblLoginInfo Set LoginStatus='F' Where (".time()."-LoginTimeStamp) > 600";
        $objLogin->UpdateQuery($updateTimeStamp);
	header("location:../index.php");
    }
    else
	header("location:Login.php?login=failed");
}
?>