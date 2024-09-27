<?php
$servername = "localhost"; 
$username = "u192822332_bolla_x2"; 
$password = "Luke582279";  
$dbname = "u192822332_cordenadas";  

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta as coordenadas mais recentes
$sql = "SELECT x, y, modo FROM coordenadas_esp32 ORDER BY data_envio DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Retorna a última coordenada em formato JSON
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(['x' => null, 'y' => null, 'modo' => null]);
}

$conn->close();
?>
