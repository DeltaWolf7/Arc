<?php
if (!isset($_SESSION['user'])) {
    echo "<script type=\"text/javascript\">window.location=\"/accounts/denied\"</script>";
}

$multistage = new multistage();
$multistage->getRandomMultistage();



$level = new result();
$poslv = (int) $level->getMultistageCount($_SESSION['user'], 1);
$neglv = (int) $level->getMultistageCount($_SESSION['user'], 0);
$lv = $poslv - $neglv;
if ($lv < 1)
{
    $lv = 1;
}
$max = $lv * 10;
?>
<p class="lead">Synopsis</p>
<p>This section will improve your maths skills over different mathematical areas.</p>
<p class="lead">Personal Level</p>
<p>Personal level determines the difficulty of the questions. The better your level, the harder the questions.
    <br />Your current level multiplier is <strong><?php echo $lv; ?></strong>, based on <strong><?php echo $poslv; ?></strong> correct answers over <strong><?php echo $neglv; ?></strong> incorrect answers.
</p>

<div class="jumbotron">
    <strong>Question</strong><br />

    <?php
    if ((string) $multistage->image <> "") {
        echo "<img src=\"/images/" . $multistage->image . "\" /><br />";
    }
    echo "<br />";

    $parser = new questionparser();
    $parser->valueLimit = $max;
    $string = $parser->Parse($multistage->masterquestion);
    echo nl2br($string);

    $question = $string;

    $question1 = nl2br($parser->Parse($multistage->question1));
    $question2 = nl2br($parser->Parse($multistage->question2));
    $question3 = nl2br($parser->Parse($multistage->question3));
    $question4 = nl2br($parser->Parse($multistage->question4));
    $question5 = nl2br($parser->Parse($multistage->question5));
    
    $answer1 = $parser->ParseSolution($multistage->answer1);
    $answer2 = $parser->ParseSolution($multistage->answer2);
    $answer3 = $parser->ParseSolution($multistage->answer3);
    $answer4 = $parser->ParseSolution($multistage->answer4);
    $answer5 = $parser->ParseSolution($multistage->answer5);

    $result1 = '';
    if (strpos($answer1, '#') != false) {
        $result1 = str_replace('#', '', $answer1);
        $question .= '|' . $question1 . '|' . $result1;
    } else {
        $eq = new eqEOS();
        $result1 = $eq->solveIF($answer1);        
        $question .= '|' . $question1 . '|' . number_format((float)$result1, 2, '.', '');
    }

    $result2 = '';
    if (strpos($answer2, '#') != false) {
        $result2 = str_replace('#', '', $answer2);
        $question .= '|' . $question2 . '|' . $result2;
    } else {
        $eq = new eqEOS();
        $result2 = $eq->solveIF($answer2);
        $question .= '|' . $question2 . '|' . number_format((float)$result2, 2, '.', '');
    }

    $result3 = '';
    if (strpos($answer3, '#') != false) {
        $result3 = str_replace('#', '', $answer3);
        $question .= '|' . $question3 . '|' . $result3;
    } else {
        $eq = new eqEOS();
        $result3 = $eq->solveIF($answer3);
        $question .= '|' . $question3 . '|' . number_format((float)$result3, 2, '.', '');
    }

    $result4 = '';
    if (strpos($answer4, '#') != false) {
        $result4 = str_replace('#', '', $answer4);
        $question .= '|' . $question4 . '|' . $result4;
    } else {
        $eq = new eqEOS();
        $result4 = $eq->solveIF($answer4);
        $question .= '|' . $question4 . '|' . number_format((float)$result4, 2, '.', '');
    }

    $result5 = '';
    if (strpos($answer5, '#') != false) {
        $result5 = str_replace('#', '', $answer5);
        $question .= '|' . $question5 . '|' . $result5;
    } else {
        $eq = new eqEOS();
        $result5 = $eq->solveIF($answer5);
        $question .= '|' . $question5 . '|' . number_format((float)$result5, 2, '.', '');
    }

    $time = time();

    $data = explode("|", $question);
    $resultx = new result();
    $resultx->userid = $_SESSION['user'];
    $resultx->type = "Multi Stage";
    $xml = '<result>'
            . '<masterquestion><![CDATA[' . $data[0] . ']]></masterquestion>'
            . '<question answer=\'' . $data[2] . '\' entered=\'\'>' . $data[1] . '</question>'
            . '<question answer=\'' . $data[4] . '\' entered=\'\'>' . $data[3] . '</question>'
            . '<question answer=\'' . $data[6] . '\' entered=\'\'>' . $data[5] . '</question>'
            . '<question answer=\'' . $data[8] . '\' entered=\'\'>' . $data[7] . '</question>'
            . '<question answer=\'' . $data[10] . '\' entered=\'\'>' . $data[9] . '</question>'
            . '</result>';

    $resultx->data = $xml;
    $resultx->updateResult();
    ?>

</div>

<form class="form-horizontal" role="form" name="login">
    <pre><p><?php echo $question1; ?></p></pre>  
    <div class="form-group" id="grouppassword">

        <label for="answer1" class="col-sm-2 control-label">Answer</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="answer1" placeholder="What's the answer? (two decimal places where appropriate)" maxlength="50">
        </div>
    </div>
    <pre><p><?php echo $question2; ?></p></pre>  
    <div class="form-group" id="grouppassword2">

        <label for="answer2" class="col-sm-2 control-label">Answer</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="answer2" placeholder="What's the answer? (two decimal places where appropriate)" maxlength="50">
        </div>
    </div>
   <pre><p><?php echo $question3; ?></p></pre>  
    <div class="form-group" id="grouppassword3">

        <label for="answer3" class="col-sm-2 control-label">Answer</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="answer3" placeholder="What's the answer? (two decimal places where appropriate)" maxlength="50">
        </div>
    </div>
    <pre><p><?php echo $question4; ?></p></pre>  
    <div class="form-group" id="grouppassword4">

        <label for="answer4" class="col-sm-2 control-label">Answer</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="answer4" placeholder="What's the answer? (two decimal places where appropriate)" maxlength="50">
        </div>
    </div>
    <pre><p><?php echo $question5; ?></p></pre>  
    <div class="form-group" id="grouppassword5">

        <label for="answer5" class="col-sm-2 control-label">Answer</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="answer5" placeholder="What's the answer? (two decimal places where appropriate)" maxlength="50">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button id="submit" type="button" class="btn btn-primary btn-lg" onclick="processMultiStage(<?php echo $_SESSION['user'] . ',' . $time . ',' . $resultx->id; ?>);">Submit</button>
        </div>
    </div>
    <input id="question" type="hidden" value="<?php echo $question; ?>">
</form>