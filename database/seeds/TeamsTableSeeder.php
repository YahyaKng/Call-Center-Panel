<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            'name' => 'چت آنلاین',
            'slug' => 'online_chat',
            'max_meal_break' => 1,
            'max_rest_break' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('teams')->insert([
            'name' => 'پشتیبانی تلفنی',
            'slug' => 'call_support',
            'queues' => '["2000","1000"]',
            'max_meal_break' => 1,
            'max_rest_break' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
