<?php

if (system\Helper::arcIsAjaxRequest()) {
    BoardViewItem::checkLifespans();
    $items = BoardViewItem::getItems();

    $html = "<div class=\"card-columns\">";

    foreach ($items as $item) {
        $html .= "<div class=\"card\">";

        // image
        if (!empty($item->image)) {
            $html .= "<img class=\"card-img-top img-fluid\" src=\"{$item->image}\" alt=\"{$item->title}\">";
        }
        $html .= "<div class=\"card-block\">";
        // title
        if (!empty($item->title)) {
            $html .= "<h4 class=\"card-title\">{$item->title}</h4>";
        }
        // subtitle
        if (!empty($item->subtitle)) {
            $html .= "<h6 class=\"card-subtitle mb-2 text-muted\">{$item->subtitle}</h6>";
        }
        // description
        if (!empty($item->description)) {
            $html .= "<p class=\"card-text\">{$item->description}</p>";
        }
        // links
        if (!empty($item->links)) {
            $links = explode(",", $item->links);
            foreach ($links as $link) {
                $data = explode("|", $link);
                $html .= "<a href=\"{$data[0]}\" class=\"card-link\">{$data[1]}</a>";
            }
        }

        // end card block
        $html .= "</div>";

        // life span
        $life = (int)$item->getLifespan();
        if ($life != -1) {
            $time = secondsToTime($life);
            $html .= "<div class=\"card-footer\"><small class=\"text-muted\">Expires in {$time}</small></div>";
        }
        
        $html .= "</div>";
    }
    $html .= "</div>";

    system\Helper::arcReturnJSON(["html" => $html]);
}


/**
 * Convert number of seconds into hours, minutes and seconds
 * and return an array containing those values
 *
 * @param integer $inputSeconds Number of seconds to parse
 * @return string
 */

function secondsToTime($inputSeconds)
{

    $secondsInAMinute = 60;
    $secondsInAnHour  = 60 * $secondsInAMinute;
    $secondsInADay    = 24 * $secondsInAnHour;

    // extract days
    $days = floor($inputSeconds / $secondsInADay);

    // extract hours
    $hourSeconds = $inputSeconds % $secondsInADay;
    $hours = floor($hourSeconds / $secondsInAnHour);

    // extract minutes
    $minuteSeconds = $hourSeconds % $secondsInAnHour;
    $minutes = floor($minuteSeconds / $secondsInAMinute);

    // extract the remaining seconds
    $remainingSeconds = $minuteSeconds % $secondsInAMinute;
    $seconds = ceil($remainingSeconds);

    // return the final array
    $obj = array(
        'd' => (int) $days,
        'h' => (int) $hours,
        'm' => (int) $minutes,
        's' => (int) $seconds,
    );
    
    $expires = "";
    if ($obj["d"] > 0) {
        $expires .= $obj["d"];
        if ($obj["d"] > 1) {
            $expires .= " days ";
        } else {
            $expires .= " day ";
        }
    }
    if ($obj["h"] > 0) {
        $expires .= $obj["h"];
        if ($obj["h"] > 1) {
            $expires .= " hours ";
        } else {
            $expires .= " hour ";
        }
    }
    if ($obj["m"] > 0) {
        $expires .= $obj["m"];
        if ($obj["m"] > 1) {
            $expires .= " minutes ";
        } else {
            $expires .= " minute ";
        }
    }
    if ($obj["s"] > 0) {
        $expires .= $obj["s"];
        if ($obj["s"] > 1) {
            $expires .= " seconds ";
        } else {
            $expires .= " second ";
        }
    }
    return $expires;
}
