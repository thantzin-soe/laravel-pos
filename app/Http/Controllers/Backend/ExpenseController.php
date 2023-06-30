<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    public function create()
    {
        return view('backend.expense.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'details' => ['required', 'string'],
            'amount' => ['required', 'integer']
        ]);

        Expense::create($request->all());

        $notification = [
            'message' => 'Expense inserted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }


    public function todayExpense()
    {
        $date = date('Y-m-d');
        $expenses = Expense::where('date', $date)->get();
        $total_expense = Expense::where('date', $date)->sum('amount');
        return view('backend.expense.today', compact('expenses', 'total_expense'));
    }

    public function edit(Expense $expense)
    {
        return view('backend.expense.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'details' => ['required', 'string'],
            'amount' => ['required', 'integer']
        ]);

        $expense->update($request->all());

        $notification = [
            'message' => 'Expense updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }


    public function monthlyExpense()
    {
        $month = date('F');
        $expenses = Expense::where('month', $month)->get();
        $total_expense = Expense::where('month', $month)->sum('amount');
        return view('backend.expense.monthly', compact('expenses', 'total_expense'));
    }

    public function yearlyExpense()
    {
        $year = date('Y');
        $expenses = Expense::where('year', $year)->get();
        $total_expense = Expense::where('year', $year)->sum('amount');
        return view('backend.expense.yearly', compact('expenses', 'total_expense'));
    }
}
