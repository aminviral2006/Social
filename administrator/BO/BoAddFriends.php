<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This class is used to defines Properties for tblAddFriend
 * Description of BoAddFriends
 * @author Sumit Joshi
 * @version 1.0
 */
class BoAddFriends
{
    var $id; //int P.K. tblAddFriend
    var $memberid; //int Member who requested F.K. Reference tblMemberRegistration
    var $friendid; //int Member who has accepted request F.K. Reference tblMemberRegistration
    var $createddate; //date
    var $approved; //string A=>Approved, R=>Reject, D=>Delete

    function setId($value) { $this->id=$value; }
    function setMemberId($value) { $this->memberid=$value; }
    function setFriendId($value) { $this->friendid=$value; }
    function setCreatedDate($value) { $this->createddate=$value; }
    function setApproved($value) { $this->approved=$value; }

    function getId() { return $this->id; }
    function getMemberId() { return $this->memberid; }
    function getFriendId() { return $this->friendid; }
    function getCreatedDate() { return $this->createddate; }
    function getApproved() { return $this->approved; }
}
?>
