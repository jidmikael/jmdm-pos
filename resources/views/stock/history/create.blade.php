@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card">
                <div class="card-header">
                    <h4>Add Stock In/Out</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('stock.history.store') }}" method="POST">
                        @csrf

                        <!-- Product Dropdown -->
                        <div class="form-group">
    <label for="product_id">Product</label>
    <select name="product_id" id="product_id" class="form-control" required>
        <option disabled selected>-- Select Product --</option>
        @foreach($products as $product)
            <option value="{{ $product->id }}" data-stock="{{ $product->product_store }}">
                {{ $product->product_name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="current_stock">Current Stock</label>
    <input type="text" id="current_stock" class="form-control" disabled placeholder="Stock will show here">
</div>


                        <!-- Type -->
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" class="form-control" required>
                                <option value="in">Stock In</option>
                                <option value="out">Stock Out</option>
                            </select>
                        </div>

                        <!-- Quantity -->
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" class="form-control" min="1" required>
                        </div>

                        <!-- Buttons -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('stock.history') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
    $(document).ready(function () {
        console.log('Script loaded!');
        $('#product_id').on('change', function () {
            var selectedStock = $(this).find(':selected').data('stock');

            // For debugging
            console.log('Selected stock:', selectedStock);

            $('#current_stock').val(selectedStock !== undefined ? selectedStock : '');
        });
    });
</script>
@endsection
@endsection
