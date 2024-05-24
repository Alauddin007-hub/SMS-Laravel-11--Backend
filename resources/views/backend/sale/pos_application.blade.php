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
                                            <select class="form-control livesearch" name="book_id"></select>
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-success btn-flat" id="add-product-btn"><i class="fa fa-search-plus"></i></button>
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
                                                        <th>Sub-total</th>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        let saleDetails = [];

        $('.livesearch').select2({
            placeholder: 'Select book',
            allowClear: true,
            ajax: {
                url: '/books/search',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.book_bangla_name,
                                // text: item.book_english_name,
                                id: item.id,
                                price: item.price // Make sure to include price in the ajax response
                            }
                        })
                    };
                },
                cache: true
            }
        });

        $('#add-product-btn').on('click', function() {
            const selectedOption = $('.livesearch').select2('data')[0];
            if (selectedOption) {
                selectProduct(selectedOption.id, selectedOption.text, selectedOption.price);
            } else {
                alert('Please select a book');
            }
        });

        function selectProduct(bookId, bookName, price) {
            const row = `
                <tr>
                    <td>${saleDetails.length + 1}</td>
                    <td>
                        <input type="number" hidden name="books[${saleDetails.length}][book_id]" class="form-control" value="${bookId}">
                        ${bookName}
                    </td>
                    <td><input type="number" name="books[${saleDetails.length}][quantity]" class="form-control" onchange="updateTotal(${saleDetails.length}, ${price})" min="1" value="1"></td>
                    <td>
                        <input type="number" hidden name="books[${saleDetails.length}][price]" class="form-control" value="${price}">
                        ${price}
                    </td>
                    <td><input type="number" name="books[${saleDetails.length}][discount]" class="form-control" onchange="updateTotal(${saleDetails.length}, ${price})" value="0"></td>
                    <td><input type="text" name="books[${saleDetails.length}][subtotal]" class="form-control" value="${price}" readonly></td>
                    <td><button type="button" class="btn btn-danger btn-xs" onclick="removeProduct(${saleDetails.length})"><i class="fa fa-times"></i></button></td>
                </tr>
            `;

            document.getElementById('sale-details').insertAdjacentHTML('beforeend', row);

            saleDetails.push({
                bookId,
                bookName,
                price,
                quantity: 1,
                discount: 0,
                subtotal: price
            });
            updateTotal();
        }

        window.updateTotal = function(index, price) {
            const quantity = document.getElementsByName(`books[${index}][quantity]`)[0].value;
            const discount = document.getElementsByName(`books[${index}][discount]`)[0].value;
            const subtotal = (quantity * price) * ((100 - discount) / 100);
            document.getElementsByName(`books[${index}][subtotal]`)[0].value = subtotal.toFixed(2);
            saleDetails[index].quantity = quantity;
            saleDetails[index].discount = discount;
            saleDetails[index].subtotal = subtotal;
            calculateTotal();
        }

        function calculateTotal() {
            const total = saleDetails.reduce((sum, item) => sum + parseFloat(item.subtotal), 0);
            document.getElementById('total-price').innerText = total.toFixed(2);
        }

        window.removeProduct = function(index) {
            saleDetails.splice(index, 1);
            const table = document.getElementById('sale-details');
            table.deleteRow(index);
            reindexTable();
            calculateTotal();
        }

        function reindexTable() {
            const rows = document.querySelectorAll('#sale-details tr');
            rows.forEach((row, index) => {
                row.cells[0].innerText = index + 1;
                row.cells[1].querySelector('input[name^="books"]').setAttribute('name', `books[${index}][book_id]`);
                row.cells[2].querySelector('input[name^="books"]').setAttribute('name', `books[${index}][quantity]`);
                row.cells[4].querySelector('input[name^="books"]').setAttribute('name', `books[${index}][discount]`);
                row.cells[5].querySelector('input[name^="books"]').setAttribute('name', `books[${index}][subtotal]`);
                row.cells[6].querySelector('button').setAttribute('onclick', `removeProduct(${index})`);
            });
        }
    });
</script>

@endsection
