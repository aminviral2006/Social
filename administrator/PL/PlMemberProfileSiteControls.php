<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlMemberProfileSiteControls
 *
 * @author DELL
 */
class PlMemberProfileSiteControls
{
    var $objBllMemberProfileSiteControls;



    /**
     * This method is used to Show Member Site Controls on Settings Page
     * @param BoMemberProfile $objBo
     * @return array $this->recordSet;
     */
    function PlShowMemberSiteControls(BoMemberProfileSiteControls $objBo)
    {
        $this->objBllMemberProfileSiteControls=new BllMemberProfileSiteControls();
        $this->recordSet=$this->objBllMemberProfileSiteControls->BllShowMemberSiteControls($objBo);
        return $this->recordSet;
    }

    function PlUpdateMemberSiteControls(BoMemberProfileSiteControls $objBo)
    {
        $this->objBllMemberProfileSiteControls=new BllMemberProfileSiteControls();
        $msg=$this->objBllMemberProfileSiteControls->BllUpdateMemberSiteControls($objBo);
        return $msg;
    }
}
?>
