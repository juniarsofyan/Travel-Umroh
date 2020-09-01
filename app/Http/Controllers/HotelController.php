<?php

namespace App\Http\Controllers;

use App\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftarHotel = Hotel::orderBy('nama', 'ASC')->get();
        return view('hotel.index', compact('daftarHotel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hotel.create');
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
            'nama' => 'required|string|max:50',
            'lokasi' => 'string',
        ]);

        try {
            $hotel = Hotel::create([
                'nama' => $request->nama,
                'lokasi' => $request->lokasi,
                'user_id' => Auth::user()->id
            ]);

            return redirect()->route('hotel.index')->with(['success' => 'Hotel: ' . $hotel->nama . ' ditambahkan']);
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
        return view('hotel.edit', compact('hotel'));
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
            'nama' => 'required|string|max:50',
            'lokasi' => 'string',
        ]);

        try {
            //update data
            $hotel->update([
                'nama' => $request->nama,
                'lokasi' => $request->lokasi,
                'user_id' => Auth::user()->id
            ]);

            //redirect ke route kategori.index
            return redirect(route('hotel.index'))->with(['success' => 'Hotel ' . $hotel->nama . ' diubah']);
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
        $hotel->delete();
        return redirect()->back()->with(['success' => 'Hotel: ' . $hotel->nama . " telah dihapus!"]);
    }
}
