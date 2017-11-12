<?php
session_start();
if (!isset($_SESSION['member']) && !isset($_REQUEST['profileid']))
    header("location:login.php");
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

    header("location:EditMemberProfile.php?profileid=".$_SESSION['memberid']."&member=".$_SESSION['member']."&message=".$message);
    //header("profile.php?profileid=".$_REQUEST['profileid']."&member=".$_REQUEST['member']."&message=Member profile has been updated successfully.");
}
?>
