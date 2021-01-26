<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**suporte@fabrica704.com.br
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Betho',
                'email' => 'eu@betho.com',
                'phone' => '85994253764',
                'password' => Hash::make('123456789'),
                'user_status_id' => '2',
                'user_type_id' => '1',
            ],
            [
                'name' => 'admin',
                'email' => 'admin@rubyrose.com.br',
                'phone' => '85994253764',
                'password' => Hash::make('123456789'),
                'user_status_id' => '2',
                'user_type_id' => '1',
            ],
            [
                'name' => 'Rubia',
                'email' => 'teste@teste.com.br',
                'phone' => '85994253762',
                'password' => Hash::make('admin12'),
                'user_status_id' => '2',
                'user_type_id' => '2',
            ],
        ]);
    }
}
