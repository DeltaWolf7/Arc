<?php
$quickfire = Quickfire::getRandom();
$parser = new QuestionParser();
?>
<div class="well">
    <p class="lead">Synopsis</p>
    <p>This section will improve your mathematical skills in a range of different mathematical areas.</p>
</div>

<div class="row">
    <div class="col-sm-5">
        <div class="panel panel-default">
            <div class="panel-body">

                <?php
                if ((string) $quickfire->image <> "") {
                    echo "<img src=\"/images/" . $quickfire->image . "\" /><br />";
                }

                $string = $parser->Parse($quickfire->question);
                echo nl2br($string);

                $answer = $parser->ParseSolution($quickfire->solution);

                $result = '';

                if (strpos($answer, '#') != false) {
                    $result = str_replace('#', '', $answer);
                    $question = $string . '|' . $result;
                } else {
                    $eq = new eqEOS();
                    $result = $eq->solveIF($answer);
                    $question = $string . '|' . number_format((float) $result, 2, '.', '');
                }

                $time = time();

                $data = explode("|", $question);
                $resultx = new Result();
                $user = arcGetUser();
                $resultx->userid = $user->id;
                $resultx->type = "Quick Fire";
                $xml = '<result chosen="">'
                        . '<question><![CDATA[' . $data[0] . ']]></question>'
                        . '<answer>' . $data[1] . '</answer>'
                        . '</result>';

                $resultx->data = $xml;
                $resultx->update();
                ?>

            </div></div></div>

    <div class="col-sm-7">
        <form class="form-horizontal" role="form" name="login">

            <div class="form-group" id="grouppassword">
                <label for="answer" class="col-sm-2 control-label">Answer</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="answer" placeholder="What's the answer? (two decimal places where appropriate)" maxlength="30">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" class="btn btn-primary btn-lg" onclick="ajax.send('POST', {action: 'quickfire', question: '#question', answer: '#answer', time: '<?php echo $time; ?>', result: '<?php echo $resultx->id; ?>'}, '<?php arcGetDispatch(); ?>', updateStatus, true)">Submit</button>
                </div>
            </div>
            <input id="question" type="hidden" value="<?php echo $question; ?>">
        </form>
    </div>
</div>

