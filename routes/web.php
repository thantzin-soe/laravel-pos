<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\AdvanceSalaryController;
use App\Http\Controllers\Backend\PaySalaryController;
use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/password-change', [PasswordController::class, 'passwordChange'])->name('password.edit');


    Route::get('employees/search', [EmployeeController::class, 'search'])->name('employees.search');
    Route::resource('employees', EmployeeController::class);

    Route::get('customers/search', [CustomerController::class, 'search'])->name('customers.search');
    Route::resource('customers', CustomerController::class);

    Route::resource('suppliers', SupplierController::class);

    Route::resource('advance_salaries', AdvanceSalaryController::class);

    Route::controller(PaySalaryController::class)->group(function () {
        Route::get('salaries', 'index')->name('salaries.index');
        Route::get('pay/salaries/{year}/{month}/{employee}', 'paySalary')->name('salaries.pay');
        Route::post('pay/salaries/{employee}', 'paidSalary')->name('salaries.paid');
    });

    Route::controller(AttendanceController::class)->group(function () {
        Route::get('attendances', 'index')->name('attendances.index');
        Route::post('attendances', 'save')->name('attendances.save');
    });

    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::get('barcode/products/{product}', [ProductController::class, 'generateBarCode'])->name('products.code');
    Route::get('imports/products', [ProductController::class, 'importProductForm'])->name('products.import');
    Route::post('imports/products', [ProductController::class, 'importProduct'])->name('products.import');
    Route::post('exports/products', [ProductController::class, 'exportProduct'])->name('products.export');


    Route::controller(ExpenseController::class)->group(function () {
        Route::get('expenses', 'create')->name('expenses.create');
        Route::post('expenses', 'store')->name('expenses.store');
        Route::get('expenses/{expense}/edit', 'edit')->name('expenses.edit');
        Route::put('expenses/{expense}', 'update')->name('expenses.update');
        Route::get('expenses/today', 'todayExpense')->name('expenses.today');
        Route::get('expenses/montly', 'monthlyExpense')->name('expenses.monthly');
        Route::get('expenses/yearly', 'yearlyExpense')->name('expenses.yearly');
    });


    Route::controller(PosController::class)->group(function () {
        Route::get('pos', 'pos')->name('pos');
        Route::post('addToCart', 'addToCart')->name('add.to.cart');
        Route::get('getFromCart', 'getFromCart')->name('get.from.cart');
        Route::put('updateCart', 'updateCart')->name('cart.update');
        Route::get('cart/remove/{id}', 'cartRemove')->name('cart.remove');
        Route::post('invoices/create', 'createInvoice')->name('invoices.create');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::post('orders/store', 'store')->name('orders.store');
        Route::get('orders/pending', 'pendingOrders')->name('orders.pending');
        Route::get('orders/completed', 'completedOrders')->name('orders.completed');
        Route::get('orders/invoice-download/{order}', 'orderInvoice')->name('orders.invoice');
        Route::put('orders/{order}', 'update')->name('orders.update');
        Route::get('orders/{order}', 'show')->name('orders.details');

        Route::get('stock', 'manageStock')->name('stock.manage');
    });


    Route::controller(RoleController::class)->group(function () {
        Route::get('permissions', 'allPermission')->name('permissions.index');
        Route::get('permissions/create', 'createPermission')->name('permissions.create');
        Route::post('permissions/store', 'storePermission')->name('permissions.store');
        Route::get('permissions/{permission}/edit', 'editPermission')->name('permissions.edit');
        Route::put('permissions/{permission}', 'updatePermission')->name('permissions.update');
        Route::delete('permissions/{permission}', 'deletePermission')->name('permissions.destroy');


        Route::get('roles', 'allRole')->name('roles.index');
        Route::get('roles/create', 'createRole')->name('roles.create');
        Route::post('roles/store', 'storeRole')->name('roles.store');

        Route::get('roles/attach-permission', 'attachPermission')->name('roles.attach.permission');
        Route::post('roles/attach-permission', 'attachPermission');
        Route::get('roles/permissions', 'allRolesWithPermissions')->name('roles.with.permission');
        Route::get('roles/{role}/edit-permission', 'editPermissioninRole')->name('roles.permission.edit');
        Route::put('roles/{role}/update-permission', 'updatePermissioninRole')->name('roles.permission.update');

        Route::get('roles/{role}/edit', 'editRole')->name('roles.edit');
        Route::put('roles/{role}', 'updateRole')->name('roles.update');
        Route::delete('roles/{role}', 'deleteRole')->name('roles.destroy');
    });


    Route::controller(AdminController::class)->group(function () {
        Route::get('admins', 'index')->name('admins.index');
        Route::get('admins/create', 'create')->name('admins.create');
        Route::post('admins/store', 'store')->name('admins.store');
        Route::get('admins/{admin}/edit', 'edit')->name('admins.edit');
        Route::put('admins/{admin}', 'update')->name('admins.update');
        Route::delete('admins/{admin}', 'destroy')->name('admins.destroy');
    });
});

Route::get('logout', [AuthenticatedSessionController::class, 'logoutPage']);
require __DIR__.'/auth.php';
