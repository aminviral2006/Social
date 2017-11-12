<?php
/**
 * BllMemberProfileControls class is used to Controls Tags Stuff on Member Profile Page
 * @author Sumit Joshi
 * @version 1.0
 */
class BllMemberProfileControls
{
    var $objConnection; //MySQL Connection object
    var $recordSet=array();

    function  __construct(){}

    /**
     * This method is used to return Requested/Selected Member Profile
     * @param iny $id
     * @return array recordSet
     */
    function BllGetMemberProfileControls(BoMemberProfileControls $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select * From tblMemberProfileControls Where MemberID=".$objBo->getMemberId();
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
    function BllAddMemberProfileControls($memberid)
    {
        if(!$this->objConnection)
        {
            $this->objConnection=new MySQLConnection();
            $this->objConnection->Open();
        }
        $query="Insert Into tblMemberProfileControls (id,MemberID,TagsOnHome) Values (NULL,".$memberid.",NULL)";
        if($this->objConnection->InsertQuery($query)==true)
            return true;
        else
            return false;
    }

    /**
     * This method is used to Update Member Profile
     * @param BoMemberProfile $objBo
     * @return string $msg success on Success otherwise fail
     */
    function BllUpdateMemberProfileControls(BoMemberProfileControls $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Update tblMemberProfileControls Set ";
        $query.="TagsOnHome='".$objBo->getTagsOnHome()."' Where MemberID=".$objBo->getMemberId();

        if($this->objConnection->UpdateQuery($query)==true)
        {
            $msg="success";
        }
        else
            $msg=mysql_error();
        $this->objConnection->Close();
        return $msg;
    }

    function BllShowTagControlSettings(BoMemberProfileControls $objBo)
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