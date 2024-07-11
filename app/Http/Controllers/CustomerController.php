<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;

use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{
    public function index()
    {
        $title = "Customer List";

        $items = Customer::all();

        return view('pages.customer.index', [
            'title' => $title,
            'items' => $items
        ]);
    }
    public function create()
    {
        $title = "Create New Customer";

        return view('pages.customer.create', [
            'title' => $title
        ]);
    }
    public function store(CustomerRequest $request)
    {
        $data = $request->all();

        $data['phone_number'] = str_replace(' ', '', $data['phone_number']);

        Customer::create($data);

        return redirect()->route('customer.index')->with('success','Customer berhasil dibuat!');
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $title = "Edit Customer";

        $item = Customer::findOrFail($id);

        return view('pages.customer.edit', [
            'title' => $title,
            'item' => $item
        ]);
    }
    public function update(CustomerRequest $request, $id)
    {
        $data = $request->all();

        Customer::findOrFail($id)->update($data);

        return redirect()->route('customer.index')->with('success','Customer berhasil diperbarui!');
    }
    public function destroy($id)
    {
        Customer::findOrFail($id)->delete();

        return redirect()->route('customer.index')->with('success','Customer berhasil dihapus!');
    }
}
