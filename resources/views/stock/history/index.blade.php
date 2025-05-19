@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @if (session()->has('success'))
                <div class="alert text-white bg-success" role="alert">
                    <div class="iq-alert-text">{{ session('success') }}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ri-close-line"></i>
                    </button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert text-white bg-danger" role="alert">
                    <div class="iq-alert-text">{{ session('success') }}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ri-close-line"></i>
                    </button>
                </div>
            @endif
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-3">Stock In and Stock Out History</h4>
                </div>
                <div>
                    <a href="{{ route('stock.history.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Change Stock
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <form action="{{ route('order.stockManage') }}" method="get">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <div class="form-group row">
                        <label for="row" class="col-sm-3 align-self-center">Row:</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="row">
                                <option value="10" @if(request('row') == '10')selected="selected"@endif>10</option>
                                <option value="25" @if(request('row') == '25')selected="selected"@endif>25</option>
                                <option value="50" @if(request('row') == '50')selected="selected"@endif>50</option>
                                <option value="100" @if(request('row') == '100')selected="selected"@endif>100</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="search">Search:</label>
                        <div class="input-group col-sm-8">
                            <input type="text" id="search" class="form-control" name="search" placeholder="Search product" value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text bg-primary"><i class="ri-search-line"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
                <table class="table mb-0">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Photo</th>
                            <th>@sortablelink('product_name', 'name')</th>
                            <th>@sortablelink('category.name', 'category')</th>
                            <th>@sortablelink('supplier.name', 'supplier')</th>
                            <th>@sortablelink('selling_price', 'price')</th>
                            <th>Stock After</th>
                            <th>Type</th> <!-- Stock In / Out -->
                            <th>Quantity</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @forelse ($stockHistories as $stock)
                        <tr>
                            <td>{{ (($stockHistories->currentPage() * 10) - 10) + $loop->iteration }}</td>
                            <td>
                                <img class="avatar-60 rounded" src="{{ $stock->product->product_image ? asset('storage/products/'.$stock->product->product_image) : asset('assets/images/product/default.webp') }}">
                            </td>
                            <td>{{ $stock->product->product_name }}</td>
                            <td>{{ $stock->product->category->name }}</td>
                            <td>{{ $stock->product->supplier->name }}</td>
                            <td>${{ $stock->product->selling_price }}</td>
                            <td>{{ $stock->stock_after }}</td>
                            <td>
                                <span class="badge {{ $stock->type == 'in' ? 'badge-success' : 'badge-danger' }}">
                                    {{ ucfirst($stock->type) }}
                                </span>
                            </td>
                            <td>{{ $stock->quantity }}</td>
                            <td>{{ \Carbon\Carbon::parse($stock->created_at)->format('Y-m-d H:i') }}</td>
                        </tr>
                        @empty
                        <div class="alert text-white bg-danger" role="alert">
                            <div class="iq-alert-text">No stock history found.</div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="ri-close-line"></i>
                            </button>
                        </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $stockHistories->links() }}
        </div>
    </div>
    <!-- Page end  -->
</div>

@endsection
