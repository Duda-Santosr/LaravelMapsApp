<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // Listar todos os locais
    public function index()
    {
        $locations = Location::all();
        return view('locations.index', compact('locations'));
    }

    // Mostrar formulário de criação
    public function create()
    {
        return view('locations.create');
    }

    // Salvar novo local
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'address' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100'
        ]);

        // Criar local
        Location::create($request->all());

        return redirect()->route('locations.index')
            ->with('success', 'Local criado com sucesso!');
    }

    // Mostrar local específico
    public function show(string $id)
    {
        $location = Location::findOrFail($id);
        return view('locations.show', compact('location'));
    }

    // Mostrar formulário de edição
    public function edit(string $id)
    {
        $location = Location::findOrFail($id);
        return view('locations.edit', compact('location'));
    }

    // Atualizar local
    public function update(Request $request, string $id)
    {
        // Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'address' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100'
        ]);

        // Atualizar local
        $location = Location::findOrFail($id);
        $location->update($request->all());

        return redirect()->route('locations.index')
            ->with('success', 'Local atualizado com sucesso!');
    }

    // Excluir local
    public function destroy(string $id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return redirect()->route('locations.index')
            ->with('success', 'Local excluído com sucesso!');
    }
}