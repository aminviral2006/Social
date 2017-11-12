<?php
/**
 * This class is used to Add Friends
 * @author Sumit Joshi
 * @version 1.0
 */
class BllAddFriends
{
    var $objConnection; // MySql Connection Object
    var $recordSet;

    function __construct(){}

    function BllGetFriendsList(BoAddFriends $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT tblAddFriend.MemberID, tblAddFriend.FriendID,
                (SELECT tblMemberRegistration.Nickname FROM tblMemberRegistration
                WHERE tblMemberRegistration.ID = tblAddFriend.FriendID) AS Nickname,
                tblMemberProfile.ProfileImagePath 
                FROM tblAddFriend, tblMemberRegistration, tblMemberProfile
                WHERE tblAddFriend.MemberID = tblMemberRegistration.ID
                AND tblAddFriend.FriendID = tblMemberProfile.MemberID
                AND (tblAddFriend.MemberID =".$objBo->getMemberId().")
                And tblAddFriend.Approved='A'";
        
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllAddFriend(BoAddFriends $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        $msg="";
        $flag=$this->BllIsFriendExist($objBo->getMemberId(), $objBo->getFriendId());
        
        if($flag=="request")
        {
            $query="Insert Into tblAddFriend (id,MemberID,FriendID,CreatedDate,Approved) Values ";
            $query.="(NULL,".$objBo->getMemberId().",".$objBo->getFriendId().",'".$objBo->getCreatedDate()."','P')";
            
            if($this->objConnection->InsertQuery($query)==true)
                $msg="success";
            else
                $msg="fail";
        }
        else if($flag=="exist")
            $msg="Friend is already exist in Friends List";
        else if($flag=="rejected")
            $msg="Friend rejected you and that's why you cannot make a request.";
        $this->objConnection->Close();
        return $msg;
    }

    function BllAddToFriendsList(BoAddFriends $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        $msg="";

        $query="Insert Into tblAddFriend (id,MemberID,FriendID,CreatedDate,Approved) Values ";
        $query.="(NULL,".$objBo->getMemberId().",".$objBo->getFriendId().",'".$objBo->getCreatedDate()."','P')";
        
        if($this->objConnection->InsertQuery($query)==true)
            $msg="success";
        else
            $msg="fail";

        $this->objConnection->Close();
        return $msg;
    }

    function BllIsFriendExist($memberid,$friendid)
    {
        $query="Select count(*) as Found From tblAddFriend Where MemberID=".$memberid." And FriendID=".$friendid;
        
        $result=$this->objConnection->SelectQuery($query);
        $found=$this->objConnection->RecordSet($result);
        
        if($found[0]["Found"]==0)
            return "request";
        else
        {
            return "exist";
        }
    }

    function BllDeleteFriend(BoAddFriends $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        $msg="";
        $query="Delete From tblAddFriend Where MemberID=".$objBo->getMemberId()." And FriendID=".$objBo->getFriendId();
        $this->objConnection->DeleteQuery($query);
        
        $query="Delete From tblAddFriend Where MemberID=".$objBo->getFriendId()." And FriendID=".$objBo->getMemberId();
        $this->objConnection->DeleteQuery($query);
        
        $this->objConnection->Close();
        return $msg;
    }

    function BllShowApprovedFriendsList(BoAddFriends $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT tblAddFriend.MemberID, tblAddFriend.FriendID,
                (SELECT tblMemberRegistration.Nickname FROM tblMemberRegistration
                WHERE tblMemberRegistration.ID = tblAddFriend.FriendID) AS Nickname,
                tblMemberProfile.ProfileImagePath FROM tblAddFriend, tblMemberRegistration, tblMemberProfile
                WHERE tblAddFriend.MemberID = tblMemberRegistration.ID
                AND tblAddFriend.FriendID = tblMemberProfile.MemberID
                AND tblAddFriend.MemberID =".$objBo->getMemberId()." And tblAddFriend.Approved='A'";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    /**
     * This method is used to show the Friends List to whom we Sent Request
     * @param BoAddFriends $objBo
     * @return recorset $this->recordSet
     */
    function BllShowSentPendingFriendsList(BoAddFriends $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT tblAddFriend.MemberID, tblAddFriend.FriendID,
                (SELECT tblMemberRegistration.Nickname FROM tblMemberRegistration
                WHERE tblMemberRegistration.ID = tblAddFriend.FriendID) AS Nickname,
                (Select tblMemberProfile.ProfileImagePath From tblMemberProfile Where tblMemberProfile.MemberID=tblAddFriend.FriendID) As ProfileImagePath
                FROM tblAddFriend, tblMemberRegistration, tblMemberProfile
                WHERE tblAddFriend.MemberID = tblMemberRegistration.ID
                AND tblAddFriend.MemberID = tblMemberProfile.MemberID
                AND tblAddFriend.MemberID =".$objBo->getMemberId()." And tblAddFriend.Approved='P'";
        
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    /**
     * This method is used to show the Friends List from whom we Received Request
     * @param BoAddFriends $objBo
     * @return recorset $this->recordSet
     */
    function BllShowReceivedPendingFriendsList(BoAddFriends $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT tblAddFriend.MemberID, tblAddFriend.FriendID,
                (SELECT tblMemberRegistration.Nickname FROM tblMemberRegistration
                WHERE tblMemberRegistration.ID = tblAddFriend.MemberID) AS Nickname,
                tblMemberProfile.ProfileImagePath
                FROM tblAddFriend, tblMemberRegistration, tblMemberProfile
                WHERE tblAddFriend.MemberID = tblMemberRegistration.ID
                AND tblAddFriend.MemberID = tblMemberProfile.MemberID
                AND tblAddFriend.FriendID =".$objBo->getMemberId()." And tblAddFriend.Approved='P'";
        
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    /**
     * This method is used to Approve or Reject Friends on AddFriend.php page.
     * @param BoAddFriends $objBo
     * @return string $msg
     */
    function BllApproveOrRejectFriend(BoAddFriends $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        $msg="";
        if($objBo->getApproved()=='A')
        {
            $query="Update tblAddFriend Set Approved='".$objBo->getApproved()."' Where MemberID=".$objBo->getMemberId()." And FriendID=".$objBo->getFriendId();
            if($this->objConnection->UpdateQuery($query))
            {
                $query="Insert Into tblAddFriend (id,MemberID,FriendID,CreatedDate,Approved) Values ";
                $query.="(NULL,".$objBo->getFriendId().",".$objBo->getMemberId().",'".$objBo->getCreatedDate()."','A')";
                if($this->objConnection->InsertQuery($query))
                    $msg="success";
                else
                    $msg=mysql_error();
            }
        }
        else if($objBo->getApproved()=='R')
        {
            $query="Delete From tblAddFriend Where MemberID=".$objBo->getMemberId()." And FriendID=".$objBo->getFriendId();
            if($this->objConnection->UpdateQuery($query))
            {
                $msg="success";
            }
        }
        $this->objConnection->Close();

        return $msg;
    }

    function BllTotalFriendsOfMember($memberid)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT count(tblAddFriend.MemberID) as TotalFriends
                FROM tblAddFriend WHERE tblAddFriend.MemberID =".$memberid." And tblAddFriend.Approved='A'";

        
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        if(isset($this->recordSet[0]['TotalFriends']))
            return $this->recordSet[0]['TotalFriends'];
        else
            return 0;
    }

    function BllIfFriendIsPending($memberid,$friendid)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT count(tblAddFriend.MemberID) as PendingFriends
                FROM tblAddFriend WHERE tblAddFriend.MemberID=".$memberid." And tblAddFriend.FriendID =".$friendid." And tblAddFriend.Approved='P'";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        if(isset($this->recordSet[0]['PendingFriends']))
            return $this->recordSet[0]['PendingFriends'];
        else
            return 0;
    }

    function BllIAmFriend($memberid,$friendid)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT count(*) as IAmFriend
                FROM tblAddFriend WHERE tblAddFriend.MemberID =".$memberid." And tblAddFriend.FriendID=".$friendid." And tblAddFriend.Approved='A'";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        if(isset($this->recordSet[0]['IAmFriend']))
            return $this->recordSet[0]['IAmFriend'];
        else
            return 0;
    }
}
?>