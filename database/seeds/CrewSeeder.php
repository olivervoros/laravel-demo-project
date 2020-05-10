<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CrewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $crews = array();
        $crews[] = ['name' => 'Johnny', 'position' => 'pilot'];
        $crews[] = ['name' => 'Peter', 'position' => 'pilot'];
        $crews[] = ['name' => 'Steve', 'position' => 'pilot'];
        $crews[] = ['name' => 'Alen', 'position' => 'pilot'];
        $crews[] = ['name' => 'Christine', 'position' => 'pilot'];
        $crews[] = ['name' => 'Mike', 'position' => 'pilot'];
        $crews[] = ['name' => 'Susan', 'position' => 'cabincrew'];
        $crews[] = ['name' => 'Mary', 'position' => 'cabincrew'];
        $crews[] = ['name' => 'Jessica', 'position' => 'cabincrew'];
        $crews[] = ['name' => 'Samantha', 'position' => 'cabincrew'];
        $crews[] = ['name' => 'Judy', 'position' => 'cabincrew'];
        $crews[] = ['name' => 'Michel', 'position' => 'cabincrew'];
        $crews[] = ['name' => 'Agnes', 'position' => 'cabincrew'];
        $crews[] = ['name' => 'Eve', 'position' => 'cabincrew'];
        $crews[] = ['name' => 'Katherine', 'position' => 'cabincrew'];
        $crews[] = ['name' => 'Monique', 'position' => 'cabincrew'];

        DB::table('crews')->insert($crews);
    }
}
