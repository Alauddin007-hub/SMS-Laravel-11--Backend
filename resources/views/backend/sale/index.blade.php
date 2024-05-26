@extends ('backend.layouts.app')

@section('title', 'Sales List')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Sales List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Transaction</a></li>
            <li class="breadcrumb-item active">Sales list</li>
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
              <h3 class="card-title">Book Sales List</h3><br>
              <div>
                <a href="{{route('transactions.create')}}" class="btn btn-info">New Transaction</a>
              </div>
            </div>

            @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
            @endif
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#SL</th>
                    <th>Book English Name</th>
                    <th>Book Bangla Name</th>
                    <th>Customer Name</th>
                    <th>Unit</th>
                    <th>Price</th>
                    <th>Sub-Total</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $sales as $key=>$item )
                  <tr>
                    <td>{{++$key}}</td>
                    <td>{{$item->book->book_english_name}}</td>
                    <td>{{$item->book->book_bangla_name}}</td>
                    <td>{{$item->customer->name}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->subtotal}}</td>
                  </tr>
                  @endforeach

                </tbody>
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