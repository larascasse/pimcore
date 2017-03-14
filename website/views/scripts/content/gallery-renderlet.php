
<section>

    <?php if($this->asset) { ?>
        <div class="row">
            <?php
                $children = $this->asset->getChilds();
                $count = 0;
                $totalCount = count($children);
                foreach ($children as $image) { ?>

                    <?php if($image instanceof Asset_Image) { ?>
                        <div class="col-6 col-md-3 ">
                            <a href="<?= $image->getThumbnail("galleryLightbox")->getPath(); ?>" class="thumbnail">
                                <?= $image->getThumbnail("galleryThumbnail")->getHTML(); ?>
                            </a>
                        </div>
                    <?php } ?>
            <?php } ?>
        </div>
    <?php } ?>

</section>