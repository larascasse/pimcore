<?php 
$i=0;

$isV4 = $this->layout()->getLayout() == "layout-lpnv4";
?>
<?php if($this->editmode) {
    echo '<hr><h2>Tabulation</h2><div class="tab-title">';

    echo "<div>";
    $title = $this->input("title",
    [
        "placeholder"=>"Titre"
    ]); 
     echo "</div>";

     echo "<div>";
     echo $this->select("cssClass", [
            "width" => 300,
            "reload" => false,
            "store" => [
                ['section-tab',"Titre centré"],
                ['section-tab-inline','Titre et boutons alignés'],
                ]
        ]);
     echo "</div>";




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

  <?php 
     $cssClass = $this->select("cssClass")->getData();
        
        if(!$cssClass) {
            $cssClass = 'section-tab';
    }


  ?>

  <!-- Tab -->
  <div class="<?php echo $cssClass?>">

    <div class="section-title">
       <h2>Accessoires</h2> 
    </div> 


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
 

    <!-- Tab content -->
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
    <!-- / Tab content -->
  </div>
  <!-- / Tab -->
  <?php endif; ?>
<?php } ?>



