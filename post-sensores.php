<?php

// Endereço do servidor
$servername = "192.168.50.58";
// Nome da base de dados
$dbname = "termopar";
// Usuário do banco de dados
$username = "root";
// Senha do banco de dados
$password = "paulvandyk11";

// Keep this API Key value to be compatible with the ESP32 code provided in the project page. 
// If you change this value, the ESP32 sketch needs to match
$api_key_value = "tPmAT5Ab3j7F9";

$api_key = $nome = $valor = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $api_key = test_input($_POST["api_key"]);
    
    if ($api_key == $api_key_value) {
        $nome = test_input($_POST["nome"]);
        $valor = test_input($_POST["valor"]);
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO mensagens (nome, valor)
        VALUES ('" . $nome . "', '" . $valor . "')";
        
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