<div class="page-header">
    <h1>Question Editor</h1>
</div>

<div id="data">

</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">New Group</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="group" maxlength="255" />
                </div>
                <div class="form-group">
                    <label>Text</label>
                    <textarea id="text" class="form-control" rows="5"></textarea>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" id="visible" /> Visible to students?</label>
                </div>

            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">Close</a>
                <a class="btn btn-primary" id="saveGroupBtn">Save</a>
            </div>
        </div>
    </div>
</div>

<!-- Edit Group /-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
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
                <a class="btn btn-default" data-dismiss="modal">Close</a>
                <a id="editButton" class="btn btn-primary">Save</a>
            </div>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Delete Group</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to permanently delete this group?
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">No</a>
                <a class="btn btn-danger" id="doDeleteGroupBtn">Yes</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteQuestionModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Delete Question</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to permanently delete this question?
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">No</a>
                <a class="btn btn-danger" id="doDeleteQuestionBtn">Yes</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="questionModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Question Editor</h4>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist" id="myTab">
                    <li role="presentation" class="active"><a href="#question" aria-controls="Question" role="tab" data-toggle="tab">Question</a></li>
                    <li role="presentation"><a href="#answers" aria-controls="answers" role="tab" data-toggle="tab">Answers</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="question">
                        <div class="form-group">
                            <label for="question">Question</label>
                            <div class="summernote"></div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="answers">
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
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">Close</a>
                <a class="btn btn-primary" id="saveQuestionBtn">Save</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="resultsModal" tabindex="-1" role="dialog" aria-labelledby="resultsModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="width: 900px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Results</h4>
            </div>

            <div class="modal-body" id="resultsData">

            </div>

            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">Close</a>
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

    $("#doDeleteGroupBtn").click(function () {
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
    });

    $("#saveGroupBtn").click(function () {
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
    });

    function deleteQuestion(id) {
        question = id;
        $("#deleteQuestionModal").modal("show");
    }

    $("#doDeleteQuestionBtn").click(function () {
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
    });

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

    $("#saveQuestionBtn").click(function () {
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
    });

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
        $('.summernote').summernote({height: 250,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['link', ['link', 'picture', 'hr']],
                ['source', ['codeview']]
            ],
            onChange: function (contents, $editable) {
                $("body").removeClass();
                $("body").addClass("modal-open");
            }
        });
        getData();
    });
</script>
