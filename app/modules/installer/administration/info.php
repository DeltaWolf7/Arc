<?php

$module_info["name"] = "Arc Module Installer";
$module_info["description"] = "Arc core module for installing modules.";
$module_info["version"] = ARCVERSION;
$module_info["author"] = "Craig Longford";
$module_info["email"] = "deltawolf7@gmail.com";
$module_info["www"] = "http://www.deltasblog.co.uk";
$module_info["system"] = true;

arcAddMenuItem("Installer", "fa-cube", false, null, "Administration");

?>