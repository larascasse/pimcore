'use strict';
/* global instantsearch */

var search;


function loadSearch(indexName) {
  console.log("Load Search",indexName);
  if(typeof(search) != "undefined" && search.destroy) {
    search.destroy();
  }
  search = instantsearch({
    appId: 'GTGYOTP3CP',
    apiKey: '94a376c0accc342b43c077f29b4b0e7c',
    indexName: indexName,
    urlSync: true,
    //
    //searchFunction] A hook that will be called each time a search needs to be done, with the
     //helper as a parameter. It's your responsibility to call helper.search(). This option allows you to avoid doing
     //searches at page load for example.numberLocale
     //searchParameters] Additional parameters to pass to the Algolia API.
     //urlSync] Url synchronization configuration

     searchParameters: {
        /*hierarchicalFacetsRefinements: { // menu is implemented as a hierarchicalFacetsRefinements
          categories: ['Cell Phones']
        },
        */
        facetsRefinements: {
          //subtype: ['teinte'],
        },
       //filters: ['catalogue:"parquet" OR catalogue:"collections"','subtype="teinte"'],
       filters: 'subtype:"teinte"',
        // Add to "facets" all attributes for which you
        // do NOT have a widget defined
       //facets: ['catalogue','largeur_txt']

      },

  });
  addAllWidgets(search);
  search.start();
}



function addAllWidgets(search) {
  search.addWidget(
    instantsearch.widgets.searchBox({
      container: '#q',
      placeholder: 'Rechercher un produit'
    })
  );

  search.addWidget(
    instantsearch.widgets.stats({
      container: '#stats'
    })
  );

  search.on('render', function() {
    $('.product-picture img').addClass('transparent');
    $('.product-picture img').one('load', function() {
        $(this).removeClass('transparent');
    }).each(function() {
        if(this.complete) $(this).load();
    });
  });


  search.addWidget(
    instantsearch.widgets.hits({
      container: '#hits',
      hitsPerPage: 200,
      templates: {
        empty: noResultsTemplate,
        item: hitTemplate
      },
      transformData: function(hit) {
        /*hit.stars = [];
        for (var i = 1; i <= 5; ++i) {
          hit.stars.push(i <= hit.rating);
        }*/
        return hit;
      },
      //getConfiguration : Let the widget update the configuration of the search with new parameters
    })
  );

  search.addWidget(
    instantsearch.widgets.pagination({
      container: '#pagination',
      cssClasses: {
        active: 'active'
      },
      labels: {
        previous: '<i class="fa fa-angle-left fa-2x"></i> précedent',
        next: 'suivant <i class="fa fa-angle-right fa-2x"></i>'
      },
      showFirstLast: false
    })
  );

  /*search.addWidget(
    instantsearch.widgets.hierarchicalMenu({
      container: '#categories',
      attributes: ['categories.level0', 'categories.level1', 'categories.level2'],
      sortBy: ['name:asc'],
      templates: {
        item: menuTemplate
      }
    })
  );
  */
  search.addWidget(
    instantsearch.widgets.menu({
      container: '#categories',
      attributeName: 'categories.level0',
      sortBy: ['name:asc'],
      templates: {
        item: menuTemplate
      }
    })
  );


  search.addWidget(
    instantsearch.widgets.refinementList({
      container: '#subtype',
      attributeName: 'subtype',
      operator: 'or',
      limit: 20,
      showMore : true,
      templates: {
        item: facetTemplateCheckbox,
        header: '<div class="facet-title">Type</div>'
      }
    })
  );

  search.addWidget(
    instantsearch.widgets.refinementList({
      container: '#motif',
      attributeName: 'motif',
      operator: 'or',
      limit: 20,
      showMore : true,
      templates: {
        item: facetTemplateCheckbox,
        header: '<div class="facet-title">Type</div>'
      }
    })
  );

 /*search.addWidget(
    instantsearch.widgets.refinementList({
      container: '#colors',
      attributeName: 'color',
      operator: 'or',
      limit: 10,
      templates: {
        item: facetTemplateColors,
        header: '<div class="facet-title">Couleur</div>'
      }
    })
  );*/



  /*search.addWidget(
    instantsearch.widgets.toggle({
      container: '#stock',
      attributeName: 'in_stock',
      label : 'Qté en stock',
      templates: {
        item: facetTemplateCheckbox,
        header: '<div class="facet-title">Qté. stock</div>'
      }
    })
  );*/

  search.addWidget(
    instantsearch.widgets.currentRefinedValues({
      container: '#current-refined-values',
      // This widget can also contain a clear all link to remove all filters,
      // we disable it in this example since we use `clearAll` widget on its own.
      clearAll: false
    })
  );

  // initialize clearAll
  search.addWidget(
    instantsearch.widgets.clearAll({
      container: '#clear-all',
      templates: {
        link: 'Effacer'
      },
      autoHideContainer: true
    })
  );



  /*search.addWidget(
    instantsearch.widgets.starRating({
      container: '#rating',
      attributeName: 'rating',
      templates: {
        header: '<div class="facet-title">Ratings</div>'
      }
    })
  );*/

  /*search.addWidget(
    instantsearch.widgets.priceRanges({
      container: '#prices',
      attributeName: 'price.default',
      currency: '',
      cssClasses: {
        list: 'nav nav-list',
        count: 'badge pull-right',
        active: 'active'
      },
      templates: {
        header: '<div class="facet-title">Prix</div>',
        //item : ''
      }
    })
  );*/

 



    search.addWidget(
    instantsearch.widgets.refinementList({
      container: '#largeur',
      attributeName: 'largeur_txt',
      operator: 'or',
      limit: 20,
      showMore : true,
      templates: {
        item: facetTemplateCheckbox,
        header: '<div class="facet-title">Largeur</div>'
      }
    })
  );

  search.addWidget(
    instantsearch.widgets.refinementList({
      container: '#longueur',
      attributeName: 'longueur_txt',
      operator: 'or',
      limit: 20,
      showMore : true,
      templates: {
        item: facetTemplateCheckbox,
        header: '<div class="facet-title">Longueur</div>'
      }
    })
  );

  search.addWidget(
    instantsearch.widgets.refinementList({
      container: '#epaisseur',
      attributeName: 'epaisseur_txt',
      operator: 'or',
      limit: 20,
      showMore : true,
      templates: {
        item: facetTemplateCheckbox,
        header: '<div class="facet-title">Epaisseur</div>'
      }
    })
  );

  search.addWidget(
    instantsearch.widgets.refinementList({
      container: '#choix',
      attributeName: 'choix_txt',
      operator: 'and',
      limit: 20,
      showMore : true,
      sortBy : ['name:asc'],
      templates: {
        item: facetTemplateCheckbox,
        header: '<div class="facet-title">Choix</div>'
      }
    })
  );

  search.addWidget(
    instantsearch.widgets.refinementList({
      container: '#finition',
      attributeName: 'finition',
      operator: 'or',
      limit: 20,
      showMore : true,
      sortBy : ['name:asc'],
      templates: {
        item: facetTemplateCheckbox,
        header: '<div class="facet-title">Finition</div>'
      }
    })
  );

  search.addWidget(
    instantsearch.widgets.refinementList({
      container: '#traitement_surface',
      attributeName: 'traitement_surface',
      operator: 'or',
      limit: 20,
      showMore : true,
      templates: {
        item: facetTemplateCheckbox,
        header: '<div class="facet-title">Traitement surface</div>'
      }
    })
  );

  search.addWidget(
  instantsearch.widgets.toggle({
    container: '#stock',
    attributeName: 'in_stock',
    label: 'En stock',
    values: {
      on: 1,
      //off: 0
    },
    templates: {
        header: '<div class="facet-title">En stock</div>'
    }
  })
);



  /*search.addWidget(
    instantsearch.widgets.sortBySelector({
      container: '#sort-by-selector',
      indices: [
        {name: 'ikea', label: 'Featured'},
        {name: 'ikea_price_asc', label: 'Price asc.'},
        {name: 'ikea_price_desc', label: 'Price desc.'}
      ],
      label:'sort by'
    })
  );*/

 /* search.addWidget(
    instantsearch.widgets.clearAll({
      container: '#clear-all',
      templates: {
        link: '<i class="fa fa-eraser"></i> Effacer les filtres'
      },
      cssClasses: {
        root: 'btn btn-block btn-default'
      },
      autoHideContainer: true
    })
  );*/


}



