<?php
class PlStuff
{
    var $objBllStuff;
    var $rows;

    function  __construct() {}

    /**
     * This method is used to Add Stuff to tblStuff
     * @param BoStuff $objBo
     * @return string $msg success on Success otherwise fail
     */
    function PlAddStuff(BoStuff $objBo)
    {
        $this->objBllStuff=new BllStuff();
        $msg=$this->objBllStuff->BllAddStuff($objBo);
        return $msg;
    }

    /**
     * This method is used to Check Whether the Stuff is Exist or Not?
     * @param BoStuff $objBo
     * @return string $msg "Stuff Exist" or "Category Exist"
     */
    function PlIsStuffExist(BoStuff $objBo)
    {
        $this->objBllStuff=new BllStuff();
        $msg=$this->objBllStuff->BllIsCategoryOrStuffExist($objBo);
        return $msg;
    }

    function PlGetStuffDetailForEdit($stuffid)
    {
        $this->objBllStuff=new BllStuff();
        $record=$this->objBllStuff->BllGetStuffDetailForEdit($stuffid);
        return $record;
    }

    function PlUpdateStuffDetails(BoStuff $objBo)
    {
        $this->objBllStuff=new BllStuff();
        $result=$this->objBllStuff->BllUpdateStuffDetails($objBo);
        return $result;
    }

    function PlUpdateStuffDescription(BoStuff $objBo)
    {
        $this->objBllStuff=new BllStuff();
        $result=$this->objBllStuff->BllUpdateStuffDescription($objBo);
        return $result;
    }

    function PlDeleteStuffImageFromAdmin($imageid,$stuffid)
    {
        $this->objBllStuff=new BllStuff();
        $result=$this->objBllStuff->BllDeleteStuffImageFromAdmin($imageid, $stuffid);
        return $result;
    }

    function PlDeleteCommentFromAdminPage($commentid,$stuffid)
    {
        $this->objBllStuff=new BllStuff();
        $result=$this->objBllStuff->BllDeleteCommentFromAdminPage($commentid, $stuffid);
        return $result;
    }

    /**
     * This method is used to Show Stuff Images on Admin's Stuff Detail Page
     * @param int $stuffid
     * @return output $output
     */
    function PlGetStuffImagesOnAdmin($stuffid)
    {
        $this->objBllStuff=new BllStuff();
        $this->rows=$this->objBllStuff->BllGetStuffImagesOnAdmin($stuffid);
        $imageList=$this->PlMakeHtmlOfStuffImagesOnAdmin($this->rows);
        return $imageList;
    }

    /**
     * This method is used to Create Layout for Image Listing on Admin's Stuff Detail Page
     * @param <type> $rows
     * @return string
     */
    function PlMakeHtmlOfStuffImagesOnAdmin($rows="")
    {
        $output="";
        if(count($rows)>0)
        {            
            for($i=0;$i<count($rows);$i++)
            {
                $output.="<div style='float:right;'>";
                $output.="<table><tr><td><img class='ImageList' src='../Stuff/StuffImages/size4/".$rows[$i]['ImagePath']."' border='0'/></td></tr>";
                $output.="<tr><td align='center'><a style='font-size:10px;' href='javascript:void(0);' onclick='DeleteDescriptionImageComments(".$rows[$i]['id'].",".$rows[$i]['StuffID'].",\"image\");'>Delete</a></td></tr></table>";
                $output.="</div>";
            }            
        }
        return $output;
    }

    function PlDeleteStuff(BoStuff $objBo)
    {
        $this->objBllStuff=new BllStuff();
        $result=$this->objBllStuff->BllDeleteStuff($objBo);
        return $result;
    }

    function PlGetAllStuffOnAdminPage($limit="")
    {
        $this->objBllStuff=new BllStuff();
        $this->rows=$this->objBllStuff->BllBrowseAllStuffOnAdminPage($limit);
        $output=$this->PlMakeHtmlOnHomePage($this->rows);
        return $output;
    }

    function PlMakeHtmlOnHomePage($rows)
    {
        $bgcolor='white';
        $output="<form id='frmStuff' name='frmStuff' method='POST' action='DeleteStuff.php'>";
        $output.="<table border='0' dir='rtl' style='font-size:12px;border: 1px solid black;' width='100%' cellpadding='0px' cellspacing='1'>";
        $output.="<tr style='background-color: #FFCC66;height:20px'>
                    <th align='right'><input type='checkbox' id='checkmain' name='checkmain' onclick='CheckAllStuff();'/></th>
                    <th style='width:18px'  align='center'>ID</th>
                    <th style='width:18px'  align='center'>vote</th>
                    <th style='width:38px' align='center'>&nbsp;</th>
                    <th style='width:350px' align='right'>stuff item</th>
                    <th align='right'>category title</th>
                    <th align='right'>member</th>
                    <th align='center'>created</th>
                    <th align='center'>status</th>
                    <th style='width:10px' align='center'>comments</th>
                  </tr>";
        for($i=0;$i<count($rows);$i++)
        {
            $status=$rows[$i]['Status'];
            if($i%2==0)
                $bgcolor='white';
            else
                $bgcolor='#fef5ce';
            $output.="<tr bgcolor='$bgcolor'>";
                $output.="<td style='width:10px'><input type='checkbox' id='checkstuff' name='checkstuff[]' value='".$rows[$i]['StuffID']."' onclick='SingleUnCheckStuff();'/></td>";
                $output.="<td align='center' ><a href='EditStuff.php?stuffid=".$rows[$i]['StuffID']."&task=edit' title='click to edit'>".$rows[$i]['StuffID']."</a></td>";
                $output.="<td align='center' >".$rows[$i]['TotalCount']." <br/>Liked</td>";
                
                $output.="<td align='center'>
                    <a style='text-decoration:none;' href='../Stuff/StuffDetail.php?stuffid=".$rows[$i]['StuffID']."' title='".$rows[$i]['Title']."'>
                    <img style='border:thin solid black;' src='../Stuff/StuffImages/".$rows[$i]['ImagePath']."' width='30px' height='30px' hspace='0'/>
                    </a></td>";

                $output.="<td align='right'><span style='font-size:10px;'>". $rows[$i]['TagName']."</span>
                    <a style='text-decoration:none;' href='../Stuff/StuffDetail.php?stuffid=".$rows[$i]['StuffID']."' title='".$rows[$i]['Title']."'>".$rows[$i]['Title']."</a></td>";
                
                $output.="<td align='right' >".$rows[$i]['CategoryTitle']."</td>";
                $output.="<td align='right' >".$rows[$i]['Nickname']."</td>";
                $output.="<td align='center' >".$rows[$i]['CreatedDate']."</td>";
                $output.="<td align='center' title='A=Active,I=Inactive,L=Locked,D=Display on Home'>".$rows[$i]['Status']."</td>";
                $output.="<td style='width:10px' align='center'>".$rows[$i]['TotalComment']."</td>";
            $output.="</tr>";
        }
        $output.="<tr>";
        $output.="<td colspan='10' align='center'>";
            $output.="<input type='submit' id='delete' name='delete' value='Delete'/>
                      <input type='button' id='checkall' name='checkall' value='Check All' onclick='CheckAllStuffs();'/>";
        $output.="</td>";
        $output.="</tr>";
        $output.="</table></form>";
        return $output;
    }

    /**
     * This method is used to Display All Stuff or Based on specified Tag Name
     * This method is used to return Total Stuff got from tblStuff
     * @return array $output
     */
    function PlGetAllStuff($tagname="",$limit="",$filter="",&$relatedCategoryArray="")
    {
        $this->objBllStuff=new BllStuff();
        $this->rows=$this->objBllStuff->BllBrowseAllStuff($tagname,$limit,$filter);
        //$this->images=$this->objBllStuff->BllGetAllImagesForStuff($tagname,$filter);
        $output=$this->PlMakeHtml($this->rows,$relatedCategoryArray);        
        return $output;
    }

    function PlTotalRecords($tagname="",$filter="")
    {
        $this->objBllStuff=new BllStuff();
        $totalrecords=$this->objBllStuff->BllTotalRecords($tagname,$filter);
        return $totalrecords;
    }

    function PlMakeHtml($rows,&$relatedCategoryArray)
    {
        $CategoryArray=array();
        $bgcolor='white';
        $output="<table dir='rtl' class='table' width='100%' cellpadding='4px' cellspacing='0'>";
        $output.="<tr style='background-color: #FFCC66;height:20px'>
                    <th style='width:20px' colspan='2' align='right'>tally</th>
                    <th style='width:500px' align='right'>stuff item</th>
                    <th>comments</th>
                  </tr>";
        for($i=0;$i<count($rows);$i++)
        {
            //Logic for Related Categories
            $CategoryArray[$i]=$rows[$i]['CategoryTitle'];                           
            //Ends here

            if($i%2==0)
                $bgcolor='white';
            else
                $bgcolor='#fef5ce';
            $output.="<tr bgcolor='$bgcolor'>";
                $output.="<td align='center'>".$rows[$i]['TotalCount']." <br/>People</td>";

                //$output.="<td align='center'><img class='stuffimageborder' src='StuffImages/".$images[$i]['StuffImagePath']."' width='38px' height='38px'/></td>";
                $output.="<td align='center'>
                    <a style='text-decoration:none;' href='StuffDetail.php?stuffid=".$rows[$i]['StuffID']."' title='".$rows[$i]['Title']."'>
                    <img class='stuffimageborder' src='StuffImages/size1/".$rows[$i]['ImagePath']."' width='38px' height='38px'/>
                    </a></td>";
                $output.="<td align='right'><span class='smalltagname'>". $rows[$i]['TagName']."</span>
                    <a style='text-decoration:none;' href='StuffDetail.php?stuffid=".$rows[$i]['StuffID']."' title='".$rows[$i]['Title']."'>".$rows[$i]['Title']."</a></td>";
                $output.="<td align='center'>".$rows[$i]['TotalComment']."</td>";
            $output.="</tr>";
        }
        $output.="</table>";
        
        //Generating Single Quoted String so that it can be passed in IN clause in SQL Query
        //This functionality Randomly chooses categories Ralated to current Page's List of Categories
        shuffle($CategoryArray);
        $CategoryArray= array_slice($CategoryArray, 0, 10);
        /*echo "<pre>";
        print_r($CategoryArray);
        echo "</pre>";*/
        $relatedCategoryArray= "'". implode("','", $CategoryArray)."'";
        return $output;
    }

