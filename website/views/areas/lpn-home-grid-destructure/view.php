<? if(!$this->editmode) {?>
<div class="table-container card-columns">
<?php } 
else {
    echo "<div>";
}
?>

<?php 
 $sameSizeCount=1;
$isDoubleSize=true;

while($this->block("contentblock")->loop()) { 
    
    $count = $this->block("contentblock")->getCount();
    $i = $this->block("contentblock")->getCurrent();

     //Algo pour avoir 2 fois de suite la meme taille
   

    $pimcoreThimbClass = "magento_equigrid_h";

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



    $image = $this->image("image",array(
                "thumbnail" => $this->editmode?"":$pimcoreThimbClass,
                "class" => $this->editmode?"":"img-fluid",
                'placeholder'=>'Image'
                
            )
            );

    $titre = $this->input("titre", ["width" => "100%",'placeholder'=>'Titre']);
    $description = $this->textarea("description", ["width" => 800,"height" => 100,'placeholder'=>'Description',"htmlspecialchars"=>false]);

    $btn_title = $this->input("btn_title", ["width" => 800, "placeholder"=>"Titre du bouton"]);

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
        echo '<div class="container">'.$titre.'</div>';

        echo '<div class="container">'.$description.'</div>';

        echo '<div class="container">'.$btn_title.'</div>'; 

        echo '<div class="container">'.$link.'</div>';
         echo '</div></div><hr />';
    }
    else {
    ?> 
    <!--  item -->
    <div class="table-bloc-thumb <?php if ($count<=1) echo "col-first"?>">
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

