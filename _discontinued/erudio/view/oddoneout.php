<div class="page-header">
    <h1>Odd One Out</h1>
</div>


<?php
$wrdGrp1 = WordGroup::getRandomGroup();
$wrdGrp2 = WordGroup::getRandomGroup();

if ($wrdGrp1->name == $wrdGrp2->name) {
    $wrdGrp2 = WordGroup::getRandomGroup();
}

$wrdArray = Array();

$count = 0;
$deadCount = 0;

$words1 = $wrdGrp1->getWords();
$words2 = $wrdGrp2->getWords();

while ($count < 3) {
    $wr = $words1[rand(0, count($words1) - 1)];
    $deadCount++;
    if (!in_array($wr, $wrdArray)) {
        array_push($wrdArray, $wr);
        $count++;
        $deadCount = 0;
    }

    if ($deadCount > 10) {
        echo "<script type=\"text/javascript\">window.location=\"/lessons/verbal-reasoning-odd-one-out\"</script>";
    }
}

$wr2 = $words2[rand(0, count($words2) - 1)];
array_push($wrdArray, $wr2);

$correctAnswer = $wr2->word;
$question = $wrdArray;
$send = "";
foreach ($question as $wrd) {
    $send .= $wrd->word . "|";
}
$send = rtrim($send, "|");

shuffle($wrdArray);
?>

<p class="lead">Synopsis</p>
<p>This section will improve your ability to recognise related words.</p>
<p class="lead">Instructions</p>
<p>In 'Odd One Out' you have to find the word that's not like the others. Click the word that you think is different.</p>

<div class="panel panel-default">
    <div class="panel-body text-center">

        <?php
        foreach ($wrdArray as $word) {
            echo "<a class=\"btn btn-info btn-lg\" onclick=\"send('{$word->word}')\">{$word->word}</a> ";
        }
        ?>
    </div>
</div>

<div class="text-right"><button id="newquestion" class="btn btn-default" >New Question</button></div>

<div id="status"></div>

<script>
    var allowClick = true;
    
    function send(btn) {
        if (allowClick == false) {
            return;
        }
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {start: <?php echo time(); ?>, userid: <?php echo system\Helper::arcGetUser()->id; ?>, words: <?php echo "'" . $send . "'"; ?>, btn: btn},
            complete: function (data) {
                allowClick = false;
                updateStatus("status");
            }
        })
    }
    
    $("#newquestion").click(function () {
        location.reload();
    });
</script>