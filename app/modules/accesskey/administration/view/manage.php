<div class="page-header">
    <h1><i class="fa fa-key"></i> User Access Keys</h1>
</div>

<table class="table table-hover table-condensed">
    <thead><tr><th>Firstname</th><th>Lastname</th><th>Email</th><th>Status</th><th>Key</th><th class="text-right"></thead>
    <tbody>
        <?php
        $users = User::getAllUsers();
        foreach ($users as $user) {
            echo "<tr><td>{$user->firstname}</td><td>{$user->lastname}</td><td>{$user->email}</td><td>";
            if ($user->enabled) {
                echo "<div class=\"label label-success\"><i class=\"fa fa-check\"></i></div>";
            } else {
                echo "<div class=\"label label-danger\"><i class=\"fa fa-close\"></i></div>";
            }
            echo "</td>";
            echo "<td>";
            $access = AccessKey::getUserKey($user->id);
            if ($access != null) {
                echo $access->setting;
            }
            echo "</td>";
            echo "<td class=\"text-right\">";
            echo "<a onclick=\"generate({$user->id});\" class=\"btn btn-default btn-xs\"><i class=\"fa fa-plus\"></i>&nbsp;Generate Key</a>";
            echo "</td></tr>";
        }
        ?>
    </tbody>
</table>


<script>
    function generate(userid) {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {user: userid},
            complete: function (data) {
                location.reload();
            }
        });
    }
    </script>