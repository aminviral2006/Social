<?php
if(!isset ($_SESSION)) //checking whether $_SESSION has been started or not?
    session_start();
ob_start(); //Buffering the data
include_once '../commoninclude.php';

//checking whether $_REQUEST and TASK has been set or not
if(isset($_REQUEST) && isset($_REQUEST['task']))
{
    $_SESSION['URI']=@$HTTP_REFERER;
    $aStatus=""; //for Active Status
    $iStatus=""; //for InActive Status
    $lStatus=""; //for Locked Status
    $dStatus=""; //for Display on Home
    //$StuffDescription="";
    $homePageStatusYes="";
    $homePageStatusNo="";

    if($_REQUEST['task']=="edit") //checking whether the TASK is EDIT
    {
        $objBoStuff=new BoStuff();
        $objBoStuff->setId($_REQUEST['stuffid']);

        $objPlStuff=new PlStuff();
        $record=$objPlStuff->PlGetStuffDetailForEdit($objBoStuff->getId());
        $StuffDescription=$objPlStuff->PlGetDescription($objBoStuff); //Getting Latest Stuff Description

        $stuffid=$_REQUEST['stuffid'];
        $stuffTitle=$record[0]['StuffTitle'];
        $categoryTitle=$record[0]['CategoryTitle'];
        $memberName=$record[0]['Nickname'];
        $tagName=$record[0]['TagName'];

        if($record[0]['Status']=="A")
        {
            $aStatus="checked";
            $iStatus=""; //for InActive Status
            $lStatus=""; //for Locked Status
            $dStatus=""; //for Display on Home
        }
        else if($record[0]['Status']=="I")
        {
            $iStatus="checked";
            $aStatus=""; //for Active Status
            $lStatus=""; //for Locked Status
            $dStatus=""; //for Display on Home
        }
        else if($record[0]['Status']=="L")
        {
            $lStatus="checked";            
            $dStatus=""; //for Display on Home
            $aStatus="";
            $iStatus="";
        }
        else if($record[0]['Status']=="D")
        {
            $dStatus="checked";
            $aStatus=""; //for Active Status
            $iStatus=""; //for InActive Status
            $lStatus=""; //for Locked Status
        }

        if($record[0]['HomePageStatus']=="D")
        {
            $homePageStatusYes="checked";
            $homePageStatusNo="";
        }
        else
        {
            $homePageStatusNo="checked";
            $homePageStatusYes="";
        }
        
        //Image List
        $imageList=$objPlStuff->PlGetStuffImagesOnAdmin($stuffid);

        //Comment Display!
        $row=$objPlStuff->PlGetCommentsDetail($objBoStuff);
        
        $output="";
        if(isset($row) && !empty($row))
        {
            $output = "<table align='right' width='100%' cellpadding='0' cellspacing='2'>";
            $i=0;
            foreach ($row as $record)
            {
                $output.="<tr bgcolor='".((($i%2)==0)?"#fef5ce":"white")."'>";
                    $output.="<td width='32px' valign='top'>
                              <a style='text-decoration:none' href='../member/profile.php?id=".$record['MemberId']."&member=".$record['NickName']."'>
                                    <img style='border-width:thin;border-color:black;' src='../Member/MemberImages/" . $record['ProfileImagePath'] . "' width='32px' height='32px'/></a></td>";
                    $output.="<td align='right'><a style='text-decoration:none' href='../member/profile.php?id=".$record['MemberId']."&member=".$record['NickName']."'>
                                    ". $record['NickName']."</a> <span style='font-size:10px;'>commented on ".$record['CreatedDate']."</span> <br>".$record['Comment'] . "</td>";
                    $output.="<td valign='top' style='width:15px;'><a style='font-size:10px;' href='javascript:void(0);' onclick='DeleteDescriptionImageComments(".$record['ID'].",".$record['StuffID'].",\"comment\");'>Delete</a></td>";
                $output.="</tr>";
                $i++;
            }
            $output.="</table>";
            $commentList=$output;
        }
        
    }
    else if($_REQUEST['task']=="update") //checking whether the TASK is UPDATE
    {
        //echo $_SESSION['URI'];
        $objBoStuff=new BoStuff();
        $objBoStuff->setId($_REQUEST['id']);        
        $objBoStuff->setStatus($_REQUEST['rdoStatus']);        
        $objBoStuff->setHomePageStatus($_REQUEST['rdoDisplayOnCollege']);

        //print_r($_REQUEST);
        $objPlStuff=new PlStuff();
        $msg=$objPlStuff->PlUpdateStuffDetails($objBoStuff);
        
        //Description Update
        $objBoStuff->setMemberId($_SESSION['memberid']);
        $objBoStuff->setDescription($_REQUEST['AddDescription']);
        $objBoStuff->setId($_SESSION['descriptionid']);
        
        $flag=$objPlStuff->PlUpdateStuffDescription($objBoStuff);
        
        $StuffDescription=$objPlStuff->PlGetDescription($objBoStuff);
        
        if($msg==1)
            header("location:DisplayStuffs.php?page=1&ipp=20&msg=Record has been updated successfully.");
        else
            header("location:DisplayStuffs.php?page=1&ipp=20&msg=Record has not been updated successfully.");
        //header("location:".$_SESSION['URI']."&msg=".$msg);
    }
?>
<form id="frmEditStuff" name="frmEditStuff" method="post" action="EditStuff.php">
    <table align="center" border='0' dir='rtl' cellpadding="5px" cellspacing="5px"
           style='font-size:12px;background-color: #FFCC66;height:20px;border: 1px solid black;'>
        <tr>
            <th colspan="6">Stuff Details <hr/></th>
        </tr>
        <tr>
            <td>Stuff ID</td>
            <td>:</td>
            <td colspan="4"><?php echo $stuffid; ?></td>
        </tr>
        <tr>
            <td>Stuff Title</td>
            <td>:</td>
            <td colspan="4"><?php echo $stuffTitle; ?></td>
        </tr>
        <tr>
            <td>Category Title</td>
            <td>:</td>
            <td colspan="4"><?php echo $categoryTitle; ?></td>
        </tr>
        <tr>
            <td>Tag Name</td>
            <td>:</td>
            <td colspan="4"><?php if($tagName!="") echo $tagName; else echo "Untagged"; ?></td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td>
                <input type="radio" id="rdoStatus" name="rdoStatus" value="A" <?php echo $aStatus; ?> />Active
            </td>
            <td>
                <input type="radio" id="rdoStatus" name="rdoStatus" value="I" <?php echo $iStatus; ?> />InActive
            </td>
            <td colspan="2">
                <input type="radio" id="rdoStatus" name="rdoStatus" value="L" <?php echo $lStatus; ?> />Locked
            </td>
        </tr>
        <tr>
            <td colspan="6"><hr/></td>
        </tr>
        <tr>
            <td>Home Page Status</td>
            <td>:</td>
            <td>
                <input type="radio" id="rdoDisplayOnCollege" name="rdoDisplayOnCollege" value="D" <?php echo $homePageStatusYes; ?> />Yes
            </td>
            <td>
                <input type="radio" id="rdoDisplayOnCollege" name="rdoDisplayOnCollege" value="N" <?php echo $homePageStatusNo; ?> />No
            </td>
        </tr>
        <tr>
            <td colspan="6"><hr/></td>
        </tr>
        <tr>
            <td>Stuff Description</td>
            <td>:</td>
            <td style="color: red;font-size: 9px;">Edited on: <?php echo $StuffDescription[0]['CreatedDate']; ?></td>
            <td colspan="3">
                <?php
                    //This code is to Show total List of different version of Description of Stuff
                    $objBo = new BoStuff();
                    $objBo->setId($_REQUEST['stuffid']);

                    $objPlStuff=new PlStuff();
                    $version=$objPlStuff->PlGetTotalDescriptionVersion($objBo); //Getting Total Count of Description of this Stuff
                    $listofversion=$objPlStuff->PlGetListOfDescriptionIDs($objBo); //Getting ID from tblStuffDescription
                    $version=$version[0]['Version'];
                    $versionlist="";
                    if(isset($version))
                    {
                        for($j=0,$i=1;$i<$version;$i++,$j++)
                        {
                            $versionlist.="<a style='text-decoration:none;outline:0' href='javascript:void(0)' onclick='LoadSelectedDescription(".$listofversion[$j]['ID'].")'>$i |</a>";
                        }
                    }
                    $versionlist.="<a style='text-decoration:none;outline:0' href='javascript:void(0)' onclick='LoadSelectedDescription(".$listofversion[$j]['ID'].")'>current version</a>";
                    echo $versionlist;                   
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="6" id="txtAddDescription">
                <?php
                    /*FCKEditor*/
                    include_once '../FCKEditor/fckeditor.php';
                    function nukeMagicQuotes()
                    {
                        if (get_magic_quotes_gpc ())
                        {
                            function stripslashes_deep($value)
                            {
                                $value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
                                return $value;
                            }

                            $_POST = array_map('stripslashes_deep', $_POST);
                            $_GET = array_map('stripslashes_deep', $_GET);
                            $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
                        }
                    }
                    nukeMagicQuotes();
                    $oFCKeditor = new FCKeditor('AddDescription');
                    if(isset($StuffDescription[0]['Description']))
                    {
                        $oFCKeditor->Value = $StuffDescription[0]['Description'];
                    }
                    else
                        $oFCKeditor->Value = "";
                    $oFCKeditor->Width = 650;
                    $oFCKeditor->Height = 200;
                    echo $oFCKeditor->CreateHtml();
                    $_SESSION['descriptionid']=$StuffDescription[0]['ID'];                    
                ?>                
            </td>
        </tr>
        <tr>
            <td colspan="6"><hr/></td>
        </tr>
        <tr><!--Section For Stuff Images-->
            <td>Stuff Image List</td>
            <td>:</td>
            <td colspan="4" id="stuffimagelist">
                <?php
                    if(isset($imageList))
                        echo $imageList;
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="6"><hr/></td>
        </tr>
        <tr>
            <td>Comments</td>
            <td>:</td>
            <td colspan="4" id="stuffcommentlist">
                <?php
                    if(isset($commentList))
                        echo $commentList;
                    else
                        echo "<h3>There are no more comments on this Stuff.</h3>";
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <input type="submit" id="submit" name="submit" value="Update"/>
                <input type="hidden" id="task" name="task" value="update"/>
                
                <input type="hidden" id="id" name="id" value="<?php echo $stuffid; ?>"/>
            </td>
        </tr>
    </table>
</form>
<?php
    $contentTitle="Edit Stuff Details";
    $pageTitle="Update Stuff Information";
    $contentData=  ob_get_contents();
    ob_clean();
    require_once 'AdminHome.php';
}
?>
