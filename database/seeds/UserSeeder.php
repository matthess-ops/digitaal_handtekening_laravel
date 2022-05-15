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
        factory(User::class)->create(['is_admin'=>true,'firstname' => 'matthijn','lastname' => 'hesselman', 'email' => 'matthijn@gmail.com', 'password' => bcrypt('password')]);
        factory(User::class)->create(['is_admin'=>false,'firstname' => 'henk','lastname' => 'frits', 'email' => 'hendrik@gmail.com', 'password' => bcrypt('password')]);
        factory(User::class, 100)->create();
    }
}
