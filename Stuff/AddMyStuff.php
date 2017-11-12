<?php
session_start();
if(!isset($_SESSION['member']))
    header("location:../Member/Login.php");
include_once '../commoninclude.php';

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600))
{
    // last request was more than 30 minates ago
    session_destroy();   // destroy session data in storage
    session_unset();     // unset $_SESSION variable for the runtime
    header("location:../logout.php");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

//$_SESSION['category'] = $_REQUEST['chkcategory'];
//print_r($category);die();
if(isset($_REQUEST['txtStuffname']))
{
    $objBoStuff=new BoStuff();
    $objBoStuff->setTitle($_REQUEST['txtStuffname']);
   
    $objPlStuff=new PlStuff();
    $msg=$objPlStuff->PlIsStuffExist($objBoStuff);

    $arrstuff=explode("-", $msg);

    if($arrstuff[0]=="exist")
        header("location:StuffDetail.php?stuffid=".$arrstuff[1]);
    else //if($arrstuff[0]=="Category Exist")
        //header("location:../Category/CategoryList.php");
    //selse
        if(isset($_REQUEST['chkcategorybetter']))
        {
            $category=implode("-", $_REQUEST['chkcategorybetter']);
            header("location:AddMultipleCategory.php?stuffname=".$_REQUEST['txtStuffname']."&category=".$category);
        }
        else
        {
            header("location:AddCategory.php?stuffname=".$_REQUEST['txtStuffname']);
        }
}
?>