<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Alex',
            'email' => '984814@swansea.ac.uk',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);
        $user->save();

        User::factory()->count(25)->create();
    }
}
