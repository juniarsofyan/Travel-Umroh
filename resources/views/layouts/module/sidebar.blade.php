{{-- Left side column. contains the logo and sidebar --}}
<aside class="main-sidebar">
    {{-- sidebar: style can be found in sidebar.less --}}
    <section class="sidebar">
        {{-- Sidebar user panel --}}
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                @php $user = Auth::user(); @endphp

                <p>{{ $user->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        {{--
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                            class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        --}}

        {{-- /.search form --}}
        {{-- sidebar menu: : style can be found in sidebar.less --}}
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-circle-o text-warning"></i> Dashboard</a></li>
                </ul>
            </li>

            @can('User View')
            <li class="treeview {{ (request()->routeIs('user*')) || (request()->routeIs('role*')) || (request()->routeIs('permission*')) ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Manajemen User</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    @can('Role View')
                    <li class="treeview {{ (request()->routeIs('role*')) ? 'active' : '' }}">
                        <a href="#">
                            <span>Grup User</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>

                        <ul class="treeview-menu">
                            <li class="{{ (request()->routeIs('role.index')) ? 'active' : '' }}"><a
                                    href="{{ route('role.index') }}"><i class="fa fa-circle-o"></i> List</a></li>

                            @can('Role Create')
                            <li class="{{ (request()->routeIs('role.create')) ? 'active' : '' }}"><a
                                    href="{{ route('role.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan

                    @can('Permission View')
                    <li class="treeview {{ (request()->routeIs('permission*')) ? 'active' : '' }}">
                        <a href="#">
                            <span>Hak Akses</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>

                        <ul class="treeview-menu">
                            <li class="{{ (request()->routeIs('permission.index')) ? 'active' : '' }}"><a
                                    href="{{ route('permission.index') }}"><i class="fa fa-circle-o"></i> List</a></li>

                            @can('Permission Create')
                            <li class="{{ (request()->routeIs('permission.create')) ? 'active' : '' }}"><a
                                    href="{{ route('permission.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan

                    @can('User View')
                    <li class="treeview {{ (request()->routeIs('user*')) ? 'active' : '' }}">
                        <a href="#">
                            <span>User</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>

                        <ul class="treeview-menu">
                            <li class="{{ (request()->routeIs('user.index')) ? 'active' : '' }}">
                                <a href="{{ route('user.index') }}"><i class="fa fa-circle-o"></i> List</a>
                            </li>

                            @can('User Create')
                            <li class="{{ (request()->routeIs('user.create')) ? 'active' : '' }}">
                                <a href="{{ route('user.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan

            @canany(['Hotel View', 'Maskapai View', 'Jenis Kamar View'])
            <li class="treeview {{ (request()->routeIs('hotel*')) ? 'active' : '' || (request()->routeIs('maskapai*')) ? 'active' : '' || (request()->routeIs('jenis-kamar*')) ? 'active' : '' }}">
                <a href="#">
                    <span>Akomodasi</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    @can('Hotel View')
                    <li class="{{ (request()->routeIs('hotel.index')) ? 'active' : '' }}">
                        <a href="{{ route('hotel.index') }}"><i class="fa fa-circle-o"></i> Hotel</a>
                    </li>
                    @endcan

                    @can('Maskapai View')
                    <li class="{{ (request()->routeIs('maskapai.index')) ? 'active' : '' }}">
                        <a href="{{ route('maskapai.index') }}"><i class="fa fa-circle-o"></i> Maskapai</a>
                    </li>
                    @endcan
                    
                    @can('Jenis Kamar View')
                    <li class="{{ (request()->routeIs('jenis-kamar.index')) ? 'active' : '' }}">
                        <a href="{{ route('jenis-kamar.index') }}"><i class="fa fa-circle-o"></i> Jenis Kamar</a>
                    </li>
                    @endcan

                    @can('Jadwal Penerbangan View')
                    <li class="{{ (request()->routeIs('jadwal-penerbangan.index')) ? 'active' : '' }}">
                        <a href="{{ route('jadwal-penerbangan.index') }}"><i class="fa fa-circle-o"></i> Jadwal Penerbangan</a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan

            @canany(['Paket Umroh View', 'Template Itinerary View'])
            <li class="treeview">
                <a href="#">
                    <span>Paket Umroh</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    @can('Template Itinerary View')
                    <li class="{{ (request()->routeIs('template-itinerary.index')) ? 'active' : '' }}">
                        <a href="{{ route('template-itinerary.index') }}"><i class="fa fa-circle-o"></i>Template Itinerary</a>
                    </li>
                    @endcan

                    @can('Paket Umroh View')
                    <li class="{{ (request()->routeIs('paket-umroh.index')) ? 'active' : '' }}">
                        <a href="{{ route('paket-umroh.index') }}"><i class="fa fa-circle-o"></i>Paket Umroh</a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('Jamaah View')
                <li>
                    <a href="{{ route('jamaah.index') }}"> <span>Jamaah</span></a>
                </li>
            @endcan

            {{-- @canany(['Transaksi View', 'Pembayaran View'])
            <li class="treeview">
                <a href="#">
                    <span>Transaksi</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    @can('Transaksi View')
                    <li class="{{ (request()->routeIs('transaksi.index')) ? 'active' : '' }}">
                        <a href="{{ route('transaksi.index') }}"><i class="fa fa-circle-o"></i>Transaksi</a>
                    </li>
                    @endcan

                    @can('Pembayaran View')
                    <li class="{{ (request()->routeIs('pembayaran.index')) ? 'active' : '' }}">
                        <a href="{{ route('pembayaran.index') }}"><i class="fa fa-circle-o"></i>Pembayaran</a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan --}}

            {{-- 
            @can('Category View')
            <li class="treeview {{ (request()->routeIs('category*')) ? 'active' : '' }}">
                <a href="#">
                    <span>Kategori</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="{{ (request()->routeIs('category.index')) ? 'active' : '' }}"><a
                            href="{{ route('category.index') }}"><i class="fa fa-circle-o"></i> List</a></li>

                    @can('Category Create')
                    <li class="{{ (request()->routeIs('category.create')) ? 'active' : '' }}"><a
                            href="{{ route('category.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('Inventory View')
            <li class="treeview {{ (request()->routeIs('inventory*')) ? 'active' : '' }}">
                <a href="#">
                    <span>Barang</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="{{ (request()->routeIs('inventory.index')) ? 'active' : '' }}"><a
                            href="{{ route('inventory.index') }}"><i class="fa fa-circle-o"></i> List</a></li>

                    @can('Inventory Create')
                    <li class="{{ (request()->routeIs('inventory.create')) ? 'active' : '' }}"><a
                            href="{{ route('inventory.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('Project View')
            <li class="treeview {{ (request()->routeIs('project*')) ? 'active' : '' }}">
                <a href="#">
                    <span>Project</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="{{ (request()->routeIs('project.index')) ? 'active' : '' }}"><a
                            href="{{ route('project.index') }}"><i class="fa fa-circle-o"></i> List</a></li>

                    @can('Project Create')
                    <li class="{{ (request()->routeIs('project.create')) ? 'active' : '' }}"><a
                            href="{{ route('project.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('Process View')
            <li class="treeview {{ (request()->routeIs('process*')) ? 'active' : '' }}">
                <a href="#">
                    <span>Proses</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="{{ (request()->routeIs('process.index')) ? 'active' : '' }}"><a
                            href="{{ route('process.index') }}"><i class="fa fa-circle-o"></i> List</a></li>

                    @can('Process Create')
                    <li class="{{ (request()->routeIs('process.create')) ? 'active' : '' }}"><a
                            href="{{ route('process.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('Component View')
            <li class="treeview {{ (request()->routeIs('component*')) ? 'active' : '' }}">
                <a href="#">
                    <span>Komponen</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="{{ (request()->routeIs('component.index')) ? 'active' : '' }}"><a
                            href="{{ route('component.index') }}"><i class="fa fa-circle-o"></i> List</a></li>

                    @can('Component Create')
                    <li class="{{ (request()->routeIs('component.create')) ? 'active' : '' }}"><a
                            href="{{ route('component.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a></li>
                    @endcan
                </ul>
            </li>
            @endcan --}}

            {{-- @can('Material View')
            <li class="treeview {{ (request()->routeIs('material*')) ? 'active' : '' }}">
                <a href="#">
                    <span>Jenis Material</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="{{ (request()->routeIs('material.index')) ? 'active' : '' }}"><a
                            href="{{ route('material.index') }}"><i class="fa fa-circle-o"></i> List</a></li>

                    @can('Material Create')
                    <li class="{{ (request()->routeIs('material.create')) ? 'active' : '' }}"><a
                            href="{{ route('material.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a></li>
                    @endcan
                </ul>
            </li>
            @endcan --}}

            {{-- @can('Officer View')
            <li class="treeview {{ (request()->routeIs('officer*')) ? 'active' : '' }}">
                <a href="#">
                    <span>Petugas</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="{{ (request()->routeIs('officer.index')) ? 'active' : '' }}"><a
                            href="{{ route('officer.index') }}"><i class="fa fa-circle-o"></i> List</a></li>

                    @can('Officer Create')
                    <li class="{{ (request()->routeIs('officer.create')) ? 'active' : '' }}"><a
                            href="{{ route('officer.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('Card Work View')
            <li class="treeview {{ (request()->routeIs('cardwork*')) ? 'active' : '' }}">
                <a href="#">
                    <span>Kartu Kerja</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="{{ (request()->routeIs('cardwork.index')) ? 'active' : '' }}"><a
                            href="{{ route('cardwork.index') }}"><i class="fa fa-circle-o"></i> List</a></li>

                    @can('Card Work Create')
                    <li class="{{ (request()->routeIs('cardwork.create')) ? 'active' : '' }}"><a
                            href="{{ route('cardwork.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('Report By Category View')
            <li class="treeview {{ (request()->routeIs('report*')) ? 'active' : '' }}">
                <a href="#">
                    <span>Laporan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    @can('Report By Category View')
                    <li class="{{ (request()->routeIs('report.bycategory')) ? 'active' : '' }}"><a
                            href="{{ route('report.bycategory') }}"><i class="fa fa-circle-o text-aqua"></i>Laporan</a></li>
                    @endcan
                </ul>
            </li>
            @endcan --}}

            

        </ul>
    </section>
    {{-- /.sidebar --}}
</aside>
