<?php
// PHP Yaml lib. bootstrap

define('HOME_DIR', realpath(__DIR__ . '/../') . DIRECTORY_SEPARATOR);
include_once HOME_DIR . 'Yaml.php';

set_include_path(HOME_DIR . 'Tests/Fixtures' . PATH_SEPARATOR . get_include_path());

