<?php
if($product = $this->product) {
	
	if($this->previewmode) {
    	echo '<a href="https://eshop.laparqueterienouvelle.fr/'.$product->getName().'" title="Voir '.$product->getName().'" class="table-selectionner-btn">'.$this->btn_title.'</a>';
   	}
    else {
   
    	$widget =  '{{block type="core/template" template="lpn/lpn_product_link.phtml" name="givemetheprice_'.$product->getSku().'" product_sku="'.$product->getSku().'" class="btn"}}';
    	echo $widget;


    }

}

else if($category = $this->category) {
	
	
	$catId = $category?$category->getMage_category_id():-1;
    
    if($this->previewmode) {
    	echo '<a href="https://eshop.laparqueterienouvelle.fr/category/'. $catId.'" title="Voir '.$category->getName().'" class="table-selectionner-btn">'.$this->btn_title.'</a>';
   	}
    else {
   
    	$widget =  ' {{widget type="catalog/product_widget_link" template="catalog/product/widget/link/link_inline.phtml" id_path="category/'. $catId.'" class="table-selectionner-btn" anchor_text="'.$this->btn_title.'" title="'.$category->getName().'"}}';
    	echo $widget;


    }
    


}
else if($blogPost = $this->blogPost) {
	echo $blogPost->getTitle();
}
else if($projectPost = $this->projectPost) {
	echo $projectPost->getName();
}
else if($document = $this->document) {
	echo $document->getName()." ".$document->getId();

	if($this->previewmode) {
    	echo '<a href="'.$document->getKey().'" title="Voir '.$document->getTitle().'" class="table-selectionner-btn">'.$this->btn_title.'</a>';
   	}
    else {
   
    	$widget =  '{{widget type="cms/widget_page_link" template="cms/widget/link/link_block.phtml" page_id="'.$document->getKey().'"}}';
    	echo $widget;


    }

}