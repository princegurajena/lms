<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user  = \App\User::query()->find(1);
        if ($user){
            $user->update([
                'emp_num' => '012335',
                'job_title' => 'Systems Analyst',
                'address' => '527 Yardley Close Chisipite',
                'gender' => 'male',
                'mobile_number' => '0775710855',
                'office_number' => '2230',
                'supervisor_email' => 'pgurajena@agribank.co.zw',
                'location_id' => 32,
                'profile_completed' => true,
            ]);
        }

        $this->call(LocationSeeder::class);
        $this->call(LeaveTypes::class);

    }
}
