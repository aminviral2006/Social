<?php
//define('ROOT','http://localhost:7007/');
define('ROOT',$_SERVER['DOCUMENT_ROOT']."Avigabso/");
define('SITE_URL','http://social.kapdreamworld.com');
//define('ROOT',$_SERVER['DOCUMENT_ROOT']."/");
//General

include_once ROOT.'administrator/Classes/MySQLConnection.php';
include_once ROOT.'administrator/Classes/FileUploader.php';
include_once ROOT.'administrator/Classes/paginator.class.php';

//Business Logic Class
include_once ROOT.'administrator/BLL/BllTags.php';
include_once ROOT.'administrator/BLL/BllMemberRegistration.php';
include_once ROOT.'administrator/BLL/BllMemberProfile.php';
include_once ROOT.'administrator/BLL/BllCountry.php';
include_once ROOT.'administrator/BLL/BllPrivateMessage.php';
include_once ROOT.'administrator/BLL/BllStuff.php';
include_once ROOT.'administrator/BLL/BllCategory.php';
include_once ROOT.'administrator/BLL/BllMemberProfileControls.php';
include_once ROOT.'administrator/BLL/BllMemberProfileSiteControls.php';
include_once ROOT.'administrator/BLL/BllAddFriends.php';
include_once ROOT.'administrator/BLL/BllMemberComment.php';
include_once ROOT.'administrator/BLL/BllPeopleLike.php';
include_once ROOT.'administrator/BLL/BllSiteConfiguration.php';


//Business Objects/Property Class
include_once ROOT.'administrator/BO/BoTags.php';
include_once ROOT.'administrator/BO/BoMemberRegistration.php';
include_once ROOT.'administrator/BO/BoMemberProfile.php';
include_once ROOT.'administrator/BO/BoCountry.php';
include_once ROOT.'administrator/BO/BoPrivateMessage.php';
include_once ROOT.'administrator/BO/BoStuff.php';
include_once ROOT.'administrator/BO/BoCategory.php';
include_once ROOT.'administrator/BO/BoMemberProfileControls.php';
include_once ROOT.'administrator/BO/BoMemberProfileSiteControls.php';
include_once ROOT.'administrator/BO/BoAddFriends.php';
include_once ROOT.'administrator/BO/BoMemberComment.php';
include_once ROOT.'administrator/BO/BoSiteConfiguration.php';


//Presentation Layer/UI Class
include_once ROOT.'administrator/PL/PlTags.php';
include_once ROOT.'administrator/PL/PlMemberRegistration.php';
include_once ROOT.'administrator/PL/PlMemberProfile.php';
include_once ROOT.'administrator/PL/PlCountry.php';
include_once ROOT.'administrator/PL/PlPrivateMessage.php';
include_once ROOT.'administrator/PL/PlStuff.php';
include_once ROOT.'administrator/PL/PlCategory.php';
include_once ROOT.'administrator/PL/PlMemberProfileControls.php';
include_once ROOT.'administrator/PL/PlMemberProfileSiteControls.php';
include_once ROOT.'administrator/PL/PlAddFriends.php';
include_once ROOT.'administrator/PL/PlMemberComment.php';
include_once ROOT.'administrator/PL/PlPeopleLike.php';
include_once ROOT.'administrator/PL/PlSiteConfiguration.php';


//Translation Constants Section
include_once ROOT."TranslationConstants.php";
?>