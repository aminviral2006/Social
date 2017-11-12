<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
session_start();
if (!isset($_SESSION['member']))
    header("location:login.php");

if($_REQUEST['profileid']==$_SESSION['memberid'] || $_SESSION['membertype']=="A");
else
    header("location:../index.php?msg=You are not allowed to see this page.");

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
                background-color: #B8ADF1;'>".$_REQUEST['msg'];
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


$objPlPrivateMessage=new PlPrivateMessage();
$objBo=new BoPrivateMessage();
$objBo->setFriendID($_REQUEST['profileid']);
$objBo->setMemberID($_REQUEST['profileid']);

//Member Details
$MemberName=$objPlPrivateMessage->PlPageDetail($objBo);

//Message Count
$Count=$objPlPrivateMessage->PlUnreadMessageCount();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <!--[if gte IE 6]>
            <link rel="stylesheet" type="text/css" href="css/i_hate_IE.css" />
        <![endif]-->
        <script type="text/javascript" language="JavaScript" src="js/jquery.js"></script>
        <script type="text/javascript" language="JavaScript" src="js/script.js"></script>

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

            #dvAds
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

            #dvMainFrame
            {
                position: relative;
                float: none;
                width: 962px;
                height: auto;
                font-size: medium;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                border-color: #233645;
                display: table;
            }

            #dvAddPrivateMessage
            {
                float: right;
                position: relative;
                left:2px;
                width: 982px;
                height: auto;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvCheckMail
            {
                top: 4px;
                float: none;
                left:2px;
                width: 976px;
                height: auto;
                display: table;
            }
            #dvMailCount
            {
                float: left;
                width: 200px;
                height: auto;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvDisplayMessage
            {
                position: relative;
                right: 10px;
                float: right;
                width: 765px;
                height: auto;
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
                border-left-style: solid;
                border-left-width: thin;
                border-top-style: solid;
                border-top-width: thin;
                border-bottom-style: solid;
                border-bottom-width: thin;
                border-left-style: solid;
                border-left-width: thin;
                border-right-style: solid;
                border-right-width: thin;
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
        </script>

        <script type="text/javascript" language="JavaScript">
            //Ajax
            String.prototype.trim = function()
            {
                return this.replace(/(?:(?:^|\n)\s+|\s+(?:$|\n))/g,"");
            }
          
                function messagevalid()
                {
                    /*if(document.frmmessage.txtmessage.value.trim()=="")
                    {
                        document.getElementById("msgerror").innerHTML="<font color='red'> Missing</font>";
                        return false;
                    }
                    else
                    {
                        document.getElementById("frnderror").innerHTML="";
                        return true;
                    }*/
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
                        <a href="comments.php?profileid=<?php echo $_SESSION['memberid']; ?>" title="Comments"> comments </a>|
                        <a href="stuffs.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnMemberStuffPage']; ?>&profileid=<?php echo $_SESSION['memberid']; ?>&member=<?php echo $_SESSION['member']; ?>" title="Stuffs"> stuff </a> |
                        <a href="profile.php?profileid=<?php echo $_SESSION['memberid']; ?>" title="Member Profile"><?php echo $_SESSION['member']; ?></a>
                        <div style="clear: both;"></div>
                </div>
                <div style="position: absolute;float:left;left: 875px;width: 105px;height: 120px;">
                        <a href="../index.php" style="outline: none;">
                        <img src="../images/hotspot.png" border="0" alt=""/>
                        </a>
                </div>
                <?php
                            } else {
                                echo "";
                    }
                ?>
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
                <form action="AddMyStuff.php" method="POST" name="frmaddstuff" onsubmit="return StuffValid();">
                    <table  align="Right" width="300px">
                        <tr>
                            <td colspan="2">Stuff Title:</td>
                        </tr>
                        <tr>
                            <td><!--<input type="text" id="txtStuffName" name="txtStuffname" size="40"/>-->
                                <div class="main">
                                    <div id="holderr">
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
                        echo "<a href='../member/profile.php?id=".$LastFriends[0][0]['ID']."&member=".$LastFriends[0][0]['NickName']."'><img src='../member/memberimages/".$LastFriends[0][0]['ProfileImagePath']."' style='width:12px;height:12px;border:1px;' alt=''/> ".$LastFriends[0][0]['NickName']."</a> and <br/>";
                        echo "<a href='../member/profile.php?id=".$LastFriends[1][0]['ID']."&member=".$LastFriends[1][0]['NickName']."'><img src='../member/memberimages/".$LastFriends[1][0]['ProfileImagePath']."' style='width:12px;height:12px;border:1px;' alt=''/> ".$LastFriends[1][0]['NickName']."</a> are now Friends";
                    }*/
                    ?>
                </div>
                <div style="clear: both;"></div>
            </div>
            <div style="clear: both;"></div>
            <span style='font-size: 1px;'>&nbsp;</span>
            <span style='font-size: 1px;'>&nbsp;</span>
            <span style='font-size: 1px;'>&nbsp;</span>
            <span style='font-size: 1px;'>&nbsp;</span>
            
            <div id="dvMainFrame">                
                <div id="dvAddPrivateMessage">
                    <form name="frmmessage" method="post" action="postmessage.php" onsubmit="return messagevalid();">
                        <table dir="RTL" align="center" class="table">
                            <tr>
                                <th colspan="3">Send Private Message</th>
                            </tr>
                            <tr>
                                <td>To:</td>
                                <td><!--<input type="text" name="txttofriend" id="txttofriend" style="width:100%"/>-->
                                    <table>
                                        <tr>
                                            <td>
                                                <div id="holder">
                                                    <input type="text" name="keyword" id="keyword" tabindex="0" style="width: 80%; direction: rlt;" OnKeyPress="return disableEnterKey(event);"/>
                                                    <img src="images/loading.gif" id="loading" alt=""/>
                                                </div>
                                                <div id="ajax_response"></div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td id="frnderror">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Message</td>
                                <td><!--<textarea rows="3"  name="txtmessage" id="txtmessage" style="width:100%"> </textarea>-->
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
                                    $oFCKeditor = new FCKeditor('txtmessage');
                                    //$oFCKeditor->BasePath = "FCKeditor/editor/";
                                    $oFCKeditor->Value    = "";
                                    $oFCKeditor->Width    = 280;
                                    $oFCKeditor->Height   = 150;

                                    echo $oFCKeditor->CreateHtml();
                                ?>
                                </td>
                                <td id="msgerror">&nbsp;</td>
                            </tr>
                            <tr align="center">
                                <td colspan="3"><input type="submit" name="submit" id="submit" value="Post Message" /></td>
                            </tr>
                        </table>
                    </form>
                    <p align="center"><?php
                    if(isset($_REQUEST['postmessage']) && $_REQUEST['postmessage']=="Your Message Posted Successfully")
                        echo $_REQUEST['postmessage'];
                    ?></p>
                </div>
                <span style='font-size: 1px;'>&nbsp;</span>
                <span style='font-size: 1px;'>&nbsp;</span>
                <div style="clear: both;"></div>
                <div id="dvCheckMail">
                <hr>
                    <div id="dvMailCount">
                        <form name="frmInbox" id="frmInbox" method="POST" action="PrivateMessageInbox.php">
                        <input type="submit" name="Inbox" id="Inbox" value='Inbox - <?php echo $Count?>'/><br>
                        <input type="submit" name="Sent" id="Sent" value="Sent"/><br>
                        <input type="hidden" name="profileid" id="profileid" value="<?php echo $_REQUEST['profileid']; ?>"/>
                        </form> 
                    </div>
                    <div id="dvDisplayMessage">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <th colspan="2" align="center"><?php if(isset($_REQUEST['Inbox'])) echo $_REQUEST['Inbox']; else echo "Inbox"; ?></th>
                            </tr>
                        <?php
                        if(isset($_REQUEST['Inbox']) && $_REQUEST['Inbox']=="Sent")
                        {
                            $SentRecord=$objPlPrivateMessage->PlShowPrivateMessageSent($objBo);
                            
                            for($i=0;$i<count($SentRecord); $i++)
                            {
                                    echo "<tr style='background-color: ".((($i%2)==0)?"beige":"white")."'><td valign='top' width='54px'><img src='MemberImages/" . $SentRecord[$i]['ProfileImagePath'] . " ' style='border:1px; border-style:solid;padding:2px;' height='32px' width='32px' align='right'/></td>";
                                    echo "<td  width='680px'><a style='text-decoration:none;' href='profile.php?id=".$SentRecord[$i]['ID']."&member=".$SentRecord[$i]['NickName']."'>".$SentRecord[$i]['NickName']."</a><br>". $SentRecord[$i]['Message'] . "</td>
                                          <td valign='top'><a style='text-decoration:none;font-size:10px;' href='DeletePrivateMessage.php?profileid=".$_SESSION['memberid']."&member=".$_SESSION['member']."&pmid=".$SentRecord[$i]['PMID']."&Sent=sent'>Delete</a></td></tr>";
                            }
                        }
                        else
                        {
                            $InboxRecord=$objPlPrivateMessage->PlShowPrivateMessageInbox($objBo);
                            for($i=0;$i<count($InboxRecord); $i++)
                                {
                                    echo "<tr style='background-color: ".((($i%2)==0)?"beige":"white")."'><td valign='top' width='54px'><img src='MemberImages/" . $InboxRecord[$i]['ProfileImagePath'] . " ' style='border:1px; border-style:solid;padding:2px;' height='32px' width='32px' align='right'/></td>";
                                    echo "<td width='680px'><a style='text-decoration:none;' href='profile.php?id=".$InboxRecord[$i]['ID']."&member=".$InboxRecord[$i]['NickName']."'>".$InboxRecord[$i]['NickName']."</a><br>". $InboxRecord[$i]['Message'] . "</td>
                                        <td valign='top'><a style='text-decoration:none;font-size:10px;' href='DeletePrivateMessage.php?profileid=".$_SESSION['memberid']."&member=".$_SESSION['member']."&pmid=".$InboxRecord[$i]['PMID']."&Inboxs=Inbox'>Delete</a></td></tr>";
                                }
                        }
                        ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
