<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">
<head>
    <meta charset="utf-8">

    <?php
        // portal detection => portal needs an adapted version of the layout
        $isPortal = false;
        if($this->getParam("controller") == "content" && $this->getParam("action") == "portal") {
            $isPortal = true;
        }
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

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="vspiOogrzIcUVBbVJByK4IT4qHpr_Ts089uOQW5ZoyA" />
    <!-- Le styles -->
 

    <link rel="stylesheet" href="/website/static_lpn/css/bootstrap-4.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="/website/static_lpn/css/bootstrap-editable.min.css" crossorigin="anonymous">
<script   src="/website/static_lpn/js/jquery-3.1.1.min.js"></script>
<link rel="stylesheet" href="/website/static_lpn/css/bootstrap-vue.css" crossorigin="anonymous">
<link rel="stylesheet" href="/website/static_lpn/algolia/instantsearch.min.css" crossorigin="">
<link rel="stylesheet" href="/website/static_lpn/scss/build/css/mauchamp.css?t=<?php echo time()?>">



  <link rel="stylesheet" type="text/css" href="/website/static_lpn/algolia/main.css" />
  <link rel="stylesheet" type="text/css" href="/website/static_lpn/loader/jquery.loader.fullscreen.css" />


    <?php echo $this->headLink(); ?>

    <?php if($this->editmode) { ?>
        <link href="/website/static/css/editmode.css?_dc=<?php echo time(); ?>" rel="stylesheet">
    <?php } ?>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/website/static/bootstrap/assets/js/html5shiv.js"></script>
    <script src="/website/static/bootstrap/assets/js/respond.min.js"></script>
    <![endif]-->
    <link href="/website/static_lpn/css/lpn.css" rel="stylesheet">

</head>

<body>


<?php echo $this->layout()->content; ?>






<div class="overlay"></div>


<script src="/website/static_lpn/js/pdfobject.min.js"></script>
<script src="/website/static_lpn/js/tether.min.js"></script> 
<script src="/website/static_lpn/js/popper.min.js"></script>
   
<script src="/website/static_lpn/js/bootstrap.min.js"></script>
<script src="/website/static_lpn/js/bootstrap-editable.min.js"></script>

<!-- VUE -->
<script src="/website/static_lpn/js/polyfill.min.js"></script>
<script src="/website/static_lpn/js/vue.min.js"></script>
<script src="/website/static_lpn/js/bootstrap-vue.js"></script>



<script src="/website/static_lpn/js/typeahead.bundle.js"></script>
<script src="/website/static_lpn/js/lpn.js"></script>


<script src="/website/static_lpn/algolia/instantsearch.min.js"></script>
<script src="/website/static_lpn/algolia/search.js"></script>

<script src="/website/static_lpn/loader/jquery.loader.fullscreen.js"></script>


</body>
</html>
