<?php
/**
 * This class is used for Stuff's Category
 * @author Sumit Joshi
 * @version 1.0
 */
class BllCategory
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
    function BllGetCategoryDetail(BoCategory $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select * From tblCategory Where Id=".$objBo->getId();
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    /**
     * This method is used to Display Related Categories on Browse Stuff and Browse Search Stuff Pages
     * @param <type> $limit
     * @param <type> $relatedCategoryArray
     * @return <type>
     */
    function BllShowRelatedCategory($limit,$relatedCategoryArray)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select id,Title From tblCategory Where Status='A' And Title In (".$relatedCategoryArray.") Order By rand() Desc limit 0,$limit";
        
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    /**
     * This method is used On Main Home Page
     * @param <type> $limit
     * @return <type>
     */
    function BllShowCategoryOnHome($limit)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        
        $query="Select id,Title From tblCategory Where Status='A' Order By ID Desc limit 0,$limit";
        
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllShowCategories($limit)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select ID,Title From tblCategory Where Status='A' order by ID Desc limit 0,$limit";
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    /**
     * This method is used to Add Category
     * @param string $objBo Category Business object
     * @return string $msg
     */
    function BllAddCategory(BoCategory $objBo)
    {
        $msg="";
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $flag=$this->BllIsCategoryExist($objBo->getTitle());
        if($flag==false)
        {
            $query="Insert Into tblCategory (Title,MemberID,CreatedDate,Status) Values ";
            $query.="('".$objBo->getTitle()."',".$objBo->getMemberId().",";
            $query.="'".$objBo->getCreatedDate()."','".$objBo->getStatus()."')";
            if($this->objConnection->InsertQuery($query)==true)
                $msg="Category inserted sucessfully.";
            else
                $msg="Category does not inserted successfully.";
        }
        else
            $msg="Category already exist.";
        $this->objConnection->Close();
        return $msg;
    }

    /**
     * This method is used to check Whether Category Exist or Not?
     * @param string $categoryname
     * @return boolean true on Success
     */
    function BllIsCategoryExist($categoryname)
    {
        $query="Select Title From tblCategory Where Title='".$categoryname."'";
        $result=$this->objConnection->SelectQuery($query);
        $rowcount=$this->objConnection->RowsCount($result);
        if($rowcount==0)
            return false;
        else
            return true;
    }

    /**
     * This method is used to Update a Category in tblCategory. This method gets Business Object from PL.
     * @param BoCategory $objBo
     * @return string $msg
     */
    function BllUpdateCategory(BoCategory $objBo)
    {
        $msg="";
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Update tblCategory Set Title='".$objBo->getTitle()."',MemberID=".$objBo->getMemberId().",";
        $query.="CreatedDate='".date('Y-m-d')."', Status='".$objBo->getStatus()."' ";
        $query.=" Where Id=".$objBo->getId();
        echo $query;
        if($this->objConnection->UpdateQuery($query)==true)
            $msg="Category detail updated successfully.";
        else
            $msg="There was no change in previous record.";

        $this->objConnection->Close();
        return $msg;
    }

    /**
     * This method is used to delete record(s)
     * @param int $id
     * @return string $msg
     */
    function BllDeleteCategory(BoCategory $objBo)
    {
        $msg="";
        $query="Delete From tblCategory Where ID In (".$objBo->ids.")";
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        if($this->objConnection->DeleteQuery($query)==true)
            $msg="Record has been deleted successfully.";
        else
            $msg="Record does not deleted successfully.";
        $this->objConnection->Close();
        return $msg;
    }

    /**
     * This method is used to return Requested/Selected Category details
     * @param iny $id
     * @return array recordSet
     */
    function BllGetAllCategories($limit="")
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select tblCategory.id,tblCategory.Title,tblCategory.MemberID,tblMemberRegistration.NickName,tblCategory.CreatedDate,tblCategory.Status ";
        $query.="From tblCategory Inner Join tblMemberRegistration on tblCategory.MemberID=tblMemberRegistration.ID ";
        $query.=" Order By tblCategory.id Desc $limit";
        
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    /**
     * This Method is used to Count Total Categories in tblCategory
     * @return <int> $totalrecords
     */
    function BllTotalCategories()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select tblCategory.id,tblCategory.Title,tblCategory.MemberID,tblMemberRegistration.NickName,tblCategory.CreatedDate,tblCategory.Status ";
        $query.="From tblCategory Inner Join tblMemberRegistration on tblCategory.MemberID=tblMemberRegistration.ID ";
        $query.=" Order By tblCategory.CreatedDate Desc";
        $result=$this->objConnection->SelectQuery($query);
        $totalrecords=mysql_num_rows($result);

        $this->objConnection->Close();
        return $totalrecords;
    }

    function BllShowVotesByCategories(BoStuff $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT tblPeopleLike.CategoryID,tblCategory.Title,count(tblPeopleLike.CategoryID) as TotalPeople
                FROM tblPeopleLike ,tblCategory
                Where tblPeopleLike.CategoryID=tblCategory.ID
                And tblPeopleLike.StuffID=".$objBo->getId()." And tblCategory.Status='A' 
                Group by tblPeopleLike.CategoryID limit 0,10";
        
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllShowStuffBasedOnVotesByCategories($categoryid)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT tblCategory.Title as CategoryTitle,tblStuff.ID, tblStuff.Title as StuffTitle,
                count(tblStuff.Title) as TotalCount
                FROM tblPeopleLike, tblStuff, tblCategory
                WHERE tblPeopleLike.StuffID = tblStuff.ID
                AND tblPeopleLike.CategoryID = tblCategory.ID
                AND tblCategory.ID=".$categoryid." Group By tblStuff.Title limit 0,10";

        
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    /* Statistics Page on Admin */
    function BllTotalCategoryListOnStatisticsPage()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select count(*) as TotalCategory From tblCategory";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet[0]['TotalCategory'];
    }

    function BllTotalActiveCategoryListOnStatisticsPage()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select count(*) as TotalActiveCategory From tblCategory Where Status='A'";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet[0]['TotalActiveCategory'];
    }

    function BllTotalInactiveCategoryListOnStatisticsPage()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select count(*) as TotalInactiveCategory From tblCategory Where Status='I'";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet[0]['TotalInactiveCategory'];
    }
    /* Ends here*/

    //Edited By Viral on 24/11/2010
    function BllGetAllActiveCategories($limit="", $status="")
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select tblCategory.id,tblCategory.Title,tblCategory.MemberID,tblMemberRegistration.NickName,tblCategory.CreatedDate,tblCategory.Status ";
        $query.="From tblCategory Inner Join tblMemberRegistration on tblCategory.MemberID=tblMemberRegistration.ID ";
        $query.="Where tblCategory.Status='".$status."'";
        $query.=" Order By tblCategory.id Desc $limit";
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    //Ends

    //Searching Categories on Admin Page
    /**
     * This method is used to return Requested/Selected Category details
     * @param iny $id
     * @return array recordSet
     */
    function BllGetSearchedCategoriesOnAdminPage($limit="",$search="")
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select tblCategory.id,tblCategory.Title,tblCategory.MemberID,tblMemberRegistration.NickName,tblCategory.CreatedDate,tblCategory.Status ";
        $query.="From tblCategory Inner Join tblMemberRegistration on tblCategory.MemberID=tblMemberRegistration.ID ";
        $query.="Where tblCategory.Title Like '%".$search."%'";
        $query.=" Order By tblCategory.id Desc $limit";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    /**
     * This Method is used to Count Total Categories in tblCategory
     * @return <int> $totalrecords
     */
    function BllTotalSearchedCategoriesResultOnAdminPage($search)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select tblCategory.id,tblCategory.Title,tblCategory.MemberID,tblMemberRegistration.NickName,tblCategory.CreatedDate,tblCategory.Status ";
        $query.="From tblCategory Inner Join tblMemberRegistration on tblCategory.MemberID=tblMemberRegistration.ID ";
        $query.="Where tblCategory.Title Like '%".$search."%'";
        $query.=" Order By tblCategory.id Desc";

        $result=$this->objConnection->SelectQuery($query);
        $totalrecords=mysql_num_rows($result);

        $this->objConnection->Close();
        return $totalrecords;
    }

    /**
     * This method is used in Member News Letter
     * @param <type> $limit
     * @return <type>
     */
    function BllShowLatestCategoriesInNewsLetter($limit)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select id,Title From tblCategory Where Status='A' Order By ID Desc limit 0,$limit";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }
}
?>
