<div class="card" id="postForm" style="display: none;">
    <div class="card-body">
        <div class="form-group">
            <label for="subject">Subject</label>
            <input class="form-control" id="subject">
        </div>
        <div class="form-group">
            <div id="summernote"></div>
        </div>
        <div class="form-group text-right">
            <button onclick="location.reload();" class="btn btn-danger">Cancel</button>
            <button id="savePost" class="btn btn-primary">Post</button>
        </div>
    </div>
</div>

<div class="card" id="replyForm" style="display: none;">
    <div class="card-body">
        <div class="form-group">
            <div id="rsummernote"></div>
        </div>
        <div class="form-group text-right">
            <button onclick="location.reload();" class="btn btn-danger">Cancel</button>
            <button id="replyPost" class="btn btn-primary">Reply</button>
        </div>
    </div>
</div>

<div class="card" id="catForm" style="display: none;">
    <div class="card-body">
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" class="form-control" id="category">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description">
        </div>
        <div class="form-group text-right">
            <button onclick="location.reload();" class="btn btn-danger">Cancel</button>
            <button id="saveCat" class="btn btn-primary">Save</button>
        </div>
    </div>
</div>

<div class="card" id="posts">
    <div class="card-body">
        <table class="table table-hover" id="html">
            
        </table>
    </div>
</div>