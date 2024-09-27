 <?php
// Função para calcular a distância entre dois pontos (Haversine)
function calcular_distancia($lat1, $lon1, $lat2, $lon2) {
    $raio_terra = 6371; // Raio da Terra em km
    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);
    $a = sin($dLat / 2) * sin($dLat / 2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
         sin($dLon / 2) * sin($dLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    return $raio_terra * $c;
}

// Definir as coordenadas do usuário (podem ser atualizadas a cada interação)
$lat_usuario = $_POST['lat_usuario'];
$lon_usuario = $_POST['lon_usuario'];
$kits_coletados = $_POST['kits_coletados']; // Número de kits já coletados

// Conectar ao banco de dados
$conn = new mysqli("localhost", "seu_usuario", "sua_senha", "seu_banco");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Se o usuário coletou 4 kits, redirecionar para (0,0)
if ($kits_coletados >= 4) {
    echo json_encode([
        'finalizado' => true,
        'latitude' => 0,
        'longitude' => 0,
        'message' => 'Você coletou todos os kits, retornando para o ponto inicial.'
    ]);
    exit();
}

// Consulta SQL para obter as coordenadas dos kits no modo 'buscar'
$sql = "SELECT id, latitude, longitude FROM kits WHERE modo = 'buscar'";
$result = $conn->query($sql);

$kit_proximo = null;
$menor_distancia = PHP_INT_MAX;

// Encontrar o kit mais próximo
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $distancia = calcular_distancia($lat_usuario, $lon_usuario, $row['latitude'], $row['longitude']);
        if ($distancia < $menor_distancia) {
            $menor_distancia = $distancia;
            $kit_proximo = $row;
        }
    }
}

if ($kit_proximo) {
    // Retornar os dados do kit mais próximo
    echo json_encode([
        'kit_id' => $kit_proximo['id'],
        'latitude' => $kit_proximo['latitude'],
        'longitude' => $kit_proximo['longitude'],
        'distancia' => $menor_distancia
    ]);
} else {
    echo json_encode(['message' => 'Nenhum kit encontrado no modo buscar.']);
}

$conn->close();
?>
