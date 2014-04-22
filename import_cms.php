<?php
$cmsurl = (isset($_GET) && isset($_GET["url"]))?$_GET["url"]:"http://www.laparqueterienouvelle.fr/realisations-parquet-beton/?ajax=true";

$content =   file_get_contents($cmsurl);

$content = str_replace("grid1", "col-md-2", $content);
$content = str_replace("grid2", "col-md-3", $content);
$content = str_replace("grid3", "col-md-4", $content);
$content = str_replace("grid4", "col-md-6", $content);
$content = str_replace("grid5", "col-md-7", $content);
$content = str_replace("grid6", "col-md-8", $content);
$content = str_replace("grid7", "col-md-9", $content);
$content = str_replace("grid8", "col-md-10", $content);
$content = str_replace("grid9", "col-md-11", $content);
$content = str_replace("grid10", "col-md-12", $content);
$content = str_replace("grid11", "col-md-14", $content);
$content = str_replace("grid12", "col-md-16", $content);
$content = str_replace("bloc", "bloc row", $content);
$content = str_replace("=\"container", "=\"containerWP", $content);


$content = str_replace("data-original", "data-src", $content);
$content = str_replace("<section", "<div", $content);
$content = str_replace("</section", "</div", $content);
//$content = str_replace("lazy", "norelazy", $content);


header('Content-Type: text/html; charset=utf-8');
//echo '<head><meta charset="UTF-8" /></head><body>';
echo '<div class="">'.$content.'</div>';
//echo '</body>';






?>