    /**
     * This method is used on Browse Search Stuff Page.
     * @param <type> $searchtext
     * @return <type>
     */
    function PlGetSearchStuff($searchtext,$limit="",&$relatedCategoryArray="")
    {
        $this->objBllStuff=new BllStuff();
        $this->rows=$this->objBllStuff->BllBrowseSearchStuff($searchtext, $limit);
        //$this->images=$this->objBllStuff->BllGetAllImagesForStuff($tagname,$filter);
        $output=$this->PlMakeHtmlForSearchStuff($this->rows,$relatedCategoryArray);
        return $output;
    }

    //Totalling for Pagination
    function PlGetSearchStuffTotalRecords($searchtext)
    {
        $this->objBllStuff=new BllStuff();
        $totalrecords=$this->objBllStuff->BllBrowseSearchStuffTotalRecords($searchtext);
        return $totalrecords;
    }
    //Making Html for Display
    function PlMakeHtmlForSearchStuff($rows,&$relatedCategoryArray)
    {
        $CategoryArray=array();

        $bgcolor='white';
        $output="<table dir='rtl' class='table' width='100%' cellpadding='4px' cellspacing='0'>";
        $output.="<tr style='background-color: #FFCC66;height:20px'>
                    <th style='width:20px' colspan='2' align='right'>tally</th>
                    <th style='width:500px' align='right'>stuff item</th>
                    <th>comments</th>
                  </tr>";
        for($i=0;$i<count($rows);$i++)
        {

            $CategoryArray[$i]=$rows[$i]['CategoryTitle'];

            if($i%2==0)
                $bgcolor='white';
            else
                $bgcolor='#fef5ce';
            $output.="<tr bgcolor='$bgcolor'>";
                $output.="<td align='center'>".$rows[$i]['TotalCount']." <br/>People</td>";

                //$output.="<td align='center'><img class='stuffimageborder' src='StuffImages/".$images[$i]['StuffImagePath']."' width='38px' height='38px'/></td>";
                $output.="<td align='center'>
                    <a style='text-decoration:none;' href='StuffDetail.php?stuffid=".$rows[$i]['StuffID']."' title='".$rows[$i]['Title']."'>
                    <img class='stuffimageborder' src='StuffImages/size1/".$rows[$i]['ImagePath']."' width='38px' height='38px'/>
                    </a></td>";
                $output.="<td align='right'><span class='smalltagname'>". $rows[$i]['TagName']."</span>
                    <a style='text-decoration:none;' href='StuffDetail.php?stuffid=".$rows[$i]['StuffID']."' title='".$rows[$i]['Title']."'>".$rows[$i]['Title']."</a></td>";
                $output.="<td align='center'>".$rows[$i]['TotalComment']."</td>";
            $output.="</tr>";
        }
        $output.="</table>";
        //Generating Single Quoted String so that it can be passed in IN clause in SQL Query
        //This functionality Randomly chooses categories Ralated to current Page's List of Categories
        shuffle($CategoryArray);
        $CategoryArray= array_slice($CategoryArray, 0, 10);
        /*echo "<pre>";
        print_r($CategoryArray);
        echo "</pre>";*/
        $relatedCategoryArray= "'". implode("','", $CategoryArray)."'";
        
        return $output;
    }

    /*Search Stuff Ends Here*/

    /**
     * This method is used to Show Stuff on Home
     * @param <type> $limit
     * @return <type>
     */
    function PlShowStuffOnHome($limit)
    {
        $this->objBllStuff=new BllStuff();
        $this->rows=$this->objBllStuff->BllShowStuffOnHome($limit);
        $output=$this->PlMakeHtmlHome($this->rows);
        return $output;
    }

    function PlMakeHtmlHome($rows)
    {
        $bgcolor='white';
        $output="<table dir='rtl' class='table' width='100%' cellpadding='4px' cellspacing='0'>";
        for($i=0;$i<count($rows);$i++)
        {
            if($i%2==0)
                $bgcolor='white';
            else
                $bgcolor='#fef5ce';
            $output.="<tr bgcolor='$bgcolor'>";
                //$output.="<td><a href='Stuff/DisplayStuff.php?stuffname=".$rows[$i]['Title']."'>". $rows[$i]['Title']."</a></td>";
                $output.="<td><a href='Stuff/StuffDetail.php?stuffid=".$rows[$i]['StuffID']."'>". $rows[$i]['Title']."</a></td>";
            $output.="</tr>";
        }
	$output.="<tr><td align='left'><a style='text-decoration:none;background-color: #E8BEBE;outline:none;' href='Stuff/BrowseStuff.php?page=1&ipp=20' title='More new stuff'> ". MORE_NEW_STUFFS ." <img src='images/left.gif' border='0'/></a></td></tr>";
        $output.="</table>";
        return $output;
    }

    function PlShowRandomStuffTagsOnHome($limit)
    {
        $this->objBllStuff=new BllStuff();
        $this->rows=$this->objBllStuff->BllShowRandomStuffTagsOnHome($limit);
        //$output=$this->PlMakeHtmlHome($this->rows);
        $output=$this->PlMakeHtmlRandomStaffTag($this->rows);
        return $output;
    }

    function PlMakeHtmlRandomStaffTag($rows)
    {
        $output="";
        $bgcolor='white';
        $output="<table dir='rtl' class='table' width='100%' cellpadding='4px' cellspacing='0'>";
        for($i=0;$i<count($rows);$i++)
        {
            if($i%2==0)
                $bgcolor='white';
            else
                $bgcolor='#fef5ce';
            $output.="<tr bgcolor='$bgcolor'>";
                //$output.="<td><a href='Stuff/DisplayStuff.php?stuffname=".$rows[$i]['Title']."'>". $rows[$i]['Title']."</a></td>";
                  $output.="<td><a href='Stuff/StuffDetail.php?stuffid=".$rows[$i]['StuffID']."'>". $rows[$i]['Title']."</a></td>";
            $output.="</tr>";
        }
	$output.="<tr><td align='left'><a style='text-decoration:none;background-color: #E8BEBE;outline:none;' href='Stuff/BrowseStuff.php?page=1&ipp=20&tag=".$_SESSION['randomtag']."' title='More'>". MORE_TAGS ." ".$_SESSION['randomtag']." <img src='images/left.gif' border='0'/></a></td></tr>";
        $output.="</table>";
        return $output;
    }

    function PlShowTagStuffOnMemberProfile($memberid,$tagid)
    {
        $this->objBllStuff=new BllStuff();
        $this->rows=$this->objBllStuff->BllShowTagStuffOnMemberProfile($memberid,$tagid);

        $output="";
        if(count($this->rows)>0)
        {
            $bgcolor='white';
            $output="<table dir='rtl' class='table' width='100%' cellpadding='4px' cellspacing='0'>";
            $output.="<tr><th colspan='2' align='right' style='background-image:url(../images/MemberProfileStuffTitle.jpg);background-repeat:no-repeat;height:32px;'>".$this->rows[0]["TagName"]."</th></tr>";
            for($i=0;$i<count($this->rows);$i++)
            {
                if($i%2==0)
                    $bgcolor='white';
                else
                    $bgcolor='#fef5ce';
                    $output.="<tr bgcolor='$bgcolor'>";
                        $output.="<td width='38px'><a href='../Stuff/DisplayStuff.php?stuffname=".$this->rows[$i]['Title']."'><img src='../Stuff/StuffImages/". $this->rows[$i]['ImagePath']."' width='28px' height='28px' border='0'/></a></td>";
                        //$output.="<td><a href='../Stuff/DisplayStuff.php?stuffname=".$this->rows[$i]['Title']."'>". $this->rows[$i]['Title']."</a></td>";
                          $output.="<td><a href='#'>". $this->rows[$i]['Title']."</a></td>";
                    $output.="</tr>";
            }
            $output.="</table>";
        }
        return $output;
    }

    function PlBrowseCategoryStuffTotalRecords($category,$filter="")
    {
        $this->objBllStuff=new BllStuff();
        $totalrecords=$this->objBllStuff->BllBrowseCategoryStuffTotalRecords($category,$filter);
        return $totalrecords;
    }

    function PlBrowseCategoryStuff($category,$limit,$filter="")
    {
        $this->objBllStuff=new BllStuff();
        $this->rows=$this->objBllStuff->BllBrowseCategoryStuff($category,$limit,$filter);
        //$this->images=$this->objBllStuff->BllBrowseCategoryStuffImages($category);
        $output=$this->PlBrowseCategoryMakeHtml($this->rows);
        return $output;
    }

    function PlBrowseCategoryMakeHtml($rows,$images="")
    {
        $bgcolor='white';
        $output="<table dir='rtl' class='table' width='100%' cellpadding='4px' cellspacing='0'>";
        $output.="<tr style='background-color: #FFCC66;height:20px'>
                    <th style='width:20px' colspan='2' align='right'>tally</th>
                    <th style='width:500px' align='right'>stuff item</th>
                    <th>comments</th>
                  </tr>";

        for($i=0;$i<count($rows);$i++)
        {
            if($i%2==0)
                $bgcolor='white';
            else
                $bgcolor='#fef5ce';
            $output.="<tr bgcolor='$bgcolor'>";
                $output.="<td align='center'>".$rows[$i]['TotalCount']." <br/>People</td>";
                $output.="<td align='center'>
                    <a href='../Stuff/StuffDetail.php?stuffid=".$rows[$i]['StuffID']."' title='".$rows[$i]['Title']."'>
                    <img src='../Stuff/StuffImages/size1/".$rows[$i]['ImagePath']."' width='38px' height='38px' style='border:1px solid #B8ADF1;padding:1px;' border='0'>
                    </a></td>";
                $output.="<td align='right'><span class='smalltagname'>". $rows[$i]['TagName']."</span>
                    <a style='text-decoration:none;' href='../Stuff/StuffDetail.php?stuffid=".$rows[$i]['StuffID']."' title='".$rows[$i]['Title']."'> ".$rows[$i]['Title']."</a></td>";
                $output.="<td align='center'>".$rows[$i]['TotalComment']."</td>";
            $output.="</tr>";
        }
        $output.="</table>";
        return $output;
    }

