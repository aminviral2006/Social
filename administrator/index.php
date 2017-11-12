<?php
if(!isset($_SESSION))
    session_start();
include_once '../commoninclude.php';

if(!isset($_SESSION['member']))
    header("location:login.php");
else if(!isset($_SESSION['membertype']))
    header("location:login.php?login=You are not authorized to login in to Admin Panel");
else if($_SESSION['membertype']!="A")
    header("location:../member/login.php?login=You are not authorized to login in to Admin Panel");

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

//Member Profile Side
$_SESSION['TotalRecordsOnMemberStuffPage']=$records[0]['TotalRecordsOnMemberStuffPage'];

/*Ends here*/


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="rtl" lang="he">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php if(isset($pageTitle)) echo $pageTitle; else "Admin Home"; ?></title>
        <script type="text/javascript" language="JavaScript" src="JS/General.js"></script>

        <!--[if gte IE 6]>
            <link rel="stylesheet" type="text/css" href="dropdown/IE.css" />
        <![endif]-->

        <!--For Drop Down Menu-->
        <script type='text/javascript' src='dropdown/jquery-1.2.3.min.js'></script>
        <script type='text/javascript' src='dropdown/menu.js'></script>
        <link rel="stylesheet" href="dropdown/style.css" type="text/css" media="screen" />

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
                display: none;
                top: 30px;
                left: 450px;
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
                top: 6px;
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
                top:8px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-weight: bold;
                font-size: 10px;
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
            #dvMessage
            {
                background-color: #E8BEBE;
                color: #000080;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                display: block;
                font-size: small;
                font-weight: bold;
                text-align: center;
            }
            #dvMeberDetailsZone
            {
                position: relative;
                /*border:1px solid black;*/
                float: right;
                right: 10px;
                width: 450px;
                height: auto;
            }
            #dvMemberZone
            {
                position: relative;                
                display: block;
                /*border:1px solid black;*/
                width: auto;
                height: auto;
            }
            #dvTopMembers
            {
                position: relative;
                /*border:1px solid black;*/
                width: auto;
                height: auto;
            }
            #dvTopMembers a
            {
                text-decoration: none;
                outline: none;
            }
            #dvTagCategoryStuffZone
            {
                position: relative;
                /*border:1px solid black;*/
                float: right;
                right: 50px;
                width: 450px;
            }
            #dvTopicZone
            {
                position: relative;
                /*border:1px solid black;*/
            }
            #dvCategoryZone
            {
                position: relative;
                /*border:1px solid black;*/
            }
            #dvStuffZone
            {
                position: relative;
                /*border:1px solid black;*/
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
                       <!--<img src='member/memberimages/default.jpg' width='20px' height='20px' alt='' />|-->
                        <!--<a href="login.php" title="Login">התחבר</a> | <span class="spNotAMember" title="Not a Member">עדיין לא רשום ?</span> <a href="signup.php" title="Sign Up"> הרשם עכשיו </a>-->
                    </div>
                    <div style="position: absolute;float:left;left: 875px;width: 105px;height: 120px;">
                        <a href="../index.php" style="outline: none;">
                        <img src="../images/hotspot.png" border="0" alt=""/>
                        </a>
                    </div>
                    <div style="clear: both;"></div>
                    <div id="dvMenuStrip">
                        <div id='dvMenuContents'>
                            <!--<a href="index.php">Home </a>|
                            <a href="SiteConfiguration.php?task=edit">Site Configuration </a> |
                            <a href="DisplayMembers.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnAdminMemberPage']; ?>">Members </a>|
                            <a href="DisplayTags.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnAdminTopicsPage']; ?>">Tag </a>|
                            <a href="DisplayCategories.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnAdminCategoryPage']; ?>">Category </a>|
                            <a href="DisplayStuffs.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnAdminStuffPage']; ?>">Stuffs </a> |
                            <a href="DisplayReportViolation.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnAdminStuffPage']; ?>">Report Violation </a> |
                            <a href="MemberNewsLetter.php">Send NewsLetter</a>-->
                            <?php include_once 'Menu.php'; ?>
                        </div>
                        <div id="dvLogout">
                            Welcome, <?php if(isset($_SESSION['member'])) echo $_SESSION['member']; ?>
                            <a href="logout.php" style="color:red;">Logout </a>
			    <!--<a href="<?php echo $_SERVER['PHP_SELF']."?lang=he"; ?>">HE</a> |
			    <a href="<?php echo $_SERVER['PHP_SELF']."?lang=en"; ?>">EN</a>-->
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
                <?php
                    /*if(isset($contentData))
                        echo $contentData;*/
                        
                ?>
                <div id="dvMeberDetailsZone">
                    <?php
                        $objPlMemberRegistration=new PlMemberRegistration();
                    ?>
                    <div id="dvMemberZone"> <!--Member Zone-->
                        <table border='0' dir='rtl' cellpadding="5px" cellspacing="5px"
           style='font-size:12px;background-color: #fef5ce;padding: 10px;height:20px;border: 0px solid black;width: 100%;'>
                            <tr>
                                <th colspan="3" align="center" title="Member Zone"><?php echo MEMBER_ZONE; ?> <hr/></th>
                            </tr>
                            <tr>
                                <td title="Total Members"><?php echo TOTAL_MEMBERS; ?></td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='javascript:void(0);'>".$objPlMemberRegistration->PlTotalMembersListOnStatisticsPage()."</a>"; ?></td>
                            </tr>
                            <tr>
                                <td title="Pending Members"><?php echo PENDING_MEMBERS; ?></td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='javascript:void(0);'>".$objPlMemberRegistration->PlTotalPendingMembersListOnStatisticsPage()."</a>"; ?></td>
                            </tr>
                            <tr>
                                <td title="Active Members"><?php echo CURRENT_ACTIVE_MEMBERS; ?></td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='javascript:void(0);'>".$objPlMemberRegistration->PlTotalActiveMembersListOnStatisticsPage()."</a>"; ?></td>
                            </tr>
                            <tr>
                                <td title="In-Active Members"><?php echo IN_ACTIVE_MEMBERS; ?></td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='javascript:void(0);'>".$objPlMemberRegistration->PlTotalInactiveMembersListOnStatisticsPage()."</a>"; ?></td>
                            </tr>
                            <tr>
                                <td title="Blocked Members"><?php echo BLOCKED_MEMBERS; ?></td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='javascript:void(0);'>".$objPlMemberRegistration->PlTotalBlockedMembersListOnStatisticsPage()."</a>"; ?></td>
                            </tr>
                            <tr>
                                <td title="Trusted Members"><?php echo TRUSTED_MEMBERS; ?></td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='javascript:void(0);'>".$objPlMemberRegistration->PlTotalTrustedMembersListOnStatisticsPage()."</a>"; ?></td>
                            </tr>
                        </table>
                    </div>
                    <br/>
                    <div id="dvTopMembers">
                        <table border='0' dir='rtl' cellpadding="5px" cellspacing="5px"
           style='font-size:12px;background-color: #fef5ce;height:20px;border: 0px solid black;width: 100%;'>
                            <tr>
                                <th colspan="3" title="Top Members"><?php echo TOP_MEMBERS; ?> <hr/></th>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                        //Most Active Based ON Stuff Created
                                        $objPlMostActiveMembers=new PlMemberRegistration();
                                        $output=$objPlMostActiveMembers->PlMostActiveMembersBasedOnStuffAndCommentCreatedOnAdminPage(10);
                                        echo $output;
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <br/>
                </div>
                <div id="dvTagCategoryStuffZone">
                    <?php
                        $objPlCategory=new PlCategory();
                    ?>
                    <div id="dvCategoryZone"> <!--Category Zone-->
                        <table border='0' dir='rtl' cellpadding="5px" cellspacing="5px"
           style='font-size:12px;background-color: #fef5ce;height:20px;border: 0px solid black;width: 100%;'>
                            <tr>
                                <th colspan="3" title="Category Zone"><?php echo CATEGORY_ZONE; ?> <hr/></th>
                            </tr>
                            <tr>
                                <td title="Total Categories"><?php echo TOTAL_CATEGORIES; ?></td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='DisplayCategories.php?page=1&ipp=20'>".$objPlCategory->PlTotalCategoryOnStatisticsPage()."</a>"; ?></td>
                            </tr>
                            <tr>
                                <td title="Active Categories"><?php echo ACTIVE_CATEGORIES; ?></td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='DisplayCategories.php?page=1&ipp=20'>".$objPlCategory->PlTotalActiveCategoryOnStatisticsPage()."</a>"; ?></td>
                            </tr>
                            <tr>
                                <td title="In-Active Categories"><?php echo IN_ACTIVE_CATEGORIES; ?></td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='DisplayCategories.php?page=1&ipp=20'>".$objPlCategory->PlTotalInactiveCategoryOnStatisticsPage()."</a>"; ?></td>
                            </tr>                            
                        </table>
                    </div>
                    <br/>
                    <div id="dvTopicZone"> <!--Topic Zone-->
                        <?php
                            $objPlTag=new PlTags();
                        ?>
                        <table border='0' dir='rtl' cellpadding="5px" cellspacing="5px"
           style='font-size:12px;background-color: #fef5ce;height:20px;border: 0px solid black;width: 100%;'>
                            <tr>
                                <th colspan="3" title="Topic(Tag) Zone"><?php echo TOPIC_ZONE; ?> <hr/></th>
                            </tr>
                            <tr>
                                <td title="Total Topics(Tags)"><?php echo TOTAL_TOPICS; ?></td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='DisplayTags.php?page=1&ipp=20'>".$objPlTag->PlTotalTagListOnStatisticsPage()."</a>"; ?></td>
                            </tr>
                            <tr>
                                <td title="Active Topics"><?php echo ACTIVE_TOPICS; ?></td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='DisplayTags.php?page=1&ipp=20'>".$objPlTag->PlTotalActiveTagListOnStatisticsPage()."</a>"; ?></td>
                            </tr>
                            <tr>
                                <td title="In-Active Topics"><?php echo IN_ACTIVE_TOPICS; ?></td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='DisplayTags.php?page=1&ipp=20'>".$objPlTag->PlTotalInactiveTagListOnStatisticsPage()."</a>"; ?></td>
                            </tr>
                        </table>                        
                    </div>
                    <br/>
                    <div id="dvStuffZone"> <!--Stuff Zone-->
                        <?php
                            $objPlStuff=new PlStuff();
                        ?>
                        <table border='0' dir='rtl' cellpadding="5px" cellspacing="5px"
           style='font-size:12px;background-color: #fef5ce;height:20px;border: 0px solid black;width: 100%;'>
                            <tr>
                                <th colspan="3" title="Stuff Zone"><?php echo STUFFS_ZONE; ?> <hr/></th>
                            </tr>
                            <tr>
                                <td title="Total Stuffs"><?php echo TOTAL_STUFFS; ?></td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='DisplayStuffs.php?page=1&ipp=20'>".$objPlStuff->PlTotalStuffListOnStatisticsPage()."</a>"; ?></td>
                            </tr>
                            <tr>
                                <td title="Active Stuffs"><?php echo ACTIVE_STUFFS; ?></td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='DisplayStuffs.php?page=1&ipp=20'>".$objPlStuff->PlTotalActiveStuffListOnStatisticsPage()."</a>"; ?></td>
                            </tr>
                            <tr>
                                <td title="In-Active Stuffs"><?php echo IN_ACTIVE_STUFFS; ?></td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='DisplayStuffs.php?page=1&ipp=20'>".$objPlStuff->PlTotalInactiveStuffListOnStatisticsPage()."</a>"; ?></td>
                            </tr>
                            <tr>
                                <td title="Locked Stuffs"><?php echo LOCKED_STUFFS; ?></td>
                                <td>:</td>
                                <td><?php echo "<a style='text-decoration:none;' href='DisplayStuffs.php?page=1&ipp=20'>".$objPlStuff->PlTotalLockedStuffListOnStatisticsPage()."</a>"; ?></td>
                            </tr>
                        </table>
                    </div>
                    <br/>
                </div>
                <div style="clear:both"></div>
                <div id="dvMessage">
                <?php
                    if(isset($_REQUEST['msg']))
                        echo $_REQUEST['msg'];
                ?>
                </div>
                <br/>
            </div>
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
