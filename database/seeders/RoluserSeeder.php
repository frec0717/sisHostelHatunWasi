<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoluserSeeder extends Seeder
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
        DB::table('role_user')->insert([
            'user_id' => '1',
            'role_id' => '1',
            'created_at' => now()
        ]);
        DB::table('role_user')->insert([
            'user_id' => '1',
            'role_id' => '4',
            'created_at' => now()
        ]);
        DB::table('role_user')->insert([
            'user_id' => '2',
            'role_id' => '2',
            'created_at' => now()
        ]);
        DB::table('role_user')->insert([
            'user_id' => '2',
            'role_id' => '4',
            'created_at' => now()
        ]);
    }

    public function runDataFake()
    {
    }
}
