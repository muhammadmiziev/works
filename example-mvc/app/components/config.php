<?php

    try {
        $conf_file = file_get_contents(ROOT.'/app/configs.json');
        return json_decode($conf_file, true);
    } catch (Exception $e) {
        die('ERROR IN CONFIG FILE!');
    }

?>
