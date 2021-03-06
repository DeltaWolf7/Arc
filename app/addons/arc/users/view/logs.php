<?php
if (is_numeric(system\Helper::arcGetLastURIItem())) {
    $user = User::getByID(system\Helper::arcGetLastURIItem());
    if ($user->id > 0) {
        $logs = Log::getByUserID($user->id, 0, 20);
?>
<div class="card">
    <div class="card-body">
        <h4 class="mt-3">Latest Logs</h4>
        <div class="table-responsive">
            <table class="table table-striped align-middle table-sm" aria-label="Logs">
                <thead class="text-primary">
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
                            <span class="badge bg-success"><i class="fa fa-check"></i><span>
                                    <?php
                break;
            case "info":
                ?>
                                    <span class="badge bg-info"><i class="fa fa-info-circle"></i><span>
                                            <?php
                break;
            case "danger":
                ?>
                                            <span class="badge bg-danger"><i
                                                    class="fa fa-exclamation-circle"></i><span>
                                                    <?php
                break;
            case "warning":
                ?>
                                                    <span class="badge bg-warning"><i
                                                            class="fa fa-exclamation-triangle"></i><span>
                                                            <?php
                break;
                default:
                ?>
                                                            <span class="badge bg-danger"><i
                                                                    class="fa fa-exclamation-circle"></i><span>
                                                                    <?php
                break;
        }
        ?>
                        </td>
                        <td class="text-sm"><?php echo $log->module; ?></td>
                        <td class="text-sm" style="width: 150px;">
                            <?php echo system\Helper::arcConvertDateTime($log->event); ?>
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
    </div>
</div>
<?php
    }
}
?>