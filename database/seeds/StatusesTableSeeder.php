<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'status' => 'Online',
        ]);
        DB::table('statuses')->insert([
            'status' => 'Rest Break',
        ]);
        DB::table('statuses')->insert([
            'status' => 'Meal Break',
        ]);
        DB::table('statuses')->insert([
            'status' => 'Offline',
        ]);
    }
}
