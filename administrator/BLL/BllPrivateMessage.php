<?php

class BllPrivateMessage
{
    var $objConnection; // MySql Object Connection
    var $recordSet;

    function  __construct() {}

    function BllAddPrivateMessage(BoPrivateMessage $objBo)
    {
        $msg="";
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        
        $SelectMember="Select ID, Nickname from tblmemberregistration Where Nickname='".$objBo->getFriendName()."'";
        $searchresult= $this->objConnection->SelectQuery($SelectMember);
        $rowcount=$this->objConnection->RowsCount($searchresult);
        $recordSet=$this->objConnection->RecordSet($searchresult);
        
        if($rowcount>0)
        {
            $InsertMessage="Insert Into tblprivatemessage (ID, MemberID, FriendID, Message, CreatedDate, Flag) ";
            $InsertMessage.="values (NULL, ".$objBo->getMemberID().", ".$recordSet[0]['ID'].", '".addslashes($objBo->getMessage())."', '".Date('Y-m-d')."', 'U')";
            
            if($this->objConnection->InsertQuery($InsertMessage)==true)
            {
                $msg="Your Message is Posted Successfully";
            }
            else
            {
                $msg=mysql_error ();
            }
        }
        
        else
        {
            $msg="Member does not exist";
        }
        $this->objConnection->Close();
        return $msg;        
    }

    function BllShowPrivateMessageInbox(BoPrivateMessage $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
            $Inbox=array();
            $InboxQuery="SELECT tblMemberRegistration.ID,tblPrivateMessage.ID as PMID,
                        (SELECT NickName FROM tblMemberRegistration WHERE ID = tblPrivateMessage.MemberID) AS NickName, tblMemberProfile.MemberID, tblprivatemessage.Message,
                        (SELECT ProfileImagePath FROM tblMemberProfile WHERE MemberID = tblPrivateMessage.MemberID) AS ProfileImagePath
                        FROM tblprivatemessage
                        INNER JOIN tblMemberProfile ON tblprivatemessage.FriendID = tblMemberProfile.MemberID
                        INNER JOIN tblMemberRegistration ON tblPrivateMessage.MemberID = tblMemberRegistration.ID
                        WHERE tblprivatemessage.friendid=".$objBo->getFriendID()." Order By tblPrivateMessage.ID Desc";
            $InboxResult=$this->objConnection->SelectQuery($InboxQuery);
            $InboxRecord=$this->objConnection->RecordSet($InboxResult);
            
            $this->objConnection->Close();
            return $InboxRecord;
    }

    function BllShowPrivateMessageSent(BoPrivateMessage $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        $msg="";
        $SentQuery="SELECT tblMemberRegistration.ID,tblPrivateMessage.ID as PMID,
                    (SELECT NickName FROM tblMemberRegistration WHERE ID = tblPrivateMessage.FriendID) AS NickName, tblMemberProfile.MemberID, tblprivatemessage.Message,
                    (SELECT ProfileImagePath FROM tblMemberProfile WHERE MemberID = tblPrivateMessage.FriendID) AS ProfileImagePath
                    FROM tblprivatemessage
                    INNER JOIN tblMemberProfile ON tblprivatemessage.FriendID = tblMemberProfile.MemberID
                    INNER JOIN tblMemberRegistration ON tblPrivateMessage.MemberID = tblMemberRegistration.ID
                    WHERE tblprivatemessage.MemberID =".$objBo->getMemberID()." Order By tblPrivateMessage.ID Desc";
        $SentResult=$this->objConnection->SelectQuery($SentQuery);
        $SentRecord=$this->objConnection->RecordSet($SentResult);
            
        $this->objConnection->Close();
        return $SentRecord;
    }
    
    function BllUnreadMessageCount()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $UnreadQuery="Select count(Flag) from tblPrivateMessage where Flag='U' and FriendID=".$_SESSION['memberid'];
        $UnreadResult=$this->objConnection->SelectQuery($UnreadQuery);
        $UnreadRecord=$this->objConnection->RecordSet($UnreadResult);
        $UnreadMeessage=$UnreadRecord[0]['count(Flag)'];
        
        return $UnreadMeessage;
        $this->objConnection->Close();
    }

    function BllPageDetail(BoPrivateMessage $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        $MemberDetailQuery="Select NickName from tblmemberregistration Where ID=".$_SESSION['memberid'];
        $MemberDetailResult=$this->objConnection->SelectQuery($MemberDetailQuery);
        $MemberDetailRecord=$this->objConnection->RecordSet($MemberDetailResult);
        $MemberName=$MemberDetailRecord[0]['NickName'];
    }

    function BllDeletePrivateMessage(BoPrivateMessage $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Delete From tblPrivateMessage Where ID=".$objBo->getID();
        $result=$this->objConnection->DeleteQuery($query);

        $this->objConnection->Close();
        return $result;
    }

    function BllSendMessageToAllByAdmin($message)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $objPlMember=new PlMemberRegistration();
        $record=$objPlMember->PlGetAllMembers();
        
        $query="Insert Into tblprivatemessage (ID, MemberID, FriendID, Message, CreatedDate, Flag) Values ";
        for($i=0;$i<count($record);$i++)
        {
            $qur[]="(NULL, ".$_SESSION['memberid'].", ".$record[$i]['id'].", '".addslashes($message)."', now(), 'U')";
        }
        $sql=implode(",", $qur);
        $query.=$sql;

        if($this->objConnection->InsertQuery($query)==true)
        {
            $this->objConnection->Close();
            return 1;
        }
        $this->objConnection->Close();
        return 0;
    }
}
?>
