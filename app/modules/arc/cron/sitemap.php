<?php

Log::createLog("success", "CRON", "Rebuilding sitemap..");
$group = UserGroup::getByName("Guests");
$routes = Router::getByGroupID($group->id);

$sitemap = "";

foreach ($routes as $route) {
    if ($route->route != "error") {
        $sitemap .= system\Helper::arcGetPath() . $route->route . PHP_EOL;
        echo system\Helper::arcGetPath() . $route->route . "<br />";
    }
}

$map = fopen(system\Helper::arcGetPath(true) . "sitemap.txt", "w") or die("Unable to open file!");
fwrite($map, $sitemap);
fclose($map);

Log::createLog("success", "CRON", "Sitemap complete.");
