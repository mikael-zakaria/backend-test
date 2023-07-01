<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skills')->insert([
            'name' => 'PHP',
            'created_at' =>  now(),
            'updated_at' => now()
        ]);

        DB::table('skills')->insert([
            'name' => 'Javascript',
            'created_at' =>  now(),
            'updated_at' => now()
        ]);

        DB::table('skills')->insert([
            'name' => 'API(JSON REST)',
            'created_at' =>  now(),
            'updated_at' => now()
        ]);

        DB::table('skills')->insert([
            'name' => 'Database (PostgreSQL MySQL)',
            'created_at' =>  now(),
            'updated_at' => now()
        ]);

        DB::table('skills')->insert([
            'name' => 'Version Control (Gitlab Github)',
            'created_at' =>  now(),
            'updated_at' => now()
        ]);
    }
}
