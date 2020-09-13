<?php

namespace App\Http\Controllers;

use App\Pembayaran;
use App\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftarPembayaran = Pembayaran::with([
            'transaksi' => function($transaksi) {
                $transaksi->select('id', 'nomor_transaksi');
            }
        ])->orderBy('tanggal_pembayaran', 'ASC')->get();
        return view('pembayaran.index', compact('daftarPembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tanggalSekarang = Carbon::now()->toDateString();

        $daftarTransaksi = Transaksi::select('id', 'tanggal_transaksi', 'nomor_transaksi', 'jamaah_id')->with([
            'jamaah' => function($jamaah) {
                $jamaah->select('id', 'nama');
            }
        ])->where('status_transaksi', 'BELUM LUNAS')->get();

        // $pembayaran = Pembayaran::with('transaksi')->with('transaksi.jamaah')->get();
        return view('pembayaran.create', compact('tanggalSekarang', 'daftarTransaksi'));
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

            if ($request->nominal == $request->sisa_pembayaran) {
                Transaksi::find($request->transaksi)->update([
                    'status_transaksi' => 'LUNAS'
                ]);
            }

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

    public function getTerminPembayaran($transaksiId)
    {
        $terminTerakhir = Pembayaran::where('transaksi_id', $transaksiId)->count();

        $terminBerikutnya = array('termin_berikutnya' => $terminTerakhir + 1);

        // return response()->json($terminBerikutnya);
        
        $pembayaranTerakhir = DB::table('pembayaran')->select(DB::raw('COUNT(pembayaran_ke) AS jumlah_termin, SUM(nominal) AS jumlah_terbayar'))
            ->where('transaksi_id', $transaksiId)
            ->groupBy('transaksi_id')
            ->first();

        $hargaPaketUmroh = Transaksi::where('id', $transaksiId)
                            ->with([
                                'paketUmroh' => function ($paketUmroh) {
                                    $paketUmroh->select('id', 'harga');
                                }
                            ])->first()->paketUmroh->harga;
                            
        $pembayaranBerikutnya = array();

        if ($pembayaranTerakhir) {
            $pembayaranBerikutnya = array(
                'termin_berikutnya' => $pembayaranTerakhir->jumlah_termin + 1,
                'jumlah_harus_dibayar' => $hargaPaketUmroh,
                'jumlah_terbayar' => (int) $pembayaranTerakhir->jumlah_terbayar,
                'sisa_pembayaran' => $hargaPaketUmroh - $pembayaranTerakhir->jumlah_terbayar
            );
        } else {
            $pembayaranBerikutnya = array(
                'termin_berikutnya' => 1,
                'jumlah_harus_dibayar' => $hargaPaketUmroh,
                'jumlah_terbayar' => 0,
                'sisa_pembayaran' => $hargaPaketUmroh
            );
        }

        return response()->json($pembayaranBerikutnya);
        
    }

    public function getPembayaranBelumLunas()
    {
        $daftarTransaksi = Transaksi::select('id', 'tanggal_transaksi', 'nomor_transaksi', 'jamaah_id')->with([
            'jamaah' => function($jamaah) {
                $jamaah->select('id', 'nama');
            }
        ])->where('status_transaksi', 'BELUM LUNAS')->get();

        return response()->json($daftarTransaksi);
    }
}
