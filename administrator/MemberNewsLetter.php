<?php
if (!session_start()) //checking whether $_SESSION has been started or not?
    session_start();
ob_start();
include_once '../commoninclude.php';
$objPlStuff = new PlStuff();
$showStuffs = $objPlStuff->PlShowLetestStuffInNewsLetter(10);

$objPlCategory = new PlCategory();
$showCategory = $objPlCategory->PlShowLatestCategoriesInNewsLetter(10);

$objPlMemberRegistration=new PlMemberRegistration();
$record=$objPlMemberRegistration->PlGetAllMembers();

for($i=0;$i<count($record);$i++)
{
    $showMemberStuff = $objPlStuff->PlShowMemberStuffInNewsLetter($record[$i]['id'], 10);

    $output="";
    $output.="
    <div style='font-family: Verdana, Arial, Helvetica, sans-serif;
         font-size:11px;
         background-color: #f4d4a6;
         width:750px;' align='center;border: 2px solid #000000;'>
        <div align='right'>
            <div>
                <a href='".SITE_URL."' style='text-decoration:none;'>
                    <img src='".SITE_URL."/images/NewsLetterLogo.png' style='height:125;width:750;' border='0'/>
                </a>
            </div>
            <div>
                <h3>Dear ".$record[$i]['Nickname'].",</h3><br/>
                This is your weekly news letter. <br>
                This is system generated news letter. Enjoy the Stuff.

                <br/>
                <br/>Regards.
                <br/>TheBest.com Team
            </div>
        </div>
        <div style='clear: both'></div>
    <br/>
    <div style='display: block;' align='center'>
    <table align='center' style='direction: rtl;border: 1px solid #000000;background-color: white;'>
        <tr>
            <th style='font-size:12px;text-align:center;'>Latest Stuffs</th>
            <th style='font-size:12px;text-align:center;'>Latest Categories</th>
        </tr>
        <tr>
            <td>
                <!--Latest Stuffs List-->".
                $showStuffs
            ."</td>
            <td>
                <!--Latest Categories List-->".
                $showCategory
            ."</td>
        </tr>
    </table>
    </div>

    <div style='clear: both'></div>
    <br>

    <div align='right'>
        <div style='font-weight: bold;background-color:#3e1a0f;color:white;height: 20px;width:100%;padding: 0px;'>
            Your latest stuff activities.
        </div>
        <br/>
        <div style='border:1px solid black;width:100%;display: table;'>".
                $showMemberStuff
        ."</div>
    </div>

    <div style='clear: both'></div>
    <br/>
    </div>";
    //echo $output;
    $flag=SendNewsLetterToMember($record[$i]['EmailID'], $output, "Weekly NewsLetter");    
}
header("location:index.php?msg=News Letter is sent to All Members");
function SendNewsLetterToMember($mailto,$message,$subject)
{
    require_once 'mail/class.phpmailer.php';
    $mailflag=0;
    try
    {
            $mail = new PHPMailer(true); //New instance, with exceptions enabled

            /*$body             = file_get_contents('contents.html');
            $body             = preg_replace('/\\\\/','', $body); //Strip backslashes*/
            $body=$message;

            $mail->IsSMTP();                           // tell the class to use SMTP
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->Port       = 465;                    // set the SMTP server port
            $mail->Host       = "ssl://smtp.gmail.com"; // SMTP server
            //$mail->Username   = "admin@sabsyp.com";     // SMTP server username
            $mail->Username   = "sumitjoshi@themacrosoft.com";     // SMTP server username
            $mail->Password   = "myisland";            // SMTP server password

            //$mail->IsSendmail();  // tell the class to use Sendmail

            $mail->AddReplyTo("sumitjoshi@themacrosoft.com","First Last");
            //$mail->AddAttachment('javaapplet.gif');
            $mail->From       = "sumitjoshi@themacrosoft.com";
            $mail->FromName   = "News Letter";

            $to = $mailto;
            $mail->AddAddress($to);

            $mail->Subject  = $subject;

            $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
            $mail->WordWrap   = 80; // set word wrap

            $mail->MsgHTML($body);

            $mail->IsHTML(true); // send as HTML

            $mail->Send();
            $mailflag="Mail sent";
    }
    catch (phpmailerException $e)
    {
        echo $e->errorMessage();
        $mailflag="Not sent";
    }
    return $mailflag;
}

$contentTitle="E-News Letter are being sent...";
$pageTitle="E-News Letter are being sent...";
$contentData=  ob_get_contents();
ob_clean();
require_once 'AdminHome.php';
?>