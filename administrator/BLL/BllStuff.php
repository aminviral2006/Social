<?php

class BllStuff
{
    var $objConnection; // MySql Connection Object
    var $recordSet;
    var $stuffid;
    var $urlfilename; //If URL file uploaded is specified

    function  __construct() {}

    /**
     * This method is used to Add Stuff to tblStuff.
     * This method also make entries to
     *      tblStuffDescription,
     *      tblStuffImages,
     *      tblPeopleLike
     * @param BoStuff $objBo
     * @return string $msg
     */
    function BllAddStuff(BoStuff $objBo)
    {
        $msg="";

        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        //Checking whether category exist or not
        $categoryrow=$this->BllIsCategoryExist($objBo->getCategoryTitle());
        if(count($categoryrow)>0)
        {
            $flag=$this->BllIsStuffExist($categoryrow[0]['ID'], $objBo);
            if($flag==false)
            {
                $InsertStuff="Insert Into tblStuff (ID, MemberID, Title,";
                $InsertStuff.="CategoryID, TagID, Status, HomePageStatus,CreatedDate) ";
                $InsertStuff.="values (NULL, ".$objBo->getMemberId().", '".addslashes($objBo->getTitle())."',".$categoryrow[0]['ID'].",".$objBo->getTagId().",'A', 'D','".Date('Y-m-d')."')";
                if($this->objConnection->InsertQuery($InsertStuff)==true)
                {
                    $this->stuffid=$this->objConnection->GetLastInsertedID();
                    //Method called to Add Description to Stuff
                    $this->BllAddDescription($this->stuffid, $objBo);
                    //Method called to Add Image to Stuff
                    $this->BllAddImage($this->stuffid);
                    //Method called to Add Stuff to tblPeopleLike
                    $this->BllAddToPeopleLike($this->stuffid, $_SESSION['memberid'],$categoryrow[0]['ID']);
                    $msg=$this->stuffid;
                }
                else
                {
                    //TO DO: REMOVE THIS ERROR
                    $msg=mysql_error ();
                }
            }
            else
            {
                //If Stuff Exist
                $query="Select ID From tblStuff Where Title='".addslashes($objBo->getTitle())."' or upper(convert(Title using latin1))='".addslashes(strtoupper($objBo->getTitle()))."'";
                $result=$this->objConnection->SelectQuery($query);
                $rows=$this->objConnection->RecordSet($result);
                $msg=$rows[0]['ID'];

            }
            return $msg;
        }
        else //If Category does not exist
        {
            $categoryid=$this->BllAddCategory($objBo->getCategoryTitle());
            $InsertStuff="Insert Into tblStuff (ID, MemberID, Title, ";
            $InsertStuff.="CategoryID, TagID, Status, HomePageStatus,CreatedDate) ";
            $InsertStuff.="values (NULL, ".$_SESSION['memberid'].",'".addslashes($objBo->getTitle())."', ".$categoryid."," ;
            $InsertStuff.=$objBo->getTagId().", 'A', 'D','".Date('Y-m-d')."')";
            if($this->objConnection->InsertQuery($InsertStuff)==true)
            {
                $this->stuffid=$this->objConnection->GetLastInsertedID();
                $msg=$this->stuffid;
            }
        }
        //Method called to Add Description to Stuff
        $this->BllAddDescription($this->stuffid, $objBo);
        //Method called to Add Image to Stuff
        $this->BllAddImage($this->stuffid);
        //Method called to Add Stuff to tblPeopleLike
        $this->BllAddToPeopleLike($this->stuffid, $_SESSION['memberid'],$categoryid);
        return $msg;
    }

    function BllAddCategory($categorytitle)
    {
        if(!isset($this->objConnection))
        {
            $this->objConnection=new MySQLConnection();
            $this->objConnection->Open();
        }
        $rows=$this->BllIsCategoryExist(addslashes($categorytitle));
        if(count($rows)==0)
        {
            $InsertCatagory="Insert into tblCategory (ID, Title, MemberID, CreatedDate, Status) ";
            $InsertCatagory.="values(NULL, '".addslashes($categorytitle)."', ".$_SESSION['memberid'].", '".Date('Y-m-d')."', 'A')";

            $InsertCatResult=$this->objConnection->InsertQuery($InsertCatagory);
        }
        $CategoryID=$this->objConnection->GetLastInsertedID();
        return $CategoryID;
    }

    function BllIsCategoryExist($categorytitle)
    {
        $query="Select ID, Title From tblCategory where Title='".  addslashes($categorytitle)."' or upper(convert(Title using latin1))='".addslashes(strtoupper($categorytitle))."'";

        $result=$this->objConnection->SelectQuery($query);
        $categoryrow=$this->objConnection->RecordSet($result);
        return $categoryrow;
    }

    function BllIsStuffExist($categoryid,  BoStuff $objBo)
    {
        $query="Select Title, CategoryID From tblStuff where Title='".  addslashes($objBo->getTitle())."' or upper(convert(Title using latin1))='".addslashes(strtoupper($objBo->getTitle()))."' And CategoryID=".$categoryid;
        $result=$this->objConnection->SelectQuery($query);
        $rowcount=$this->objConnection->RowsCount($result);
        if($rowcount==0)
            return false;
        else
            return true;
    }

    function BllAddDescription($stuffid, BoStuff $objBo)
    {
        if(!isset($this->objConnection))
        {
            $this->objConnection=new MySQLConnection();
            $this->objConnection->Open();
        }

        $InsertDescription="Insert Into tblStuffDescription (ID, StuffID, MemberID,Description, CreatedDate,Flag)";
        $InsertDescription.="values(NULL, ".$stuffid.",".$objBo->getMemberId().", '".addslashes($objBo->getDescription())."', '".Date('Y-m-d')."','Y')";

        if($this->objConnection->InsertQuery($InsertDescription)==true)
            $msg="Success!";
        else
            $msg="Exist";
        return $msg;
    }

    function BllAddImage($stuffid)
    {
        $rand=time();
        $imageName="";
        $targetDirectory="StuffImages/".$rand.$_FILES['file']['name'];
        $this->filename=$rand.$_FILES['file']['name']; //added by sumit on 20-Nov-2010
        if($_FILES['file']['name']=="")
            $imageName="";
        else
            $imageName=$this->filename;
        //$this->BllUploadImageInDifferentSizes();
        if(isset($_FILES['file']['name']) && $_FILES['file']['name']!="")
        {
            if(@move_uploaded_file($_FILES['file']['tmp_name'], $targetDirectory))
            {}
            $this->BllCropImageInDifferentSizes();
        }
        else if(isset($_REQUEST['txturl']) && $_REQUEST['txturl']!="")
        {
            $url = trim($_POST["txturl"]);
            if ($url)
            {
                $file = fopen($url, "rb");
                if ($file)
                {
                    $valid_exts = array("jpg", "jpeg", "gif", "png"); // default image only extensions
                    $ext = end(explode(".", strtolower(basename($url))));
                    if (in_array($ext, $valid_exts))
                    {
                        //$rand = rand(10000, 99999);
                        $rand=time();
                        $newfile = fopen("StuffImages/" . $rand . basename($url), "wb"); // replace "downloads" with whatever directory you wish.
                        $this->urlfilename=$rand.basename($url);
                        $imageName=$this->urlfilename;
                        if ($newfile)
                        {
                            while (!feof($file))
                            {
                                // Write the url file to the directory.
                                fwrite($newfile, fread($file, 1024 * 8), 1024 * 8); // write the file to the new directory at a rate of 8kb/sec. until we reach the end.
                            }
                            $this->BllCropImageInDifferentSizes();
                        }
                    }
                }
            }
        }
        if($imageName=="")
        {
            $imageName="default.jpg";
        }

        $InsertImages="Insert Into tblStuffImages (ID, StuffID, ImagePath, CreatedDate)";
        $InsertImages.="values(NULL, '".$stuffid."', '".$imageName."', '".Date('Y-m-d')."')";

        $result=$this->objConnection->InsertQuery($InsertImages);
    }

