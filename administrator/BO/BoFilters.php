<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This class is defined for Sorting Stuff based on selection like
 * Created, Popular, Active Discussion
 *
 * @author DELL
 */
class BoFilters
{
    var $created;
    var $popular;
    var $activediscussion;

    function setCreated($value) { $this->created=$value; }
    function setPopular($value) { $this->popular=$value; }
    function setActiveDiscussion($value) { $this->activediscussion=$value; }

    function getCreated() { return $this->created; }
    function getPopular() { return $this->popular; }
    function getActiveDiscussion() { return $this->activediscussion; }
}
?>
