<?php

/**
 * This class is used to Members who get Registered in this website.
 * This class is only used at the time of Member Registration Page.
 * @author Sumit Joshi
 * @version 1.0
 */
class BllMemberRegistration
{
    var $objConnection; //MySQL Connection object
    var $recordSet=array();

    function  __construct(){}

    /**
     * This method is used to return Requested/Selected Member details
     * @param iny $id
     * @return array recordSet
     */
    function BllGetMemberDetail(BoMemberRegistration $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select * From tblMemberRegistration Where Id=".$objBo->getId()." or Nickname='".$objBo->getNickname()."'";
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    /**
     * This method is used to Gel All Details of Members
     * This method is called from PL object.
     * @return array recordSet
     */
    function BllGetAllMembers()
    {
        $query="Select * From tblMemberRegistration";
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    /**
     * This method is used to Add Member Registration Details to tblMemberRegistration table
     * @param BoMembers $objBo
     * @return string $msg
     */
    function BllRegisterMember(BoMemberRegistration $objBo)
    {
        $msg="";
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $flag=$this->BllIsNicknameExist($objBo->getNickname());
        if($flag==false)
        {
            $query="Insert Into tblMemberRegistration (Nickname,EmailID,UserPassword,";
            $query.="CaptchaCode,CreatedDate,MemberStatus,OnlineStatus,MemberType) ";
            $query.="Values ('".$objBo->getNickname()."',";
            $query.="'".$objBo->getEmailId()."',";
            $query.="'".$objBo->getUserPassword()."',";
            $query.="'".$objBo->getCaptchaCode()."',";
            $query.="'".$objBo->getCreatedDate()."',";
            $query.="'".$objBo->getMemberStatus()."',";
            $query.="'".$objBo->getOnlineStatus()."',";
            $query.="'".$objBo->getMemberType()."')";
            
            if($this->objConnection->InsertQuery($query)==true)
            {
                $memberid=  $this->objConnection->GetLastInsertedId();
                $objMemberProfile=new BllMemberProfile();
                $objMemberProfile->BllAddMemberProfile($memberid,$objBo->getNickname());

                $objMemberProfileControls=new BllMemberProfileControls();
                $objMemberProfileControls->BllAddMemberProfileControls($memberid);

                $objMemberProfileSiteControls=new BllMemberProfileSiteControls();
                $objMemberProfileSiteControls->BllAddMemberProfileSiteControls($memberid);
                $msg="success";
            }
            else
                $msg="fail";
        }
        else
            $msg="exist";
        
        $this->objConnection->Close();
        return $msg;
    }

    /**
     * This method is used to check whether the Member with specified Nickname is exist of not?
     * @param string $nickname
     * @return string Exist on true or NULL otherwise
     */
    function BllIsNicknameExist($nickname)
    {
        if(!isset($this->objConnection))
        {
            $this->objConnection=new MySQLConnection();
            $this->objConnection->Open();
        }

        $query="Select Nickname From tblMemberRegistration Where NickName='".$nickname."'";
        
        $result=$this->objConnection->SelectQuery($query);
        $rowcount=$this->objConnection->RowsCount($result);
        if($rowcount==0)
            return false;
        else
            return true;
    }

    /**
     * This method is used to check whether the Member with specified EmailID is exist of not?
     * @param string $emailid
     * @return string Exist on true or NULL otherwise
     */
    function BllIsEmailExist($emailid)
    {
        if(!isset($this->objConnection))
        {
            $this->objConnection=new MySQLConnection();
            $this->objConnection->Open();
        }
        $query="Select EmailID From tblMemberRegistration Where EmailID='".$emailid."'";
        $result=$this->objConnection->SelectQuery($query);
        $rowcount=$this->objConnection->RowsCount($result);
        if($rowcount==0)
            return false;
        else
            return true;
    }

    function BllUpdateMemberDetails(BoMemberRegistration $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Update tblMemberRegistration Set ";
        $query.="EmailID='".$objBo->getEmailId()."',UserPassword='".$objBo->getUserPassword()."' ";
        $query.="Where ID=".$objBo->getId();
        $msg="";
        if($this->objConnection->UpdateQuery($query))
            $msg="success";
        else
            $msg=mysql_error();
        $this->objConnection->Close();
        return $msg;
    }

    function BllMemberSince($memberid)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT CreatedDate FROM tblMemberRegistration Where ID=".$memberid;
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=  $this->objConnection->RecordSet($result);
        
        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllTotalMembersListOnStatisticsPage()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select count(*) as TotalMembers From tblMemberRegistration";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet[0]['TotalMembers'];
    }

    function BllTotalActiveMembersListOnStatisticsPage()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select count(*) as TotalActiveMembers From tblMemberRegistration Where MemberStatus='A'";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet[0]['TotalActiveMembers'];
    }

