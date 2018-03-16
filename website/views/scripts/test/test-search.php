
<style>
.dropdown {
	display: inline-block;
}
.dropdown .btn-secondary {
	border-color: #FFFFFF;
	color : #AAAAAA;
	font-size: 1.2em;	

}
.btn-secondary.filled {
	color : #000000;
}
.btn-secondary::after___ {
	color : #000000;
}
.dropdown {
}
</style>

<script>
	$(document).ready(function() {
	window.log("INIT");
  //loadMagentoClient();
  $('.dropdown').on('hide.bs.dropdown', function (e) {
  // do something…
  console.log(e);
  //$(e.relatedTarget).html('TOTO')
})

  $(".dropdown-menu").on('click', 'a', function(){
  	var link = $(this);
  	var btn = link.parent().parent().find('.btn');
  	var btnId = btn.attr('id');
     btn.html(link.html()).addClass('filled');
     var str = link.data('desc');
     $('.view-inline .'+btnId).html(str);
     $('.view-list .'+btnId).html('<li><input type="checkbox" checked /> '+str+"</li>");
   });

  $(".level-1 .btn").on('click', function(){
  	var btn = $(this);
  	$(".level-1 .btn").removeClass('active');
  	$(this).addClass('active');
  
  	$(".level-0").fadeIn();
  	$(".level-0-title").html(btn.html().toLowerCase());
  	//$(".level-2").fadeIn();

  }
  );

  $(".plus").on('click', function(){
  	var btn = $(this);
  
  	$(".level-2").fadeIn();
  	//$(".level-2").fadeIn();

  }
  );

  
});

</script>

</div>
<div class="container-fluid">


<div class="level-1">

<div class="row justify-content-center mt-2">
<!--<button type="button" class="btn btn-outline-info m-2">Chêne</button>
<button type="button" class="btn btn-outline-info m-2">Bambou</button>
-->
<button type="button" class="btn btn-outline-success m-2">Brut</button>

<button type="button" class="btn btn-outline-success m-2">Huilé</button>
<button type="button" class="btn btn-outline-success m-2">Vernis / Vitrifé</button>



<button type="button" class="btn btn-outline-warning m-2">Naturel</button>
<button type="button" class="btn btn-outline-warning m-2">Gris</button>
<button type="button" class="btn btn-outline-warning m-2">Foncé</button>
<button type="button" class="btn btn-outline-warning m-2">Clair</button>

<button type="button" class="btn btn-outline-primary m-2">Vieilli</button>

<button type="button" class="btn btn-outline-warning m-2">Point de hongrie/Chevrons</button>

</div>
<div class="row justify-content-center mt-2">
	<button type="button" class="btn btn-outline-danger m-2">Massif</button>
	<button type="button" class="btn btn-outline-danger m-2">Contrecollé</button>
	<button type="button" class="btn btn-outline-danger m-2">Lame large</button>
</div>
<div class="row justify-content-center mt-2">
<button type="button" class="btn btn-secondary m-2">100% France</button>
<button type="button" class="btn btn-secondary m-2">Compatible sols chauffants</button>
<button type="button" class="btn btn-secondary m-2">Promotions</button>
<button type="button" class="btn btn-secondary m-2">Premiers prix</button>
<button type="button" class="btn btn-secondary m-2">En stock</button>
<button type="button" class="btn btn-secondary m-2">Pose flottante</button>
</div>
<div class="row justify-content-center mt-2">
<button type="button" class="btn btn-primary m-2">Tous les autres parquets</button>
</div>

</div>


<div class="level-0 container" style="display: none">
	<div class=" mt-4 mb-4">

	<h2>Parquet <span class="level-0-title"></span></h2>
	<p><a href="#" class="plus">Voir plus de filtres</a></p>
	</div>
</div>

<div class="level-2" style="display: none">


<hr />

<div class="row justify-content-center">
<div class="">

<div class="dropdown">
<button class="btn btn-secondary filled">Parquet</button>
</div>




<div class="dropdown" id="essence-menu">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="essence" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   Essence
  </button>
  <div class="dropdown-menu" aria-labelledby="essence">
	<a class="dropdown-item" href="#chene" data-desc=" en chêne">Chêne</a>
	<a class="dropdown-item" href="#" data-desc=" en frêne">Frêne</a>
  </div>
</div>


<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="choix" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Choix
  </button>
  <div class="dropdown-menu" aria-labelledby="choix">
	<a class="dropdown-item" href="#" data-desc=" avec peu de noeuds">Peu ou pas noeuds</a>
	<a class="dropdown-item" href="#" data-desc=" avec des noeuds pour un aspect authentique">Avec des nooeuds</a>
  </div>
</div>


<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="surface" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Surface
  </button>
  <div class="dropdown-menu" aria-labelledby="surface">
	<a class="dropdown-item" href="#">Contemporaine</a>
	<a class="dropdown-item" href="#" data-desc=" brossé">Brossé</a>
	<a class="dropdown-item" href="#" data-desc=" vielli">Vieilli</a>
	<a class="dropdown-item" href="#" data-desc=" usé brossé">Usé brossé</a>
	<a class="dropdown-item" href="#" data-desc=" très vielli">Très vielli</a>
  </div>
