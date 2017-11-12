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
        $objBoCategory=new BoCategory();
        $objBoCategory->setId($_REQUEST['id']);

        $objPlCategory=new PlCategory();
        $record=$objPlCategory->PlEditCategory($objBoCategory);

        $categorytitle=$record[0]['Title'];
        if($record[0]['Status']=="A")
            $aStatus="checked";
        else
            $iStatus="checked";
    }
    else if($_REQUEST['task']=="update") //checking whether the TASK is UPDATE
    {
        $objBoCategory=new BoCategory();
        $objBoCategory->setId($_REQUEST['id']);
        $objBoCategory->setTitle($_REQUEST['txttitle']);
        $objBoCategory->setStatus($_REQUEST['rdoStatus']);
        $objBoCategory->setMemberId($_SESSION['adminid']);

        $objPlCategory=new PlCategory();
        $msg=$objPlCategory->PlUpdateCategory($objBoCategory);
        header("location:DisplayCategories.php?page=1&ipp=20&msg=".$msg);
    }
?>
<form id="frmEditCategory" name="frmEditCategory" method="post" action="EditCategory.php">
    <table align="center" border='0' dir='rtl' cellpadding="5px" cellspacing="5px"
           style='font-size:12px;background-color: #FFCC66;height:20px;border: 1px solid black;'>
        <tr><th colspan="4">Category Details <hr/></th></tr>

        <tr>
            <td>Category Title</td>
            <td>:</td>
            <td colspan="2"><input style="width:100%;" type="text" id="txttitle" name="txttitle" value="<?php echo $categorytitle; ?>" /></td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td>
                <input type="radio" id="rdoStatus" name="rdoStatus" value="A" <?php echo $aStatus; ?> />Active
            </td>
            <td>
                <input type="radio" id="rdoStatus" name="rdoStatus" value="I" <?php echo $iStatus; ?> />InActive
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <input type="submit" id="submit" name="submit" value="Update"/>
                <input type="hidden" id="task" name="task" value="update"/>
                <input type="hidden" id="id" name="id" value="<?php echo $record[0]['id']; ?>"/>
            </td>
        </tr>
    </table>
</form>
<?php
    $contentTitle="Edit Category Details";
    $pageTitle="Category Information";
    $contentData=  ob_get_contents();
    ob_clean();
    require_once 'AdminHome.php';
}
?>
