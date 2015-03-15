<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $question = $_POST['question'];
    $answer1 = cleanInput($_POST['answer1']);
    $answer2 = cleanInput($_POST['answer2']);
    $answer3 = cleanInput($_POST['answer3']);
    $answer4 = cleanInput($_POST['answer4']);
    $answer5 = cleanInput($_POST['answer5']);
    $time = $_POST['time'];
    $taken = time() - $time;
    $resultid = $_POST['result'];
    $data = explode("|", $question);
    $correct = true;

    if ((string) $data[2] <> (string) $answer1) {
        $correct = false;
    }
    if ((string) $data[4] <> (string) $answer2) {
        $correct = false;
    }
    if ((string) $data[6] <> (string) $answer3) {
        $correct = false;
    }
    if ((string) $data[8] <> (string) $answer4) {
        $correct = false;
    }
    if ((string) $data[10] <> (string) $answer5) {
        $correct = false;
    }

    $resultx = new Result();
    $resultx->getByID($resultid);
    $resultx->time = $taken;
    $resultx->correct = $correct;
    $xml = '<result>'
            . '<masterquestion><![CDATA[' . $data[0] . ']]></masterquestion>'
            . '<question answer=\'' . $data[2] . '\' entered=\'' . $answer1 . '\'>' . $data[1] . '</question>'
            . '<question answer=\'' . $data[4] . '\' entered=\'' . $answer2 . '\'>' . $data[3] . '</question>'
            . '<question answer=\'' . $data[6] . '\' entered=\'' . $answer3 . '\'>' . $data[5] . '</question>'
            . '<question answer=\'' . $data[8] . '\' entered=\'' . $answer4 . '\'>' . $data[7] . '</question>'
            . '<question answer=\'' . $data[10] . '\' entered=\'' . $answer5 . '\'>' . $data[9] . '</question>'
            . '</result>';
    $resultx->data = $xml;
    $resultx->update();

    if ($correct) {
        system\Helper::arcAddMessage("success", "Great job! That's correct.<br />Time taken: " . $taken . " seconds.<br /><a href=\"" . system\Helper::arcGetModulePath() . "multistage" . "\">Try another question</a>");
    } else {
        system\Helper::arcAddMessage("danger", "Sorry, don't give up.<br />Answer 1 <strong>'" . $data[2] . "'</strong>.<br />Answer 2 <strong>'" . $data[4] . "'</strong>.<br />Answer 3 <strong>'" . $data[6] . "'</strong>.<br />Answer 4 <strong>'" . $data[8] . "'</strong>.<br />Answer 5 <strong>'" . $data[10] . "'</strong>.<br />Time taken: " . $taken . " seconds.<br /><a href=\"" . system\Helper::arcGetModulePath() . "multistage" . "\">Try another question</a>");
    }
}
