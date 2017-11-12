<?php
session_start();
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
//Setting Pagination Limit
$_SESSION['currentpagelimit']= $_SESSION['TotalRecordsOnMemberStuffPage'];

/* Browsing Stuff Here */
if(!isset($_REQUEST['tag']))
    $_SESSION['tag']="All";
else
    $_SESSION['tag']=$_REQUEST['tag'];

if(isset($_REQUEST['filter'])) $filter=$_REQUEST['filter'];
else $filter="";

$pages = new Paginator();
$objPlBrowseStuff = new PlStuff();
$num_rows=0;
if(isset($_REQUEST['id']))
    $num_rows=$objPlBrowseStuff->PlGetAllMemberStuffTotal($_REQUEST['id'],$_SESSION['tag'], $filter);
else
    $num_rows=$objPlBrowseStuff->PlGetAllMemberStuffTotal($_SESSION['memberid'],$_SESSION['tag'], $filter);
if($num_rows>0)
{
    $pages->items_total = $num_rows;
    $pages->paginate();
}
$limit=$pages->limit;


if(isset($_REQUEST['id']))
    $output = $objPlBrowseStuff->PlGetAllMemberStuff($_REQUEST['id'],$limit,$_SESSION['tag'],$filter);
else
    $output = $objPlBrowseStuff->PlGetAllMemberStuff($_SESSION['memberid'],$limit,$_SESSION['tag'],$filter);
/* Browsing Stuff Ends Here */

/* Display All Tags */
$objPlTag=new PlTags();
$alltagslist=$objPlTag->PlDisplayAllTagsOnMemberStuffPage();
/* Ends here*/

