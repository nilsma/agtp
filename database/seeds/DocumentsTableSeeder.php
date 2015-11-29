<?php

use Illuminate\Database\Seeder;

class DocumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $random = str_random(10);

        DB::table('documents')->insert([
            'title' => $random,
            'filename' => $random . '.pdf',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => NULL,
            'owner_id' => 1
        ]);

        $random = str_random(10);

        DB::table('documents')->insert([
            'title' => $random,
            'filename' => $random . '.pdf',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => NULL,
            'owner_id' => 2
        ]);

        $random = str_random(10);

        DB::table('documents')->insert([
            'title' => $random,
            'filename' => $random . '.pdf',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => NULL,
            'owner_id' => 3
        ]);

        DB::table('documents')->insert([
            'title' => 'Orienteringsskriv om møte med Straume',
            'filename' => 'orienteringsskriv_01_2015_11_08.pdf',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => NULL,
            'owner_id' => 3
        ]);

    }
}
