@extends('admin.layouts.header')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Purchase Order</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> {{ $data->order_no }}
                    <small class="float-right">Date: {{ date('d/m/Y', strtotime($data->order_date)) }}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                <strong> Supplier Details </strong>
                  <address>
                    {{ $data->supplier->name }}<br>
                    {{ $data->supplier->address }}<br>
                    Phone: {{ $data->supplier->mobile }}<br>
                    Email: {{ $data->supplier->email }}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                 
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Order Number: {{ $data->order_no }}</b> <br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Sl. No</th>
                      <th>Item No.</th>
                      <th>Name</th>
                      <th>Stock Unit</th>
                      <th>Packing Unit</th>
                      <th>unit Price</th>
                      <th>Qty</th>
                      <th>Item Amount</th>
                      <th>Discount</th>
                      <th>Net Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($data->items as $purchase_item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $purchase_item->item->item_no }}</td>
                      <td>{{ $purchase_item->item->name }}</td>
                      <td>{{ $purchase_item->item->stock_unit }}</td>
                      <td>{{ $purchase_item->packing_unito }}</td>
                      <td>{{ $purchase_item->item->unit_price }}</td>
                      <td>{{ $purchase_item->quantity }}</td>
                      <td>{{ $purchase_item->item_total }}</td>
                      <td>{{ $purchase_item->discount }}</td>
                      <td>{{ $purchase_item->net_amount }}</td>
                    </tr>
                    @endforeach

                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  
                </div>
                <!-- /.col -->
                <div class="col-6">
                

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th>Item Total:</th>
                        <td>{{ $data->item_total }}</td>
                      </tr>
                      <tr>
                        <th>Discount:</th>
                        <td>{{ $data->discount }}</td>
                      </tr>
                      <tr>
                        <th>Net Amount:</th>
                        <td>{{ $data->net_amount }}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                <button onclick="printInvoice()" class="btn btn-default">
                                    <i class="fas fa-print"></i> Print
                                </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  @endsection