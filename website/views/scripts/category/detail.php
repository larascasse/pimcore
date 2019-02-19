<?php $this->layout()->setLayout("layout-lpnv4"); ?>


<div class="category-image-hero">
    <?php
     if($this->category->getImage_header()) : 

        echo $this->category->getImage_header()->getThumbnail("magento-header")->getHtml();

        else :

        ?>
           <img src="http://shopdev.laparqueterienouvelle.fr/media/catalog/category/cache/1200x720/parquet-massif-chene-matiere-huile-structure-junot-23x100-180-still_laparqueterienouvelle_2800.jpg" alt="Parquet clairs" title="Parquet clairs" class=" lazyloaded" data-src="http://shopdev.laparqueterienouvelle.fr/media/catalog/category/cache/1200x720/parquet-massif-chene-matiere-huile-structure-junot-23x100-180-still_laparqueterienouvelle_2800.jpg">

        <?php endif; ?>
        <div class="image-hero-degrade"></div>
        </div>
        <div class="breadcrumb_cnt breadcrumb-left">    

    
<div class="container-main text-center">
    <ul class="breadcrumb breadcrumb-category"><li class="home crumb-level-0">
                            <a href="http://shopdev.laparqueterienouvelle.fr/" title="Aller à la page d'accueil">Accueil</a>
                        </li>
                                <li class="category151 crumb-level-1">
                            <a href="http://shopdev.laparqueterienouvelle.fr/parquet.html" title="">Parquets</a>
                        </li>
                                <li class="category198 crumb-level-2">
                            <a href="http://shopdev.laparqueterienouvelle.fr/parquet/choisir-son-parquet.html" title="">Découvrir</a>
                        </li>
                        </ul></div>



                    </div>



                    <div class="container-main category-header-container noimg category-auto">
            <div class="row">
                <div class="col-12 col-md-6 text-left category-name">
                    <h1><?php echo $this->category->getName(); ?></h1>
                    <p class="description"><?php echo nl2br($this->category->getDescription()); ?></p>
                    
                </div>
                
                <div class="col-12 col-md-6 subdescription text-left">
                    <ul><?php
                        $sub = explode("\n",$this->category->getSub_description());
                        foreach ($sub as $row) {
                           echo '<li>'.$row.'</i>';
                        }
                        ?>
                    </ul>

</div>

<?php
if(!is_array($this->category->products))
    return;
?>


<section class="area-wysiwyg">

 

   	<?php 

    foreach ($this->category->products as $products) { 
 

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