<div class="page-header">
    <h1>Question Editor</h1>
</div>

<p  class="text-right">
    <button class="btn btn-default btn-sm" data-toggle="modal" onclick="editGroup(0);"><span class="fa fa-plus"></span> New Question Group</button>
</p>

<div id="data">

</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">New Group</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="group" />
                    </div>
                    <div class="form-group">
                        <label>Text</label>
                        <textarea id="text" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" id="visible" /> Visible to students?</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveGroup();">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Group /-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Group</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="editgroup">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="editButton" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Group</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to permanently delete this group?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" onclick="doDeleteGroup();">Yes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteQuestionModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Question</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to permanently delete this question?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" onclick="doDeleteQuestion();">Yes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="questionModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Question Editor</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="question">Question</label>
                        <div class="summernote"></div>
                    </div>
                    <div class="form-group">
                        <label for="answer1">Answer 1</label>
                        <input type="text" class="form-control" id="answer1" />
                    </div>
                    <div class="form-group">
                        <label for="answer2">Answer 2</label>
                        <input type="text" class="form-control" id="answer2" />
                    </div>
                    <div class="form-group">
                        <label for="answer3">Answer 3</label>
                        <input type="text" class="form-control" id="answer3" />
                    </div>
                    <div class="form-group">
                        <label for="answer4">Answer 4</label>
                        <input type="text" class="form-control" id="answer4" />
                    </div>
                    <div class="form-group">
                        <label for="answer5">Answer 5</label>
                        <input type="text" class="form-control" id="answer5" />
                    </div>
                    <div class="form-group">
                        <label for="correct">Correct Answer</label>
                        <select id="correct" class="form-control">
                            <option value="1">Answer 1</option>
                            <option value="2">Answer 2</option>
                            <option value="3">Answer 3</option>
                            <option value="4">Answer 4</option>
                            <option value="5">Answer 5</option>
                        </select>
                    </div>
                    <div class="form-group" id="groupSelect">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveQuestion();">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="resultsModal" tabindex="-1" role="dialog" aria-labelledby="resultsModal" aria-hidden="true">
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
    var question;
    var questions;
    var group;

    function editGroup(id) {
        group = id;
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "getgroup", id: group},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $("#group").val(jdata.name);
                $("#text").val(jdata.txt);
                $("#visible").prop('checked', jdata.visible);
                $("#myModal").modal("show");
            }
        });
    }

    function deleteGroup(id) {
        group = id;
        $("#deleteModal").modal("show");
    }

    function doDeleteGroup() {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "deletegroup", id: group},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                updateStatus(jdata.status, jdata.data);
                $("#deleteModal").modal("hide");
                getData();
            }
        });
    }

    function saveGroup() {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "savegroup", group: $("#group").val(), text: $("#text").val(), id: group, visible: $("#visible").prop("checked")},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                updateStatus(jdata.status, jdata.data);
                if (jdata.status == "success") {
                    $("#myModal").modal("hide");
                    getData();
                }
            }
        });
    }

    function deleteQuestion(id) {
        question = id;
        $("#deleteQuestionModal").modal("show");
    }

    function doDeleteQuestion() {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "deletequestion", id: question},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                updateStatus(jdata.status, jdata.data);
                $("#deleteQuestionModal").modal("hide");
                getQuestions(questions);
            }
        });
    }

    function getData() {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "getgroups"},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $("#data").html(jdata.html);
            }
        });
    }

    function getQuestions(id) {
        questions = id;
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "getquestions", id: id},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $("#data").html(jdata.html);
            }
        });
    }

    function getQuestion(id) {
        question = id;
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "getquestion", id: id, group: questions},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $('.summernote').code(jdata.question);
                $("#answer1").val(jdata.answer1);
                $("#answer2").val(jdata.answer2);
                $("#answer3").val(jdata.answer3);
                $("#answer4").val(jdata.answer4);
                $("#answer5").val(jdata.answer5);
                $("#groupSelect").html(jdata.group);
                $("#correct").val(jdata.correct);
                $("#questionModal").modal("show");
            }
        });
    }

    function saveQuestion() {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "savequestion", id: question, question: $('.summernote').code(),
                answer1: $("#answer1").val(), answer2: $("#answer2").val(), answer3: $("#answer3").val(),
                answer4: $("#answer4").val(), answer5: $("#answer5").val(), group: $("#groupS").val(), correct: $("#correct").val()},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                updateStatus(jdata.status, jdata.data);
                if (jdata.status == "success") {
                    $("#questionModal").modal("hide");
                    getQuestions(questions);
                }
            }
        });
    }
    
    function viewResults(id) {
        groups = id;
        $("#resultsModal").modal("show");
         $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "getresults", id: groups},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $("#resultsData").html(jdata.data);
            }
        });
    }
    
    function viewResult(userid, groupid) {
        $("#resultsModal").modal("show");
         $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "getresult", id: userid, group: groupid},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $("#resultsData").html(jdata.data);
            }
        });
    }
    
    function copyQuestion(id) {
         $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "copyquestion", id: id},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                updateStatus(jdata.status, jdata.data);
                getQuestions(questions);
            }
        });
    }

    $(document).ready(function () {
        $('.summernote').summernote({height: 250});
        getData();
    });
</script>
