$(document).ready(function() {
    console.log("DOCU READY",$('.typeahead').typeahead,Bloodhound);
    if(jQuery('#carte').height() > 1) {
        affichePlan(jQuery('#carte').data( 'showroom' ));
    }


var products = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  limit: 30,
  //prefetch: '../data/films/post_1960.json',
   remote: {
    url: '/ajax/autocompleteList/%QUERY',
        wildcard: '%QUERY'
      }
});


$('.typeahead').typeahead(
   null
, {
  name: 'best-pictures',
 display: 'name',
 templates: {
        suggestion: function(data) { // data is an object as returned by suggestion engine
            return '<div class="tt-suggest-page"><p class="title">' + data.name + '</p><p class="short">'+data.short+'</p></div>';
        }
    },
    limit: 30,
  source: products
  
}).on('typeahead:selected typeahead:autocompleted', function(e, datum) {
            console.log(datum.link);
            window.document.location = datum.link;
        });


//var compiledTemplate = Hogan.compile('<p class="title">{{name}}</p><p class="short">{{short}}</p>');
	
	$('.typeahead___').typeahead(

        {
            highlight : true,

        }
        ,
  {
    limit: 10,
    valueKey: 'name',
    name: 'autocomplete_product',
    //remote: '/ajax/autocompleteList/%QUERY',
     source : products,
    templates: {
        suggestion: function(data) { // data is an object as returned by suggestion engine
            return '<div class="tt-suggest-page">' + data.value + '</div>';
        }
    }
    //template: '<p class="title">{{name}}</p><p class="short">{{short}}</p>',
    //engine: Hogan,

  }
).on('typeahead:selected typeahead:autocompleted', function(e, datum) {
            console.log(datum.link);
            window.document.location = datum.link;
        });;

    



});


//INFOBOX
/**
 * @name InfoBox
 * @version 1.1.11 [January 9, 2012]
 * @author Gary Little (inspired by proof-of-concept code from Pamela Fox of Google)
 * @copyright Copyright 2010 Gary Little [gary at luxcentral.com]
 * @fileoverview InfoBox extends the Google Maps JavaScript API V3 <tt>OverlayView</tt> class.
 *  <p>
 *  An InfoBox behaves like a <tt>google.maps.InfoWindow</tt>, but it supports several
 *  additional properties for advanced styling. An InfoBox can also be used as a map label.
 *  <p>
 *  An InfoBox also fires the same events as a <tt>google.maps.InfoWindow</tt>.
 */

