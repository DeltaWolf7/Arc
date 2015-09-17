<?php

system\Helper::arcCheckSettingExists("ARC_PAGE_MENU_NAME", "Pages", "Pages");
$setting = SystemSetting::getByKey("ARC_PAGE_MENU_NAME");
$defaultModule = SystemSetting::getByKey("ARC_DEFAULT_MODULE");
$defaultAction = SystemSetting::getByKey("ARC_DEFAULT_ACTION");


$pages = Page::getAllPages();
foreach ($pages as $page) {
    if ($defaultModule->value == "page" && $defaultAction->value == $page->seourl || !isset($page->title))
        continue;
    system\Helper::arcAddMenuItem($page->title, "fa-file-o", false, system\Helper::arcGetPath() . "page/{$page->seourl}", $setting->value);
}