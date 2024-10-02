<?php
    session_start();

    $user = "root";
    $pass = "Udemy1234";  // Insira a senha do seu usuário 'root'
    $db = "pizzaria";
    $host = "localhost";
    //$host = "127.0.0.1";
    //$port = "3306";  // Porta padrão do MySQL

    try {

        $conn = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_ERRMODE, false);

    } catch(PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();

    }

?>