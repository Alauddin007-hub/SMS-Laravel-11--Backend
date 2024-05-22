@extends ('backend.layouts.app')

@section('title', 'Customer')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Customers</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Customer</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header ">
              <h3 class="card-title">Customer List</h3><br>
              <div>
                <a href="{{route('customer.create')}}" class="btn btn-info"> Add Customer</a>
              </div>
            </div>

            @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
            @endif
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#SL</th>
                    <th>Picture</th>
                    <th>Writer Name</th>
                    <th>Short Description</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $customer as $key=>$item )
                  <tr>
                    <td>{{++$key}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{$item->address}}</td>
                    <td>
                      <a class="btn btn-secondary" href="{{route('customer.edit', $item->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>

                      <a class="btn btn-danger" href="{{route('customer.delete', $item->id)}}" onclick="return confirm('Are you sure to delete')"><i class="fa-solid fa-trash"></i></a>
                    </td>
                  </tr>
                  @endforeach

                </tbody>
                <tfoot>
                  <tr>
                    <th>#SL</th>
                    <th>Picture</th>
                    <th>Writer Name</th>
                    <th>Short Description</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

@endsection