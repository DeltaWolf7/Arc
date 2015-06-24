<div class="page-header">
    <h1>Skype Session Manager</h1>
</div>




<table class="table table-bordered" id="printTable">
    <thead>
        <tr><th>Mon</th><th>Tue</th><th>Wed</th><th>Thur</th><th>Fri</th><th>Sat</th><th>Sun</th></tr>
    </thead>
    <tbody>
        <?php
        $today = date("d-m-Y");

        $date = date("d-m-Y");
        while (date("w", strtotime($date)) != 1) {
            $date = strtotime(date("d-m-Y", strtotime($date)) . " -1 day");
            $date = date("d-m-Y", $date);
        }

        $count = 0;
        $mark = 0;
        $on = 0;
        while ($count < 28) {
            if ($mark == 0) {
                echo "<tr>";
            }


            if ($date == $today) {
                echo "<td class=\"warning\">";
                if ($on == 0) {
                    $on = 1;
                } else {
                    $on = 0;
                }
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

<div class="text-right"><a class="btn btn-default btn-xs" onclick="printData();"><i class="fa fa-print"></i> Print</a></div>


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

    function printData()
    {
        var divToPrint = document.getElementById("printTable");
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }
</script>