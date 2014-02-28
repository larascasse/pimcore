<?php
/**
 * Created by JetBrains PhpStorm.
 * User: cfasching
 * Date: 21.11.11
 * Time: 14:16
 * To change this template use File | Settings | File Templates.
 */
 
if($revision == 7) {

    $db = Pimcore_Resource::get();

    $db->query("ALTER TABLE plugin_texttemplates_templates
         ADD description VARCHAR(300) AFTER modificationDate,
         ADD category VARCHAR(150);
    ");
}