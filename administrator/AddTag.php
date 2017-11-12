<?php
if(!isset ($_SESSION)) //checking whether $_SESSION has been started or not?
    session_start();
ob_start(); //Buffering the data
include_once '../commoninclude.php';
$msg="";
//checking whether $_REQUEST and TASK has been set or not
if(isset($_REQUEST['task']) && $_REQUEST['task']=="save") //checking whether the TASK is UPDATE
{
    $objBoTag=new BoTags();
    $objBoTag->setTagName($_REQUEST['txttagname']);
    $objBoTag->setStatus($_REQUEST['rdoTagStatus']);

    $objPlTag=new PlTags();
    $msg=$objPlTag->PlAddTag($objBoTag);
    header("location:DisplayTags.php?page=1&ipp=20&msg=".$msg);
}
else
    $msg="";

?>
<form id="frmAddTag" name="frmAddTag" method="post" action="AddTag.php" onsubmit="return CheckTag();">
    <table align="center" border='0' dir='rtl' cellpadding="5px" cellspacing="5px"
           style='font-size:12px;background-color: #FFCC66;height:20px;border: 1px solid black;'>
        <tr><th colspan="4">Tag Details <hr/></th></tr>
        <tr>
            <td>Tag Name</td>
            <td>:</td>
            <td colspan="2"><input type="text" id="txttagname" name="txttagname"/></td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td>
                <input type="radio" id="rdoTagStatus" name="rdoTagStatus" value="A" checked/>Active
            </td>
            <td>
                <input type="radio" id="rdoTagStatus" name="rdoTagStatus" value="I"/>InActive
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <input type="submit" id="submit" name="submit" value="Save"/>
                <input type="hidden" id="task" name="task" value="save"/>                
            </td>
        </tr>
        <tr>
            <td id="errtagname" colspan="4">
                <?php
                    if(isset($msg))
                        echo $msg;
                    else
                        echo "";
                ?>
            </td>
        </tr>
    </table>
</form>
<?php
    $contentTitle="Insert Tag Details";
    $pageTitle="Tags Information";
    $contentData=  ob_get_contents();
    ob_clean();
    require_once 'AdminHome.php';
?>
