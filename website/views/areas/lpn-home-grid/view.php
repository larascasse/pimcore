
<?php 

$classNoRoll="";
if($this->editmode) { 
    $classNoRoll = "noroll";
?>
    <div class="container" style="padding-bottom: 40px">
        Nombre d'image: <?= $this->select("columns", [
            "width" => 60,
            "reload" => true,
            "store" => [[1,1],[2,2],[3,3],[4,4],[5,5],[6,6]]
        ]); ?>
    </div>

    <div class="container" style="padding-bottom: 40px">
        Type: <?= $this->select("cardClass", [
            "width" => 300,
            "reload" => true,
            "store" => [['rollbloc',"Texte sur photo, roll"],['rollbloc-destructure',"Texte sur photo, déstructuré, roll"],['card','Text en dessous'],['hero','Text centré']]
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

//Aligné
$gridClass="row table-container";


//New
$gridClass="table-container card-columns";
$smallClass="";
$defaultCardClass="rollbloc";

//Algo pour avoir 2 fois de suite la meme taille
$sameSizeCount=1;
$isDoubleSize=true;

?>


        
<div class="<?php echo $gridClass ?>">




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
            if ($defaultCardClass=="rollbloc") {
                $pimcoreThimbClass = "magento_equigrid_v";
                $smallClass="col-6";
            }
            else {
                $pimcoreThimbClass = "magento_equigrid_h";
                $smallClass="col-12 col-sm-6 col-sm-3";
            }
           
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

    //On remet le hero
    if($this->select("cardClass")->getData()=="hero"){
     $cardClass="hero";
    }

    ?> 
    <!--  item -->
    <div class="<?php echo  $smallClass?> table-bloc-thumb">
    


<?php

    if($this->editmode) {
        echo $this->image("image".$i,array(
            "thumbnail" => $pimcoreThimbClass,
            "class" => "img-fluid".$classNoRoll
            
        )
        );
    }

    

?>
    <?php if ($cardClass == "rollbloc" || $cardClass == "rollbloc-destructure" ) : ?>
        
        <div class="<?= $cardClass?><?=  $classNoRoll ?>">

        <?php 
        if(!$this->editmode) {
            echo $this->image("image".$i,array(
                "thumbnail" => $pimcoreThimbClass,
                "class" => "img-fluid".$classNoRoll
                
            )
            );
        }
        ?>
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



      <?php elseif ($cardClass == "hero") : ?>
        
          <?php 
        if(!$this->editmode) {
            if($this->image("image".$i)->getSrc()) {
              $bkg= "style=\"background-image:url('".$this->image("image".$i)->getThumbnail($pimcoreThimbClass)."')\"";
            }

        }
        ?>
        <div class="image-header-container lpn-hero lpn-covered" <?php echo $bkg?>>
        <div>
        <h2><?= $this->input("titre".$i, ["width" => 400,'placeholder'=>'titre']); ?></h2>
        <p><?= $this->textarea("description".$i, ["width" => 600,'placeholder'=>'Description',"htmlspecialchars"=>false]); ?></p>
                
  
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
          <?php 
        if(!$this->editmode) {
            echo $this->image("image".$i,array(
                "thumbnail" => $pimcoreThimbClass,
                "class" => "img-fluid".$classNoRoll
                
            )
            );
        }
        ?>
        <div class="<?= $cardClass?><?=  $classNoRoll ?> clickable">
         <div class="card-block">
            <div class="card-title"><?= $this->input("titre".$i, ["width" => 400,'placeholder'=>'titre']); ?></div>
            <div class="card-text"><?= $this->textarea("description".$i, ["width" => 600,'placeholder'=>'Description',"htmlspecialchars"=>false]); ?>
                    
            <?php 
            if ($this->editmode) { 
              
                echo $this->input("btn_title".$i, ["width" => 600, "placeholder"=>"Titre du bouton"]); 

            }
            echo '<div class="actions">';

            echo $this->renderlet("link".$i, array(
                        "types"=>array("object"),
                        "controller" => "content",
                        "action" => "link-eshop-renderlet",
                        "title" => "Glisser un doc, un produit, une categorie",
                        "editmode" => $this->editmode,
                        "previewmode" => $this->previewmode,
                        "btn_title" => $this->input("btn_title".$i)
             ));
             echo '</div>';


            
            ?>
            </div>
        </div>
     </div>

    <?php endif; ?>
    </div>
    <!-- fin item -->
    <?php } ?>
    <!-- Fin Table  -->
</div>

