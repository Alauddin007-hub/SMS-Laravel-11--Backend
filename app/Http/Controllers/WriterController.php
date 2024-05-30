<?php

namespace App\Http\Controllers;

use App\Models\Writer;
use Illuminate\Http\Request;

class WriterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lekhok = Writer::all();
        return view('backend.writer.index',compact('lekhok'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.writer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'writer_name' => 'required',
            'short_description' => 'required|max:150',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        $imageName = Null;
        if($request->hasFile('image'))
        {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(('writer'), $imageName);
        }


        // echo $imageName;

        if ($validated) {

            $data = [
                'writer_name' => $request->writer_name,
                // 'joining_date' => $request->joining_date,
                'short_description' => $request->short_description,
                'image' => $imageName,
            ];

            // dd($data);
            Writer::create($data);
            return redirect('/lekhok')->with('success', "Writer has been added");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Writer $writer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lekhok = Writer::find($id);
        return view('backend.writer.edit', compact('lekhok'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Writer $writer)
    {
        $validated = $request->validate([
            'writer_name' => 'required',
            'short_description' => 'required|max:150',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        $imageName = Null;
        if($request->hasFile('image'))
        {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(('writer'), $imageName);
        }

        // dd($imageName);


        if ($validated) {

            $data = [
                'writer_name' => $request->writer_name,
                'short_description' => $request->short_description,
                'image' => $imageName,
            ];
            $lekhok = Writer::find($request->id);

            // dd($data);
            $lekhok->update($data);
            return redirect('/lekhok')->with('success', "Writer has been Updated Successfully");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $lekhok = Writer::find($request->id);
        $lekhok->delete();
        return back()->with('success', "Writer has been deleted");
    }
}
