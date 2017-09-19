


    <?php $video = $this->video("video", [
        "html5" => true,
        "thumbnail" => "content",
        "height" => "auto",
        "width" =>	"100%",
        "attributes" => ["preload" => "auto" ,"autoplay" => "true" ,"loop" => "true", "fluid"=>"true"]

    ]); 

    

    $surtitre = $this->input("surtitre", ["width" => 400,'placeholder'=>'Surtitre']);

    $titre = $this->input("titre", ["width" => 400,'placeholder'=>'Titre']);
    $description = $this->textarea("description", ["width" => 400,"height" => 100,'placeholder'=>'"Description"',"htmlspecialchars"=>false]);

    $btn_title = $this->input("btn_title", ["width" => 400, "placeholder"=>"Titre du bouton"]);

    $link = $this->renderlet("link", array(
                                "types"=>array("object"),
                                "controller" => "content",
                                "action" => "link-eshop-renderlet",
                                "title" => "Glisser un doc, un produit, une categorie",
                                "editmode" => $this->editmode,
                                "previewmode" => $this->previewmode,
                                "btn_title" => $btn_title
                    )
    );
    

    if($this->editmode) {
    	echo '<div class="table-container">';
        echo '<div class="row"><div class="col-md-6">';
        echo $video;
         echo '</div><div class="col-md-6">';
        echo '<div class="container">'.$surtitre.'</div>';
        echo '<div class="container"><h3>'.$titre.'</h3></div>';

        echo '<div class="container">'.$description.'</div>';

        echo '<div class="container">'.$btn_title.'</div>'; 

        echo '<div class="container">'.$link.'</div>';
         echo '</div></div>';
         echo '</div>';

    }
    else {
    	echo '<div class="video-header-container clickable">';
    	echo '<div class="video-container">';
        echo $video;
     	echo '</div>';
        //echo '<div class="container">'.$surtitre.'</div>';
        echo '<div class="container-overlay"><div class="overlay-content">';
        echo '<h3>'.$titre.'</h3>';

        echo '<p>'.$description.'</p>';

        //echo '<div class="container">'.$btn_title.'</div>'; 

        //echo '<div class="container">'.$link.'</div>';
         echo '</div>';
         echo '</div>';
         echo $link; 
         echo '</div>';
    }


    ?>
</section>