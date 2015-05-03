<?php

system\Helper::arcCheckSettingExists("ARC_PAGE_MENU_NAME", "pages");

$pages = Page::getAllPages();
foreach ($pages as $page) {
    if (ARCDEFAULTMODULE == "page" && ARCDEFAULTACTION == $page->seourl)
        continue;
    system\Helper::arcAddMenuItem($page->title, "fa-file-o", false, system\Helper::arcGetPath() . "page/{$page->seourl}", $setting->value);
}