@extends('layouts.master')

@section('title')
<title>Manajemen Jadwal Penerbangan</title>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Manajemen Jadwal Penerbangan </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}">Home</a></li>
            <li><a a href="{{ route('jadwal-penerbangan.index') }}">Jadwal Penerbangan</a></li>
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
                        <h3 class="box-title">Edit Jadwal Penerbangan</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    <form role="form" action="{{ route('jadwal-penerbangan.update', $jadwalPenerbangan->id) }}" method="POST">
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
                                <label for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal" value="{{ $jadwalPenerbangan->tanggal }}" class="form-control {{ $errors->has('tanggal') ? 'is-invalid':'' }}" id="tanggal" required>
                            </div>
                            <div class="form-group">
                                <label for="maskapai">Maskapai</label>
                                <select name="maskapai" id="maskapai" class="form-control {{ $errors->has('maskapai') ? 'is-invalid':'' }}" required>
                                    <option value="" selected disabled>-- PILIH MASKAPAI --</option>
                                    @foreach ($daftarMaskapai as $maskapai)
                                        <option value="{{ $maskapai->id }}" {{ $maskapai->id == $jadwalPenerbangan->maskapai_id ? 'selected' : '' }}>{{ $maskapai->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nomor_pesawat">Nomor Pesawat</label>
                                <input type="text" name="nomor_pesawat" value="{{ $jadwalPenerbangan->nomor_pesawat }}" class="form-control {{ $errors->has('nomor_pesawat') ? 'is-invalid':'' }}" id="nomor_pesawat" required>
                            </div>
                            <div class="form-group">
                                <label for="bandara_takeoff">Bandara Takeoff</label>
                                <input type="text" name="bandara_takeoff" value="{{ $jadwalPenerbangan->bandara_takeoff }}" class="form-control {{ $errors->has('bandara_takeoff') ? 'is-invalid':'' }}" id="bandara_takeoff" required>
                            </div>
                            <div class="form-group">
                                <label for="waktu_takeoff">Waktu Takeoff</label>
                                <input type="time" name="waktu_takeoff" value="{{ $jadwalPenerbangan->waktu_takeoff }}" class="form-control time-picker {{ $errors->has('waktu_takeoff') ? 'is-invalid':'' }}" id="waktu_takeoff" required>
                            </div>
                            <div class="form-group">
                                <label for="bandara_landing">Bandara Landing</label>
                                <input type="text" name="bandara_landing" value="{{ $jadwalPenerbangan->bandara_landing }}" class="form-control {{ $errors->has('bandara_landing') ? 'is-invalid':'' }}" id="bandara_landing" required>
                            </div>
                            <div class="form-group">
                                <label for="waktu_landing">Waktu Landing</label>
                                <input type="time" name="waktu_landing" value="{{ $jadwalPenerbangan->waktu_landing }}" class="form-control time-picker {{ $errors->has('waktu_landing') ? 'is-invalid':'' }}" id="waktu_landing" required>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button> &nbsp;&nbsp;
                            <a href="{{ route('jadwal-penerbangan.index') }}" class="btn btn-default">Batal</a>
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
