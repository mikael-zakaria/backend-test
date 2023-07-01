<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobs')->insert([
            'name' => 'Frontend Web Programmer',
            'created_at' =>  now(),
            'updated_at' => now()
        ]);

        DB::table('jobs')->insert([
            'name' => 'Backend Web Programmer',
            'created_at' =>  now(),
            'updated_at' => now()
        ]);

        DB::table('jobs')->insert([
            'name' => 'Fullstack Web Programmer',
            'created_at' =>  now(),
            'updated_at' => now()
        ]);

        DB::table('jobs')->insert([
            'name' => 'Quality Control',
            'created_at' =>  now(),
            'updated_at' => now()
        ]);

        DB::table('jobs')->insert([
            'name' => 'System Implementator',
            'created_at' =>  now(),
            'updated_at' => now()
        ]);

        DB::table('jobs')->insert([
            'name' => 'DevOps Engineer',
            'created_at' =>  now(),
            'updated_at' => now()
        ]);
    }
}
