<?php

ini_set("sendmail_from","admin@sabsyp.com");
ini_set("SMTP","mail.sabsyp.com");
ini_set("smtp_port","25");
//ini_set("SMTPSecure","ssl");
ini_set("AUTH_USER","admin@sabsyp.com");
ini_set("AUTH_PASSWORD","sabsypadmin");

if(mail("sumitjoshi@ymail.com","hello","hi"))
    echo "sent";
else
    echo "not sent";
?>