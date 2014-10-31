<?php
$question = new Question();
$question->getByID(arcGetURLData("data3"));

$xml = simplexml_load_string($question->answer);
?>

<div class="page-header">
    <h1>WebSite FAQ Editor <?php
        if (!empty(arcGetURLData("data1"))) {
            echo "<a href=\"" . arcGetModulePath() . "\"><span class=\"fa fa-arrow-circle-left\"></span></a>";
        }
        ?></h1>
</div>

<form>
    <div class="form-group">
        <label>Question</label>
        <textarea class="form-control" id="question" rows="5"><?php echo $question->question; ?></textarea>
    </div>
    <div class="form-group">
        <label>Group</label>
        <select class="form-control" id="group">
            <?php
                $groups = Group::getGroups();
                foreach ($groups as $group) {
                    echo "<option value=\"" . $group->id . "\"";
                    if ($group->id == $question->groupid) {
                        echo " selected";
                    }
                    echo ">" . $group->name . "</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Answer 1</label>
        <input type="text" id="answer1" class="form-control" value="<?php
        if (isset($xml->answer[0])) {
            echo $xml->answer[0]["text"];
        }
        ?>" />
    </div>
    <div class="form-group">
        <label>Answer 2</label>
        <input type="text" id="answer2" class="form-control" value="<?php
        if (isset($xml->answer[1])) {
            echo $xml->answer[1]["text"];
        }
        ?>" />
    </div>
    <div class="form-group">
        <label>Answer 3</label>
        <input type="text" id="answer3" class="form-control" value="<?php
        if (isset($xml->answer[2])) {
            echo $xml->answer[2]["text"];
        }
        ?>" />
    </div>
    <div class="form-group">
        <label>Answer 4</label>
        <input type="text" id="answer4" class="form-control" value="<?php
        if (isset($xml->answer[3])) {
            echo $xml->answer[3]["text"];
        }
        ?>" />
    </div>
    <div class="form-group">
        <label>Answer 5</label>
        <input type="text" id="answer5" class="form-control" value="<?php
        if (isset($xml->answer[4])) {
            echo $xml->answer[4]["text"];
        }
        ?>" />
    </div>
    <div class="form-group">
        <label>Correct Answer</label>
        <select id="answer" class="form-control">
            <?php
            $count = 1;
            while ($count <= 5) {
                echo "<option value=\"" . $count . "\"";
                if (isset($xml->answer[$count]) && isset($xml->answer[$count]["correct"])) {
                    echo " selected";
                }
                echo ">Answer " . $count . "</option>";
                $count++;
            }
            ?>
        </select>
    </div>
    <div class="form-group text-right">
        <button type="button" class="btn btn-success" onclick="ajax.send('POST', {action: 'savequestion', questionid: '<?php arcGetURLData("data3"); ?>', answer1: '#answer1', answer2: '#answer2', answer3: '#answer3', answer4: '#answer4', answer5: '#answer5', answer: '#answer', group: '#group', question: '#question'}, '<?php echo arcGetDispatch(); ?>', updateStatus, true);">Save</button> 
        <button type="button" class="btn btn-danger" onclick="window.location='<?php echo arcGetModulePath() . "delete/" . arcGetURLData("data3"); ?>'">Delete</button>
    </div>
</form>