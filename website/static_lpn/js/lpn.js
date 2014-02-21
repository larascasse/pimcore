$(document).ready(function() {
	
	$('.typeahead').typeahead([
  {
    limit: 10,
    valueKey: 'name',
    name: 'autocomplete_product',
    remote: '/ajax/autocompleteList/%QUERY',
    /*prefetch: '../data/films/post_1960.json',*/
    template: '<p class="title">{{name}}</p><p class="short">{{short}}</p>',
    engine: Hogan,

  }
]).on('typeahead:selected typeahead:autocompleted', function(e, datum) {
            console.log(datum.link);
            window.document.location = datum.link;
        });;





	});