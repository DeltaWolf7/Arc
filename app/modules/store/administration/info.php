<?php

$module_info["name"] = "Arc Store Module";
$module_info["description"] = "Arc Module Providing Online Store.";
$module_info["version"] = ARCVERSION;
$module_info["author"] = "Craig Longford";
$module_info["email"] = "deltawolf7@gmail.com";
$module_info["www"] = "http://www.deltasblog.co.uk";
$module_info["system"] = false;

arcAddMenuItem("Store Manager", "fa-shopping-cart", false, null, "Administration");