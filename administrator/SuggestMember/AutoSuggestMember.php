<?php
session_start();
include_once '../../commoninclude.php';
$objConnection=new MySQLConnection();
$objConnection->Open();
	$keyword = $_POST['data'];
	$sql = "SELECT tblMemberRegistration.Nickname FROM tblMemberRegistration 
                WHERE (tblMemberRegistration.Nickname Like '".  addslashes($keyword)."%' or tblMemberRegistration.Nickname like '".addslashes($keyword)."%') limit 0,8";
	//$sql = "select name from ".$db_table."";
	$result = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($result))
	{
		echo '<ul class="list">';
		while($row = mysql_fetch_array($result))
		{
			$str = strtolower($row['Nickname']);
			$start = strpos($str,$keyword);
			$end   = similar_text($str,$keyword);
			$last = substr($str,$end,strlen($str));
			$first = substr($str,$start,$end);

			$final = '<span class="bold">'.$first.'</span>'.$last;

			echo '<li><a href=\'javascript:void(0);\'>'.$final.'</a></li>';
		}
		echo "</ul>";
	}
	else
		echo 0;
?>
