<?php
/**
 * PlTags - Presentation Layer
 *
 * This class contains members and methods of Tag Table
 * which will be visible for Users.
 *
 * @name PlTags
 * @version 1.0
 */
//include_once ROOT.'Administrator/BO/BoTags.php';

class PlTags
{
    var $objBllTag;
    var $row;

    function  __construct() {}


    /**
     *
     * @return string $output Returns $output with records
     */
    function PlGetAllTagsOnAdminPage($limit="")
    {
        $this->objBllTag=new BllTags();        
        $this->row=$this->objBllTag->BllGetAllTagsOnAdminPage($limit);
        $output=$this->MakeHtml($this->row);
        return $output;
    }

    function PlTotalTags()
    {
        $this->objBllTag=new BllTags();
        $totalrecords=$this->objBllTag->BllTotalTags();
        return $totalrecords;
    }

    /**
     * This method is used to Convert an HTML of records which are fetched from MySql
     * @param array $rows Array of Records
     * @return string $output Which holds data of Tags in form of Table
     */
    function MakeHtml($rows)
    {
        $output="<form id='frmTag' name='frmTag' method='POST' action='DeleteTag.php'>";
        $output.="<table border='0' dir='rtl' style='font-size:12px;border: 1px solid black;' align='center'>";
        $output.="<tr style='background-color: #FFCC66;height:20px'>";
            $output.="<th><input type='checkbox' id='checkmain' name='checkmain' onclick='CheckAll();'/></th>";
            $output.="<th>ID</th>";
            $output.="<th>Tag</th>";
            $output.="<th colspan='2'>Status</th>";
        $output.="</tr>";
        $i=0;
        foreach($rows as $record)
        {
            if($i%2==0)
                $bgcolor='white';
            else
                $bgcolor='#fef5ce';
            $i++;
            
            $aStatus=""; //Active Status Checked True
            $iStatus=""; //InActive Status Checked True
            $output.="<tr bgcolor='$bgcolor'>";
                $output.="<td><input type='checkbox' id='checktags' name='checktags[]' value='".$record['id']."' onclick='SingleUnChecked();'/></td>";
                $output.="<td><a href='EditTag.php?id=".$record['id']."&task=edit' title='click to edit'/>".$record['id']."</a></td>";
                $output.="<td><a href='EditTag.php?id=".$record['id']."&task=edit' title='click to edit'/>".$record['TagName']."</a></td>";
                //$output.="<td>".$record['Status']."</td>";
                //$output.="<td>";
                if($record['Status']=="A")
                {
                    //$aStatus="checked";
                    //$output.="<input type='radio' id='rdoTagStatus".$record['id']."' name='rdoTagStatus".$record['id']."' value='A' $aStatus/>Active</td>";
                    //$output.="<td><input type='radio' id='rdoTagStatus".$record['id']."' name='rdoTagStatus".$record['id']."' value='I'/>InActive</td>";
                    $output.="<td>Active</td>";
                }
                else
                {
                    //$iStatus="checked";
                    //$output.="<input type='radio' id='rdoTagStatus".$record['id']."' name='rdoTagStatus".$record['id']."' value='A'/></td>Active";
                    //$output.="<td><input type='radio' id='rdoTagStatus".$record['id']."' name='rdoTagStatus".$record['id']."' value='I' $iStatus/></td>InActive";
                    $output.="<td>InActive</td>";
                }
                //$output.="</td>";
            $output.="</tr>";
        }
        $output.="<tr>";
        $output.="<td colspan='4' align='center'>";
            $output.="<input type='submit' id='delete' name='delete' value='Delete'/>
                      <input type='button' id='checkall' name='checkall' value='Check All' onclick='CheckAllTags();'/>";
        $output.="</td>";
        $output.="</tr>";        
        
        $output.="</table>";
        $output.="</form>";
        return $output;
    }

    function PlAddTag(BoTags $objBo)
    {
        $this->objBllTag=new BllTags();
        $msg=$this->objBllTag->BllAddTag($objBo);
        return $msg;
    }

