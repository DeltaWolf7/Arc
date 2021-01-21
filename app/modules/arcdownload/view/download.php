<?php

    $downloadid = system\Helper::arcGetModuleValues();
    $download = ArcDownload::getByID($downloadid[0]);
    if ($download->id == 0) {
?>

    <div class="card text-white bg-danger">
        <div class="card-body">
            <h5 class="card-title">Invalid Download</h5>
            <p class="card-text">ID <?php echo $downloadid[0]; ?> not found</p>   
        </div>
    </div>

<?php } else { ?>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo $download->title; ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo $download->version; ?></h6>
            <p class="card-text"><?php echo $download->description; ?></p>
            <p class="card-text"><a href="#" class="btn btn-primary">Download</a></p>
            <?php

                $images = ArcDownloadImage::getAllByDownloadID($downloadid[0]);
                foreach ($images as $image) {
                    ?>

                        <a href="#"><img style="height: 100px;" src="<?php echo $image->image; ?>" class="img-thumbnail" alt="Preview"></a>

                    <?php
                }

            ?>
        </div>
    </div>

<?php

}