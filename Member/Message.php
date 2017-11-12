<?php
if(isset($_REQUEST['msg']) && $_REQUEST['msg']=="success")
{
    $message="<h1>Congratulatioins!!</h1> ";
    $message.="You're registered with Avigabso.";
    $message.="An Email has been sent to your email address. Please follow the instructions to activate the account.";
    
}
else if(isset($_REQUEST['msg']) && $_REQUEST['msg']=="fail")
{
    $message="<h1>Error!!</h1> ";
    $message.="Member could not registered.";
    echo $message;
}
else if(isset($_REQUEST['msg']) && $_REQUEST['msg']=="exist")
{
    $message="<h1>Exist!!</h1> ";
    $message.="Member already exist.";
    echo $message;
}
?>
<html>
    <head>
        <title>Member Created</title>
        <meta http-equiv="refresh" content="4; url=../index.php">
    </head>
    <body>
        <?php
            print($message);
        ?>
    </body>
</html>
