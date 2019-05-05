<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
//use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AccessTableSeeder::class);
    }
}

class AccessTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('reference_access')->delete();
        DB::table('reference_access')->insert([
            [
                'name' => 'public',
                'comment' => 'доступна всем, видна в списках',
                'created_at' => Carbon::now(),
            ], [
                'name' => 'unlisted',
                'comment' => 'доступна только по ссылке',
                'created_at' => Carbon::now(),
            ], [
                'name' => 'private',
                'comment' => 'доступна только отправившему',
                'created_at' => Carbon::now(),
            ]
        ]);
        DB::table('pasta_datas')->delete();
        DB::table('pasta_datas')->insert([
            [
                'user_id' => null,
                'access_id' => 1,
                'time_of_del' => null,
                'title' => 'test1',
                'text' => '1',
                'short_link' => null,
            ], [
                'user_id' => null,
                'access_id' => 1,
                'time_of_del' => null,
                'title' => 'test2',
                'text' => '1',
                'short_link' => 'aaaa',
            ], [
                'user_id' => null,
                'access_id' => 1,
                'time_of_del' => null,
                'title' => 'test3',
                'text' => '1',
                'short_link' => 'bbbb',
            ]
        ]);
    }
}
