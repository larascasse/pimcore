<?php 
if ($this->editmode) { ?>
<div class="row">
<div class="col">
 	<h2>LPN Header Image</h2>;

<?php
}
?>

<?php

$cssClass= (!$this->image("image")->getSrc())?" noimg":"";

$bkg = null;

if($this->image("image")->getSrc()) {
  $bkg= "style=\"background-image:url('".$this->image("image")->getThumbnail('magento_header')."')\"";
  $cssClass .= " lpn-covered";
}


?>
<div class="image-header-container <?= $cssClass ?>" <?= $bkg ?>>
<?php
if($this->editmode || !isset($bkg))
echo $this->image("image", [
                            "class" => "img-fluid",
                            "thumbnail" => "magento_header",
                            "placeholder" =>  "Image",
                             "width" => 200,
                             "height" => 200,
                            ]
                        );
?>
    <div>
      <?php $titre = $this->textarea("title",[
        "nl2br" => true,
        "width" => 600,
        "height" => 50,
        "placeholder" => "Titre",
        "class" => "editmode" //Edit mode
    ]);

    if($this->editmode || !$titre->isEmpty()) : ?>
      <h1><?php echo $titre ?></h1>
     <?php endif; ?> 
     
      <?php 

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


      if ($this->editmode) :
        ?>
          <p><?= $textarea; ?></p>
          <div>
          <?= $btn_title; ?>
        </div>
        <div>
          <?= $link; ?>
        </div>



      <?php
      else : 
        
        if(strlen($textarea->getData())>0) :
            echo '<p>'.$textarea->getData().'</p>';


        endif;

        if(strlen($link)>0) :
            echo $link;
            

        endif;

      endif;
      ?>
    </div>

</div>


<?php 
if ($this->editmode) { ?>
</div>
</div>
<?php
}
?>
