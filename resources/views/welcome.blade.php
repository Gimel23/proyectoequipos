<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Gestión de Equipos') }}</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <!-- Google Fonts -->
        <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet">
        <!-- Custom CSS -->
        <style>
            :root {
                --primary-color:rgb(158, 202, 231);
                --secondary-color:rgb(3, 3, 3);
                --accent-color:rgb(11, 14, 1);
                --light-color:rgb(147, 212, 228);
                --dark-color: #2c3e50;
            }
            
            body {
                font-family: 'Nunito', sans-serif;
                background: linear-gradient(135deg, var(--light-color) 0%, #bdc3c7 100%);
                color: var(--dark-color);
            }
            
            .navbar {
                background-color: var(--secondary-color);
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }
            
            .navbar-brand {
                font-weight: 800;
                color: white;
            }
            
            .nav-link {
                font-weight: 600;
                color: rgba(255,255,255,0.85) !important;
                transition: all 0.3s ease;
            }
            
            .nav-link:hover {
                color: white !important;
                transform: translateY(-2px);
            }
            
            .hero-section {
                padding: 6rem 0;
                background: linear-gradient(rgba(44, 62, 80, 0.8), rgba(44, 62, 80, 0.8)), url("/api/placeholder/1200/400") center/cover no-repeat;
                color: white;
                text-align: center;
                border-radius: 0 0 20px 20px;
                margin-bottom: 4rem;
            }
            
            .hero-section h1 {
                font-weight: 800;
                font-size: 3.5rem;
                margin-bottom: 1.5rem;
                text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            }
            
            .hero-section p {
                font-size: 1.25rem;
                max-width: 800px;
                margin: 0 auto;
                opacity: 0.9;
            }
            
            .feature-card {
                background: white;
                border-radius: 15px;
                overflow: hidden;
                box-shadow: 0 10px 30px rgba(0,0,0,0.1);
                transition: all 0.3s ease;
                height: 100%;
            }
            
            .feature-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 15px 35px rgba(0,0,0,0.15);
            }
            
            .feature-icon {
                font-size: 2.5rem;
                color: var(--primary-color);
                margin-bottom: 1rem;
            }
            
            .feature-card h3 {
                color: var(--secondary-color);
                font-weight: 700;
                margin-bottom: 1rem;
            }
            
            .feature-card p {
                color: #6c757d;
            }
            
            .card-header-custom {
                background-color: var(--primary-color);
                color: white;
                padding: 1.5rem;
                text-align: center;
            }
            
            .cta-section {
                background-color: var(--primary-color);
                padding: 4rem 0;
                color: white;
                margin: 4rem 0;
                border-radius: 15px;
            }
            
            .btn-primary {
                background-color: var(--accent-color);
                border-color: var(--accent-color);
                font-weight: 600;
                padding: 0.75rem 2rem;
                border-radius: 30px;
                transition: all 0.3s ease;
            }
            
            .btn-primary:hover {
                background-color: #c0392b;
                border-color: #c0392b;
                transform: scale(1.05);
            }
            
            .btn-outline-light {
                font-weight: 600;
                padding: 0.75rem 2rem;
                border-radius: 30px;
                transition: all 0.3s ease;
            }
            
            .btn-outline-light:hover {
                transform: scale(1.05);
            }
            
            footer {
                background-color: var(--secondary-color);
                color: white;
                padding: 2rem 0;
                margin-top: 4rem;
            }
            
            .social-icon {
                font-size: 1.5rem;
                margin: 0 10px;
                color: white;
                transition: all 0.3s ease;
            }
            
            .social-icon:hover {
                color: var(--accent-color);
                transform: translateY(-5px);
            }
        </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <i class="fas fa-futbol me-2"></i>
                    Gestión de Equipos y Jugadores
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-1"></i> Panel de Control
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-1"></i> Iniciar Sesión
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus me-1"></i> Registrarse
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <h1>Gestión de Equipos Deportivos</h1>
                <p class="lead">La plataforma perfecta para administrar tus equipos y jugadores de manera eficiente y profesional</p>
                <div class="mt-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-tachometer-alt me-2"></i> Ir al Panel
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-2">
                            <i class="fas fa-user-plus me-2"></i> Registrarse
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i> Iniciar Sesión
                        </a>
                    @endauth
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="container mb-5">
            <h2 class="text-center mb-5 fw-bold">Nuestras Características</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card p-4">
                        <div class="card-header-custom">
                            <i class="fas fa-users feature-icon"></i>
                            <h3>Gestión de Equipos</h3>
                        </div>
                        <div class="p-4">
                            <p>Crea, edita y administra tus equipos deportivos de manera sencilla. Organiza toda la información relevante en un solo lugar.</p>
                            <a href="#" class="btn btn-primary mt-3">Más información</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4">
                        <div class="card-header-custom">
                            <i class="fas fa-running feature-icon"></i>
                            <h3>Jugadores</h3>
                        </div>
                        <div class="p-4">
                            <p>Administra los jugadores de cada equipo, con información detallada, estadísticas y seguimiento de rendimiento.</p>
                            <a href="#" class="btn btn-primary mt-3">Más información</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4">
                        <div class="card-header-custom">
                            <i class="fas fa-trophy feature-icon"></i>
                            <h3>Estadísticas</h3>
                        </div>
                        <div class="p-4">
                            <p>Visualiza estadísticas detalladas de rendimiento de equipos y jugadores. Analiza datos para mejorar resultados.</p>
                            <a href="#" class="btn btn-primary mt-3">Más información</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="container text-center">
                <h2 class="fw-bold mb-4">¿Estás listo para empezar?</h2>
                <p class="lead mb-4">Regístrate ahora y comienza a gestionar tus equipos deportivos como un profesional</p>
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-rocket me-2"></i> Comenzar ahora
                </a>
            </div>
        </section>


        <!-- Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    </body>
</html>