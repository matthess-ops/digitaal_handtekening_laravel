<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        error_log("lets go");
        $files = glob('storage\app\public\documents\*');
        error_log(print_r($files,true));
        $splitted = explode("/", $files[0] );
        error_log(end( $splitted));

        $users = User::all();


        foreach ($users as $user) {
            foreach ($files as $file) {
                $splitFilename =explode('\\', $file );
                DB::table('documents')->insert([
                    'user_id' => $user->id,
                    'filepath' => $file,
                    'filename'=>end($splitFilename),
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),

                ]);            }

        }
    }
}
