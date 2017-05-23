<?php
 $count = $this->block("contentblock")->getCount();
 if(!$this->editmode) {
    $defaultGridMode = $this->select("grid-mode")->getData();
    if(!$defaultGridMode) {
        $defaultGridMode = 'grid-destructuree';
}



?>
    <div class="table-container <?php echo $defaultGridMode?> <?php echo 'grid-destructuree-'.$count?>">
<?php } 
else {
    echo "<div>";


    echo $this->select("grid-mode", [
            "width" => 300,
            "reload" => false,
            "store" => [
                ['grid-destructuree',"Normal (grand à gauche)"],
                ['grid-destructuree grid-inverse','Inverse'],
                ['grid-destructuree grid-vertical','Vertical'],
                ['grid-destructuree grid-vertical grid-inverse','Vertical Inverse']
                ]
        ]);

    
}

 $isInverse = strpos($defaultGridMode,'grid-inverse')>0;
 $isVertical = strpos($defaultGridMode,'grid-vertical')>0;
 
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
                $pimcoreThimbClass = "magento_equigrid_h";
                break;

            case 3:
                switch ($i) {
                    case 0:
                        $pimcoreThimbClass = $isInverse ?"magento_equigrid_h":"magento_equigrid_v";
                        break;
                    case 1:
                        $pimcoreThimbClass = "magento_equigrid_h";
                        break;
                    case 2:
                        $pimcoreThimbClass = $isInverse?"magento_equigrid_v":"magento_equigrid_h";
                        break;
                    
                    default:
                        # code...
                        break;
                }
                break;

            case 4:
                switch ($i) {
                    case 0:
                         $pimcoreThimbClass = ($isVertical && !$isInverse) ?"magento_equigrid_v":"magento_equigrid_h";
                        break;
                    case 1:
                        $pimcoreThimbClass = ($isVertical && $isInverse) ?"magento_equigrid_v":"magento_equigrid_h";
                        break;
                    case 2:
                        $pimcoreThimbClass = ($isVertical && $isInverse) ?"magento_equigrid_v":"magento_equigrid_h";
                        break;
                    case 3:
                        $pimcoreThimbClass = ($isVertical && !$isInverse) ?"magento_equigrid_v":"magento_equigrid_h";
                        
                        break;
                    
                    default:
                        # code...
                        break;
                }
                break;

                
            

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

    $surtitre = $this->input("surtitre", ["width" => 400,'placeholder'=>'Surtitre']);

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
        echo '<div class="container">'.$surtitre.'</div>';
        echo '<div class="container"><h3>'.$titre.'</h3></div>';

        echo '<div class="container">'.$description.'</div>';

        echo '<div class="container">'.$btn_title.'</div>'; 

        echo '<div class="container">'.$link.'</div>';
         echo '</div></div><hr />';
    }
    else {
    ?> 
    <!--  item -->

    <?php
    $colFirst = "";
    if(
        $i==0
        || ($i==1 && !$isInverse && $isVertical)
        || ($i==2 && $count==3 && $isInverse && $isVertical)
        || ($i==2 && $count==4)

        )
    $colFirst = " col-first";
    ?>

    <?php
        if($i==0) {
            echo '<div class="grid-col">';
        }
        ?>

    <div class="table-bloc-thumb<?php echo $colFirst ?>">
        <div class="rollbloc">

        <?php 
            echo $image;
        
        ?>
        <div class="table-bloc-thumb-text">
            
                <p><?= $surtitre; ?></p>
                <h2><?= $titre; ?></h2>
            
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
    <?php 

            if($i== ($count-1)) {
                echo "</div>";
                
            }
            else if (
                //A près le 1er
                ($i==0 && $count==2)
                || ($i==0 && $count==3 && $isVertical && !$isInverse)
                //A près le 12e
                || ($i==1 && $count==3 && $isVertical && $isInverse)
                || ($i==1 && $count==3 && !$isVertical)
                || ($i==1 && $count==4)
            ) {
                echo "</div>";
                echo '<div class="grid-col">';
            }
       
            $i++;
        } ?>
<?php } ?>
<!-- Fin Loop  -->
<!--<div class="grid-bkg"></div>-->
</div>

