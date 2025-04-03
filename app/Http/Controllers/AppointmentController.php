<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    
    public function index()
    {
        $appointments = Appointment::with(['customer', 'employee', 'service'])->get();

        $formattedAppointments = $appointments->map(function ($appointment) {
            return [
                "id" => $appointment->id,
                "customer_name" => $appointment->customer->name, 
                "employee_name" => $appointment->employee->name, 
                "service_name" => $appointment->service->name,   
                "date" => $appointment->date,
                "start_date" => $appointment->start_date,
                "end_date" => $appointment->end_date,
                "status" => $appointment->status,
                "created_at" => $appointment->created_at,
                "updated_at" => $appointment->updated_at,
            ];
        });

        return response()->json($formattedAppointments, 200);
    }

    
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

    
    public function show($id)
    {
        $appointment = Appointment::with(['customer', 'employee', 'service'])->find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Cita no encontrada'], 404);
        }

        $formattedAppointment = [
            "id" => $appointment->id,
            "customer_name" => $appointment->customer->name, 
            "employee_name" => $appointment->employee->name, 
            "service_name" => $appointment->service->name,
            "date" => $appointment->date,
            "start_date" => $appointment->start_date,
            "end_date" => $appointment->end_date,
            "status" => $appointment->status,
            "created_at" => $appointment->created_at,
            "updated_at" => $appointment->updated_at,
        ];

        return response()->json($formattedAppointment, 200);
    }

    
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
