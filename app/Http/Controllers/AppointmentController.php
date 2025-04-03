<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    /**
     * Obtener todas las citas.
     */
    public function index()
    {
        $appointments = Appointment::with(['customer', 'employee', 'service'])->get();

        return response()->json($appointments, 200);
    }

    /**
     * Crear una nueva cita.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'employee_id' => 'required|exists:employees,id',
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|string'
        ]);

        $appointment = Appointment::create($request->all());

        return response()->json([
            'message' => 'Cita creada exitosamente',
            'appointment' => $appointment
        ], 201);
    }

    /**
     * Obtener una cita específica.
     */
    public function show($id)
    {
        $appointment = Appointment::with(['customer', 'employee', 'service'])->find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Cita no encontrada'], 404);
        }

        return response()->json($appointment, 200);
    }

    /**
     * Actualizar una cita.
     */
    public function update(Request $request, $id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Cita no encontrada'], 404);
        }

        $request->validate([
            'customer_id' => 'sometimes|exists:customers,id',
            'employee_id' => 'sometimes|exists:employees,id',
            'service_id' => 'sometimes|exists:services,id',
            'date' => 'sometimes|date',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after:start_date',
            'status' => 'sometimes|string'
        ]);

        $appointment->update($request->all());

        return response()->json([
            'message' => 'Cita actualizada correctamente',
            'appointment' => $appointment
        ], 200);
    }

    /**
     * Eliminar una cita.
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Cita no encontrada'], 404);
        }

        $appointment->delete();

        return response()->json(['message' => 'Cita eliminada correctamente'], 200);
    }
}
