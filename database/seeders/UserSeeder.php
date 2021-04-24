<?php

namespace Database\Seeders;

use App\Models\User;
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
        $dev = User::create([
            'firstname' => "Dev",
            'lastname' => "Dev",
            'email' => "dev@siwei.fr",
            'password' => bcrypt("2BE3ornot2be_")
        ]);
        $dev->assignRole('dev');

        $admin = User::create([
            'firstname' => "Admin",
            'lastname' => "Admin",
            'email' => 'admin@siwei.fr',
            'password' => bcrypt("2BE3ornot2be_")
        ]);
        $admin->assignRole('admin');
    }
}
