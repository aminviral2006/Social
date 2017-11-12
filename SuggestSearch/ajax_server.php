<?php
include_once '../commoninclude.php';
$objConnection=new MySQLConnection();
$objConnection->Open();
$keyword = $_POST['data'];
//$sql = "select Title from tblStuff where Title='".  addslashes($keyword)."%' or  upper(convert(Title using latin1)) like '" . addslashes(strtoupper($keyword)) . "%' limit 0,8";
$sql = "select tblStuff.Title as StuffTitle,tblCategory.Title as CategoryTitle from tblStuff,tblCategory where
    tblStuff.CategoryID=tblCategory.ID And
    upper(convert(tblStuff.Title using latin1)) like '" . addslashes(strtoupper($keyword)) . "%'  limit 0,8";
//$sql = "select name from ".$db_table."";
$result = mysql_query($sql) or die(mysql_error());
if (mysql_num_rows($result))
{
    echo '<ul  class="list">';
    while ($row = mysql_fetch_array($result))
    {
        $str = strtolower($row['StuffTitle']."-".$row['CategoryTitle']);
        $start = strpos($str, $keyword);
        $end = similar_text($str, $keyword);
        $last = substr($str, $end, strlen($str));
        $first = substr($str, $start, $end);
        $final = '<span class="bold">' . $first . '</span>' . $last;
        //echo '<li><a href=\'javascript:void(0);\'>' . $final . '</a></li>';
        echo '<li><a href="javascript:void(0)" style="text-align:right">' . $final . '</a></li>';
    }
    echo "</ul>";
}
else
    echo 0;
?>	   
