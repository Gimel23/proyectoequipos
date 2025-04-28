<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Auth::user()->equipos;
        return view('equipos.index', compact('equipos'));
    }

    public function create()
    {
        return view('equipos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        // Crear el arreglo de datos correctamente
        $data = [
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'user_id' => Auth::id()
        ];

        // Crear el Equipo
        Equipo::create($data);

        return redirect()
            ->route('equipos.index')
            ->with('success', 'Equipo creado exitosamente.');
    }

    public function show(Equipo $equipo)
    {
        $jugadores = $equipo->jugadores;
        return view('equipos.show', compact('equipo', 'jugadores'));
    }

    public function edit(Equipo $equipo)
    {
        return view('equipos.edit', compact('equipo'));
    }

    public function update(Request $request, Equipo $equipo)
    {  
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $equipo->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('equipos.show', $equipo)
            ->with('success', 'Equipo actualizado correctamente');
    }

    public function destroy(Equipo $equipo)
    {
        $equipo->delete();

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo eliminado correctamente');
    }
}