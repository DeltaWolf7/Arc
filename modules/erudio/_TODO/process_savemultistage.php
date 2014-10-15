<?php

require_once('/bootstrap.php');

$id = $_POST['id'];
$master = htmlentities($_POST['master']);
$img = $_POST['img'];
$q1 = htmlentities($_POST['q1']);
$q2 = htmlentities($_POST['q2']);
$q3 = htmlentities($_POST['q3']);
$q4 = htmlentities($_POST['q4']);
$q5 = htmlentities($_POST['q5']);
$a1 = htmlentities($_POST['a1']);
$a2 = htmlentities($_POST['a2']);
$a3 = htmlentities($_POST['a3']);
$a4 = htmlentities($_POST['a4']);
$a5 = htmlentities($_POST['a5']);

$multistage = new multistage();
$multistage->getMultistage($id);
$multistage->masterquestion = $master;
if ($img == '-- No Image --') {
    $multistage->image = '';
} else {
    $multistage->image = $img;
}
$multistage->question1 = $q1;
$multistage->question2 = $q2;
$multistage->question3 = $q3;
$multistage->question4 = $q4;
$multistage->question5 = $q5;
$multistage->answer1 = $a1;
$multistage->answer2 = $a2;
$multistage->answer3 = $a3;
$multistage->answer4 = $a4;
$multistage->answer5 = $a5;
$multistage->updateMultistage();

echo "Saved";
