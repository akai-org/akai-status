<?php

use Illuminate\Database\Seeder;
use App\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (! Role::whereName('admin')->exists()) {
            $admin = new Role();
            $admin->name         = 'admin';
            $admin->display_name = 'Administrator'; // optional
            $admin->description  = 'User is the admin of the application'; // optional
            $admin->save();

            $user = new Role();
            $user->name         = 'user';
            $user->display_name = 'User'; // optional
            $user->description  = 'User is an AKAI member'; // optional
            $user->save();
        }
        //factory(\App\Event::class, 10)->create();
    }
}
