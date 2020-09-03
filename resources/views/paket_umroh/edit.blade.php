@extends('layouts.master')

@section('title')
<title>Manajemen Paket Umroh</title>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Manajemen Paket Umroh </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}">Home</a></li>
            <li><a a href="{{ route('paket-umroh.index') }}">Paket Umroh</a></li>
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
                        <h3 class="box-title">Edit Paket Umroh</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    <form role="form" action="{{ route('paket-umroh.update', $paketUmroh->id) }}" method="POST">
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
                                <label for="nama_paket">Nama Paket Umroh</label>
                                <input type="text" name="nama_paket" value="{{ $paketUmroh->nama_paket }}" class="form-control {{ $errors->has('nama_paket') ? 'is-invalid':'' }}" id="nama_paket" required>
                            </div>
    
                            <div class="form-group">
                                <label for="jumlah_hari">Jumlah Hari</label>
                                <input type="number" step="1" min="9" name="jumlah_hari" value="{{ $paketUmroh->jumlah_hari }}" class="form-control {{ $errors->has('jumlah_hari') ? 'is-invalid':'' }}" id="jumlah_hari" required>
                            </div>
    
                            <div class="form-group">
                                <label for="jumlah_orang">Jumlah Orang</label>
                                <input type="number" step="1" min="1" name="jumlah_orang" value="{{ $paketUmroh->jumlah_orang }}" class="form-control {{ $errors->has('jumlah_orang') ? 'is-invalid':'' }}" id="jumlah_orang" required>
                            </div>
    
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" min="0" name="harga" value="{{ $paketUmroh->harga }}" class="form-control {{ $errors->has('harga') ? 'is-invalid':'' }}" id="harga" required>
                            </div>
    
                            <div class="form-group">
                                <label for="hotel_makkah">Hotel Makkah:</label>
                                <select name="hotel_makkah" id="hotel_makkah" class="form-control" required>
                                    <option value="" selected disabled>-- PILIH SATU --</option>
                                    @foreach ($daftarHotelMakkah as $hotel)
                                        <option value="{{ $hotel->id }}" {{ $paketUmroh->hotel_makkah == $hotel->id ? "selected" : "" }}>{{ $hotel->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="hotel_madinah">Hotel Madinah:</label>
                                <select name="hotel_madinah" id="hotel_madinah" class="form-control" required>
                                    <option value="" selected disabled>-- PILIH SATU --</option>
                                    @foreach ($daftarHotelMadinah as $hotel)
                                        <option value="{{ $hotel->id }}" {{ $paketUmroh->hotel_madinah == $hotel->id ? "selected" : "" }}>{{ $hotel->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="form-group">
                                <label for="maskapai">Maskapai:</label>
                                <select name="maskapai" id="maskapai" class="form-control" required>
                                    <option value="" selected disabled>-- PILIH SATU --</option>
                                    @foreach ($daftarMaskapai as $maskapai)
                                        <option value="{{ $maskapai->id }}" {{ $paketUmroh->maskapai_id == $maskapai->id ? "selected" : "" }}>{{ $maskapai->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':'' }}" cols="5" rows="5">{{ $paketUmroh->deskripsi }}</textarea>
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
