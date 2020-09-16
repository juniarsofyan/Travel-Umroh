@extends('layouts.master')

@section('title')
    <title>Manajemen Jenis Kamar</title>
@endsection

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/buttons.dataTables.min.css') }}">
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Manajemen Jenis Kamar </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}">Home</a></li>
            <li class="active">Jenis Kamar</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- right column -->
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Daftar Jenis Kamar</h3>
                        <div class="pull-left box-tools">
                            <a href="{{ route('jenis-kamar.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Jenis Kamar</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br/>
                        @if (session('success'))
                            @alert(['type' => 'success'])
                                {!! session('success') !!}
                            @endalert
                        @endif

                        <table id="datatable-standard" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Jenis Kamar</th>
                                    <th>Jumlah Orang</th>
                                    <th>Jumlah Kasur</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php $no = 1; @endphp
                                @forelse ($daftarJenisKamar as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->nama }} </td>
                                        <td>{{ $row->jumlah_orang }} </td>
                                        <td>{{ $row->jumlah_kasur }} </td>
                                        <td>
                                            <form action="{{ route('jenis-kamar.destroy', $row->id) }}" method="POST" onsubmit="return confirmDelete()">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <a href="{{ route('jenis-kamar.edit', $row->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                                                <button class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jszip.min.js') }}"></script>
    <script src="{{ asset('js/plugins/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/plugins/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/plugins/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/datatable.js') }}"></script>
@endsection
