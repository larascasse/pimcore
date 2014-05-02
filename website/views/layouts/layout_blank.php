<?php if (!$this->editmode) { ?>
<textarea cols="200" rows="80">
<?php } ?>
<?php echo $this->layout()->content; ?>

<?php if (!$this->editmode) { ?>
</textarea>
<?php } ?>
