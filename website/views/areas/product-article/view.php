<section class="area-gallery-folder">
    <?php $this->template("/includes/area-headlines.php"); ?>

    <?php echo $this->renderlet("products", array(
        "controller" => "product",
        "action" => "product-article-renderlet"
    )); ?>

</section>

