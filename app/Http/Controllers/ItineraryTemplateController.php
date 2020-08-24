<?php

namespace App\Http\Controllers;

use App\ItineraryTemplate;
use Illuminate\Http\Request;

class ItineraryTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itineraryTemplates = ItineraryTemplate::withCount('detailTemplate')->get();

        return view('itineraries.template.index', compact('itineraryTemplates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('itineraries.template.create');
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
            $itineraryTemplate = ItineraryTemplate::create($request->all());

            $itineraryTemplate->detailTemplate()->createMany($request->events);

            return redirect()->route('itinerary-templates.index')->with(['success' => 'Itinerary: <b>' . $itineraryTemplate->kode_template . '</b> ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItineraryTemplate  $itineraryTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(ItineraryTemplate $itineraryTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItineraryTemplate  $itineraryTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(ItineraryTemplate $itineraryTemplate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItineraryTemplate  $itineraryTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItineraryTemplate $itineraryTemplate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItineraryTemplate  $itineraryTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItineraryTemplate $itineraryTemplate)
    {
        //
    }
}
