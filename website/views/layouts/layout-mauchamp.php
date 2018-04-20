<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="format-detection" content="telephone=no">

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
<link rel="stylesheet" href="/website/static_lpn/css/bootstrap-4.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="/website/static_lpn/css/bootstrap-editable.min.css" crossorigin="anonymous">
<script   src="/website/static_lpn/js/jquery-3.1.1.min.js"></script>



  <!--<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>-->
 <!--<link href="http://vjs.zencdn.net/5.4.4/video-js.css" rel="stylesheet">-->

    <!--<link href="/website/static/css/global.css" rel="stylesheet">-->

    


    <?php echo $this->headLink(); ?>

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
  window.log = function f() {

  log.history = log.history || [];
  log.history.push(arguments);
  if (this.console) {
    var args = arguments,
      newarr;
    args.callee = args.callee.caller;
    newarr = [].slice.call(args);
    if (typeof console.log === 'object') log.apply.call(console.log, console, newarr);
    else console.log.apply(console, newarr);
  }
};

</script>

<div id="content" class="container">

            <?php echo $this->layout()->content; ?>

</div>



<script src="/website/static_lpn/js/pdfobject.min.js"></script>
<script src="/website/static_lpn/js/tether.min.js"></script> 
<script src="/website/static_lpn/js/popper.min.js"></script>
   
<script src="/website/static_lpn/js/bootstrap-4.min.js"></script>
<script src="/website/static_lpn/js/bootstrap-editable.min.js"></script>



</body>
</html>
