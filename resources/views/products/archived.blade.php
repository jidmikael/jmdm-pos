@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <h4 class="mb-4">Archived Products</h4>

    @if (session()->has('success'))
        <div class="alert text-white bg-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive rounded mb-3">
        <table class="table mb-0">
            <thead class="bg-white text-uppercase">
                <tr class="ligth ligth-data">
                    <th>No.</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Supplier</th>
                    <th>Selling Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="ligth-body">
                @forelse ($products as $product)
                    <tr>
                        <td>{{ (($products->currentPage() - 1) * $products->perPage()) + $loop->iteration }}</td>
                        <td>
                            <img class="avatar-60 rounded" src="{{ $product->product_image ? asset('storage/products/'.$product->product_image) : asset('assets/images/product/default.webp') }}">
                        </td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->supplier->name }}</td>
                        <td>{{ $product->selling_price }}</td>
                        <td>
                            <form action="{{ route('products.restore', $product->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-danger">No archived products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $products->links() }}
</div>
@endsection
