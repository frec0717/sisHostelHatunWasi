<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmisiondereciboSeeder extends Seeder
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
        DB::table('emisionderecibos')->insert([
            'nombre_emisionderecibo' => 'BOLETA',
            'estado_emisionderecibo' => '1',
            'created_at' => now()
        ]);        
        DB::table('emisionderecibos')->insert([
            'nombre_emisionderecibo' => 'FACTURA',
            'estado_emisionderecibo' => '1',
            'created_at' => now()
        ]);
       
        
    }

    public function runDataFake()
    {
    }
}
