<section class="category-product-renderlet">
    <?php if($this->category) { ?>
       
            <?php 
                $products = $this->category->products;
                $cols=4;
                $index=0;
                foreach ($products as $product) {
                    if(($index%$cols)==0)
                    echo "\n<div class=\"row\">\n";
                    $this->template("includes/inc-product-cell.php", array(
    "product" => $product,"index"=>$index,"cols"=>12/$cols

));
                if(($index%$cols)==($cols-1))
                    echo "</div>";
                $index++;
            }
            if(($index%$cols)>0)
                    echo "\n</div>\n";

            ?>
        
    <?php } ?>
</section>