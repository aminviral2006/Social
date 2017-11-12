<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BoSiteConfiguration
 *
 * @author DELL
 */
class BoSiteConfiguration
{
    var $id; //int Auto Incremented
    var $TotalStuffListOnHomePage; //int 3
    var $TotalCategoryListOnHomePage; //int 3
    var $TotalRandomTagListOnHomePage; //int 3
    var $TotalRecordsOnBrowseStuffPage; //int 3
    var $TotalRecordsOnBrowseSearchStuffPage; //int 3
    var $TotalRecordsOnBrowseCategoryPage; //int 3
    var $TotalRelatedCategory; //int 3

    var $TotalRecordsOnAdminMemberPage; //int 3
    var $TotalRecordsOnAdminTopicsPage; //int 3
    var $TotalRecordsOnAdminCategoryPage; //int 3
    var $TotalRecordsOnAdminStuffPage; //int 3
    var $TotalRecordsOnAdminMemberSearchPage; //int 3

    var $TotalRecordsOnTrustedMemberCategoryPage; //int 3
    var $TotalRecordsOnTrustedMemberStuffPage; //int 3

    var $TotalRecordsOnMemberStuffPage; //int 3
    var $TotalRecordsOnMemberCommentPage; //int 3
    var $TotalRecordsOnMemberInnerStuffPage; //int 3
    var $TotalRecordsOnMemberInnerCommentPage; //int 3
    var $TotalRecordsOnMemberFriendPage; //int 3
    var $ShowStuffBasedOnVotesOnHomePage; 

    function setId($value){ $this->id=$value; }
    function setTotalStuffListOnHomePage($value){ $this->TotalStuffListOnHomePage=$value; }
    function setTotalCategoryListOnHomePage($value){ $this->TotalCategoryListOnHomePage=$value; }
    function setTotalRandomTagListOnHomePage($value){ $this->TotalRandomTagListOnHomePage=$value; }
    function setTotalRecordsOnBrowseStuffPage($value){ $this->TotalRecordsOnBrowseStuffPage=$value; }
    function setTotalRecordsOnBrowseSearchStuffPage($value){ $this->TotalRecordsOnBrowseSearchStuffPage=$value; }
    function setTotalRecordsOnBrowseCategoryPage($value){ $this->TotalRecordsOnBrowseCategoryPage=$value; }
    function setTotalRelatedCategory($value){ $this->TotalRelatedCategory=$value; }

    function setTotalRecordsOnAdminMemberPage($value){ $this->TotalRecordsOnAdminMemberPage=$value; }
    function setTotalRecordsOnAdminTopicsPage($value){ $this->TotalRecordsOnAdminTopicsPage=$value; }
    function setTotalRecordsOnAdminCategoryPage($value){ $this->TotalRecordsOnAdminCategoryPage=$value; }
    function setTotalRecordsOnAdminStuffPage($value){ $this->TotalRecordsOnAdminStuffPage=$value; }
    function setTotalRecordsOnAdminMemberSearchPage($value){ $this->TotalRecordsOnAdminMemberSearchPage=$value; }

    function setTotalRecordsOnTrustedMemberCategoryPage($value){ $this->TotalRecordsOnTrustedMemberCategoryPage=$value; }
    function setTotalRecordsOnTrustedMemberStuffPage($value){ $this->TotalRecordsOnTrustedMemberStuffPage=$value; }

    function setTotalRecordsOnMemberStuffPage($value){ $this->TotalRecordsOnMemberStuffPage=$value; }
    function setTotalRecordsOnMemberCommentPage($value){ $this->TotalRecordsOnMemberCommentPage=$value; }
    function setTotalRecordsOnMemberInnerStuffPage($value){ $this->TotalRecordsOnMemberInnerStuffPage=$value; }
    function setTotalRecordsOnMemberInnerCommentPage($value){ $this->TotalRecordsOnMemberInnerCommentPage=$value; }
    function setTotalRecordsOnMemberFriendPage($value){ $this->TotalRecordsOnMemberFriendPage=$value; }
    function setShowStuffBasedOnVotesOnHomePage($value){ $this->ShowStuffBasedOnVotesOnHomePage=$value; }

    //Getters
    function getId(){ return $this->id; }
    function getTotalStuffListOnHomePage(){ return $this->TotalStuffListOnHomePage; }
    function getTotalCategoryListOnHomePage(){ return $this->TotalCategoryListOnHomePage; }
    function getTotalRandomTagListOnHomePage(){ return $this->TotalRandomTagListOnHomePage; }
    function getTotalRecordsOnBrowseStuffPage(){ return $this->TotalRecordsOnBrowseStuffPage; }
    function getTotalRecordsOnBrowseSearchStuffPage(){ return $this->TotalRecordsOnBrowseSearchStuffPage; }
    function getTotalRecordsOnBrowseCategoryPage(){ return $this->TotalRecordsOnBrowseCategoryPage; }
    function getTotalRelatedCategory(){ return $this->TotalRelatedCategory; }

    function getTotalRecordsOnAdminMemberPage(){ return $this->TotalRecordsOnAdminMemberPage; }
    function getTotalRecordsOnAdminTopicsPage(){ return $this->TotalRecordsOnAdminTopicsPage; }
    function getTotalRecordsOnAdminCategoryPage(){ return $this->TotalRecordsOnAdminCategoryPage; }
    function getTotalRecordsOnAdminStuffPage(){ return $this->TotalRecordsOnAdminStuffPage; }
    function getTotalRecordsOnAdminMemberSearchPage(){ return $this->TotalRecordsOnAdminMemberSearchPage; }

    function getTotalRecordsOnTrustedMemberCategoryPage(){ return $this->TotalRecordsOnTrustedMemberCategoryPage; }
    function getTotalRecordsOnTrustedMemberStuffPage(){ return $this->TotalRecordsOnTrustedMemberStuffPage; }
    function getTotalRecordsOnMemberStuffPage(){ return $this->TotalRecordsOnMemberStuffPage; }
    function getTotalRecordsOnMemberCommentPage(){ return $this->TotalRecordsOnMemberCommentPage; }
    function getTotalRecordsOnMemberInnerStuffPage(){ return $this->TotalRecordsOnMemberInnerStuffPage; }
    function getTotalRecordsOnMemberInnerCommentPage(){ return $this->TotalRecordsOnMemberInnerCommentPage; }
    function getTotalRecordsOnMemberFriendPage(){ return $this->TotalRecordsOnMemberFriendPage; }
    function getShowStuffBasedOnVotesOnHomePage(){ return $this->ShowStuffBasedOnVotesOnHomePage; }
}
?>
