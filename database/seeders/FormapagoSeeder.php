<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormapagoSeeder extends Seeder
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
        DB::table('formapagos')->insert([
            'nombre_formapago' => 'EFECTIVO',
            'estado_formapago' => '1',
            'created_at' => now()
        ]);        
        DB::table('formapagos')->insert([
            'nombre_formapago' => 'TARJETA',
            'estado_formapago' => '1',
            'created_at' => now()
        ]);
        DB::table('formapagos')->insert([
            'nombre_formapago' => 'TRANSFERENCIA',
            'estado_formapago' => '1',
            'created_at' => now()
        ]);
        
    }

    public function runDataFake()
    {
    }
}
