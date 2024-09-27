<?php
require 'config.php';
require 'coletaController.php'; // Controlador de coleta

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    coletarDados($_POST);
}
?>
