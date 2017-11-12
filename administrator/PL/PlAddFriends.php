<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This class is used to Defind User Interface at User Side
 * Description of PlAddFriends
 * @author Sumit Joshi
 * $version 1.0
 */
class PlAddFriends
{
    var $objBllAddFriends;
    var $rows;

    function __construct(){}

    function PlGetFriendsList(BoAddFriends $objBo)
    {
        $this->objBllAddFriends=new BllAddFriends();
        $this->rows=$this->objBllAddFriends->BllGetFriendsList($objBo);
        return $this->rows;
    }

    function PlAddFriend(BoAddFriends $objBo)
    {
        $this->objBllAddFriends=new BllAddFriends();
        $msg=$this->objBllAddFriends->BllAddFriend($objBo);
        return $msg;
    }

    function PlDeleteFriend(BoAddFriends $objBo)
    {
        $this->objBllAddFriends=new BllAddFriends();
        $msg=$this->objBllAddFriends->BllDeleteFriend($objBo);
        return $msg;
    }

    function PlShowFriendsOnProfile($rows)
    {
        $output="";
        for($i=0;$i<count($rows);$i++)
        {
            $output.="<a href='profile.php?id=".$rows[$i]['FriendID']."&member=".$rows[$i]['Nickname']."' title='".$rows[$i]['Nickname']."'>";
            $output.="<img src='../Member/MemberImages/".$rows[$i]['ProfileImagePath']."' width='38px' height='38px' border='0'/>";
            $output.="</a>";
        }
        return $output;
    }

    /**
     * This method is used to Show Approved Friends List on AddFriend.php Page
     * @param BoAddFriends $objBo
     * @return string
     */
    function PlShowApprovedFriendsList(BoAddFriends $objBo)
    {
        $this->objBllAddFriends=new BllAddFriends();
        $this->rows=$this->objBllAddFriends->BllShowApprovedFriendsList($objBo);

        $output="<table width='250px'>";
        for($i=0;$i<count($this->rows);$i++)
        {
            $output.="<tr><td width='15px'><a href='profile.php?id=".$this->rows[$i]['FriendID']."&member=".$this->rows[$i]['Nickname']."' title='".$this->rows[$i]['Nickname']."'>";
            $output.="<img src='../Member/MemberImages/".$this->rows[$i]['ProfileImagePath']."' width='38px' height='38px' border='0'/>";
            $output.="</a></td>";
            $output.="<td width='170px'><a href='profile.php?id=".$this->rows[$i]['FriendID']."&member=".$this->rows[$i]['Nickname']."' title='".$this->rows[$i]['Nickname']."'>".$this->rows[$i]['Nickname']."</a></td>";
            $output.="<td width='30px'><a href='?friendid=".$this->rows[$i]['FriendID']."&id=".$this->rows[$i]['MemberID']."&member=".$this->rows[$i]['Nickname']."&flag=D'><img src='../images/delete.jpg' width='10' height='10' border='0'/></a></td></tr>";
        }
        $output.="</table>";
        return $output;
    }

    /**
     * This method is used to Show Pending Friends List on AddFriend.php Page
     * @param BoAddFriends $objBo
     * @return string
     */
    function PlShowSentPendingFriendsList(BoAddFriends $objBo)
    {
        $this->objBllAddFriends=new BllAddFriends();
        $this->rows=$this->objBllAddFriends->BllShowSentPendingFriendsList($objBo);

        $output="";
        if(count($this->rows)>0)
        {
            $output="<table width='250px'>";
            for($i=0;$i<count($this->rows);$i++)
            {
                $output.="<tr><td width='15px'><a href='profile.php?id=".$this->rows[$i]['FriendID']."&member=".$this->rows[$i]['Nickname']."' title='".$this->rows[$i]['Nickname']."'>";
                $output.="<img src='../Member/MemberImages/".$this->rows[$i]['ProfileImagePath']."' width='38px' height='38px' border='0'/>";
                $output.="</a></td>";
                $output.="<td width='170px'><a href='profile.php?id=".$this->rows[$i]['FriendID']."&member=".$this->rows[$i]['Nickname']."' title='".$this->rows[$i]['Nickname']."'>".$this->rows[$i]['Nickname']."</a></td>";
                $output.="<td width='30px'>
                            <a href='?id=".$this->rows[$i]['FriendID']."&friendid=".$this->rows[$i]['MemberID']."&member=".$this->rows[$i]['Nickname']."&flag=D' title='Reject'><img src='../images/delete.jpg' width='10' height='10' border='0'/></a>
                          </td></tr>";
            }
            $output.="</table>";
        }
        return $output;
    }

