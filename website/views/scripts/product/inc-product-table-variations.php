<?php

$childrens = $this->products;

?>
<style>
.table.table-striped td {
	padding: 0.3em;
}

</style>

<div class="row">
	<div class="col">
	    <div>
	       

	   		 <?php
	   		 $strChildren="";
	   		 if(count($childrens)>0) {

	   		 	$fields["Famille"] = "getFamille";
	   		 	$fields["Choix"] = "getChoixString";
	   		 	$fields["Ep."] = "getEpaisseurString";
	   		 	$fields["Larg."] = "getLargeurString";
	   		 	$fields["Long."] = "getLongueurString";


	   		 	$fields["Surface"] = "getTraitement_surfaceString";
	   		 	$fields["Finition"] = "getFinitionString";
	   		 	$fields["Support"] = "getSupport";

	   		 	$fields["CU"] = "getCoucheUsure";
	   		 	

	   		 	$fields["Colisage"] = "getColisage";
	   		 	
	   		 	//$fields["Dimensions"] = "getPimonly_dimensions";
	   		 	$fields["Classe"] = "getCalculatedClasseUtilisation";
	   		 	$fields["Fixation"] = "getFixation";
	   		 	$fields["EAN"] = "getEan";

	   		 	//$fields["Prix Public HT<br /> au ".date('d/m/Y')] = "getPrice_4";
	   		 	$fields["Prix HT"] = "getPrice_4";
	   		 	$fields["FT"] = "getPreviewLink";



			$strChildren.=   '<table class="table table-striped" style="font-size: 10px">  <thead><tr>';
			foreach ($fields as $key => $value) {
				$strChildren.= '<th>'.$key.'</th>';
			}
			$strChildren.= '</tr></thead>';

  			$index = 1;
  			$productsToDisplay =array();
			foreach ($childrens as $subProduct) {

				//Configurables
				if($subProduct->getEan()=="") {


					$subProductChildrens = $subProduct->getChildren(null,true);
		
					
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
							
							if (is_array($v))
								$v = implode(',',$v);

							$strChildren.= '<td style="padding: 0.3em;">'.$v.'</td>';
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