<?php
if(!isset ($_SESSION)) //checking whether $_SESSION has been started or not?
    session_start();
ob_start(); //Buffering the data
include_once '../commoninclude.php';

//checking whether $_REQUEST and TASK has been set or not
if(isset($_REQUEST) && isset($_REQUEST['task']))
{
    $_SESSION['URI']=@$HTTP_REFERER;    
    $aStatus=""; $iStatus=""; $bStatus="";
    $oOnlinestatus=""; $fOnlinestatus=""; $rOnlinestatus="";
    $aMembertype=""; $tMembertype=""; $uMembertype="";


    if($_REQUEST['task']=="edit") //checking whether the TASK is EDIT
    {
        $objBoMemberRegistration=new BoMemberRegistration();
        $objBoMemberRegistration->setId($_REQUEST['id']);

        $objPlMemberRegistration=new PlMemberRegistration();
        $record=$objPlMemberRegistration->PlGetMemberDetailsForEditOnAdminPage($objBoMemberRegistration);
        
        $memberid=$_REQUEST['id'];
        $nickName=$record[0]['Nickname'];
        $profileImagePath=$record[0]['ProfileImagePath'];
        $emailId=$record[0]['EmailID'];
        $createdDate=$record[0]['CreatedDate'];

        //Member Status
            if($record[0]['MemberStatus']=="A")
                $aStatus="checked";
            else if($record[0]['MemberStatus']=="I")
                $iStatus="checked";
            else if($record[0]['MemberStatus']=="B")
                $bStatus="checked";

            //Online Status
            if($record[0]['OnlineStatus']=="O")
                $oOnlinestatus="checked";
            else if($record[0]['OnlineStatus']=="F")
                $fOnlinestatus="checked";
            else if($record[0]['OnlineStatus']=="R")
                $rOnlinestatus="checked";

            //Member Type
            if($record[0]['MemberType']=="A")
                $aMembertype="checked";
            else if($record[0]['MemberType']=="T")
                $tMembertype="checked";
            else if($record[0]['MemberType']=="U")
                $uMembertype="checked";

    }
    else if($_REQUEST['task']=="update") //checking whether the TASK is UPDATE
    {
        //echo $_SESSION['URI'];
        $objBoMemberRegistration=new BoMemberRegistration();
        $objBoMemberRegistration->setId($_REQUEST['id']);
        $objBoMemberRegistration->setMemberStatus($_REQUEST['rdoStatus']);
        $objBoMemberRegistration->setMemberType($_REQUEST['rdoMemberType']);

        $objPlMemberRegistration=new PlMemberRegistration();
        $msg=$objPlMemberRegistration->PlUpdateMemberOnAdminPage($objBoMemberRegistration);

        if($msg==1)
            header("location:DisplayMembers.php?page=1&ipp=20&msg=Record has been updated successfully.");
        else
            header("location:DisplayMembers.php?page=1&ipp=20&msg=Record has not been updated successfully.");
        //header("location:".$_SESSION['URI']."&msg=".$msg);
    }
?>
<form id="frmEditMember" name="frmEditMember" method="post" action="EditMember.php">
    <table align="center" border='0' dir='rtl' cellpadding="5px" cellspacing="5px"
           style='font-size:12px;background-color: #FFCC66;height:20px;border: 1px solid black;'>
        <tr>
            <th colspan="6">Member Details <hr/></th>
        </tr>
        <tr>
            <td>ID</td>
            <td>:</td>
            <td colspan="4"><?php echo $memberid; ?></td>
        </tr>
        <tr>
            <td>Member Image</td>
            <td>:</td>
            <td colspan="4"><img src="../Member/MemberImages/<?php echo $profileImagePath; ?>" style="width: 60px;height: 62px;" alt="Image not found"/></td>
        </tr>
        <tr>
            <td>Nickname</td>
            <td>:</td>
            <td colspan="4"><?php echo $nickName; ?></td>
        </tr>
        <tr>
            <td>Email ID</td>
            <td>:</td>
            <td colspan="4"><?php echo $emailId; ?></td>
        </tr>        
        <tr>
            <td>Member Status</td>
            <td>:</td>
            <td>
                <input type="radio" id="rdoStatus" name="rdoStatus" value="A" <?php echo $aStatus; ?> />Active
            </td>
            <td>
                <input type="radio" id="rdoStatus" name="rdoStatus" value="I" <?php echo $iStatus; ?> />InActive
            </td>
            <td>
                <input type="radio" id="rdoStatus" name="rdoStatus" value="B" <?php echo $bStatus; ?> />Blocked - Deleted
            </td>            
        </tr>
        <!--<tr>
            <td>Online Status</td>
            <td>:</td>
            <td>
                <input type="radio" id="rdoOnlineStatus" name="rdoOnlineStatus" value="O" <?php echo $oOnlinestatus; ?> />Online
            </td>
            <td>
                <input type="radio" id="rdoOnlineStatus" name="rdoOnlineStatus" value="F" <?php echo $fOnlinestatus; ?> />Offline
            </td>
            <td>
                <input type="radio" id="rdoOnlineStatus" name="rdoOnlineStatus" value="R" <?php echo $rOnlinestatus; ?> />Registered
            </td>
        </tr>-->
        <tr>
            <td>Member Type</td>
            <td>:</td>
            <td>
                <input type="radio" id="rdoMemberType" name="rdoMemberType" value="A" <?php echo $aMembertype; ?> />Administrator
            </td>
            <td>
                <input type="radio" id="rdoMemberType" name="rdoMemberType" value="T" <?php echo $tMembertype; ?> />Trusted Member
            </td>
            <td>
                <input type="radio" id="rdoMemberType" name="rdoMemberType" value="U" <?php echo $uMembertype; ?> />Member
            </td>
        </tr>
        <tr>
            <td colspan="6"><hr/></td>
        </tr>
        <tr>
            <td><span class="ProfileLabel">Stuff Created</span></td>
            <td>:</td>
            <td colspan="3">
                <?php
                    $objPlStuffCreated=new PlStuff();
                    echo $objPlStuffCreated->PlStuffCreatedByMember($_REQUEST['id']);
                ?>
            </td>
        </tr>
        <tr>
            <td><span class="ProfileLabel">Total Stuff</span></td>
            <td>:</td>
            <td colspan="3">
                <?php
                    $objPlTotalStuff=new PlStuff();
                    echo $objPlTotalStuff->PlTotalStuffOfMember($_REQUEST['id']);
                ?>
            </td>
        </tr>
        <tr>
            <td><span class="ProfileLabel">Bookmarks</span></td>
            <td>:</td>
            <td colspan="3">
                <?php
                    $objPlTotalBookmarkedStuff=new PlStuff();
                    echo $objPlTotalBookmarkedStuff->PlTotalBookmarkedStuffOfMember($_REQUEST['id']);
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="6"><hr/></td>
        </tr>
        <tr>
            <td><span class="ProfileLabel">Comments In Profile</span></td>
            <td>:</td>
            <td colspan="3">
                <?php
                    $objPlCommentsInProfile=new PlMemberComment();
                    echo $objPlCommentsInProfile->PlCommentsInProfile($_REQUEST['id']);
                ?>
            </td>
        </tr>
        <tr>
            <td><span class="ProfileLabel">Comments Made</span></td>
            <td>:</td>
            <td colspan="3">
                <?php
                    $objPlCommentsMade=new PlMemberComment();
                    echo $objPlCommentsMade->PlCommentsMade($_REQUEST['id']);
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="6"><hr/></td>
        </tr>
        <tr>
            <td><span class="ProfileLabel">Friends</span></td>
            <td>:</td>
            <td colspan="3">
                <?php
                    $objPlFriends=new PlAddFriends();
                    echo $objPlFriends->PlTotalFriendsOfMember(isset($_REQUEST['profileid'])?$_REQUEST['profileid']:$_REQUEST['id']);
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="6" align="center">
                <input type="submit" id="submit" name="submit" value="Update"/>
                <input type="hidden" id="task" name="task" value="update"/>

                <input type="hidden" id="id" name="id" value="<?php echo $memberid; ?>"/>
            </td>
        </tr>
    </table>
</form>
<?php
    $contentTitle="Edit Member Details";
    $pageTitle="Update Member Information";
    $contentData=  ob_get_contents();
    ob_clean();
    require_once 'AdminHome.php';
}
?>
