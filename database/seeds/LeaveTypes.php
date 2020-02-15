<?php

use App\LeaveType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            [
                'name'=>'sick leave',
                'max'=> 2,
                'document' => true,
                'map' => 'sick_leave'
            ],
            [
                'name'=>'sick leave half pay',
                'max'=> 90,
                'document' => true,
                'map' => 'sick_leave_half_pay'
            ],
            [
                'name'=>'sick leave full pay',
                'max'=> 60,
                'document' => true,
                'map' => 'sick_leave_full_pay'
            ],
            [
                'name'=>'maternity leave',
                'max'=>90,
                'document' => false,
                'map' => 'maternity_leave'
            ],
            [
                'name'=>'study leave',
                'max'=>20,
                'document' => true,
                'map' => 'study_leave'
            ],
            [
                'name'=>'annual leave',
                'max'=>10,
                'document' => false,
                'map' => 'annual_leave'
            ],
        ];

        Model::unguard();

        foreach($values as $value)
        {
            LeaveType::query()->create([
                'name' => ucwords($value['name']),
                'max' => $value['max'],
                'document' => $value['document'],
                'map' => $value['map'],
            ]);
        }

    }
}
