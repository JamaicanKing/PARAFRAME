<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorisationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authorisationStatuses = [];
        $authorisationStatuses = ['SINGLE ENTRY','MULTIPLE ENTRY - (WHITELIST)','DENY ENTRY - (BLACKLIST)',];

        foreach($authorisationStatuses as $authorisationStatus){
            DB::table('authorisation_statuses')->insert([
                'name' => $authorisationStatus,
            ]);
        }
       
    }
}
