<?php
if(!session_start())
    session_start();
ob_start();
include_once '../commoninclude.php';
if(isset($_REQUEST['msg']))
    echo "<h1>".$_REQUEST["msg"]."</h1>";

$pageTitle="Tag Updated";
$contentData=  ob_get_contents();
ob_clean();
require_once 'AdminHome.php';
?>
