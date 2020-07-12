<?php

use Illuminate\Database\Seeder;
use App\Airline;

class AirlinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $airlines = [
            array('code' => 'QZ', 'name' => 'Air Asia Indonesia'), 
            array('code' => 'ID', 'name' => 'Batik Air'), 
            array('code' => 'QG', 'name' => 'Citilink'), 
            array('code' => 'GA', 'name' => 'Garuda Indonesia'), 
            array('code' => 'KD', 'name' => 'Kal Star Aviation'), 
            array('code' => 'JT', 'name' => 'Lion Air'), 
            array('code' => 'SJ', 'name' => 'Sriwijaya Air'), 
            array('code' => 'SI', 'name' => 'Susi Air'), 
            array('code' => 'TN', 'name' => 'Trigana Air'), 
            array('code' => 'IW', 'name' => 'Wings Air'), 
        ];

        foreach ($airlines as $airline) {
            Airline::create($airline);
        }
    }
}
