<?php
//define('ROOT','http://localhost:7007/');
define('ROOT',$_SERVER['DOCUMENT_ROOT']."Avigabso/");
//define('ROOT',$_SERVER['DOCUMENT_ROOT']."/");
//General
include_once ROOT.'Administrator/Classes/MySQLConnection.php';
include_once ROOT.'Administrator/Classes/FileUploader.php';
include_once ROOT.'Administrator/Classes/paginator.class.php';

//Business Logic Class
include_once ROOT.'Administrator/BLL/BllTags.php';
include_once ROOT.'Administrator/BLL/BllMemberRegistration.php';
include_once ROOT.'Administrator/BLL/BllMemberProfile.php';
include_once ROOT.'Administrator/BLL/BllCountry.php';
include_once ROOT.'Administrator/BLL/BllPrivateMessage.php';
include_once ROOT.'Administrator/BLL/BllStuff.php';
include_once ROOT.'Administrator/BLL/BllCategory.php';
include_once ROOT.'Administrator/BLL/BllMemberProfileControls.php';
include_once ROOT.'Administrator/BLL/BllMemberProfileSiteControls.php';
include_once ROOT.'Administrator/BLL/BllAddFriends.php';
include_once ROOT.'Administrator/BLL/BllMemberComment.php';
include_once ROOT.'Administrator/BLL/BllPeopleLike.php';
include_once ROOT.'Administrator/BLL/BllSiteConfiguration.php';


//Business Objects/Property Class
include_once ROOT.'Administrator/BO/BoTags.php';
include_once ROOT.'Administrator/BO/BoMemberRegistration.php';
include_once ROOT.'Administrator/BO/BoMemberProfile.php';
include_once ROOT.'Administrator/BO/BoCountry.php';
include_once ROOT.'Administrator/BO/BoPrivateMessage.php';
include_once ROOT.'Administrator/BO/BoStuff.php';
include_once ROOT.'Administrator/BO/BoCategory.php';
include_once ROOT.'Administrator/BO/BoMemberProfileControls.php';
include_once ROOT.'Administrator/BO/BoMemberProfileSiteControls.php';
include_once ROOT.'Administrator/BO/BoAddFriends.php';
include_once ROOT.'Administrator/BO/BoMemberComment.php';
include_once ROOT.'Administrator/BO/BoSiteConfiguration.php';


//Presentation Layer/UI Class
include_once ROOT.'Administrator/PL/PlTags.php';
include_once ROOT.'Administrator/PL/PlMemberRegistration.php';
include_once ROOT.'Administrator/PL/PlMemberProfile.php';
include_once ROOT.'Administrator/PL/PlCountry.php';
include_once ROOT.'Administrator/PL/PlPrivateMessage.php';
include_once ROOT.'Administrator/PL/PlStuff.php';
include_once ROOT.'Administrator/PL/PlCategory.php';
include_once ROOT.'Administrator/PL/PlMemberProfileControls.php';
include_once ROOT.'Administrator/PL/PlMemberProfileSiteControls.php';
include_once ROOT.'Administrator/PL/PlAddFriends.php';
include_once ROOT.'Administrator/PL/PlMemberComment.php';
include_once ROOT.'Administrator/PL/PlPeopleLike.php';
include_once ROOT.'Administrator/PL/PlSiteConfiguration.php';
?>