<?php
$path = system\Helper::arcGetPath();

function generateLink($name, $url) {
    ?>
    <li>
        <a href="<?php echo $url; ?>"><?php echo ucfirst($name); ?></a>
    </li>
    <?php
}
?>

<div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home home-icon"></i>
            <a href="<?php echo $path; ?>">Home</a>
        </li>

        <?php
        $path .= system\Helper::arcGetURLData("module");
        generateLink(system\Helper::arcGetURLData("module"), $path);

        if (system\Helper::arcGetURLData("administration") == true) {
            $path .= "/administration";
            generateLink("Administration", $path);
        }

        $path .= "/" . system\Helper::arcGetURLData("action");
        generateLink(system\Helper::arcGetURLData("action"), $path);
        ?>
    </ul>
</div>