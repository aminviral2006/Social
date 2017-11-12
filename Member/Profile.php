<?php
session_start();
set_time_limit(0);
if (!isset($_SESSION['member']))
    header("location:login.php");
include_once '../commoninclude.php';
/*Session Timeout*/
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600))
{
    // last request was more than 30 minates ago
    //session_destroy();   // destroy session data in storage
    //session_unset();     // unset $_SESSION variable for the runtime
    header("location:../logout.php");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
/*Ends here*/
$message = "";
$profileImage = "";
$aboutme="";
if (isset($_REQUEST['msg'])) {
    $message = "<span style='font-size: 1px;'>&nbsp;</span>";
    $message.="<div id='dvMessage'";
    $message.=" style='width: 100%;
                visibility: visible;
                display: block;
                text-align: right;
                padding: 4px;
                color:brown;
                font-family: verdana;
                font-size: 12px;
                background-color: #B8ADF1;'>";
    $message.= "Stuff added successfully.";
    $message.="</div><span style='font-size: 1px;'>&nbsp;</span>";
} else {
    $message = "<span style='font-size: 1px;'>&nbsp;</span>";
    $message.="<div id='dvMessage'";
    $message.=" style='width: 100%;
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
$objBoMemberProfile="";
if(isset($_SESSION['member']))
{
    //Business Object
    $objBoMemberProfile = new BoMemberProfile();
    if(isset($_REQUEST['id']))
        $objBoMemberProfile->setMemberId($_REQUEST['id']);
    else
        $objBoMemberProfile->setMemberId($_SESSION['memberid']);
    //Presentation Layer Object
    $objPlMember = new PlMemberProfile();
    $record = $objPlMember->PlGetMemberProfileDetails($objBoMemberProfile);
    $profileImage = isset($record[0]['ProfileImagePath']) ? addslashes('../Member/MemberImages/' . $record[0]['ProfileImagePath']) : addslashes('../Member/MemberImages/Default.jpg');
    $aboutme=isset($record[0]['About']) ? $record[0]['About'] : '';
}


/* Browsing Stuff Here */
if(!isset($_REQUEST['tag']))
    $_SESSION['tag']="All";
else
    $_SESSION['tag']=$_REQUEST['tag'];

$objPlBrowseStuff = new PlStuff();
$output = $objPlBrowseStuff->PlGetAllStuff($_SESSION['tag']);
/* Browsing Stuff Ends Here */

/* Display All Tags */
$objPlTag=new PlTags();
$alltagslist=$objPlTag->PlDisplayAllTags();
/* Ends here*/


//Members Info
$objPlMemberProfile=new PlMemberProfile();
$memberfinfo=$objPlMember->PlShowMemberInfoOnProfilePage($objBoMemberProfile);
//Ends here


//I am Friend Section
$objPlAddToFriends=new PlAddFriends();
$flag=0;
$sitecontrols="";
if(isset($_REQUEST['id']))
{
    $objBoProfileSiteControls=new BoMemberProfileSiteControls();
    $objBoProfileSiteControls->setMemberId($_REQUEST['id']);


    $objPlProfileSiteControls=new PlMemberProfileSiteControls();
    $sitecontrols=$objPlProfileSiteControls->PlShowMemberSiteControls($objBoProfileSiteControls);

    $flag=$objPlAddToFriends->PlIAmFriend($_SESSION['memberid'], $_REQUEST['id']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" lang="he" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title></title>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

        <!--Suggest Add New Stuff-->
        <link href="SuggestAddNewStuff/css/style.css" rel="stylesheet" type="text/css"/>
        <!--[if gte IE 6]>
            <link rel="stylesheet" type="text/css" href="css/i_hate_IE.css" />
        <![endif]-->
        <script type="text/javascript" language="JavaScript" src="SuggestAddNewStuff/js/jquery.js"></script>
        <script type="text/javascript" language="JavaScript" src="SuggestAddNewStuff/js/script.js"></script>

        <style type="text/css">

            body
            {
                background-color: #495863;
                font-family: Verdana, Arial, Helvetica, sans-serif;
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
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 13px;
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
                font-weight: bold;
                font-family: Verdana, Arial, Helvetica, sans-serif;
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
                right:130px;
                float: right;
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
                width: 982px;
                display: block;
                height: 90px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }

            #dvAd1
            {
                position: relative;
                float: left;
                top: 3px;
                left: 10px;
                width: 650px;
                border-width: thin;
                border-style: solid;
                display: block;
                height: 78px;
                background-image: url(../images/ad1.jpg);
                background-repeat: no-repeat;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }

            #dvBecameFriends
            {
                position: relative;
                float: right;
                top: 3px;
                right: 5px;
                width: 300px;
                /*border-width: thin;
                border-style: solid;*/
                display: block;
                height: 78px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                background-image: url(../images/becamefriends.jpg);
                text-align: center;
            }
            #dvBecameFriends a
            {
                text-decoration: none;
            }
            #dvMainContent
            {

                float: right;
                width: 982px;
                border-width: thin;
                border-style: solid;
                display: block;
                height: auto;
                text-align: right;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }

            #dvBrowseStuff
            {
                width: 680px;
                border-width: thin;
                border-style: solid;
                display: table;
                padding: 4px;
                height: auto;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            /*Profile Menus*/
            #dvProfileMenu
            {
                position: relative;
                /*float: left;*/
                right: 8px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvSubMenuProfile, #dvSubMenuStuff, #dvSubMenuComments, #dvSubMenuInbox
            {
                background-image: url(../images/ProfileMenu.jpg);
                background-repeat: no-repeat;
                height: 30px;
                width: 90px;
                float: right;
                padding-right: 1px;
                vertical-align: middle;
                font-weight: bold;
                color: #FFFFFF;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvSubMenuProfile a
            {
                color: #FFFFFF;
                text-decoration: none;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvSubMenuStuff a
            {
                color: #FFFFFF;
                text-decoration: none;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvSubMenuComments a
            {
                color: #FFFFFF;
                text-decoration: none;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvSubMenuInbox a
            {
                color: #FFFFFF;
                text-decoration: none;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            /*Ends Here*/
            /*Profile Title and Settings*/
            #dvProfileTitleAndSettings
            {
                position: relative;
                float: right;
                display: block;
                width: 965px;
                height: 20px;
                right: 5px;
                background-image: url(../images/ProfilePageTitle.jpg);
                background-repeat: no-repeat;
                height: 32px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvProfileTitle
            {
                position: relative;
                float: right;
                display: block;
                font-size: 14px;
                color: #3e1a0f;
                padding-right: 10px;
                padding-top: 3px;
                font-weight: bold;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvProfileSettings
            {
                position: relative;
                float: left;
                display: block;
                font-size: 14px;
                color: #3e1a0f;
                padding-left: 10px;
                padding-top: 3px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvProfileSettings a
            {
                /*color: #3e1a0f;*/
                text-decoration: none;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvProfileSettings a:hover
            {
                color: #3e1a0f;
                text-decoration: underline;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            /**/
            #dvLeftColumn
            {
                position: relative;
                top: 0px;
                width: 650px;
                left: 12px;
                float: left;
                /*border-width: thin;
                border-style: solid;*/
                display: block;
                height: auto;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvProfileDetailSection
            {
                position: relative;
                float: left;
                left: 4px;
                width: 640px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                /*border-width: thin;
                border-style: solid;*/
                display: table;
                height: auto;
                display: block;
            }
            #dvMemberCollageSection
            {
                /*border-width: thin;
                border-style: solid;*/
                height: 100px;
                display: block;
                background-color: #fef7ed;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvMemberCollageTitle
            {
                color: #3e1a0f;
                text-align: right;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvCollageStuffList
            {
                display: block;
                text-align: right;
                padding-right: 10px;
                text-align: right;
            }
            #dvCollageStuffList img
            {
                margin-left: 1px;
                margin-right: 1px;
                margin-bottom: 1px;
                margin-top: 1px;
                border: 1px solid #7096d3;
                padding: 1px;
            }
            #dvCollageStuffList a
            {
                text-decoration: none;
            }
            .collageimagetableborder
            {
                border-style: solid;
                table-layout: auto;
                max-width: 640px;
                max-height: 100px;
                border-collapse: collapse;
                border-spacing: 0;
                padding: 0;
                background-color: #233645;
                border-color: white;
                background-color: #FFFFFF;
                width:640px;
                height:100px;
                /*max-width: 870px;
                max-height: 380px;*/
            }
            #dvTagsList
            {
                position: relative;
                /*border-width: thin;
                border-style: solid;*/
                float: right;
                display: block;
                top: 2px;
                width: 310px;
                height: auto;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                /*background-color: #fef7ed;*/
            }
            #dvFriendAndCommentList
            {
                position: relative;
                top: 2px;
                float: left;
                left: 6px;
                /*border-width: thin;
                border-style: solid;*/
                display: block;
                width: 310px;
                height: auto;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvFriendList
            {
                position: relative;
                /*border-width: thin;
                border-style: solid;*/
                width: 310px;
                height: auto;
                text-align: right;
                padding: 2px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                /*background-color: #fef7ed;*/
            }
            #dvFriendListTitle
            {
                background-image: url(../images/MemberProfileStuffTitle.jpg);
                background-repeat: no-repeat;
                height: 32px;
                font-weight: bold;
                padding-right: 5px;
                padding-top: 5px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvFriendList img
            {
                /*border-style: groove;
                border-width: thin;
                border-color: #1c2e3c;*/
                padding: 1px;
                margin-left:5px;
                margin-right:2px;
                margin-top: 2px;
                margin-bottom: 2px;
                background-color: #f9c60b;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvFriendListAdd
            {
                font-weight: bold;
                text-align: center;
                background-color: #fef7ed;
                height: 20px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvFriendListAdd a
            {
                text-decoration: none;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvFriendListAdd a:hover
            {
                text-decoration: underline;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvCommentsList
            {
                position: relative;
                /*border-width: thin;
                border-style: solid;*/
                width: 310px;
                height: 50px;
                text-align: right;
                padding: 2px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                display: table;
                /*background-color: #fef7ed;*/
            }
            #dvCommentsListTitle
            {
                background-image: url(../images/MemberProfileStuffTitle.jpg);
                background-repeat: no-repeat;
                height: 32px;
                font-weight: bold;
                padding-right: 5px;
                padding-top: 5px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvCommentListAdd
            {
                font-weight: bold;
                text-align: center;
                background-color: #fef7ed;
                height: 20px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvCommentListAdd a
            {
                text-decoration: none;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvCommentListAdd a:hover
            {
                text-decoration: underline;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            /*Right Column Section */
            #dvRightColumn
            {
                position: relative;
                float: right;
                top: 0px;
                right:8px;
                width:300px;
                height: auto;
                display: block;
                background-color: #fef7ed;
                margin-left:auto;
                margin-right:auto;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvMemberInfoBottom
            {
                float: right;
                right:8px;
                height: 10px;
                background-image: url("../images/MemberInfoBottom.jpg");
                background-repeat: no-repeat;
                width: 300px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvProfileImage
            {
                position: relative;
                top: 2px;
                float: right;
                width: 130px;
                height: 130px;
                border-style: solid;
                border-width: thin;
                border-color:#1b4376;                
                background-repeat: no-repeat;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvAddToFriends
            {
                float: right;
            }
            /* Display Member Info*/
            #dvMemberInfo
            {
                position: relative;
                top: 2px;
                width: 290px;
                height: auto;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvMemberInfoTitle
            {
                height: 20px;
                text-align: right;
                color: black;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 14px;
                color: blueviolet;
                font-weight: bold;
                padding-right: 5px;
                padding-top: 6px;
            }
            #dvMemberProfileList
            {
                display: table;
                width: 270px;
                height: auto;
                text-align: right;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 12px;
            }
            .ProfileLabel
            {
                color: #b5b6b6;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            /* Ends here*/
            /*Related Category*/
            #dvMemberStats
            {
                position: relative;
                top: 2px;
                width: 290px;
                height: auto;
                border-color:#1b4376;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvMemberStatsTitle
            {
                height: 20px;
                text-align: right;
                color: blueviolet;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 14px;
                font-weight: bold;
                padding-right: 5px;
                padding-top: 6px;
            }
            #dvMemberStatsList
            {
                display: block;
                width: 270px;
                height: auto;
                text-align: right;
                font-family: arial;
                font-size: 12px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            /*Ends here*/
            /*About Me*/
            #dvAboutMeSection
            {
                position: relative;
                top: 2px;
                width: 290px;
                height: auto;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvAboutMeTitle
            {
                height: 20px;
                text-align: right;
                color: blueviolet;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 14px;
                font-weight: bold;
                padding-right: 5px;
                padding-top: 6px;
            }
            #dvAboutMeDetail
            {
                display: block;
                width: 270px;
                height: auto;
                text-align: right;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 12px;
                padding-bottom: 5px;
            }
            /*Ends here*/
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
                margin-left: 9.5%;
                margin-right: 9.5%;

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
            .table
            {
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 12px;
                /*border-style: solid;
                border-width: thin;*/
            }
            .smalltagname
            {
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 9px;
            }
            .background
            {
                background-color: #fef5ce;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
        </style>

        <style type="text/css">

        .borderit img{
        border: 2px solid #ccc;
        }

        .borderit:hover img{
        border: 2px solid #5dafdf;
        }

        .borderit:hover{
        color: red; /* irrelevant definition to overcome IE bug */
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
    </style>
    <!--CSS tooltips ends here-->

    <script type="text/javascript" src="jquery-1.2.2.pack.js"></script>
    <style type="text/css">

    div.htmltooltip{
    position: absolute; /*leave this and next 3 values alone*/
    z-index: 1000;
    left: 0px;
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
            var i=1;
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
                    document.getElementById("dvMessage").innerHTML="";
                document.getElementById("dvMessage").style.display="block";
                return true;
            }
            function DisplayAddStuff()
            {
                if(i==1)
                {
                    document.getElementById("dvAddStuff").style.visibility="visible";
                    document.getElementById("dvAddStuff").style.display="table";
                    i=0;
                }
                else
                {
                    document.getElementById("dvAddStuff").style.visibility="hidden";
                    document.getElementById("dvAddStuff").style.display="none";
                    i=1;
                }
            }
            function DisplayAddCategory()
            {
                if(i==1)
                {
                    document.getElementById("dvAddCategory").style.visibility="visible";
                    document.getElementById("dvAddCategory").style.display="table";
                    i=0;
                }
                else
                {
                    document.getElementById("dvAddCategory").style.visibility="hidden";
                    document.getElementById("dvAddCategory").style.display="none";
                    i=1;
                }
            }

            /*Ajax Script for voting its the best*/
            var xhr=null;

            function GetXMLHttp()
            {
                try
                {
                    xhr=new ActiveX("Microsoft.XMLHTTP");
                }
                catch(e)
                {
                    xhr=new XMLHttpRequest();
                }
                return xhr;
            }

            /*This function is used to Add friends list*/
            function AddToFriendsList()
            {
                var id=document.getElementById("friendid").value;
                url="AddtoFriendsList.php?friendid="+id;
                
                xhr=new GetXMLHttp();
                xhr.onreadystatechange=StateChanged;
                xhr.open('GET',url,true);
                xhr.send(null);
            }

            function StateChanged()
            {
                if(xhr.readyState==4)
                {
                    document.getElementById("dvAddToFriends").innerHTML=xhr.responseText;
                }
                else
                {
                    document.getElementById("dvAddFriendMessage").innerHTML="<img src='../images/008.gif' width='32px' height='32px' border='0'/>";
                }
            }
        </script>
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
                    messageObj.setSize(280,200);
                    messageObj.setShadowDivVisible(true);	// Enable shadow for these boxes
                    messageObj.display();
            }
            function displayStaticMessage(messageContent,cssClass)
            {
                    messageObj.setHtmlContent(messageContent);
                    messageObj.setSize(300,150);
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
    <body>
        <div id="dvMain" align="center">
            <div id="dvBanner">
                <div id="dvLogin">
                        <a href="../logout.php" title="Logout"> logout </a> |
                        <a href="Comments.php?profileid=<?php echo $_SESSION['memberid']."&member=".$_SESSION['member']; ?>" title="Comments"> comments </a>|
                        <a href="Stuffs.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnMemberStuffPage']; ?>&profileid=<?php echo $_SESSION['memberid']."&member=".$_SESSION['member']; ?>" title="Stuffs"> stuff </a> |
                        <a href="Profile.php?profileid=<?php echo $_SESSION['memberid']."&member=".$_SESSION['member']; ?>" title="Member Profile"><?php echo $_SESSION['member']; ?></a>
                        <div style="clear: both;"></div>
                </div>
                <div style="position: absolute;float:left;left: 875px;width: 105px;height: 120px;">
                        <a href="../index.php" style="outline: none;">
                        <img src="../images/hotspot.png" border="0" alt=""/>
                        </a>
                </div>
                <div style="clear: both;"></div>
                <div id="dvMenuStrip">
                    <div id='dvMenuContents'>
                        <a href="../index.php" title="HOME"><?php echo MENU_HOME; ?></a> <a href="../faq.php" title="FAQ"><?php echo FAQ; ?></a>
                    </div>
                    <div id="dvAddStuffButton">
                        <a href="#" onclick="DisplayAddStuff();"> <img id="btnAddStuff" name="btnAddStuff" src='../images/AddStuff.png' width='175px' height='24px' alt='' border="0"/></a>
                    </div>
                    <div id="dvBrowseStuffButton">
                        <a href="../Stuff/BrowseStuff.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnBrowseStuffPage']; ?>"><img id="btnBrowser" name="btnBrowse" src='../images/BrowseStuff.png' width='130px' height='24px' alt='' border="0"/></a>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>
            <span style='font-size: 1px;'>&nbsp;</span>
            <!--Add Stuff Section-->
            <div id="dvAddStuff"><span style='font-size: 1px;'>&nbsp;</span>
                <form action="../Stuff/AddMyStuff.php" method="POST" name="frmaddstuff" onsubmit="return StuffValid();">
                    <table class="table" align="Right" width="300px">
                        <tr>
                            <td colspan="2">Stuff Title:</td>
                        </tr>
                        <tr>
                            <td><!--<input type="text" id="txtStuffName" name="txtStuffname" size="40"/>-->
                                <div class="main">
                                    <div id="holder">
                                        <input type="text" id="txtStuffname" name="txtStuffname" tabindex="0" size="29" OnKeyPress="return disableEnterKey(event);"/>
                                        <img src="suggestaddnewstuff/images/loading.gif" id="loading" alt=""/> <input type="submit" name="submit" id="submit" value="Add"/>
                                    </div>
                                <div id="ajax_response_addnewstuff"></div>
                                </div>
                            </td>
                            <td align="left"></td>
                        </tr>
                    </table>
                </form>
                <div style="float: left;"><a href='#' onclick="DisplayAddStuff();">Close</a></div>
            </div>
            <!--Add Stuff Form ends here-->
            <!--Ads and Friends Section-->
            <div id="dvAdsAndMessage">
                <div id="dvAd1">
                    Ads goes here
                </div>
                <div id="dvBecameFriends">
                    &nbsp;
                    <?php
                    $objPlStuff=new PlStuff();
                    $LastFriends=$objPlStuff->PlLastFriend();
		    echo $LastFriends;
                    ?>
                </div>
            </div>
            <!--Ads and Message ends here-->
            <div style="clear: both;"></div>
            <div id="dvProfileMenu">
                <?php
                $profilelink="";
                $stufflink="";
                $commentlink="";
                    if(isset($_REQUEST['id']))
                    {
                        $profilelink="Profile.php?id=".$_REQUEST['id']."&member=".$_REQUEST['member'];
                        $stufflink="Stuffs.php?page=1&ipp=20&id=".$_REQUEST['id']."&member=".$_REQUEST['member'];
                        $commentlink="Comments.php?id=".$_REQUEST['id']."&member=".$_REQUEST['member'];
                    }
                    else
                    {
                        $profilelink="Profile.php?profileid=".$_SESSION['memberid']."&member=".$_SESSION['member'];
                        $stufflink="Stuffs.php?page=1&ipp=20&profileid=".$_SESSION['memberid']."&member=".$_SESSION['member'];
                        $commentlink="Comments.php?profileid=".$_SESSION['memberid']."&member=".$_SESSION['member'];
                    }
                ?>
                <div id="dvSubMenuProfile"><a href="<?php echo $profilelink;  ?>" title="Profile">Profile</a></div>
                <div id="dvSubMenuStuff"><a href="<?php echo $stufflink; ?>" title="Stuff">Stuff</a></div>
                <div id="dvSubMenuComments"><a href="<?php echo $commentlink; ?>" title="Comments">Comments</a></div>
                <?php
                    if(!isset($_REQUEST['id']) || ($_REQUEST['id']==$_SESSION['memberid']))
                        echo "<div id='dvSubMenuInbox'><a href='PrivateMessage.php?profileid=".$_SESSION['memberid']."' title='Inbox'>Inbox</a></div>";
                ?>
                
            </div>
            <div style="clear: both;"></div>
            <div id="dvProfileTitleAndSettings">
                <div id="dvProfileTitle">
                    <?php
                        if(isset($_REQUEST['id']))
                            echo $_REQUEST['member']."'s Profile";
                        else
                            echo $_SESSION['member']."'s Profile";
                    ?>
                </div>
                <?php
                    if(!isset($_REQUEST['id']) || ($_REQUEST['id']==$_SESSION['memberid']))
                    {
                        echo "<div id='dvProfileSettings'>";
                        echo "<a href='Settings.php?profileid=".$_SESSION['memberid']."&member=".$_SESSION['member']."'>Settings </a>";
                        echo "<a href='EditMemberProfile.php?profileid=".$_SESSION['memberid']."&member=".$_SESSION['member']."'>Edit Profile</a>";
                        echo "</div>";
                    }
                ?>
            </div>
            <div style="clear: both;"></div>
            <!---->
            <div id="dvLeftColumn">
                <div style="clear:both;"></div>
                <span style='font-size: 1px;'>&nbsp;</span>
                <!--Profile Detail Section-->
                <?php if($flag==1 || isset($_REQUEST['profileid']) || $_SESSION['membertype']=="A" || $_SESSION["membertype"]=="T" || $sitecontrols[0]['OFCSP']=="N") { ?>
                <div id="dvProfileDetailSection">
                    <div id="dvMemberCollageSection">
                        <div id="dvMemberCollageTitle"><?php echo isset($_REQUEST['member'])?$_REQUEST['member']."'s stuff": $_SESSION['member']."'s stuff"; ?></div>
                        <div id="dvCollageStuffList">
                            <?php
                                    $objPlTotalStuff=new PlStuff();
                                    $membersTotalStuff=$objPlTotalStuff->PlTotalStuffOfMember(isset($_REQUEST['profileid'])?$_REQUEST['profileid']:$_REQUEST['id']);

                                    if($membersTotalStuff>=0)
                                    {
                                        $collagememberid=0;
                                        if(isset($_REQUEST['profileid']))
                                            $collagememberid=$_REQUEST['profileid'];
                                        else
                                            $collagememberid=$_REQUEST['id'];
                                        $objPlStuff = new PlStuff();
                                        $membersCollage=$objPlStuff->PlShowCollageOnMemberProfile(34, $collagememberid);
                                        echo $membersCollage;                                   
                                    }
                                    else
                                    {
                                        echo "<h3 style='font-size:11px;color: #3e1a0f;font-family: Verdana, Arial, Helvetica, sans-serif;'>You need to add at least 40 items for your own personal collage. Keep going!</h3>";
                                    }
                            ?>
                        </div>
                    </div>
                    <div id="dvTagsList">
                        <?php
                            //Stuff Based on Tags Selected in Profile Controls in Setting Page
                            $objBoMemberProfileControls=new BoMemberProfileControls();
                            if(isset($_REQUEST['id']))
                                $objBoMemberProfileControls->setMemberId($_REQUEST['id']);
                            else
                                $objBoMemberProfileControls->setMemberId($_SESSION['memberid']);

                            $objProfileTags=new PlMemberProfileControls();
                            $tagsonhome=$objProfileTags->PlShowTagControlSettings($objBoMemberProfileControls);
                            $tagsonhome=explode("-",$tagsonhome[0]['TagsOnHome']);
                            
                            if(isset($tagsonhome) && count($tagsonhome)>0 && $tagsonhome[0]!="")
                            {
                                $objBoStuff=new BoStuff();
                                $objPlStuff=new PlStuff();
                                for($i=0;$i<count($tagsonhome);$i++)
                                {
                                    if(isset($_REQUEST['id']))
                                        $objBoStuff->setMemberId($_REQUEST['id']);
                                    else
                                        $objBoStuff->setMemberId($_SESSION['memberid']);
                                    $objBoStuff->setTagId($tagsonhome[$i]);
                                    $output=$objPlStuff->PlShowTagStuffOnMemberProfile($objBoStuff->getMemberId(), $objBoStuff->getTagId());
                                    if($output!="")
                                    {
                                        echo $output;
                                        echo "<br/>";
                                    }
                                    else
                                    {
                                        $objBoTag=new BoTags();
                                        $objBoTag->setId($tagsonhome[$i]);
                                        $objPlTag=new PlTags();
                                        $taglist=$objPlTag->PlGetTagDetail($objBoTag);
                                        $output="<table dir='rtl' class='table' width='100%' cellpadding='4px' cellspacing='0'>";
                                        $output.="<tr><th colspan='2' align='right' style='background-image:url(../images/MemberProfileStuffTitle.jpg);background-repeat:no-repeat;height:32px;'>".$taglist[0]["TagName"]."</th></tr>";
                                        $output.="<tr><td colspan='2' align='center'>Click here to add stuff</td></tr>";
                                        $output.="</table>";
                                        echo $output;
                                    }
                                }
                            }
                            else
                            {
                                $output="<table dir='rtl' class='table' width='100%' cellpadding='4px' cellspacing='0'>";
                                $output.="<tr><th colspan='2' align='right' style='background-image:url(../images/MemberProfileStuffTitle.jpg);background-repeat:no-repeat;height:32px;'>Add Tag List</th></tr>";
                                $output.="<tr><td colspan='2'>Please select the tags whome stuff you want to show on Profile Page.</td></tr>";
                                $output.="</table>";
                                echo $output;
                            }
                        ?>
                    </div>
                    <div id="dvFriendAndCommentList">
                        <div id="dvFriendList">
                            <div id="dvFriendListTitle">
                                Friends
                            </div>
                            <?php
                                $objBoFriend=new BoAddFriends();
                                if(isset($_REQUEST['id']))
                                    $objBoFriend->setMemberId($_REQUEST['id']);
                                else
                                    $objBoFriend->setMemberId($_SESSION['memberid']);
                                
                                $objPlFriend=new PlAddFriends();
                                $rows=$objPlFriend->PlGetFriendsList($objBoFriend);
                                if(count($rows)>0)
                                {
                                    echo $objPlFriend->PlShowFriendsOnProfile($rows);
                                }
                            ?>
                            <div id="dvFriendListAdd">
                                <?php
                                    if(isset($_REQUEST['profileid']) || (isset($_REQUEST['id']) && $_REQUEST['id']==$_SESSION['memberid']))
                                        echo "<a href='AddFriend.php?id=".$_SESSION['memberid']."&member=".$_SESSION['member']."'>Click</a> here to add friends";
                                ?>
                            </div>
                        </div>
                        <span style='font-size: 1px;'>&nbsp;</span>
                        <div id="dvCommentsList">
                            <div id="dvCommentsListTitle">
                                Comments List
                            </div>
                            <?php
                                $objBoComment=new BoMemberComment();
                                if(isset($_REQUEST['profileid']))
                                    $objBoComment->setFriendID($_REQUEST['profileid']);
                                else if(isset($_REQUEST['id']))
                                    $objBoComment->setFriendID($_REQUEST['id']);
                                
                                $objPlComment=new PlMemberComment();
                                $output=$objPlComment->PlDisplayCommentOnHome($objBoComment);
                                echo $output;
                            ?>
                            <div id="dvCommentListAdd">
                                <?php
                                    if(isset($_REQUEST['profileid']))
                                        echo "Leave <a href='Comments.php?id=".$_SESSION['memberid']."&member=".$_SESSION['member']."'>Comment</a>";
                                    if(isset($_REQUEST['id']) && $_REQUEST['id']==$_SESSION['memberid'])
                                        echo "Leave <a href='Comments.php?id=".$_SESSION['memberid']."&member=".$_SESSION['member']."'>Comment</a>";
                                    else if(isset($_REQUEST['id']))
                                        echo "Leave <a href='Comments.php?id=".$_REQUEST['id']."&member=".$_REQUEST['member']."'>Comment</a>";
                                    //else if($_SESSION['memberid']==$_REQUEST['profileid'])
                                      //  echo "Leave<a href='Comments.php?id=".$_SESSION['memberid']."&member=".$_SESSION['member'].">Comment</a>";
                                ?>      
                            </div>
                        </div>
                    </div>
                    <div style="clear:right;"></div>
                </div>
                <?php } 
                else{
                 ?>
                <div id="dvProfileDetailSection">
                    <h1>
                        This member has requested Private Profile. <br/>
                        If you want to see member's profile, Add him/her as a Friend.
                    </h1>
                    <!--<div id="dvMemberCollageSection">
                        <div id="dvMemberCollageTitle"><?php echo isset($_REQUEST['member'])?$_REQUEST['member']."'s stuff": $_SESSION['member']."'s stuff"; ?></div>
                        <div id="dvCollageStuffList">Collage Stuff List</div>
                    </div>
                    <div id="dvTagsList">
                        <?php
                            //Stuff Based on Tags Selected in Profile Controls in Setting Page
                            $objBoMemberProfileControls=new BoMemberProfileControls();
                            if(isset($_REQUEST['id']))
                                $objBoMemberProfileControls->setMemberId($_REQUEST['id']);
                            else
                                $objBoMemberProfileControls->setMemberId($_SESSION['memberid']);

                            $objProfileTags=new PlMemberProfileControls();
                            $tagsonhome=$objProfileTags->PlShowTagControlSettings($objBoMemberProfileControls);
                            $tagsonhome=explode("-",$tagsonhome[0]['TagsOnHome']);

                            if(isset($tagsonhome) && count($tagsonhome)>0 && $tagsonhome[0]!="")
                            {
                                $objBoStuff=new BoStuff();
                                $objPlStuff=new PlStuff();
                                for($i=0;$i<count($tagsonhome);$i++)
                                {
                                    if(isset($_REQUEST['id']))
                                        $objBoStuff->setMemberId($_REQUEST['id']);
                                    else
                                        $objBoStuff->setMemberId($_SESSION['memberid']);
                                    $objBoStuff->setTagId($tagsonhome[$i]);
                                    $output=$objPlStuff->PlShowTagStuffOnMemberProfile($objBoStuff->getMemberId(), $objBoStuff->getTagId());
                                    if($output!="")
                                    {
                                        echo $output;
                                        echo "<br/>";
                                    }
                                    else
                                    {
                                        $objBoTag=new BoTags();
                                        $objBoTag->setId($tagsonhome[$i]);
                                        $objPlTag=new PlTags();
                                        $taglist=$objPlTag->PlGetTagDetail($objBoTag);
                                        $output="<table dir='rtl' class='table' width='100%' cellpadding='4px' cellspacing='0'>";
                                        $output.="<tr><th colspan='2' align='right' style='background-image:url(../images/MemberProfileStuffTitle.jpg);background-repeat:no-repeat;height:32px;'>".$taglist[0]["TagName"]."</th></tr>";
                                        $output.="<tr><td colspan='2' align='center'>Click here to add stuff</td></tr>";
                                        $output.="</table>";
                                        echo $output;
                                    }
                                }
                            }
                            else
                            {
                                $output="<table dir='rtl' class='table' width='100%' cellpadding='4px' cellspacing='0'>";
                                $output.="<tr><th colspan='2' align='right' style='background-image:url(../images/MemberProfileStuffTitle.jpg);background-repeat:no-repeat;height:32px;'>Add Tag List</th></tr>";
                                $output.="<tr><td colspan='2'>Please select the tags whome stuff you want to show on Profile Page.</td></tr>";
                                $output.="</table>";
                                echo $output;
                            }
                        ?>
                    </div>-->
                    <div id="dvFriendAndCommentList">
                        <div id="dvFriendList">
                            <!--<div id="dvFriendListTitle">
                                Friends
                            </div>
                            <?php
                                $objBoFriend=new BoAddFriends();
                                if(isset($_REQUEST['id']))
                                    $objBoFriend->setMemberId($_REQUEST['id']);
                                else
                                    $objBoFriend->setMemberId($_SESSION['memberid']);

                                $objPlFriend=new PlAddFriends();
                                $rows=$objPlFriend->PlGetFriendsList($objBoFriend);
                                if(count($rows)>0)
                                {
                                    echo $objPlFriend->PlShowFriendsOnProfile($rows);
                                }
                            ?>
                            <div id="dvFriendListAdd">
                                <?php
                                    if(isset($_REQUEST['profileid']) || (isset($_REQUEST['id']) && $_REQUEST['id']==$_SESSION['memberid']))
                                        echo "<a href='AddFriend.php?id=".$_SESSION['memberid']."&member=".$_SESSION['member']."'>Click</a> here to add friends";
                                ?>
                            </div>-->
                        </div>
                        <span style='font-size: 1px;'>&nbsp;</span>
                        <div id="dvCommentsList">
                            <!--<div id="dvCommentsListTitle">
                                Comments List
                            </div>
                            <?php
                                $objBoComment=new BoMemberComment();
                                if(isset($_REQUEST['profileid']))
                                    $objBoComment->setFriendID($_REQUEST['profileid']);
                                else if(isset($_REQUEST['id']))
                                    $objBoComment->setFriendID($_REQUEST['id']);

                                $objPlComment=new PlMemberComment();
                                $output=$objPlComment->PlDisplayCommentOnHome($objBoComment);
                                echo $output;
                            ?>
                            <div id="dvCommentListAdd">
                                <?php
                                    if(isset($_REQUEST['profileid']))
                                        echo "Leave <a href='Comments.php?id=".$_SESSION['memberid']."&member=".$_SESSION['member']."'>Comment</a>";
                                    if(isset($_REQUEST['id']) && $_REQUEST['id']==$_SESSION['memberid'])
                                        echo "Leave <a href='Comments.php?id=".$_SESSION['memberid']."&member=".$_SESSION['member']."'>Comment</a>";
                                    else if(isset($_REQUEST['id']))
                                        echo "Leave <a href='Comments.php?id=".$_REQUEST['id']."&member=".$_REQUEST['member']."'>Comment</a>";
                                    //else if($_SESSION['memberid']==$_REQUEST['profileid'])
                                      //  echo "Leave<a href='Comments.php?id=".$_SESSION['memberid']."&member=".$_SESSION['member'].">Comment</a>";
                                ?>
                            </div>-->
                        </div>
                    </div> 
                    <div style="clear:right;"></div>
                </div>
                <?php } ?>
                <div style="clear:right;"></div>
<!--                <div id="dvBottomPaging">
                    Bottom Paging
                </div>-->
                <font color="white">fjsdl</font>
            </div>
            <!--Ads and Related Category Left Column-->
            <div id="dvRightColumn">
                <div id="dvProfileImage">
                    <?php
                        echo "<img src='" . $profileImage . "' width='128px' height='128px' style='border-style:solid;border-width: thin; padding: 1px' alt='Image Not found'/>";
                    ?>
                    <!--<a href="#" onclick="displayMessage('includes/demo-modal-message-1.php?member=<?php echo $_REQUEST['member']; ?>');return false">Send Message</a><br>-->
                </div>
                <div style="clear:right;"></div>
                <br/>
                <span style='font-size: 1px;'>&nbsp;</span>
                <div id="dvAddToFriends">
                    <?php
                        //$objPlAddToFriends=new PlAddFriends();
                        if(isset($_REQUEST['id']) && $_SESSION['memberid']!=$_REQUEST['id'])
                        {
                            //$flag=$objPlAddToFriends->PlIAmFriend($_SESSION['memberid'], $_REQUEST['id']);
                            if($flag==1)
                                echo "<img src='../images/IAmFriend.jpg'/>";
                            else
                                echo "<input type='image' src='../images/AddFriend.jpg' id='btnaddtofriends' name='btnaddtofriends' value='Add to Friend' onclick='AddToFriendsList()'/>";

                        
                            $objPlPendingFriend=new PlAddFriends();
                            $pending=$objPlPendingFriend->PlIfFriendIsPending($_SESSION['memberid'],$_REQUEST['id']);

                            if($pending==1)
                                echo "<img src='../images/PendingFriendRequest.jpg' />";                            

                            echo "<br><a style='text-decoration:none;' href='#' onclick=\"displayMessage('includes/demo-modal-message-1.php?id=".$_REQUEST["id"]."&member=".$_REQUEST["member"]."');return false\">Send Message</a><br>";
                        }
                    ?>
                    <div id="dvAddFriendMessage"></div>
                    <input type="hidden" id="friendid" name="friendid" value="<?php if(isset($_REQUEST['id'])) echo $_REQUEST['id']; else echo "0"; ?>"/>
                </div>
                <div style="clear:right;"></div>
                <span style='font-size: 1px;'>&nbsp;</span>
                <div id="dvMemberInfo">
                    <div id="dvMemberInfoTitle">
                        Member Info
                    </div>
                    <div id="dvMemberProfileList">
                        <?php echo $memberfinfo; ?>
                    </div>
                </div>
                <span style='font-size: 1px;'>&nbsp;</span>
                <span style='font-size: 1px;'>&nbsp;</span>
                <div id="dvMemberStats">
                    <div id="dvMemberStatsTitle">
                        Member Stats
                    </div>
                    <div id="dvMemberStatsList">
                        <table>
                            <tr>
                                <td><span class="ProfileLabel">Member Since:</span>
                                <?php
                                    $objPlMemberSince=new PlMemberRegistration();
                                    echo $objPlMemberSince->PlMemberSince(isset($_REQUEST['profileid'])?$_REQUEST['profileid']:$_REQUEST['id']);
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="ProfileLabel">Stuff Created:</span>
                                <?php
                                    $objPlStuffCreated=new PlStuff();
                                    echo $objPlStuffCreated->PlStuffCreatedByMember(isset($_REQUEST['profileid'])?$_REQUEST['profileid']:$_REQUEST['id']);
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="ProfileLabel">Total Stuff:</span>
                                <?php
                                    $objPlTotalStuff=new PlStuff();
                                    echo $objPlTotalStuff->PlTotalStuffOfMember(isset($_REQUEST['profileid'])?$_REQUEST['profileid']:$_REQUEST['id']);
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="ProfileLabel">Bookmarks:</span>
                                <?php
                                    $objPlTotalBookmarkedStuff=new PlStuff();
                                    echo $objPlTotalBookmarkedStuff->PlTotalBookmarkedStuffOfMember(isset($_REQUEST['profileid'])?$_REQUEST['profileid']:$_REQUEST['id']);
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="ProfileLabel">Comments in Profile:</span>
                                <?php
                                    $objPlCommentsInProfile=new PlMemberComment();
                                    echo $objPlCommentsInProfile->PlCommentsInProfile(isset($_REQUEST['profileid'])?$_REQUEST['profileid']:$_REQUEST['id']);
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="ProfileLabel">Comments Made:</span>
                                <?php
                                    $objPlCommentsMade=new PlMemberComment();
                                    echo $objPlCommentsMade->PlCommentsMade(isset($_REQUEST['profileid'])?$_REQUEST['profileid']:$_REQUEST['id']);
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="ProfileLabel">Friends:</span>
                                <?php
                                    $objPlFriends=new PlAddFriends();
                                    echo $objPlFriend->PlTotalFriendsOfMember(isset($_REQUEST['profileid'])?$_REQUEST['profileid']:$_REQUEST['id']);
                                ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <span style='font-size: 1px;'>&nbsp;</span>
                <span style='font-size: 1px;'>&nbsp;</span>
                <div id="dvAboutMeSection">
                    <div id="dvAboutMeTitle">
                        About Me
                    </div>
                    <div id="dvAboutMeDetail">
                        <?php
                            echo trim($aboutme);
                        ?>
                    </div>                    
                </div>
                <div style="clear: both;"></div>
                <div id="dvMemberInfoBottom"></div>
            </div>
            <div style="clear: both;"></div>
            <!--Left Column ends here-->
        </div><!--Main Div ends here-->
        <span style='font-size: 1px;'>&nbsp;</span>
        <div id='dvFooter' align="center">
            
            <!--<a href="#">home |</a> <a href="#">faq |</a>
            <a href="#">privacy policy |</a> <a href="#">term and conditions |</a>
            <a href="#">contact us |</a> <a href="#">rss feed |</a> <a href="#">bookmark this page</a><br/>
            Copyright &copy;2010 Avigabso. Designed & Developed by <a href="http://themacrosoft.com">Macrosoft Solutions</a>-->
	    <?php include_once '../footers.php' ?>
        </div>
    </body>
</html>
