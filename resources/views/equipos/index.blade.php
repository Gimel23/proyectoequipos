<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fs-4 fw-semibold text-dark mb-0">
                <i class="bi bi-people-fill me-2"></i>{{ __('Mis Equipos') }}
            </h2>
            <a href="{{ route('equipos.create') }}" class="btn btn-success btn-sm">
                <i class="bi bi-plus-lg me-1"></i>Crear nuevo equipo
            </a>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-light py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-secondary">
                            <i class="bi bi-list-ul me-2"></i>Lista de equipos
                        </span>
                        <span class="badge bg-primary">
                            {{ isset($equipos) ? $equipos->count() : 0 }} equipos
                        </span>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if (isset($equipos) && $equipos->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach ($equipos as $equipo)
                                <li class="list-group-item p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h3 class="fs-5 fw-medium mb-1">{{ $equipo->nombre }}</h3>
                                            @if ($equipo->descripcion)
                                                <p class="text-muted mb-1 small">{{ $equipo->descripcion }}</p>
                                            @endif
                                            <span class="badge bg-info text-dark">
                                                <i class="bi bi-person-fill me-1"></i>{{ $equipo->jugadores->count() }} jugadores
                                            </span>
                                        </div>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('equipos.show', $equipo) }}" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" title="Ver detalles">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('equipos.edit', $equipo) }}" class="btn btn-outline-warning btn-sm" data-bs-toggle="tooltip" title="Editar equipo">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <form action="{{ route('equipos.destroy', $equipo) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" 
                                                        onclick="return confirm('¿Estás seguro de eliminar este equipo? Esta acción eliminará todos sus jugadores.')"
                                                        data-bs-toggle="tooltip" title="Eliminar equipo">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="bi bi-people text-secondary" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="text-muted">No tienes equipos registrados</h5>
                            <p class="text-muted">Comienza creando tu primer equipo</p>
                            <a href="{{ route('equipos.create') }}" class="btn btn-outline-primary mt-2">
                                <i class="bi bi-plus-lg me-1"></i>Crear mi primer equipo
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Script para inicializar los tooltips -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
</x-app-layout>