    /**
     * This method is used to Display All Stuff or Based on specified Tag Name
     * This method is used to return Total Stuff got from tblStuff
     * @return array $output
     */
    function PlGetAllMemberStuff($memberid,$limit,$tagname="",$filter="")
    {
        $this->objBllStuff=new BllStuff();
        $this->rows=$this->objBllStuff->BllBrowseAllMemberStuff($memberid,$limit,$tagname,$filter);
        //$this->images=$this->objBllStuff->BllGetAllImagesForStuff($tagname,$filter);
        $output=$this->PlMakeHtmlForMemberStuff($this->rows);
        return $output;
    }

    function PlGetAllMemberStuffTotal($memberid,$tagname="",$filter="")
    {
        $this->objBllStuff=new BllStuff();
        $totalrecords=$this->objBllStuff->BllBrowseAllMemberStuffTotal($memberid,$tagname,$filter);
        return $totalrecords;
    }

    function PlMakeHtmlForMemberStuff($rows,$images="")
    {
        $bgcolor='white';
        $output="<table dir='rtl' class='table' width='100%' cellpadding='4px' cellspacing='0'>";
        $output.="<tr style='background-color: #FFCC66;height:20px'>
                    <th style='width:20px' colspan='2' align='right'>tally</th>
                    <th style='width:500px' align='right'>stuff item</th>
                    <th>comments</th>
                  </tr>";
        for($i=0;$i<count($rows);$i++)
        {
            if($i%2==0)
                $bgcolor='white';
            else
                $bgcolor='#fef5ce';
            $output.="<tr bgcolor='$bgcolor'>";
                $output.="<td align='center'><img src='../images/likes.gif'/>".$rows[$i]['Likes']."<br><img src='../images/unlikes.gif'/>".$rows[$i]['UnLikes']."</td>";

                //$output.="<td align='center'><img class='stuffimageborder' src='StuffImages/".$images[$i]['StuffImagePath']."' width='38px' height='38px'/></td>";
                $output.="<td align='center'>
                    <a style='text-decoration:none' href='../Stuff/StuffDetail.php?stuffid=".$rows[$i]['StuffID']."'>
                    <img class='stuffimageborder' src='../Stuff/StuffImages/".$rows[$i]['ImagePath']."' width='38px' height='38px' border='0'/>
                    </a></td>";
                $output.="<td align='right'><span class='smalltagname'>". $rows[$i]['TagName']."</span>
                            <a style='text-decoration:none' href='../Stuff/StuffDetail.php?stuffid=".$rows[$i]['StuffID']."'>".$rows[$i]['Title']."</a></td>";
                $output.="<td align='center'>".$rows[$i]['TotalComment']."</td>";
            $output.="</tr>";
        }
        $output.="</table>";
        return $output;
    }

    /**
     * This method is used to Display All Stuff or Based on specified Tag Name
     * This method is used to return Total Stuff got from tblStuff
     * @return array $output
     */
    function PlGetAllMemberBookmarkedStuff($memberid,$limit,$tagname="",$filter="")
    {
        $this->objBllStuff=new BllStuff();
        $this->rows=$this->objBllStuff->BllBrowseAllMemberBookmarkedStuff($memberid,$limit,$tagname,$filter);
        //$this->images=$this->objBllStuff->BllGetAllImagesForStuff($tagname,$filter);
        $output=$this->PlMakeHtmlForMemberBookmarkedStuff($this->rows);
        return $output;
    }

    function PlGetAllMemberBookmarkedStuffTotal($memberid,$tagname="",$filter="")
    {
        $this->objBllStuff=new BllStuff();
        $totalrecords=$this->objBllStuff->BllBrowseAllMemberBookmarkedStuffTotal($memberid,$tagname,$filter);
        return $totalrecords;
    }

    function PlMakeHtmlForMemberBookmarkedStuff($rows,$images="")
    {
        $bgcolor='white';
        $output="<table dir='rtl' class='table' width='100%' cellpadding='4px' cellspacing='0'>";
        $output.="<tr style='background-color: #FFCC66;height:20px'>
                    <th style='width:20px' colspan='2' align='right'>tally</th>
                    <th style='width:500px' align='right'>stuff item</th>
                    <th>comments</th>
                  </tr>";
        for($i=0;$i<count($rows);$i++)
        {
            if($i%2==0)
                $bgcolor='white';
            else
                $bgcolor='#fef5ce';
            $output.="<tr bgcolor='$bgcolor'>";
                $output.="<td align='center'><img src='../images/likes.gif'/>".$rows[$i]['Likes']."<br><img src='../images/unlikes.gif'/>".$rows[$i]['UnLikes']."</td>";

                //$output.="<td align='center'><img class='stuffimageborder' src='StuffImages/".$images[$i]['StuffImagePath']."' width='38px' height='38px'/></td>";
                $output.="<td align='center'>
                    <a style='text-decoration:none' href='../Stuff/StuffDetail.php?stuffid=".$rows[$i]['StuffID']."'>
                    <img class='stuffimageborder' src='../Stuff/StuffImages/".$rows[$i]['ImagePath']."' width='38px' height='38px' border='0'/>
                    </a></td>";
                $output.="<td align='right'><span class='smalltagname'>". $rows[$i]['TagName']."</span>
                    <a style='text-decoration:none' href='../Stuff/StuffDetail.php?stuffid=".$rows[$i]['StuffID']."'>".$rows[$i]['Title']."
                        </a></td>";
                $output.="<td align='center'>".$rows[$i]['TotalComment']."</td>";
            $output.="</tr>";
        }
        $output.="</table>";
        return $output;
    }

    /**
     * This method is used to Display All Stuff or Based on specified Tag Name
     * This method is used to return Total Stuff got from tblStuff
     * @return array $output
     */
    function PlGetAllMemberFriendsStuff($memberid,$limit,$tagname="",$filter="")
    {
        $this->objBllStuff=new BllStuff();
        $this->rows=$this->objBllStuff->BllBrowseAllMemberFriendsStuff($memberid,$limit,$tagname,$filter);
        //$this->images=$this->objBllStuff->BllGetAllImagesForStuff($tagname,$filter);
        $output=$this->PlMakeHtmlForMemberFriendsStuff($this->rows);
        return $output;
    }

    function PlGetAllMemberFriendsStuffTotal($memberid,$tagname="",$filter="")
    {
        $this->objBllStuff=new BllStuff();
        $totalrecords=$this->objBllStuff->BllBrowseAllMemberFriendsStuffTotal($memberid,$tagname,$filter);
        return $totalrecords;
    }

    function PlMakeHtmlForMemberFriendsStuff($rows,$images="")
    {
        $bgcolor='white';
        $output="<table dir='rtl' class='table' width='100%' cellpadding='4px' cellspacing='0'>";
        $output.="<tr style='background-color: #FFCC66;height:20px'>
                    <th style='width:20px' colspan='2' align='right'>tally</th>
                    <th style='width:500px' align='right'>stuff item</th>
                    <th>comments</th>
                  </tr>";
        for($i=0;$i<count($rows);$i++)
        {
            if($i%2==0)
                $bgcolor='white';
            else
                $bgcolor='#fef5ce';
            $output.="<tr bgcolor='$bgcolor'>";
                $output.="<td align='center'><img src='../images/likes.gif'/>".$rows[$i]['Likes']."<br><img src='../images/unlikes.gif'/>".$rows[$i]['UnLikes']."</td>";

                //$output.="<td align='center'><img class='stuffimageborder' src='StuffImages/".$images[$i]['StuffImagePath']."' width='38px' height='38px'/></td>";
                $output.="<td align='center'>
                    <a style='text-decoration:none' href='../Stuff/StuffDetail.php?stuffid=".$rows[$i]['StuffID']."'>
                    <img class='stuffimageborder' src='../Stuff/StuffImages/".$rows[$i]['ImagePath']."' width='38px' height='38px'/>
                    </a></td>";
                $output.="<td align='right'><span class='smalltagname'>". $rows[$i]['TagName']."</span>
                    <a style='text-decoration:none' href='../Stuff/StuffDetail.php?stuffid=".$rows[$i]['StuffID']."'>".$rows[$i]['Title']."</a></td>";
                $output.="<td align='center'>".$rows[$i]['TotalComment']."</td>";
            $output.="</tr>";
        }
        $output.="</table>";
        return $output;
    }

    //Edited By Viral
    function PlShowCollageImages()
    {
        $this->objBllStuff=new BllStuff();
        $ImageCluster=$this->objBllStuff->BllShowCollageImages();
        $CollageImages=$this->MakeCollageImagesHTML($ImageCluster);
    }

    //Edited By Viral
    function MakeCollageImagesHTML($ImageCluster)
    {
        for($i=0;$i<count($ImageCluster);$i++)
        {
            echo $ImageCluster[$i]['ImagePath'];
            $output="<a href'#'><img src='stuff/StuffImages/".$ImageCluster[$i]['ImagePath']."'/></a>";
        }
        return $output;
    }

    //Edited By Viral

    function PlGetAllStuffDetail($stuffid)
    {
        $this->objBllStuff=new BllStuff();
        $StuffDetail=$this->objBllStuff->BllGetAllStuffDetail($stuffid);
        return $StuffDetail;
    }

    //Edited By Viral

    function PlGetMemberDetail($CreatorID)
    {
        $this->objBllStuff=new BllStuff();
        $MemberDetail=$this->objBllStuff->BllGetMemberDetails($CreatorID);
        return $MemberDetail;
    }

    //Edited By Viral

    function PlGetDescription($objBo)
    {
        $this->objBllStuff=new BllStuff();
        $StuffDescription=$this->objBllStuff->BllGetDescription($objBo);
        return $StuffDescription;
    }

