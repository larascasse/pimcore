<?php
//NE PAS DEPLACER? UTILISER PAR CONTENTCONTROLLER

$mustRender = $this->layout()->getLayout() == "layout-fiche-pdf";
if($product = $this->product) {
	
	if($this->previewmode || $mustRender) {
    	echo '<a href="https://www.laparqueterienouvelle.fr/'.$product->getName().'" title="Voir '.$product->getName().'" class="btn table-selectionner-btn">'.$this->btn_title.'</a>';
   	}
    else {
   
    	$widget =  '{{block type="core/template" template="lpn/lpn_product_link.phtml" name="givemetheprice_'.$product->getSku().'" product_sku="'.$product->getSku().'" class="btn" anchor_text="'.$this->btn_title.'"}}';
    	echo $widget;


    }

}

else if($teinte = $this->teinte) {
    
    if($this->previewmode || $mustRender) {
        echo '<a href="https://www.laparqueterienouvelle.fr/'.$teinte->getName().'" title="Voir '.$teinte->getName().'" class="btn table-selectionner-btn">'.$this->btn_title.'</a>';
    }
    else {
   
        $widget =  '{{block type="core/template" template="lpn/lpn_product_link.phtml" name="givemetheprice_'.$teinte->getMageIdentifier().'" product_sku="'.$teinte->getMageIdentifier().'" class="btn" anchor_text="'.$this->btn_title.'"}}';
        echo $widget;


    }

}
else if($category = $this->category) {
	
	
	$catId = $category?$category->getMage_category_id():-1;
    
    if($this->previewmode || $mustRender) {
    	echo '<a href="https://www.laparqueterienouvelle.fr/category/'. $catId.'" title="Voir '.$category->getName().'" class="table-selectionner-btn">'.$this->btn_title.'</a>';
   	}
    else {
    	$widget =  ' {{widget type="catalog/category_widget_link" template="catalog/category/widget/link/link_block.phtml" id_path="category/'. $catId.'" class="btn" anchor_text="'.$this->btn_title.'" title="'.$category->getName().'"}}';
    	echo $widget;


    }
    


}
else if($blogPost = $this->blogPost) {
	echo $blogPost->getTitle();
}
else if($projectPost = $this->projectPost) {
	$link = "/".$projectPost->getMageUrl();
    echo '<a href="'.$link.'" title="Voir '.$projectPost->getName().'" class="btn table-selectionner-btn">'.$this->btn_title.'</a>';
}
else if($document = $this->document) {
	//echo $document->getName()." ".$document->getId();

	if($this->previewmode|| $mustRender) {
    	echo '<a href="'.$document->getKey().'" title="Voir '.$document->getTitle().'" class="btn table-selectionner-btn">'.$this->btn_title.'</a>';
   	}
    else {
        
    	//$widget =  '{{widget type="cms/widget_page_link" template="cms/widget/link/link_block.phtml" page_id="'.$document->getKey().'"}}';
        echo '<a href="/'.$document->getKey().'" title="Voir '.$document->getTitle().'" class="btn table-selectionner-btn">'.$this->btn_title.'</a>';
    	echo $widget;


    }

}