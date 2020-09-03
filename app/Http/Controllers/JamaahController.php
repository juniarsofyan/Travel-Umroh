<?php

namespace App\Http\Controllers;

use App\Jamaah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JamaahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftarJamaah = Jamaah::orderBy('nama', 'ASC')->get();
        return view('jamaah.index', compact('daftarJamaah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jamaah.create');
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
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'telepon' => 'required|string',
            'email' => 'string',
            'alamat' => 'required|string',
        ]);

        try {
            $jamaah = Jamaah::create([
                'nama' => $request->nama,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'telepon' => $request->telepon,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'user_id' => Auth::user()->id
            ]);

            return redirect()->route('jamaah.index')->with(['success' => 'Jamaah: ' . $jamaah->nama . ' ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jamaah  $jamaah
     * @return \Illuminate\Http\Response
     */
    public function show(Jamaah $jamaah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jamaah  $jamaah
     * @return \Illuminate\Http\Response
     */
    public function edit(Jamaah $jamaah)
    {
        return view('jamaah.edit', compact('jamaah'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jamaah  $jamaah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jamaah $jamaah)
    {
        $this->validate($request, [
            'nama' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'telepon' => 'required|string',
            'email' => 'string',
            'alamat' => 'required|string',
        ]);

        try {
            //update data
            $jamaah->update([
                'nama' => $request->nama,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'telepon' => $request->telepon,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'user_id' => Auth::user()->id
            ]);

            //redirect ke route kategori.index
            return redirect(route('jamaah.index'))->with(['success' => 'Jamaah ' . $jamaah->nama . ' diubah']);
        } catch (\Exception $e) {
            //jika gagal, redirect ke form yang sama lalu membuat flash message error
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jamaah  $jamaah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jamaah $jamaah)
    {
        $jamaah->delete();
        return redirect()->back()->with(['success' => 'Jamaah: ' . $jamaah->nama . " telah dihapus!"]);
    }
}
