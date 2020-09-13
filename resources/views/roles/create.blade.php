@extends('layouts.master')

@section('title')
<title>Manajemen Tipe User</title>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Manajemen Tipe User </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Tipe User</li>
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
                        <h3 class="box-title">Tambah Tipe User</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    {!! Form::open(array('route' => 'role.store', 'method'=>'POST', 'role' => 'form')) !!}
                        <div class="box-body">

                            {{-- IF SOMETHING WRONG HAPPENED --}}
                            @if ($errors->any())
                                @alert(['type' => 'danger'])
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li> {!! $error !!} </li>
                                        @endforeach
                                    </ul>
                                @endalert
                            @endif

                            <div class="form-group">
                                {!! Form::label('name', 'Nama') !!}
                                {!! Form::text('name', null, array('required', 'autofocus', 'class'=>(($errors->has("name")) ? "is-invalid":"").' form-control ')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('permissions', 'Hak Akses') !!}
                                @foreach($permissions as $permission)
                                <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permission[]', $permission->id, false, array('class' => 'name')) !!}
                                            {{ $permission->name }}
                                        </label>
                                        <br/>
                                    </div>
                                    @endforeach
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button> &nbsp;&nbsp;
                            <a href="{{ route('role.index') }}" class="btn btn-default">Batal</a>
                        </div>
                    {!! Form::close() !!}
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
