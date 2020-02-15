<?php

use App\ReportName;
use Illuminate\Database\Seeder;

class ReportNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values =['awaiting recommendation','awaiting authorization','authorized','closed','rejected','all'];
        for($i=0;$i<count($values);$i++){
            ReportName::create(['name'=>$values[$i]]);
        }

    }
}
