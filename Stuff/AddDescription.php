<?php
session_start();
include_once '../commoninclude.php';
$objBo = new BoStuff();
$stuffid = $_REQUEST['stuffid'];
$Description=$_REQUEST['AddDescription'];
echo $Description;
echo $stuffid;
$objBo->setId($stuffid);
$objBo->setDescription($Description);

$objPlStuff=new PlStuff();
if(!isset($_SESSION['memberid']))
    echo "login";
else if (isset($_REQUEST['AddDescription']))
{
    $objBo->setMemberId($_SESSION['memberid']);
    $StuffDescription=$objPlStuff->PlGetDescription($objBo);
    
    if(count($StuffDescription)>0)
    {
        $UpdateDescription=$objPlStuff->PlAddDescriptionUpdate($stuffid, $objBo);
    }
    $AddDescription=$objPlStuff->PlAddDescription($stuffid,$objBo);
    //echo $objBo->getDescription ();
    $StuffDescription=$objPlStuff->PlGetDescription($objBo);
    echo $StuffDescription[0]['Description'];
}
header("location:StuffDetail.php?stuffid=".$stuffid);
?>