<?php
include_once 'commoninclude.php';

if(isset($_REQUEST['type']) && $_REQUEST['type']=="O")
{
    $objPlOnlineMembers=new PlMemberRegistration();
    $output=$objPlOnlineMembers->PlShowOnlineMembersListOnHomePage(40);
    echo $output;
}
else if(isset($_REQUEST['type']) && $_REQUEST['type']=="L")
{
    $objPlLastLoginMembers=new PlMemberRegistration();
    $output=$objPlLastLoginMembers->PlLastLoggedInMembers(40);
    echo $output;
}
else
{
    $objPlMostActiveMembers=new PlMemberRegistration();
    $output=$objPlMostActiveMembers->PlMostActiveMembersBasedOnStuffAndCommentCreated(40);
    echo $output;
}
?>