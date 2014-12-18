<?php

$module_info["name"] = "Arc Page Module";
$module_info["description"] = "Arc core module for page display.";
$module_info["version"] = ARCVERSION;
$module_info["author"] = "Craig Longford";
$module_info["email"] = "deltawolf7@gmail.com";
$module_info["www"] = "http://www.deltasblog.co.uk";
$module_info["system"] = true;

$pages = Page::getAllPages();
foreach ($pages as $page) {
    if (ARCDEFAULTMODULE == "page" && ARCDEFAULTACTION != $page->seourl) {
        system\Helper::arcAddMenuItem($page->title, "fa-file-o", false, system\Helper::arcGetPath() . "page/" . $page->seourl, "Pages");
    }
}