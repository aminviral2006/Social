<?php
if(!isset($_SESSION['lang']))
    $_SESSION['lang'] = "en";

$lang = $_SESSION['lang'];
if(!defined('LOGIN')) define('LOGIN','Login');
if(!defined('NOT_A_MEMBER'))
    define('NOT_A_MEMBER','Not a Member');
if(!defined('SIGN_UP'))
    define('SIGN_UP','SignUp');

//Translations for Menubar
if(!defined('MENU_HOME')) 
    define('MENU_HOME',$lang=="en"?'Home':"Home");
    if(!defined('MENU_SITE_CONFIGURATION'))
	define('MENU_SITE_CONFIGURATION',$lang=="en"? 'Site Configuration' : 'Site Configurations');
    if(!defined('MENU_MEMBERS'))
	define('MENU_MEMBERS',$lang=="en"? 'Members' : 'Members');
    if(!defined('MENU_DISPLAY_MEMBERS'))
	define('MENU_DISPLAY_MEMBERS',$lang=="en"? 'Display Members' : 'Display Members');
    if(!defined('MENU_SEARCH_MEMBERS'))
	define('MENU_SEARCH_MEMBERS',$lang=="en"? 'Search Members' : 'Search Members');
    if(!defined('MENU_MESSAGE_TO_ALL'))
	define('MENU_MESSAGE_TO_ALL',$lang=="en"? 'Message to All' : 'Message to All');

if(!defined('MENU_TAG'))
    define('MENU_TAG',$lang=="en"? 'Tag' : 'Tag');
    if(!defined('MENU_DISPLAY_TAG'))
	define('MENU_DISPLAY_TAG',$lang=="en"? 'Display Tag' : 'Display Tag');
    if(!defined('MENU_ADD_TAG'))
	define('MENU_ADD_TAG',$lang=="en"? 'Add Tag' : 'Add Tag');
    
if(!defined('MENU_CATEGORY'))
    define('MENU_CATEGORY',$lang=="en"? 'Category' : 'Category');
    if(!defined('MENU_DISPLAY_CATEGORY'))
	define('MENU_DISPLAY_CATEGORY',$lang=="en"? 'Display Category' : 'Display Category');
    if(!defined('MENU_SEARCH_CATEGORY'))
	define('MENU_SEARCH_CATEGORY',$lang=="en"? 'Search Category' : 'Search Category');

if(!defined('MENU_STUFFS'))
    define('MENU_STUFFS',$lang=="en"? 'Stuffs' : 'Stuffs');
    if(!defined('MENU_DISPLAY_STUFFS'))
	define('MENU_DISPLAY_STUFFS',$lang=="en"? 'Display Stuffs' : 'Display Stuffs');
    if(!defined('MENU_SEARCH_STUFFS'))
	define('MENU_SEARCH_STUFFS',$lang=="en"? 'Search Stuffs' : 'Search Stuffs');

if(!defined('MENU_REPORT_VIOLATION'))
    define('MENU_REPORT_VIOLATION',$lang=="en"? 'Report Violation' : 'Report Violation');
    if(!defined('MENU_UNHANDLED_REPORT_VIOLATION'))
	define('MENU_UNHANDLED_REPORT_VIOLATION',$lang=="en"? 'Unhandled Report Violation' : 'Unhandled Report Violation');
    if(!defined('MENU_HANDLED_REPORT_VIOLATION'))
	define('MENU_HANDLED_REPORT_VIOLATION',$lang=="en"? 'Handled Report Violation' : 'Handled Report Violation');

if(!defined('MENU_NEWS_LETTER'))
    define('MENU_NEWS_LETTER',$lang=="en"? 'News Letter' : 'News Letter');
    if(!defined('MENU_SEND_NEWS_LETTER'))
	define('MENU_SEND_NEWS_LETTER',$lang=="en"? 'Send News Letter' : 'Send News Letter');
    if(!defined('MENU_SEND_SITE_ANNOUNCEMENT'))
	define('MENU_SEND_SITE_ANNOUNCEMENT',$lang=="en"? 'Send Site Announcement' : 'Send Site Announcement');

