<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">
<head>
    <meta charset="utf-8">

    <?php

        try {
            // output the collected meta-data
            if(!$this->document) {
                // use "home" document as default if no document is present
                $this->document = Document::getById(1);
            }

            if($this->document->getTitle()) {
                // use the manually set title if available
                $this->headTitle()->set($this->document->getTitle());
            }

            if($this->document->getDescription()) {
                // use the manually set description if available
                $this->headMeta()->appendName('description', $this->document->getDescription());
            }

            //$this->headTitle()->append("pimcore Demo");
            $this->headTitle()->setSeparator(" : ");

            echo $this->headTitle();
            echo $this->headMeta();
        
        } catch (Exception $e) {
            //Bug si ce n'est pas un document !! (ex produit)
        }
    ?>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Le styles -->
 <!--<link rel="stylesheet" type="text/css" href="https://www.laparqueterienouvelle.fr/skin/frontend/lpn/default/css/main-min.css?d=<?php echo time() ?>" media="all">-->
 <!--<link href="http://vjs.zencdn.net/5.4.4/video-js.css" rel="stylesheet">-->

    <!--<link href="/website/static/css/global.css" rel="stylesheet">-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<link rel="stylesheet" href="/website/static_lpn/scss/build/css/ft.css">





    <?php echo $this->headLink(); ?>

    <?php if($this->editmode) { ?>
        <link href="/website/static/css/editmode.css?_dc=<?php echo time(); ?>" rel="stylesheet">
    <?php } ?>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/website/static/bootstrap/assets/js/html5shiv.js"></script>
    <script src="/website/static/bootstrap/assets/js/respond.min.js"></script>
    <![endif]-->
    <!--<link href="/website/static_lpn/css/lpn.css" rel="stylesheet">-->

</head>

<body>
<script>
function trackPageView() {};
function trackLinkEvent() {};
var fbq;
var dataLayer=[];
</script>
<style>
.pim-centered {
    
    margin-left:auto;
    margin-right: auto; 
    /*max-width: 1000px; */
   
}
.pim-ft-bkg {
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px; 
    background-color: #FFFFFF; 
    padding:0 50px 50px 50px;

}
</style>

<div id="content" class="container-pdf">

    <?php echo $this->layout()->content; ?>
   <!-- <div class="row"> 
        <div class="col-xs-12 pim-centered"">
        <h2 style="padding: 20px 20px 20px 25px; float: left;">Fiche technique</h2>
        <img src="/website/static_lpn/img/logo_lpn_1ligne_300_fondblanc.gif" style="padding: 20px 30px 20px 20px; float: right">
        </div>

    </div>

    <div class="row"> 

            <div class="col-xs-12 pim-centered pim-ft-bkg">
                <?php //echo $this->layout()->content; 
                ?>
            </div>
        </div>
    </div>
    -->

<?php
    // include a document-snippet - in this case the footer document
    echo $this->inc("/" . $this->language . "/shared/includes/footer");
?>


 <!--<script src="http://vjs.zencdn.net/5.4.4/video.js"></script>-->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>

 <script src="/website/static_lpn/js/typeahead.bundle.js"></script>
<script src="/website/static_lpn/js/lpn.js"></script>



<link rel="stylesheet" href="/website/static_lpn/blueimp/css/blueimp-gallery.min.css">
<script src="/website/static_lpn/blueimp/js/blueimp-gallery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>-->
<!-- Latest compiled and minified CSS 
Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<script src="//cdn.jsdelivr.net/npm/balance-text@3.2.0/balancetext.min.js" crossorigin="anonymous"></script>
<script>
    console.log("UU",jQuery,$);
    $(document).ready(function() {

        balanceText(); 
    });
</script>



</body>
</html>
