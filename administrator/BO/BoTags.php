<?php
class BoTags
{
    var $id; //int
    var $tagname; //string
    var $status; //string
    var $ids; //string

    function  __construct() {}

    function setId($value)
    {
        $this->id=$value;
    }

    function setTagName($value)
    {
        $this->tagname=$value;
    }

    function setStatus($value)
    {
        $this->status=$value;
    }

    function setIds($value)
    {
        $this->ids=$value;
    }

    function getId()
    {
        return $this->id;
    }

    function getTagName()
    {
        return $this->tagname;
    }

    function getStatus()
    {
        return $this->status;
    }

    function getIds()
    {
        $this->ids;
    }
}
?>
