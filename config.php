<?php

if (file_exists("config.dev.php")) {
    $local_config = require "config.dev.php";   //for dev environment, load this. ps: not pushed to prod
    return $local_config;

}

//if not found
//that is in production
//just skip above and load below


return [
    "database" => [
        "server" => getenv('db_connection'),
        "dbname" => getenv('dbname'),
        "username" => getenv("dbusername"),
        "password" => getenv('dbpass'),
        "options" => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ],
    ],
];

// mysql://b67a464312a7b7:cd5384c3@us-cdbr-east-05.cleardb.net/heroku_5a6e872e3ba3c78?reconnect=true