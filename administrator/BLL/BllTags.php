<?php
//include_once ROOT.'Administrator/BO/BoTags.php';
class BllTags
{
    var $objConnection; //MySQL Connection object
    var $recordSet=array();

    function  __construct(){}

    /**
     * This method is used to return Requested/Selected Tag details
     * @param iny $id
     * @return array recordSet
     */
    function BllGetTagDetail(BoTags $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select * From tblTag Where Id=".$objBo->getId();
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    /**
     * Display on Admin Page
     * @return array recordSet
     */
    function BllGetAllTagsOnAdminPage($limit="")
    {        
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select * From tblTag Order By id Asc $limit";
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllTotalTags()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select * From tblTag Order By id Asc";
        $result=$this->objConnection->SelectQuery($query);
        $totalrecords=mysql_num_rows($result);

        $this->objConnection->Close();
        return $totalrecords;
    }

    /**
     * Display on AddCategory Page
     * @return array recordSet
     */
    function BllGetAllTags()
    {
        $query="Select * From tblTag Where Status='A' Order By TagName";
        
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);
        
        $this->objConnection->Close();
        return $this->recordSet;
    }

    /**
     *
     * @param string $tagname
     * @param string $status
     * @return string $msg
     */
    function BllAddTag(BoTags $objBo)
    {
        $msg="";
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $flag=$this->BllIsTagExist($objBo->getTagName());
        if($flag==false)
        {
            $query="Insert Into tblTag (TagName,Status) Values ('".$objBo->getTagName()."','".$objBo->getStatus()."')";
            if($this->objConnection->InsertQuery($query)==true)
                $msg="Tag inserted sucessfully.";
            else
                $msg="Tag does not inserted successfully.";                
        }
        else
            $msg="Tag already exist.";
        $this->objConnection->Close();
        return $msg;
    }

    /**
     *
     * @param <type> $tagname
     * @return boolean true on Success
     */
    function BllIsTagExist($tagname)
    {
        $query="Select TagName From tblTag Where TagName='".$tagname."'";
        $result=$this->objConnection->SelectQuery($query);
        $rowcount=$this->objConnection->RowsCount($result);
        if($rowcount==0)
            return false;
        else
            return true;
    }

    /**
     * This method is used to Update a Tag in tblTag. This method gets Business Object from PL.
     * @param string $tagname
     * @param string $status
     * @return string $msg
     */
    function BllUpdateTag(BoTags $objBo)
    {
        $msg="";
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Update tblTag Set TagName='".$objBo->getTagName()."', Status='".$objBo->getStatus()."' ";
        $query.=" Where Id=".$objBo->getId();
        if($this->objConnection->UpdateQuery($query)==true)
            $msg="Tag detail updated successfully.";
        else
            $msg="There was no change in previous record.";
        
        $this->objConnection->Close();
        return $msg;
    }

    /**
     *
     * @param int $id
     * @return string $msg
     */
    function BllDeleteTag(BoTags $objBo)
    {
        $msg="";
        $query="Delete From tblTag Where ID In (".$objBo->ids.")";
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        if($this->objConnection->DeleteQuery($query)==true)
            $msg="Record has been deleted successfully.";
        else
            $msg="Record does not deleted successfully.";
        $this->objConnection->Close();
        return $msg;
    }

    /* Statistics Page on Admin */
    function BllTotalTagListOnStatisticsPage()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select count(*) as TotalTag From tblTag";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet[0]['TotalTag'];
    }
    function BllTotalActiveTagListOnStatisticsPage()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select count(*) as TotalActiveTag From tblTag Where Status='A'";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet[0]['TotalActiveTag'];
    }

    function BllTotalInactiveTagListOnStatisticsPage()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select count(*) as TotalInactiveTag From tblTag Where Status='I'";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet[0]['TotalInactiveTag'];
    }
    /* Ends Here */
}
?>