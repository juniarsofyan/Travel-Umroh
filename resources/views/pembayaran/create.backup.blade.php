@extends('layouts.master')

@section('title')
<title>Manajemen Pembayaran</title>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}">
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

                            <div class="row">
                                <div class="col-xs-3">
                                    <label for="tanggal_pembayaran">Tanggal Pembayaran</label>
                                    <input type="date" name="tanggal_pembayaran" class="form-control" value="{{ $tanggalSekarang }}" {{ $errors->has('tanggal_pembayaran') ? 'is-invalid':'' }}" id="tanggal_pembayaran" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label for="transaksi">Nomor Transaksi</label>
                                    <select name="transaksi" id="transaksi" class="form-control" required>
                                        <option value="" selected disabled>-- PILIH SATU --</option>
                                        @foreach ($daftarTransaksi as $transaksi)
                                        <option value="{{ $transaksi->id }}">{{ $transaksi->nomor_transaksi }} / {{ $transaksi->jamaah->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xs-2">
                                    <label for="pembayaran_ke">Pembayaran ke</label>
                                    <input type="number" name="pembayaran_ke" class="form-control {{ $errors->has('pembayaran_ke') ? 'is-invalid':'' }}" id="pembayaran_ke" min="0" readonly required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label for="jumlah_harus_dibayar">Jumlah harus dibayar</label>
                                    <input type="number" name="jumlah_harus_dibayar" class="form-control {{ $errors->has('jumlah_harus_dibayar') ? 'is-invalid':'' }}" id="jumlah_harus_dibayar" min="0" readonly required>
                                </div>
                                <div class="col-xs-4">
                                    <label for="jumlah_terbayar">Jumlah terbayar</label>
                                    <input type="number" name="jumlah_terbayar" class="form-control {{ $errors->has('jumlah_terbayar') ? 'is-invalid':'' }}" id="jumlah_terbayar" min="0" readonly required>
                                </div>
                                <div class="col-xs-4">
                                    <label for="sisa_pembayaran">Sisa pembayaran</label>
                                    <input type="number" name="sisa_pembayaran" class="form-control {{ $errors->has('sisa_pembayaran') ? 'is-invalid':'' }}" id="sisa_pembayaran" min="0" readonly required>
                                </div>
                            </div>




                            <div class="form-group">
                                <label for="tanggal_pembayaran">Tanggal Pembayaran</label>
                                <input type="date" name="tanggal_pembayaran" class="form-control" value="{{ $tanggalSekarang }}" {{ $errors->has('tanggal_pembayaran') ? 'is-invalid':'' }}" id="tanggal_pembayaran" required>
                            </div>                      
                            <div class="form-group">
                                <label for="transaksi">Nomor Transaksi</label>
                                <select name="transaksi" id="transaksi" class="form-control" required>
                                    <option value="" selected disabled>-- PILIH SATU --</option>
                                    @foreach ($daftarTransaksi as $transaksi)
                                    <option value="{{ $transaksi->id }}">{{ $transaksi->nomor_transaksi }} / {{ $transaksi->jamaah->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jumlah_harus_dibayar">Jumlah harus dibayar</label>
                                <input type="number" name="jumlah_harus_dibayar" class="form-control {{ $errors->has('jumlah_harus_dibayar') ? 'is-invalid':'' }}" id="jumlah_harus_dibayar" min="0" readonly required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_terbayar">Jumlah terbayar</label>
                                <input type="number" name="jumlah_terbayar" class="form-control {{ $errors->has('jumlah_terbayar') ? 'is-invalid':'' }}" id="jumlah_terbayar" min="0" readonly required>
                            </div>
                            <div class="form-group">
                                <label for="sisa_pembayaran">Sisa pembayaran</label>
                                <input type="number" name="sisa_pembayaran" class="form-control {{ $errors->has('sisa_pembayaran') ? 'is-invalid':'' }}" id="sisa_pembayaran" min="0" readonly required>
                            </div>

                            <div class="form-group">
                                <label for="pembayaran_ke">Pembayaran ke</label>
                                <input type="number" name="pembayaran_ke" class="form-control {{ $errors->has('pembayaran_ke') ? 'is-invalid':'' }}" id="pembayaran_ke" min="0" readonly required>
                            </div>
                            <div class="form-group">
                                <label for="nominal">Nominal</label>
                                <input type="number" name="nominal" class="form-control {{ $errors->has('nominal') ? 'is-invalid':'' }}" id="nominal" required>
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

@section('scripts')
    <script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>

    <script>
        $(function() {
            $('#transaksi').chosen();

            $('select[name=transaksi]').change(function() {
                getTerminBerikutnya();
            });
        });

        function getTerminBerikutnya() {
                
            let transaksiId = $('select[name=transaksi]').val();

            if (transaksiId) {
                $.ajax({
                    url: '{{ env('APP_API_URL') }}transaksi/' + transaksiId + '/termin',
                    type: 'GET',
                    headers: {
                        // 'Access-Control-Allow-Origin': '*',
                    },
                    crossDomain: true,
                    dataType: 'json',
                    success: function(result) {
                        $('input[name=jumlah_harus_dibayar]').val(result.jumlah_harus_dibayar);
                        $('input[name=jumlah_terbayar]').val(result.jumlah_terbayar);
                        $('input[name=sisa_pembayaran]').val(result.sisa_pembayaran);
                        $('input[name=pembayaran_ke]').val(result.termin_berikutnya);
                        $('input[name=nominal]').attr('max', result.sisa_pembayaran);
                    }
                });
            }
        }
    </script>
@endsection