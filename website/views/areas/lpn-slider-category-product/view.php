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
    Prix : <?php  echo $this->select("show_price",
        ["store" => [
            ["1",'Montrer le prix'],
             ["0",'Cacher le prix']
             ]
        ]
        ); 
        if($this->select("show_price")->isEmpty()):
            $this->select("show_price")->setDataFromResource("1");
         endif;

    ?>

    </div>
    <div>
    Titre : <?php  echo $this->select("hide_title",
        ["store" => [
            ["0",'Montrer le titre'],
             ["1",'Cacher le titre']
             ]
        ]
        );
     if($this->select("hide_title")->isEmpty()):
        $this->select("hide_title")->setDataFromResource("0");
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
<?php 

$category = $this->href("objectPaths")->getElement();

if($category) { 
    $showPrice = $this->select("show_price")->getData();
    $hideTitle = $this->select("hide_title")->getData();
    $carouselType = $this->select("viewType")->getData();
    $str = '{{block type="catalog/product_list" name="home.catalog.product.list" alias="category-bloc-'.$category->getMage_category_id().'" category_id="'.$category->getMage_category_id().'" template="catalog/product/list_for_home.phtml" column_count="'.$this->select("columns")->getData().'" show_price="'.$showPrice.'" hide_title="'.$hideTitle.'" carousel_class="'.$carouselType.'"}}';
    echo  $str;
}

?>
<?php endif; ?>

