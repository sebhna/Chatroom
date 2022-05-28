<?php
    $hostname = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "chatroom";
    $dtbsocket = "/zstorage/home/ece01358/mysql/run/mysql.sock";
    try {
        $conn =  new PDO("mysql:unix_socket=$dtbsocket;dbname=$dbname;charset=utf8",$username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
    catch (PDOException $e) {
        file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        $conn = null;

    }
?>