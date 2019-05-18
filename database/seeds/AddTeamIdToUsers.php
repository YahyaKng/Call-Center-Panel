<?php

use Illuminate\Database\Seeder;

class AddTeamIdToUsers extends Seeder
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
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
