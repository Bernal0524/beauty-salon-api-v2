<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        return response()->json(Schedule::all(), 200);
    }

    public function show($id)
    {
        $schedule = Schedule::find($id);
        if (!$schedule) {
            return response()->json(['message' => 'Horario no encontrado'], 404);
        }
        return response()->json($schedule, 200);
    }

    public function updateAvailability(Request $request, $id)
    {
        $schedule = Schedule::find($id);
        if (!$schedule) {
            return response()->json(['message' => 'Horario no encontrado'], 404);
        }
        
        $validated = $request->validate([
            'available' => 'required|boolean',
        ]);
        
        $schedule->update($validated);
        return response()->json(['message' => 'Disponibilidad actualizada', 'data' => $schedule], 200);
    }
}
