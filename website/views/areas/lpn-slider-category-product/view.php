<?php

?>

<?php if($this->editmode): ?>
   
    <div>
    Type de vue : <?php echo $this->select("viewType", [
            "store" => [
                ['sliderproduct', 'Slider Produit'],
                ['slideraccessories', 'Slider accessoires'],
                ['products-grid', 'Grille produit']
            ],
            "reload" => true,
        ]);
    if($this->select("viewType")->isEmpty()):
        $this->select("viewType")->setDataFromResource("unlimited");
    endif;


 ?>

    </div>
    <div>
    Prix : <?php  echo $this->select("hide_price",
        ["store" => [
            "0",'Montrer le prix',
             "1",'Cacher le prix'
             ]
        ]
        ); 
        if($this->select("hide_price")->isEmpty()):
            $this->select("hide_price")->setDataFromResource("false");
         endif;

    ?>

    </div>
    <div>
    Titre : <?php  echo $this->select("hide_title",
        ["store" => [
            "0",'Montrer le titre',
             "1",'Cacher le titre'
             ]
        ]
        );
     if($this->select("hide_title")->isEmpty()):
        $this->select("hide_title")->setDataFromResource("false");
    endif;
     ?>

    </div>

<?php
if($this->select("viewType")->getData() == 'products-grid') {
?>

    <div class="container" style="padding-bottom: 40px">
        Nombre de colonnes: <?= $this->select("columns", [
            "width" => 60,
            "reload" => true,
            "store" => [[1,1],[2,2],[3,3],[4,4],[5,5],[6,6]]
        ]); 
        if($this->select("columns")->isEmpty()):
        $this->select("columns")->setDataFromResource("3");
    endif;
    ?>
    </div>
<?php
}
?>

     <div><?= $this->href("objectPaths",
    [
        "types" => ["object"],
        "subtypes" => ["object"=>["category"]],
        "classes" => ["category"]

    ]); ?>
    </div>

<?php else: ?>

       <!-- Carousel Item -->
            <div class="<?php echo $this->select("viewType")->getData() ?>">
            
<?php 

$category = $this->href("objectPaths")->getElement();
if($category) { 
    $showPrice = $this->select("hide_price")->getData();
    $showTitle = $this->select("hide_title")->getData();
    $str = '{{block type="catalog/product_list" name="home.catalog.product.list" alias="category-bloc-'.$category->getMage_category_id().'" category_id="'.$category->getMage_category_id().'" template="catalog/product/list_for_subcategory.phtml" column_count="'.$this->select("columns")->getData().'" show_price="'.$showPrice.'" show_title"'.$showTitle.'"}}';
    echo  $str;
}

?>
   
            </div>
  

<?php endif; ?>

