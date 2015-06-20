<div class="page-header">
    <h1>Skype Session</h1>
</div>


<table class="table table-bordered">
    <thead>
        <tr><th>Mon</th><th>Tue</th><th>Wed</th><th>Thur</th><th>Fri</th><th>Sat</th><th>Sun</th></tr>
    </thead>
    <tbody>
        <?php
        $date = date("d-m-Y");
        while (date("w", strtotime($date)) != 1) {
            $date = strtotime(date("d-m-Y", strtotime($date)) . " -1 day");
            $date = date("d-m-Y", $date);
        }

        $count = 0;
        $mark = 0;
        $on = 0;
        $today = date("d-m-Y");
        while ($count < 28) {
            if ($mark == 0) {
                echo "<tr>";
            }

            
            if ($date == $today) {
                echo "<td class=\"warning\">";
            } else {
                if ($on == 0) {
                    echo "<td>";
                    $on = 1;
                } else {
                    echo "<td class=\"active\">";
                    $on = 0;
                }
            }


            echo date_format(date_create($date), "d M");
            echo "<br />";

            $bookings = Skype::getByDateLike($date);
            $mark2 = 0;
            foreach ($bookings as $booking) {
                if ($booking->confirmed) {
                    echo "<span style=\"font-size: 10px;\" class=\"label ";
                    if ($mark2 == 0) {
                        $mark2 = 1;
                        echo "label-success";
                    } else {
                        $mark2 = 0;
                        echo "label-info";
                    }
                    echo "\">";

                    $user = new User();
                    $user->getByID($booking->userid);
                    $data = explode("@", $booking->booked);
                    echo $user->getFullname() . " @" . $data[1] . "</span><br />";
                }
            }

            echo "</td>";

            $date = strtotime(date("d-m-Y", strtotime($date)) . " +1 day");
            $date = date("d-m-Y", $date);
            $mark++;

            if ($mark == 7) {
                echo "</tr>";
                $mark = 0;
            }
            $count++;
        }
        ?>
    </tbody>
</table>

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
    <div class="alert alert-warning">
        <strong>Warning</strong> Booking multiple sessions within the same week is abuse of the privilege and will result in your sessions being cancelled. You have been warned!
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