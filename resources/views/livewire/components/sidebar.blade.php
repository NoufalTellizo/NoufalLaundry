<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand"> <a href="../index.html" class="brand-link">
            <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"> <span class="brand-text fw-light tw-text-2xl tw-font-bold"></span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Orders</li>
                <li class="nav-item"> <a href="" class="nav-link"> <i class="nav-icon bi bi-palette"></i>
                        <p>POS</p>
                    </a> </li>
                <li class="nav-item"> <a href="" class="nav-link"> <i class="nav-icon bi bi-palette"></i>
                        <p>Orders</p>
                    </a> </li>
                <li class="nav-item"> <a href="" class="nav-link"> <i class="nav-icon bi bi-palette"></i>
                        <p>Order Status Screen</p>
                    </a> </li>
                <li class="nav-header">Application</li>
                <li class="nav-item {{ Request::is('customers*') ? 'menu-open' : '' }} "> <a href="#"
                        class="nav-link "> <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Category
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ Request::is('customers/customerlist') ? 'active' : '' }}"> <a
                                href="{{ route('inventory.categories.two') }}"
                                class="nav-link  {{ Request::is('customers/customerlist') ? 'active' : '' }}"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Category List</p>
                            </a> </li>
                        
                        <li class="nav-item {{ Request::is('customers/customerlist') ? 'active' : '' }}"> <a
                                href="{{ route('inventory.suppliers.two') }}"
                                class="nav-link  {{ Request::is('customers/customerlist') ? 'active' : '' }}"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Suppliers List</p>
                            </a> </li>
                        <li class="nav-item {{ Request::is('customers/customerlist') ? 'active' : '' }}"> <a
                                href="{{ route('inventory.suppliers.three') }}"
                                class="nav-link  {{ Request::is('customers/customerlist') ? 'active' : '' }}"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Suppliers List Three</p>
                            </a> </li>
                        <li class="nav-item {{ Request::is('customers/customerlist') ? 'active' : '' }}"> <a
                                href="{{ route('inventory.suppliers.four') }}"
                                class="nav-link  {{ Request::is('customers/customerlist') ? 'active' : '' }}"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Suppliers List Four</p>
                            </a> </li>
                        <li class="nav-item {{ Request::is('customers/customerlist') ? 'active' : '' }}"> <a
                                href="{{ route('inventory.products.two') }}"
                                class="nav-link  {{ Request::is('customers/customerlist') ? 'active' : '' }}"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Product List Two</p>
                            </a> </li>
                        <li class="nav-item {{ Request::is('customers/customerlist') ? 'active' : '' }}"> <a
                                href="{{ route('inventory.products.three') }}"
                                class="nav-link  {{ Request::is('customers/customerlist') ? 'active' : '' }}"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Product List Three</p>
                            </a> </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
