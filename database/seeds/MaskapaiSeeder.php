<?php

use Illuminate\Database\Seeder;
use App\Maskapai;

class MaskapaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $airlines = [
            array('kode_maskapai' => 'QZ', 'nama' => 'Air Asia Indonesia', 'user_id' => 1), 
            array('kode_maskapai' => 'ID', 'nama' => 'Batik Air', 'user_id' => 1), 
            array('kode_maskapai' => 'QG', 'nama' => 'Citilink', 'user_id' => 1), 
            array('kode_maskapai' => 'GA', 'nama' => 'Garuda Indonesia', 'user_id' => 1), 
            array('kode_maskapai' => 'KD', 'nama' => 'Kal Star Aviation', 'user_id' => 1), 
            array('kode_maskapai' => 'JT', 'nama' => 'Lion Air', 'user_id' => 1), 
            array('kode_maskapai' => 'SJ', 'nama' => 'Sriwijaya Air', 'user_id' => 1), 
            array('kode_maskapai' => 'SI', 'nama' => 'Susi Air', 'user_id' => 1), 
            array('kode_maskapai' => 'TN', 'nama' => 'Trigana Air', 'user_id' => 1), 
            array('kode_maskapai' => 'IW', 'nama' => 'Wings Air', 'user_id' => 1), 
        ];

        foreach ($airlines as $airline) {
            Maskapai::create($airline);
        }
    }
}
