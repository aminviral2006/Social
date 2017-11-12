<?php
if(!session_start()) //checking whether $_SESSION has been started or not?
    session_start();
ob_start(); //Buffering the data
include_once '../commoninclude.php';
?>

<form name="frmSearchMember" id="frmSearchMember" method="get" action="MemberSearchResult.php">
    <table align="center"
           style='font-size:12px;background-color: #fef5ce;padding: 10px;height:20px;border: 0px solid black;'>
        <tr>
            
            <td>
                <!--<input type="text" name="txtsearch" id="txtsearch" />-->
                 <div class="main">
                    <div id="holderr">
                        Member Name :<input type="text" id="txtsearch" name="txtsearch" tabindex="0" size="29" OnKeyPress="return disableEnterKey(event);"/>
                        <img src="SuggestMember/images/loading.gif" id="loading" alt=""/> <input type="submit" name="submit" id="submit" value="Search"/>
                    </div>
                    <div id="ajax_response_member"></div>
                </div>
            </td>
            <td>
                
                <input type="hidden" name="page" value="1"/>
                <input type="hidden" name="ipp" value="<?php echo $_SESSION['TotalRecordsOnAdminMemberSearchPage']; ?>"/>
            </td>
        </tr>
    </table>
</form>

<?php

$pageTitle="Search Member";
$contentTitle="Search Member";
$contentData=  ob_get_contents(); //Strogin the buffered data in to $contentData
ob_clean();
require_once 'AdminHome.php'; //Loading AdminHome Page
?>
