<?php
session_start();
include_once '../commoninclude.php';

$objPlStuff=new PlStuff();
$stuffid=$_REQUEST['stuffid'];
if(isset($_REQUEST['id']) && $_REQUEST['type']=="description")
{

}
else if(isset($_REQUEST['id']) && $_REQUEST['type']=="image")
{
    $imageid=$_REQUEST['id'];
    $objPlStuff->PlDeleteStuffImageFromAdmin($imageid, $stuffid);
    //Image List    
    $imageList=$objPlStuff->PlGetStuffImagesOnAdmin($stuffid);    
    echo $imageList;
}
else if(isset($_REQUEST['id']) && $_REQUEST['type']=="comment")
{
    $commentid=$_REQUEST['id'];
    $objPlStuff->PlDeleteCommentFromAdminPage($commentid, $stuffid);

    //Comment Display!
    $objBoStuff=new BoStuff();
    $objBoStuff->setId($stuffid);
    $row=$objPlStuff->PlGetCommentsDetail($objBoStuff);
    $output="";
    if(isset($row))
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
        if($flag==1)
            echo $commentList;
    }
    if(empty ($row))
        $output="<h3>There are no more comments on this Stuff.</h3>";
    echo $output;
}
?>
