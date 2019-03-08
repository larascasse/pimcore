<?php


$isHeroCheckbox = $this->select("isHero",["store" => [
                ['empty','--'],
                ['hero','Hero'],
               
                ]]); 



$isHero = $isHeroCheckbox->getData() == 'hero'; 

$image = $this->image("image", [
                            "class" => "img-responsive",
                            "thumbnail" => "magento-header",
                            "placeholder" =>  "Image",
                             //"width" => 200,
                             //"height" => 200,
                            ]
                        );

$titre = $this->textarea("title",[
        "nl2br" => true,
        "width" => 600,
        "height" => 50,
        "placeholder" => "Titre",
        "class" => "editmode" //Edit mode
    ]);


$textarea = $this->textarea("description",[
  "nl2br" => true,
  "width" => 600,
  "height" => 50,
  "placeholder" => "Sous-titre",
  "class" => "editmode" //Edit mode
]);


$btn_title = $this->input("btn_title", ["width" => 400, "placeholder"=>"Titre du bouton"]);

$link = $this->renderlet("link", array(
                          "width" => 400,
                          "types"=>array("object"),
                          "controller" => "content",
                          "action" => "link-eshop-renderlet",
                          "title" => "Glisser un doc, un produit, une categorie",
                          "editmode" => $this->editmode,
                          "previewmode" => $this->previewmode,
                          "btn_title" => $btn_title
              )
);





$cssClass= (!$image->getSrc())?" noimg":"";

$bkg = null;

if($image->getSrc()) {
  $bkg= "style=\"background-image:url('".$image->getThumbnail('magento-header')."')\"";
  $cssClass .= " lpn-covered";
}


?>

<?php




if ($this->editmode) :  ?>

    <div class="container-main">
    <div class="row">
    <div class="col-12">
    <h2>LPN Header Image</h2>
     <?php echo $isHeroCheckbox; ?>
    </div>
    <div class="row">
      <div class="col-6">
       
        <?php echo $image; ?>
      </div>
     
     <div class="col-6">
       
       <h1><?php echo $titre ?></h1>
        <p><?= $textarea; ?></p>
        <div>
          <?= $btn_title; ?>
          <?= $link; ?>
        </div>
    <div>
    
  </div>
  </div>
  


<?php

else : 

  if($isHero) {
    echo '<div class="category-header category-header___level2">';
      
      echo '<div class="category-image-hero">';
        echo $image; 
        echo '<div class="image-hero-degrade"></div>';
      echo '</div>';

      echo '<div class="container-main category-header___text category-auto">';
      echo '<div class="row">';
            
            echo '<div class="category-name">';
            echo '<h1>';
            echo $titre;
            echo '</h1>';

            if(strlen($textarea->getData())>0) {
              echo '<p class="subdescription">'.$textarea->getData().'</p>';
            }

            if(strlen($link)>0) {
                echo $link;
            }

            echo '</div>';

      echo '</div>';
      echo '</div>';
    
    echo '</div>';

             


  }
  else {
    echo '<div class="image-header-container '.$cssClass.'" '.$bkg.'>';
    echo '<div>';
 

    if(!$titre->isEmpty()) {
      echo '<h1>'.$titre.'</h1>';
    }

    if(strlen($textarea->getData())>0) {
        echo '<p>'.$textarea->getData().'</p>';

    }

    if(strlen($link)>0) {
        echo $link;
    }

    echo '</div>';
    echo '</div>';

  }

  

       

endif;
?>