    function PlLoadSelectedDescription($id)
    {
        $this->objBllStuff=new BllStuff();
        $StuffDescription=$this->objBllStuff->BllLoadSelectedDescription($id);
        return $StuffDescription;
    }

    //Edited By Sumit
    function PlGetTotalDescriptionVersion($objBo)
    {
        $this->objBllStuff=new BllStuff();
        $version=$this->objBllStuff->BllGetTotalDescriptionVersion($objBo);
        return $version;
    }

    //Editeb By Sumit
    function PlGetListOfDescriptionIDs(BoStuff $objBo)
    {
        $this->objBllStuff=new BllStuff();
        $versionlist=$this->objBllStuff->BllGetListOfDescriptionIDs($objBo);
        return $versionlist;
    }

    //Edited By Viral
    function PlAddDescriptionUpdate($stuffid, $objBo)
    {
        $this->objBllStuff=new BllStuff();
        $UpdateDescription=$this->objBllStuff->BllAddDescriptionUpdate($stuffid, $objBo);
        return $UpdateDescription;
    }

    //Edited By Viral
    function PlAddDescription($stuffid,$objBo)
    {
        $this->objBllStuff=new BllStuff();
        $AddDescription=$this->objBllStuff->BllAddDescription($stuffid,$objBo);
        return $AddDescription;
    }
    //Edited By Viral
    function PlGetTagDetail($objBo)
    {
        $this->objBllStuff=new BllStuff();
        $TagName=$this->objBllStuff->BllGetTagsDestails($objBo);
        return $TagName;
    }

    //Edited By Viral
    function PlGetCommentsDetail($objBO)
    {
        $this->objBllStuff=new BllStuff();
        $row=$this->objBllStuff->BllGetCommentsDetail($objBO);
        return $row;
    }

    //Edited By Viral

    function PlGetMemberImages($objBo)
    {
        $this->objBllStuff=new BllStuff();
        $MemberImageRecord=$this->objBllStuff->BllGetMemberImages($objBo);
        return $MemberImageRecord;
    }

    //Edited By Viral

    function PlAddComment($objBo, $comment)
    {
        $this->objBllStuff=new BllStuff();
        $AddComment=$this->objBllStuff->BllAddComment($objBo, $comment);
        $row=$this->objBllStuff->BllGetCommentsDetail($objBo);
    }

    //Edited By Viral
    function PlGetStuffImages($objBo)
    {
        $this->objBllStuff=new BllStuff();
        $StuffImage=$this->objBllStuff->BllGetStuffImage($objBo);
        return $StuffImage;
    }

    //Edited By Sumit
    function PlGetStuffAllImages($objBo)
    {
        $this->objBllStuff=new BllStuff();
        $this->images=$this->objBllStuff->BllGetStuffAllImages($objBo);
        //$StuffImages=$this->PlGetStuffAllImagesHTML($this->images);
        return $this->images;
    }

    function PlGetStuffAllImagesHTML($images)
    {
        $output="";
        for($i=0;$i<count($images);$i++)
        {
            $output.="<a href='". $images[$i]['StuffID']."' title='".$images[$i]['ImagePath']."'>
                <img src='StuffImages/size4/". $images[$i]['ImagePath']."' width='56' height='56' border='0' style='border-width:thin;border-color:black;'>
                    </a>";
        }
        return $output;
    }

    //Edited By Viral
    function PlAddCategory($objBo, $categorytitle)
    {
        $this->objBllStuff=new BllStuff();
        $AddCategory=$this->objBllStuff->BllAddCategory($categorytitle);
        return $AddCategory;
    }

    //Edited by Viral
    function PlShowCategory($objBo)
    {
        $this->objBllStuff=new BllStuff();
        $DisplayCategory=$this->objBllStuff->BllShowCategory($objBo);
        return $DisplayCategory;
    }

    /**
     * This method is used to Show Stuff on Home (Main Index.php Page)
     * @param <type> $limit
     * @return <type>
     */
    function PlShowCollageOnHome($limit,$maxvotes,$mrows=0,$mcols=0)
    {
        $this->objBllStuff=new BllStuff();
        $this->rows=$this->objBllStuff->BllShowCollageOnHome($limit,$maxvotes);
        //$output=$this->PlMakeCollageHtmlOnHome($this->rows);
        $output=$this->PlShowCollageImageOnHomePage($this->rows,$mrows,$mcols);
        return $output;
    }

    

    function PlShowCollageTest($limit)
    {
        $this->objBllStuff=new BllStuff();
        $this->rows=$this->objBllStuff->BllShowCollageOnHome($limit);
        return $this->rows;
    }

    //Edited By Viral
    function PlGetLastEdited($objBo)
    {
        $this->objBllStuff=new BllStuff();
        $LastEdited=$this->objBllStuff->BllGetLastEdited($objBo);
        return $LastEdited;
    }

    //New Edited By Viral
    function PlUploadImage($stuffid, $filename)
    {
        $this->objBllStuff=new BllStuff();
        $UploadImage=$this->objBllStuff->BllUploadImages($stuffid, $filename);
    }

    //Edited by Sumit for more image upload
    function PlUploadMoreImages()
    {
        $this->objBllStuff=new BllStuff();
        $this->objBllStuff->BllUploadMoreImages();
    }

