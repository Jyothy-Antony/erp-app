@extends('admin.layouts.header')

@section('content')

<section class="content-header">
      <div class="container-fluid">
        <div class="card card-default" data-select2-id="55">
          <div class="card-header">
            <h3 class="card-title">Add New Purchase Order</h3>

            
          </div>
          <!-- /.card-header -->
          <form action="{{ route('purchase.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Order Date</label>
                    <input type="date" class="form-control" id="" placeholder="" name="order_date">
                    @error('order_date')<span class="error-message"role="alert">{{ $message }} </span>@enderror
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

                <h3>Items</h3>
        <table class="table" id="items-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Item No</th>
                    <th>Stock Unit</th>
                    <th>Packing Unit</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Item Amount</th>
                    <th>Discount</th>
                    <th>Net Amount</th>
                    <th><button type="button" class="btn btn-success" onclick="addItemRow()">Add Item</button></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <br>

        <div class="row">
        <div class="col-6">
</div>
    <div class="col-6">
        <table class="table">
            <tr>
                <th>Item Total:</th>
                <td><span id="itemTotal">0.00</span></td>
            </tr>
            <tr>
                <th>Discount:</th>
                <td><span id="discountTotal">0.00</span></td>
            </tr>
            <tr>
                <th>Net Amount:</th>
                <td><span id="netAmount">0.00</span></td>
            </tr>
        </table>
    </div>
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

<script>
    let items = @json($items);

    function addItemRow() {
        let row = `
            <tr>
                <td>
                    <select name="items[]" class="form-control" onchange="fetchItemDetails(this)" required>
                    <option value="">Select Item</option>
                        ${items.map(item => `<option value="${item.id}">${item.name}</option>`).join('')}
                    </select>
                </td>
                <td><input type="text" name="item_no[]" class="form-control item-no" readonly></td>
                <td><input type="text" name="stock_unit[]" class="form-control stock-unit" readonly></td>
                <td><select name="packing_unit[]" class="form-control" required>
                        <option value="Number">Number</option>
                        <option value="Kilogram">Kilogram</option>
                        <option value="Liter">Liter</option>
                    </select></td>
                <td><input type="number" name="quantities[]" class="form-control quantity" oninput="updateTotal(this)" required ></td>
                <td><input type="text" name="unit_price[]" class="form-control unit-price" readonly></td>
                <td><input type="text" name="item_amount[]" class="form-control item-total" readonly></td>
                <td><input type="text" name="discounts[]" class="form-control item-discount" oninput="updateNetAmount(this)"></td>
                <td><input type="text" name="net_amount[]" class="form-control net-amount" readonly></td>
                <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
            </tr>
        `;
        document.querySelector("#items-table tbody").insertAdjacentHTML("beforeend", row);
    }

    function removeRow(button) {
        button.closest('tr').remove();
        recalculateTotals();
    }

    function fetchItemDetails(selectElement) {
        let itemId = selectElement.value;
        let row = selectElement.closest('tr');
        
        if (itemId) {
            fetch(`/item/show/${itemId}/`)
                .then(response => response.json())
                .then(data => {
                    if (!data.error) {
                        row.querySelector('.item-no').value = data.item_no;
                        row.querySelector('.unit-price').value = data.unit_price;
                        row.querySelector('.stock-unit').value = data.stock_unit;
                        updateTotal(row.querySelector('.quantity'));
                    } else {
                        alert(data.error);
                    }
                });
        }
    }

    function updateTotal(element) {
        let row = element.closest('tr');
        let quantity = parseFloat(row.querySelector('.quantity').value) || 0;
        let unitPrice = parseFloat(row.querySelector('.unit-price').value) || 0;
        
        // Calculate and set item total
        row.querySelector('.item-total').value = (quantity * unitPrice).toFixed(2);
        

        // Update grand total
        updateGrandTotal();
    }

    function updateNetAmount(element) {
        let row = element.closest('tr');
        let discount = parseFloat(row.querySelector('.item-discount').value) || 0;
        let itemTotal = parseFloat(row.querySelector('.item-total').value) || 0;
        
        // Calculate and set item total
        row.querySelector('.net-amount').value = (itemTotal - discount).toFixed(2);
        

        // Update grand total
        updateGrandTotal();
    }

    function updateGrandTotal() {
      let itemTotals = Array.from(document.querySelectorAll('.item-total')).map(el => parseFloat(el.value) || 0);
      let discounts = Array.from(document.querySelectorAll('.item-discount')).map(el => parseFloat(el.value) || 0);

      let itemTotalSum = itemTotals.reduce((sum, val) => sum + val, 0);
      let discountTotalSum = discounts.reduce((sum, val) => sum + val, 0);
      let netAmount = itemTotalSum - discountTotalSum;

      document.getElementById('itemTotal').innerText = itemTotalSum.toFixed(2);
      document.getElementById('discountTotal').innerText = discountTotalSum.toFixed(2);
      document.getElementById('netAmount').innerText = netAmount.toFixed(2);
    }

    
    function recalculateTotals() {
        let itemTotal = 0;
        let discountTotal = 0;
        let netTotal = 0;

        let rows = document.querySelectorAll("#items-table tbody tr");
        
        rows.forEach(row => {
            let unitPrice = parseFloat(row.querySelector('.unit-price').value) || 0;
            let quantity = parseInt(row.querySelector('input[name="quantities[]"]').value) || 0;
            let discount = parseFloat(row.querySelector('input[name="discounts[]"]').value) || 0;

            let itemAmount = unitPrice * quantity;
            let netAmount = itemAmount - discount;

            row.querySelector('input[name="item_amount[]"]').value = itemAmount.toFixed(2);
            row.querySelector('input[name="net_amount[]"]').value = netAmount.toFixed(2);

            itemTotal += itemAmount;
            discountTotal += discount;
            netTotal += netAmount;
        });

        document.getElementById('itemTotal').innerText = itemTotal.toFixed(2);
        document.getElementById('discountTotal').innerText = discountTotal.toFixed(2);
        document.getElementById('netAmount').innerText = netTotal.toFixed(2);
    }
</script>