if(!defined('HOME')) define('HOME','HOME');
if(!defined('FAQ')) define('FAQ','Faq');
if(!defined('ABOUT_US')) define('ABOUT_US','About Us');
if(!defined('PRIVACY_POLICY')) define('PRAVACY_POLICY','Privacy Policy');
if(!defined('TERMS_AND_CONDITIONS')) define('TERMS_AND_CONDITIONS','Terms &amp; Conditions');
if(!defined('CONTACT_US')) define('CONTACT_US','Contact Us');
if(!defined('RSS_FEED')) define('RSS_FEED','Rss Feed');

if(!defined('NEW_STUFFS')) define('NEW_STUFFS','New Stuff');
if(!defined('NEW_CATEGORIES')) define('NEW_CATEGORIES','New Category');
if(!defined('MORE_NEW_STUFFS')) define('MORE_NEW_STUFFS','More New Stuffs...');
if(!defined('MORE_TAGS')) define('MORE_TAGS','More Tags...');

if(!defined('LAST_LOGGED_IN')) define('LAST_LOGGED_IN','Last logged in');
if(!defined('LOGGED_IN_NOW')) define('LOGGED_IN_NOW','Logged in now');
if(!defined('ACTIVE_MEMBERS')) define('ACTIVE_MEMBERS','Active Members');

//Administrator Home Page Translation
if(!defined('MEMBER_ZONE')) 
    define('MEMBER_ZONE',$lang=='en' ? 'Member Zone' : 'Member Zone');
if(!defined('TOTAL_MEMBERS')) 
    define('TOTAL_MEMBERS',$lang=='en' ? 'Total Members' : 'Total Members');
if(!defined('PENDING_MEMBERS')) 
    define('PENDING_MEMBERS',$lang=='en' ? 'Pending Members' : 'Pending Members');
if(!defined('CURRENT_ACTIVE_MEMBERS')) 
    define('CURRENT_ACTIVE_MEMBERS',$lang=='en' ? 'Active Members' : 'Active Members');
if(!defined('IN_ACTIVE_MEMBERS')) 
    define('IN_ACTIVE_MEMBERS',$lang=='en' ? 'In-Active Members' : 'In-Active Members');
if(!defined('BLOCKED_MEMBERS')) 
    define('BLOCKED_MEMBERS',$lang=='en' ? 'Blocked Members' : 'Blocked Members');
if(!defined('TRUSTED_MEMBERS')) 
    define('TRUSTED_MEMBERS',$lang=='en' ? 'Trusted Members' : 'Trusted Members');

if(!defined('TOP_MEMBERS')) 
    define('TOP_MEMBERS',$lang=='en' ? 'Top Members' : 'Top Members');
if(!defined('MEMBER_NAME'))
    define('MEMBER_NAME',$lang=='en' ? 'Member Name' : 'Member Name');
if(!defined('STUFFS_CREATED'))
    define('STUFFS_CREATED',$lang=='en' ? 'Stuffs Created' : 'Stuffs Created');

if(!defined('CATEGORY_ZONE')) 
    define('CATEGORY_ZONE',$lang=='en' ? 'Category Zone' : 'Category Zone');
if(!defined('TOTAL_CATEGORIES')) 
    define('TOTAL_CATEGORIES',$lang=='en' ? 'Total Categories' : 'Total Categories');
if(!defined('ACTIVE_CATEGORIES')) 
    define('ACTIVE_CATEGORIES',$lang=='en' ? 'Active Categories' : 'Active Categories');
if(!defined('IN_ACTIVE_CATEGORIES')) 
    define('IN_ACTIVE_CATEGORIES',$lang=='en' ? 'In-Active Categories' : 'In-Active Categories');

if(!defined('TOPIC_ZONE')) 
    define('TOPIC_ZONE',$lang=='en' ? 'Topic Zone' : 'Topic Zone');
if(!defined('TOTAL_TOPICS')) 
    define('TOTAL_TOPICS',$lang=='en' ? 'Total Topics' : 'Total Topics');
if(!defined('ACTIVE_TOPICS')) 
    define('ACTIVE_TOPICS',$lang=='en' ? 'Active Topics' : 'Active Topics');
if(!defined('IN_ACTIVE_TOPICS')) 
    define('IN_ACTIVE_TOPICS',$lang=='en' ? 'In-Active Topics' : 'In-Active Topics');

