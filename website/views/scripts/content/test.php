<a href="#" class="button btn" onclick='showGallery();return false;'>Ouvrir gallery</a>

<script>
function showGallery(productId) {
	jQuery.ajax({
						url: '/ajax/jsonProductImages/2932',
						dataType: 'json',
						type : 'get',
						success: function(data, textStatus, jqXHR){
							console.log(data);
							var images=new Array();
							for (var i=0; i<data.length;i++) {
								group = data[i];
								console.log(group);
								images.push(group.images)
							}
							images = images.join(',').split(',');

							blueimp.Gallery(images);
							

						}
					}
				);
}
</script>