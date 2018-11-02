<?php

if (system\Helper::arcIsAjaxRequest()) {

        $id = ArcDownload::getByID($_POST["id"]);
        $images = ArcDownloadImage::getAllByDownloadID($_POST["id"]);
        $stats = ArcDownloadStat::getAllByDownloadID($_POST["id"]);

        $id->delete();

        foreach ($images as $image) {
            $image->delete();
        }

        foreach ($stats as $stat) {
            $stat->delete();
        }

        system\Helper::arcReturnJSON([]);
}