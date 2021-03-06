<?php

$colors=[
    "#F6F5F2",
    "#F3F4EF",
    "#FCEFE9",
    "#8C8782",
    "#E4E4D2",
    "#E8F3F3",
    "#D1DFE0",

    "#DAD7CB",
    "#D0D5C1",
    "#F2BFA9",
    "#8C8782",
    "#93924B",
    "#A4CFCE",
    "#487E85",

    "#48B7C9",
    "#505050",
    "#7994A5",
    "#3C6297",
    "#065446",
    "#027683",
    "#DD5639",

];
$color = $this->input("color",["placeholder"=>"Couleur de fond ?","htmlspecialchars"=>false]);

if($this->editmode) {  ?>

<div class="row">
<?php
$i==0;
foreach ($colors as $color2) {
    ?>
    <div class="col" style="height: 25px; display: block; background-color: <?php echo $color2?>;font-size:8px">
    <?php echo $color2 ?>
    </div>
   
   <?php
   if($i==(count($colors)-1))
        echo "</div>";
   else if(($i%7)==6) {
         echo "</div>";
         echo '<div class="row">';
   }
   

   $i++;
}

    echo $color."<br />";
}




$count = $this->block("contentblock")->getCount();

$main_titre         = $this->input("main_titre", ["width" => 800,'placeholder'=>'Titre']);
$main_description   = $this->textarea("main_description", ["width" => 400,"height" => 100,'placeholder'=>'Description',"htmlspecialchars"=>false]);


 if(!$this->editmode) {
    $defaultGridMode = $this->select("grid-mode")->getData();
    
    if(!$defaultGridMode) {
        $defaultGridMode = 'grid-destructuree';
}




$style = strlen($color->getData())>0 ? 'style="background-color:'.$color->getData().'"':'';
$gridClass = strlen($color->getData())>0 ? 'grid-bkg-full':'grid-bkg-full grid-bkg-full___nocolor';
?>
<!-- V4 pas de container main, c'est dans le table-congtainer-->

<div class="<?php echo $gridClass ?>" <?php echo $style ?>>
<div class="table-container">
<div class="<?php echo $defaultGridMode?> <?php echo 'grid-destructuree-'.$count?>">

<?php } 
else {
    echo "<div>";
    echo "<div>";
    echo "<div>";


    echo $this->select("grid-mode", [
            "width" => 300,
            "reload" => false,
            "store" => [
                ['grid-destructuree',"Normal (grand à gauche)"],
                ['grid-destructuree grid-inverse','Inverse'],
                ['grid-destructuree grid-vertical','Vertical'],
                ['grid-destructuree grid-vertical grid-inverse','Vertical Inverse'],
                ['grid-classique','Grille classique']
                ]
        ]);

   


    echo '<h2>'.$main_titre .'</h2>';
    echo $main_description;

    
}

 $isInverse = strpos($defaultGridMode,'grid-inverse')>0;
 $isVertical = strpos($defaultGridMode,'grid-vertical')>0 || $count==3;
 $isGrilleClassique = strpos($defaultGridMode,'classique') > 0;
 


$sameSizeCount=1;
$isDoubleSize=true;

$simple=false;

if(!$this->editmode && $main_titre && $main_description) {
    $hasText = strlen(trim($main_titre))>0 && strlen(trim($main_description))>0;
    $blocText = '<div class="table-bloc-thumb grid-bloc-text"><h2>'.$main_titre.'</h2><p>'.$main_description.'</p></div>';
}
else {
    $hasText =false;
    $blocText = "";
}


$blocClassOffseted = 'table-bloc-thumb-small';

