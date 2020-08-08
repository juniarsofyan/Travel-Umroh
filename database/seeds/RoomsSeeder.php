<?php

use Illuminate\Database\Seeder;
use App\Room;

class RoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = [
            array('room_type' => 'Double', 'number_of_beds' => 2), 
            array('room_type' => 'Triple', 'number_of_beds' => 3), 
            array('room_type' => 'Quad', 'number_of_beds' => 4), 
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
