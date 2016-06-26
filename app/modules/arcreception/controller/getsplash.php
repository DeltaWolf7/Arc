<?php

if (system\Helper::arcIsAjaxRequest()) {

    $html = "<div class=\"container splash\">"
            . "  <div class=\"row\">"
            . "    <div class=\"col-md-9\">"
            . "      <div class=\"time\"></div>"
            . "      <div class=\"date\"></div>"
            . "    </div>"
            . "  <div class=\"col-md-3 text-right\">"
            . "    <a class=\"btn btn-default animated pulse infinite signin\" onclick=\"getState('signin')\"><i class=\"fa fa-arrow-circle-right fa-4x\"></i></a>"
            . "  </div>"
            . "</div>"
            . "</div>"
            . "<footer class=\"footer\">"
            . "  <div class=\"container\">"
            . "   <div class=\"row\">"
            . "     <div class=\"col-md-6\"><a class=\"btn btn-default btn-lg\"><i class=\"fa fa-sign-out\"></i> Sign Out</a></div>"
            . "   </div>"
            . "  </div>"
            . "</footer>";
    system\Helper::arcReturnJSON(["html" => $html, "state" => "splash"]);
}
