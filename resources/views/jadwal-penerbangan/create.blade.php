@extends('layouts.master')

@section('title')
<title>Manajemen Jadwal Penerbangan</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.timepicker.min.css') }}" />
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
            <li class="active">Tambah</li>
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
                        <h3 class="box-title">Tambah Jadwal Penerbangan</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    <form role="form" action="{{ route('jadwal-penerbangan.store') }}" method="POST">
                        @csrf
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
                                <input type="date" name="tanggal" class="form-control {{ $errors->has('tanggal') ? 'is-invalid':'' }}" id="tanggal" required>
                            </div>
                            <div class="form-group">
                                <label for="maskapai">Maskapai</label>
                                <select name="maskapai" id="maskapai" class="form-control {{ $errors->has('maskapai') ? 'is-invalid':'' }}" required>
                                    <option value="" selected disabled>-- PILIH MASKAPAI --</option>
                                    @foreach ($daftarMaskapai as $maskapai)
                                        <option value="{{ $maskapai->id }}">{{ $maskapai->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nomor_pesawat">Nomor Pesawat</label>
                                <input type="text" name="nomor_pesawat" class="form-control {{ $errors->has('nomor_pesawat') ? 'is-invalid':'' }}" id="nomor_pesawat" required>
                            </div>
                            <div class="form-group">
                                <label for="bandara_takeoff">Bandara Takeoff</label>
                                <input type="text" name="bandara_takeoff" class="form-control {{ $errors->has('bandara_takeoff') ? 'is-invalid':'' }}" id="bandara_takeoff" required>
                            </div>
                            <div class="form-group">
                                <label for="waktu_takeoff">Waktu Takeoff</label>
                                <input type="time" name="waktu_takeoff" class="form-control time-picker {{ $errors->has('waktu_takeoff') ? 'is-invalid':'' }}" id="waktu_takeoff" required>
                            </div>
                            <div class="form-group">
                                <label for="bandara_landing">Bandara Landing</label>
                                <input type="text" name="bandara_landing" class="form-control {{ $errors->has('bandara_landing') ? 'is-invalid':'' }}" id="bandara_landing" required>
                            </div>
                            <div class="form-group">
                                <label for="waktu_landing">Waktu Landing</label>
                                <input type="time" name="waktu_landing" class="form-control time-picker {{ $errors->has('waktu_landing') ? 'is-invalid':'' }}" id="waktu_landing" required>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Batal</button> &nbsp;&nbsp;
                            <button type="submit" class="btn btn-primary">Simpan</button>
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

@section('scripts')
<script src="{{ asset('assets/js/jquery.inputmask.min.js') }}"></script>
<script>
    /* $(function () {
        $('.time-picker').inputmask("hh:mm", {
        placeholder: "HH:MM", 
        // insertMode: false, 
        showMaskOnHover: false,
        hourFormat: 24
      }
   );
    }); */
</script>
@endsection