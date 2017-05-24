<?php

$colors=[
    "#F6F5F2",
    "#F3F4EF",
    "#FCEFE9",
    "#8C8782",
    "#E4E4D2",
    "#E8F3F3",
    "#D1DFE0",

    "#DAD7CB",
    "#D0D5C1",
    "#F2BFA9",
    "#8C8782",
    "#93924B",
    "#A4CFCE",
    "#487E85",

    "#48B7C9",
    "#505050",
    "#7994A5",
    "#3C6297",
    "#065446",
    "#027683",
    "#DD5639",

];


$color = $this->input("color",["placeholder"=>"Couleur de fond"]);

/*$colorSelect = $this->select("color-bkg", [
            "width" => 300,
            "reload" => false,
            "store" => [['jaune','jaune'],['vert','vert'],['bleu','bleu'],['rose','rose'],['color-a','color-a'],['color-b','color-b']]
        ]);
*/

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
    //echo $colorSelect;
    ?>

<div class="row">
<?php
$i==0;
foreach ($colors as $color2) {
    ?>
    <div class="col" style="height: 50px; display: block; background-color: <?php echo $color2?>">
    <?php echo $color2 ?>
    </div>
   
   <?php
   if($i==(count($colors)-1))
        echo "</div>";
   else if(($i%7)==6) {
         echo "</div>";
         echo '<div class="row">';
   }
   

   $i++;
}

    echo $color."<br />";
    echo $hauteurSelect."<br />";
    echo $largeurSelect."<br />";
    echo $marginSelect."<br />";
}

//$color = $colorSelect->getData();
$hauteur = $hauteurSelect->getData();
$largeur = $largeurSelect->getData();
$margin = $marginSelect->getData();
?>
<div class="grid-offset"></div>
<div class="grid-bkg <?php echo $hauteur?' grid-height-'.$hauteur:''?><?php echo $largeur?' grid-width-'.$largeur:''?><?php echo $margin?' grid-margin-'.$margin:''?>" style="background-color: <?php echo $color->getData()?>">
<div></div>
</div>