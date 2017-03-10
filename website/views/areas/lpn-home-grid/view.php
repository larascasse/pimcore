
<?php 

$classNoRoll="";
if($this->editmode) { 
    $classNoRoll = "noroll";
?>
    <div class="container" style="padding-bottom: 40px">
        Nombre de colonnes: <?= $this->select("columns", [
            "width" => 60,
            "reload" => true,
            "store" => [[1,1],[2,2],[3,3]]
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




<?php 
for($i=0; $i<$count; $i++) { 
    $smallClass="";
    $cardClass="rollbloc";

    switch ($count) {
        case 1:
           $pimcoreThimbClass = "magento_equigrid_h";
        
        break;

        case 2:
           $pimcoreThimbClass = "magento_equigrid_v";
            break;

        case 3:
           $pimcoreThimbClass = "magento_equigrid_h";
           $smallClass="-sm-12 col-md";
           $cardClass="card";
            break;
        
        default:
            # code...
            break;
    }

    ?> 
    <!--  item -->
    <div class="col-12 col-sm<?php echo  $smallClass?> table-bloc-thumb">
    <div class="<?= $cardClass?><?=  $classNoRoll ?>">


<?php

        echo $this->image("image".$i,array(
        "thumbnail" => $pimcoreThimbClass,
        "class" => "img-fluid".$classNoRoll
        
    )
    );

?>

        <div class="table-bloc-thumb-text<?=  $classNoRoll ?> nsg_container">
            <div class="table-thumb-type"><span class="table-thumb-subtext"><?= $this->input("titre".$i, ["width" => 400,'placeholder'=>'titre']); ?></span></div> 
            <div class="rollbloc_txt_over">
                <div class="rollbloc_txt_over_cnt">
                    <div class="rollbloc_txt"><?= $this->textarea("description".$i, ["width" => 600,'placeholder'=>'Description',"htmlspecialchars"=>false]); ?></div>
                    
                </div>
            </div>
            <?php 
            if ($this->editmode) { 
              
                echo $this->input("btn_title".$i, ["width" => 600, "placeholder"=>"Titre du bouton"]); 

            }
            
            echo $this->renderlet("link".$i, array(
                        "types"=>array("object"),
                        "controller" => "content",
                        "action" => "link-eshop-renderlet",
                        "title" => "Glisser un doc, un produit, une categorie",
                        "editmode" => $this->editmode,
                        "previewmode" => $this->previewmode,
                        "btn_title" => $this->input("btn_title".$i)
             ));



            
            ?>

         </div>
    </div>
    </div>
    <!-- fin item -->
    <?php } ?>
    <!-- Fin Table  -->
</div>

