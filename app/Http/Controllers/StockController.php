<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Stock;
use App\Models\Stock_Detail;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    //

    public function index()
    {
        $stock = Stock::get();
        return view('backend.stock.total_stock', compact('stock'));
    }

    public function create()
    {
        $book = Book::all();
        return view('backend.stock.restore', compact('book'));
    }

    public function restock(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required',
            'quantity' => 'required|integer|min:1', // Assuming quantity should be a positive integer
            'price' => 'required|numeric|min:0', // Assuming price should be a non-negative number
        ]);
    
        // Generate unique code for the stock detail
        $uuid = IdGenerator::generate(['table' => 'stock_details', 'field' => 'uni_code', 'length' => 7, 'prefix' => 'IN#']);
    
        // Create new stock detail
        $stockDetail = Stock_Detail::create([
            'book_id' => $request->book_id,
            'uni_code' => $uuid,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);
    
        $stock = Stock::where('book_id', $request->book_id)->first();
    
        if (!$stock) {
            Stock::create([
                'book_id' => $request->book_id,
                'stock_detail_id' => $stockDetail->id,
                'total_quantity' => $request->quantity,
                'total_price' => $request->quantity * $request->price,
            ]);
        } else {
            // Update existing stock record
            $stock->total_quantity += $request->quantity;
            $stock->total_price += $request->quantity * $request->price;
            $stock->save();
        }
    
        return redirect()->route('stocks')->with('success', 'Book has been restocked.');
    }
    


    // public function restock(Request $request)
    // {
    //     // $data = $request->all();
    //     // dd($data);
    //     $validated = $request->validate([
    //         'book_id' => 'required',
    //         'quantity' => 'required',
    //         'price' => 'required',
    //     ]);

    //     $uuid = IdGenerator::generate(['table' => 'stock_details', 'field' => 'uni_code', 'length' => 7, 'prefix' => 'IN#']);

    //     if($validated){
    //         $data = [
    //             'book_id' => $request->book_id,
    //             'uni_code' => $uuid,
    //             'quantity' => $request->quantity,
    //             'price' => $request->price,
    //         ];

    //         // dd($data);
    //         $store = Stock_Detail::all($request->book_id);
    //         foreach($store as $item){
    //             $store_detail_id = $item->id;
    //             $store_book_id = $item->book_id;
    //             $quantity = $item->quantity;
    //             $total_price = $quantity * $item->price;
    //         }
    //         $store->create($data);
            
    //         // dd($store);
            
    //         $upload = Stock::find($request->book_id);
    //         foreach($upload as $list){
    //             $list->book_id = $store_book_id;
    //             $list->stock_detail_id = $store_detail_id;
    //             $list->total_quantity += $store->quantity;
    //             $list->total_price += $total_price;
    //         }
            
            
    //         dd($upload);
            
    //         $upload->update([
    //             'book_id' => $store_book_id,
    //             'stock_detail_id' => $store_detail_id,
    //             'total_quantity' => $quantity,
    //             'total_price' => $total_price,
    //         ]);
    //         // return redirect()->route('stockDetails')->with('success', 'Book are stored');
    //     }
    // }

    public function in_stock()
    {
        $stock_detail = Stock_Detail::get();
        return view('backend.stock.in_stock', compact('stock_detail'));
    }
}
