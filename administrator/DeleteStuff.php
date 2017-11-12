<?php
ob_start(); //Buffering the data
include_once '../commoninclude.php';
if(isset($_REQUEST['checkstuff']))
{
    //Generatign array values in to COMMA SEPARATED VALUEs
    //which can be passed in SQL's IN Query
    $idarray=implode(",", $_REQUEST['checkstuff']);
    
    //Business Object Layer's object declaration
    $objBoStuff = new BoStuff();
    $objBoStuff->setIds($idarray);
    
    //Presentation Layer (PL) object declaration
    $objPlStuff = new PlStuff();
    $result = $objPlStuff->PlDeleteStuff($objBoStuff);
    $msg="";
    if($result==true)
        $msg="Record(s) has been deleted successfully.";
    else
        $msg="Record(s) has not been deleted successfully.";
    $pageTitle = "Stuff Information";
    $contentTitle = "Delete Stuff";
    $contentData = ob_get_contents(); //Strogin the buffered data in to $contentData
    ob_clean();
    header("location:DisplayStuffs.php?page=1&ipp=20&msg=".$msg);
}
else if(isset($_REQUEST['UpdateStatus']))
{
    $objBoStuff=new BoStuff();
    print_r($_POST);
    echo $_REQUEST['stuffid'];
    echo $_REQUEST['stuffstatus'];die();
    $objPlStuff=new PlStuff();
    $msg=$objPlStuff->PlUpdateStuffStatus($objBoStuff);
    //header("location:DisplayTags.php?page=1&ipp=20&msg=".$msg);
    $ref=@$HTTP_REFERER;
    header("location:".$ref);
}
?>