var hitTemplate =
  '<article class="hit">' +
      '<div class="product-picture-wrapper">' +

        '<div class="product-picture"><a href="#" onclick="showGallery(\'{{sku}}\');return false;"><img src="{{image_url}}" /></a></div>' +
      '</div>' +
      '<div class="product-desc-wrapper">' +
     
       '<div class="product-type">{{{_highlightResult.subtype.value}}}</div>' +
        '<div class="product-name"><a href="{{url}}" target="_blank">{{{_highlightResult.name.value}}}</a></div>' +
        '<div class="product-type">{{sku}}</div>' +
        '<button type="button" class="btn btn-secondary" onclick="showStock(\'{{sku}}\');return false;">stock: {{stock_qty}} <span class="glyphicon glyphicon glyphicon-refresh" aria-hidden="true"></span></button>' +
       '<button type="button" class="btn btn-secondary" onclick="showGallery(\'{{sku}}\');return false;">photos <span class="glyphicon glyphicon glyphicon-picture" aria-hidden="true"></span></button>' +
        '<a href="http://pim.laparqueterienouvelle.fr/ean/{{sku}}" target="_blank">Voir plus</a>' +
        '<div class="product-price">{{price.default_formated}}</div>' +
        //'<div class="product-rating">{{#stars}}<span class="ais-star-rating--star{{^.}}__empty{{/.}}"></span>{{/stars}}</div>' +
      '</div>' +
  '</article>';

var noResultsTemplate =
  '<div class="text-center">Aucun résultat sur la recherche <strong>{{query}}</strong>.</div>';

var menuTemplate =
  '<a href="javascript:void(0);" class="facet-item {{#isRefined}}active{{/isRefined}}"><span class="facet-name"><i class="fa fa-angle-right"></i> {{name}}</span class="facet-name"></a>';

var facetTemplateCheckbox =
  '<a href="javascript:void(0);" class="facet-item">' +
    '<input type="checkbox" class="{{cssClasses.checkbox}}" value="{{name}}" {{#isRefined}}checked{{/isRefined}} />{{label}}' +
    '<span class="facet-count">({{count}})</span>' +
  '</a>';

var facetTemplateColors =
  '<a href="javascript:void(0);" data-facet-value="{{name}}" class="facet-color {{#isRefined}}checked{{/isRefined}}"></a>';


loadSearch('magentolocal_lpn_storeview_fr_products');

