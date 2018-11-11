<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BudgetsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentMonth = request('month') ?: Carbon::now()->format('M');
        if (request()->has('month')) {
            $budgets = Budget::byMonth(request('month'))->get();
        } else {
            $budgets = Budget::byMonth('this month')->get();
        }
        return view('budgets.index', compact('currentMonth', 'budgets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $months = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ];

        $budget = new Budget();
        $categories = Category::all();

        return view('budgets.create', compact('months', 'categories', 'budget'));
    }

    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function store()
    {
        $this->validate(request(), [
            'category_id' => 'required',
            'amount'      => 'required',
            'budget_date' => 'required'
        ]);

        Budget::create(request()->all());
        return redirect('/budgets');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Budget $budget
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Budget $budget)
    {
        $months = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ];
        $categories = Category::all();

        return view('budgets.edit', compact('months', 'categories', 'budget'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Budget $budget
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     * @internal param int $id
     */
    public function update(Budget $budget)
    {
        $this->validate(request(), [
            'category_id' => 'required',
            'amount'      => 'required',
            'budget_date' => 'required'
        ]);

        $budget->update(request()->all());
        return redirect('/budgets');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Budget $budget
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Budget $budget)
    {
        $budget->delete();
        return redirect('/budgets');
    }
}
