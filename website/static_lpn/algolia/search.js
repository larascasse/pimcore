'use strict';
/* global instantsearch */

var search = instantsearch({
  appId: 'R7ZI25KI5A',
  apiKey: '4d94d16a91186890589b12392cf37a3b',
  indexName: 'magentoprod_matieres_fr_products'
  //
  //searchFunction] A hook that will be called each time a search needs to be done, with the
   //helper as a parameter. It's your responsibility to call helper.search(). This option allows you to avoid doing
   //searches at page load for example.numberLocale
   //searchParameters] Additional parameters to pass to the Algolia API.
   //urlSync] Url synchronization configuration
});

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

var hitTemplate =
  '<article class="hit">' +
      '<div class="product-picture-wrapper">' +

        '<div class="product-picture"><a href="#" onclick="showGallery(\'{{sku}}\');return false;"><img src="http://eshop.laparqueterienouvelle.fr/media/{{image_url}}" /></a></div>' +
      '</div>' +
      '<div class="product-desc-wrapper">' +
     
       '<div class="product-type">{{{_highlightResult.subtype.value}}}</div>' +
        '<div class="product-name"><a href="{{url}}" target="_blank">{{{_highlightResult.short_name.value}}}{{short_name}}</a></div>' +
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
    '<input type="checkbox" class="{{cssClasses.checkbox}}" value="{{name}}" {{#isRefined}}checked{{/isRefined}} />{{name}}' +
    '<span class="facet-count">({{count}})</span>' +
  '</a>';

var facetTemplateColors =
  '<a href="javascript:void(0);" data-facet-value="{{name}}" class="facet-color {{#isRefined}}checked{{/isRefined}}"></a>';

search.addWidget(
  instantsearch.widgets.hits({
    container: '#hits',
    hitsPerPage: 16,
    templates: {
      empty: noResultsTemplate,
      item: hitTemplate
    },
    transformData: function(hit) {
      hit.stars = [];
      for (var i = 1; i <= 5; ++i) {
        hit.stars.push(i <= hit.rating);
      }
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
    container: '#materials',
    attributeName: 'subtype',
    operator: 'or',
    limit: 10,
    templates: {
      item: facetTemplateCheckbox,
      header: '<div class="facet-title">Type</div class="facet-title">'
    }
  })
);

search.addWidget(
  instantsearch.widgets.refinementList({
    container: '#colors',
    attributeName: 'color',
    operator: 'or',
    limit: 10,
    templates: {
      item: facetTemplateColors,
      header: '<div class="facet-title">Couleur</div class="facet-title">'
    }
  })
);

search.addWidget(
  instantsearch.widgets.refinementList({
    container: '#stock',
    attributeName: 'stock_qty',
    label : 'Qté en stock',
    templates: {
      item: facetTemplateCheckbox,
      header: '<div class="facet-title">Qté. stock</div class="facet-title">'
    }
  })
);


/*search.addWidget(
  instantsearch.widgets.starRating({
    container: '#rating',
    attributeName: 'rating',
    templates: {
      header: '<div class="facet-title">Ratings</div class="facet-title">'
    }
  })
);*/

search.addWidget(
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
      header: '<div class="facet-title">Prix</div class="facet-title">',
      //item : ''
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

search.addWidget(
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
);

search.start();
