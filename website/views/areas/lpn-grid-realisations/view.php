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
    

    $isInverse = strpos($defaultGridMode,'grid-inverse')>0;
    $isVertical = strpos($defaultGridMode,'grid-vertical')>0;

	


    if($defaultGridMode == 'grid-simple') {
     ?>
   
		<div class="blog">
			<div class="card-columns clickable grid-count-<?php echo count($this->multihref("objectPaths")->getElements())?>">
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
		$i=0;
		$elements = $this->multihref("objectPaths")->getElements();
		$count = count($elements);
		$sameSizeCount=1;
		$isDoubleSize=true;
		$simple=false;

		?>

	    
		<div class="container-main">
	    <div class="table-container realisations <?php echo $defaultGridMode?> <?php echo 'grid-destructuree-'.$count?>">

	    <?php


		foreach($elements as $article) { 

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
		                $pimcoreThimbClass = "magento_h_half";
		                break;

		            case 3:
		                switch ($i) {
		                    case 0:
		                        $pimcoreThimbClass = $isInverse?"magento_h_half":"magento_equigrid_v";
		                        break;
		                    case 1:
		                        $pimcoreThimbClass = "magento_h_half";
		                        break;
		                    case 2:

		                        $pimcoreThimbClass = $isInverse?"magento_equigrid_v":"magento_h_half";
		                        break;
		                    
		                    default:
		                        # code...
		                        break;
		                }
		                break;

		             case 4:
		                switch ($i) {
		                    case 0:
		                         $pimcoreThimbClass = ($isVertical && !$isInverse) ?"magento_equigrid_v":"magento_h_half";
		                         $pimcoreThimbClass." ".$i;
		                        break;
		                    case 1:
		                        $pimcoreThimbClass = ($isVertical && $isInverse) ?"magento_equigrid_v":"magento_h_half";
		                        $pimcoreThimbClass." ".$i;
		                        break;
		                    case 2:
		                        $pimcoreThimbClass = ($isVertical && $isInverse) ?"magento_equigrid_v":"magento_h_half";
		                        $pimcoreThimbClass." ".$i;
		                        break;
		                    case 3:
		                        $pimcoreThimbClass = ($isVertical && !$isInverse) ?"magento_equigrid_v":"magento_h_half";
		                        $pimcoreThimbClass." ".$i;
		                        
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

		    <?php
		    if($i==0) {
		    	echo '<div class="grid-col">';
		    }
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

		    if($i== ($count-1)) {
		    	echo "</div>";
		    	
		    }
		    else if (
		    	//A près le 1er
		    	($i==0 && $count<=2)
		    	|| ($i==0 && $count==3 && $isVertical && !$isInverse)
		    	//A près le 12e
		    	|| ($i==1 && $count==3 && $isVertical && $isInverse)
		    	|| ($i==1 && $count==3 && !$isVertical)
		    	|| ($i==1 && $count==4)
		    ) {
		    	echo "</div>";
		    	echo '<div class="grid-col">';
		    }
	   
	    	$i++;
	    } ?>
	    </div>
	    </div>
    <?php
	}
	?>
  

<?php endif; ?>
