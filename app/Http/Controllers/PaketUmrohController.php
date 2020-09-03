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

        $daftarPaketUmroh = PaketUmroh::with(
            [
                'maskapai' => function($maskapai) {
                    $maskapai->select('kode_maskapai', 'maskapai.nama');
                },
                'jenisKamar' => function($address) {
                    $address->select('jenis_kamar.nama');
                },
                'hotelMakkah' => function($address) {
                    $address->select('hotel.nama');
                },
                'hotelMadinah' => function($address) {
                    $address->select('hotel.nama');
                }
            ]
        )->get();

        // print_r($daftarPaketUmroh);exit();

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
        $daftarJenisKamar = JenisKamar::all();
        $daftarTemplateItinerary = TemplateItinerary::all(); // where('tanggal', '>', Carbon::now())->get();
        $daftarJadwalPenerbangan = JadwalPenerbangan::all();
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
        $this->validate($request, [
            'nama_paket' => 'required|string',
            'tanggal' => 'required|date',
            'jumlah_hari' => 'required|integer',
            'jumlah_orang' => 'required|string',
            'harga' => 'required|integer',
            'deskripsi' => 'required|string',
            'hotel_makkah' => 'required|integer',
            'hotel_madinah' => 'required|integer',
            'maskapai' => 'required|integer',
            'jenis_kamar' => 'required|integer',
        ]);

        try {
            $paketUmroh = PaketUmroh::create([
                'nama_paket' => $request->nama_paket,
                'tanggal' => $request->tanggal,
                'jumlah_hari' => $request->jumlah_hari,
                'jumlah_orang' => $request->jumlah_orang,
                'harga' => $request->harga,
                'hotel_makkah' => $request->hotel_makkah,
                'hotel_madinah' => $request->hotel_madinah,
                'maskapai_id' => $request->maskapai,
                'jenis_kamar_id' => $request->jenis_kamar,
                'deskripsi' => $request->deskripsi,
                'user_id' => Auth::user()->id
            ]);

            $paketUmroh->itinerary()->createMany($request->events);

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
