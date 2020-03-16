<?php

use Illuminate\Database\Seeder;

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todos')->insert([
            'text' => Str::random(10),
            'status' => 0,
            
        ]);

        DB::table('todos')->insert([
            'text' => Str::random(10),
            'status' => 1,
            
        ]);
    }
}
