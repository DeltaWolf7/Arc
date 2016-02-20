<?php

function getTasksHtml($tasks) {
    $html = "<table class=\"table table-striped table-hover\">"
            . "<thead>"
            . "<tr><th>#</th><th>Created</th><th>Due</th><th>Owner</th><th>Description</th><th>Tags</th><th>Status</th>"
            . "<th class=\"text-right\"><a class=\"btn btn-default btn-xs\" onclick=\"edit(0)\"><i class=\"fa fa-plus\"></i> Create Task</a></th></tr>"
            . "</thead>"
            . "<tbody>";

    if (count($tasks) == 0) {
        $html .= "<tr><td colspan=\"8\" class=\"text-center\">No tasks found</td></tr>";
    }

    foreach ($tasks as $task) {
        $html .= "<tr";

        if ($task->due != "0000-00-00 00:00:00" && $task->status != "Done") {
            if (date('Ymd') >= date('Ymd', strtotime($task->due))) {
                $html .= " class=\"danger\"";
            } elseif (date('Ymd', strtotime('tomorrow')) >= date('Ymd', strtotime($task->due))) {
                $html .= " class=\"warning\"";
            }
        }

        $html .= "><td>{$task->id}</td><td>{$task->created}</td><td>";

        if ($task->due == "0000-00-00 00:00:00") {
            $html .= " - ";
        } else {
            $html .= $task->due;
        }

        $html .= "</td><td>";

        $user = new User();
        $user->getByID($task->owner);
        $html .= $user->getFullname();

        $html .= "</td><td>" . substr(html_entity_decode($task->description), 0, 100) . "</td><td>";

        $tags = explode(",", $task->tags);
        foreach ($tags as $tag) {
            $html .= "<i class=\"label label-info\">{$tag}</i> ";
        }

        $html .= "</td><td>";

        switch ($task->status) {
            case "New":
                $html .= "<i class=\"label label-danger\">New</i>";
                break;
            case "In Progress":
                $html .= "<i class=\"label label-warning\">In Progress</i>";
                break;
            case "Done":
                $html .= "<i class=\"label label-success\">Done</i>";
                break;
        }

        $html .= "</td><td class=\"text-right\">"
                . "<a class=\"btn btn-success btn-xs\" onclick=\"edit({$task->id})\"><i class=\"fa fa-pencil\"></i> Edit</a>"
                . "</td></tr>";
    }

    $html .= "</tbody></table>";

    return $html;
}
