<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'email' => 'user@user.com',
            'is_admin' => FALSE,
            'password' => Hash::make('123123')
        ]);

        factory(User::class)->create([
            'email' => 'admin@admin.com',
            'is_admin' => TRUE,
            'password' => Hash::make('123123')
        ]);
    }
}
