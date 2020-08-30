<?php

namespace App\Http\Controllers;

use App\Maskapai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaskapaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftarMaskapai = Maskapai::orderBy('nama', 'ASC')->get();
        return view('maskapai.index', compact('daftarMaskapai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('maskapai.create');
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
            'kode_maskapai' => 'required|string',
            'nama' => 'string|string',
        ]);

        try {
            $maskapai = Maskapai::create([
                'kode_maskapai' => $request->kode_maskapai,
                'nama' => $request->nama,
                'user_id' => Auth::user()->id
            ]);

            return redirect()->route('maskapai.index')->with(['success' => 'Maskapai: ' . $maskapai->nama . ' ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Maskapai  $maskapai
     * @return \Illuminate\Http\Response
     */
    public function edit(Maskapai $maskapai)
    {
        return view('maskapai.edit', compact('maskapai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Maskapai  $maskapai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Maskapai $maskapai)
    {
        $this->validate($request, [
            'kode_maskapai' => 'required|string',
            'nama' => 'string|string',
            'user_id' => Auth::user()->id
        ]);

        try {
            //update data
            $maskapai->update([
                'kode_maskapai' => $request->kode_maskapai,
                'nama' => $request->nama,
                'user_id' => Auth::user()->id
            ]);

            //redirect ke route kategori.index
            return redirect(route('maskapai.index'))->with(['success' => 'Maskapai: ' . $maskapai->nama . ' diubah']);
        } catch (\Exception $e) {
            //jika gagal, redirect ke form yang sama lalu membuat flash message error
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Maskapai  $maskapai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maskapai $maskapai)
    {
        $maskapai->delete();
        return redirect()->back()->with(['success' => 'Maskapai: ' . $maskapai->nama . " telah dihapus!"]);
    }
}
