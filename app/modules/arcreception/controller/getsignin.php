<?php

if (system\Helper::arcIsAjaxRequest()) {

    $html = "<div class=\"container\">"
            . "  <div class=\"row\">"
            . "  <div class=\"col-md-12 text-center\">"
            . "  <h1>Please identify yourself</h1>"
            . "  </div>"
            . "  <div class=\"col-md-12\">";

    $events = ArcRecEvent::getTodaysEvents();
    $guests = array();
    foreach ($events as $event) {
        $guestList = $event->getGuests();
        $guests = array_merge($guests, $guestList);
    }

    foreach ($guests as $guest) {
        $html .= "<div class=\"col-md-3\">"
                . " <a class=\"btn btn-default\" onclick=\"getEvents('{$guest->id}')\">"
                . "        <div class=\"row\">"
                . "            <div class=\"col-md-3\">";


        if (!empty($guest->image)) {
            $html .= "<img style=\"height: 50px;\" src=\"{$guest->image}\" />";
        } else {
            $html .= "<i class=\"fa fa-user fa-4x\"></i>";
        }

        $html .= "            </div>"
                . "            <div class=\"col-md-9\">"
                . "                <div class=\"row\">"
                . "                    <div class=\"col-md-12 text-left\">{$guest->name}</div>"
                . "                </div>"
                . "                <div class=\"row\">"
                . "                    <div class=\"col-md-12 text-left\">{$guest->company}</div>"
                . "                </div>"
                . "            </div>"
                . "        </div>"
                . "</a>"
                . "</div>";
    }

    $html.= "  </div>"
            . "</div>"
            . "</div>"
            . "<footer class=\"footer\">"
            . "  <div class=\"container\">"
            . "   <div class=\"row\">"
            . "     <div class=\"col-md-6\"><a class=\"btn btn-default btn-lg\" onclick=\"getState('splash')\"><i class=\"fa fa-arrow-left\"></i> Back</a></div>"
            . "   </div>"
            . "  </div>"
            . "</footer>";
    system\Helper::arcReturnJSON(["html" => $html, "state" => "signin"]);
}
