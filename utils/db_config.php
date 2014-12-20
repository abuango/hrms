<?php

require_once 'classes/Zebra_Database.php';

$db = new Zebra_Database();
//$db->resource_path = '../res/zebra_db';
// turn debugging on
$db->debug = true;

// set relative path to parent of public folder from $_SERVER['DOCUMENT_ROOT'] (optional)
// no leading slash
// ie: http://example.com/vendor/stefangabos/zebra_database/public/css/database.css


$db->connect('localhost', 'root', '', 'db_mml_hrms_v2');

// code goes here

// this should always be present at the end of your scripts;
// whether it should output anything should be controlled by the $debug property


?>