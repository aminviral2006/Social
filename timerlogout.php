<?php
session_start();
include_once 'commoninclude.php';
$link=mysql_connect("localhost","root","");
mysql_select_db("dbtables");
$query="delete from active_users Where (".time()."-timestamp) > 30";
if(mysql_query($query))
{
    echo $query;
    echo "success";
}
else
    echo mysql_error();

?>
