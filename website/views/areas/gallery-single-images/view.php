<section class="area-gallery-single-images">

    <?php $this->template("/includes/area-headlines.php"); ?>

    <div class="row">
        <?php
        $block = $this->block("gallery");

        while ($block->loop()) { ?>
            <div class="col-md-3 col-6">
                <a href="<?= $this->image("image")->getThumbnail("galleryLightbox")->getPath(); ?>" class="thumbnail">
                    <?= $this->image("image", [
                        "thumbnail" => "galleryThumbnail"
                    ]); ?>
                </a>
            </div>
        <?php } ?>
    </div>

</section>

