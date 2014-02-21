
<section>
    <?php if($this->products) { ?>
        <div class="row">
            <?php
                $children = $this->products->getChilds();
                $count = 0;
                $totalCount = count($children);
                foreach ($children as $product) { ?>
                    <?php 
                             $this->template("includes/inc-product-cell.php", array(
    "product" => $product));
                    ?>

            <?php } ?>
        </div>
    <?php } ?>

</section>