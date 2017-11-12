<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BoMemberProfileSiteControls
 *
 * @author DELL
 */
class BoMemberProfileSiteControls
{
    var $id; //int P.K. tblMemberProfile
    var $memberid; //int F.K. Reference tblMemberRegistration
    var $ncf; //enum Newest Comment First
    var $ofcsp; //enum  Only Friends Can See My Profile
    var $ofcc; //enum Only Friends Can Comment in My Profile
    var $ewmcp; //enum Email Me When Member Comment in My Profile
    var $ewfrm; //enum Email Me When Friend Request is Made
    var $esa; //enum Email Me Site Announcments

    function __construct(){}

    function setId($value){ $this->id=$value; }
    function setMemberId($value){ $this->memberid=$value; }
    function setNCF($value){ $this->ncf=$value; }
    function setOFCSP($value){ $this->ofcsp=$value; }
    function setOFCC($value){ $this->ofcc=$value; }
    function setEWMCP($value){ $this->ewmcp=$value; }
    function setEWFRM($value){ $this->ewfrm=$value; }
    function setESA($value){ $this->esa=$value; }

    function getId(){ return $this->id; }
    function getMemberId(){ return $this->memberid; }
    function getNCF(){ return $this->ncf; }
    function getOFCSP(){ return $this->ofcsp; }
    function getOFCC(){ return $this->ofcc; }
    function getEWMCP(){ return $this->ewmcp; }
    function getEWFRM(){ return $this->ewfrm; }
    function getESA(){ return $this->esa; }
}
?>
