<?php

$module_info["system"] = true;

system\Helper::arcAddMenuItem("Users", "fa-users", false, system\Helper::arcGetPath() . "user/administration/users", "Administration");