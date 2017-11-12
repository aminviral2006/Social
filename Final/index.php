<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" lang="he" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Home Page</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link href="http://www.freelancer.com/rss.xml" rel="alternate" type="application/rss+xml" title="Latest projects" />

        <style type="text/css">
            body
            {
                background-color: #495863;
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
                font-family: verdana;
                font-size: 12px;
                margin-left: auto;
                margin-right: auto;

                /*position: relative;
                background-color: #FFFFFF;                
                width: 79%;
                height: auto;
                display:block;
                margin: 0 auto;
                border-style: solid;
                border-width: thick;
                border-color:white;
                padding-left: 12px;
                padding-right: 3px;
                padding-top: 3px;
                padding-bottom: 3px;
                font-family: verdana;
                font-size: 12px;*/


            }
            #dvBanner
            {
                position: relative;
                width: 100%;
                height: 125px;
                display:block;
                padding: 0px;
                background-image: url(aviimages/logoheader.jpg);
                background-repeat: no-repeat;
            }
            #dvLogin
            {
                position: relative;
                float: left;
                display: block;
                top: 30px;
                left: 450px;
                color: white;
                font-size: 14px;
                font-weight: bold;
            }
            .spNotAMember
            {
                color: #f9c60b;
            }
            #dvMenuStrip
            {
                position: relative;
                top: 80px;
                width: 982px;
                height: 30px;
                z-index: 3;
                display:block;                                
            }
            #dvMenuContents
            {
                position: relative;
                width: 982px;
                top: 3px;
                left: 300px;
                float: right;
                color: black;
                display: block;
                font-size: 14px;
                font-weight: bold;
            }
            #dvBrowseStuff
            {
                position: absolute;
                float: left;
                top: 1px;
                display: block;
                left: 10px
            }
            #dvSearchTextBox
            {
                position: absolute;
                float:left;
                top: 3px;
                left: 240px;
                width: 15%;
                height: 24px;
            }
            #dvSearch
            {
                position: absolute;
                float:left;
                top: 1px;
                left: 150px;
            }
            #dvIsBestSection
            {
                width: 978px;
                height: 100px;
                z-index: 4;
                margin-left:auto;
                margin-right:auto;
                padding-top: 10px;
                padding-bottom: 10px;
                display:block; /*Maha Gilinder*/
                padding: 0px;
            }
            #dvIsBest
            {
                display: block;
                width: 430px;
                height: 90px;
                float: right;
                z-index: 4;
                background-image: url(aviimages/IsBestSectionBackground.jpg);
                background-repeat: no-repeat;
                padding: 0px;
            }
            #dvIsBestText
            {
                text-align: right;
                font-family: verdana;
                font-size: 18px;
                font-weight: bold;
                color: white;
                padding-right: 20px;
            }
            #dvIsBestTextBox
            {
                float: right;
                padding-right: 10px;
            }
            #dvIsBestButton
            {}
            #dvDoYouAgree
            {
                float: left;
                display: block;
                width: 390px;
                height: 90px;
                z-index: 4;
                background-image: url(aviimages/DoYouThinkBackground.jpg);
                background-repeat: no-repeat;
                padding: 0px;
            }
            #dvDoYouAgreeImage
            {
                position: relative;
                left: 10px;
                top: 0px;
                float: left;
                display: block;
                width: 100px;
                height: 88px;
                z-index: 4;
                background-image: url(aviimages/manthinkimagebackground.jpg);
                background-repeat: no-repeat;
                padding-top: 4px;
            }
            #dvManThinks
            {
                float: right;
                display: block;
                padding-right: 10px;
                padding-top: 2px;
                color:#f9c60b;
            }
            #dvThinkingStuff
            {
                float: right;
                display: block;
                padding-right: 20px;
                padding-top: 3px;
                color:#2296b9;
                font-family: arial;
                font-weight: bold;
                font-size: 14px;                
            }
            #spThinks
            {
                color:white;
                font-weight: bold;
                font-family: arial;
            }
            #dvThinkingIsBest
            {
                float: right;
                display: block;
                padding-right: 70px;
                padding-top: 2px;
                color:#f9c60b;
                font-family: arial;
                font-weight: bold;
                font-size: 18px;
            }
            #dvWhatDoYouThink
            {
                float: right;
                display: block;
                padding-right: 90px;
                padding-top: 1px;
                color:white;
                font-family: arial;
                font-weight: bold;
                font-size: 20px;
            }
            #dvYesNo
            {
                position: relative;
                top:-30px;
                left: 3px;
                width: 150px;
                height: 30px;
                float: left;
                display: block;
            }
            #dvCollage
            {
                position: relative;
                /*top:100px;
                left:2px;*/
                width: 960px;
                height: 380px;
                z-index: 4;
                background-image: url(aviimages/CollageBackground.jpg);
                background-repeat: no-repeat;
                margin-left:auto;
                margin-right:auto;
                padding-top: 2px;
                display:block; /*Maha Gilinder*/
            }
            #imgCollage
            {
                padding-top: 3px;
                width: 950px;
                height: 370px;
            }
            #dvOptions
            {
                width: 978px;
                display: block;
                height: auto;
                padding: 0;
            }
            #dvNewStuffTitle
            {
                color: white;
                background-image: url(aviimages/categorititles.jpg);
                background-repeat: no-repeat;
                width:298px;
                height: 32px;
                display: block;
                float: left;
                padding-top: 5px;
                padding-left: -50px;
                font-weight: bold;
                font-family: arial;
                font-size: 16px;
            }
            #dvNewStuff
            {
                position: relative;
                top: 1px;
                left:45px;
                display: block;
                float: left;
                width: 300px;
                height: auto;
            }
            #dvNewStuffContents
            {
                position: relative;
                top: 1px;
                left:0px;
                display: table;
                float: left;
                width: 300px;
                height: 200px;
            }
            #dvCategoryTitle
            {
                color: white;
                background-image: url(aviimages/categorititles.jpg);
                background-repeat: no-repeat;
                width:298px;
                height: 32px;
                display: block;
                float: left;
                padding-top: 5px;
                padding-left: -50px;
                font-weight: bold;
                font-family: arial;
                font-size: 16px;
            }
            #dvCategory
            {
                position: relative;
                top: 1px;
                left:35px;
                display: block;
                float: left;
                width: 300px;
                height: auto;
            }
            #dvCategoryContents
            {
                position: relative;
                top: 1px;
                left:0px;
                display: table;
                float: left;
                width: 300px;
                height: 200px;
            }
            #dvRandomTitle
            {
                color: white;
                background-image: url(aviimages/categorititles.jpg);
                background-repeat: no-repeat;
                width:298px;
                height: 32px;
                display: block;
                float: left;
                padding-top: 5px;
                padding-left: -50px;
                font-weight: bold;
                font-family: arial;
                font-size: 16px;
            }
            #dvRandom
            {
                position: relative;
                top: 1px;
                left:25px;
                display: block;
                float: left;
                width: 300px;
                height: auto;
                
            }
            #dvRandomContents
            {
                position: relative;
                top: 1px;
                left:0px;
                display: table;
                float: left;
                width: 300px;
                height: 200px;
            }
            #dvActiveMembers
            {
                position: relative;
                top: 1px;
                left:10px;
                display: block;
                width: 800px;
                height: 120px;
                padding: 1px;
                padding-left: 5px;
            }
            #dvActiveMembersTitle
            {
                position: relative;
                color: white;
                background-image: url(aviimages/activememberstitle.jpg);
                background-repeat: no-repeat;
                width:800px;
                height: 32px;
                display: block;
                margin-left:auto;
                margin-right:auto;
                padding-top: 5px;
                padding-left: -100px;
                font-weight: bold;
                font-size: 14px;
                text-align: right;
            }
            #dvActiveMemberImages
            {
                padding-top: 3px;                
                display: block;
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
                font-family: arial;
                color: #FFFFFF;
                margin-left: auto;
                margin-right: auto;

            }
            #dvFooter a
            {
                font-size: 13px;
                font-family: arial;
                color: #FFFFFF;
                text-decoration: none;
            }
            #dvFooter a:hover
            {
                text-decoration: underline;
            }

            .table
            {
                font-family: verdana;
                font-size: 13px;
                color: blue;
                width: 300px;
            }
            .odd
            {
                background-color: #fef5ce;
            }
        </style>
        <script type="text/javascript" language="JavaScript">
            String.prototype.trim = function()
            {
                return this.replace(/(?:(?:^|\n)\s+|\s+(?:$|\n))/g,"");
            }

            function CategoryValid()
            {
                if(document.frmaddcategory.txtAddCategory.value.trim()=="")
                    return false;
                else
                    return true;
            }
        </script>
    </head>
    <body>
        <form name="frmaddcategory" method="POST" action="Newstuff.php" enctype="multipart/form-data" onsubmit="return CategoryValid();">
            <div id="dvMain" align="center">
                <div id="dvBanner">                    
                    <div id="dvLogin">
                       <!--<img src='member/memberimages/default.jpg' width='20px' height='20px' alt='' />|-->
                        התחבר | <span class="spNotAMember">עדיין לא רשום ?</span> הרשם עכשיו                       
                    </div>
                    <div style="clear: both;"></div>
                    <div id="dvMenuStrip">
                        <div id='dvMenuContents'>
                            ראשי שאלות נפוצות
                        </div>
                        <div style="clear: both;"></div>
                        <form id="frmSearch" name="frmSearch" method="post" action="">
                            <div id="dvSearchTextBox">
                                <input type="text" id="txtsearch" name="txtsearch"/>
                            </div>
                            <span style='font-size: 1px;'>&nbsp;</span>
                            <div id="dvSearch">
                                <input type="image" value="" id="btnSearch" name="btnSearch" src='aviimages/search.jpg' width='80px' height='24px' alt='' />
                            </div>
                        </form>
                        <span style='font-size: 1px;'>&nbsp;</span>
                        <div style="clear: both;"></div>
                        <div id="dvBrowseStuff">
                            <input type="image" value="" id="btnBrowser" name="btnBrowse" src='aviimages/BrowseStuff.jpg' width='130px' height='24px' alt='' />
                        </div>
                    </div>
                </div>

                <span style='font-size: 1px;'>&nbsp;</span>
                <span style='font-size: 1px;'>&nbsp;</span>
                <div id="dvIsBestSection">
                    <div id="dvIsBest">
                        <form id="frmIsBest" name="frmIsBest" method="post" action="">
                            <span style='font-size: 1px;'>&nbsp;</span>
                            <div id="dvIsBestText">
                                מה לדעתכם הדבר הכי טוב בעולם ?
                            </div>
                            <div id="dvIsBestTextBox">
                                <input type="text" id="txtisbest" name="txtisbest" size="40"/>
                            </div>                            
                            <div id="dvIsBestButton">
                                <input type="image" value="" id="btnisbest" name="btnisbest" src="Aviimages/IsBestButton.jpg"/>
                            </div>                            
                        </form>
                    </div>
                    <span style='font-size: 1px;'>&nbsp;</span>
                    <div id="dvDoYouAgree">
                        <div id="dvManThinks">
                            <span>Redman </span><span id="spThinks">חושב ש...</span>
                        </div>
                        <div style="clear: both;"></div>
                        <div id="dvThinkingStuff">
                            (תילארשי הקהל) לוחכה ליפה
                        </div>
                        <div style="clear: both;"></div>
                        <div id="dvThinkingIsBest">
                            היא הלהקה הכי טובה
                        </div>
                        <div style="clear: both;"></div>
                        <div id="dvWhatDoYouThink">
                            האם אתה מסכים?
                        </div>
                        <div style="clear: both;"></div>
                        <div id="dvYesNo">
                            <input type="image" value="" id="btnyes" name="btnyes" src="aviimages/yes.jpg"/>
                            <input type="image" value="" id="btnno" name="btnno" src="aviimages/no.jpg"/>
                        </div>
                    </div>
                    <span style='font-size: 1px;'>&nbsp;</span>
                    <div id="dvDoYouAgreeImage">
                        <img src="aviimages/great.jpg" width="90px" height="80px"/>
                    </div>
                </div>
                <span style='font-size: 1px;'>&nbsp;</span>
                <span style='font-size: 1px;'>&nbsp;</span>
                <div id="dvCollage">
                    <img id="imgCollage" src="aviimages/collage_jpg.jpg"/>
                </div>
                <div style="clear: both;"></div>
                <span style='font-size: 1px;'>&nbsp;</span>
                <span style='font-size: 1px;'>&nbsp;</span>
                <div id="dvOptions">
                    <div id="dvRandom" align="right">
                        <div id="dvRandomTitle" title="Random">&nbsp;&nbsp;&nbsp;קטגריות חדשות</div>
                        <div id="dvRandomContents">
                            <table class="table">
                                <tr>
                                    <td>"I'm Not Always Right, I'm Just Never Wrong"</td>
                                </tr>
                                <tr class="odd">
                                    <td>Way to enlighten the Dark Days</td>
                                </tr>
                                <tr>
                                    <td>EATING CHOCOLATE :)</td>
                                </tr>
                                <tr class="odd">
                                    <td>Miley Cyrus :)</td>
                                </tr>
                                <tr>
                                    <td>Let Be the One (SS501)</td>
                                </tr>
                                <tr class="odd">
                                    <td>Trouble Is a Friend</td>
                                </tr>
                                <tr>
                                    <td>Music Is Everything</td>
                                </tr>
                                <tr class="odd">
                                    <td>Bonamana Super Junior</td>
                                </tr>
                                <tr>
                                    <td>Cats Lover</td>
                                </tr>
                                <tr class="odd">
                                    <td>Yamapi Vs Kim Hyun Jong</td>
                                </tr>
                                <tr>
                                    <td>Triple s 4 Ever</td>
                                </tr>
                                <tr class="odd">
                                    <td>Love the Way You Lie</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div id="dvCategory" align="right">
                        <div id="dvCategoryTitle" title="Categories">&nbsp;&nbsp;&nbsp;נושאים אחרונים</div>
                        <div id="dvCategoryContents">
                            <table class="table">
                                <tr>
                                    <td>Best Manangement</td>
                                </tr>
                                <tr class="odd">
                                    <td>Best Pretty and Cute Girl Singer</td>
                                </tr>
                                <tr>
                                    <td>Best More Time</td>
                                </tr>
                                <tr class="odd">
                                    <td>Best More Time</td>
                                </tr>
                                <tr>
                                    <td>Best Http://www.afroromance.com/fyooz/multiculturalism-the-new-beauty-inspiration/</td>
                                </tr>
                                <tr class="odd">
                                    <td>Best Http://www.afroromance.com/fyooz/fear-of-intimacy-commitment/</td>
                                </tr>
                                <tr>
                                    <td>Best Smell of a Season</td>
                                </tr>
                                <tr class="odd">
                                    <td>Best Thing to make Footprints In</td>
                                </tr>
                                <tr>
                                    <td>Best Eating Turn Offs</td>
                                </tr>
                                <tr class="odd">
                                    <td>Best Super Skinny Actor</td>
                                </tr>
                                <tr>
                                    <td>Best Thing to giggle At</td>
                                </tr>
                                <tr class="odd">
                                    <td>Best Lyrical Genius</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div id="dvNewStuff" align="right">
                        <div id="dvNewStuffTitle" title="New Stuff">&nbsp;&nbsp;&nbsp;אחר</div>
                        <div id="dvNewStuffContents">
                            <table class="table">
                                <tr>
                                    <td>Miley Cyrus :)</td>
                                </tr>
                                <tr class="odd">
                                    <td>Let Be the One (SS501)</td>
                                </tr>
                                <tr>
                                    <td>Music Is Everything</td>
                                </tr>
                                <tr class="odd">
                                    <td>Bonamana Super Junior</td>
                                </tr>
                                <tr>
                                    <td>Love the Way You Lie</td>
                                </tr>
                                <tr class="odd">
                                    <td>Songs That Tell a Sad Lifestory</td>
                                </tr>
                                <tr>
                                    <td>I Believe to my Soul</td>
                                </tr>
                                <tr class="odd">
                                    <td>Things Have Changed</td>
                                </tr>
                                <tr>
                                    <td>Cristy Spiteri</td>
                                </tr>
                                <tr class="odd">
                                    <td>Elise Estrada</td>
                                </tr>
                                <tr>
                                    <td>Black Coffee</td>
                                </tr>
                                <tr class="odd">
                                    <td>Avishai Cohen</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
                <span style='font-size: 1px;'>&nbsp;</span>
                <span style='font-size: 1px;'>&nbsp;</span>       
                <div id="dvActiveMembers" align="center">
                    <div id="dvActiveMembersTitle" title="Active Members">
                        &nbsp;&nbsp;&nbsp;חברים פעילים
                    </div>
                    <div id="dvActiveMemberImages">
                        <img src="aviimages/activemembers.jpg" width="800px" height="70px"/>
                    </div>                
                </div>                
            </div>
        </form>
        <span style='font-size: 1px;'>&nbsp;</span>
        <div id='dvFooter' align="center">
            <a href="#">home |</a> <a href="#">faq |</a>
            <a href="#">privacy policy |</a> <a href="#">term and conditions |</a>
            <a href="#">contact us |</a> <a href="#">rss feed |</a> <a href="#">bookmark this page</a><br/>
            Copyright &copy;2010 Avigabso. Designed & Developed by <a href="http://themacrosoft.com">Macrosoft Solutions</a>
        </div>
    </body>
</html>