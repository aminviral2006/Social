<?php
session_start();
include_once '../commoninclude.php';

$stuffid=$_REQUEST['stuffid'];
//$CategoryID = substr( $_REQUEST['category'], 0, -1 );
$MemberID=$_SESSION['memberid'];

$objBoStuff = new BoStuff();
$objBoStuff->setMemberId($MemberID);

$objBoStuff->setId($stuffid);

$Likes = "";
$DontLikes = "";

$objPlPeopleLike=new PlPeopleLike();
$str=$_REQUEST['category'];

//$str=substr($str, 0, strlen($str)-1);
//echo "str:".$str;
$arr=explode(",", $str);

if (isset($_REQUEST['q']) && $_REQUEST['q'] == "L")
{
    for($i=0; $i<count($arr); $i++)
    {
        if(!$arr[$i]=="")
        {
            $objBoStuff->setCategoryId($arr[$i]);
            $Likes=$objPlPeopleLike->AddPeopleLike($objBoStuff);
        }
    }
}
else if (isset($_REQUEST['q']) && $_REQUEST['q'] == "D")
{
    $objBoStuff->setCategoryId($_REQUEST['category']);
    $DontLikesVotes=$objPlPeopleLike->AddPeopleDontLike($objBoStuff);
}

$Likes = $objPlPeopleLike->ShowPeopleLike($objBoStuff);
//echo $Likes . "<br> <font size='3'>People</font> bested this!";
echo "<b>".$Likes."</b><br><img src='../images/peoplelikes.png' alt=''/>";
$DontLikes = $objPlPeopleLike->ShowPeopleDontLike($objBoStuff);
if ($DontLikes > 0)
{
    //echo "<hr>".$DontLikes . "<br> People are crucious.";
    echo "<hr><b>".$DontLikes."</b><br> <img src='../images/peoplecurious.png' alt=''/>";
}
?>
