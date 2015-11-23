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
        DB::table('documents')->insert([
            'title' => 'Orienteringsskriv om møte med Straume',
            'filename' => 'orienteringsskriv_01_2015_11_08.pdf',
        ]);

    }
}