    /**
     * This method is used to Show Received Pending Friends List on AddFriend.php Page
     * @param BoAddFriends $objBo
     * @return string
     */
    function PlShowReceivedPendingFriendsList(BoAddFriends $objBo)
    {
        $this->objBllAddFriends=new BllAddFriends();
        $this->rows=$this->objBllAddFriends->BllShowReceivedPendingFriendsList($objBo);
        $output="";
        if(count($this->rows)>0)
        {
            $output="<table width='250px'>";
            for($i=0;$i<count($this->rows);$i++)
            {
                $output.="<tr><td width='15px'><a href='profile.php?id=".$this->rows[$i]['FriendID']."&member=".$this->rows[$i]['Nickname']."' title='".$this->rows[$i]['Nickname']."'>";
                $output.="<img src='../Member/MemberImages/".$this->rows[$i]['ProfileImagePath']."' width='38px' height='38px' border='0'/>";
                $output.="</a></td>";
                $output.="<td width='170px'><a href='profile.php?id=".$this->rows[$i]['FriendID']."&member=".$this->rows[$i]['Nickname']."' title='".$this->rows[$i]['Nickname']."'>".$this->rows[$i]['Nickname']."</a></td>";
                $output.="<td width='30px'>
                            <a href='?id=".$this->rows[$i]['FriendID']."&friendid=".$this->rows[$i]['MemberID']."&member=".$this->rows[$i]['Nickname']."&flag=A' title='Approve'><img src='../images/approve.jpg' width='10' height='10' border='0'/></a>
                            <a href='?id=".$this->rows[$i]['FriendID']."&friendid=".$this->rows[$i]['MemberID']."&member=".$this->rows[$i]['Nickname']."&flag=R' title='Reject'><img src='../images/delete.jpg' width='10' height='10' border='0'/></a>
                          </td></tr>";
            }
            $output.="</table>";
        }
        return $output;
    }

    /**
     * This method is used to Approve or Reject Friends on AddFriend.php page.
     * @param BoAddFriends $objBo
     */
    function PlApproveOrRejectFriend(BoAddFriends $objBo)
    {
        $this->objBllAddFriends=new BllAddFriends();
        $msg=$this->objBllAddFriends->BllApproveOrRejectFriend($objBo);
        return $msg;
    }

    function PlTotalFriendsOfMember($memberid)
    {
        $this->objBllAddFriends=new BllAddFriends();
        return $this->objBllAddFriends->BllTotalFriendsOfMember($memberid);
    }

    function PlIfFriendIsPending($memberid,$friendid)
    {
        $this->objBllAddFriends=new BllAddFriends();
        return $this->objBllAddFriends->BllIfFriendIsPending($memberid,$friendid);
    }

    function PlAddtoFriendsList(BoAddFriends $objBo)
    {
        $this->objBllAddFriends=new BllAddFriends();
        return $this->objBllAddFriends->BllAddToFriendsList($objBo);
    }

    //I am Friend
    function PlIAmFriend($memberid,$friendid)
    {
        $this->objBllAddFriends=new BllAddFriends();
        return $this->objBllAddFriends->BllIAmFriend($memberid, $friendid);
    }
}
?>
