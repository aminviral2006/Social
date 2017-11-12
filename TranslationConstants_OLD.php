<?php
if(!isset($_SESSION['lang']))
    $_SESSION['lang'] = "en";

$lang = $_SESSION['lang'];
if(!defined('LOGIN')) define('LOGIN','התחבר');
if(!defined('NOT_A_MEMBER'))
    define('NOT_A_MEMBER','עדיין לא רשום ?');
if(!defined('SIGN_UP'))
    define('SIGN_UP','הרשם עכשיו');

//Translations for Menubar
if(!defined('MENU_HOME')) 
    define('MENU_HOME',$lang=="he"?'ראשי':"Home");
    if(!defined('MENU_SITE_CONFIGURATION'))
	define('MENU_SITE_CONFIGURATION',$lang=="he"? 'הגדרות האתר' : 'Site Configurations');
    if(!defined('MENU_MEMBERS'))
	define('MENU_MEMBERS',$lang=="he"? 'משתמשים' : 'Members');
    if(!defined('MENU_DISPLAY_MEMBERS'))
	define('MENU_DISPLAY_MEMBERS',$lang=="he"? 'הצג משתמשים' : 'Display Members');
    if(!defined('MENU_SEARCH_MEMBERS'))
	define('MENU_SEARCH_MEMBERS',$lang=="he"? 'חיפוש משתמשים' : 'Search Members');
    if(!defined('MENU_MESSAGE_TO_ALL'))
	define('MENU_MESSAGE_TO_ALL',$lang=="he"? 'הודעה לכל המשתמשים' : 'Message to All');

if(!defined('MENU_TAG'))
    define('MENU_TAG',$lang=="he"? 'תגיות \נושאים' : 'Tag');
    if(!defined('MENU_DISPLAY_TAG'))
	define('MENU_DISPLAY_TAG',$lang=="he"? 'הצג נושא\תגית' : 'Display Tag');
    if(!defined('MENU_ADD_TAG'))
	define('MENU_ADD_TAG',$lang=="he"? 'הוספת נושא\תגית' : 'Add Tag');
    
if(!defined('MENU_CATEGORY'))
    define('MENU_CATEGORY',$lang=="he"? ' אזור קטגוריות' : 'Category');
    if(!defined('MENU_DISPLAY_CATEGORY'))
	define('MENU_DISPLAY_CATEGORY',$lang=="he"? ' הצג קטגוריה' : 'Display Category');
    if(!defined('MENU_SEARCH_CATEGORY'))
	define('MENU_SEARCH_CATEGORY',$lang=="he"? ' חיפוש קטגוריה' : 'Search Category');

if(!defined('MENU_STUFFS'))
    define('MENU_STUFFS',$lang=="he"? ' אייטמים' : 'Stuffs');
    if(!defined('MENU_DISPLAY_STUFFS'))
	define('MENU_DISPLAY_STUFFS',$lang=="he"? ' הצג אייטמים(דברים הכי טובים)' : 'Display Stuffs');
    if(!defined('MENU_SEARCH_STUFFS'))
	define('MENU_SEARCH_STUFFS',$lang=="he"? '  חיפוש אייטם(דבר הכי טוב)' : 'Search Stuffs');

if(!defined('MENU_REPORT_VIOLATION'))
    define('MENU_REPORT_VIOLATION',$lang=="he"? 'דיווחים על פגיעה' : 'Report Violation');
    if(!defined('MENU_UNHANDLED_REPORT_VIOLATION'))
	define('MENU_UNHANDLED_REPORT_VIOLATION',$lang=="he"? ' דיווחים לא מטופלים' : 'Unhandled Report Violation');
    if(!defined('MENU_HANDLED_REPORT_VIOLATION'))
	define('MENU_HANDLED_REPORT_VIOLATION',$lang=="he"? 'דיווחים שטופלו כבר' : 'Handled Report Violation');

if(!defined('MENU_NEWS_LETTER'))
    define('MENU_NEWS_LETTER',$lang=="he"? 'ניוזלטר' : 'News Letter');
    if(!defined('MENU_SEND_NEWS_LETTER'))
	define('MENU_SEND_NEWS_LETTER',$lang=="he"? 'שלח ניוזלטר' : 'Send News Letter');
    if(!defined('MENU_SEND_SITE_ANNOUNCEMENT'))
	define('MENU_SEND_SITE_ANNOUNCEMENT',$lang=="he"? 'שלח הודעה' : 'Send Site Announcement');

