<?php 
if ($this->editmode) { 
 	echo '<h2>LPN Header Image</h2>';

}
?>

<div class="row image-header-container justify-content-center">
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


    <div class="col-sm-10 text-center">
      <h1> <?= $this->textarea("title",[
        "nl2br" => true,
        "width" => 600,
        "height" => 100,
        "placeholder" => "Titre",
        "class" => "editmode" //Edit mode
    ]); ?></h1>
			<div class="catLine">&nbsp;</div>
			<p> <?= $this->textarea("description",[
        "nl2br" => true,
        "width" => 600,
        "height" => 200,
        "placeholder" => "Sous-titre",
        "class" => "editmode" //Edit mode
    ]); ?></p>
    </div>

  </div>
