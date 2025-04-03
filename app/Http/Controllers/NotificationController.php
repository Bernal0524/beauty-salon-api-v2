<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Muestra el historial de notificaciones.
     */
    public function index()
    {
        $notifications = Notification::with(['customer', 'employee'])->latest()->get();

        return response()->json([
            'message' => 'Historial de notificaciones recuperado con éxito',
            'data' => $notifications,
        ]);
    }

    /**
     * Envía una notificación manualmente.
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'employee_id' => 'required|exists:employees,id',
            'message' => 'required|string|max:255',
        ]);

        $validated['date_shipped'] = now();

        $notification = Notification::create($validated);

        return response()->json([
            'message' => 'Notificación enviada correctamente',
            'data' => $notification,
        ], 201);
    }

    // Aquí podés agregar más lógica relacionada a notificaciones en el futuro
}
