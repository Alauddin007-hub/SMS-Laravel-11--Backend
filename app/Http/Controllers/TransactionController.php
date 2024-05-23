<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\SaleDetails;
use App\Models\Stock_Detail;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Sale;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class TransactionController extends Controller
{
    public function create()
    {
        $customers = Customer::all();
        $books = Book::all();
        $stockDetails = Stock_Detail::with('book')->get();
        return view('backend.sale.pos_application', compact('customers', 'stockDetails','books'));
    }

    public function searchBooks(Request $request)
    {
        $query = $request->get('query');
        $stockDetails = Stock_Detail::whereHas('book', function ($q) use ($query) {
            $q->where('book_bangla_name', 'LIKE', "%{$query}%")
                ->orWhere('book_english_name', 'LIKE', "%{$query}%");
        })->with('book')->get();

        return response()->json($stockDetails);
    }

    public function store(Request $request)
    {
        $books = $request->input('books');
        // dd($books);

        // Retrieve customer information from the request
        // $name = $request->input('name');
        // $phone = $request->input('phone');
        // $address = $request->input('address');

        // // Create the customer
        // $customer = Customer::create([
        //     'name' => $name,
        //     'phone' => $phone,
        //     'address' => $address,
        //     // You may need to adjust this depending on your authentication setup
        //     'user_id' => auth()->id()
        // ]);


        // Calculate total quantity and total price
        $totalQuantity = 0;
        $totalPrice = 0;

        foreach ($books as $book) {
            $totalQuantity += $book['quantity'];
            $totalPrice += $book['subtotal'];
        }

        // Create the sale
        $sale = Sale::create([
            'total_quantity' => $totalQuantity,
            'total_price' => $totalPrice,
            'discount' => $request->input('discount', 0),
            // 'customer_id' => $request->customer_id, // Associate the sale with the customer
            // You may need to adjust this depending on your authentication setup
            'user_id' => auth()->id()
        ]);

        $uniCode = IdGenerator::generate(['table' => 'stock_details', 'field' => 'uni_code', 'length' => 7, 'prefix' => 'Sale#']);

        // Create sale details and update stock
        foreach ($books as $book) {
            SaleDetails::create([
                'book_id' => $book['book_id'],
                'sales_id' => $sale->id,
                'uni_code' => $uniCode,
                'customer_id' => $request->customer_id,
                'quantity' => $book['quantity'],
                'price' => $book['price'],
                'subtotal' => $book['subtotal'],
                // You may need to adjust this depending on your authentication setup
                'user_id' => auth()->id()
            ]);

            // Update the stock
            $stockDetail = Stock_Detail::where('book_id', $book['book_id'])->first();
            if ($stockDetail) {
                $stockDetail->quantity -= $book['quantity'];
                $stockDetail->save();
            } 
            // else 
            // {
            //     // Handle the case where stock detail for the book is not found
            //     // This could be logging an error or other appropriate action
            // }
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }
}
