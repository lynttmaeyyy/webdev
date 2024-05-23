<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable=[
        'id',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'address',
        'phone_number',
        'department'

    ];
}
