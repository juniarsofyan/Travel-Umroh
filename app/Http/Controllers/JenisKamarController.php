<?php

namespace App\Http\Controllers;

use App\JenisKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JenisKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftarJenisKamar = JenisKamar::orderBy('nama', 'ASC')->get();
        return view('jenis-kamar.index', compact('daftarJenisKamar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jenis-kamar.create');
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
            'nama' => 'required|string',
            'jumlah_orang' => 'required|integer',
            'jumlah_kasur' => 'required|integer',
        ]);

        try {
            $jenisKamar = JenisKamar::create([
                'nama' => $request->nama,
                'jumlah_orang' => $request->jumlah_orang,
                'jumlah_kasur' => $request->jumlah_kasur,
                'user_id' => Auth::user()->id
            ]);

            return redirect()->route('jenis-kamar.index')->with(['success' => 'Jenis Kamar: ' . $jenisKamar->nama . ' ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JenisKamar  $jenisKamar
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisKamar $jenisKamar)
    {
        return view('jenis-kamar.edit', compact('jenisKamar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JenisKamar  $jenisKamar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisKamar $jenisKamar)
    {
        $this->validate($request, [
            'nama' => 'required|string',
            'jumlah_orang' => 'required|integer',
            'jumlah_kasur' => 'required|integer',
        ]);

        try {
            //update data
            $jenisKamar->update([
                'nama' => $request->nama,
                'jumlah_orang' => $request->jumlah_orang,
                'jumlah_kasur' => $request->jumlah_kasur,
                'user_id' => Auth::user()->id
            ]);

            //redirect ke route kategori.index
            return redirect(route('jenis-kamar.index'))->with(['success' => 'Jenis Kamar: ' . $jenisKamar->nama . ' diubah']);
        } catch (\Exception $e) {
            //jika gagal, redirect ke form yang sama lalu membuat flash message error
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JenisKamar  $jenisKamar
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisKamar $jenisKamar)
    {
        $jenisKamar->delete();
        return redirect()->back()->with(['success' => 'Jenis Kamar: ' . $jenisKamar->nama . " telah dihapus!"]);
    }
}
