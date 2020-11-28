<?php
if (is_numeric(system\Helper::arcGetLastURIItem())) {
    $user = User::getByID(system\Helper::arcGetLastURIItem());
    if ($user->id > 0) {
        $logs = Log::getByUserID($user->id, 0, 20);
?>
<h4 class="mt-3">Latest Logs</h4>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead class="thead-default">
            <tr>
                <th>Type</th>
                <th>Module</th>
                <th>When</th>
                <th>Imp</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <?php
    foreach ($logs as $log) {
?>
            <tr>
                <td>
                    <?php
        switch ($log->type) {
            case "success":
                ?>
                    <span class="badge badge-success"><i class="fa fa-check"></i><span>
                            <?php
                break;
            case "info":
                ?>
                            <span class="badge badge-info"><i class="fa fa-info-circle"></i><span>
                                    <?php
                break;
            case "danger":
                ?>
                                    <span class="badge badge-danger"><i class="fa fa-exclamation-circle"></i><span>
                                            <?php
                break;
            case "warning":
                ?>
                                            <span class="badge badge-warning"><i
                                                    class="fa fa-exclamation-triangle"></i><span>
                                                    <?php
                break;
        }
        ?>
                </td>
                <td class="text-sm"><?php echo $log->module; ?></td>
                <td class="text-sm" style="width: 150px;"><?php echo system\Helper::arcConvertDateTime($log->event); ?>
                </td>
                <?php
        if ($log->impersonate == 1) {
            ?>
                <td class="text-sm"><i class="fa fa-check text-success"></i></td>
                <?php
        } else {
            ?>
                <td class="text-sm"><i class="fa fa-times text-danger"></i></td>
                <?php
        }
        ?>
                <td class="text-sm"><?php echo $log->message; ?></td>
            </tr>
            <?php
    }
    ?>
        </tbody>
    </table>
</div>
<?php
    }
}
?>