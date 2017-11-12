<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BllPeopleLike
 *
 * @author MACROSOFT-04
 */
class BllPeopleLike
{
    var $objConnection; // MySql Connection Object
    var $recordSet;
    var $stuffid;


    function  __construct() {}

    /**
     * This method is used to return Requested/Selected Category details
     * @param iny $id
     * @return array recordSet
     */

    function BllAddPeopleLike(BoStuff $objBoStuff)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $PeopleLikeRow=$this->BllIsPeopleExist($objBoStuff);
        if($PeopleLikeRow>0)
        {
            $this->BllUpdatePeopleLike($objBoStuff);
        }
        else
        {
            
            $query = "Insert Into tblPeopleLike (ID, StuffID, MemberID, CategoryID, Flag, CreatedDate) ";
            $query.="values (NULL, " . $objBoStuff->getId() . ", " . $_SESSION['memberid'] . ", ";
            $query.="" . $objBoStuff->getCategoryId(). ", 'Y', '" . Date("Y-m-d") . "')";
            
            $result=$this->objConnection->InsertQuery($query);            
            
            //$this->objConnection->Close();
            $this->BllShowPeopleLike($objBoStuff);
        }
    }

    function BllAddPeopleDontLike(BoStuff $objBoStuff)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $PeopleDontLikeRow=$this->BllIsPeopleExist($objBoStuff);
        if($PeopleDontLikeRow>0)
        {
            $this->BllUpdatePeopleDontLike($objBoStuff);
        }
        else
        {
        

        $query = "Insert Into tblPeopleLike (ID, StuffID, MemberID, CategoryID, Flag, CreatedDate)";
        $query.="values (NULL, " . $objBoStuff->getId() . ", " . $_SESSION['memberid'] . ", ";
        $query.="" . $objBoStuff->getCategoryId(). ", 'N', '" . Date("Y-m-d") . "')";
        $result=$this->objConnection->InsertQuery($query);
        
        //$this->objConnection->Close();
        $this->BllShowDontPeopleLike($objBoStuff);
        }
    }

    function BllIsPeopleExist(BoStuff $objBoStuff)
    {
        
        $SelectQuery="Select * From tblPeopleLike where MemberID=".$objBoStuff->getMemberId();
        $SelectQuery.=" and StuffID=".$objBoStuff->getId()." and CategoryID=".$objBoStuff->getCategoryId();
        
        
        $result=$this->objConnection->SelectQuery($SelectQuery);
        $Record=$this->objConnection->RowsCount($result);
        //$this->objConnection->Close();
        return $Record;
    }
    function BllUpdatePeopleLike(BoStuff $objBoStuff )
    {
        if(!isset($this->objConnection))
        {
            $this->objConnection=new MySQLConnection();
            $this->objConnection->Open();
        }
        $updatequery = "Update tblPeopleLike Set Flag='Y' where MemberID=" . $objBoStuff->getMemberId()." And StuffID=".$objBoStuff->getId();
        $result = $this->objConnection->DeleteQuery($updatequery);
        
        $this->BllShowPeopleLike($objBoStuff);
        //$this->objConnection->Close();
    }

    function BllUpdatePeopleDontLike(BoStuff $objBoStuff)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        $updatequery= " Update tblPeopleLike Set Flag='N' where MemberID=". $objBoStuff->getMemberId()." And StuffID=".$objBoStuff->getId();

        $result = $this->objConnection->UpdateQuery($updatequery);
        
        $this->BllShowDontPeopleLike($objBoStuff);
        //$this->objConnection->Close();
    }
    function BllShowPeopleLike(BoStuff $objBoStuff)
    {
        if(!isset($this->objConnection))
        {
            $this->objConnection=new MySQLConnection();
            $this->objConnection->Open();
        }
        $VoteQuery="Select count(tblPeopleLike.StuffID) As Likes From tblPeopleLike where Flag='Y' and StuffID=".$objBoStuff->getId()." Group By tblPeopleLike.MemberID";
        //echo $VoteQuery;;
        $result=$this->objConnection->SelectQuery($VoteQuery);
        $record=$this->objConnection->RecordSet($result);
        $LikeVotes=count($record);
        //$this->objConnection->Close();
        return $LikeVotes;
    }

    function BllShowDontPeopleLike(BoStuff $objBoStuff)
    {
        if(!isset($this->objConnection))
        {
            $this->objConnection=new MySQLConnection();
            $this->objConnection->Open();
        }
        $VoteQuery="Select count(tblPeopleLike.StuffID) As DontLikes From tblPeopleLike where Flag='N' and StuffID=".$objBoStuff->getId()." Group By tblPeopleLike.MemberID";
        $result=$this->objConnection->SelectQuery($VoteQuery);        
        $record=$this->objConnection->RecordSet($result);
        $DontLikeVotes=count($record);
        //$this->objConnection->Close();
        return $DontLikeVotes;
    }
}
?>
