<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Employee;
use Illuminate\Validation\ValidationException;

class ScheduleController extends Controller
{
<<<<<<< Updated upstream
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
=======
    // Obtener todos los horarios
    public function index() {
        $schedules = Schedule::with('employee')->get();
    
        // Transformar la respuesta para incluir solo el nombre del empleado
        $formattedSchedules = $schedules->map(function ($schedule) {
            return [
                "id" => $schedule->id,
                "employee_name" => $schedule->employee->name, // Solo el nombre del empleado
                "week_day" => $schedule->week_day,
                "start_date" => $schedule->start_date,
                "end_date" => $schedule->end_date,
                "created_at" => $schedule->created_at,
                "updated_at" => $schedule->updated_at,
            ];
        });
    
        return response()->json($formattedSchedules);
    }
    

    // Obtener un horario específico
    public function show($id) {
        $schedule = Schedule::with('employee')->find($id);
    
        if (!$schedule) {
            return response()->json(['message' => 'Schedule not found'], 404);
        }
    
        $formattedSchedule = [
            "id" => $schedule->id,
            "employee_name" => $schedule->employee->name, // Solo el nombre del empleado
            "week_day" => $schedule->week_day,
            "start_date" => $schedule->start_date,
            "end_date" => $schedule->end_date,
            "created_at" => $schedule->created_at,
            "updated_at" => $schedule->updated_at,
        ];
    
        return response()->json($formattedSchedule);
    }
    

    // Crear un nuevo horario
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'week_day' => 'required|string',
            'start_date' => 'required|date_format:Y-m-d H:i:s',
            'end_date' => 'required|date_format:Y-m-d H:i:s|after:start_date',
        ]);

        $schedule = Schedule::create($request->all());

        return response()->json(['message' => 'Schedule created successfully', 'schedule' => $schedule], 201);
    }

    // Actualizar un horario
    public function update(Request $request, $id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json(['message' => 'Schedule not found'], 404);
        }

        $request->validate([
            'employee_id' => 'exists:employees,id',
            'week_day' => 'string',
            'start_date' => 'date_format:Y-m-d H:i:s',
            'end_date' => 'date_format:Y-m-d H:i:s|after:start_date',
        ]);

        $schedule->update($request->all());

        return response()->json(['message' => 'Schedule updated successfully', 'schedule' => $schedule]);
    }

    // Eliminar un horario
    public function destroy($id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json(['message' => 'Schedule not found'], 404);
        }

        $schedule->delete();

        return response()->json(['message' => 'Schedule deleted successfully']);
>>>>>>> Stashed changes
    }
}