    /**
     * This method will return selected one row to edit the Tag.
     * @param BoTags $objBo Business Objects object
     * @return row $this->row Row of record
     */
    function PlEditTag(BoTags $objBo)
    {
        $this->objBllTag=new BllTags();
        $this->row=$this->objBllTag->BllGetTagDetail($objBo);        
        return $this->row;
    }

    /**
     * This method is used to Update a Tag in tblTag.
     * @param BoTags $objBo
     * @return string $msg Returns message whether record has been sucesfully updated or not.
     */
    function PlUpdateTag(BoTags $objBo)
    {
        $this->objBllTag=new BllTags();
        $msg=$this->objBllTag->BllUpdateTag($objBo);
        return $msg;
    }

    /**
     * This method is used to Delete a Tag. An
     * @param string $idarray array of TagID
     * @return string $msg Containing whether Tag(s) has been deleted or not
     */
    function PlDeleteTag($idarray)
    {
        $this->objBllTag=new BllTags();
        $msg=$this->objBllTag->BllDeleteTag($idarray);
        return $msg;
    }

    /**
     * This method is used to Fill Tag Select Box in Add Category Page
     * return string $tag
     */
    function PlFillTag()
    {
        $this->objBllTag=new BllTags();
        $this->recordSet=$this->objBllTag->BllGetAllTags();
        $tag="<select name='slttags' id='slttags'>";
        $tag.="<option value='NULL'>Select Tag</option>";
        for($i=0;$i<count($this->recordSet);$i++)
        {
            $tag.="<option value='".$this->recordSet[$i]['id']."'>".$this->recordSet[$i]['TagName']."</option>";
        }
        $tag.="</select>";
        return $tag;
    }

    /**
     * This method is used to display at the Browse Stuff Page.
     * Stuff can be Browsed with the Tags.
     * return $output Tag List in Formatted Table Form
     */
    function PlDisplayAllTags()
    {
        $this->objBllTag=new BllTags();
        $this->recordSet=$this->objBllTag->BllGetAllTags();

        $output="<table dir='rtl' class='table' width='100%' cellpadding='4px' cellspacing='0'>";
        $output.="<tr bgcolor='#fef5ce'><td><a href='BrowseStuff.php?page=1&ipp=20&tag=All'>All</a></td></tr>";
        for($i=0;$i<count($this->recordSet);$i++)
        {
            if($i%2==0)
                $bgcolor='white';
            else
                $bgcolor='#fef5ce';
            $output.="<tr bgcolor='$bgcolor'><td><a href='BrowseStuff.php?page=1&ipp=20&tag=".$this->recordSet[$i]['TagName']."'>".$this->recordSet[$i]['TagName']."</a></td></tr>";
        }
        $output.="</table>";
        return $output;
    }

    function PlGetTags()
    {
        $this->objBllTag=new BllTags();
        $this->row=$this->objBllTag->BllGetAllTags();
        return $this->row;
    }

    function PlGetTagDetail(BoTags $objBo)
    {
        $this->objBllTag=new BllTags();
        $this->row=$this->objBllTag->BllGetTagDetail($objBo);
        return $this->row;
    }

    /**
     * This method is used to display at the Browse Stuff Page.
     * Stuff can be Browsed with the Tags.
     * return $output Tag List in Formatted Table Form
     */
    function PlDisplayAllTagsOnMemberStuffPage()
    {
        $this->objBllTag=new BllTags();
        $this->recordSet=$this->objBllTag->BllGetAllTags();

        $output="<table dir='rtl' class='table' width='100%' cellpadding='4px' cellspacing='0'>";        
        for($i=0;$i<count($this->recordSet);$i++)
        {
            if(isset($_REQUEST['profileid']))
                $output.="<tr><td><a href='Stuffs.php?page=1&ipp=".$_SESSION['TotalRecordsOnMemberStuffPage']."&profileid=".$_REQUEST['profileid']."&member=".$_REQUEST['member']."&tag=".$this->recordSet[$i]['TagName']."'>".$this->recordSet[$i]['TagName']."</a></td></tr>";
            else
                $output.="<tr><td><a href='Stuffs.php?page=1&ipp=".$_SESSION['TotalRecordsOnMemberStuffPage']."&id=".$_REQUEST['id']."&member=".$_REQUEST['member']."&tag=".$this->recordSet[$i]['TagName']."'>".$this->recordSet[$i]['TagName']."</a></td></tr>";
        }
        $output.="</table>";
        return $output;
    }

