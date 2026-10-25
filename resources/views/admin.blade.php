<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration du Transport Urbain</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
 <style>
        /* ==========================================================================
            VARIABLES DE DESIGN ET PALETTE DE COULEURS NOIR & BLANC (MONOCHROME)
            ========================================================================== */
        :root {
            /* Fonds épurés blanc / gris clair */
            --bg-main: #f8fafc;
            --bg-sidebar: #ffffff;
            --bg-card: #ffffff;
            --bg-card-hover: #f1f5f9;
            --bg-input: #f8fafc;
            --border-color: #e2e8f0;
            --border-focus: #0f172a;

            /* Palette monochrome (Noir, Blanc, Gris) */
            --primary-cobalt: #0f172a;
            --primary-light: #334155;
            --emerald-green: #0f172a;
            --emerald-dark: #000000;
            --accent-amber: #475569;
            --accent-amber-hover: #1e293b;
            --rose-danger: #334155;
            --cyan-accent: #64748b;

            /* Typographie */
            --font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            --text-main: #334155;
            --text-muted: #64748b;
            --text-bright: #0f172a;
            
            --shadow-subtle: 0 4px 20px rgba(0, 0, 0, 0.04);
            --shadow-card: 0 10px 30px rgba(0, 0, 0, 0.08);
            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 20px;
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ==========================================================================
            RESET ET STYLES DE BASE
            ========================================================================== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: var(--font-family);
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-main);
            height: 100vh;
            overflow: hidden;
            display: flex;
        }

        /* Scrollbar personnalisé */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--bg-sidebar);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--text-muted);
        }

        /* ==========================================================================
            STRUCTURE DE L'APPLICATION (LAYOUT)
            ========================================================================== */
        #app-layout {
            display: flex;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
        }

        /* --- BARRE SIDEBAR DE NAVIGATION --- */
        #sidebar {
            width: 280px;
            background-color: var(--bg-sidebar);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: var(--transition);
            z-index: 40;
            flex-shrink: 0;
        }

        .brand-header {
            padding: 22px 24px;
            display: flex;
            align-items: center;
            gap: 14px;
            border-bottom: 1px solid var(--border-color);
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.04), transparent);
        }

        .brand-logo {
            width: 46px;
            height: 46px;
            border-radius: var(--radius-sm);
            background: linear-gradient(135deg, #000000, #333333);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .brand-title h1 {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-bright);
            letter-spacing: 0.5px;
        }

        .brand-title span {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .nav-menu {
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            flex-grow: 1;
        }

        .nav-section-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--text-muted);
            letter-spacing: 1.2px;
            padding: 0 12px 8px 12px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 18px;
            border-radius: var(--radius-md);
            color: var(--text-muted);
            background: transparent;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-align: left;
            width: 100%;
            transition: var(--transition);
        }

        .nav-item i {
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        .nav-item:hover {
            background-color: var(--bg-card-hover);
            color: var(--text-bright);
        }

        .nav-item.active {
            background: linear-gradient(90deg, rgba(0, 0, 0, 0.06), rgba(0, 0, 0, 0.01));
            border-left: 4px solid #000000;
            color: var(--text-bright);
        }

        /* Profile Footer */
        .sidebar-footer {
            padding: 18px;
            border-top: 1px solid var(--border-color);
            background-color: rgba(255, 255, 255, 0.8);
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, #000000, #4b5563);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #ffffff;
            border: 2px solid var(--border-color);
        }

        .admin-info p {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--text-bright);
        }

        .admin-info span {
            display: inline-block;
            font-size: 10.5px;
            background: rgba(0, 0, 0, 0.05);
            color: var(--text-bright);
            padding: 2px 8px;
            border-radius: 10px;
            font-weight: 600;
            border: 1px solid rgba(0, 0, 0, 0.1);
            margin-top: 2px;
        }

        /* --- CONTENU PRINCIPAL --- */
        #main-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background-color: var(--bg-main);
        }

        /* Header Supérieur */
        header {
            height: 75px;
            border-bottom: 1px solid var(--border-color);
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            flex-shrink: 0;
        }

        .header-title-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-bright);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .network-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border-radius: 20px;
            background-color: rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.1);
            color: var(--text-bright);
            font-size: 12px;
            font-weight: 600;
        }

        .pulse-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #000000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            animation: pulse 1.8s infinite;
        }

        @keyframes pulse {
            0% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(1.2); }
            100% { opacity: 1; transform: scale(1); }
        }
        /* Bouton Déconnexion Header */
        .btn-logout {
            text-decoration: none;
            background: rgba(0, 0, 0, 0.04);
            color: #000000;
            border: 1px solid rgba(0, 0, 0, 0.15);
            padding: 9px 16px;
            border-radius: var(--radius-sm);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .btn-logout:hover {
            background: #000000;
            color: #ffffff;
            border-color: #000000;
            transform: translateY(-2px);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.2);
        }

        /* Modal Overlay pour réauthentification */
        .logout-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            z-index: 300;
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 24px;
        }

        .logout-screen.show {
            display: flex;
            animation: fadeIn 0.3s ease;
        }

        .logout-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 40px;
            max-width: 420px;
            width: 100%;
            box-shadow: var(--shadow-card);
        }

        .logout-card .avatar-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: linear-gradient(135deg, #000000, #4b5563);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #ffffff;
            margin: 0 auto 20px auto;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        /* Corps du contenu */
        .content-body {
            flex-grow: 1;
            overflow-y: auto;
            padding: 30px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .tab-view {
            display: none;
            flex-direction: column;
            gap: 24px;
            animation: fadeIn 0.3s ease-in-out;
        }

        .tab-view.active-view {
            display: flex;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ==========================================================================
            BARRES D'ACTIONS ET FILTRES
            ========================================================================== */
        .toolbar-box {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 18px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            box-shadow: var(--shadow-subtle);
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .input-search-wrapper {
            position: relative;
            width: 280px;
        }

        .input-search-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 14px;
        }

        .form-control {
            background-color: var(--bg-input);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            padding: 10px 14px 10px 40px;
            border-radius: var(--radius-sm);
            font-size: 13.5px;
            width: 100%;
            outline: none;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: #000000;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.08);
        }

        .select-control {
            background-color: var(--bg-input);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            padding: 10px 16px;
            border-radius: var(--radius-sm);
            font-size: 13.5px;
            outline: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .select-control:focus {
            border-color: #000000;
        }

        /* Boutons */
        .btn {
            padding: 10px 20px;
            border-radius: var(--radius-sm);
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
        }

        .btn-emerald {
            background-color: #000000;
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
        }
        .btn-emerald:hover { 
            background-color: #334155; 
            transform: translateY(-2px);
        }

        .btn-amber {
            background-color: #e2e8f0;
            color: #0f172a;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
        }
        .btn-amber:hover { 
            background-color: #cbd5e1; 
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: var(--bg-main);
            color: var(--text-main);
            border: 1px solid var(--border-color);
        }
        .btn-secondary:hover { background-color: var(--bg-card-hover); }

        /* ==========================================================================
            TABLEAUX STYLISÉS (CRUD)
            ========================================================================== */
        .table-responsive {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            overflow-x: auto;
            box-shadow: var(--shadow-subtle);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 13.5px;
        }

        .data-table th {
            background-color: #f1f5f9;
            color: var(--text-muted);
            padding: 16px 20px;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 11.5px;
            letter-spacing: 0.8px;
            border-bottom: 1px solid var(--border-color);
        }

        .data-table td {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-main);
            vertical-align: middle;
        }

        .data-table tbody tr {
            transition: var(--transition);
        }

        .data-table tbody tr:hover {
            background-color: var(--bg-card-hover);
        }

        .status-pill {
            padding: 5px 12px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            display: inline-block;
        }

        .status-pill.fluid { background: rgba(0, 0, 0, 0.06); color: #000000; border: 1px solid rgba(0, 0, 0, 0.15); }
        .status-pill.delay { background: rgba(0, 0, 0, 0.03); color: #475569; border: 1px dashed #64748b; }
        .status-pill.alert { background: #000000; color: #ffffff; border: 1px solid #000000; }

        .type-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 12px;
            background-color: rgba(0, 0, 0, 0.04);
            color: var(--text-bright);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .action-btns {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }

        .btn-icon {
            width: 34px;
            height: 34px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border-color);
            background-color: var(--bg-main);
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-icon:hover {
            color: #ffffff;
            background-color: #000000;
            border-color: #000000;
        }

        .btn-icon.delete:hover {
            background-color: #334155;
            border-color: #334155;
        }

        /* ==========================================================================
            MODALES DE FORMULAIRE
            ========================================================================== */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(8px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 100;
        }

        .modal-backdrop.show { display: flex; }

        .modal-box {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            width: 100%;
            max-width: 540px;
            padding: 28px;
            box-shadow: var(--shadow-card);
            animation: modalPop 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes modalPop {
            from { transform: scale(0.92); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 16px;
            margin-bottom: 20px;
        }

        .modal-header h3 {
            font-size: 17px;
            color: var(--text-bright);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-group-full { grid-column: span 2; }

        .form-label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
            border-top: 1px solid var(--border-color);
            padding-top: 18px;
        }

        /* --- TOAST NOTIFICATIONS --- */
        #toast-container {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 200;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .toast {
            background-color: var(--bg-card);
            border-left: 4px solid #000000;
            color: var(--text-bright);
            padding: 14px 22px;
            border-radius: var(--radius-sm);
            box-shadow: var(--shadow-card);
            font-size: 13.5px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>
<body>

    <!-- SYSTEME TOAST DE NOTIFICATION -->
    <div id="toast-container"></div>

    <div id="app-layout">
        
        <!-- SIDEBAR -->
        <aside id="sidebar">
            <div>
                <div class="brand-header">
                    <div class="brand-logo">
                        <i class="fa-solid fa-bus-simple"></i>
                    </div>
                    <div class="brand-title">
                        <h1>CasaTransport</h1>
                    </div>
                </div>

                <nav class="nav-menu">
                    <div class="nav-section-label">Modules d'Administration</div>

                    <button class="nav-item active" onclick="switchTab('transport')" id="nav-transport">
                        <i class="fa-solid fa-bus-simple" style="color: var(--emerald-green);"></i>
                        <span>Moyens de Transport</span>
                    </button>

                    <button class="nav-item" onclick="switchTab('users')" id="nav-users">
                        <i class="fa-solid fa-users-gear" style="color: var(--accent-amber);"></i>
                        <span>Gestion Utilisateurs</span>
                    </button>
                </nav>
            </div>

            <div class="sidebar-footer">
                <div class="admin-profile">
                    <div class="avatar">KA</div>
                    <div class="admin-info">
                        <p>Yahya Laghchaoui</p>
                        <span>Super Administrateur</span>
                    </div>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT CONTAINER -->
        <main id="main-content">
            
            <!-- TOP HEADER BAR -->
            <header>
                <div class="header-title-container">
                    <div class="header-title" id="page-header-title">
                        <i class="fa-solid fa-bus-simple" style="color: var(--emerald-green);"></i> Gestion des Moyens de Transport
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 20px;">
                    <!-- Bouton Déconnexion -->
                    <a href="{{route('adminLogin')}}" class="btn-logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Se déconnecter</span>
                    </a>
                </div>
            </header>

            <!-- VUES PRINCIPALES -->
            <div class="content-body">

                <!-- 1. GERER LES MOYENS DE TRANSPORT (CRUD) -->
                <section id="view-transport" class="tab-view active-view">
                    
                    <div class="toolbar-box">
                        <div class="filter-group">
                            <div class="input-search-wrapper">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <input type="text" id="transport-search" class="form-control" placeholder="Rechercher code, matricule, ligne..." oninput="renderTransportTable()">
                            </div>
                            <select id="transport-filter-type" class="select-control" onchange="renderTransportTable()">
                                <option value="">Tous les types</option>
                                <option value="Tramway">Tramway</option>
                                <option value="Busway">Busway</option>
                                <option value="Casabus">bus</option>
                            </select>
                            <select id="transport-filter-status" class="select-control" onchange="renderTransportTable()">
                                <option value="">Tous les états</option>
                                <option value="En service">En service</option>
                                <option value="En maintenance">En maintenance</option>
                                <option value="Hors service">Hors service</option>
                            </select>
                        </div>
                        <button class="btn btn-emerald" onclick="openTransportModal()">
                            <i class="fa-solid fa-plus"></i> Ajouter un Véhicule
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Code / Matricule</th>
                                    <th>Type</th>
                                    <th>Ligne / Zone</th>
                                    <th>Capacité</th>
                                    <th>Localisation</th>
                                    <th>État de Service</th>
                                    <th style="text-align: right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="transport-table-body">
                                <!-- Généré dynamiquement par JS -->
                            </tbody>
                        </table>
                    </div>

                </section>

                <!-- 2. GERER LES UTILISATEURS (CRUD) -->
                <section id="view-users" class="tab-view">
                    
                    <div class="toolbar-box">
                        <div class="filter-group">
                            <div class="input-search-wrapper">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <input type="text" id="user-search" class="form-control" placeholder="Rechercher un agent par nom, email..." oninput="renderUsersTable()">
                            </div>
                            <select id="user-filter-role" class="select-control" onchange="renderUsersTable()">
                                <option value="">Tous les rôles</option>
                                <option value="Chauffeur">Chauffeur</option>
                                <option value="Responsable-transport">Responsable de transport</option>
                                <option value="Administrateur">Administrateur</option>
                            </select>
                            <select id="user-filter-status" class="select-control" onchange="renderUsersTable()">
                                <option value="">Tous les statuts</option>
                                <option value="Actif">Actif</option>
                                <option value="Inactif">Inactif</option>
                                <option value="Suspendu">Suspendu</option>
                            </select>
                        </div>
                        <button class="btn btn-amber" onclick="openUserModal()">
                            <i class="fa-solid fa-user-plus"></i> Ajouter un Utilisateur
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Agent / Utilisateur</th>
                                    <th>Rôle</th>
                                    <th>Identifiant Matricule</th>
                                    <th>Statut Compte</th>
                                    <th>Dernière Activité</th>
                                    <th style="text-align: right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="users-table-body">
                                <!-- Généré dynamiquement par JS -->
                            </tbody>
                        </table>
                    </div>

                </section>

            </div>
        </main>
    </div>

    <!-- ==========================================================================
       MODALES POUR MOYENS DE TRANSPORT ET UTILISATEURS
       ========================================================================== -->

    <!-- MODALE MOYENS DE TRANSPORT -->
    <div class="modal-backdrop" id="modal-transport">
        <div class="modal-box">
            <div class="modal-header">
                <h3 id="modal-transport-title">Ajouter un Véhicule</h3>
                <button class="btn-icon" onclick="closeModal('modal-transport')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form id="form-transport" onsubmit="handleTransportSubmit(event)">
                <input type="hidden" id="trans-id">
                <div class="form-grid">
                    <div>
                        <label class="form-label">Code / Matricule</label>
                        <input type="text" id="trans-code" class="form-control" placeholder="ex: TRAM-T1-112" required style="padding-left: 12px;">
                    </div>
                    <div>
                        <label class="form-label">Type de Véhicule</label>
                        <select id="trans-type" class="select-control" style="width: 100%;">
                            <option value="Tramway">Tramway</option>
                            <option value="Busway">Busway</option>
                            <option value="Casabus">Bus</option>
                        </select>
                    </div>
                    <div class="form-group-full">
                        <label class="form-label">Ligne / Zone Assignée</label>
                        <input type="text" id="trans-line" class="form-control" placeholder="ex: Ligne T1 Sidi Moumen - Lissasfa" required style="padding-left: 12px;">
                    </div>
                    <div>
                        <label class="form-label">Capacité (Passagers)</label>
                        <input type="number" id="trans-capacity" class="form-control" placeholder="ex: 600" required style="padding-left: 12px;">
                    </div>
                    <div>
                        <label class="form-label">Localisation Actuelle</label>
                        <input type="text" id="trans-pos" class="form-control" placeholder="ex: Bd Hassan II" required style="padding-left: 12px;">
                    </div>
                    <div class="form-group-full">
                        <label class="form-label">État de Service</label>
                        <select id="trans-status" class="select-control" style="width: 100%;">
                            <option value="En service">En service</option>
                            <option value="En maintenance">En maintenance</option>
                            <option value="Hors service">Hors service</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modal-transport')">Annuler</button>
                    <button type="submit" class="btn btn-emerald">Enregistrer le Véhicule</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODALE UTILISATEUR -->
    <div class="modal-backdrop" id="modal-user">
        <div class="modal-box">
            <div class="modal-header">
                <h3 id="modal-user-title">Ajouter un Agent</h3>
                <button class="btn-icon" onclick="closeModal('modal-user')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form id="form-user" onsubmit="handleUserSubmit(event)">
                <input type="hidden" id="user-id">
                <div class="form-grid">
                    <div class="form-group-full">
                        <label class="form-label">Nom et Prénom de l'Agent</label>
                        <input type="text" id="user-name" class="form-control" placeholder="ex: Youssef Mansouri" required style="padding-left: 12px;">
                    </div>
                    <div>
                        <label class="form-label">Adresse Email</label>
                        <input type="email" id="user-email" class="form-control" placeholder="y.mansouri@casatransport.ma" required style="padding-left: 12px;">
                    </div>
                    <div>
                        <label class="form-label">Rôle Système</label>
                        <select id="user-role" class="select-control" style="width: 100%;">
                            <option value="Chauffeur">Chauffeur</option>
                            <option value="Responsable-transport">Responsable de transport</option>
                            <option value="Administrateur">Administrateur</option>
                        </select>
                    </div>
                    <div class="form-group-full">
                        <label class="form-label">Statut du Compte</label>
                        <select id="user-status" class="select-control" style="width: 100%;">
                            <option value="Actif">Actif</option>
                            <option value="Inactif">Inactif</option>
                            <option value="Suspendu">Suspendu</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modal-user')">Annuler</button>
                    <button type="submit" class="btn btn-amber">Enregistrer l'Agent</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==========================================================================
       LOGIQUE JAVASCRIPT ET GESTION DE L'ETAT
       ========================================================================== -->
    <script>
        // --- NAVIGATION PAR ONGLETS ---
        function switchTab(tabId) {
            document.querySelectorAll('.tab-view').forEach(view => view.classList.remove('active-view'));
            document.querySelectorAll('.nav-item').forEach(btn => btn.classList.remove('active'));

            document.getElementById(`view-${tabId}`).classList.add('active-view');
            const activeBtn = document.getElementById(`nav-${tabId}`);
            if (activeBtn) activeBtn.classList.add('active');

            const headers = {
                'transport': '<i class="fa-solid fa-bus-simple" style="color: var(--emerald-green);"></i> Gestion des Moyens de Transport',
                'users': '<i class="fa-solid fa-users-gear" style="color: var(--accent-amber);"></i> Gestion des Utilisateurs et Agents'
            };
            document.getElementById('page-header-title').innerHTML = headers[tabId];
        }

        // --- GESTION DU MOYEN DE TRANSPORT (CRUD) ---
        function renderTransportTable() {
            const tbody = document.getElementById('transport-table-body');
            const search = document.getElementById('transport-search').value.toLowerCase();
            const filterType = document.getElementById('transport-filter-type').value;
            const filterStatus = document.getElementById('transport-filter-status').value;

            tbody.innerHTML = '';

            const filtered = transportData.filter(item => {
                const matchSearch = item.code.toLowerCase().includes(search) || item.line.toLowerCase().includes(search);
                const matchType = filterType === '' || item.type === filterType;
                const matchStatus = filterStatus === '' || item.status === filterStatus;
                return matchSearch && matchType && matchStatus;
            });

            filtered.forEach(item => {
                let badgeClass = 'fluid';
                if (item.status === 'En maintenance') badgeClass = 'delay';
                if (item.status === 'Hors service') badgeClass = 'alert';

                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td><strong>${item.code}</strong></td>
                    <td><span class="type-badge"><i class="fa-solid fa-circle-dot"></i> ${item.type}</span></td>
                    <td>${item.line}</td>
                    <td>${item.capacity} passagers</td>
                    <td><i class="fa-solid fa-location-dot" style="color: var(--primary-light);"></i> ${item.pos}</td>
                    <td><span class="status-pill ${badgeClass}">${item.status}</span></td>
                    <td>
                        <div class="action-btns">
                            <button class="btn-icon" onclick="editTransport(${item.id})" title="Modifier"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="btn-icon delete" onclick="deleteTransport(${item.id})" title="Supprimer"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        function openTransportModal(id = null) {
            document.getElementById('form-transport').reset();
            document.getElementById('trans-id').value = '';

            if (id) {
                const item = transportData.find(t => t.id === id);
                if (item) {
                    document.getElementById('trans-id').value = item.id;
                    document.getElementById('trans-code').value = item.code;
                    document.getElementById('trans-type').value = item.type;
                    document.getElementById('trans-line').value = item.line;
                    document.getElementById('trans-capacity').value = item.capacity;
                    document.getElementById('trans-pos').value = item.pos;
                    document.getElementById('trans-status').value = item.status;
                    document.getElementById('modal-transport-title').innerText = "Modifier le Véhicule";
                }
            } else {
                document.getElementById('modal-transport-title').innerText = "Ajouter un Véhicule";
            }
            document.getElementById('modal-transport').classList.add('show');
        }

        function handleTransportSubmit(e) {
            e.preventDefault();
            const id = document.getElementById('trans-id').value;
            const code = document.getElementById('trans-code').value;
            const type = document.getElementById('trans-type').value;
            const line = document.getElementById('trans-line').value;
            const capacity = document.getElementById('trans-capacity').value;
            const pos = document.getElementById('trans-pos').value;
            const status = document.getElementById('trans-status').value;

            if (id) {
                const idx = transportData.findIndex(t => t.id == id);
                if (idx !== -1) {
                    transportData[idx] = { id: parseInt(id), code, type, line, capacity, pos, status };
                    showToast('Véhicule mis à jour avec succès !');
                }
            } else {
                const newObj = { id: Date.now(), code, type, line, capacity, pos, status };
                transportData.push(newObj);
                showToast('Nouveau véhicule enregistré dans le réseau !');
            }

            closeModal('modal-transport');
            renderTransportTable();
        }

        function editTransport(id) { openTransportModal(id); }

        function deleteTransport(id) {
            if (confirm("Voulez-vous supprimer ce véhicule de la flotte ?")) {
                transportData = transportData.filter(t => t.id !== id);
                renderTransportTable();
                showToast('Véhicule retiré du système.');
            }
        }

        // --- GESTION DES UTILISATEURS (CRUD) ---
        function renderUsersTable() {
            const tbody = document.getElementById('users-table-body');
            const search = document.getElementById('user-search').value.toLowerCase();
            const filterRole = document.getElementById('user-filter-role').value;
            const filterStatus = document.getElementById('user-filter-status').value;

            tbody.innerHTML = '';

            const filtered = usersData.filter(user => {
                const matchSearch = user.name.toLowerCase().includes(search) || user.email.toLowerCase().includes(search);
                const matchRole = filterRole === '' || user.role === filterRole;
                const matchStatus = filterStatus === '' || user.status === filterStatus;
                return matchSearch && matchRole && matchStatus;
            });

            filtered.forEach(user => {
                let statusClass = 'fluid';
                if (user.status === 'Inactif') statusClass = 'delay';
                if (user.status === 'Suspendu') statusClass = 'alert';

                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>
                        <div style="font-weight: 700; color: var(--text-bright);">${user.name}</div>
                        <div style="font-size: 11.5px; color: var(--text-muted);">${user.email}</div>
                    </td>
                    <td><span style="background: rgba(255,255,255,0.06); padding: 5px 10px; border-radius: 6px; font-weight: 600; font-size: 12px;">${user.role}</span></td>
                    <td><code>${user.code}</code></td>
                    <td><span class="status-pill ${statusClass}">${user.status}</span></td>
                    <td><span style="color: var(--text-muted); font-size: 12.5px;">${user.lastLogin}</span></td>
                    <td>
                        <div class="action-btns">
                            <button class="btn-icon" onclick="toggleUserStatus(${user.id})" title="Changer le statut"><i class="fa-solid fa-rotate"></i></button>
                            <button class="btn-icon" onclick="editUser(${user.id})" title="Modifier"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="btn-icon delete" onclick="deleteUser(${user.id})" title="Supprimer"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        function openUserModal(id = null) {
            document.getElementById('form-user').reset();
            document.getElementById('user-id').value = '';

            if (id) {
                const user = usersData.find(u => u.id === id);
                if (user) {
                    document.getElementById('user-id').value = user.id;
                    document.getElementById('user-name').value = user.name;
                    document.getElementById('user-email').value = user.email;
                    document.getElementById('user-role').value = user.role;
                    document.getElementById('user-status').value = user.status;
                    document.getElementById('modal-user-title').innerText = "Modifier l'Agent";
                }
            } else {
                document.getElementById('modal-user-title').innerText = "Ajouter un Agent";
            }
            document.getElementById('modal-user').classList.add('show');
        }

        function handleUserSubmit(e) {
            e.preventDefault();
            const id = document.getElementById('user-id').value;
            const name = document.getElementById('user-name').value;
            const email = document.getElementById('user-email').value;
            const role = document.getElementById('user-role').value;
            const status = document.getElementById('user-status').value;

            if (id) {
                const idx = usersData.findIndex(u => u.id == id);
                if (idx !== -1) {
                    usersData[idx] = { ...usersData[idx], name, email, role, status };
                    showToast('Fiche utilisateur mise à jour !');
                }
            } else {
                const newObj = {
                    id: Date.now(),
                    name, email, role, status,
                    code: 'EMP-' + Math.floor(100 + Math.random() * 900),
                    lastLogin: 'Jamais'
                };
                usersData.push(newObj);
                showToast('Nouveau compte agent créé !');
            }

            closeModal('modal-user');
            renderUsersTable();
        }

        function toggleUserStatus(id) {
            const u = usersData.find(x => x.id === id);
            if (u) {
                const states = ['Actif', 'Inactif', 'Suspendu'];
                const nextState = states[(states.indexOf(u.status) + 1) % states.length];
                u.status = nextState;
                renderUsersTable();
                showToast(`Statut de l'agent changé pour : "${u.status}"`);
            }
        }

        function editUser(id) { openUserModal(id); }

        function deleteUser(id) {
            if (confirm("Voulez-vous supprimer cet agent ?")) {
                usersData = usersData.filter(u => u.id !== id);
                renderUsersTable();
                showToast('Agent supprimé de la base.');
            }
        }

        // --- DECONNEXION & RECONNEXION ---
        function handleLogout() {
            showToast('Déconnexion réussie. À bientôt !');
            setTimeout(() => {
                document.getElementById('logout-screen').classList.add('show');
            }, 500);
        }

        function handleReconnect() {
            document.getElementById('logout-screen').classList.remove('show');
            showToast('Reconnexion réussie ! Bienvenue Karim Alami.');
        }

        // --- FONCTIONS UTILITAIRES ---
        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('show');
        }

        function showToast(message) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = 'toast';
            toast.innerHTML = `<i class="fa-solid fa-circle-check" style="color: var(--emerald-green); font-size: 18px;"></i> <span>${message}</span>`;
            container.appendChild(toast);

            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transition = '0.3s';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // --- INITIALISATION AU CHARGEMENT ---
        window.onload = function() {
            renderTransportTable();
            renderUsersTable();
        };
    </script>
</body>
</html>