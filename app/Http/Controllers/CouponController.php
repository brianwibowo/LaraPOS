<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Coupon;

use App\Http\Requests\CouponRequest;

class CouponController extends Controller
{
    public function index()
    {
        $title = "Coupon List";

        $items = Coupon::all();

        return view('pages.coupon.index', [
            'title' => $title,
            'items' => $items
        ]);
    }
    public function create()
    {
        $title = "Create New Coupon";

        return view('pages.coupon.create', [
            'title' => $title
        ]);
    }
    public function store(CouponRequest $request)
    {
        $data = $request->all();
        $data['coupon_code'] = strtoupper(str_replace(' ', '', $data['coupon_code']));

        Coupon::create($data);

        return redirect()->route('coupon.index')->with('success','Kupon berhasil dibuat!');
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $title = "Edit Coupon";

        $item = Coupon::findOrFail($id);

        return view('pages.coupon.edit', [
            'title' => $title,
            'item' => $item
        ]);
    }
    public function update(CouponRequest $request, $id)
    {
        $data = $request->all();

        Coupon::findOrFail($id)->update($data);

        return redirect()->route('coupon.index')->with('success','Kupon berhasil diperbarui!');
    }
    public function destroy($id)
    {
        Coupon::findOrFail($id)->delete();

        return redirect()->route('coupon.index')->with('success','Kupon berhasil dihapus!');
    }
}
