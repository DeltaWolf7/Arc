<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php system\Helper::arcGetHeader(); ?>
    <body class="no-skin">
        <div class="main-container" id="main-container">
            <div id="sidebar" class="sidebar responsive">
                <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                        <div class="logoBox">
                            <a href="<?php echo system\Helper::arcGetPath(); ?>">
                                <img src="<?php echo system\Helper::arcGetThemePath(); ?>images/logo.png" />
                            </a>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-list">
                    <?php system\Helper::arcGetMenu(); ?>
                </ul>
            </div>

            <div class="main-content">
                <div class="main-content-inner">
                    <?php
                    system\Helper::arcGetWidget("breadcrumb")
                    ?>
                    <div class="page-content">
                        <div class="row">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->