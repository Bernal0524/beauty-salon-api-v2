<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'week_day', 'start_date', 'end_date'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
}
}