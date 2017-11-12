<?php
session_start();
//Stuff Added Message
if(!isset($_REQUEST['stuffid']))
    header("location:../index.php");
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600))
{
    // last request was more than 30 minates ago
    //session_destroy();   // destroy session data in storage
    //session_unset();     // unset $_SESSION variable for the runtime
    //header("location:../logout.php");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
$message = "";
if (isset($_REQUEST['msg']))
{
    $msg = $_REQUEST['msg'];
    $message = "<span style='font-size: 1px;'>&nbsp;</span>";
    $message.="<div id='dvMessage'";
    $message.=" style='width: 972px ;
                visibility: visible;
                display: block;
                text-align: right;
                padding: 4px;
                color:brown;
                font-family: verdana;
                font-size: 12px;
                background-color: #B8ADF1;'>";
    $message.= "$msg";
    $message.="</div><span style='font-size: 1px;'>&nbsp;</span>";
}
else
{
    $message = "<span style='font-size: 1px;'>&nbsp;</span>";
    $message.="<div id='dvMessage'";
    $message.=" style='width: 972px;
                visibility: hidden;
                display: none;
                text-align: right;
                padding: 4px;
                color:brown;
                font-family: verdana;
                font-size: 12px;
                background-color: #B8ADF1;'>";
    $message.="</div><span style='font-size: 1px;'>&nbsp;</span>";
}
include_once '../commoninclude.php';
$stuffid = $_REQUEST['stuffid'];  //to do (replace this with stuffid everywhere)

$_SESSION['stuffid']=$stuffid;
//$TagID=8;

$objPlStuff = new PlStuff();
$StuffRecord=$objPlStuff->PlGetAllStuffDetail($stuffid);

if(count($StuffRecord)<1)
    header("location:BrowseStuff.php?msg=The stuff you was searching is not found.");

$CreatorID=$StuffRecord[0]['MemberID'];
$StuffTitle=$StuffRecord[0]['Title'];
$tagid=$StuffRecord[0]['TagID'];
$categoryid=$StuffRecord[0]['CategoryID'];
$StuffStatus=$StuffRecord[0]['Status'];

$objBoStuff = new BoStuff();
$objBoStuff->setId($stuffid);
$objBoStuff->setTagId($tagid);
$objBoStuff->setCategoryId($categoryid);
$objBoStuff->setTitle($StuffTitle);

if(isset($_SESSION['memberid']))
    $objBoStuff->setMemberId($_SESSION['memberid']);


$objPlPeopleLike=new PlPeopleLike();
$LikeVotes=$objPlPeopleLike->ShowPeopleLike($objBoStuff);
$DontLikeVotes=$objPlPeopleLike->ShowPeopleDontLike($objBoStuff);

$MemberName=$objPlStuff->PlGetMemberDetail($CreatorID);

$TagName="";
if(isset($StuffRecord[0]['TagID']))
{
    $TagRecord=$objPlStuff->PlGetTagDetail($objBoStuff);
    if(isset($TagRecord[0]['TagName']))
        $TagName=$TagRecord[0]['TagName'];
}
else
    $TagName="Untagged";

$StuffDescription=$objPlStuff->PlGetDescription($objBoStuff);
$LastEdited=$objPlStuff->PlGetLastEdited($objBoStuff);
//Comment Display!
$row=$objPlStuff->PlGetCommentsDetail($objBoStuff);
$output="";
if(isset($row))
{
    $output = "<table align='right' width='100%' cellpadding='5' cellspacing='0'>";
    $i=0;
    foreach ($row as $record)
    {
            $output.="<tr>";
            $output.="<td width='38px' style='padding:0;' valign='top'>
                <a style='text-decoration:none' href='../member/profile.php?id=".$record['MemberId']."&member=".$record['NickName']."'>
                <img style='border-width:thin;border-color:black;' src='../Member/MemberImages/" . $record['ProfileImagePath'] . "' width='38px' height='38px'/></a></td>";
            $output.="<td bgcolor='".((($i%2)==0)?"#fef5ce":"white")."' align='right'><a style='text-decoration:none' href='../member/profile.php?id=".$record['MemberId']."&member=".$record['NickName']."'>
                ". $record['NickName']."</a><span style='font-size:10px;'> commented on ".$record['CreatedDate']."</span> <br>".$record['Comment'] . "</td>";
            if(isset($_SESSION['membertype']) && ($_SESSION['membertype']=="A" || $_SESSION['membertype']=="T"))
            {
                $output.="<td bgcolor='".((($i%2)==0)?"#fef5ce":"white")."' valign='top' align='left' style='width:80px;padding:0px;'><a style='text-decoration:none;font-size:10px;' href='HideDescriptionOrComment.php?stuffid=".$stuffid."&commentid=".$record['ID']."&sensor=comment'>
                            <input type='image' src='../images/Hide.png' style='width:80px;height:24px;' name='btnhide' value='Hide'/>
                          </a></td>";
            }
            $output.="</tr>";
            $i++;
    }
    $output.="</table>";
}
//$StuffImage=$objPlStuff->PlGetStuffImages($objBoStuff);
$ShowMoreStuffImages=$objPlStuff->PlGetStuffAllImages($objBoStuff);

//$record=$objPlStuff->PlShowCategory($objBoStuff);
$record = $objPlStuff->PlShowCategory($objBoStuff);

//Display Member Images for this stuff
$MemberImageRecord=$objPlStuff->PlGetMemberImages($objBoStuff);

/* Displaying Categories */
$objPlCategory=new PlCategory();
$votesbycategory=$objPlCategory->PlShowVotesByCategories($objBoStuff);

/* Ends here*/

/* You would also like this */
//Here we are assuming that First Word of Stuff Title may be match in other related Stuff Title
//And therefore we will fetch those related Stuffs
$stuffsearched=explode(" ", $StuffTitle);
$resultcount=0;
$YouwouldAlsoLikeCollage= $objPlStuff->PlShowCollageOnStuffDetailPage(28,$stuffsearched[0],$resultcount);

/* Ends Here */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir='rtl'>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script type="text/javascript" src="ajaxupload.js"></script>
        <!--<style type="text/css">
            iframe { display:none; }
	</style>-->

        <link href="SuggestStuffDetailAddCategory/css/style.css" rel="stylesheet" type="text/css"/>
        <!--[if gte IE 6]>
            <link rel="stylesheet" type="text/css" href="css/i_hate_IE.css" />
        <![endif]-->
        <script type="text/javascript" language="JavaScript" src="SuggestStuffDetailAddCategory/js/jquery.js"></script>
        <script type="text/javascript" language="JavaScript" src="SuggestStuffDetailAddCategory/js/script.js"></script>
        <!--Suggest Add New Stuff-->
        <link href="SuggestAddNewStuff/css/style.css" rel="stylesheet" type="text/css"/>
        <!--[if gte IE 6]>
            <link rel="stylesheet" type="text/css" href="css/i_hate_IE.css" />
        <![endif]-->

	<!--CSS for this Page-->
	<!--<link href="css/StuffDetail.css" rel="stylesheet" type="text/css"/>-->

        <script type="text/javascript" language="JavaScript" src="SuggestAddNewStuff/js/jquery.js"></script>
        <script type="text/javascript" language="JavaScript" src="SuggestAddNewStuff/js/script.js"></script>
	<style type="text/css">
	    body
            {
                background-color: #495863;
            }
            div#dvMain
            {
                padding: 0;
                margin: 0 auto;
                width: 982px;
                height: auto;
                background-color: #FFFFFF;
                border-style: solid;
                border-width: thick;
                border-color:#1c2e3c;
                font-family: verdana;
                font-size: 12px;
                margin-left: 9.5%;
                margin-right: 9.5%;
            }

            #dvBanner
            {
                position: relative;
                width: 982px;
                height: 125px;
                display:block;
                padding: 0px;
                background-image: url(../images/logoheader.jpg);
                background-repeat: no-repeat;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvLogin
            {
                position: relative;
                float: left;
                display: block;
                top: 30px;
                left: 390px;
                color: white;
                font-size: 14px;
                font-weight: bold;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvLogin a
            {
                text-decoration: none;
                color:white;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvLogin a:hover
            {
                text-decoration: underline;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            /*If Member not logged in*/
            #dvNotLogin
            {
                position: relative;
                float: left;
                display: block;
                top: 30px;
                left: 450px;
                color: white;
                font-size: 14px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-weight: bold;
            }
            #dvNotLogin a
            {
                text-decoration: none;
                color:white;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvNotLogin a:hover
            {
                text-decoration: underline;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            .spNotAMember
            {
                color: #f9c60b;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvMenuStrip
            {
                position: relative;
                top: 80px;
                width: 982px;
                height: 30px;
                z-index: 3;
                display:block;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvMenuContents
            {
                position: relative;
                width: 982px;
                top: 3px;
                right:110px;
                /*float: right;*/
                color: black;
                display: block;
                font-size: 15px;
                font-weight: bold;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                text-align: right;
            }
            #dvMenuContents a
            {
                text-decoration: none;
                color: black;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvMenuContents a:hover
            {
                color: white;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvBrowseOrAddNewStuff
            {
                display: block;
                float: left;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvMessage
            {
                width: 100%;
                visibility: hidden;
                display: none;
                text-align: right;
                padding: 4px;
                color:brown;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 12px;
                background-color: #B8ADF1;
            }
            #dvAddStuffButton
            {
                position: relative;
                float:left;
                top: -17px;
                left: 140px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvBrowseStuffButton
            {
                position: relative;
                float: left;
                top: -17px;
                display: block;
                left: -170px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvMessage
            {
                width: 980px;
                visibility: hidden;
                height:15px;
                display: none;
                text-align: right;
                color:brown;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 12px;
                background-color: #B8ADF1;
            }
            #dvAddStuff
            {
                /*position: absolute;
                top:100px;
                left:2px;*/
                visibility: hidden;
                width: 980px;
                height: auto;
                z-index: 4;
                border-style: solid;
                border-width: thin;
                border-color:#1b4376;
                margin-left:auto;
                margin-right:auto;
                padding-top: 10px;
                padding-bottom: 10px;
                display:none; /*Maha Gilinder*/
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvAdsAndMessage
            {
                width: 978.px;
                display: block;
                padding: 4px;
                height: 15%;
            }

            #dvAd1
            {
                float: left;
                left: 3px;
                width: 650px;
                display: block;
                /*border-style: solid;
                border-width: thin;
                border-color:#1b4376;*/
                padding: 4px;
                height: 78px;
                /*background-image: url(../images/ad1.jpg);
                background-color: #233645;*/
                overflow: hidden;
            }

            #dvBecameFriends
            {
                float: right;
                left: 380px;
                width: 300px;
                display: block;
                /*border-style: solid;
                border-width: thin;
                border-color:#1b4376;*/
                padding: 4px;
                height: 78px;
		font-family: Verdana, Arial, Helvetica, sans-serif;
                background-image: url(../images/becamefriends.jpg);
                font-size: 15px;
                text-align: center;
            }
            #dvBecameFriends a
            {
                text-decoration: none;
            }

            #dvMainContent
            {
                top: 3px;
                float: right;
                width: 972px;
                display: block;
                padding: 4px;
                height: auto;
            }

            #dvRightColumn
            {
                width: 650px;
                float: right;
                display: block;
                padding: 4px;
                height: auto;
            }
            #dvReport
            {
                text-align: right;
            }
            #dvReport a
            {
                text-decoration: none;
                color:red;
            }
            #dvStuffTitle
            {
                border-color: black;
                width: 650px;
                display: block;
                padding-left: 0px;
                padding-bottom: 4px;
                height: auto;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 20px;
                color: white;
                background-image: url(../images/StuffDetailTitle_Rectangle.jpg);
            }
            #dvOwner
            {
                float: right;
                width: 510px;
                display: block;
                padding: 4px;
                height: auto;
                font-family: Verdana;
                font-size: 11px;
                color: black;
                text-align: right;
                /*border:1px solid black;*/
            }
            #dvedit
            {
                float: left;
                position: relative;
                left: 1px;
                width: 50px;
                display: block;
                height: auto;
                font-family: Verdana;
                font-size: 15px;
                color: white;
                z-index: 100;
                padding-top: 5px;
                font-weight: bold;
                text-align: left;
            }
            #dvedit a
            {
                color: white;
                text-decoration: none;
            }
            #dvAddCategory
            {
                /*position: absolute;
                top:100px;
                left:2px;*/
                visibility: hidden;
                width: 640px;
                height: auto;
                z-index: 4;
                border-color:#1b4376;
                margin-left:auto;
                margin-right:auto;
                padding-top: 10px;
                padding-bottom: 10px;
                display:none; /*Maha Gilinder*/
                padding: 4px;
            }
            #dvAddNewCategory
            {
                display: block;
                visibility: visible;
            }

            #dvImagesMain
            {
                width: 210px;
                display: block;
                padding-top: 0px;
                height: auto;
                float: right;
            }
            #dvStuffImages
            {
                width: 210px;
                display: block;
                padding: 4px;
                height: auto;
                float: right;
            }
            #dvStuffImages img
            {
                padding: 2px;
                border:2px solid #fbf3e7;
            }

            #dvUploadImages
            {
                visibility: hidden;
                width: 195px;
                height: auto;
                z-index: 4;
                margin-left:auto;
                margin-right:auto;
                padding-top: 10px;
                padding-bottom: 10px;
                display:none; /*Maha Gilinder*/
                padding: 4px;
            }
            #dvMoreImages
            {
                width: 203px;
                display: block;
                max-height: 250px;
                float: right;
                text-align: right;
                padding-right: 13px;
                margin-left:2px;
                margin-right:2px;
                margin-top: 1px;
                margin-bottom: 2px;
            }
            #dvMoreImages a
            { text-decoration: none;}

            #dvitsbest
            {
                width: 380px;
                float: left;
                display: block;
                padding: 2px;
                height: auto;
                background-color: #fbf3e7;
                /*border:1px solid black;*/
            }

            #dvShowAddStuffBest
            {
                visibility: hidden;
                width: 270px;
                height: auto;
                z-index: 4;
                /*border-style: solid;
                border-width: thin;
                border-color:#1b4376;*/
                margin-left:auto;
                margin-right:auto;
                padding-top: 10px;
                padding-bottom: 10px;
                display:none; /*Maha Gilinder*/
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvVoteBestLeft
            {
                position: relative;
                width:260px;
                /*border-style: solid;
                border-width: thin;*/
            }
            #dvVoteit
            {
                position: relative;
                width: auto;
                float: left;
                display: block;

                /*height: 300px;*/
                height: auto;
                background-color: #fbf3e7;

                text-align: left;
            }
            #dvItIsBest
            {
                width: 270px;
            }
            #dvItsBetter
            {
                position: relative;
                width: 270px;
                display: block;
                height: auto;
                background-color: #fbf3e7;
                text-align: left;
                padding: 0px;
            }
            #dvIDontThink
            {
                width: 270px;
                display: block;
                height: auto;
            }

            #dvShowAddStuff
            {
                visibility: hidden;
                width: 270px;
                height: auto;
                z-index: 4;
                margin-left:auto;
                margin-right:auto;
                padding-top: 10px;
                padding-bottom: 10px;
                display:none; /*Maha Gilinder*/
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvVoteLikesRight
            {
                position: relative;
                float: right;
            }
            #dvNoOfLikes
            {
                position: relative;
                width: 100px;
                /*float: right;*/
                display: block;
                /*border-style: solid;*/
                padding: 4px;
                height: auto;
                background-color: white;
            }


            #dvStuffDescription
            {
                width: 420px;
                float: left;
                display: block;
                padding: 4px;
                height: auto;
                text-align: right;

            }

            #AddStuffDescription
            {
                visibility: hidden;
                width: 420px;
                height: auto;
                z-index: 4;
                margin-left:auto;
                margin-right:auto;
                padding-top: 10px;
                padding-bottom: 10px;
                display:none; /*Maha Gilinder*/

            }
            #dvFullDescription
            {
                /*border-style: solid;
                border-width: thin;
                border-color:#1b4376;
                background-color: beige;*/
            }
            #dvAds2
            {
                float: left;
                width: 640px;
                display: block;
                text-align: left;
                height: 70px;
                background-image: url(../images/ad1.jpg);
                background-color: #233645;
                border-style: solid;
                border-width: thin;
                border-color:#1b4376;
            }
            #dvMembersTitle
            {
                float: left;
                width: 650px;
                display: block;
                padding-top: 5px;
                height: 32px;
                background-image: url(../images/StuffDetailTitle.jpg);
                background-repeat: no-repeat;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 16px;
                color: white;
                text-align: right;
            }
            #dvMembersImage
            {
                text-align: right;
                float: right;
                width: 640px;
                display: block;
                padding: 4px;
                height: auto;
            }
            #dvComments
            {
                float: right;
                width: 640px;
                display: block;
                height: 30px;
                text-align: right;
                display: table;
            }
            #dvCommentsTitle
            {
                position: relative;
                background-image: url(../images/StuffDetailTitle.jpg);
                background-repeat: no-repeat;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 16px;
                color: white;
                text-align: right;
                height: 32px;
                width: 650px;
                padding-top: 5px;
            }
            #dvAddComments
            {
                visibility: hidden;
                width: 640px;
                height: auto;
                z-index: 4;
                border-color:#1b4376;
                margin-left:auto;
                margin-right:auto;
                padding-top: 10px;
                padding-bottom: 10px;
                display:none; /*Maha Gilinder*/
                padding: 4px;
            }
            #dvFullComments
            {
                float: right;
                width: 640px;
                display: block;
                direction: rtl;
                padding: 4px;
                height: auto;
            }
            #dvLeftColumn
            {
                float: left;
                width:290px;
                height: auto;
                display: block;
                border-color:#1b4376;
                margin-left:auto;
                margin-right:auto;
                padding: 4px;
            }
            #dvAds3
            {
                position: relative;
                width: 290px;
                height: 230px;
                border-color:#1b4376;
                border-width: thin;
                border-style: solid;
                margin-left:auto;
                margin-right:auto;
                background-image: url(../images/ad2.png);
                background-repeat: no-repeat;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvCategoyVotes
            {
                position: relative;
                top: 2px;
                width: 290px;
                height: auto;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvCategotyVotesTitle
            {
                background-image: url(../images/RelatedCategoryTitle.jpg);
                background-repeat: no-repeat;
                width: 290px;
                height: 32px;
                /*border-width: thin;
                border-style: solid;*/
                text-align: right;
                color: black;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 11px;
                color: #FFFFFF;
                font-weight: bold;
                padding-right: 5px;
                padding-top: 6px;
            }
            #dvCategoryList
            {
                display: block;
                width: 270px;
                height: auto;
                text-align: right;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 4px;
                padding-right: 5px;
            }
            #dvCategoryList a
            {
                text-decoration: none;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvCategoryNameTitle
            {
                font-size: 11px;
                font-weight: bold;
            }
            .ShowCategoryList
            {
                font-size: 10px;
            }
            .showdetails
            {
                display: block;
                visibility: visible;
            }
            .hidedetails
            {
                display: none;
                visibility: hidden;
            }
            #dvYouWouldAlsoLikeThis
            {

            }
            #dvYouWouldAlsoLikeThisTitle
            {
                background-image: url(../images/RelatedCategoryTitle.jpg);
                background-repeat: no-repeat;
                width: 290px;
                height: 32px;
                /*border-width: thin;
                border-style: solid;*/
                text-align: right;
                color: black;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 11px;
                color: #FFFFFF;
                font-weight: bold;
                padding-right: 5px;
                padding-top: 6px;
            }
            #dvYouWouldAlsoLikeThisCollage
            {
                display: block;
                width: 270px;
                height: auto;
                text-align: right;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 4px;
                padding-right: 25px;
            }
            #dvYouWouldAlsoLikeThisCollage img
            {
                margin-left: 1px;
                margin-right: 1px;
                margin-bottom: 1px;
                margin-top: 1px;
                border: 1px solid #7096d3;
                padding: 1px;
            }
            #dvYouWouldAlsoLikeThisCollage a
            {
                text-decoration: none;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvYouWouldAlsoLikeThisTitle
            {
                font-size: 11px;
                font-weight: bold;
            }

            div#dvFooter
            {
                width: 982px;
                z-index: 4;
                padding-top: 20px;
                display:block;
                padding: 4px;
                direction: rtl;
                text-align: center;
                font-size: 13px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                color: #FFFFFF;
                margin-left: 9%;
                margin-right: 9%;

            }
            #dvFooter a
            {
                font-size: 13px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                color: #FFFFFF;
                text-decoration: none;
            }
            #dvFooter a:hover
            {
                text-decoration: underline;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
	</style>
        <style type="text/css">
            div.popup
            {
                display:none;
                position:absolute;
                border:solid 1px black;
                font-size: 10px;
                background-color: #233645;
                width: 150px;
                text-align: right;
            }
            a.popup:hover + div.popup
            {
                display:block;
            }
            div.popup:hover
            {
                left: auto;
                display:block;
                width: 150px;
            }
            ul
            {
                list-style-type: none;
                padding: 0px;
                padding-right:  0px;
                padding-bottom: 0px;
                padding-left: 0px;
                padding-top: 0px;
                width: auto;
            }
            div.popup a
            {
                text-decoration: none;
            }
        </style>

        <!--CSS tool tip-->
    <style type="text/css">
    /*---------- bubble tooltip -----------*/
    a.tt{
    position:relative;
    z-index:24;
    color:#3CA3FF;
    font-weight:bold;
    text-decoration:none;
    font-size: 11px;
    }
    a.tt span{ display: none; }
    /*background:; ie hack, something must be changed in a for ie to execute it*/
    a.tt:hover{ z-index:25; color: #aaaaff; background:;}
    a.tt:hover span.tooltip{
        display:block;
        position:absolute;
        top:0px; left:0;
        padding: 15px 0 0 0;
        width:200px;
        color: #993300;
        text-align: center;
        filter: alpha(opacity:90);
        KHTMLOpacity: 0.90;
        MozOpacity: 0.90;
        opacity: 0.90;
    }
    a.tt:hover span.top{
        display: block;
        padding: 30px 8px 0;
        background: url(../images/bubble.gif) no-repeat top;
    }
    a.tt:hover span.middle{ /* different middle bg for stretch */
        display: block;
        padding: 0 8px;
        background: url(../images/bubble_filler.gif) repeat bottom;
    }
    a.tt:hover span.bottom{
        display: block;
        padding:3px 8px 10px;
        color: #548912;
        background: url(../images/bubble.gif) no-repeat bottom;
    }

    #tooltip{
	position:absolute;
	border:1px solid #333;
	background:#f7f5d1;
	padding:2px 5px;
	color:#333;
	display:none;
	}

   </style>

    <!--CSS tooltips ends here-->

    <script type="text/javascript" src="jquery-1.2.2.pack.js"></script>

    <style type="text/css">

    div.htmltooltip{
    position: absolute; /*leave this and next 3 values alone*/
    z-index: 1000;
    left: auto;
    top: -1000px;
    background: #272727;
    border: 10px solid black;
    color: white;
    padding: 3px;
    width: auto; /*width of tooltip*/
    text-align: center;
    }

    </style>

    <script type="text/javascript" src="htmltooltip.js">

    /***********************************************
    * Inline HTML Tooltip script- by JavaScript Kit (http://www.javascriptkit.com)
    * This notice must stay intact for usage
    * Visit JavaScript Kit at http://www.javascriptkit.com/ for this script and 100s more
    ***********************************************/

    </script>
        <script type="text/javascript" language="JavaScript">

            var editmenuflag=1;
            function ShowEditMenu()
            {
                if(editmenuflag==1)
                {
                    document.getElementById("dveditmenu").style.visibility="visible";
                    document.getElementById("dveditmenu").style.display="block";
                    document.getElementById("dveditmenu").style.top="28px";
                    document.getElementById("dveditmenu").style.left="-1px";
                    document.getElementById("dveditmenu").style.padding="0px";
                    editmenuflag=0;
                }
                else
                {
                    document.getElementById("dveditmenu").style.visibility="hidden";
                    document.getElementById("dveditmenu").style.display="none";
                    editmenuflag=1;
                }
            }

            function showdivtag(id)
            {
                document.getElementById(id).style.visibility="visible";
                document.getElementById(id).style.display="block";
            }
            function hidedivtag(id)
            {
                document.getElementById(id).style.visibility="hidden";
                document.getElementById(id).style.display="none";
            }
        </script>

        <script type="text/javascript" language="JavaScript">
            /*Ajax Script for voting its the best*/
            var xmlhttp=null;
            var xhr=null;
            function GetXMLHttp()
            {
                try
                {
                    xmlhttp=new ActiveX("Microsoft.XMLHTTP");
                }
                catch(e)
                {
                    xmlhttp=new XMLHttpRequest();
                }
                return xmlhttp;
            }


            function CheckAvailabilityPeopleLike()
            {
                cat=document.getElementsByName("chkcategory[]");
                sid=document.frmAddDescription.stuffid.value;
                var s="";
                for(i=0;i<cat.length;i++)
                {
                    if(cat[i].checked==true)
                        s+=cat[i].value+",";
                }
                if(s=="")
                    s=document.getElementById("defaultcat").value;

                url="vote_best.php?stuffid="+sid+"&q=L&category="+s;

                xhr=new GetXMLHttp();
                xhr.onreadystatechange=LikeStateChange;
                xhr.open('GET',url,true);
                xhr.send(null);
            }
            function CloseItsBestSection()
            {
                document.getElementById("dvShowAddStuffBest").style.visibility="hidden";
                document.getElementById("dvShowAddStuffBest").style.display="none";
                k=1;
            }
            function PeopleDontLike()
            {
                if(document.getElementById("loggedinmember").value=="not".trim())
                    window.location="../member/signup.php?msg=Please be member first before dedicate stuff";
                else
                {
                    dcate=document.getElementById("defaultcat").value;
                    sid=document.frmAddDescription.stuffid.value;
                    var url;
                    url="vote_best.php?stuffid="+sid+"&q=D&category="+dcate;

                    xhr=new GetXMLHttp();
                    xhr.onreadystatechange=DontLikeStateChange;
                    xhr.open('GET',url,true);
                    xhr.send(null);
                }
            }

            function LikeStateChange()
            {
                if(xhr.readyState==4 && xhr.status==200)
                {
                    CloseItsBestSection();
                    document.getElementById("dvNoOfLikes").innerHTML=xhr.responseText;
                }
                else
                    document.getElementById("dvNoOfLikes").innerHTML="";
            }

            function DontLikeStateChange()
            {
                if(xhr.readyState==4 && xhr.status==200)
                {
                    document.getElementById("dvNoOfLikes").innerHTML=xhr.responseText;
                }
                else
                    document.getElementById("dvNoOfDontLikes").innerHTML="";
            }


        </script>

        <script type="text/javascript" language="JavaScript">
            //Ajax Script for adding a comment.
            String.prototype.trim = function()
            {
                return this.replace(/(?:(?:^|\n)\s+|\s+(?:$|\n))/g,"");
            }
            var xmlhttp=null;
            var xhr=null;
            function GetXMLHttp()
            {
                try
                {
                    xmlhttp=new ActiveX("Microsoft.XMLHTTP");
                }
                catch(e)
                {
                    xmlhttp=new XMLHttpRequest();
                }
                return xmlhttp;
            }

            function CheckAvailabilityComment()
            {
                str=document.frmAddComments.txtAddComment.value.trim();
                sid=document.frmAddDescription.stuffid.value;
                url="StuffComment.php?stuffid="+sid+"&q="+str;
                xhr=new GetXMLHttp();
                xhr.onreadystatechange=StateChange;
                xhr.open('GET',url,true);
                xhr.send(null);
                DisplayAddComment();
            }

            function StateChange()
            {
                if(xhr.readyState==4 && xhr.status==200)
                {
                    if(xhr.responseText.trim()=="login".trim())
                    {
                        window.location="../member/signup.php?msg=Please be member first before dedicate stuff";
                    }
                    else
                        document.getElementById("dvFullComments").innerHTML=xhr.responseText;
                }
                else
                    document.getElementById("dvFullComments").innerHTML="<img src='../images/008.gif'/>";
            }
        </script>

        <script type="text/javascript" language="JavaScript">
            //Ajax Script for adding a Description.
            String.prototype.trim = function()
            {
                return this.replace(/(?:(?:^|\n)\s+|\s+(?:$|\n))/g,"");
            }
            var xmlhttp=null;
            var xhr=null;
            function GetXMLHttp()
            {
                try
                {
                    xmlhttp=new ActiveX("Microsoft.XMLHTTP");
                }
                catch(e)
                {
                    xmlhttp=new XMLHttpRequest();
                }
                return xmlhttp;
            }

            function AjaxAddDescription()
            {
                str=document.getElementsByName("AddDescription").value;
                sid=document.frmAddDescription.stuffid.value;
                url="AddDescription.php?stuffid="+sid+"&q="+str;
                alert(url);
                xhr=new GetXMLHttp();
                xhr.onreadystatechange=AjaxAddDescriptionStateChange;
                xhr.open('GET',url,true);
                xhr.send(null);
                DescriptionValid();
            }

            function AjaxAddDescriptionStateChange()
            {
                if(xhr.readyState==4 && xhr.status==200)
                {
                    if(xhr.responseText.trim()=="login".trim())
                    {
                        window.location="../member/signup.php?msg=Please be member first before dedicate stuff";
                    }
                    else
                        document.getElementById("dvStuffDescription").innerHTML="<hr size='1' style='border-color: black;'/>"+xhr.responseText;
                }
                else
                    document.getElementById("dvStuffDescription").innerHTML="<img src='../images/008.gif'/>";
            }
        </script>

        <script type="text/javascript" language="JavaScript">
            //Ajax Script to add Category
            String.prototype.trim = function()
            {
                return this.replace(/(?:(?:^|\n)\s+|\s+(?:$|\n))/g,"");
            }
            var xmlhttp=null;
            var xhr=null;
            function GetXMLHttp()
            {
                try
                {
                    xmlhttp=new ActiveX("Microsoft.XMLHTTP");
                }
                catch(e)
                {
                    xmlhttp=new XMLHttpRequest();
                }
                return xmlhttp;
            }

            function AjaxAddCategory()
            {
                CategoryValid();
                str=document.frmAddCategory.txtAddCategory.value.trim();
                sid=document.frmAddDescription.stuffid.value;
                url="StuffAddCategory.php?stuffid="+sid+"&q="+str;
                xhr=new GetXMLHttp();
                xhr.onreadystatechange=AddCategoryStateChange;
                xhr.open('GET',url,true);
                xhr.send(null);
            }

            function AddCategoryStateChange()
            {
                if(xhr.readyState==4 && xhr.status==200)
                {
                    if(xhr.responseText.trim()=="login".trim())
                    {
                        window.location="../member/signup.php?msg=Please be member first before dedicate stuff";
                    }
                    else
                        document.getElementById("dvCategoryAdded").innerHTML=xhr.responseText;
                }
                else
                    document.getElementById("dvCategoryAdded").innerHTML="<img src='../images/008.gif'/>";
            }
        </script>

        <script type="text/javascript" language="JavaScript"> //JavaScript Functions All
            var i=1;
            var j=1;
            String.prototype.trim = function()
            {
                return this.replace(/(?:(?:^|\n)\s+|\s+(?:$|\n))/g,"");
            }

            function StuffValid()
            {
                if(document.frmaddstuff.txtStuffname.value.trim()=="")
                {
                    document.getElementById("dvMessage").style.visibility="visible";
                    document.getElementById("dvMessage").style.display="block";
                    document.getElementById("dvMessage").innerHTML="Stuff cannot be blank.";
                    return false;
                }
                else
                {
                    document.getElementById("dvMessage").innerHTML="";
                    document.getElementById("dvMessage").style.display="block";
                    document.getElementById("dvMessage").style.visibility="hidden";
                }
                return true;
            }

            function DisplayAddStuff()
            {
                if(i==1)
                {
                    document.getElementById("dvAddStuff").style.visibility="visible";
                    //document.getElementById("dvAddStuff").style.display="table";
                    var appName = navigator.appName;
                    if(appName.indexOf('Microsoft Internet Explorer') >= 0)
                        document.getElementById("dvAddStuff").style.display="block";
                    else
                        document.getElementById("dvAddStuff").style.display="table";

                    i=0;
                }
                else
                {
                    document.getElementById("dvAddStuff").style.visibility="hidden";
                    document.getElementById("dvAddStuff").style.display="none";
                    document.getElementById("dvMessage").innerHTML="";
                    document.getElementById("dvMessage").style.display="none";
                    document.getElementById("dvMessage").style.visibility="hidden";
                    i=1;
                }
            }


            function DisplayAddCategory()
            {
                if(j==1)
                {
                    document.getElementById("dvAddCategory").style.visibility="visible";
                    //document.getElementById("dvAddCategory").style.display="table";
                    var appName = navigator.appName;
                    if(appName.indexOf('Microsoft Internet Explorer') >= 0)
                        document.getElementById("dvAddCategory").style.display="block";
                    else
                        document.getElementById("dvAddCategory").style.display="table";
                    j=0;
                    //Close EditMenu
                    document.getElementById("dveditmenu").style.visibility="hidden";
                    document.getElementById("dveditmenu").style.display="none";
                }
                else
                {
                    document.getElementById("dvAddCategory").style.visibility="hidden";
                    document.getElementById("dvAddCategory").style.display="none";
                    j=1;
                }
            }

            function BetterStuffValid()
            {

                if(document.frmaddbetterstuff.txtStuffname.value.trim()=="")
                {
                    document.getElementById("dvBetterStuffMessage").style.visibility="visible";
                    document.getElementById("dvBetterStuffMessage").style.display="block";
                    document.getElementById("dvBetterStuffMessage").innerHTML="Stuff cannot be blank.";
                    return false;
                }
                else
                {
                    document.getElementById("dvBetterStuffMessage").innerHTML="";
                    document.getElementById("dvBetterStuffMessage").style.display="block";
                    document.getElementById("dvBetterStuffMessage").style.visibility="hidden";
                }
                return true;
            }
            var k=1;
            function DisplayItsBest()
            {
                if(document.getElementById("loggedinmember").value=="not".trim())
                    window.location="../member/signup.php?msg=Please be member first before dedicate stuff";
                else
                {
                    norecord=document.getElementById("sample").value;
                    if(norecord>1)
                    {
                        if(i==1)
                        {
                            document.getElementById("dvShowAddStuffBest").style.visibility="visible";
                            var appName = navigator.appName;
                            if(appName.indexOf('Microsoft Internet Explorer') >= 0)
                                document.getElementById("dvShowAddStuffBest").style.display="block";
                            else
                                document.getElementById("dvShowAddStuffBest").style.display="table";
                            i=0;
                        }
                        else
                        {
                            document.getElementById("dvShowAddStuffBest").style.visibility="hidden";
                            document.getElementById("dvShowAddStuffBest").style.display="none";
                            document.getElementById("dvShowAddStuffBest").style.display="";
                            i=1;
                        }
                    }
                    else
                    {
                        CheckAvailabilityPeopleLike();
                    }
                }
            }
            var l=1;
            function DisplayAddBetterStuff()
            {
                if(document.getElementById("loggedinmember").value=="not".trim())
                    window.location="../member/signup.php?msg=Please be member first before dedicate stuff";
                else
                {
                    if(l==1)
                    {
                        document.getElementById("dvShowAddStuff").style.visibility="visible";
                        var appName = navigator.appName;
                        if(appName.indexOf('Microsoft Internet Explorer') >= 0)
                            document.getElementById("dvShowAddStuff").style.display="block";
                        else
                            document.getElementById("dvShowAddStuff").style.display="table";
                        l=0;
                    }
                    else
                    {
                        document.getElementById("dvShowAddStuff").style.visibility="hidden";
                        document.getElementById("dvShowAddStuff").style.display="none";
                        /*document.getElementById("dvBetterStuffMessage").innerHTML="";
                        document.getElementById("dvBetterStuffMessage").style.display="block";
                        document.getElementById("dvBetterStuffMessage").style.visibility="hidden";*/
                        l=1;
                    }
                }
            }
            var m=1;
            function DisplayAddComment()
            {
                if(m==1)
                {
                    document.getElementById("dvAddComments").style.visibility="visible";
                    //document.getElementById("dvAddComments").style.display="table";
                    var appName = navigator.appName;
                    if(appName.indexOf('Microsoft Internet Explorer') >= 0)
                        document.getElementById("dvAddComments").style.display="block";
                    else
                        document.getElementById("dvAddComments").style.display="table";
                    m=0;
                }
                else
                {
                    document.getElementById("dvAddComments").style.visibility="hidden";
                    document.getElementById("dvAddComments").style.display="none";

                    m=1;
                }
            }
            var n=1;
            function DisplayAddDescription()
            {
                if(n==1)
                {
                    document.getElementById("AddStuffDescription").style.visibility="visible";
                    document.getElementById("AddStuffDescription").style.display="table";
                    var appName = navigator.appName;
                    if(appName.indexOf('Microsoft Internet Explorer') >= 0)
                        document.getElementById("AddStuffDescription").style.display="block";
                    else
                        document.getElementById("AddStuffDescription").style.display="table";

                    document.getElementById("dvFullDescription").style.visibility="hidden";
                    document.getElementById("dvFullDescription").style.display="none";
                    n=0;
                    //Close EditMenu
                    document.getElementById("dveditmenu").style.visibility="hidden";
                    document.getElementById("dveditmenu").style.display="none";
                }
                else
                {
                    document.getElementById("AddStuffDescription").style.visibility="hidden";
                    document.getElementById("AddStuffDescription").style.display="none";
                    document.getElementById("dvFullDescription").style.visibility="visible";
                    document.getElementById("dvFullDescription").style.display="block";
                    n=1;
                }
            }

            function CommentValid()
            {
                if(document.frmAddComments.txtAddComment.value.trim()=="")
                {
                    document.getElementById("dvAddComments").innerHTML="Comment cannot be blank.";
                    return false;
                }
                else
                {
                    return true;
                }
            }

            function DescriptionValid()
            {
                if(Document.frmAddDescription.txtAddDescription.value.trim()=="")
                {
                    document.getElementById("AddStuffDescription").innerHTML="Description cannot be blank";
                    return false;
                }
                else
                {
                    return true;
                }
            }

            function CategoryValid()
            {
                if(document.frmAddCategory.txtAddCategory.value.trim()=="")
                {
                    document.getElementById("dvAddedCategory").innerHTML="Category cannot be blank.";
                    return false;
                }
                else
                {
                    return true;
                }
            }
            var i=1;
            function DisplayUploadImages()
            {
                if(i==1)
                {
                    document.getElementById("dvUploadImages").style.visibility="visible";
                    document.getElementById("dvUploadImages").style.display="table";
                    var appName = navigator.appName;
                    if(appName.indexOf('Microsoft Internet Explorer') >= 0)
                        document.getElementById("dvUploadImages").style.display="block";
                    else
                        document.getElementById("dvUploadImages").style.display="table";

                    document.getElementById("dvStuffImages").style.visibility="hidden";
                    document.getElementById("dvStuffImages").style.display="none";
                    document.getElementById("dvMoreImages").style.visibility="hidden";
                    document.getElementById("uploadimageflag").value="";
                    i=0;

                    //Close EditMenu
                    document.getElementById("dveditmenu").style.visibility="hidden";
                    document.getElementById("dveditmenu").style.display="none";
                }
                else
                {
                    document.getElementById("dvUploadImages").style.visibility="hidden";
                    document.getElementById("dvUploadImages").style.display="none";
                    document.getElementById("dvStuffImages").style.visibility="visible";
                    document.getElementById("dvStuffImages").style.display="";
                    document.getElementById("dvMoreImages").style.visibility="visible";
                    document.getElementById("uploadimageflag").value="uploadimage";
                    i=1;
                }
            }
            /*  It is the best wadi Javascript downloaded from Dynamic Drive  */
            var what=1;
            function ShowWhatDoYouThinkSection()
            {
                if(what==0)
                {
                    document.getElementById("dvWhatDoYouThinkIsBest").style.visibility="visible";
                    document.getElementById("dvWhatDoYouThinkIsBest").style.display="block";
                    what=1;
                }
                else
                {
                    document.getElementById("dvWhatDoYouThinkIsBest").style.visibility="hidden";
                    document.getElementById("dvWhatDoYouThinkIsBest").style.display="none";
                    what=0;
                }
            }
            /*Function to change stuff image on click*/
            function changeimage(imgname)
            {
                document.getElementById("dvStuffImages").innerHTML="<img src='stuffimages/size6/"+imgname+"' style='max-width: 210px;max-height: 250px;' alt=''/>";
            }

        </script>
        <script type="text/javascript" language="JavaScript">
            function LoadSelectedDescription(id)
            {
                url="LoadSelectedDescription.php?id="+id;
                xhr=new GetXMLHttp();
                xhr.onreadystatechange=SelectedDescriptionStateChanged;
                xhr.open('GET',url,true);
                xhr.send(null);
            }
            function SelectedDescriptionStateChanged()
            {
                if(xhr.readyState==4)
                {
                    document.getElementById("txtAddDescription").innerHTML=xhr.responseText;
                }
            }

            function disableEnterKey(e)
            {
                var key;
                if(window.event)
                    key = window.event.keyCode; //IE
                else
                    key = e.which; //firefox

                return (key != 13);
            }
            
        </script>
        <script type="text/javascript" language="JavaScript">

            function CheckAllCategorySection()
            {
                
                if(document.getElementById("CheckAllCategory").checked==true)
                {
                    var ch=document.getElementsByName("chkcategorybetter[]");
                    for (i = 0; i < ch.length; i++)
                        ch[i].checked = true ;
                }
                else
                {
                    var ch=document.getElementsByName("chkcategorybetter[]");
                    for (i = 0; i < ch.length; i++)
                        ch[i].checked = false ;
                }
            }

            function CheckAllBestSection()
            {
                if(document.getElementById("CheckAllBest").checked==true)
                {
                    var ch=document.getElementsByName("chkcategory[]");
                    for (i = 0; i < ch.length; i++)
                        ch[i].checked = true ;
                }
                else
                {
                    var ch=document.getElementsByName("chkcategory[]");
                    for (i = 0; i < ch.length; i++)
                        ch[i].checked = false ;
                }
            }
            function SingleUnChecked()
            {
                document.getElementById("CheckAllBest").checked=false;
                document.getElementById("CheckAllCategory").checked=false;
            }
        </script>
        <!--Ajax Dialog Box for Report Violation-->
        <link rel="stylesheet" href="css/demos.css" media="screen" type="text/css"/>
        <link rel="stylesheet" href="css/modal-message.css" type="text/css"/>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/modal-message.js"></script>
	<script type="text/javascript" src="js/ajax-dynamic-content.js"></script>
        <script type="text/javascript">
            messageObj = new DHTML_modalMessage();	// We only create one object of this class
            messageObj.setShadowOffset(5);	// Large shadow

            function displayMessage(url)
            {

                    messageObj.setSource(url);
                    messageObj.setCssClassMessageBox(false);
                    messageObj.setSize(200,120);
                    messageObj.setShadowDivVisible(true);	// Enable shadow for these boxes
                    messageObj.display();
            }
            function displayStaticMessage(messageContent,cssClass)
            {
                    messageObj.setHtmlContent(messageContent);
                    messageObj.setSize(200,200);
                    messageObj.setCssClassMessageBox(cssClass);
                    messageObj.setSource(false);	// no html source since we want to use a static message here.
                    messageObj.setShadowDivVisible(false);	// Disable shadow for these boxes
                    messageObj.display();
            }
            function closeMessage()
            {
                    messageObj.close();
            }

            function disableEnterKey(e)
            {
                var key;
                if(window.event)
                    key = window.event.keyCode; //IE
                else
                    key = e.which; //firefox

                return (key != 13);
            }
       </script>


    </head>
    <body dir="rtl">
        <div id="dvMain" align="center">
            <div id="dvBanner">
                <?php
                if (isset($_SESSION['member'])) {
                ?>
                    <div id="dvLogin">
                        <a href="../logout.php" title="Logout"> logout </a> |
                        <a href="../member/comments.php?profileid=<?php echo $_SESSION['memberid']; ?>" title="Comments"> comments </a>|
                        <a href="../member/stuffs.php?page=1&ipp=20&profileid=<?php echo $_SESSION['memberid']; ?>&member=<?php echo $_SESSION['member']; ?>" title="Stuffs"> stuff </a> |
                        <a href="../member/profile.php?profileid=<?php echo $_SESSION['memberid']; ?>&<?php echo $_SESSION['member']; ?>" title="Member Profile"><?php echo $_SESSION['member']; ?></a>
                        <div style="clear: both;"></div>
                    </div>
                    <div style="position: absolute;float:left;left: 875px;width: 105px;height: 120px;">
                        <a href="../index.php" style="outline: none;">
                            <img src="../images/hotspot.png" border="0" alt=""/>
                        </a>
                    </div>
                <?php
                } else {
                ?>
                    <div id="dvNotLogin">
                        <!--<img src='member/memberimages/default.jpg' width='20px' height='20px' alt='' />|-->
                        <a href="../Member/Login.php" title="Login">התחבר</a> |
                        <span class="spNotAMember" title="Not a Member">עדיין לא רשום ?</span>
                        <a href="../Member/Signup.php" title="Sign Up"> הרשם עכשיו </a>
                    </div>
                    <div style="position: absolute;float:left;left: 875px;width: 105px;height: 120px;">
                    <a href="../index.php" style="outline: none;">
                    <img src="../images/hotspot.png" border="0" alt=""/>
                    </a>
                    </div>
                <?php
                       }
                ?>
                <div style="clear: both;"></div>
                <div id="dvMenuStrip">
                    <div id='dvMenuContents'>
                        <a href="../index.php" title="HOME"><?php echo MENU_HOME; ?></a> <a href="../faq.php" title="FAQ"><?php echo FAQ; ?></a>
                    </div>
                    <div id="dvAddStuffButton">
                        <a href="javascript:void(0)" onclick="DisplayAddStuff();"> <img id="btnAddStuff" name="btnAddStuff" src='../images/AddStuff.png' width='175px' height='24px' alt='' border="0"/></a>
                    </div>
                    <div id="dvBrowseStuffButton">
                        <a href="../Stuff/BrowseStuff.php?page=1&ipp=20"><img id="btnBrowser" name="btnBrowse" src='../images/BrowseStuff.png' width='130px' height='24px' alt='' border="0"/></a>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>
            <div id="dvAddStuff">
                <form action="AddMyStuff.php" method="POST" name="frmaddstuff" onsubmit="return StuffValid();">
                    <table class="table" align="Right" width="300px">
                        <tr>
                            <td colspan="2">Stuff Title:</td>
                        </tr>
                        <tr>
                            <td><!--<input type="text" id="txtStuffName" name="txtStuffname" size="40"/>-->
                                <div class="main">
                                    <div id="holder">
                                        <input type="text" id="txtStuffname" name="txtStuffname" tabindex="0" size="29" OnKeyPress="return disableEnterKey(event);"/>
                                        <img src="suggestaddnewstuff/images/loading.gif" id="loading" alt=""/>
                                        <input type="submit" name="submit" id="submit" value="Add"/>
                                    </div>
                                <div id="ajax_response_addnewstuff"></div>
                                </div>
                            </td>
                            <td align="left"></td>
                        </tr>
                    </table>
                </form>
                <div style="float: left;"><a href='javascript:void(0)' onclick="DisplayAddStuff();">Close</a></div>
            </div>
            <div id="dvMessageMain">
                <?php
                if (isset($message))
                    echo $message;
                ?>
            </div>
            <span style='font-size: 1px;'>&nbsp;</span>
            <div id="dvAdsAndMessage" align="left">
                <div id="dvAd1" align="left">
                    Ads Goes Here
                </div>
                <div id="dvBecameFriends" align="right">
                    &nbsp;
                    <?php
                    $LastFriends=$objPlStuff->PlLastFriend();
                    /*echo "<a href='../Member/Profile.php?id=".$LastFriends[0][0]['ID']."&member=".$LastFriends[0][0]['NickName']."'><img src='../Member/MemberImages/".$LastFriends[0][0]['ProfileImagePath']."' style='width:20px;height:20px;border:1px;padding:1px;' alt=''/> ".$LastFriends[0][0]['NickName']."</a> and <br/>";
                    echo "<a href='../Member/Profile.php?id=".$LastFriends[1][0]['ID']."&member=".$LastFriends[1][0]['NickName']."'><img src='../Member/MemberImages/".$LastFriends[1][0]['ProfileImagePath']."' style='width:20px;height:20px;border:1px;padding:1px;' alt=''/> ".$LastFriends[1][0]['NickName']."</a> are now Friends";*/
		    echo $LastFriends;
                    ?>
                </div>
            </div>
	    <div style="clear:both;"/>
            <span style='font-size: 1px;'>&nbsp;</span>
            <div id="dvMainContent" align="center">
                <div id="dvRightColumn">
                    <div id="dvFacebookShare">
                        <!-- AddThis Button BEGIN -->
                        <!--<div class="addthis_toolbox addthis_default_style ">
                        <a href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4cf10fbb4a816dae" class="addthis_button_compact">Share</a>
                        <span class="addthis_separator">|</span>
                        <a class="addthis_button_preferred_1"></a>
                        <a class="addthis_button_preferred_2"></a>
                        <a class="addthis_button_preferred_3"></a>
                        <a class="addthis_button_preferred_4"></a>
                        </div>
                        <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4cf10fbb4a816dae"></script>-->
                        <!-- AddThis Button END -->
                    </div>
                    <br/>
                    <div id="dvReport">
                        <div><!--<a href="javascript:void(0);" onclick="ReportViolation();">Report Violation</a></div>-->
                        <?php
                            if(isset($_SESSION['memberid']))
                                echo "<br><a style='text-decoration:none;' href='javascript:void(0);' onclick=\"displayMessage('includes/demo-modal-message-1.php?stuffid=".$stuffid."&memberid=".$_SESSION["memberid"]."');return false\">Report Violation</a><br>";
                        ?>
                        </div>
                    </div>
                    <div id="dvStuffTitle" align="Right">
                            <div style="float: right; width:590px;color:white;">&nbsp;<?php echo $StuffTitle; ?></div>
                            <?php if(isset($_SESSION['member'])) { if($StuffStatus=='A') { ?>
                            <div id="dvedit">
                            <a class="popup" href="javascript:void(0)" onclick="ShowEditMenu();">Edit</a>
                                <div class="popup" id="dveditmenu">
                                    <ul>
                                        <li><a href="javascript:void(0)" onclick="DisplayAddCategory();">Add Category</a></li>
                                        <li><a href="javascript:void(0)" onclick="DisplayUploadImages();">Add/Edit Image</a></li>
                                        <li><a href="javascript:void(0)" onclick="DisplayAddDescription();">Add/Edit Description</a></li>
                                    </ul>
                                </div>
                            <!--<a href='javascript:void(0)' onclick='DisplayAddCategory();'>Add Category</a>-->
                            </div>
                        <?php } }
                        if($StuffStatus=="L")
                            echo "<div id='dvedit'><img  src='../images/lock.png' alt='locked item' title='This item has been locked.'/></div>";
                        ?>
                            <div style="clear: both"></div>
                    </div>

                    <!--Own Section-->
                    <div id="dvOwner" align="Right">
                        <div style="position: relative;float:right;">
                        Created By
                        <a style="text-decoration: none;" href="../member/profile.php?id=<?php echo $MemberName[0]['ID']; ?>&member=<?php echo $MemberName[0]['NickName'];  ?>">
                            <?php echo $MemberName[0]['NickName']; ?></a>.
                        Last Edited by
                        <a style="text-decoration: none;" href="../member/profile.php?id=<?php  echo $LastEdited[0]['ID']; ?>&member=<?php echo $LastEdited[0]['NickName'];  ?>">
                            <?php
                                if(isset($LastEdited[0]['NickName']))
                                    echo $LastEdited[0]['NickName'];
                                else
                                    echo $MemberName[0]['NickName'];
                            ?>
                        </a>
                        Tagged as <span style="color:gray;"> <?php echo $TagName; ?></span>.</div>
                        
                    </div>
                    <div id="dvFacebookLike" style="position: relative;float:left;left: 0px;">
                            <!--<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
                            <fb:like href="<?php //echo SITE_URL; ?>/Stuff/StuffDetail.php?stuffid=<?php //echo $stuffid; ?>" layout="button_count" show_faces="false" width="100">
                            </fb:like>-->
                    </div>
                    
                    <!--Owner Section ends here-->

                    <div id="dvAddCategory" align="right">
                        <form name="frmAddCategory" id="frmAddCategory" action="" method="Post">
                            <!--<input type="text" id="txtAddCategory" name="txtAddCategory"/>-->
                            <div class="main">
                                    <div id="holder">
                                        <input type="text" id="txtAddCategory" name="txtAddCategory" tabindex="0" size="29" OnKeyPress="return disableEnterKey(event);"/>
                                        <img src="suggeststuffdetailaddcategory/images/loading.gif" id="loading" alt=""/>
                                        <input type="button" onclick="AjaxAddCategory();" value="Add Category"/>
                                    </div>
                                <div id="ajax_response_addcategory"></div>
                            </div>                            
                        </form>
                    </div>
                    <div id="dvCategoryAdded">
                    </div>
                    <span style='font-size: 1px;'>&nbsp;</span>
                    <div id="dvImagesMain">
                        <!--<input type="button" name="UploadImage" id="UploadImage" onclick="DisplayUploadImages();" value="Add Images"/>-->
                        <div id="dvStuffImages">
                            <img src="StuffImages/size6/<?php echo $ShowMoreStuffImages[0]['ImagePath'];  ?>" style="max-width: 210px;max-height: 250px;" alt=""/>
                        </div>
                        <div style="clear: both"></div>
                        <div id="dvMoreImages">
                            <?php
                                if(isset($ShowMoreStuffImages) && count($ShowMoreStuffImages)>1)
                                {
                                    $imageoutput="";
                                    for($i=0;$i<count($ShowMoreStuffImages);$i++)
                                    {
                                        $imgname=$ShowMoreStuffImages[$i]['ImagePath'];
                                        //$imageoutput.="<a style='text-decoration:none' onclick='changeimage(\"$imgname\")' href='javascript:void(0)' title='". $ShowMoreStuffImages[$i]['ImagePath']."'><img src='StuffImages/size4/". $ShowMoreStuffImages[$i]['ImagePath']."' width='56' height='56' border='0' style='border-width:thin;border-color:black;'> </a>";
                                        $imageoutput.="<img src='StuffImages/size4/". $ShowMoreStuffImages[$i]['ImagePath']."' onclick='changeimage(\"$imgname\")' width='56' height='56' border='0' style='border:2px solid #B8ADF1;'> ";
                                    }
                                    echo $imageoutput;
                                }
                            ?>
                        </div>
                        <div style="clear: both"></div>
                        <div id="dvUploadImages">
                                <!--action="ajaxupload.php?"-->
                            <form action="UploadMoreImages.php"  method="post" name="standard_use" id="standard_use" enctype="multipart/form-data">
                                <p><input type="file" name="file" id="file" size="15px"/></p>or Upload from URL
                                <input type="text" name="txturl" id="txturl" />
				<!--<button onclick="ajaxUpload(this.form,'ajaxupload.php?filename=filename&amp;maxSize=9999999999&amp;maxW=200&amp;fullPath=StuffImages/&amp;relPath=stuffimages/&amp;colorR=255&amp;colorG=255&amp;colorB=255&amp;maxH=300','upload_area','File Uploading Please Wait...&lt;br /&gt;&lt;img src=\'../images/loader_light_blue.gif\' width=\'128\' height=\'15\' border=\'0\' /&gt;','&lt;img src=\'images/error.gif\' width=\'16\' height=\'16\' border=\'0\' /&gt; Error in Upload, check settings and path info in source code.'); return false;">Upload Image</button>-->
                                <input type="hidden" id="uploadimageflag" name="uploadimageflag" />
                                <input type="hidden" name="uploadstuffid" value="<?php echo $stuffid; ?>">
                                <input type="submit" id="submituploadimage" name="submituploadimage" value="Upload Image"/>
                            </form>
                        </div>
                        <!--<div id="upload_area"></div>-->
                    </div>

                    <div id="dvitsbest">
                        <!--People Like and Don't Like Section starts here-->
                        <div id="dvVoteLikesRight">
                            <div id="dvNoOfLikes">
                                <?php
                                /*echo $LikeVotes."<br><font size='3'>People</font> bested this!";
                                if($DontLikeVotes>0)
                                    echo "<hr>".$DontLikeVotes."<br> People are crucious.";*/
                                echo "<b>".$LikeVotes."</b><br><img src='../images/peoplelikes.png' alt=''/>";
                                if($DontLikeVotes>0)
                                    echo "<hr><b>".$DontLikeVotes."</b><br> <img src='../images/peoplecurious.png' alt=''/>";
                                ?>
                            </div>
                        </div>
                        <!--People Like and Don't Like Section ends here-->
                        <div style="float:right;text-align: left;width:270px;padding: 0" align="left">
                            <div id="dvWhatDoYouThink">
                                 <!--What do you think is best? Section-->
                                 <a href="javascript:void(0)" onclick="ShowWhatDoYouThinkSection();"
                                    style="text-decoration: none;font-weight:bold;font-size:16px; color:brown;">
                                     Do you think this is best?
                                 </a>
                            </div>
                            <br>
                            <div id="dvWhatDoYouThinkIsBest">
                                <div id="dvVoteBestLeft">
                                    <div id="dvItIsBest" align="left">
                                        <input type="image" src="../images/IThinkItsBest.jpg" name="ShowAddBest" value="I think its the best" style="width:250px;height:30px" onclick="DisplayItsBest();"/>
                                        <div id="dvShowAddStuffBest">
                                            <form name="frmitsbest" id="frmitsbest" method="post" action="">
                                                <input type="hidden" id="loggedinmember" name="loggedinmember" value="<?php
                                                        if (isset($_SESSION['member']))
                                                            echo $_SESSION['memberid'];
                                                        else
                                                            echo "not";
                                                        ?>">
                                                       <?php
                                                       if (count($record) > 1)
                                                       {
                                                           $CategoryDisplay = "<table style='font-size:10px;font-family: Verdana, Arial, Helvetica, sans-serif;' cellpadding='0' cellspacing='0' width='250px'>";
                                                           $CategoryDisplay.="<tr><td colspan='2'>
                                                                              <input type='checkbox' name='CheckAllBest' id='CheckAllBest' value='select/check all' onclick='CheckAllBestSection()'/>select/check all
                                                                              </td></tr>";
                                                           for ($i = 0; $i < count($record); $i++)
                                                           {
                                                               $CategoryDisplay.="<tr bgcolor='white'>";
                                                               $CategoryDisplay.="<td width='10px'>";
                                                               $CategoryDisplay.="<input type='checkbox' name='chkcategory[]' id='chkcategory' value=" . $record[$i]['ID'] . " onclick='SingleUnChecked()'>";
                                                               $CategoryDisplay.="<input type='hidden' id='defaultcat' name='defaultcat' value='" . $record[0]['ID'] . "'></td>";
                                                               $CategoryDisplay.="<td>" . $record[$i]["Title"] . "</td></tr>";
                                                           }                                                           
                                                           $CategoryDisplay.="<tr><td colspan='2'><input type='button' onclick='CheckAvailabilityPeopleLike();' value='its Best'/></td></tr>";
                                                           $CategoryDisplay.="</table>";
                                                           echo $CategoryDisplay;
                                                       }
                                                       ?>
                                                <input type="hidden" id="sample" name="sample" value="<?php echo count($record); ?>"
                                            </form>
                                        </div>
                                    </div>
                                    <div id="dvItsBetter" align="left">
                                        <a href="javascript:void(0);" onclick="DisplayAddBetterStuff();">
                                        <img src="../images/IThinkThereisBetter.jpg" name="ShowAddStuff" id="ShowAddStuff"  style="width:250px;height:30px" alt="" border="0"/>
                                        </a>
                                        <div id="dvShowAddStuff">
                                            <form  method="post" name="frmaddbetterstuff" id="frmaddbetterstuff" action="AddMyStuff.php" >
                                                <table class="table" width="100%">
                                                    <tr>
                                                        <td style="font-size:11px;font-weight: bold;">Stuff Title</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="txtStuffname" name="txtStuffname" size="20"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="right">
                                                           <?php
                                                           $CategoryDisplay = "<table style='font-size:10px;font-family: Verdana, Arial, Helvetica, sans-serif;' cellpadding='0' cellspacing='0' width='100%'>";
                                                           $CategoryDisplay.="<tr><td colspan='2'>
                                                                              <input type='checkbox' name='CheckAllCategory' id='CheckAllCategory' value='select/check all' onclick='CheckAllCategorySection()'/>select/check all
                                                                              </td></tr>";
                                                           for($i=0;$i<count($record);$i++)
                                                           {
                                                               $CategoryDisplay.="<tr bgcolor='white'>";
                                                               $CategoryDisplay.="<td width='10%'><input type='checkbox' name='chkcategorybetter[]' id='chkcategorybetter' value=" . $record[$i]['ID'] . " onclick='SingleUnChecked();'>";
                                                               $CategoryDisplay.="<input type='hidden' id='defaultcat' name='defaultcat' value='" . $record[0]['ID'] . "'></td>";
                                                               $CategoryDisplay.="<td>" . $record[$i]["Title"] . "</td></tr>";
                                                           }
                                                           $CategoryDisplay.="</table>";
                                                           echo $CategoryDisplay;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="right" colspan="2">                                                            
                                                            <input type="submit" name="submit" id="submit" value="is better"/>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                    <div id="dvIDontThink">
                                        <input type="image" src="../images/ICantDecide.jpg" onclick="PeopleDontLike();" style="width:250px;height:30px" value="Cant Decide? BookMark" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="dvStuffDescription">
                        <hr size='1' style='text-align: left;border-color: black;'/>
                        <div id="AddStuffDescription">
                            <label for="txtAddDescription"><b>Edit Description</b></label>
                            <div id="dvListOfDescription">
                                <?php
                                //This code is to Show total List of different version of Description of Stuff
                                    $objBo = new BoStuff();
                                    $objBo->setId($_SESSION['stuffid']);

                                    $objPlStuff=new PlStuff();
                                    $version=$objPlStuff->PlGetTotalDescriptionVersion($objBo); //Getting Total Count of Description of this Stuff
                                    $listofversion=$objPlStuff->PlGetListOfDescriptionIDs($objBo); //Getting ID from tblStuffDescription
                                    $version=$version[0]['Version'];
                                    $versionlist="";
                                    if(isset($version))
                                    {
                                        for($j=0,$i=1;$i<$version;$i++,$j++)
                                        {
                                            $versionlist.="<a style='text-decoration:none;outline:0' href='javascript:void(0)' onclick='LoadSelectedDescription(".$listofversion[$j]['ID'].")'>$i |</a>";
                                        }
                                    }
                                    $versionlist.="<a style='text-decoration:none;outline:0' href='javascript:void(0)' onclick='LoadSelectedDescription(".$listofversion[$j]['ID'].")'>current version</a>";
                                    echo $versionlist;

                                    /**/
                                    include_once '../FCKEditor/fckeditor.php';
                                    function nukeMagicQuotes()
                                    {
                                        if (get_magic_quotes_gpc ())
                                        {
                                            function stripslashes_deep($value)
                                            {
                                                $value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
                                                return $value;
                                            }

                                            $_POST = array_map('stripslashes_deep', $_POST);
                                            $_GET = array_map('stripslashes_deep', $_GET);
                                            $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
                                        }
                                    }
                                    /**/
                                ?>
                            </div>
                            <form name="frmAddDescription" method="post" action="AddDescription.php">
                                <table>
                                    <tr>
                                        <td id="txtAddDescription">
                                            <?php
                                                /*if(isset($StuffDescription[0]['Description']))
                                                    echo "<textarea name'txtAddDescription' id='txtAddDescription' cols='30' rows='10' >".$StuffDescription[0]['Description']."</textarea>";
                                                else
                                                    echo "<textarea name'txtAddDescription' id='txtAddDescription' cols='30' rows='10' ></textarea>";
                                                */
                                                nukeMagicQuotes();
                                                $oFCKeditor = new FCKeditor('AddDescription');
                                                if(isset($StuffDescription[0]['Description']))
                                                {

                                                    $oFCKeditor->Value = $StuffDescription[0]['Description'];
                                                }
                                                else
                                                    $oFCKeditor->Value = "";
                                                $oFCKeditor->Width = 295;
                                                $oFCKeditor->Height = 130;
                                                echo $oFCKeditor->CreateHtml();
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <!--<input type="button" value="Add Description" onclick="return AjaxAddDescription();"/>-->
                                            <input type="submit" value="Add Description">
                                            <input type="hidden" name="stuffid" value="<?php echo $stuffid; ?>">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <div id="dvFullDescription">
                            <?php
                                if(isset($StuffDescription[0]['Description']))
                                    echo $StuffDescription[0]['Description']."<br>";
                            ?>
                            <?php if(isset($_SESSION['membertype']) && ($_SESSION['membertype']=="A" || $_SESSION['membertype']=="T"))
                                  {                                        
                            ?>

                            <form name="frmHideUnhideDescription" method="post" action="HideDescriptionOrComment.php">
                                <!--<input type="submit" name="btnhide" value="Hide"/>-->
                                <input type="image" src="../images/Hide.png" style="width:80px;height:24px;" name="btnhide" value="Hide"/>
                                <input type="hidden" name="descriptionid" value="<?php echo $StuffDescription[0]['ID']; ?>">
                                <input type="hidden" name="stuffid" value="<?php echo $stuffid; ?>">
                                <input type="hidden" name="sensor" value="description">
                            </form>
                            <?php } ?>
                        </div>
                    </div>

                    <div id="dvAds2">
                        [Amazon Ads here]
                    </div>
                    <div style="clear: both"></div>
                    <div>
                        <br/>
                        <div id="dvMembersTitle">
                            &nbsp;&nbsp;&nbsp;Members that think This Stuff is the best!
                        </div>

                        <div id="dvMembersImage">
                            <?php
                                for($i=0;$i<count($MemberImageRecord);$i++)
                                {
                                    echo "<a style='text-decoration:none' href='../Member/Profile.php?id=".$MemberImageRecord[$i]['MemberID']."&member=".$MemberImageRecord[$i]['Nickname']."' title='".$MemberImageRecord[$i]['Nickname']."'>
                                        <img style='border-width:thin;border-color:black;' src='../Member/MemberImages/".$MemberImageRecord[$i]['ProfileImagePath']."' width=30px height=30px />
                                         </a>";
                                }
                            ?>
                        </div>
                    </div>
		    
                    <?php if($StuffStatus=='A') {?>
                    <div id="dvComments">
                        <div id="dvCommentsTitle">
                            &nbsp;&nbsp;&nbsp;Comments
                        </div>
                        <div>
                            <a href='javascript:void(0)' onclick='DisplayAddComment();'>
                                <img src="../images/AddComment.jpg" border="0" alt=""/>
                            </a>
                        </div>
                    </div>
                    <div style="clear: both"></div>
                    <!--<div id="dvAddComments" align="right">
                        <form name="frmAddComments" id="frmAddComments" method="Post" action="stuffcomment.php">
                            <table>
                                <tr>
                                    <td>
                                        <?php
                                                /*nukeMagicQuotes();
                                                $oFCKeditor = new FCKeditor('txtAddComment');
                                                $oFCKeditor->Width = 295;
                                                $oFCKeditor->Height = 130;
                                                echo $oFCKeditor->CreateHtml();*/
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="submit" name="submit" id="submit" value="Add Comment"/>
                                        <input type="hidden" name="stuffid" value="<?php echo $stuffid; ?>">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>-->
                    <?php } ?>
                    <div id="dvFullComments">
                        <?php
                            echo $output;
                        ?>
                    </div>
                </div>
                <div id="dvLeftColumn">
                    <div id="dvAds3">
                        Ads 3 Goes here
                    </div>
                    <span style='font-size: 1px;'>&nbsp;</span>
                    <div id="dvCategoryVotes">
                         <div id="dvCategotyVotesTitle">
                            &nbsp;&nbsp;Votes By Category
                         </div>
                        <!--<span style='font-size: 1px;'>&nbsp;</span>-->
                        <div style="clear: both"></div>
                        <div id="dvCategoryList">

                            <?php
                                if(isset($votesbycategory))
                                    echo $votesbycategory;
                            ?>

                        </div>
                    </div>
                    <br/>
                    <?php if($resultcount>10) { ?>
                    <div id="dvYouWouldAlsoLikeThis">
                        <div id="dvYouWouldAlsoLikeThisTitle">
                            &nbsp;&nbsp;You would also like this
                         </div>
                        <!--<span style='font-size: 1px;'>&nbsp;</span>-->
                        <div style="clear: both"></div>
                        <div id="dvYouWouldAlsoLikeThisCollage">
                            <?php
                                if(isset($YouwouldAlsoLikeCollage))
                                    echo $YouwouldAlsoLikeCollage;
                            ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!--Stuff Description Body completes here-->
            <span style='font-size: 1px;'>&nbsp;</span>
            <div style="clear: both"></div>
            <span style='font-size: 1px;'>&nbsp;</span>
        </div>
        <span style='font-size: 1px;'>&nbsp;</span>
        <div id='dvFooter' align="center">
	    <?php include_once('../footers.php'); ?>
        </div>
    </body>
</html>