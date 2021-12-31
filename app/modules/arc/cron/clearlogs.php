<?php

    // CLEAR LOGS
    // Get number of days to keep setting
    $days = SystemSetting::getByKey("ARC_KEEP_LOGS");
    // Delete logs older than the number of kept days    
    if ($days->value != "") {
        system\Helper::arcGetDatabase()->query("delete from arc_logs where datediff(now(), arc_logs.event) > " . $days->value);
        Log::createLog("success", "CRON", "Purged logs older than " . $days->value);
    }