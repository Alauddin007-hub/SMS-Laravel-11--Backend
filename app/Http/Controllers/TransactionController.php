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
        return view('backend.sale.pos_application', compact('customers', 'stockDetails', 'books'));
    }

    public function searchBooks(Request $request)
    {
        $query = $request->get('query');
        $book = Book::where('book_bangla_name', 'LIKE', "%{$query}%")
            ->orWhere('book_english_name', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($book);
    }

    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'books' => 'required|array',
            'books.*.book_id' => 'required|exists:books,id',
            'books.*.quantity' => 'required|integer|min:1',
            'books.*.subtotal' => 'required|numeric|min:0',
            'customer_id' => 'nullable|exists:customers,id',
            'name' => 'nullable|required_without:customer_id|string|max:255',
            'phone' => 'nullable|required_without:customer_id|string|max:255',
            'address' => 'nullable|required_without:customer_id|string|max:255',
        ]);

        if ($errors = $request->errors()) {
            dd($errors);
        }

        $books = $request->input('books');
        dd($books);

        // Handle customer selection or creation
        $customerId = $request->input('customer_id');
        if (!$customerId) {
            $customer = Customer::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'user_id' => auth()->id(),
            ]);
            $customerId = $customer->id;
        }
        dd($customerId);

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
            'customer_id' => $customerId,
            'user_id' => auth()->id(),
        ]);
        dd($sale);

        $uniCode = IdGenerator::generate(['table' => 'stock_details', 'field' => 'uni_code', 'length' => 7, 'prefix' => 'Sale#']);

        // Create sale details and update stock
        foreach ($books as $book) {
            $saleDetail = SaleDetails::create([
                'book_id' => $book['book_id'],
                'sales_id' => $sale->id,
                'uni_code' => $uniCode,
                'customer_id' => $customerId,
                'quantity' => $book['quantity'],
                'price' => $book['price'],
                'subtotal' => $book['subtotal'],
                'user_id' => auth()->id(),
            ]);
            dd($saleDetail);
        
            $stockDetail = Stock_Detail::where('book_id', $book['book_id'])->first();
            if ($stockDetail) {
                if ($stockDetail->quantity < $book['quantity']) {
                    return redirect()->back()->withErrors(['message' => 'Not enough stock for book ID ' . $book['book_id']]);
                }
                $stockDetail->quantity -= $book['quantity'];
                $stockDetail->save();
            } else {
                return redirect()->back()->withErrors(['message' => 'Stock detail not found for book ID ' . $book['book_id']]);
            }
        }

        // return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }
}
