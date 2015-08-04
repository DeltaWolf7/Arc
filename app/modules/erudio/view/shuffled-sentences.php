<div class="page-header">
    <h1>Shuffled Sentences</h1>
</div>

<?php
$sentence = new Sentence();
$data = $sentence->getRandomSentence();

$wrdArray = explode(' ', $data->sentence);

shuffle($wrdArray);
?>

<p class="lead">Synopsis</p>
<p>This section will improve your ability to construct meaningful sentences using your understanding of sentence construction.</p>
<p class="lead">Instructions</p>
<p>In 'Shuffled Sentences' you have to find the word which doesn't belong in the sentence. This is the 'superfluous' word. This is the word you should click.</p>


<div class="panel panel-default">
    <div class="panel-body text-center">


        <?php
        $btnCount = 0;
        $strWords = array();

        foreach ($wrdArray as $word) {
            ?>

            
                <?php
                echo "<a class=\"btn btn-info btn-lg\" onclick=\"send(" . $btnCount . ")\">" . $word . "</a>";
                $strWords[] = $word;
                ?>
            

            <?php
            $btnCount++;
        }

        $words = "";
        foreach ($strWords as $wrd) {
            $words .= $wrd . " ";
        }
        $words = "'" . rtrim($words, " ") . "'";
        ?>

    </div>
</div>

<div class="text-right"><button id="newquestion" class="btn btn-default" >New Question</button></div>

<div id="status"></div>

<script>
    var allowClick = true;
    
    function send(btnid) {
        if (allowClick == false) {
            return;
        }
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {start: <?php echo time(); ?>, userid: <?php echo system\Helper::arcGetUser()->id; ?>, words: <?php echo $words; ?>, btn: btnid, questionid: <?php echo $data->id; ?>},
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

