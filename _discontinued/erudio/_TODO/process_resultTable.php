<?php

require_once('/bootstrap.php');

$userid = $_POST['id'];
$date = '';
$rows = 25;
$type = $_POST['type'];

if (isset($_POST['date'])) {
    $date = $_POST['date'];
}
if (isset($_POST['rows'])) {
    $rows = $_POST['rows'];
    if (strlen($rows) == 0)
    {
        $rows = 25;
    }
    if (is_numeric($rows) == false)
    {
        $rows = 0;
    }
    if ((int)$rows < 0)
    {
        $rows = 0;
    }
}


echo "<table class=\"table table-striped\">";

$results = new results();

if (strlen($date) > 0) {
    if ($type == "All")
    {
        $results->getResultsByDate($userid, $date, $rows);
    }
    else
    {
        $results->getResultsByDateAndType($userid, $date, $rows, $type);
    }
} else {
    if ($type == "All")
    {
    $results->getResults($userid, $rows);
    }
 else {
        $results->getResultsByType($userid, $rows, $type);
    }
}

if (count($results->results) > 0) {
    echo "<tr><th>Date</th><th>Type</th><th>Time (seconds)</th><th>Result</th><th>&nbsp;</th></tr>";
    foreach ($results->results as $result) {
        echo "<tr><td>" . date("d-m-Y", strtotime($result->date)) . "</td><td>" . $result->type . "</td><td>";

        if ($result->time < 1) {
            echo "< 1";
        } else {
            echo $result->time;
        }

        echo "</td><td>";

        if ($result->correct == "1") {
            echo "<span class=\"label label-success\"><span class=\"glyphicon glyphicon-ok\"></span> Correct";
        } else {
            echo "<span class=\"label label-danger\"><span class=\"glyphicon glyphicon-remove\"></span> Incorrect";
        }

        echo "</td><td><button class=\"btn btn-default btn-sm\""
        . " data-toggle=\"modal\" data-target=\"#resultsModal\" onclick=\"processResult(" . $result->id . ")\">"
        . "View Details</button></td></tr>";
    }
} else {
    echo "<div class=\"alert alert-warning\" role=\"alert\">Sorry, we don't have anything to show you right now.</div>";
}

echo "</table>";