<div class="page-header">
    <h1>Answers <?php
        if (!empty(arcGetURLData("data1"))) {
            echo "<a href=\"" . arcGetModulePath() . "\"><span class=\"fa fa-arrow-circle-left\"></span></a>";
        }
        ?></h1>
</div>

<div class="row">
    <form>
        <?php
        $questions = Group::getQuestions(arcGetURLData("data2"));
        $count = 1;
        $time = time();

        foreach ($questions as $question) {
            ?>
            <div class="form-group">
                <div class="well"><?php echo "Q" . $count . ". " . $question->question; ?></div>

                <?php
                $xml = simplexml_load_string($question->answer);
                foreach ($xml as $answer) {
                    echo "<div class=\"radio-inline\"><label><input type=\"radio\" id=\"Q" . $count . "\" name=\"Q" . $count . "\" value=\"" . $answer["text"] . "\">" . $answer["text"] . "</label></div>";
                }

                $count++;
                ?>
            </div>
            <?php
        }

        $count--;
        $sender = "";
        while ($count > 0) {
            $sender = $sender . "Q" . $count . ": '#Q" . $count . "', ";
            $count--;
        }
        $sender = $sender . "userid: '" . arcGetUser()->id . "', time: '" . $time . "', action: 'answerquestion', groupid: '" . arcGetURLData("data2") . "'";
        ?>
        <div class="text-right">
            <button type="button" class="btn btn-success" onclick="ajax.send('POST', {<?php echo $sender; ?>}, '<?php arcGetDispatch(); ?>', updateStatus, true);"><span class="fa fa-save"></span> Save</button>
        </div>
    </form>
</div>
