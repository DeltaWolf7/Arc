<?php

system\Helper::arcCheckSettingExists("SKYPE_DISABLE_DAYS", "0,1", "Skype");
system\Helper::arcCheckSettingExists("SKYPE_DAYS_NOTICE", "2", "Skype");
system\Helper::arcCheckSettingExists("SKYPE_SESSION_LENGTH", "30", "Skype");
system\Helper::arcCheckSettingExists("SKYPE_BOOK_AHEAD", "14", "Skype");
system\Helper::arcCheckSettingExists("SKYPE_ALLOW_BOOOKING", "1", "Skype");

system\Helper::arcAddMenuItem("Book Skype Session", "fa-skype", false, null, "Applications");