if(!defined('STUFFS_ZONE')) 
    define('STUFFS_ZONE',$lang=='en' ? 'Stuffs Zone':'Stuffs Zone');
if(!defined('TOTAL_STUFFS')) 
    define('TOTAL_STUFFS',$lang=='en' ? 'Total Stuffs' : 'Total Stuffs');
if(!defined('ACTIVE_STUFFS')) 
    define('ACTIVE_STUFFS',$lang=='en' ?  'Active Stuffs' : 'Active Stuffs');
if(!defined('IN_ACTIVE_STUFFS')) 
    define('IN_ACTIVE_STUFFS',$lang=='en' ? 'In-Active Stuffs' : 'In-Active Stuffs');
if(!defined('LOCKED_STUFFS')) 
    define('LOCKED_STUFFS',$lang=='en' ? 'Locked Stuffs' : 'Locked Stuffs');

//Site Configuration Page
if(!defined('SITE_CONFIG_GUEST_USER_SIDE'))
    define('SITE_CONFIG_GUEST_USER_SIDE',$lang=='en' ? 'Guest User Side Configuration' : 'Guest User Side Configuration');
    if(!defined('NO_OF_STUFFS_ON_HOME_PAGE'))
	define('NO_OF_STUFFS_ON_HOME_PAGE',$lang=='en' ? 'No. of Stuffs Shown on Home Page' : 'No. of Stuffs Shown on Home Page');
    if(!defined('NO_OF_CATEGORIES_ON_HOME_PAGE'))
	define('NO_OF_CATEGORIES_ON_HOME_PAGE',$lang=='en' ? 'No. of Categories Shown on Home Page' : 'No. of Categories Shown on Home Page');
    if(!defined('NO_OF_RANDOM_STUFFS_ON_HOME_PAGE'))
	define('NO_OF_RANDOM_STUFFS_ON_HOME_PAGE',$lang=='en' ? 'No. of Random Stuffs Shown on Home Page' : 'No. of Random Stuffs Shown on Home Page');
    if(!defined('NO_OF_STUFFS_ON_BROSE_STUFF_PAGE'))
	define('NO_OF_STUFFS_ON_BROSE_STUFF_PAGE',$lang=='en' ? 'No. of Stuffs on Browse Stuff Page' : 'No. of Stuffs on Browse Stuff Page');
    if(!defined('NO_OF_STUFFS_ON_BROSE_SEARCH_STUFF_PAGE'))
	define('NO_OF_STUFFS_ON_BROSE_SEARCH_STUFF_PAGE',$lang=='en' ? 'No. of Stuffs on Browse Search Stuff Page' : 'No. of Stuffs on Browse Search Stuff Page');
    if(!defined('NO_OF_STUFFS_ON_BROSE_CATEGORY_PAGE'))
	define('NO_OF_STUFFS_ON_BROSE_CATEGORY_PAGE',$lang=='en' ? 'No. of Stuffs on Browse Category Page' : 'No. of Stuffs on Browse Category Page');
    if(!defined('NO_OF_RELATED_CATEGORY_STUFF_LIST_PAGE'))
	define('NO_OF_RELATED_CATEGORY_STUFF_LIST_PAGE',$lang=='en' ? 'No. of Related Category Records on Stuff List Page(s)' : 'No. of Related Category Records on Stuff List Page(s)');

if(!defined('SITE_CONFIG_ADMINISTRATOR_SIDE'))
    define('SITE_CONFIG_ADMINISTRATOR_SIDE',$lang=='en' ? 'Administrator Side' : 'Administrator Side');
    if(!defined('NO_OF_RECORDS_ON_MEMBER_PAGE'))
	define('NO_OF_RECORDS_ON_MEMBER_PAGE',$lang=='en' ? 'No. of Records on Members Page' : 'No. of Records on Members Page');
    if(!defined('NO_OF_RECORDS_ON_TOPICS_PAGE'))
	define('NO_OF_RECORDS_ON_TOPICS_PAGE',$lang=='en' ? 'No. of Records on Topics Page' : 'No. of Records on Topics Page');
    if(!defined('NO_OF_RECORDS_ON_CATEGORY_PAGE'))
	define('NO_OF_RECORDS_ON_CATEGORY_PAGE',$lang=='en' ? 'No. of Records on Category Page' : 'No. of Records on Category Page');
    if(!defined('NO_OF_RECORDS_ON_STUFFS_PAGE'))
	define('NO_OF_RECORDS_ON_STUFFS_PAGE',$lang=='en' ? 'No. of Records on Stuff Page' : 'No. of Records on Stuff Page');
    if(!defined('NO_OF_RECORDS_ON_MEMBER_SEARCH_PAGE'))
	define('NO_OF_RECORDS_ON_MEMBER_SEARCH_PAGE',$lang=='en' ? 'No. of Records on Member Search Page' : 'No. of Records on Member Search Page');

