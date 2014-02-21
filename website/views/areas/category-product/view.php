<section class="area-gallery-folder">
<?php $this->template("/includes/area-headlines.php"); ?>
    <?php echo $this->renderlet("categories", array(
        "controller" => "category",
        "action" => "category-product-renderlet"
    )); ?>
</section>

