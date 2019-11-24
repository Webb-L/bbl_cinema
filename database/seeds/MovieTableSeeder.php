<?php

use Illuminate\Database\Seeder;

class MovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movie')->insert([
            [
                'movie_name'=>'复仇者联盟4：终局之战 Avengers: Endgame',
                'release_date'=>'00:00',
                'release_time'=>date('Y/m/d',strtotime('1 day')),
                'release_room'=>1,
                'tickets' => '30',
                'price'=>'103.98'
            ],[
                'movie_name'=>'阿凡达 Avatar',
                'release_date'=>'00:00',
                'release_time'=>date('Y/m/d',strtotime('2 day')),
                'release_room'=>2,
                'tickets' => '50',
                'price'=>'65.08'
            ],[
                'movie_name'=>'泰坦尼克号 Titanic',
                'release_date'=>'00:00',
                'release_time'=>date('Y/m/d',strtotime('3 day')),
                'release_room'=>3,
                'tickets' => '80',
                'price'=>'37.58'
            ]
        ]);
    }
}
