<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center bg-light rounded p-4 shadow-sm">
            <h2 class="h4 mb-0 fw-bold text-primary">
                <i class="bi bi-speedometer2 me-2"></i>Panel de control
            </h2>
            <a href="{{ route('equipos.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle me-1"></i> Nuevo equipo
            </a>
        </div>
    </x-slot>

    <div class="container py-5">
        {{-- Estadísticas principales --}}
        <div class="row justify-content-center g-4 mb-5">
            <div class="col-md-4 mx-auto">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body text-center">
                        <i class="bi bi-people-fill fs-1 text-primary mb-3"></i>
                        <h5 class="card-title text-muted">Total de Equipos</h5>
                        <h2 class="fw-bold">{{ $equipos->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mx-auto">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body text-center">
                        <i class="bi bi-person-fill fs-1 text-success mb-3"></i>
                        <h5 class="card-title text-muted">Jugadores Registrados</h5>
                        <h2 class="fw-bold">{{ $equipos->sum(fn($e) => $e->jugadores->count()) }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Mis equipos --}}
        <div class="card shadow-sm border-0 rounded-4 mb-5">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-trophy me-2"></i> Mis equipos</h4>
                <a href="{{ route('equipos.index') }}" class="btn btn-light btn-sm">Ver todos</a>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    @forelse($equipos as $equipo)
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm hover-shadow">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title mb-2">{{ $equipo->nombre }}</h5>
                                    @if($equipo->descripcion)
                                        <p class="text-muted small flex-grow-1">
                                            {{ Str::limit($equipo->descripcion, 80, '...') }}
                                        </p>
                                    @endif
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <span class="badge bg-light text-dark">
                                            {{ $equipo->jugadores->count() }} 
                                            {{ Str::plural('jugador', $equipo->jugadores->count()) }}
                                        </span>
                                        <div class="btn-group">
                                            <a href="{{ route('equipos.show', $equipo) }}" 
                                               class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-eye"></i> Detalles
                                            </a>
                                            <a href="{{ route('jugadores.index', $equipo) }}" 
                                               class="btn btn-outline-success btn-sm">
                                                <i class="bi bi-people"></i> Jugadores
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted py-5">
                            <i class="bi bi-emoji-smile display-1 mb-3"></i>
                            <p>No tienes equipos registrados aún.</p>
                            <a href="{{ route('equipos.create') }}" class="btn btn-primary mt-3">
                                <i class="bi bi-plus-circle me-1"></i> Crear equipo
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Acciones rápidas --}}
        @if($equipos->isNotEmpty())
            <div class="d-flex flex-column flex-md-row gap-3">
                <a href="{{ route('jugadores.index', $equipos->first()) }}" 
                   class="btn btn-success flex-fill">
                    <i class="bi bi-people me-2"></i>Gestionar jugadores
                </a>
                <a href="{{ route('equipos.create') }}" class="btn btn-primary flex-fill">
                    <i class="bi bi-plus-lg me-2"></i>Nuevo equipo
                </a>
            </div>
        @endif
    </div>

    {{-- Estilos personalizados --}}
    <style>
        .hover-shadow:hover {
            box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important;
            transform: translateY(-3px);
            transition: all 0.3s ease;
        }
    </style>

    {{-- Bootstrap y Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>