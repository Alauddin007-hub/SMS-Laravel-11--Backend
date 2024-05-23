@extends ('backend.layouts.app')

@section('title', 'New Transaction')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>New Transaction</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">New Transaction</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <form action="{{ route('transactions.store') }}" method="POST" class="form-produk">
                                @csrf
                                <div class="form-group row">
                                    <label for="customer_id" class="col-lg-2">Customer :</label>
                                    <div class="col-lg-5">
                                        <select name="customer_id" id="customer_id" class="form-control">
                                            <option selected>Select Customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="book_search" class="col-lg-2">Search Book:</label>
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <input type="text" name="book_search" id="book_search" class="form-control" placeholder="Search for a book">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#modal-book"><i class="fa fa-search-plus"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <table class="table table-bordered table-striped table-sale">
                                                <thead>
                                                    <tr>
                                                        <th>#SL</th>
                                                        <th>Book</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>Discount (%)</th>
                                                        <th>Total Amount</th>
                                                        <th width="15%"><i class="fa fa-cog"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="sale-details">
                                                    <!-- Sale details will be dynamically added here -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Total <span id="total-price">0.00</span></h4>
                                            </div>
                                            <div class="card-body">
                                                <button type="submit" class="btn btn-primary">Save Transaction</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-book" tabindex="-1" role="dialog" aria-labelledby="modal-book">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Select Product</h4>
            </div>
            <div class="modal-body">
                <input type="text" id="book-search-input" class="form-control" placeholder="Search for books...">
                <table class="table table-striped table-bordered table-product table-hover">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Purchase Price</th>
                            <th><i class="fa fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody id="book-list">
                        <!-- Book search results will be dynamically added here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    let saleDetails = [];

    document.getElementById('book_search').addEventListener('keyup', function() {
        const query = this.value;
        if (query.length >= 2) {
            fetch(`/books/search?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    let html = '';
                    data.forEach((item, index) => {
                        html += `
                            <tr>
                                <td width="5%">${index + 1}</td>
                                <td>${item.book_id}</td>
                                <td>${item.book.book_bangla_name}</td>
                                <td>${item.price}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-xs btn-flat" onclick="selectProduct(${item.book.id}, '${item.book.book_bangla_name}', ${item.price})">
                                        <i class="fa fa-check-circle"></i> Select
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    document.getElementById('book-list').innerHTML = html;
                });
        }
    });

    function selectProduct(bookId, bookName, price) {
        const row = `
            <tr>
                <td>${saleDetails.length + 1}</td>
                <td>
                <input type="number" hidden name="books[][book_id]" class="form-control"  min="1" value="${bookId}">
                ${bookName}
                </td>
                <td><input type="number" name="books[${saleDetails.length}][quantity]" class="form-control" onchange="updateTotal(${saleDetails.length}, ${price})" min="1" value="1"></td>
                <td>
                <input type="number" hidden name="books[][price]" class="form-control"  min="1" value="${price}">
                ${price}
                </td>
                <td><input type="number" name="books[${saleDetails.length}][discount]" class="form-control" value="0"></td>
                <td><input type="text" name="books[${saleDetails.length}][subtotal]" class="form-control" value="${price}" readonly></td>
                <td><button type="button" class="btn btn-danger btn-xs" onclick="removeProduct(${saleDetails.length})"><i class="fa fa-times"></i></button></td>
            </tr>
        `;

        document.getElementById('sale-details').insertAdjacentHTML('beforeend', row);

        saleDetails.push({ bookId, bookName, price, quantity: 1, subtotal: price });
        updateTotal();
    }

    function updateTotal(index = null, price = null) {
        if (index !== null && price !== null) {
            const quantity = document.getElementsByName(`books[${index}][quantity]`)[0].value;
            const discount = document.getElementsByName(`books[${index}][discount]`)[0].value;
            const subtotal = (quantity * price) * ((100 - discount) / 100);
            document.getElementsByName(`books[${index}][subtotal]`)[0].value = subtotal.toFixed(2);
            saleDetails[index].quantity = quantity;
            saleDetails[index].subtotal = subtotal;
        }

        const total = saleDetails.reduce((sum, item) => sum + parseFloat(item.subtotal), 0);
        document.getElementById('total-price').innerText = total.toFixed(2);
    }

    function removeProduct(index) {
        saleDetails.splice(index, 1);
        const table = document.getElementById('sale-details');
        table.deleteRow(index);
        updateTotal();
    }
</script>

@endsection
