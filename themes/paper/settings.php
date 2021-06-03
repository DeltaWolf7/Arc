<?php

    $paper_enable = SystemSetting::getByKey("PAPER_ENABLE");
    $paper_sidebar_colour = SystemSetting::getByKey("PAPER_SIDEBAR_COLOUR");
    $paper_sidebar_logocolour = SystemSetting::getByKey("PAPER_SIDEBAR_LOGOCOLOUR");
    $paper_sidebar_iconcolour = SystemSetting::getByKey("PAPER_SIDEBAR_ICONCOLOUR");
    $paper_sidebar_menuheader = SystemSetting::getByKey("PAPER_SIDEBAR_MENUHEADER");
    $paper_sidebar_link = SystemSetting::getByKey("PAPER_SIDEBAR_LINK");
    $paper_header_colour = SystemSetting::getByKey("PAPER_HEADER_COLOUR");
    $paper_font_colour = SystemSetting::getByKey("PAPER_FONT_COLOUR");
    $paper_page_colour = SystemSetting::getByKey("PAPER_PAGE_COLOUR");

    if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
        if (isset($_POST["papEnable"]) && $_POST["papEnable"] == "Yes") {
            $paper_enable->value = "true";
            $paper_enable->update();
        } elseif (isset($_POST["papEnable"])) {
            $paper_enable->value = "false";
            $paper_enable->update();
        }
        
        if (isset($_POST["papSBBG"])) {
            $paper_sidebar_colour->value = $_POST["papSBBG"];
            $paper_sidebar_colour->udpate();
        }

        if (isset($_POST["papSBHC"])) {
            $paper_sidebar_logocolour->value = $_POST["papSBHC"];
            $paper_sidebar_logocolour->udpate();
        }

        if (isset($_POST["papSBIC"])) {
            $paper_sidebar_iconcolour->value = $_POST["papSBIC"];
            $paper_sidebar_iconcolour->udpate();
        }

        if (isset($_POST["papSBMH"])) {
            $paper_sidebar_menuheader->value = $_POST["papSBMH"];
            $paper_sidebar_menuheader->udpate();
        }

        if (isset($_POST["papSBLC"])) {
            $paper_sidebar_link->value = $_POST["papSBLC"];
            $paper_sidebar_link->udpate();
        }

        if (isset($_POST["papSBH"])) {
            $paper_header_colour->value = $_POST["papSBH"];
            $paper_header_colour->udpate();
        }

        if (isset($_POST["papSBF"])) {
            $paper_font_colour->value = $_POST["papSBF"];
            $paper_font_colour->udpate();
        }

        if (isset($_POST["papSBP"])) {
            $paper_page_colour->value = $_POST["papSBP"];
            $paper_page_colour->udpate();
        }

        ?>

        <div class="alert alert-success">
        Theme settings have been udpated.
        </div>

        <?php
    }

?>

<form method="post">
    <fieldset class="mt-3">
        <legend>Paper Settings</legend>
        <!-- Enable /-->
        <div class="row">
            <div class="col-md-6">

                <label for="papEnable" class="form-label">Enable Custom Styles</label>
                <select id="papEnable" class="form-select">
                    <option value="true" <?php
                                    if ($paper_enable->value == "true") {
                                        echo " selected";
                                    }
                                    ?>>Yes</option>
                    <option value="false" <?php
                                    if ($paper_enable->value == "false") {
                                        echo " selected";
                                    }
                                    ?>>No</option>
                </select>

            </div>
            <div class="col-md-6 pt-3">
                If enabled, allows Paper to use customer styles.
            </div>
        </div>

        <!-- Sidebar Colours /-->
        <div class="row">
            <div class="col-md-6">

                <label for="papSBBG" class="form-label">Sidebar Background Colour</label>
                <input id="papSBBG" class="form-control" value="<?php echo $paper_sidebar_colour->value; ?>"
                    placeholder="#000000" maxlength="7" />

            </div>
            <div class="col-md-6 pt-3">
                Sidebar/Menu background colour.
            </div>
        </div>

        <!-- Sidebar logo Colour /-->
        <div class="row">
            <div class="col-md-6">

                <label for="papSBHC" class="form-label">Sidebar Header Text Colour</label>
                <input id="papSBHC" class="form-control" value="<?php echo $paper_sidebar_logocolour->value; ?>"
                    placeholder="#000000" maxlength="7" />

            </div>
            <div class="col-md-6 pt-3">
                The colour of the site title in the header of the sidebar.
            </div>
        </div>

        <!-- Sidebar icon Colour /-->
        <div class="row">
            <div class="col-md-6">

                <label for="papSBIC" class="form-label">Sidebar Icon Colour</label>
                <input id="papSBIC" class="form-control" value="<?php echo $paper_sidebar_iconcolour->value; ?>"
                    placeholder="#000000" maxlength="7" />

            </div>
            <div class="col-md-6 pt-3">
                The colour of the icons on the sidebar.
            </div>
        </div>

        <!-- Sidebar menu headers Colour /-->
        <div class="row">
            <div class="col-md-6">

                <label for="papSBMH" class="form-label">Sidebar Menu Header Highlights</label>
                <input id="papSBMH" class="form-control" value="<?php echo $paper_sidebar_menuheader->value; ?>"
                    placeholder="#000000" maxlength="7" />

            </div>
            <div class="col-md-6 pt-3">
                The colour of the headers highlighted on the sidebar menu items.
            </div>
        </div>

        <!-- Sidebar link Colour /-->
        <div class="row">
            <div class="col-md-6">

                <label for="papSBLC" class="form-label">Sidebar Link Colour</label>
                <input id="papSBLC" class="form-control" value="<?php echo $paper_sidebar_link->value; ?>"
                    placeholder="#000000" maxlength="7" />

            </div>
            <div class="col-md-6 pt-3">
                The colour of the links in the sidebar.
            </div>
        </div>

        <!-- header Colour /-->
        <div class="row">
            <div class="col-md-6">

                <label for="papSBH" class="form-label">Page Header Colour</label>
                <input id="papSBH" class="form-control" value="<?php echo $paper_header_colour->value; ?>"
                    placeholder="#000000" maxlength="7" />

            </div>
            <div class="col-md-6 pt-3">
                The colour of the page headers.
            </div>
        </div>

        <!-- font Colour /-->
        <div class="row">
            <div class="col-md-6">

                <label for="papSBF" class="form-label">Page Font Colour</label>
                <input id="papSBF" class="form-control" value="<?php echo $paper_font_colour->value; ?>"
                    placeholder="#000000" maxlength="7" />

            </div>
            <div class="col-md-6 pt-3">
                The colour of font on general pages.
            </div>
        </div>

        <!-- page Colour /-->
        <div class="row">
            <div class="col-md-6">

                <label for="papSBP" class="form-label">Page Colour</label>
                <input id="papSBP" class="form-control" value="<?php echo $paper_page_colour->value; ?>"
                    placeholder="#000000" maxlength="7" />

            </div>
            <div class="col-md-6 pt-3">
                The colour of general pages.
            </div>
        </div>

    </fieldset>

    <div class="mt-3 text-end">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save Theme Settings</button>
    </div>
</form>