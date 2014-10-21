<?php
$quickfire = new quickfire();
$quickfire->getRandomQuickfire();

$parser = new questionparser();

$level = new result();
$poslv = (int)$level->getQuickFireCount($_SESSION['user'], 1);
$neglv = (int)$level->getQuickFireCount($_SESSION['user'], 0);
$lv = $poslv - $neglv;
if ($lv < 1)
{
    $lv = 1;
}
$max = $lv * 10;
$parser->valueLimit = $max;
        
?>
<p class="lead">Synopsis</p>
<p>This section will improve your mathematical skills in a range of different mathematical areas.</p>
<p class="lead">Personal Level</p>
<p>Personal level determines the difficulty of the questions. The better your level, the harder the questions.
    <br />Your current level multiplier is <strong><?php echo $lv; ?></strong>, based on <strong><?php echo $poslv; ?></strong> correct answers over <strong><?php echo $neglv; ?></strong> incorrect answers.
</p>

<div class="jumbotron">
    <strong>Question</strong><br />
      
    <?php
    
    if ((string)$quickfire->image <> "")
    {
        echo "<img src=\"/images/" . $quickfire->image . "\" /><br />";
    }
       
    $string =  $parser->Parse($quickfire->question);
    echo nl2br($string);
    
    $answer = $parser->ParseSolution($quickfire->solution);
    
    $result = '';
    
    if (strpos($answer, '#') != false)
    {
        $result = str_replace('#', '', $answer);
        $question = $string . '|' . $result;
    }
    else
    {
        $eq = new eqEOS();
        $result = $eq->solveIF($answer);
        $question = $string . '|' . number_format((float)$result, 2, '.', '');
    }
    
    $time = time();
    
    $data = explode("|", $question);
    $resultx = new result();
$resultx->userid = $_SESSION['user'];
$resultx->type = "Quick Fire";
$xml = '<result chosen="">'
        . '<question><![CDATA[' . $data[0] . ']]></question>'
        . '<answer>' . $data[1] . '</answer>'
        . '</result>';

$resultx->data = $xml;
$resultx->updateResult();
    
    ?>
    
    </div>
    

    <form class="form-horizontal" role="form" name="login">
        
        <div class="form-group" id="grouppassword">
        <label for="answer" class="col-sm-2 control-label">Answer</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="answer" placeholder="What's the answer? (two decimal places where appropriate)" maxlength="30">
        </div>
    </div>
        
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button id="btnLogin" type="button" class="btn btn-primary btn-lg" onclick="processQuickFire(<?php echo $_SESSION['user'] . ',' . $time . ',' . $resultx->id; ?>);">Submit</button>
        </div>
    </div>
        <input id="question" type="hidden" value="<?php echo $question; ?>">
    </form>

