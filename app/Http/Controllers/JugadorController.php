<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JugadorController extends Controller
{
    public function index(Equipo $equipo)
    {
        // Verificar que el equipo pertenece al usuario actual
        if ($equipo->user_id !== Auth::id()) {
            abort(403);
        }
        
        $jugadores = $equipo->jugadores;
        return view('jugadores.index', compact('equipo', 'jugadores'));
    }

    public function create(Equipo $equipo)
    {
        return view('jugadores.create', compact('equipo'));
    }

    public function store(Request $request, Equipo $equipo)
    {
        
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        $equipo->jugadores()->create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'fecha_nacimiento' => $request->fecha_nacimiento,
        ]);

        return redirect()->route('equipos.show', $equipo)
            ->with('success', 'Jugador añadido correctamente');
    }

    public function edit(Equipo $equipo, Jugador $jugador)
    {
        // Verificar que el jugador pertenece al equipo
        if ($jugador->equipo_id !== $equipo->id) {
            abort(404);
        }
        
        return view('jugadores.edit', compact('jugador', 'equipo'));
    }

    public function update(Request $request, Jugador $jugador)
    {
        
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        $jugador->update([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'fecha_nacimiento' => $request->fecha_nacimiento,
        ]);

        return redirect()->route('equipos.show', $jugador->equipo)
            ->with('success', 'Jugador actualizado correctamente');
    }

    public function destroy(Jugador $jugador)
    {
        $equipo = $jugador->equipo;
        $jugadoresCount = $equipo->jugadores()->count();
        
        if ($jugadoresCount <= 1) {
            return redirect()->route('equipos.show', $equipo)
                ->with('warning', 'No se puede eliminar el último jugador del equipo');
        }
        
        $jugador->delete();
        
        return redirect()->route('equipos.show', $equipo)
            ->with('success', 'Jugador eliminado correctamente');
    }
}