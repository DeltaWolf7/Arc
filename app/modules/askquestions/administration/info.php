<?php

$module_info["name"] = "Arc Questions Module";
$module_info["description"] = "Arc questions module";
$module_info["version"] = "0.0.0.1";
$module_info["author"] = "Craig Longford";
$module_info["email"] = "deltawolf7@gmail.com";
$module_info["www"] = "http://www.deltasblog.co.uk";
$module_info["system"] = true;

system\Helper::arcAddMenuItem("Question Editor", "fa-question", false, null, "Administration");