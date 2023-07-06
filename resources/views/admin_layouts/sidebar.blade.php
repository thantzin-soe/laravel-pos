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

                            @if(auth()->user()->can('pos.menu'))
                            <li>
                                <a href="{{ route('pos') }}">
                                    <span class="badge bg-pink float-end">Hot</span>
                                    <i class="mdi mdi-view-dashboard-outline"></i>
                                    <span> POS </span>
                                </a>
                            </li>
                            @endif

                            <li class="menu-title mt-2">Apps</li>

                            @if(auth()->user()->can('employee.menu'))
                            <li>
                                <a href="#sidebarEmployee" data-bs-toggle="collapse">
                                    <i class="mdi mdi-account-group"></i>
                                    <span> Employee Manage </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarEmployee">
                                    <ul class="nav-second-level">
                                        @if(auth()->user()->can('employee.all'))
                                        <li>
                                            <a href="{{ route('employees.index') }}">All Employees</a>
                                        </li>
                                        @endif
                                        @if(auth()->user()->can('employee.add'))
                                        <li>
                                            <a href="{{ route('employees.create') }}">Add Employee</a>
                                        </li>
                                        @endif
                                    </ul>   
                                </div>
                            </li>
                            @endif

                            @if(auth()->user()->can('customer.menu'))
                            <li>
                                <a href="#sidebarCustomer" data-bs-toggle="collapse">
                                    <i class="mdi mdi-account-group"></i>
                                    <span> Customer Manage </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarCustomer">
                                    <ul class="nav-second-level">
                                        @if(auth()->user()->can('customer.all'))
                                        <li>
                                            <a href="{{ route('customers.index') }}">All Customers</a>
                                        </li>
                                        @endif
                                        @if(auth()->user()->can('customer.add'))
                                        <li>
                                            <a href="{{ route('customers.create') }}">Add Customer</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if(auth()->user()->can('supplier.menu'))
                            <li>
                                <a href="#sidebarSupplier" data-bs-toggle="collapse">
                                    <i class="mdi mdi-account-group"></i>
                                    <span> Supplier Manage </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarSupplier">
                                    <ul class="nav-second-level">
                                        @if(auth()->user()->can('supplier.all'))
                                        <li>
                                            <a href="{{ route('suppliers.index') }}">All Suppliers</a>
                                        </li>
                                        @endif
                                        @if(auth()->user()->can('supplier.add'))
                                        <li>
                                            <a href="{{ route('suppliers.create') }}">Add Supplier</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if(auth()->user()->can('salary.menu'))
                            <li>
                                <a href="#sidebarSalary" data-bs-toggle="collapse">
                                    <i class="mdi mdi-cash-multiple"></i>
                                    <span> Employee Salary </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarSalary">
                                    <ul class="nav-second-level">
                                        @if(auth()->user()->can('salary.add'))
                                        <li>
                                            <a href="{{ route('advance_salaries.create') }}">Add Advance Salary</a>
                                        </li>
                                        @endif
                                        @if(auth()->user()->can('salary.all'))
                                        <li>
                                            <a href="{{ route('advance_salaries.index') }}">All Advance Salary</a>
                                        </li>
                                        @endif
                                        @if(auth()->user()->can('salary.pay'))
                                        <li>
                                            <a href="{{ route('salaries.index') }}">Pay Salary</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if(auth()->user()->can('attendance.menu'))
                            <li>
                                <a href="#sidebarAttendance" data-bs-toggle="collapse">
                                    <i class="mdi mdi-briefcase-check-outline"></i>
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
                            @endif

                            @if(auth()->user()->can('category.menu'))
                            <li>
                                <a href="#sidebarCategory" data-bs-toggle="collapse">
                                    <i class="mdi mdi-clipboard-list-outline"></i>
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
                            @endif

                            @if(auth()->user()->can('product.menu'))
                            <li>
                                <a href="#sidebarProduct" data-bs-toggle="collapse">
                                    <i class="fas fa-bars"></i>
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
                            @endif

                            @if(auth()->user()->can('orders.menu'))
                            <li>
                                <a href="#sidebarOrder" data-bs-toggle="collapse">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span> Orders </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarOrder">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('orders.pending') }}">Pending Orders</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('orders.completed') }}">Completed Orders</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('orders.pending.due') }}">Pending Due</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @endif


                            @if(auth()->user()->can('stock.menu'))
                            <li>
                                <a href="#sidebarStock" data-bs-toggle="collapse">
                                    <i class="fas fa-weight-hanging"></i>
                                    <span> Stock Management </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarStock">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('stock.manage') }}">Stock</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if(auth()->user()->can('roles.menu'))
                            <li>
                                <a href="#sidebarRolesAndPermission" data-bs-toggle="collapse">
                                    <i class="fas fa-weight-hanging"></i>
                                    <span> Roles & Permisison </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarRolesAndPermission">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('permissions.index') }}">All Permission</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('roles.index') }}">All Roles</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('roles.attach.permission') }}">Attach Permissions to Role</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('roles.with.permission') }}">Roles With Permissions</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @role('Superadmin')
                            <li>
                                <a href="#sidebarAdmin" data-bs-toggle="collapse">
                                    <i class="fas fa-weight-hanging"></i>
                                    <span> Setting Admin User </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarAdmin">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('admins.index') }}">All Admin</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admins.create') }}">Add Admin</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @endrole

                            @role('Superadmin')
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
                            @endrole

                            
                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->