if(!defined('SITE_CONFIG_TRUSTED_MEMBER_SIDE'))
    define('SITE_CONFIG_TRUSTED_MEMBER_SIDE',$lang=='en' ? 'Trusted Member Side' : 'Trusted Member Side');
    if(!defined('NO_OF_RECORDS_ON_CATEGORY_PAGE_TRUSTED'))
	define('NO_OF_RECORDS_ON_CATEGORY_PAGE_TRUSTED',$lang=='en' ? 'No. of Records on Category Page' : 'No. of Records on Category Page');
    if(!defined('NO_OF_RECORDS_ON_STUFFS_PAGE_TRUSTED'))
	define('NO_OF_RECORDS_ON_STUFFS_PAGE_TRUSTED',$lang=='en' ? 'No. of Records on Stuff Page' : 'No. of Records on Stuff Page');

if(!defined('SITE_CONFIG_MEMBER_PROFIDE_SIDE'))
    define('SITE_CONFIG_MEMBER_PROFIDE_SIDE',$lang=='en' ? 'Member Profile Side' : 'Member Profile Side');
    if(!defined('NO_OF_STUFFS_ON_MEMBER_PROFILE_SUB_PAGE'))
	define('NO_OF_STUFFS_ON_MEMBER_PROFILE_SUB_PAGE',$lang=='en' ? 'No. of Stuff Records on Member Profile Sub Page' : 'No. of Stuff Records on Member Profile Sub Page');
    if(!defined('NO_OF_COMMENTS_ON_MEMBER_PROFILE_SUB_PAGE'))
	define('NO_OF_COMMENTS_ON_MEMBER_PROFILE_SUB_PAGE',$lang=='en' ? 'No. of Comments on Member Profile Sub Page' : 'No. of Comments on Member Profile Sub Page');
    if(!defined('NO_OF_INNER_STUFFS_ON_MEMBER_PROFILE_SUB_PAGE'))
	define('NO_OF_INNER_STUFFS_ON_MEMBER_PROFILE_SUB_PAGE',$lang=='en' ? 'No. of Inner Stuff Records on Member Profile Main Page' : 'No. of Inner Stuff Records on Member Profile Main Page');
    if(!defined('NO_OF_INNER_COMMENTS_ON_MEMBER_PROFILE_SUB_PAGE'))
	define('NO_OF_INNER_COMMENTS_ON_MEMBER_PROFILE_SUB_PAGE',$lang=='en' ? 'No. of Inner Comment Records on Member Profile Main Page' : 'No. of Inner Comment Records on Member Profile Main Page');
    if(!defined('NO_OF_INNER_FRIENDS_ON_MEMBER_PROFILE_SUB_PAGE'))
	define('NO_OF_INNER_FRIENDS_ON_MEMBER_PROFILE_SUB_PAGE',$lang=='en' ? 'No. of Inner Friends Records on Member Profile Main Page' : 'No. of Inner Friends Records on Member Profile Main Page');
    if(!defined('NO_OF_STUFFS_ON_COLLEGE_PAGE'))
	define('NO_OF_STUFFS_ON_COLLEGE_PAGE',$lang=='en' ? 'Show Stuff on Collage Page based on Total Votes the Stuff Received' : 'Show Stuff on Collage Page based on Total Votes the Stuff Received');
if(!defined('BUTTON_UPDATE'))
	define('BUTTON_UPDATE',$lang=='en' ? 'Update' : 'Update');
?>