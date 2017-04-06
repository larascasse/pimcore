<?php if($this->editmode): ?>
    <?php
    // with $this->brick->getPath() you get the path of the area out of the info-object.
    ?>
    <link rel="stylesheet" type="text/css" href="<?= $this->brick->getPath(); ?>/editmode.css" />

    <div>
        <h2>IFrame</h2>
        <div>
            URL: <?= $this->input("iframe_url"); ?>
        </div>
        <br />
        <b>Advanced Configuration</b>
        <div>
            Width: <?= $this->numeric("iframe_width"); ?>px (default: 100%)
        </div>
        <div>
            Height: <?= $this->numeric("iframe_height"); ?>px (default: 400px)
        </div>
        <div>
            Transparent: <?= $this->checkbox("iframe_transparent"); ?> (default: false)
        </div>
    </div>
<?php else: ?>
    <?php if(!$this->input("iframe_url")->isEmpty()): ?>
    <?php
            // defaults
            $transparent = "false";
            $width = "100%";
            $height = "400";

            if(!$this->numeric("iframe_width")->isEmpty()) {
                $width = (string) $this->numeric("iframe_width");
            }
            if(!$this->numeric("iframe_height")->isEmpty()) {
                $height = (string) $this->numeric("iframe_height");
            }
            if($this->checkbox("iframe_transparent")->isChecked()) {
                $transparent = "true";
            }
        ?>
    <iframe src="<?= $this->input("iframe_url"); ?>" width="<?= $width; ?>" height="<?= $height; ?>" allowtransparency="<?= $transparent; ?>" frameborder="0" ></iframe>

    <?php endif; ?>
<?php endif; ?>