function InfoBox(e){e=e||{};google.maps.OverlayView.apply(this,arguments);this.content_=e.content||"";this.disableAutoPan_=e.disableAutoPan||false;this.maxWidth_=e.maxWidth||0;this.pixelOffset_=e.pixelOffset||new google.maps.Size(0,0);this.position_=e.position||new google.maps.LatLng(0,0);this.zIndex_=e.zIndex||null;this.boxClass_=e.boxClass||"infoBox";this.boxStyle_=e.boxStyle||{};this.closeBoxMargin_=e.closeBoxMargin||"2px";this.closeBoxURL_=e.closeBoxURL||"http://www.google.com/intl/en_us/mapfiles/close.gif";if(e.closeBoxURL===""){this.closeBoxURL_=""}this.infoBoxClearance_=e.infoBoxClearance||new google.maps.Size(1,1);this.isHidden_=e.isHidden||false;this.alignBottom_=e.alignBottom||false;this.pane_=e.pane||"floatPane";this.enableEventPropagation_=e.enableEventPropagation||false;this.div_=null;this.closeListener_=null;this.moveListener_=null;this.contextListener_=null;this.eventListeners_=null;this.fixedWidthSet_=null}InfoBox.prototype=new google.maps.OverlayView;InfoBox.prototype.createInfoBoxDiv_=function(){var e;var t;var n;var r=this;var i=function(e){e.cancelBubble=true;if(e.stopPropagation){e.stopPropagation()}};var s=function(e){e.returnValue=false;if(e.preventDefault){e.preventDefault()}if(!r.enableEventPropagation_){i(e)}};if(!this.div_){this.div_=document.createElement("div");this.setBoxStyle_();if(typeof this.content_.nodeType==="undefined"){this.div_.innerHTML=this.getCloseBoxImg_()+this.content_}else{this.div_.innerHTML=this.getCloseBoxImg_();this.div_.appendChild(this.content_)}this.getPanes()[this.pane_].appendChild(this.div_);this.addClickHandler_();if(this.div_.style.width){this.fixedWidthSet_=true}else{if(this.maxWidth_!==0&&this.div_.offsetWidth>this.maxWidth_){this.div_.style.width=this.maxWidth_;this.div_.style.overflow="auto";this.fixedWidthSet_=true}else{n=this.getBoxWidths_();this.div_.style.width=this.div_.offsetWidth-n.left-n.right+"px";this.fixedWidthSet_=false}}this.panBox_(this.disableAutoPan_);if(!this.enableEventPropagation_){this.eventListeners_=[];t=["mousedown","mouseover","mouseout","mouseup","click","dblclick","touchstart","touchend","touchmove"];for(e=0;e<t.length;e++){this.eventListeners_.push(google.maps.event.addDomListener(this.div_,t[e],i))}this.eventListeners_.push(google.maps.event.addDomListener(this.div_,"mouseover",function(e){this.style.cursor="default"}))}this.contextListener_=google.maps.event.addDomListener(this.div_,"contextmenu",s);google.maps.event.trigger(this,"domready")}};InfoBox.prototype.getCloseBoxImg_=function(){var e="";if(this.closeBoxURL_!==""){e="<img";e+=" src='"+this.closeBoxURL_+"'";e+=" align=right";e+=" style='";e+=" position: relative;";e+=" cursor: pointer;";e+=" margin: "+this.closeBoxMargin_+";";e+="'>"}return e};InfoBox.prototype.addClickHandler_=function(){var e;if(this.closeBoxURL_!==""){e=this.div_.firstChild;this.closeListener_=google.maps.event.addDomListener(e,"click",this.getCloseClickHandler_())}else{this.closeListener_=null}};InfoBox.prototype.getCloseClickHandler_=function(){var e=this;return function(t){t.cancelBubble=true;if(t.stopPropagation){t.stopPropagation()}google.maps.event.trigger(e,"closeclick");e.close()}};InfoBox.prototype.panBox_=function(e){var t;var n;var r=0,i=0;if(!e){t=this.getMap();if(t instanceof google.maps.Map){if(!t.getBounds().contains(this.position_)){t.setCenter(this.position_)}n=t.getBounds();var s=t.getDiv();var o=s.offsetWidth;var u=s.offsetHeight;var a=this.pixelOffset_.width;var f=this.pixelOffset_.height;var l=this.div_.offsetWidth;var c=this.div_.offsetHeight;var h=this.infoBoxClearance_.width;var p=this.infoBoxClearance_.height;var d=this.getProjection().fromLatLngToContainerPixel(this.position_);if(d.x<-a+h){r=d.x+a-h}else if(d.x+l+a+h>o){r=d.x+l+a+h-o}if(this.alignBottom_){if(d.y<-f+p+c){i=d.y+f-p-c}else if(d.y+f+p>u){i=d.y+f+p-u}}else{if(d.y<-f+p){i=d.y+f-p}else if(d.y+c+f+p>u){i=d.y+c+f+p-u}}if(!(r===0&&i===0)){var v=t.getCenter();t.panBy(r,i)}}}};InfoBox.prototype.setBoxStyle_=function(){var e,t;if(this.div_){this.div_.className=this.boxClass_;this.div_.style.cssText="";t=this.boxStyle_;for(e in t){if(t.hasOwnProperty(e)){this.div_.style[e]=t[e]}}if(typeof this.div_.style.opacity!=="undefined"&&this.div_.style.opacity!==""){this.div_.style.filter="alpha(opacity="+this.div_.style.opacity*100+")"}this.div_.style.position="absolute";this.div_.style.visibility="hidden";if(this.zIndex_!==null){this.div_.style.zIndex=this.zIndex_}}};InfoBox.prototype.getBoxWidths_=function(){var e;var t={top:0,bottom:0,left:0,right:0};var n=this.div_;if(document.defaultView&&document.defaultView.getComputedStyle){e=n.ownerDocument.defaultView.getComputedStyle(n,"");if(e){t.top=parseInt(e.borderTopWidth,10)||0;t.bottom=parseInt(e.borderBottomWidth,10)||0;t.left=parseInt(e.borderLeftWidth,10)||0;t.right=parseInt(e.borderRightWidth,10)||0}}else if(document.documentElement.currentStyle){if(n.currentStyle){t.top=parseInt(n.currentStyle.borderTopWidth,10)||0;t.bottom=parseInt(n.currentStyle.borderBottomWidth,10)||0;t.left=parseInt(n.currentStyle.borderLeftWidth,10)||0;t.right=parseInt(n.currentStyle.borderRightWidth,10)||0}}return t};InfoBox.prototype.onRemove=function(){if(this.div_){this.div_.parentNode.removeChild(this.div_);this.div_=null}};InfoBox.prototype.draw=function(){this.createInfoBoxDiv_();var e=this.getProjection().fromLatLngToDivPixel(this.position_);this.div_.style.left=e.x+this.pixelOffset_.width+"px";if(this.alignBottom_){this.div_.style.bottom=-(e.y+this.pixelOffset_.height)+"px"}else{this.div_.style.top=e.y+this.pixelOffset_.height+"px"}if(this.isHidden_){this.div_.style.visibility="hidden"}else{this.div_.style.visibility="visible"}};InfoBox.prototype.setOptions=function(e){if(typeof e.boxClass!=="undefined"){this.boxClass_=e.boxClass;this.setBoxStyle_()}if(typeof e.boxStyle!=="undefined"){this.boxStyle_=e.boxStyle;this.setBoxStyle_()}if(typeof e.content!=="undefined"){this.setContent(e.content)}if(typeof e.disableAutoPan!=="undefined"){this.disableAutoPan_=e.disableAutoPan}if(typeof e.maxWidth!=="undefined"){this.maxWidth_=e.maxWidth}if(typeof e.pixelOffset!=="undefined"){this.pixelOffset_=e.pixelOffset}if(typeof e.alignBottom!=="undefined"){this.alignBottom_=e.alignBottom}if(typeof e.position!=="undefined"){this.setPosition(e.position)}if(typeof e.zIndex!=="undefined"){this.setZIndex(e.zIndex)}if(typeof e.closeBoxMargin!=="undefined"){this.closeBoxMargin_=e.closeBoxMargin}if(typeof e.closeBoxURL!=="undefined"){this.closeBoxURL_=e.closeBoxURL}if(typeof e.infoBoxClearance!=="undefined"){this.infoBoxClearance_=e.infoBoxClearance}if(typeof e.isHidden!=="undefined"){this.isHidden_=e.isHidden}if(typeof e.enableEventPropagation!=="undefined"){this.enableEventPropagation_=e.enableEventPropagation}if(this.div_){this.draw()}};InfoBox.prototype.setContent=function(e){this.content_=e;if(this.div_){if(this.closeListener_){google.maps.event.removeListener(this.closeListener_);this.closeListener_=null}if(!this.fixedWidthSet_){this.div_.style.width=""}if(typeof e.nodeType==="undefined"){this.div_.innerHTML=this.getCloseBoxImg_()+e}else{this.div_.innerHTML=this.getCloseBoxImg_();this.div_.appendChild(e)}if(!this.fixedWidthSet_){this.div_.style.width=this.div_.offsetWidth+"px";if(typeof e.nodeType==="undefined"){this.div_.innerHTML=this.getCloseBoxImg_()+e}else{this.div_.innerHTML=this.getCloseBoxImg_();this.div_.appendChild(e)}}this.addClickHandler_()}google.maps.event.trigger(this,"content_changed")};InfoBox.prototype.setPosition=function(e){this.position_=e;if(this.div_){this.draw()}google.maps.event.trigger(this,"position_changed")};InfoBox.prototype.setZIndex=function(e){this.zIndex_=e;if(this.div_){this.div_.style.zIndex=e}google.maps.event.trigger(this,"zindex_changed")};InfoBox.prototype.getContent=function(){return this.content_};InfoBox.prototype.getPosition=function(){return this.position_};InfoBox.prototype.getZIndex=function(){return this.zIndex_};InfoBox.prototype.show=function(){this.isHidden_=false;if(this.div_){this.div_.style.visibility="visible"}};InfoBox.prototype.hide=function(){this.isHidden_=true;if(this.div_){this.div_.style.visibility="hidden"}};InfoBox.prototype.open=function(e,t){var n=this;if(t){this.position_=t.getPosition();this.moveListener_=google.maps.event.addListener(t,"position_changed",function(){n.setPosition(this.getPosition())})}this.setMap(e);if(this.div_){this.panBox_()}};InfoBox.prototype.close=function(){var e;if(this.closeListener_){google.maps.event.removeListener(this.closeListener_);this.closeListener_=null}if(this.eventListeners_){for(e=0;e<this.eventListeners_.length;e++){google.maps.event.removeListener(this.eventListeners_[e])}this.eventListeners_=null}if(this.moveListener_){google.maps.event.removeListener(this.moveListener_);this.moveListener_=null}if(this.contextListener_){google.maps.event.removeListener(this.contextListener_);this.contextListener_=null}this.setMap(null)};



