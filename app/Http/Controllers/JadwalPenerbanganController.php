<?php

namespace App\Http\Controllers;

use App\JadwalPenerbangan;
use App\Maskapai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPenerbanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftarJadwalPenerbangan = JadwalPenerbangan::with('maskapai')->orderBy('tanggal', 'ASC')->get();
        return view('jadwal-penerbangan.index', compact('daftarJadwalPenerbangan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $daftarMaskapai = Maskapai::all();
        return view('jadwal-penerbangan.create', compact('daftarMaskapai'));
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
            'tanggal' => 'required|date',
            'nomor_pesawat' => 'required|string',
            'bandara_takeoff' => 'required|string',
            'bandara_landing' => 'required|string',
            'waktu_takeoff' => 'required|string',
            'waktu_landing' => 'required|string',
            'maskapai' => 'required|integer'
        ]);

        try {
            $jadwalPenerbangan = JadwalPenerbangan::create([
                'tanggal' => $request->tanggal,
                'nomor_pesawat' => $request->nomor_pesawat,
                'bandara_takeoff' => $request->bandara_takeoff,
                'bandara_landing' => $request->bandara_landing,
                'waktu_takeoff' => $request->waktu_takeoff,
                'waktu_landing' => $request->waktu_landing,
                'maskapai_id' => $request->maskapai,
                'user_id' => Auth::user()->id
            ]);

            return redirect()->route('jadwal-penerbangan.index')->with(['success' => 'Jadwal Penerbangan: ' . $jadwalPenerbangan->nomor_pesawat . ' ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JadwalPenerbangan  $jadwalPenerbangan
     * @return \Illuminate\Http\Response
     */
    public function edit(JadwalPenerbangan $jadwalPenerbangan)
    {
        $daftarMaskapai = Maskapai::all();
        return view('jadwal-penerbangan.edit', compact('jadwalPenerbangan', 'daftarMaskapai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JadwalPenerbangan  $jadwalPenerbangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JadwalPenerbangan $jadwalPenerbangan)
    {
        $this->validate($request, [
            'tanggal' => 'required|date',
            'nomor_pesawat' => 'required|string',
            'bandara_takeoff' => 'required|string',
            'bandara_landing' => 'required|string',
            'waktu_takeoff' => 'required|string',
            'waktu_landing' => 'required|string',
            'maskapai' => 'required|integer'
        ]);

        try {
            //update data
            $jadwalPenerbangan->update([
                'tanggal' => $request->tanggal,
                'nomor_pesawat' => $request->nomor_pesawat,
                'bandara_takeoff' => $request->bandara_takeoff,
                'bandara_landing' => $request->bandara_landing,
                'waktu_takeoff' => $request->waktu_takeoff,
                'waktu_landing' => $request->waktu_landing,
                'maskapai_id' => $request->maskapai,
                'user_id' => Auth::user()->id
            ]);

            //redirect ke route kategori.index
            return redirect(route('jadwal-penerbangan.index'))->with(['success' => 'Jadwal Penerbangan ' . $jadwalPenerbangan->nama . ' diubah']);
        } catch (\Exception $e) {
            //jika gagal, redirect ke form yang sama lalu membuat flash message error
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JadwalPenerbangan  $jadwalPenerbangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(JadwalPenerbangan $jadwalPenerbangan)
    {
        $jadwalPenerbangan->delete();
        return redirect()->back()->with(['success' => 'JadwalPenerbangan: ' . $jadwalPenerbangan->nomor_pesawat . " telah dihapus!"]);
    }
}
