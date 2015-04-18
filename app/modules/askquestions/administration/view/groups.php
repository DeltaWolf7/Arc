<div class="page-header">
    <h1>Question Editor</h1>
</div>

<div id="data" class="table-responsive">
</div>

<div id="status"></div>

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
            <div class="modal-body table-responsive" id="resultsData">
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
            data: {action: "deletegroup", id: group}
        });
        updateStatus("status", null);
        $("#deleteModal").modal("hide");
        getData();
    });

    function deleteGroupResults(id) {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "deletegroupresults", id: id}
        });
        updateStatus("status");
        getData();
    }

    $("#saveGroupBtn").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "savegroup", group: $("#group").val(), text: $("#text").val(), id: group, visible: $("#visible").prop("checked")}
        });
        updateStatus("status", updateStatusYCallback);
    });

    function updateStatusYCallback(data) {
        if (data.danger == 0) {
            $("#myModal").modal("hide");
            getData();
        }
    }

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
            data: {action: "deletequestion", id: question}
        });
        updateStatus("status", null);
        $("#deleteQuestionModal").modal("hide");
        getQuestions(questions);
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
                answer4: $("#answer4").val(), answer5: $("#answer5").val(), group: $("#groupS").val(), correct: $("#correct").val()}
        });
        updateStatus("status", updateStatusCallback);
    });

    function updateStatusCallback(data) {
        if (data.danger == 0) {
            $("#questionModal").modal("hide");
            getQuestions(questions);
        }
    }

    function viewResults(id, pack) {
        groups = id;
        $("#resultsModal").modal("show");
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "getresults", id: groups, pack: pack},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $("#resultsData").html(jdata.data);
            }
        });
    }

    function archive(groupid) {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "archive", group: groupid}
        });
        $("#resultsModal").modal("hide");
        updateStatus("status", null);
    }

    function viewArchive(groupid) {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "viewArchive", group: groupid},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $("#resultsData").html(jdata.data);
                $("#resultsModal").modal("show");
            }
        });
    }

    function viewResult(userid, groupid, pack) {
        $("#resultsModal").modal("show");
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "getresult", id: userid, group: groupid, pack: pack},
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
            data: {action: "copyquestion", id: id}
        });
        updateStatus("status", null);
        getQuestions(questions);
    }

    $(document).ready(function () {
        $('.summernote').summernote({height: 250,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['insert', ['sub', 'super', 'charsDropdown']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['link', ['picture']],
                ['source', ['codeview']]
            ],
            onImageUpload: function (files, editor, welEditable) {
                sendFile(files[0], editor, welEditable);
            }
        });
        getData();
    });

    function sendFile(file, editor, welEditable) {
        data = new FormData();
        data.append("file", file);
        $.ajax({
            data: data,
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            cache: false,
            type: "post",
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                if (jdata.status == "success") {
                    editor.insertImage(welEditable, jdata.data);
                } else {
                    updateStatus("status", null);
                }
                $("body").removeClass();
                $("body").addClass("modal-open");
            }
        });
    }
</script>
