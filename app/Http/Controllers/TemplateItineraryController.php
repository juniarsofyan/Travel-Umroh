<?php

namespace App\Http\Controllers;

use App\TemplateItinerary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TemplateItineraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftarTemplateItinerary = TemplateItinerary::all();

        return view('template-itinerary.index', compact('daftarTemplateItinerary'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('template-itinerary.create');
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
            'kode_template' => 'required|string',
            'jumlah_hari' => 'required|integer'
        ]);

        try {
            $templateItinerary = TemplateItinerary::create([
                'kode_template' => $request->kode_template,
                'jumlah_hari' => $request->jumlah_hari,
                'user_id' => Auth::user()->id
            ]);

            $templateItinerary->detailTemplate()->createMany($request->events);

            return redirect()->route('template-itinerary.index')->with(['success' => 'Itinerary: <b>' . $templateItinerary->kode_template . '</b> ditambahkan']);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TemplateItinerary  $TemplateItinerary
     * @return \Illuminate\Http\Response
     */
    public function edit(TemplateItinerary $templateItinerary)
    {
        $templateItineraryDetail = $templateItinerary->detailTemplate()->get();
        return view('template-itinerary.edit', compact('templateItinerary', 'templateItineraryDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TemplateItinerary  $TemplateItinerary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TemplateItinerary $templateItinerary)
    {
        $this->validate($request, [
            'kode_template' => 'required|string',
            'jumlah_hari' => 'required|integer'
        ]);

        try {

            //update data
            $templateItinerary->update([
                'kode_template' => $request->kode_template,
                'jumlah_hari' => $request->jumlah_hari,
                'user_id' => Auth::user()->id
            ]);

            $templateItinerary->detailTemplate()->delete();
            $templateItinerary->detailTemplate()->createMany($request->events);

            //redirect ke route kategori.index
            return redirect(route('template-itinerary.index'))->with(['success' => 'Template Itinerary ' . $templateItinerary->nama . ' diubah']);
        } catch (\Exception $e) {
            dd($e->getMessage());
            //jika gagal, redirect ke form yang sama lalu membuat flash message error
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TemplateItinerary  $TemplateItinerary
     * @return \Illuminate\Http\Response
     */
    public function destroy(TemplateItinerary $templateItinerary)
    {
        $templateItinerary->detailTemplate()->delete();
        $templateItinerary->delete();
        return redirect()->back()->with(['success' => 'Template Itinerary: ' . $templateItinerary->nama . " telah dihapus!"]);
    }
}
