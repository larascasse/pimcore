<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Pimcore Tools Plugin :: Settings</title>

    <link type="text/css" rel="stylesheet" href="/pimcore/static/css/layout.css"></link>
    <style type="text/css">
        <?php

        echo file_get_contents(PIMCORE_PLUGINS_PATH . "/Tools/static/css/admin.css");
        ?>
    </style>
</head>
<body class="plugin">
<div class="plugin">
        <?php

            include (dirname(__FILE__) . "/includes/menu.php");
            ?>
            <?= $this->layout()->content ?>
</div>
</body>
</html>
