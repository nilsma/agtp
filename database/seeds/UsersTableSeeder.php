<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('asdflkj'),
            'role' => 'subscriber',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('asdflkj'),
            'role' => 'subscriber',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'asdflkj',
            'email' => 'asdflkj@gmail.com',
            'password' => bcrypt('asdflkj'),
            'role' => 'admin',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'nilsma',
            'email' => 'nilsma@gmail.com',
            'password' => bcrypt('asdflkj'),
            'role' => 'admin'
        ]);
    }
}
