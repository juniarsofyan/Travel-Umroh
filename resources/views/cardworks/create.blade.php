@extends('layouts.master')

@section('title')
    <title>Manajemen Kartu Kerja</title>
@endsection

@section('styles')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Manajemen Kartu Kerja </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Kartu Kerja</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border text-center">
                        <h3 class="box-title" style="margin-top:1em;margin-bottom:1em;">Kartu Kerja</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    <form role="form" action="{{ route('cardwork.store') }}" method="POST">
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
                                {!! Form::label('date', 'Tanggal') !!}

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    {!! Form::text('date', null, array('required', 'id' => 'datepicker', 'class'=>(($errors->has("date")) ? "is-invalid":"").' form-control pull-right')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('category', 'Kategori') !!}
                                {!! Form::select('category', $categories, null, ['required', 'class' => 'form-control','placeholder' => '-- PILIH KATEGORI --']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('po_number', 'Nomor PO') !!}
                                {!! Form::text('po_number', null, array('class'=>(($errors->has("po_number")) ? "is-invalid":"").' form-control ')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('inventory', 'Barang') !!}
                                {!! Form::select('inventory', $inventories, null, ['required', 'class' => 'form-control','placeholder' => '-- PILIH BARANG --']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('process', 'Proses') !!}
                                {!! Form::select('process', $processes, null, ['required', 'class' => 'form-control','placeholder' => '-- PILIH PROSES --']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('customer', 'Customer') !!}
                                {!! Form::select('customer', $customers, null, ['required', 'class' => 'form-control','placeholder' => '-- PILIH CUSTOMER --']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('project', 'Project') !!}
                                {!! Form::select('project', $projects, null, ['required', 'class' => 'form-control','placeholder' => '-- PILIH PROJECT --']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('officer', 'Petugas') !!}
                                {!! Form::select('officer', $officers, null, ['required', 'class' => 'form-control','placeholder' => '-- PILIH PETUGAS --']) !!}
                            </div>

                            {{-- CARD WORK DETAIL --}}

                            <div class="box-header with-border text-center">
                                <h3 class="box-title" style="margin-top:1em;margin-bottom:1em;">Detail Kartu Kerja</h3>
                            </div>

                            <div class="form-group">
                                {!! Form::label('component', 'Komponen') !!}
                                {!! Form::select('component', $components, isset($cardwork_detail->component_id) ? $cardwork_detail->component_id : null, ['class' => 'form-control','placeholder' => '-- PILIH KOMPONEN --']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('problem', 'Masalah') !!}
                                {!! Form::textarea('problem', isset($cardwork_detail->problem) ? $cardwork_detail->problem : null, array('required', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class'=>(($errors->has("problem")) ? "is-invalid":"").' form-control ')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('solution', 'Pengerjaan') !!}
                                {!! Form::textarea('solution', isset($cardwork_detail->solution) ? $cardwork_detail->solution : null, array('required', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class'=>(($errors->has("solution")) ? "is-invalid":"").' form-control ')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('total_hours', 'Total Jam') !!}
                                <div class="input-group">
                                    {!! Form::text('total_hours', isset($cardwork_detail->total_hours) ? $cardwork_detail->total_hours : null, array('required', 'class'=>(($errors->has("total_hours")) ? "is-invalid":"").' form-control ')) !!}
                                    <span class="input-group-addon">Jam</span>
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('qty', 'Qty') !!}
                                <div class="input-group">
                                    {!! Form::text('qty', isset($cardwork_detail->qty) ? $cardwork_detail->qty : null, array('required', 'class'=>(($errors->has("qty")) ? "is-invalid":"").' form-control ')) !!}
                                    <span class="input-group-addon">Pcs</span>
                                </div>
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
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

@section('scripts')
    <!-- bootstrap datepicker -->
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/datepicker.js') }}"></script>
@endsection
