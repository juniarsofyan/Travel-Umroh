<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\JadwalPenerbangan;
use App\JenisKamar;
use App\Maskapai;
use App\TemplateItinerary;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaketUmrohController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('template-itinerary.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $daftarHotelMakkah = Hotel::where('lokasi', 'Makkah')->get(); // where('tanggal', '>', Carbon::now())->get();
        $daftarHotelMadinah = Hotel::where('lokasi', 'Madinah')->get(); // where('tanggal', '>', Carbon::now())->get();
        $daftarMaskapai = Maskapai::all(); // where('tanggal', '>', Carbon::now())->get();
        $daftarJenisKamar = JenisKamar::all(); // where('tanggal', '>', Carbon::now())->get();
        $daftarTemplateItinerary = TemplateItinerary::all();
        $daftarJadwalPenerbangan = JadwalPenerbangan::all(); // where('tanggal', '>', Carbon::now())->get();
        return view('paket_umroh.create', compact('daftarTemplateItinerary', 'daftarJadwalPenerbangan', 'daftarHotelMakkah', 'daftarHotelMadinah', 'daftarMaskapai', 'daftarJenisKamar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function generateItinerary($jadwalPenerbanganId, $templateItineraryId)
    {
        // $waktuTakeOff = $jadwalPenerbangan->tanggal . ' ' . $jadwalPenerbangan->waktu_takeoff;
        // $waktuLanding = $jadwalPenerbangan->tanggal . ' ' . $jadwalPenerbangan->waktu_landing;
        
        // $start_time = \Carbon\Carbon::parse($waktuTakeOff);
        // $finish_time = \Carbon\Carbon::parse($waktuLanding);

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

                $waktuTakeOff = $jadwalPenerbangan->tanggal . ' ' . $jadwalPenerbangan->waktu_takeoff;
                $waktuMulai = Carbon::parse($waktuTakeOff)->subHours($estimasiJam)->subMinutes($estimasiMenit)->toMutable();
                $tanggalKegiatan = $waktuMulai->toDateString();
                $waktuSelesai = $waktuTakeOff;

                $newItinerary[$index]['hari_ke'] = $template->hari_ke;
                $newItinerary[$index]['tanggal'] = $tanggalKegiatan;
                $newItinerary[$index]['kegiatan'] = $template->kegiatan;
                $newItinerary[$index]['keterangan'] = $template->keterangan;
                $newItinerary[$index]['waktu_mulai'] = $waktuMulai->toDateTimeString();
                $newItinerary[$index]['waktu_selesai'] = $waktuSelesai;
                $newItinerary[$index]['paket_umroh_id'] = 0;
                $newItinerary[$index]['user_id'] = 0;
            } else {
                
                $previousIndex = $index - 1;
                
                $estimasiJam = floor($template->estimasi);
                $estimasiMenit = ($template->estimasi - $estimasiJam) * 60;

                $previousWaktuSelesai = $newItinerary[$previousIndex]['waktu_selesai'];
                $tanggalKegiatan = Carbon::parse($previousWaktuSelesai)->toMutable();
                $waktuMulai = $tanggalKegiatan->toDateTimeString();
                $waktuSelesai = Carbon::parse($waktuMulai)->addHours($estimasiJam)->addMinutes($estimasiMenit)->toMutable();

                $newItinerary[$index]['hari_ke'] = $template->hari_ke;
                $newItinerary[$index]['tanggal'] = $tanggalKegiatan->toDateString();
                $newItinerary[$index]['kegiatan'] = $template->kegiatan;
                $newItinerary[$index]['keterangan'] = $template->keterangan;
                $newItinerary[$index]['waktu_mulai'] = $waktuMulai;
                $newItinerary[$index]['waktu_selesai'] = $waktuSelesai->toDateTimeString();
                $newItinerary[$index]['paket_umroh_id'] = 0;
                $newItinerary[$index]['user_id'] = 0;
            }

            $index++;
        }

        return response()->json($newItinerary);
    }
}
