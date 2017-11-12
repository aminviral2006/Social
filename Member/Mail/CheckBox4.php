<?php
if(isset($_POST['submit']))
{
    $fields = $_POST['fields'];
    if (is_array($fields)) {
        echo "<pre>";
        print_r($fields);
        echo "</pre>";
        foreach ($fields as $key=>$val) {
            echo "$key -> $val <br />";
        }
        $content = '<hr><br>';
        $content = $content . count($fields);
        for ($i=0;$i<count($fields);$i++) {
            $content = $content . "<li>$fields[$i]\n";
        }
        echo $content;
    }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <title>Untitled Document</title>
    </head>
    <body>
        <form action="<?php $_SERVER["PHP_SELF"];?>" method="post">
            <input type="checkbox" name="fields[]" value="name">Machine Name<br />
            <input type="checkbox" name="fields[]" value="domain">Workgroup/Domain<br />
            <input type="checkbox" name="fields[]" value="make">Make<br />
            <input type="checkbox" name="fields[]" value="model">Model<br />
            <input type="checkbox" name="fields[]" value="os">Operating System
            <input name="submit" type="submit" value="submit">
        </form>
    </body>
</html>

