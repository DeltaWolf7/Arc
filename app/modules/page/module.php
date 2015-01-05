<?php

$setting = SystemSetting::keyExists("ARC_PAGE_VIEW");
if (empty($setting->key)) {
    $setting = new SystemSetting();
    $setting->key = "ARC_PAGE_VIEW";
    $setting->update();
}

$pages = Page::getAllPages();
foreach ($pages as $page) {
    if (ARCDEFAULTMODULE == "page" && ARCDEFAULTACTION == $page->seourl)
        continue;
    system\Helper::arcAddMenuItem($page->title, "fa-file-o", false, system\Helper::arcGetPath() . "page/" . $page->seourl, $setting->value);
}