 
<?php 
if($this->editmode) { 
?>
<h2>Bloc Texte</h2> 

<div class="container" style="padding-bottom: 40px">
        Classe: <?= $this->select("htmlClass", [
            "width" => 600,
            "reload" => true,
            "store" => [['bloctext','Aligné à gauche'],
            			['table-intersticiel','Centré Fond blanc'],
            			['introcategory','Centré Fond noir'],
            			['subcategory','Sous-catégorie']
            		 ]
        ]); ?>
    </div>

<?php } ?>

<?php

$htmlClass = $this->select("htmlClass")->getData();
if(!$htmlClass) {
    $htmlClass = "bloctext";
}

$countCars = strlen($this->textarea("description")->getData());

?>


<!-- BLOC TITRE -->
<div class="<?php echo $htmlClass ?>">
<h2><?= $this->textarea("title",[
        "nl2br" => true,
        "width" => 600,
        "height" => 30,
        "placeholder" => "Titre",
        "class" => "editmode" //Edit mode
    ]); ?></h2>
<p <?php echo $countCars>200?'class="longtext"':''?>><?= $this->textarea("description",[
        "nl2br" => true,
        "width" => 600,
        "height" => 70,
        "placeholder" => "Texte",
        "class" => "editmode" //Edit mode
    ]); ?></p>
</div>
<!-- FIN BLOC TITRE -->














