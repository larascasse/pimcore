<script>

$(document).ready(function() {
	console.log("INIT");
  $('#selectAllFt').on('click', function () {
  	//console.log('KKKKKKKKK',$('input[type="checkbox"]', '.check-ft'))
    if ($(this).hasClass('allChecked')) {
        $('.check-ft').attr('checked', false);
    } else {
        $('.check-ft').attr('checked', true);
    }
    $(this).toggleClass('allChecked');
  });
  $('#selectAllPose').on('click', function () {
  	//console.log('KKKKKKKKK',$('input[type="checkbox"]', '.check-ft'))
    if ($(this).hasClass('allChecked')) {
        $('.check-pose').attr('checked', false);
    } else {
        $('.check-pose').attr('checked', true);
    }
    $(this).toggleClass('allChecked');
  });
  $('#selectAllPhoto').on('click', function () {
  	//console.log('KKKKKKKKK',$('input[type="checkbox"]', '.check-ft'))
    if ($(this).hasClass('allChecked')) {
        $('.check-photo').attr('checked', false);
    } else {
        $('.check-photo').attr('checked', true);
    }
    $(this).toggleClass('allChecked');
  });

  $('#selectAllFt').click();
  $('#selectAllPose').click();
  $('#selectAllPhoto').click();


});



function showPleaseWait () {
            $('#pleasewaitmodal').modal();
        };

function hidePleaseWait () {
            $('#pleasewaitmodal').modal('hide');
        };




function sendEmail() {
  console.log("KK",$("#mailform"),$("#mailform").serialize());
  showPleaseWait();
  $.ajax({
     url : '/?controller=mauchamp&action=mauchamp-sendmail',
     data: $("#mailform").serialize()+'&sendmail=true',
     method : "POST",
     success: function (data) {

       

            hidePleaseWait();
            alert(data);

      }
  });
}

</script>
<form id="mailform">

<?php foreach ($this->client as $key => $value) {
  echo '<div class="form-group"><label>'.$key.' : </label> <input disabled value="'.$value.'" /></div>';
}
?>
<textarea disabled cols="50" rows="20"><?php echo $this->xmlClient ?></textarea>
 </form>
<div id="pleasewaitmodal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"><div class="modal-dialog modal-sm"><div class="modal-content">En cours de traitement</div></div></div>