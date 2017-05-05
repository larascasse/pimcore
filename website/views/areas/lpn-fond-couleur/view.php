<?php

$colorSelect = $this->select("color-bkg", [
            "width" => 300,
            "reload" => false,
            "store" => [['jaune','jaune'],['vert','vert'],['bleu','bleu']]
        ]);


$hauteurSelect = $this->select("hauteur-bkg", [
            "width" => 300,
            "reload" => false,
            "store" => [
                            ['','defaut'],
                            ['big','haut'],
                        ]
        ]);

$largeurSelect = $this->select("largeur-bkg", [
            "width" => 300,
            "reload" => false,
            "store" => [
                            ['','100%'],
                            ['left-50','50% à gauche'],
                            ['left-33','33% à gauche'],
                            ['left-25','25% à gauche'],
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
                ['above','Décalé vers le haut']
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

<div class="grid-bkg <?php echo $color?' grid-bkg-'.$color:''?><?php echo $hauteur?' grid-height-'.$hauteur:''?><?php echo $largeur?' grid-width-'.$largeur:''?><?php echo $margin?' grid-margin-'.$margin:''?>">
<div></div>
</div>