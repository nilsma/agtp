<?php

use Illuminate\Database\Seeder;

class ProtocolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('protocols')->insert([
            'title' => 'Referat fra styremøte 27.10.2015',
            'filename' => 'referat_02_2015_10_27.pdf',
            'event_date' => '2015-10-27',
            'is_approved' => 0
        ]);

        DB::table('protocols')->insert([
            'title' => 'Referat fra styremøte 08.10.2015',
            'filename' => 'referat_01_2015_10_08.pdf',
            'event_date' => '2015-10-08',
            'is_approved' => 1
        ]);

        DB::table('protocols')->insert([
            'title' => 'Referat fra styremøte 17.06.2015',
            'filename' => 'referat_00_2015_06_17.pdf',
            'event_date' => '2015-17_06',
            'is_approved' => 1
        ]);
    }
}
