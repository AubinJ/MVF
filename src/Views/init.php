<?php

use src\Models\Database;

require_once __DIR__ . '/autoload.php';


session_start();

require_once __DIR__ . "/../config.php";

if (DB_INITIALIZED == FALSE) {
    $db = new Database();
    $db->initializeDB();
}

require_once __DIR__ . "/router.php";
