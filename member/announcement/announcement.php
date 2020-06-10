<?php
require_once "classes/announcement.class.php";
global $announcement;
$announcement = new AnnouncementObject();
add_menu( "announcement", "Announcement", "../announcement/admin/ViewAllAnnouncements&li_class=Announcement" );
?>





