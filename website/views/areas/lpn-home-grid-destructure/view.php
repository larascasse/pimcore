<?php
 $count = $this->block("contentblock")->getCount();
 if(!$this->editmode) {
   

?>
    <div class="table-container card-columns grid-destructuree <?php echo 'grid-destructuree-'.$count?>" style="columns-count:2">
<?php } 
else {
    echo "<div>";
}
?>

<?php 
$sameSizeCount=1;
$isDoubleSize=true;

$simple=false;

while($this->block("contentblock")->loop()) { 
    
    
    $i = $this->block("contentblock")->getCurrent();

     //Algo pour avoir 2 fois de suite la meme taille
   

    $pimcoreThimbClass = "magento_equigrid_h";

    //Type avec A vertival, 2 H, 2V...
    if($simple) {
        if($isDoubleSize) {
            $pimcoreThimbClass = "magento_equigrid_v";
        }

        //Pourle prochain
        if($sameSizeCount==1 && $isDoubleSize) {
            $sameSizeCount = 0;
            $isDoubleSize = false;
        }
        else if($sameSizeCount==1 && !$isDoubleSize) {
            $sameSizeCount = 0;
            $isDoubleSize = true;
        }
        else {
            $sameSizeCount++;
        }
    }
    else {
        $colClass="";
        switch ($count) {
            case 1:
                $pimcoreThimbClass = "magento_equigrid_h";
                break;

            case 2:
                $pimcoreThimbClass = "magento_equigrid_v";
                break;

            case 3:
                switch ($i) {
                    case 0:
                        $pimcoreThimbClass = "magento_equigrid_v";
                        break;
                    case 1:
                        $pimcoreThimbClass = "magento_equigrid_h";
                        break;
                    case 2:
                        $pimcoreThimbClass = "magento_equigrid_h";
                        break;
                    
                    default:
                        # code...
                        break;
                }

            case 4:
                $pimcoreThimbClass = "magento_equigrid_h";
            
            default:
                # code...
                break;
        }
    }
    



    $image = $this->image("image",array(
                "thumbnail" => $this->editmode?"":$pimcoreThimbClass,
                "class" => $this->editmode?"":"img-fluid",
                'placeholder'=>'Image'
                
            )
            );

    $titre = $this->input("titre", ["width" => 400,'placeholder'=>'Titre']);
    $description = $this->textarea("description", ["width" => 400,"height" => 100,'placeholder'=>'Description',"htmlspecialchars"=>false]);

    $btn_title = $this->input("btn_title", ["width" => 400, "placeholder"=>"Titre du bouton"]);

    $link = $this->renderlet("link", array(
                                "types"=>array("object"),
                                "controller" => "content",
                                "action" => "link-eshop-renderlet",
                                "title" => "Glisser un doc, un produit, une categorie",
                                "editmode" => $this->editmode,
                                "previewmode" => $this->previewmode,
                                "btn_title" => $btn_title
                    )
    );


    if($this->editmode) {
        echo '<div class="row"><div class="col-md-6">';
        echo '<div class="container" style="width:300px">'.$image.'</div>';
         echo '</div><div class="col-md-6">';
        echo '<div class="container"><h3>'.$titre.'</h3></div>';

        echo '<div class="container">'.$description.'</div>';

        echo '<div class="container">'.$btn_title.'</div>'; 

        echo '<div class="container">'.$link.'</div>';
         echo '</div></div><hr />';
    }
    else {
    ?> 
    <!--  item -->
    <div class="table-bloc-thumb <?php if ($i<=1) echo "col-first"?>">
        <div class="rollbloc">

        <?php 
            echo $image;
        
        ?>
        <div class="table-bloc-thumb-text">
            <div class="table-thumb-type">
                <span class="table-thumb-subtext"><?= $titre; ?></span>
            </div> 
            <div class="rollbloc_txt_over">
                <div class="rollbloc_txt_over_cnt">
                    <div class="rollbloc_txt"><?= $description; ?></div>
                    
                </div>
            </div>
            <?php  echo $link; ?>

         </div>
         </div>




    </div>
    <!-- fin item -->
    <?php } ?>
<?php } ?>
<!-- Fin Loop  -->
</div>