if(!defined('HOME')) define('HOME','עמוד ראשי ');
if(!defined('FAQ')) define('FAQ','שאלות נפוצות');
if(!defined('ABOUT_US')) define('ABOUT_US','מי אנחנו');
if(!defined('PRIVACY_POLICY')) define('PRAVACY_POLICY','הצהרת פרטיות');
if(!defined('TERMS_AND_CONDITIONS')) define('TERMS_AND_CONDITIONS',' תנאי שימוש');
if(!defined('CONTACT_US')) define('CONTACT_US',' צור קשר');
if(!defined('RSS_FEED')) define('RSS_FEED','הזנת RSS');

if(!defined('NEW_STUFFS')) define('NEW_STUFFS','נושאים אחרים');
if(!defined('NEW_CATEGORIES')) define('NEW_CATEGORIES','קטגוריות אחרונות');
if(!defined('MORE_NEW_STUFFS')) define('MORE_NEW_STUFFS','עוד נושאים אחרונים...');
if(!defined('MORE_TAGS')) define('MORE_TAGS','עוד...');

if(!defined('LAST_LOGGED_IN')) define('LAST_LOGGED_IN','התחברו לאחרונה');
if(!defined('LOGGED_IN_NOW')) define('LOGGED_IN_NOW','מחוברים עכשיו');
if(!defined('ACTIVE_MEMBERS')) define('ACTIVE_MEMBERS','חברים פעילים');

//Administrator Home Page Translation
if(!defined('MEMBER_ZONE')) 
    define('MEMBER_ZONE',$lang=='he' ? 'אזור המשתמשים' : 'Member Zone');
if(!defined('TOTAL_MEMBERS')) 
    define('TOTAL_MEMBERS',$lang=='he' ? 'סך הכל משתמשים' : 'Total Members');
if(!defined('PENDING_MEMBERS')) 
    define('PENDING_MEMBERS',$lang=='he' ? 'משתמשים ממתינים לאישור' : 'Pending Members');
if(!defined('CURRENT_ACTIVE_MEMBERS')) 
    define('CURRENT_ACTIVE_MEMBERS',$lang=='he' ? 'משתמשים פעילים' : 'Active Members');
if(!defined('IN_ACTIVE_MEMBERS')) 
    define('IN_ACTIVE_MEMBERS',$lang=='he' ? 'משתמשים לא פעילים' : 'In-Active Members');
if(!defined('BLOCKED_MEMBERS')) 
    define('BLOCKED_MEMBERS',$lang=='he' ? 'משתמשים חסומים' : 'Blocked Members');
if(!defined('TRUSTED_MEMBERS')) 
    define('TRUSTED_MEMBERS',$lang=='he' ? 'משתמשים מנהלים ' : 'Trusted Members');

if(!defined('TOP_MEMBERS')) 
    define('TOP_MEMBERS',$lang=='he' ? 'משתמשים מובילים' : 'Top Members');
if(!defined('MEMBER_NAME'))
    define('MEMBER_NAME',$lang=='he' ? 'שם המשתמש' : 'Member Name');
if(!defined('STUFFS_CREATED'))
    define('STUFFS_CREATED',$lang=='he' ? 'מספר אייטמים' : 'Stuffs Created');

if(!defined('CATEGORY_ZONE')) 
    define('CATEGORY_ZONE',$lang=='he' ? 'אזור הקטגוריות' : 'Category Zone');
if(!defined('TOTAL_CATEGORIES')) 
    define('TOTAL_CATEGORIES',$lang=='he' ? 'כך הכל קטגוריות' : 'Total Categories');
if(!defined('ACTIVE_CATEGORIES')) 
    define('ACTIVE_CATEGORIES',$lang=='he' ? 'קטגוריות פעילות' : 'Active Categories');
if(!defined('IN_ACTIVE_CATEGORIES')) 
    define('IN_ACTIVE_CATEGORIES',$lang=='he' ? 'קטגוריות לא פעילות' : 'In-Active Categories');

if(!defined('TOPIC_ZONE')) 
    define('TOPIC_ZONE',$lang=='he' ? 'אזור התגיות' : 'Topic Zone');
if(!defined('TOTAL_TOPICS')) 
    define('TOTAL_TOPICS',$lang=='he' ? 'סך הכל נושאים\תגיות' : 'Total Topics');
if(!defined('ACTIVE_TOPICS')) 
    define('ACTIVE_TOPICS',$lang=='he' ? 'נושאים\תגיות פעילות' : 'Active Topics');
if(!defined('IN_ACTIVE_TOPICS')) 
    define('IN_ACTIVE_TOPICS',$lang=='he' ? 'נושאים\תגיות לא פעילות' : 'In-Active Topics');

