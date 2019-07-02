<?php 
$i=0;

$isV4 = $this->layout()->getLayout() == "layout-lpnv4";

$title = $this->input("title",
  [
      "placeholder"=>"Titre",
      "width" => 600,
  ]); 


?>
<?php if($this->editmode) {
    echo '<hr><h2>Tabulation</h2>';

    echo "<div>";

    echo "<div>";
    echo  $title;
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

          <h3 class="<?php echo $i==0?"selected":""?>" rel="<?php echo $i ?>"><?= $this->input("title"); ?> </h3>
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
  <div>

  <div class="<?php echo $cssClass?>">

    <?php 
    if (strlen(trim($title)) > 0 ) : ?>
    <div class="section-title">
       <h2><?php echo $title ?></h2> 
    </div> 
  <?php endif; ?>

    <div class="nav nav-pills" role="tablist">

     <?php 
            $i=0;
            while($this->block("contentblock")->loop()) {
               $block = $this->block("contentblock")->getElements()[$i];


                $panId = 'pimpane-'.\Pimcore\File::getValidFilename((string) $this->input("title")).'-'.$i;

                 ?>
                 <div class="nav-item">
                   <a class="nav-link <?php echo $i==0?"active":""?>" href="#tabpanel-<?php echo $panId ?>" data-toggle="tab" role="tab" aria-controls="tabpanel-<?php echo $panId ?>" aria-selected="<?php echo $i==0?"true":"false"?>" id="tabpanel-<?php echo $panId ?>_title"><?= $this->input("title"); ?></a>
                </div>


            <?php 
              $i++;
            } ?>
    </div>
  </div>

    <!-- Tab content -->
    <div class="tab-content">
      <?php

      $i=0;
            while($this->block("contentblock")->loop()) {

                $panId = 'pimpane-'.\Pimcore\File::getValidFilename((string)$this->input("title")).'-'.$i;

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



