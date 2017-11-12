<?php
session_start();
include_once '../commoninclude.php';
$stuffid=$_REQUEST['stuffid']; //replace with $_SESSION['stuffid']
if(!isset($_SESSION['memberid']))
    echo "login";
else if (isset($_REQUEST['q']))
    {
        $objBo=new BoStuff();
        $objBo->setId($stuffid);
        $objBo->setMemberId($_SESSION['memberid']);
        $objBo->setCategoryTitle($_REQUEST['q']);
        $categorytitle=$_REQUEST['q'];
        $objPlStuff=new PlStuff();
        $objBo->setCategoryTitle($categorytitle);
        

        $objPlStuff=new PlStuff();
        $CategoryID=$objPlStuff->PlAddCategory($objBo, $categorytitle);
        $objBo->setCategoryId($CategoryID);
        $objPlPeopleLike=new PlPeopleLike();
        $AddPeopleLike=$objPlPeopleLike->AddPeopleLike($objBo);
        echo "Success";
    }
?>