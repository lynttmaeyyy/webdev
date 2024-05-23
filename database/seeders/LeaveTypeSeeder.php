<?php

namespace Database\Seeders;

// database/seeders/LeaveTypeSeeder.php
use Illuminate\Database\Seeder;
use App\Models\LeaveType;

class LeaveTypeSeeder extends Seeder
{
    public function run()
    {
        $leaveTypes = [
            ['name' => 'Sick Leave'],
            ['name' => 'Annual Leave'],
            ['name' => 'Maternity Leave'],
            // Add more leave types as needed
        ];

        foreach ($leavetypes as $type) {
            LeaveType::create($type);
        }
    }
}

