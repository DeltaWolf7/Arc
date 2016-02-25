<?php

system\Helper::arcCheckSettingExists("ARC_TASKLASTRUN", date("y-m-d H:i:s"));
$lastrun = SystemSetting::getByKey("ARC_TASKLASTRUN");

$tasks = Task::getAll();

$day = date("d");
$month = date("m");
$year = date("y");
$hour = date("H");
$minute = date("i");

foreach ($tasks as $task) {
    if ($task->enabled == "1") {

        $data = $task->getArrayFromJson();
        $when = explode("-", $data["when"]);

        switch ($data["type"]) {
            case "once":
                if ($when[0] == $hour && $when[1] == $minute && $when[2] == $day && $when[3] == $month && $when[4] == $year) {
                    post($data["url"], $data["parameters"]);
                    $task->enabled = false;
                    $task->update();
                    Log::createLog("info", "taskengine", "Task ran once: " . $task->name);
                }
                break;
            case "repeat":
                if ($when[2] == "*" || $when[2] == $day) {
                    if ($when[3] == "*" || $when[3] == $month) {
                        if ($when[0] == "*" || $when[0] == $hour) {
                            if ($when[1] == "*" || $when[1] == $minute) {
                                post($data["url"], $data["parameters"]);
                                Log::createLog("info", "taskengine", "Task ran repeat: " . $task->name);
                            }
                        }
                    }
                }
                break;
        }
    }
}

function post($url, $parameters) {
    //$myvars = 'myvar1=' . $myvar1 . '&myvar2=' . $myvar2;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    echo curl_exec($ch);
}
