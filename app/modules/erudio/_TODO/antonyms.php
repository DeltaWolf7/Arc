<?php
$wrdGrp1 = new wordgroups();
$wrdGrp1->getWordGroupsWithAntonyms();

$rnd1 = rand(0, count($wrdGrp1->wordgroups) - 1);
$wrdGrp2 = $wrdGrp1->wordgroups[$rnd1];
$wrdGrp2->getWords();

$wrdGrp3 = $wrdGrp2->getAntonymGroup();

$leftWord = $wrdGrp2->words[rand(0, count($wrdGrp2->words) - 1)];

$wrdArray = Array();

$count = 0;
$deadCount = 0;


while ($count < 3) {
    $wr = $wrdGrp2->words[rand(0, count($wrdGrp2->words) - 1)];
    $deadCount++;
    if (!in_array($wr, $wrdArray) && $wr->word <> $leftWord->word) {
        array_push($wrdArray, $wr);
        $count++;
        $deadCount = 0;
    }

    if ($deadCount > 10) {
        echo "<script type=\"text/javascript\">window.location=\"/lessons/verbal-reasoning-antonyms\"</script>";
        exit();
    }
}

$wr2 = $wrdGrp3->words[rand(0, count($wrdGrp3->words) - 1)];
array_push($wrdArray, $wr2);

$correctAnswer = $wr2->word;
$question = $wrdArray;

shuffle($wrdArray);

?>

<p class="lead">Synopsis</p>
<p>This section will improve your ability to recognise words that have opposite meanings.</p>
<p class="lead">Instructions</p>
<p>In 'Antonyms' you have to find the word that has the opposite meaning of the word in green.</p>
<p>

<form class="form-horizontal" role="form" name="login">

    <?php
    $result = new result();
    $result->userid = $_SESSION['user'];
    $result->type = "Antonyms";
    $xml = '<result chosen="">';
    foreach ($wrdArray as $word) {
        if ($word->word == $correctAnswer) {
            $xml = $xml . '<word correct="1">' . $word->word . '</word>';
        } else {
            $xml = $xml . '<word correct="0">' . $word->word . '</word>';
        }
    }
    $xml = $xml . '</result>';
    $result->data = $xml;
    $result->updateResult();


    $btnCount = 1;
    $strWords = "";

    $time = time();


    echo "<div class=\"btn-group\">";
    echo "<button id=\"btn0\" type=\"button\" class=\"btn btn-success btn-lg\" value=\"0\" disabled=\"true\">";
    $strWords = $strWords . "0|" . $leftWord->word . "|";
    echo $leftWord->word;
    echo "</button>";
    echo "</div>";


    foreach ($wrdArray as $word) {
        ?>

        <div class="btn-group">
        <?php
        if ($word->word == $correctAnswer) {
            echo "<button id=\"btn" . $btnCount . "\" type=\"button\" class=\"btn btn-info btn-lg\" value=\"1\" onclick=\"processAntonyms(" . $btnCount . ", " . $_SESSION['user'] . ", '" . $time . "', " . $result->id . ")\">";
            $strWords = $strWords . "1|" . $word->word . "|";
        } else {
            echo "<button id=\"btn" . $btnCount . "\" type=\"button\" class=\"btn btn-info btn-lg\" value=\"0\" onclick=\"processAntonyms(" . $btnCount . ", " . $_SESSION['user'] . ", '" . $time . "', " . $result->id . ")\">";
            $strWords = $strWords . "0|" . $word->word . "|";
        }

        echo $word->word;
        echo "</button>";
        ?>
        </div>

            <?php
            $btnCount++;
        }

        $strWords = rtrim($strWords, "|");
        ?>

    <input id="question" type="hidden" value="<?php echo $strWords; ?>">

</form>
</p>