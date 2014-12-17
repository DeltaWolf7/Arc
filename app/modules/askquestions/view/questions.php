<div class="page-header">
    <h1>Questions</h1>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped" id="data">

            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="questionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Questions</h4>
      </div>
      <div class="modal-body" id="questionData">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
    var time;
    
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
    $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "getGroup", id: grpid},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $('#questionData').html(jdata.html);
                time = jdata.time;
            },
            complete: function() {
                $("questionModal").modal("show");
            }
        });
    }
    
    $(document).ready(function () {
        getQuestions();
    });
</script>