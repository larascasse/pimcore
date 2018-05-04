<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="/website/static_lpn/css/bootstrap-3.3.7.min.css">
<link rel="stylesheet" href="/website/static_lpn/css/bootstrap-theme-3.3.7.min.css">

<link rel="stylesheet" href="/website/static_lpn/scss/build/css/ft.css?t=<?php echo time()?>">

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
</div>

<script src="/website/static_lpn/js/jquery-3.1.1.slim.min.js"></script>
<script src="/website/static_lpn/js/lpn.js"></script>
<script src="/website/static_lpn/js/tether.min.js"></script>
<script src="/website/static_lpn/js/bootstrap-3.3.7.min.js"></script>
<script src="/website/static_lpn/js/balancetext.min.js"></script>
<script>
    $(document).ready(function() {

        balanceText(); 
    });
</script>



</body>
</html>
