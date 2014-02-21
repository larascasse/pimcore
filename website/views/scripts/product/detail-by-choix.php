

<?php 
$this->template("/includes/content-headline.php");

$this->document->setProperty("leftNavHide",true);
 ?>

<?php //echo $this->areablock("content"); 
echo $this->select("mySelect",array(
            "store" => array(
                array("option1", "Option One"),
                array("option2", "Option Two"),
                array("option3", "Option Three")
            )
        ));
echo "klklmklmklkm";
?>

<?php foreach ($this->products as $products) { ?>
    <div class="media">
        <?php
            $detailLink = $this->url(array(
                "id" => $products->getId(),
                "text" => $products->getName(),
                "prefix" => $this->document->getFullPath()
            ), "produits");
        ?>
        <?php if($products->getImage_1()) { ?>
            <a class="pull-left" href="<?php echo $detailLink; ?>">
                <img class="media-object" src="<?php echo $products->getImage_1()->getThumbnail("newsList"); ?>">
            </a>
        <?php } ?>

        <div class="media-body">
            <h4 class="media-heading">
                <a href="<?php echo $detailLink; ?>"><?php echo $products->getName(); ?></a>
               <p><?php echo $products->getShort_description(); ?></p>
            </h4>
        </div>
    </div>
<?php } ?>


<!-- pagination start -->
<?php echo $this->paginationControl($this->products, 'Sliding', 'includes/paging.php', array(
   'urlprefix' => $this->document->getFullPath() . '?page=',
   'appendQueryString' => true
)); ?>
<!-- pagination end -->