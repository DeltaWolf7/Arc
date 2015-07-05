<div class="page-header">
    <h1>Skype Session History</h1>
</div>

<table class="table table-striped table-responsive">
    <thead>
        <tr>
            <td>Date/Time</td><td>Name</td><td>Notes</td><td>&nbsp;</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $history = Skype::getBookings(true);
        $no = 0;
        foreach ($history as $item) {
            $user = new User();
            $user->getByID($item->userid);
            echo "<tr><td>{$item->booked}</td><td>{$user->getFullname()}</td><td><textarea id=\"note" . $no . "\" rows=\"5\" cols=\"40\">{$item->note}</textarea></td><td class=\"text-right\"><a class=\"btn btn-default\" onclick=\"saveNote({$item->id}, {$no})\"><i class=\"fa fa-save\"></i> Save</a></td></tr>";
            $no++;
        }
        ?>
    </tbody>
</table>

<div id="status"></div>


<script>
    function saveNote(id, no) {
        var note = $("#note" + no).val();
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "saveNote", id: id, data: note},
            complete: function (data) {
                updateStatus("status", null);
            }
        });
    }
</script>