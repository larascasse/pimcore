<?php if($this->editmode): ?>

	<?=  $this->select("grid-mode", [
            "width" => 300,
            "reload" => false,
            "store" => [['grid-destructuree',"Normal (grand à gauche)"],['grid-destructuree grid-inverse','Inverse'],['grid-destructuree grid-vertical','Vertical'],['grid-destructuree grid-vertical grid-inverse','Vertical Inverse']]
        ]);
     ?>
    <?= $this->multihref("objectPaths",
    [
        "types" => ["object"],
        "classes" => ["projectPost"],
        "title" => "Faire glisser des réalisations"

    ]); ?>


<?php else: 

	$defaultGridMode = $this->select("grid-mode")->getData();
    if(!$defaultGridMode) {
        $defaultGridMode = 'grid-simple';
     }
    
    $isInverse = ($defaultGridMode == "grid-destructuree grid-inverse") || ($defaultGridMode == "grid-destructuree grid-vertical grid-inverse");

	$isVertical = ($defaultGridMode == "grid-destructuree grid-vertical") || ($defaultGridMode == "grid-destructuree grid-vertical grid-inverse");


    if($defaultGridMode == 'grid-simple') {
     ?>
   
		<div class="blog">
			<div class="card-columns grid-count-<?php echo count($this->multihref("objectPaths")->getElements())?> clickable">
			<?php foreach($this->multihref("objectPaths") as $article) {

				$this->template("/snippets/lpn-grid-realisations-item.php",array('article'=>$article)); ?>

			<?php } ?>
			</div>
		</div>

	<?php
	}
	else {
	?>
		<?php 

		//TODO A METTRE DANS UN TEMPLATE
		$activeElements=[];
		$hrefElements = $this->multihref("objectPaths")->getElements();
		if(is_array($hrefElements)) {
			foreach ($hrefElements as $element) {
				if($element->isPublished()) {
					$activeElements[] = $element;
				}
			}
		}
		$count = count($activeElements);
		$i=0;
		//$count = count($this->multihref("objectPaths")->getElements());
		$sameSizeCount=1;
		$isDoubleSize=true;
		$simple=false;

		//Algo pour avoir 2 fois de suite la meme taille
   

	    $pimcoreThimbClass = "magento_equigrid_h";

	    //Type avec A vertival, 2 H, 2V...
	    if($simple) {
	        if($isDoubleSize) {
	            $pimcoreThimbClass = "magento_equigrid_v";
	        }

	        //Pourle prochain
	        if($sameSizeCount==1 && $isDoubleSize) {
	            $sameSizeCount = 0;
	            $isDoubleSize = false;
	        }
	        else if($sameSizeCount==1 && !$isDoubleSize) {
	            $sameSizeCount = 0;
	            $isDoubleSize = true;
	        }
	        else {
	            $sameSizeCount++;
	        }
	    }
	    else {
	        $colClass="";

	        switch ($count) {
	            case 1:
	                $pimcoreThimbClass = "magento_equigrid_h";
	                break;

	            case 2:
	                $pimcoreThimbClass = "magento_equigrid_h";
	                break;

	            case 3:
	                switch ($i) {
	                    case 0:
	                        $pimcoreThimbClass = $isInverse?"magento_equigrid_h":"magento_equigrid_v";
	                        break;
	                    case 1:
	                        $pimcoreThimbClass = "magento_equigrid_h";
	                        break;
	                    case 2:

	                        $pimcoreThimbClass = $isInverse?"magento_equigrid_v":"magento_equigrid_h";
	                        break;
	                    
	                    default:
	                        # code...
	                        break;
	                }
	                break;

	             case 4:
	                switch ($i) {
	                    case 0:
	                         $pimcoreThimbClass = ($isVertical && !$isInverse) ?"magento_equigrid_v":"magento_equigrid_h";
	                        break;
	                    case 1:
	                        $pimcoreThimbClass = ($isVertical && $isInverse) ?"magento_equigrid_v":"magento_equigrid_h";
	                        break;
	                    case 2:
	                        $pimcoreThimbClass = ($isVertical && $isInverse) ?"magento_equigrid_v":"magento_equigrid_h";
	                        break;
	                    case 3:
	                        $pimcoreThimbClass = ($isVertical && !$isInverse) ?"magento_equigrid_v":"magento_equigrid_h";
	                        
	                        break;
	                    
	                    default:
	                        # code...
	                        break;
	                }
	                break;
	            
	            default:
	                # code...
	                break;
	        }
	    }

	    

	    ?>

	    <div class="table-container realisations card-columns  <?php echo $defaultGridMode?> <?php echo 'grid-destructuree-'.$count?>">

	    <?php


		foreach($activeElements as $article) { 
				$image="";

				$subtitle = "Inspiration";



			    if($article->getCategory()) {
			    	

			    	$subtitle = $article->getCategory()[0]->getName();
			    }


				if($article->getPosterImage()) { 
    				$image = $article->getPosterImage()->getThumbnail($pimcoreThimbClass)->getHTML(["class" => "img-fluid"]);
				} 
				$link = '/projet/'.$article->getKey();


?>
			<!--  item -->
		    <?php
		    $colFirst = "";
		    if(
		        $i==0
		        || ($i==1 && !$isInverse && $isVertical)
		        || ($i==2 && $count==3 && $isInverse && $isVertical)
		        || ($i==2 && $count==4)

		        )
		    $colFirst = " col-first";
		    ?>
		    <div class="table-bloc-thumb<?php echo $colFirst ?>">
		        <div class="rollbloc">

		        <?php 
		            echo $image;
		        
		        ?>
		        <div class="table-bloc-thumb-text">
		            
		                <p><?= $subtitle ?></p>
		                <h3><?= $article->getName() ?></h3>
		            
		            <div class="rollbloc_txt_over">
		                <div class="rollbloc_txt_over_cnt">
		                    <div class="rollbloc_txt"><?= $article->getAccroche(); ?></div>
		                    
		                </div>
		            </div>
		            <a href="<?= $link; ?>" class="btn table-selectionner-btn">Voir le projet</a>
		           

		         </div>
		         </div>




		    </div>
		    <!-- fin item -->
	    <?php 
	    	$i++;
	    } ?>
	    </div>
    <?php
	}
	?>
  

<?php endif; ?>
