@php

    //$user_type = Auth::user()->user_type;
    //dd($user_type);

    //$redirecturl = 'user.dashboard';

    //switch($user_type){
        # super admin
        //case 1 :
            //$redirecturl = 'superadmin.dashboard';
            //break;
        # admin
        //case 2 :
            //$redirecturl = 'admin.dashboard';
            //break;
        //default:
            //$redirecturl = 'user.dashboard';
            //break;
    //}

@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="" class="brand-link">
                <img src="{{asset('')}}assets/dist/img/AdminLTELogo.png" alt="SM-System" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Siddikia Publication</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset('')}}assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="" class="d-block">{{ Auth::user()->name ?? 'N/A' }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="" class="nav-link active">
                                <!-- <i class="nav-icon fas fa-solid fa-tachometer-alt"></i> -->
                                <i class="nav-icon fas fa-solid fa-gauge-high"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                           
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-users"></i>
                                <!-- <i class="fa-solid fa-users"></i> -->
                                <p>
                                    Users
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manage User Role</p>
                                        
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('lekhok.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-pen-nib"></i>
                                <p>
                                    Writer
                                    <!-- <span class="right badge badge-danger">New</span> -->
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <!-- <i class="nav-icon fas fa-copy"></i> -->
                                <i class="nav-icon fas fa-solid fa-layer-group"></i>
                                <p>
                                    Category
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                            <li class="nav-item">
                                    <a href="{{route('categories')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Category List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('category.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Category</p>
                                        <!-- <span class="right badge badge-danger">New</span> -->
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <!-- <i class="nav-icon fas fa-copy"></i> -->
                                <i class="nav-icon fas fa-duotone fa-person"></i>
                                <p>
                                    Customer
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                            <li class="nav-item">
                                    <a href="{{route('customers')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Customer List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('customer.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Customer</p>
                                        <!-- <span class="right badge badge-danger">New</span> -->
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-book"></i>
                                <!-- <i class="fa-solid fa-book"></i>boi -->
                                <p>
                                    Books
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('boi')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Book List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('boi.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Book</p>
                                        <!-- <span class="right badge badge-danger">New</span> -->
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-store"></i>
                                <!-- <i class="fa-solid fa-store"></i> -->
                                <p>
                                    Stock
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('store.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Stock</p>
                                        <!-- <span class="right badge badge-danger">New</span> -->
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('stockDetails')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Stocks</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('stocks')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Rest of Stock</p>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Sales
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('stocks')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sales List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('transactions.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>New Transaction</p>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Report
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/tables/simple.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Simple Tables</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/tables/data.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>DataTables</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/tables/jsgrid.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>jsGrid</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- <li class="nav-header">EXAMPLES</li>
                        <li class="nav-item">
                            <a href="pages/calendar.html" class="nav-link">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>
                                    Calendar
                                    <span class="badge badge-info right">2</span>
                                </p>
                            </a>
                        </li> --> 
                    </ul>
                  
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>