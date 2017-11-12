<?php
if(!isset ($_SESSION)) //checking whether $_SESSION has been started or not?
    session_start();
ob_start(); //Buffering the data
include_once '../commoninclude.php';

/**/
include_once '../FCKEditor/fckeditor.php';
function nukeMagicQuotes()
{
    if (get_magic_quotes_gpc ())
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

//checking whether $_REQUEST and TASK has been set or not
if(isset($_REQUEST) && isset($_REQUEST['submit']))
{
        $message=$_REQUEST['message'];
        $objPlSendMessageToAll=new PlPrivateMessage();
        $objPlSendMessageToAll->PlSendMessageToAllByAdmin($message);
        header("location:SendMessageToAllMembers.php?msg=Message has been sent to All Members");
}
else
{
?>
<form id="frmMessage" name="frmMessage" method="post" action="SendMessageToAllMembers.php">
    <table align="center" border='0' dir='rtl' cellpadding="5px" cellspacing="5px"
           style='font-size:12px;background-color: #FFCC66;height:20px;border: 1px solid black;'>
        <tr><th colspan="4">Send Message To All Members<hr/></th></tr>

        <tr>
            <td>Message</td>
            <td>:</td>
            <td colspan="2">
                <?php
                    nukeMagicQuotes();
                    $oFCKeditor = new FCKeditor("message");
                    $oFCKeditor->Value = "";
                    $oFCKeditor->Width = 295;
                    $oFCKeditor->Height = 130;
                    echo $oFCKeditor->CreateHtml();
                ?>
            </td>
        </tr>        
        <tr>
            <td colspan="4" align="center">
                <input type="submit" id="submit" name="submit" value="Send"/>
                <input type="hidden" id="task" name="task" value="send"/>
            </td>
        </tr>
    </table>
</form>
<?php
}
$contentTitle="Send Message To All Members";
$pageTitle="Send Message To All Members";
$contentData=  ob_get_contents();
ob_clean();
require_once 'AdminHome.php';
?>