if(!defined('STUFFS_ZONE')) 
    define('STUFFS_ZONE',$lang=='he' ? 'אזור האייטמים(הדברים הטובים)':'Stuffs Zone');
if(!defined('TOTAL_STUFFS')) 
    define('TOTAL_STUFFS',$lang=='he' ? 'סך הכל אייטמים' : 'Total Stuffs');
if(!defined('ACTIVE_STUFFS')) 
    define('ACTIVE_STUFFS',$lang=='he' ?  'אייטמים פעילים' : 'Active Stuffs');
if(!defined('IN_ACTIVE_STUFFS')) 
    define('IN_ACTIVE_STUFFS',$lang=='he' ? 'אייטמים לא פעילים' : 'In-Active Stuffs');
if(!defined('LOCKED_STUFFS')) 
    define('LOCKED_STUFFS',$lang=='he' ? 'אייטמים נעולים' : 'Locked Stuffs');

//Site Configuration Page
if(!defined('SITE_CONFIG_GUEST_USER_SIDE'))
    define('SITE_CONFIG_GUEST_USER_SIDE',$lang=='he' ? ' הגדרת האתר (אגף הגולשים)' : 'Guest User Side Configuration');
    if(!defined('NO_OF_STUFFS_ON_HOME_PAGE'))
	define('NO_OF_STUFFS_ON_HOME_PAGE',$lang=='he' ? ' מספר אייטמים (נושאים הכי טובים) בעמוד הראשי' : 'No. of Stuffs Shown on Home Page');
    if(!defined('NO_OF_CATEGORIES_ON_HOME_PAGE'))
	define('NO_OF_CATEGORIES_ON_HOME_PAGE',$lang=='he' ? ' מספר קטגוריות בעמוד הראשי' : 'No. of Categories Shown on Home Page');
    if(!defined('NO_OF_RANDOM_STUFFS_ON_HOME_PAGE'))
	define('NO_OF_RANDOM_STUFFS_ON_HOME_PAGE',$lang=='he' ? 'מספר אייטמים(נושאים) רנדומאלי בעמוד הראשי' : 'No. of Random Stuffs Shown on Home Page');
    if(!defined('NO_OF_STUFFS_ON_BROSE_STUFF_PAGE'))
	define('NO_OF_STUFFS_ON_BROSE_STUFF_PAGE',$lang=='he' ? 'מספר האייטמים(נושאים הכי טובים) בעמוד העיון בדברים הטובים' : 'No. of Stuffs on Browse Stuff Page');
    if(!defined('NO_OF_STUFFS_ON_BROSE_SEARCH_STUFF_PAGE'))
	define('NO_OF_STUFFS_ON_BROSE_SEARCH_STUFF_PAGE',$lang=='he' ? 'מספר האייטמים(נושאים הכי טובים) בעמוד תוצאות החיפוש' : 'No. of Stuffs on Browse Search Stuff Page');
    if(!defined('NO_OF_STUFFS_ON_BROSE_CATEGORY_PAGE'))
	define('NO_OF_STUFFS_ON_BROSE_CATEGORY_PAGE',$lang=='he' ? 'מספר האייטמים(נושאים הכי טובים) בעמוד הקטגוריות' : 'No. of Stuffs on Browse Category Page');
    if(!defined('NO_OF_RELATED_CATEGORY_STUFF_LIST_PAGE'))
	define('NO_OF_RELATED_CATEGORY_STUFF_LIST_PAGE',$lang=='he' ? 'מספר האייטמים ברשימת הנושאים הקשורים' : 'No. of Related Category Records on Stuff List Page(s)');

if(!defined('SITE_CONFIG_ADMINISTRATOR_SIDE'))
    define('SITE_CONFIG_ADMINISTRATOR_SIDE',$lang=='he' ? 'אגף המנהל ' : 'Administrator Side');
    if(!defined('NO_OF_RECORDS_ON_MEMBER_PAGE'))
	define('NO_OF_RECORDS_ON_MEMBER_PAGE',$lang=='he' ? 'מספר רשומות בעמוד המשתמש' : 'No. of Records on Members Page');
    if(!defined('NO_OF_RECORDS_ON_TOPICS_PAGE'))
	define('NO_OF_RECORDS_ON_TOPICS_PAGE',$lang=='he' ? 'מספר רשומות בעמוד הנושאים' : 'No. of Records on Topics Page');
    if(!defined('NO_OF_RECORDS_ON_CATEGORY_PAGE'))
	define('NO_OF_RECORDS_ON_CATEGORY_PAGE',$lang=='he' ? 'מספר רשומות בעמוד הקטגוריות' : 'No. of Records on Category Page');
    if(!defined('NO_OF_RECORDS_ON_STUFFS_PAGE'))
	define('NO_OF_RECORDS_ON_STUFFS_PAGE',$lang=='he' ? 'מספר רשומות בעמוד האייטם הכי טוב ' : 'No. of Records on Stuff Page');
    if(!defined('NO_OF_RECORDS_ON_MEMBER_SEARCH_PAGE'))
	define('NO_OF_RECORDS_ON_MEMBER_SEARCH_PAGE',$lang=='he' ? 'מספר רשומות בתוצאות החיפוש משתמשים' : 'No. of Records on Member Search Page');

