<?php

if (system\Helper::arcIsAjaxRequest()) {

    $services = ServiceManagerItem::getAll();
    $html = "<table class=\"table table-striped\">";
    $html .= "<thead><tr><th>Type</th><th>Value</th><th>Created</th>"
            . "<th>Expires</th><th>Tags</th><th>Source</th><th></th></tr></thead>";
    $html .= "<tbody>";

    foreach ($services as $service) {
        $json = json_decode($service->data);
        $html .= "<tr><td>";

        switch ($json->type) {
            case "domain":
                $html .= "<i class=\"fa fa-globe\"></i> Domain";
                break;
            case "ssl":
                $html .= "<i class=\"fa fa-certificate\"></i> SSL";
                break;
            default:
                $html .= "<i class=\"fa fa-certificate\"></i> Unknown";
                break;
        }

        $html .= "</td><td><a href=\"http://{$json->value}\" target=\"_new\">{$json->value}</a> <i class=\"fa fa-external-link\"></i></td><td>{$json->created}</td>"
                . "<td>{$json->expires}</td><td>";

        $tags = explode(",", $json->tags);
        foreach ($tags as $tag) {
            $html .= "<i class=\"label label-default\">{$tag}</i> ";
        }

        $html .= "</td><td>{$json->source}</td>"
                . "<td class=\"text-right\"><a class=\"btn btn-default btn-xs\" onclick=\"edit({$service->id})\">"
                . "<i class=\"fa fa-pencil\"></i> Edit</a></td></tr>";
    }

    $html .= "</tbody>";
    $html .= "</table>";

    system\Helper::arcReturnJSON(["html" => $html]);
}

