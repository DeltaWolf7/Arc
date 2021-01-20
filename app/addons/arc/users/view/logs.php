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
                <th scope="col">Type</th>
                <th scope="col">Module</th>
                <th scope="col">When</th>
                <th scope="col">Imp</th>
                <th scope="col">Message</th>
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
                    <span class="badge badge-success"><em class="fa fa-check"></em><span>
                            <?php
                break;
            case "info":
                ?>
                            <span class="badge badge-info"><em class="fa fa-info-circle"></em><span>
                                    <?php
                break;
            case "danger":
                ?>
                                    <span class="badge badge-danger"><em class="fa fa-exclamation-circle"></em><span>
                                            <?php
                break;
            case "warning":
                ?>
                                            <span class="badge badge-warning"><em class="fa fa-exclamation-triangle"></em><span>
                                                    <?php
                break;
                default:
                ?>
                                    <span class="badge badge-danger"><i class="fa fa-exclamation-circle"></i><span>
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