    function BllTotalBlockedMembersListOnStatisticsPage()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select count(*) as TotalBlockedMembers From tblMemberRegistration Where MemberStatus='B'";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet[0]['TotalBlockedMembers'];
    }

    function BllTotalInactiveMembersListOnStatisticsPage()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select count(*) as TotalInactiveMembers From tblMemberRegistration Where MemberStatus='I'";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet[0]['TotalInactiveMembers'];
    }

    function BllTotalTrustedMembersListOnStatisticsPage()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select count(*) as TotalTrustedMembers From tblMemberRegistration Where MemberType='T'";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet[0]['TotalTrustedMembers'];
    }

    function BllTotalPendingMembersListOnStatisticsPage()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select count(*) as TotalPendingMembers From tblMemberRegistration Where OnlineStatus='R'";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet[0]['TotalPendingMembers'];
    }
    /* Statistics Informational Functions Ends Here */

    function BllGetAllMembersListOnAdminPage($limit="",$sort="Desc",$column="ID")
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT tblMemberRegistration.ID,tblMemberRegistration.Nickname,tblMemberProfile.ProfileImagePath,
                tblMemberRegistration.EmailID,tblMemberRegistration.CreatedDate,
                tblMemberRegistration.MemberStatus,tblMemberRegistration.OnlineStatus,
                tblMemberRegistration.MemberType
                From tblMemberRegistration
                Inner Join tblMemberProfile On tblMemberProfile.MemberID=tblMemberRegistration.ID
                Order By $column $sort $limit";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=  $this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllTotalRecords()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select * From tblMemberRegistration";

        $result=$this->objConnection->SelectQuery($query);
        $totalrecords=  mysql_num_rows($result);

        $this->objConnection->Close();
        return $totalrecords;
    }

    /**
     * This method is used at Edit Member Page on Admin Page
     * @param BoMemberRegistration $objBo
     * @return array $this->recordSet
     */
    function BllGetMemberDetailsForEditOnAdminPage(BoMemberRegistration $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT tblMemberRegistration.ID,tblMemberRegistration.Nickname,tblMemberProfile.ProfileImagePath,
                tblMemberRegistration.EmailID,tblMemberRegistration.CreatedDate,
                tblMemberRegistration.MemberStatus,tblMemberRegistration.OnlineStatus,
                tblMemberRegistration.MemberType
                From tblMemberRegistration
                Inner Join tblMemberProfile On tblMemberProfile.MemberID=tblMemberRegistration.ID Where tblMemberRegistration.ID=".$objBo->getId();

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=  $this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllUpdateMemberOnAdminPage(BoMemberRegistration $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Update tblMemberRegistration Set MemberStatus='".$objBo->getMemberStatus()."',
                MemberType='".$objBo->getMemberType()."' Where ID=".$objBo->getId();

        $result=$this->objConnection->UpdateQuery($query);

        $this->objConnection->Close();
        return $result;
    }

    function BllDeleteMemberOnAdminPage(BoMemberRegistration $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Update tblMemberRegistration Set MemberStatus='".$objBo->getMemberType()."' Where ID IN (".$objBo->getIds().")";
        
        $result=$this->objConnection->UpdateQuery($query);

        $this->objConnection->Close();
        return $result;
    }

    function BllMostActiveMembersBasedOnStuffAndCommentCreated($limit)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT tblMemberRegistration.id,
                tblMemberRegistration.Nickname,tblMemberProfile.ProfileImagePath,
                count(tblStuff.ID) AS TotalStuff
                FROM tblStuff Inner Join tblMemberRegistration
                On tblStuff.MemberID=tblMemberRegistration.ID
                Left Outer Join tblMemberProfile On tblStuff.MemberID=tblMemberProfile.MemberID 
                Group By tblStuff.MemberID Order By TotalStuff Desc Limit 0,$limit";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllShowOnlineMembersListOnHomePage($limit)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT tblMemberRegistration.id,
                tblMemberRegistration.Nickname,tblMemberProfile.ProfileImagePath
                FROM tblMemberRegistration
                Left Outer Join tblMemberProfile On tblMemberRegistration.ID=tblMemberProfile.MemberID 
                Left Outer Join tblLoginInfo On tblMemberRegistration.ID=tblLoginInfo.MemberID 
                Where tblLoginInfo.LoginStatus='O' Group By tblLoginInfo.MemberID 
                Order By tblLoginInfo.LoginTime Desc limit 0,$limit";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=  $this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllLastLoggedInMembers($limit)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT tblMemberRegistration.id,
                tblMemberRegistration.Nickname,tblMemberProfile.ProfileImagePath
                FROM tblMemberRegistration
                Left Outer Join tblMemberProfile On tblMemberRegistration.ID=tblMemberProfile.MemberID
                Left Outer Join tblLoginInfo On tblMemberRegistration.ID=tblLoginInfo.MemberID
                Where tblLoginInfo.LoginStatus='F' Group By tblLoginInfo.MemberID 
                Order By tblLoginInfo.LoginTime Desc Limit 0,$limit";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    /* Member Search Logic */
    function BllGetMemberSearchedListOnAdminPage($searchname="",$limit="",$sort="Asc",$column="ID")
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT tblMemberRegistration.ID,tblMemberRegistration.Nickname,tblMemberProfile.ProfileImagePath,
                tblMemberRegistration.EmailID,tblMemberRegistration.CreatedDate,
                tblMemberRegistration.MemberStatus,tblMemberRegistration.OnlineStatus,
                tblMemberRegistration.MemberType
                From tblMemberRegistration
                Inner Join tblMemberProfile On tblMemberProfile.MemberID=tblMemberRegistration.ID
                Where tblMemberRegistration.Nickname Like '%".$searchname."%'
                Order By $column $sort $limit";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=  $this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllTotalSearchedResult($searchname="")
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT tblMemberRegistration.ID,tblMemberRegistration.Nickname,tblMemberProfile.ProfileImagePath,
                tblMemberRegistration.EmailID,tblMemberRegistration.CreatedDate,
                tblMemberRegistration.MemberStatus,tblMemberRegistration.OnlineStatus,
                tblMemberRegistration.MemberType
                From tblMemberRegistration
                Inner Join tblMemberProfile On tblMemberProfile.MemberID=tblMemberRegistration.ID
                Where tblMemberRegistration.Nickname Like '%".$searchname."%'";

        $result=$this->objConnection->SelectQuery($query);
        $totalrecords=  mysql_num_rows($result);
        
        $this->objConnection->Close();
        return $totalrecords;
    }

    function BllSendMessageToAllMembersByAdmin()
    {
        
    }
}
?>