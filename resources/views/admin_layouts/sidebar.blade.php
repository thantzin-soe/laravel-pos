<!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="h-100" data-simplebar>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            <li class="menu-title">Navigation</li>

                            <li>
                                <a href="{{ route('dashboard') }}">
                                    <i class="mdi mdi-view-dashboard-outline"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('pos') }}">
                                    <span class="badge bg-pink float-end">Hot</span>
                                    <i class="mdi mdi-view-dashboard-outline"></i>
                                    <span> POS </span>
                                </a>
                            </li>

                            <li class="menu-title mt-2">Apps</li>

                            <li>
                                <a href="#sidebarEmployee" data-bs-toggle="collapse">
                                    <i class="mdi mdi-cart-outline"></i>
                                    <span> Employee Manage </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarEmployee">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('employees.index') }}">All Employees</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('employees.create') }}">Add Employee</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarCustomer" data-bs-toggle="collapse">
                                    <i class="mdi mdi-cart-outline"></i>
                                    <span> Customer Manage </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarCustomer">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('customers.index') }}">All Customers</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('customers.create') }}">Add Customer</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarSupplier" data-bs-toggle="collapse">
                                    <i class="mdi mdi-cart-outline"></i>
                                    <span> Supplier Manage </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarSupplier">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('suppliers.index') }}">All Suppliers</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('suppliers.create') }}">Add Supplier</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarSalary" data-bs-toggle="collapse">
                                    <i class="mdi mdi-cart-outline"></i>
                                    <span> Employee Salary </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarSalary">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('advance_salaries.create') }}">Add Advance Salary</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('advance_salaries.index') }}">All Advance Salary</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('salaries.index') }}">Pay Salary</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>


                            <li>
                                <a href="#sidebarAttendance" data-bs-toggle="collapse">
                                    <i class="mdi mdi-cart-outline"></i>
                                    <span> Employee Attendance </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarAttendance">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('attendances.index') }}">Employee Attendance List</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarCategory" data-bs-toggle="collapse">
                                    <i class="mdi mdi-cart-outline"></i>
                                    <span> Category </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarCategory">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('categories.index') }}">All Category</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarProduct" data-bs-toggle="collapse">
                                    <i class="mdi mdi-cart-outline"></i>
                                    <span> Product </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarProduct">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('products.index') }}">All Product</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('products.create') }}">Add Product</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('products.import') }}">Import Products</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="menu-title mt-2">Custom</li>
                            <li>
                                <a href="#sidebarAuth" data-bs-toggle="collapse">
                                    <i class="mdi mdi-account-circle-outline"></i>
                                    <span> Expense </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarAuth">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('expenses.create') }}">Add Expense</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('expenses.today') }}">Today Expense</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('expenses.monthly') }}">Monthly Expense</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('expenses.yearly') }}">Yearly Expense</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarExpages" data-bs-toggle="collapse">
                                    <i class="mdi mdi-text-box-multiple-outline"></i>
                                    <span> Extra Pages </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarExpages">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="pages-starter.html">Starter</a>
                                        </li>
                                        <li>
                                            <a href="pages-timeline.html">Timeline</a>
                                        </li>
                                        <li>
                                            <a href="pages-sitemap.html">Sitemap</a>
                                        </li>
                                        <li>
                                            <a href="pages-invoice.html">Invoice</a>
                                        </li>
                                        <li>
                                            <a href="pages-faqs.html">FAQs</a>
                                        </li>
                                        <li>
                                            <a href="pages-search-results.html">Search Results</a>
                                        </li>
                                        <li>
                                            <a href="pages-pricing.html">Pricing</a>
                                        </li>
                                        <li>
                                            <a href="pages-maintenance.html">Maintenance</a>
                                        </li>
                                        <li>
                                            <a href="pages-coming-soon.html">Coming Soon</a>
                                        </li>
                                        <li>
                                            <a href="pages-gallery.html">Gallery</a>
                                        </li>
                                        <li>
                                            <a href="pages-404.html">Error 404</a>
                                        </li>
                                        <li>
                                            <a href="pages-404-two.html">Error 404 Two</a>
                                        </li>
                                        <li>
                                            <a href="pages-404-alt.html">Error 404-alt</a>
                                        </li>
                                        <li>
                                            <a href="pages-500.html">Error 500</a>
                                        </li>
                                        <li>
                                            <a href="pages-500-two.html">Error 500 Two</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            
                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->