<div class="page-header">
    <h1>Skype Session Manager</h1>
</div>


<h3>Unconfirmed</h3>
<table class="table table-condensed">
    <tr>
        <th>Who</th><th>When</th><th></th>
    </tr>
    <?php
    $skype = Skype::getBookings(false);
    foreach ($skype as $sky) {
        $user = new User();
        $user->getByID($sky->userid);
        echo "<tr><td>" . $user->getFullname() . "</td><td>" . $sky->booked . "</td><td class=\"text-right\"><a class=\"btn btn-default btn-xs\" onclick=\"confirm(" . $sky->id . ")\"><i class=\"fa fa-check\"></i> Confirm</a></td></tr>";
    }
    ?>
</table>


<h3>Confirmed</h3>
<table class="table table-condensed">
    <tr>
        <th>Who</th><th>When</th><th></th>
    </tr>
<?php
$skype = Skype::getBookings(true);
foreach ($skype as $sky) {
    $user = new User();
    $user->getByID($sky->userid);
    echo "<tr><td>" . $user->getFullname() . "</td><td>" . $sky->booked . "</td><td class=\"text-right\"><a class=\"btn btn-default btn-xs\" onclick=\"unconfirm(" . $sky->id . ")\"><i class=\"fa fa-close\"></i> Unconfirm</a></td></tr>";
}
?>
</table>


<script>
    function confirm(id) {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "confirm", id: id},
            complete: function (data) {
                location.reload();
            }
        });
    }

    function unconfirm(id) {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "unconfirm", id: id},
            complete: function (data) {
                location.reload();
            }
        });
    }
</script>