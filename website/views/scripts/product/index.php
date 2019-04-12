
<?php $this->layout()->setLayout("layout-lpn"); ?>
<?php $this->template("/includes/content-headline.php"); ?>

<?php echo $this->areablock("content"); ?>

<?php 
$index=0;
$cols = 3;
foreach ($this->products as $product) { 
 
        $this->template("snippets/inc-product-row.php", array(
    "product" => $product,"index"=>$index, "cols"=>$cols)); 
}      
    ?>
  


<!-- pagination start -->
<?php echo $this->paginationControl($this->products, 'Sliding', 'includes/paging.php', array(
   'urlprefix' => $this->document->getFullPath() . '?page=',
   'appendQueryString' => true
)); ?>
<!-- pagination end -->