<?php

use Illuminate\Database\Seeder;

class usSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('us')->insert([
            ['content' => 'teste']
        ]);
    }
}
