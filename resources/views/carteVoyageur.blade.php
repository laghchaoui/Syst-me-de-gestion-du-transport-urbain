<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CasaMobilité - Carte du Réseau</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        /* ==========================================================================
           1. CHARTE GRAPHIQUE & PALETTE DE COULEURS
           ========================================================================== */
        :root {
            --navy-blue: #202742;
            --navy-light: #2c3558;
            --light-beige: #F5F0E8;
            --pure-white: #FFFFFF;
            --border-gray: #E2E8F0;
            --text-dark: #2B2F3E;
            --text-muted: #64748B;
            
            /* Couleurs distinctives par type de transport */
            --bus-color: #E67E22;
            --tram-color: #C0392B;
            --busway-color: #16A085;
        }

        body {
            background-color: var(--light-beige);
            color: var(--text-dark);
            font-family: 'Segoe UI', system-ui, -apple-system, Roboto, sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        /* En-tête de section */
        .section-header {
            margin-bottom: 2rem;
        }

        .section-badge {
            background-color: rgba(32, 39, 66, 0.1);
            color: var(--navy-blue);
            font-weight: 600;
            font-size: 0.85rem;
            padding: 0.4rem 1rem;
            border-radius: 50rem;
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        .section-title {
            color: var(--navy-blue);
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        /* Carte Conteneur Principal */
        .panel-card {
            background-color: var(--pure-white);
            border: 1px solid var(--border-gray);
            border-radius: 1.25rem;
            box-shadow: 0 10px 30px rgba(32, 39, 66, 0.05);
            padding: 1.75rem;
            height: 100%;
        }

        /* Cartes de sélection de transport */
        .mode-card {
            border: 2px solid var(--border-gray);
            border-radius: 1rem;
            padding: 1rem 0.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            background-color: var(--pure-white);
            user-select: none;
        }

        .mode-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
        }

        .mode-card i {
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
            display: block;
            transition: transform 0.25s ease;
        }

        .mode-card:hover i {
            transform: scale(1.1);
        }

        .mode-card .mode-title {
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--navy-blue);
        }

        /* États Sélectionnés par type */
        .mode-card.selected-bus {
            border-color: var(--bus-color);
            background-color: rgba(230, 126, 34, 0.06);
        }
        .mode-card.selected-bus i { color: var(--bus-color); }

        .mode-card.selected-tram {
            border-color: var(--tram-color);
            background-color: rgba(192, 57, 43, 0.06);
        }
        .mode-card.selected-tram i { color: var(--tram-color); }

        .mode-card.selected-busway {
            border-color: var(--busway-color);
            background-color: rgba(22, 160, 133, 0.06);
        }
        .mode-card.selected-busway i { color: var(--busway-color); }

        /* Formulaire & Sélecteur */
        .form-label-custom {
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--navy-blue);
            margin-bottom: 0.5rem;
        }

        .form-select-custom {
            border: 2px solid var(--border-gray);
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            font-weight: 600;
            color: var(--navy-blue);
            transition: border-color 0.2s ease;
        }

        .form-select-custom:focus {
            border-color: var(--navy-blue);
            box-shadow: 0 0 0 0.25rem rgba(32, 39, 66, 0.15);
        }

        /* Encadré Trajet & Infos */
        .route-info-box {
            background-color: rgba(245, 240, 232, 0.5);
            border: 1px dashed #D1D5DB;
            border-radius: 0.85rem;
            padding: 1rem;
            margin-top: 1.25rem;
            margin-bottom: 1.25rem;
        }

        .route-display {
            font-weight: 700;
            font-size: 1.05rem;
            color: var(--navy-blue);
        }

        /* Bouton d'action principal */
        .btn-action {
            background-color: var(--navy-blue);
            color: var(--pure-white);
            font-weight: 700;
            padding: 0.85rem 1.5rem;
            border-radius: 0.75rem;
            border: none;
            width: 100%;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(32, 39, 66, 0.2);
        }

        .btn-action:hover {
            background-color: var(--navy-light);
            color: var(--pure-white);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(32, 39, 66, 0.3);
        }

        .btn-action:active {
            transform: translateY(0);
        }

        /* Carte Leaflet */
        .map-container {
            position: relative;
            height: 100%;
            min-height: 520px;
            border-radius: 1.25rem;
            overflow: hidden;
            border: 1px solid var(--border-gray);
            box-shadow: 0 10px 30px rgba(32, 39, 66, 0.05);
        }

        #map {
            width: 100%;
            height: 100%;
            min-height: 520px;
            z-index: 1;
        }

        /* Bouton Recentrer sur la carte */
        .map-btn-recenter {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 1000;
            background: var(--pure-white);
            border: 1px solid var(--border-gray);
            border-radius: 0.6rem;
            padding: 0.5rem 0.85rem;
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--navy-blue);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .map-btn-recenter:hover {
            background-color: var(--navy-blue);
            color: var(--pure-white);
        }

        /* Légende sur la carte */
        .map-legend {
            position: absolute;
            bottom: 20px;
            left: 20px;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(4px);
            border: 1px solid var(--border-gray);
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            font-size: 0.8rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.35rem;
            font-weight: 600;
        }

        .legend-item:last-child {
            margin-bottom: 0;
        }

        .legend-color-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
        }

        /* Watermark Démo */
        .demo-watermark {
            position: absolute;
            top: 15px;
            left: 55px;
            z-index: 1000;
            background: rgba(245, 240, 232, 0.92);
            border: 1px solid rgba(32, 39, 66, 0.2);
            padding: 0.35rem 0.75rem;
            border-radius: 50rem;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--navy-blue);
            pointer-events: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        /* Style des badges d'information de ligne */
        .badge-info-item {
            background-color: var(--pure-white);
            border: 1px solid var(--border-gray);
            padding: 0.5rem 0.75rem;
            border-radius: 0.6rem;
            font-size: 0.8rem;
            text-align: center;
        }

        .badge-info-item .val {
            font-weight: 700;
            color: var(--navy-blue);
            display: block;
        }

        /* Leaflet Marker Pulsing Animation */
        .custom-pin-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: white;
            font-weight: bold;
            box-shadow: 0 3px 8px rgba(0,0,0,0.3);
            border: 2px solid white;
        }
    </style>
