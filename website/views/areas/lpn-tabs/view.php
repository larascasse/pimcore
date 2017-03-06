<?php 
$i=0;
?>
<?php if($this->editmode) {
    echo '<hr><h2>Tabulation</h2><div class="tab-title">';

    while($this->block("contentblock")->loop()) { ?>
        <h3><?= $this->input("title", ["placeholder" => "Titre", "width"=>400]); ?></h3>
        <?= $this->template("helper/lpn-areablock.php", array("name" => "name".$i++, "excludeBricks" => array("lpn-tabs"))) ?>
        <hr />
    <?php } 

        echo '</div>';

}
else {
?>


<div class="tab-all">
      <div class="tab-title">
          <?php 
          $i=0;
          while($this->block("contentblock")->loop()) { ?>
          <h3 class="<?php echo $i==0?"selected":""?>" rel="<?php echo $i ?>"><?= $this->input("title"); ?></h3>
          <?php 
            $i++;
          } ?>
      </div>

  
      <!-- Carousel content -->
      <div class="tab-content"  role="listbox">

            <?php 
          $i=0;
          while($this->block("contentblock")->loop()) { ?>
           <div class="tab-container" data-ride="carousel">
          <?= $this->template("helper/lpn-areablock.php", array("name" => "name".$i, "excludeBricks" => array("lpn-tabs"))) ?>
         </div>
          <?php 
            $i++;
          } ?>

      </div>

</div>
<?php } ?>



