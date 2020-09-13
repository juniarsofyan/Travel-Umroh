@extends('layouts.master')

@section('title')
<title>Manajemen Template Itinerary</title>
@endsection

@section('content')
{{-- Content Wrapper. Contains page content --}}
<div class="content-wrapper">
    {{-- Content Header (Page header) --}}
    <section class="content-header">
        <h1>Manajemen Template Itinerary</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}">Home</a></li>
            <li><a a href="{{ route('template-itinerary.index') }}">Template Itinerary</a></li>
            <li class="active">Tambah</li>
        </ol>
    </section>

    {{-- Main content --}}
    <section class="content">
        <form method="POST" action="{{ route('template-itinerary.store') }}">
            <div class="row">
                <div class="col-md-12">
                    {{-- general form elements --}}
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tambah Template Itinerary</h3>
                        </div>

                        {{-- <form role="form" action="{{ route('template-itinerary.store') }}" method="POST"> --}}
                        <div>
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
                                    <label for="kode_template">Kode Template</label>
                                    <input type="text" name="kode_template" class="form-control {{ $errors->has('kode_template') ? 'is-invalid':'' }}" id="kode_template" required>
                                </div>

                                <div class="form-group">
                                    <label for="jumlah_hari">Jumlah Hari</label>
                                    <input type="number" step="1" min="9" name="jumlah_hari" class="form-control {{ $errors->has('jumlah_hari') ? 'is-invalid':'' }}" id="jumlah_hari" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Kegiatan</h3>
                        </div>
                        <div class="box-body" id="events-list">
                            
                            <div class="row row-container">
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
                            </div>
                            
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button> &nbsp;&nbsp;
                            <a href="{{ route('template-itinerary.index') }}" class="btn btn-default">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
    </form>
    </section>
    {{-- /.content --}}
</div>
@endsection

@section('scripts')
<script>
    function appendNewEventInputs() {
        var newElementIndex = $(".row-container").length;

        var newElement = `<div class='row row-container' id='row${newElementIndex}'> <div class='col-xs-1'> <div class='form-group'> <label>${newElementIndex + 1}</label> </div> </div> <div class='col-xs-1'> <div class='form-group'> <label>Hari ke:</label> <input type='number' name='events[${newElementIndex}][hari_ke]' class='form-control' step='1' min='1'/> </div> </div> <div class='col-xs-3'> <div class='form-group'> <label>Kegiatan</label> <textarea name='events[${newElementIndex}][kegiatan]' class='form-control' cols='5' rows='5'></textarea> </div> </div> <div class='col-xs-2'> <div class='form-group'> <label>Keterangan</label> <textarea name='events[${newElementIndex}][keterangan]' class='form-control' cols='5' rows='5'></textarea> </div> </div> <div class='col-xs-2'> <div class='form-group'> <label>Estimasi (Jam)</label> <input type='number' name='events[${newElementIndex}][estimasi]' class='form-control' step='0.5' min='0'/> </div> </div> <div class='col-xs-1'> <div class='form-group'> <label>Sebelum penerbangan</label> <input type='checkbox' name='events[${newElementIndex}][tipe]' value='SEBELUM PENERBANGAN'> </div> </div> <div class='col-xs-2'> <div class='form-group'> <br/> <button type='button' class='btn btn-danger' onclick='removeEventInputs(row${newElementIndex})'> <i class='fa fa-trash'></i> </button> &nbsp; <button type='button' class='btn btn-primary' onclick='appendNewEventInputs()'> <i class='fa fa-plus'></i> </button> </div> </div> </div>`;

        $("#events-list").append(newElement);
    }

    function removeEventInputs(elementIndex)
    {
        const elementId = '#' + elementIndex.id;
        $(elementId).remove();
    }
</script>
@endsection