@extends('admin.layouts.header')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Suppliers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <a href="{{ route('supplier.add') }}" class="btn btn-block btn-primary">Add</a>
             
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
                    <th>Supplier No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Tax No</th>
                    <th>Country</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($list as $supplier)
                  <tr>
                  <td>{{ $loop->iteration }}</td>
                    <td>{{ $supplier->supplier_no }}</td>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->address }}</td>
                    <td>{{ $supplier->tax_no }}</td>
                    <td>{{ $supplier->countries->name }}</td>
                    <td>{{ $supplier->email }}</td>
                    <td>{{ $supplier->mobile }}</td>
                    <td>@if ($supplier->status == 'ACTIVE')
        Active
    @elseif ($supplier->status == 'INACTIVE')
        Inactive
    @else
        Blocked
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
