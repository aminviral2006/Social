<?php
/**
 * This class is used to Update the Member Profile
 * @author Sumit Joshi
 * @version 1.0
 */
class BllMemberProfile
{
    var $objConnection; //MySQL Connection object
    var $recordSet=array();

    function  __construct(){}

    /**
     * This method is used to return Requested/Selected Member Profile
     * @param iny $id
     * @return array recordSet
     */
    function BllGetMemberProfileDetail(BoMemberProfile $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select * From tblMemberProfile Where MemberID=".$objBo->getMemberId();
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    /**
     * This method is used to Enter First Time Entry of Member at the Time of Registration
     * This method is called from BllMemberRegistration method from BllMemberRegistration Class
     * @param <type> $memberid
     * @return <type>
     */
    function BllAddMemberProfile($memberid,$nickname)
    {
        if(!$this->objConnection)
        {
            $this->objConnection=new MySQLConnection();
            $this->objConnection->Open();
        }
        @copy("MemberImages/default.jpg","MemberImages/".$nickname.".jpg");
        $query="Insert Into tblMemberProfile (id,MemberID,ProfileImagePath) Values (NULL,".$memberid.",'".$nickname.".jpg')";
        
        if($this->objConnection->InsertQuery($query)==true)
            return true;
        else
            return mysql_error();
    }

    /**
     * This method is used to Update Member Profile
     * @param BoMemberProfile $objBo
     * @return string $msg success on Success otherwise fail
     */
    function BllUpdateMemberProfile(BoMemberProfile $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        
        $query="Update tblMemberProfile Set ";
        $query.="ProfileImagePath='".$_SESSION['member'].".jpg',";
        $query.="Gender='".$objBo->getGender()."',";
        $query.="GenderVisibility='".$objBo->getGenderVisibility()."',";
        $query.="BirthDate='".$objBo->getBirthDate()."',";
        $query.="BirthDateVisibility='".$objBo->getBirthDateVisibility()."',";
        $query.="CountryID=".$objBo->getCountry().",";
        $query.="CountryVisibility='".$objBo->getCountryVisibility()."',";
        $query.="SexualPreference='".$objBo->getSexualPreference()."',";
        $query.="SexualVisibility='".$objBo->getSexualVisibility()."',";
        $query.="RelationshipStatus='".$objBo->getRelationshipStatus()."',";
        $query.="RelationshipVisibility='".$objBo->getRelationshipVisibility()."',";
        $query.="Education='".$objBo->getEducation()."',";
        $query.="EducationVisibility='".$objBo->getEducationVisibility()."',";
        $query.="Children='".$objBo->getChildren()."',";
        $query.="ChildrenVisibility='".$objBo->getChildrenVisibility()."',";
        $query.="About='".$objBo->getAbout()."' Where MemberID=".$objBo->getMemberId();

        
        if(@move_uploaded_file($_FILES['file']['tmp_name'],"MemberImages/".$_SESSION['member'].".jpg"))
        {}
        //echo $query;
        if($this->objConnection->UpdateQuery($query)==true)
        {
            $msg="";
            if(@move_uploaded_file($_FILES['file']['tmp_name'],"MemberImages//".$_SESSION['member'].".jpg"))
            {}
            /*if(isset($_FILES['file']['name']) && $_FILES['file']['name']!="")
            {
                $targetDirectory="MemberImages/".$_SESSION['member'].".jpg";
                if(@move_uploaded_file($_FILES['file']['tmp_name'], $targetDirectory))
                {}
            }*/
            else mysql_error();
            $msg="success";
        }
        else
            $msg=mysql_error();
        $this->objConnection->Close();
        return $msg;
    }

    function BllShowMemberSiteControls(BoMemberProfile $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select * From tblMemberSiteControls Where MemberID=".$objBo->getMemberId();
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllShowTagControlSettings(BoMemberProfile $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select * From tblMemberProfileControls Where MemberID=".$objBo->getMemberId();
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }
}
?>