@extends('layouts.master')

@section('title')
<title>Manajemen Transaksi</title>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Manajemen Transaksi </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}">Home</a></li>
            <li><a a href="{{ route('transaksi.index') }}">Transaksi</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Transaksi</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    <form role="form" action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="box-body">

                            {{-- IF SOMETHING WRONG HAPPENED --}}
                            @if ($errors->any())
                                @alert(['type' => 'danger'])
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li> {{ $error }} </li>
                                        @endforeach
                                    </ul>
                                @endalert
                            @endif

                            <div class="form-group">
                                <label for="tanggal_transaksi">Tanggal Transaksi</label>
                                <input type="date" name="tanggal_transaksi" value="{{ $transaksi->tanggal_transaksi }}" class="form-control {{ $errors->has('tanggal_transaksi') ? 'is-invalid':'' }}" id="tanggal_transaksi" required>
                            </div>

                            <div class="form-group">
                                <label for="jamaah">Jamaah</label>
                                <select name="jamaah" id="jamaah" class="form-control" required>
                                    <option value="" selected disabled>-- PILIH SATU --</option>
                                    @foreach ($daftarJamaah as $jamaah)
                                        <option value="{{ $jamaah->id }}" {{ $jamaah->id == $transaksi->jamaah_id ? "selected" : ""}}>{{ $jamaah->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="paket_umroh">Paket Umroh</label>
                                <select name="paket_umroh" id="paket_umroh" class="form-control" required>
                                    <option value="" selected disabled>-- PILIH SATU --</option>
                                    @foreach ($daftarPaketUmroh as $paketUmroh)
                                        <option value="{{ $paketUmroh->id }}" {{ $paketUmroh->id == $transaksi->paket_umroh_id ? "selected" : ""}}>{{ $paketUmroh->nama_paket }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jenis_kamar">Tipe Kamar</label>
                                <select name="jenis_kamar" id="jenis_kamar" class="form-control" required>
                                    <option value="" selected disabled>-- PILIH SATU --</option>
                                    @foreach ($daftarJenisKamar as $jenisKamar)
                                        <option value="{{ $jenisKamar->id }}" {{ $jenisKamar->id == $transaksi->jenis_kamar_id ? "selected" : ""}}>{{ $jenisKamar->nama }} - {{ $jenisKamar->jumlah_orang }} orang</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jadwal_penerbangan">Jadwal Penerbangan</label>
                                <select name="jadwal_penerbangan" id="jadwal_penerbangan" class="form-control" required>
                                    <option value="" selected disabled>-- PILIH SATU --</option>
                                    @foreach ($daftarJadwalPenerbangan as $jadwalPenerbangan)
                                        <option value="{{ $jadwalPenerbangan->id }}"  {{ $jadwalPenerbangan->id == $transaksi->jadwal_penerbangan_id ? "selected" : ""}}>{{ $jadwalPenerbangan->tanggal }} / {{ $jadwalPenerbangan->bandara_takeoff }} / {{ $jadwalPenerbangan->nomor_pesawat }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="template_itinerary">Template Itinerary</label>
                                <select name="template_itinerary" id="template_itinerary" class="form-control" required>
                                    <option value="" selected disabled>-- PILIH SATU --</option>
                                    @foreach ($daftarTemplateItinerary as $templateItinerary)
                                        <option value="{{ $templateItinerary->id }}" {{ $templateItinerary->id == $transaksi->template_itinerary_id ? "selected" : ""}}>{{ $templateItinerary->kode_template }} - {{ $templateItinerary->jumlah_hari }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Keterangan</label>
                                <textarea name="deskripsi" id="deskripsi"
                                    class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':'' }}" cols="5"
                                    rows="5">{{ $transaksi->deskripsi }}</textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Batal</button> &nbsp;&nbsp;
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->

            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
