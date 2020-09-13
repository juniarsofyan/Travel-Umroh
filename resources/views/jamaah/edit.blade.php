@extends('layouts.master')

@section('title')
<title>Manajemen Jamaah</title>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Manajemen Jamaah </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}">Home</a></li>
            <li><a a href="{{ route('jamaah.index') }}">Jamaah</a></li>
            <li class="active">Edit</li>
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
                        <h3 class="box-title">Edit Jamaah</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    <form role="form" action="{{ route('jamaah.update', $jamaah->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
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
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" name="nama" value="{{ $jamaah->nama }}" class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}" id="nama" required>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ $jamaah->tanggal_lahir }}" class="form-control {{ $errors->has('tanggal_lahir') ? 'is-invalid':'' }}" id="tanggal_lahir" required>
                            </div>

                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin:</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                    <option value="" selected disabled>-- PILIH SATU --</option>
                                    <option value="PRIA" {{ $jamaah->jenis_kelamin == "PRIA" ? "selected" : "" }}>PRIA</option>
                                    <option value="WANITA" {{ $jamaah->jenis_kelamin == "WANITA" ? "selected" : "" }}>WANITA</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="text" name="telepon" value="{{ $jamaah->telepon }}" class="form-control {{ $errors->has('telepon') ? 'is-invalid':'' }}" id="telepon" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" value="{{ $jamaah->email }}" class="form-control {{ $errors->has('email') ? 'is-invalid':'' }}" id="email" required>
                            </div>

                            <div class="form-group">
                                <label for="alamat">alamat</label>
                                <textarea name="alamat" id="alamat"
                                    class="form-control {{ $errors->has('alamat') ? 'is-invalid':'' }}" cols="5"
                                    rows="5">{{ $jamaah->alamat }}</textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button> &nbsp;&nbsp;
                            <a href="{{ route('jamaah.index') }}" class="btn btn-default">Batal</a>
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
