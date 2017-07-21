<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">
<head>
<script type="text/javascript">
   var BASE_URL = 'http://magento.florent.local/magento/';
</script>

<?php 
if (isset($_SERVER["HTTP_HOST"]) && $_SERVER["HTTP_HOST"]=="pimcore.florent.local") { ?>
<link rel="stylesheet" type="text/css" href="http://magento.florent.local/skin/frontend/lpn/matieres/css/matieres-min.css" media="all" />

<script type="text/javascript" src="https://www.laparqueterienouvelle.fr/js/lpn/lpn-terrasses.min.js?q=20170105"></script>
<?php } else { ?>
<link rel="stylesheet" type="text/css" href="https://www.laparqueterienouvelle.fr/skin/frontend/lpn/matieres/css/matieres-min.css" media="all" />

<script type="text/javascript" src="https://www.laparqueterienouvelle.fr/js/lpn/lpn-terrasses.min.js?q=20170105"></script>

<?php } ?>
<script type="text/javascript" src="https://raw.githubusercontent.com/aFarkas/lazysizes/gh-pages/lazysizes.min.js"></script>

</head>
<body class=" cms-index-index cms-home">
<div class="container wpcms" id="maincnt">
    <?= $this->layout()->content; ?>w
 </div>

	
<div id="nsgcachepage" class="hidden">
	<script type="text/javascript">
	//<![CDATA[
		var _nsg_current_category="";		
	//]]>
	</script>
</div>

 
<div id="nsgcacheuser" class="hidden">
	<script type="text/javascript">
	//<![CDATA[
		var _nsg_isLogged="";
		var _nsg_isAccount="";
		var _nsg_wishlistCnt="0";
		var _nsg_cartCnt="0";
	//]]>
	</script>
</div>
 
  

<div id="revealModalContainer"></div>    

        
</body>
</html>