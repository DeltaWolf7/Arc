<?php

system\Helper::arcCheckSettingExists("ARC_BLOG_TITLE", "Latest News");
system\Helper::arcCheckSettingExists("ARC_BLOG_MENU_TITLE", "Blog");
system\Helper::arcCheckSettingExists("ARC_BLOG_CHAR_LIMIT", "600");
system\Helper::arcCheckSettingExists("ARC_BLOG_NOLATEST", "10");
system\Helper::arcCheckSettingExists("ARC_BLOG_ENTRIES_PER_PAGE", "10");

$menutitle = SystemSetting::getByKey("ARC_BLOG_MENU_TITLE");

system\Helper::arcAddMenuItem($menutitle->value, "fa-newspaper-o", false, null, null);