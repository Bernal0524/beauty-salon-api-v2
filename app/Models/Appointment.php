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

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getCustomerNameAttribute()
    {
        return $this->customer ? $this->customer->name : 'No asignado';
    }

    public function getEmployeeNameAttribute()
    {
        return $this->employee ? $this->employee->name : 'No asignado';
    }

    public function getServiceNameAttribute()
    {
        return $this->service ? $this->service->name : 'No asignado';
    }
}
