@extends ('backend.layouts.app')

@section('title', 'Add Book')

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
                        <li class="breadcrumb-item active">Add Book</li>
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
                            <h3 class="card-title">Added <small>Book</small></h3>
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
                        <form method="post" action="{{ route('boi.store') }}" enctype="multipart/form-data">

                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="book_english_name">Book English Name</label>
                                    <input type="text" name="book_english_name" class="form-control" placeholder="Enter Book English Name">
                                </div>
                                <div class="form-group">
                                    <label for="book_bangla_name">Book Bangla Name</label>
                                    <input type="text" name="book_bangla_name" class="form-control" placeholder="Enter Book Bangla Name">
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Category Name</label>
                                    <select name="category_id" class="form-control" id="">
                                        <option selected>Choose Category Name</option>
                                        @if(!empty($cats->count()))
                                        @foreach($cats as $cat)
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="writer_id">Writer Name</label>
                                    <select name="writer_id" class="form-control" id="">
                                        <option selected>Choose Writer Name</option>
                                        @if(!empty($lekhok->count()))
                                        @foreach($lekhok as $item)
                                        <option value="{{$item->id}}">{{$item->writer_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="short_description">Short Description</label>
                                    <textarea name="short_description" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="image">Price</label>
                                    <input type="number" name="price" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="publising_date">Publishing Date</label>
                                    <input type="date" name="publising_date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="book_of_page">Book of Page</label>
                                    <input type="number" name="book_of_page" class="form-control" placeholder="Enter Book of Page">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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

