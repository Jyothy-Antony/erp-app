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
            <a href="{{ route('purchase.add') }}" class="btn btn-block btn-primary">Add</a>
             
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
                    <th>Order No</th>
                    <th>Order Date</th>
                    <th>Supplier Name</th>
                    <th>Item Total</th>
                    <th>Discount</th>
                    <th>Net Amount</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($list as $order)
                  <tr>
                  <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->order_no }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>{{ $order->supplier->name }}</td>
                    <td>{{ $order->item_total }}</td>
                    <td>{{ $order->discount }}</td>
                    <td>{{ $order->net_amount }}</td>
                    <td>
                    <a class="btn btn-info btn-sm actionbtn" href="{{ route('purchase.view',encrypt($order->id))}}">View
                                          </a>
                    </td>
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
