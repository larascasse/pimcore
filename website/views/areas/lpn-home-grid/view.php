
<?php 
if($this->editmode) { 
?>
    <div class="container" style="padding-bottom: 40px">
        Nombre de colonnes: <?= $this->select("columns", [
            "width" => 60,
            "reload" => true,
            "store" => [[1,1],[2,2]]
        ]); ?>
    </div>

<?php } ?>

<?php
$count = $this->select("columns")->getData();
if(!$count) {
    $count = 1;
}

?>


        
<div class="row table-container">
<div class="col">
<?php
if($count == 1) { ?>
    <!-- Table Horizontale -->
    <div class="row_">
<?php } else if($count == 2){ ?>
    <!-- Table Verticale x2 -->
    <div class="row">    
<?php } ?> 



<?php 
for($i=0; $i<$count; $i++) { 

    if($count == 1) { 
        $pimcoreThimbClass = "magento_equigrid_h";
        ?>
    <?php } else if($count == 2){ 
        $pimcoreThimbClass = "magento_equigrid_v";
        ?>  
    <?php } ?> 
    <!--  item -->
    <div class="col-12 col-sm table-bloc-thumb">
    <div class="rollbloc">


<?php

        echo $this->image("image".$i,array(
        "thumbnail" => $pimcoreThimbClass,
        "class" => "lazyload"
        
    )
    );

?>

        <div class="table-bloc-thumb-text nsg_container">
            <div class="table-thumb-type"><span class="table-thumb-subtext"><?= $this->input("titre".$i, ["width" => 400,'placeholder'=>'titre']); ?></span></div> 
            <div class="rollbloc_txt_over">
                <div class="rollbloc_txt_over_cnt">
                    <div class="rollbloc_txt"><?= $this->textarea("description".$i, ["width" => 600,'placeholder'=>'Description',"htmlspecialchars"=>false]); ?></div>
                    
                </div>
            </div>
            <?php 
            if ($this->editmode) { 
              
                echo $this->input("btn_title".$i, ["width" => 600, "placeholder"=>"Titre du bouton"]); 

                echo $this->href("btn_catid".$i,array(
            "types"=>array("object"),
            "classes" => array("category"),
            "reload" => false,
            "width" =>200,
        )); 
 

            }
            else {
                //print_r($this->href("btn_catid".$i)->getElement()->getMage_category_id());
                $category  = $this->href("btn_catid".$i)->getElement();
                $catId = $category?$this->href("btn_catid".$i)->getElement()->getMage_category_id():-1;
                echo '<a href="https://eshop.laparqueterienouvelle.fr/matieres/category/'. $catId.'" title="'. $this->input("btn_title".$i).'" class="table-selectionner-btn">'. $this->input("btn_title".$i).'</a>';
                  echo '<!-- {{widget type="catalog/product_widget_link" template="catalog/product/widget/link/link_inline.phtml" id_path="category/"'. $catId.' class="table-selectionner-btn" anchor_text="'. $this->input("btn_title".$i).'" title="'. $this->input("btn_title".$i).'"}}-->';
            }
            
            ?>

         </div>
    </div>
    </div>
    <!-- fin item -->
    <?php } ?>
    <!-- Fin Table  -->
</div>


</div>
</div>

