<?php
$mustRender = $this->layout()->getLayout() == "layout-fiche-pdf";
?>

<?php if($this->editmode): ?>
     
     <div class="container" style="padding-bottom: 40px">
        Nombre de colonnes: <?= $this->select("columns", [
            "width" => 60,
            "reload" => false,
            "store" => [[1,1],[2,2],[3,3],[4,4],[4,4],[6,6]]
        ]); ?>
    </div>

    <div class="container" style="padding-bottom: 40px">
        Format Image: <?= $this->select("imageformat", [
            "width" => 60,
            "reload" => false,
            "store" => [['magento_equigrid_h','horizontal'],['magento_equigrid_v','vertical'],['magento_equigrid_c','carré'],['destructure','destructure']]
        ]); ?>
    </div>



    <?= $this->multihref("objectPaths",
    [
        "types" => ["object"],
        //"subtypes" => ["product","category","teinte"],
        "classes" => ["product","category","teinte"]


    ]); ?>
<?php else: ?>

<?php
$count = $this->select("columns")->getData();
if(!$count) {
    $count = 6;
}

$imageformat = $this->select("imageformat")->getData();
if(!$imageformat) {
    $imageformat = 'magento_equigrid_h';
}


?>

<!-- Grid -->
<div class="container-main product-grid">
<div class="row">
<?php 

$index=0;
echo '<div class="products-grid list-for-subcategory cols'.($count).'">';

foreach($this->multihref("objectPaths")->getElements() as $object) { 

    if($object instanceOf Website_Category) {
        $category = $object;

    }
    if($object instanceOf Website_Teinte) {
        $teinte = $object;
    }
    if($object instanceOf Website_Product) {
        $product = $object;
       // $product = Object\Product::getById($object->getId());
    }

    if(isset($product)) {
         echo  $this->template("includes/inc-product-cell.php", array(
                "product" => $product,
                "index"=>$index,
                "cols"=>12/$count
            ));
    }
    else if(isset($category)) {
        echo '{{block type="catalog/product_list" name="home.catalog.product.list" alias="'.$category->mage_category_id.'" category_id="'.$category->mage_category_id.'" template="catalog/product/list_for_home.phtml" column_count="3"}}';
    }
   
    $index++;
  
} 
echo '</div>';
?>
   
</div>
</div>
<!-- FIN Grid -->

<?php endif; ?>

