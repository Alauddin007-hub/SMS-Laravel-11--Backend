@extends ('backend.layouts.app')

@section('title', 'Books')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Book</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Books</li>
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
              <h3 class="card-title">Book Information</h3><br>
              <div>
                <a href="{{route('boi.create')}}" class="btn btn-info"> Add Book</a>
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
                    <th>Book Cover Photo</th>
                    <th>Book English Name</th>
                    <th>Book Bangla Name</th>
                    <th>Book Categoty Name</th>
                    <th>Book Writer Name</th>
                    <th>Price</th>
                    <th>Short Description</th>
                    <th>Publish Date</th>
                    <th>Book of page</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $books as $key=>$item )
                  <tr>
                    <td>{{++$key}}</td>
                    <td>
                    <a href="javascript:void(0)" class="avatar"><img alt="avatar" src="{{asset('book/'.$item->image)}}" width="60px" height="90px"></a>
                    </td>
                    <td>{{$item->book_english_name}}</td>
                    <td>{{$item->book_bangla_name}}</td>
                    <td>{{$item->category->name}}</td>
                    <td>{{$item->writer->writer_name}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->short_description}}</td>
                    <td>{{$item->publising_date}}</td>
                    <td>{{$item->book_of_page}}</td>
                    <td>
                      <a class="btn btn-secondary" href="{{route('boi.edit', $item->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>

                      <a class="btn btn-danger" href="{{route('boi.delete', $item->id)}}" onclick="return confirm('Are you sure to delete')"><i class="fa-solid fa-trash"></i></a>
                    </td>
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