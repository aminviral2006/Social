<?php
session_start();
if(!isset($_SESSION['member']))
    header("location:../Member/Login.php");
include_once '../commoninclude.php';

$objBoStuff=new BoStuff();
$objBoStuff->setMemberId($_SESSION['memberid']);
$objBoStuff->setTitle($_SESSION['stuffName']);

$objBoStuff->setTagId($_REQUEST['slttags']);
$objBoStuff->setStatus("A");
$objBoStuff->setHomePageStatus("N");
$objBoStuff->setDescription($_REQUEST['txtdescribe']);
if(isset($_REQUEST['keyword']))
{    
    $category=explode("," , $_REQUEST['keyword']);
    $categoryid=explode(",", $_REQUEST['categoryid']);

    $objBoStuff->setCategoryTitle($category[0]);
    $objPlStuff=new PlStuff();
    $stuffid=$objPlStuff->PlAddStuff($objBoStuff);

    for($i=1;$i<count($category);$i++)
    {
        $memberid=$_SESSION['memberid'];
        $Cat=$objPlStuff->PlAddCategory($objBo, $category[$i]);
        $msg=$objPlStuff->PlAddToPeopleLike($stuffid, $memberid, $categoryid[$i]);
    }
    header("location:StuffDetail.php?stuffid=".$stuffid);
}
else
{
    $objBoStuff->setCategoryTitle($_REQUEST['keyword']);
    $objPlStuff=new PlStuff();
    $stuffid=$objPlStuff->PlAddStuff($objBoStuff);
    header("location:StuffDetail.php?stuffid=".$stuffid);
}
?>