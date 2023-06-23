<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BaseRepository;
use App\Repositories\BaseRepositoryInterface;
use App\Repositories\Employee\EmployeeRepository;
use App\Repositories\Employee\EmployeeRepositoryInterface;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Supplier\SupplierRepository;
use App\Repositories\Supplier\SupplierRepositoryInterface;
use App\Repositories\AdvanceSalary\AdvanceSalaryRepository;
use App\Repositories\AdvanceSalary\AdvanceSalaryRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
        $this->app->bind(AdvanceSalaryRepositoryInterface::class, AdvanceSalaryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
