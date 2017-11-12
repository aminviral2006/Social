<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlPeopleLike
 *
 * @author MACROSOFT-04
 */

class PlPeopleLike
{
    var $objBllPeopleLike;
    var $rows;

    function  __construct() {}

    function AddPeopleLike(BoStuff $objBoStuff)
    {
        $this->objBllPeopleLike=new BllPeopleLike();
        $LikeCount=$this->objBllPeopleLike->BllAddPeopleLike($objBoStuff);
        return $LikeCount;
    }

    function AddPeopleDontLike(BoStuff $objBoStuff)
    {
        $this->objBllPeopleLike=new BllPeopleLike();
        $DontLikeCount=$this->objBllPeopleLike->BllAddPeopleDontLike($objBoStuff);
        return $DontLikeCount;
    }

    function ShowPeopleLike(BoStuff $objBoStuff)
    {
        $this->objBllPeopleLike=new BllPeopleLike();
        $LikeCount=$this->objBllPeopleLike->BllShowPeopleLike($objBoStuff);
        return $LikeCount;
    }

    function ShowPeopleDontLike(BoStuff $objBoStuff)
    {
        $this->objBllPeopleLike=new BllPeopleLike();
        $DontLikeCount=$this->objBllPeopleLike->BllShowDontPeopleLike($objBoStuff);
        return $DontLikeCount;
    }
}
?>
