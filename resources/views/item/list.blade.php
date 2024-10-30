@extends('admin.layouts.header')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Items</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <a href="{{ route('item.add') }}" class="btn btn-block btn-primary">Add</a>
             
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card">
              
              <!-- /.card-header -->
              <div class="card-body">
              @if ($message = Session::get('success'))
                  <div class="alert alert-success alert-block">
                     <button type="button" class="close" data-dismiss="alert">×</button>    
                     <strong>{{ $message }}</strong>
                  </div>
                  @endif
                  @if ($message = Session::get('error'))
                  <div class="alert alert-danger alert-block">
                     <button type="button" class="close" data-dismiss="alert">×</button>    
                     <strong>{{ $message }}</strong>
                  </div>
                  @endif
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Item No</th>
                    <th>Name</th>
                    <th>Inventory Location</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Stock Unit</th>
                    <th>Unit Price</th>
                    <th>Supplier</th>
                    <th>Media</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($list as $item)
                  <tr>
                  <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->item_no }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->inventory_location }}</td>
                    <td>{{ $item->brand }}</td>
                    <td>{{ $item->category }}</td>
                    <td>{{ $item->stock_unit }}</td>
                    <td>{{ $item->unit_price }}</td>
                    <td>{{ $item->supplier->name }}</td>
                    <td>
                      @foreach($item->images as $media)
                      <img width="25%" height="25%" src="{{ asset('storage/' . $media->media) }}" class="img-fluid mb-2" alt="white sample"/>
                      @endforeach
                    </td>
                    <td>@if ($item->status == 'ENABLED')
        Enabled
    @else
        Disabled
    @endif</td>
                  </tr>
                  @endforeach
                  
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

@endsection
