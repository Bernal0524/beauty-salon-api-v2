<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
<<<<<<< Updated upstream
=======
    /**
     * Listar todos los empleados.
     */
>>>>>>> Stashed changes
    public function index()
    {
        return response()->json(Employee::all(), 200);
    }

<<<<<<< Updated upstream
=======
    /**
     * Obtener detalles de un empleado específico.
     */
>>>>>>> Stashed changes
    public function show($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }
        return response()->json($employee, 200);
    }

<<<<<<< Updated upstream
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees',
            'phone_number' => 'required|string|min:8|max:15',
            'position' => 'required|string|max:100',
        ]);

        $employee = Employee::create($validated);
        return response()->json(['message' => 'Empleado registrado', 'data' => $employee], 201);
    }

=======
    /**
     * Crear un nuevo empleado.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:employees',
            'phone_number' => 'required|string',
            'username' => 'required|string|unique:employees',
            'password' => 'required|string|min:6',
        ]);

        $employee = Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($employee, 201);
    }

    /**
     * Modificar un empleado existente.
     */
>>>>>>> Stashed changes
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }

<<<<<<< Updated upstream
        $validated = $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:employees,email,' . $id,
            'phone_number' => 'string|min:8|max:15',
            'position' => 'string|max:100',
        ]);

        $employee->update($validated);
        return response()->json(['message' => 'Empleado actualizado', 'data' => $employee], 200);
    }

=======
        $request->validate([
            'name' => 'string',
            'email' => 'email|unique:employees,email,' . $id,
            'phone_number' => 'string',
            'username' => 'string|unique:employees,username,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        $employee->update([
            'name' => $request->name ?? $employee->name,
            'email' => $request->email ?? $employee->email,
            'phone_number' => $request->phone_number ?? $employee->phone_number,
            'username' => $request->username ?? $employee->username,
            'password' => $request->password ? Hash::make($request->password) : $employee->password,
        ]);

        return response()->json($employee, 200);
    }

    /**
     * Eliminar un empleado.
     */
>>>>>>> Stashed changes
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }
        $employee->delete();
<<<<<<< Updated upstream
        return response()->json(['message' => 'Empleado eliminado'], 200);
=======
        return response()->json(['message' => 'Empleado eliminado correctamente'], 200);
>>>>>>> Stashed changes
    }
}
