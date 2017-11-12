<?php
include_once '../commoninclude.php';
if(isset($_SESSION['member']))
    header("location:../index.php");
$msg = "";
//checking whether $_REQUEST and TASK has been set or not
if (isset($_REQUEST['submit']) && isset($_REQUEST['task']) && $_REQUEST['task'] == "save")
{
    //checking whether the TASK is SAVE
    $msg = "";
    $objBo = new BoMemberRegistration();
    $objBo->setNickname($_REQUEST['txtnickname']);
    $objBo->setEmailId($_REQUEST['txtemail']);
    $objBo->setUserPassword(md5($_REQUEST['txtpassword']));
    $objBo->setCaptchaCode($_REQUEST['txtCaptcha']);
    $objBo->setCreatedDate(Date('Y-m-d'));
    $objBo->setMemberStatus("A");
    $objBo->setOnlineStatus("F");
    $objBo->setMemberType("U");

    $objPlMember = new PlMemberRegistration();
    $msg = $objPlMember->PlRegisterMember($objBo);
    if ($msg == "exist")
    {
        $flag = "exist";
        $msg = "<img src='../Images/errorred.png' width='18px' height='18px'/>Member already exist. Please choose other UserName";
    } 
    else
    {
        header("location:Message.php?msg=" . $msg);
    }
}
$pageTitle = "Member Account";
$contentTitle = "Member Registration";
$contentData = ob_get_contents();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" lang="he" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <script src="../Js/Validation.js" type="text/javascript" language="JavaScript"></script>
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
                top: 3px;
                right:110px;
                /*float: right;*/
                color: black;
                display: block;
                font-size: 15px;
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
            #dvWhyJoin
            {
                position: relative;
                float: left;
                left: 20px;
                border-style: solid;
                border-width: thin;
                border-color: black;
                width: 300px;
                height: 200px;
                text-align: right;
                padding-right: 5px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvFormMain
            {
                float: right;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvContentTitle
            {
                width: 600px;
                height: 32px;
                z-index: 4;
                float: right;
                background-image: url(../images/MemberRegistration.jpg);
                background-repeat: no-repeat;
                border-style: solid;
                border-width: thin;
                display:block;
                color: white;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 14px;
                font-weight: bold;
                padding-top: 4px;
            }
            #dvSignUpForm
            {
                width: 400px;
                height: auto;
                z-index: 4;
                margin-left:auto;
                margin-right:auto;
                padding-top: 10px;
                padding-bottom: 10px;
                display:block; /*Maha Gilinder*/
                font-family: Verdana, Arial, Helvetica, sans-serif;
                text-align: right;
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
            .odd
            {
                background-color: #fef5ce;
                font-size: 13px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            .table
            {
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 12px;
                font-weight: bold;
            }
            tr, .table
            {
                height: 22px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            input[type='text']
            {
                border-style: solid;
                border-width: 2px;
                border-color: #233645;
                background-color: gainsboro;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            input[type='password']
            {
                border-style: solid;
                border-width: 2px;
                border-color: #233645;
                background-color: #b5b6b6;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
        </style>
    </head>
    <body>
        <div id='dvMain' align="center">
            <div id="dvBanner">
                <div id="dvLogin">
                   <!--<img src='member/memberimages/default.jpg' width='20px' height='20px' alt='' />|-->
                    <a href="Login.php" title="Login">התחבר</a> | <span class="spNotAMember" title="Not a Member">עדיין לא רשום ?</span>
                    <a href="Signup.php" title="Sign Up"> הרשם עכשיו </a>
                </div>
                <div style="position: absolute;float:left;left: 875px;width: 105px;height: 120px;">
                        <a href="../index.php" style="outline: none;">
                        <img src="../images/hotspot.png" border="0" alt=""/>
                        </a>
                </div>
                <div style="clear: both;"></div>
                <div id="dvMenuStrip">
                    <div id='dvMenuContents'>
                        <a href="../index.php" title="HOME"><?php echo HOME; ?></a> <a href="../faq.php" title="FAQ"><?php echo FAQ; ?></a>
                    </div>
                    <div style="clear: both;"></div>
                    <form id="frmSearch" name="frmSearch" method="post" action="">

                        <span style='font-size: 1px;'>&nbsp;</span>
                        <div id="dvAddStuffButton">
                            <input type="image" value="" id="btnSearch" name="btnAddStuff" src='../images/AddStuff.jpg' width='175px' height='24px' alt='' />
                        </div>
                    </form>
                    <span style='font-size: 1px;'>&nbsp;</span>
                    <div style="clear: both;"></div>
                    <div id="dvBrowseStuff">
                        <input type="image" value="" id="btnBrowser" name="btnBrowse" src='../images/BrowseStuff.png' width='130px' height='24px' alt='' />
                    </div>
                </div>
            </div>
            <span style='font-size: 1px;'>&nbsp;</span>
            <div id="dvErroMessage">
                <?php
                    if (isset($flag) && $flag == 'exist')
                    {
                        echo $msg;
                    }
                    else if(isset($_REQUEST['msg']))
                    {
                        echo $_REQUEST['msg'];
                    }
                    $msg="";
                ?>
            </div>
            <span style='font-size: 1px;'>&nbsp;</span>
            <span style='font-size: 1px;'>&nbsp;</span>
            <div style="clear: both;"></div>
            <div id="dvWhyJoin">
                <span style="font-family: verdana;font-size:18px;font-weight: bolder;" title="Why Join">למה להצטרף </span><br><br>
                <span style="font-family: verdana;font-size:12px;" title="details">על מנת שתוכלו להצביע , להגיב , להוסיף דברים טובים , ולהשתתף בחוויה עליכם להירשם</span><br><br>
                <span style="font-family: verdana;font-size:12px;" title="moredetails">
                    הצטרפו לאתר בתהליך קל ומהיר. ברגע שתרשמו , תוכלו להצביע עבור הדברים הטובים האהובים עליכם ולהוסיף כמה דברים טובים משלכם.
כמו כן תוכלו להכיר אנשים חדשים , ולקחת חלק בקהילה הפעילה שלנו סביב הדברים הטובים בעולם.

                </span>
                
            </div>
            <div id='dvContentTitle'>
                    <?php
                    if (isset($contentTitle))
                        echo $contentTitle;
                    ?>
                </div>
            <div id="dvFormMain">
                <span style='font-size: 1px;'>&nbsp;</span>
                
                <div>
                &nbsp;&nbsp;&nbsp;&nbsp;Already a member? <a href="Login.php">Login</a> | Confirmation email got lost? Click here
                </div>
                <hr>
                <!--Sign Up Form starts here-->
                <div id='dvSignUpForm'>
                    <form dir='rtl' id='frmSignUp' name='frmSignUp' method='post' action='SignUp.php' onsubmit='return ValidateMemberForm();'>
                        <table class='table' id='memberregistration' width='400px' dir='rtl'  align='right'>
                            <tr>
                                <td>Nick Name</td>
                            </tr>
                            <tr>
                                <td><input type='text' id='txtnickname' name='txtnickname' size='30' onblur='checkIsUserExist(this.value);'/></td>
                            </tr>
                            <tr>
                                <td style='color: red'><div id='errnickname'>&nbsp;</div>
                                </td>
                            </tr>
                            <tr>
                                <td>Email Address</td>
                            </tr>
                            <tr>
                                <td><input type='text' id='txtemail' name='txtemail' size='30' onblur='checkIsEmailExist(this.value);'/></td>
                            </tr>
                            <tr>
                                <td style='color: red'>
                                    <div id='erremail'>&nbsp;</div>
                                </td>
                            </tr>
                            <tr>
                                <td>Verify your Email Address</td>
                            </tr>
                            <tr>
                                <td><input type='text' id='txtverifyemail' name='txtverifyemail' size='30' onblur='checkVerifyEmail();'/></td>
                            </tr>
                            <tr>
                                <td style='color: red'>
                                    <div id='errverifyemail'>&nbsp;</div>
                                </td>
                            </tr>
                            <tr>
                                <td>Password</td>
                            </tr>
                            <tr>
                                <td><input type='password' id='txtpassword' name='txtpassword' size='30' onblur='checkPassword();'/></td>
                            </tr>
                            <tr>
                                <td style='color: red'>
                                    <div id='errpassword'>&nbsp;</div>
                                </td>
			    </tr>
                            <tr>
                                <td>Verify Password</td>
                            </tr>
                            <tr>
                                <td><input type='password' id='txtverifypassword' name='txtverifypassword' size='30' onblur='checkVerifyPassword();'/></td>
                            </tr>
                            <tr>
                                <td style='color: red'>
                                    <div id='errverifypassword'>&nbsp;</div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'>Human Check</td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <input id='btnCaptcha' type='button' value='Change Captcha' name='btnCaptcha' onclick='ChangeCaptcha();'/>
                                    </div>
                                    <div><img id='imgCaptcha' src='create_image.php' /></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input id='txtCaptcha' type='text' name='txtCaptcha' value='' maxlength='10' size='30' onblur='getParam(document.frmSignUp);' />
                                </td>
                            </tr>
                            <tr>
                                <td style='color: red'>
                                    <div id='errcaptcha'>&nbsp;</div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'>
                                    <input type='submit' id='submit' name='submit' value='Create Account'/>
                                    <input type='hidden' id='task' name='task' value=''/>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2' style='font-family: verdana; font-size: 12px; color:red;'>
                                    
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <!--Sign up Form ends here-->
            <div style="clear: both;"></div>
        </div> <!--Main Div -->
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