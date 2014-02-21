<?php $this->layout()->setLayout("layout-lpn"); ?>

<?php $this->template("/includes/content-headline.php"); ?>

<?php echo $this->areablock("content"); ?>

<?php foreach ($this->categories as $category) { 
 

    ?>
    <div class="media">
        <?php
            $detailLink = $this->url(array(
                "id" => $category->getId(),
                "text" => $category->getName(),
                "prefix" => $this->document->getFullPath()
            ), "categories");
        ?>
        <div class="media-body">
            <h4 class="media-heading">
                <a href="<?php echo $detailLink; ?>"><?php echo $category->getName(); ?></a>
            </h4>
        </div>
    </div>
<?php } ?>


<!-- pagination start -->
<?php echo $this->paginationControl($this->categories, 'Sliding', 'includes/paging.php', array(
   'urlprefix' => $this->document->getFullPath() . '?page=',
   'appendQueryString' => true
)); ?>
<!-- pagination end -->