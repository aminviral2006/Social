<ul id="nav">
    <li><a href="index.php" title="Home"><?php echo MENU_HOME; ?></a></li>
    <li><a href="SiteConfiguration.php?task=edit" title="Site Configuration"><?php echo MENU_SITE_CONFIGURATION; ?></a></li>
    <li><a href="DisplayMembers.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnAdminMemberPage']; ?>" title="Members"><?php echo MENU_MEMBERS; ?></a>
      <ul>
	    <li><a href="DisplayMembers.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnAdminMemberPage']; ?>" title="Display Members"><?php echo MENU_DISPLAY_MEMBERS; ?></a></li>
	    <li><a href="SearchMember.php" title="Search Members"><?php echo MENU_SEARCH_MEMBERS; ?></a></li>
	    <li><a href="SendMessageToAllMembers.php" title="Message to All"><?php echo MENU_MESSAGE_TO_ALL; ?></a></li>
      </ul>
    </li>
    <li><a href="DisplayTags.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnAdminTopicsPage']; ?>" title="Tag"><?php echo MENU_TAG; ?></a>
	<ul>
	    <li><a href="DisplayTags.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnAdminTopicsPage']; ?>" title="Display Tags"><?php echo MENU_DISPLAY_TAG; ?></a></li>
	    <li><a href="AddTag.php" title="Add Tag"><?php echo MENU_ADD_TAG; ?></a></li>
	</ul>
    </li>
    <li><a href="DisplayCategories.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnAdminCategoryPage']; ?>" title="Category"><?php echo MENU_CATEGORY; ?></a>
	<ul>
	    <li><a href="DisplayCategories.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnAdminCategoryPage']; ?>" title="Display Categories"><?php echo MENU_DISPLAY_CATEGORY; ?></a></li>
	    <li><a href="SearchCategory.php" title="Search Category"><?php echo MENU_SEARCH_CATEGORY; ?></a></li>
	</ul>
    </li>
    <li><a href="DisplayStuffs.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnAdminStuffPage']; ?>" title="Stuffs"><?php echo MENU_STUFFS; ?></a>
	<ul>
	    <li><a href="DisplayStuffs.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnAdminStuffPage']; ?>" title="Display Stuffs"><?php echo MENU_DISPLAY_STUFFS; ?></a></li>
	    <li><a href="SearchStuff.php" title="Search Stuffs"><?php echo MENU_SEARCH_STUFFS; ?></a></li>
	</ul>
    </li>
    <li><a href="DisplayReportViolation.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnAdminStuffPage']; ?>" title="Report Violation"><?php echo MENU_REPORT_VIOLATION; ?></a>
	<ul>
	    <li><a href="DisplayReportViolation.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnAdminStuffPage']; ?>" title="Unhandled Report Violation"><?php echo MENU_UNHANDLED_REPORT_VIOLATION; ?></a></li>
	    <li><a href="DisplayHandledViolation.php?page=1&ipp=<?php echo $_SESSION['TotalRecordsOnAdminStuffPage']; ?>" title="Handled Report Violation"><?php echo MENU_HANDLED_REPORT_VIOLATION; ?></a></li>
	</ul>
    </li>
    <li><a href="MemberNewsLetter.php" title="News Letter"><?php echo MENU_NEWS_LETTER; ?></a>
	<ul>
	    <li><a href="MemberNewsLetter.php" title="Send News Letter"><?php echo MENU_SEND_NEWS_LETTER; ?></a></li>
	    <li><a href="#" title="Send Site Announcements"><?php echo MENU_SEND_SITE_ANNOUNCEMENT; ?></a></li>
	</ul>
    </li>
</ul>


<!-- AdminHome.php 's menu code
<ul id="nav">
    <li><a href="index.php">Home</a></li>
    <li><a href="SiteConfiguration.php?task=edit">Site Configuration</a></li>
    <li><a href="DisplayMembers.php?page=1&ipp=<?php //echo $_SESSION['TotalRecordsOnAdminMemberPage']; ?>" title="Members"></a>
      <ul>
	    <li><a href="DisplayMembers.php?page=1&ipp=<?php //echo $_SESSION['TotalRecordsOnAdminMemberPage']; ?>">Display Members</a></li>
	    <li><a href="SearchMember.php">Search Members</a></li>
	    <li><a href="SendMessageToAllMembers.php">Message to All</a></li>
      </ul>
    </li>
    <li><a href="DisplayTags.php?page=1&ipp=<?php //echo $_SESSION['TotalRecordsOnAdminTopicsPage']; ?>">Tag</a>
	<ul>
	    <li><a href="DisplayTags.php?page=1&ipp=<?php //echo $_SESSION['TotalRecordsOnAdminTopicsPage']; ?>">Display Tags</a></li>
	    <li><a href="AddTag.php">Add Tag</a></li>
	</ul>
    </li>
    <li><a href="DisplayCategories.php?page=1&ipp=<?php //echo $_SESSION['TotalRecordsOnAdminCategoryPage']; ?>">Category</a>
	<ul>
	    <li><a href="DisplayCategories.php?page=1&ipp=<?php //echo $_SESSION['TotalRecordsOnAdminCategoryPage']; ?>">Display Categories</a></li>
	    <li><a href="SearchCategory.php">Search Category</a></li>
	</ul>
    </li>
    <li><a href="DisplayStuffs.php?page=1&ipp=<?php //echo $_SESSION['TotalRecordsOnAdminStuffPage']; ?>">Stuffs</a>
	<ul>
	    <li><a href="DisplayStuffs.php?page=1&ipp=<?php //echo $_SESSION['TotalRecordsOnAdminStuffPage']; ?>">Display Stuffs</a></li>
	    <li><a href="SearchStuff.php">Search Stuffs</a></li>
	</ul>
    </li>
    <li><a href="DisplayReportViolation.php?page=1&ipp=<?php //echo $_SESSION['TotalRecordsOnAdminStuffPage']; ?>">Report Violation</a>
	<ul>
	    <li><a href="DisplayReportViolation.php?page=1&ipp=<?php //echo $_SESSION['TotalRecordsOnAdminStuffPage']; ?>">Unhandled Report Violation</a></li>
	    <li><a href="DisplayHandledViolation.php?page=1&ipp=<?php //echo $_SESSION['TotalRecordsOnAdminStuffPage']; ?>">Handled Report Violation</a></li>
	</ul>
    </li>
    <li><a href="MemberNewsLetter.php">News Letter</a>
	<ul>
	    <li><a href="MemberNewsLetter.php">Send News Letter</a></li>
	    <li><a href="#">Send Site Announcement</a></li>
	</ul>
    </li>
</ul>
-->