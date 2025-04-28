<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fs-4 fw-semibold text-dark mb-0">
                {{ $equipo->nombre }}
            </h2>
            <a href="{{ route('equipos.index') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Volver a la lista
            </a>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if (session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('warning') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h2 class="fs-3 fw-bold">Detalles del equipo</h2>
                            @if ($equipo->descripcion)
                                <p class="mt-2">{{ $equipo->descripcion }}</p>
                            @endif
                            <p class="mt-1 text-muted small">Creado el {{ $equipo->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('equipos.edit', $equipo) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-fill me-1"></i> Editar equipo
                            </a>
                            <form action="{{ route('equipos.destroy', $equipo) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este equipo?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash-fill me-1"></i> Eliminar equipo
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fs-4 fw-bold mb-0">Jugadores del equipo</h2>
                        <a href="{{ route('jugadores.create', $equipo) }}" class="btn btn-success btn-sm">
                            <i class="bi bi-plus-lg me-1"></i> Añadir jugador
                        </a>
                    </div>

                    @if ($jugadores->isEmpty())
                        <div class="text-center py-4">
                            <div class="mb-3">
                                <i class="bi bi-people text-secondary" style="font-size: 2rem;"></i>
                            </div>
                            <p class="text-muted">No hay jugadores registrados en este equipo.</p>
                            <a href="{{ route('jugadores.create', $equipo) }}" class="btn btn-outline-primary btn-sm mt-2">
                                Añadir primer jugador
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Fecha de nacimiento</th>
                                        <th class="text-end">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jugadores as $jugador)
                                        <tr>
                                            <td>{{ $jugador->nombre }}</td>
                                            <td>{{ $jugador->apellidos }}</td>
                                            <td>
                                                {{ $jugador->fecha_nacimiento ? $jugador->fecha_nacimiento->format('d/m/Y') : 'No registrada' }}
                                            </td>
                                            <td class="text-end">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('jugadores.edit', $jugador) }}" class="btn btn-outline-warning btn-sm" title="Editar">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    <form action="{{ route('jugadores.destroy', $jugador) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm" 
                                                                onclick="return confirm('¿Estás seguro de eliminar este jugador?');"
                                                                title="Eliminar">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>