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
  $bkg= "style=\"background-image:url(' + imageSource + ')'\"";
  $cssClass .= " lpn-covered";
}


?>
<div class="image-header-container <?= $cssClass ?>">
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
      <h1><?= $this->textarea("title",[
        "nl2br" => true,
        "width" => 600,
        "height" => 50,
        "placeholder" => "Titre",
        "class" => "editmode" //Edit mode
    ]); ?></h1>
      
      <?php 

      $textarea = $this->textarea("description",[
        "nl2br" => true,
        "width" => 600,
        "height" => 50,
        "placeholder" => "Sous-titre",
        "class" => "editmode" //Edit mode
    ]);
      if ($this->editmode) :
        ?>
      <p><?= $textarea; ?></p>

      <?php
      else : 
        if(strlen($textarea->getData())>0) :
            echo '<p>'.$textarea->getData().'</p>';
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
