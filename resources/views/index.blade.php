<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CasaMobilité - Transport Urbain à Casablanca</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Google Fonts & FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
    --black: #000000;
    --gray-light: #f8f9fa;
    --white: #FFFFFF;
    --border-gray: #e2e8f0;
}

body {
    font-family: 'Inter', sans-serif;
    background-color: var(--gray-light);
    color: var(--black);
    margin: 0;
    padding: 0;
}

.navbar {
    background-color: var(--black);
}

.navbar-brand, .nav-link {
    color: var(--white) !important;
}

.hero-section {
    background-color: var(--black);
    color: var(--white);
    padding: 4rem 1rem;
    border-radius: 0 0 2rem 2rem;
}

.card-custom {
    border: 1px solid var(--border-gray);
    border-radius: 1rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    background-color: var(--white);
    transition: transform 0.2s ease;
}

.card-custom:hover {
    transform: translateY(-3px);
}

#map {
    height: 500px;
    border-radius: 1rem;
    z-index: 1;
    border: 1px solid var(--border-gray);
}

.badge-transport {
    font-size: 0.85rem;
    padding: 0.4em 0.8em;
    background-color: var(--black);
    color: var(--white);
    border-radius: 50rem;
}

footer {
    background-color: var(--black);
    color: var(--white);
    padding: 3rem 0;
    margin-top: 4rem;
}
    </style>
