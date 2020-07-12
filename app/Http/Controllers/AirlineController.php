<?php

namespace App\Http\Controllers;

use App\Airline;
use Illuminate\Http\Request;

class AirlineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $airlines = Airline::orderBy('name', 'ASC')->get();
        return view('airlines.index', compact('airlines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('airlines.create');
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
            'code' => 'required|string',
            'name' => 'string|string',
        ]);

        try {
            $airlines = Airline::firstOrCreate([
                'code' => $request->code,
                'name' => $request->name
            ]);

            return redirect()->route('airlines.index')->with(['success' => 'airline: ' . $airlines->name . ' ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Airline  $airline
     * @return \Illuminate\Http\Response
     */
    public function edit(Airline $airline)
    {
        $airlines = Airline::findOrFail($airline);
        return view('airlines.edit', compact('airline'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Airline  $airline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Airline $airline)
    {
        $this->validate($request, [
            'code' => 'required|string',
            'name' => 'string|string',
        ]);

        try {
            //select data berdasarkan id
            $airlines = Airline::findOrFail($airline->id);

            //update data
            $airlines->update([
                'code' => $request->code,
                'name' => $request->name
            ]);

            //redirect ke route kategori.index
            return redirect(route('airlines.index'))->with(['success' => 'Airline: ' . $airlines->name . ' diubah']);
        } catch (\Exception $e) {
            //jika gagal, redirect ke form yang sama lalu membuat flash message error
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Airline  $airline
     * @return \Illuminate\Http\Response
     */
    public function destroy(Airline $airline)
    {
        $airlines = Airline::findOrFail($airline->id);
        $airlines->delete();
        return redirect()->back()->with(['success' => 'Airline: ' . $airlines->name . " telah dihapus!"]);
    }
}
