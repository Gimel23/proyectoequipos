<x-app-layout>
    <x-slot name="header">
        <div class="bg-primary text-white py-4 px-3 rounded-lg shadow">
            <h2 class="font-semibold text-xl">
                <i class="bi bi-people-fill me-2"></i>{{ __('Jugadores de ') }} {{ $equipo->nombre }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('jugadores.create', $equipo) }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Agregar Jugador
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Fecha de Nacimiento</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jugadores as $jugador)
                                    <tr>
                                        <td>{{ $jugador->nombre }}</td>
                                        <td>{{ $jugador->apellidos }}</td>
                                        <td>{{ $jugador->fecha_nacimiento ? $jugador->fecha_nacimiento->format('d/m/Y') : 'N/A' }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('jugadores.edit', $jugador) }}" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('jugadores.destroy', $jugador) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>