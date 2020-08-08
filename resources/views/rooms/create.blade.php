@extends('layouts.master')

@section('title')
<title>Manajemen Kamar</title>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Manajemen Kamar </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Kamar</li>
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
                        <h3 class="box-title">Tambah Kamar</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    <form role="form" action="{{ route('rooms.store') }}" method="POST">
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
                                <label for="room_type">Tipe Kamar</label>
                                <input type="text" name="room_type" class="form-control {{ $errors->has('room_type') ? 'is-invalid':'' }}" id="room_type" required>
                            </div>
                            <div class="form-group">
                                <label for="number_of_beds">Jumlah Kasur</label>
                                <input type="number" min="1" name="number_of_beds" class="form-control {{ $errors->has('number_of_beds') ? 'is-invalid':'' }}" id="number_of_beds" required>
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
