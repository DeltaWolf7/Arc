<?php
if (!isset($_SESSION['user'])) {
    echo "<script type=\"text/javascript\">window.location=\"/accounts/denied\"</script>";
} else {
    $user = new user();
    $user->getUserByID($_SESSION['user']);
    if ($user->isadmin == false) {
        echo "<script type=\"text/javascript\">window.location=\"/accounts/denied\"</script>";
    }
}

include('/templates/admin_menu.php');

$id = '';
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
}

if ($id == '') {
    ?>


    <p>

    <table class="table table-striped">
        <thead>
            <tr><th>ID</th><th>Master Question</th></tr>
        </thead>
        <tbody>
            <?php
            $multistage = new multistages();
            $multistage->getQuestions();

            foreach ($multistage->questions as $question) {

                echo "<tr><td>" . $question->id . "</td><td>" . nl2br(html_entity_decode($question->masterquestion)) . "</a></td><td>"
                . "<div class=\"btn-group\">"
                . "<button type=\"button\" class=\"btn btn-default btn-xs\" onclick=\"window.location='/administration/questions-multistage/" . $question->id . "'\">"
                . "<span class=\"glyphicon glyphicon-pencil\"></span>"
                . "</button>"
                . "<button type=\"button\" class=\"btn btn-danger btn-xs\" onclick=\"deleteMultiStage('" . $question->id . "')\">"
                . "<span class=\"glyphicon glyphicon-remove\"></span>"
                . "</button>"
                . "</div>"
                . "</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <button id="btnNew" type="button" class="btn btn-primary btn-lg" onclick="window.location = '/administration/questions-multistage/-1'">New Question</button>
    </p>



    <?php
} else {

    $multistage = new multistage();
    if ($id <> -1) {
        $multistage->getMultistage($id);
    }
    ?>

    <script>
        function mulImageChange()
        {
            var sel = document.getElementById('image');
            var img = sel.options[sel.selectedIndex].value;
            if (img == '-- No Image --')
            {
                document.getElementById('mulImage').src = '';
            }
            else
            {
                document.getElementById('mulImage').src = '/images/' + img;
            }
        }
    </script>

    <form class="form-horizontal" role="form" name="mutlistage">
        <div class="form-group" id="groupmaster">
            <label for="masterquestion" class="col-sm-2 control-label">Master Question</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="masterquestion" rows="5"><?php echo html_entity_decode($multistage->masterquestion); ?></textarea>
            </div>
        </div>
        <div class="form-group" id="groupimage">
            <label for="image" class="col-sm-2 control-label">Image</label>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-md-11"><select class="form-control" id="image" onchange="mulImageChange();">
                            <option>-- No Image --</option>                   
                            <?php
                            $files = scandir($_SERVER['DOCUMENT_ROOT'] . '/images');
                            $set = '';
                            foreach ($files as $file) {
                                if ($file <> '.' && $file <> '..') {
                                    if ($file == $multistage->image) {
                                        echo "<option selected=\"selected\">" . $file . "</option>";
                                        $set = $file;
                                    } else {
                                        echo "<option>" . $file . "</option>";
                                    }
                                }
                            }
                            ?>
                        </select></div>
                    <div class="col-md-1"><img id="mulImage" src="/images/<?php echo $set; ?>" height="50px" /></div>
                </div>

            </div>
        </div>
        <div class="form-group" id="groupq1">
            <label for="question1" class="col-sm-2 control-label">Question 1</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="question1" rows="5"><?php echo html_entity_decode($multistage->question1); ?></textarea>
            </div>
        </div>
        <div class="form-group" id="groupanswer1">
            <label for="answer1" class="col-sm-2 control-label">Answer 1</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="answer1" maxlength="50" value="<?php echo html_entity_decode($multistage->answer1); ?>">
            </div>
        </div>
        <div class="form-group" id="groupq2">
            <label for="question2" class="col-sm-2 control-label">Question 2</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="question2" rows="5"><?php echo html_entity_decode($multistage->question2); ?></textarea>
            </div>
        </div>
        <div class="form-group" id="groupanswer2">
            <label for="answer2" class="col-sm-2 control-label">Answer 2</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="answer2" maxlength="50" value="<?php echo html_entity_decode($multistage->answer2); ?>">
            </div>
        </div>
        <div class="form-group" id="groupq3">
            <label for="question3" class="col-sm-2 control-label">Question 3</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="question3" rows="5"><?php echo html_entity_decode($multistage->question3); ?></textarea>
            </div>
        </div>
        <div class="form-group" id="groupanswer3">
            <label for="answer3" class="col-sm-2 control-label">Answer 3</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="answer3" maxlength="50" value="<?php echo html_entity_decode($multistage->answer3); ?>">
            </div>
        </div>
        <div class="form-group" id="groupq4">
            <label for="question4" class="col-sm-2 control-label">Question 4</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="question4" rows="5"><?php echo html_entity_decode($multistage->question4); ?></textarea>
            </div>
        </div>
        <div class="form-group" id="groupanswer4">
            <label for="answer4" class="col-sm-2 control-label">Answer 4</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="answer4" maxlength="50" value="<?php echo html_entity_decode($multistage->answer4); ?>">
            </div>
        </div>
        <div class="form-group" id="groupq5">
            <label for="question5" class="col-sm-2 control-label">Question 5</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="question5" rows="5"><?php echo html_entity_decode($multistage->question5); ?></textarea>
            </div>
        </div>
        <div class="form-group" id="groupanswer5">
            <label for="answer5" class="col-sm-2 control-label">Answer 5</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="answer5" maxlength="50" value="<?php echo html_entity_decode($multistage->answer5); ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button id="btnLogin" type="button" class="btn btn-primary btn-lg" onclick="saveMultiStage('<?php echo $id; ?>')">Save</button>
            </div>
        </div>
    </form>

<?php } ?>


