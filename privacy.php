<?php
session_start();
if(isset($_SESSION['member']))
    header("location:../index.php?msg=".$_REQUEST['login']);
include_once 'commoninclude.php';
/*if(isset($_POST['submit']))
{
    header("location:checkmemberlogin.php");
}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" lang="he" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>הצהרת פרטיות</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <style type="text/css">
            body
            {
                background-color: #495863;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            div#dvMain
            {
                padding: 0;
                margin: 0 auto;
                width: 982px;
                height: auto;
                background-color: #FFFFFF;
                border-style: solid;
                border-width: thick;
                border-color:#1c2e3c;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 13px;
                margin-left: auto;
                margin-right: auto;
            }
            #dvBanner
            {
                position: relative;
                width: 982px;
                height: 125px;
                display:block;
                padding: 0px;
                background-image: url(images/logoheader.jpg);
                background-repeat: no-repeat;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvLogin
            {
                position: relative;
                float: left;
                display: none;
                top: 30px;
                left: 450px;
                color: white;
                font-size: 14px;
                font-weight: bold;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvLogin a
            {
                text-decoration: none;
                color:white;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvLogin a:hover
            {
                text-decoration: underline;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            .spNotAMember
            {
                color: #f9c60b;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvMenuStrip
            {
                position: relative;
                top: 95px;
                width: 982px;
                height: 30px;
                z-index: 3;
                display:block;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvMenuContents
            {
                position: relative;
                width: 982px;
                top: 3px;
                right:110px;
                /*float: right;*/
                color: black;
                display: block;
                font-size: 15px;
                font-weight: bold;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                text-align: right;
            }
            #dvMenuContents a
            {
                text-decoration: none;
                color: black;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvMenuContents a:hover
            {
                color: white;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvBrowseStuff
            {
                position: absolute;
                float: left;
                top: 1px;
                display: none;
                left: 10px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvAddStuffButton
            {
                position: absolute;
                float:left;
                top: 1px;
                left: 150px;
                display: none;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvAddStuff
            {
                /*position: absolute;
                top:100px;
                left:2px;*/
                visibility: hidden;
                width: 980px;
                height: auto;
                z-index: 4;
                border-style: solid;
                border-width: thin;
                border-color:#1b4376;
                margin-left:auto;
                margin-right:auto;
                padding-top: 10px;
                padding-bottom: 10px;
                display:none; /*Maha Gilinder*/
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            #dvErroMessage
            {
                width: 982px;
                color: red;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 13px;
                font-weight: bold;
                text-align: right;
                background-color: burlywood;
            }
            #dvLoginSection
            {
                float: right;
                width: 400px;
                height: auto;
                z-index: 4;
                margin-left:auto;
                margin-right:auto;
                padding-top: 10px;
                padding-bottom: 10px;
                display:block; /*Maha Gilinder*/
                font-family: Verdana, Arial, Helvetica, sans-serif;
                text-align: right;
            }

	    #dvPrivacyAndPolicy
	    {
		background-color: #fef5ce;
		width: 700px;
		display:block; /*Maha Gilinder*/
                font-family: Verdana, Arial, Helvetica, sans-serif;
	    }

	    .tableborder
	    {
		border:1px solid coral;
		font-family: Verdana, Arial, Helvetica, sans-serif;
	    }
            #dvSignUpSection
            {
                position: relative;
                float:left;
                top: 6px;
                left: 10px;
                width: 300px;
                height: auto;
                margin-left:auto;
                margin-right:auto;
                padding-top: 10px;
                padding-bottom: 10px;
                padding-right: 10px;
                display:block; /*Maha Gilinder*/
                background-color: #FFCC66;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            div#dvFooter
            {
                width: 982px;
                z-index: 4;
                padding-top: 20px;
                display:block;
                padding: 4px;
                direction: rtl;
                text-align: center;
                font-size: 13px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                color: #FFFFFF;
                margin-left: auto;
                margin-right: auto;

            }
            #dvFooter a
            {
                font-size: 13px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                color: #FFFFFF;
                text-decoration: none;
            }
            #dvFooter a:hover
            {
                text-decoration: underline;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            .loginsectiontitle
            {
                background-image: url(../images/loginsectiontitle.jpg);
                width:400px;
                height: 32px;
                background-repeat: no-repeat;
                color: #FFFFFF;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            .table
            {
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 12px;
                font-weight: bold;
            }
            tr, .table
            {
                height: 22px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            input[type='text']
            {
                border-style: solid;
                border-width: 2px;
                border-color: #233645;
                background-color: gainsboro;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
            input[type='password']
            {
                border-style: solid;
                border-width: 2px;
                border-color: #233645;
                background-color: #b5b6b6;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }
        </style>
        <script type="text/javascript" language="JavaScript">
            var i=1;
            String.prototype.trim = function()
            {
                return this.replace(/(?:(?:^|\n)\s+|\s+(?:$|\n))/g,"");
            }

            function TrimTextArea()
            {
                document.getElementById("tarabout").value.trim();
            }
            function StuffValid()
            {
                if(document.frmaddstuff.txtStuffName.value.trim()=="")
                {
                    document.getElementById("dvMessage").style.visibility="visible";
                    document.getElementById("dvMessage").style.display="block";
                    return false;
                }
                else
                    return true;
            }

            /*function DisplayAddStuff()
            {
                if(i==1)
                {
                    document.getElementById("dvAddStuff").style.visibility="visible";
                    document.getElementById("dvAddStuff").style.display="table";
                    i=0;
                }
                else
                {
                    document.getElementById("dvAddStuff").style.visibility="hidden";
                    document.getElementById("dvAddStuff").style.display="none";
                    i=1;
                }
            }*/
        </script>
    </head>
    <body>        
            <div id="dvMain" align="center">                
                <div id="dvBanner">
                    <div id="dvLogin">
                       <!--<img src='member/memberimages/default.jpg' width='20px' height='20px' alt='' />|-->
                        <!--<a href="login.php" title="Login">התחבר</a> | <span class="spNotAMember" title="Not a Member">עדיין לא רשום ?</span> <a href="signup.php" title="Sign Up"> הרשם עכשיו </a>-->                        
                    </div>
                    <div style="position: absolute;float:left;left: 875px;width: 105px;height: 120px;">
                        <a href="index.php" style="outline: none;">
                        <img src="images/hotspot.png" border="0" alt=""/>
                        </a>
                    </div>
                    <div style="clear: both;"></div>
                    <div id="dvMenuStrip">
                        <div id='dvMenuContents'>
                            <a href="../index.php" title="HOME">ראשי</a> <a href="#" title="FAQ">שאלות נפוצות</a>
                        </div>
                        <div style="clear: both;"></div>
                        <form id="frmSearch" name="frmSearch" method="post" action="">
                            <span style='font-size: 1px;'>&nbsp;</span>
                            <div id="dvAddStuffButton">
                                <a href="#" onclick="DisplayAddStuff();"> <img id="btnAddStuff" name="btnAddStuff" src='../images/AddStuff.png' width='175px' height='24px' alt='' border="0"/></a>
                            </div>
                        </form>
                        <span style='font-size: 1px;'>&nbsp;</span>
                        <div style="clear: both;"></div>
                        <div id="dvBrowseStuff">
                            <a href="../Stuff/BrowseStuff.php"><img id="btnBrowser" name="btnBrowse" src='../images/BrowseStuff.png' width='130px' height='24px' alt='' border="0"/></a>
                        </div>
                    </div>
                </div>
                <span style='font-size: 1px;'>&nbsp;</span>                
                
                <?php
                    if (isset($_REQUEST['login']))
                    {
                        echo "<div id='dvErroMessage'>";
                        echo "Username of Password is invalid.";
                        echo "</div>";
                    }
                ?>
                
                <div style="clear: both;"></div>
                <span style='font-size: 1px;'>&nbsp;</span>
                <div id="dvPrivacyAndPolicy" align="center">
		    <div align="right">
			<table class="tableborder">
			    <tr>
				<td colspan="2">הצהרת פרטיות</td>
			    </tr>
			    <tr>
				<td colspan="2">אנו רוצים להפוך את החוויה שלכם בגלישה באתר כמה שיותר מהנה ונטולת דאגות ככל הניתן. </td>
			    </tr>
			    <tr>
				<td colspan="2">הפרטיות שלכם חשובה לנו , ואנו מחויבים לוודא שהפרטים האישיים שלכם מוגנים.</td>
			    </tr>
			    <tr><td colspan="2"></td></tr>
			    <tr>
				<td colspan="2">
				    <ul>
					<li>
					    איזה מידע אנו אוספים ? כיצד אנו משתמשים בו ?<br/>
					    כשאתם נרשמים כחברים לאתר , אנו מבקשים רק מידע בסיסי(שם מתמש,אימייל וסיסמא)
					    על מנת ליצור את החשבון. אתם אפילו לא חייבים לתת את שמכם האמיתי , אלא אם כן
					    אתם רוצים שזה יהיה השם משתמש\כינוי שלכם באתר(מטורף אנחנו יודעים...).
					    אנו נשתמש בכתובת האימייל שלכם על מנת לוודא שזה באמת אתם(להפעלת החשבון) ,
					    ולשלוח לכם עדכונים וחדשות בנוגע לאתר מעת לעת.<br/>
					    אנו לעולם לא נעשה שימוש רע בפרטיכם האישיים(אנו שונאים דואר זבל!!).
					</li>
					<li>
					    חוץ מהמידע שאתם שולחים לנו , אנו מקבלים מהשרת מידע
					    "אוטומטי" בכל פעם שגולש מבקר באתר(כמו בכל אתר אחר ברשת).<br/>
					    מידע כמו כתובת הIP , איזה סוג דפדפן יש ברשותכם ובאיזה מערכת
					    הפעלה אתם משתמשים, תאריך וזמן שהייה באתר , ועוד כמה נתונים
					    סטטיסטיים משעממים הנשלחים אלינו. <br/>
					    אנחנו ממש לא משתמשים בציוד מיוחד כדי לקבל
					    את המידע הזה (צפיתם ביותר מדי סרטי ריגול...) ,
					    זהו רק מידע פשוט ורגיל שהשרתים אוספים כאשר אתם
					    גולשים באתר שלנו(או בכל אתר אחר – לצורך העניין).<br/>
					    אנו משתמשים במידע הזה על מנת שנוכל לדעת כמה גולשים
					    מגיעים אלינו (כדי שנוכל להרגיש טוב עם עצמנו).
					    זה גם עוזר לנו לנתח את רמת התקשורת שלכם הגולשים עם האתר ,
					    כדי שנוכל לשפר את חווית הגלישה והאיכות הכללית שלו כמה שיותר.<br/>
					    אנו משתמשים במידע הזה על מנת שנוכל לדעת כמה גולשים מגיעים אלינו
					    (כדי שנוכל להרגיש טוב עם עצמנו). זה גם עוזר לנו לנתח את רמת התקשורת
					    שלכם הגולשים עם האתר , כדי שנוכל לשפר את חווית הגלישה והאיכות הכללית
					    שלו כמה שיותר.
					    אם אתם קצת פרנואידים לגבי החלק הזה , תשמח לגלות שיש המון תוכנות ,
					    מאגרים וחברות שיעזרו לכם להישאר אנונימיים ברשת. פשוט חפשו בגוגל – "פרטיות באינטרנט".
					</li>
					<li>
					    האם אנו לא נמכור את המידע שלכם? בטוח ?<br/>
					    בוודאות!! אנו לא נמכור ,נשכיר , נחליף את המידע
					    האישי שלך ללא רשותך המפורשת. לעולם(חוץ ממקרה של הפרת תנאי השימוש).
					</li>
					<li>
					    אם יש משהו בהצהרת הפרטיות שלנו שלא הבנת
					    ואת\ה רוצה הבהרות נוספות , נשמח אם תיצור עמנו קשר למייל
					    <a href="mailto:admin@besthing.co.il">admin@besthing.co.il</a>  , ואנו נשלח לך את כל התשובות המתאימות
					    בהקדם האפשרי.
					</li>
				    </ul>
				</td>
			    </tr>
			    <tr><td colspan="2"></td></tr>
			    <tr>
				<td colspan="2">
				    אנו משתדלים לשמור על הצהרת הפרטיות של האתר מעודכנת וברורה ככל הניתן.
				</td>
			    </tr>
			    <tr>
				<td colspan="2">
				    צור קשר
				</td>
			    </tr>
			    <tr>
				<td colspan="2">
				    אם יש לך כל שאלה ו\או הסתייגות מהצהרת הפרטיות שלנו ,
				    אתה מוזמן ליצור קשר במייל <a href="mailto:admin@besthing.co.il">admin@besthing.co.il</a>   או בעמוד המיועד.
				</td>
			    </tr>
			    <tr>
				<td colspan="2">תודה</td>
			    </tr>
			</table>
		    </div>
		    
                </div>
                <br/>
                <div style="clear: both;"></div>
            </div><!--main section -->        
        <span style='font-size: 1px;'>&nbsp;</span>
        <div id='dvFooter' align="center">
            <!--<a href="index.php">home |</a> <a href="#">faq |</a>
            <a href="privacy.php">privacy policy |</a> <a href="terms.php">term and conditions |</a>
            <a href="#">contact us |</a> <a href="#">rss feed |</a> <a href="#">bookmark this page</a><br/>
            Copyright &copy;2010 Avigabso. Designed & Developed by <a href="http://themacrosoft.com">Macrosoft Solutions</a>-->
	    <?php include_once('footers.php'); ?>
        </div>
    </body>
</html>