<div class="page-header">
    <h1>Multistage Manager</h1>
</div>

<div id="data" class="table-responsive">
</div>

<div id="status"></div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Edit Question</h4>
            </div>
            <div class="modal-body">
                <div role="tabpanel">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#master" aria-controls="master" role="tab" data-toggle="tab">Master Question</a></li>
                        <li role="presentation"><a href="#question1" aria-controls="question1" role="tab" data-toggle="tab">Question 1</a></li>
                        <li role="presentation"><a href="#question2" aria-controls="question2" role="tab" data-toggle="tab">Question 2</a></li>
                        <li role="presentation"><a href="#question3" aria-controls="question3" role="tab" data-toggle="tab">Question 3</a></li>
                        <li role="presentation"><a href="#question4" aria-controls="question4" role="tab" data-toggle="tab">Question 4</a></li>
                        <li role="presentation"><a href="#question5" aria-controls="question5" role="tab" data-toggle="tab">Question 5</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="master">
                            <div class="form-group">
                                <label>Master Question</label>
                                <div class="masterQuestion"></div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="question1">
                            <div class="form-group">
                                <label>Question 1</label>
                                <div class="question1"></div>
                            </div>
                            <div class="form-group">
                                <label>Answer 1</label>
                                <input type="text" class="form-control" id="answer1" maxlength="50" />
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="question2">
                            <div class="form-group">
                                <label>Question 2</label>
                                <div class="question2"></div>
                            </div>
                            <div class="form-group">
                                <label>Answer 2</label>
                                <input type="text" class="form-control" id="answer2" maxlength="50" />
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="question3">
                            <div class="form-group">
                                <label>Question 3</label>
                                <div class="question3"></div>
                            </div>
                            <div class="form-group">
                                <label>Answer 3</label>
                                <input type="text" class="form-control" id="answer3" maxlength="50" />
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="question4">
                            <div class="form-group">
                                <label>Question 4</label>
                                <div class="question4"></div>
                            </div>
                            <div class="form-group">
                                <label>Answer 4</label>
                                <input type="text" class="form-control" id="answer4" maxlength="50" />
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="question5">
                            <div class="form-group">
                                <label>Question 5</label>
                                <div class="question5"></div>
                            </div>
                            <div class="form-group">
                                <label>Answer 5</label>
                                <input type="text" class="form-control" id="answer5" maxlength="50" />
                            </div>
                        </div>
                    </div></div>

            </div>
            <div class="modal-footer">
                <div id="status2" class="text-left"></div>
                <a class="btn btn-default" data-dismiss="modal">Close</a>
                <a class="btn btn-primary" id="sendbtn">Save</a>
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
    var Xeditor;
    var XwelEditable;
    $(document).ready(function () {
        $('.masterQuestion').summernote({height: 250,
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
        function sendFile(file, editor, welEditable) {
            Xeditor = editor;
            XwelEditable = welEditable;
            data = new FormData();
            data.append("file", file);
            $.ajax({
                data: data,
                url: "<?php system\Helper::arcGetDispatch(); ?>",
                cache: false,
                type: "post",
                contentType: false,
                processData: false,
                dataType: "json"
            });
            updateStatus("status", updateStatus2Callback);
            $("body").removeClass();
            $("body").addClass("modal-open");
        }

        $('.question1').summernote({height: 250,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['insert', ['sub', 'super', 'charsDropdown']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['source', ['codeview']]
            ]
        });
        $('.question2').summernote({height: 250,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['insert', ['sub', 'super', 'charsDropdown']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['source', ['codeview']]
            ]
        });
        $('.question3').summernote({height: 250,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['insert', ['sub', 'super', 'charsDropdown']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['source', ['codeview']]
            ]
        });
        $('.question4').summernote({height: 250,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['insert', ['sub', 'super', 'charsDropdown']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['source', ['codeview']]
            ]
        });
        $('.question5').summernote({height: 250,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['insert', ['sub', 'super', 'charsDropdown']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['source', ['codeview']]
            ]
        });
        getData();
    });
    function updateStatus2Callback(data) {
        if (data.danger == 0) {
            Xeditor.insertImage(XwelEditable, jdata.data);
        }
    }

    function getData() {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "getQuestions"},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $("#data").html(jdata.html);
            }
        })
    }

    function deleteQuestion(id) {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "deleteQuestion", id: id}
        })
        getData();
        updateStatus("status");
    }

    var selectedid;
    function editQuestion(id) {
        selectedid = id;
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "editQuestion", id: id},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $(".masterQuestion").code(jdata.masterQuestion);
                $(".question1").code(jdata.question1);
                $(".question2").code(jdata.question2);
                $(".question3").code(jdata.question3);
                $(".question4").code(jdata.question4);
                $(".question5").code(jdata.question5);
                $("#answer1").val(jdata.answer1);
                $("#answer2").val(jdata.answer2);
                $("#answer3").val(jdata.answer3);
                $("#answer4").val(jdata.answer4);
                $("#answer5").val(jdata.answer5);
                $("#editModal").modal("show");
            }
        })
    }

    function genQuestions() {
        $("#builderModal").modal("show");
    }

    $("#sendbtn").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "saveQuestion", masterquestion: $('.masterQuestion').code(), id: selectedid,
                question1: $('.question1').code(), question2: $('.question2').code(), question3: $('.question3').code(),
                question4: $('.question4').code(), question5: $('.question5').code(), answer1: $("#answer1").val(),
                answer2: $("#answer2").val(), answer3: $("#answer3").val(), answer4: $("#answer4").val(), answer5: $("#answer5").val()}
        })
        updateStatus("status2", null);
        getData();
    });

    var qid;
    function results(id) {
        qid = id;
        $("#resultsModal").modal("show");
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "getresults", id: qid},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $("#resultsData").html(jdata.data);
            }
        });
    }
</script>