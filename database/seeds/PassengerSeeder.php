<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PassengerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('passengers')->truncate();
        factory(App\Passenger::class, 100)->create();
        $extraUser = ["id" => 999,
            "name" => "Oliver Voros",
            "email" => "olivervoros@gmail.com",
            "email_verified_at" => now(),
            "password" => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            "remember_token" => Str::random(10)
        ];
        DB::table('passengers')->insert($extraUser);
    }
}
