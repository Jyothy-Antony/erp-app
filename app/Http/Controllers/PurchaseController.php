<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Supplier;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;

class PurchaseController extends Controller
{
    public function index()
    {
        $list = PurchaseOrder::orderBy('id', 'DESC')
                            ->with('supplier')
                            ->get();
        return view('purchase.list',compact('list'));
    }

    public function add()
    {
        $suppliers = Supplier::activeSupplier()->get();
        $items = Item::activeItem()->get();
        return view('purchase.add',compact('suppliers','items'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'supplier_id' => 'required|exists:suppliers,id',
        //     'order_date' => 'required|date',
        //     'items' => 'required|array'
        // ]);

        //dd(request('items'));

        $auto_gen_key = 'ORDER';
        $latest_order = PurchaseOrder::latest()->first();
        $auto_gen_value = $auto_gen_key.'-1000';
        if($latest_order){
            $latest_value = explode('-', $latest_order->order_no)[1];
            $auto_gen_value = $auto_gen_key.'-'.$latest_value+1;
            
        }
        $order = new PurchaseOrder([
            'supplier_id' => request('supplier'),
            'order_date' => request('order_date'),
            'discount' => array_sum(request('discounts')),
            'item_total' =>  array_sum(request('item_amount')),
            'net_amount' =>  array_sum(request('net_amount')),
            'order_no' => $auto_gen_value,
        ]);
        if($order->save()) {
            foreach ($request->items as $key => $value) {
                $order->items()->create([
                    'purchase_order_id' => $order->id,
                    'item_id' => $value,
                    'quantity' => $request->quantities[$key],
                    'packing_unit' => $request->packing_unit[$key],
                    'discount' => $request->discounts[$key] ?? 0.00,
                    'item_total' => $request->item_amount[$key],
                    'net_amount' => $request->item_amount[$key] - $request->discounts[$key],
                ]);
            }
        }
        return redirect('purchase/index')->with('success', 'Purchase Order has been added successfully');
    }

    public function view($id)
    {
        $data = PurchaseOrder::with(['supplier', 'items'])->find(decrypt($id));
        return view('purchase.view',compact('data'));
    }
}
