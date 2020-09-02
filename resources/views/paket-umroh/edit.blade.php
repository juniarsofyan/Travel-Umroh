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
            <li class="active">Edit</li>
        </ol>
    </section>
    
    {{-- Main content --}}
    <section class="content">
        <form method="POST" action="{{ route('template-itinerary.update', $templateItinerary->id) }}">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="row">
                <div class="col-md-12">
                    {{-- general form elements --}}
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Ubah Template Itinerary</h3>
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
                                    <input type="text" name="kode_template" value="{{ $templateItinerary->kode_template }}" class="form-control {{ $errors->has('kode_template') ? 'is-invalid':'' }}" id="kode_template" required>
                                </div>

                                <div class="form-group">
                                    <label for="jumlah_hari">Jumlah Hari</label>
                                    <input type="number" step="1" min="9" name="jumlah_hari" value="{{ $templateItinerary->jumlah_hari }}" class="form-control {{ $errors->has('jumlah_hari') ? 'is-invalid':'' }}" id="jumlah_hari" required>
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
                            
                            @php
                                $index = 0;
                                $no = 1; 
                            @endphp

                            @foreach($templateItineraryDetail as $kegiatan)
                            <div class="row row-container" id="row{{ $index }}">
                                <div class="col-xs-1">
                                    <div class="form-group">
                                        <label>{{ $no++ }}.</label>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="form-group">
                                        <label>Hari ke:</label>
                                        <input type="number" name="events[{{ $index }}][hari_ke]" class="form-control" step="1" min="1" value="{{ $kegiatan->hari_ke }}"/>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label>Kegiatan</label>
                                        <textarea name="events[{{ $index }}][kegiatan]" class="form-control" cols="5" rows="5">{{ $kegiatan->kegiatan }}</textarea>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="events[{{ $index }}][keterangan]" class="form-control" cols="5" rows="5">{{ $kegiatan->keterangan }}</textarea>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                        <label>Estimasi (Jam)</label>
                                        <input type="number" name="events[{{ $index }}][estimasi]" class="form-control" step="0.5" min="0" value="{{ $kegiatan->estimasi }}"/>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="form-group">
                                        <label>Sebelum penerbangan</label>
                                        <input type="checkbox" name="events[{{ $index }}][tipe]" value="SEBELUM PENERBANGAN" {{ $kegiatan->tipe == 'SEBELUM PENERBANGAN' ? 'checked' : '' }}>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                        <br/>
                                        <button type="button" class="btn btn-danger" onclick="removeEventInputs('row{{ $index }}')"> <i class="fa fa-trash"></i> </button>
                                        <button type="button" class="btn btn-primary" onclick="appendNewEventInputs()"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            @php
                                $index++;
                            @endphp
                            @endforeach
                            
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
        const elementId = '#' + elementIndex;
        // console.log(elementId);
        $(elementId).remove();
    }
</script>
@endsection