

<?php
if (arcGetURLData("data4") == null) {
    ?>

    <div class="page-header">
        <h1>Results <?php
            if (!empty(arcGetURLData("data1"))) {
                echo "<a href=\"" . arcGetModulePath() . "\"><span class=\"fa fa-arrow-circle-left\"></span></a>";
            }
            ?></h1>
    </div>

    <?php
    $group = new Group();
    $group->getByID(arcGetURLData("data3"));
    $results = Result::getByGroup(arcGetURLData("data3"));
    ?>

    <div class="panel panel-default">
        <div class="panel-heading">Students who have not taken this test</div>
        <div class='panel-body'>
            <?php
            $studentGroup = UserGroup::getByName("Students");
            $students = $studentGroup->getUsers();
            $sc = 0;
            foreach ($results as $result) {
                foreach ($students as $student) {
                    if ($student != null) {
                        if ($result->userid == $student->id) {
                            $students[$sc] = null;
                        }
                    }
                    $sc++;
                }
                $sc = 0;
            }
            ?>
            <ul class="list-inline">
                <?php
                foreach ($students as $student) {
                    if ($student != null && $student->groupid != 1) {
                        echo "<li><span class=\"fa fa-user\"></span> " . $student->getFullname() . "</li>";
                    }
                }
                ?>
            </ul>
        </div>
    </div>

    <table class="table table-striped">
        <tr><th>User</th><th>When</th><th>Time Taken)</th></tr>
        <?php
        foreach ($results as $result) {
            $user = new User();
            $user->getByID($result->userid);
            if ($user->groupid != 1) {
                echo "<tr><td><a href=\"" . arcGetModulePath() . "results/" . arcGetURLData("data3") . "/" . $result->id . "\">" . $user->firstname . " " . $user->lastname . "</a></td><td>" . $result->datedone . "</td><td>";
                if ($result->timetaken < 60) {
                    echo $result->timetaken . " seconds";
                } else {
                    $time = $result->timetaken / 60;
                    echo number_format($time, 2, '.', '') . " minutes";
                }
                echo "</td></tr>";
            }
        }
        ?>

    </table>

    <?php
} else {
    $result = new Result();
    $result->getByID(arcGetURLData("data4"));

    $questions = Group::getQuestions(arcGetURLData("data3"));

    $xml = simplexml_load_string($result->result);

    $correct = 0;
    $incorrect = 0;
    ?>

    <div class="page-header">
        <h1>Results <?php
    if (!empty(arcGetURLData("data1"))) {
        echo "<a href=\"" . arcGetModulePath() . "results/" . arcGetURLData("data3") . "\"><span class=\"fa fa-arrow-circle-left\"></span></a>";
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
                if ((string) $at["text"] == (string) $atts["answer"]) {
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

        echo "</td></tr>";
        $count++;
        $q++;
    }
    ?>
    </table>
    <div class="well"><?php echo $correct; ?> correct answers and <?php echo $incorrect; ?> incorrect answers out of <?php echo count($questions); ?> questions.
        <br />You scored <?php echo 100 / count($questions) * $correct; ?>%.
    </div>

    <?php
}
?>


