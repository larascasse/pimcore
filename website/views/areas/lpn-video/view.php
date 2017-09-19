
<section class="area-video">

    <?php $this->template("/includes/area-headlines.php"); ?>

    <?= $this->video("video", [
        "html5" => true,
        "thumbnail" => "content",
        "height" => "auto",
        "width" =>	"100%",
        "attributes" => ["class" => "video-js custom-class", "preload" => "auto", "controls" => "", "data-custom-attr" => "my-test","autoplay" => "true" ,"loop" => "true"]

    ]); ?>

</section>