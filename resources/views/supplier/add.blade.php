@extends('admin.layouts.header')

@section('content')

<section class="content-header">
      <div class="container-fluid">
        <div class="card card-default" data-select2-id="55">
          <div class="card-header">
            <h3 class="card-title">Add New Supplier</h3>

            
          </div>
          <!-- /.card-header -->
          <form action="{{ route('supplier.store') }}" method="POST">
          @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="" placeholder="Enter Name" name="name">
                    @error('name')<span class="error-message"role="alert">{{ $message }} </span>@enderror
                  </div>
                  <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" rows="3" placeholder="Enter Address" name="address"></textarea>
                        @error('address')<span class="error-message"role="alert">{{ $message }} </span>@enderror
                      </div>
                  <div class="form-group">
                    <label for="">Tax No</label>
                    <input type="text" class="form-control" id="" placeholder="Enter Tax No" name="tax_no">
                    @error('tax_no')<span class="error-message"role="alert">{{ $message }} </span>@enderror
                  </div>
                  <div class="form-group">
                  <label>Country</label>
                  <select class="form-control select2" style="width: 100%;" name="country">
                    @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                  </select>
                  @error('country')<span class="error-message"role="alert">{{ $message }} </span>@enderror
                </div>
                  <div class="form-group">
                  <label for="">Email </label>
                    <input type="email" class="form-control" id="" placeholder="Enter email" name="email">
                    @error('email')<span class="error-message"role="alert">{{ $message }} </span>@enderror
                  </div>
                  <div class="form-group">
                  <label for="">Mobile </label>
                    <input type="number" class="form-control" id="" placeholder="Enter Mobile Number" name="mobile">
                    @error('mobile')<span class="error-message"role="alert">{{ $message }} </span>@enderror
                  </div>
                  <div class="form-group">
                  <label>Status</label>
                  <select class="form-control select2" style="width: 100%;" name="status">
                    <option value="ACTIVE" selected>Active</option>
                    <option value="INACTIVE">Inactive</option>
                    <option value="BLOCKED">Blocked</option>
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