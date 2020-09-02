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
            <li><a href="#">Home</a></li>
            <li class="active">Paket Umroh</li>
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
                        <h3 class="box-title">Tambah Paket Umroh</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    <form role="form" action="{{ route('paket-umroh.store') }}" method="POST">
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
                                <label for="nama_paket">Nama Paket Umroh</label>
                                <input type="text" name="nama_paket" class="form-control {{ $errors->has('nama_paket') ? 'is-invalid':'' }}" id="nama_paket" required>
                            </div>

                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control {{ $errors->has('tanggal') ? 'is-invalid':'' }}" id="tanggal" required>
                            </div>

                            <div class="form-group">
                                <label for="jumlah_hari">Jumlah Hari</label>
                                <input type="number" step="1" min="9" name="jumlah_hari" class="form-control {{ $errors->has('jumlah_hari') ? 'is-invalid':'' }}" id="jumlah_hari" required>
                            </div>

                            <div class="form-group">
                                <label for="jumlah_orang">Jumlah Orang</label>
                                <input type="number" step="1" min="1" name="jumlah_orang" class="form-control {{ $errors->has('jumlah_orang') ? 'is-invalid':'' }}" id="jumlah_orang" required>
                            </div>

                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" min="0" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid':'' }}" id="harga" required>
                            </div>

                            <div class="form-group">
                                <label for="hotel_makkah">Hotel Makkah:</label>
                                <select name="hotel_makkah" id="hotel_makkah" class="form-control" required>
                                    <option value="" selected disabled>-- PILIH SATU --</option>
                                    @foreach ($daftarHotelMakkah as $hotel)
                                    <option value="{{ $hotel->id }}">{{ $hotel->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="hotel_madinah">Hotel Madinah:</label>
                                <select name="hotel_madinah" id="hotel_madinah" class="form-control" required>
                                    <option value="" selected disabled>-- PILIH SATU --</option>
                                    @foreach ($daftarHotelMadinah as $hotel)
                                        <option value="{{ $hotel->id }}">{{ $hotel->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="maskapai">Maskapai:</label>
                                <select name="maskapai" id="maskapai" class="form-control" required>
                                    <option value="" selected disabled>-- PILIH SATU --</option>
                                    @foreach ($daftarMaskapai as $maskapai)
                                        <option value="{{ $maskapai->id }}">{{ $maskapai->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jenis_kamar">Jenis Kamar:</label>
                                <select name="jenis_kamar" id="jenis_kamar" class="form-control" required>
                                    <option value="" selected disabled>-- PILIH SATU --</option>
                                    @foreach ($daftarJenisKamar as $kamar)
                                        <option value="{{ $kamar->id }}">{{ $kamar->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':'' }}" cols="5" rows="5"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="jadwal_penerbangan">Jadwal Penerbangan:</label>
                                <select name="jadwal_penerbangan" id="jadwal_penerbangan" class="form-control" required>
                                    <option value="" selected disabled>-- PILIH SATU --</option>
                                    @foreach ($daftarJadwalPenerbangan as $penerbangan)
                                        <option value="{{ $penerbangan->id }}">{{ $penerbangan->tanggal }} - {{ $penerbangan->nomor_pesawat }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="template_itinerary">Template Itinerary:</label>
                                <select name="template_itinerary" id="template_itinerary" class="form-control" required>
                                    <option value="" selected disabled>-- PILIH SATU --</option>
                                    @foreach ($daftarTemplateItinerary as $template)
                                        <option value="{{ $template->id }}">{{ $template->kode_template }} - {{ $template->jumlah_hari }} hari</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Cancel</button> &nbsp;&nbsp;
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->

            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Kegiatan</h3>
                    </div>
                    <div class="box-body" id="events-list">
                        
                        {{-- <div class="row row-container">
                            <div class="col-xs-1">
                                <div class="form-group">
                                    <label>1.</label>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="form-group">
                                    <label>Hari ke:</label>
                                    <input type="number" name="events[0][hari_ke]" class="form-control" step="1" min="1" />
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label>Kegiatan</label>
                                    <textarea name="events[0][kegiatan]" class="form-control" cols="5" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="events[0][keterangan]" class="form-control" cols="5" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="form-group">
                                    <label>Estimasi (Jam)</label>
                                    <input type="number" name="events[0][estimasi]" class="form-control" step="0.5" min="0" />
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="form-group">
                                    <label>Sebelum penerbangan</label>
                                    <input type="checkbox" name="events[0][tipe]" value="SEBELUM PENERBANGAN">
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="form-group">
                                    <br/>
                                    <button type="button" class="btn btn-primary" onclick="appendNewEventInputs()"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div> --}}
                        
                    </div>
                    <div class="box-footer">
                        {{-- <button wire:click="resetState" class="btn btn-default">Batal</button> &nbsp;&nbsp; --}}
                        {{-- <button type="submit" class="btn btn-primary">Simpan Itinerary</button> --}}
                        <button type="reset" class="btn btn-default">Batal</button> &nbsp;&nbsp;
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

@section('scripts')
    <script>
        $(function() {
            $('select[name=template_itinerary]').change(function() {

                let jadwalPenerbangan = $('select[name=jadwal_penerbangan]').val();

                $.ajax({
                    url: '{{ env('APP_API_URL') }}paket-umroh/generate-itinerary/' + jadwalPenerbangan + '/' + $(this).val(),
                    type: 'GET',
                    headers: {
                        // 'Access-Control-Allow-Origin': '*',
                    },
                    crossDomain: true,
                    dataType: 'json',
                    success: function(result) {

                        var newElementIndex = $(".row-container").length;

                        // console.log(result);

                        $("#events-list").empty();

                        result.forEach(item => {
                            var newElement = `<div class='row row-container' id='row${newElementIndex}'> <div class='col-xs-1'> <div class='form-group'> <label>${newElementIndex + 1}</label> </div> </div> <div class='col-xs-1'> <div class='form-group'> <label>Hari ke:</label> <input type='number' name='events[${newElementIndex}][hari_ke]' value='${item.hari_ke}' class='form-control' step='1' min='1'/> </div> </div> <div class='col-xs-3'> <div class='form-group'> <label>Kegiatan</label> <textarea name='events[${newElementIndex}][kegiatan]' class='form-control' cols='5' rows='5'>${item.kegiatan}</textarea> </div> </div> <div class='col-xs-2'> <div class='form-group'> <label>Keterangan</label> <textarea name='events[${newElementIndex}][keterangan]' class='form-control' cols='5' rows='5'>${item.keterangan}</textarea> </div> </div> <div class='col-xs-2'> <div class='form-group'> <label>Estimasi (Jam)</label> <input type='number' name='events[${newElementIndex}][estimasi]' class='form-control' step='0.5' min='0'/> </div> </div> <div class='col-xs-1'> <div class='form-group'> <label>Sebelum penerbangan</label> <input type='checkbox' name='events[${newElementIndex}][tipe]' value='SEBELUM PENERBANGAN'> </div> </div> <div class='col-xs-2'> <div class='form-group'> <br/> <button type='button' class='btn btn-danger' onclick='removeEventInputs(row${newElementIndex})'> <i class='fa fa-trash'></i> </button> &nbsp; <button type='button' class='btn btn-primary' onclick='appendNewEventInputs()'> <i class='fa fa-plus'></i> </button> </div> </div> </div>`;
                            $("#events-list").append(newElement);
                        });
                        


                        /* var select = $('select[name=kota]');

                        select.empty();

                        select.append('<option selected disabled>-- Pilih Kota --</option>');

                        $.each(result.data,function(key, value) {
                            select.append('<option value=' + value.city_id + '>' + value.city_name + '</option>');
                        }); */
                    }
                });
            });
        });
    </script>
@endsection