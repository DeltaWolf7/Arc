<div class="page-header">
    <h1>Questions</h1>
</div>


<div class="table-responsive">
    <table class="table table-hover table-condensed" id="data">
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="questionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onclick="doClose();" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Questions</h4>
            </div>
            <div class="modal-body" id="questionData">

            </div>
            <div class="modal-footer">
                <p><i class="fa fa-exclamation-circle"></i> You can take a break at any time by clicking the close button. Your progress will be saved.</p> 
                <button id="prevBtn" type="button" class="btn btn-default" onclick="previousQuestion();"><i class="fa fa-backward"></i> Previous</button>
                <button id="nextBtn" type="button" class="btn btn-primary" onclick="nextQuestion();"><i class="fa fa-forward"></i> Next</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="doClose();"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="resultsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="width: 900px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Results</h4>
            </div>   
                <div class="modal-body" id="resultsData table-responsive">
                </div>      
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    var time;
    var question = 0;
    var groupid;
    var qid;

    function getResult(id) {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "getresults", grpid: id, id: <?php echo system\Helper::arcGetUser()->id; ?>},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $('#resultsData').html(jdata.html);
                $('#resultsModal').modal("show");
            }
        });
    }

    function getQuestions() {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "getQuestions"},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $('#data').html(jdata.html);
            }
        });
    }

    function getGroup(grpid) {
        groupid = grpid;
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "getGroup", id: grpid, question: question},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $('#questionData').html(jdata.html);
                time = jdata.time;
                qid = jdata.questionid;
                $("#nextBtn").prop("disabled", false);
                if (jdata.done == true) {
                    $("#nextBtn").prop("disabled", true);
                }
            },
            complete: function () {
                $("#questionModal").modal("show");
            }
        });
    }

    function nextQuestion() {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "saveresult", grpid: groupid,
                question: question, id: <?php echo system\Helper::arcGetUser()->id; ?>,
                time: time, answer: $("#answer").val(), qid: qid},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                updateStatus(jdata.status, jdata.data);
            },
            complete: function () {
                question = question + 1;
                getGroup(groupid);
            }
        });
    }

    function previousQuestion() {
        if (question > 0) {
            question = question - 1;
            $("#nextBtn").prop("disabled", false);
            getGroup(groupid);
        }
    }

    function doClose() {
        question = 0;
        getQuestions();
    }

    $(document).ready(function () {
        getQuestions();
    });
</script>