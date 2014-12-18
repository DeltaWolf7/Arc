<div class="page-header">
    <h1>Questions</h1>
</div>


<div class="table-responsive">
    <table class="table table-striped" id="data">

    </table>
</div>


<!-- Modal -->
<div class="modal fade" id="questionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onclick="doClose();" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Questions</h4>
            </div>
            <div class="modal-body" id="questionData">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="doClose();">Close</button>
                <button id="nextBtn" type="button" class="btn btn-primary" onclick="nextQuestion();">Next</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="resultsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Results</h4>
            </div>
            <div class="modal-body" id="resultsData">

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
                $("#nextBtn").prop("disabled", false);
                if (jdata.done == true) {
                    question = 0;
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
                time: time, answer: $("#answer").val()},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                updateStatus(jdata.status, jdata.data);
            },
            complete: function () {
                $("#questionModal").modal("hide");
                setTimeout(function () {
                    question = question + 1;
                    getGroup(groupid);
                }, 500);
            }
        });
    }

    function doClose() {
        question = 0;
        getQuestions();
    }

    $(document).ready(function () {
        getQuestions();
    });
</script>