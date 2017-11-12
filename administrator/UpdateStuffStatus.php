<?php
if(!isset ($_SESSION)) //checking whether $_SESSION has been started or not?
    session_start();
include_once '../commoninclude.php';

$ref=@$HTTP_REFERER;
echo $ref;
//print_r($_REQUEST);
//checking whether $_REQUEST and TASK has been set or not
if(isset($_REQUEST) && isset($_REQUEST['task']))
{
    $aStatus=""; //for Active Status
    $iStatus=""; //for InActive Status

    if($_REQUEST['task']=="update") //checking whether the TASK is UPDATE
    {
        $objBoStuff=new BoStuff();
        $objBoStuff->setId($_REQUEST['stuffid']);
        $objBoStuff->setStatus($_REQUEST['rdostatus'].$_REQUEST['stuffid']);

        $objPlStuff=new PlStuff();
        $msg=$objPlStuff->PlUpdateStuffStatus($objBoStuff);
        header("location:DisplayTags.php?page=1&ipp=20&msg=".$msg);
    }
}
?>