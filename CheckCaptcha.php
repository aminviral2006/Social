<?php
session_start();
if ($_SESSION['security_code'] == $_REQUEST['txtcaptcha'] && !empty($_SESSION['security_code']))
{
    // Insert you code for processing the form here, e.g emailing the submission, entering it into a database.
    echo "Success";
    //unset($_SESSION['security_code']);
}
else
{
    // Insert your code for showing an error message here
    /*$img="<div id=\"captchasection\">";
    $img.="<a href=\"#\" onclick=\"changeCaptcha();\">Change</a>";
    $img.="<img src=\"CaptchaSecurityImages.php\" id=\"imgcaptcha\" name=\"imgcaptcha\" alt=\"Image not found\"/></div>";*/
    echo "Failed";
}
?>
