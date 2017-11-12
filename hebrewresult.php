<?php
$link=  mysql_connect("localhost","root","");
mysql_select_db("dbhebrew");
//mysql_query("insert into tblhebrew (test,description) values ('עדיין לא רשום ? הרשם עכשיו ','עדיין לא רשום ? הרשם עכשיו ')");
$txt="שאלות נפוצות";
$txt=$_REQUEST['txt'];
$query="Select mytext from tblhebrew where mytext='".addslashes($txt)."' or upper(convert(mytext using latin1))='". strtoupper(addslashes($txt))."'";
echo $query;
$result=mysql_query($query);
echo "<br>num rows:".mysql_num_rows(mysql_query($query));
$row=mysql_fetch_assoc($result);

echo "<br>output:".$row['mytext'];

?>