/********************************************************************************************/
//  Google map
/********************************************************************************************/
var currentCenter;
var is_iphone = false;
var template_directory = "http://www.laparqueterienouvelle.fr/wp-content/themes/parqueterie_nouvelle/";
function affichePlan(showroom){
    //log("affichePlan "+showroom);
    

    //Options de la carte
    var myOptions = {
        //le niveau de zoom (de 1 à 19)
        zoom: 13,
        //assignation du centre
        //center: myCenter,
        // StreetView
        streetViewControl: true,
        // scrollwheel
        scrollwheel: false,
        // navigationControl
        navigationControl: true,
        // Draggable
        mapTypeControl: true,
        // Draggable
        scaleControl: true,
        // Draggable
        draggable: is_iphone?false:true,
        //type de carte. ROADMAP : plan / SATELLITE : satellite / HYBRID : plan+satellite / TERRAIN : relief physique
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        size: new google.maps.Size(475,445)
    };
    //placement de la carte, ici dans le div ayant l'id "carte" 
    //attention, le div "carte" doit être sizé en hauteur, sinon on ne voit pas la carte
    var map = new google.maps.Map(document.getElementById('carte'),myOptions);
        
    //spécification de la puce à utiliser. Par défaut, la puce Google Map classique     
    var puce = template_directory+'img/puce.png';
    
    var infowindow = new InfoBox({pixelOffset:new google.maps.Size(-255,-200),visible:true,closeBoxMargin:"-15px",maxWidth:230}); // infoWindow w/ infobox.js
    
    for(var i=0;i<3;i++) {
            var image,title,myCenter,myLatLng,content;
            
            if(i==0) {
                // CHAMBOURCY
                image = "<img src='"+template_directory+"/img/expand1_img4.jpg' />";
                title = "La Parqueterie Nouvelle<br />Chambourcy";
                content = "22, route de Mantes N13<br />78240 Chambourcy<br />T : 01 30 06 09 22";
                myCenter = myLatlng = new google.maps.LatLng(48.905662, 2.052383);
            }
            else if(i==1) {
                // CARRIERES
                image = "<img src='"+template_directory+"/img/expand1_img3.jpg' />";
                title = "La Parqueterie Nouvelle<br />Carrières/Seine";
                content = "33 rue des entrepreneurs<br />ZI des Amandiers<br />78420 Carrières / Seine";
                myCenter = myLatlng = new google.maps.LatLng(48.913644, 2.196708);
            }
            else {
                // PARIS
                title = "La Parqueterie Nouvelle<br />Paris";
                content = "Angle 141, rue de Bagnolet / 3 rue Pelleport<br />Parking gratuit de 20 places.<br />Entrée par le 3 rue Pelleport";
                image = "<img src='"+template_directory+"/img/expand1_img2.jpg' />";
                myCenter = myLatlng = new google.maps.LatLng(48.862372,2.406304);
            }
            content = '<div class="i-box" style="background: transparent url('+template_directory+'/images/coffee_top_1.jpg) left top no-repeat;"><div class="i-str">'+image+'<div class="infos_bulle"><h3>'+title+'</h3><p>'+content+'</p></div></div></div><div class="clear"></div>';
            
            var marker_1 = new google.maps.Marker({
                position: myLatlng,
                map: map,
                icon: puce,
                content : content,
                title:i.toString()
            });
            
            attachInfoBox(map,infowindow,marker_1,content);
            
            //Positionnement du marqueur    
            if(showroom=="chambourcy" && i==0) {
                map.setCenter(myCenter);
                infowindow.setContent(content);
                infowindow.open(map,marker_1);
                currentCenter = myCenter;
            } else if(showroom=="carrieres"  && i==1) {
                map.setCenter(myCenter);
                infowindow.setContent(content);
                infowindow.open(map,marker_1);
                currentCenter = myCenter;
            } 
            else if(showroom=="paris" && i==2) {
                map.setCenter(myCenter);
                infowindow.setContent(content);
                infowindow.open(map,marker_1);
                currentCenter = myCenter;
            }
            
    
        
    }

    // Center la carte en cas de resize
    google.maps.event.addDomListener(window, 'resize', function() {
        map.setCenter(currentCenter);
    });
    
}

function attachInfoBox(map,infowindow,marker,content) {
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent(content);
                infowindow.open(map,marker);
            });
}

function destroyMaps() {
    currentCenter = null;
}
