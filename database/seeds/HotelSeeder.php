<?php

use Illuminate\Database\Seeder;
use App\Hotel;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hotels = [
            array('nama' => 'Abraj Makkah Hotel', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Ajyad Hotel', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Al Bustan Golden Hotel', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Al Maasah Hotel Makkah', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Al Marwa Hotel Makkah', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Al Rawasi Hotel Makkah', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Al Safwa Orchid Royal', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Al Shohada Hotel Makkah', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Al-Khaleej Hotel Makkah', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Al-Qadesia Hotel Makkah', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Al-Rawassi Hotel Makkah', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Dallah Ajyad Hotel Makkah', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Dallah Shubaika Hotel Makkah', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Dar Al Nadwa Hotel Makkah', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Dar Al Tawid InterContinental Hotel', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Dar Al-Salam Hotel Makkah', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Dar El Eiman', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Elaf Ajyad Hotel Makkah S', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Elaf Kinda', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Fairmont Royal Clock', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Hawazen Hotel Makkah', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Hilton Hotel and Tower Makkah', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Hilton Makkah Saudi', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Hyatt Hotel Regency', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Le Meridien', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Le Meridien Makkah Hotel', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Makkah Hotel Saudi', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Metropolitan Hotel Makkah', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Metropolitan Palace Hotel Makkah', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'movenpick hotel residence hajar tower', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Novotel Elaf Al-Huda Hotel', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Pullman Grand Zam zam', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Raffles Makkah Palace', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Retaj Suite', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Rotana Al Marwa Rayhan', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Sheraton Makkah Hotel and Towers', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Sofitel Elaf Kindah Hotel Makkah', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Sofitel Makkah Hotel', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Swiss Otel', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'Umm Alqura Hotel Makkah', 'lokasi' => 'Makkah', 'user_id' => 1),
            array('nama' => 'White Palace Hotel Makkah', 'lokasi' => 'Makkah', 'user_id' => 1),

            array('nama' => 'Al Ansar Diamond Hotel Madinah', 'lokasi'=> 'Madinah', 'user_id' => 1),
            array('nama' => 'Al Ansar Golden Hotel Madinah', 'lokasi'=> 'Madinah', 'user_id' => 1),
            array('nama' => 'Marriott Madinah Hotel', 'lokasi'=> 'Madinah', 'user_id' => 1),
            array('nama' => 'Al Ansar Silver Hotel Madinah', 'lokasi'=> 'Madinah', 'user_id' => 1),
            array('nama' => 'Movenpick Hotel Madinah', 'lokasi'=> 'Madinah', 'user_id' => 1),
            array('nama' => 'Al Haram Plaza Hotel Madinah', 'lokasi'=> 'Madinah', 'user_id' => 1),
            array('nama' => 'Sanabel Al Madinah Hotel', 'lokasi'=> 'Madinah', 'user_id' => 1),
            array('nama' => 'Al Harithhyah Sheraton Hotel', 'lokasi'=> 'Madinah', 'user_id' => 1),
            array('nama' => 'Dallah Medinah Hotel', 'lokasi'=> 'Madinah', 'user_id' => 1),
            array('nama' => 'Dar Al Hijra InterContinental', 'lokasi'=> 'Madinah', 'user_id' => 1),
            array('nama' => 'Sheraton Medina Hotel Madinah', 'lokasi'=> 'Madinah', 'user_id' => 1),
            array('nama' => 'Dar Al Iman InterContinental', 'lokasi'=> 'Madinah', 'user_id' => 1),
            array('nama' => 'Sofitel Elaf Taibah Hotel Madinah', 'lokasi'=> 'Madinah', 'user_id' => 1),
            array('nama' => 'Dar Al Taqwa InterContinental', 'lokasi'=> 'Madinah', 'user_id' => 1),
            array('nama' => 'Dallah Taibah Hotel', 'lokasi'=> 'Madinah', 'user_id' => 1),
            array('nama' => 'Elaf Taibah Hotel', 'lokasi'=> 'Madinah', 'user_id' => 1),
            array('nama' => 'Green Palace Hotel Madinah', 'lokasi'=> 'Madinah', 'user_id' => 1),
            array('nama' => 'The Madina Oberoi Madinah', 'lokasi'=> 'Madinah', 'user_id' => 1),
            array('nama' => 'Karam Golden Hotel Madinah', 'lokasi'=> 'Madinah', 'user_id' => 1),
            array('nama' => 'Luxurious Rawadah Suites Hotel', 'lokasi'=> 'Madinah', 'user_id' => 1),
            array('nama' => 'The Oberoi Medina Hotel', 'lokasi'=> 'Madinah', 'user_id' => 1),
            array('nama' => 'Madinah Hilton', 'lokasi'=> 'Madinah', 'user_id' => 1), 
        ];

        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }
    }
}
