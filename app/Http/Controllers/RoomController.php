<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::orderBy('room_type', 'ASC')->get();
        return view('rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'room_type' => 'required|string',
            'number_of_beds' => 'required|integer',
        ]);

        try {
            $rooms = Room::firstOrCreate([
                'room_type' => $request->room_type,
                'number_of_beds' => $request->number_of_beds
            ]);

            return redirect()->route('rooms.index')->with(['success' => 'room: ' . $rooms->room_type . ' ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        $rooms = Room::findOrFail($room);
        return view('rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $this->validate($request, [
            'room_type' => 'required|string',
            'number_of_beds' => 'required|integer',
        ]);

        try {
            //select data berdasarkan id
            $rooms = Room::findOrFail($room->id);

            //update data
            $rooms->update([
                'room_type' => $request->room_type,
                'number_of_beds' => $request->number_of_beds
            ]);

            //redirect ke route kategori.index
            return redirect(route('rooms.index'))->with(['success' => 'Room: ' . $rooms->room_type . ' diubah']);
        } catch (\Exception $e) {
            //jika gagal, redirect ke form yang sama lalu membuat flash message error
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $rooms = Room::findOrFail($room->id);
        $rooms->delete();
        return redirect()->back()->with(['success' => 'Room: ' . $rooms->room_type . " telah dihapus!"]);
    }
}
