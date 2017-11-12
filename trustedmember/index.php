<?php
if(!isset($_SESSION))
    session_start();
include_once '../commoninclude.php';
if(!isset($_SESSION['member']))
    header("location:../member/login.php");
else if(!isset($_SESSION['membertype']))
    header("location:../member/login.php?login=You are not authorized to login in to Trusted Member Panel");

if($_SESSION['membertype']=="T" || $_SESSION['membertype']=="A")
    echo "";
else
    header("location:../member/login.php?login=You are not authorized to login in to Trusted Member Panel");

/*Site Pagination Configuration*/
$objPlSiteConfiguration=new PlSiteConfiguration();
$records=$objPlSiteConfiguration->PlGetSiteConfigurationDetails(1);
$stufflist=$records[0]['TotalStuffListOnHomePage'];
$categorylist=$records[0]['TotalCategoryListOnHomePage'];
$randomtaglist=$records[0]['TotalRandomTagListOnHomePage'];

//General User Side
$_SESSION['TotalRecordsOnBrowseStuffPage']=$records[0]['TotalRecordsOnBrowseStuffPage'];
$_SESSION['TotalRecordsOnBrowseSearchStuffPage']=$records[0]['TotalRecordsOnBrowseSearchStuffPage'];
$_SESSION['TotalRecordsOnBrowseCategoryPage']=$records[0]['TotalRecordsOnBrowseCategoryPage'];
$_SESSION['TotalRelatedCategory']=$records[0]['TotalRelatedCategory'];

//Admin Side
$_SESSION['TotalRecordsOnAdminMemberPage']=$records[0]['TotalRecordsOnAdminMemberPage'];
$_SESSION['TotalRecordsOnAdminTopicsPage']=$records[0]['TotalRecordsOnAdminTopicsPage'];
$_SESSION['TotalRecordsOnAdminCategoryPage']=$records[0]['TotalRecordsOnAdminCategoryPage'];
$_SESSION['TotalRecordsOnAdminStuffPage']=$records[0]['TotalRecordsOnAdminStuffPage'];
$_SESSION['TotalRecordsOnAdminMemberSearchPage']=$records[0]['TotalRecordsOnAdminMemberSearchPage'];

//Trusted Member Side
$_SESSION['TotalRecordsOnTrustedMemberCategoryPage']=$records[0]['TotalRecordsOnTrustedMemberCategoryPage'];
$_SESSION['TotalRecordsOnTrustedMemberStuffPage']=$records[0]['TotalRecordsOnTrustedMemberStuffPage'];

/*Ends here*/

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="rtl" lang="he">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php if(isset($pageTitle)) echo $pageTitle; else "Trusted Member Home"; ?></title>
        <script type="text/javascript" language="JavaScript" src="../Administrator/JS/General.js"></script>
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
                        
            #dvTagCategoryStuffZone
            {
                position: relative;
                /*border:1px solid black;*/
                width: auto;
            }
            
            #dvCategoryZone
            {
                position: relative;
                /*border:1px solid black;*/
                width: 190px;
                float: right;
                right: 250px;
            }
            #dvStuffZone
            {
                position: relative;
                /*border:1px solid black;*/
                width: 160px;
                float: right;
                right: 300px;
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
                padding: 0;
                margin: 0 auto;
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
                else
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
                    i=1;
                }
            }*/
        </script>
    </head>
    <body>
        <div id="dvMain" align="center">
                <div id="dvBanner">
                    <div id="dvLogin">
                        <a href="../logout.php" title="Logout"> logout </a> |
                        <a href="../member/comments.php?profileid=<?php echo $_SESSION['memberid']; ?>&member=<?php echo $_SESSION['member']; ?>" title="Comments"> comments </a>|
                        <a href="../member/stuffs.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnMemberStuffPage']; ?>&profileid=<?php echo $_SESSION['memberid']; ?>&member=<?php echo $_SESSION['member']; ?>" title="Stuffs"> stuff </a> |
                        <a href="../member/profile.php?profileid=<?php echo $_SESSION['memberid']; ?>&member=<?php echo $_SESSION['member']; ?>" title="Member Profile"><?php echo $_SESSION['member']; ?></a>
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
                            <a href="index.php">Home </a>|
                            <a href="DisplayCategories.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnTrustedMemberCategoryPage']; ?>&total=t">Category </a>|
                            <a href="DisplayStuffs.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnTrustedMemberStuffPage']; ?>&total=t">Stuffs </a>  |
                            <a href="DisplayReportViolation.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnAdminStuffPage']; ?>">Report Violation </a>
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
            <div id="dvData">
                <div id="dvTagCategoryStuffZone">
                    <?php
                        $objPlCategory=new PlCategory();
                    ?>
                    <div id="dvCategoryZone" align="center"> <!--Category Zone-->
                        <table border='0' dir='rtl' cellpadding="5px" cellspacing="5px"
           style='font-size:12px;background-color: #fef5ce;height:20px;border: 0px solid black;'>
                            <tr>
                                <th colspan="3">Category Zone <hr/></th>
                            </tr>
                            <tr>
                                <td>Total Categories</td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='DisplayCategories.php?page=1&ipp=20&total=T'>".$objPlCategory->PlTotalCategoryOnStatisticsPage()."</a>"; ?></td>
                            </tr>
                            <tr>
                                <td>Active Categories</td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='DisplayCategories.php?page=1&ipp=20&active=A'>".$objPlCategory->PlTotalActiveCategoryOnStatisticsPage()."</a>"; ?></td>
                            </tr>
                            <tr>
                                <td>In-Active Categories</td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='DisplayCategories.php?page=1&ipp=20&inactive=I'>".$objPlCategory->PlTotalInactiveCategoryOnStatisticsPage()."</a>"; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div id="dvStuffZone"> <!--Stuff Zone-->
                        <?php
                            $objPlStuff=new PlStuff();
                        ?>
                        <table align="center" border='0' dir='rtl' cellpadding="5px" cellspacing="5px"
           style='font-size:12px;background-color: #fef5ce;height:20px;border: 0px solid black;'>
                            <tr>
                                <th colspan="3">Stuff Zone <hr/></th>
                            </tr>
                            <tr>
                                <td>Total Stuffs</td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='DisplayStuffs.php?page=1&ipp=20&total=T'>".$objPlStuff->PlTotalStuffListOnStatisticsPage()."</a>"; ?></td>
                            </tr>
                            <tr>
                                <td>Active Stuffs</td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='DisplayStuffs.php?page=1&ipp=20&active=A'>".$objPlStuff->PlTotalActiveStuffListOnStatisticsPage()."</a>"; ?></td>
                            </tr>
                            <tr>
                                <td>In-Active Stuffs</td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='DisplayStuffs.php?page=1&ipp=20&inactive=I'>".$objPlStuff->PlTotalInactiveStuffListOnStatisticsPage()."</a>"; ?></td>
                            </tr>
                            <tr>
                                <td>Locked Stuffs</td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='DisplayStuffs.php?page=1&ipp=20&locked=L'>".$objPlStuff->PlTotalLockedStuffListOnStatisticsPage()."</a>"; ?></td>
                            </tr>
                        </table>
                    </div>
                    <br/>
                </div>
            </div>
            <br>
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