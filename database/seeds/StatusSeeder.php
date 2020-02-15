<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'status_name'=>'Awaiting Recommendation',
                'description'=>'Pending',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'status_name'=>'Awaiting Authorization',
                'description'=>'Pending',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'status_name'=>'Authorized',
                'description'=>'Authorized',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'status_name'=>'Rejected',
                'description'=>'Rejected',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'status_name'=>'Closed',
                'description'=>'Closed',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],

        ];

        foreach($statuses as $status){
            DB::table('statuses')->insert($status);
        }
    }
}
