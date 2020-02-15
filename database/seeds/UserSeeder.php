<?php

use App\Location;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=> 'TAccount',
            'firstname'=>'Test',
            'surname'=>'Account',
            'address'=>'Avondale Harare',
            'gender'=>'Female',
            'location_id'=>32,
            'job_title'=>'Supervisor',
            'emp_num'=>1,
            'mobile_number'=>'0783210639',
            'office_number'=>'2230',
            //'profile_picture'=>$faker->image('public/storage/images',640,480, null, false),
            'sick_leave'=>5,
            'sick_leave_half_pay'=>5,
            'sick_leave_full_pay'=>5,
            'annual_leave'=>5,
            'study_leave'=>5,
            'maternity_leave'=>5,
            'total_leave_balance'=>30,
            'supervisor_email'=>'mmajuru@agribank.co.zw',
            'email' => 'testaccount@agribank.co.zw',
            'email_verified_at' => Carbon::now(),
            'password'=>Hash::make('general123'),
            'password_change_at' => Carbon::now(),
            'remember_token' => Str::random(10),


        ])->assignRole('General');

        User::create([
            'name'=> 'MMajuru',
            'firstname'=>'Melissah',
            'surname'=>'Majuru',
            'address'=>'Avondale Harare',
            'gender'=>'Female',
            'location_id'=>32,
            'job_title'=>'Supervisor',
            'emp_num'=>2,
            'mobile_number'=>'0783210639',
            'office_number'=>'2230',
            //'profile_picture'=>$faker->image('public/storage/images',640,480, null, false),
            'sick_leave'=>5,
            'sick_leave_half_pay'=>5,
            'sick_leave_full_pay'=>5,
            'annual_leave'=>5,
            'study_leave'=>5,
            'maternity_leave'=>5,
            'total_leave_balance'=>30,
            'supervisor_email'=>'jsiziba@agribank.co.zw',
            'email' => 'mmajuru@agribank.co.zw',
            'email_verified_at' => Carbon::now(),
            'password'=>Hash::make('supervisor123'),
            'password_change_at' => Carbon::now(),
            'remember_token' => Str::random(10),


        ])->assignRole('Supervisor');

        User::create([
            'name'=> 'ZZiteya',
            'firstname'=>'Zuvarashe',
            'surname'=>'Ziteya',
            'address'=>'Avondale Harare',
            'gender'=>'Female',
            'location_id'=>31,
            'job_title'=>'Human Resources Officer',
            'emp_num'=>3,
            'mobile_number'=>'0783210639',
            'office_number'=>'2230',
            //'profile_picture'=>$faker->image('public/storage/images',640,480, null, false),
            'sick_leave'=>5,
            'sick_leave_half_pay'=>5,
            'sick_leave_full_pay'=>5,
            'annual_leave'=>5,
            'study_leave'=>5,
            'maternity_leave'=>5,
            'total_leave_balance'=>30,
            'supervisor_email'=>'pgurajena@agribank.co.zw',
            'email' => 'zziteya@agribank.co.zw',
            'email_verified_at' => Carbon::now(),
            'password'=>Hash::make('supervisor123'),
            'password_change_at' => Carbon::now(),
            'remember_token' => Str::random(10),


        ])->assignRole('Human Resources');

        User::create([
            'name'=> 'JSiziba',
            'firstname'=>'Johnson',
            'surname'=>'Siziba',
            'address'=>'Kuwadzana Avondale',
            'gender'=>'Male',
            'location_id'=>32,
            'job_title'=>'Head of Department',
            'emp_num'=>4,
            'mobile_number'=>'0783210639',
            'office_number'=>'2230',
            //'profile_picture'=>$faker->image('public/storage/images',640,480, null, false),
            'sick_leave'=>5,
            'sick_leave_half_pay'=>5,
            'sick_leave_full_pay'=>5,
            'annual_leave'=>5,
            'study_leave'=>5,
            'maternity_leave'=>5,
            'total_leave_balance'=>30,
            'email' => 'jsiziba@agribank.co.zw',
            'email_verified_at' => Carbon::now(),
            'password'=>Hash::make('head1234'),
            'password_change_at' => Carbon::now(),
            'remember_token' => Str::random(10),


        ])->assignRole('Head of Department');

        User::create([
            'name'=> 'MZiteya',
            'firstname'=>'Munyaradzi',
            'surname'=>'Ziteya',
            'address'=>'Kuwadzana Avondale',
            'gender'=>'Male',
            'location_id'=>24,
            'job_title'=>'Chief Executive Officer',
            'emp_num'=>5,
            'mobile_number'=>'0783210639',
            'office_number'=>'2230',
            //'profile_picture'=>$faker->image('public/storage/images',640,480, null, false),
            'sick_leave'=>5,
            'sick_leave_half_pay'=>5,
            'sick_leave_full_pay'=>5,
            'annual_leave'=>5,
            'study_leave'=>5,
            'maternity_leave'=>5,
            'total_leave_balance'=>30,
            'email' => 'mziteya@agribank.co.zw',
            'email_verified_at' => Carbon::now(),
            'password'=>Hash::make('head1234'),
            'password_change_at' => Carbon::now(),
            'remember_token' => Str::random(10),

        ])->assignRole('Executive Supervisor');

        User::create([
            'name'=> 'WZiteya',
            'firstname'=>'Winnet',
            'surname'=>'Ziteya',
            'address'=>'Kuwadzana Avondale',
            'gender'=>'Female',
            'location_id'=>31,
            'job_title'=>'Head of Human Resources',
            'emp_num'=>6,
            'mobile_number'=>'0783210639',
            'office_number'=>'2230',
            //'profile_picture'=>$faker->image('public/storage/images',640,480, null, false),
            'sick_leave'=>5,
            'sick_leave_half_pay'=>5,
            'sick_leave_full_pay'=>5,
            'annual_leave'=>5,
            'study_leave'=>5,
            'maternity_leave'=>5,
            'total_leave_balance'=>30,
            'email' => 'wziteya@agribank.co.zw',
            'email_verified_at' => Carbon::now(),
            'password'=>Hash::make('head1234'),
            'password_change_at' => Carbon::now(),
            'remember_token' => Str::random(10),


        ])->assignRole('Executive Human Resources');

        User::create([
            'name'=> 'CZiteya',
            'firstname'=>'Cephas',
            'surname'=>'Ziteya',
            'address'=>'3628 Chikamba Close Budiriro Two Harare',
            'gender'=>'Male',
            'location_id'=>32,
            'job_title'=>'Graduate Trainee',
            'emp_num'=>319902,
            'mobile_number'=>'0777250754',
            'office_number'=>'2230',
            //'profile_picture'=>$faker->image('public/storage/images',640,480, null, false),
            'sick_leave'=>5,
            'sick_leave_half_pay'=>5,
            'sick_leave_full_pay'=>5,
            'annual_leave'=>5,
            'study_leave'=>5,
            'maternity_leave'=>5,
            'total_leave_balance'=>30,
            'email' => 'cziteya@agribank.co.zw',
            'email_verified_at' => Carbon::now(),
            'password'=>Hash::make('mz0754cz'),
            'password_change_at' => Carbon::now(),
            'remember_token' => Str::random(10),


        ])->assignRole('System Administrator');




        /*$faker = Faker\Factory::create();
        $roles = Role::all();
        $locations = Location::select('id')->get();
        $new_loc = array();
        for($i=0;$i<count($locations);$i++){
            array_push( $new_loc,$locations[$i]['id']);
        }

        foreach(range(1,10) as $index){
            //$gender = $faker->randomElement(['male', 'female'])[0];
            User::create([
                'name'=> $faker->name(),
                'firstname'=>$faker->firstName,
                'surname'=>$faker->lastName,
                'address'=>$faker->streetAddress,
                'gender'=>$faker->randomElement(['male', 'female']),
                'location_id'=>32,//$faker->randomElement($new_loc),
                'emp_num'=>$faker->randomDigit,
                'job_title'=>$faker->jobTitle,
                 'mobile_number'=>$faker->e164PhoneNumber,
                 'office_number'=>$faker->e164PhoneNumber,
                 //'profile_picture'=>$faker->image('public/storage/images',640,480, null, false),
                'sick_leave_half_pay'=>20,
                'sick_leave_full_pay'=>20,
                'annual_leave'=>20,
                'study_leave'=>20,
                'maternity_leave'=>20,                //'user_leave_balance'=>100,
                'total_leave_balance'=>100,
                 'email' => $faker->unique()->safeEmail,
                 'email_verified_at' => Carbon::now(),
                 'password'=>Hash::make('password'),
                 'password_change_at' => Carbon::now(),
                 'remember_token' => Str::random(10),


            ])->assignRole('General');//$faker->randomElement($roles));

        }*/

    }
}
