<?php
    require "vendor/autoload.php";
    
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    //Instantiate connection
    $conn = mysqli_connect($server, $username, $password, $db);
    $conn->set_charset("utf8");