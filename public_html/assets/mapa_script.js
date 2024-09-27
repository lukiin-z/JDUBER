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

    if (role === 'montador') {
        marker.setIcon('path_to_montador_icon.png'); // Substitua pelo caminho da imagem do montador
    } else if (role === 'operador') {
        marker.setIcon('path_to_operador_icon.png'); // Substitua pelo caminho da imagem do operador
    }
}

// Carregar as localizações de operadores e montadores
fetch('/api/get_all_locations')
    .then(response => response.json())
    .then(data => {
        displayLocationsOnMap(data);
    });
