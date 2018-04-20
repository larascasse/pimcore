<table class="table table-bordered table-striped" style="font-size:12px;">
        <thead class="thead-inverse__">
    <tr>
<?php 


foreach ($this->transports as $transport) { 
	$attributes = $transport->getClass()->getFieldDefinitions();
	foreach($attributes as $key=> $value) {

	    $attribute  =  $value->getName();
	    
	    $attributeLabel = $value->getTitle();
	    $attributeKey = $attribute;
	     echo "<th>".$attributeLabel."</th>";
	 }
	 break;
}

?>
</tr>
</thead>




<?php

foreach ($this->transports as $transport) { 

 	echo $this->template("transport/inc-transport-row.php", array("transport" => $transport)); 
}      
?>
  
</table>

<!-- pagination start -->
<?php echo $this->paginationControl($this->transports, 'Sliding', 'includes/paging.php', array(
   'urlprefix' => 'transports/?page=',
   'appendQueryString' => true
)); ?>
<!-- pagination end -->