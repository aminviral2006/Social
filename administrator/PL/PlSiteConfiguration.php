<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlSiteConfiguration
 *
 * @author DELL
 */
class PlSiteConfiguration
{
    var $objBllSiteConfiguration;
    var $rows;

    function  __construct() {}

    function PlGetSiteConfigurationDetails($id)
    {
        $this->objBllSiteConfiguration=new BllSiteConfiguration();
        $this->rows=$this->objBllSiteConfiguration->BllGetSiteConfigurationDetails($id);
        return $this->rows;
    }

    function PlUpdateSiteConfiguration(BoSiteConfiguration $objBo)
    {
        $this->objBllSiteConfiguration=new BllSiteConfiguration();
        $msg=$this->objBllSiteConfiguration->BllUpdateSiteConfiguration($objBo);
        return $msg;
    }
}
?>
