<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Mousavi',
            'email' => 'superadmin@alopeyk.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'line' => '600',
            'team_id' => 1,
            'role_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Fallah',
            'email' => 'admin@alopeyk.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'line' => '427',
            'team_id' => 1,
            'role_id' => 2,
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Test',
            'email' => 'test@alopeyk.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'line' => '427',
            'team_id' => 2,
            'role_id' => 3,
            'created_by' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
