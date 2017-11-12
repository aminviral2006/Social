<?php

/**
 * This class contains field description about MemberRegistratin Table
 *
 * @author Sumit Joshi
 */
class BoMemberRegistration
{
    var $id; //int
    var $nickname; //string joshisumit
    var $emailid; //string example@domain.com
    var $userpassword; //string *******
    var $captchacode; //string 1111
    var $createddate; //date
    var $memberstatus; //string A-active, I-inactive, B-blocked
    var $onlinestatus; //string O-online, F-offline, R-registered
    var $membertype; //string U-user, T-trusted member, A-admin
    var $ids; //string

    function  __construct() {}


    function setId($value)
    {
        $this->id=$value;
    }

    function setNickname($value)
    {
        $this->nickname=$value;
    }

    function setEmailId($value)
    {
        $this->emailid=$value;
    }

    function setUserPassword($value)
    {
        $this->userpassword=$value;
    }

    function setCaptchaCode($value)
    {
        $this->captchacode=$value;
    }

    function setCreatedDate($value)
    {
        $this->createddate=$value;
    }

    function setMemberStatus($value)
    {
        $this->memberstatus=$value;
    }

    function setOnlineStatus($value)
    {
        $this->onlinestatus=$value;
    }

    function setMemberType($value)
    {
        $this->membertype=$value;
    }

    function setIds($value)
    {
        $this->ids=$value;
    }
    
    //Getters
    function getId()
    {
        return $this->id;
    }

    function getNickname()
    {
        return $this->nickname;
    }

    function getEmailId()
    {
        return $this->emailid;
    }

    function getUserPassword()
    {
        return $this->userpassword;
    }

    function getCaptchaCode()
    {
        return $this->captchacode;
    }

    function getCreatedDate()
    {
        return $this->createddate;
    }

    function getMemberStatus()
    {
        return $this->memberstatus;
    }

    function getOnlineStatus()
    {
        return $this->onlinestatus;
    }

    function getMemberType()
    {
        return $this->membertype;
    }

    function getIds()
    {
        return $this->ids;
    }
}
?>
