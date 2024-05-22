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

<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li> -->
        <li class="nav-item">

            <!-- <form method="POST" action="">
                @csrf

                <input href="" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    
                </input>
            </form> -->

            <form class="dropdown-item d-flex align-items-center" action="" method="post">
                        @csrf
                        <i class="mdi mdi-logout font-size-16 align-middle mr-1"><input class="btn btn-light" style="border: none; outline:none" type="submit" value="Sign out"></i>
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </form>
        </li>

    </ul>
</nav>