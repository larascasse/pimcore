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
 <link rel="stylesheet" type="text/css" href="https://www.laparqueterienouvelle.fr/skin/frontend/lpn/default/css/main-min.css?d=<?php echo time() ?>" media="all">
 <!--<link href="http://vjs.zencdn.net/5.4.4/video-js.css" rel="stylesheet">-->

    <!--<link href="/website/static/css/global.css" rel="stylesheet">-->




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

<div id="content" class="container-main"  style="background-color: #EEEEEE;padding:30px;">
    
    <div class=""><h2 style="padding: 20px 20px 20px 50px; float: left;">Fiche technique</h2> <img src="/website/static_lpn/img/logo_lpn_1ligne_300_fondblanc.gif" style="float: right"></div>
 <div class="row"> 

        <div class="col-12" style="background-color: #FFFFFF; max-width: 1000px; margin-left:auto;margin-right: auto; -webkit-border-radius: 50px;-moz-border-radius: 50px;border-radius: 50px; padding:50px;">
            <?php echo $this->layout()->content; ?>
        </div>
    </div>
</div>


<?php
    // include a document-snippet - in this case the footer document
    echo $this->inc("/" . $this->language . "/shared/includes/footer");
?>


 <!--<script src="http://vjs.zencdn.net/5.4.4/video.js"></script>-->
 <script src="/website/static_lpn/js/typeahead.bundle.js"></script>
<script src="/website/static_lpn/js/lpn.js"></script>



<link rel="stylesheet" href="/website/static_lpn/blueimp/css/blueimp-gallery.min.css">
<script src="/website/static_lpn/blueimp/js/blueimp-gallery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</body>
</html>
