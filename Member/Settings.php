<?php
session_start();
if(!isset($_SESSION['member']))
    header("location:../logout.php");
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

/*Updating Profile*/
if(isset($_REQUEST['submit']))
{
    if(isset($_REQUEST['chktag']))
    {
        //Setting BO Member Profile Controls' Business Object
        $objBoMemberProfileControls=new BoMemberProfileControls();
        $objBoMemberProfileControls->setMemberId($_SESSION['memberid']);

        $chktags=implode("-", $_REQUEST['chktag']);
        $objBoMemberProfileControls->setTagsOnHome($chktags);

        //Setting PL Member Profile Controls' Object
        $objPlMemberProfileControls=new PlMemberProfileControls();
        $Profile=$objPlMemberProfileControls->PlUpdateMemberProfileControls($objBoMemberProfileControls);
    }
    //Setting BO Member Profile Site Controls' Business Object
    $objBoMemberProfileSiteControls=new BoMemberProfileSiteControls();
    $objBoMemberProfileSiteControls->setMemberId($_SESSION['memberid']);
    if(isset($_REQUEST['chkncf'])=='Y') $objBoMemberProfileSiteControls->setNCF('Y'); else $objBoMemberProfileSiteControls->setNCF('N');
    if(isset($_REQUEST['chkofcsp'])=='Y') $objBoMemberProfileSiteControls->setOFCSP('Y'); else $objBoMemberProfileSiteControls->setOFCSP('N');
    if(isset($_REQUEST['chkofcc'])=='Y') $objBoMemberProfileSiteControls->setOFCC('Y'); else $objBoMemberProfileSiteControls->setOFCC('N');
    if(isset($_REQUEST['chkewmcp'])=='Y') $objBoMemberProfileSiteControls->setEWMCP('Y'); else $objBoMemberProfileSiteControls->setEWMCP('N');
    if(isset($_REQUEST['chkewfrm'])=='Y') $objBoMemberProfileSiteControls->setEWFRM('Y'); else $objBoMemberProfileSiteControls->setEWFRM('N');
    if(isset($_REQUEST['chkesa'])=='Y') $objBoMemberProfileSiteControls->setESA('Y'); else $objBoMemberProfileSiteControls->setESA('N');

    //print_r($objBoMemberProfileSiteConstrols);
    //Setting PL Member Profile Site Controls' Object
    $objPlMemberProfileSiteControls=new PlMemberProfileSiteControls();
    $Site=$objPlMemberProfileSiteControls->PlUpdateMemberSiteControls($objBoMemberProfileSiteControls);
    
    $Registration="";
    if($_REQUEST['flagemail']=="t" && $_REQUEST['flagpassword']=="t" && $_REQUEST['flagverifypassword']=="t")
    {
        //Setting BO Member Registration Business' Object
        $objBoMemberRegistration=new BoMemberRegistration();
        $objBoMemberRegistration->setId($_SESSION['memberid']);
        $objBoMemberRegistration->setEmailId($_REQUEST['txtemail']);
        $objBoMemberRegistration->setUserPassword(md5($_REQUEST['txtpassword']));

        //Setting PL Membe Registration's Object
        $objPlMemberRegistration=new PlMemberRegistration();
        $Registration=$objPlMemberRegistration->PlUpdateMemberDetails($objBoMemberRegistration);
    }

}
/*Updating ends here*/

//Business Object
$objBoMemberProfileSiteControls = new BoMemberProfileSiteControls();
$objBoMemberProfileSiteControls->setMemberId($_SESSION['memberid']);
//Presentation Layer Object
$objPlMemberSiteControls = new PlMemberProfileSiteControls();
$record = $objPlMemberSiteControls->PlShowMemberSiteControls($objBoMemberProfileSiteControls);

//Profile Control Tag Details List
$objPlTags=new PlTags();
$recordTags=$objPlTags->PlGetTags();

//Login and Email
$objBoMemberRegistration=new BoMemberRegistration();
$objBoMemberRegistration->setId($_SESSION['memberid']);

