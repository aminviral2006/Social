<?php
session_start();
if (isset($_SESSION['member']))
    header("location:../index.php?msg=" . $_REQUEST['login']);
include_once 'commoninclude.php';
/* if(isset($_POST['submit']))
  {
  header("location:checkmemberlogin.php");
  } */
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
                        <a href="../index.php" title="HOME"><?php echo MENU_HOME?></a> <a href="#" title="FAQ"><?php echo FAQ; ?></a>
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
            if (isset($_REQUEST['login'])) {
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
                            <td colspan="2"><b><h1>שאלות נפוצות</h1></b></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <h2><ul>
                                        <li>אז מה הוא אתר "הכי טוב!" ?</li>
                                    </ul></h2>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <ul><b>"הכי טוב!"(besthing.co.il)</b> הוא אתר חברתי פתוח לכולם , שבהתאם למשתמש , יכול לקבל משמעויות שונות.<br/><br/>
                                    האתר פשוט שואל אתכם שאלה אחת פשוטה : <b>מהו הדבר הטוב בעולם ?</b><br/><br/>

                                    זה יכול להיות שיר או ציטוט שהעניק לך השראה , הבית קפה בפינת הרחוב או הבר השכונתי שלכם.  <br/>
                                    כמו כן זה יכול להיות אישיות שאתם מעריצים , או הסבר מסוים על כל נושא אחר שאהוב עליכם.<br/><br/>

                                    האתר מאפשר לכם לגלות מה אנשים מכל רחבי הארץ והעולם חושבים לגבי שאלה חשובה זו , <br/>
                                    והאתר נותן לכם פלטפורמה לשיתוף הדברים הטובים ביותר בעולם עבורכם. <br/><br/>

                                    "הכי טוב!"  הוא אתר השואף להיות רשת חברתית קהילתית שוקקת ודינאמית של אנשים בעלי דעות <br/>
                                    דומות שאוהבים לשתף ולדון ברעיונותיהם מסביב לדברים הטובים בעולם.<br/><br/>

                                    האתר מאפשר לכם להכיר אנשים שחושבים ואוהבים בדיוק כמוכם , או ההפך הגמור. לאתר ממשק <br/>
                                    גרפי פשוט ויעיל שיאפשר לכם לעשות הכל בפשטות ובקלות , וליהנות מחוויה של ידע , דעות , הומור , ואנשים.<br/><br/>
                                </ul>
                            </td>
                        </tr>
                        <tr><td colspan="2"></td></tr>
                        <tr>
                            <td colspan="2">
                                <ul>
                                    <li>
                                        <h2>אז איך אני מוסיף דברים?</h2>
                                    </li>
                                    <ul>
					         קל! כדי להוסיף פריט חדש, פשוט להוסיף אותו מן עמוד הבית שלנו או בתוך דף הקטגוריה. <br/>
                                        פריטים חדשים ניתן גם להוסיף על ידי הצעת פריט טוב יותר בדף הבית , או בעמוד תיאור הפריט<br/>
                                    </ul>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <ul>
                                    <li>
                                        <h2>היי!  האדם/המקום/הדבר הזה הוא לא הכי טוב. אני רוצה לומר את שלי בעניין!</h2>
                                    </li>
                                </ul>
                                <ul>
                                    אם אתה לא מאמין שפריט תוכן מסוים הוא הכי טוב, אז אתה תמיד יכול להציע משהו שאתה<br/>
                                    חושב שהוא יותר טוב. הכנס לדף התיאור של הפריט המדובר, ואז פשוט לחץ על כפתור "משהו אחר <br/>
                                    יותר טוב"  על מנת להוסיף "משהו הכי טוב" המועדף עליך. <br/>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <ul>
                                    <li><h2>אני רוצה לעדכן את תיאור הפריט / להוסיף עוד תמונה לפריט / לשייך את הפריט לקטגוריה נוספת.</h2></li>
                                </ul>
                                <ul>
                                    תיאורים, תמונות וקטגוריות נוספות ניתן להוסיף / לערוך באמצעות הכפתורים בדף התיאור. <br/>
                                    עליך להיות חבר רשום ומחובר באתר כדי לנהל את האופציות האלה. <br/><br/>

                                    כדי לעדכן את תיאור הפריט , לחץ על כפתור ה"ערוך תיאור". תיאור הפריט יהפוך לשדה טקסט <br/>
                                    הניתן לעריכה. גרסתו הקודמת של התיאור והוראות העיצוב גם מופיעים. <br/><br/>

                                    כדי להוסיף תמונות עבור הפריט, רק לחץ על כפתור "נהל\הוסף תמונות". <br/><br/>

                                    כדי להוסיף קטגוריה נוספת לפריט, רק לחץ על הכפתור "הוסף קטגוריות". ניתן להוסיף <br/>
                                    קטגוריות נוספות במקרה שאתה חושב שהפריט יכול להיות מתאים על פני מספר קטגוריות. כלומר, <br/>
                                    'כדורגל' יכול להיות 'משחק הספורט הכי טוב' או 'המשחק שהכי טוב לצפייה'. לאחר שיצרת קטגוריה,<br/>
                                    היא תהיה זמינה עבור חברים אחרים כדי להוסיף פריטים עבור אותה קטגוריה. <br/><br/>

                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <ul>
                                    <li><h2>                                        מה זה "סימון פריט"</h2></li>
                                </ul>
                                <ul>
                                    אם אתה מאתר פריט שאתה רוצה לפקוח עליו עין , אבל לא רוצה להצביע או להציע <br/>
                                    אלטרנטיבה, אז לחץ על כפתור "סמן פריט זה". כך תוסיף את הפריט המדובר לאזור הפריטים <br/>
                                    המסומנים בדף הפרופיל שלך. <br/><br/>

                                    "סימון פריטים" היא הדרך ה"נייטרלית" להוספת פריטים עבור עמוד הפרופיל שלכם. <br/>
                                    פריטים אלו יכולים לשמש אתכם במספר דרכים. הם יופיעו בעמוד הפרופיל שלכם באזור ה"סימניות" <br/>
                                    , וזה יעזור לך למצוא את התיאורים של הפריטים במהירות ובקלות.<br/>

                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <ul>
                                    <li><h2>כיצד אוכל לעדכן את הפרופיל שלי? </h2></li>
                                </ul>
                                <ul>
                                       אתה יכול לעדכן את הפרטים שלך או תמונת הפרופיל בעמוד הפרופיל שלכם. פשוט תלחצו על <br/>
                                       כפתור "ערוך פרופיל" בתוך אזור הפרופיל שלך. <br/>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <ul>
                                    <li><h2>מה זה "חבר מנהל"? </h2></li>
                                </ul>
                                <ul>
                                     "חבר מנהל" הוא בעצם חבר שיש לו הרשאות מנהל באתר. הוא יכול לערוך כותרות פריט <br/>
                                     וקטגוריות, כמו כן למחוק את כל תמונות הפריט, וגם יכול אפילו לסמן פריט להשעיה (המכונה 'פסק <br/>
                                     זמן') אם הם חושבים פריט נחשב פוגע או מעליב\לא חוקי. <br/><br/>

                                           חבר יכול להפוך לחבר מנהל רק אם צוות "הכי טוב!" שם לב לפעילות החיובית שלו בקהילת <br/>
                                           האתר. חברים אלו אנו נזמין אותם להיות חלק מהצוות ולהפוך לחברים מנהלים. <br/>
                                           כמובן שעם כוח גדול מגיעה אחריות גדולה ... <br/>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <ul>
                                    <li><h2>מהו פריט "נעול"? </h2></li>
                                </ul>
                                <ul>
                                          מדי פעם פריט מסוים שכבר פורסם באתר עשוי להינעל בעקבות שימוש ללא הרף של שפה <br/>
                                          פוגעת ו\או שימוש בתוכן אחר העלול לפגוע ברגשות ציבור הגולשים<br/>
                                          כדי לשמור על הרוח החיובית וההנאה שבאתר שלנו, אנחנו לפעמים ננעל את הפריטים האלה, כך <br/>
                                          שרוב המשתמשים לא ייעלבו או יפגעו. <br/><br/>
                                          
                                                כאשר פריט הוא "נעול", אתה לא יכול לשנות ו\או להוסיף תיאורים, קטגוריות, ותמונות, אולם <br/>
                                                ההצבעה עדיין אפשרית.<br/>
                                                תוכלו לזהות פריט נעול על ידי הופעת מנעול קטן בשורת הכותרת. <br/><br/>
                                                      אם אתה רואה משהו מעליב, אנא יידע אותנו(LINK TO REPORT <br/>
                                                      VIOLATION/CONTACT US)! <br/>
                                                      
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <ul>
                                    <li><h2> האם אתה מעוניין לקבל עדכוני RSS / Atom ? </h2></li>
                                </ul>
                                <ul>
                                          RSS 2.0 ו-Atom זמינים עבור אזורים מרובים של אתר האינטרנט שלנו: <br/><br/>

                                                "רשימת הזנה"(FEED) כללית מן עמוד הבית: רשימת הפריטים שהוספו לארונה באתר.<br/><br/>

                                                     "רשימת הזנה"(FEED) עבור קטגוריה : רשימה זו תתן לך את התוספות האחרונות לקטגוריה <br/>
                                                     ספציפית. <br/><br/>

                                                     רק לחץ על קישור ATOM / RSS  מהקטגוריה המסוימת שברצונך לעקוב אחריה. <br/><br/>

                                                         "רשימת הזנה"(FEED) פרופיל: רוצה לפקוח עין על רשימת הדברים של מישהו? רוצה לדעת <br/><br/>

                                                         מתי הפרופיל שלו מתעדכן ?  ובכן במקרה כזה ,  הירשם לרשימת ההזנה(RSS) מעמוד הפרופיל<br/>
                                                         שלהם. <br/><br/>

                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <ul>
                                    <li><h2>   אני לא יכול לראות את קולאז' התמונות בדף הבית? / יש שטח לבן גדול בדף הבית? </h2></li>
                                </ul>
                                <ul>
                                          אם אתה לא מצליח לראות את קולאז' התמונות בעמוד הבית, אז יכול להיות שבמחשב שלך <br/>
                                          מותקנת תוכנה לחסימת מודעות(AD BLOCKNG SOFTWARE) , בדוק הגדרות הדפדפן שלך<br/>
                                          לפתרון הבעיה. <br/>

                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <ul>
                                    <li><h2>    למה כפתורי ההצבעה לא עובדים? </h2></li>
                                </ul>
                                <ul>
                                          אנו משתמשים המון בJavaScript באתר שלנו כדי לעשות אותו כל כך מגניב , ודא כי <br/>
                                          JavaScript מופעלת(ENABLED) בהגדרות הדפדפן אינטרנט שלך. <br/>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <ul>
                                    <li><h2>     אני רוצה לדווח על תקלה / בעיה / עלבון / פגיעה </h2></li>
                                </ul>
                                <ul>
                                    כדי ליצור עמנו קשר, אנא בקר בדף הצור קשר(LINK TO CONTACT US) שלנו. <br/>
                                    
                                </ul>
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
    	    <A HREF="http://www.bizhostnet.com/" title="ASP.NET HOSTING" >ASP.NETHOSTING</A>
        </div>
    </body>
</html>