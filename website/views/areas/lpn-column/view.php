<?php if($this->editmode): 
    echo '<label>Classe CSS</label>'.$this->input("cssClass");
endif;
?>
<div class="row <?= $this->input("cssClass")->getData() ?>">

<div class="col-xs-12">
    <h2><?= $this->input('titleblock', array("width" => 500))?></h2>
</div>



<?php

$defaultBricks = array(
    'lpn-product'
);

$excludeBricks = $this->excludeBricks;
$extraBricks = $this->extraBricks;
$name = $this->name;
if (!$this->name) $this->name = "default";
$params = array();

$bricks = $defaultBricks;

if(is_array($excludeBricks))
    foreach ($excludeBricks as $brick) {
        if (in_array($brick, $bricks)) {
            $bricks = array_diff($bricks, array($brick));
        }
    }

if(is_array($extraBricks))
foreach ($extraBricks as $brick) {
    if (!in_array($brick, $bricks)) {
        $bricks[] = $brick;
    }
}

foreach ($bricks as $brick) {
    $params[$brick] = array(
        "forceEditInView" => true
    );
}






?>
<div class="col-xs-4">
<?php
 echo $this->template("helper/lpn-areablock.php", array("name" => "l".$i, "excludeBricks" => array("lpn-column")));
    /*echo $this->areablock("l" . $name, array(
    "allowed" => $bricks,
    "params" => $params
));*/
?>
</div>
<div class="col-xs-1"></div>
<div class="col-xs-7">
<?php
 echo $this->template("helper/lpn-areablock.php", array("name" => "r".$i, "excludeBricks" => array("lpn-column")));
    /*echo $this->areablock("l" . $name, array(
    "allowed" => $bricks,
    "params" => $params
));*/
?>
</div>
</div>