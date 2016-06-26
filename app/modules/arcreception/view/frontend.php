<?php
system\Helper::arcCheckSettingExists("ARCREC_LOGO", "");
$logo = SystemSetting::getByKey("ARCREC_LOGO");
?>

<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-6">Welcome</div>
            <div class="col-md-6 text-right">
                <?php if (!empty($logo->value)) { echo "<img src=\"" . $logo->value . "\" />"; } ?>
            </div>
        </div>
    </div>
</header>

<div id="data"></div>