<form role="form">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">&nbsp;</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="key">Key</label>
                    <input maxlength="100" type="text" class="form-control" id="key" placeholder="Setting key" value="<?php echo $setting->key; ?>">
                </div>
                <div class="form-group">
                    <label for="value">Value</label>
                    <input maxlength="255" type="text" class="form-control" id="value" placeholder="Setting value" value="<?php echo $setting->setting; ?>">
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-danger">Delete</button>
    </form>