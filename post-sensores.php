<?php

// Endereço do servidor
$servername = "10.0.0.50";
// Nome da base de dados
$dbname = "termopar";
// Usuário do banco de dados
$username = "root";
// Senha do banco de dados
$password = "paulvandyk11";

// Keep this API Key value to be compatible with the ESP32 code provided in the project page. 
// If you change this value, the ESP32 sketch needs to match
$api_key_value = "tPmAT5Ab3j7F9";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $api_key = test_input($_POST["api_key"]);
    
    if ($api_key == $api_key_value) {
        $tk1 = test_input($_POST["tk1"]);
        $tk2 = test_input($_POST["tk2"]);
        $tk3 = test_input($_POST["tk3"]);
        $tk4 = test_input($_POST["tk4"]);
        $tk5 = test_input($_POST["tk5"]);
        $media = test_input($_POST["media"]);
        $t_tdb = test_input($_POST["t_tdb"]);
        $h_tdb = test_input($_POST["h_tdb"]);
        $kimo = test_input($_POST["kimo"]);
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO sensores (tk1, tk2, tk3, tk4, tk5, media, t_tdb, h_tdb, kimo) 
        VALUES ('{$tk1}', '{$tk2}', '{$tk3}', '{$tk4}', '{$tk5}', '{$media}', '{$t_tdb}', '{$h_tdb}', '{$kimo}')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}