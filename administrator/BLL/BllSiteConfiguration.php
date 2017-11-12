<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BllSiteConfiguration
 *
 * @author DELL
 */
class BllSiteConfiguration
{
    var $objConnection; // MySql Connection Object
    var $recordSet;
    var $id;

    function  __construct() {}

    function BllGetSiteConfigurationDetails($id)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select * From tblSiteConfiguration";

        $result=  $this->objConnection->SelectQuery($query);
        $this->recordSet=  $this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllUpdateSiteConfiguration(BoSiteConfiguration $objBo)
    {
        $msg="";
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Update tblSiteConfiguration Set
                TotalStuffListOnHomePage=".$objBo->getTotalStuffListOnHomePage().",
                TotalCategoryListOnHomePage=".$objBo->getTotalCategoryListOnHomePage().",
                TotalRandomTagListOnHomePage=".$objBo->getTotalRandomTagListOnHomePage().",
                TotalRecordsOnBrowseStuffPage=".$objBo->getTotalRecordsOnBrowseStuffPage().",
                TotalRecordsOnBrowseSearchStuffPage=".$objBo->getTotalRecordsOnBrowseSearchStuffPage().",
                TotalRecordsOnBrowseCategoryPage=".$objBo->getTotalRecordsOnBrowseCategoryPage().",
                TotalRelatedCategory=".$objBo->getTotalRelatedCategory().",

                TotalRecordsOnAdminMemberPage=".$objBo->getTotalRecordsOnAdminMemberPage().",
                TotalRecordsOnAdminTopicsPage=".$objBo->getTotalRecordsOnAdminTopicsPage().",
                TotalRecordsOnAdminCategoryPage=".$objBo->getTotalRecordsOnAdminCategoryPage().",
                TotalRecordsOnAdminStuffPage=".$objBo->getTotalRecordsOnAdminStuffPage().",
                TotalRecordsOnAdminMemberSearchPage=".$objBo->getTotalRecordsOnAdminMemberSearchPage().",

                TotalRecordsOnTrustedMemberCategoryPage=".$objBo->getTotalRecordsOnTrustedMemberCategoryPage().",
                TotalRecordsOnTrustedMemberStuffPage=".$objBo->getTotalRecordsOnTrustedMemberStuffPage().",

                TotalRecordsOnMemberStuffPage=".$objBo->getTotalRecordsOnMemberStuffPage().",
                TotalRecordsOnMemberCommentPage=".$objBo->getTotalRecordsOnMemberCommentPage().",
                TotalRecordsOnMemberInnerStuffPage=".$objBo->getTotalRecordsOnMemberInnerStuffPage().",
                TotalRecordsOnMemberInnerCommentPage=".$objBo->getTotalRecordsOnMemberInnerCommentPage().",
                TotalRecordsOnMemberFriendPage=".$objBo->getTotalRecordsOnMemberFriendPage().",
                ShowStuffBasedOnVotesOnHomePage=".$objBo->getShowStuffBasedOnVotesOnHomePage()."
                Where Id=".$objBo->getId();

        //echo $query;die();
        if($this->objConnection->UpdateQuery($query)==true)
            $msg="Site Configuration updated successfully.";
        else
            $msg="There was no change in previous record.";

        $this->objConnection->Close();
        return $msg;
    }
}
?>
