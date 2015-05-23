<div class="page-header">
    <h1>Skype Session</h1>
</div>


<form>
    <div class="form-group">
        <label for="day">When (within 10 days)</label>
        <select type="text" class="form-control" id="day">
            <?php
            $date = date("d-m-Y");
            $count = 1;
            while ($count < 10) {
                $date = strtotime(date("d-m-Y", strtotime($date)) . " +1 day");
                $date = date("d-m-Y",$date);
                echo "<option>{$date}</option>";
                $count++;
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="time">Time</label>
        <select type="text" class="form-control" id="time">
            <option>10:00</option>
            <option>10:30</option>
            <option>11:00</option>
            <option>11:30</option>
            <option>12:00</option>
            <option>12:30</option>     
            <option>13:00</option>
            <option>13:30</option>
            <option>14:00</option>
            <option>14:30</option>
        </select>
    </div>
    <button type="button" class="btn btn-default" onclick="send()">Submit</button>
</form>

<div id="status"></div>

<script>
    function send() {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "send", id: <?php echo system\Helper::arcGetUser()->id; ?>, day: $("#day").val(), time: $("#time").val()},
            complete: function (data) {
                updateStatus("status", null);
            }
        });
    }
</script>