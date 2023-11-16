<?php

namespace Database\Seeders\Users;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::factory()->create([
            'first_name' => 'Super',
            'last_name'  => 'Admin',
            'email'      => 'super@admin.com',
        ]);
        $user->assignRole('administrator');
    }
}
