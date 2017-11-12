<?php
/**
 * This class is used to display Categories for User Interface Level
 * @author Sumit Joshi
 * @version 1.0
 */
class PlCategory
{
    var $objBllCategory;
    var $rows;

    function  __construct() {}

    function PlShowCategoryOnHome($limit)
    {
        $this->objBllCategory=new BllCategory();
        $this->rows=$this->objBllCategory->BllShowCategoryOnHome($limit);
        $output=$this->PlMakeHtmlHome($this->rows);
        return $output;
    }

    function PlMakeHtmlHome($rows)
    {
        $bgcolor='white';
        $output="<table dir='rtl' class='table' width='100%' cellpadding='4px' cellspacing='0'>";
        $paging=$_SESSION['TotalRecordsOnBrowseCategoryPage'];
        for($i=0;$i<count($rows);$i++)
        {
            if($i%2==0)
                $bgcolor='white';
            else
                $bgcolor='#fef5ce';
            $output.="<tr bgcolor='$bgcolor'>";
                $output.="<td><a href='Category/BrowseCategory.php?categoryid=".$rows[$i]['id']."&categoryname=".$rows[$i]['Title']."&page=1&ipp=$paging'>". $rows[$i]['Title']."</a></td>";
            $output.="</tr>";
        }
        $output.="</table>";
        return $output;
    }

    //Related CAtegories
    function PlShowCategories($limit,$relatedCategoryArray)
    {
        $this->objBllCategory=new BllCategory();
        $this->rows=$this->objBllCategory->BllShowRelatedCategory($limit,$relatedCategoryArray);
        $output=$this->PlMakeHtmlRelated($this->rows);
        return $output;
    }

    function PlMakeHtmlRelated($rows)
    {
        $bgcolor='white';
        $output="<table dir='rtl' class='table' width='100%' cellpadding='4px' cellspacing='0'>";
        $paging=$_SESSION['TotalRecordsOnBrowseCategoryPage'];
        
        for($i=0;$i<count($rows);$i++)
        {
            if($i%2==0)
                $bgcolor='white';
            else
                $bgcolor='#fef5ce';
            $output.="<tr bgcolor='$bgcolor'>";
                $output.="<td><a href='../Category/BrowseCategory.php?page=1&ipp=".$paging."&categoryid=".$rows[$i]['id']."&categoryname=".$rows[$i]['Title']."'>". $rows[$i]['Title']."</a></td>";
            $output.="</tr>";
        }
        $output.="</table>";
        return $output;
    }

    function PlAddCategory(BoCategory $objBo)
    {
        $this->objBllCategory=new BllCategory();
        $msg=$this->objBllCategory->BllAddCategory($objBo);
        return $msg;
    }

    /**
     * This method will return selected one row to edit the Tag.
     * @param BoTags $objBo Business Objects object
     * @return row $this->row Row of record
     */
    function PlEditCategory(BoCategory $objBo)
    {
        $this->objBllCategory=new BllCategory();
        $this->row=$this->objBllCategory->BllGetCategoryDetail($objBo);
        return $this->row;
    }

    /**
     * This method is used to Update a Tag in tblTag.
     * @param BoTags $objBo
     * @return string $msg Returns message whether record has been sucesfully updated or not.
     */
    function PlUpdateCategory(BoCategory $objBo)
    {
        $this->objBllCategory=new BllCategory();
        $msg=$this->objBllCategory->BllUpdateCategory($objBo);
        return $msg;
    }

    /**
     * This method is used to Delete a Tag. An
     * @param string $idarray array of TagID
     * @return string $msg Containing whether Tag(s) has been deleted or not
     */
    function PlDeleteCategory(BoCategory $objBo)
    {
        $this->objBllCategory=new BllCategory();
        $msg=$this->objBllCategory->BllDeleteCategory($objBoa);
        return $msg;
    }

    //Displaying on Admin Page
    function PlGetAllCategories($limit="")
    {
        $this->objBllCategory=new BllCategory();
        $this->rows=$this->objBllCategory->BllGetAllCategories($limit);
        $output=$this->PlMakeHtml($this->rows);
        return $output;
    }

    function PlTotalCategories()
    {
        $this->objBllCategory=new BllCategory();
        $totalrecords=$this->objBllCategory->BllTotalCategories();
        return $totalrecords;
    }

