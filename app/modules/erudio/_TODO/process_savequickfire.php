<?php

require_once('/bootstrap.php');

$id = $_POST['id'];
$master = htmlentities($_POST['question']);
$img = $_POST['img'];
$answer = htmlentities($_POST['answer']);

$multistage = new quickfire();
$multistage->getQuickfire($id);
$multistage->question = $master;
if ($img == '-- No Image --') {
    $multistage->image = '';
} else {
    $multistage->image = $img;
}
$multistage->solution = $answer;
$multistage->updateQuickfire();

echo "Saved";