<?php
session_start();
if(!isset($_SESSION['member']))
    header("location:../Member/Login.php");
include_once '../commoninclude.php';

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600))
{
    // last request was more than 30 minates ago
    session_destroy();   // destroy session data in storage
    session_unset();     // unset $_SESSION variable for the runtime
    header("location:../logout.php");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
$profileImage="";
if(isset($_POST['submit']))
{
    $objBoStuff=new BoStuff();
    $objBoStuff->setTitle(strtoupper($_REQUEST['txtStuffName']));

    $objPlStuff=new PlStuff();
    $msg=$objPlStuff->PlIsStuffExist($objBoStuff);
    
    if($msg=="Stuff Exist")
        header("location:StuffDetail.php");
    else if($msg=="Category Exist")
        header("location:../Category/CategoryList.php");
    else
        header("location:AddCategory.php?stuffname=".$_REQUEST['txtStuffName']);
}
//Business Object
$objBoMemberProfile = new BoMemberProfile();
$objBoMemberProfile->setMemberId($_SESSION['memberid']);
//Presentation Layer Object
$objPlMember = new PlMemberProfile();
$record = $objPlMember->PlGetMemberProfileDetails($objBoMemberProfile);
$profileImage = isset($record[0]['ProfileImagePath']) ? addslashes('../Member/MemberImages/'.$record[0]['ProfileImagePath']) : addslashes('../Member/MemberImages/Default.jpg');
?>
<!--<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="rtl">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <style type="text/css">
            #dvMainAddStuff
            {
                position: relative;
                top:0px;
                left:0px;
                width: 79%;
                height: auto;
                display:block;
                margin-left:auto;
                margin-right:auto;
                border-style: solid;
                border-width: thin;
                border-color:#1b4376;
                padding-left: 12px;
                padding-right: 3px;
                padding-top: 3px;
                padding-bottom: 3px;
            }
            #dvBanner
            {
                /*position: absolute;
                top:2px;
                left:2px;*/
                width: 100%;
                height: 8%;
                border-width: thin;
                border-style: solid;
                display:block;
                padding: 4px;
            }
            #dvLogin
            {
                position: relative;
                display: block;
                float:right;
                right: 170px;
                top:20px;
            }
            #dvMenuStrip
            {
                /*position: absolute;
                top: 95px;
                left: 1px;*/
                width: 100%;
                height: 3%;
                z-index: 3;
                border-style: solid;
                border-width: thin;
                border-color:#1b4376;
                display:block;
                padding: 4px;
            }
            #dvMenuContents
            {
                text-align: right;
                padding: 4px;
            }
            #dvBrowseOrAddNewStuff
            {
                display: block;
                float: left;
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
            }
            #dvAddStuff
            {
                /*position: absolute;
                top:100px;
                left:2px;*/
                visibility: hidden;
                display: none;
                width: 100%;
                height: auto;
                z-index: 4;
                border-style: solid;
                border-width: thin;
                border-color:#1b4376;
                margin-left:auto;
                margin-right:auto;
                padding-top: 10px;
                padding-bottom: 10px;                
                padding: 4px;

            }
            #dvFooter
            {
                /*position: absolute;
                top: 657px;
                left: 1px;*/
                width: 100%;
                z-index: 4;
                border-style: solid;
                border-width: thin;
                border-color:#1b4376;
                margin-left:auto;
                margin-right:auto;
                padding-top: 20px;
                text-align: center;
                display:block;
                padding: 4px;
                direction: rtl;
            }
            #dvFooter a
            {
                text-decoration: none;
            }
            #dvFooter a:hover
            {
                text-decoration: underline;
            }
            .table
            {
                font-family: verdana;
                font-size: 12px;
                border-style: solid;
                border-width: thin;

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
                    return false;
                }
                else
                    return true;
            }

            function DisplayAddStuff()
            {
                if(i==1)
                {
                    document.getElementById("dvAddStuff").style.visibility="visible";
                    document.getElementById("dvAddStuff").style.display="table";
                    document.getElementById("spAboveAddStuff").style.display="block";
                    i=0;
                }
                else
                {
                    document.getElementById("dvAddStuff").style.visibility="hidden";
                    document.getElementById("dvAddStuff").style.display="none";
                    document.getElementById("spAboveAddStuff").style.display="none";
                    i=1;
                }
            }
        </script>
    </head>
    <body>

        <div id="dvMainAddStuff" align="center">
            <div id="dvBanner">
                Banner Header
                <div id="dvLogin">
                    <?php
                            //echo "<img src='".$profileImage."' width='20px' height='20px' alt='' />";
                    ?>
                    <a href="../logout.php">logout</a>
                    <?php //echo $_SESSION['member']; ?>
                </div>
            </div>
            <span style='font-size: 1px;'>&nbsp;</span>
            <div id='dvMenuStrip'>
                <div id='dvMenuContents'>
                    Home FAQ
                    <div id='dvBrowseOrAddNewStuff'>
                        <a href='#' onclick='DisplayAddStuff();'>Add Stuff</a>
                        <a href='BrowseStuff.php'>Browse Stuff</a>
                    </div>
                </div>
            </div>
            <span id='spAboveAddStuff' style='font-size: 1px;visibility: hidden;display: none;'>&nbsp;</span>
            <div id="dvAddStuff">
                <form action="<?php //echo $_SERVER['PHP_SELF']; ?>" method="POST" name="frmaddstuff" onsubmit="return StuffValid();">
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
            <div id="dvMessage">
                <img src='../Images/errorred.jpg' width='18px' height='18px'/>Stuff cannot be blank.
            </div>                        
            <span style='font-size: 1px;'>&nbsp;</span>
            <div id='dvFooter'>
                <a href="#">home |</a> <a href="#">faq |</a>
                <a href="#">privacy policy |</a> <a href="#">term and conditions |</a>
                <a href="#">contact us |</a> <a href="#">rss feed |</a> <a href="#">bookmark this page</a>
            </div>
        </div>
    </body>
</html>-->
