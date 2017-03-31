
<?php 

$classNoRoll="";
if($this->editmode) { 
    $classNoRoll = "noroll";
?>
    <div class="container" style="padding-bottom: 40px">
        Nombre de colonnes: <?= $this->select("columns", [
            "width" => 60,
            "reload" => true,
            "store" => [[1,1],[2,2],[3,3],[4,4],[5,5],[6,6]]
        ]); ?>
    </div>

    <div class="container" style="padding-bottom: 40px">
        Type: <?= $this->select("cardClass", [
            "width" => 100,
            "reload" => true,
            "store" => [['rollbloc',"Texte sur photo, roll"],['card','Text en dessous']]
        ]); ?>
    </div>

<?php } ?>

<?php
$count = $this->select("columns")->getData();
if(!$count) {
    $count = 1;
}

$defaultCardClass = $this->select("cardClass")->getData();
if(!$defaultCardClass) {
    $defaultCardClass = 'rollbloc';
}

?>


        
<div class="row table-container">




<?php 
for($i=0; $i<$count; $i++) { 
   
    $smallClass="";
    $cardClass=$defaultCardClass;

    switch ($count) {
        case 1:
           $pimcoreThimbClass = "magento_equigrid_h";
           $smallClass="col";
           break;
        
        break;

        case 2:
           $pimcoreThimbClass = "magento_equigrid_v";
           $smallClass="col";
            break;

        case 4:
            $pimcoreThimbClass = "magento_equigrid_h";
            $smallClass="-sm-12 col-md-6";
            $smallClass="col-12 col-sm-6 col-sm-3";
            break;

        case 3:
        case 6:
        case 5:
           $pimcoreThimbClass = "magento_equigrid_h";
           $smallClass="col-12 col-sm-12 col-md-4";
           $cardClass="card";
            break;
        
        default:
            # code...
            break;
    }

    // le dernier prend tout la place
    if($i==($count-1) && $i>1) {
        $smallClass="col col-sm col-md";
    }

    ?> 
    <!--  item -->
    <div class="<?php echo  $smallClass?> table-bloc-thumb">
    


<?php

    if($this->editmode) {

    }

    echo $this->image("image".$i,array(
        "thumbnail" => $pimcoreThimbClass,
        "class" => "img-fluid".$classNoRoll
        
    )
    );

?>
    <?php if ($cardClass != "card") : ?>
        <div class="<?= $cardClass?><?=  $classNoRoll ?>">
        <div class="table-bloc-thumb-text<?=  $classNoRoll ?> nsg_container">
            <div class="table-thumb-type">
                <span class="table-thumb-subtext"><?= $this->input("titre".$i, ["width" => 400,'placeholder'=>'titre']); ?></span>
            </div> 
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
    

    <?php else : ?>
        <div class="<?= $cardClass?><?=  $classNoRoll ?> clickable">
         <div class="card-block">
            <div class="card-title"><?= $this->input("titre".$i, ["width" => 400,'placeholder'=>'titre']); ?></div>
            <div class="card-text"><?= $this->textarea("description".$i, ["width" => 600,'placeholder'=>'Description',"htmlspecialchars"=>false]); ?></div>
                    
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

    <?php endif; ?>
    </div>
    <!-- fin item -->
    <?php } ?>
    <!-- Fin Table  -->
</div>

