<?php
if(!isset ($_SESSION)) //checking whether $_SESSION has been started or not?
    session_start();
ob_start(); //Buffering the data
include_once '../commoninclude.php';

//checking whether $_REQUEST and TASK has been set or not
if(isset($_REQUEST) && isset($_REQUEST['task']))
{
    if($_REQUEST['task']=="edit") //checking whether the TASK is EDIT
    {
        $id=1;
        $objPlSiteConfiguration=new PlSiteConfiguration();
        $record=$objPlSiteConfiguration->PlGetSiteConfigurationDetails($id);

        $TotalStuffListOnHomePage=$record[0]['TotalStuffListOnHomePage'];
        $TotalCategoryListOnHomePage=$record[0]['TotalCategoryListOnHomePage'];
        $TotalRandomTagListOnHomePage=$record[0]['TotalRandomTagListOnHomePage'];
        $TotalRecordsOnBrowseStuffPage=$record[0]['TotalRecordsOnBrowseStuffPage'];
        $TotalRecordsOnBrowseSearchStuffPage=$record[0]['TotalRecordsOnBrowseSearchStuffPage'];
        $TotalRecordsOnBrowseCategoryPage=$record[0]['TotalRecordsOnBrowseCategoryPage'];
        $TotalRelatedCategory=$record[0]['TotalRelatedCategory'];

        $TotalRecordsOnAdminMemberPage=$record[0]['TotalRecordsOnAdminMemberPage'];
        $TotalRecordsOnAdminTopicsPage=$record[0]['TotalRecordsOnAdminTopicsPage'];
        $TotalRecordsOnAdminCategoryPage=$record[0]['TotalRecordsOnAdminCategoryPage'];
        $TotalRecordsOnAdminStuffPage=$record[0]['TotalRecordsOnAdminStuffPage'];
        $TotalRecordsOnAdminMemberSearchPage=$record[0]['TotalRecordsOnAdminMemberSearchPage'];

        $TotalRecordsOnTrustedMemberCategoryPage=$record[0]['TotalRecordsOnTrustedMemberCategoryPage'];
        $TotalRecordsOnTrustedMemberStuffPage=$record[0]['TotalRecordsOnTrustedMemberStuffPage'];

        $TotalRecordsOnMemberStuffPage=$record[0]['TotalRecordsOnMemberStuffPage'];
        $TotalRecordsOnMemberCommentPage=$record[0]['TotalRecordsOnMemberCommentPage'];
        $TotalRecordsOnMemberInnerStuffPage=$record[0]['TotalRecordsOnMemberInnerStuffPage'];
        $TotalRecordsOnMemberInnerCommentPage=$record[0]['TotalRecordsOnMemberInnerCommentPage'];
        $TotalRecordsOnMemberFriendPage=$record[0]['TotalRecordsOnMemberFriendPage'];
    }
    else if($_REQUEST['task']=="update") //checking whether the TASK is UPDATE
    {
        $id=$_REQUEST['id'];

        $objBoSiteConfiguration=new BoSiteConfiguration();
        $objBoSiteConfiguration->setId($id);
        $objBoSiteConfiguration->setTotalStuffListOnHomePage($_REQUEST['TotalStuffListOnHomePage']);
        $objBoSiteConfiguration->setTotalCategoryListOnHomePage($_REQUEST['TotalCategoryListOnHomePage']);
        $objBoSiteConfiguration->setTotalRandomTagListOnHomePage($_REQUEST['TotalRandomTagListOnHomePage']);
        $objBoSiteConfiguration->setTotalRecordsOnBrowseStuffPage($_REQUEST['TotalRecordsOnBrowseStuffPage']);
        $objBoSiteConfiguration->setTotalRecordsOnBrowseSearchStuffPage($_REQUEST['TotalRecordsOnBrowseSearchStuffPage']);
        $objBoSiteConfiguration->setTotalRecordsOnBrowseCategoryPage($_REQUEST['TotalRecordsOnBrowseCategoryPage']);
        $objBoSiteConfiguration->setTotalRelatedCategory($_REQUEST['TotalRelatedCategory']);

        $objBoSiteConfiguration->setTotalRecordsOnAdminMemberPage($_REQUEST['TotalRecordsOnAdminMemberPage']);
        $objBoSiteConfiguration->setTotalRecordsOnAdminTopicsPage($_REQUEST['TotalRecordsOnAdminTopicsPage']);
        $objBoSiteConfiguration->setTotalRecordsOnAdminCategoryPage($_REQUEST['TotalRecordsOnAdminCategoryPage']);
        $objBoSiteConfiguration->setTotalRecordsOnAdminStuffPage($_REQUEST['TotalRecordsOnAdminStuffPage']);
        $objBoSiteConfiguration->setTotalRecordsOnAdminStuffPage($_REQUEST['TotalRecordsOnAdminStuffPage']);
        $objBoSiteConfiguration->setTotalRecordsOnAdminMemberSearchPage($_REQUEST['TotalRecordsOnAdminMemberSearchPage']);

        $objBoSiteConfiguration->setTotalRecordsOnTrustedMemberCategoryPage($_REQUEST['TotalRecordsOnTrustedMemberCategoryPage']);
        $objBoSiteConfiguration->setTotalRecordsOnTrustedMemberStuffPage($_REQUEST['TotalRecordsOnTrustedMemberStuffPage']);

        $objBoSiteConfiguration->setTotalRecordsOnMemberStuffPage($_REQUEST['TotalRecordsOnMemberStuffPage']);
        $objBoSiteConfiguration->setTotalRecordsOnMemberCommentPage($_REQUEST['TotalRecordsOnMemberCommentPage']);
        $objBoSiteConfiguration->setTotalRecordsOnMemberInnerStuffPage($_REQUEST['TotalRecordsOnMemberInnerStuffPage']);
        $objBoSiteConfiguration->setTotalRecordsOnMemberInnerCommentPage($_REQUEST['TotalRecordsOnMemberInnerCommentPage']);
        $objBoSiteConfiguration->setTotalRecordsOnMemberFriendPage($_REQUEST['TotalRecordsOnMemberFriendPage']);
        $objBoSiteConfiguration->setShowStuffBasedOnVotesOnHomePage($_REQUEST['ShowStuffBasedOnVotesOnHomePage']);

        //echo $_REQUEST['ShowStuffBasedOnVotesOnHomePage'];die();
        $objPlSiteConfiguration=new PlSiteConfiguration();
        $msg=$objPlSiteConfiguration->PlUpdateSiteConfiguration($objBoSiteConfiguration);

        header("location:index.php?msg=".$msg);
    }
?>
<form id="frmSiteConfiguration" name="frmSiteConfiguration" method="post" action="SiteConfiguration.php">
    <table align="center" border='0' dir='rtl' cellpadding="5px" cellspacing="5px"
           style='font-size:12px;background-color: #FFCC66;height:20px;border: 1px solid black;'>
        <!--Guest User-->
        <tr><th colspan="4" title="Guest User Side Configuration"><hr/><?php echo SITE_CONFIG_GUEST_USER_SIDE; ?></th></tr>
        <tr>
            <td>1</td>
            <td title="No. of Stuffs Shown on Home Page"><?php echo NO_OF_STUFFS_ON_HOME_PAGE; ?></td>
            <td>:</td>
            <td><input style="width:40%;" type="text" id="TotalStuffListOnHomePage" name="TotalStuffListOnHomePage" value="<?php echo isset($record[0]['TotalStuffListOnHomePage'])?$record[0]['TotalStuffListOnHomePage']:20; ?>" /> / Page</td>
        </tr>
        <tr>
            <td>2</td>
            <td title="No. of Categories Shown on Home Page"><?php echo NO_OF_CATEGORIES_ON_HOME_PAGE; ?></td>
            <td>:</td>
            <td><input style="width:40%;" type="text" id="TotalCategoryListOnHomePage" name="TotalCategoryListOnHomePage" value="<?php echo isset($record[0]['TotalCategoryListOnHomePage'])?$record[0]['TotalCategoryListOnHomePage']:20; ?>" />  / Page</td>
        </tr>
        <tr>
            <td>3</td>
            <td title="No. of Random Stuffs Shown on Home Page"><?php echo NO_OF_RANDOM_STUFFS_ON_HOME_PAGE; ?></td>
            <td>:</td>
            <td><input style="width:40%;" type="text" id="TotalRandomTagListOnHomePage" name="TotalRandomTagListOnHomePage" value="<?php echo isset($record[0]['TotalRandomTagListOnHomePage'])?$record[0]['TotalRandomTagListOnHomePage']:20; ?>" />  / Page</td>
        </tr>
        <tr></tr>
        <tr>
            <td>4</td>
            <td title="No. of Stuffs on Browse Stuff Page"><?php echo NO_OF_STUFFS_ON_BROSE_STUFF_PAGE; ?></td>
            <td>:</td>
            <td><input style="width:40%;" type="text" id="TotalRecordsOnBrowseStuffPage" name="TotalRecordsOnBrowseStuffPage" value="<?php echo isset($record[0]['TotalRecordsOnBrowseStuffPage'])?$record[0]['TotalRecordsOnBrowseStuffPage']:20; ?>" />  / Page</td>
        </tr>
        <tr>
            <td>5</td>
            <td title="No. of Stuffs on Browse Search Stuff Page"><?php echo NO_OF_STUFFS_ON_BROSE_SEARCH_STUFF_PAGE; ?></td>
            <td>:</td>
            <td><input style="width:40%;" type="text" id="TotalRecordsOnBrowseSearchStuffPage" name="TotalRecordsOnBrowseSearchStuffPage" value="<?php echo isset($record[0]['TotalRecordsOnBrowseSearchStuffPage'])?$record[0]['TotalRecordsOnBrowseSearchStuffPage']:20; ?>" />  / Page</td>
        </tr>
        <tr>
            <td>6</td>
            <td title="No. of Stuffs on Browse Category Page"><?php echo NO_OF_STUFFS_ON_BROSE_CATEGORY_PAGE; ?></td>
            <td>:</td>
            <td><input style="width:40%;" type="text" id="TotalRecordsOnBrowseCategoryPage" name="TotalRecordsOnBrowseCategoryPage" value="<?php echo isset($record[0]['TotalRecordsOnBrowseCategoryPage'])?$record[0]['TotalRecordsOnBrowseCategoryPage']:20; ?>" />  / Page</td>
        </tr>
        <tr>
            <td>7</td>
            <td title="No. of Related Category Records on Stuff List Page(s)"><?php echo NO_OF_RELATED_CATEGORY_STUFF_LIST_PAGE; ?></td>
            <td>:</td>
            <td><input style="width:40%;" type="text" id="TotalRelatedCategory" name="TotalRelatedCategory" value="<?php echo isset($record[0]['TotalRelatedCategory'])?$record[0]['TotalRelatedCategory']:20; ?>" />  / Page</td>
        </tr>
        <!--Guest User-->

        <!--Administrator Side-->
        <tr><th colspan="4" title="Administrator Side"><hr/><?php echo SITE_CONFIG_ADMINISTRATOR_SIDE; ?></th></tr>
        <tr>
            <td>1</td>
            <td title="No. of Records on Members Page"><?php echo NO_OF_RECORDS_ON_MEMBER_PAGE; ?></td>
            <td>:</td>
            <td><input style="width:40%;" type="text" id="TotalRecordsOnAdminMemberPage" name="TotalRecordsOnAdminMemberPage" value="<?php echo isset($record[0]['TotalRecordsOnAdminMemberPage'])?$record[0]['TotalRecordsOnAdminMemberPage']:20; ?>" />  / Page</td>
        </tr>
        <tr>
            <td>2</td>
            <td title="No. of Records on Topics Page"><?php echo NO_OF_RECORDS_ON_TOPICS_PAGE; ?></td>
            <td>:</td>
            <td><input style="width:40%;" type="text" id="TotalRecordsOnAdminTopicsPage" name="TotalRecordsOnAdminTopicsPage" value="<?php echo isset($record[0]['TotalRecordsOnAdminTopicsPage'])?$record[0]['TotalRecordsOnAdminTopicsPage']:20; ?>" />  / Page</td>
        </tr>
        <tr>
            <td>3</td>
            <td title="No. of Records on Category Page"><?php echo NO_OF_RECORDS_ON_CATEGORY_PAGE; ?></td>
            <td>:</td>
            <td><input style="width:40%;" type="text" id="TotalRecordsOnAdminCategoryPage" name="TotalRecordsOnAdminCategoryPage" value="<?php echo isset($record[0]['TotalRecordsOnAdminCategoryPage'])?$record[0]['TotalRecordsOnAdminCategoryPage']:20; ?>" />  / Page</td>
        </tr>
        <tr>
            <td>4</td>
            <td title="No. of Records on Stuff Page"><?php echo NO_OF_RECORDS_ON_STUFFS_PAGE; ?></td>
            <td>:</td>
            <td><input style="width:40%;" type="text" id="TotalRecordsOnAdminStuffPage" name="TotalRecordsOnAdminStuffPage" value="<?php echo isset($record[0]['TotalRecordsOnAdminStuffPage'])?$record[0]['TotalRecordsOnAdminStuffPage']:20; ?>" />  / Page</td>
        </tr>
        <tr>
            <td>5</td>
            <td title="No. of Records on Member Search Page"><?php echo NO_OF_RECORDS_ON_MEMBER_SEARCH_PAGE; ?></td>
            <td>:</td>
            <td><input style="width:40%;" type="text" id="TotalRecordsOnAdminMemberSearchPage" name="TotalRecordsOnAdminMemberSearchPage" value="<?php echo isset($record[0]['TotalRecordsOnAdminMemberSearchPage'])?$record[0]['TotalRecordsOnAdminMemberSearchPage']:20; ?>" />  / Page</td>
        </tr>
        <!--Administrator Side-->

        <!--Trusted Member Side-->
        <tr><th colspan="4" title="Trusted Member Side"><hr/><?php echo SITE_CONFIG_TRUSTED_MEMBER_SIDE; ?></th></tr>
        <tr>
            <td>1</td>
            <td title="No. of Records on Category Page"><?php echo NO_OF_RECORDS_ON_CATEGORY_PAGE_TRUSTED; ?></td>
            <td>:</td>
            <td><input style="width:40%;" type="text" id="TotalRecordsOnTrustedMemberCategoryPage" name="TotalRecordsOnTrustedMemberCategoryPage" value="<?php echo isset($record[0]['TotalRecordsOnTrustedMemberCategoryPage'])?$record[0]['TotalRecordsOnTrustedMemberCategoryPage']:20; ?>" />  / Page</td>
        </tr>
        <tr>
            <td>2</td>
            <td title="No. of Records on Stuff Page"><?php echo NO_OF_RECORDS_ON_STUFFS_PAGE_TRUSTED; ?></td>
            <td>:</td>
            <td><input style="width:40%;" type="text" id="TotalRecordsOnTrustedMemberStuffPage" name="TotalRecordsOnTrustedMemberStuffPage" value="<?php echo isset($record[0]['TotalRecordsOnTrustedMemberStuffPage'])?$record[0]['TotalRecordsOnTrustedMemberStuffPage']:20; ?>" />  / Page</td>
        </tr>
        <!--Trusted Member Side-->

        <!--Member Profile Side-->
        <tr><th colspan="4" title="Member Profile Side"><hr/><?php echo SITE_CONFIG_MEMBER_PROFIDE_SIDE; ?></th></tr>
        <tr>
            <td>1</td>
            <td title="No. of Stuff Records on Member Profile Sub Page"><?php echo NO_OF_STUFFS_ON_MEMBER_PROFILE_SUB_PAGE; ?></td>
            <td>:</td>
            <td><input style="width:40%;" type="text" id="TotalRecordsOnMemberStuffPage" name="TotalRecordsOnMemberStuffPage" value="<?php echo isset($record[0]['TotalRecordsOnMemberStuffPage'])?$record[0]['TotalRecordsOnMemberStuffPage']:20; ?>" />  / Page</td>
        </tr>
        <tr>
            <td>2</td>
            <td title="No. of Comments on Member Profile Sub Page"><?php echo NO_OF_COMMENTS_ON_MEMBER_PROFILE_SUB_PAGE; ?></td>
            <td>:</td>
            <td><input style="width:40%;" type="text" id="TotalRecordsOnMemberCommentPage" name="TotalRecordsOnMemberCommentPage" value="<?php echo isset($record[0]['TotalRecordsOnMemberCommentPage'])?$record[0]['TotalRecordsOnMemberCommentPage']:20; ?>" />  / Page</td>
        </tr>
        <tr>
            <td>3</td>
            <td title="No. of Inner Stuff Records on Member Profile Main Page"><?php echo NO_OF_INNER_STUFFS_ON_MEMBER_PROFILE_SUB_PAGE; ?></td>
            <td>:</td>
            <td><input style="width:40%;" type="text" id="TotalRecordsOnMemberInnerStuffPage" name="TotalRecordsOnMemberInnerStuffPage" value="<?php echo isset($record[0]['TotalRecordsOnMemberInnerStuffPage'])?$record[0]['TotalRecordsOnMemberInnerStuffPage']:20; ?>" />  / Page</td>
        </tr>
        <tr>
            <td>4</td>
            <td title="No. of Inner Comment Records on Member Profile Main Page"><?php echo NO_OF_INNER_COMMENTS_ON_MEMBER_PROFILE_SUB_PAGE; ?></td>
            <td>:</td>
            <td><input style="width:40%;" type="text" id="TotalRecordsOnMemberInnerCommentPage" name="TotalRecordsOnMemberInnerCommentPage" value="<?php echo isset($record[0]['TotalRecordsOnMemberInnerCommentPage'])?$record[0]['TotalRecordsOnMemberInnerCommentPage']:20; ?>" />  / Page</td>
        </tr>
        <tr>
            <td>5</td>
            <td title="No. of Inner Friends Records on Member Profile Main Page"><?php echo NO_OF_INNER_FRIENDS_ON_MEMBER_PROFILE_SUB_PAGE; ?></td>
            <td>:</td>
            <td><input style="width:40%;" type="text" id="TotalRecordsOnMemberFriendPage" name="TotalRecordsOnMemberFriendPage" value="<?php echo isset($record[0]['TotalRecordsOnMemberFriendPage'])?$record[0]['TotalRecordsOnMemberFriendPage']:20; ?>" />  / Page</td>
        </tr>
        <tr>
            <td>6</td>
            <td title="Show Stuff on Collage Page based on Total Votes the Stuff Received"><?php echo NO_OF_STUFFS_ON_COLLEGE_PAGE; ?></td>
            <td>:</td>
            <td><input style="width:40%;" type="text" id="ShowStuffBasedOnVotesOnHomePage" name="ShowStuffBasedOnVotesOnHomePage" value="<?php echo isset($record[0]['ShowStuffBasedOnVotesOnHomePage'])?$record[0]['ShowStuffBasedOnVotesOnHomePage']:5; ?>" />  / Page</td>
        </tr>
        <!--Member Profile Side-->
        <tr>
            <td colspan="4" align="center">
                <input type="submit" id="submit" name="submit" value="<?php echo BUTTON_UPDATE; ?>"/>
                <input type="hidden" id="task" name="task" value="update"/>
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>"/>
            </td>
        </tr>
    </table>
</form>
<?php
    $contentTitle="Site Configuration";
    $pageTitle="Site Configuration";
    $contentData=  ob_get_contents();
    ob_clean();
    require_once 'AdminHome.php';
}
?>