<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreInvestmentRequest;
use App\Models\Investment;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    public function index()
    {
        return view('admin.investments.index', ['investments' => Investment::all()]);
    }

    public function create()
    {
        return view('admin.investments.create');
    }

    public function store(StoreInvestmentRequest $request)
    {
        Investment::create($request->all());
        return redirect()->route('admin.investments.index')->with('success', 'Investimento criado com sucesso!');
    }

    public function edit(Investment $investment)
    {
        return view('admin.investments.edit', compact('investment'));
    }

    public function update(Request $request, Investment $investment)
    {
        $investment->update($request->all());
        return redirect()->route('admin.investments.index')->with('success', 'Investimento atualizado com sucesso!');
    }

    public function destroy(Investment $investment)
    {
        $investment->delete();
        return redirect()->route('admin.investments.index')->with('success', 'Investimento removido com sucesso!');
    }
}
