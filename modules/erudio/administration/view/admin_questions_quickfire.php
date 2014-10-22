<?php

$id = '';
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
}

if ($id == '') {
    ?>


    <p>

    <table class="table table-striped">
        <thead>
            <tr><th>ID</th><th>Question</th></tr>
        </thead>
        <tbody>
            <?php
            $multistage = new quickfires();
            $multistage->getQuestions();

            foreach ($multistage->questions as $question) {

                echo "<tr><td>" . $question->id . "</td><td>" . nl2br(html_entity_decode($question->question)) . "</a></td><td>"
                . "<div class=\"btn-group\">"
                . "<button type=\"button\" class=\"btn btn-default btn-xs\" onclick=\"window.location='/administration/questions-quickfire/" . $question->id . "'\">"
                . "<span class=\"glyphicon glyphicon-pencil\"></span>"
                . "</button>"
                . "<button type=\"button\" class=\"btn btn-danger btn-xs\" onclick=\"deleteQuickfire('" . $question->id . "')\">"
                . "<span class=\"glyphicon glyphicon-remove\"></span>"
                . "</button>"
                . "</div>"
                . "</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <button id="btnNew" type="button" class="btn btn-primary btn-lg" onclick="window.location='/administration/questions-quickfire/-1'">New Question</button>
    </p>
    
    

    <?php
} else {

    $multistage = new quickfire();
    if ($id <> -1)
    {
        $multistage->getQuickfire($id);
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
            <label for="question" class="col-sm-2 control-label">Question</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="question" rows="5"><?php echo html_entity_decode($multistage->question); ?></textarea>
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
       
        <div class="form-group" id="groupanswer5">
            <label for="answer" class="col-sm-2 control-label">Answer</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="answer" maxlength="50" value="<?php echo html_entity_decode($multistage->solution); ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button id="btnLogin" type="button" class="btn btn-primary btn-lg" onclick="saveQuickfire('<?php echo $id; ?>')">Save</button>
            </div>
        </div>
    </form>

<?php } ?>


