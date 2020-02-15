<?php

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
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
                'location_name'=>'BRANCH BINDURA',
                'description'=>'Agribank branch',
                'category_id' => 2 ,

            ],

            [
                'location_name'=>'BRANCH BULAWAYO INALA',
                'description'=>'Agribank branch',
                'category_id'=>2,

            ],

            [
                'location_name'=>'BRANCH BULAWAYO JASON MOYO',
                'description'=>'Agribank branch',
                'category_id'=>2,

            ],

            [
                'location_name'=>'BRANCH BULAWAYO 8th AVE',
                'description'=>'Agribank branch',
                'category_id'=>2,

            ],

            [
                'location_name'=>'BRANCH CHEGUTU',
                'description'=>'Agribank branch',
                'category_id'=>2,

            ],

            [
                'location_name'=>'BRANCH CHINHOYI',
                'description'=>'Agribank branch',
                'category_id'=>2,

            ],

            [
                'location_name'=>'BRANCH CHIREDZI',
                'description'=>'Agribank branch',
                'category_id'=>2,

            ],

            [
                'location_name'=>'BRANCH GOKWE',
                'description'=>'Agribank branch',
                'category_id'=>2,

            ],

            [
                'location_name'=>'BRANCH GWANDA',
                'description'=>'Agribank branch',
                'category_id'=>2,

            ],

            [
                'location_name'=>'BRANCH GWERU',
                'description'=>'Agribank branch',
                'category_id'=>2,

            ],

            [
                'location_name'=>'BRANCH HWANGE',
                'description'=>'Agribank branch',
                'category_id'=>2,

            ],

            [
                'location_name'=>'BRANCH KAROI',
                'description'=>'Agribank branch',
                'category_id'=>2,

            ],

            [
                'location_name'=>'BRANCH KOPJE',
                'description'=>'Agribank branch',
                'category_id'=>2,

            ],

            [
                'location_name'=>'BRANCH MARONDERA',
                'description'=>'Agribank branch',
                'category_id'=>2,

            ],

            [
                'location_name'=>'BRANCH GWERU',
                'description'=>'Agribank branch',
                'category_id'=>2,

            ],

            [
                'location_name'=>'BRANCH MARONDERA',
                'description'=>'Agribank branch',
                'category_id'=>2,

            ],

            [
                'location_name'=>'BRANCH MASVINGO',
                'description'=>'Agribank branch',
                'category_id'=>2,

            ],

            [
                'location_name'=>'BRANCH MUTARE',
                'description'=>'Agribank branch',
                'category_id'=>2,

            ],

            [
                'location_name'=>'BRANCH MVURWI',
                'description'=>'Agribank branch',
                'category_id'=>2,

            ],

            [
                'location_name'=>'BRANCH NELSON MANDELA',
                'description'=>'Agribank branch',
                'category_id'=>2,

            ],

            [
                'location_name'=>'BRANCH WESTGATE',
                'description'=>'Agribank branch',
                'category_id'=>2,

            ],

            [
                'location_name'=>'HQ ADMINISTRATION',
                'description'=>'Agribank HQ department',
                'category_id'=>1,

            ],

            [
                'location_name'=>'HQ CENTRAL CLEARING UNIT BULAWAYO',
                'description'=>'Agribank HQ department',
                'category_id'=>1,

            ],

            [
                'location_name'=>'HQ CHIEF EXECUTIVE ',
                'description'=>'Agribank HQ department',
                'category_id'=>1,

            ],

            [
                'location_name'=>'HQ CORPORATE BANKING ',
                'description'=>'Agribank HQ department',
                'category_id'=>1,

            ],

            [
                'location_name'=>'HQ DEBT RECOVERIES ',
                'description'=>'Agribank HQ department',
                'category_id'=>1,

            ],

            [
                'location_name'=>'HQ  E BANKING & COMMUNICATIONS ',
                'description'=>'Agribank HQ department',
                'category_id'=>1,

            ],

            [
                'location_name'=>'HQ  EXECUTIVE BANKING AGRIGOLD',
                'description'=>'Agribank HQ department',
                'category_id'=>1,

            ],

            [
                'location_name'=>'HQ  FINANCIAL ACCOUNTING',
                'description'=>'Agribank HQ department',
                'category_id'=>1,

            ],


            [
                'location_name'=>'HQ  CREDIT DEPARTMENT',
                'description'=>'Agribank HQ department',
                'category_id'=>1,

            ],


            [
                'location_name'=>'HQ HUMAN RESOURCES',
                'description'=>'Agribank HQ department',
                'category_id'=>1,

            ],

            [
                'location_name'=>'HQ  INFORMATION COMM TECH',
                'description'=>'Agribank HQ department',
                'category_id'=>1,

            ],


            [
                'location_name'=>'HQ  LEGAL & COMPLIANCE ',
                'description'=>'Agribank HQ department',
                'category_id'=>1,

            ],



            [
                'location_name'=>'HQ  LOCAL DEALING',
                'description'=>'Agribank HQ department',
                'category_id'=>1,

            ],


            [
                'location_name'=>'HQ  PREMISES',
                'description'=>'Agribank HQ department',
                'category_id'=>1,

            ],


            [
                'location_name'=>'HQ  PROCUREMENT',
                'description'=>'Agribank HQ department',
                'category_id'=>1,

            ],



            [
                'location_name'=>'HQ  RISK MANAGEMENT',
                'description'=>'Agribank HQ department',
                'category_id'=>1,

            ],

            [
                'location_name'=>'HQ  STRATEGY,MARKETING & BUSINESS',
                'description'=>'Agribank HQ department',
                'category_id'=>1,

            ],

            [
                'location_name'=>'HQ  TRADE FINANCE & EXCHANGE CONTR',
                'description'=>'Agribank HQ department',
                'category_id'=>1,

            ],

            [
                'location_name'=>'HQ  TREASURY BACK OFFICE',
                'description'=>'Agribank HQ department',
                'category_id'=>1,

            ],

            [
                'location_name'=>'HQ  BANKING OPERATIONS',
                'description'=>'Agribank HQ department',
                'category_id'=>1,

            ],

            [
                'location_name'=>'MICROFINANCE CHIREDZI',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>4,

            ],

            [
                'location_name'=>'MICROFINANCE FILABUSI',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>4,

            ],

            [
                'location_name'=>'MICROFINANCE GOKWE',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>4,

            ],

            [
                'location_name'=>'MICROFINANCE GWANDA',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>4,

            ],

            [
                'location_name'=>'MICROFINANCE MAPHISA',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>4,

            ],

            [
                'location_name'=>'MICROFINANCE MUTOKO',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>4,

            ],

            [
                'location_name'=>'MICROFINANCE SANYATI',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>4,

            ],

            [
                'location_name'=>'NBO BINGA',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],

            [
                'location_name'=>'NBO CHECHECHE',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],

            [
                'location_name'=>'NBO CHIPINGE',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],

            [
                'location_name'=>'NBO CHIVI',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],

            [
                'location_name'=>'NBO FILABUSI',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],

            [
                'location_name'=>'NBO GURUVE',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],

            [
                'location_name'=>'NBO GUTU',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],


            [
                'location_name'=>'NBO JERERA',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],

            [
                'location_name'=>'NBO KOTWA',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],

            [
                'location_name'=>'NBO LUPANE',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],

            [
                'location_name'=>'NBO MAGUNJE',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],


            [
                'location_name'=>'NBO MAPHISA',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],

            [
                'location_name'=>'NBO MATAGA',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],

            [
                'location_name'=>'NBO MT DARWIN',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],


            [
                'location_name'=>'NBO MUBAIRA',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],

            [
                'location_name'=>'NBO MURAMBINDA',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],

            [
                'location_name'=>'NBO MUREHWA',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],

            [
                'location_name'=>'NBO MUTOKO',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],

            [
                'location_name'=>'NBO NYANGA',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],

            [
                'location_name'=>'NBO NYIKA',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],

            [
                'location_name'=>'NBO RUSAPE', // Nbo Rusape
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],

            [
                'location_name'=>'NBO RUSHINGA',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],

            [
                'location_name'=>'NBO WEDZA',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],

            [
                'location_name'=>'NBO ZVISHANE',
                'description'=>'Agribank HQ microfinance',
                'category_id'=>3,

            ],

        ];

        Model::unguard();

        foreach($values as $value)
        {
            \App\Location::query()->create([
                'location_name' => ucwords(strtolower($value['location_name'])),
                'description' => ucwords($value['description']),
                'category_id' => $value['category_id'],
            ]);
        }

    }

}
