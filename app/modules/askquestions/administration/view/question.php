<?php
$question = new Question();
if (arcGetURLData("data3") != "0") {
    $question->getByID(arcGetURLData("data3"));
}

$xml = simplexml_load_string($question->answer);
?>

<div class="page-header">
    <h1>Question Editor <?php
        if (!empty(arcGetURLData("data1"))) {
            echo "<a href=\"" . arcGetModulePath() . "\"><span class=\"fa fa-arrow-circle-left\"></span></a>";
        }
        ?></h1>
</div>

<form>
    <div class="form-group">
        <label>Question</label>
        <div class="summernote"><?php echo html_entity_decode($question->question); ?></div>
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
                } elseif (arcGetURLData("data4") != null && arcGetURLData("data4") == $group->id) {
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
                if (isset($xml->answer[$count - 1]["correct"])) {
                    echo " selected";
                }
                echo ">Answer " . $count . "</option>";
                $count++;
            }
            ?>
        </select>
    </div>
    <div class="form-group text-right">
        <button type="button" class="btn btn-success" onclick="doSave();">Save</button> 
        <button type="button" class="btn btn-danger" onclick="window.location = '<?php echo arcGetModulePath() . "delete/" . arcGetURLData("data3"); ?>'">Delete</button>
    </div>
</form>

<script>
    function doSave() {
        var txt = $('.summernote').code();
        ajax.send('POST', {action: 'savequestion', questionid: '<?php echo arcGetURLData("data3"); ?>', answer1: '#answer1', answer2: '#answer2', answer3: '#answer3', answer4: '#answer4', answer5: '#answer5', answer: '#answer', group: '#group', question: txt}, '<?php arcGetDispatch(); ?>', updateStatus, true);
    }
    
    $(document).ready(function () {
        $('.summernote').summernote();
    });
</script>