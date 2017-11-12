<?php
/**
 * This class is used for Category Properties
 * @author Sumit Joshi
 * @version 1.0
 */
class BoCategory
{
    var $id; //int
    var $title; //string
    var $memberid; //int
    var $createddate; //date
    var $status; //string
    var $ids;
    
    function setId($value) { $this->id=$value; }
    function setTitle($value) { $this->title=$value; }
    function setMemberId($value) { $this->memberid=$value; }
    function setCreatedDate($value) { $this->createddate=$value; }
    function setStatus($value) { $this->status=$value; }
    function setIds($value){ $this->ids=$value; }

    function getId() { return $this->id; }
    function getTitle() { return $this->title; }
    function getMemberId() { return $this->memberid; }
    function getCreatedDate() { return $this->createddate; }
    function getStatus() { return $this->status; }
    function getIds(){ $this->ids; }
}
?>
