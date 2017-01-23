
<section class="category-renderlet">
    <?php if($this->category) { ?>
        <div class="row">
            <?php
            foreach ($this->category->products as $product) { 
 
                         $this->template("includes/inc-product-cell.php", array(
    "product" => $product));
                    
            } 
            ?>
        </div>
    <?php } ?>

</section>