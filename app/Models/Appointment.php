<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'employee_id',
        'service_id',
        'date',
        'start_date',
        'end_date',
        'status'
    ];

    // Relación con clientes
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relación con empleados
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // Relación con servicios
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Accesor para obtener el nombre del cliente en lugar del ID
    public function getCustomerNameAttribute()
    {
        return $this->customer ? $this->customer->name : 'No asignado';
    }

    // Accesor para obtener el nombre del empleado en lugar del ID
    public function getEmployeeNameAttribute()
    {
        return $this->employee ? $this->employee->name : 'No asignado';
    }

    // Accesor para obtener el nombre del servicio en lugar del ID
    public function getServiceNameAttribute()
    {
        return $this->service ? $this->service->name : 'No asignado';
    }
}
