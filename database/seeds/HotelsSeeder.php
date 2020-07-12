<?php

use Illuminate\Database\Seeder;
use App\Hotel;

class HotelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hotels = [
            array('name' => 'Abraj Makkah Hotel', 'location' => 'Makkah'),
            array('name' => 'Ajyad Hotel', 'location' => 'Makkah'),
            array('name' => 'Al Bustan Golden Hotel', 'location' => 'Makkah'),
            array('name' => 'Al Maasah Hotel Makkah', 'location' => 'Makkah'),
            array('name' => 'Al Marwa Hotel Makkah', 'location' => 'Makkah'),
            array('name' => 'Al Rawasi Hotel Makkah', 'location' => 'Makkah'),
            array('name' => 'Al Safwa Orchid Royal', 'location' => 'Makkah'),
            array('name' => 'Al Shohada Hotel Makkah', 'location' => 'Makkah'),
            array('name' => 'Al-Khaleej Hotel Makkah', 'location' => 'Makkah'),
            array('name' => 'Al-Qadesia Hotel Makkah', 'location' => 'Makkah'),
            array('name' => 'Al-Rawassi Hotel Makkah', 'location' => 'Makkah'),
            array('name' => 'Dallah Ajyad Hotel Makkah', 'location' => 'Makkah'),
            array('name' => 'Dallah Shubaika Hotel Makkah', 'location' => 'Makkah'),
            array('name' => 'Dar Al Nadwa Hotel Makkah', 'location' => 'Makkah'),
            array('name' => 'Dar Al Tawid InterContinental Hotel', 'location' => 'Makkah'),
            array('name' => 'Dar Al-Salam Hotel Makkah', 'location' => 'Makkah'),
            array('name' => 'Dar El Eiman', 'location' => 'Makkah'),
            array('name' => 'Elaf Ajyad Hotel Makkah S', 'location' => 'Makkah'),
            array('name' => 'Elaf Kinda', 'location' => 'Makkah'),
            array('name' => 'Fairmont Royal Clock', 'location' => 'Makkah'),
            array('name' => 'Hawazen Hotel Makkah', 'location' => 'Makkah'),
            array('name' => 'Hilton Hotel and Tower Makkah', 'location' => 'Makkah'),
            array('name' => 'Hilton Makkah Saudi', 'location' => 'Makkah'),
            array('name' => 'Hyatt Hotel Regency', 'location' => 'Makkah'),
            array('name' => 'Le Meridien', 'location' => 'Makkah'),
            array('name' => 'Le Meridien Makkah Hotel', 'location' => 'Makkah'),
            array('name' => 'Makkah Hotel Saudi', 'location' => 'Makkah'),
            array('name' => 'Metropolitan Hotel Makkah', 'location' => 'Makkah'),
            array('name' => 'Metropolitan Palace Hotel Makkah', 'location' => 'Makkah'),
            array('name' => 'movenpick hotel residence hajar tower', 'location' => 'Makkah'),
            array('name' => 'Novotel Elaf Al-Huda Hotel', 'location' => 'Makkah'),
            array('name' => 'Pullman Grand Zam zam', 'location' => 'Makkah'),
            array('name' => 'Raffles Makkah Palace', 'location' => 'Makkah'),
            array('name' => 'Retaj Suite', 'location' => 'Makkah'),
            array('name' => 'Rotana Al Marwa Rayhan', 'location' => 'Makkah'),
            array('name' => 'Sheraton Makkah Hotel and Towers', 'location' => 'Makkah'),
            array('name' => 'Sofitel Elaf Kindah Hotel Makkah', 'location' => 'Makkah'),
            array('name' => 'Sofitel Makkah Hotel', 'location' => 'Makkah'),
            array('name' => 'Swiss Otel', 'location' => 'Makkah'),
            array('name' => 'Umm Alqura Hotel Makkah', 'location' => 'Makkah'),
            array('name' => 'White Palace Hotel Makkah', 'location' => 'Makkah'),

            array('name' => 'Al Ansar Diamond Hotel Madinah', 'location'=> 'Madinah'),
            array('name' => 'Al Ansar Golden Hotel Madinah', 'location'=> 'Madinah'),
            array('name' => 'Marriott Madinah Hotel', 'location'=> 'Madinah'),
            array('name' => 'Al Ansar Silver Hotel Madinah', 'location'=> 'Madinah'),
            array('name' => 'Movenpick Hotel Madinah', 'location'=> 'Madinah'),
            array('name' => 'Al Haram Plaza Hotel Madinah', 'location'=> 'Madinah'),
            array('name' => 'Sanabel Al Madinah Hotel', 'location'=> 'Madinah'),
            array('name' => 'Al Harithhyah Sheraton Hotel', 'location'=> 'Madinah'),
            array('name' => 'Dallah Medinah Hotel', 'location'=> 'Madinah'),
            array('name' => 'Dar Al Hijra InterContinental', 'location'=> 'Madinah'),
            array('name' => 'Sheraton Medina Hotel Madinah', 'location'=> 'Madinah'),
            array('name' => 'Dar Al Iman InterContinental', 'location'=> 'Madinah'),
            array('name' => 'Sofitel Elaf Taibah Hotel Madinah', 'location'=> 'Madinah'),
            array('name' => 'Dar Al Taqwa InterContinental', 'location'=> 'Madinah'),
            array('name' => 'Dallah Taibah Hotel', 'location'=> 'Madinah'),
            array('name' => 'Elaf Taibah Hotel', 'location'=> 'Madinah'),
            array('name' => 'Green Palace Hotel Madinah', 'location'=> 'Madinah'),
            array('name' => 'The Madina Oberoi Madinah', 'location'=> 'Madinah'),
            array('name' => 'Karam Golden Hotel Madinah', 'location'=> 'Madinah'),
            array('name' => 'Luxurious Rawadah Suites Hotel', 'location'=> 'Madinah'),
            array('name' => 'The Oberoi Medina Hotel', 'location'=> 'Madinah'),
            array('name' => 'Madinah Hilton', 'location'=> 'Madinah'), 
        ];

        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }
    }
}
