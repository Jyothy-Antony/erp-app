<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Supplier;
use App\Models\ItemImage;

class ItemController extends Controller
{
    public function index()
    {
        $list = Item::orderBy('id', 'DESC')
                            ->with(['supplier','images'])
                            ->get();
        return view('item.list',compact('list'));
    }

    public function add()
    {
        $suppliers = Supplier::activeSupplier()->get();
        return view('item.add',compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'inventory_location' => 'required',
            'brand' => 'required',
            'category' => 'required',
            'stock_unit' => 'required',
            'unit_price' => 'required',
            'status' => 'required',
            'supplier' => 'required',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048'
        ]);

        $auto_gen_key = 'ITEM';
        $latest_item = Item::latest()->first();
        $auto_gen_value = $auto_gen_key.'-1000';
        if($latest_item){
            $latest_value = explode('-', $latest_item->item_no)[1];
            $auto_gen_value = $auto_gen_key.'-'.$latest_value+1;
            
        }
        $item = new Item([
            'name' => request('name'),
            'inventory_location' => request('inventory_location'),
            'brand' => request('brand'),
            'category' => request('category'),
            'stock_unit' => request('stock_unit'),
            'item_no' => $auto_gen_value,
            'unit_price' => request('unit_price'),
            'status' => request('status'),
            'supplier_id' => request('supplier'),
        ]);

        if($item->save()) {
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('uploads', $filename, 'public');

                    $itemImage = new ItemImage([
                        'media' => $path,
                        'item_id' => $item->id,
                    ]);
                    $itemImage->save();
                }
            }
        }
        return redirect('item/index')->with('success', 'Item has been added successfully');
    }

    public function show($id)
    {
        $item = Item::find($id);
        return response()->json($item);
    }
}