</div>



<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="teinte" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Teinte
  </button>
  <div class="dropdown-menu" aria-labelledby="teinte">
	<a class="dropdown-item" href="#" data-desc="brut">Brut</a>
	<a class="dropdown-item" href="#" data-desc="">Teinté</a>
	<a class="dropdown-item" href="#" data-desc=", à teinte réactive">Teinte réactive</a>
	<a class="dropdown-item" href="#">Peint</a>
  </div>
</div>


<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="color" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Couleur
  </button>
  <div class="dropdown-menu" aria-labelledby="color">
	<a class="dropdown-item" href="#" data-desc=", d'aspect bois brut">Bois brut</a>
	<a class="dropdown-item" href="#" data-desc=", brun d'aspect naturel">Brun</a>
	<a class="dropdown-item" href="#" data-desc=", plutôt gris">Gris</a>
	<a class="dropdown-item" href="#"  data-desc=", plutôt clair">Clair</a>
	<a class="dropdown-item" href="#" data-desc=", plutôt foncé">Foncé</a>
  </div>
</div>


<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="finition" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Finition  </button>
  <div class="dropdown-menu" aria-labelledby="finition">
	<a class="dropdown-item" href="#">Brut</a>
	<a class="dropdown-item" href="#" data-desc=", huilé, avec un entretien régulier">Huilé</a>
	<a class="dropdown-item" href="#" data-desc=", huile cire, pour garder une patine">Huile Cire</a>
	<a class="dropdown-item" href="#" data-desc=", vernis, avec peu d'entretien">Vernis</a>
  </div>
</div>

</div>

</div>

<div class="row justify-content-center mt-2">

<div class="">
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="structure" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Structure  </button>
  <div class="dropdown-menu" aria-labelledby="structure">

	<a class="dropdown-item" href="#" data-desc="massif">Massif</a>
	<a class="dropdown-item" href="#"  data-desc="contrecollé">Contrecollé</a>
  </div>
</div>


<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="epaisseur" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Epaisseur
  </button>
  <div class="dropdown-menu" aria-labelledby="epaisseur">
	<a class="dropdown-item" href="#" data-desc=", fin, idéal pour de la rénovation">fin</a>
	<a class="dropdown-item" href="#" data-desc=", d'épaisseur standard">14/15mm</a>
	<a class="dropdown-item" href="#"  data-desc=", épais, ponçable plusieurs fois">>15 mm</a>
  </div>
</div>



<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="largeur" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
 Largeur
  </button>
  <div class="dropdown-menu" aria-labelledby="largeur">
	<a class="dropdown-item" href="#" data-desc=", à lames étroites">étroite</a>
	<a class="dropdown-item" href="#" data-desc=", à lames larges pour donner une impression d'espace">large</a>
	<a class="dropdown-item" href="#" data-desc=", à lames très larges, pour de trèèèeeees grandes pièces">très large</a>
  </div>
</div>

</div>
<div class="col-2">
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="longueur" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   Longueur
  </button>
  <div class="dropdown-menu" aria-labelledby="longueur">
	<a class="dropdown-item" href="#" data-desc=", à lames courtes">courte</a>
	<a class="dropdown-item" href="#" data-desc=", à lames longues">longues</a>
	<a class="dropdown-item" href="#" data-desc=", à lames très longueus">très longues</a>
  </div>
</div>
</div>

</div>

<div class="row justify-content-center mt-2">
<button type="button" class="btn btn-outline-secondary m-2">100% France</button>
<button type="button" class="btn btn-outline-secondary m-2">Compatible sols chauffants</button>
<button type="button" class="btn btn-outline-secondary m-2">Promotions</button>
<button type="button" class="btn btn-outline-secondary m-2">Premiers prix</button>
<button type="button" class="btn btn-outline-secondary m-2">En stock</button>
<button type="button" class="btn btn-outline-secondary m-2">Pose flottante</button>
</div>

<br /><br /><br />
<div class="view-inline">
		<h2>
Je voudrais un parquet 
<span class="essence"></span>
<span class="structure"></span>
<span class="choix"></span>
<span class="surface"></span>
<span class="teinte"></span>
<span class="color"></span>
<span class="finition"></span>
<span class="epaisseur"></span>
<span class="largeur"></span>
<span class="longueur"></span>
</h2>
</div>

<br /><br /><br />
<div class="view-list">

Je voudrais un parquet 
<span class="essence"></span>
<span class="structure"></span>
<span class="choix"></span>
<span class="surface"></span>
<span class="teinte"></span>
<span class="color"></span>
<span class="finition"></span>
<span class="epaisseur"></span>
<span class="largeur"></span>
<span class="longueur"></span>
</div>



</div>


