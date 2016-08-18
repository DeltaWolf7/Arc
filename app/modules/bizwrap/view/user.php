<?php
if (system\Helper::arcIsUserLoggedIn()) {

    $profileImage = SystemSetting::getByKey("ARC_USER_IMAGE", system\Helper::arcGetUser()->id);

    $image = "<i class=\"fa fa-user fa-5x\"></i>";
    if (!empty($profileImage->value)) {
        $image = "<img style=\"width: 160px; margin-bottom: 10px;\" class=\"img-thumbnail\" src=\"" . system\Helper::arcGetPath() . "assets/profile/" . $profileImage->value . "\" />";
    }
    ?>

    <div class="media user-media hidden-phone">
        <?php echo $image; ?><br />
        <div class="media-body hidden-tablet">
            <h5 class="media-heading"><?php echo system\Helper::arcGetUser()->getFullname(); ?></h5>
            <ul class="unstyled user-info">
                <li>Last Access : <br/>
                    <small><i class="icon-calendar"></i> <?php echo date("d/m/y G:i:s"); ?></small>
                </li>
            </ul>
        </div>
    </div>

    <?php
}
?>