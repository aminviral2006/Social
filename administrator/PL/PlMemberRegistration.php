<?php

/**
 * Description of PlMemberRegistration
 *
 * @author DELL
 */
class PlMemberRegistration
{
    var $objBllMemberRegistration;
    var $recordSet=array();

    /**
     * This method is used to Register a Member
     * @param BoMemberRegistration $objBo
     * @return <type>
     */
    function PlRegisterMember(BoMemberRegistration $objBo)
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $msg=$this->objBllMemberRegistration->BllRegisterMember($objBo);
        return $msg;
    }

    /**
     * This method will be called for AJAX purpose at the time of Member Registration
     * This method is used to check whether the Nickname is already exist or not
     * @param BoMemberRegistration $objBo
     * @return string $msg Exist or NULL
     */
    function PlIsNicknameExist(BoMemberRegistration $objBo)
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $msg=$this->objBllMemberRegistration->BllIsNicknameExist($objBo->getNickname());
        
        if($msg==false)
            return "";
        else
            return "Exist";
    }

    /**
     * This method will be called for AJAX purpose at the time of Member Registration
     * This method is used to check whether the Email is already exist or not
     * @param BoMemberRegistration $objBo
     * @return string $msg Exist or NULL
     */
    function PlIsEmailExist(BoMemberRegistration $objBo)
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $msg=$this->objBllMemberRegistration->BllIsEmailExist($objBo->getEmailId());
        
        if($msg==false)
            return "";
        else
            return "Exist";
    }

    /**
     * This method is used to return Member Details based on MemberID provided.
     * This will return entire record and fields like id,Nickname,EmailID etc.
     * @param BoMemberRegistration $objBo
     * @return <type>
     */
    function PlGetMemberDetails(BoMemberRegistration $objBo)
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $this->recordSet=$this->objBllMemberRegistration->BllGetMemberDetail($objBo);
        return $this->recordSet;
    }

    function PlUpdateMemberDetails(BoMemberRegistration $objBo)
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $msg=$this->objBllMemberRegistration->BllUpdateMemberDetails($objBo);
        return $msg;
    }

    function PlShowOnlineMembersListOnHomePage($limit)
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $this->recordSet=$this->objBllMemberRegistration->BllShowOnlineMembersListOnHomePage($limit);
        $output=$this->PlMakeHtmlOfOnlineMembersImageList($this->recordSet);
        return $output;
    }

    function PlMakeHtmlOfOnlineMembersImageList($rows)
    {
        $output="";
        for($i=0;$i<count($rows);$i++)
        {
            $output.="<a href='member/profile.php?id=".$rows[$i]['id']."&member=".$rows[$i]['Nickname']."' title='".$rows[$i]['Nickname']."'>";
            $output.="<img src='Member/MemberImages/".$rows[$i]['ProfileImagePath']."' width='28px' height='28px' border='0'/>";
            $output.="</a>";
        }
        return $output;
    }

    function PlMemberSince($memberid)
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $this->recordSet=$this->objBllMemberRegistration->BllMemberSince($memberid);
        if(isset($this->recordSet[0]['CreatedDate']))
            return $this->recordSet[0]['CreatedDate'];
        else
            return "";
    }

    function PlTotalMembersListOnStatisticsPage()
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $totalMembersList=$this->objBllMemberRegistration->BllTotalMembersListOnStatisticsPage();
        return $totalMembersList;
    }

    function PlTotalActiveMembersListOnStatisticsPage()
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $totalActiveMembersList=$this->objBllMemberRegistration->BllTotalActiveMembersListOnStatisticsPage();
        return $totalActiveMembersList;
    }

    function PlTotalBlockedMembersListOnStatisticsPage()
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $totalBlockedMembersList=$this->objBllMemberRegistration->BllTotalBlockedMembersListOnStatisticsPage();
        return $totalBlockedMembersList;
    }

    function PlTotalInactiveMembersListOnStatisticsPage()
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $totalInactiveMembersList=$this->objBllMemberRegistration->BllTotalInactiveMembersListOnStatisticsPage();
        return $totalInactiveMembersList;
    }

    function PlTotalTrustedMembersListOnStatisticsPage()
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $totalTrustedMembersList=$this->objBllMemberRegistration->BllTotalTrustedMembersListOnStatisticsPage();
        return $totalTrustedMembersList;
    }

    function PlTotalPendingMembersListOnStatisticsPage()
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $totalPendingMembersList=$this->objBllMemberRegistration->BllTotalPendingMembersListOnStatisticsPage();
        return $totalPendingMembersList;
    }
    /* Statistics Page Informatoins Ends Here */

    function PlGetAllMembersListOnAdminPage($limit="",$sort="Desc",$column="ID")
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $this->recordSet=$this->objBllMemberRegistration->BllGetAllMembersListOnAdminPage($limit, $sort, $column);
        $output=$this->PlMakeHtmlOfMembersListOnAdminPage($this->recordSet);
        return $output;
    }

    function PlMakeHtmlOfMembersListOnAdminPage($rows)
    {
        $bgcolor='white';
        $output="<form id='frmMemberRegistration' name='frmMemberRegistration' method='POST' action='DeleteMember.php'>";
        $output.="<table border='0' dir='rtl' style='font-size:12px;border: 1px solid black;' width='100%' cellpadding='0px' cellspacing='1'>";
        $output.="<tr style='background-color: #FFCC66;height:20px'>
                    <th align='right'><input type='checkbox' id='checkmain' name='checkmain' onclick='CheckAllMembers();'/></th>
                    <th align='center'>ID</th>
                    <th align='center'>Nickname</th>
                    <th style='width:38px' align='center'>&nbsp;</th>
                    <th align='center'>EmailID</th>
                    <th style='width:90px' align='center'>Created Date</th>
                    <th style='width:100px' align='center'>Member Status</th>
                    <th style='width:100px' align='center'>Online Status</th>
                    <th style='width:100px' align='center'>Member Type</th>
                  </tr>";
        for($i=0;$i<count($rows);$i++)
        {
            //Member Status
            if($rows[$i]['MemberStatus']=="A")
                $status="Active";
            else if($rows[$i]['MemberStatus']=="I")
                $status="In-Active";
            else if($rows[$i]['MemberStatus']=="B")
                $status="Blocked - Deleted";

            //Online Status
            if($rows[$i]['OnlineStatus']=="O")
                $onlinestatus="Online";
            else if($rows[$i]['OnlineStatus']=="F")
                $onlinestatus="Offline";
            else if($rows[$i]['OnlineStatus']=="R")
                $onlinestatus="Registered";

            //Member Type
            if($rows[$i]['MemberType']=="A")
                $membertype="Admin";
            else if($rows[$i]['MemberType']=="T")
                $membertype="Trusted";
            else if($rows[$i]['MemberType']=="U")
                $membertype="User";
            
            if($i%2==0)
                $bgcolor='white';
            else
                $bgcolor='#fef5ce';
            $output.="<tr bgcolor='$bgcolor'>";
                $output.="<td style='width:10px'><input type='checkbox' id='checkstuff' name='checkmember[]' value='".$rows[$i]['ID']."' onclick='SingleUnCheckedMember();'/></td>";
                $output.="<td align='center' ><a href='EditMember.php?id=".$rows[$i]['ID']."&task=edit' title='click to edit'>".$rows[$i]['ID']."</a></td>";
                $output.="<td align='right' >".$rows[$i]['Nickname']."</td>";

                $output.="<td align='center'>
                    <a style='text-decoration:none;' href='../Member/EditMemberProfile.php?stuffid=".$rows[$i]['ID']."' title='".$rows[$i]['Nickname']."'>
                    <img style='border:thin solid black;' src='../Member/MemberImages/".$rows[$i]['ProfileImagePath']."' width='30px' height='30px' hspace='0'/>
                    </a></td>";

                $output.="<td align='right'>".$rows[$i]['EmailID']."</a></td>";

                $output.="<td align='center' >".$rows[$i]['CreatedDate']."</td>";
                $output.="<td align='center' >$status</td>";
                $output.="<td align='center' >".$onlinestatus."</td>";
                $output.="<td align='center' >".$membertype."</td>";
            $output.="</tr>";
        }
        $output.="<tr>";
        $output.="<td colspan='10' align='center'>";
            $output.="<input type='submit' id='delete' name='delete' value='Delete'/>
                      <input type='button' id='checkall' name='checkall' value='Check All' onclick='CheckAllMemberList();'/>";
        $output.="</td>";
        $output.="</tr>";
        $output.="</table></form>";
        return $output;
    }

    function PlTotalRecords()
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $totalrecords=$this->objBllMemberRegistration->BllTotalRecords();
        return $totalrecords;
    }

    function PlGetMemberDetailsForEditOnAdminPage(BoMemberRegistration $objBo)
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $this->recordSet=$this->objBllMemberRegistration->BllGetMemberDetailsForEditOnAdminPage($objBo);
        return $this->recordSet;
    }

    function PlUpdateMemberOnAdminPage(BoMemberRegistration $objBo)
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $result=$this->objBllMemberRegistration->BllUpdateMemberOnAdminPage($objBo);
        return $result;
    }

    function PlDeleteMemberOnAdminPage(BoMemberRegistration $objBo)
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $result=$this->objBllMemberRegistration->BllDeleteMemberOnAdminPage($objBo);
        return $result;
    }

    function PlMostActiveMembersBasedOnStuffAndCommentCreated($limit)
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $this->recordSet=$this->objBllMemberRegistration->BllMostActiveMembersBasedOnStuffAndCommentCreated($limit);
        $output=$this->PlMakeHtmlOfMostActiveMembersBasedOnStuffAndCommentCreated($this->recordSet);
        return $output;
    }

    function PlMakeHtmlOfMostActiveMembersBasedOnStuffAndCommentCreated($rows)
    {
        $output="";
        for($i=0;$i<count($rows);$i++)
        {
            $stuffcomment=" (Stuff:".$rows[$i]['TotalStuff'].")";
            $output.="<a href='member/profile.php?id=".$rows[$i]['id']."&member=".$rows[$i]['Nickname']."' title='".$rows[$i]['Nickname'].$stuffcomment."'>";
            $output.="<img src='Member/MemberImages/".$rows[$i]['ProfileImagePath']."' width='28px' height='28px' border='0'/>";
            $output.="</a>";
        }
        return $output;
    }

    function PlLastLoggedInMembers($limit)
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $this->recordSet=$this->objBllMemberRegistration->BllLastLoggedInMembers($limit);
        $output=$this->PlMakeHtmlOfLastLoggedInMembersOnHomePage($this->recordSet);
        return $output;
    }

    function PlMakeHtmlOfLastLoggedInMembersOnHomePage($rows)
    {
        $output="";
        for($i=0;$i<count($rows);$i++)
        {
            $output.="<a href='member/profile.php?id=".$rows[$i]['id']."&member=".$rows[$i]['Nickname']."' title='".$rows[$i]['Nickname']."'>";
            $output.="<img src='Member/MemberImages/".$rows[$i]['ProfileImagePath']."' width='28px' height='28px' border='0'/>";
            $output.="</a>";
        }
        return $output;
    }

    /* Member Search Logic */
    function PlGetMemberSearchedListOnAdminPage($searchname="",$limit="",$sort="Asc",$column="ID")
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $this->recordSet=$this->objBllMemberRegistration->BllGetMemberSearchedListOnAdminPage($searchname,$limit, $sort, $column);
        //Here we are calling Same for (below) to Populate the Result List
        $output=$this->PlMakeHtmlOfMembersListOnAdminPage($this->recordSet);
        return $output;
    }

    function PlTotalSearchedResult($searchname="")
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $totalrecords=$this->objBllMemberRegistration->BllTotalSearchedResult($searchname);
        return $totalrecords;
    }

    function PlGetAllMembers()
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $this->recordSet=$this->objBllMemberRegistration->BllGetAllMembers();
        return $this->recordSet;
    }

    function PlMostActiveMembersBasedOnStuffAndCommentCreatedOnAdminPage($limit)
    {
        $this->objBllMemberRegistration=new BllMemberRegistration();
        $this->recordSet=$this->objBllMemberRegistration->BllMostActiveMembersBasedOnStuffAndCommentCreated($limit);
        $output=$this->PlMakeHtmlOfMostActiveMembersBasedOnStuffAndCommentCreatedOnAdminPage($this->recordSet);
        return $output;
    }

    function PlMakeHtmlOfMostActiveMembersBasedOnStuffAndCommentCreatedOnAdminPage($rows)
    {
        $output="<table style='font-size:12px;width:100%;' align='center'>";
        $output.="<tr>
                    <th>&nbsp;</th>
                    <th align='right' title='Member Name'>".MEMBER_NAME."</th>
                    <th title='Stuffs Created'>".STUFFS_CREATED."</th>
                  </tr>";
        for($i=0;$i<count($rows);$i++)
        {
            //$stuffcomment=" (Stuff:".$rows[$i]['TotalStuff'].")";
            $output.="<tr><td style='width:30px;height:30px;'><a href='../member/profile.php?id=".$rows[$i]['id']."&member=".$rows[$i]['Nickname']."' title='".$rows[$i]['Nickname']."'>";
            $output.="<img src='../Member/MemberImages/".$rows[$i]['ProfileImagePath']."' style='width:28px;height:28px;border:1px solid grey;padding:1px;' border='0'/>";
            $output.="</a></td>";
            $output.="<td><a href='../member/profile.php?id=".$rows[$i]['id']."&member=".$rows[$i]['Nickname']."' title='".$rows[$i]['Nickname']."'>".$rows[$i]['Nickname']."</a></td>";
            $output.="<td align='center'>".$rows[$i]['TotalStuff']."</td></tr>";
        }
        $output.="</table>";
        return $output;
    }
}
?>