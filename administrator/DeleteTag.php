<?php
ob_start(); //Buffering the data
include_once '../commoninclude.php';
if(isset($_REQUEST['checktags']))
{
    //Generatign array values in to COMMA SEPARATED VALUEs
    //which can be passed in SQL's IN Query
    $idarray=implode(",", $_REQUEST['checktags']);

    //Business Object Layer's object declaration
    $objBoTag = new BoTags();    
    $objBoTag->setIds($idarray);

    //Presentation Layer (PL) object declaration
    $objPlTag = new PlTags();
    $output = $objPlTag->PlDeleteTag($objBoTag);
    echo $output; //displaying output here

    $pageTitle = "Tags Information";
    $contentTitle = "Delete Tags";
    $contentData = ob_get_contents(); //Strogin the buffered data in to $contentData
    ob_clean();
    header("location:DisplayTags.php?page=1&ipp=20&msg=Record has been deleted successfully.");
}
?>