</head>
<body>
    <!-- A. Barre de navigation -->
    <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fa-solid fa-bus-simple me-2"></i>CasaMobilité
            </a>
            <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-3">
                    <li class="nav-item"><a class="nav-link" href="#">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#apropos">À propos</a></li>
                    <li class="nav-item">
                        <a href="#carteReseau" class="btn btn-light text-dark fw-semibold rounded-pill px-4">Consulter les lignes</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('adminLogin')}}" class="btn btn-light text-dark fw-semibold rounded-pill px-4">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- B. Section principale (Hero) -->
    <header class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Déplacez-vous facilement à Casablanca</h1>
            <p class="lead mb-4 text-white-50">Retrouvez les lignes, les itinéraires et les arrêts du réseau de transport urbain en un seul endroit.</p>
        </div>
    </header>
    <main class="container my-5">
        <section class="mb-5 py-4">
            @include('carteVoyageur')
        </section>
        <!-- E. Section « Comment ça marche ? » -->
        <section class="mb-5 py-4">
            <div class="text-center mb-5">
                <h2 class="h3 fw-bold">Comment ça marche ?</h2>
                <p class="text-muted">Naviguez simplement sur le réseau en 3 étapes</p>
            </div>
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="card card-custom h-100 p-4">
                        <div class="fs-1 text-primary mb-3"><i class="fa-solid fa-magnifying-glass-location"></i></div>
                        <h4 class="h5 fw-bold">1. Recherchez</h4>
                        <p class="text-muted small">Trouvez rapidement votre ligne ou votre arrêt par nom ou par numéro.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom h-100 p-4">
                        <div class="fs-1 text-primary mb-3"><i class="fa-solid fa-map"></i></div>
                        <h4 class="h5 fw-bold">2. Consultez</h4>
                        <p class="text-muted small">Visualisez l'itinéraire complet de la ligne directement sur la carte interactive.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom h-100 p-4">
                        <div class="fs-1 text-primary mb-3"><i class="fa-solid fa-signs-post"></i></div>
                        <h4 class="h5 fw-bold">3. Identifiez</h4>
                        <p class="text-muted small">Repérez les arrêts desservis pour préparer au mieux vos déplacements.</p>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- F. Pied de page -->
    <footer id="apropos">
        <div class="container text-center text-md-start">
            <div class="row g-4">
                <div class="col-md-6">
                    <h5 class="fw-bold mb-3"><i class="fa-solid fa-bus-simple me-2"></i>CasaMobilité</h5>
                    <p class="text-white-50 small">Système de gestion et d'optimisation du transport urbain à Casablanca. Une solution moderne pour faciliter la mobilité des citoyens.</p>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold mb-3">Liens rapides</h6>
                    <ul class="list-unstyled small">
                        <li><a href="#" class="text-white-50 text-decoration-none">Accueil</a></li>
                        <li><a href="#lignes-section" class="text-white-50 text-decoration-none">Lignes de transport</a></li>
                        <li><a href="#apropos" class="text-white-50 text-decoration-none">À propos</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold mb-3">Cadre académique</h6>
                    <p class="text-white-50 small">Projet de Fin d'Études (PFE) — Casablanca, Maroc.</p>
                </div>
            </div>
            <hr class="border-secondary my-4">
            <div class="text-center text-white-50 small">
                &copy; 2026 CasaMobilité. Tous droits réservés.
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS & Leaflet JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // Données simulées (Mock Data) pour les lignes et arrêts de Casablanca
        const transportData = [
            {
                id: 1,
                numero: "T1",
                nom: "Sidi Moumen - Lissasfa",
                type_transport: "Tramway",
                couleur: "#006699",
                arrets: [
                    { nom: "Sidi Moumen", lat: 33.601, lng: -7.531 },
                    { nom: "Al Qods", lat: 33.590, lng: -7.550 },
                    { nom: "Fès", lat: 33.585, lng: -7.570 },
                    { nom: "Place Mohammed V", lat: 33.595, lng: -7.618 },
                    { nom: "Lissasfa", lat: 33.535, lng: -7.662 }
                ]
            },
            {
                id: 2,
                numero: "T2",
                nom: "Sidi Bernoussi - Ain Diab",
                type_transport: "Tramway",
                couleur: "#E63946",
                arrets: [
                    { nom: "Sidi Bernoussi", lat: 33.610, lng: -7.510 },
                    { nom: "Grand Stade", lat: 33.588, lng: -7.535 },
                    { nom: "Anfa Clubs", lat: 33.560, lng: -7.650 },
                    { nom: "Ain Diab Plage", lat: 33.592, lng: -7.665 }
                ]
            },
            {
                id: 3,
                numero: "BW1",
                nom: "Lissasfa - Hay Al Amal (Bd Mohammed VI)",
                type_transport: "Busway",
                couleur: "#2A9D8F",
                arrets: [
                    { nom: "Lissasfa Busway", lat: 33.536, lng: -7.660 },
                    { nom: "Bd Mohammed VI - Station 1", lat: 33.560, lng: -7.610 },
                    { nom: "Hay Al Amal", lat: 33.570, lng: -7.590 }
                ]
            },
            {
                id: 4,
                numero: "19",
                nom: "Gare Casa-Port - Aéroport Mohammed V",
                type_transport: "Bus",
                couleur: "#F4A261",
                arrets: [
                    { nom: "Gare Casa-Port", lat: 33.603, lng: -7.612 },
                    { nom: "Place des Nations Unies", lat: 33.596, lng: -7.619 },
                    { nom: "Technopark", lat: 33.548, lng: -7.665 }
                ]
            }
        ];

        document.addEventListener('DOMContentLoaded', function() {
            // Initialisation de la carte Leaflet centrée sur Casablanca
            const casaCoords = [33.5731, -7.5898];
            const map = L.map('map').setView(casaCoords, 12);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            let markersLayer = L.layerGroup().addTo(map);

            // Fonction d'affichage des cartes de lignes
            function renderLignes(lignes) {
                const container = document.getElementById('lignesContainer');
                container.innerHTML = '';

                if (lignes.length === 0) {
                    container.innerHTML = `
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">Aucune ligne ne correspond à votre recherche.</p>
                        </div>
                    `;
                    return;
                }

                lignes.forEach(ligne => {
                    const col = document.createElement('div');
                    col.className = 'col-md-6 col-lg-4 ligne-item';
                    col.innerHTML = `
                        <div class="card card-custom h-100 p-4 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge badge-transport rounded-pill" style="background-color: ${ligne.couleur}; color: #fff;">
                                        ${ligne.type_transport}
                                    </span>
                                    <span class="fw-bold fs-5 text-secondary">N° ${ligne.numero}</span>
                                </div>
                                <h3 class="h5 fw-bold text-dark">${ligne.nom}</h3>
                                <p class="text-muted small mb-3">
                                    <i class="fa-solid fa-map-pin me-1"></i> ${ligne.arrets.length} arrêts desservis
                                </p>
                            </div>
                            <button class="btn btn-outline-dark btn-sm rounded-pill w-100 mt-3 select-ligne-btn" data-id="${ligne.id}">
                                <i class="fa-solid fa-eye me-1"></i> Voir l'itinéraire
                            </button>
                        </div>
                    `;
                    container.appendChild(col);
                });

                // Attacher les écouteurs sur les nouveaux boutons générés
                attachSelectListeners();
            }

            // Afficher tous les arrêts sur la carte au chargement initial
            function plotAllArrets() {
                markersLayer.clearLayers();
                transportData.forEach(ligne => {
                    ligne.arrets.forEach(arret => {
                        const marker = L.marker([arret.lat, arret.lng]);
                        marker.bindPopup(`<strong>${arret.nom}</strong><br><span class="text-muted">Ligne ${ligne.numero} (${ligne.type_transport})</span>`);
                        markersLayer.addLayer(marker);
                    });
                });
            }

            plotAllArrets();
            renderLignes(transportData);

            // Recentrer la carte
            document.getElementById('resetMapBtn').addEventListener('click', function() {
                map.setView(casaCoords, 12);
                plotAllArrets();
            });

            // Sélection d'une ligne spécifique
            function attachSelectListeners() {
                document.querySelectorAll('.select-ligne-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const ligneId = parseInt(this.getAttribute('data-id'));
                        const ligne = transportData.find(l => l.id === ligneId);

                        if(ligne) {
                            markersLayer.clearLayers();
                            let latLngs = [];

                            ligne.arrets.forEach(arret => {
                                const latLng = [arret.lat, arret.lng];
                                latLngs.push(latLng);
                                const marker = L.marker(latLng);
                                marker.bindPopup(`<strong>${arret.nom}</strong><br><span class="text-muted">Ligne ${ligne.numero} - ${ligne.nom}</span>`);
                                markersLayer.addLayer(marker);
                            });

                            if(latLngs.length > 0) {
                                map.fitBounds(latLngs, { padding: [50, 50] });
                                if(latLngs.length > 1) {
                                    const polyline = L.polyline(latLngs, { color: ligne.couleur, weight: 5 });
                                    markersLayer.addLayer(polyline);
                                }
                            }

                            document.getElementById('map').scrollIntoView({ behavior: 'smooth' });
                        }
                    });
                });
            }

            // Filtrage et recherche dynamique
            const filterTypeCards = document.getElementById('filterTypeCards');
            const filterTypeMap = document.getElementById('filterTypeMap');
            const searchInput = document.getElementById('searchInput');

            function filterAndSearch() {
                const typeVal = filterTypeCards.value;
                const searchVal = searchInput.value.toLowerCase().trim();

                const filtered = transportData.filter(ligne => {
                    const matchType = !typeVal || ligne.type_transport === typeVal;
                    const matchSearch = !searchVal || 
                        ligne.numero.toLowerCase().includes(searchVal) || 
                        ligne.nom.toLowerCase().includes(searchVal);
                    return matchType && matchSearch;
                });

                renderLignes(filtered);
            }

            filterTypeCards.addEventListener('change', function() {
                filterTypeMap.value = filterTypeCards.value;
                filterAndSearch();
            });

            filterTypeMap.addEventListener('change', function() {
                filterTypeCards.value = filterTypeMap.value;
                filterAndSearch();
            });

            searchInput.addEventListener('input', filterAndSearch);
            document.getElementById('searchForm').addEventListener('submit', function(e) {
                e.preventDefault();
                filterAndSearch();
                document.getElementById('lignes-section').scrollIntoView({ behavior: 'smooth' });
            });
        });
    </script>
</body>
</html>                                                                                                                                                                                 