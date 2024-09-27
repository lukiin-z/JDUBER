// Função para exibir chamados na tela
function displayChamados(chamados) {
    const chamadosDiv = document.getElementById('chamados');
    chamadosDiv.innerHTML = '';

    chamados.forEach(chamado => {
        const chamadoElement = document.createElement('div');
        chamadoElement.innerText = `Chamado de montador ${chamado.montador_id} - Local: ${chamado.latitude}, ${chamado.longitude}`;
        chamadosDiv.appendChild(chamadoElement);
    });
}

// Verificar chamados a cada 5 segundos
setInterval(() => {
    fetch('/api/get_chamados')
        .then(response => response.json())
        .then(data => {
            displayChamados(data);
        });
}, 5000);

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
        marker.setIcon('path_to_montador_icon.png');
    }
}

// Carregar as localizações dos montadores
fetch('/api/get_all_locations')
    .then(response => response.json())
    .then(data => {
        displayLocationsOnMap(data);
    });
