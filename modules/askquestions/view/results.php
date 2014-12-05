<?php

if (arcGetURLData("data3") == null) {
    ?>

    <div class="page-header">
        <h1>Results <?php
            if (!empty(arcGetURLData("data1"))) {
                echo "<a href=\"" . arcGetModulePath() . "\"><span class=\"fa fa-arrow-circle-left\"></span></a>";
            }
            ?></h1>
    </div>

    <table class="table table-striped">
        <tr><th>When</th><th>Time Taken</th></tr>
        <?php
        $group = new Group();
        $group->getByID(arcGetURLData("data2"));
        $results = Result::getByGroupAndUserID(arcGetURLData("data2"), arcGetUser()->id);

        foreach ($results as $result) {
            echo "<tr><td><a href=\"" . arcGetModulePath() . "results/" . arcGetURLData("data2") . "/" . $result->id . "\">" . $result->datedone . "</a></td><td>";
            if ($result->timetaken < 60) {
                echo $result->timetaken . " seconds";
            } else {
                $time = $result->timetaken / 60;
                echo number_format($time, 2, '.', '') . " minutes";
            }
            echo "</td></tr>";
        }
        ?>

    </table>

    <?php
} else {
    $result = new Result();
    $result->getByID(arcGetURLData("data3"));

    $questions = Group::getQuestions(arcGetURLData("data2"));

    $xml = simplexml_load_string($result->result);
    
    $correct = 0;
    $incorrect = 0;
    
    ?>

    <div class="page-header">
        <h1>Results <?php
            if (!empty(arcGetURLData("data1"))) {
                echo "<a href=\"" . arcGetModulePath() . "results/" . arcGetURLData("data2") . "\"><span class=\"fa fa-arrow-circle-left\"></span></a>";
            }
            ?></h1>
    </div>

    <table class="table table-striped">
        <tr><th>Question</th><th>Your Answer</th><th>Correct Answer</th></tr>
        <?php
        $count = 0;
        $q = 1;
        foreach ($xml->result as $data) {
            $atts = $data->attributes();
            echo "<tr><td>(Q" . $q . ") " . html_entity_decode($questions[$count]->question) . "</td><td>" . $atts["answer"] . "</td><td>";
            
            $xml2 = simplexml_load_string($questions[$count]->answer);
            foreach ($xml2->answer as $ans) {
                $at = $ans->attributes();
                if (isset($at["correct"])) {
                    echo $at["text"] . " <span class=\"fa fa-";                 
                    if ((string)$at["text"] == (string)$atts["answer"]) {
                        echo "check";
                        $correct++;
                    } else {
                        echo "close";
                        $incorrect++;
                    }
                    echo "\"></span>";
                    break;
                }
            }
            $q++;
            
            echo "</td></tr>";
            $count++;
        }
        ?>
    </table>
<div class="well"><?php echo $correct; ?> correct answers and <?php echo $incorrect; ?> incorrect answers out of <?php echo count($questions); ?> questions.
<br />You scored <?php echo 100 / count($questions) * $correct; ?>%.
</div>
    <?php
}
?>