if(!defined('SITE_CONFIG_TRUSTED_MEMBER_SIDE'))
    define('SITE_CONFIG_TRUSTED_MEMBER_SIDE',$lang=='he' ? 'אגף משתמשים נאמנים' : 'Trusted Member Side');
    if(!defined('NO_OF_RECORDS_ON_CATEGORY_PAGE_TRUSTED'))
	define('NO_OF_RECORDS_ON_CATEGORY_PAGE_TRUSTED',$lang=='he' ? '	מספר רשומות בעמוד הקטגוריות' : 'No. of Records on Category Page');
    if(!defined('NO_OF_RECORDS_ON_STUFFS_PAGE_TRUSTED'))
	define('NO_OF_RECORDS_ON_STUFFS_PAGE_TRUSTED',$lang=='he' ? 'מספר רשומות בעמוד האייטם(נושא  הכי טוב)' : 'No. of Records on Stuff Page');

if(!defined('SITE_CONFIG_MEMBER_PROFIDE_SIDE'))
    define('SITE_CONFIG_MEMBER_PROFIDE_SIDE',$lang=='he' ? 'אגף פרופיל המשתמש' : 'Member Profile Side');
    if(!defined('NO_OF_STUFFS_ON_MEMBER_PROFILE_SUB_PAGE'))
	define('NO_OF_STUFFS_ON_MEMBER_PROFILE_SUB_PAGE',$lang=='he' ? 'מספר רשומות בעמוד פרופיל המשתמש משני' : 'No. of Stuff Records on Member Profile Sub Page');
    if(!defined('NO_OF_COMMENTS_ON_MEMBER_PROFILE_SUB_PAGE'))
	define('NO_OF_COMMENTS_ON_MEMBER_PROFILE_SUB_PAGE',$lang=='he' ? 'מספר תגובות בעמוד פרופיל המשתמש המשני' : 'No. of Comments on Member Profile Sub Page');
    if(!defined('NO_OF_INNER_STUFFS_ON_MEMBER_PROFILE_SUB_PAGE'))
	define('NO_OF_INNER_STUFFS_ON_MEMBER_PROFILE_SUB_PAGE',$lang=='he' ? 'מספר אייטמים פנימיים בעמוד פרופיל המשתמש הראשי' : 'No. of Inner Stuff Records on Member Profile Main Page');
    if(!defined('NO_OF_INNER_COMMENTS_ON_MEMBER_PROFILE_SUB_PAGE'))
	define('NO_OF_INNER_COMMENTS_ON_MEMBER_PROFILE_SUB_PAGE',$lang=='he' ? 'מספר התגובות הפנימיות בעמוד פרופיל המשתמש הראשי' : 'No. of Inner Comment Records on Member Profile Main Page');
    if(!defined('NO_OF_INNER_FRIENDS_ON_MEMBER_PROFILE_SUB_PAGE'))
	define('NO_OF_INNER_FRIENDS_ON_MEMBER_PROFILE_SUB_PAGE',$lang=='he' ? 'מספר החברים הפנימיים בעמוד הפרופיל המשתמש הראשי' : 'No. of Inner Friends Records on Member Profile Main Page');
    if(!defined('NO_OF_STUFFS_ON_COLLEGE_PAGE'))
	define('NO_OF_STUFFS_ON_COLLEGE_PAGE',$lang=='he' ? 'הראה אייטמים(נושאים) בעמוד הקולאג\' בהתאם לכמות ההצבעות שהאייטם קיבל' : 'Show Stuff on Collage Page based on Total Votes the Stuff Received');
if(!defined('BUTTON_UPDATE'))
	define('BUTTON_UPDATE',$lang=='he' ? 'עדכן' : 'Update');
?>