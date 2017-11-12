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
        <title>תנאי שימוש</title>
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

	    #dvTermsAndConditions
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
                            <a href="index.php" title="HOME">ראשי</a> <a href="#" title="FAQ">שאלות נפוצות</a>
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
                <div id="dvTermsAndConditions" align="center">
		    <div align="right">
			<table class="tableborder">
			    <tr>
				<td colspan="2">תנאי שימוש</td>
			    </tr>
			    <tr>
				<td colspan="2">ברוכים הבאים לאתר "הכי טוב!". </td>
			    </tr>
			    <tr><td colspan="2"></td></tr>
			    <tr>
				<td colspan="2">
				    לפני שתרשמו לאתר ותפתחו את חשבונכם , עליכם לקרוא , להבין ולהסכים לתנאי השימוש (להלן ההסכם)
				    הבאים (כולל כל שינוי עתידי אשר עשוי להתבצע בהם).
				    עליכם לבקר בעמוד זה מעת לעת על מנת לצפות בתנאי השימוש.
				</td>
			    </tr>
			    <tr><td colspan="2"></td></tr>
			    <tr>
				<td colspan="2">
				    אתר "הכי טוב!" רשאי באופן בלעדי ובלתי תלוי , לשנות ו\או להוסיף את
				    תנאי השימוש באתר ואתם מצהירים בזאת שאתם מבינים תנאים אלו וכפופים להם.
				</td>
			    </tr>
			    <tr><td colspan="2"></td></tr>
			    <tr>
				<td colspan="2">
				    אם אינכם מקבלים את הכתוב בתנאי השימוש(להלן:ההסכם) ,
				    אינכם רשאים להרשם לאתר , להשתמש באתר "הכי טוב" ו\או באחד משרותיו.
				</td>
			    </tr>
			    <!-- 1st term-->
			    <tr><td colspan="2"></td></tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left">1)</td>
				<td>
				    תיאור השרות : "הכי טוב!"(שרות האתר) הוא אתר קהילתי מבוסס שיתוף מידע ודעות ציבור הגולשים. 
				    אתה(הגולש והמשתמש באתר) מבין ומסכים לעובדה שהשרות באתר מוצע כמו שהוא(AS IS) , ולא תמיד יתאפשר.
				</td>
			    </tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left"></td>
				<td>
				    אתר הכי טוב לא יישא באחריות ולא יקבל שום תביעה בנוגע לזמינות השרות ,
				    בטחון השרות , אמינות השרות ותוכן השרות.
				</td>
			    </tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left"></td>
				<td>
				    אתר "הכי טוב" שומר לעצמו את הזכות לשנות , להשעות , ולהפסיק את השרות המוצע
				    באתר ואת הפעלתו הכללית – בכל עת וללא כל התראה מוקדמת לכם הגולשים או לכל אחד אחר.
				</td>
			    </tr>
			    <!-- 2nd term-->
			    <tr><td colspan="2"></td></tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left">2)</td>
				<td>
				   שימוש אישי : השרות באתר נועד לשימושך האישי בלבד. עליך להיות לפחות בגיל 16
				   על מנת להשתמש בשרותי האתר. הנך חייב לספק אמצעי זיהוי עדכני ומדויק ,
				   וכמו כן נתוני התקשרות נכונים ו\או כל מידע אחר שתתבקש למסור בתהליך ההרשמה ו\או
				   תוך שימוש בשרותי האתר – יהיה עליו להיות נכון ומדויק.
				</td>
			    </tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left"></td>
				<td>
				    אתה(הגולש) הוא האחראי הבלעדי על שמירת חשאיות הסיסמא והחשבון שלך ,
				    וכמו כן על כל התוכן והפעילות המופיעים בחשבונך.
				</td>
			    </tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left"></td>
				<td>
				    <ul>
					<li style="padding: 0;">
					    אתר "הכי טוב" שומר לעצמו את הזכות לבטל, להשעות, ו\או להפסיק
					    לאלתר את השרות עבור כל אחד\אחת , בכל שעה , וללא כל סיבה ו\או התראה מוקדמת.
					</li>
				    </ul>
				</td>
			    </tr>
			    <!-- 3rd term-->
			    <tr><td colspan="2"></td></tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left">3)</td>
				<td>
				   שימוש נאות – אתה מסכים לכך שאתה הוא האחראי הבלעדי על ההתקשרויות שלך
				   באתר ועל התוכן שאתה מעלה ועל כל אי אלו השלכות שיהיו כתוצאה מאלו.
				</td>
			    </tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left"></td>
				<td>
				    השימוש שלך בשרותי האתר כפוף לקבלה המוחלטת של הסכם זה
				    ועל הסכמתך לפעול לפי תנאי השימוש האלו ואחרים שיוצגו ע"י האתר.
				</td>
			    </tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left"></td>
				<td>
				    אתה מסכים להשתמש בשרותי האתר בכפוף לחוקי מדינת ישראל וכמו כן בכפוף לחוקים הבינלאומיים.
				</td>
			    </tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left"></td>
				<td>
				    אסור עלייך , אסור עלייך לקבל ו\או להעביר ,אסור לך להסכים , ואינך מורשה לאשר ו\
				    או לעודד כל צד שלישי לבצע את הדברים הבאים :
				</td>
			    </tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left"></td>
				<td><!--Sub points-->
				    <table>
					<!-- a point -->
					<tr>
					    <td valign="top" style="width: 20px;padding-left: 4px;" align="left">a)</td>
					    <td>
						להעליב , לפגוע , לאיים על משתמשים אחרים , על מבקרים ו\או על כל אחד אחר המשתמש בשרותי האתר וחשוף לתכנים שבו.
					    </td>
					</tr>
					<!-- b point -->
					<tr>
					    <td valign="top" style="width: 20px;padding-left: 4px;" align="left">b)</td>
					    <td>
						להשתמש בשרותי האתר על מנת להעלות , לשדר , להגיב , לכתוב , לייצר כל תוכן שעשוי לפגוע בזולת.
					    </td>
					</tr>
					<tr>
					    <td valign="top" style="width: 20px;padding-left: 4px;" align="left"></td>
					    <td>
						אין להעלות כל תוכן לא חוקי , גזעני , פורנוגרפי , מסית , הקורא לפעילות בלתי חוקית ,
						ניצול מיני , אלימות מילולית , אלימות גרפית , או אלימות כנגד בעלי חיים ,
						או אלימות מכל סוג שהוא.
					    </td>
					</tr>
					<!-- c point -->
					<tr>
					    <td valign="top" style="width: 20px;padding-left: 4px;" align="left">c)</td>
					    <td>
						להעלות , לשדר , להגיב בתכנים הרומזים לפגיעה בשמו הטוב של גוף\אדם\קבוצה\אתרים אחרים ו\או כל
						אחד אחר מעל במת האתר. אין למנוע מאחרים את השימוש באתר.
					    </td>
					</tr>
					<!-- d point -->
					<tr>
					    <td valign="top" style="width: 20px;padding-left: 4px;" align="left">d)</td>
					    <td>
						להעלות, לשדר , ליצור , להגיב תכנים הכוללים מידע פרסומי , אי מייל זבל ו\או "ספאם".
						זה כולל פרסום לא אתי , פרסום כלשהו , או כל דבר אחר הכולל בתוכו קשר כלשהו ל"ספאם" כגון : שליחת מיילים
						רבים למשתמשים שאינם ביקשו מייל ממך עם כתובת אי מייל מזוייפת לחזרה.
					    </td>
					</tr>
					<tr>
					    <td valign="top" style="width: 20px;padding-left: 4px;" align="left"></td>
					    <td>
						קידום אתר מסוים עם לינקים , כותרות , תיאורים מסויימים.<br/>
						קידום האתר שלך באמצעות הודעות כפולות ומכופלות זהות במספר נושאים שונה וגדול.
					    </td>
					</tr>
					<!-- e point -->
					<tr>
					    <td valign="top" style="width: 20px;padding-left: 4px;" align="left">e)</td>
					    <td>
						שימוש בשרות בכוונת מרמה , זדון , ו\או חוסר תום לב.
					    </td>
					</tr>
					<!-- f point -->
					<tr>
					    <td valign="top" style="width: 20px;padding-left: 4px;" align="left">f)</td>
					    <td>
						לפעול בכל צורה שמפרה את תנאי השימוש(ההסכם) – העשויים להשתנות מעת לעת.
					    </td>
					</tr>
					<tr>
					    <td valign="top" style="width: 20px;padding-left: 4px;" align="left"></td>
					    <td>
						הפרה של כל אחד מהכללים הנ"ל , עשויה לשאת בסיום מיידי של ההתקשרות , וכמו כן ,
						לעונשים הקבועים בחוק – במקרה של תביעה.
					    </td>
					</tr>
					<tr>
					    <td valign="top" style="width: 20px;padding-left: 4px;" align="left"></td>
					    <td>
						האתר שומר לעצמו את הזכות(אך אינו מתחייב) , לחקור את שימושך בשרותי האתר על מנת לקבוע איזו
						הפרה של ההסכם התבצעה על ידך – אם יתבקש ע"י תביעה חיצונית והליך משפטי או בקשה מגוף ממשלתי\אזרחי זה או אחר
					    </td>
					</tr>
				    </table>
				</td>
			    </tr>
			    <!-- 4rd term-->
			    <tr><td colspan="2"></td></tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left">4)</td>
				<td>
				   פרטיות – כתנאי לשימוש בשרות , אתה מסכים לתנאי הצהרת מדיניות הפרטיות של
				</td>
			    </tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left"></td>
				<td>
				   האתר(העשויה להתעדכן ולהשתנות מעת לעת).<br/>
				    אנו מבינים שפרטיות היא נושא חשוב עבורך.
				</td>
			    </tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left"></td>
				<td>
				   אתה מבין , בכל מקרה , ומסכים לעובדה שהאתר "הכי טוב" עשוי לפקח , לערוך ,
				   להסיר את המידע האישי שלך ו\או את התוכן שלך , אם נאלץ לעשות כך בעקבות הפרה בלתי-חוקית ו\או
				   בקשה ממשלתית\אזרחית (כגון צו חיפוש,דרישת בית המשפט , וכדומה) , ו\או כל הפרה אחרת של ההסכם.
				</td>
			    </tr>
			    <!-- 5rd term-->
			    <tr><td colspan="2"></td></tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left">5)</td>
				<td>
				   תוכן השרות – האתר "הכי טוב" אינו אחראי בשום צורה , במישרין ו\או בעקיפין ,
				   ולא יישא בשום אחריות ו\או השלכות משפטיות ובכלל(לרבות תביעות אזרחיות וכדומה)
				   כלשהן על תוכן שהועלה לאתר ע"י צד שלישי(לרבות גולשי האתר)  - כולל , וללא הגבלה – כל
				   וירוס או גורם מגביל\מזיד\מזיק אחר).
				</td>
			    </tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left"></td>
				<td>
				   כמו כן , אין לאתר "הכי טוב" , התחייבות לאתר ו\או לפקח על תוכן מסוג זה.<br/>
				    האתר "הכי טוב" שומר לעצמו את הזכות לסרב לפרסם , ו\או להסיר באופן מיידי וללא כל התראה מוקדמת ,
				    כל תוכן מסוג זה , או כל תוכן אחר המפר את תנאי השימוש.<br/>
				    האתר גם שומר לעצמו את הזכות לגשת , לקרוא , לשמר , למנוע גישה , לערוך ולשנות כל תוכן באתר
				    שסביר להניח שזה הכרחי לעשות כך על מנת\בעקבות :
				</td>
			    </tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left"></td>
				<td><!--Sub points-->
				    <table>
					<!-- a point -->
					<tr>
					    <td valign="top" style="width: 50px;padding-left: 4px;" align="left">a)</td>
					    <td>
						לרצות כל רשות ממשלתית\חוקתית\אזרחית.
					    </td>
					</tr>
					<!-- b point -->
					<tr>
					    <td valign="top" style="width: 50px;padding-left: 4px;" align="left">b)</td>
					    <td>
						לאכוף הסכם זה , כולל בתוכו חקירה של הפרת אחד התנאים.
					    </td>
					</tr>
					<!-- c point -->
					<tr>
					    <td valign="top" style="width: 50px;padding-left: 4px;" align="left">c)</td>
					    <td>
						לאתר , למנוע הונאה מצד כתובת האתר , בעיה טכנית , ו\
						או פגיעה בבטחון הגולשים ובכלל (כולל סינון ספאם).
					    </td>
					</tr>
					<!-- d point -->
					<tr>
					    <td valign="top" style="width: 50px;padding-left: 4px;" align="left">d)</td>
					    <td>
						להגיב לבקשה של משתמש זה או אחר למחלקת התמיכה בנוגע לתוכן מסוים.
					    </td>
					</tr>
					<!-- e point -->
					<tr>
					    <td valign="top" style="width: 50px;padding-left: 4px;" align="left">e)</td>
					    <td>
						להגן על זכויות , רכוש , בטחון של אתר "הכי טוב" , הגולשים והמשתמשים בשרותיו , והציבור בכלל.
					    </td>
					</tr>
					<tr>
					    <td valign="top" style="width: 50px;padding-left: 4px;" align="left"></td>
					    <td>
						למען הסר ספק - אתר "הכי טוב!" , בעליו , מנהליו , פועליו ,עובדיו ומפעיליו , לא יהיו אחראים ,
						ולא יישאו באחריות ובהשלכות (מכל סוג שהן) על ביצוע ו\או אי ביצוע ההוראות בהסכם זה – אלא אך ורק המשתמש
						באתר אחראי להשלכות על התוכן שלו והוא בלבד.
					    </td>
					</tr>
				    </table>
				</td>
			    </tr>
			    <!-- 6th term-->
			    <tr><td colspan="2"></td></tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left">6)</td>
				<td>
				   פרסומות – כתנאי לשימוש באתר , אתה מסכים ומבין שהאתר "הכי טוב" יציג בפניך ותוכן שיווקי כזה או אחר.<br/>
				   זה כולל (אך לא מוגבל לזאת בלבד) מידע ממומן , גוגל אדסנס,באנרים וגם פרסוסמות אחרות מכל סוג שהוא.
				</td>
			    </tr>
			    <!-- 7th term-->
			    <tr><td colspan="2"></td></tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left">7)</td>
				<td>
				   זכויות קניין – אתה מודע לכך שאתר "הכי טוב" הוא הבעלים החוקי של השרות באתר ,
				   בעקבות כך – אתה מסכים שלא תעתיק , תשכפל , תערוך , או תיצור עבודות זהות מתוך השרות שלנו.
				   אתה גם מסכים שלא תשמש בכל רובוט , ספיידר , או כל גורם מונחה אחר על מנת להעתיק ו\או לעשות כל
				   שימוש בתוכן ו\או שרות האתר.<br/>
				   הזכויות של אתר "הכי טוב" כוללות את פיתוח השרות וכל מערכת האתר וכן את התכנון והעיצוב בפועל הקשורות אליה.<br/>
				   אתר "הכי טוב" אינו טוען לבעלות על שום תוכן שאתם(הגולשים) מעלים , משדרים , מגיבים , ו\או שומרים בחשבונכם באתר , אך האתר רשאי להשתמש בתוכן זה למטרותיו השונות.
				    אתם האחראים הבלעדיים לתוכן שאתם מעלים לאתר.
				</td>
			    </tr>
			    <!-- 8th term-->
			    <tr><td colspan="2"></td></tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left">8)</td>
				<td>
				   ידע ואחריות – אתה(הגולש) מודע ומבין שאתה אחראי לכל המידע והתוכן מכל סוג שהוא – שאתה מספק ומעלה לאתר "הכי טוב".<br/>
				   אתה מסכים להשמע ולשתף פעולה לכל אחד מהגורמים הקשורים באתר "הכי טוב" במקרה של תביעה מגוף
				   שלישי  העולה כתוצאה משימוש בשרותי האתר על ידך , בצורה זו או אחרת.<br/>
				   אתה מודע לכך שאתה(הגולש-המשתמש בשרות) תהיה הנושא הבלעדי באחריות כנד תביעות , הוצאות כספיות ,
				   עלויות משפטיות, ו\או כל נזק אחר שייגרם לאתר מכל סוג שהוא – במקרה שהדבר נגרם בערבות תוכן שהעלת
				   לאתר , ו\או כתוצאה משימושך בשרותיו.
				</td>
			    </tr>
			    <!-- 9th term-->
			    <tr><td colspan="2"></td></tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left">9)</td>
				<td>
				   ביטול\סיום התקשרות – אתה רשאי לבטל את שימושך בשרותי האתר ו\או לסיים את ההתקשרות להסכם זה בכל עת , ע"י שליחת אי מייל בו בקשה לביטול החברות באתר לכתובת : admin@besthing.co.il. אינך חייב לציין מדוע הנך מעוניין לבטל את ההתקשרות.
				    לאתר יש זכות , בכל עת ומכל סיבה , להפסיק לאלתר את שרותיו (אחד מהם או יותר) , לסיים ו\או לשנות הסכם זה , להשעות או להסיר את חשבונך , ללא הודעה מוקדמת.
				    במקרה של הסרה – חשבונך יוגבל ולא תוכל לגשת לתוכן שבחשבון מכל סוג שהוא(קבצים,מידע וכדומה...).
				</td>
			    </tr>
			    <!-- 10th term-->
			    <tr><td colspan="2"></td></tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left">10)</td>
				<td>
				   זכויות יוצרים – כל הקבצים המאוחסנים בשרתי האתר מוגנים ואינם מפרים את זכויות היוצרים של בעליהם החוקי.<br/>
				   הנך חייב ליצור קשר עם הבעלים המקורי והחוקי של קובץ\תוכן מכל סוג שהוא – אם הנך מעוניין להשתמש בו במסגרת שרותי
				   האתר ולקבל רשות מפורשת ובכתב מבעליו החוקי – על מנת להשתמש בו(בצורה שונה מזו המופיעה ברשיון השימוש עבור אותו הקובץ).<br/>
				   כל שאר התוכן באתר, כולל(אך לא מוגבל לזאת בלבד) התיאורים , הכתבות , התגובות והתמונות שהעלו הגולשים
				   הם רכושם הבלעדי של המחברים המקוריים.<br/>
				   כל חלק מהתוכן באתר , אינו ניתן להעתקה ,שכפול או לשימוש חוזר – ללא רשות מפורשת וכתובה מהיוצרים
				   המקוריים – הלוא הם הבעלים החוקיים והבלעדיים של הקובץ\תוכן.
				</td>
			    </tr>
			    <!-- 11th term-->
			    <tr><td colspan="2"></td></tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left">11)</td>
				<td>
				   הודעה על הפרת זכויות יוצרים – המדיניות שלנו היא לשתף פעולה ולשמור על כל חוקי הקניין
				   הבינלאומיים ולפעול באופן חד ומהיר ברגע שאנו מקבלים כל הודעה על פגיעה בזכויות יוצרים כלשהם.<br/>
				   אם אתה חושב ומאמין שהתוכן שלך שוכפל ומופיע באתר זה בצורה שמפרה את זכויות היוצרים שלך על התוכן ,
				   נודה לך אם תשלח לנו הודעה על הפרת זכויות יוצרים באי מייל ובה הנתונים הבאים :
				</td>
			    </tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left"></td>
				<td><!--Sub points-->
				    <table>
					<!-- a point -->
					<tr>
					    <td valign="top" style="width: 10px;padding-left: 4px;" align="left">א)</td>
					    <td>
						חתימה פיזית(העתק) או אלקטרונית של האדם המורשה לפעול בעניין זה מטעם בעלי זכויות היוצרים.
					    </td>
					</tr>
					<!-- b point -->
					<tr>
					    <td valign="top" style="width: 10px;padding-left: 4px;" align="left">ב)</td>
					    <td>
						זיהוי של העבודה\תוכן המקורי הנטען כי הפגיעה בו(שוכפל\הועתק וכדומה).
					    </td>
					</tr>
					<!-- c point -->
					<tr>
					    <td valign="top" style="width: 10px;padding-left: 4px;" align="left">ג)</td>
					    <td>
						זיהוי של העבודה\תוכן המשוכפל – הנטען כי ישנה פגיעה בזכויות היוצרים בו באתר.
					    </td>
					</tr>
					<!-- d point -->
					<tr>
					    <td valign="top" style="width: 10px;padding-left: 4px;" align="left">ד)</td>
					    <td>
						הכתובת , הטלפון , והאימייל של הצד המתלונן.
					    </td>
					</tr>
					<!-- e point -->
					<tr>
					    <td valign="top" style="width: 10px;padding-left: 4px;" align="left">ה)</td>
					    <td>
						הצהרה של הצד המתלונן , כי הוא מאמין שהחומר שבו השתמשו והגורם שהעתיק אותו –
						ופגע בזכויות היוצרים – אינו מורשה לכך ואינו קיבל רשות מהבעלים החוקי לשימוש בתוכן.
					    </td>
					</tr>
					<!-- f point -->
					<tr>
					    <td valign="top" style="width: 10px;padding-left: 4px;" align="left">ו)</td>
					    <td>
						הצהרה שהפרטים ששלחתם נכונים ומדויקים בעניין זה , ושהצד המתלונן מוסמך לפעול
						בעניין זה מטעם בעלי הזכויות בתוכן\קובץ המקורי שפגעו בזכויות היוצרים שלהם.
					    </td>
					</tr>
				    </table>
				</td>
			    </tr>
			    <!-- 12th term-->
			    <tr><td colspan="2"></td></tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left">12)</td>
				<td>
    				   תחום שיפוט – כל התנאים האלו (להלן ההסכם) יחולו בהתאם ולפי חוקי מדינת ישראל ובתחום שיפוטה. כל טענה , או הליך משפטי כזה או אחר – הקשור בשרותי האתר עליו להינתן בתחומי השיפוט של מדינת ישראל וייבחן ברשויות המתאימות במסגרת המדינה.
				    כל זאת , ללא התחשבות בחוקי המדינה האחרת בה אתם אזרחיםי \ או במיקומכם הגאוגרפי הנוכחי.
				</td>
			    </tr>
			    <!-- 13th term-->
			    <tr><td colspan="2"></td></tr>
			    <tr>
				<td valign="top" style="width: 70px;padding-left: 4px;" align="left">13)</td>
				<td>
    				   צור קשר – אם יש לך כל שאלה בנוגע לתנאי השימוש , אתה מוזמן ליצור עמנו קשר בשליחת
				   אימייל ל- <a href="mailto:admin@besthing.co.il">admin@besthing.co.il</a> , ואנו נחזור אלייך בהקדם האפשרי.
				</td>
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