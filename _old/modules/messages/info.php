<?php

$module_info["name"] = "Arc Message Module";
$module_info["description"] = "Arc core module providing user communication.";
$module_info["version"] = ARCVERSION;
$module_info["author"] = "Craig Longford";
$module_info["email"] = "deltawolf7@gmail.com";
$module_info["www"] = "http://www.deltasblog.co.uk";
$module_info["system"] = true;

arcAddMenuItem("Messages", "fa-envelope", false, null, "Account");

?>
