<?php

class BoStuff
{
    var $id; //int
    var $memberid; //int
    var $title; //string
    var $categoryid; //int
    var $categorytitle;
    var $tagid; //int
    var $rate; //int
    var $views; //int
    var $peoplelike; //int
    var $peopledontlike; //int
    var $status; //binary
    var $homepagestatus; //binary
    var $description; //String
    var $imagepath; //Image URL
    var $ids; //ids string

    function  __construct() {}

    function setId($value) { $this->id=$value; }

    function setMemberId($value) { $this->memberid=$value; }

    function setTitle($value) { $this->title=$value; }

    function setCategoryTitle($value) { $this->categorytitle=$value; }

    function setCategoryId($value) { $this->categoryid=$value; }

    function setTagId($value) { $this->tagid=$value; }

    function setRate($value){ $this->rate=$value; }

    function setViews($value) { $this->views=$value; }

    function setPeopleLike($value) { $this->peoplelike=$value; }

    function setPeopleDontLike($value) { $this->peopledontlike=$value; }

    function setStatus($value) { $this->status=$value; }

    function setHomePageStatus($value) { $this->homepagestatus=$value; }

    function setDescription($value) { $this->description=$value; }

    function setIds($value) { $this->ids=$value; }


    //Getters
    function getId() { return $this->id; }

    function getMemberId() { return $this->memberid; }

    function getTitle() { return $this->title; }

    function getCategoryTitle() { return $this->categorytitle; }

    function getCategoryId() { return $this->categoryid; }

    function getTagId() { return $this->tagid; }

    function getRate() { return $this->rate; }

    function getViews() { return $this->views; }

    function getPeopleLike() { return $this->peoplelike; }

    function getPeopleDontLike() { return $this->peopledontlike; }

    function getStatus() { return $this->status; }

    function getHomePageStatus() { return $this->homepagestatus; }

    function getDescription() { return $this->description; }

    function getIds() { $this->ids; }
}
?>
