<?php

use App\JenisKamar;
use Illuminate\Database\Seeder;

class JenisKamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenisKamar = [
            array('nama' => 'Double', 'jumlah_orang' => 2, 'jumlah_kasur' => 4, 'user_id' => 1), 
            array('nama' => 'Triple', 'jumlah_orang' => 3, 'jumlah_kasur' => 6, 'user_id' => 1), 
            array('nama' => 'Quad', 'jumlah_orang' => 4, 'jumlah_kasur' => 8, 'user_id' => 1), 
        ];

        foreach ($jenisKamar as $room) {
            JenisKamar::create($room);
        }
    }
}
