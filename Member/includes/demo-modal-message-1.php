<?php
session_start();
?>
<form name="myForm" action="postmessage.php" method="post">
    <table border="0" cellpadding="0" cellspacing="0" height="100px">
		<tr>
                    <td><!--<label for="firstname">&nbsp;</label>-->
                        <input type="image" src="../images/errorred.jpg" style="width:18px;height:18px" value="Close" onclick="closeMessage()">
                    </td>
			<td align="center"><!--<input type="text" name="firstname" id="firstname">-->
                        <span style="color: blue;"><?php echo "Send <b>".$_REQUEST['member']."</b>"; ?> a Private Message</span>
                        <input type="hidden" name="keyword" id="keword" value="<?php echo $_REQUEST['member']; ?>">
                        <input type="hidden" name="id" id="id" value="<?php echo $_REQUEST['id']; ?>">
                        <input type="hidden" name="member" id="member" value="<?php echo $_REQUEST['member']; ?>">
                        <input type="hidden" name="sendmessage" id="sendmessage" value="fromprofilepage">
                        </td>
		</tr>
		<tr>
			<td colspan="2"><!--<input type="text" name="txtmessage" id="txtmessage" size="30">-->
                                <?php
                                    include_once '../../FCKEditor/fckeditor.php';
                                    function nukeMagicQuotes()
                                    {
                                        if (get_magic_quotes_gpc())
                                        {
                                            function stripslashes_deep($value)
                                            {
                                                $value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
                                                return $value;
                                            }
                                            $_POST = array_map('stripslashes_deep', $_POST);
                                            $_GET = array_map('stripslashes_deep', $_GET);
                                            $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
                                        }
                                    }
                                    nukeMagicQuotes();

                                    if(isset($_REQUEST['cancel']))
                                    {
                                        $oFCKeditor->Value=null;
                                    }
                                    $oFCKeditor = new FCKeditor('txtmessage');
                                    //$oFCKeditor->BasePath = "FCKeditor/editor/";
                                    $oFCKeditor->Value    = "";
                                    $oFCKeditor->Width    = 280;
                                    $oFCKeditor->Height   = 150;

                                    echo $oFCKeditor->CreateHtml();
                                ?>
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