<?php $this->layout()->setLayout("layout-lpn"); ?>
<section class="area-wysiwyg">

    <div class="page-header">
        <h1><?php echo $this->category->getName(); ?></h1>
    </div>
   	<?php foreach ($this->category->products as $products) { 
 

    ?>
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
                <img class="media-object" src="<?php echo $products->getImage_1()->getThumbnail("newsList")->getPath(); ?>">
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

</section>