<?php

use Illuminate\Database\Seeder;

class VerifiedEmailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('verified_emails')->insert([
            'email' => 'nilsma231@gmail.com',
            'created_at' => date('Y-m-d H:i:s')
        ]);

    }

}