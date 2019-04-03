<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $now = new DateTime();

        DB::table('products')->insert([
            'id' => 1,
            'name' => 'iPhone XR',
            'value' => 5000,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        DB::table('products')->insert([
            'id' => 2,
            'name' => 'Samsung 40" 4K',
            'value' => 3000,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        DB::table('products')->insert([
            'id' => 3,
            'name' => 'Nike Air',
            'value' => 500,
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
