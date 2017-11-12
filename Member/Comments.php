<?php
session_start();
if (!isset($_SESSION['member']))
    header("location:login.php");
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600))
{
    // last request was more than 30 minates ago
    //session_destroy();   // destroy session data in storage
    //session_unset();     // unset $_SESSION variable for the runtime
    header("location:../logout.php");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp


//Stuff Added Message
$message = "";
if (isset($_REQUEST['msg'])) {
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
    $message.= "Stuff added successfully.";
    $message.="</div><span style='font-size: 1px;'>&nbsp;</span>";
} else {
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

$objBoComment=new BoMemberComment();
if(isset($_REQUEST['id']))
    $receiverid=$_REQUEST['id'];
else
    $receiverid=$_SESSION['memberid'];

$objBoComment->setFriendID($receiverid);

$objPlComment=new PlMemberComment();
$output=$objPlComment->PlDisplayComment($objBoComment);

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
        
    else if($flag==0 && ($sitecontrols[0]['OFCSP']=="Y" || $sitecontrols[0]['OFCC']== "Y" ))
    {
        header("location:Profile.php?id=".$_REQUEST['id']."&member=".$_REQUEST['member']);
    }
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
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
            }
            div#dvMain
            {
                position: relative;
                padding: 0;
                margin: 0 auto;
                width: 982px;
                height: auto;
                display: block;
                background-color: #FFFFFF;
                border-style: solid;
                border-width: thick;
                /*border-color:#1c2e3c;*/
                border-color:#233645;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 12px;
                margin-left: 10%;
                margin-right: 10%;
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
                font-family: verdana;
                font-size: 12px;
                background-color: #B8ADF1;
                font-family: Verdana, Arial, Helvetica, sans-serif;
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

            #dvAds
            {
                position: relative;
                float: left;
                left: 2px;
                width: 650px;
                border-width: thin;
                border-style: solid;
                display: block;
                padding: 4px;
                height: 78px;
                background-image: url(../images/ad1.jpg);
                background-color: #233645;
                overflow: hidden;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }

            #dvBecameFriends
            {
                position: relative;
                float: left;
                left:6px;
                width: 300px;
                /*border-width: thin;
                border-style: solid;*/
                display: block;
                padding: 4px;
                height: 78px;
                background-color: #f9c60b;
                background-image: url(../images/becamefriends.jpg);
                text-align: center;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }


            #dvMainFrame
            {
                float: right;
                width: 972px;
                padding: 4px;
                height: auto;
                font-size: medium;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                /*border-style: solid;
                border-width: medium;
                border-color: #233645*/
}
            #dvMemberName
            {
                float: right;
                width: 972px;
                padding: 0px;
                height: 30px;
                background-color: #f9c60b;
                direction: rtl;
                font-size: 20px;
                font-style: italic;
                text-align: right;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvCommentButton
            {
                float: right;
                width: auto;
                padding: 10px;
                height: auto;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvAddComment
            {
                float: right;
                visibility: hidden;
                width: 300px;
                height: auto;
                z-index: 4;
                margin-left:auto;
                margin-right:auto;
                padding-top: 10px;
                padding-bottom: 10px;
                display:none; /*Maha Gilinder*/
                padding: 4px;
                top: 20px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }

            #dvMessageDisplay
            {
                float: right;
                width: 960px;
                padding: 4px;
                height: auto;
                direction: rtl;
                display: table;
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
                margin-left: 10%;
                margin-right: 10%;

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

        <script type="text/javascript" language="JavaScript">
            var i=1
            function DisplayAddComment()
            {
                if(i==1)
                {
                    document.getElementById("dvAddComment").style.visibility="visible";
                    document.getElementById("dvAddComment").style.display="table";
                    i=0;
                }
                else
                {
                    document.getElementById("dvAddComment").style.visibility="hidden";
                    document.getElementById("dvAddComment").style.display="none";
                    i=1;
                }
                i==1;
            }

        </script>

        <script type="text/javascript" language="JavaScript">
            //Ajax Script for adding a Private Comment.
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

            function CheckPrivateComment()
            {
                str=document.frmPrivateComment.txtPrivateComment.value.trim();
                url="AddPrivateComment.php?q="+str;
                xhr=new GetXMLHttp();
                xhr.onreadystatechange=PrivateCommentStateChange;
                xhr.open('GET',url,true);
                xhr.send(null);
                alert(str);
            }

            function PrivateCommentStateChange()
            {
                if(xhr.readyState==4 && xhr.status==200)
                    document.getElementById("dvMessage").innerHTML=xhr.responseText;
                else
                    document.getElementById("dvMessage").innerHTML="Sorry Try Again ";
            }
        </script>
        <script type="text/javascript" language="JavaScript"> //JavaScript Functions All
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
                {
                    document.getElementById("dvMessage").innerHTML="";
                    document.getElementById("dvMessage").style.display="block";
                    document.getElementById("dvMessage").style.visibility="hidden";
                }
                return true;
            }

            /*function DisplayAddStuff()
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
                    document.getElementById("dvMessage").innerHTML="";
                    document.getElementById("dvMessage").style.display="block";
                    document.getElementById("dvMessage").style.visibility="hidden";
                    i=1;
                }                
            }*/

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

            function CommentValid()
            {
                if(document.frmPrivateComment.txtPrivateComment.value.trim()=="")
                {
                    document.getElementById("dvAddComment").style.visibility="visible";
                    document.getElementById("dvAddComment").style.display="block";
                    document.getElementById("dvCommentError").innerHTML="You cannot add blank comment!";
                    return false;
                }
                else
                {
                    document.getElementById("dvCommentError").innerHTML="";
                    document.getElementById("dvAddComment").style.display="block";
                    document.getElementById("dvAddComment").style.visibility="hidden";
                }
                return true;
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
    <body dir="rtl">
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
            <div id="dvAddStuff">
                <form action="../stuff/AddMyStuff.php" method="POST" name="frmaddstuff" onsubmit="return StuffValid();">
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
            <div id="dvMessageMain">
                <?php
                            if (isset($message))
                                echo $message;
                ?>
            </div>
            <span style='font-size: 1px;'>&nbsp;</span>
            <div id="dvAdsAndMessage" align="left">
                <div id="dvAds" align="left">
                    Ads Goes Here
                </div>
                <div id="dvBecameFriends" align="right">
                    &nbsp;
                    <?php
		    $objPlStuff=new PlStuff();
                    $LastFriends=$objPlStuff->PlLastFriend();
		    echo $LastFriends;
                    /*$objPlLastFriend=new PlStuff();
                    $LastFriends=$objPlLastFriend->PlLastFriend();
                    if(isset($LastFriends))
                    {
                        echo "<a href='../member/Profile.php?id=".$LastFriends[0][0]['ID']."&member=".$LastFriends[0][0]['NickName']."'><img src='../member/memberimages/".$LastFriends[0][0]['ProfileImagePath']."' style='width:12px;height:12px;border:1px;' alt=''/> ".$LastFriends[0][0]['NickName']."</a> and <br/>";
                        echo "<a href='../member/Profile.php?id=".$LastFriends[1][0]['ID']."&member=".$LastFriends[1][0]['NickName']."'><img src='../member/memberimages/".$LastFriends[1][0]['ProfileImagePath']."' style='width:12px;height:12px;border:1px;' alt=''/> ".$LastFriends[1][0]['NickName']."</a> are now Friends";
                    }*/
                    ?>
                </div>
                <div style="clear: right;"></div>
            </div>
            <div style="clear: both;"></div>
            <span style='font-size: 1px;'>&nbsp;</span>
            <div id="dvMainFrame">
                <div id="dvMemberName">
                    <?php 
                        if(isset($_REQUEST['member']))
                            echo $_REQUEST['member']."'s comments";
                        else
                            echo $_SESSION['member']."'s comments";
                    ?>
                </div>
                <div style="clear: both;"></div>
                <div id="dvCommentButton">
                    <input type="button" name="DisplayComment" id="DisplayComment" value="Add Comment" align="right" onclick="DisplayAddComment();"/><br>
                </div>
                <div style="clear: both;"></div>
                <div id="dvAddComment">
                    <form name="frmPrivateComment" id="frmPrivateComment" method="post" action="AddPrivateComment.php" >
                        <h4>Your Comment</h4>
                        <!--<textarea name="txtPrivateComment" id="txtPrivateComment" rows="6" cols="30"></textarea>-->
                        <?php
                            include_once '../FCKEditor/fckeditor.php';
                            function nukeMagicQuotes()
                            {
                                if (get_magic_quotes_gpc())
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
                            nukeMagicQuotes();
                            if(isset($_REQUEST['cancel']))
                            {
                                $oFCKeditor->Value=null;
                            }
                            $oFCKeditor = new FCKeditor('txtPrivateComment');
                            //$oFCKeditor->BasePath = "FCKeditor/editor/";
                            $oFCKeditor->Value    = "";
                            $oFCKeditor->Width    = 360;
                            $oFCKeditor->Height   = 200;
                            echo $oFCKeditor->CreateHtml();
                        ?>
                        <br>
                        <input type="submit" name="submit" id="submit" value="Submit"/>
                        <input type="hidden" name="id" value="<?php echo isset($_REQUEST['id'])?$_REQUEST['id']:$_SESSION['memberid']; ?>" />
                        <input type="hidden" name="member" value="<?php echo isset($_REQUEST['member'])?$_REQUEST['member']:$_SESSION['member']; ?>" />
                        <div id="dvCommentError"></div>
                    </form>
                </div>
                <div style="clear: both;"></div>
                <div id="dvMessage">

                </div>

                <div id="dvMessageDisplay">
                    <table border="0" align="right" width="950px" cellpadding="2px" style="border-color: grey;">
                        <?php
                            echo $output;
                        ?>
                    </table>
                </div>
            </div>
            <div style="clear: both;"></div>
        </div>
        <div id='dvFooter' align="center">
            <a href="#">home |</a> <a href="#">faq |</a>
            <a href="#">privacy policy |</a> <a href="#">term and conditions |</a>
            <a href="#">contact us |</a> <a href="#">rss feed |</a> <a href="#">bookmark this page</a><br/>
            Copyright &copy;2010 Avigabso. Designed & Developed by <a href="http://themacrosoft.com">Macrosoft Solutions</a>
        </div>
    </body>
</html>
