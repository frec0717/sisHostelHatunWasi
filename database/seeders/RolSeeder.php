<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->runDataDefault();
        if (env('PROJECT_MODE', 'prod') === 'dev') {
            $this->runDataFake();
        }
    }

    public function runDataDefault() {
        DB::table('roles')->insert(['name' => 'administrador','created_at' => now()]);
        DB::table('roles')->insert(['name' => 'recepcionista','created_at' => now()]);
        DB::table('roles')->insert(['name' => 'servicio','created_at' => now()]);
        // DB::table('roles')->insert(['name' => 'cliente','created_at' => now()]);
    }

    public function runDataFake() {
    }
}
