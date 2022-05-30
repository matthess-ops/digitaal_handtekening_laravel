<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //for all documents in the documents folder create for each user and documents table entry.
    public function run()
    {
        $files = glob('storage\app\public\documents\*');

        $users = User::all();

        foreach ($users as $user) {
            foreach ($files as $file) {
                $splitFilename = explode('\\', $file);
                DB::table('documents')->insert([
                    'user_id' => $user->id,
                    'filepath' => $file,
                    'filename' => end($splitFilename),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),

                ]);
            }
        }
    }
}
