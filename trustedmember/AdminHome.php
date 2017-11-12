<?php
if(!isset($_SESSION))
    session_start();
if(!isset($_SESSION['member']))
    header("location:../Member/Login.php");
else if(!isset($_SESSION['membertype']))
    header("location:../Member/Login.php?login=You are not authorized to login in to Trusted Member Panel");

if($_SESSION['membertype']=="T" || $_SESSION['membertype']=="A")
    echo "";
else
    header("location:../Member/Login.php?login=You are not authorized to login in to Trusted Member Panel");


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="rtl" lang="he">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php if(isset($pageTitle)) echo $pageTitle; else "Admin Home"; ?></title>
        <script type="text/javascript" language="JavaScript" src="../administrator/JS/General.js"></script>
        <link rel="stylesheet" type="text/css" href="chrometheme/chromestyle.css" />
        <script type="text/javascript" src="chromejs/chrome.js"></script>
            
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
            .spNotAMember
            {
                color: #f9c60b;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvMenuStrip
            {
                position: relative;
                top: 95px;
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
                top: -10px;
                right:110px;
                /*float: right;*/
                color: black;
                display: block;
                font-size: 10px;
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
            #dvLogout
            {
                position: relative;
                float:left;
                left: 10px;
                top:-27px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-weight: bold;
            }
            #dvLogout a
            {
                text-decoration: none;
                color: black;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvLogout a:hover
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
            #dvContentTitle h1
            {
                display: block;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: medium;
                font-weight: bold;
                color:blue;
            }
            #dvMenuLink
            {
                position: relative;
                font-size: 12px;
                font-weight: bold;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                padding-right: 50px;
                text-align: right;
            }
            #dvMenuLink a
            {
                text-decoration: none;
            }
            #dvMenuLink a:hover
            {
                text-decoration: blink;
            }
            #dvData
            {
                position: static;
                top: 10px;
                left: -1px;
                width: 978px;
                height: auto;
                display: table;
                z-index: 4;
                padding-top: 5px
            }
            #dvMessage
            {
                background-color: #E8BEBE;
                color: #000080;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                display: block;
                font-size: small;
                font-weight: bold;
            }
            .ImageList
            {
                border:thin solid black;
                margin-left:2px;
                margin-right:2px;
                margin-top: 1px;
                margin-bottom: 2px;
                padding: 1px;
            }
            .ImageList a
            {
                text-decoration: none;
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
            var i=1;
            String.prototype.trim = function()
            {
                return this.replace(/(?:(?:^|\n)\s+|\s+(?:$|\n))/g,"");
            }

            function TrimTextArea()
            {
                document.getElementById("tarabout").value.trim();
            }
            function StuffValid()
            {
                if(document.frmaddstuff.txtStuffName.value.trim()=="")
                {
                    document.getElementById("dvMessage").style.visibility="visible";
                    document.getElementById("dvMessage").style.display="block";
                    return false;
                }
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
                    i=1;
                }
            }*/
        </script>
        <script language='JavaScript' type='text/javascript'>
            function changevalue(sid,sstatus)
            {
                document.getElementById("stuffid").value=sid;
                alert(document.getElementById("stuffid").value);
                document.getElementById("stuffstatus").value=sstatus;
                alert(document.getElementById("stuffstatus").value);
            }
        </script>
        <!--<script type='text/javascript' src='jquery-1.2.3.min.js'></script>
        <script type='text/javascript' src='menu.js'></script>
        <link rel="stylesheet" href="style.css" type="text/css" media="screen" />-->
    </head>
    <body>
        <div id="dvMain" align="center">
                <div id="dvBanner">
                    <div id="dvLogin">
                       <a href="../logout.php" title="Logout"> logout </a> |
                        <a href="../Member/Comments.php?profileid=<?php echo $_SESSION['memberid']; ?>&member=<?php echo $_SESSION['member']; ?>" title="Comments"> comments </a>|
                        <a href="../Member/Stuffs.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnMemberStuffPage']; ?>&profileid=<?php echo $_SESSION['memberid']; ?>&member=<?php echo $_SESSION['member']; ?>" title="Stuffs"> stuff </a> |
                        <a href="../Member/Profile.php?profileid=<?php echo $_SESSION['memberid']; ?>&member=<?php echo $_SESSION['member']; ?>" title="Member Profile"><?php echo $_SESSION['member']; ?></a>
                        <div style="clear: both;"></div>
                    </div>
                     <div style="position: absolute;float:left;left: 875px;width: 105px;height: 120px;">
                        <a href="../index.php" style="outline: none;">
                        <img src="../images/hotspot.png" border="0" alt=""/>
                        </a>
                    </div>
                    <div style="clear: both;"></div>
                    <div id="dvMenuStrip">
                        <div id='dvMenuContents' align="right">
                            <a href="index.php"><?php echo MENU_HOME;?> </a>|
                            <a href="DisplayCategories.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnTrustedMemberCategoryPage']; ?>&total=t">Category </a>|
                            <a href="DisplayStuffs.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnTrustedMemberStuffPage']; ?>&total=t">Stuffs </a>  |
                            <a href="DisplayReportViolation.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnAdminStuffPage']; ?>">Report Violation </a>
                            <!--<ul id="nav">
                                <li><a href="#">1 HTML</a></li>
                                <li><a href="#">2 CSS</a></li>
                                <li><a href="#">3 Javascript </a>
                                  <ul>
                                        <li><a href="#">3.1 jQuery</a>
                                          <ul>
                                                <li><a href="#">3.1.1 Download</a></li>
                                                <li><a href="#">3.1.2 Tutorial</a></li>
                                          </ul>
                                        </li>
                                        <li><a href="#">3.2 Mootools</a></li>
                                        <li><a href="#">3.3 Prototype</a></li>
                                  </ul>
                                </li>
                            </ul>-->
                        </div>
                        <div id="dvLogout">
                            Welcome, <?php if(isset($_SESSION['member'])) echo $_SESSION['member']; ?>
                            <a href="../logout.php" style="color:red;">Logout </a>
                        </div>
                        <div style="clear: both;"></div>
                        <form id="frmSearch" name="frmSearch" method="post" action="">
                            <span style='font-size: 1px;'>&nbsp;</span>
                            <div id="dvAddStuffButton">
                                <a href="#" onclick="DisplayAddStuff();"> <img id="btnAddStuff" name="btnAddStuff" src='../images/AddStuff.png' width='175px' height='24px' alt='' border="0"/></a>
                            </div>
                        </form>
                        <span style='font-size: 1px;'>&nbsp;</span>
                        <div style="clear: both;"></div>
                        <div id="dvBrowseStuff">
                            <a href="../Stuff/BrowseStuff.php"><img id="btnBrowser" name="btnBrowse" src='../images/BrowseStuff.png' width='130px' height='24px' alt='' border="0"/></a>
                        </div>
                    </div>
                </div>
            <div style="clear: both;"></div>
            <br>
            <div id="dvMenuLink">
                <?php
                    if(isset($menuLink))
                        echo $menuLink;
                ?>
            </div>
            <div id="dvContentTitle">
                <h1>
                <?php
                    if(isset($contentTitle))
                        echo $contentTitle;
                ?></h1>
            </div>
            <div id="dvData">
                <?php
                    if(isset($contentData))
                        echo $contentData;
                ?>                
            </div>
            <div id="dvMessage">
                <?php
                    if(isset($msg))
                        echo $msg;
                ?>
            </div>
            <br/>
       </div> <!--Main Div -->
       <div style="clear: both;"></div>
       <div id='dvFooter' align="center">
            <!--<a href="#">home |</a> <a href="#">faq |</a>
            <a href="#">privacy policy |</a> <a href="#">term and conditions |</a>
            <a href="#">contact us |</a> <a href="#">rss feed |</a> <a href="#">bookmark this page</a><br/>
            Copyright &copy;2010 Avigabso. Designed & Developed by <a href="http://themacrosoft.com">Macrosoft Solutions</a>-->
	    <?php include_once('../footers.php'); ?>
        </div>
    </body>
</html>
