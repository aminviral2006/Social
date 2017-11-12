<?php
session_start();
?>
<form name="reportviolation" action="ReportViolation.php" method="post">
    <table border="0" cellpadding="0" cellspacing="0" align="center">
        <caption><span style="color: blue;font-size: 12px;">Violate Report</span></caption>
        <tr>
            <td><!--<label for="firstname">&nbsp;</label>-->
                <textarea name="reportdescription" rows="3" cols="20"></textarea>
            </td>
            <td align="center">
                <input type="hidden" name="stuffid" id="stuffid" value="<?php echo $_REQUEST['stuffid']; ?>">
                <input type="hidden" name="memberid" id="memberid" value="<?php echo $_SESSION['memberid']; ?>">
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="button" value="Close" onclick="closeMessage()">
                <input type="submit" value="Send">
            </td>
        </tr>
    </table>
</form>