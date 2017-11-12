<?php
$db = mysql_connect('208.43.69.173','ssocial','s!@#4');
if(!$db) echo "Cannot connect to the database - incorrect details";
mysql_select_db('myuser_mydbname'); $result=mysql_query('show tables');
while($tables = mysql_fetch_array($result)) {
foreach ($tables as $key => $value) {
mysql_query("ALTER TABLE $value COLLATE utf8_general_ci");
}}
echo "The collation of your database has been successfully changed!";
?>