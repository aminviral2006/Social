<?php
session_start();
if(!isset($_SESSION['member']))
    header("location:../member/login.php");
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600))
{
    // last request was more than 30 minates ago
    //session_destroy();   // destroy session data in storage
    //session_unset();     // unset $_SESSION variable for the runtime
    header("location:../logout.php");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
if (isset($_REQUEST['stuffname']))
{
    $_SESSION['stuffName'] = $_REQUEST['stuffname'];
}
else
    header("location:../index.php");

include_once '../commoninclude.php';
$objAddcat = new MySQLConnection();
$objAddcat->Open();

$objTag = new PlTags();
$tag = $objTag->PlFillTag();


//Business Object
$objBoMemberProfile = new BoMemberProfile();
$objBoMemberProfile->setMemberId($_SESSION['memberid']);
//Presentation Layer Object
$objPlMember = new PlMemberProfile();
$record = $objPlMember->PlGetMemberProfileDetails($objBoMemberProfile);
$profileImage = isset($record[0]['ProfileImagePath']) ? addslashes('../Member/MemberImages/'.$record[0]['ProfileImagePath']) : addslashes('../Member/MemberImages/Default.jpg');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" lang="he" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Add Category Here</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <!--[if gte IE 6]>
            <link rel="stylesheet" type="text/css" href="css/i_hate_IE.css" />
        <![endif]-->
        <script type="text/javascript" language="JavaScript" src="js/jquery.js"></script>
        <script type="text/javascript" language="JavaScript" src="js/script.js"></script>
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
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            /*Ends here*/
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
            #dvBrowseStuff
            {
                position: absolute;
                float: left;
                top: 1px;
                display: none;
                left: 10px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvAddStuffButton
            {
                position: absolute;
                float:left;
                top: 1px;
                left: 150px;
                display: none;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            
            #dvErroMessage
            {
                width: 982px;
                color: red;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 13px;
                font-weight: bold;
                text-align: right;
                background-color: burlywood;
            }
            #dvAddStuff
            {
                position: relative;
                top:1px;                
                width: 982px;
                height: auto;
                z-index: 4;
                display: table;
                right: 16px;
                /*border-style: solid;
                border-width: thin;
                border-color:#1b4376;*/
                margin-left:auto;
                margin-right:auto;
                padding-top: 10px;
                padding-bottom: 10px;
                display:table; /*Maha Gilinder*/
                font-family: Verdana, Arial, Helvetica, sans-serif;
                text-align: right;
            }
            #dvOptions
            {
                width: 982px;
                display: block;
                height: auto;
                /*border-width: thin;
                border-style: solid;*/
                padding-bottom: 8px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvTag
            {
                position: relative;
                top: 2px;
                left:45px;
                display: block;
                float: left;
                width: 300px;
                height: 180px;
                border-width: thin;
                border-style: solid;
                background-color: #233645;
                padding-right: 5px;
                color: #FFFFFF;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }

            #dvAddImage
            {
                position: relative;
                top: 2px;
                left:30px;
                display: block;
                float: left;
                width: 300px;
                height: 180px;
                border-width: thin;
                border-style: solid;
                background-color: #233645;
                padding-right: 5px;
                color: #FFFFFF;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }

            #dvDescribe
            {
                position: relative;
                top: 2px;
                left:15px;
                display: block;
                float: left;
                width: 300px;
                height: 180px;
                border-width: thin;
                border-style: solid;
                background-color: #233645;
                padding-right: 5px;
                color: #FFFFFF;
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
            #dvSubmit
            {
                position: relative;
                top: 2px;
                left: 0px;
                display: block;
                width: 980px;
                height: 30px;
                /*border-width: thin;
                border-style: solid;*/
                background-color: #f9c60b;
                padding-top: 3px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            .table
            {
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 28px;
                /*border-style: solid;
                border-width: thin;*/
            }
        </style>
        <script type="text/javascript" language="JavaScript">
            String.prototype.trim = function()
            {
                return this.replace(/(?:(?:^|\n)\s+|\s+(?:$|\n))/g,"");
            }

            function CategoryValid()
            {
                if(document.frmaddcategory.keyword.value.trim()=="" || document.getElementById("keyword").value.trim()=="add category".trim())
                    return false;
                else
                    return true;
            }
            function hideautosuggestbox()
            {
                document.getElementById("augosuggestbox").style.visibility="hidden";
                document.getElementById("augosuggestbox").style.display="none";
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

            function ClearTextBox()
            {
                document.getElementById("keyword").value="";
            }
            function FillTextBoxDefault()
            {
                if(document.getElementById("keyword").value.trim()=="".trim())
                    document.getElementById("keyword").value="add category";
            }
        </script>
    </head>
    <body>
        <form name="frmaddcategory" method="POST" action="Newstuff.php" enctype="multipart/form-data" onsubmit="return CategoryValid();">
            <div id="dvMain" align="center">
                <div id="dvBanner">
                   <?php
                if (isset($_SESSION['member'])) {
                ?>
                    <div id="dvLogin">
                        <a href="../logout.php" title="Logout"> logout </a> |
                        <a href="../Member/Comments.php?profileid=<?php echo $_SESSION['memberid']; ?>&member=<?php echo $_SESSION['member']; ?>" title="Comments"> comments </a>|
                        <a href="../Member/Stuffs.php?page=1&ipp=20&profileid=<?php echo $_SESSION['memberid']; ?>&member=<?php echo $_SESSION['member']; ?>" title="Stuffs"> stuff </a> |
                        <a href="../Member/Profile.php?profileid=<?php echo $_SESSION['memberid']; ?>&member=<?php echo $_SESSION['member']; ?>" title="Member Profile"><?php echo $_SESSION['member']; ?></a>
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
                        <div style="clear: both;"></div>
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
                        <div style="clear: both;"></div>
                        <!--<form id="frmSearch" name="frmSearch" method="post" action="">
                            <span style='font-size: 1px;'>&nbsp;</span>
                            <div id="dvAddStuffButton">
                                <a href="#" onclick="DisplayAddStuff();"> <img id="btnAddStuff" name="btnAddStuff" src='../images/AddStuff.png' width='175px' height='24px' alt='' border="0"/></a>
                            </div>
                        </form>
                        <span style='font-size: 1px;'>&nbsp;</span>
                        <div style="clear: both;"></div>
                        <div id="dvBrowseStuff">
                            <a href="../Stuff/BrowseStuff.php?page=1&ipp=20"><img id="btnBrowser" name="btnBrowse" src='../images/BrowseStuff.png' width='130px' height='24px' alt='' border="0"/></a>
                        </div>-->
                    </div>
                </div>
                <span style='font-size: 1px;'>&nbsp;</span>
                <div id="dvAddStuff">
                    <table class="table" align="Right" width="805px">
                        <tr>
                            <th title="add stuff" style="background-image: url(../images/ActiveMembersTitle.jpg);width: 800px;color:white;height: 32px;background-repeat: no-repeat; font-size: 15px;text-align: right;padding-right: 10px;">Add Stuff</th>
                            <!--<th title="add stuff">Add Stuff</th>-->
                        </tr>
                        <tr>
                            <td style="color:#3e1a0f;font-weight: bold;">I think</td>
                        </tr>
                        <tr>
                            <td style="color:yellowgreen;font-weight: bold;"><b>
                            <?php
                                if(isset($_SESSION['stuffName']))
                                    echo $_SESSION['stuffName'];
                            ?></b></td>
                        </tr>
                        <tr>
                            <td style="color:#3e1a0f;font-weight: bold;">is the best</td>
                        </tr>
                        <tr>
                            <!--<td><input type="text" name="txtAddCategory" id="txtAddCategory" style="width:90%"/></td>-->
                            <td>                                
                                    <div id="holder"> 
                                        <input style="font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;width: 400px;height: 30px; direction: rtl;vertical-align: middle;" type="text" name="keyword" id="keyword" tabindex="0" value="add category" onclick="ClearTextBox();" onblur="FillTextBoxDefault();"  OnKeyPress="return disableEnterKey(event);"/>
                                        <!--<img src="images/loading.gif" id="loading" alt=""/>-->
                                    </div>
                                    <div id="ajax_response"></div>
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="color:#3e1a0f;font-weight: bold;">in the world!</td>
                        </tr>                        
                    </table>
                </div>
                <br/>
                <span style='font-size: 1px;'>&nbsp;</span>
                <div id="dvOptions">
                    <div id="dvDescribe" align="right">
                        <b>Describe It!</b><br/>
                        Optional, but handy for when people don't know what you're on about.<br>
                        <!--<textarea name="txtdescribe" id="txtdescribe" cols="30px" rows="5px"></textarea>-->
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
                                    $oFCKeditor = new FCKeditor('txtdescribe');
                                    //$oFCKeditor->BasePath = "FCKeditor/editor/";
                                    $oFCKeditor->Value    = "";
                                    $oFCKeditor->Width    = 295;
                                    $oFCKeditor->Height   = 130;
                                    echo $oFCKeditor->CreateHtml();
                        ?>       
                    </div>
                    <div class="spacer"></div>
                    <div id="dvAddImage" align="right">
                        <b>Add An Image!</b><br/>
                        Optional, but looks cool! Minimum image size is 200x100 pixels.<br>
                        <br/>
                        <b>Upload An Image:</b>
                        <input type="file" name="file" id="file"/>
                        <br/>
                        <b>Or add an Image URL:</b><br/>
                        <input type="text" name="txturl" id="txturl"/>
                    </div>
                    <div class="spacer"></div>
                    <div id="dvTag" align="right">
                        <B>Tag It!</B><br/>
                        Optional. Tagging your item helps to class it into popular groups.<br>
                        <?php
                        echo $tag;
                        ?>
                    </div>
                    <div style="clear: both;"></div>
                </div>
                <span style='font-size: 1px;'>&nbsp;</span>
                <div id="dvSubmit" align="right">
                    <input type="submit" name="submit" id="submit" value="Add Category"/>
                </div>
                <span style='font-size: 1px;'>&nbsp;</span>
           </div>
        </form>                           
          <div id='dvFooter' align="center">
            <!--<a href="#">home |</a> <a href="#">faq |</a>
            <a href="#">privacy policy |</a> <a href="#">term and conditions |</a>
            <a href="#">contact us |</a> <a href="#">rss feed |</a> <a href="#">bookmark this page</a><br/>
            Copyright &copy;2010 Avigabso. Designed & Developed by <a href="http://themacrosoft.com">Macrosoft Solutions</a>-->
	    <?php include_once('../footers.php'); ?>
        </div>
    </body>
</html>