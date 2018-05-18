 <div class="container-fluid">
    <header class="content-wrapper">
    
      <a href="./" class="logo">La Parqueterie Nouvelle</a>
      <div class="input-group">
        <input type="text" class="form-control" id="q" />
        <span class="input-group-btn">
          <button class="btn btn-default"><i class="fa fa-search"></i></button>
        </span>
        <div class="selector">
        <select id="index_selector" onchange="changeIndex();">
          <option value="magentoprod_terrasses_storeview_fr_products">Terrasses</option>
          <option value="magentoprod_matieres_fr_products">Matères</option>
          <option value="magentoprod_tables_storeview_fr_products">Tables</option>
          <option value="magentoprod_sol_stratifie_vinyle_lvt_fr_products">Vinyle / Strat</option>
        </select>
        </div>
      </div>
    </header>


    <div class="content-wrapper">

      <aside>

<section class="facet-wrapper">
         <div class="facet-category-title" class="facet">Résultats pour</div>

        <div id="current-refined-values">
         
  <!-- CurrentRefinedValues widget will appear here -->
      </div>
  <div id="clear-all"></div>

</section>
        <section class="facet-wrapper">
          <div class="facet-category-title" class="facet">Catégories</div>
          <div id="categories"></div>
        </section>
        <section class="facet-wrapper">
          <div class="facet-category-title">Filtrer par</div>
          

          <div id="choix" class="facet"></div>
          <div id="finition" class="facet"></div>
          <div id="traitement_surface" class="facet"></div>

          <div id="subtype" class="facet"></div>
          <div id="colors" class="facet"></div>
          <div id="longueur" class="facet"></div>
          <div id="largeur" class="facet"></div>
          <div id="epaisseur" class="facet"></div>
          <div id="stock" class="facet"></div>
          
          
          
          <div id="rating" class="facet"></div>
          <div id="prices" class="facet"></div>
        </section>
      
      </aside>

      <div class="results-wrapper">
        <section id="results-topbar">
          <div class="sort-by">
            <label>Trier par</label>
            <div id="sort-by-selector"></div>
          </div>
          <div id="stats" class="text-muted"></div>
        </section>
        <main id="hits"></main>
        <section id="pagination"></section>
      </div>

    </div>
  </div>


<!-- The Gallery as lightbox dialog, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>


<script>

function changeIndex() {
  var indexName = jQuery('#index_selector').val();
  console.log("chandeIndex",search,indexName);
  if(search) {
    loadSearch(indexName);

  }
}
function showGallery(ean) {
  loader.begin();
  jQuery.ajax({
            url: '/ajax/jsonProductImagesByEan/'+ean,
            dataType: 'json',
            type : 'get',
            success: function(data, textStatus, jqXHR){
              loader.stop();
              //console.log(data);
              var images=new Array();
              for (var i=0; i<data.length;i++) {
                group = data[i];
                console.log(group);
               
                 for (var j=0; j<group.images.length;j++) {
                     images.push({
                      href:group.images[j],
                      thumbnail:group.thumb[j],
                      title:group.name
                    });
                   
                 }
              }
              
              console.log(images)
              var options = {
      //container: '#blueimp-image-carousel',
      //carousel: true
    }

              blueimp.Gallery(images,options);
              

            }
          }
        );
}

function showStock(ean) {
  loader.begin();
  jQuery.ajax({
            url: '/ajax/jsonProductStockByEan/'+ean,
            dataType: 'json',
            type : 'get',
            success: function(data, textStatus, jqXHR){
              loader.stop();
              //console.log(data);
              var str = new Array();
               if(data.dispo) {
                str.push('** En stock '+data.total_dispo+'**');
              }
              else {
                str.push("** Sur commande");
              }
              str.push('');
              str.push( "Carrières: "+(data.data['LPN78420']?data.data['LPN78420']:'0'));
              str.push( "Paris: "+(data.data['LPN75']?data.data['LPN75']:'0'));
              str.push( "Chambourcy: "+(data.data['LPN78240']?data.data['LPN78240']:'0'));
              str.push('');
              str.push( "Commande Carrières: "+(data.data['CDELPN7824']?data.data['CDELPN7824']:'0'));
              str.push( "Commande Paris: "+(data.data['CDELPN75']?data.data['CDELPN75']:'0'));
              str.push( "Commande Chambourcy: "+(data.data['CDELPN7842']?data.data['CDELPN75']:'0'));
             
              
              alert(str.join('\n'));
              
              

            }
          }
        );
}
</script>