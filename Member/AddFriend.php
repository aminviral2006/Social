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
$msg="";
$message = "";
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
if(isset($_REQUEST['submit']))
{
    $objBoMember=new BoMemberRegistration();
    $objBoMember->setId("NULL");
    $objBoMember->setNickname($_REQUEST['txtfriendname']);

    $objPlMember=new PlMemberRegistration();
    $memberdetail=$objPlMember->PlGetMemberDetails($objBoMember);
    if(!empty ($memberdetail))
    {
        $objBoFriend=new BoAddFriends();
        $objBoFriend->setMemberId($_SESSION['memberid']);
        $objBoFriend->setFriendId($memberdetail[0]['id']);
        $objBoFriend->setCreatedDate(Date('Y-m-d'));
        $objPlFriend=new PlAddFriends();
        $msg=$objPlFriend->PlAddFriend($objBoFriend);
    }
    else
        $msg="Member not found.";
}
if(isset($_REQUEST['flag']) && ($_REQUEST['flag']=='A' || $_REQUEST['flag']=='R'))
{
    $objBoARFriends=new BoAddFriends();
    $objBoARFriends->setMemberId($_REQUEST['friendid']);
    $objBoARFriends->setFriendId($_REQUEST['id']);
    $objBoARFriends->setApproved($_REQUEST['flag']);
    $objBoARFriends->setCreatedDate(Date('Y-m-d'));

    $objPlARFriends=new PlAddFriends();
    $msg=$objPlARFriends->PlApproveOrRejectFriend($objBoARFriends);
    header("location:AddFriend.php?id=".$_REQUEST['id']."&member=".$_REQUEST['member']."&msg=".$msg);
    
}
else if(isset($_REQUEST['flag']) && $_REQUEST['flag']=='D')
{
    $objBoDeleteFriends=new BoAddFriends();
    $objBoDeleteFriends->setMemberId($_REQUEST['id']);
    $objBoDeleteFriends->setFriendId($_REQUEST['friendid']);
    $objBoDeleteFriends->setApproved($_REQUEST['flag']);

    $objPlDeleteFriends=new PlAddFriends();
    $msg=$objPlDeleteFriends->PlDeleteFriend($objBoDeleteFriends);
    header("location:AddFriend.php?id=".$_REQUEST['id']."&member=".$_REQUEST['member']."&msg=".$msg);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" lang="he" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title></title>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
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
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 14px;
                font-weight: bold;
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
                left: 300px;
                float: right;
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
                height: 90px;;
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
                border-width: thin;
                border-style: solid;
                display: block;
                height: 78px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
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
            /*Profile Title and Settings*/
            #dvProfileTitleAndSettings
            {
                position: relative;
                float: right;
                display: block;
                width: 965px;
                height: 20px;
                right: 5px;
                background-image: url(../images/profilepagetitle.jpg);
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
            #dvBackToProfile
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
            #dvBackToProfile a
            {
                /*color: #3e1a0f;*/
                text-decoration: none;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvBackToProfile a:hover
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
                border-width: thin;
                border-style: solid;
                display: block;
                height: auto;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvFriendsListSection
            {
                position: relative;
                float: left;
                left: 4px;
                width: 640px;
                /*border-width: thin;
                border-style: solid;*/
                display: table;
                height: auto;
                display: block;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvPendingFriendsRequest
            {
                position: relative;
                top: 2px;
                float: right;
                height: auto;
                display: table;
                background-color: #fef7ed;
                text-align: right;
                width:100%;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvPendingFriendsTitle
            {
                position: relative;
                top: 2px;
                float: right;
                height: auto;
                display: block;
                background-color: #fef7ed;
                text-align: right;
                width:100%;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvPendingFriendsList
            {
                position: relative;
                top: 2px;
                height: auto;
                display: table;
                background-color: #fef7ed;
                text-align: right;
                width:100%;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            /*Received Pending Friends Request*/
            #dvReceivedPendingFriendsRequest
            {
                position: relative;
                top: 2px;
                float: right;
                height: auto;
                display: table;
                background-color: #fef7ed;
                text-align: right;
                width:100%;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvReceivedPendingFriendsTitle
            {
                position: relative;
                top: 2px;
                float: right;
                height: auto;
                display: block;
                background-color: #fef7ed;
                text-align: right;
                width:100%;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvReceivedPendingFriendsList
            {
                position: relative;
                top: 2px;
                height: auto;
                display: table;
                background-color: #fef7ed;
                text-align: right;
                width:100%;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            /*Ends here*/
            #dvApprovedFriendsList
            {
                position: relative;
                top: 5px;
                /*border-width: thin;
                border-style: solid;*/
                float: right;
                height: auto;
                display: table;
                background-color: #fef7ed;
                text-align: right;
                width:100%;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvApprovedFriendsTitle
            {
                position: relative;
                top: 2px;
                /*border-width: thin;
                border-style: solid;*/
                float: right;
                height: auto;
                display: table;
                background-color: #fef7ed;
                text-align: right;
                width:100%;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvApprovedFriendsList
            {
                position: relative;
                top: 2px;
                /*border-width: thin;
                border-style: solid;*/
                float: right;
                height: auto;
                display: table;
                background-color: #fef7ed;
                text-align: right;
                width:100%;
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
            /* Display Member Info*/
            #dvAddFriendTitle
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
            
            .ProfileLabel
            {
                color: #b5b6b6;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            /* Ends here*/
           
            #dvAddFriendFormSection
            {
                position: relative;
                top: 2px;
                width: 290px;
                height: auto;
                border-color:#1b4376;
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
                border-style: solid;
                border-width: thin;
            }
            .smalltagname
            {
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 9px;
            }
            .background
            {
                background-color: #fef5ce;
            }
        </style>
        <script type="text/javascript" language="JavaScript">
            var i=1;
            String.prototype.trim = function()
            {
                return this.replace(/(?:(?:^|\n)\s+|\s+(?:$|\n))/g,"");
            }
            function StuffValid()
            {
                if(document.frmaddstuff.txtStuffName.value.trim()=="")
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
    </head>
    <body>
        <div id="dvMain" align="center">
            <div id="dvBanner">
                 <div id="dvLogin">
                        <a href="../logout.php" title="Logout"> logout </a> |
                        <a href="Comments.php?profileid=<?php echo $_SESSION['memberid']; ?>" title="Comments"> comments </a>|
                        <a href="Stuffs.php?profileid=<?php echo $_SESSION['memberid']; ?>" title="Stuffs"> stuff </a> |
                        <a href="Profile.php?profileid=<?php echo $_SESSION['memberid']; ?>" title="Member Profile"><?php echo $_SESSION['member']; ?></a>
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
                        <a href="../index.php" title="HOME"><?php echo HOME_MENU; ?></a> <a href="../faq.php" title="FAQ"><?php echo FAQ; ?></a>
                    </div>
                    <div id="dvAddStuffButton">
                        <a href="#" onclick="DisplayAddStuff();"> <img id="btnAddStuff" name="btnAddStuff" src='../images/AddStuff.png' width='175px' height='24px' alt='' border="0"/></a>
                    </div>
                    <div id="dvBrowseStuffButton">
                        <a href="../Stuff/BrowseStuff.php"><img id="btnBrowser" name="btnBrowse" src='../images/BrowseStuff.png' width='130px' height='24px' alt='' border="0"/></a>
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
                            <td><input type="text" id="txtStuffName" name="txtStuffName" size="40"/></td>
                            <td align="left"><input type="submit" name="submit" id="submit" value="Add"/></td>
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
                    XXX became friends
                </div>
            </div>
            <!--Ads and Message ends here-->
            <div style="clear: both;"></div>
            
            <div style="clear: both;"></div>
            <div id="dvProfileTitleAndSettings">
                <div id="dvProfileTitle">
                    Add Friend
                </div>
                <div id="dvBackToProfile">
                    <a href="Profile.php">Back to Profile</a>
                </div>
            </div>
            <div style="clear: both;"></div>
            <!---->
            <div id="dvLeftColumn">
                <div style="clear:both;"></div>
                <span style='font-size: 1px;'>&nbsp;</span>
                <!--Profile Detail Section-->
                <div id="dvFriendsListSection">
                    <!--Sent Pending Friends Request-->
                    <div id="dvPendingFriendsRequest">
                        <div id="dvPendingFriendsTitle">
                            Sent Pending Friends Request
                        </div>
                        <div style="clear: both;"></div>
                        <span style='font-size: 1px;'>&nbsp;</span>
                        <span style='font-size: 1px;'>&nbsp;</span>
                        <div id="dvPendingFriendsList">
                            <?php
                                $objBoShowFriendsList=new BoAddFriends();
                                $objBoShowFriendsList->setMemberId($_SESSION['memberid']);

                                $objPlShowFriendList=new PlAddFriends();
                                echo $objPlShowFriendList->PlShowSentPendingFriendsList($objBoShowFriendsList);
                            ?>
                            
                        </div>
                        <font color="white">fjsdl</font>
                        <div style="clear: both;"></div>
                    </div>
                    <!--ends here-->
                    <div style="clear: both;"></div>
                    <span style='font-size: 1px;'>&nbsp;</span>
                    <span style='font-size: 1px;'>&nbsp;</span>
                    <!--Received Pending Friends Request-->
                    <div id="dvReceivedPendingFriendsRequest">
                        <div id="dvReceivedPendingFriendsTitle">
                            Received Pending Friends Request
                        </div>
                        <div style="clear: both;"></div>
                        <span style='font-size: 1px;'>&nbsp;</span>
                        <span style='font-size: 1px;'>&nbsp;</span>
                        <div id="dvReceivedPendingFriendsList">
                            <?php
                                $objBoShowFriendsList=new BoAddFriends();
                                $objBoShowFriendsList->setMemberId($_SESSION['memberid']);

                                $objPlShowFriendList=new PlAddFriends();
                                echo $objPlShowFriendList->PlShowReceivedPendingFriendsList($objBoShowFriendsList);
                            ?>
                        </div>
                        <font color="white">fjsdl</font>
                        <div style="clear: both;"></div>
                    </div>
                    <!--ends here-->
                    <div style="clear: both;"></div>
                    <span style='font-size: 1px;'>&nbsp;</span><br>
                    <div id="dvApprovedFriendsList">
                        <div id="dvApprovedFriendsTitle">
                            Approved Friends List
                        </div>
                        <div style="clear: both;"></div>
                        <span style='font-size: 1px;'>&nbsp;</span>
                        <span style='font-size: 1px;'>&nbsp;</span>
                        <div id="dvApprovedFriendsList">
                        <?php
                            $objBoShowFriendsList=new BoAddFriends();
                            $objBoShowFriendsList->setMemberId($_SESSION['memberid']);

                            $objPlShowFriendList=new PlAddFriends();
                            echo $objPlShowFriendList->PlShowApprovedFriendsList($objBoShowFriendsList);
                        ?>
                        </div>
                    </div>                                   
                    <div style="clear:right;"></div>
                </div>
                <div style="clear:right;"></div>
                <font color="white">fjsdl</font>
            </div>
            <!--Ads and Related Category Left Column-->
            <div id="dvRightColumn">                
                <span style='font-size: 1px;'>&nbsp;</span>
                <div id="dvAddFriendFormSection">
                    <div id="dvAddFriendTitle">
                        Friend's Info
                    </div>
                    <div id="dvAddFriendForm">
                        <form id="frmAddFriend" name="frmAddFriend" method="post" action="">
                            <table align="right">
                                <tr>
                                    <td colspan="2">Friend's NickName</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><input type="text" id="txtfriendname" name="txtfriendname" /></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="submit" id="submit" name="submit" value="Add Friend"/>
                                    </td>
                                </tr>
                                <?php
                                    if(isset($msg) && $msg!="")
                                    {
                                        echo "<tr><td colspan='2'>$msg</td></tr>";
                                    }
                                ?>
                            </table>
                        </form>
                    </div>
                </div>
                <span style='font-size: 1px;'>&nbsp;</span>                
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
