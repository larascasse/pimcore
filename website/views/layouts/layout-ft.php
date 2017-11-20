<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Le styles -->
 <!--<link rel="stylesheet" type="text/css" href="https://www.laparqueterienouvelle.fr/skin/frontend/lpn/default/css/main-min.css?d=<?php echo time() ?>" media="all">-->
 <!--<link href="http://vjs.zencdn.net/5.4.4/video-js.css" rel="stylesheet">-->

    <!--<link href="/website/static/css/global.css" rel="stylesheet">-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

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

 <!--<script src="http://vjs.zencdn.net/5.4.4/video.js"></script>-->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>

<script src="/website/static_lpn/js/lpn.js"></script>




<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>-->
<!-- Latest compiled and minified CSS 
Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<script src="//cdn.jsdelivr.net/npm/balance-text@3.2.0/balancetext.min.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {

        balanceText(); 
    });
</script>



</body>
</html>
