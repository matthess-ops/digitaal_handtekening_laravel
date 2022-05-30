<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create an single admin user
        factory(User::class)->create(['is_admin'=>true,'firstname' => 'matthijn','lastname' => 'hesselman', 'email' => 'matthijn@gmail.com', 'password' => bcrypt('password')]);
        // create an single user
        factory(User::class)->create(['is_admin'=>false,'firstname' => 'hendrik','lastname' => 'frits', 'email' => 'hendrik@gmail.com', 'password' => bcrypt('password')]);
        // create 100 dummy user to fill the db
        factory(User::class, 100)->create();
    }
}
