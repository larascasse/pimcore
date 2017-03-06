
<hr>


 
<?php while($this->block("block")->loop()) { ?>

<?php if($this->editmode) { ?>
<div class="editmode-label">
    <label>Orientation:</label>
    <?= $this->select("postition", ["reload" => true,"store" => [["left","Texte à gauche"],["right","Texte à droite"]]]); ?>
</div>
<!--
<div class="editmode-label">
    <label>Type:</label>
    <?= $this->select("type", ["reload" => true, "store" => [["video","video"], ["image","image"]]]); ?>
</div>
-->
<?php } ?>

<?php            
$position = $this->select("postition")->getData();
if(!$position) {
    $position = "right";
}
?>



    <div class="row">

     

        <div class="col-sm-6<?= ($position == "right") ? " push-sm-6" : ""; ?>">
            <h2 class="<?= ($position == "left") ? "" : ""; ?>">
                <?= $this->input("headline", ["width" => 400]); ?>
                <!--
                <span class="text-muted"><?= $this->input("subline", ["width" => 400]); ?></span>
                -->
            </h2>
            <div class="<?= ($position == "left") ? "" : ""; ?>">
                <?= $this->wysiwyg("content", ["width" => 350, "height" => 200]); ?>
            </div>
        </div>

        <div class="col-sm-6<?= ($position == "right") ? " pull-sm-6" : ""; ?>">
           

            <?php
                $type = $this->select("type")->getData();
                if($type == "video") {
                    echo $this->video("video", [
                        "html5" => true,
                        "thumbnail" => "featurerette"
                    ]);
                } else {

                    echo $this->image("image", [
                        "class" => "img-fluid",
                        "thumbnail" => "magento_selection"
                        ]
                    );
                    
                    
                }
            ?>
        </div>
    </div>

    <hr>
<?php } ?>
