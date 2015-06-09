<div class="page-header">
    <h1>Skype Session</h1>
</div>


<form>
    <div class="form-group">
        <label for="day">When (within 10 days, excluding Monday and Sunday)</label>
        <select type="text" class="form-control" id="day" onchange="dateChange();">
            <?php
            $date = date("d-m-Y");
            $count = 1;
            while ($count <= 10) {
                $date = strtotime(date("d-m-Y", strtotime($date)) . " +1 day");
                $date = date("d-m-Y", $date);
                // dont allow mondays/sundays
                if ((date("w", strtotime($date)) != 1) && (date("w", strtotime($date)) != 0)) {
                    echo "<option>{$date}</option>";
                    $count++;
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="time">Time</label>
        <select type="text" class="form-control" id="time" onchange="timeChange()">
            <option>16:00</option>
            <option>16:30</option>
            <option>17:00</option>
            <option>17:30</option>
            <option>18:00</option>
        </select>
    </div>
    <div class="form-group">
        <label for="ds">Booking Information</label>
        <div id="ds" class="form-control">Not selected</div>
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

    function dateChange() {
        var data = $("#day").val().split("-");
        var time = $("#time").val().split(":");
        // small hack to correct month being out by 1.
        var today = new Date(data[2], data[1] - 1, data[0], time[0], time[1], 00);
        if (today.getDay() == 6) {
            $("#time")
                    .empty()
                    .append('<option selected="selected">10:00</option><option>10:30</option><option>11:00</option><option>11:30</option><option>12:00</option><option>12:30</option><option>13:00</option><option>13:30</option><option>14:00</option><option>14:30</option><option>15:00</option>');
        } else {
            $("#time")
                    .empty()
                    .append('<option selected="selected">16:00</option><option>16:30</option><option>17:00</option><option>17:30</option><option>18:00</option>');
        }
        $("#ds")
                .empty()
                .append('Date selected: ' + today);
    }

    function timeChange() {
        var data = $("#day").val().split("-");
        var time = $("#time").val().split(":");
        // small hack to correct month being out by 1.
        var today = new Date(data[2], data[1] - 1, data[0], time[0], time[1], 00);
        $("#ds")
                .empty()
                .append('Date selected: ' + today);
    }
    
    $(document).ready(function () {
        timeChange();
    });
</script>