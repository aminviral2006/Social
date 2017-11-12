<?php
session_start();
include_once '../commoninclude.php';
$stuffid = $_REQUEST['stuffid'];
$objBo=new BoStuff();
$objBo->setId($stuffid);

$comment=$_REQUEST['txtAddComment'];

if(!isset($_SESSION['memberid']))
    echo "login";
else if(isset($_REQUEST['txtAddComment']))
{
    $objPlStuff=new PlStuff();
    $AddComment=$objPlStuff->PlAddComment($objBo, $comment);
    $objBo->setMemberId($_SESSION['memberid']);
    $record=$objPlStuff->PlGetCommentsDetail($objBo);
    $output="";
    $output="<table align='right'>";
    for($i=0;$i<count($record);$i++)
    {
        $output.="<tr>";
        $output.="<td><img src='../Member/MemberImages/" . $record[$i]['ProfileImagePath'] . "' width='50px' height='50px'/></td>";
        $output.="<td><u>" . $record[$i]['NickName']."</u> <br>".$record[$i]['Comment'] . "</td>";
        $output.="</tr>";
    }
$output.="</table>";
echo $output;
}
header("location:StuffDetail.php?stuffid=".$stuffid);
?>
