<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'group_id' => 1,
            'name' => 'mj-300',
            'price' => 3500,
            'total_price' => 3500,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('products')->insert([
            'group_id' => 1,
            'name' => 'mj-400',
            'price' => 4000,
            'discount' => 10,
            'total_price' => 3600,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('products')->insert([
            'group_id' => 2,
            'name' => 'cb-1200',
            'price' => 1500,
            'discount' => 200,
            'total_price' => 1300,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
