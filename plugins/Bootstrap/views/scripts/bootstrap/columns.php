<div class="row <?= $this->input("cssClass")->getData() ?>">

<div class="col-xs-12">
<h2><?php echo $this->input('title')?></h2>
</div>


    <?php

    $values = \Bootstrap\Config::getConfig();
    $valueArray = $values->toArray();

    $store = array();

    if( isset( $valueArray['columnElements'] ) ) {

        foreach( $valueArray['columnElements'] as $key => $value) {
            $store[] = array($key, $value);
        }

    }

    if ($this->editmode) {
        if ($this->select("type")->isEmpty()) {
            $this->select("type")->setDataFromResource("column_12");
        } 
        ?>

        <div class="col-12">
            <?= $this->select("type", array("reload" => true, "store" => $store)); ?>
            <?= $this->input("cssClass", array("reload" => false, "store" => $store)); ?>
        </div>
    <?php
    }

    $type = $this->select("type")->getData();

    if ($type) {
        $type = explode("_", $type);

        $type_partial = $type[0];
        $columns = array_splice($type, 1);

        $params = array(
            "columns" => $columns,
            "cssClass" => $this->input("cssClass")->getData()
        );

        $this->template("bootstrap/columns/" . $type_partial . ".php", $params);
    } ?>
</div>
