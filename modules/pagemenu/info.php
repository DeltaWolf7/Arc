<?php

$module_info["name"] = "Arc Page Menu Module";
$module_info["description"] = "Arc core module for page menu display.";
$module_info["version"] = ARCVERSION;
$module_info["author"] = "Craig Longford";
$module_info["email"] = "deltawolf7@gmail.com";
$module_info["www"] = "http://www.deltasblog.co.uk";
$module_info["system"] = false;


$pages = Pages::getAllPages();
foreach ($pages as $page) {
    arcAddMenuItem($page->title, "fa-file-o", false, "/" . $page->seourl, "Pages");
}

?>

