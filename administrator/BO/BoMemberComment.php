<?php

class BoMemberComment
{
    var $id;
    var $memberid;
    var $friendid;
    var $comment;
    var $createddate;

    function  __construct() {}

    function setID($value) { $this->id=$value; }
    function setMemberID($value) { $this->memberid=$value; }
    function setFriendID($value) { $this->friendid=$value; }
    function setComment($value) { $this->comment=$value; }
    function setCreatedDate($value) { $this->createddate=$value; }

    function getID() { return $this->id; }
    function getMemberID() { return $this->memberid; }
    function getFriendID() { return $this->friendid; }
    function getComment() { return $this->comment; }
    function getCreatedDate() { return $this->createddate; }

}
?>
