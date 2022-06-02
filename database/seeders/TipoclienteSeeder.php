<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoclienteSeeder extends Seeder
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

    public function runDataDefault()
    {
        DB::table('tipoclientes')->insert([
            'nombre_tipocliente' => 'NATURAL',
            'estado_tipocliente' => '1',
            'created_at' => now()
        ]);        
        DB::table('tipoclientes')->insert([
            'nombre_tipocliente' => 'JURIDICA',
            'estado_tipocliente' => '1',
            'created_at' => now()
        ]);       
        
    }

    public function runDataFake()
    {
    }
}
