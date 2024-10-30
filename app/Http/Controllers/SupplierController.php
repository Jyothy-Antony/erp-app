<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Country;

class SupplierController extends Controller
{
    public function index()
    {
        $list = Supplier::orderBy('id', 'DESC')
                            ->with('countries')
                            ->get();
        return view('supplier.list',compact('list'));
    }

    public function add()
    {
        $countries = Country::all();
        return view('supplier.add',compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:suppliers,email,NULL,id,deleted_at,NULL',
            'mobile' => 'required|numeric|digits_between:8,12',
            'address' => 'required',
            'tax_no' => 'required',
            'country' => 'required',
            'status' => 'required'
        ]);

        $auto_gen_key = 'SUPPLIER';
        $latest_supplier = Supplier::latest()->first();
        $auto_gen_value = $auto_gen_key.'-1000';
        if($latest_supplier){
            $latest_value = explode('-', $latest_supplier->supplier_no)[1];
            $auto_gen_value = $auto_gen_key.'-'.$latest_value+1;
            
        }
        $supplier = new Supplier([
            'name' => request('name'),
            'email' => request('email'),
            'country' => request('country'),
            'address' => request('address'),
            'tax_no' => request('tax_no'),
            'supplier_no' => $auto_gen_value,
            'mobile' => request('mobile'),
            'status' => request('status')
        ]);
        $supplier->save();
        return redirect('supplier/index')->with('success', 'Supplier has been added successfully');
    }
}
