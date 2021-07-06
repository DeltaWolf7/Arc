<?php

    // CLEAR LOGS
    // Get number of days to keep setting
    $days = SystemSetting::getByKey("ARC_KEEP_LOGS");
    // Delete logs older than the number of kept days    
    if ($days->value != "") {
        system\Helper::arcGetDatabase()->query("delete from " . $log->table . " where datediff(now(), " . $log->table . ".event) > " . $days->value);
        Log::createLog("success", "CRON", "Purged logs older than " . $days->value);
    }