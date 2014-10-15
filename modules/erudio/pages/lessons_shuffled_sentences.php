<?php
if (!isset($_SESSION['user'])) {
    echo "<script type=\"text/javascript\">window.location=\"/accounts/denied\"</script>";
}


$sentence = new sentence();
$sentence->getRandomSentence();

$wrdArray = explode(' ', $sentence->sentence);
$correctAnswer = $wrdArray[count($wrdArray) - 1];

shuffle($wrdArray);

?>

<p class="lead">Synopsis</p>
<p>This section will improve your ability to construct meaningful sentences using your understanding of sentence construction.</p>
<p class="lead">Instructions</p>
<p>In 'Shuffled Sentences' you have to find the word which doesn't belong in the sentence. This is the 'superfluous' word. This is the word you should click.</p>
<p>

<form class="form-horizontal" role="form" name="login">

    <?php
    $result = new result();
    $result->userid = $_SESSION['user'];
    $result->type = "Shuffled Sentences";
    $xml = '<result chosen="">';
    foreach ($wrdArray as $word) {
        if ($word == $correctAnswer) {
            $xml = $xml . '<word correct="1">' . $word . '</word>';
        } else {
            $xml = $xml . '<word correct="0">' . $word. '</word>';
        }
    }
    $xml = $xml . '</result>';
    $result->data = $xml;
    $result->updateResult();
    
    
    $btnCount = 0;
    $strWords = "";

    $time = time();

    foreach ($wrdArray as $word) {
        ?>

        <div class="btn-group">
            <?php
            if ($word == $correctAnswer) {
                echo "<button id=\"btn" . $btnCount . "\" type=\"button\" class=\"btn btn-info btn-lg\" value=\"1\" onclick=\"processShuffled(" . $btnCount . ", " . $_SESSION['user'] . ", '" . $time . "'," . $result->id . ")\">";
                $strWords = $strWords . "1|" . $word . "|";
            } else {
                echo "<button id=\"btn" . $btnCount . "\" type=\"button\" class=\"btn btn-info btn-lg\" value=\"0\" onclick=\"processShuffled(" . $btnCount . ", " . $_SESSION['user'] . ", '" . $time . "'," . $result->id . ")\">";
                $strWords = $strWords . "0|" . $word . "|";
            }

            echo $word;
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