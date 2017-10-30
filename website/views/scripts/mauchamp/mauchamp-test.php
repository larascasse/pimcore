<br />
<br />
<br />
<script type="text/javascript">
  $(document).ready(function() {
    $('#btn-commande').on('click',function() {
        document.location.href="/mauchamp-test/"+$('#codecommande').val();
    });
  });
</script>

<div class="container-small">
  <div class="row">
  <div class="col-12 text-center">
    
  <div class="form-group">
    <form action="/mauchamp-test" method ="GET">
    <label for="exampleInputEmail1">Numéro de commande</label>
    <input type="text" class="form-control" aria-describedby="emailHelp__" placeholder="Code commande" value="<?php echo $this->codecommande; ?>" id="codecommande">
    <!--<small id="emailHelp" class="form-text text-muted">le numéro de commande scienergie</small>-->
    <input type="button"  id="btn-commande" value="Envoyer" />
  </form>
<hr />
<?php if(isset($this->xml)) { ?>
<form action="/mauchamp" method ="POST">
    <textarea class="form-control"  rows="13" name="xml"><?php echo $this->xml->asXml()?></textarea>
    <input type="submit" value="Envoyer" />
  </div>
</form>

<?php } ?>
  </div>
</div>
</div>
</div>