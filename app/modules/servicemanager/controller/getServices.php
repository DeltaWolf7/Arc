<?php

if (system\Helper::arcIsAjaxRequest()) {

    $services = ServiceManagerItem::getAll();
    $html = "<table class=\"table table-striped\">";
    $html .= "<thead><tr><th>Type</th><th>Value</th><th>Created</th>"
            . "<th>Expires</th><th>Tags</th><th>Source</th></tr></thead>";
    $html .= "<tbody>";

    foreach ($services as $service) {
        $json = json_decode($service->data);
        $html .= "<tr><td>{$json->type}</td><td>{$json->value}</td><td>{$json->created}</td>"
                . "<td>{$json->expires}</td><td>{$json->tags}</td><td>{$json->source}</td></tr>";
    }

    $html .= "</tbody>";
    $html .= "</table>";

    system\Helper::arcReturnJSON(["html" => $html]);
}

