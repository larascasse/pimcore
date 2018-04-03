<?php

$childrens = $this->products;

?>

<div class="row">
	<div class="col">
	    <div class="">
	       

	   		 <?php
	   		 $strChildren="";
	   		 if(count($childrens)>0) {

	   		 	$fields["Famille"] = "getFamille";
	   		 	$fields["Choix"] = "getChoix";
	   		 	$fields["Epaisseur"] = "getEpaisseurString";
	   		 	$fields["Largeur"] = "getLargeurString";
	   		 	$fields["Longueur"] = "getLongueurString";

	   		 	
	   		 	$fields["Surface"] = "getTraitement_surface";
	   		 	$fields["Finition"] = "getFinition";
	   		 	$fields["Support"] = "getSupport";

	   		 	$fields["CU"] = "getCoucheUsure";
	   		 	

	   		 	$fields["Colisage"] = "getColisage";
	   		 	
	   		 	//$fields["Dimensions"] = "getPimonly_dimensions";
	   		 	$fields["Utilisation"] = "getCalculatedClasseUtilisation";
	   		 	$fields["EAN"] = "getEan";

	   		 	$fields["Prix Public HT<br /> au ".date('d/m/Y')] = "getPrice_4";
	   		 	$fields["FT"] = "getPreviewLink";



			$strChildren.=   '<table class="table table-striped">  <thead><tr>';
			foreach ($fields as $key => $value) {
				$strChildren.= '<th>'.$key.'</th>';
			}
			$strChildren.= '</tr></thead>';

  			$index = 1;
  			$productsToDisplay =array();
			foreach ($childrens as $subProduct) {

				//Configurables
				if($subProduct->getEan()=="") {
					$subProductChildrens = $subProduct->getChilds();
		
					
					foreach ($subProductChildrens as $subsubProduct) {
						$productsToDisplay[] = $subsubProduct;
					
					}

				}
				else { 
					$productsToDisplay[] = $subProduct;
					
				}
			}

			foreach ($productsToDisplay as $subproduct) {
				$strChildren.= '<tr>';
				?>
					
						<?php
						foreach ($fields as $key => $value) {
							switch ($key) {
								case 'Famille':
									$v = $subproduct->isParquetMassif()?'Massif':'';
									$v = $subproduct->isParquetContrecolle()?'Contrecollé':$v;
									break;

								case 'Dimensions':
									$v = $subproduct->getDimensionsStringExtended();
									break;
								
								default:
									$v = $subproduct->$value();
									break;
							}
							
								
							$strChildren.= '<td>'.$v.'</td>';
						}
						?>
					


				<?php
				$strChildren.= '</tr>';
			}
			$strChildren.=   "</table>";
		}

		echo $strChildren;
		?>

	    </div>
	</div>

 <!-- Fin product header -->  


</div> 
<!-- row -->