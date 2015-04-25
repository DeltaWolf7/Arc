<div class="page-header">
    <h1>Multistage</h1>
</div>
<?php
$multistage = Multistage::getRandomMultistage();
?>
<div class="row">
    <div class="col-sm-5">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php echo html_entity_decode($multistage->masterquestion); ?>
            </div>
        </div>
    </div>
    <div class="col-sm-7">
        <div class="panel panel-default">
            <div class="panel-body"><strong>Q1:</strong><br/><?php echo html_entity_decode($multistage->question1); ?></div>
            <div class="panel-footer">
                <input type="text" class="form-control" id="answer1" placeholder="What's the answer?" maxlength="50" />
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body"><strong>Q2:</strong><br/><?php echo html_entity_decode($multistage->question2); ?></div>
            <div class="panel-footer">
                <input type="text" class="form-control" id="answer2" placeholder="What's the answer?" maxlength="50" />
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body"><strong>Q3:</strong><br/><?php echo html_entity_decode($multistage->question3); ?></div>
            <div class="panel-footer">
                <input type="text" class="form-control" id="answer3" placeholder="What's the answer?" maxlength="50" />
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body"><strong>Q4:</strong><br/><?php echo html_entity_decode($multistage->question4); ?></div>
            <div class="panel-footer">
                <input type="text" class="form-control" id="answer4" placeholder="What's the answer?" maxlength="50" />
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body"><strong>Q5:</strong><br/><?php echo html_entity_decode($multistage->question5); ?></div>
            <div class="panel-footer">
                <input type="text" class="form-control" id="answer5" placeholder="What's the answer?" maxlength="50" />
            </div>
        </div>
        <div class="form-group text-right">
            <button id="submit" class="btn btn-default" >Submit</button>&nbsp;
            <button id="newquestion" class="btn btn-default" >New Question</button>
        </div>
    </div>
</div>
<div id="status"></div>

<script>
    $("#submit").click(function () {
        $("#answer1").prop("disabled", true);
        $("#answer2").prop("disabled", true);
        $("#answer3").prop("disabled", true);
        $("#answer4").prop("disabled", true);
        $("#answer5").prop("disabled", true);
        $("#submit").prop("disabled", true);
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {answer1: $("#answer1").val(), answer2: $("#answer2").val(),
                answer3: $("#answer3").val(), answer4: $("#answer4").val(),
                answer5: $("#answer5").val(), start: <?php echo time(); ?>,
                userid: <?php echo system\Helper::arcGetUser()->id; ?>, questionid: <?php echo $multistage->id; ?>},
            complete: function (data) {
                updateStatus("status");
            }
        })
    });

    $("#newquestion").click(function () {
        location.reload();
    });
</script>