    /**
     * This method is used to display at the Browse Stuff Page.
     * Stuff can be Browsed with the Tags.
     * return $output Tag List in Formatted Table Form
     */
    function PlDisplayAllTagsOnMemberBookmarkedStuffPage()
    {
        $this->objBllTag=new BllTags();
        $this->recordSet=$this->objBllTag->BllGetAllTags();

        $output="<table dir='rtl' class='table' width='100%' cellpadding='4px' cellspacing='0'>";
        for($i=0;$i<count($this->recordSet);$i++)
        {
            if(isset($_REQUEST['profileid']))
                $output.="<tr><td><a href='Bookmarks.php?page=1&ipp=".$_SESSION['TotalRecordsOnMemberStuffPage']."&profileid=".$_REQUEST['profileid']."&member=".$_REQUEST['member']."&tag=".$this->recordSet[$i]['TagName']."'>".$this->recordSet[$i]['TagName']."</a></td></tr>";
            else
                $output.="<tr><td><a href='Bookmarks.php?page=1&ipp=".$_SESSION['TotalRecordsOnMemberStuffPage']."&id=".$_REQUEST['id']."&member=".$_REQUEST['member']."&tag=".$this->recordSet[$i]['TagName']."'>".$this->recordSet[$i]['TagName']."</a></td></tr>";
        }
        $output.="</table>";
        return $output;
    }

    /**
     * This method is used to display at the Browse Stuff Page.
     * Stuff can be Browsed with the Tags.
     * return $output Tag List in Formatted Table Form
     */
    function PlDisplayAllTagsOnMemberFriendsStuffPage()
    {
        $this->objBllTag=new BllTags();
        $this->recordSet=$this->objBllTag->BllGetAllTags();

        $output="<table dir='rtl' class='table' width='100%' cellpadding='4px' cellspacing='0'>";
        for($i=0;$i<count($this->recordSet);$i++)
        {
            if(isset($_REQUEST['profileid']))
                $output.="<tr><td><a href='FriendsStuff.php?page=1&ipp=".$_SESSION['TotalRecordsOnMemberStuffPage']."&profileid=".$_REQUEST['profileid']."&member=".$_REQUEST['member']."&tag=".$this->recordSet[$i]['TagName']."'>".$this->recordSet[$i]['TagName']."</a></td></tr>";
            else
                $output.="<tr><td><a href='FriendsStuff.php?page=1&ipp=".$_SESSION['TotalRecordsOnMemberStuffPage']."&id=".$_REQUEST['id']."&member=".$_REQUEST['member']."&tag=".$this->recordSet[$i]['TagName']."'>".$this->recordSet[$i]['TagName']."</a></td></tr>";
        }
        $output.="</table>";
        return $output;
    }

    function PlTotalTagListOnStatisticsPage()
    {
        $this->objBllTag=new BllTags();
        $totalTag=$this->objBllTag->BllTotalTagListOnStatisticsPage();
        return $totalTag;
    }

    function PlTotalActiveTagListOnStatisticsPage()
    {
        $this->objBllTag=new BllTags();
        $totalActiveTag=$this->objBllTag->BllTotalActiveTagListOnStatisticsPage();
        return $totalActiveTag;
    }

    function PlTotalInactiveTagListOnStatisticsPage()
    {
        $this->objBllTag=new BllTags();
        $totalInactiveTag=$this->objBllTag->BllTotalInactiveTagListOnStatisticsPage();
        return $totalInactiveTag;
    }
}
?>