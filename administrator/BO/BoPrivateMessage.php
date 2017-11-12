<?php

class BoPrivateMessage
{
    var $id;
    var $memberid;
    var $friendname;
    var $message;
    var $createddate;
    var $flag;
    var $friendid;

    function  __construct() {}

    function setID($value) { $this->id=$value; }

    function setMemberID($value) { $this->memberid=$value; }

    function setFriendName($value) { $this->friendname=$value; }

    function setMessage($value) { $this->message=$value; }

    function setCreatedDate($value) { $this->createddate=$value; }

    function setFlag($value) { $this->flag=$value; }

    function setFriendID($value) { $this->friendid=$value; }

    function getID() { return $this->id; }

    function getMemberID() { return $this->memberid; }

    function getFriendName() { return $this->friendname; }

    function getMessage() { return $this->message; }

    function getCreatedDate() { return $this->createddate; }

    function getFlag() { return $this->flag; }

    function getFriendID() { return $this->friendid; }
}
?>
