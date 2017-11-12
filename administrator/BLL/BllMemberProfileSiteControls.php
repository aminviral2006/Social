<?php

/**
 * Description of BllMemberProfileSiteControls
 *
 * @author DELL
 */
class BllMemberProfileSiteControls
{
    var $objConnection; //MySQL Connection object
    var $recordSet=array();

    function  __construct(){}

    function BllShowMemberSiteControls(BoMemberProfileSiteControls $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select * From tblMemberSiteControls Where MemberID=".$objBo->getMemberId();
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);
        
        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllUpdateMemberSiteControls(BoMemberProfileSiteControls $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $msg="";
        $query="Update tblMemberSiteControls Set ";
        $query.="NCF='".$objBo->getNCF()."',";
        $query.="OFCSP='".$objBo->getOFCSP()."',";
        $query.="OFCC='".$objBo->getOFCC()."',";
        $query.="EWMCP='".$objBo->getEWMCP()."',";
        $query.="EWFRM='".$objBo->getEWFRM()."',";
        $query.="ESA='".$objBo->getESA()."' ";
        $query.=" Where MemberID=".$objBo->getMemberId();
        
        if($this->objConnection->UpdateQuery($query))
            $msg="success";
        else
            $msg="fail";
        $this->objConnection->Close();
        return $msg;
    }

    function BllAddMemberProfileSiteControls($memberid)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Insert Into tblMemberSiteControls (id,memberid,ncf,ofcsp,ofcc,ewmcp,ewfrm,esa) Values ";
        $query.="(NULL,".$memberid.",'Y','N','N','N','Y','Y')";
        
        if($this->objConnection->InsertQuery($query))
            $msg="success";
        else
            $msg="fail";
        $this->objConnection->Close();
        return $msg;
    }
}
?>