$objLogin=new PlMemberRegistration();
$logindetails=$objLogin->PlGetMemberDetails($objBoMemberRegistration);

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
                font-family: Verdana, Arial, Helvetica, sans-serif;
                color:white;
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
            #dvBrowseStuff
            {
                width: 680px;
                display: table;
                padding: 4px;
                height: auto;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
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
            /*Login Section*/
            #dvLoginSection
            {
                position: relative;
                float: left;
                width: 300px;
                height: auto;
                left: 20px;
                text-align: right;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvLoginTitle
            {
                height: 32px;
                background-image: url(../images/CategoriTitles.jpg);
                background-repeat: no-repeat;
                color: #FFFFFF;
                padding-top: 5px;
                padding-right: 5px;
                font-weight: bold;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            /*Ends here*/
            /*Profile Controls*/
            #dvProfileControls
            {
                position: relative;
                float: left;
                width: 300px;
                height: auto;
                left: 40px;
                text-align: right;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvProfileControlTitle
            {
                height: 32px;
                background-image: url(../images/CategoriTitles.jpg);
                background-repeat: no-repeat;
                color: #FFFFFF;
                padding-top: 5px;
                padding-right: 5px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-weight: bold;
            }
            /*Ends here*/
            /*Profile Controls*/
            #dvSiteControls
            {
                position: relative;
                float: left;
                width: 300px;
                height: auto;
                left: 60px;
                text-align: right;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvSiteControlTitle
            {
                height: 32px;
                background-image: url(../images/CategoriTitles.jpg);
                background-repeat: no-repeat;
                color: #FFFFFF;
                padding-top: 5px;
                padding-right: 5px;
                font-weight: bold;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            /*Ends here*/
            #dvUpdateProfile
            {
                background-color: #f9c60b;
                width: 965px;
                text-align: right;
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
            .background
            {
                background-color: #fef5ce;
                font-family: Verdana, Arial, Helvetica, sans-serif;
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
            var count=Array()
            var ncount=Array()
            function OldCheckBoxChecked()
            {
                var chk=document.getElementsByName("chktag[]");
                var counter=0;
                for(j=0,i=0;i<chk.length;i++)
                {
                    if(chk[i].checked==true)
                    {
                        ncount[j]=i;
                        j++;
                    }
                }
            }
            function CheckProfileControlCheckBoxes()
            {                
                var chk=document.getElementsByName("chktag[]");                
                var count=Array()
                var counter=0;
                for(j=0,i=0;i<chk.length;i++)
                {
                    if(chk[i].checked==true)
                    {
                        counter++;
                        if(counter>3)
                        {
                            break;
                        }
                        else
                        {
                            count[j]=i;
                            j++;                            
                        }
                    }
                }
                if(counter>3)
                {
                    alert("Sorry, you can select only 3 Tags");
                    for(j=0;j<chk.length;j++)
                    {
                        chk[j].checked=false;
                    }
                    for(j=0;j<ncount.length;j++)
                    {
                        chk[ncount[j]].checked=true;
                    }
                }
                else
                {
                    for(j=0;j<chk.length;j++)
                    {
                        chk[j].checked=false;
                    }
                    for(j=0;j<count.length;j++)
                    {
                        chk[count[j]].checked=true;
                    }
                }
            }
            String.prototype.trim = function()
            {
                return this.replace(/(?:(?:^|\n)\s+|\s+(?:$|\n))/g,"");
            }
            flags=Array()
            
            function checkEmail()
            {
                var str=document.frmProfileControls.txtemail.value.trim()
                var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
                if(str!="")
                {
                    if(filter.test(str))
                    {
                        flags[0]=0;
                        document.getElementById("erremail").innerHTML="&nbsp;";
                        document.getElementById("flagemail").value="t";
                    }
                    else
                    {
                        flags[0]=1;
                        document.getElementById("erremail").innerHTML="Invalid Email";
                        document.getElementById("flagemail").value="f";
                        //return false;
                    }
                }
                else
                {
                    flags[0]=1
                    document.getElementById("erremail").innerHTML="required";
                    document.getElementById("flagemail").value="f";
                    //return false;
                }
            }
            function checkPassword()
            {
                var pswd=document.frmProfileControls.txtpassword.value.trim();
                if(pswd!="")
                {
                    pslen=pswd.length;
                    if(pslen < 6 || pslen >10)
                    {
                        flags[1]=1;
                        document.getElementById("errpassword").innerHTML="Password must be between 6 to 10 characters";
                        document.getElementById("flagpassword").value="f";
                        //return false;
                    }
                    else
                    {
                        flags[1]=0;
                        document.getElementById("errpassword").innerHTML="&nbsp;";
                        document.getElementById("flagpassword").value="t";
                    }
                }
                else
                {
                    flags[1]=1;
                    document.getElementById("errpassword").innerHTML="required";
                    document.getElementById("flagpassword").value="f";
                    //return false;
                }
            }

            function checkVerifyPassword()
            {
                var vfpswd=document.frmProfileControls.txtverifypassword.value.trim();
                var pswd=document.frmProfileControls.txtpassword.value.trim();
                if(vfpswd!="")
                {
                    if(vfpswd!=pswd)
                    {
                        flags[2]=1;
                        document.getElementById("errverifypassword").innerHTML="Password does not matched";
                        document.getElementById("flagverifypassword").value="f";
                        //return false;
                    }
                    else
                    {
                        flags[2]=0;
                        document.getElementById("errverifypassword").innerHTML="&nbsp;";
                        document.getElementById("flagverifypassword").value="t";
                    }
                }
                else
                {
                    flags[2]=1;
                    document.getElementById("errverifypassword").innerHTML="required";
                    document.getElementById("flagverifypassword").value="f";
                    //return false;
                }
            }
        </script>
    </head>
    <body onload="OldCheckBoxChecked();">
        <div id="dvMain" align="center">
            <div id="dvBanner">
                <?php
                if (isset($_SESSION['member'])) {
                ?>
                    <div id="dvLogin">
                        <a href="../logout.php" title="Logout"> logout </a> |
                        <a href="Comments.php?profileid=<?php echo $_SESSION['memberid']."&member=".$_SESSION['member']; ?>" title="Comments"> comments </a>|
                        <a href="Stuffs.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnMemberStuffPage']; ?>&profileid=<?php echo $_SESSION['memberid']."&member=".$_SESSION['member']; ?>" title="Stuffs"> stuff </a> |
                        <a href="Profile.php?profileid=<?php echo $_SESSION['memberid']."&member=".$_SESSION['member']; ?>" title="Member Profile"><?php echo $_SESSION['member']; ?></a>
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
                <form action="AddMyStuff.php" method="POST" name="frmaddstuff" onsubmit="return StuffValid();">
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
            </div>
            <!--Ads and Message ends here-->
            <div style="clear: both;"></div>
            <div id="dvProfileTitleAndSettings">
                <div id="dvProfileTitle">
                    Settings:<?php echo $_SESSION['member']; ?>
                </div>
                <div id="dvProfileSettings">
                    <a href="Profile.php?profileid=<?php echo $_SESSION['memberid']; ?>">Back to Profile</a>
                </div>
            </div>
            <div style="clear: both;"></div>
            <div id="dvOptions">
                <form id="frmProfileControls" name="frmProfileControls" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div id="dvLoginSection">
                    <div id="dvLoginTitle">
                        Login Details
                    </div>
                    <div id="LoginDetails">
                        <table>
                            <tr>
                                <td>Email</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" id="txtemail" name="txtemail" value="<?php echo $logindetails[0]['EmailID'] ?>" onblur="checkEmail();"/>
                                    <input type="hidden" id="flagemail" name="flagemail" value=""/>
                                </td>
                            </tr>
                            <tr>
                                <td id="erremail">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Password</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="password" id="txtpassword" name="txtpassword" value="" onblur="checkPassword();"/>
                                    <input type="hidden" id="flagpassword" name="flagpassword" value=""/>
                                </td>
                            </tr>
                            <tr>
                                <td id="errpassword">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Verify Password</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="password" id="txtverifypassword" name="txtverifypassword" value="" onblur="checkVerifyPassword();"/>
                                    <input type="hidden" id="flagverifypassword" name="flagverifypassword" value=""/>
                                </td>
                            </tr>
                            <tr>
                                <td id="errverifypassword">&nbsp;</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="dvProfileControls">
                    <div id="dvProfileControlTitle">
                        Profile Controls
                    </div>
                    <div id="dvProfileControlDetails">
                        <input type="checkbox" id="autoprofile" name="autoprofile"/>Automatic Profile
                        <hr/>
                        <ul style="list-style-type: none;padding: 0px;font-size: 10px;">
                            <?php
                                $objBoMemberProfileControls=new BoMemberProfileControls();
                                $objBoMemberProfileControls->setMemberId($_SESSION['memberid']);

                                $objProfileTags=new PlMemberProfileControls();
                                $tagsonhome=$objProfileTags->PlShowTagControlSettings($objBoMemberProfileControls);
                                $tagsonhome=explode("-",$tagsonhome[0]['TagsOnHome']);
                                for($i=0;$i<count($recordTags);$i++)
                                {
                                    if(in_array($recordTags[$i]['id'], $tagsonhome))
                                        echo "<li><input type='checkbox' id='chktag' name='chktag[]' value='".$recordTags[$i]['id']."' onclick='CheckProfileControlCheckBoxes();' checked/>".$recordTags[$i]['TagName']."</li>";
                                    else
                                        echo "<li><input type='checkbox' id='chktag' name='chktag[]' value='".$recordTags[$i]['id']."' onclick='CheckProfileControlCheckBoxes();'/>".$recordTags[$i]['TagName']."</li>";
                                    
                                }                                
                            ?>
                        </ul>
                    </div>
                </div>
                <div id="dvSiteControls">
                    <div id="dvSiteControlTitle">
                        Site Controls
                    </div>
                    <div id="dvSiteControlDetails">
                        <ul style="list-style-type: none;padding: 0px;font-size: 10px;">
                        <?php
                            //Show Newest Comments First
                            if($record[0]['NCF']=="Y")
                                echo "<li><input type='checkbox' id='chkncf' name='chkncf' value='Y' checked/>Show Newest Comments First</li>";
                            else
                                echo "<li><input type='checkbox' id='chkncf' name='chkncf' value=''/>Show Newest Comments First</li>";
                            //Only Friends Can See My Profile
                            if($record[0]['OFCSP']=="Y")
                                echo "<li><input type='checkbox' id='chkofcsp' name='chkofcsp' value='Y' checked/>Only Firends Can See My Profile</li>";
                            else
                                echo "<li><input type='checkbox' id='chkofcsp' name='chkofcsp' value=''/>Only Firends Can See My Profile</li>";
                            //Only Friends Can Comment in My Profile
                            if($record[0]['OFCC']=="Y")
                                echo "<li><input type='checkbox' id='chkofcc' name='chkofcc' value='Y' checked/>Only Friends Can Comment in My Profile</li>";
                            else
                                echo "<li><input type='checkbox' id='chkofcc' name='chkofcc' value=''/>Only Friends Can Comment in My Profile</li>";
                            //Email Me When Member Comment in My Profile
                            if($record[0]['EWMCP']=="Y")
                                echo "<li><input type='checkbox' id='chkewmcp' name='chkewmcp' value='Y' checked/>Email Me When Member Comment in My Profile</li>";
                            else
                                echo "<li><input type='checkbox' id='chkewmcp' name='chkewmcp' value=''/>Email Me When Member Comment in My Profile</li>";
                            //Email Me When Friend Request is Made
                            if($record[0]['EWFRM']=="Y")
                                echo "<li><input type='checkbox' id='chkewfrm' name='chkewfrm' value='Y' checked/>Email Me When Friend Request is Made</li>";
                            else
                                echo "<li><input type='checkbox' id='chkewfrm' name='chkewfrm' value=''/>Email Me When Friend Request is Made</li>";
                            //Email Me When Site Announcements
                            if($record[0]['EWFRM']=="Y")
                                echo "<li><input type='checkbox' id='chkesa' name='chkesa' value='Y' checked/>Email Me When Site Announcements</li>";
                            else
                                echo "<li><input type='checkbox' id='chkesa' name='chkesa' value=''/>Email Me When Site Announcements</li>";
                        ?>
                        </ul>
                    </div>
                </div>
                    <div style="clear: both;"></div>
            <span style='font-size: 1px;'>&nbsp;</span>
            <div id="dvUpdateProfile">
                <input type="submit" id="submit" name="submit" value="Update Profile"/>
            </div>
            <span style='font-size: 1px;'>&nbsp;</span>
                </form>
            </div>
            
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
