<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - CasaMobilité</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts & FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
    --black: #000000;
    --gray-dark: #1a1a1a;
    --gray-light: #f4f4f4;
    --gray-border: #e0e0e0;
    --white: #FFFFFF;
}

body {
    font-family: 'Inter', sans-serif;
    background-color: var(--gray-light);
    color: var(--black);
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.login-card {
    border: 1px solid var(--gray-border);
    border-radius: 1.5rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    background-color: var(--white);
    overflow: hidden;
    width: 100%;
    max-width: 450px;
    padding: 2.5rem;
}

.brand-icon {
    width: 60px;
    height: 60px;
    background-color: var(--black);
    color: var(--white);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin: 0 auto 1.5rem auto;
    font-size: 1.5rem;
}

.btn-navy {
    background-color: var(--black);
    color: var(--white);
    border-radius: 50rem;
    padding: 0.75rem;
    font-weight: 600;
    transition: background-color 0.2s, color 0.2s;
    border: 1px solid var(--black);
}

.btn-navy:hover {
    background-color: var(--gray-dark);
    color: var(--white);
}

.form-control {
    border-radius: 50rem;
    padding: 0.75rem 1.25rem;
    background-color: var(--gray-light);
    border: 1px solid var(--gray-border);
    color: var(--black);
}

.form-control:focus {
    box-shadow: none;
    border-color: var(--black);
    background-color: var(--white);
}

.form-label {
    font-weight: 500;
    font-size: 0.9rem;
    margin-left: 0.5rem;
    color: var(--black);
}
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="login-card">
                    
                    <!-- En-tête / Logo -->
                    <div class="text-center">
                        <div class="brand-icon">
                            <i class="fa-solid fa-bus-simple"></i>
                        </div>
                        <h2 class="h4 fw-bold mb-1">Connexion</h2>
                        <p class="text-muted small mb-4">Accédez à votre espace CasaMobilité</p>
                    </div>

                    <!-- Formulaire de Connexion -->
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <div class="input-group">
                                <input type="email" class="form-control" id="email" placeholder="nom@exemple.com" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Mot de passe</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4 small px-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label text-muted" for="remember">Se souvenir de moi</label>
                            </div>
                            <a href="#" class="text-decoration-none text-navy fw-semibold">Mot de passe oublié ?</a>
                        </div>

                        <button type="submit" class="btn btn-navy w-100 mb-3">
                            Se connecter
                        </button>

                        <div class="text-center">
                            <a href="{{url('/')}}" class="text-decoration-none small text-muted">
                                <i class="fa-solid fa-arrow-left me-1"></i> Retour à l'accueil
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>