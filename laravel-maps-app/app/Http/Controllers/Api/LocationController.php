<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Listar todos os locais (com paginação opcional)
     */
    public function index()
    {
        $locations = Location::all(); // ou: Location::paginate(10);
        return response()->json([
            'success' => true,
            'data' => $locations
        ], 200);
    }

    /**
     * Criar novo local
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'address' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
        ]);

        $location = Location::create($validated);

        return response()->json([
            'success' => true,
            'data' => $location
        ], 201);
    }

    /**
     * Obter um local específico
     */
    public function show($id)
    {
        $location = Location::find($id);

        if (!$location) {
            return response()->json([
                'success' => false,
                'message' => 'Local não encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $location
        ], 200);
    }

    /**
     * Atualizar um local
     */
    public function update(Request $request, $id)
    {
        $location = Location::find($id);

        if (!$location) {
            return response()->json([
                'success' => false,
                'message' => 'Local não encontrado'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'address' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
        ]);

        $location->update($validated);

        return response()->json([
            'success' => true,
            'data' => $location
        ], 200);
    }

    /**
     * Excluir um local
     */
    public function destroy($id)
    {
        $location = Location::find($id);

        if (!$location) {
            return response()->json([
                'success' => false,
                'message' => 'Local não encontrado'
            ], 404);
        }

        $location->delete();

        return response()->json([
            'success' => true,
            'message' => 'Local excluído com sucesso'
        ], 200);
    }
}