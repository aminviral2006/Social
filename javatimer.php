<?php
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 30))
{
    echo time();
    header("location:timerlogout.php");
}
else
{
    $_SESSION['LAST_ACTIVITY'] = time();
    $link=mysql_connect("localhost","root","");
    mysql_select_db("dbtables");
    $query="update active_users set timestamp=".time()." Where username='viral'";
    echo $query;
    if(mysql_query($query))
    {
        echo $query;
        echo "success";
    }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script type="text/javascript" language="JavaScript">
            var xmlhttp;
            function mycall()
            {
                url="timerlogout.php";
                xmlhttp=new XMLHttpRequest();
                xmlhttp.onreadystatechange=statechanged;
                xmlhttp.open('GET',url,true);
                xmlhttp.send(null);
            }
            function statechanged()
            {
                //alert(xmlhttp.readyState);
                if(xmlhttp.readyState==4)
                {
                    //alert(xmlhttp.responseText);
                }
            }
            function myinterval()
            {
                setInterval("mycall()", 30000);
            }
        </script>
    </head>
    <body onload="myinterval()" >
        <!--<input type="button" name="clickMe" value="Click me and wait!"
            onclick="setTimeout('alert(\'Surprise!\')', 5000)"/>-->
        <input type="button" name="clickMe" id="colourButton" value="Click me and wait!"/>

    </body>
</html>
