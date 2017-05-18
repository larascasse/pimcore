<?php

$colorSelect = $this->select("color-bkg", [
            "width" => 300,
            "reload" => false,
            "store" => [['jaune','jaune'],['vert','vert'],['bleu','bleu'],['rose','rose'],['color-a','color-a'],['color-b','color-b']]
        ]);


$hauteurSelect = $this->select("hauteur-bkg", [
            "width" => 300,
            "reload" => false,
            "store" => [
                            ['','defaut'],
                            ['small','petit'],
                            ['big','Grand'],
                        ]
        ]);

$largeurSelect = $this->select("largeur-bkg", [
            "width" => 300,
            "reload" => false,
            "store" => [
                            ['','100%'],
                            ['left-66','66% à gauche'],
                            ['left-50','50% à gauche'],
                            ['left-33','33% à gauche'],
                            ['left-25','25% à gauche'],
                            ['right-66','50% à droite'],
                            ['right-50','50% à droite'],
                            ['right-33','33% à droite'],
                            ['right-25','25% à droite'],
                        ]
        ]);

$marginSelect = $this->select("margin-bkg", [
            "width" => 300,
            "reload" => false,
            "store" => [
                ['','default'],
                ['below','Décalé vers le bas'],
                ['below-small','Décalé vers le bas un peu'],
                ['above','Décalé vers le haut'],
                ['above-small','Décalé vers le haut un peu']
            ]
        ]);


//Margin-top
//largeur
//position left / right

if($this->editmode) {
    echo $colorSelect;
    echo $hauteurSelect;
    echo $largeurSelect;
    echo $marginSelect;
}

$color = $colorSelect->getData();
$hauteur = $hauteurSelect->getData();
$largeur = $largeurSelect->getData();
$margin = $marginSelect->getData();
?>
<div class="grid-offset"></div>
<div class="grid-bkg <?php echo $color?' grid-bkg-'.$color:''?><?php echo $hauteur?' grid-height-'.$hauteur:''?><?php echo $largeur?' grid-width-'.$largeur:''?><?php echo $margin?' grid-margin-'.$margin:''?>">
<div></div>
</div>