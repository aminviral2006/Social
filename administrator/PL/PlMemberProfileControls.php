<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlMemberProfileConstrols
 *
 * @author DELL
 */
class PlMemberProfileControls
{
    var $objBllMemberProfileControls;
    var $recordSet=array();

    function PlShowTagControlSettings(BoMemberProfileControls $objBo)
    {
        $this->objBllMemberProfileControls=new BllMemberProfileControls();
        $this->recordSet=$this->objBllMemberProfileControls->BllShowTagControlSettings($objBo);
        return $this->recordSet;
    }

    function PlUpdateMemberProfileControls(BoMemberProfileControls $objBo)
    {
        $this->objBllMemberProfileControls=new BllMemberProfileControls();
        $msg=$this->objBllMemberProfileControls->BllUpdateMemberProfileControls($objBo);
        return $msg;
    }
}
?>
