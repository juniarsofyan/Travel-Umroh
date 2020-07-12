<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
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

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
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

                            @can('Category Create')
                            <li class="{{ (request()->routeIs('user.create')) ? 'active' : '' }}">
                                <a href="{{ route('user.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan

                    @can('Role View')
                    <li class="treeview {{ (request()->routeIs('role*')) ? 'active' : '' }}">
                        <a href="#">
                            <span>Tipe User</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>

                        <ul class="treeview-menu">
                            <li class="{{ (request()->routeIs('role.index')) ? 'active' : '' }}"><a
                                    href="{{ route('role.index') }}"><i class="fa fa-circle-o"></i> List</a></li>

                            @can('Category Create')
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

                            @can('Category Create')
                            <li class="{{ (request()->routeIs('permission.create')) ? 'active' : '' }}"><a
                                    href="{{ route('permission.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan

            {{-- @can('Customer View')
            <li class="treeview {{ (request()->routeIs('customer*')) ? 'active' : '' }}">
                <a href="#">
                    <span>Customer</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="{{ (request()->routeIs('customer.index')) ? 'active' : '' }}"><a
                            href="{{ route('customer.index') }}"><i class="fa fa-circle-o"></i> List</a></li>

                    @can('Customer Create')
                    <li class="{{ (request()->routeIs('customer.create')) ? 'active' : '' }}"><a
                            href="{{ route('customer.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

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

            @can('Hotels View')
            <li class="treeview {{ (request()->routeIs('hotels*')) ? 'active' : '' }}">
                <a href="#">
                    <span>Hotel</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="{{ (request()->routeIs('hotels.index')) ? 'active' : '' }}"><a
                            href="{{ route('hotels.index') }}"><i class="fa fa-circle-o"></i> List</a></li>

                    @can('Hotels Create')
                    <li class="{{ (request()->routeIs('hotels.create')) ? 'active' : '' }}"><a
                            href="{{ route('hotels.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('Airlines View')
            <li class="treeview {{ (request()->routeIs('airlines*')) ? 'active' : '' }}">
                <a href="#">
                    <span>Maskapai</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="{{ (request()->routeIs('airlines.index')) ? 'active' : '' }}"><a
                            href="{{ route('airlines.index') }}"><i class="fa fa-circle-o"></i> List</a></li>

                    @can('Airlines Create')
                    <li class="{{ (request()->routeIs('airlines.create')) ? 'active' : '' }}"><a
                            href="{{ route('airlines.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
