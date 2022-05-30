<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // calls user seeder before document seeder because
    // document seeder uses the users table. The same for signature seeder
    // it uses the documents table in the signature seeder
    public function run()
    {
        $this->call(UserSeeder::class);

        $this->call(DocumentSeeder::class);
        // $this->call(SignatureSeeder::class);



    }
}
