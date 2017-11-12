<?php
session_start();
if(!isset($_SESSION['member']))
    header("location:member/login.php");
else
{
    
    include_once 'commoninclude.php';

    $mcs=explode("-", $_REQUEST['whatdoyouthink']);

    $MemberID=$_SESSION['memberid'];

    $objBoStuff = new BoStuff();
    $objBoStuff->setMemberId($MemberID);

    $objBoStuff->setId($mcs[2]);

    $objPlPeopleLike=new PlPeopleLike();

    if (isset($_REQUEST['btnyes']))
    {
        
        $objBoStuff->setCategoryId($mcs[1]);
        $objPlPeopleLike->AddPeopleLike($objBoStuff);
    }
    else if (isset($_REQUEST['btnno']))
    {
        $objBoStuff->setCategoryId($mcs[1]);
        $objPlPeopleLike->AddPeopleDontLike($objBoStuff);
    }
    /*
    $Likes = $objPlPeopleLike->ShowPeopleLike($objBoStuff);
    echo $Likes . "<br> <font size='4'>People</font> bested this!";

    $DontLikes = $objPlPeopleLike->ShowPeopleDontLike($objBoStuff);
    if ($DontLikes > 0)
    {
        echo "<hr>".$DontLikes . "<br> People are crucious.";
    }*/
    header("location:Stuff/StuffDetail.php?stuffid=".$mcs[2]);
}
?>
