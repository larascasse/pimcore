<?php
if($product = $this->product) {
	echo $product->getName();
}

else if($category = $this->category) {
	
	
	$catId = $category?$category->getMage_category_id():-1;
    
    if($this->previewmode) {
    	echo '<a href="https://eshop.laparqueterienouvelle.fr/category/'. $catId.'" title="Voir '.$category->getName().'" class="table-selectionner-btn">'.$this->btn_title.'</a>';
   	}
    else {
    	echo '{{widget type="catalog/product_widget_link" template="catalog/product/widget/link/link_inline.phtml" id_path="category/'. $catId.'" class="btn btn-text" anchor_text="'.$this->btn_title.'" title="Voir '.$category->getName().'"}}';
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
}