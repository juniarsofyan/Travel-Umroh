@extends('layouts.master')

@section('title')
<title>Manajemen Transaksi</title>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}">
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
            <li class="active">Tambah</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- form start -->
        <form role="form" action="{{ route('transaksi.store') }}" method="POST">
            @csrf
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tambah Transaksi</h3>
                        </div>
                        <!-- /.box-header -->

                        
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
                                    <input type="date" name="tanggal_transaksi" value="{{ $tanggalSekarang }}" class="form-control {{ $errors->has('tanggal_transaksi') ? 'is-invalid':'' }}" id="tanggal_transaksi" readonly required>
                                </div>

                                <div class="form-group">
                                    <label for="nomor_transaksi">Nomor Transaksi</label>
                                    <input type="text" name="nomor_transaksi" value="{{ $nomorTransaksi }}" class="form-control {{ $errors->has('nomor_transaksi') ? 'is-invalid':'' }}" id="nomor_transaksi" required>
                                </div>

                                {{-- <div class="form-group">
                                    <label for="jamaah">Jamaah</label>
                                    <input type="text" name="jamaah" class="form-control {{ $errors->has('jamaah') ? 'is-invalid':'' }}" id="jamaah" required>
                                </div> --}}

                                <div class="form-group">
                                    <label for="jamaah">Jamaah</label>
                                    <select name="jamaah" id="jamaah" class="form-control">
                                        <option value="" selected disabled>-- PILIH SATU --</option>
                                        @foreach ($daftarJamaah as $jamaah)
                                            <option value="{{ $jamaah->id }}">{{ $jamaah->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="paket_umroh">Paket Umroh</label>
                                    <select name="paket_umroh" id="paket_umroh" class="form-control">
                                        <option value="" selected disabled>-- PILIH SATU --</option>
                                        @foreach ($daftarPaketUmroh as $paketUmroh)
                                            <option value="{{ $paketUmroh->id }}">{{ $paketUmroh->nama_paket }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="jenis_kamar">Tipe Kamar</label>
                                    <select name="jenis_kamar" id="jenis_kamar" class="form-control">
                                        <option value="" selected disabled>-- PILIH SATU --</option>
                                        @foreach ($daftarJenisKamar as $jenisKamar)
                                            <option value="{{ $jenisKamar->id }}">{{ $jenisKamar->nama }} - {{ $jenisKamar->jumlah_orang }} orang</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="jadwal_penerbangan">Jadwal Penerbangan</label>
                                    <select name="jadwal_penerbangan" id="jadwal_penerbangan" class="form-control">
                                        <option value="" selected disabled>-- PILIH SATU --</option>
                                        @foreach ($daftarJadwalPenerbangan as $jadwalPenerbangan)
                                            <option value="{{ $jadwalPenerbangan->id }}">{{ $jadwalPenerbangan->tanggal }} / {{ $jadwalPenerbangan->bandara_takeoff }} / {{ $jadwalPenerbangan->nomor_pesawat }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="template_itinerary">Template Itinerary</label>
                                    <select name="template_itinerary" id="template_itinerary" class="form-control">
                                        <option value="" selected disabled>-- PILIH SATU --</option>
                                        @foreach ($daftarTemplateItinerary as $templateItinerary)
                                            <option value="{{ $templateItinerary->id }}">{{ $templateItinerary->kode_template }} - {{ $templateItinerary->jumlah_hari }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi">Keterangan</label>
                                    <textarea name="deskripsi" id="deskripsi"
                                        class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':'' }}" cols="5"
                                        rows="5"></textarea>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            {{-- <div class="box-footer">
                                <button type="reset" class="btn btn-default">Batal</button> &nbsp;&nbsp;
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div> --}}
                    </div>
                    <!-- /.box -->

                </div>
                <!--/.col (left) -->
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Jadwal Kegiatan</h3>
                        </div>
                        <div class="box-body" id="itinerary-list">

                                <table id="datatable-standard" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Hari ke</th>
                                            <th>Tanggal Kegiatan</th>
                                            <th>Kegiatan</th>
                                            <th>Keterangan</th>
                                            <th>Estimasi</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Selesai</th>
                                        </tr>
                                    </thead>
                                    <tbody id="event-list">
                                        
                                    </tbody>
                                </table>
                        </div>
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Batal</button> &nbsp;&nbsp;
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </form>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

@section('scripts')
    <script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>

    <script>
        $(function() {
            $('#jamaah').chosen();

            $('#paket_umroh').chosen();

            $('#jenis_kamar').chosen();

            $('#jadwal_penerbangan').chosen();

            $('#template_itinerary').chosen();

            $('select[name=template_itinerary]').change(function() {
                generateItinerary();
            });

            $('select[name=template_itinerary]').change(function() {
                generateItinerary();
            });

            // $(selector).autocomplete(options);
        });

        function generateItinerary() {
                
                let jadwalPenerbangan = $('select[name=jadwal_penerbangan]').val();
                let templateItinerary = $('select[name=template_itinerary]').val();

                if (jadwalPenerbangan && templateItinerary) {
                    $.ajax({
                        url: '{{ env('APP_API_URL') }}paket-umroh/generate-itinerary/' + jadwalPenerbangan + '/' + templateItinerary,
                        type: 'GET',
                        headers: {
                            // 'Access-Control-Allow-Origin': '*',
                        },
                        crossDomain: true,
                        dataType: 'json',
                        success: function(result) {

                            var newElementIndex = 0;

                            // console.log(result);

                            $("tbody[id=event-list]").empty();

                            result.forEach(item => {
                                var newElement = `<tr> <td>${newElementIndex + 1}</td> <td> <input type='hidden' name='events[${newElementIndex}][hari_ke]' value='${item.hari_ke}'/> ${item.hari_ke} </td> <td> <input type='hidden' name='events[${newElementIndex}][tanggal_mulai]' value='${item.tanggal_mulai}'/> <input type='hidden' name='events[${newElementIndex}][tanggal_selesai]' value='${item.tanggal_selesai}'/> ${item.tanggal_mulai} </td> <td> <input type='hidden' name='events[${newElementIndex}][kegiatan]' value='${item.kegiatan}'/> ${item.kegiatan} </td> <td> <input type='hidden' name='events[${newElementIndex}][keterangan]' value='${item.keterangan}'/> ${item.keterangan} </td> <td> <input type='hidden' name='events[${newElementIndex}][tanggal]' value='${item.estimasi}'/> ${item.estimasi} jam </td> <td> <input type='text' name='events[${newElementIndex}][jam_mulai]' value='${item.jam_mulai}' class='form-control'/> </td> <td> <input type='text' name='events[${newElementIndex}][jam_selesai]' value='${item.jam_selesai}' class='form-control'/> </td> </tr>`;
                                $("tbody[id=event-list]").append(newElement);
                                newElementIndex++;
                            });
                        }
                    });
                }
            }
    </script>
@endsection