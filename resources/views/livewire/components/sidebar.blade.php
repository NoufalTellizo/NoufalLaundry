<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="../index.html" class="brand-link">
            <!--begin::Brand Image--> <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span
                class="brand-text fw-light">LAUNDRY</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div>
    <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Inventory
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{ route('inventory.products') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Products</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('inventory.categories') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Categories</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('inventory.units') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Units</p>
                            </a> </li>

                    </ul>
                </li>
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Purchase
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{ route('inventory.purchase.list') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Purchase</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('inventory.suppliers') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Suppliers</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('inventory.units') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Units</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('inventory.purchase.list') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Purchase</p>
                            </a> </li>
                    </ul>
                </li>
                {{-- <li class="nav-item"> <a href="{{route('book.list')}}" class="nav-link"> <i
                            class="nav-icon bi bi-palette"></i>
                        <p>Books</p>
                    </a> </li> --}}
                {{-- <li class="nav-item"> <a href="{{route('add.book')}}" class="nav-link"> <i
                            class="nav-icon bi bi-palette"></i>
                        <p>Add Book</p>
                    </a> </li> --}}
                {{-- <li class="nav-item"> <a href="{{route('member.list')}}" class="nav-link"> <i
                            class="nav-icon bi bi-palette"></i>
                        <p>Members</p>
                    </a> </li> --}}
                {{-- <li class="nav-item"> <a href="" class="nav-link"> <i
                            class="nav-icon bi bi-palette"></i>
                        <p>Membership Type</p>
                    </a> </li> --}}
                {{-- <li class="nav-item"> <a href="{{route('transaction.list')}}" class="nav-link"> <i
                            class="nav-icon bi bi-palette"></i>
                        <p>Transactions</p>
                    </a> </li>
                <li class="nav-item"> <a href="{{route('report.list')}}" class="nav-link"> <i
                            class="nav-icon bi bi-palette"></i>
                        <p>Reports</p>
                    </a>
                </li> --}}
                <li class="nav-item"> <a href="" class="nav-link"> <i class="nav-icon bi bi-palette"></i>
                        <p>Log Out</p>
                    </a>
                </li>
            </ul>


        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->
