<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\JadwalPenerbangan;
use App\JenisKamar;
use App\Maskapai;
use App\PaketUmroh;
use App\TemplateItinerary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaketUmrohController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $daftarPaketUmroh = PaketUmroh::get();

        $sql = "SELECT 
                    paket_umroh.id, nama_paket, jumlah_hari, jumlah_orang, harga, hotel_makkah.nama as hotel_makkah, hotel_madinah.nama as hotel_madinah, maskapai.nama as maskapai, deskripsi 
                FROM 
                    paket_umroh 
                inner join maskapai on paket_umroh.maskapai_id = maskapai.id 
                inner join hotel as hotel_makkah on paket_umroh.hotel_makkah = hotel_makkah.id 
                inner join hotel as hotel_madinah on paket_umroh.hotel_madinah = hotel_madinah.id";

        $daftarPaketUmroh = DB::select($sql);

        return view('paket_umroh.index', compact('daftarPaketUmroh'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $daftarHotelMakkah = Hotel::where('lokasi', 'Makkah')->get();
        $daftarHotelMadinah = Hotel::where('lokasi', 'Madinah')->get();
        $daftarMaskapai = Maskapai::all();
        return view('paket_umroh.create', compact('daftarHotelMakkah', 'daftarHotelMadinah', 'daftarMaskapai'));
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
            'nama_paket' => 'required|string',
            'jumlah_hari' => 'required|integer',
            'jumlah_orang' => 'required|string',
            'harga' => 'required|integer',
            'deskripsi' => 'required|string',
            'hotel_makkah' => 'required|integer',
            'hotel_madinah' => 'required|integer',
            'maskapai' => 'required|integer',
        ]);

        try {
            $paketUmroh = PaketUmroh::create([
                'nama_paket' => $request->nama_paket,
                'jumlah_hari' => $request->jumlah_hari,
                'jumlah_orang' => $request->jumlah_orang,
                'harga' => $request->harga,
                'hotel_makkah' => $request->hotel_makkah,
                'hotel_madinah' => $request->hotel_madinah,
                'maskapai_id' => $request->maskapai,
                'deskripsi' => $request->deskripsi,
                'user_id' => Auth::user()->id
            ]);

            return redirect()->route('paket-umroh.index')->with(['success' => 'Paket Umroh: <b>' . $paketUmroh->nama_paket . '</b> ditambahkan']);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PaketUmroh $paketUmroh)
    {
        $daftarHotelMakkah = Hotel::where('lokasi', 'Makkah')->get();
        $daftarHotelMadinah = Hotel::where('lokasi', 'Madinah')->get();
        $daftarMaskapai = Maskapai::all();
        return view('paket_umroh.edit', compact('paketUmroh', 'daftarHotelMakkah', 'daftarHotelMadinah', 'daftarMaskapai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaketUmroh $paketUmroh)
    {
        $this->validate($request, [
            'nama_paket' => 'required|string',
            'jumlah_hari' => 'required|integer',
            'jumlah_orang' => 'required|string',
            'harga' => 'required|integer',
            'deskripsi' => 'required|string',
            'hotel_makkah' => 'required|integer',
            'hotel_madinah' => 'required|integer',
            'maskapai' => 'required|integer',
        ]);

        try {
            //update data
            $paketUmroh->update([
                'nama_paket' => $request->nama_paket,
                'jumlah_hari' => $request->jumlah_hari,
                'jumlah_orang' => $request->jumlah_orang,
                'harga' => $request->harga,
                'hotel_makkah' => $request->hotel_makkah,
                'hotel_madinah' => $request->hotel_madinah,
                'maskapai_id' => $request->maskapai,
                'deskripsi' => $request->deskripsi,
                'user_id' => Auth::user()->id
            ]);

            //redirect ke route kategori.index
            return redirect(route('paket-umroh.index'))->with(['success' => 'Paket Umroh ' . $paketUmroh->nama_paket . ' diubah']);
        } catch (\Exception $e) {
            //jika gagal, redirect ke form yang sama lalu membuat flash message error
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaketUmroh $paketUmroh)
    {
        $paketUmroh->delete();
        return redirect()->back()->with(['success' => 'Paket Umroh: ' . $paketUmroh->nama_paket . " telah dihapus!"]);
    }

    public function generateItinerary($jadwalPenerbanganId, $templateItineraryId)
    {
        $newItinerary = array();

        $jadwalPenerbangan = JadwalPenerbangan::find($jadwalPenerbanganId);
        $templateItinerary = TemplateItinerary::find($templateItineraryId);

        $templateDetail = $templateItinerary->detailTemplate()->get();

        $index = 0;

        foreach ($templateDetail as $template)
        {
            if ($template->tipe == "SEBELUM PENERBANGAN") {

                $estimasiJam = floor($template->estimasi);
                $estimasiMenit = ($template->estimasi - $estimasiJam) * 60;

                $waktuTakeOff = Carbon::parse($jadwalPenerbangan->tanggal . ' ' . $jadwalPenerbangan->waktu_takeoff);
                
                $waktuMulai = Carbon::parse($waktuTakeOff)->subHours($estimasiJam)->subMinutes($estimasiMenit)->toMutable();
                $tanggalMulai = $waktuMulai->toDateString();
                $jamMulai = $waktuMulai->toTimeString();
                
                $waktuSelesai = $waktuTakeOff;
                $tanggalSelesai = $waktuSelesai->toDateString();
                $jamSelesai = $waktuSelesai->toTimeString();

                $newItinerary[$index]['hari_ke'] = $template->hari_ke;
                $newItinerary[$index]['kegiatan'] = $template->kegiatan;
                $newItinerary[$index]['keterangan'] = $template->keterangan;
                $newItinerary[$index]['estimasi'] = $template->estimasi;
                $newItinerary[$index]['tanggal_mulai'] = $tanggalMulai;
                $newItinerary[$index]['jam_mulai'] = $jamMulai;
                $newItinerary[$index]['tanggal_selesai'] = $tanggalSelesai;
                $newItinerary[$index]['jam_selesai'] = $jamSelesai;
                $newItinerary[$index]['paket_umroh_id'] = 0;
                $newItinerary[$index]['user_id'] = 0;

            } else {
                
                $previousIndex = $index - 1;
                
                $estimasiJam = floor($template->estimasi);
                $estimasiMenit = ($template->estimasi - $estimasiJam) * 60;

                $waktuMulai = Carbon::parse($newItinerary[$previousIndex]['tanggal_selesai'] . ' ' . $newItinerary[$previousIndex]['jam_selesai'])->toMutable();
                $tanggalMulai = $waktuMulai->toDateString();
                $jamMulai = $waktuMulai->toTimeString();

                $waktuSelesai = $waktuMulai->addHours($estimasiJam)->addMinutes($estimasiMenit)->toMutable();;
                $tanggalSelesai = $waktuSelesai->toDateString();
                $jamSelesai = $waktuSelesai->toTimeString();

                $newItinerary[$index]['hari_ke'] = $template->hari_ke;
                $newItinerary[$index]['kegiatan'] = $template->kegiatan;
                $newItinerary[$index]['keterangan'] = $template->keterangan;
                $newItinerary[$index]['estimasi'] = $template->estimasi;
                $newItinerary[$index]['tanggal_mulai'] = $tanggalMulai;
                $newItinerary[$index]['jam_mulai'] = $jamMulai;
                $newItinerary[$index]['tanggal_selesai'] = $tanggalSelesai;
                $newItinerary[$index]['jam_selesai'] = $jamSelesai;
                $newItinerary[$index]['paket_umroh_id'] = 0;
                $newItinerary[$index]['user_id'] = 0;
            }

            $index++;
        }

        return response()->json($newItinerary);
    }
}
