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

?>
<div class="image-header-container <?= $cssClass ?>">
<?php
echo $this->image("image", [
                            "class" => "img-fluid",
                            "thumbnail" => "magento_selection",
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
      <div class="catLine">&nbsp;</div>
      <p><?= $this->textarea("description",[
        "nl2br" => true,
        "width" => 600,
        "height" => 50,
        "placeholder" => "Sous-titre",
        "class" => "editmode" //Edit mode
    ]); ?></p>
    </div>

</div>


<?php 
if ($this->editmode) { ?>
</div>
</div>
<?php
}
?>
