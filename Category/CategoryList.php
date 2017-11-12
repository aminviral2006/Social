<?php
session_start();
if(!isset($_SESSION['member']))
    header("location:../Member/Login.php");

include_once '../commoninclude.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="rtl">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <style type="text/css">
            #dvMain
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
            #dvCategoryList
            {
                /*position: absolute;
                top:100px;
                left:2px;*/
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
                display:table; /*Maha Gilinder*/
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
    </head>
    <body>

        <div id="dvMain" align="center">
            <div id="dvBanner">
                Banner Header
                <div id="dvLogin">
                    <img src="../Member/MemberImages/default.jpg" width="28px" height="28px" alt="" />
                    <a href="logout.php">logout</a>
                    <?php echo $_SESSION['member']; ?>
                </div>
            </div>
            <span style='font-size: 1px;'>&nbsp;</span>
            <div id='dvMenuStrip'>
                <div id='dvMenuContents'>
                    Home FAQ
                </div>
            </div>
            <span style='font-size: 1px;'>&nbsp;</span>
            <div id="dvMessage">
                <img src='../Images/errorred.jpg' width='18px' height='18px'/>Stuff cannot be blank.
            </div>
            <div id="dvCategoryList">
                Category List goes here
            </div>
            <span style='font-size: 1px;'>&nbsp;</span>
            <div id='dvFooter'>
                <!--<a href="#">home |</a> <a href="#">faq |</a>
		<a href="#">privacy policy |</a> <a href="#">term and conditions |</a>
		<a href="#">contact us |</a> <a href="#">rss feed |</a> <a href="#">bookmark this page</a><br/>
		Copyright &copy;2010 Avigabso. Designed & Developed by <a href="http://themacrosoft.com">Macrosoft Solutions</a>-->
		<?php include_once('../footers.php'); ?>
            </div>
        </div>

    </body>
</html>
