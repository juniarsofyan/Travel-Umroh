<?php

namespace App\Http\Controllers;

use App\JadwalPenerbangan;
use App\Jamaah;
use App\JenisKamar;
use App\PaketUmroh;
use App\TemplateItinerary;
use App\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sql = "SELECT
                    transaksi.id,
                    tanggal_transaksi,
                    nomor_transaksi,
                    jamaah.nama as jamaah,
                    paket_umroh.nama_paket as paket_umroh,
                    jenis_kamar.nama as jenis_kamar, 
                    jadwal_penerbangan.tanggal as jadwal_penerbangan
                FROM transaksi
                inner join jamaah on transaksi.jamaah_id = jamaah.id
                inner join paket_umroh on transaksi.paket_umroh_id = paket_umroh.id
                inner join jenis_kamar on transaksi.jenis_kamar_id = jenis_kamar.id
                inner join jadwal_penerbangan on transaksi.jadwal_penerbangan_id = jadwal_penerbangan.id 
        ";

        $daftarTransaksi = DB::select($sql);
        
        return view('transaksi.index', compact('daftarTransaksi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $daftarJamaah = Jamaah::all();
        $daftarPaketUmroh = PaketUmroh::all();
        $daftarJenisKamar = JenisKamar::all();
        $daftarJadwalPenerbangan = JadwalPenerbangan::all();
        $daftarTemplateItinerary = TemplateItinerary::all();
        $nomorTransaksi = $this->getTransactionNumber();

        return view('transaksi.create', compact('nomorTransaksi', 'daftarJamaah', 'daftarPaketUmroh', 'daftarJenisKamar', 'daftarJadwalPenerbangan', 'daftarTemplateItinerary'));
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
            'tanggal_transaksi' => 'required|date',
            'nomor_transaksi' => 'string',
            'jamaah' => 'required|integer',
            'paket_umroh' => 'required|integer',
            'jenis_kamar' => 'required|integer',
            'jadwal_penerbangan' => 'required|integer',
            'template_itinerary' => 'required|integer',
            'deskripsi' => 'string',
        ]);

        try {
            $transaksi = Transaksi::create([
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'nomor_transaksi' => $request->nomor_transaksi,
                'jamaah_id' => $request->jamaah,
                'paket_umroh_id' => $request->paket_umroh,
                'jenis_kamar_id' => $request->jenis_kamar,
                'jadwal_penerbangan_id' => $request->jadwal_penerbangan,
                'template_itinerary_id' => $request->template_itinerary,
                'deskripsi' => $request->deskripsi,
                'status_transaksi' => 'BELUM LUNAS',
                'user_id' => Auth::user()->id
            ]);

            // $transaksi->itinerary()->createMany($request->events);

            foreach ($request->events as $kegiatan) {
                $kegiatan['paket_umroh_id'] = $request->paket_umroh;
                $kegiatan['jamaah_id'] = $request->jamaah;
                $kegiatan['user_id'] = Auth::user()->id;
                $kegiatan['transaksi_id'] = $transaksi->id;
                
                $transaksi->itinerary()->create($kegiatan);

                // echo "<pre>";
                // print_r($kegiatan);
                // echo "</pre>";
            }

            // exit();

            return redirect()->route('transaksi.index')->with(['success' => 'Transaksi ditambahkan']);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        $daftarJamaah = Jamaah::all();
        $daftarPaketUmroh = PaketUmroh::all();
        $daftarJenisKamar = JenisKamar::all();
        $daftarJadwalPenerbangan = JadwalPenerbangan::all();
        $daftarTemplateItinerary = TemplateItinerary::all();
        $itinerary = $transaksi->itinerary()->get();

        return view('transaksi.edit', compact('itinerary', 'transaksi', 'daftarJamaah', 'daftarPaketUmroh', 'daftarJenisKamar', 'daftarJadwalPenerbangan', 'daftarTemplateItinerary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        /* $this->validate($request, [
            'tanggal_transaksi' => 'required|date',
            'nomor_transaksi' => 'required|string',
            'jamaah' => 'required|integer',
            'paket_umroh' => 'required|integer',
            'jenis_kamar' => 'required|integer',
            'jadwal_penerbangan' => 'required|integer',
            'template_itinerary' => 'required|integer',
            'deskripsi' => 'string',
        ]);

        try {
            $transaksi->update([
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'nomor_transaksi' => $request->nomor_transaksi,
                'jamaah_id' => $request->jamaah,
                'paket_umroh_id' => $request->paket_umroh,
                'jenis_kamar_id' => $request->jenis_kamar,
                'jadwal_penerbangan_id' => $request->jadwal_penerbangan,
                'template_itinerary_id' => $request->template_itinerary,
                'deskripsi' => $request->deskripsi,
                'user_id' => Auth::user()->id
            ]);

            return redirect()->route('transaksi.index')->with(['success' => 'Transaksi ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        } */


        // ----------------------------------------------- 

        $this->validate($request, [
            'tanggal_transaksi' => 'required|date',
            'nomor_transaksi' => 'required|string',
            'jamaah' => 'required|integer',
            'paket_umroh' => 'required|integer',
            'jenis_kamar' => 'required|integer',
            'jadwal_penerbangan' => 'required|integer',
            'template_itinerary' => 'required|integer',
            'deskripsi' => 'string',
        ]);

        try {
            $transaksi->update([
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'jamaah_id' => $request->jamaah,
                'paket_umroh_id' => $request->paket_umroh,
                'jenis_kamar_id' => $request->jenis_kamar,
                'jadwal_penerbangan_id' => $request->jadwal_penerbangan,
                'template_itinerary_id' => $request->template_itinerary,
                'deskripsi' => $request->deskripsi,
                'user_id' => Auth::user()->id
            ]);

            $transaksi->itinerary()->delete($request->events);

            foreach ($request->events as $kegiatan) {
                $kegiatan['paket_umroh_id'] = $request->paket_umroh;
                $kegiatan['jamaah_id'] = $request->jamaah;
                $kegiatan['user_id'] = Auth::user()->id;
                $kegiatan['transaksi_id'] = $transaksi->id;
                
                $transaksi->itinerary()->create($kegiatan);
            }

            return redirect()->route('transaksi.index')->with(['success' => 'Transaksi ditambahkan']);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->itinerary()->delete();
        $transaksi->delete();
        return redirect()->back()->with(['success' => 'Transaksi telah dihapus!']);
    }

    public function getTransactionNumber()
    {
        $monthNumberToAlphabet = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L');

        $monthIndex = Carbon::now()->startOfMonth()->month;
        $monthIndex = $monthIndex - 1;
        $yearTwoDigit = Carbon::now()->format('y');

        $lastTransactionNumber = Transaksi::select('nomor_transaksi')->orderBy('nomor_transaksi', 'DESC')->limit(1)->first()->nomor_transaksi;
        $lastTransactionNumber = (($lastTransactionNumber) ? substr($lastTransactionNumber, -4) : '0000');
        $nomorTransaksi = "ELT" . $yearTwoDigit . $monthNumberToAlphabet[$monthIndex] . $lastTransactionNumber;
        $nomorTransaksi++;

        return $nomorTransaksi;
    }
}
