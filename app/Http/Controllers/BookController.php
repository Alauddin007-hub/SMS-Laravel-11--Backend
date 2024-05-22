<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Writer;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('backend.book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cats = Category::all();
        $lekhok = Writer::all();
        return view('backend.book.create', compact('cats','lekhok'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_english_name' => 'required',
            'book_bangla_name' => 'required',
            'category_id' => 'required',
            'writer_id' => 'required',
            'short_description' => 'required|max:150',
            'image' => 'image|mimes:jpg,jpeg,png,gif',
        ]);
        // $imageName = Null;
        $imageName = time() . '.' . $request->image->extension();


        // dd($imageName);


        if ($validated) {
            $request->image->move(('book'), $imageName);

            $data = [
                'book_english_name' => $request->book_english_name,
                'book_bangla_name' => $request->book_bangla_name,
                'category_id' => $request->category_id,
                'writer_id' => $request->writer_id,
                'short_description' => $request->short_description,
                'publising_date' => $request->publising_date,
                'book_of_page' => $request->book_of_page,
                'image' => $imageName,
            ];
            // dd($data);
          Book::create($data);

            // $book->update($data);
            return redirect('/boi')->with('success', "Book has been added Successfully");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cats = Category::get();
        $lekhok = Writer::get();
        $book = Book::find($id);
        return view('backend.book.edit', compact('cats','lekhok','book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'book_english_name' => 'required',
            'book_bangla_name' => 'required',
            'category_id' => 'required',
            'writer_id' => 'required',
            'short_description' => 'required|max:150',
            'image' => 'image|mimes:jpg,jpeg,png,gif',
        ]);
        // $imageName = Null;
        $imageName = time() . '.' . $request->image->extension();


        // dd($imageName);


        if ($validated) {
            $request->image->move(('book'), $imageName);

            $data = [
                'book_english_name' => $request->book_english_name,
                'book_bangla_name' => $request->book_bangla_name,
                'category_id' => $request->category_id,
                'writer_id' => $request->writer_id,
                'short_description' => $request->short_description,
                'publising_date' => $request->publising_date,
                'book_of_page' => $request->book_of_page,
                'image' => $imageName,
            ];
            // dd($data);
            $book = Book::find($request->id);

            $book->update($data);
            return redirect('/boi')->with('success', "Book has been Updated Successfully");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $book = Book::find($request->id);
        $book->delete();
        return back()->with('success', "Book has been deleted");
    }
}
