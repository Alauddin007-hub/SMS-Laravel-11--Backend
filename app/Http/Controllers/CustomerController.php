<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = Customer::get();
        return view('backend.customer.index',compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            // 'phone' => 'required|number',
            'address' => 'required|max:100',
        ]);

        if ($validated) {

            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
            ];

            // dd($data);
            Customer::create($data);
            return redirect('/Customer')->with('success', "Customer has been added");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::find($id);
        return view('backend.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            // 'phone' => 'required|number',
            'address' => 'required|max:100',
        ]);

        if ($validated) {

            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
            ];

            // dd($data);
            $cat = Customer::find($request->id);
            $cat->update($data);
            return redirect('/Customer')->with('success', "Customer has been added");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $cat = Customer::find($request->id);
        $cat->delete();
        return back()->with('success', "Customer has been deleted");
    }
}
