<?php

if (system\Helper::arcIsAjaxRequest()) {

    $html = "<div class=\"table table-responsive\">"
        . "<table class=\"table table-striped\">"
        . "<thead>"
        .        "<tr>"
         .          "<th scope=\"col\">ID</th>"
         .           "<th scope=\"col\">Date</th>"
          .          "<th scope=\"col\">Title</th>"
          .          "<th scope=\"col\">Version</th>"
          .          "<th scope=\"col\" class=\"text-right\"><button class=\"btn btn-success btn-sm\"><i class=\"fa fa-plus\"></i> Add</button></th>"
          .      "<tr>"
           . "</thead>"
            . "<tbody>";
                
                    $downloads = ArcDownload::getAllByDownloads();
                    foreach ($downloads as $download) {
                        $html .= "<tr>"
                            . "<td>{$download->id}</td>"
                            . "<td>" . system\Helper::arcConvertDateTime($download->date) . "</td>"
                            . "<td>{$download->title}</td>"
                            . "<td>{$download->version}</td>"
                            . "<td>"
                            . "<div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">"
                            . "<a href=\"#\" onclick=\"deleteDownload({$download->id})\" class=\"btn btn-danger\"><i class=\"fas fa-times\"></i></a>"
                            . "<a href=\"#\" class=\"btn btn-success\"><i class=\"fas fa-signal\"></i></a>"
                            . "</div>"
                            . "</td>"
                            . "</tr>";
                    }

               
                    $html .= "</tbody>"
        . "</table>"
    . "</div>";

    system\Helper::arcReturnJSON(["html" => $html]);
}