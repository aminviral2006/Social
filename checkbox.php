<?php
if(isset($_REQUEST['submit']))
{
    echo "hello:";
    print_r($_REQUEST);
}
?>

<form name="fff" method="post" action="">
    <input type="checkbox" name="chk" value=""/>
    <input type="submit" name="submit" value="submit"/>
</form>
