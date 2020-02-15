<?php

use App\Leave;
use App\LeaveType;
use App\Location;
use App\Status;
use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class LeaveApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();
        $status = Status::select('id')->get();
        $new_stat = array();
        for($i=0;$i<count($status);$i++){
            array_push( $new_stat,$status[$i]['id']);
        }

        $leave = LeaveType::select('id')->get();
        $new_leave = array();
        for($a=0;$a<count($leave);$a++){
            array_push( $new_leave,$leave[$a]['id']);
        }

        $user = User::select('id')->get();
        $new_user = array();
        for($a=0;$a<count($user);$a++){
            array_push( $new_user,$user[$a]['id']);
        }

        $location = Location::select('id')->get();
        $new_location = array();
        for($a=0;$a<count($location);$a++){
            array_push( $new_location,$location[$a]['id']);
        }

        //$head = User::

        for($a=0;$a<20;$a++){
            $leave = Leave::create([
                'user_id' => $faker->randomElement($new_user),
                'status_id' => $faker->randomElement($new_stat),
                'leave_type_id' => $faker->randomElement($new_leave),
                'start_date' => $faker->dateTimeBetween('+0 days', '+20 days'),
                'end_date' => $faker->dateTimeBetween('+10 days', '+3 months'),
                'total_days_taken'=>2,
                'location_id'=>32, //$faker->randomElement($new_location),
                'head_id' => 3,
                'supervisor_id' => 2,
            ]);
        }

        /*for($a=0;$a<10;$a++) {
            $leave = Leave::create([
                'user_id' => 101,
                'status_id' => $faker->randomElement($new_stat),
                'leave_type_id' => $faker->randomElement($new_leave),
                'start_date' => $faker->dateTimeBetween('+0 days', '+1 month'),
                'end_date' => $faker->dateTimeBetween('+10 days', '+3 months'),
                'location_id'=>32,
                'head_id' => 1,
                'supervisor_id' => 2,
            ]);
        }*/
    }
}
