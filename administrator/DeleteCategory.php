<?php
if(!session_start()) //checking whether $_SESSION has been started or not?
    session_start();
ob_start(); //Buffering the data
include_once '../commoninclude.php';
if(isset($_REQUEST['checkcategory']))
{
    //Generatign array values in to COMMA SEPARATED VALUEs
    //which can be passed in SQL's IN Query
    $idarray=implode(",", $_REQUEST['checkcategory']);

    //Business Object Layer's object declaration
    $objBoCategory = new BoCategory();
    $objBoCategory->setIds($idarray);

    //Presentation Layer (PL) object declaration
    $objPlCategory = new PlCategory();
    $output = $objPlCategory->PlDeleteCategory($objBoCategory);
    echo $output; //displaying output here

    $pageTitle = "Category Information";
    $contentTitle = "Delete Categories";
    $contentData = ob_get_contents(); //Strogin the buffered data in to $contentData
    ob_clean();
}
require_once 'AdminHome.php'; //Loading AdminHome Page
?>
