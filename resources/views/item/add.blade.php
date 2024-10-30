@extends('admin.layouts.header')

@section('content')

<section class="content-header">
      <div class="container-fluid">
        <div class="card card-default" data-select2-id="55">
          <div class="card-header">
            <h3 class="card-title">Add New Item</h3>

            
          </div>
          <!-- /.card-header -->
          <form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="" placeholder="Enter Name" name="name">
                    @error('name')<span class="error-message"role="alert">{{ $message }} </span>@enderror
                  </div>
                  <div class="form-group">
                    <label for="">Inventory Location</label>
                    <input type="text" class="form-control" id="" placeholder="Enter Tax No" name="inventory_location">
                    @error('inventory_location')<span class="error-message"role="alert">{{ $message }} </span>@enderror
                  </div>
                  
                  <div class="form-group">
                  <label for="">Brand </label>
                    <input type="text" class="form-control" id="" placeholder="Enter Brand" name="brand">
                    @error('brand')<span class="error-message"role="alert">{{ $message }} </span>@enderror
                  </div>
                  <div class="form-group">
                  <label for="">Category </label>
                    <input type="text" class="form-control" id="" placeholder="Enter Category" name="category">
                    @error('category')<span class="error-message"role="alert">{{ $message }} </span>@enderror
                  </div>
                  <div class="form-group">
                  <label>Supplier</label>
                  <select class="form-control select2" style="width: 100%;" name="supplier">
                    @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                  </select>
                  @error('supplier')<span class="error-message"role="alert">{{ $message }} </span>@enderror
                </div>
                <div class="form-group">
                  <label>Stock Unit</label>
                  <select class="form-control select2" style="width: 100%;" name="stock_unit">
                    <option value="Number">Number</option>
                    <option value="Kilogram">Kilogram</option>
                    <option value="Litre">Litre</option>
                  </select>
                  @error('stock_unit')<span class="error-message"role="alert">{{ $message }} </span>@enderror
                </div>
                  <div class="form-group">
                  <label for="">Unit Price </label>
                    <input type="text" class="form-control" id="" placeholder="Enter Unit Price" name="unit_price">
                    @error('unit_price')<span class="error-message"role="alert">{{ $message }} </span>@enderror
                  </div>
                  <div class="form-group">
                  <label for="">Media</label>
            
                      <input type="file" multiple class="form-control" name="images[]">
                      
  
                  </div>
                  <div class="form-group">
                  <label>Status</label>
                  <select class="form-control select2" style="width: 100%;" name="status">
                    <option value="ENABLED" selected>Enabled</option>
                    <option value="DISABLED">Disabled</option>
                  </select>
                  @error('status')<span class="error-message"role="alert">{{ $message }} </span>@enderror
                </div>
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
          <!-- /.card-body -->
          
        </div>
        </div>
      <!-- /.container-fluid -->
    </section>

@endsection