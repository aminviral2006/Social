<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BoMemberProfileControls
 *
 * @author DELL
 */
class BoMemberProfileControls
{
    var $id; //int P.K. tblMemberProfile
    var $memberid; //int F.K. Reference tblMemberRegistration
    var $tagsonhome; //Tags List

    function __construct(){}

    function setId($value){ $this->id=$value; }
    function setMemberId($value){ $this->memberid=$value; }
    function setTagsOnHome($value){ $this->tagsonhome=$value; }

    function getId(){ return $this->id; }
    function getMemberId(){ return $this->memberid; }
    function getTagsOnHome(){ return $this->tagsonhome; }
}
?>
