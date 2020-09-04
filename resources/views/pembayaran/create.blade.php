@extends('layouts.master')

@section('title')
<title>Manajemen Pembayaran</title>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Manajemen Pembayaran </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}">Home</a></li>
            <li><a a href="{{ route('pembayaran.index') }}">Pembayaran</a></li>
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
                        <h3 class="box-title">Tambah Pembayaran</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    <form role="form" action="{{ route('pembayaran.store') }}" method="POST">
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
                                <label for="tanggal_pembayaran">Tanggal Pembayaran</label>
                                <input type="date" name="tanggal_pembayaran" class="form-control {{ $errors->has('tanggal_pembayaran') ? 'is-invalid':'' }}" id="tanggal_pembayaran" required>
                            </div>                            
                            <div class="form-group">
                                <label for="transaksi">Nomor Transaksi</label>
                                <select name="transaksi" id="transaksi" class="form-control" required>
                                    <option value="" selected disabled>-- PILIH SATU --</option>
                                    @foreach ($daftarTransaksi as $transaksi)
                                    <option value="{{ $transaksi->id }}">{{ $transaksi->nomor_transaksi }} / {{ $transaksi->tanggal_transaksi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pembayaran_ke">Pembayaran ke</label>
                                <input type="number" name="pembayaran_ke" class="form-control {{ $errors->has('pembayaran_ke') ? 'is-invalid':'' }}" id="pembayaran_ke" required>
                            </div>
                            <div class="form-group">
                                <label for="nominal">Nominal</label>
                                <input type="text" name="nominal" class="form-control {{ $errors->has('nominal') ? 'is-invalid':'' }}" id="nominal" required>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan"
                                    class="form-control {{ $errors->has('keterangan') ? 'is-invalid':'' }}" cols="5"
                                    rows="5"></textarea>
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
