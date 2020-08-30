@extends('layouts.master') @section('title')
<title>Manajemen Hotel</title>
@endsection @section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <a href="#">Home</a>
            </li>
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
                        <h3 class="box-title">Dashboard</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    <div class="box-body">
                        {{ $user }}
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                       
                    </div>
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