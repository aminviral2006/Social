<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlMemberComment
 *
 * @author MACROSOFT-04
 */
class PlMemberComment 
{
    var $objMemberComment;
    var $row;

    function  __construct() {}

    function PlAddMemberComment(BoMemberComment $objBo)
    {
        $this->objMemberComment=new BllMemberComment();
        $msg=$this->objMemberComment->BllAddMemberComment($objBo);
        return $msg;
    }

    function PlDisplayComment(BoMemberComment $objBo)
    {
        $this->objMemberComment=new BllMemberComment();
        $this->row=$this->objMemberComment->BllDisplayComment($objBo);
        $output=$this->PlMakeHtml($this->row);
        return $output;
    }

    function PlMakeHtml($rows)
    {
        $output="<table width='100%'>";
        if(!empty ($rows))
        {
        for ($i = 0; $i < count($rows);$i++)
        {
            $output.="<tr>";
                $output.="<td width='54px' valign='top'><a style='text-decoration:none;' href='profile.php?id=".$rows[$i]['ID']."&member=".$rows[$i]['Nickname']."'><img src='MemberImages/" . $rows[$i]['ProfileImagePath'] . "' style='border:1px; border-style:solid;padding:2px;border-color:black;' height='48px' width='48px' align='right' border='0'/></a></td>";
                $output.="<td style='background-color: ".((($i%2)==0)?"beige":"white")."'>";
                $output.="<div><span style='font-size:10px;'><a style='text-decoration:none;' href='profile.php?id=".$rows[$i]['ID']."&member=".$rows[$i]['Nickname']."'>".$rows[$i]['Nickname']."</a> posted on ".$rows[$i]['CreatedDate']."</span></div><span style='font-size:12px;'>" . $rows[$i]['Comment'] . "</span></td>";
            $output.="</tr>";
        }
        }
        $output.="</table>";
        return $output;
    }

    function PlDisplayCommentOnHome(BoMemberComment $objBo)
    {
        $this->objMemberComment=new BllMemberComment();
        $this->row=$this->objMemberComment->BllDisplayComment($objBo);
        $output=$this->PlMakeHtmlOnProfile($this->row);
        return $output;
    }

    function PlMakeHtmlOnProfile($rows)
    {
        $output="<table width='100%'>";
        if(!empty ($rows))
        {
        for ($i = 0; $i < count($rows);$i++)
        {
            $output.="<tr>";
                $output.="<td width='24px' valign='top'><a style='text-decoration:none;' href='profile.php?id=".$rows[$i]['ID']."&member=".$rows[$i]['Nickname']."'><img src='MemberImages/" . $rows[$i]['ProfileImagePath'] . "' style='border:1px; border-style:solid;padding:2px;border-color:black;' height='24px' width='24px' align='right' border='0'/></a></td>";
                $output.="<td style='background-color: ".((($i%2)==0)?"beige":"white")."'>";
                $output.="<div><a href='profile.php?id=".$rows[$i]['ID']."&member=".$rows[$i]['Nickname']."'>".$rows[$i]['Nickname']."</a></div>" . $rows[$i]['Comment'] . "</td>";
            $output.="</tr>";
        }
        }
        $output.="</table>";
        return $output;
    }

    function PlCommentsInProfile($memberid)
    {
        $this->objMemberComment=new BllMemberComment();
        return $this->objMemberComment->BllCommentsInProfile($memberid);
    }

    function PlCommentsMade($memberid)
    {
        $this->objMemberComment=new BllMemberComment();
        return $this->objMemberComment->BllCommentsMade(    $memberid);
    }
}
?>
