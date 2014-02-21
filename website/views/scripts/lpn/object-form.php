
<?php $this->layout()->setLayout('layout-lpn'); ?>
<?php if((!$this->error && !$this->success)|| $this->editmode) { ?>
    <?php $this->template("/content/default.php"); ?>
<?php } ?>

<?php if($this->error || $this->editmode) { ?>
    <br />
    <div class="alert alert-error">
        <?php echo $this->input("errorMessage"); ?>
    </div>
<?php } ?>

<?php if(!$this->success) { 
    $defaultEan = strlen($this->ean)==0?"121130270\n921100311\n121130273":$this->ean;
    $defaultMessage = strlen($this->message)==0?"Merci de votre visite à La Parqueterie Nouvelle.\nRetrouvez ci-dessous, votre séléction de produit :":$this->message;


    ?>
    <form class="form-horizontal" role="form" action="" method="post">
            <div class="form-group">
                <label class="col-lg-2 control-label"><?php echo $this->translate("Gender"); ?></label>
                <div class="col-lg-10">
                    <select name="gender" class="form-control">
                        <option value="Mr.">Mr.</option>
                        <option value="Mme.">Mme.</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label"><?php echo $this->translate("Firstname"); ?></label>
                <div class="col-lg-10">
                    <input name="firstname" type="text" class="form-control" placeholder="" value="<?php echo $this->firstname; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label"><?php echo $this->translate("Lastname"); ?></label>
                <div class="col-lg-10">
                    <input name="lastname" type="text" class="form-control" placeholder="" value="<?php echo $this->lastname; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label"><?php echo $this->translate("E-Mail"); ?></label>
                <div class="col-lg-10">
                    <input name="email" type="text" class="form-control" placeholder="exemple@exemple.com" value="<?php echo $this->email; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label"><?php echo $this->translate("Message"); ?></label>
                <div class="col-lg-10">
                    <textarea name="message" type="text" class="form-control" placeholder="" value="" rows="5"><?php echo $defaultMessage; ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label"><?php echo $this->translate("EAN/Article"); ?></label>
                <div class="col-lg-10">
                    <textarea name="ean" type="text" class="form-control" placeholder="Liste d'EAN"  rows="5" value="<?php echo $this->ean; ?>"><?php echo $defaultEan; ?></textarea>
                </div>
            </div>

        

            <br />

            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" class="btn btn-default"><?php echo $this->translate("Submit"); ?></button>
                </div>
            </div>
    </form>
<?php } else { ?>

    <h2><?php echo $this->translate("Merci, l'email a été envoyé"); ?></h2>

    <p>
        Informations :

        <br />
        <br />

        <b>Prénom: </b> <?php echo $this->firstname; ?><br />
        <b>Nom: </b> <?php echo $this->lastname; ?><br />
        <b>E-mail: </b> <?php echo $this->email; ?><br />
        <b>Page: </b> <a href="<?php echo $this->documentUrl; ?>" target="_blank">Voir la page</a><br />
    </p>
<?php } ?>
