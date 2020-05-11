<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        $data = $this->fillUpArray();
        DB::table('companies')->insert($data);
    }

    private function fillUpArray() {

        $companies = array("Brussels Airline", "Austrian Airlines" ,"British Airways", "KLM", "Wizzair", "Easyjey", "Ryanair", "Lufthansa",
            "Air France", "TAP Portugal", "Iberia", "LOT Polish Airlines", "SwissAir", "Vueling", "SAS", "Finnair", "Tarom",
            "Cathay Pacific", "Thai Airways", "American Airlines");

        $result = [];
        foreach($companies as $key => $company) {
            $result[$key]['name'] = $company;
            $result[$key]['description'] = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).';
        }

        return $result;
    }
}
