// Solicitar chamado
document.getElementById('solicitarChamado').addEventListener('click', () => {
    getCurrentLocation().then((location) => {
        fetch('/backend_php/chamado_controller.php', {  // Alterado para o caminho correto
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                location: location
            }),
        })
        .then(() => {
            alert('Chamado solicitado!');
        });
    }).catch((error) => {
        console.error("Erro ao obter a localização: ", error);
    });
});

// Função para exibir localizações no mapa
function displayLocationsOnMap(locations) {
    locations.forEach(location => {
        // Lógica para adicionar marcadores no mapa
        addMarkerToMap(location.latitude, location.longitude, location.role);
    });
}

// Função para adicionar marcadores no mapa
function addMarkerToMap(latitude, longitude, role) {
    const marker = new google.maps.Marker({
        position: { lat: latitude, lng: longitude },
        map: map,
        title: role
    });

    if (role === 'operador') {
        marker.setIcon('path_to_operador_icon.png');  // Substitua pelo caminho correto do ícone do operador
    }
}

// Carregar as localizações dos operadores e montadores
fetch('/backend_php/get_all_locations.php')  // Alterado para o caminho correto
    .then(response => response.json())
    .then(data => {
        displayLocationsOnMap(data);
    });

// Função para obter a localização atual
function getCurrentLocation() {
    return new Promise((resolve, reject) => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const location = {
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude
                };
                console.log("Localização atual:", location);  // Exibe no console para teste
                resolve(location);
            }, function(error) {
                reject(error);
            });
        } else {
            alert("Geolocalização não é suportada pelo seu navegador.");
            reject("Geolocalização não suportada.");
        }
    });
}

// Função para inicializar o mapa
function initMap() {
    const center = { lat: -23.5489, lng: -46.6388 };  // Coordenadas centrais válidas
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: center  // Defina as coordenadas válidas aqui
    });
}
