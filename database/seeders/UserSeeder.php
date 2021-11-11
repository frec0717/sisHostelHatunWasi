<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
        DB::table('users')->insert([
            'name' => 'FLORES ROMERO EBLE CHRISTIAN',
            'email' => 'frec0717@gmail.com',
            'password' => Hash::make('123456789'),
            'created_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Mirta Huertas',
            'email' => 'frec0717@hotmail.com',
            'password' => Hash::make('123456789'),
            'created_at' => now()
        ]);
    }

    public function runDataFake() {
    }
}
