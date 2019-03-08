<?php 
$i=0;

$isV4 = $this->layout()->getLayout() == "layout-lpnv4";
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


<?php if(!$isV4) : ?>


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

<?php else : ?>

  <div class="section-tab">
    <div class="nav nav-pills" role="tablist">

     <?php 
            $i=0;
            while($this->block("contentblock")->loop()) {

                $panId = 'pimpane-'.$this->getId().'-'.$i;

                 ?>
                 <div class="nav-item">
                   <a class="nav-link <?php echo $i==0?"active":""?>" href="#tabpanel-<?php echo $panId ?>" data-toggle="tab" role="tab" aria-controls="tabpanel-<?php echo $panId ?>" aria-selected="<?php echo $i==0?"true":"false"?>" id="tabpanel-<?php echo $panId ?>_title"><?= $this->input("title"); ?></a>
                </div>


            <?php 
              $i++;
            } ?>
    </div>
 


    <div class="tab-content">
      <?php

      $i=0;
            while($this->block("contentblock")->loop()) {

                $panId = 'pimpane-'.$this->getId().'-'.$i;

              ?>


                <div class="tab-pane fade <?php echo $i==0?"active show":""?>" role="tabpanel" id="tabpanel-<?php echo $panId ?>" aria-labelledby="tabpanel-<?php echo $panId ?>_title">
                <?= $this->template("helper/lpn-areablock.php", array("name" => "name".$i, "excludeBricks" => array("lpn-tabs"))) ?>
              </div>

              <?php 
              $i++;
            } ?>
      
    </div>



  </div>


              



  <?php endif; ?>
<?php } ?>