while($this->block("contentblock")->loop()) { 
    
   

    $i = $this->block("contentblock")->getCurrent();

     //Algo pour avoir 2 fois de suite la meme taille
   

    $pimcoreThimbClass = "magento_equigrid_h";

    //Type avec A vertival, 2 H, 2V...
    if($simple) {
        if($isDoubleSize) {
            $pimcoreThimbClass = "magento_equigrid_v";
        }

        //Pourle prochain
        if($sameSizeCount==1 && $isDoubleSize) {
            $sameSizeCount = 0;
            $isDoubleSize = false;
        }
        else if($sameSizeCount==1 && !$isDoubleSize) {
            $sameSizeCount = 0;
            $isDoubleSize = true;
        }
        else {
            $sameSizeCount++;
        }
    }
    else if($isGrilleClassique) {
        $colClass="";
        $blocClass = "notroll";
         switch ($count) {
             case 1:
             case 3:
             case 5:
             case 7:
             case 9:
                if($i%3 == 0)
                    $pimcoreThimbClass = "magento_equigrid_h";
                else
                    $pimcoreThimbClass = "magento_equigrid_v";
                break;
            default:
                $pimcoreThimbClass = "magento_equigrid_v";

        }
    }
    else {
        $colClass="";
        $blocClass = "";

        switch ($count) {
            case 1:
                $pimcoreThimbClass = "magento_h_half";
                break;

            case 2:
                $pimcoreThimbClass = "magento_equigrid_h";

                switch ($i) {
                    case 0:
                        if($hasText) 
                            $pimcoreThimbClass = $isInverse?"magento_gritext_v":"magento_gridtext_h";
                            $blocClass = $isInverse? $blocClassOffseted : $blocClassOffseted;
                        break;
                    case 1:
                        if($hasText) 
                            $pimcoreThimbClass = $isInverse?"magento_gridtext_h":"magento_gritext_v";
                            $blocClass = $isInverse?"": "";
                        
                        break;

                }

                break;

            case 3:
                switch ($i) {
                    case 0:
                        $pimcoreThimbClass = $isInverse ?"magento_h_half":"magento_equigrid_v";
                        
                        if($hasText) {
                            $pimcoreThimbClass = "magento_gritext_v";
                            $blocClass = $isInverse?$blocClassOffseted : $blocClassOffseted;
                        }
                        break;
                   
                    case 1:
                        $pimcoreThimbClass = "magento_h_half";

                        $blocClass = $isInverse ? $blocClassOffseted:"";

                        if($hasText) {
                            $pimcoreThimbClass = $isInverse?"magento_gridtext_h":"magento_gritext_v";
                            $blocClass = $isInverse? "" : $blocClassOffseted;
                        }

                        break;
                    case 2:
                        $pimcoreThimbClass = $isInverse?"magento_equigrid_v":"magento_h_half";

                        $blocClass = !$isInverse ? $blocClassOffseted:"";

                        if($hasText) {
                            $pimcoreThimbClass = $isInverse?"magento_gritext_v":"magento_gridtext_h";
                            $blocClass = "";
                        }

                        break;
                    
                    default:
                        # code...
                        break;
                }
                break;

            case 4:
                switch ($i) {
                    case 0:
                         $pimcoreThimbClass = ($isVertical && !$isInverse) ?"magento_equigrid_v":"magento_h_half";

                        if($hasText) {
                            $pimcoreThimbClass = $isInverse?"magento_gritext_v":"magento_gridtext_h";
                            $blocClass = $isInverse?$blocClassOffseted : "";
                        }

                        break;
                    
                    case 1:
                        $pimcoreThimbClass = ($isVertical && $isInverse) ?"magento_gritext_v":"magento_h_half";
                        $blocClass = ($isVertical && !$isInverse) ? $blocClassOffseted:"";

                        if($hasText) {
                            $pimcoreThimbClass = $isInverse?"magento_gridtext_h":"magento_gritext_v";
                            $blocClass = $isInverse?"" : $blocClassOffseted;
                        }

                        break;
                    
                    case 2:
                        $pimcoreThimbClass = ($isVertical && $isInverse) ?"magento_equigrid_v":"magento_h_half";

                        if($hasText) {
                            $pimcoreThimbClass = $isInverse?"magento_gridtext_h":"magento_gritext_v";
                            $blocClass = $isInverse?"" : $blocClassOffseted;
                           
                        }

                        break;

                    
                    case 3:
                        $pimcoreThimbClass = ($isVertical && !$isInverse) ?"magento_equigrid_v":"magento_h_half";

                        $blocClass = ($isVertical && !$isInverse) ? $blocClassOffseted:"";

                        if($hasText) {
                            $pimcoreThimbClass = $isInverse?"magento_gritext_v":"magento_gridtext_h";
                             $blocClass = $isInverse?$blocClassOffseted : "";
                            
                        }
                        
                        break;
                    
                    default:
                        # code...
                        break;
                }
                break;

                
            

            default:
                # code...
                break;
        }
    }
    



    $image = $this->image("image",array(
                "thumbnail" => $this->editmode?"":$pimcoreThimbClass,
                "class" => $this->editmode?"":"img-fluid",
                'placeholder'=>'Image'
                
            )
            );

    $surtitre = $this->input("surtitre", ["width" => 400,'placeholder'=>'Surtitre']);

    $titre = $this->input("titre", ["width" => 400,'placeholder'=>'Titre']);
    $description = $this->textarea("description", ["width" => 400,"height" => 100,'placeholder'=>'Description',"htmlspecialchars"=>false]);

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

    $html = $this->textarea("html", ["width" => 400,"height" => 100,'placeholder'=>'BLock HTML',"htmlspecialchars"=>false]);



    if($this->editmode) {
        echo '<div class="row"><div class="col-md-6">';
        echo '<div class="container" style="width:300px">'.$image.'</div>';
         echo '</div><div class="col-md-6">';
        echo '<div class="container">'.$surtitre.'</div>';
        echo '<div class="container"><h3>'.$titre.'</h3></div>';

        echo '<div class="container">'.$description.'</div>';

        echo '<div class="container">'.$btn_title.'</div>'; 

        echo '<div class="container">'.$link.'</div>';

        echo '<div class="container">'.$html.'</div>';

         echo '</div></div><hr />';
    }
    else {
    
    $colFirst = "";
    if(
        $i==0
        || ($i==1 && !$isInverse && $isVertical)
        || ($i==2 && $count==3 && $isInverse && $isVertical)
        || ($i==2 && $count==4)

        )
    $colFirst = " col-first";
    ?>

    <?php
        if($i==0) {
            echo '<div class="grid-col">';
            if($hasText && !$isInverse) {
                echo $blocText;
            }
        }


        
        ?>
         <!--  item -->
        <div class="table-bloc-thumb<?php echo $colFirst ?> <?php echo $blocClass ?>">
           
            <div class="rollbloc">
                <?php   
                echo $image;
                $htmlStr = trim($html->getData());
                if(strlen($htmlStr)>10) {
                    echo $htmlStr;
                }
                else {
                ?>

                    <div class="table-bloc-thumb-text">
                    
                        <p><?= $surtitre; ?></p>
                        <h2><?= $titre; ?></h2>
                        
                        <div class="rollbloc_txt_over">
                            <div class="rollbloc_txt_over_cnt">
                                <div class="rollbloc_txt"><?= $description; ?></div>    
                            </div>
                        </div>
                        <?php  echo $link; ?>
                    </div>
            
                <?php
                }
                ?>
            </div>
             
        </div>    
        <!-- fin item -->   



    <?php 
            //On fini la grille
            if($i== ($count-1)) {
                echo "</div>";
                
            }
            else if (
                //A près le 1er
                ($i==0 && $count==2)
                || ($i==0 && ($count==3 || $count==7 || $count==11) && $isVertical && !$isInverse)
                //A près le 12e
                || ($i==1 && ($count==3 || $count==7 || $count==11) && $isVertical && $isInverse)
                || ($i==1 && ($count==3 || $count==7 || $count==11) && !$isVertical)
                || ($i==1 && ($count==4 || $count==5 || $count==8 || $count==12))
            ) {
                echo "</div>";
                echo '<div class="grid-col">';

                if($hasText && $isInverse) {
                    echo $blocText;
                }
            }
       
            $i++;
        } ?>
<?php } ?>
<!-- Fin Loop  -->
<!--<div class="grid-bkg"></div>-->
</div>
</div>
</div>
