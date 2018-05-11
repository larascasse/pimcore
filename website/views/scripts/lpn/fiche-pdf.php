<style>
@media print {
	#logo2 {
		display: none;
		top:0;
		left: 0;
	}
	
}
</style>

<?php

if(!function_exists('apache_request_headers')) {
    function apache_request_headers() {
        $headers = array();
        foreach($_SERVER as $key => $value) {
            if(substr($key, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))))] = $value;
            }
        }
        return $headers;
    }
}

$header = apache_request_headers();
?>

<?php 
if (!isset($header["lpn-pdf"])) : ?>
	<header>
	<div id="logo2">
	<?php 
	$width = 300;
	echo $this->template("includes/logo_1l_small_svg.php",array('width'=>$width)); ?>	 
</div>
</header>
<?php else  : ?>

<?php endif; ?> 


<h1><?php echo $this->getTitle(); ?></h1>
<div class="content">
<?php echo $this->areablock("content"); ?>
</div>