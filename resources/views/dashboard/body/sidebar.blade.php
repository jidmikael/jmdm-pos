<div class="iq-sidebar sidebar-default" style="background-color: #32BDEA;">
    <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard') }}" class="header-logo">
            <img src="{{ asset('assets/images/jmdmpos1.png') }}" class="img-fluid rounded-normal light-logo" alt="logo">
        </a>
        <div class="iq-menu-bt-sidebar ml-0">   
        </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="svg-icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>

                @if (auth()->user()->can('pos.menu'))
                <li class="{{ Request::is('pos*') ? 'active' : '' }}">
                    <a href="{{ route('pos.index') }}" class="svg-icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="ml-3">POS</span>
                    </a>
                </li>
                @endif

                <hr>

                @if (auth()->user()->can('orders.menu'))
                <li>
                    <a href="#orders" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="fa-solid fa-basket-shopping"></i>
                        <span class="ml-3">Orders</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="orders" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle" style="">

                        <li class="{{ Request::is('orders/complete*') ? 'active' : '' }}">
                            <a href="{{ route('order.completeOrders') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>Completed Orders</span>
                            </a>
                        </li>
                        <li class="{{ Request::is( patterns: 'stock-history') ? 'active' : '' }}">
                            <a href="{{ route('stock.history') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>Stock Management</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if (auth()->user()->can('product.menu'))
                <li>
                    <a href="#products" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        <span class="ml-3">Products</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="products" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle" style="">
                        <li class="{{ Request::is(['products']) ? 'active' : '' }}">
                            <a href="{{ route('products.index') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>Products</span>
                            </a>
                        </li>
                        <li class="{{ Request::is(['products/create']) ? 'active' : '' }}">
                            <a href="{{ route('products.create') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>Add Product</span>
                            </a>
                        </li>
                        <li class="{{ Request::is(['categories*']) ? 'active' : '' }}">
                            <a href="{{ route('categories.index') }}">
                                <i class="fa-solid fa-arrow-right"></i><span>Categories</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('products/archived') ? 'active' : '' }}">
                            <a href="{{ route('products.archived') }}">
                                <i class="fa-solid fa-box-archive"></i><span>Archived Products</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <hr>

                @if (auth()->user()->can('supplier.menu'))
                <li class="{{ Request::is('suppliers*') ? 'active' : '' }}">
                    <a href="{{ route('suppliers.index') }}" class="svg-icon">
                        <i class="fa-solid fa-users"></i>
                        <span class="ml-3">Suppliers</span>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <div class="p-3 mt-5">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-block">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i> Sign Out
                </button>
            </form>
        </div>
    </div>
</div>
