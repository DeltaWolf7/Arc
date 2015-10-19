<?php

system\Helper::arcCheckSettingExists("ARC_BLOG_TITLE", "Latest News", "Blog");
system\Helper::arcCheckSettingExists("ARC_BLOG_MENU_TITLE", "Blog", "Blog");
system\Helper::arcCheckSettingExists("ARC_BLOG_CHAR_LIMIT", "600", "Blog");
system\Helper::arcCheckSettingExists("ARC_BLOG_NOLATEST", "10", "Blog");
system\Helper::arcCheckSettingExists("ARC_BLOG_ENTRIES_PER_PAGE", "10", "Blog");

$menutitle = SystemSetting::getByKey("ARC_BLOG_MENU_TITLE");

system\Helper::arcAddMenuItem($menutitle->value, "fa-newspaper-o", false, null, null);