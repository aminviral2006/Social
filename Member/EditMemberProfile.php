<?php
session_start();
if($_REQUEST['profileid']!=$_SESSION['memberid'])
    header("location:../index.php?msg=You are not allowed to see this page.");

if (!isset($_SESSION['member']) && !isset($_REQUEST['profileid']))
    header("location:login.php");
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600))
{
    // last request was more than 30 minates ago
    //session_destroy();   // destroy session data in storage
    //session_unset();     // unset $_SESSION variable for the runtime
    header("location:../logout.php");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

include_once '../commoninclude.php';
$profileImage = '';
$gender = '';
$year = '';
$month = '';
$day = '';
$gender = '';
$gendervisibility = '';
$birthdate = '';
$birthdatevisibility = '';
$country = '';
$countryvisibility = '';
$sexualpreference = '';
$sexualvisibility = '';
$relationshipstatus = '';
$relationshipvisibility = '';
$education = '';
$educationvisibility = '';
$children = '';
$childrenvisibility = '';
$about = '';
$message = "";
if (isset($_REQUEST['updateprofile']))
{
    $objBoMemberProfile = new BoMemberProfile();
    $objBoMemberProfile->setMemberId($_SESSION['memberid']);
    $objBoMemberProfile->setGender(isset($_REQUEST['sltgender']) ? $_REQUEST['sltgender'] : "");

    if (isset($_REQUEST['chkgender']) == 'Y')
        $objBoMemberProfile->setGenderVisibility('Y');
    else
        $objBoMemberProfile->setGenderVisibility('N');

    $birthdatestring = $_REQUEST['sltyear'] . "-" . $_REQUEST['sltmonth'] . "-" . $_REQUEST['sltday'];
    if($birthdatestring=="--")
        $objBoMemberProfile->setBirthDate(Date('0000-00-00'));
    else
        $objBoMemberProfile->setBirthDate($birthdatestring);
    if (isset($_REQUEST['chkbirthdate']) == 'Y')
        $objBoMemberProfile->setBirthDateVisibility('Y');
    else
        $objBoMemberProfile->setBirthDateVisibility('N');

    $objBoMemberProfile->setCountry(isset($_REQUEST['sltcountry']) ? $_REQUEST['sltcountry'] : 0);
    if (isset($_REQUEST['chkcountry']) == 'Y')
        $objBoMemberProfile->setCountryVisibility('Y');
    else
        $objBoMemberProfile->setCountryVisibility('N');

    if (isset($_REQUEST['rdosexualpreference']) == 'M')
        $objBoMemberProfile->setSexualPreference('M');
    else
        $objBoMemberProfile->setSexualPreference('W');

    if (isset($_REQUEST['chksexualpreference']) == 'Y')
        $objBoMemberProfile->setSexualVisibility('Y');
    else
        $objBoMemberProfile->setSexualVisibility('N');

    if (isset($_REQUEST['sltrelationship']) == '')
        $objBoMemberProfile->setRelationshipStatus('N');
    else
        $objBoMemberProfile->setRelationshipStatus($_REQUEST['sltrelationship']);

    if (isset($_REQUEST['chkrelationship']) == 'Y')
        $objBoMemberProfile->setRelationshipVisibility('Y');
    else
        $objBoMemberProfile->setRelationshipVisibility('N');

    if (isset($_REQUEST['slteducation']) == '')
        $objBoMemberProfile->setEducation('N');
    else
        $objBoMemberProfile->setEducation($_REQUEST['slteducation']);

    if (isset($_REQUEST['chkeducation']) == 'Y')
        $objBoMemberProfile->setEducationVisibility('Y');
    else
        $objBoMemberProfile->setEducationVisibility('N');

    if (isset($_REQUEST['chkchildrenyesno']) == 'Y')
        $objBoMemberProfile->setChildren('Y');
    else
        $objBoMemberProfile->setChildren('N');

    if (isset($_REQUEST['chkchildren']) == 'Y')
        $objBoMemberProfile->setChildrenVisibility('Y');
    else
        $objBoMemberProfile->setChildrenVisibility('N');

    $objBoMemberProfile->setAbout(trim($_REQUEST['tarabout']));

    
    $objPlMemberProfile = new PlMemberProfile();
    $msg = $objPlMemberProfile->PlUpdateMemberProfile($objBoMemberProfile);    
    
    if ($msg == "success") {

        $message = "<span style='font-size: 1px;'>&nbsp;</span>";
        $message.="<div id='dvMessage'";
        $message.=" style='width: 982px;
                visibility: visible;
                padding-top:4px;
                padding-bottom:4px;
                height:15px;
                display: block;
                text-align: right;
                color:brown;
                font-family: verdana;
                font-size: 14px;
                background-color: #B8ADF1;'>";
        $message.= "Profile updated successfully.";
        $message.="</div><span style='font-size: 1px;'>&nbsp;</span>";
    } else {
        $message = "<span style='font-size: 1px;'>&nbsp;</span>";
        $message.="<div id='dvMessage'";
        $message.=" style='width: 982px;
                    visibility: hidden;
                    height:15px;
                    display: none;
                    text-align: right;
                    color:brown;
                    font-family: verdana;
                    font-size: 14px;
                    background-color: #B8ADF1;'>";
        $message.="</div><span style='font-size: 1px;'>&nbsp;</span>";
    }
}
//Business Object
$objBoMemberProfile = new BoMemberProfile();
$objBoMemberProfile->setMemberId($_SESSION['memberid']);

//Presentation Layer Object
$objPlMember = new PlMemberProfile();
$record = $objPlMember->PlGetMemberProfileDetails($objBoMemberProfile);
$profileImage = isset($record[0]['ProfileImagePath']) ? 'MemberImages/' . $record[0]['ProfileImagePath'] : 'MemberImages/Default.jpg';
$gender = $objPlMember->PlFillGender($record[0]['Gender']);
$gendervisibility = $record[0]['GenderVisibility'];
$birthdate = $record[0]['BirthDate'];
$arrbirthdate = explode("-", $birthdate);

if (count($arrbirthdate) == 3) {
    $year = $objPlMember->PlFillBirthYear($arrbirthdate[0]);
    $month = $objPlMember->PlFillBirthMonth($arrbirthdate[1]);
    $day = $objPlMember->PlFillBirthDay($arrbirthdate[2]);
} else {
    $year = $objPlMember->PlFillBirthYear();
    $month = $objPlMember->PlFillBirthMonth();
    $day = $objPlMember->PlFillBirthDay();
}
$birthdatevisibility = $record[0]['BirthDateVisibility'];
$country = $objPlMember->PlFillCountry($record[0]['CountryID']);
$countryvisibility = $record[0]['CountryVisibility'];
$sexualpreference = $record[0]['SexualPreference'];
$sexualvisibility = $record[0]['SexualVisibility'];
$relationshipstatus = $objPlMember->PlFillRelationshipStatus($record[0]['RelationshipStatus']);
$relationshipvisibility = $record[0]['RelationshipVisibility'];
$education = $objPlMember->PlFillEducation($record[0]['Education']);
$educationvisibility = $record[0]['EducationVisibility'];
$children = $record[0]['Children'];
$childrenvisibility = $record[0]['ChildrenVisibility'];
$about = trim($record[0]['About']);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" lang="he" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Edit Member Profile</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
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
                font-size: 12px;
                margin-left: 10%;
                margin-right: 10%;
            }
            #dvBanner
            {
                position: relative;
                width: 100%;
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
                display: block;
                left: 10px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvAddStuffButton
            {
                position: absolute;
                float:left;
                top: 1px;
                left: 150px;
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
            #dvProfile
            {
                /*position: absolute;
                top:100px;
                left:2px;*/
                width: 980px;
                height: auto;
                z-index: 4;
                margin-left:auto;
                margin-right:auto;
                padding-top: 10px;
                padding-bottom: 10px;
                display:table; /*Maha Gilinder*/
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
                border: none;
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
                if(document.frmaddstuff.txtStuffname.value.trim()=="")
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
    </head>
    <body onload="TrimTextArea();">
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
                    <form id="frmAddStuff" name="frmSearch" method="post" action="">
                        <span style='font-size: 1px;'>&nbsp;</span>
                        <div id="dvAddStuffButton">
                            <a href="#" onclick="DisplayAddStuff();"> <img id="btnAddStuff" name="btnAddStuff" src='../images/AddStuff.png' width='175px' height='24px' alt='' border="0"/></a>
                        </div>
                        <div id="dvBrowseStuff">
                            <a href="../Stuff/BrowseStuff.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnBrowseStuffPage']; ?>"><img id="btnBrowser" name="btnBrowse" src='../images/BrowseStuff.png' width='130px' height='24px' alt='' border="0"/></a>
                        </div>
                    </form>
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
                            <td><input type="text" id="txtStuffname" name="txtStuffname" size="40"/></td>
                            <td align="left"><input type="submit" name="submit" id="submit" value="Add"/></td>
                        </tr>
                    </table>
                </form>
                <div style="float: left;"><a href='#' onclick="DisplayAddStuff();">Close</a></div>
            </div>

            <div id="dvMessageMain">
<?php
                if (isset($message))
                {
                    echo $message;
                }
?>
                <span style='font-size: 1px;'>&nbsp;</span>
            </div>
            <!--Edit Profile Section-->
            <div id="dvProfile">
                <form id='frmMemberProfile' name='frmMemberProfile' method='post' action='EditMemberProfile.php?profileid=<?php echo $_SESSION['memberid']; ?>&member=<?php echo $_SESSION['member'] ?>' enctype="multipart/form-data">
                    <table class='table' align='right' width='700px' border='0' dir='rtl'>
                        <caption>Member Profile</caption>
                        <tr>
                            <td align='left' width='130px'>Profile Image</td>
                            <td>:</td>
                            <td colspan='3'>
                                <table>
                                    <tr>
                                        <td>
<?php
                echo "<img src='" . $profileImage . "' width='128px' height='128px' style='border-style:solid;border-width: thin; padding: 1px' alt='Image Not found'/>";
                
?>
                                        </td>
                                        <td>
                                            <div id='dvbrowse'  valign='middle' style='font-size: 10px;font-weight: normal;' align='right'>
                                                We accept most image files<br>
                                                    <input type='file' id='file' name='file'/><br>
                                                        Minimum file size: 200px x 200px
                                                        </div>
                                                        </td>
                                                        </tr>
                                                        </table>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan='2'>&nbsp;</td>
                                                            <td colspan='3'><hr size='1' style='border-color: pink;'/></td>
                                                        </tr>
                                                        <tr>
                                                            <td align='left'>Gender</td>
                                                            <td>:</td>
                                                            <td colspan='2' align="right"><?php echo $gender;?>                                                      </td>
                                                            <td align='right'>
                                                                <?php
                                                                $genderchecked = "";
                                                                if ($gendervisibility == "Y") {
                                                                    $genderchecked = "checked";
                                                                    echo "<input type='checkbox' id='chkgender' name='chkgender' value='Y' $genderchecked/>Make Public";
                                                                } else {
                                                                    echo "<input type='checkbox' id='chkgender' name='chkgender' value='' $genderchecked/>Make Public";
                                                                }
                                                                ?>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan='2'>&nbsp;</td>
                                                            <td colspan='3'><hr size='1' style='border-color: pink;'/></td>
                                                        </tr>
                                                        <tr>
                                                            <td align='left'>Birth Date</td>
                                                            <td>:</td>
                                                            <td colspan='2' align='right'>
<?php
                                                                echo $year;
                                                                echo $month;
                                                                echo $day;
?>
                                                            </td>
                                                            <td align='right'>
                                                                <?php
                                                                $birthchecked = "";
                                                                if ($birthdatevisibility == "Y") {
                                                                    $birthchecked = "checked";
                                                                    echo "<input type='checkbox' id='chkbirthdate' name='chkbirthdate' value='Y' $birthchecked/>Make Public";
                                                                } else {
                                                                    echo "<input type='checkbox' id='chkbirthdate' name='chkbirthdate' value='' $birthchecked/>Make Public";
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan='2'>&nbsp;</td>
                                                            <td colspan='3'><hr size='1' style='border-color: pink;'/></td>
                                                        </tr>
                                                        <!--Country-->
                                                        <tr>
                                                            <td align='left'>Country</td>
                                                            <td>:</td>
                                                            <td colspan='2' align='right'>
<?php
                                                                echo $country;
?>
                                                            </td>
                                                            <td align='right'>
<?php
                                                                $countrychecked = "";
                                                                if ($countryvisibility == "Y") {
                                                                    $countrychecked = "checked";
                                                                    echo "<input type='checkbox' id='chkcountry' name='chkcountry' value='Y' $countrychecked/>Make Public";
                                                                } else {
                                                                    echo "<input type='checkbox' id='chkcountry' name='chkcountry' value='' $countrychecked/>Make Public";
                                                                }
?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan='2'>&nbsp;</td>
                                                            <td colspan='3'><hr size='1' style='border-color: pink;'/></td>
                                                        </tr>
                                                        <tr>
                                                            <td align='left'>Sexual Preference</td>
                                                            <td>:</td>
                                                            <td colspan='2' align="right">
                                                            <?php
                                                                $sexualpreferencechecked = "";
                                                                if ($sexualpreference == "M") {
                                                                    $sexualpreferencechecked = "checked";
                                                                    echo "
                                                                            <input type='radio' id='rdosexualpreference' name='rdosexualpreference' value='W'/>Women
                                                                            <input type='radio' id='rdosexualpreference' name='rdosexualpreference' value='M' $sexualpreferencechecked/>Men
                                                                         ";
                                                                } else {
                                                                    $sexualpreferencechecked = "checked";
                                                                    echo "
                                                                            <input type='radio' id='rdosexualpreference' name='rdosexualpreference' value='W' $sexualpreferencechecked/>Women
                                                                            <input type='radio' id='rdosexualpreference' name='rdosexualpreference' value='M'/>Men
                                                                         ";
                                                                }
                                                            ?>
                                                            </td>
                                                            <td align='right' >
                                                                <?php
                                                                $sexualchecked = "";
                                                                if ($sexualvisibility == "Y")
                                                                {
                                                                    $sexualchecked = "checked";
                                                                    echo "<input type='checkbox' id='chksexualpreference' name='chksexualpreference' value='Y' $sexualchecked/>Make Public";                                                                    
                                                                } 
                                                                else
                                                                {
                                                                    echo "<input type='checkbox' id='chksexualpreference' name='chksexualpreference' value='N' $sexualchecked/>Make Public";
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan='2'>&nbsp;</td>
                                                            <td colspan='3'><hr size='1' style='border-color: pink;'/></td>
                                                        </tr>
                                                        <tr>
                                                            <td align='left'>Relationship Status</td>
                                                            <td>:</td>
                                                            <td colspan='2' align="right">
                                                                <?php
                                                                echo $relationshipstatus;
                                                                ?>
                                                            </td>
                                                            <td align='right'>
                                                                <?php
                                                                $relationshipchecked = "";
                                                                if ($relationshipvisibility == "Y") {
                                                                    $relationshipchecked = "checked";
                                                                    echo "<input type='checkbox' id='chkrelationship' name='chkrelationship' value='Y' $relationshipchecked/>Make Public";
                                                                } else {
                                                                    echo "<input type='checkbox' id='chkrelationship' name='chkrelationship' value='' $relationshipchecked/>Make Public";
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan='2'>&nbsp;</td>
                                                            <td colspan='3'><hr size='1' style='border-color: pink;'/></td>
                                                        </tr>
                                                        <tr>
                                                            <td align='left'>Education</td>
                                                            <td>:</td>
                                                            <td colspan='2' align="right">
                                                                <?php
                                                                echo $education;
                                                                ?>
                                                            </td>
                                                            <td align='right'>
                                                                <?php
                                                                $ecucationchecked = "";
                                                                if ($educationvisibility == "Y") {
                                                                    $ecucationchecked = "checked";
                                                                    echo "<input type='checkbox' id='chkeducation' name='chkeducation' value='Y' $ecucationchecked/>Make Public";
                                                                } else {
                                                                    echo "<input type='checkbox' id='chkeducation' name='chkeducation' value='' $ecucationchecked/>Make Public";
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan='2'>&nbsp;</td>
                                                            <td colspan='3'><hr size='1' style='border-color: pink;'/></td>
                                                        </tr>
                                                        <tr>
                                                            <td align='left'>Children</td>
                                                            <td>:</td>
                                                            <td colspan='2' align="right">
                                                                <?php
                                                                $childrenyesno = "";
                                                                if ($children == "Y") {
                                                                    $childrenyesno = "checked";
                                                                    echo "<input type='checkbox' id='chkchildrenyesno' name='chkchildrenyesno' value='$children' $childrenyesno/>";
                                                                } else {
                                                                    echo "<input type='checkbox' id='chkchildrenyesno' name='chkchildrenyesno' value='$children' $childrenyesno/>";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td align='right'>
                                                                <?php
                                                                $childrenchecked = "";
                                                                if ($childrenvisibility == "Y") {
                                                                    $childrenchecked = "checked";
                                                                    echo "<input type='checkbox' id='chkchildren' name='chkchildren' value='Y' $childrenchecked/>Make Public";
                                                                } else {
                                                                    echo "<input type='checkbox' id='chkchildren' name='chkchildren' value='' $childrenchecked/>Make Public";
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan='2'>&nbsp;</td>
                                                            <td colspan='3'><hr size='1' style='border-color: pink;'/></td>
                                                        </tr>
                                                        <tr>
                                                            <td align='left'>About</td>
                                                            <td>:</td>
                                                            <td colspan='5' align="right">

                                                                <!--<textarea id='tarabout' name='tarabout' rows='7' cols='43' dir="rtl">
                                                                <?php //echo trim($about, "\t"); ?>
                                                                </textarea>-->
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
                                                                    $oFCKeditor = new FCKeditor('tarabout');
                                                                    //$oFCKeditor->BasePath = "FCKeditor/editor/";
                                                                    $oFCKeditor->Value    = trim($about, "\t");
                                                                    $oFCKeditor->Width    = 360;
                                                                    $oFCKeditor->Height   = 200;
                                                                    echo $oFCKeditor->CreateHtml();
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan='2'>&nbsp;</td>
                                                            <td colspan='3'><hr size='1' style='border-color: pink;'/></td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td colspan='6'>
                                                                <input type='submit' id='updateprofile' name='updateprofile' value='Update Profile'/>
                                                                <input type='submit' id='cancelprofile' name='cancelprofile' value='Cancel'/>
                                                            </td>
                                                        </tr>
                                                        </table>
                                                        </form>
                                                        </div>
                                                        <span style='font-size: 1px;'>&nbsp;</span>
                                                        </div>
                                                        <div id='dvFooter' align="center">
                                                            <!--<a href="#">home |</a> <a href="#">faq |</a>
                                                            <a href="#">privacy policy |</a> <a href="#">term and conditions |</a>
                                                            <a href="#">contact us |</a> <a href="#">rss feed |</a> <a href="#">bookmark this page</a><br/>
                                                            Copyright &copy;2010 Avigabso. Designed & Developed by <a href="http://themacrosoft.com">Macrosoft Solutions</a>-->
							    <?php include_once '../footers.php' ?>
                                                        </div>
                                                        </body>
                                                        </html>