    function PlMakeHtml($rows)
    {
        $output="<form id='frmCategory' name='frmCategory' method='POST' action='DeleteCategory.php'>";
        $output.="<table border='0' dir='rtl' style='font-size:12px;border: 1px solid black;' cellpadding='5px' cellspacing='1' align='center'>";
        $output.="<tr style='background-color: #FFCC66;height:20px'>";
            $output.="<th><input type='checkbox' id='checkmain' name='checkmain' onclick='CheckAllCategory();'/></th>";
            $output.="<th align='right'>id</th>";
            $output.="<th align='right'>title</th>";
            $output.="<th align='right'>member name</th>";
            $output.="<th align='right'>created date</th>";
            $output.="<th align='right' colspan='2'>status</th>";
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
                $output.="<td><input type='checkbox' id='checkcategory' name='checkcategory[]' value='".$record['id']."' onclick='SingleUnCheck();'/></td>";
                $output.="<td><a href='EditCategory.php?id=".$record['id']."&task=edit' title='click to edit'/>".$record['id']."</a></td>";
                $output.="<td><a href='EditCategory.php?id=".$record['id']."&task=edit' title='click to edit'/>".$record['Title']."</a></td>";
                $output.="<td>".$record['NickName']."</td>";
                $output.="<td>".$record['CreatedDate']."</td>";
                //$output.="<td>";
                if($record['Status']=="A")
                {
                    //$aStatus="checked";
                    //$output.="<input type='radio' id='rdoCategoryStatus".$record['id']."' name='rdoTagStatus".$record['id']."' value='A' $aStatus/>Active</td>";
                    //$output.="<td><input type='radio' id='rdoCategoryStatus".$record['id']."' name='rdoTagStatus".$record['id']."' value='I'/>InActive</td>";
                    $output.="<td>Active</td>";
                }
                else
                {
                    //$iStatus="checked";
                    //$output.="<input type='radio' id='rdoCategoryStatus".$record['id']."' name='rdoTagStatus".$record['id']."' value='A'/>Active</td>";
                    ///$output.="<td><input type='radio' id='rdoCategoryStatus".$record['id']."' name='rdoTagStatus".$record['id']."' value='I' $iStatus/>InActive</td>";
                    $output.="<td>InActive</td>";
                }
                //$output.="</td>";
            $output.="</tr>";
        }
        $output.="<tr>";
        $output.="<td colspan='7' align='center'>";
            $output.="<input type='submit' id='delete' name='delete' value='Delete'/>
                      <input type='button' id='checkall' name='checkall' value='Check All' onclick='CheckAllCategories();'/>";
        $output.="</td>";
        $output.="</tr>";
        $output.="</table>";
        $output.="</form>";
        return $output;
    }

    /**
     * This method is used in StuffDetail Pate to Display the Votes By Categories based on Current Stuff
     * @param BoStuff $objBo
     */
    function PlShowVotesByCategories(BoStuff $objBo)
    {
        $this->objBllCategory=new BllCategory();
        $this->rows=$this->objBllCategory->BllShowVotesByCategories($objBo);
        $output=$this->PlMakeVotesByCategoriesHtml($this->rows);
        return $output;
    }

    function PlMakeVotesByCategoriesHtml($rows)
    {
        
        $output="";
        for($i=0;$i<count($rows);$i++)
        {
            $output.="<div id='".$rows[$i]['CategoryID']."'>";
                $output.="<div id='dvCategoryNameTitle' onmouseover=\"showdivtag('dvShowCategory".$rows[$i]['CategoryID']."');\"
                            onmouseout=\"hidedivtag('dvShowCategory".$rows[$i]['CategoryID']."');\">
                                <a href='../Category/BrowseCategory.php?page=1&ipp=20&categoryid=".$rows[$i]['CategoryID']."&categoryname=".$rows[$i]['Title']."'><span style='color:slateblue;'>".$rows[$i]['Title']."</span> - <span style='color:green;'>".$rows[$i]['TotalPeople']."</span> <span style='color:gray;'>people</span></a>
                          </div>";
                $output.="<div id='dvShowCategory".$rows[$i]['CategoryID']."'
                            style='display:none;visibility:hidden;'
                            onmouseover=\"showdivtag('dvShowCategory".$rows[$i]['CategoryID']."');\"
                            onmouseout=\"hidedivtag('dvShowCategory".$rows[$i]['CategoryID']."');\">";
                    $output.=$this->PlShowStuffBasedOnVotesByCategories($rows[$i]['CategoryID'])."</div>";
            $output.="</div>";
        }
        return $output;
    }

    /**
     *
     * @param BoCategory $objBo
     */
    function PlShowStuffBasedOnVotesByCategories($categoryid)
    {
        $this->objBllCategory=new BllCategory();
        $this->rows=$this->objBllCategory->BllShowStuffBasedOnVotesByCategories($categoryid);
        $output=$this->PlMakeStuffBasedOnVotesByCategoriesHtml($this->rows);
        return $output;
    }

    function PlMakeStuffBasedOnVotesByCategoriesHtml($rows)
    {
        $output="<table width='100%'>";
        for($i=0;$i<count($rows);$i++)
        {
            $output.="<tr>
                        <td class='ShowCategoryList'><a href='StuffDetail.php?stuffid=".$rows[$i]['ID']."' title='".$rows[$i]['StuffTitle']."'> <span style='color:gray;'>people </span> <span style='color:green;font-weight:bold;'> ".$rows[$i]['TotalCount']."</span> <span style='color:gray;'>-</span>".$rows[$i]['StuffTitle']."</a></td>
                      </tr>";
        }
        $output.="</table>";
        return $output;
    }

    function PlTotalCategoryOnStatisticsPage()
    {
        $this->objBllCategory=new BllCategory();
        $totalCategory=$this->objBllCategory->BllTotalCategoryListOnStatisticsPage();
        return $totalCategory;
    }

    function PlTotalActiveCategoryOnStatisticsPage()
    {
        $this->objBllCategory=new BllCategory();
        $totalActiveCategory=$this->objBllCategory->BllTotalActiveCategoryListOnStatisticsPage();
        return $totalActiveCategory;
    }

    function PlTotalInactiveCategoryOnStatisticsPage()
    {
        $this->objBllCategory=new BllCategory();
        $totalInactiveCategory=$this->objBllCategory->BllTotalInactiveCategoryListOnStatisticsPage();
        return $totalInactiveCategory;
    }

    //Edited By Viral on 24/11/2010
    function PlGetAllActiveCategories($limit="", $status)
    {
        $this->objBllCategory=new BllCategory();
        $this->rows=$this->objBllCategory->BllGetAllActiveCategories($limit="", $status);
        $output=$this->PlMakeHtml($this->rows);
        return $output;
    }
    //Ends

    //Searching Categories on Admin Page
    function PlGetSearchedCategoriesOnAdminPage($limit="",$search="")
    {
        $this->objBllCategory=new BllCategory();
        $this->rows=$this->objBllCategory->BllGetSearchedCategoriesOnAdminPage($limit,$search);
        $output=$this->PlMakeHtml($this->rows);
        return $output;
    }

    function PlTotalCategoriesSearchedResultOnAdminPage($search)
    {
        $this->objBllCategory=new BllCategory();
        $totalrecords=$this->objBllCategory->BllTotalSearchedCategoriesResultOnAdminPage($search);
        return $totalrecords;
    }

    /*News Letter Logic Code*/
    function PlShowLatestCategoriesInNewsLetter($limit)
    {
        $this->objBllCategory=new BllCategory();
        $this->rows=$this->objBllCategory->BllShowLatestCategoriesInNewsLetter($limit);
        $output=$this->PlMakeHtmlOfLatestCategoriesInNewsLetter($this->rows);
        return $output;
    }

    function PlMakeHtmlOfLatestCategoriesInNewsLetter($rows)
    {
        $style="
                <style type='text/css'>
                    .table
                    {
                        font-family: Verdana, Arial, Helvetica, sans-serif;
                        font-size:11px;
                    }
                    .table a
                    {
                        text-decoration:none;
                    }
                </style>
                ";
        echo $style;
        $bgcolor='white';
        $output="<table class='table' dir='rtl'  width='100%' cellpadding='4px' cellspacing='0'>";
        $paging=$_SESSION['TotalRecordsOnBrowseCategoryPage'];
        for($i=0;$i<count($rows);$i++)
        {
            if($i%2==0)
                $bgcolor='white';
            else
                $bgcolor='#fef5ce';
            $output.="<tr bgcolor='$bgcolor'>";
                $output.="<td><a href='".SITE_URL."/Category/BrowseCategory.php?categoryid=".$rows[$i]['id']."&categoryname=".$rows[$i]['Title']."&page=1&ipp=$paging'>". $rows[$i]['Title']."</a></td>";
            $output.="</tr>";
        }
        $output.="</table>";
        return $output;
    }
    /*News Letter Logic Ends Here*/
}
?>
