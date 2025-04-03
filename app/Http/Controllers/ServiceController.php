<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return response()->json(Service::all(), 200);
    }

    public function show($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }
        return response()->json($service, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'time_estimated' => 'required|integer|min:1'
        ]);

        $service = Service::create($validated);
        return response()->json(['message' => 'Servicio creado', 'data' => $service], 201);
    }

    public function update(Request $request, $id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }

        $validated = $request->validate([
            'name' => 'string|max:255',
            'description' => 'string',
            'time_estimated' => 'integer|min:1'
        ]);

        $service->update($validated);
        return response()->json(['message' => 'Servicio actualizado', 'data' => $service], 200);
    }

    public function destroy($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }

        $service->delete();
        return response()->json(['message' => 'Servicio eliminado'], 200);
    }
}
