<?php

system\Helper::arcAddMenuItem("System Settings", "fa-cog", false, null, "Administration");
system\Helper::arcAddMenuItem("Logs", "fa-file-text-o", false, system\Helper::arcGetPath() . "systemsettings/administration/logs", "Administration");