    /**
     * This method is called on Main Index.php page
     * @param <type> $rows
     * @param <type> $rows
     * @param <type> $cols
     * @return string $output
     */
    function PlShowCollageImageOnHomePage($rows,$mrows=0,$mcols=0)
    {
        $str=0;
	$strchk="";
	$size21=0; $size31=0; $size41=0; $size5=0; $size22=0; $size32=0; $size42=0; $size23=0; $size33=0;
	$size43=0; $size24=0; $size34=0; $size44=0; $size25=0; $size35=0; $size45=0; $size46=0; $size47=0; $size48=0;
	$size36=0; $size37=0; $size38=0; $size39=0; $size310=0; $size311=0; $size312=0; $size313=0; $size314=0; $size315=0; $size316=0; $size317=0; $size318=0; $size319=0; $size320=0; $size321=0; $size322=0; $size323=0; $size324=0; $size325=0; $size326=0; $size327=0; $size328=0; $size329=0; $size330=0;
	$size26=0; $size27=0; $size28=0; $size29=0; $size210=0; $size211=0; $size212=0; $size213=0; $size214=0; $size215=0; $size216=0; $size217=0; $size218=0; $size219=0; $size220=0; $size221=0; $size222=0; $size223=0; $size224=0; $size225=0; $size226=0; $size227=0; $size228=0; $size229=0; $size230=0;
	$strchk="o,";

        $maxrows=0;
        $maxcols=0;
        if($mrows==0 && $mcols==0)
        {
            $maxrows=11;
            $maxcols=26;
        }
        else
        {
            $maxrows=$mrows;
            $maxcols=$mcols;
        }

	do
        {
		$str=(int)((rand(1,400)));
                //echo "1str:".$str;
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) )
                {
			$size21=$str;
			$strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
			break;
                }
        }while(1);
	do
        {
		$str=(int)((rand(1,400)));
                //echo "2str:".$str;
		if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk, "," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
                {
			$size31=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
        }while(1);


	do
        {
		$str=(int)((rand(1,400)));
                if($str < ((($maxrows-1)*$maxcols)+1) && ($str % $maxcols) <> 0 && (int)strpos($strchk,"," . strval((int)$str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
                {
			$size41=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
        }while(1);


	do
        {
		$str=(int)((rand(1,400)));

                if ($str < ((($maxrows-4)*$maxcols)+1) && ($str % $maxcols) <> 0 && ($str % $maxcols) < 24 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*2)) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*3)) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*2)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*3)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+2) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+2) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*2)+2) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*3)+2) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+3) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+3) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*2)+3) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*3)+3) . ",")===0)
		{
                        $size5=$str;
			$strchk= $strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+($maxcols*2)) . "," .  strval((int)($str)+($maxcols*3)) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . "," .  strval((int)($str)+($maxcols*2)+1) . "," .  strval((int)($str)+($maxcols*3)+1) . "," .  strval((int)($str)+2) . "," .  strval((int)($str)+$maxcols+2) . "," .  strval((int)($str)+($maxcols*2)+2) . "," .  strval((int)($str)+($maxcols*3)+2) . ","  .  strval((int)($str)+3) . "," .  strval((int)($str)+$maxcols+3) . "," .  strval((int)($str)+($maxcols*2)+3) . "," .  strval((int)($str)+($maxcols*3)+3) . ",";
                        break;
                }
        }while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size22=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
                {
			$size32=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size42=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size23=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
		{
                        $size33=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size43=$str;
			$strchk=$strchk . strval($str). "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if($str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size24=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
		{
                        $size34=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size44=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size25=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));

                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
		{
                        $size35=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size45=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size26=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));

		if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
		{
                        $size36=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size46=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size27=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));

		if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 )
		{
                        $size37=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size47=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size28=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
		{
                        $size38=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size48=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size29=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);
	//Response.Write(size21 & "<br>" & size31 & "<br>" & size41 & "<br>" & size5 & "<br>" & size22 & "<br>" & size32 & "<br>" & size42 & "<br>" & size23 & "<br>" & size33 & "<br>" & size43 & "<br>" & size24 & "<br>" & size34 & "<br>" & size44 & "<br>" & $strchk)

        do{
            $str=(int)((rand(1,400)));
            if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
            {
                    $size39=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                break;
            }
        }while(1);

        do{
            $str=(int)((rand(1,400)));
            if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
            {
                $size210=$str;
                $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                break;
            }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size310=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size211=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size311=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size212=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size312=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0 )
                {
                       $size213=$str;
                       $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                       break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size313=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size214=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size314=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size215=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0 )
                {
                    $size315=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0 )
                {
                    $size216=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                        $size316=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                        $size217=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0 )
                {
                    $size317=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size218=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);
        //Upto this output is also good and if possible below loops also can be ignored
	//echo "<br>finished:".time();
        do{
                $str=(int)((rand(1,400)));
                if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size318=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size219=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                        $size319=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                        $size220=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                        break;
                }
        }while(1);


        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size320=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size221=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size321=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                        $size222=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                        $size322=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));

                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size223=$str;

                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size323=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size224=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                        $size324=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size225=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size325=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                       $size226=$str;
                       $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                       break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size326=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size227=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0 )
                {
                        $size327=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                        $size228=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size328=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                        $size229=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                        $size329=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                        $size230=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));

                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size330=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        $output="<table  class='collageimagetableborder' border='0' cellspacing='0'>";
        $cnt=0;
        $index=0;
        for($i=1;$i<=$maxrows;$i++)
        {
            $output.="<tr>";
            for($j=1;$j<=$maxcols;$j++)
            {
                $cnt=$cnt+1;
                if( $cnt == $size21 || $cnt == $size22 || $cnt == $size23 || $cnt == $size24 || $cnt == $size25 || $cnt == $size26 || $cnt == $size27 || $cnt == $size28 || $cnt == $size29 || $cnt == $size210 || $cnt == $size211 || $cnt == $size212 || $cnt == $size213 || $cnt == $size214 || $cnt == $size215 || $cnt == $size216 || $cnt == $size217 || $cnt == $size218 || $cnt == $size219 || $cnt == $size220 || $cnt == $size221 || $cnt == $size222 || $cnt == $size223 || $cnt == $size224 || $cnt == $size225 || $cnt == $size226 || $cnt == $size227 || $cnt == $size228 || $cnt == $size229 || $cnt == $size230)
                {
                    $output.="<td colspan='2' width='30px' height='30px' valign='top'>";
                        if(isset($rows[$index]['ImagePath']))
                        {
                            $output.="<a class='borderit tt' href='Stuff/StuffDetail.php?stuffid=".$rows[$index]['StuffID']."'>
                                <img src='Stuff/StuffImages/size2/".$rows[$index]['ImagePath']."' style='height:28px;width:58px;' VSPACE='0' HSPACE='0'>
                                    <span class='tooltip'><span class='top'></span><span class='middle'>".$rows[$index]['Title']."</span><span class='bottom'></span></span>
                                    </a>";
                            $index++;
                        }
                        else
                            $output."&nbsp;</td>";
                    //$output.="</td>";
                    //$index++;
                }
                if( $cnt == $size31 || $cnt == $size32 || $cnt == $size33 || $cnt == $size34 || $cnt == $size35 || $cnt == $size36 || $cnt == $size37 || $cnt == $size38 || $cnt == $size39 || $cnt == $size310 || $cnt == $size311 || $cnt == $size312 || $cnt == $size313 || $cnt == $size314 || $cnt == $size315 || $cnt == $size316 || $cnt == $size317 || $cnt == $size318 || $cnt == $size319 || $cnt == $size320 || $cnt == $size321 || $cnt == $size322 || $cnt == $size323 || $cnt == $size324 || $cnt == $size325 || $cnt == $size326 || $cnt == $size327 || $cnt == $size328 || $cnt == $size329 || $cnt == $size330)
                {
                    $output.="<td rowspan='2'  width='30px' height='30px' valign='top'>";
                        if(isset($rows[$index]['ImagePath']))
                        {
                            $output.="<a class='borderit tt' href='Stuff/StuffDetail.php?stuffid=".$rows[$index]['StuffID']."'>
                                <img src='Stuff/StuffImages/size3/".$rows[$index]['ImagePath']."' style='min-height:60px;width:28px;' VSPACE='0' HSPACE='0'>
                                    <span class='tooltip'><span class='top'></span><span class='middle'>".$rows[$index]['Title']."</span><span class='bottom'></span></span>
                                    </a>";
                            $index++;
                        }
                        else
                            $output."&nbsp;</td>";
                    //$output.="</td>";
                    //$index++;
                }
                if( $cnt == $size41 || $cnt == $size42 || $cnt == $size43 || $cnt == $size44 || $cnt == $size45 || $cnt == $size46 || $cnt == $size47 || $cnt == $size48 )
                {
                    $output.="<td colspan='2' rowspan='2'  width='30px' height='30px' valign='top'>";
                        if(isset($rows[$index]['ImagePath']))
                        {
                            $output.="<a class='borderit tt' href='Stuff/StuffDetail.php?stuffid=".$rows[$index]['StuffID']."'>
                                <img src='Stuff/StuffImages/size4/".$rows[$index]['ImagePath']."' style='height:58px;width:58px;' VSPACE='0' HSPACE='0'>
                                    <span class='tooltip'><span class='top'></span><span class='middle'>".$rows[$index]['Title']."</span><span class='bottom'></span></span>
                                    </a>";
                            $index++;
                        }
                        else
                            $output."&nbsp;</td>";
                    //$output.="</td>";
                    //$index++;
                }
                if($cnt == $size5)
                {
                    $output.="<td colspan='4' rowspan='4'  width='30px' height='30px' valign='top'>";
                        if(isset($rows[$index]['ImagePath']))
                        {
                            $output.="<a class='borderit tt' href='Stuff/StuffDetail.php?stuffid=".$rows[$index]['StuffID']."' >
                                <img src='Stuff/StuffImages/size5/".$rows[$index]['ImagePath']."' style='height:123px;width:128px;' VSPACE='0' HSPACE='0'>
                                <span class='tooltip'><span class='top'></span><span class='middle'>".$rows[$index]['Title']."</span><span class='bottom'></span></span>
                                    </a>";
                            $index++;
                        }
                        else
                            $output."&nbsp;</td>";
                    //$output.="</td>";
                    //$index++;
                }
                if( (int)strpos( $strchk, "," . strval($cnt) . ",")>0)
                {

                }
                else
                {
                    $output.="<td  width='30px' height='30px' valign='top'>";
                        if(isset($rows[$index]['ImagePath']))
                        {
                            $output.="<a  class='borderit tt' href='Stuff/StuffDetail.php?stuffid=".$rows[$index]['StuffID']."'>
                                <img src='Stuff/StuffImages/size1/".$rows[$index]['ImagePath']."' style='height:28px;width:28px;' VSPACE='0' HSPACE='0' >
                                    <span class='tooltip'><span class='top'></span><span class='middle'>".$rows[$index]['Title']."</span><span class='bottom'></span></span>
                                    </a>";                            
                            $index++;
                        }
                        else
                            $output.="&nbsp;</td>";

                    //$output.="</td>";
                    //$index++;
                }
           }
           $output.="</tr>";
        }
        $output.="</table>";

        return $output;
    }

    function PlStuffCreatedByMember($memberid)
    {
        $this->objBllStuff=new BllStuff();
        return $this->objBllStuff->BllStuffCreatedByMember($memberid);
    }

    function PlTotalStuffOfMember($memberid)
    {
        $this->objBllStuff=new BllStuff();
        return $this->objBllStuff->BllTotalStuffOfMember($memberid);
    }

    function PlTotalBookmarkedStuffOfMember($memberid)
    {
        $this->objBllStuff=new BllStuff();
        return $this->objBllStuff->BllTotalBookmarkedStuffOfMember($memberid);
    }

    function PlWhatDoYouThinkIsBestOnHome()
    {
        $this->objBllStuff=new BllStuff();
        return $this->objBllStuff->BllWhatDoYouThinkIsBestOnHome();
    }

    //new function dated 16/11/2010
    function PlAddToPeopleLike($stuffid,$memberid,$categoryid)
    {
        $this->objBllStuff=new BllStuff();
        $this->objBllStuff->BllAddToPeopleLike($stuffid, $memberid, $categoryid);
        $msg="Success";
        return $msg;
    }

    /* Statistics Page on Admin */
    function PlTotalStuffListOnStatisticsPage()
    {
        $this->objBllStuff=new BllStuff();
        $totalStuff=$this->objBllStuff->BllTotalStuffListOnStatisticsPage();
        return $totalStuff;
    }

    function PlTotalActiveStuffListOnStatisticsPage()
    {
        $this->objBllStuff=new BllStuff();
        $totalActiveStuff=$this->objBllStuff->BllTotalActiveStuffListOnStatisticsPage();
        return $totalActiveStuff;
    }

    function PlTotalInactiveStuffListOnStatisticsPage()
    {
        $this->objBllStuff=new BllStuff();
        $totalInactiveStuff=$this->objBllStuff->BllTotalInactiveStuffListOnStatisticsPage();
        return $totalInactiveStuff;
    }

    function PlTotalLockedStuffListOnStatisticsPage()
    {
        $this->objBllStuff=new BllStuff();
        $totalLockedStuff=$this->objBllStuff->BllTotalLockedStuffListOnStatisticsPage();
        return $totalLockedStuff;
    }
    /* Ends Here */

    //Edited By Viral on 24/11/2010
    function PlGetAllActiveStuffOnAdminPage($limit="" , $status)
    {
        $this->objBllStuff=new BllStuff();
        $this->rows=$this->objBllStuff->BllBrowseAllActiveStuffOnAdminPage($limit , $status);
        $output=$this->PlMakeHtmlOnHomePage($this->rows);
        return $output;
    }

    //Ends

    //Edited By Viral on 25/1/2010

    function PlLastFriend()
    {
        $this->objBllStuff=new BllStuff();
        $LastFriends=$this->objBllStuff->BllLastFriend();
	if(isset($LastFriends))
	{
	    $curTime = time();
	    $friendCreatedTime = strtotime($LastFriends[2]['CreatedDate']);
	    if($curTime - $friendCreatedTime >10)
	    {
		$LastFriends =  "<div>Welcome to besthing.il <br> Look around and enjoy the stuff.</div>";
	    }
	    else
	    {
		$LastFriends .= "<a href='../Member/Profile.php?id=".$LastFriends[0][0]['ID']."&member=".$LastFriends[0][0]['NickName']."'><img src='../Member/MemberImages/".$LastFriends[0][0]['ProfileImagePath']."' style='width:12px;height:12px;border:1px;' alt=''/> ".$LastFriends[0][0]['NickName']."</a> and <br/>";
		$LastFriends .= "<a href='../Member/Profile.php?id=".$LastFriends[1][0]['ID']."&member=".$LastFriends[1][0]['NickName']."'><img src='../Member/MemberImages/".$LastFriends[1][0]['ProfileImagePath']."' style='width:12px;height:12px;border:1px;' alt=''/> ".$LastFriends[1][0]['NickName']."</a> are now Friends";
	    }
	}
	else
	{
	    $LastFriends = "<div>Welcome to besthing.il <br> Look around and enjoy the stuff.</div>";;
	}
        return $LastFriends;
    }
    /* Ends Here */

    /**
     * This method is used to show Collage on Member Profile.
     * @param <type> $limit
     * @param <type> $memberid
     * @return <type>
     */
    function PlShowCollageOnMemberProfile($limit,$memberid)
    {
        $this->objBllStuff=new BllStuff();
        $this->rows=$this->objBllStuff->BllShowCollageOnMemberProfilePage($limit, $memberid);
        //$output=$this->PlMakeHtmlCollageImageOnMemberProfilePage($this->rows);
        $output=$this->PlMakeCollageHtmlOnHome($this->rows);
        return $output;
    }

    //break point
    function PlMakeCollageHtmlOnHome($rows)
    {
        /*
         * <span class='tooltip'><span class='top'></span><span class='middle'>".$rows[$i]['Title']."</span><span class='bottom'></span></span>
         */

        $output="";
        for($i=0;$i<count($rows);$i++)
        {
            $output.="<a href='../Stuff/StuffDetail.php?stuffid=".$rows[$i]['StuffID']."'>
                        <img src='../Stuff/StuffImages/size1/". $rows[$i]['ImagePath']."' style='width:30px;height:30px;' border='0' alt=''/>
                      </a>
                      <!--<div class='htmltooltip'>".$rows[$i]['Title']."</div>-->";
        }
        return $output;
    }

    /**
     * This method is called on Member's Profile Page
     * @param <type> $rows
     * @return string $output
     */
    function PlMakeHtmlCollageImageOnMemberProfilePage($rows)
    {
        $str=0;
	$strchk="";
	$size21=0; $size31=0; $size41=0; $size5=0; $size22=0; $size32=0; $size42=0; $size23=0; $size33=0;
	$size43=0; $size24=0; $size34=0; $size44=0; $size25=0; $size35=0; $size45=0; $size46=0; $size47=0; $size48=0;
	$size36=0; $size37=0; $size38=0; $size39=0; $size310=0; $size311=0; $size312=0; $size313=0; $size314=0; $size315=0; $size316=0; $size317=0; $size318=0; $size319=0; $size320=0; $size321=0; $size322=0; $size323=0; $size324=0; $size325=0; $size326=0; $size327=0; $size328=0; $size329=0; $size330=0;
	$size26=0; $size27=0; $size28=0; $size29=0; $size210=0; $size211=0; $size212=0; $size213=0; $size214=0; $size215=0; $size216=0; $size217=0; $size218=0; $size219=0; $size220=0; $size221=0; $size222=0; $size223=0; $size224=0; $size225=0; $size226=0; $size227=0; $size228=0; $size229=0; $size230=0;
	$strchk="o,";

        $maxrows=11;
        $maxcols=26;
        /*if($mrows==0 && $mcols==0)
        {
            $maxrows=11;
            $maxcols=26;
        }
        else
        {
            $maxrows=$mrows;
            $maxcols=$mcols;
        }*/

	do
        {
		$str=(int)((rand(1,400)));
                //echo "1str:".$str;
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) )
                {
			$size21=$str;
			$strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
			break;
                }
        }while(1);
	do
        {
		$str=(int)((rand(1,400)));
                //echo "2str:".$str;
		if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk, "," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
                {
			$size31=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
        }while(1);


	do
        {
		$str=(int)((rand(1,400)));
                if($str < ((($maxrows-1)*$maxcols)+1) && ($str % $maxcols) <> 0 && (int)strpos($strchk,"," . strval((int)$str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
                {
			$size41=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
        }while(1);


	do
        {
		$str=(int)((rand(1,400)));

                if ($str < ((($maxrows-4)*$maxcols)+1) && ($str % $maxcols) <> 0 && ($str % $maxcols) < 24 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*2)) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*3)) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*2)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*3)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+2) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+2) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*2)+2) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*3)+2) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+3) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+3) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*2)+3) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*3)+3) . ",")===0)
		{
                        $size5=$str;
			$strchk= $strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+($maxcols*2)) . "," .  strval((int)($str)+($maxcols*3)) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . "," .  strval((int)($str)+($maxcols*2)+1) . "," .  strval((int)($str)+($maxcols*3)+1) . "," .  strval((int)($str)+2) . "," .  strval((int)($str)+$maxcols+2) . "," .  strval((int)($str)+($maxcols*2)+2) . "," .  strval((int)($str)+($maxcols*3)+2) . ","  .  strval((int)($str)+3) . "," .  strval((int)($str)+$maxcols+3) . "," .  strval((int)($str)+($maxcols*2)+3) . "," .  strval((int)($str)+($maxcols*3)+3) . ",";
                        break;
                }
        }while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size22=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
                {
			$size32=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size42=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size23=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
		{
                        $size33=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size43=$str;
			$strchk=$strchk . strval($str). "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if($str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size24=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
		{
                        $size34=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size44=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size25=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));

                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
		{
                        $size35=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size45=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size26=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));

		if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
		{
                        $size36=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size46=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size27=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));

		if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 )
		{
                        $size37=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size47=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size28=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
		{
                        $size38=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size48=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size29=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);
	//Response.Write(size21 & "<br>" & size31 & "<br>" & size41 & "<br>" & size5 & "<br>" & size22 & "<br>" & size32 & "<br>" & size42 & "<br>" & size23 & "<br>" & size33 & "<br>" & size43 & "<br>" & size24 & "<br>" & size34 & "<br>" & size44 & "<br>" & $strchk)

        do{
            $str=(int)((rand(1,400)));
            if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
            {
                    $size39=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                break;
            }
        }while(1);

        do{
            $str=(int)((rand(1,400)));
            if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
            {
                $size210=$str;
                $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                break;
            }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size310=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size211=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size311=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size212=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size312=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0 )
                {
                       $size213=$str;
                       $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                       break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size313=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size214=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size314=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size215=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0 )
                {
                    $size315=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0 )
                {
                    $size216=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                        $size316=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                        $size217=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0 )
                {
                    $size317=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size218=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);
        //Upto this output is also good and if possible below loops also can be ignored
	//echo "<br>finished:".time();
        do{
                $str=(int)((rand(1,400)));
                if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size318=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size219=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                        $size319=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                        $size220=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                        break;
                }
        }while(1);


        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size320=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size221=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size321=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                        $size222=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                        $size322=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));

                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size223=$str;

                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size323=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size224=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                        $size324=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size225=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size325=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                       $size226=$str;
                       $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                       break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size326=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size227=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0 )
                {
                        $size327=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                        $size228=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size328=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                        $size229=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                        $size329=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                        $size230=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));

                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size330=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        $output="<table  class='collageimagetableborder' border='0' cellspacing='0'>";
        $cnt=0;
        $index=0;
        for($i=1;$i<=$maxrows;$i++)
        {
            $output.="<tr>";
            for($j=1;$j<=$maxcols;$j++)
            {
                $cnt=$cnt+1;
                if( $cnt == $size21 || $cnt == $size22 || $cnt == $size23 || $cnt == $size24 || $cnt == $size25 || $cnt == $size26 || $cnt == $size27 || $cnt == $size28 || $cnt == $size29 || $cnt == $size210 || $cnt == $size211 || $cnt == $size212 || $cnt == $size213 || $cnt == $size214 || $cnt == $size215 || $cnt == $size216 || $cnt == $size217 || $cnt == $size218 || $cnt == $size219 || $cnt == $size220 || $cnt == $size221 || $cnt == $size222 || $cnt == $size223 || $cnt == $size224 || $cnt == $size225 || $cnt == $size226 || $cnt == $size227 || $cnt == $size228 || $cnt == $size229 || $cnt == $size230)
                {
                    $output.="<td colspan='2' width='30px' height='30px' valign='top'>";
                        if(isset($rows[$index]['ImagePath']))
                        {
                            $output.="<a class='borderit' href='../Stuff/StuffDetail.php?stuffid=".$rows[$index]['StuffID']."' title='".$rows[$index]['Title']."'><img src='Stuff/StuffImages/size2/".$rows[$index]['ImagePath']."' style='height:28px;width:58px;' VSPACE='0' HSPACE='0'></a>";
                            $index++;
                        }
                        else
                            $output."&nbsp;</td>";
                    //$output.="</td>";
                    //$index++;
                }
                if( $cnt == $size31 || $cnt == $size32 || $cnt == $size33 || $cnt == $size34 || $cnt == $size35 || $cnt == $size36 || $cnt == $size37 || $cnt == $size38 || $cnt == $size39 || $cnt == $size310 || $cnt == $size311 || $cnt == $size312 || $cnt == $size313 || $cnt == $size314 || $cnt == $size315 || $cnt == $size316 || $cnt == $size317 || $cnt == $size318 || $cnt == $size319 || $cnt == $size320 || $cnt == $size321 || $cnt == $size322 || $cnt == $size323 || $cnt == $size324 || $cnt == $size325 || $cnt == $size326 || $cnt == $size327 || $cnt == $size328 || $cnt == $size329 || $cnt == $size330)
                {
                    $output.="<td rowspan='2'  width='30px' height='30px' valign='top'>";
                        if(isset($rows[$index]['ImagePath']))
                        {
                            $output.="<a class='borderit' href='../Stuff/StuffDetail.php?stuffid=".$rows[$index]['StuffID']."' title='".$rows[$index]['Title']."'><img src='Stuff/StuffImages/size3/".$rows[$index]['ImagePath']."' style='min-height:60px;width:28px;' VSPACE='0' HSPACE='0'></a>";
                            $index++;
                        }
                        else
                            $output."&nbsp;</td>";
                    //$output.="</td>";
                    //$index++;
                }
                if( $cnt == $size41 || $cnt == $size42 || $cnt == $size43 || $cnt == $size44 || $cnt == $size45 || $cnt == $size46 || $cnt == $size47 || $cnt == $size48 )
                {
                    $output.="<td colspan='2' rowspan='2'  width='30px' height='30px' valign='top'>";
                        if(isset($rows[$index]['ImagePath']))
                        {
                            $output.="<a class='borderit' href='../Stuff/StuffDetail.php?stuffid=".$rows[$index]['StuffID']."' title='".$rows[$index]['Title']."'><img src='Stuff/StuffImages/size4/".$rows[$index]['ImagePath']."' style='height:58px;width:58px;' VSPACE='0' HSPACE='0'></a>";
                            $index++;
                        }
                        else
                            $output."&nbsp;</td>";
                    //$output.="</td>";
                    //$index++;
                }
                /*if($cnt == $size5)
                {
                    $output.="<td colspan='4' rowspan='4'  width='30px' height='30px' valign='top'>";
                        if(isset($rows[$index]['ImagePath']))
                        {
                            $output.="<a class='borderit' href='../Stuff/StuffDetail.php?stuffid=".$rows[$index]['StuffID']."' title='".$rows[$index]['Title']."'><img src='Stuff/StuffImages/size5/".$rows[$index]['ImagePath']."' style='height:123px;width:128px;' VSPACE='0' HSPACE='0'></a>";
                            $index++;
                        }
                        else
                            $output."&nbsp;</td>";
                    //$output.="</td>";
                    //$index++;
                }*/
                if( (int)strpos( $strchk, "," . strval($cnt) . ",")>0)
                {

                }
                else
                {
                    $output.="<td  width='30px' height='30px' valign='top'>";
                        if(isset($rows[$index]['ImagePath']))
                        {
                            $output.="<a class='borderit' href='../Stuff/StuffDetail.php?stuffid=".$rows[$index]['StuffID']."' title='".$rows[$index]['Title']."'><img src='Stuff/StuffImages/size1/".$rows[$index]['ImagePath']."' style='height:28px;width:28px;' VSPACE='0' HSPACE='0' ></a>";
                            //onmouseover=\"ajax_showTooltip(window.event,'demo-pages/ajax-tooltip.html',this);return false\" onmouseout=\"ajax_hideTooltip()\"
                            $index++;
                        }
                        else
                            $output.="&nbsp;</td>";

                    //$output.="</td>";
                    //$index++;
                }
           }
           $output.="</tr>";
        }
        $output.="</table>";

        return $output;
    }

    /**
     * This method is used to show Collage on Member Profile.
     * @param <type> $limit
     * @param <type> $memberid
     * @return <type>
     */
    function PlShowCollageOnStuffDetailPage($limit,$stufftitle,&$resultcount)
    {
        $this->objBllStuff=new BllStuff();
        $this->rows=$this->objBllStuff->BllShowCollageOnStuffDetailsPage($limit, $stufftitle);
        //$output=$this->PlMakeHtmlCollageImageOnMemberProfilePage($this->rows);
        $output=$this->PlMakeCollageHtmlOnStuffDetailsPage($this->rows,$resultcount);
        return $output;
    }

    //break point
    function PlMakeCollageHtmlOnStuffDetailsPage($rows,&$resultcount)
    {
        /*
         * <span class='tooltip'>
                            <span class='top'></span>
                                <span class='middle'>".$rows[$i]['Title']."</span>
                                <span class='bottom'></span>
                            </span>
         */
        $output="";
        for($i=0;$i<count($rows);$i++)
        {
            $output.="<a rel='htmltooltip' href='../Stuff/StuffDetail.php?stuffid=".$rows[$i]['StuffID']."'>
                        <img src='../Stuff/StuffImages/size1/". $rows[$i]['ImagePath']."' style='width:30px;height:30px;' border='0' alt=''/>
                      </a>
                      <div class='htmltooltip'>".$rows[$i]['Title']."</div>";
        }
        $resultcount=$i; //Assigning How many Records we got?
        return $output;
    }

    function PlGetSearchedStuffOnAdminPage($limit="",$search="")
    {
        $this->objBllStuff=new BllStuff();
        $this->rows=$this->objBllStuff->BllBrowseSearchedStuffOnAdminPage($limit,$search);
        $output=$this->PlMakeHtmlOnHomePage($this->rows);
        return $output;
    }

    function PlTotalSearchedStuffResultOnAdminPage($search)
    {
        $this->objBllStuff=new BllStuff();
        $totalrecords=$this->objBllStuff->BllSearchedStuffResultOnAdminPage($search);
        return $totalrecords;
    }

    //This function is defined for Hiding/Unhiding Description
    function PlHideDescription($descriptionid,$value)
    {
        $this->objBllStuff=new BllStuff();
        $result=$this->objBllStuff->BllHideDescription($descriptionid, $value);
        return $result;
    }

    //This function is defined for Hiding/Unhiding Comment
    function PlHideComment($commentid,$value)
    {
        $this->objBllStuff=new BllStuff();
        $result=$this->objBllStuff->BllHideComment($commentid, $value);
        return $result;
    }

    function PlReportViolation($stuffid,$memberid,$description)
    {
        $this->objBllStuff=new BllStuff();
        $result=$this->objBllStuff->BllReportViolation($stuffid, $memberid, $description);
        return $result;
    }

    function PlDisplayAllReportViolation($limit)
    {
        $this->objBllStuff=new BllStuff();
        $this->rows=$this->objBllStuff->BllDisplayAllReportViolation($limit);
        $output=$this->PlMakeHtmlOfReportViolationOnAdminPage($this->rows);
        return $output;
    }

    function PlMakeHtmlOfReportViolationOnAdminPage($rows)
    {
        $bgcolor='white';
        $output="<form id='frmStuff' name='frmStuff' method='POST' action='UpdateReportViolation.php'>";
        $output.="<table border='0' dir='rtl' style='font-size:12px;border: 1px solid black;' width='100%' cellpadding='0px' cellspacing='1'>";
        $output.="<tr style='background-color: #FFCC66;height:20px'>
                    <th align='right'><input type='checkbox' id='checkmain' name='checkmain' onclick='CheckAllStuff();'/></th>
                    <th style='width:18px'  align='center'>ID</th>
                    <th style='width:18px'  align='center'>StuffID</th>
                    <th style='width:120px'  align='center'>Member Name <br><span style='font-size:9px;color:grey;'>who reported</span></th>
                    <th style='width:120px' align='center'>Moderator Name  <br><span style='font-size:9px;color:grey;'>who took action</span></th>
                    <th style='width:250px' align='center'>Description</th>
                    <th align='center'>CreatedDate</th>
                    <th align='center'>Handled</th>
                    <th align='center'>HandledDate</th>
                  </tr>";
        for($i=0;$i<count($rows);$i++)
        {
            if($i%2==0)
                $bgcolor='white';
            else
                $bgcolor='#fef5ce';
            $output.="<tr bgcolor='$bgcolor'>";
                $output.="<td style='width:10px'>
                    <input type='checkbox' id='checkstuff' name='checkstuff[]' value='".$rows[$i]['ID']."' onclick='SingleUnCheckStuff();'/>
                    <!--<input type='radio' id='checkstuff' name='checkstuff' value='".$rows[$i]['StuffID']."'/>-->
                    </td>";
                $output.="<td align='center' ><a href='EditStuff.php?stuffid=".$rows[$i]['StuffID']."&task=edit' title='click to edit Stuff'>".$rows[$i]['ID']."</a></td>";
                $output.="<td align='center' >
                    <a href='../Stuff/StuffDetail.php?stuffid=".$rows[$i]['StuffID']."'>".$rows[$i]['StuffID']."</a></td>";
                $output.="<td align='right'>".$rows[$i]['MemberName']."</td>";
                $output.="<td align='right'>". $rows[$i]['ModeratorName']."</td>";
                $output.="<td align='right' >".$rows[$i]['Description']."</td>";
                $output.="<td align='right' >".$rows[$i]['CreatedDate']."</td>";
                $output.="<td align='center' >".$rows[$i]['Handled']."</td>";
                $output.="<td align='center' >".$rows[$i]['HandledDate']."</td>";
            $output.="</tr>";
        }
        $output.="<tr>";
        $output.="<td colspan='10' align='center'>";
            $output.="<!--<input type='submit' id='delete' name='delete' value='Delete'/>-->
                      <input type='submit' id='update' name='update' value='Update as Handled'/>
                      <input type='hidden' id='unhandled' name='unhandled' value='Unhandled'/>
                      <input type='button' id='checkall' name='checkall' value='Check All' onclick='CheckAllStuffs();'/>";
        $output.="</td>";
        $output.="</tr>";
        $output.="</table></form>";
        return $output;
    }

    function PlTotalUnhandledReportViolation()
    {
        $this->objBllStuff=new BllStuff();
        $totalrecords=$this->objBllStuff->BllTotalUnhandledReportViolation();
        return $totalrecords;
    }

    function PlUpdateReportViolationStatus($moderatorId,$reportId,$handler)
    {
        $this->objBllStuff=new BllStuff();
        $msg=$this->objBllStuff->BllUpdateReportViolationStatus($moderatorId,$reportId,$handler);
        return $msg;
    }

    //Handled Report Violation
    function PlDisplayAllHandledReportViolation($limit)
    {
        $this->objBllStuff=new BllStuff();
        $this->rows=$this->objBllStuff->BllDisplayAllHandledReportViolation($limit);
        $output=$this->PlMakeHtmlOfHandledReportViolationOnAdminPage($this->rows);
        return $output;
    }

    function PlMakeHtmlOfHandledReportViolationOnAdminPage($rows)
    {
        $bgcolor='white';
        $output="<form id='frmStuff' name='frmStuff' method='POST' action='UpdateReportViolation.php'>";
        $output.="<table border='0' dir='rtl' style='font-size:12px;border: 1px solid black;' width='100%' cellpadding='0px' cellspacing='1'>";
        $output.="<tr style='background-color: #FFCC66;height:20px'>
                    <th align='right'><input type='checkbox' id='checkmain' name='checkmain' onclick='CheckAllStuff();'/></th>
                    <th style='width:18px'  align='center'>ID</th>
                    <th style='width:18px'  align='center'>StuffID</th>
                    <th style='width:120px'  align='center'>Member Name <br><span style='font-size:9px;color:grey;'>who reported</span></th>
                    <th style='width:120px' align='center'>Moderator Name  <br><span style='font-size:9px;color:grey;'>who took action</span></th>
                    <th style='width:250px' align='center'>Description</th>
                    <th align='center'>CreatedDate</th>
                    <th align='center'>Handled</th>
                    <th align='center'>HandledDate</th>
                  </tr>";
        for($i=0;$i<count($rows);$i++)
        {
            if($i%2==0)
                $bgcolor='white';
            else
                $bgcolor='#fef5ce';
            $output.="<tr bgcolor='$bgcolor'>";
                $output.="<td style='width:10px'>
                    <input type='checkbox' id='checkstuff' name='checkstuff[]' value='".$rows[$i]['ID']."' onclick='SingleUnCheckStuff();'/>
                    <!--<input type='radio' id='checkstuff' name='checkstuff' value='".$rows[$i]['StuffID']."'/>-->
                    </td>";
                $output.="<td align='center' ><a href='EditStuff.php?stuffid=".$rows[$i]['StuffID']."&task=edit' title='click to edit Stuff'>".$rows[$i]['ID']."</a></td>";
                $output.="<td align='center' >
                    <a href='../Stuff/StuffDetail.php?stuffid=".$rows[$i]['StuffID']."'>".$rows[$i]['StuffID']."</a></td>";
                $output.="<td align='right'>".$rows[$i]['MemberName']."</td>";
                $output.="<td align='right'>". $rows[$i]['ModeratorName']."</td>";
                $output.="<td align='right' >".$rows[$i]['Description']."</td>";
                $output.="<td align='right' >".$rows[$i]['CreatedDate']."</td>";
                $output.="<td align='center' >".$rows[$i]['Handled']."</td>";
                $output.="<td align='center' >".$rows[$i]['HandledDate']."</td>";
            $output.="</tr>";
        }
        $output.="<tr>";
        $output.="<td colspan='10' align='center'>";
            $output.="<!--<input type='submit' id='delete' name='delete' value='Delete'/>-->
                      <input type='submit' id='update' name='update' value='Update as Unhandled'/>
                      <input type='hidden' id='handled' name='handled' value='Handled'/>
                      <input type='button' id='checkall' name='checkall' value='Check All' onclick='CheckAllStuffs();'/>";
        $output.="</td>";
        $output.="</tr>";
        $output.="</table></form>";
        return $output;
    }

    function PlTotalHandledReportViolation()
    {
        $this->objBllStuff=new BllStuff();
        $totalrecords=$this->objBllStuff->BllTotalHandledReportViolation();
        return $totalrecords;
    }

    /*News Letter Function Starts Here*/

    /**
     * This method is used to Show Latest Stuff in Member News Letter.
     * @return array $this->recordSet
     */
    function PlShowLetestStuffInNewsLetter($limit)
    {
        $this->objBllStuff=new BllStuff();
        $this->rows=$this->objBllStuff->BllShowStuffOnHome($limit);
        $output=$this->PlMakeHtmlOfLatestStuffInNewsLetter($this->rows);
        return $output;
    }

    function PlMakeHtmlOfLatestStuffInNewsLetter($rows)
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
        $output="<table class='table' dir='rtl' width='100%' cellpadding='4px' cellspacing='0'>";
        for($i=0;$i<count($rows);$i++)
        {
            if($i%2==0)
                $bgcolor='white';
            else
                $bgcolor='#fef5ce';
            $output.="<tr bgcolor='$bgcolor'>";
                //$output.="<td><a href='Stuff/DisplayStuff.php?stuffname=".$rows[$i]['Title']."'>". $rows[$i]['Title']."</a></td>";
                $output.="<td><a href='".SITE_URL."/Stuff/StuffDetail.php?stuffid=".$rows[$i]['StuffID']."'>". $rows[$i]['Title']."</a></td>";
            $output.="</tr>";
        }
        $output.="<tr><td align='left'><a style='text-decoration:none;background-color: #E8BEBE;outline:none;' href='".SITE_URL."/Stuff/BrowseStuff.php?page=1&ipp=20'>More new stuff <img src='".SITE_URL."/images/left.gif' border='0'/></a></td></tr>";
        $output.="</table>";
        return $output;
    }

    /**
     * This method is used to Show Members' Latest Stuffs In NewsLetter
     * And also showing who also Bested this Stuff.
     * @return array $this->recordSet
     */
    function PlShowMemberStuffInNewsLetter($memberid,$limit)
    {
        $this->objBllStuff=new BllStuff();
        $this->rows=$this->objBllStuff->BllShowMemberStuffInNewsLetter($memberid, $limit);
        $output=$this->PlMakeHtmlOfMemberStuffInNewsLetter($this->rows);
        return $output;
    }

    function PlMakeHtmlOfMemberStuffInNewsLetter($rows)
    {
        $bgcolor='white';
        $output="<table dir='rtl' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size:12px;' width='100%' cellpadding='4px' cellspacing='0'>";
        $output.="<tr style='background-color: #FFCC66;height:20px'>
                    <th style='width:20px' colspan='2' align='center'>tally</th>
                    <th style='width:300px' align='right'>stuff item</th>
                    <th>comments</th>
                    <th>member who also bested this stuff</th>
                  </tr>";
        for($i=0;$i<count($rows);$i++)
        {
            if($i%2==0)
                $bgcolor='white';
            else
                $bgcolor='#fef5ce';
            $output.="<tr bgcolor='$bgcolor'>";
                $output.="<td align='center'><img src='".SITE_URL."/images/likes.gif'/>".$rows[$i]['Likes']."<br><img src='".SITE_URL."/images/unlikes.gif'/>".$rows[$i]['UnLikes']."</td>";

                //$output.="<td align='center'><img class='stuffimageborder' src='StuffImages/".$images[$i]['StuffImagePath']."' width='38px' height='38px'/></td>";
                $output.="<td align='center'>
                    <a style='text-decoration:none' href='".SITE_URL."/Stuff/StuffDetail.php?stuffid=".$rows[$i]['StuffID']."'>
                    <img class='stuffimageborder' src='".SITE_URL."/Stuff/StuffImages/".$rows[$i]['ImagePath']."' style='width:38px;height:38px;padding:1px;border:1px solid black;'/>
                    </a></td>";
                $output.="<td><span style='font-size:9px;color:gray;'>". $rows[$i]['TagName']."</span>
                            <a style='text-decoration:none' href='".SITE_URL."/Stuff/StuffDetail.php?stuffid=".$rows[$i]['StuffID']."'>".$rows[$i]['Title']."</a></td>";
                $output.="<td align='center'>".$rows[$i]['TotalComment']."</td>";
                
                $output.="<td align='right'>".$this->PlShowMembersWhoBestedSameStuff($rows[$i]['StuffID'])."</td>";
            $output.="</tr>";
        }
        $output.="</table>";
        return $output;
    }

    function PlShowMembersWhoBestedSameStuff($stuffid)
    {
        $objBoStuff=new BoStuff();
        $objBoStuff->setId($stuffid);
        $MemberImageRecord=$this->PlGetMemberImages($objBoStuff);
        $output="";
        for($i=0;$i<count($MemberImageRecord);$i++)
        {
            $output.= "<a style='text-decoration:none' href='".SITE_URL."/Member/profile.php?id=".$MemberImageRecord[$i]['MemberID']."&member=".$MemberImageRecord[$i]['Nickname']."' title='".$MemberImageRecord[$i]['Nickname']."'>
            <img style='border-width:thin;border-color:black;' src='".SITE_URL."/Member/MemberImages/".$MemberImageRecord[$i]['ProfileImagePath']."' width=30px height=30px />
            </a>";
        }
        return $output;
    }

    /*News Letter Function Ends Here*/

    function PlRssFeedForLatestStuffOnHomePage()
    {
        $this->objBllStuff=new BllStuff();
        $this->rows=$this->objBllStuff->BllBrowseAllStuffOnAdminPage("limit 0,20");
        $this->PlGeneratedRssFeedFileForLatestStuffOnHomePage($this->rows);
    }

    function PlGeneratedRssFeedFileForLatestStuffOnHomePage($rows)
    {
        $myFile = "rss.xml";
        $fh = fopen($myFile, 'w') or die("can't open file");
        $FileContent="<?xml version='1.0' encoding='utf-8'?>
            <?xml-stylesheet type='text/xsl'  ?>
            <rss version='2.0'>
                <channel>
                <title>The Best Avigabso</title>
                <link>".SITE_URL."</link>
                <description>This is the site where you can write whatever you want.</description>
                <image>
                    <url>".SITE_URL."/images/TheBestLogo.gif</url>
                    <title>social.themacrosoft.com</title>
                    <link>".SITE_URL."/index.php</link>
                </image>";
        
        for($i=0;$i<count($rows);$i++)
        {
            $FileContent.="<item>";
            $FileContent.="<title>".$rows[$i]['Title']."</title>";
            $FileContent.="<link>".SITE_URL."/stuff/stuffdetail.php?stuffid=".$rows[$i]['StuffID']."</link>";
            $FileContent.="<description>".$rows[$i]['Title']."</description>";
            $FileContent.="<category>".$rows[$i]['CategoryTitle']."</category>";
            $FileContent.="<image>
                            <url>".SITE_URL."/stuff/stuffimages/size4/".$rows[$i]['ImagePath']."</url>
                            <title>".$rows[$i]['Title']."</title>
                            <link>".SITE_URL."/stuff/stuffdetail.php?stuffid=".$rows[$i]['StuffID']."</link>
                           </image>";
            $FileContent.="</item>";
        }
        $FileContent.="</channel></rss>";
        fwrite($fh, $FileContent);
        fclose($fh);
    }
}
?>