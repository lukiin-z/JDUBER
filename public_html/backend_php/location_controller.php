<?php
// location_controller.php

// Recebe a localização do usuário (montador/operador)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $location = $_POST['location'];
    $userId = $_POST['userId'];
    
    // Atualiza localização no banco de dados
    updateUserLocation($userId, $location);
    
    echo json_encode(['status' => 'success']);
}
?>
