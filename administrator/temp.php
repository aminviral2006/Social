<?php
if ($status == "A")
    $output.="<input type='radio' id='rdostatus" . $rows[$i]['StuffID'] . "' name='rdostatus" . $rows[$i]['StuffID'] . "' value='A' checked/>A";
    $output.="<input type='radio' id='rdostatus" . $rows[$i]['StuffID'] . "' name='rdostatus" . $rows[$i]['StuffID'] . "' value='I' checked/>I";
    $output.="<input type='radio' id='rdostatus" . $rows[$i]['StuffID'] . "' name='rdostatus" . $rows[$i]['StuffID'] . "' value='L' checked/>L";
    $output.="<input type='radio' id='rdostatus" . $rows[$i]['StuffID'] . "' name='rdostatus" . $rows[$i]['StuffID'] . "' value='D' checked/>D";
?>