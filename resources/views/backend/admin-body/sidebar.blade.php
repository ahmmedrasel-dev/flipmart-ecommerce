<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="index.html">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('backend-assets/images/logo-dark.png') }}" alt="">
                        <h3><b>Flipmart</b> Admin</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            {{-- <li class="treeview @yield('d_active')">
                <a href="{{ route('adminDashboard') }}"><i data-feather="pie-chart"></i>Dashboard</a>
            </li> --}}

            <li class="treeview @yield('d_active')">
                <a href="{{ route('adminDashboard') }}"><i data-feather="pie-chart"></i>Dashboard</a>
            </li>

            <li class="treeview @yield('b_active')">
                <a href="#">
                    <i class="fa fa-heart"></i>
                    <span>Brand</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@yield('b_subactive')"><a href="{{ route('brand.index') }}"><i class="ti-more"></i>All Brands</a></li>
                    <li class="@yield('b_subactive_trash')"><a href="{{ route('brand.trash') }}"><i class="ti-more"></i>Trash</a></li>
                </ul>
            </li>

            <li class="treeview @yield('ca_active')">
                <a href="#">
                    <i class="mdi mdi-file-tree"></i>
                    <span>Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@yield('ca_subactive')"><a href="{{ route('category.index') }}"><i class="ti-more"></i>All Category</a></li>
                    <li class="@yield('ca_subactive_trash')"><a href="{{ route('category.trash') }}"><i class="ti-more"></i>Trash</a></li>
                </ul>
            </li>

            <li class="treeview @yield('subca_active')">
                <a href="#">
                    <i class="mdi mdi-file-tree"></i>
                    <span>Subcategory</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@yield('subca_subactive')"><a href="{{ route('subcategory.index') }}"><i class="ti-more"></i>All Subcategory</a></li>
                    <li class="@yield('subsubca_subactive')"><a href="{{ route('subsubcategory.index') }}"><i class="ti-more"></i>All sub-subcategory</a></li>
                    <li class="@yield('subca_subactive_trash')"><a href="{{ route('subcategory.trash') }}"><i class="ti-more"></i>Trash</a></li>
                </ul>
            </li>

            <li class="treeview @yield('ecom_active')">
                <a href="#">
                    <i class="mdi mdi-file-tree"></i>
                    <span>E-commerces</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@yield('attribute_active')"><a href="{{ route('attribute.index') }}"><i class="ti-more"></i>Add Attribute</a></li>
                    <li class="@yield('attribute_active')"><a href="{{ route('attributevalue.view') }}"><i class="ti-more"></i>Add Attri-value</a></li>
                    <li class="@yield('product_active')"><a href="{{ route('product.index') }}"><i class="ti-more"></i>All Products</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i data-feather="mail"></i> <span>Mailbox</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="mailbox_inbox.html"><i class="ti-more"></i>Inbox</a></li>
                    <li><a href="mailbox_compose.html"><i class="ti-more"></i>Compose</a></li>
                    <li><a href="mailbox_read_mail.html"><i class="ti-more"></i>Read</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Pages</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="profile.html"><i class="ti-more"></i>Profile</a></li>
                    <li><a href="invoice.html"><i class="ti-more"></i>Invoice</a></li>
                </ul>
            </li>

            <li class="header nav-small-cap">User Interface</li>

            <li class="treeview">
                <a href="#">
                    <i data-feather="grid"></i>
                    <span>Components</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="components_alerts.html"><i class="ti-more"></i>Alerts</a></li>
                    <li><a href="components_badges.html"><i class="ti-more"></i>Badge</a></li>
                    <li><a href="components_buttons.html"><i class="ti-more"></i>Buttons</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i data-feather="credit-card"></i>
                    <span>Cards</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="card_advanced.html"><i class="ti-more"></i>Advanced Cards</a></li>
                    <li><a href="card_basic.html"><i class="ti-more"></i>Basic Cards</a></li>
                    <li><a href="card_color.html"><i class="ti-more"></i>Cards Color</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i data-feather="alert-triangle"></i>
                    <span>Authentication</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="auth_login.html"><i class="ti-more"></i>Login</a></li>
                    <li><a href="auth_register.html"><i class="ti-more"></i>Register</a></li>
                </ul>
            </li>

            <li class="header nav-small-cap">EXTRA</li>

            <li>
                <a href="auth_login.html">
                    <i data-feather="lock"></i>
                    <span>Log Out</span>
                </a>
            </li>

        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings"
            aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i
                class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i
                class="ti-lock"></i></a>
    </div>
</aside>
