<?php
if(!isset ($_SESSION)) //checking whether $_SESSION has been started or not?
    session_start();
ob_start(); //Buffering the data
include_once '../commoninclude.php';

//checking whether $_REQUEST and TASK has been set or not
if(isset($_REQUEST) && isset($_REQUEST['task']))
{
    $aStatus=""; //for Active Status
    $iStatus=""; //for InActive Status
    
    if($_REQUEST['task']=="edit") //checking whether the TASK is EDIT
    {
        $objBoTag=new BoTags();
        $objBoTag->setId($_REQUEST['id']);
    
        $objPlTag=new PlTags();
        $record=$objPlTag->PlEditTag($objBoTag);
    
        $tagname=$record[0]['TagName'];        
        if($record[0]['Status']=="A")
            $aStatus="checked";
        else
            $iStatus="checked";
    }
    else if($_REQUEST['task']=="update") //checking whether the TASK is UPDATE
    {
        $objBoTag=new BoTags();
        $objBoTag->setId($_REQUEST['id']);
        $objBoTag->setTagName($_REQUEST['txttagname']);
        $objBoTag->setStatus($_REQUEST['rdoTagStatus']);

        $objPlTag=new PlTags();
        $msg=$objPlTag->PlUpdateTag($objBoTag);
        header("location:DisplayTags.php?page=1&ipp=20&msg=".$msg);
    }    
?>
<form id="frmEditTag" name="frmEditTag" method="post" action="EditTag.php">
    <table align="center" border='0' dir='rtl' cellpadding="5px" cellspacing="5px" 
           style='font-size:12px;background-color: #FFCC66;height:20px;border: 1px solid black;'>
        <tr>
            <th colspan="4">Tag Details</th>
        </tr>
        <tr>
            <td >Tag Name</td>
            <td>:</td>
            <td colspan="2"><input style="width:100%;" type="text" id="txttagname" name="txttagname" value="<?php echo $tagname; ?>" /></td>
        </tr>
        <tr>
            <td >Status</td>
            <td>:</td>
            <td>
                <input type="radio" id="rdoTagStatus" name="rdoTagStatus" value="A" <?php echo $aStatus; ?> />Active
            </td>
            <td>
                <input type="radio" id="rdoTagStatus" name="rdoTagStatus" value="I" <?php echo $iStatus; ?> />InActive
            </td>
        </tr>
        <tr>
            <td colspan="4" align="center">
                <input type="submit" id="submit" name="submit" value="Update"/>
                <input type="hidden" id="task" name="task" value="update"/>
                <input type="hidden" id="id" name="id" value="<?php echo $record[0]['id']; ?>"/>
            </td>
        </tr>
    </table>
</form>
<?php
    $contentTitle="Edit Tag Details";
    $pageTitle="Tags Information";
    $contentData=  ob_get_contents();
    ob_clean();
    require_once 'AdminHome.php';
}
?>
