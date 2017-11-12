<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BllMemberComment
 *
 * @author MACROSOFT-04
 */
class BllMemberComment {

    var $objConnection; // MySql Object Connection
    var $recordSet;

    function  __construct() {}

    function BllAddMemberComment(BoMemberComment $objBo)
    {
        $msg="";
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        
        $InsertMessage="Insert Into tblMemberComment (ID, MemberID, FriendID, Comment, CreatedDate) ";
        $InsertMessage.="values (NULL, ".$objBo->getMemberID().", ".$objBo->getFriendID().", '".$objBo->getComment()."', '".Date('Y-m-d')."')";
        
        if($this->objConnection->InsertQuery($InsertMessage)==true)
        {
            $msg="success";
        }
        else
        {
            $msg=mysql_error ();
        }
        return $msg;
    }

    function BllDisplayComment(BoMemberComment $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query = "Select tblMemberComment.Comment,tblMemberComment.FriendID,
                        tblMemberProfile.ProfileImagePath, tblMemberRegistration.ID,tblMemberRegistration.Nickname,tblMemberComment.CreatedDate
                        From tblMemberComment Inner Join tblMemberRegistration
                        On tblMemberComment.MemberID=tblMemberRegistration.ID
                        Inner Join tblMemberProfile On tblMemberComment.MemberID=tblMemberProfile.MemberID
                        And tblMemberComment.FriendID=".$objBo->getFriendID();
        
        $result = $this->objConnection->SelectQuery($query);
        $this->recordSet = $this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllCommentsInProfile($memberid)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query = "Select tblMemberComment.Comment,count(tblMemberComment.FriendID) as TotalCommentsInProfile,
                        tblMemberProfile.ProfileImagePath, tblMemberRegistration.Nickname,tblMemberComment.CreatedDate
                        From tblMemberComment Inner Join tblMemberRegistration
                        On tblMemberComment.MemberID=tblMemberRegistration.ID
                        Inner Join tblMemberProfile On tblMemberComment.MemberID=tblMemberProfile.MemberID
                        And tblMemberComment.FriendID=".$memberid." Group By tblMemberComment.FriendID";

        $result = $this->objConnection->SelectQuery($query);
        $this->recordSet = $this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        if(isset($this->recordSet[0]['TotalCommentsInProfile']))
            return $this->recordSet[0]['TotalCommentsInProfile'];
        else
            return 0;
    }

    function BllCommentsMade($memberid)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query = "Select tblMemberComment.Comment,count(tblMemberComment.FriendID) as CommentsMade,
                        tblMemberProfile.ProfileImagePath, tblMemberRegistration.Nickname,tblMemberComment.CreatedDate
                        From tblMemberComment Inner Join tblMemberRegistration
                        On tblMemberComment.MemberID=tblMemberRegistration.ID
                        Inner Join tblMemberProfile On tblMemberComment.MemberID=tblMemberProfile.MemberID
                        And tblMemberComment.MemberID=".$memberid." Group By tblMemberComment.MemberID";

        $result = $this->objConnection->SelectQuery($query);
        $this->recordSet = $this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        if(isset($this->recordSet[0]['CommentsMade']))
            return $this->recordSet[0]['CommentsMade'];
        else
            return 0;
    }
}
?>
