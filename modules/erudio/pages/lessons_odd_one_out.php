<?php
if (!isset($_SESSION['user'])) {
    echo "<script type=\"text/javascript\">window.location=\"/accounts/denied\"</script>";
}

$wrdGrp1 = new wordgroup();
$wrdGrp1->getRandomGroup();

$wrdGrp2 = new wordgroup();
$wrdGrp2->getRandomGroup();

if ($wrdGrp1->name == $wrdGrp2->name) {
    $wrdGrp2->getRandomGroup();
}

$wrdArray = Array();

$count = 0;
$deadCount = 0;

while ($count < 3) {
    $wr = $wrdGrp1->words[rand(0, count($wrdGrp1->words) - 1)];
    $deadCount++;
    if (!in_array($wr, $wrdArray)) {
        array_push($wrdArray, $wr);
        $count++;
        $deadCount = 0;
    }
    
    if ($deadCount > 10)
    {
        echo "<script type=\"text/javascript\">window.location=\"/lessons/verbal-reasoning-odd-one-out\"</script>";
    }
}

$wr2 = $wrdGrp2->words[rand(0, count($wrdGrp2->words) - 1)];
array_push($wrdArray, $wr2);

$correctAnswer = $wr2->word;
$question = $wrdArray;

shuffle($wrdArray);
?>

<p class="lead">Synopsis</p>
<p>This section will improve your ability to recognise related words.</p>
<p class="lead">Instructions</p>
<p>In 'Odd One Out' you have to find the word that's not like the others. Click the word that you think is different.</p>
<p>

<form class="form-horizontal" role="form" name="login">

<?php
$result = new result();
    $result->userid = $_SESSION['user'];
$result->type = "Odd One Out";
$xml = '<result chosen="">';
foreach ($wrdArray as $word) {
if ($word->word == $correctAnswer)
            {
    $xml = $xml . '<word correct="1">' . $word->word . '</word>';
            }
            else
            {
                $xml = $xml . '<word correct="0">' . $word->word . '</word>';
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
            if ($word->word == $correctAnswer)
            {
            echo "<button id=\"btn" . $btnCount . "\" type=\"button\" class=\"btn btn-info btn-lg\" value=\"1\" onclick=\"processOddOneOut(" . $btnCount . ", " . $_SESSION['user'] . ", '" . $time . "'," . $result->id . ")\">";
            $strWords = $strWords . "1|" . $word->word . "|";
            }
            else
            {
                echo "<button id=\"btn" . $btnCount . "\" type=\"button\" class=\"btn btn-info btn-lg\" value=\"0\" onclick=\"processOddOneOut(" . $btnCount . ", " . $_SESSION['user'] . ", '" . $time . "'," . $result->id . ")\">";
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