</head>
<body>

    <div class="container-xl">
        
        <!-- SECTION EN-TÊTE -->
        <div id="carteReseau" class="row justify-content-center text-center section-header">
            <div class="col-lg-8">
                <span class="section-badge">
                    <i class="fa-solid fa-map-location-dot me-1"></i> Transport Urbain Casablanca
                </span>
                <h1 class="section-title display-6">Carte du réseau</h1>
                <p class="text-muted fs-6 mb-0">
                    Explorez les itinéraires et stations des lignes de Bus, Tramway et Busway de Casablanca en temps réel.
                </p>
            </div>
        </div>

        <!-- SECTION CONTENU PRINCIPAL (2 COLONNES) -->
        <div class="row g-4 align-items-stretch">
            
            <!-- COLONNE GAUCHE : FORMULAIRE ET SÉLECTION (col-lg-5) -->
            <div class="col-lg-5">
                <div class="panel-card d-flex flex-column justify-content-between">
                    <div>
                        <!-- 1. Sélection du moyen de transport -->
                        <div class="mb-4">
                            <label class="form-label-custom">1. Choisissez le moyen de transport</label>
                            <div class="row g-2">
                                <!-- Bus -->
                                <div class="col-4">
                                    <div class="mode-card selected-bus" id="btn-bus" onclick="changeTransportMode('bus')">
                                        <i class="fa-solid fa-bus" style="color: var(--bus-color);"></i>
                                        <div class="mode-title">Bus</div>
                                    </div>
                                </div>
                                <!-- Tramway -->
                                <div class="col-4">
                                    <div class="mode-card" id="btn-tram" onclick="changeTransportMode('tram')">
                                        <i class="fa-solid fa-train-tram" style="color: var(--text-muted);"></i>
                                        <div class="mode-title">Tramway</div>
                                    </div>
                                </div>
                                <!-- Busway -->
                                <div class="col-4">
                                    <div class="mode-card" id="btn-busway" onclick="changeTransportMode('busway')">
                                        <i class="fa-solid fa-bus-simple" style="color: var(--text-muted);"></i>
                                        <div class="mode-title">Busway</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Sélecteur de ligne -->
                        <div class="mb-3">
                            <label for="lineSelector" class="form-label-custom">2. Choisissez votre ligne</label>
                            <select class="form-select form-select-custom" id="lineSelector" onchange="handleLineChange()">
                                <!-- Dynamique via JS -->
                            </select>
                        </div>

                        <!-- 3. Affichage du trajet -->
                        <div class="route-info-box">
                            <div class="text-muted fs-12 fw-semibold text-uppercase mb-1" style="font-size: 0.75rem;">
                                <i class="fa-solid fa-route me-1"></i> Trajet configuré
                            </div>
                            <div class="route-display" id="routeText">
                                <!-- Modifié dynamiquement -->
                                Sélectionner une ligne pour consulter son trajet
                            </div>
                        </div>

                        <!-- 4. Statistiques rapides sur la ligne -->
                        <div class="row g-2 mb-4">
                            <div class="col-4">
                                <div class="badge-info-item">
                                    <span class="text-muted" style="font-size: 0.7rem;">Arrêts</span>
                                    <span class="val" id="infoStops">-</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="badge-info-item">
                                    <span class="text-muted" style="font-size: 0.7rem;">Durée Est.</span>
                                    <span class="val" id="infoDuration">-</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="badge-info-item">
                                    <span class="text-muted" style="font-size: 0.7rem;">Fréquence</span>
                                    <span class="val" id="infoFrequency">-</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Bouton d'action principal -->
                    <button class="btn-action" id="btnDisplayOnMap" onclick="drawSelectedRoute()">
                        <i class="fa-solid fa-crosshairs me-2"></i> Afficher sur la carte
                    </button>
                </div>
            </div>

            <!-- COLONNE DROITE : CARTE INTERACTIVE LEAFLET (col-lg-7) -->
            <div class="col-lg-7">
                <div class="map-container">
                    
                    <!-- Avertissement Données Fictives -->
                    <div class="demo-watermark">
                        <i class="fa-solid fa-flask me-1"></i> Données de démonstration
                    </div>

                    <!-- Bouton Recentrer -->
                    <button class="map-btn-recenter" onclick="resetMapZoom()" title="Recentrer la vue">
                        <i class="fa-solid fa-expand"></i> Recentrer
                    </button>

                    <!-- Div Carte Leaflet -->
                    <div id="map"></div>

                    <!-- Légende Interactive -->
                    <div class="map-legend">
                        <div class="fw-bold mb-1" style="color: var(--navy-blue);">Légende du réseau</div>
                        <div class="legend-item">
                            <span class="legend-color-dot" style="background-color: var(--bus-color);"></span> Lignes Bus
                        </div>
                        <div class="legend-item">
                            <span class="legend-color-dot" style="background-color: var(--tram-color);"></span> Lignes Tramway
                        </div>
                        <div class="legend-item">
                            <span class="legend-color-dot" style="background-color: var(--busway-color);"></span> Lignes Busway
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/bootstrap.bundle.min.js"></script>
    <!-- Leaflet.js -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        /* ==========================================================================
           DONNÉES LOCALES JS (Fictives pour démonstration PFE)
           ========================================================================== */
        const networkDataset = {
            bus: [
                {
                    id: "L12",
                    name: "Ligne 12",
                    route: "Maârif → Sbata",
                    color: "#E67E22",
                    stopsCount: 6,
                    duration: "32 min",
                    frequency: "10 min",
                    stops: [
                        { name: "Maârif Extension", coords: [33.5720, -7.6350] },
                        [33.5700, -7.6250],
                        { name: "Boulevard Zerktouni", coords: [33.5750, -7.6150] },
                        { name: "Derb Sultan Central", coords: [33.5680, -7.5950] },
                        { name: "Boulevard Al Qods", coords: [33.5580, -7.5800] },
                        { name: "Terminus Sbata", coords: [33.5500, -7.5650] }
                    ]
                },
                {
                    id: "L20",
                    name: "Ligne 20",
                    route: "Gare Casa-Port → Hay Hassani",
                    color: "#E67E22",
                    stopsCount: 5,
                    duration: "40 min",
                    frequency: "12 min",
                    stops: [
                        { name: "Gare Casa-Port", coords: [33.6000, -7.6180] },
                        { name: "Place Nations Unies", coords: [33.5930, -7.6185] },
                        { name: "Bd Rachidi", coords: [33.5850, -7.6280] },
                        { name: "Place Financière Anfa", coords: [33.5650, -7.6550] },
                        { name: "Hay Hassani Terminus", coords: [33.5500, -7.6750] }
                    ]
                },
                {
                    id: "L30",
                    name: "Ligne 30",
                    route: "Sidi Bernoussi → Ain Diab",
                    color: "#E67E22",
                    stopsCount: 5,
                    duration: "50 min",
                    frequency: "15 min",
                    stops: [
                        { name: "Sidi Bernoussi", coords: [33.6150, -7.5300] },
                        { name: "Ain Sebaâ Station", coords: [33.6050, -7.5600] },
                        { name: "Belvédère", coords: [33.5950, -7.5900] },
                        { name: "Corniche Anfa", coords: [33.5900, -7.6600] },
                        { name: "Ain Diab Plage", coords: [33.5850, -7.6780] }
                    ]
                }
            ],
            tram: [
                {
                    id: "T1",
                    name: "Ligne T1",
                    route: "Sidi Moumen → Lissasfa",
                    color: "#C0392B",
                    stopsCount: 7,
                    duration: "65 min",
                    frequency: "5 min",
                    stops: [
                        { name: "Sidi Moumen", coords: [33.5850, -7.5300] },
                        { name: "Grande Mosquée", coords: [33.5890, -7.5600] },
                        { name: "Place Al Yassir", coords: [33.5910, -7.6100] },
                        { name: "Nations Unies", coords: [33.5920, -7.6180] },
                        { name: "Abdelmoumen", coords: [33.5780, -7.6280] },
                        { name: "Oasis Gare", coords: [33.5500, -7.6480] },
                        { name: "Lissasfa", coords: [33.5250, -7.6750] }
                    ]
                },
                {
                    id: "T2",
                    name: "Ligne T2",
                    route: "Sidi Bernoussi → Ain Diab",
                    color: "#C0392B",
                    stopsCount: 5,
                    duration: "55 min",
                    frequency: "6 min",
                    stops: [
                        { name: "Sidi Bernoussi T2", coords: [33.6100, -7.5250] },
                        { name: "Mdakra", coords: [33.5950, -7.5750] },
                        { name: "Derb Sultan", coords: [33.5820, -7.6120] },
                        { name: "Derb Ghallef", coords: [33.5750, -7.6400] },
                        { name: "Ain Diab Plage T2", coords: [33.5880, -7.6720] }
                    ]
                }
            ],
            busway: [
                {
                    id: "BW1",
                    name: "Ligne BW1",
                    route: "Salmia → Laymoune",
                    color: "#16A085",
                    stopsCount: 4,
                    duration: "38 min",
                    frequency: "7 min",
                    stops: [
                        { name: "Salmia Terminus", coords: [33.5600, -7.5600] },
                        { name: "Sbata Central", coords: [33.5550, -7.5900] },
                        { name: "Boulevard Al Qods", coords: [33.5480, -7.6200] },
                        { name: "Station Laymoune", coords: [33.5300, -7.6550] }
                    ]
                },
                {
                    id: "BW2",
                    name: "Ligne BW2",
                    route: "Errahma → Oulfa",
                    color: "#16A085",
                    stopsCount: 3,
                    duration: "28 min",
                    frequency: "8 min",
                    stops: [
                        { name: "Ville Nouvelle Errahma", coords: [33.5050, -7.7100] },
                        { name: "Cité Hassani", coords: [33.5250, -7.6850] },
                        { name: "Oulfa Terminus", coords: [33.5450, -7.6680] }
                    ]
                }
            ]
        };

        /* ==========================================================================
           VARIABLES D'ÉTAT & CARTE
           ========================================================================== */
        let selectedMode = 'bus';
        let map = null;
        let routePolyline = null;
        let stationMarkers = [];

        /* ==========================================================================
           INITIALISATION DE LA PAGE
           ========================================================================== */
        document.addEventListener('DOMContentLoaded', () => {
            initLeafletMap();
            populateLineSelector('bus');
        });

        // Initialisation de la carte Leaflet
        function initLeafletMap() {
            // Centre par défaut : Casablanca
            map = L.map('map', {
                zoomControl: true,
                scrollWheelZoom: true
            }).setView([33.5731, -7.5898], 12);

            // Fond de carte OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
        }

        /* ==========================================================================
           GESTION DU FORMULAIRE ET DES INTERACTIONS
           ========================================================================== */

        // Changer le moyen de transport (Bus / Tramway / Busway)
        function changeTransportMode(mode) {
            selectedMode = mode;

            // Mise à jour visuelle des boutons
            const modes = ['bus', 'tram', 'busway'];
            modes.forEach(m => {
                const btn = document.getElementById(`btn-${m}`);
                const icon = btn.querySelector('i');
                
                if (m === mode) {
                    btn.className = `mode-card selected-${m}`;
                    if (m === 'bus') icon.style.color = 'var(--bus-color)';
                    if (m === 'tram') icon.style.color = 'var(--tram-color)';
                    if (m === 'busway') icon.style.color = 'var(--busway-color)';
                } else {
                    btn.className = 'mode-card';
                    icon.style.color = 'var(--text-muted)';
                }
            });

            // Mettre à jour la liste des lignes
            populateLineSelector(mode);
        }

        // Remplir le selecteur de ligne en fonction du moyen sélectionné
        function populateLineSelector(mode) {
            const selector = document.getElementById('lineSelector');
            selector.innerHTML = '';

            const lines = networkDataset[mode] || [];
            
            lines.forEach(line => {
                const option = document.createElement('option');
                option.value = line.id;
                option.textContent = `${line.name} (${line.route})`;
                selector.appendChild(option);
            });

            handleLineChange();
        }

        // Action au changement de ligne dans le dropdown
        function handleLineChange() {
            const selectedLineId = document.getElementById('lineSelector').value;
            const lineData = getCurrentLineData(selectedLineId);

            if (lineData) {
                document.getElementById('routeText').innerHTML = `Trajet : <strong>${lineData.route}</strong>`;
                document.getElementById('infoStops').textContent = lineData.stopsCount;
                document.getElementById('infoDuration').textContent = lineData.duration;
                document.getElementById('infoFrequency').textContent = lineData.frequency;
                
                // Dessiner directement la ligne au changement
                drawSelectedRoute();
            } else {
                document.getElementById('routeText').textContent = "Sélectionnez une ligne pour consulter son trajet";
                document.getElementById('infoStops').textContent = "-";
                document.getElementById('infoDuration').textContent = "-";
                document.getElementById('infoFrequency').textContent = "-";
            }
        }

        // Helper pour récupérer l'objet de la ligne sélectionnée
        function getCurrentLineData(lineId) {
            const lines = networkDataset[selectedMode] || [];
            return lines.find(l => l.id === lineId);
        }

        /* ==========================================================================
           TRACÉ ET GESTION DE LA CARTE LEAFLET
           ========================================================================== */

        function drawSelectedRoute() {
            const selectedLineId = document.getElementById('lineSelector').value;
            const lineData = getCurrentLineData(selectedLineId);

            if (!lineData || !map) return;

            // 1. Nettoyer les tracés et marqueurs existants
            if (routePolyline) {
                map.removeLayer(routePolyline);
            }
            stationMarkers.forEach(marker => map.removeLayer(marker));
            stationMarkers = [];

            // 2. Préparer les coordonnées pour le Polyline
            const latLngs = lineData.stops.map(stop => stop.coords || stop);

            // 3. Dessiner la ligne colorée (Polyline)
            routePolyline = L.polyline(latLngs, {
                color: lineData.color,
                weight: 6,
                opacity: 0.85,
                lineCap: 'round',
                lineJoin: 'round'
            }).addTo(map);

            // 4. Ajouter les marqueurs d'arrêt
            lineData.stops.forEach((stop, index) => {
                const coords = stop.coords || stop;
                const name = stop.name || `Station ${index + 1}`;

                // Icône circulaire personnalisée
                const customIcon = L.divIcon({
                    className: 'custom-pin-wrapper',
                    html: `<div class="custom-pin-icon" style="background-color: ${lineData.color}; width: 22px; height: 22px; font-size: 11px;">${index + 1}</div>`,
                    iconSize: [22, 22],
                    iconAnchor: [11, 11]
                });

                const popupContent = `
                    <div style="font-family: sans-serif; text-align: center;">
                        <span style="font-size: 0.75rem; color: #64748B; font-weight: 600;">${lineData.name} - ${selectedMode.toUpperCase()}</span>
                        <h6 style="margin: 3px 0 0 0; color: #202742; font-weight: 700;">${name}</h6>
                    </div>
                `;

                const marker = L.marker(coords, { icon: customIcon })
                    .bindPopup(popupContent)
                    .addTo(map);

                stationMarkers.push(marker);
            });

            // 5. Ajuster automatiquement le zoom (Fit Bounds) pour englober tout le trajet
            map.fitBounds(routePolyline.getBounds(), {
                padding: [50, 50],
                maxZoom: 15
            });
        }

        // Recentrer la carte sur la vue initiale
        function resetMapZoom() {
            if (routePolyline) {
                map.fitBounds(routePolyline.getBounds(), { padding: [50, 50] });
            } else {
                map.setView([33.5731, -7.5898], 12);
            }
        }
    </script>
</body>
</html>