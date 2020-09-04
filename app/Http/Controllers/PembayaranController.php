<?php

namespace App\Http\Controllers;

use App\Pembayaran;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftarPembayaran = Pembayaran::orderBy('tanggal_pembayaran', 'ASC')->get();
        return view('pembayaran.index', compact('daftarPembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $daftarTransaksi = Transaksi::all();
        return view('pembayaran.create', compact('daftarTransaksi'));
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
            'tanggal_pembayaran' => 'required|date',
            'transaksi' => 'required|integer',
            'pembayaran_ke' => 'required|integer',
            'nominal' => 'required|integer',
            'keterangan' => 'string',
        ]);

        try {
            $pembayaran = Pembayaran::create([
                'tanggal_pembayaran' => $request->tanggal_pembayaran,
                'transaksi_id' => $request->transaksi,
                'pembayaran_ke' => $request->pembayaran_ke,
                'nominal' => $request->nominal,
                'keterangan' => $request->keterangan,
                'user_id' => Auth::user()->id
            ]);

            return redirect()->route('pembayaran.index')->with(['success' => 'Pembayaran: ' . $pembayaran->nama . ' ditambahkan']);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return redirect()->back()->with(['success' => 'Pembayaran telah dihapus!']);
    }
}
