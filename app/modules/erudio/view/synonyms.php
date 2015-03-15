<?php
$wrdGrp1 = new wordgroups();
$wrdGrp1->getWordGroupsWithSynonyms();

$rnd1 = rand(0, count($wrdGrp1->wordgroups) - 1);
$wrdGrp2 = $wrdGrp1->wordgroups[$rnd1];
$wrdGrp2->getWords();


$leftWord = $wrdGrp2->words[rand(0, count($wrdGrp2->words) - 1)];
$rightWord = $wrdGrp2->words[rand(0, count($wrdGrp2->words) - 1)];

$question = $leftWord->word . "|" . $rightWord->word;

if ($leftWord == $rightWord) {
    echo "<script type=\"text/javascript\">window.location=\"/lessons/verbal-reasoning-synonyms\"</script>";
    exit();
}

?>

<p class="lead">Synopsis</p>
<p>This section will improve your ability to recognise words that have the same meaning.</p>
<p class="lead">Instructions</p>
<p>In Synonyms you have to complete the word that meanings the same as the word in green.</p>
<p>

<form  class="form-inline" role="form" name="login">
<div class="form-group">
    
<?php

$result = new result();
$result->userid = $_SESSION['user'];
$result->type = "Synonyms";
$xml = '<result chosen="">'
        . '<word>' . $leftWord->word . '</word>'
        . '<word>' . $rightWord->word . '</word>'
        . '</result>';
$result->data = $xml;
$result->updateResult();

echo "<div class=\"btn-group\">";
        echo "<button id=\"btn0\" type=\"button\" class=\"btn btn-success btn-lg\" value=\"0\" disabled=\"true\">";
            echo $leftWord->word;
             echo "</button>";
      echo "</div>";
echo "&nbsp;&nbsp;";
$time = time();
$count = 0;
$word = str_split($rightWord->word);

$missing = count($word) / 2;

while ($missing > 0)
{
    $rn = rand(0, count($word) - 1);
    if ($word[$rn] != '')
    {
        $word[$rn] = '';
        $missing--;
    }
}

foreach ($word as $char)
{
    echo "<div class=\"btn-group\">";
    if ($char == '')
    {
        echo "<input id=\"txt" . $count . "\" type=\"text\" style=\"width: 40px; text-align: center;\" value=\"" . $char . "\" class=\"form-control\" maxlength=\"1\">";
    }
    else
    {
        echo "<input id=\"txt" . $count . "\" type=\"text\" style=\"width: 40px; text-align: center;\" value=\"" . $char . "\" class=\"form-control\" disabled=\"true\">";
    }
    echo "</div>";    
}

?>

    <input id="question" type="hidden" value="<?php echo $question; ?>">
    
    <?php
    echo "<br /><br /><div class=\"btn-group\">";
        echo "<button id=\"submit\" type=\"button\" class=\"btn btn-primary btn-lg\" value=\"0\" onclick=\"processSynonyms(" . $_SESSION['user'] . "," . $time . "," . $result->id . ")\">";
            echo "Submit";
             echo "</button>";
      echo "</div>";
    ?>
</div>
</form>
</p>

