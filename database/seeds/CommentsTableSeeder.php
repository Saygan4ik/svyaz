<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'user_id' => 1,
            'product_id' => 1,
            'text' => 'comment 1',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('comments')->insert([
            'user_id' => 2,
            'product_id' => 1,
            'text' => 'comment 2',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('comments')->insert([
            'user_id' => 2,
            'product_id' => 1,
            'text' => 'comment 3',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('comments')->insert([
            'user_id' => 2,
            'product_id' => 2,
            'text' => 'comment 4',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('comments')->insert([
            'user_id' => 2,
            'product_id' => 3,
            'text' => 'comment 5',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
