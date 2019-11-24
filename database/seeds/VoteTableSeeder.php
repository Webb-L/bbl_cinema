<?php

use Illuminate\Database\Seeder;

class VoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vote')->insert([
            [
                'row'=>'5',
                'number'=>'6'
            ],[
                'row'=>'10',
                'number'=>'5'
            ],[
                'row'=>'10',
                'number'=>'8'
            ]
        ]);
    }
}
