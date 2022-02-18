<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisitorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $visitorTypes = [];
        $visitorTypes = ['PEDESTRIAN','DRIVER','CYCLIST','PASSENGER'];

        foreach($visitorTypes as $visitorType){
            DB::table('visitor_Types')->insert([
                'name' => $visitorType,
            ]);
        }
       
    }
}