//I am Friend Section
$objPlAddToFriends=new PlAddFriends();
$flag=0;
if(isset($_REQUEST['id']))
{
    $objBoProfileSiteControls=new BoMemberProfileSiteControls();
    $objBoProfileSiteControls->setMemberId($_REQUEST['id']);


    $objPlProfileSiteControls=new PlMemberProfileSiteControls();
    $sitecontrols=$objPlProfileSiteControls->PlShowMemberSiteControls($objBoProfileSiteControls);

    $flag=$objPlAddToFriends->PlIAmFriend($_SESSION['memberid'], $_REQUEST['id']);
    if($_SESSION['membertype']=="A" || $_SESSION['membertype']=="T");

    else if($flag==0 && $sitecontrols[0]['OFCSP']=="Y")
    {
        header("location:Profile.php?id=".$_REQUEST['id']."&member=".$_REQUEST['member']);
    }
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
                margin-left: auto;
                margin-right: auto;
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
                text-align: right;
                color: black;
                display: block;
                font-size: 15px;
                font-weight: bold;
                font-family: Verdana, Arial, Helvetica, sans-serif;
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
                width: 750px;
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
                left:2px;
                width: 745px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                /*border-width: thin;
                border-style: solid;*/
                display: table;
                height: auto;
                display: block;
            }
            #dvStuffDetailSection
            {
                /*border-width: thin;
                border-style: solid;*/
                position: relative;
                top: 0px;
                height: 25px;
                display: block;
                background-color: #fef7ed;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvSort
            {
                position: relative;
                float: right;
                color: #3e1a0f;
                width: 330px;
                height: auto;
                /*border-width: thin;
                border-style: solid;*/
                text-align: right;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                padding-right: 5px;
            }
            #dvSort a
            {
                text-decoration: none;
            }
            #dvFilter
            {
                position: relative;
                float: right;
                width: 140px;
                height: auto;
                right: 3px;
                /*border-width: thin;
                border-style: solid;*/
                color: #3e1a0f;
                text-align: right;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvFilter a
            {
                text-decoration: none;
            }
            #dvTopPaging
            {
                position: relative;
                float: right;
                width: 268px;
                display: block;
                height: auto;
                text-align: left;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            /*Right Column Section */
            #dvRightColumn
            {
                position: relative;
                float: right;
                top: -1px;
                background-color: #f4d4a6;
                right: 5px;
                width:210px;
                height: auto;
                display: block;
                margin-left:auto;
                margin-right:auto;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvAllStuffs
            {
                position: relative;
                width: 200px;
                background-color: transparent;
                display: block;
                text-align: right;
                font-weight: bold;                
                font-family: Verdana, Arial, Helvetica, sans-serif;
                right: -5px;
                
            }
            #dvLists
            {
                display: block;
                position: relative;
                background-color: #fef7ed;
                font-weight: bold;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                height: 30px;
                padding-right: 5px;
                vertical-align: middle;
                
            }
            #dvStuffs
            { 
                display: table;
                position: relative;
                background-color: #f4d4a6;
                font-weight: bold;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                height: 30px;
                top: 2px;
                padding-right: 5px;
                vertical-align: middle;
                padding-top: 2px;
            }
            #dvStuffs a
            {
                text-decoration: none;
            }
            #dvStuffsTitle
            {
                height: 30px;
            }
            #dvStuffsList
            {
                background-color: #fffaf2;
                width:194px;
                height: auto;
                font-weight: normal;
                display: inline-block;
                z-index: 1000;
            }
            #dvStuffsList a
            {
                text-decoration: none;
            }
            #dvBookmarks
            {
                display: block;
                position: relative;
                background-color: #fef7ed;
                font-weight: bold;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                height: 30px;
                top: 5px;
                padding-right: 5px;
                vertical-align: middle;
                padding-top: 2px;
            }
            #dvBookmarks a
            {
                text-decoration: none;
            }
            #dvFriendsStuffs
            {
                display: block;
                position: relative;
                background-color: #fef7ed;
                font-weight: bold;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                height: 30px;
                top: 8px;
                padding-right: 5px;
                vertical-align: middle;
                bottom: -5px;
                padding-top: 2px;
            }
            #dvFriendsStuffs a
            {
                text-decoration: none;
            }
            #dvMemberStuffBottom
            {
                float: right;
                right:8px;
                height: 10px;
                background-image: url("../images/MemberStuffBottom.jpg");
                background-repeat: no-repeat;
                width: 210px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            .ProfileLabel
            {
                color: #b5b6b6;
                font-family: Verdana, Arial, Helvetica, sans-serif;
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
                margin-left: auto;
                margin-right: auto;

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
            .stuffimageborder
            {
                border-style: solid;
                border-width: thin;
                padding: 2px;
            }
            .background
            {
                background-color: #fef5ce;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
        </style>

        <!--Paging-->
        <style type="text/css">
        .paginate {
                font-family: Arial, Helvetica, sans-serif;
                font-size: .7em;
        }

        a.paginate {
                border: 1px solid #000080;
                padding: 2px 6px 2px 6px;
                text-decoration: none;
                color: #000080;
        }


        a.paginate:hover {
                background-color: #000080;
                color: #FFF;
                text-decoration: underline;
        }

        a.current {
                border: 1px solid #000080;
                font: bold .7em Arial,Helvetica,sans-serif;
                padding: 2px 6px 2px 6px;
                cursor: default;
                background:#000080;
                color: #FFF;
                text-decoration: none;
        }

        span.inactive {
                border: 1px solid #999;
                font-family: Arial, Helvetica, sans-serif;
                font-size: .7em;
                padding: 2px 6px 2px 6px;
                color: #999;
                cursor: default;
        }

        /*table {
                margin: 8px;
        }

        th {
                font-family: Arial, Helvetica, sans-serif;
                font-size: .7em;
                background: #666;
                color: #FFF;
                padding: 2px 6px;
                border-collapse: separate;
                border: 1px solid #000;
        }

        td {
                font-family: Arial, Helvetica, sans-serif;
                font-size: .7em;
                border: 1px solid #DDD;
        }*/
        </style>
        <script type="text/javascript" language="JavaScript">
        function hilite(elem)
        {
                elem.style.background = '#FFC';
        }

        function lowlite(elem)
        {
                elem.style.background = '';
        }
        </script>
        <!--Paging-->


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
        </script>

        <script type="text/javascript" language="javascript">
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
                    <a href="Comments.php?profileid=<?php echo $_SESSION['memberid']; ?>&member=<?php echo $_SESSION['member']; ?>" title="Comments"> comments </a>|
                    <a href="Stuffs.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnMemberStuffPage']; ?>&profileid=<?php echo $_SESSION['memberid']; ?>&member=<?php echo $_SESSION['member']; ?>" title="Stuffs"> stuff </a> |
                    <a href="Profile.php?profileid=<?php echo $_SESSION['memberid']; ?>&member=<?php echo $_SESSION['member']; ?>" title="Member Profile"><?php echo $_SESSION['member']; ?></a>
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
                    /*$objPlLastFriend=new PlStuff();
                    $LastFriends=$objPlLastFriend->PlLastFriend();
                    if(isset($LastFriends))
                    {
                        echo "<a href='../Member/Profile.php?id=".$LastFriends[0][0]['ID']."&member=".$LastFriends[0][0]['NickName']."'><img src='../Member/MemberImages/".$LastFriends[0][0]['ProfileImagePath']."' style='width:12px;height:12px;border:1px;' alt=''/> ".$LastFriends[0][0]['NickName']."</a> and <br/>";
                        echo "<a href='../Member/Profile.php?id=".$LastFriends[1][0]['ID']."&member=".$LastFriends[1][0]['NickName']."'><img src='../Member/MemberImages/".$LastFriends[1][0]['ProfileImagePath']."' style='width:12px;height:12px;border:1px;' alt=''/> ".$LastFriends[1][0]['NickName']."</a> are now Friends";
                    }*/
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
                        $stufflink="Stuffs.php?page=1&ipp=".$_SESSION['TotalRecordsOnMemberStuffPage']."&id=".$_REQUEST['id']."&member=".$_REQUEST['member'];
                        $commentlink="Comments.php?id=".$_REQUEST['id']."&member=".$_REQUEST['member'];
                    }
                    else
                    {
                        $profilelink="Profile.php?profileid=".$_SESSION['memberid']."&member=".$_SESSION['member'];
                        $stufflink="Stuffs.php?page=1&ipp=".$_SESSION['TotalRecordsOnMemberStuffPage']."&profileid=".$_SESSION['memberid']."&member=".$_SESSION['member'];
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
            </div>
            <div style="clear: both;"></div>
            <!---->
            <div id="dvLeftColumn">
                <div style="clear:both;"></div>
                <span style='font-size: 1px;'>&nbsp;</span>
                <!--Profile Detail Section-->
                <div id="dvProfileDetailSection">
                    <div id="dvStuffDetailSection">
                        <div id="dvSort">
                            <?php
                                if(isset($_REQUEST['id']))
                                    $defaulttag="id=".$_REQUEST['id']."&member=".$_REQUEST['member']."&tag=".$_SESSION['tag'];
                                else
                                    $defaulttag="id=".$_REQUEST['profileid']."&member=".$_REQUEST['member']."&tag=".$_SESSION['tag'];
                            ?>
                            <a href="Stuffs.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnMemberStuffPage']; ?>&<?php echo $defaulttag; ?>&filter=active discussion">Active Discussion</a>
                            <a href="Stuffs.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnMemberStuffPage']; ?>&<?php echo $defaulttag; ?>&filter=active discussion">Popularity</a>
                            <a href="#">Rating</a>
                            <a href="Stuffs.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnMemberStuffPage']; ?>&<?php echo $defaulttag; ?>">Added</a>
                            :Sort
                        </div>
                        <div id="dvFilter">
                            <a href="Stuffs.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnMemberStuffPage']; ?>&<?php echo $defaulttag; ?>&filter=created">Created</a>
                            <a href="Stuffs.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnMemberStuffPage']; ?>&<?php echo $defaulttag; ?>">None</a>
                            :Filter
                        </div>
                        <div id="dvTopPaging">
                            <?php
                                if($num_rows>0)
                                {
                                    echo $pages->display_pages();
                                }
                            ?>
                        </div>
                    </div>
                    <div style="clear:right;"></div>
                    <div id="dvMemberStuffs">
                        <?php
                            echo $output;
                        ?>
                    </div>
                </div>
                <div style="clear:right;"></div>
                <font color="white" size="1">fjsdl</font>
            </div>
            <!--Ads and Related Category Left Column-->
            <div id="dvRightColumn">
                <div style="clear:right;"></div>                
                <div id="dvAllStuffs">
                    <div id="dvLists">
                        Lists
                    </div>
                    <div id="dvStuffs">
                        <div id="dvStuffsTitle">
                            <?php
                                if(isset($_REQUEST['profileid']))
                                    echo "<a href='Stuffs.php?page=1&ipp=".$_SESSION['TotalRecordsOnMemberStuffPage']."&profileid=".$_REQUEST['profileid']."&member=".$_REQUEST['member']."&tag=All'>Stuffs</a>";
                                else
                                    echo "<a href='Stuffs.php?page=1&ipp=".$_SESSION['TotalRecordsOnMemberStuffPage']."&id=".$_REQUEST['id']."&member=".$_REQUEST['member']."&tag=All'>Stuffs</a>";
                            ?>
                        </div>
                        <div id="dvStuffsList">
                            <?php
                                if(isset($alltagslist))
                                    echo $alltagslist;
                            ?>
                        </div>
                    </div>
                    <div id="dvBookmarks">
                        <div id="dvBookmarksTitle">
                            <?php
                                if(isset($_REQUEST['profileid']))
                                    echo "<a href='Bookmarks.php?page=1&ipp=".$_SESSION['TotalRecordsOnMemberStuffPage']."&profileid=".$_REQUEST['profileid']."&member=".$_REQUEST['member']."&tag=All'>Bookmarks</a>";
                                else
                                    echo "<a href='Bookmarks.php?page=1&ipp=".$_SESSION['TotalRecordsOnMemberStuffPage']."&id=".$_REQUEST['id']."&member=".$_REQUEST['member']."&tag=All'>Bookmarks</a>";
                            ?>
                        </div>
                        <div id="dvBookmarksList"></div>
                    </div>
                    <div id="dvFriendsStuffs">
                        <div id="dvFriendsTitle">
                            <?php
                                if(isset($_REQUEST['profileid']))
                                    echo "<a href='FriendsStuff.php?page=1&ipp=".$_SESSION['TotalRecordsOnMemberStuffPage']."&profileid=".$_REQUEST['profileid']."&member=".$_REQUEST['member']."&tag=All'>Friend's Stuff</a>";
                                else
                                    echo "<a href='FriendsStuff.php?page=1&ipp=".$_SESSION['TotalRecordsOnMemberStuffPage']."&id=".$_REQUEST['id']."&member=".$_REQUEST['member']."&tag=All'>Friend's Stuff</a>";
                            ?>
                        </div>
                        <div id="dvFriendsList"></div>
                    </div>
                    <div style="clear: both;"></div>
                </div>                          
                <div style="clear: both;"></div>
                <div id="dvMemberStuffBottom"></div>
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
