<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BoCountry
 *
 * @author DELL
 */
class BoCountry
{
    var $id; //int
    var $countryname; //string

    function __construct(){}

    function setId($value) { $this->id=$value; }
    function setCountryName($value) { $this->countryname=$value; }

    function getId() { return $this->id; }
    function getCountryName() { return $this->countryname; }
}
?>
