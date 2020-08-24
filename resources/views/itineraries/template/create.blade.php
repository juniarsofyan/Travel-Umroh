@extends('layouts.app')

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
            <li><a href="#">Home</a></li>
            <li class="active">Template Itinerary</li>
        </ol>
    </section>

    {{-- Main content --}}
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tambah Template Itinerary</h3>
                    </div>

                    {{-- <form role="form" action="{{ route('itinerary-templates.store') }}" method="POST"> --}}
                    <form role="form" action="" method="POST">
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

                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Cancel</button> &nbsp;&nbsp;
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        @php
            $jumlahHari = 12;    
        @endphp
        
        {{-- NOTE: LOAD ITINERARY EVENTS --}}
        @livewire('itinerary-events', ['contact' => ''])
    </section>
</div>

@endsection
