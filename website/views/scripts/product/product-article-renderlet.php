
<h1>Renderlet</h1>
    <?php if($this->products) { ?>
        <div class="row">
            <?php
                $children = $this->products->getChilds();
                $count = 0;
                $totalCount = count($children);
                foreach ($children as $product) { ?>
                    <?php 
                             echo $product;
                             $this->template("snippets/inc-product-cell.php", array(
    "product" => $product));
                    ?>

            <?php } ?>
        </div>
    <?php } ?>

</section>