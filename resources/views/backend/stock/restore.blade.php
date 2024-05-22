@extends ('backend.layouts.app')

@section('title', 'Add Writer')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Re-Store Books</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Re-Stock Books</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Re-Store <small>Book</small></h3>
                        </div>
                        <!-- /.card-header -->
                        @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                            <li>{{$err}}</li>
                            @endforeach
                        </div>
                        @endif
                        <!-- form start -->
                        <form method="post" action="{{ route('store.restock') }}" enctype="multipart/form-data">

                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="book_id">Book Name</label>
                                    <select name="book_id" class="form-control" id="">
                                        <option selected>Choose Book</option>
                                        @if(!empty($book->count()))
                                        @foreach($book as $item)
                                        <option value="{{$item->id}}">{{$item->book_bangla_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" name="quantity" class="form-control" placeholder="Enter Book Quantity">
                                </div>
                                <div class="form-group">
                                    <label for="price">Selling Per Book Price</label>
                                    <input type="number" name="price" class="form-control" placeholder="Enter Per Book Price">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Store</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection

