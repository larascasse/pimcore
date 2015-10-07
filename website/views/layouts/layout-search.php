<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">
<head>
    <meta charset="utf-8">


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="vspiOogrzIcUVBbVJByK4IT4qHpr_Ts089uOQW5ZoyA" />
    <!-- Le styles -->
    <link href="/website/static/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

    <link href="/website/static/css/global.css" rel="stylesheet">

    <link rel="stylesheet" href="/website/static/lib/projekktor/theme/style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/website/static/lib/magnific/magnific.css" type="text/css" media="screen" />

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




  

    <div id="content" class="container">
        
        <div class="col-md-12">
            <?php echo $this->layout()->content; ?>

        </div>
    </div>




<?php
    // include a document-snippet - in this case the footer document
    //echo $this->inc("/" . $this->language . "/shared/includes/footer");
?>

<script src="/website/static/bootstrap/assets/js/jquery.js"></script>
<script src="/website/static/bootstrap/dist/js/bootstrap.js"></script>




<script src="/website/static/lib/projekktor/projekktor-1.2.25r232.min.js"></script>
<script src="/website/static/lib/magnific/magnific.js"></script>

<script>

    
</script>
<script src="/website/static_lpn/js/typeahead.bundle.js"></script>
<script src="/website/static_lpn/js/lpn.js"></script>


</body>
</html>
