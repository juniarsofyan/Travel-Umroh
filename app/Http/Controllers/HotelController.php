<?php

namespace App\Http\Controllers;

use App\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = Hotel::orderBy('name', 'ASC')->get();
        return view('hotels.index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hotels.create');
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
            'name' => 'required|string|max:50',
            'location' => 'string',
        ]);

        try {
            $hotels = hotel::firstOrCreate([
                'name' => $request->name,
                'location' => $request->location
            ]);

            return redirect()->route('hotels.index')->with(['success' => 'hotel: ' . $hotels->name . ' ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
        $hotels = Hotel::findOrFail($hotel);
        return view('hotels.edit', compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'location' => 'string',
        ]);

        try {
            //select data berdasarkan id
            $hotels = Hotel::findOrFail($hotel->id);

            //update data
            $hotels->update([
                'name' => $request->name,
                'location' => $request->location
            ]);

            //redirect ke route kategori.index
            return redirect(route('hotels.index'))->with(['success' => 'Hotel: ' . $hotels->name . ' diubah']);
        } catch (\Exception $e) {
            //jika gagal, redirect ke form yang sama lalu membuat flash message error
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        $hotels = Hotel::findOrFail($hotel->id);
        $hotels->delete();
        return redirect()->back()->with(['success' => 'Hotel: ' . $hotels->name . " telah dihapus!"]);
    }
}
