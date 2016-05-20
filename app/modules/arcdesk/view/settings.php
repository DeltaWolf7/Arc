<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Keep Logs for</span>
                <input id="keepLogsDays" type="number" class="form-control" placeholder="30" value="<?php echo $logs->value; ?>">
                <span class="input-group-addon">days</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">File upload size limit</span>
                <input id="uploadLimit" type="number" class="form-control" placeholder="2000000" value="<?php echo $file_size->value; ?>">
                <span class="input-group-addon">bytes</span>
            </div>
        </div>
    </div>
</div>