    function BllAddToPeopleLike($stuffid,$memberid,$categoryid)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Insert Into tblPeopleLike (StuffID,CategoryID,MemberID,CreatedDate) Values ";
        $query.="(".$stuffid.",".$categoryid.",".$memberid.",'".Date('Y-m-d')."')";
        $this->objConnection->InsertQuery($query);
    }

    /**
     * This method is used to Check at the TIME OF ADD STUFF BUTTON that
     * Whether the STUFF OR CATEGORY ALREADY EXIST?
     * If no then Add Category Page will displayed.
     * @param string $str
     * @return string $msg
     */
    function BllIsCategoryOrStuffExist(BoStuff $objBo)
    {
        $msg="";

        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select * From tblStuff Where Title='".addslashes($objBo->getTitle())."' or upper(convert(Title using latin1))='".addslashes($objBo->getTitle())."'";

        $stuffresult=$this->objConnection->SelectQuery($query);
        $stuffFlag=$this->objConnection->RowsCount($stuffresult);

        $query="Select * From tblCategory Where Title='".  addslashes($objBo->getTitle())."' or upper(convert(Title using latin1))='".addslashes($objBo->getTitle())."'";
        $result=$this->objConnection->SelectQuery($query);
        $categoryFlag=$this->objConnection->RowsCount($result);

        if($stuffFlag>0)
        {
            $record=$this->objConnection->RecordSet($stuffresult);
            $msg="exist-".$record[0]['id'];
        }
        else if($categoryFlag>0)
        {
            $msg="Category Exist";
        }
        else
            $msg="";
        return $msg;
    }

    function BllUpdateStuffDetails(BoStuff $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        
        $query="Update tblStuff Set Status='".$objBo->getStatus()."',HomePageStatus='".$objBo->getHomePageStatus()."'  Where id=".$objBo->getId();
        
        $result=$this->objConnection->UpdateQuery($query);
        return $result;
    }

    /**
     * This method is called at Admin Side
     * @param BoStuff $objBo
     * @return bool $result
     */
    function BllUpdateStuffDescription(BoStuff $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Update tblStuffDescription Set MemberID=".$objBo->getMemberId().", Description='".$objBo->getDescription()."',CreatedDate='".date('Y-m-d')."'  Where id=".$objBo->getId();
        $result=$this->objConnection->UpdateQuery($query);
        return $result;
    }

    function BllDeleteStuffImageFromAdmin($imageid,$stuffid)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        //Checking if no images left for this stuff then assigning Default Image
        $query="Select count(*) as Total From tblStuffImages Where StuffID=".$stuffid;
        $result=$this->objConnection->SelectQuery($query);
        $rowcount=$this->objConnection->RecordSet($result);
        if($rowcount[0]['Total']>1)
        {
            $query="Delete From tblStuffImages Where id=".$imageid." And stuffid=".$stuffid;
            $result=$this->objConnection->DeleteQuery($query);
        }
        else if($rowcount[0]['Total']==1)
        {
            $query="Update tblStuffImages Set ImagePath='default.jpg' Where StuffID=".$stuffid;
            $result=$this->objConnection->UpdateQuery($query);
        }
        return $rowcount[0]['Total'];
    }

    /**
     * This method will show Images of size 60x60 on Admin's Stuff Detail Section
     * @param int $stuffid
     * @return array $this->recordSet
     */
    function BllGetStuffImagesOnAdmin($stuffid)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select * From tblStuffImages Where StuffID=".$stuffid;
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);
        return $this->recordSet;
    }

    function BllDeleteStuff(BoStuff $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Delete From tblStuff Where id IN (".$objBo->ids.")";
        $result=$this->objConnection->DeleteQuery($query);
        return $result;
    }

    /**
     * This method is used to Browse All Stuff from tblStuff
     * @return array $this->recordSet
     */
    function BllBrowseAllStuffOnAdminPage($limit="")
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT (SELECT count( tblPeopleLike.StuffID) FROM tblPeopleLike WHERE tblPeopleLike.StuffID = tblStuff.ID) AS TotalCount,
                tblStuff.ID AS StuffID, tblStuff.Title,
                tblCategory.Title as CategoryTitle, tblTag.ID AS TagID, tblTag.TagName,
                (SELECT count( tblStuffComment.StuffID)FROM tblStuffComment
                WHERE tblStuffComment.StuffID = tblStuff.ID) AS TotalComment,
                (SELECT DISTINCT tblStuffImages.ImagePath FROM tblStuffImages, tblStuff
                WHERE tblStuffImages.StuffID = tblPeopleLike.StuffID GROUP BY tblStuffImages.StuffID LIMIT 0 , 1) AS ImagePath,
                tblMemberRegistration.Nickname, tblStuff.CreatedDate,tblStuff.Status
                FROM tblStuff
                LEFT OUTER JOIN tblPeopleLike ON tblStuff.ID = tblPeopleLike.StuffID
                LEFT OUTER JOIN tblTag ON tblStuff.TagID = tblTag.ID
                LEFT OUTER JOIN tblStuffComment ON tblStuff.ID = tblStuffComment.StuffID
                LEFT OUTER JOIN tblCategory ON tblStuff.CategoryID = tblCategory.ID
                INNER JOIN tblStuffImages ON tblStuffImages.StuffID = tblStuff.ID
                INNER JOIN tblMemberRegistration ON tblMemberRegistration.ID=tblStuff.MemberID
                WHERE 1 =1";

        $query.=" group by tblStuff.ID ";
        $query.="Order By tblStuff.ID Desc $limit";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }


    /**
     * This method is used to Browse All Stuff from tblStuff
     * @return array $this->recordSet
     */
    function BllBrowseAllStuff($tagname="",$limit="",$filter="")
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT (SELECT count( tblPeopleLike.StuffID)FROM tblPeopleLike WHERE tblPeopleLike.StuffID = tblStuff.ID) AS TotalCount,
                tblStuff.ID AS StuffID, tblStuff.Title, tblTag.ID AS TagID, tblTag.TagName,
                tblCategory.Title as CategoryTitle,
                (SELECT count( tblStuffComment.StuffID)FROM tblStuffComment
                WHERE tblStuffComment.StuffID = tblStuff.ID) AS TotalComment,
                (SELECT DISTINCT tblStuffImages.ImagePath FROM tblStuffImages, tblStuff
                WHERE tblStuffImages.StuffID = tblPeopleLike.StuffID GROUP BY tblStuffImages.StuffID LIMIT 0 , 1) AS ImagePath
                FROM tblStuff
                LEFT OUTER JOIN tblPeopleLike ON tblStuff.ID = tblPeopleLike.StuffID
                LEFT OUTER JOIN tblTag ON tblStuff.TagID = tblTag.ID
                LEFT OUTER JOIN tblStuffComment ON tblStuff.ID = tblStuffComment.StuffID
                LEFT OUTER JOIN tblCategory ON tblStuff.CategoryID = tblCategory.ID
                INNER JOIN tblStuffImages ON tblStuffImages.StuffID = tblStuff.ID
                WHERE 1 =1 AND (tblStuff.Status = 'A' Or tblStuff.Status='L') AND tblCategory.Status = 'A'";
        
        if($tagname!="" && $tagname!="All")
            $query.=" And tblTag.TagName='".$tagname."'";
        $query.=" group by tblStuff.ID ";

        if($filter=="created")
            $query.=" Order by tblPeopleLike.CreatedDate Desc ";
        else if($filter=="popular")
            $query.=" Order by TotalCount Desc  ";
        else if($filter=="active discussion")
            $query.=" Order by TotalComment Desc  ";

        $query.=" $limit";
        //echo $query;
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllTotalRecords($tagname="",$filter="")
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT (SELECT count( tblPeopleLike.StuffID)FROM tblPeopleLike WHERE tblPeopleLike.StuffID = tblStuff.ID) AS TotalCount,
                tblStuff.ID AS StuffID, tblStuff.Title, tblTag.ID AS TagID, tblTag.TagName,
                (SELECT count( tblStuffComment.StuffID)FROM tblStuffComment
                WHERE tblStuffComment.StuffID = tblStuff.ID) AS TotalComment,
                (SELECT DISTINCT tblStuffImages.ImagePath FROM tblStuffImages, tblStuff
                WHERE tblStuffImages.StuffID = tblPeopleLike.StuffID GROUP BY tblStuffImages.StuffID LIMIT 0 , 1) AS ImagePath
                FROM tblStuff
                LEFT OUTER JOIN tblPeopleLike ON tblStuff.ID = tblPeopleLike.StuffID
                LEFT OUTER JOIN tblTag ON tblStuff.TagID = tblTag.ID
                LEFT OUTER JOIN tblStuffComment ON tblStuff.ID = tblStuffComment.StuffID
                LEFT OUTER JOIN tblCategory ON tblStuff.CategoryID = tblCategory.ID
                INNER JOIN tblStuffImages ON tblStuffImages.StuffID = tblStuff.ID
                WHERE 1 =1 AND (tblStuff.Status = 'A' Or tblStuff.Status='L') AND tblCategory.Status = 'A'";

        if($tagname!="" && $tagname!="All")
            $query.=" And tblTag.TagName='".$tagname."'";
        $query.=" group by tblStuff.ID";

        if($filter=="created")
            $query.=" Order by tblPeopleLike.CreatedDate Desc";
        else if($filter=="popular")
            $query.=" Order by TotalCount Desc ";
        else if($filter=="active discussion")
            $query.=" Order by TotalComment Desc";

        $result=$this->objConnection->SelectQuery($query);
        $totalrecords=mysql_num_rows($result);

        $this->objConnection->Close();
        return $totalrecords;
    }


    function BllBrowseSearchStuff($searchtext,$limit="")
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT (SELECT count( tblPeopleLike.StuffID)FROM tblPeopleLike WHERE tblPeopleLike.StuffID = tblStuff.ID) AS TotalCount,
                tblStuff.ID AS StuffID, tblStuff.Title, tblTag.ID AS TagID, tblTag.TagName,
                tblCategory.Title as CategoryTitle,
                (SELECT count( tblStuffComment.StuffID)FROM tblStuffComment
                WHERE tblStuffComment.StuffID = tblStuff.ID) AS TotalComment,
                (SELECT DISTINCT tblStuffImages.ImagePath FROM tblStuffImages, tblStuff
                WHERE tblStuffImages.StuffID = tblPeopleLike.StuffID GROUP BY tblStuffImages.StuffID LIMIT 0 , 1) AS ImagePath
                FROM tblStuff
                LEFT OUTER JOIN tblPeopleLike ON tblStuff.ID = tblPeopleLike.StuffID
                LEFT OUTER JOIN tblTag ON tblStuff.TagID = tblTag.ID
                LEFT OUTER JOIN tblStuffComment ON tblStuff.ID = tblStuffComment.StuffID
                LEFT OUTER JOIN tblCategory ON tblStuff.CategoryID = tblCategory.ID
                INNER JOIN tblStuffImages ON tblStuffImages.StuffID = tblStuff.ID
                INNER JOIN tblStuffDescription ON tblStuff.ID=tblStuffDescription.StuffID
                WHERE 1 =1 AND (tblStuff.Status = 'A' Or tblStuff.Status='L') AND tblCategory.Status = 'A' ";
        $query.=" And (tblStuff.Title Like '%".$searchtext."%' or  ";
        $query.=" tblStuffDescription.Description Like '%".$searchtext."%' or ";
        $query.=" tblCategory.Title Like '%".$searchtext."%' ) ";

        $query.=" group by tblStuff.ID ";
        $query.=" $limit";
        
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    /*Search Stuff Total Records*/
    function BllBrowseSearchStuffTotalRecords($searchtext)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT (SELECT count( tblPeopleLike.StuffID)FROM tblPeopleLike WHERE tblPeopleLike.StuffID = tblStuff.ID) AS TotalCount,
                tblStuff.ID AS StuffID, tblStuff.Title, tblTag.ID AS TagID, tblTag.TagName,
                (SELECT count( tblStuffComment.StuffID)FROM tblStuffComment
                WHERE tblStuffComment.StuffID = tblStuff.ID) AS TotalComment,
                (SELECT DISTINCT tblStuffImages.ImagePath FROM tblStuffImages, tblStuff
                WHERE tblStuffImages.StuffID = tblPeopleLike.StuffID GROUP BY tblStuffImages.StuffID LIMIT 0 , 1) AS ImagePath
                FROM tblStuff
                LEFT OUTER JOIN tblPeopleLike ON tblStuff.ID = tblPeopleLike.StuffID
                LEFT OUTER JOIN tblTag ON tblStuff.TagID = tblTag.ID
                LEFT OUTER JOIN tblStuffComment ON tblStuff.ID = tblStuffComment.StuffID
                LEFT OUTER JOIN tblCategory ON tblStuff.CategoryID = tblCategory.ID
                INNER JOIN tblStuffImages ON tblStuffImages.StuffID = tblStuff.ID
                INNER JOIN tblStuffDescription ON tblStuff.ID=tblStuffDescription.StuffID
                WHERE 1 =1 AND (tblStuff.Status = 'A' Or tblStuff.Status='L') AND tblCategory.Status = 'A' ";
        $query.=" And (tblStuff.Title Like '%".$searchtext."%' or  ";
        $query.=" tblStuffDescription.Description Like '%".$searchtext."%' or ";
        $query.=" tblCategory.Title Like '%".$searchtext."%' ) ";

        $query.=" group by tblStuff.ID ";

        $result=$this->objConnection->SelectQuery($query);
        $totalrecords=mysql_num_rows($result);

        $this->objConnection->Close();
        return $totalrecords;
    }


    /*
     * This method is used Display Images along with related Stuff on Browse Stuff Page
     * @return array $this->recordSet
     */
    function BllGetAllImagesForStuff($tagname="",$filter="")
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $imagequery="Select tblStuffImages.StuffID as StuffImageID,tblStuffImages.ImagePath as StuffImagePath ";
        $imagequery.="From tblStuffImages,tblStuff,tblTag Where  1=1 And tblStuffImages.StuffID=tblStuff.ID And tblStuff.TagID=tblTag.ID ";
        if($tagname!="" && $tagname!="All")
            $imagequery.=" And tblTag.TagName='".$tagname."'";
        $imagequery.=" group by tblStuffImages.StuffID";

        if($filter=="created")
            $imagequery.=" Order by tblStuffImages.CreatedDate Desc ";

        $result=$this->objConnection->SelectQuery($imagequery);
        $this->recordSet=$this->objConnection->RecordSet($result);
        $this->objConnection->Close();

        return $this->recordSet;
    }

    /**
     * This method is used to Count Total Stuff of Category on BrowseCateogyr.php Page
     * @param <type> $category 
     */
    function BllBrowseCategoryStuffTotalRecords($category,$filter="")
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT (SELECT count( tblPeopleLike.StuffID)FROM tblPeopleLike WHERE tblPeopleLike.StuffID = tblStuff.ID) AS TotalCount,
                tblStuff.ID AS StuffID, tblStuff.Title, tblTag.ID AS TagID, tblTag.TagName,
                (SELECT count( tblStuffComment.StuffID)FROM tblStuffComment
                WHERE tblStuffComment.StuffID = tblStuff.ID) AS TotalComment,
                (SELECT DISTINCT tblStuffImages.ImagePath FROM tblStuffImages, tblStuff
                WHERE tblStuffImages.StuffID = tblPeopleLike.StuffID GROUP BY tblStuffImages.StuffID LIMIT 0 , 1) AS ImagePath
                FROM tblStuff
                LEFT OUTER JOIN tblPeopleLike ON tblStuff.ID = tblPeopleLike.StuffID
                LEFT OUTER JOIN tblTag ON tblStuff.TagID = tblTag.ID
                LEFT OUTER JOIN tblStuffComment ON tblStuff.ID = tblStuffComment.StuffID
                LEFT OUTER JOIN tblCategory ON tblStuff.CategoryID = tblCategory.ID
                INNER JOIN tblStuffImages ON tblStuffImages.StuffID = tblStuff.ID
                WHERE 1 =1 AND (tblStuff.Status = 'A' Or tblStuff.Status='L') AND tblCategory.Status = 'A'
                And tblPeopleLike.CategoryID=".$category." Group By tblPeopleLike.StuffID";

        if($filter=="created")
            $query.=" Order by tblPeopleLike.CreatedDate Desc";
        else if($filter=="popular")
            $query.=" Order by TotalCount Desc ";
        else if($filter=="active discussion")
            $query.=" Order by TotalComment Desc";

       
        $result=$this->objConnection->SelectQuery($query);
        $totalrecords=mysql_num_rows($result);

        $this->objConnection->Close();
        return $totalrecords;
    }

    /**
     * This method is used to Browse All Stuff Based on Category Selected on BrowseCategory.php Page
     * @return array $this->recordSet
     */
    function BllBrowseCategoryStuff($category,$limit,$filter="")
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT (SELECT count( tblPeopleLike.StuffID)FROM tblPeopleLike WHERE tblPeopleLike.StuffID = tblStuff.ID) AS TotalCount,
                tblStuff.ID AS StuffID, tblStuff.Title, tblTag.ID AS TagID, tblTag.TagName,
                (SELECT count( tblStuffComment.StuffID)FROM tblStuffComment
                WHERE tblStuffComment.StuffID = tblStuff.ID) AS TotalComment,
                (SELECT DISTINCT tblStuffImages.ImagePath FROM tblStuffImages, tblStuff
                WHERE tblStuffImages.StuffID = tblPeopleLike.StuffID GROUP BY tblStuffImages.StuffID LIMIT 0 , 1) AS ImagePath
                FROM tblStuff
                LEFT OUTER JOIN tblPeopleLike ON tblStuff.ID = tblPeopleLike.StuffID
                LEFT OUTER JOIN tblTag ON tblStuff.TagID = tblTag.ID
                LEFT OUTER JOIN tblStuffComment ON tblStuff.ID = tblStuffComment.StuffID
                LEFT OUTER JOIN tblCategory ON tblStuff.CategoryID = tblCategory.ID
                INNER JOIN tblStuffImages ON tblStuffImages.StuffID = tblStuff.ID
                WHERE 1 =1 AND (tblStuff.Status = 'A' Or tblStuff.Status='L') AND tblCategory.Status = 'A'
                And tblPeopleLike.CategoryID=".$category." Group By tblPeopleLike.StuffID";

        if($filter=="created")
            $query.=" Order by tblPeopleLike.CreatedDate Desc";
        else if($filter=="popular")
            $query.=" Order by TotalCount Desc ";
        else if($filter=="active discussion")
            $query.=" Order by TotalComment Desc";

        $query.=" $limit ";
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    /**
     * This method is used in Browse Stuff based on Category Selected.
     * Images are fetched and displayed in BrowseCategory.php Page.
     * @param <type> $categoryid
     * @return <type>
     */
    function BllBrowseCategoryStuffImages($categoryid)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $imagequery="Select tblStuffImages.StuffID as StuffImageID,tblStuffImages.ImagePath as StuffImagePath ";
        $imagequery.="From tblStuffImages,tblStuff,tblTag,tblCategory Where  1=1 And tblStuffImages.StuffID=tblStuff.ID And tblStuff.CategoryID=tblCategory.ID And tblStuff.TagID=tblTag.ID And tblStuff.CategoryID=".$categoryid;
        $imagequery.=" group by tblStuffImages.StuffID";

        $result=$this->objConnection->SelectQuery($imagequery);
        $this->recordSet=$this->objConnection->RecordSet($result);
        $this->objConnection->Close();

        return $this->recordSet;
    }

    /**
     * This method is used to Browse All Stuff from tblStuff
     * @return array $this->recordSet
     */
    function BllShowStuffOnHome($limit)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select tblStuff.ID as StuffID, tblStuff.Title,tblStuff.TagID ";
        $query.="From tblStuff inner join tblCategory on tblStuff.CategoryID=tblCategory.ID ";
        $query.=" Where (tblStuff.Status = 'A' Or tblStuff.Status='L') And tblCategory.Status='A' order by tblStuff.ID Desc limit 0,$limit";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }


    function BllShowRandomStuffTagsOnHome($limit)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $randomtagquery="Select TagName From tblTag order by rand() limit 0,1";
        $randomtagresult=  $this->objConnection->SelectQuery($randomtagquery);
        $randomtagrecord=$this->objConnection->RecordSet($randomtagresult);
        $tagname=$randomtagrecord[0]['TagName'];
        $_SESSION['randomtag']=$tagname;
        $query="Select tblStuff.ID as StuffID, tblStuff.Title, tblTag.ID as TagID, tblTag.TagName ";
        $query.="From tblTag left outer join tblStuff on tblTag.ID=tblStuff.TagID Where TagName='$tagname' And tblTag.Status='A' limit 0,$limit";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllShowTagStuffOnMemberProfile($memberid,$tagid="")
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        if(isset($tagid) && $tagid!="")
        {
            $query="Select tblStuffImages.ImagePath,tblStuff.Title,tblStuff.ID,tblTag.TagName From tblStuffImages,tblStuff,tblTag,tblMemberRegistration ";
            $query.="Where tblStuffImages.StuffID=tblStuff.ID and tblStuff.TagID=tblTag.ID And tblStuff.MemberID=tblMemberRegistration.ID And tblStuff.MemberID=$memberid and tblStuff.TagID=$tagid";

            $result=$this->objConnection->SelectQuery($query);
            $this->recordSet=$this->objConnection->RecordSet($result);
        }
        $this->objConnection->Close();
        return $this->recordSet;
    }

    /**
     * This method is used to Browse All Stuff In Member Profile
     * @return array $this->recordSet
     */
    function BllBrowseAllMemberStuff($memberid,$limit,$tagname="",$filter="")
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        /*New Working Query Logic*/
        $query="SELECT
                (SELECT COUNT(CASE WHEN Flag = 'Y' THEN 1 END) From tblPeopleLike Where StuffID=tblStuff.ID Group By StuffID) AS Likes,
                (SELECT COUNT(CASE WHEN Flag = 'N' THEN 1 END) From tblPeopleLike Where StuffID=tblStuff.ID Group By StuffID) AS UnLikes,
                tblStuff.ID AS StuffID, tblStuff.Title, tblTag.ID AS TagID, tblTag.TagName, tblPeopleLike.Flag, count( tblStuffComment.StuffID ) AS TotalComment,
                (SELECT DISTINCT tblStuffImages.ImagePath FROM tblStuffImages, tblStuff WHERE tblStuffImages.StuffID = tblPeopleLike.StuffID GROUP BY tblStuffImages.StuffID LIMIT 0 , 1 ) AS ImagePath
                FROM tblStuff
                LEFT OUTER JOIN tblPeopleLike ON tblStuff.ID = tblPeopleLike.StuffID
                LEFT OUTER JOIN tblTag ON tblStuff.TagID = tblTag.ID
                LEFT OUTER JOIN tblStuffComment ON tblStuff.ID = tblStuffComment.StuffID
                LEFT OUTER JOIN tblCategory ON tblStuff.CategoryID = tblCategory.ID
                INNER JOIN tblStuffImages ON tblStuffImages.StuffID = tblStuff.ID
                WHERE 1 =1 AND (tblStuff.Status = 'A' Or tblStuff.Status='L') AND tblCategory.Status = 'A' And tblPeopleLike.Flag='Y'
                And tblPeopleLike.MemberID=".$memberid."";
        if($tagname!="" && $tagname!="All")
            $query.=" And tblTag.TagName='".$tagname."'";
        $query.=" group by tblPeopleLike.StuffID ";

        if($filter=="created")
            $query.=" Order by tblPeopleLike.CreatedDate Desc ";
        else if($filter=="popular")
            $query.=" Order by TotalCount Desc";
        else if($filter=="active discussion")
            $query.=" Order by TotalComment Desc";
        $query.=" $limit";
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllBrowseAllMemberStuffTotal($memberid,$tagname="",$filter="")
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        /*New Working Query Logic*/
        $query="SELECT
                (SELECT COUNT(CASE WHEN Flag = 'Y' THEN 1 END) From tblPeopleLike Where StuffID=tblStuff.ID Group By StuffID) AS Likes,
                (SELECT COUNT(CASE WHEN Flag = 'N' THEN 1 END) From tblPeopleLike Where StuffID=tblStuff.ID Group By StuffID) AS UnLikes,
                tblStuff.ID AS StuffID, tblStuff.Title, tblTag.ID AS TagID, tblTag.TagName, tblPeopleLike.Flag, count( tblStuffComment.StuffID ) AS TotalComment,
                (SELECT DISTINCT tblStuffImages.ImagePath FROM tblStuffImages, tblStuff WHERE tblStuffImages.StuffID = tblPeopleLike.StuffID GROUP BY tblStuffImages.StuffID LIMIT 0 , 1 ) AS ImagePath
                FROM tblStuff
                LEFT OUTER JOIN tblPeopleLike ON tblStuff.ID = tblPeopleLike.StuffID
                LEFT OUTER JOIN tblTag ON tblStuff.TagID = tblTag.ID
                LEFT OUTER JOIN tblStuffComment ON tblStuff.ID = tblStuffComment.StuffID
                LEFT OUTER JOIN tblCategory ON tblStuff.CategoryID = tblCategory.ID
                INNER JOIN tblStuffImages ON tblStuffImages.StuffID = tblStuff.ID
                WHERE 1 =1 AND (tblStuff.Status = 'A' Or tblStuff.Status='L') AND tblCategory.Status = 'A' And tblPeopleLike.Flag='Y'
                And tblPeopleLike.MemberID=".$memberid."";
        if($tagname!="" && $tagname!="All")
            $query.=" And tblTag.TagName='".$tagname."'";
        $query.=" group by tblPeopleLike.StuffID ";

        if($filter=="created")
            $query.=" Order by tblPeopleLike.CreatedDate Desc ";
        else if($filter=="popular")
            $query.=" Order by TotalCount Desc";
        else if($filter=="active discussion")
            $query.=" Order by TotalComment Desc";

        $result=$this->objConnection->SelectQuery($query);
        $totalrecords=mysql_num_rows($result);

        $this->objConnection->Close();
        return $totalrecords;
    }

    /**
     * This method is used to Browse All Stuff In Bookmarked Stuff
     * @return array $this->recordSet
     */
    function BllBrowseAllMemberBookmarkedStuff($memberid,$limit,$tagname="",$filter="")
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        /*New Working Query Logic*/
        $query="SELECT
                (SELECT COUNT(CASE WHEN Flag = 'Y' THEN 1 END) From tblPeopleLike Where StuffID=tblStuff.ID Group By StuffID) AS Likes,
                (SELECT COUNT(CASE WHEN Flag = 'N' THEN 1 END) From tblPeopleLike Where StuffID=tblStuff.ID Group By StuffID) AS UnLikes,
                tblStuff.ID AS StuffID, tblStuff.Title, tblTag.ID AS TagID, tblTag.TagName,
                tblPeopleLike.Flag, count( tblStuffComment.StuffID ) AS TotalComment,
                (SELECT DISTINCT tblStuffImages.ImagePath
                FROM tblStuffImages, tblStuff WHERE tblStuffImages.StuffID = tblPeopleLike.StuffID
                GROUP BY tblStuffImages.StuffID LIMIT 0 , 1 ) AS ImagePath,tblPeopleLike.MemberID
                FROM tblStuff LEFT OUTER JOIN tblPeopleLike ON tblStuff.ID = tblPeopleLike.StuffID
                LEFT OUTER JOIN tblTag ON tblStuff.TagID = tblTag.ID
                LEFT OUTER JOIN tblStuffComment ON tblStuff.ID = tblStuffComment.StuffID
                LEFT OUTER JOIN tblCategory ON tblStuff.CategoryID = tblCategory.ID
                INNER JOIN tblStuffImages ON tblStuffImages.StuffID = tblStuff.ID WHERE 1 =1 AND (tblStuff.Status = 'A' Or tblStuff.Status='L')
                AND tblCategory.Status = 'A' And tblPeopleLike.MemberID=".$memberid." And tblPeopleLike.Flag='N' ";

        if($tagname!="" && $tagname!="All")
            $query.=" And tblTag.TagName='".$tagname."'";

        $query.=" group by tblPeopleLike.StuffID,tblPeopleLike.MemberID";

        if($filter=="created")
            $query.=" Order by tblPeopleLike.CreatedDate Desc ";
        else if($filter=="popular")
            $query.=" Order by TotalCount Desc";
        else if($filter=="active discussion")
            $query.=" Order by TotalComment Desc";
        $query.=" $limit";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllBrowseAllMemberBookmarkedStuffTotal($memberid,$tagname="",$filter="")
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        /*New Working Query Logic*/
        $query="SELECT
                (SELECT COUNT(CASE WHEN Flag = 'Y' THEN 1 END) From tblPeopleLike Where StuffID=tblStuff.ID Group By StuffID) AS Likes,
                (SELECT COUNT(CASE WHEN Flag = 'N' THEN 1 END) From tblPeopleLike Where StuffID=tblStuff.ID Group By StuffID) AS UnLikes,
                tblStuff.ID AS StuffID, tblStuff.Title, tblTag.ID AS TagID, tblTag.TagName,
                tblPeopleLike.Flag, count( tblStuffComment.StuffID ) AS TotalComment,
                (SELECT DISTINCT tblStuffImages.ImagePath
                FROM tblStuffImages, tblStuff WHERE tblStuffImages.StuffID = tblPeopleLike.StuffID
                GROUP BY tblStuffImages.StuffID LIMIT 0 , 1 ) AS ImagePath,tblPeopleLike.MemberID
                FROM tblStuff LEFT OUTER JOIN tblPeopleLike ON tblStuff.ID = tblPeopleLike.StuffID
                LEFT OUTER JOIN tblTag ON tblStuff.TagID = tblTag.ID
                LEFT OUTER JOIN tblStuffComment ON tblStuff.ID = tblStuffComment.StuffID
                LEFT OUTER JOIN tblCategory ON tblStuff.CategoryID = tblCategory.ID
                INNER JOIN tblStuffImages ON tblStuffImages.StuffID = tblStuff.ID WHERE 1 =1 AND (tblStuff.Status = 'A' Or tblStuff.Status='L')
                AND tblCategory.Status = 'A' And tblPeopleLike.MemberID=".$memberid." And tblPeopleLike.Flag='N' ";

        if($tagname!="" && $tagname!="All")
            $query.=" And tblTag.TagName='".$tagname."'";

        $query.=" group by tblPeopleLike.StuffID,tblPeopleLike.MemberID";

        if($filter=="created")
            $query.=" Order by tblPeopleLike.CreatedDate Desc ";
        else if($filter=="popular")
            $query.=" Order by TotalCount Desc";
        else if($filter=="active discussion")
            $query.=" Order by TotalComment Desc";


        $result=$this->objConnection->SelectQuery($query);
        $totalrecords=mysql_num_rows($result);

        $this->objConnection->Close();
        return $totalrecords;
    }

    /**
     * This method is used to Browse All Stuff In Bookmarked Stuff
     * @return array $this->recordSet
     */
    function BllBrowseAllMemberFriendsStuff($memberid,$limit,$tagname="",$filter="")
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        /*New Working Query Logic*/
        $query="SELECT
                (SELECT COUNT(CASE WHEN Flag = 'Y' THEN 1 END) From tblPeopleLike Where StuffID=tblStuff.ID Group By StuffID) AS Likes,
                (SELECT COUNT(CASE WHEN Flag = 'N' THEN 1 END) From tblPeopleLike Where StuffID=tblStuff.ID Group By StuffID) AS UnLikes,
                tblStuff.ID AS StuffID, tblStuff.Title, tblTag.ID AS TagID, tblTag.TagName,
                tblPeopleLike.Flag, count( tblStuffComment.StuffID ) AS TotalComment,
                (SELECT DISTINCT tblStuffImages.ImagePath
                FROM tblStuffImages, tblStuff WHERE tblStuffImages.StuffID = tblPeopleLike.StuffID
                GROUP BY tblStuffImages.StuffID LIMIT 0 , 1 ) AS ImagePath,tblPeopleLike.MemberID
                FROM tblStuff LEFT OUTER JOIN tblPeopleLike ON tblStuff.ID = tblPeopleLike.StuffID
                LEFT OUTER JOIN tblTag ON tblStuff.TagID = tblTag.ID
                LEFT OUTER JOIN tblStuffComment ON tblStuff.ID = tblStuffComment.StuffID
                LEFT OUTER JOIN tblCategory ON tblStuff.CategoryID = tblCategory.ID
                INNER JOIN tblStuffImages ON tblStuffImages.StuffID = tblStuff.ID WHERE 1 =1
                AND (tblStuff.Status = 'A' Or tblStuff.Status='L') AND tblCategory.Status = 'A'
                And tblPeopleLike.MemberID In (Select FriendID From tblAddFriend
                Where tblAddFriend.MemberID=".$memberid.")";

        if($tagname!="" && $tagname!="All")
            $query.=" And tblTag.TagName='".$tagname."'";

        $query.=" group by tblPeopleLike.StuffID,tblPeopleLike.MemberID";

        if($filter=="created")
            $query.=" Order by tblPeopleLike.CreatedDate Desc ";
        else if($filter=="popular")
            $query.=" Order by TotalCount Desc";
        else if($filter=="active discussion")
            $query.=" Order by TotalComment Desc";
        $query.=" $limit";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllBrowseAllMemberFriendsStuffTotal($memberid,$tagname="",$filter="")
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        /*New Working Query Logic*/
        $query="SELECT
                (SELECT COUNT(CASE WHEN Flag = 'Y' THEN 1 END) From tblPeopleLike Where StuffID=tblStuff.ID Group By StuffID) AS Likes,
                (SELECT COUNT(CASE WHEN Flag = 'N' THEN 1 END) From tblPeopleLike Where StuffID=tblStuff.ID Group By StuffID) AS UnLikes,
                tblStuff.ID AS StuffID, tblStuff.Title, tblTag.ID AS TagID, tblTag.TagName,
                tblPeopleLike.Flag, count( tblStuffComment.StuffID ) AS TotalComment,
                (SELECT DISTINCT tblStuffImages.ImagePath
                FROM tblStuffImages, tblStuff WHERE tblStuffImages.StuffID = tblPeopleLike.StuffID
                GROUP BY tblStuffImages.StuffID LIMIT 0 , 1 ) AS ImagePath,tblPeopleLike.MemberID
                FROM tblStuff LEFT OUTER JOIN tblPeopleLike ON tblStuff.ID = tblPeopleLike.StuffID
                LEFT OUTER JOIN tblTag ON tblStuff.TagID = tblTag.ID
                LEFT OUTER JOIN tblStuffComment ON tblStuff.ID = tblStuffComment.StuffID
                LEFT OUTER JOIN tblCategory ON tblStuff.CategoryID = tblCategory.ID
                INNER JOIN tblStuffImages ON tblStuffImages.StuffID = tblStuff.ID WHERE 1 =1
                AND (tblStuff.Status = 'A' Or tblStuff.Status='L') AND tblCategory.Status = 'A'
                And tblPeopleLike.MemberID In (Select FriendID From tblAddFriend
                Where tblAddFriend.MemberID=".$memberid.")";

        if($tagname!="" && $tagname!="All")
            $query.=" And tblTag.TagName='".$tagname."'";

        $query.=" group by tblPeopleLike.StuffID,tblPeopleLike.MemberID";

        if($filter=="created")
            $query.=" Order by tblPeopleLike.CreatedDate Desc ";
        else if($filter=="popular")
            $query.=" Order by TotalCount Desc";
        else if($filter=="active discussion")
            $query.=" Order by TotalComment Desc";


        $result=$this->objConnection->SelectQuery($query);
        $totalrecords=mysql_num_rows($result);

        $this->objConnection->Close();
        return $totalrecords;
    }

    //Edited By Viral
    function BllGetStuffImage(BoStuff $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $StuffImageQuery="Select ID,StuffID,ImagePath from tblStuffImages where StuffID=".$objBo->getId()." order by rand()";

        $StuffImageResult=$this->objConnection->SelectQuery($StuffImageQuery);
        $StuffImageRecord=$this->objConnection->RecordSet($StuffImageResult);
        $StuffImage=$StuffImageRecord[0]['ImagePath'];
        return $StuffImage;
    }

    //Edited by Sumit
    function BllGetStuffAllImages(BoStuff $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $StuffImageQuery="Select ID,StuffID,ImagePath from tblStuffImages where StuffID=".$objBo->getId()." order by rand() limit 0,9";

        $StuffImageResult=$this->objConnection->SelectQuery($StuffImageQuery);
        $StuffImageRecord=$this->objConnection->RecordSet($StuffImageResult);

        return $StuffImageRecord;
    }

    //Edited By Viral
    function BllGetAllStuffDetail($stuffid)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select ID,MemberID, Title, CategoryID, TagID,Status From tblStuff where ID=".$stuffid;
        //echo $query;
        $result=$this->objConnection->SelectQuery($query);
        $StuffRecord=$this->objConnection->RecordSet($result);
        return $StuffRecord;
        $this->objConnection->Close();
    }

    //Edited By Viral
    function BllGetStuffDetailForEdit($stuffid)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select tblStuff.ID, tblStuff.Title as StuffTitle,tblStuff.CategoryID,
                tblCategory.Title as CategoryTitle,tblStuff.MemberID, tblMemberRegistration.Nickname,
                tblStuff.TagID,tblTag.TagName,tblStuff.Status,tblStuff.HomePageStatus 
                From tblStuff
                Inner Join tblMemberRegistration On tblStuff.MemberID=tblMemberRegistration.ID
                Inner Join tblCategory On tblStuff.CategoryID=tblCategory.ID
                Left Outer Join tblTag On tblStuff.TagID=tblTag.ID
                Where tblStuff.ID=".$stuffid;
        
        $result=$this->objConnection->SelectQuery($query);
        $StuffRecord=$this->objConnection->RecordSet($result);
        return $StuffRecord;
        $this->objConnection->Close();
    }

    //Edited By Viral

    function BllGetMemberDetails($CreatorID)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select tblMemberRegistration.ID,tblMemberRegistration.NickName,tblMemberProfile.ProfileImagePath
                From tblMemberProfile Inner Join tblMemberRegistration On tblMemberProfile.MemberID=tblMemberRegistration.ID
                Where tblMemberRegistration.ID=".$CreatorID;
        $result=$this->objConnection->SelectQuery($query);
        $MemberRecord=$this->objConnection->RecordSet($result);
        $this->objConnection->Close();
        return $MemberRecord;
    }

    //Edited By Viral
    function BllGetDescription(BoStuff $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        $DescriptionQuery = "Select ID,Description,MemberID,CreatedDate,Sensor From tblStuffDescription where StuffID=" . $objBo->getId() . " and Flag='Y' And Sensor='U' Order By StuffID Desc Limit 0,1";
        
        $DescriptionResult = $this->objConnection->SelectQuery($DescriptionQuery);
        $DescriptionRecord=$this->objConnection->RecordSet($DescriptionResult);
        $this->objConnection->Close();
        return $DescriptionRecord;
    }

    function BllLoadSelectedDescription($id)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        $DescriptionQuery = "Select ID,Description,CreatedDate,MemberID,Sensor From tblStuffDescription where ID=".$id ;
        $DescriptionResult = $this->objConnection->SelectQuery($DescriptionQuery);
        $DescriptionRecord=$this->objConnection->RecordSet($DescriptionResult);
        $this->objConnection->Close();
        return $DescriptionRecord;
    }

    //Edited By Sumit
    function BllGetTotalDescriptionVersion(BoStuff $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        $Query = "Select count(Description) as Version From tblStuffDescription where StuffID=" . $objBo->getId() . "";
        $Result = $this->objConnection->SelectQuery($Query);
        $Record=$this->objConnection->RecordSet($Result);
        $this->objConnection->Close();
        return $Record;
    }

    //Editeb By Sumit
    function BllGetListOfDescriptionIDs(BoStuff $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        $Query = "SELECT ID FROM tblStuffDescription WHERE StuffID =" . $objBo->getId() . "";
        $Result = $this->objConnection->SelectQuery($Query);
        $Record=$this->objConnection->RecordSet($Result);
        $this->objConnection->Close();
        return $Record;
    }
    //Edited By Viral

    function BllGetTagsDestails(BoStuff $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        $TagQuery="Select TagName from tblTag where ID=".$objBo->getTagId();
        //echo $TagQuery;
        $TagResult=$this->objConnection->SelectQuery($TagQuery);
        $TagRecord=$this->objConnection->RecordSet($TagResult);
        $this->objConnection->Close();
        return $TagRecord;
    }

    //Edited By Viral
    function BllGetCommentsDetail(BoStuff $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        $query = "SELECT tblStuffComment.ID,tblStuffComment.Comment,tblStuffComment.CreatedDate,tblStuffComment.StuffID, tblStuffComment.MemberId,tblStuffComment.Sensor, tblMemberProfile.ProfileImagePath, ";
        $query.="tblMemberRegistration.Id, tblMemberRegistration.NickName FROM tblStuffComment ";
        $query.="INNER JOIN tblMemberProfile ON tblStuffComment.MemberId = tblMemberProfile.MemberId ";
        $query.="INNER JOIN tblMemberRegistration ON tblStuffComment.MemberId = tblMemberRegistration.Id ";
        $query.=" AND tblStuffComment.Sensor='U' And tblStuffComment.StuffId = ".$objBo->getId();

        $result = $this->objConnection->SelectQuery($query);
        $row = $this->objConnection->RecordSet($result);
        $this->objConnection->Close();
        return $row;
    }

    function BllDeleteCommentFromAdminPage($commentid,$stuffid)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        $query = "Delete From tblStuffComment Where id=".$commentid." And StuffID=".$stuffid;

        $result = $this->objConnection->DeleteQuery($query);
        $this->objConnection->Close();
        return $result;
    }

    //Edited By Viral
    function BllGetMemberImages(BoStuff $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        $ImagesQuery="SELECT tblMemberProfile.MemberID,tblMemberRegistration.Nickname,tblMemberProfile.ProfileImagePath
                      FROM tblMemberProfile INNER JOIN tblPeopleLike ON tblMemberProfile.MemberID = tblPeopleLike.MemberID
                      Inner Join tblMemberRegistration On tblMemberProfile.MemberID=tblMemberRegistration.ID
                      WHERE tblPeopleLike.StuffId =".$objBo->getId()." GROUP BY tblMemberProfile.ProfileImagePath";

        $ImagesResult=$this->objConnection->SelectQuery($ImagesQuery);
        $MemberImageRecord=$this->objConnection->RecordSet($ImagesResult);
        $this->objConnection->Close();
        return $MemberImageRecord;
    }

    //Edited By Viral
    function BllAddComment(BoStuff $objBo , $comment)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        $query="Insert Into tblStuffComment (ID, StuffID, MemberID, Comment, CreatedDate)";
        $query.="values (NULL, ".$objBo->getId().", ".$_SESSION['memberid'].", '".$comment."', '".Date('Y-m-d')."')";
        $result=$this->objConnection->InsertQuery($query);
    }

    //Edited by Viral
    function BllAddDescriptionUpdate($stuffid, BoStuff $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        $UpdateQuery="Update tblStuffDescription SET Flag = 'N' Where StuffID=".$stuffid;
        $UpdateResult=$this->objConnection->UpdateQuery($UpdateQuery);
        $this->objConnection->Close();

    }

    //Edited by Viral
    function BllShowCategory(BoStuff $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        $query="SELECT tblCategory.ID, tblCategory.Title FROM tblPeopleLike ";
        $query.="INNER JOIN tblCategory ON tblPeopleLike.CategoryID = tblCategory.ID ";
        $query.="INNER JOIN tblStuff ON tblPeopleLike.StuffID = tblStuff.ID ";
        $query.="AND tblStuff.ID = ".$objBo->getId()." group by tblPeopleLike.CategoryID";

        $result=$this->objConnection->SelectQuery($query);
        $DisplayCategory=$this->objConnection->RecordSet($result);
        return $DisplayCategory;
    }

    /**
     * This method is used to Browse All Stuff from tblStuff
     * @return array $this->recordSet
     */
    function BllShowCollageOnHome($limit,$maxvotes)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        /*New Working Query Logic
        $query="Select tblStuff.ID as StuffID, tblStuff.Title,
                (Select distinct tblStuffImages.ImagePath
                From tblStuffImages,tblStuff Where tblStuffImages.StuffID=tblPeopleLike.StuffID
                Group By tblStuffImages.StuffID limit 0,1) as ImagePath
                From tblStuff left outer join tblPeopleLike on tblStuff.ID=tblPeopleLike.StuffID
                Left Outer Join tblCategory on tblStuff.CategoryID=tblCategory.ID
                Inner Join tblStuffImages on tblStuffImages.StuffID=tblStuff.ID
                Where 1=1 And (tblStuff.Status = 'A' Or tblStuff.Status='L') And tblCategory.Status='A'
                And tblStuffImages.ImagePath!='default.jpg' Group By tblStuff.ID Order By rand() Limit 0,$limit";*/
        
        /*New Working Query Logic*/
        $query="Select tblStuff.ID as StuffID, tblStuff.Title,
                (SELECT count(tblPeopleLike.StuffID) FROM tblPeopleLike
                WHERE tblPeopleLike.StuffID = tblStuff.ID) AS TotalCount,
                (Select distinct tblStuffImages.ImagePath
                From tblStuffImages,tblStuff Where tblStuffImages.StuffID=tblPeopleLike.StuffID
                Group By tblStuffImages.StuffID limit 0,1) as ImagePath
                From tblStuff left outer join tblPeopleLike on tblStuff.ID=tblPeopleLike.StuffID
                Left Outer Join tblCategory on tblStuff.CategoryID=tblCategory.ID
                Inner Join tblStuffImages on tblStuffImages.StuffID=tblStuff.ID
                Where 1=1 And (tblStuff.Status = 'A' Or tblStuff.Status='L'  Or tblStuff.HomePageStatus='D')
                And tblCategory.Status='A' And
                ((Select distinct tblStuffImages.ImagePath From tblStuffImages,tblStuff
                Where tblStuffImages.StuffID=tblPeopleLike.StuffID
                Group By tblStuffImages.StuffID limit 0,1)!='default.jpg') And
                ((SELECT count(tblPeopleLike.StuffID) FROM tblPeopleLike
                WHERE tblPeopleLike.StuffID = tblStuff.ID)>=$maxvotes Or tblStuff.HomePageStatus='D')
                Group By tblPeopleLike.StuffID Order By rand() Limit 0,$limit";

        
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

     //New Edited by Viral
    function BllGetLastEdited(BoStuff $objBo)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        $query="SELECT tblMemberRegistration.ID, tblMemberRegistration.NickName FROM tblMemberRegistration ";
        $query.="INNER JOIN tblStuffDescription ON tblStuffDescription.MemberID = tblMemberRegistration.ID ";
        $query.="AND tblStuffDescription.StuffID = ".$objBo->getId()." AND Flag='Y' GROUP BY NickName";

        $result=$this->objConnection->SelectQuery($query);
        $record=$this->objConnection->RecordSet($result);

        return $record;
    }

    //Edited by Sumit for upload more images
    function BllUploadMoreImages()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $this->filename=$rand.$_FILES['file']['name']; //added on 20-Nov-2010 by sumit
        $targetDirectory="StuffImages/".str_replace('%','_',  $this->filename);
        $imageName=str_replace('%','_',$this->filename);
        $rand=time();
        
        if(isset($_FILES['file']['name']) && $_FILES['file']['name']!="")
        {

            if(move_uploaded_file(str_replace('%','_',$_FILES['file']['tmp_name']), $targetDirectory))
            {}
            $this->BllCropImageInDifferentSizes();

        }
        else if(isset($_REQUEST['txturl']) && $_REQUEST['txturl']!="")
        {
            $url = trim($_POST["txturl"]);
            if ($url)
            {
                $file = fopen($url, "rb");
                if ($file)
                {
                    $valid_exts = array("jpg", "jpeg", "gif", "png"); // default image only extensions
                    $ext = end(explode(".", strtolower(basename($url))));
                    if (in_array($ext, $valid_exts))
                    {
                        //$rand = rand(10000, 99999);
                        $rand=time();
                        $newfile = fopen("StuffImages/" . $rand . basename($url), "wb"); // replace "downloads" with whatever directory you wish.
                        $this->urlfilename=$rand.basename($url);
                        $imageName=str_replace('%','_',$this->urlfilename);
                        if ($newfile)
                        {
                            while (!feof($file))
                            {
                                // Write the url file to the directory.
                                fwrite($newfile, fread($file, 1024 * 8), 1024 * 8); // write the file to the new directory at a rate of 8kb/sec. until we reach the end.
                            }
                            $this->BllCropImageInDifferentSizes();
                        }
                    }
                }
            }
        }
        if($imageName=="")
        {
            $imageName="default.jpg";
        }
        $query="Insert Into tblStuffImages (id,StuffID,ImagePath,CreatedDate) Value ";
        $query.="(NULL,".$_REQUEST['uploadstuffid'].",'".$imageName."','".date('Y-m-d')."')";

        $this->objConnection->InsertQuery($query);

    }

    function getExtension($str)
    {
        $i = strrpos($str,".");
        if (!$i)
        {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);
        return $ext;
    }
    /*BllUploadImageInDifferentSizes*/
    function BllUploadImageInDifferentSizes()
    {
        $errors=0;

        $image =$_FILES["file"]["name"];
        $uploadedfile = $_FILES['file']['tmp_name'];

        if ($image)
        {
            $filename = stripslashes($_FILES['file']['name']);
            $extension = $this->getExtension($filename);
            $extension = strtolower($extension);
            if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif") && ($extension != "bmp"))
            {
                $change='<div class="msgdiv">Unknown Image extension </div> ';
                $errors=1;
            }
            else
            {
                $size=filesize($_FILES['file']['tmp_name']);

                if ($size > MAX_SIZE*1024)
                {
                    $change='<div class="msgdiv">You have exceeded the size limit!</div> ';
                    $errors=1;
                }
                if($extension=="jpg" || $extension=="jpeg" )
                {
                    $uploadedfile = $_FILES['file']['tmp_name'];
                    $src = imagecreatefromjpeg($uploadedfile);
                }
                else if($extension=="png")
                {
                    $uploadedfile = $_FILES['file']['tmp_name'];
                    $src = imagecreatefrompng($uploadedfile);
                }
                else if($extension=="gif")
                {
                    $uploadedfile = $_FILES['file']['tmp_name'];
                    $src = imagecreatefromgif($uploadedfile);
                }
                else if($extension=="bmp")
                {
                    $uploadedfile = $_FILES['file']['tmp_name'];
                    $src = $this->ImageCreateFromBMP($uploadedfile);
                }

                list($width,$height)=getimagesize($uploadedfile);

                //size1 h-30px X w-30px
                $size1height30=30;
                $size1width30=30;
                $tmp=imagecreatetruecolor($size1width30,$size1height30);
                imagecopyresampled($tmp,$src,0,0,0,0,$size1width30,$size1height30,$width,$height);
                $filename = "StuffImages/Size1/". $_FILES['file']['name'];
                imagejpeg($tmp,$filename,100);

                //size2 h-30px X w-62px
                $size2height30=30;
                $size2width62=60;
                $tmp=imagecreatetruecolor($size2width62,$size2height30);
                imagecopyresampled($tmp,$src,0,0,0,0,$size2width62,$size2height30,$width,$height);
                $filename = "StuffImages/Size2/". $_FILES['file']['name'];
                imagejpeg($tmp,$filename,100);

                //size3 h-62px X w-30px
                $size3height60=60;
                $size3width30=30;
                $tmp=imagecreatetruecolor($size3width30,$size3height60);
                imagecopyresampled($tmp,$src,0,0,0,0,$size3width30,$size3height60,$width,$height);
                $filename = "StuffImages/size3/". $_FILES['file']['name'];
                imagejpeg($tmp,$filename,100);

                //size4 h-62px X w-62px
                //$size4height60=60;
                $size4width60=60;
                $size4height60=60;
                $tmp=imagecreatetruecolor($size4width60,$size4height60);
                imagecopyresampled($tmp,$src,0,0,0,0,$size4width60,$size4height60,$width,$height);
                $filename = "StuffImages/Size4/". $_FILES['file']['name'];
                imagejpeg($tmp,$filename,100);

                //size5 h-128px X w-128px
                //$size5height128=120;
                $size5width128=120;
                $size5height128=120;
                $tmp=imagecreatetruecolor($size5width128,$size5height128);
                imagecopyresampled($tmp,$src,0,0,0,0,$size5width128,$size5height128,$width,$height);
                $filename = "StuffImages/Size5/". $_FILES['file']['name'];
                imagejpeg($tmp,$filename,100);

                imagedestroy($src);
                imagedestroy($tmp);
            }
        }
    }
    /*BllUploadDifferentImageSize*/

    /*Crop Images in different sizes without affecting the resolution*/
    function BllCropImageInDifferentSizes()
    {

        if($_FILES['file']['name']!="")
        {
            // *** Include the class
            include("resize-class.php");
            // 1) Initialise / load image
            $resizeObj = new resize('StuffImages/'.$this->filename); //edited by sumit on 20-Nov-2010

            /*Size1 => w:30 h:30*/
            // 2) Resize image (options: exact, portrait, landscape, auto, crop)
            $resizeObj -> resizeImage(30, 30, 'crop');
            // 3) Save image
            $resizeObj -> saveImage('StuffImages/size1/'.str_replace('%','_',$this->filename), 100);

            //Size2 => w:60 h:30
            // 2) Resize image (options: exact, portrait, landscape, auto, crop)
            $resizeObj -> resizeImage(60, 30, 'crop');
            // 3) Save image
            $resizeObj -> saveImage('StuffImages/size2/'.str_replace('%','_',$this->filename), 100);

            //Size3 => w:30 h:60
            // 2) Resize image (options: exact, portrait, landscape, auto, crop)
            $resizeObj -> resizeImage(30, 60, 'crop');
            // 3) Save image
            $resizeObj -> saveImage('StuffImages/size3/'.str_replace('%','_',$this->filename), 100);

            //Size4 => w:60 h:60
            // 2) Resize image (options: exact, portrait, landscape, auto, crop)
            $resizeObj -> resizeImage(60, 60, 'crop');
            // 3) Save image
            $resizeObj -> saveImage('StuffImages/size4/'.str_replace('%','_',$this->filename), 100);

            //Size5 => w:120 h:120
            // 2) Resize image (options: exact, portrait, landscape, auto, crop)
            $resizeObj -> resizeImage(120, 120, 'crop');
            // 3) Save image
            $resizeObj -> saveImage('StuffImages/size5/'.str_replace('%','_',$this->filename), 100);

            //Size6 => w:250 h:210
            // 2) Resize image (options: exact, portrait, landscape, auto, crop)
            $resizeObj -> resizeImage(250, 210, 'auto');
            // 3) Save image
            $resizeObj -> saveImage('StuffImages/size6/'.str_replace('%','_',$this->filename), 100);
        }
        else
        {
            // *** Include the class
            include("resize-class.php");
            // 1) Initialise / load image
            $resizeObj = new resize('StuffImages/'.$this->urlfilename,100);

            /*Size1 => w:30 h:30*/
            // 2) Resize image (options: exact, portrait, landscape, auto, crop)
            $resizeObj -> resizeImage(30, 30, 'crop');
            // 3) Save image
            $resizeObj -> saveImage('StuffImages/size1/'.str_replace('%','_',$this->urlfilename), 100);

            //Size2 => w:60 h:30
            // 2) Resize image (options: exact, portrait, landscape, auto, crop)
            $resizeObj -> resizeImage(60, 30, 'crop');
            // 3) Save image
            $resizeObj -> saveImage('StuffImages/size2/'.str_replace('%','_',$this->urlfilename), 100);

            //Size3 => w:30 h:60
            // 2) Resize image (options: exact, portrait, landscape, auto, crop)
            $resizeObj -> resizeImage(30, 60, 'crop');
            // 3) Save image
            $resizeObj -> saveImage('StuffImages/size3/'.str_replace('%','_',$this->urlfilename), 100);

            //Size4 => w:60 h:60
            // 2) Resize image (options: exact, portrait, landscape, auto, crop)
            $resizeObj -> resizeImage(60, 60, 'crop');
            // 3) Save image
            $resizeObj -> saveImage('StuffImages/size4/'.str_replace('%','_',$this->urlfilename), 100);

            //Size5 => w:120 h:120
            // 2) Resize image (options: exact, portrait, landscape, auto, crop)
            $resizeObj -> resizeImage(120, 120, 'crop');
            // 3) Save image
            $resizeObj -> saveImage('StuffImages/size5/'.str_replace('%','_',$this->urlfilename), 100);

            //Size6 => w:250 h:210
            // 2) Resize image (options: exact, portrait, landscape, auto, crop)
            $resizeObj -> resizeImage(250, 210, 'auto');
            // 3) Save image
            $resizeObj -> saveImage('StuffImages/size6/'.str_replace('%','_',$this->urlfilename), 100);
        }

    }

    /*Convert BMP to JPG*/
    function ImageCreateFromBMP($filename)
    {
        //Ouverture du fichier en mode binaire
        if (! $f1 = fopen($filename,"rb")) return FALSE;

        //1 : Chargement des ent�tes FICHIER
        $FILE = unpack("vfile_type/Vfile_size/Vreserved/Vbitmap_offset", fread($f1,14));
        if ($FILE['file_type'] != 19778) return FALSE;

        //2 : Chargement des ent�tes BMP
        $BMP = unpack('Vheader_size/Vwidth/Vheight/vplanes/vbits_per_pixel'.
                     '/Vcompression/Vsize_bitmap/Vhoriz_resolution'.
                     '/Vvert_resolution/Vcolors_used/Vcolors_important', fread($f1,40));
        $BMP['colors'] = pow(2,$BMP['bits_per_pixel']);
        if ($BMP['size_bitmap'] == 0)
            $BMP['size_bitmap'] = $FILE['file_size'] - $FILE['bitmap_offset'];

        $BMP['bytes_per_pixel'] = $BMP['bits_per_pixel']/8;
        $BMP['bytes_per_pixel2'] = ceil($BMP['bytes_per_pixel']);
        $BMP['decal'] = ($BMP['width']*$BMP['bytes_per_pixel']/4);
        $BMP['decal'] -= floor($BMP['width']*$BMP['bytes_per_pixel']/4);
        $BMP['decal'] = 4-(4*$BMP['decal']);
        if ($BMP['decal'] == 4)
            $BMP['decal'] = 0;

        //3 : Chargement des couleurs de la palette
        $PALETTE = array();
        if ($BMP['colors'] < 16777216)
        {
            $PALETTE = unpack('V'.$BMP['colors'], fread($f1,$BMP['colors']*4));
        }

        //4 : Cr�ation de l'image
        $IMG = fread($f1,$BMP['size_bitmap']);
        $VIDE = chr(0);

        $res = imagecreatetruecolor($BMP['width'],$BMP['height']);
        $P = 0;
        $Y = $BMP['height']-1;
        while ($Y >= 0)
        {
            $X=0;
            while ($X < $BMP['width'])
            {
                if ($BMP['bits_per_pixel'] == 24)
                    $COLOR = unpack("V",substr($IMG,$P,3).$VIDE);
                else if ($BMP['bits_per_pixel'] == 16)
                {
                    $COLOR = unpack("n",substr($IMG,$P,2));
                    $COLOR[1] = $PALETTE[$COLOR[1]+1];
                }
                else if ($BMP['bits_per_pixel'] == 8)
                {
                    $COLOR = unpack("n",$VIDE.substr($IMG,$P,1));
                    $COLOR[1] = $PALETTE[$COLOR[1]+1];
                }
                else if ($BMP['bits_per_pixel'] == 4)
                {
                    $COLOR = unpack("n",$VIDE.substr($IMG,floor($P),1));
                    if (($P*2)%2 == 0)
                        $COLOR[1] = ($COLOR[1] >> 4);
                    else
                        $COLOR[1] = ($COLOR[1] & 0x0F);
                    $COLOR[1] = $PALETTE[$COLOR[1]+1];
                }
                else if ($BMP['bits_per_pixel'] == 1)
                {
                    $COLOR = unpack("n",$VIDE.substr($IMG,floor($P),1));
                    if(($P*8)%8 == 0)
                        $COLOR[1] =  $COLOR[1] >>7;
                    else if (($P*8)%8 == 1)
                        $COLOR[1] = ($COLOR[1] & 0x40)>>6;
                    else if (($P*8)%8 == 2)
                        $COLOR[1] = ($COLOR[1] & 0x20)>>5;
                    else if (($P*8)%8 == 3)
                        $COLOR[1] = ($COLOR[1] & 0x10)>>4;
                    else if (($P*8)%8 == 4)
                        $COLOR[1] = ($COLOR[1] & 0x8)>>3;
                    else if (($P*8)%8 == 5)
                        $COLOR[1] = ($COLOR[1] & 0x4)>>2;
                    else if (($P*8)%8 == 6)
                        $COLOR[1] = ($COLOR[1] & 0x2)>>1;
                    else if (($P*8)%8 == 7)
                        $COLOR[1] = ($COLOR[1] & 0x1);
                    $COLOR[1] = $PALETTE[$COLOR[1]+1];
                }
            else
                return FALSE;
            imagesetpixel($res,$X,$Y,$COLOR[1]);
            $X++;
            $P += $BMP['bytes_per_pixel'];
        }
        $Y--;
        $P+=$BMP['decal'];
        }

        //Fermeture du fichier
        fclose($f1);
        return $res;
    }
    /*Ends here*/

    //Edited by Viral
    function BllUploadImages($stuffid , $filename)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();
        $query="Insert Into tblStuffImages (ID, StuffID, ImagePath, CreatedDate)";
        $query.="values(NULL, '".$stuffid."', '".$filename."', '".Date('Y-m-d')."')";

        if($this->objConnection->InsertQuery($query)==true)
            $deleteDefault=$this->BllDeleteDefaultImage($stuffid);
    }

    //Edited By Viral
    function BllDeleteDefaultImage($stuffid)
    {
        $query="Delete From tblStuffImages where StuffID=".$stuffid." and ImagePath='default.jpg'";
        $result=$this->objConnection->DeleteQuery($query);
    }

    function BllStuffCreatedByMember($memberid)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT count(tblStuff.MemberID) as TotalStuffCreated ";
        $query.="FROM tblStuff Inner Join tblMemberRegistration On tblStuff.MemberID=tblMemberRegistration.ID ";
        $query.=" Where tblStuff.MemberID=".$memberid." Group By tblStuff.MemberID";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        if(isset($this->recordSet[0]['TotalStuffCreated']))
            return $this->recordSet[0]['TotalStuffCreated'];
        else
            return 0;
    }

    function BllTotalStuffOfMember($memberid)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT count(tblPeopleLike.MemberID) as TotalStuff ";
        $query.="FROM tblPeopleLike Inner Join tblMemberRegistration On tblPeopleLike.MemberID=tblMemberRegistration.ID ";
        $query.=" Where tblPeopleLike.MemberID=".$memberid." Group By tblPeopleLike.MemberID";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        if(isset($this->recordSet[0]['TotalStuff']))
            return $this->recordSet[0]['TotalStuff'];
        else
            return 0;
    }

    function BllTotalBookmarkedStuffOfMember($memberid)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT count(tblPeopleLike.MemberID) as TotalBookmarkedStuff ";
        $query.="FROM tblPeopleLike Inner Join tblMemberRegistration On tblPeopleLike.MemberID=tblMemberRegistration.ID ";
        $query.=" Where tblPeopleLike.MemberID=".$memberid." And tblPeopleLike.Flag='N' Group By tblPeopleLike.MemberID";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        if(isset($this->recordSet[0]['TotalBookmarkedStuff']))
            return $this->recordSet[0]['TotalBookmarkedStuff'];
        else
            return 0;
    }

    function BllWhatDoYouThinkIsBestOnHome()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select tblMemberRegistration.Nickname,tblMemberRegistration.ID as MemberID,
                tblCategory.ID as CategoryID,tblCategory.Title as CategoryTitle,
                tblStuff.Title as StuffTitle,tblStuff.ID as StuffID,
                tblMemberProfile.ProfileImagePath
                From tblMemberRegistration Inner Join tblMemberProfile On tblMemberProfile.MemberID=tblMemberRegistration.ID 
		Inner Join tblCategory On tblCategory.MemberID=tblMemberRegistration.ID
                Inner Join tblStuff On tblStuff.MemberID=tblMemberRegistration.ID Order By rand() Limit 0,1";
	
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    /* Statistics Page Queries */    
    function BllTotalStuffListOnStatisticsPage()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select count(*) as TotalStuff From tblStuff";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet[0]['TotalStuff'];
    }

    function BllTotalActiveStuffListOnStatisticsPage()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select count(*) as TotalActiveStuff From tblStuff Where Status='A'";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet[0]['TotalActiveStuff'];
    }

    function BllTotalInactiveStuffListOnStatisticsPage()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select count(*) as TotalInactiveStuff From tblStuff Where Status='I'";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet[0]['TotalInactiveStuff'];
    }

    function BllTotalLockedStuffListOnStatisticsPage()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select count(*) as TotalLockedStuff From tblStuff Where Status='L'";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet[0]['TotalLockedStuff'];
    }
    /* Ends Here */

    //Edited by Viral on 24/11/2010

    function BllBrowseAllActiveStuffOnAdminPage($limit="",$status)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT (SELECT count( tblPeopleLike.StuffID)FROM tblPeopleLike WHERE tblPeopleLike.StuffID = tblStuff.ID) AS TotalCount,
                tblStuff.ID AS StuffID, tblStuff.Title,
                tblCategory.Title as CategoryTitle, tblTag.ID AS TagID, tblTag.TagName,
                (SELECT count( tblStuffComment.StuffID)FROM tblStuffComment
                WHERE tblStuffComment.StuffID = tblStuff.ID) AS TotalComment,
                (SELECT DISTINCT tblStuffImages.ImagePath FROM tblStuffImages, tblStuff
                WHERE tblStuffImages.StuffID = tblPeopleLike.StuffID GROUP BY tblStuffImages.StuffID LIMIT 0 , 1) AS ImagePath,
                tblMemberRegistration.Nickname, tblStuff.CreatedDate,tblStuff.Status
                FROM tblStuff
                LEFT OUTER JOIN tblPeopleLike ON tblStuff.ID = tblPeopleLike.StuffID
                LEFT OUTER JOIN tblTag ON tblStuff.TagID = tblTag.ID
                LEFT OUTER JOIN tblStuffComment ON tblStuff.ID = tblStuffComment.StuffID
                LEFT OUTER JOIN tblCategory ON tblStuff.CategoryID = tblCategory.ID
                INNER JOIN tblStuffImages ON tblStuffImages.StuffID = tblStuff.ID
                INNER JOIN tblMemberRegistration ON tblMemberRegistration.ID=tblStuff.MemberID
                WHERE 1 =1 AND tblCategory.Status = 'A'  AND tblStuff.Status = '".$status."'";

        $query.=" group by tblStuff.ID ";
        $query.=" $limit";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }
    //Ends

    //Edited By Viral on 25/11/2010

    function BllLastFriend()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT * FROM tblAddFriend WHERE Approved = 'A' ORDER BY ID DESC LIMIT 0 , 1";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();

        $LastFriendAID=$this->recordSet[0]['MemberID'];
        $LastFriendBID=$this->recordSet[0]['FriendID'];
        $LastFriendName= array ();
        $LastFriendName[0]=$this->BllGetMemberDetails($LastFriendAID);
        $LastFriendName[1]=$this->BllGetMemberDetails($LastFriendBID);
        return $LastFriendName;
    }
    /* Ends Here */

    /**
     * This method is used to Show Collage Image on Member's Profile Page.
     * @return array $this->recordSet
     */
    function BllShowCollageOnMemberProfilePage($limit,$memberid)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        /*New Working Query Logic*/
        $query="Select tblStuff.ID as StuffID, tblStuff.Title,
                (Select distinct tblStuffImages.ImagePath
                From tblStuffImages,tblStuff Where tblStuffImages.StuffID=tblPeopleLike.StuffID
                Group By tblStuffImages.StuffID limit 0,1) as ImagePath
                From tblStuff left outer join tblPeopleLike on tblStuff.ID=tblPeopleLike.StuffID
                Left Outer Join tblCategory on tblStuff.CategoryID=tblCategory.ID
                Inner Join tblStuffImages on tblStuffImages.StuffID=tblStuff.ID
                Where 1=1 And (tblStuff.Status = 'A' Or tblStuff.Status='L') And tblCategory.Status='A'
                And tblStuffImages.ImagePath!='default.jpg' And tblStuff.MemberID=".$memberid." 
                Group By tblStuff.ID Order By rand() Limit 0,$limit";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    /**
     * This method is used to Show Collage Image on Stuff Detail Page.
     * @return array $this->recordSet
     */
    function BllShowCollageOnStuffDetailsPage($limit,$stufftitle)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        /*New Working Query Logic*/
        $query="Select tblStuff.ID as StuffID, tblStuff.Title,
                (Select distinct tblStuffImages.ImagePath
                From tblStuffImages,tblStuff Where tblStuffImages.StuffID=tblPeopleLike.StuffID
                Group By tblStuffImages.StuffID limit 0,1) as ImagePath
                From tblStuff left outer join tblPeopleLike on tblStuff.ID=tblPeopleLike.StuffID
                Left Outer Join tblCategory on tblStuff.CategoryID=tblCategory.ID
                Inner Join tblStuffImages on tblStuffImages.StuffID=tblStuff.ID
                Where 1=1 And (tblStuff.Status = 'A' Or tblStuff.Status='L') And tblCategory.Status='A'
                And tblStuffImages.ImagePath!='default.jpg' And tblStuff.Title Like '%".$stufftitle."%'
                Group By tblStuff.ID Order By rand() Limit 0,$limit";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    /**
     * This method is used to Browse All Stuff from tblStuff
     * @return array $this->recordSet
     */
    function BllBrowseSearchedStuffOnAdminPage($limit="",$search="")
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT (SELECT count( tblPeopleLike.StuffID) FROM tblPeopleLike WHERE tblPeopleLike.StuffID = tblStuff.ID) AS TotalCount,
                tblStuff.ID AS StuffID, tblStuff.Title,
                tblCategory.Title as CategoryTitle, tblTag.ID AS TagID, tblTag.TagName,
                (SELECT count( tblStuffComment.StuffID)FROM tblStuffComment
                WHERE tblStuffComment.StuffID = tblStuff.ID) AS TotalComment,
                (SELECT DISTINCT tblStuffImages.ImagePath FROM tblStuffImages, tblStuff
                WHERE tblStuffImages.StuffID = tblPeopleLike.StuffID GROUP BY tblStuffImages.StuffID LIMIT 0 , 1) AS ImagePath,
                tblMemberRegistration.Nickname, tblStuff.CreatedDate,tblStuff.Status
                FROM tblStuff
                LEFT OUTER JOIN tblPeopleLike ON tblStuff.ID = tblPeopleLike.StuffID
                LEFT OUTER JOIN tblTag ON tblStuff.TagID = tblTag.ID
                LEFT OUTER JOIN tblStuffComment ON tblStuff.ID = tblStuffComment.StuffID 
                LEFT OUTER JOIN tblStuffDescription ON tblStuff.ID = tblStuffDescription.StuffID
                LEFT OUTER JOIN tblCategory ON tblStuff.CategoryID = tblCategory.ID
                INNER JOIN tblStuffImages ON tblStuffImages.StuffID = tblStuff.ID
                INNER JOIN tblMemberRegistration ON tblMemberRegistration.ID=tblStuff.MemberID
                WHERE 1 =1 And tblStuff.Title Like '%".$search."%'  Or
                tblStuffComment.Comment Like '%".$search."%' Or tblStuffDescription.Description Like '%".$search."%'";

        $query.=" group by tblStuff.ID ";
        $query.=" $limit";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllSearchedStuffResultOnAdminPage($search)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="SELECT (SELECT count( tblPeopleLike.StuffID) FROM tblPeopleLike WHERE tblPeopleLike.StuffID = tblStuff.ID) AS TotalCount,
                tblStuff.ID AS StuffID, tblStuff.Title,
                tblCategory.Title as CategoryTitle, tblTag.ID AS TagID, tblTag.TagName,
                (SELECT count( tblStuffComment.StuffID)FROM tblStuffComment
                WHERE tblStuffComment.StuffID = tblStuff.ID) AS TotalComment,
                (SELECT DISTINCT tblStuffImages.ImagePath FROM tblStuffImages, tblStuff
                WHERE tblStuffImages.StuffID = tblPeopleLike.StuffID GROUP BY tblStuffImages.StuffID LIMIT 0 , 1) AS ImagePath,
                tblMemberRegistration.Nickname, tblStuff.CreatedDate,tblStuff.Status
                FROM tblStuff
                LEFT OUTER JOIN tblPeopleLike ON tblStuff.ID = tblPeopleLike.StuffID
                LEFT OUTER JOIN tblTag ON tblStuff.TagID = tblTag.ID
                LEFT OUTER JOIN tblStuffComment ON tblStuff.ID = tblStuffComment.StuffID
                LEFT OUTER JOIN tblStuffDescription ON tblStuff.ID = tblStuffDescription.StuffID
                LEFT OUTER JOIN tblCategory ON tblStuff.CategoryID = tblCategory.ID
                INNER JOIN tblStuffImages ON tblStuffImages.StuffID = tblStuff.ID
                INNER JOIN tblMemberRegistration ON tblMemberRegistration.ID=tblStuff.MemberID
                WHERE 1 =1 And tblStuff.Title Like '%".$search."%' Or 
                tblStuffComment.Comment Like '%".$search."%' Or tblStuffDescription.Description Like '%".$search."%'";

        $query.=" Group by tblStuff.ID ";

        $result=$this->objConnection->SelectQuery($query);
        $totalrecords=mysql_num_rows($result);

        $this->objConnection->Close();
        return $totalrecords;
    }

    //This function is defined for Hiding/Unhiding Description
    function BllHideDescription($descriptionid,$value)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Update tblStuffDescription Set Sensor='".$value."' Where ID=".$descriptionid;
        $result=  $this->objConnection->UpdateQuery($query);

        $query="Update tblStuffDescription Set Flag='Y' Where StuffID=".$_SESSION['stuffid'];
        $result=  $this->objConnection->UpdateQuery($query);

        $this->objConnection->Close();
        return $result;
    }

    //This function is defined for Hiding/Unhiding Comment
    function BllHideComment($commentid,$value)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Update tblStuffComment Set Sensor='".$value."' Where ID=".$commentid;

        $result=  $this->objConnection->UpdateQuery($query);

        $this->objConnection->Close();
        return $result;
    }

    function BllReportViolation($stuffid,$memberid,$description)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Insert Into tblReportViolation (StuffID,MemberID,Description,CreatedDate,Handled) Values
                ($stuffid,$memberid,'".addslashes($description)."',now(),'N')";
        
        $result=$this->objConnection->InsertQuery($query);
        
        $this->objConnection->Close();
        return $result;
    }

    function BllDisplayAllReportViolation($limit)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select tblReportViolation.ID,tblReportViolation.StuffID,tblReportViolation.MemberID,
                tblReportViolation.ModeratorID,tblReportViolation.Description,tblReportViolation.CreatedDate,
                tblReportViolation.Handled,tblReportViolation.HandledDate,
                tblMemberRegistration.Nickname as MemberName,
                (Select tblMemberRegistration.Nickname From tblMemberRegistration
                Where tblReportViolation.ModeratorID=tblMemberRegistration.ID) as ModeratorName
                From tblReportViolation
                Inner Join tblMemberRegistration On tblReportViolation.MemberID=tblMemberRegistration.ID
                Inner Join tblStuff On tblReportViolation.StuffID=tblStuff.ID
                Where tblReportViolation.Handled='N' $limit";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllTotalUnhandledReportViolation()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select tblReportViolation.ID,tblReportViolation.StuffID,tblReportViolation.MemberID,
                tblReportViolation.ModeratorID,tblReportViolation.Description,tblReportViolation.CreatedDate,
                tblReportViolation.Handled,tblReportViolation.HandledDate,
                tblMemberRegistration.Nickname as MemberName,
                (Select tblMemberRegistration.Nickname From tblMemberRegistration
                Where tblReportViolation.ModeratorID=tblMemberRegistration.ID) as ModeratorName
                From tblReportViolation
                Inner Join tblMemberRegistration On tblReportViolation.MemberID=tblMemberRegistration.ID
                Inner Join tblStuff On tblReportViolation.StuffID=tblStuff.ID
                Where tblReportViolation.Handled='N'";

        $result=$this->objConnection->SelectQuery($query);
        $totalrecords=mysql_num_rows($result);

        $this->objConnection->Close();
        return $totalrecords;
    }

    function BllUpdateReportViolationStatus($moderatorId,$reportId,$handler)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Update tblReportViolation Set Handled='".$handler."',ModeratorID=".$moderatorId.",HandledDate=now()
                Where ID=".$reportId;
        
        $msg="";
        if($this->objConnection->UpdateQuery($query))
        {
            $msg="Report Violation handled successfully.";
        }
        else
            $msg="Report Violation does not handled successfully.";
        
        $this->objConnection->Close();
        return $msg;
    }

    function BllDisplayAllHandledReportViolation($limit)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select tblReportViolation.ID,tblReportViolation.StuffID,tblReportViolation.MemberID,
                tblReportViolation.ModeratorID,tblReportViolation.Description,tblReportViolation.CreatedDate,
                tblReportViolation.Handled,tblReportViolation.HandledDate,
                tblMemberRegistration.Nickname as MemberName,
                (Select tblMemberRegistration.Nickname From tblMemberRegistration
                Where tblReportViolation.ModeratorID=tblMemberRegistration.ID) as ModeratorName
                From tblReportViolation
                Inner Join tblMemberRegistration On tblReportViolation.MemberID=tblMemberRegistration.ID
                Inner Join tblStuff On tblReportViolation.StuffID=tblStuff.ID
                Where tblReportViolation.Handled='Y' $limit";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    function BllTotalHandledReportViolation()
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select tblReportViolation.ID,tblReportViolation.StuffID,tblReportViolation.MemberID,
                tblReportViolation.ModeratorID,tblReportViolation.Description,tblReportViolation.CreatedDate,
                tblReportViolation.Handled,tblReportViolation.HandledDate,
                tblMemberRegistration.Nickname as MemberName,
                (Select tblMemberRegistration.Nickname From tblMemberRegistration
                Where tblReportViolation.ModeratorID=tblMemberRegistration.ID) as ModeratorName
                From tblReportViolation
                Inner Join tblMemberRegistration On tblReportViolation.MemberID=tblMemberRegistration.ID
                Inner Join tblStuff On tblReportViolation.StuffID=tblStuff.ID
                Where tblReportViolation.Handled='Y'";

        $result=$this->objConnection->SelectQuery($query);
        $totalrecords=mysql_num_rows($result);

        $this->objConnection->Close();
        return $totalrecords;
    }

    /**
     * This method is used to Show Latest Stuff in Member News Letter.
     * @return array $this->recordSet
     */
    function BllShowLetestStuffInNewsLetter($limit)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        $query="Select tblStuff.ID as StuffID, tblStuff.Title,tblStuff.TagID ";
        $query.="From tblStuff inner join tblCategory on tblStuff.CategoryID=tblCategory.ID ";
        $query.=" Where (tblStuff.Status = 'A' Or tblStuff.Status='L') And tblCategory.Status='A' order by tblStuff.ID Desc limit 0,$limit";

        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }

    /**
     * This method is used to Show Members' Latest Stuffs In NewsLetter
     * And also showing who also Bested this Stuff.
     * @return array $this->recordSet
     */
    function BllShowMemberStuffInNewsLetter($memberid,$limit)
    {
        $this->objConnection=new MySQLConnection();
        $this->objConnection->Open();

        /*New Working Query Logic*/
        $query="SELECT
                (SELECT COUNT(CASE WHEN Flag = 'Y' THEN 1 END) From tblPeopleLike Where StuffID=tblStuff.ID Group By StuffID) AS Likes,
                (SELECT COUNT(CASE WHEN Flag = 'N' THEN 1 END) From tblPeopleLike Where StuffID=tblStuff.ID Group By StuffID) AS UnLikes,
                tblStuff.ID AS StuffID, tblStuff.Title, tblTag.ID AS TagID, tblTag.TagName, tblPeopleLike.Flag, count( tblStuffComment.StuffID ) AS TotalComment,
                (SELECT DISTINCT tblStuffImages.ImagePath FROM tblStuffImages, tblStuff WHERE tblStuffImages.StuffID = tblPeopleLike.StuffID GROUP BY tblStuffImages.StuffID LIMIT 0 , 1 ) AS ImagePath
                FROM tblStuff
                LEFT OUTER JOIN tblPeopleLike ON tblStuff.ID = tblPeopleLike.StuffID
                LEFT OUTER JOIN tblTag ON tblStuff.TagID = tblTag.ID
                LEFT OUTER JOIN tblStuffComment ON tblStuff.ID = tblStuffComment.StuffID
                LEFT OUTER JOIN tblCategory ON tblStuff.CategoryID = tblCategory.ID
                INNER JOIN tblStuffImages ON tblStuffImages.StuffID = tblStuff.ID
                WHERE 1 =1 AND (tblStuff.Status = 'A' Or tblStuff.Status='L') AND tblCategory.Status = 'A' And tblPeopleLike.Flag='Y'
                And tblPeopleLike.MemberID=".$memberid."";
        
        $query.=" Group By tblPeopleLike.StuffID Order By tblPeopleLike.CreatedDate Desc Limit 0,$limit ";
        $result=$this->objConnection->SelectQuery($query);
        $this->recordSet=$this->objConnection->RecordSet($result);

        $this->objConnection->Close();
        return $this->recordSet;
    }
}
?>